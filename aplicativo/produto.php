<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, POST, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: text/json; charset=utf-8");


include "../Connect/connect.php";

$postjson = json_decode(file_get_contents('php://input'), true);

if ($postjson['crud'] == "listar-produtos") {

    $data = array();

    $query = mysqli_query($mysqli, "SELECT 
        p.id,
        p.nome,
        p.codigo,
        p.barra,
        p.valor_venda,
        p.valor_compra,
        p.aplicacao,
        p.categorias_id,
        p.estoque,
        p.foto as foto,
        c.foto as capa,
        c.nome as categoria
        FROM
        produtos AS p inner join categorias as c ON (p.categorias_id = c.id)
        order by p.id DESC LIMIT $postjson[start], $postjson[limit]");

    while ($row = mysqli_fetch_array($query)) {
        $data[] = array(
            'id'              => $row['id'],
            'nome'            => $row['nome'],
            'codigo'          => $row['codigo'],
            'barra'           => $row['barra'],
            'valor_venda'     => $row['valor_venda'],
            'valor_compra'    => $row['valor_compra'],
            'estoque'         => $row['estoque'],
            'categoria'       => $row['categoria'],
            'categorias_id'   => $row['categorias_id'],
            'aplicacao'       => $row['aplicacao'],
            'capa'            => $row['capa'],
            'foto'            => $row['foto']
        );
    }

    if ($query) $result = json_encode(array('success' => true, 'result' => $data));
    else $result = json_encode(array('success' => false));
    echo $result;
} 

    elseif ($postjson['crud'] == "adicionar") {

    $data = array();

    $radom     = date('Y-m-d_H_i_s');

    $entry     = base64_decode($postjson['foto']);

    $img       = imagecreatefromstring($entry);

    $directory = "../imgs/" . $radom . ".jpg";

    $caminho = "./imgs/" . $radom . ".jpg";

    imagejpeg($img, $directory);

    imagedestroy($img);

    $query   = mysqli_query($mysqli, "INSERT INTO produtos SET
                   
                   codigo             = '$postjson[codigo]',
                   barra              = '$postjson[barra]',
                   nome               = '$postjson[nome]',
                   qtd                = '$postjson[qtd]',
                   aplicacao          = '$postjson[aplicacao]',
                   foto               = '$caminho',
                   valor_venda        = '$postjson[valor_venda]',
                   valor_compra       = '$postjson[valor_compra]',
                   estoque            = '$postjson[estoque]',
                   status             = '$postjson[status]',
                   categorias_id      = '$postjson[categorias_id]',
                   usuarios_id        = '$postjson[usuarios_id]'
                  


                   ");

    $idadd = mysqli_insert_id($mysqli);

    if ($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
    else $result = json_encode(array('success' => false));
    echo $result;


} 

elseif($postjson['crud'] == "editar-produto"){
  
    $data = array();

    $radom     = date('Y-m-d_H_i_s');

    $entry     = base64_decode($postjson['foto']);

    $img       = imagecreatefromstring($entry);

    $directory = "../imgs/".$radom.".jpg";

    $caminho ="./imgs/".$radom.".jpg";

    imagejpeg($img, $directory);

    imagedestroy($img);

    $query   = mysqli_query($mysqli, "UPDATE produtos SET
           
                   nome               = '$postjson[nome]',
                   barra              = '$postjson[barra]',
                   codigo             = '$postjson[codigo]',
                   qtd                = '$postjson[qtd]',
                   valor_compra       = '$postjson[valor_compra]',
                   valor_venda        = '$postjson[valor_venda]',
                   estoque            = '$postjson[estoque]',
                   foto               = '$caminho',
                   aplicacao          = '$postjson[aplicacao]',
                   usuarios_id        = '$postjson[usuarios_id]',
                   categorias_id      = '$postjson[categorias_id]'  WHERE id  = '$postjson[id]'");


    if($query) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false));
    echo $result;

    
   
}


elseif($postjson['crud'] == "editar-produto2"){


    $data = array();


    $query   = mysqli_query($mysqli, "UPDATE produtos SET
           
                   nome               = '$postjson[nome]',
                   barra              = '$postjson[barra]',
                   codigo             = '$postjson[codigo]',
                   qtd                = '$postjson[qtd]',
                   valor_compra       = '$postjson[valor_compra]',
                   valor_venda        = '$postjson[valor_venda]',
                   estoque            = '$postjson[estoque]',
                   foto               = '$postjson[foto]',
                   aplicacao          = '$postjson[aplicacao]',
                   usuarios_id        = '$postjson[usuarios_id]',
                   categorias_id      = '$postjson[categorias_id]'  WHERE id  = '$postjson[id]'");


    if($query) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false));
    echo $result;

    
   
}

elseif ($postjson['crud'] == "deletar") {

    $query   = mysqli_query($mysqli, "DELETE FROM produtos WHERE id  = '$postjson[id]'");


    if ($query) $result = json_encode(array('success' => true));
    else $result = json_encode(array('success' => false, 'msg' => 'error, Por favor, tente novamente... '));
    echo $result;
}
