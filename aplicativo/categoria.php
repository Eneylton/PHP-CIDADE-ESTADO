<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, POST, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: text/html; charset=utf-8");

include "../Connect/connect.php";

$postjson = json_decode(file_get_contents('php://input'), true);


if ($postjson['crud'] == 'Listar-Categorias') {
    
          
    $query = mysqli_query($mysqli,"SELECT * FROM categorias");

   

        While($row = mysqli_fetch_array($query)){
     
            $id = $row['id'];
     
             $query2 = mysqli_query($mysqli,"SELECT s.id, s.nome, s.categoria_id, s.foto as foto
                                             FROM
                                             subcategoria AS s INNER JOIN categorias AS c ON (s.categoria_id = c.id)
                                             WHERE c.id = $id");
     
             foreach ($query2 as $key => $value) {
                
     
                 $data2[$key] = [
     
                     'id'                  => $value['id'],
                     'nome'                => $value['nome'],
                     'foto'                => $value['foto'],
                     'categoria_id'        => $value['categoria_id']
                
                 ];
             }
     
                 $data[] = [
     
     
                    'id'              => $row['id'],
                    'nome'            => $row['nome'],
                    'foto'            => $row['foto'],
                    'subcategoria'    => $data2
     
             ];

           
         }

         if ($query) $result = json_encode(array('success' => true, 'result' => $data));
         else $result = json_encode(array('success' => false));
         echo $result;
   
}

elseif($postjson['crud'] == "listar-categorias2"){

    $data = array();
    
    $query = mysqli_query($mysqli, "SELECT * FROM categorias as c ORDER BY c.nome ASC LIMIT $postjson[start], $postjson[limit]");

    while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id'           => $row['id'],
            'nome'         => $row['nome'],
            'foto'         => $row['foto']
            
        );
    }

    if($query) $result = json_encode(array('success' => true,'result' =>$data));
    else $result = json_encode(array('success'=> false));
    echo $result;

}

elseif($postjson['crud'] == "listar-cat"){

    $data = array();
    
    $query = mysqli_query($mysqli, "SELECT * FROM categorias as c ORDER BY c.nome ASC");

    while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id'           => $row['id'],
            'nome'    => $row['nome']
            
        );
    }

    if($query) $result = json_encode(array('success' => true,'result' =>$data));
    else $result = json_encode(array('success'=> false));
    echo $result;

}


elseif($postjson['crud'] == "adicionar"){
   
    $data = array();

    $radom     = date('Y-m-d_H_i_s');

    $entry     = base64_decode($postjson['foto']);

    $img       = imagecreatefromstring($entry);

    $directory = "../imgs/".$radom.".jpg";

    $caminho ="./imgs/".$radom.".jpg";

    imagejpeg($img, $directory);

    imagedestroy($img);


    $query   = mysqli_query($mysqli, "INSERT INTO categorias SET
               nome               = '$postjson[nome]',
               foto               = '$caminho'");

    $idadd = mysqli_insert_id($mysqli);

    if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
    else $result = json_encode(array('success'=> false));
    echo $result;
}


elseif($postjson['crud'] == "editar"){

    $data = array();

    $radom     = date('Y-m-d_H_i_s');

    $entry     = base64_decode($postjson['foto']);

    $img       = imagecreatefromstring($entry);

    $directory = "../imgs/".$radom.".jpg";

    $caminho ="./imgs/".$radom.".jpg";

    imagejpeg($img, $directory);

    imagedestroy($img);

    $query   = mysqli_query($mysqli, "UPDATE categorias SET           
     
    nome       =  '$postjson[nome]',
    foto       =  '$caminho' WHERE id  = '$postjson[id]'");


    if($query) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false));
    echo $result;
}

elseif($postjson['crud'] == "editar2"){

    $data = array();

    $query   = mysqli_query($mysqli, "UPDATE categorias SET
           
     
    nome       =  '$postjson[nome]',
    foto       =  '$postjson[foto]' WHERE id  = '$postjson[id]'");


    if($query) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false));
    echo $result;
}

elseif($postjson['crud'] == "deletar"){

    $query   = mysqli_query($mysqli, "DELETE FROM categorias WHERE id  = '$postjson[id]'");
  

    if($query) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false, 'msg'=>'error, Por favor, tente novamente... '));
    echo $result;
}


?>



