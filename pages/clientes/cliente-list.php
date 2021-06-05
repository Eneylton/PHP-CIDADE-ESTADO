<?php
require __DIR__.'../../../vendor/autoload.php';

use  \App\Db\Pagination;
use App\Entidy\Cidade;
use   \App\Entidy\Cliente;
use App\Entidy\Estado;
use    \App\Session\Login;

define('TITLE','Listar Clientes');
define('BRAND','Cliente');


Login::requireLogin();


$buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);

$condicoes = [
    strlen($buscar) ? 'c.nome LIKE "%'.str_replace(' ','%',$buscar).'%" or 
                       c.id LIKE "%'.str_replace(' ','%',$buscar).'%"' : null
];

$condicoes = array_filter($condicoes);

$where = implode(' AND ', $condicoes);

if(isset($_POST['id'])){
    $id= $_POST['id'];

    $cidades = Cidade:: getEstados($id);

    foreach ($cidades as $item) {
        echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
     }
    
}

$estados = Estado:: getList();

$qtd = Cliente:: getQtdCidEstado($where);

$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1, 7);

$clientes = Cliente::getListCidadeEstado($where, 'c.id desc',$pagination->getLimit());


include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/cliente/clientes-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';


?>
<script>
$("#estados_id").on("change", function(){
   
   var idEstado = $("#estados_id").val();
   $.ajax({
       url:'cliente-list.php',
       type:'POST',
       data:{id:idEstado},
       beforeSend:function(){
           $("#cidades").css({'display':'block'});
           $("#cidades").html("carregando....");
       },
       success:function(data){
           $("#cidades").css({'display':'block'});
           $("#cidades").html(data);
       }
   })

});

</script>
<script>
$(document).ready(function(){
    $('.editbtn').on('click', function(){
        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $('#id').val(data[0]);
        $('#nome').val(data[1]);
        $('#estados_id').val(data[2]);
        $('#cidades_id').val(data[3]);
        $('#placa').val(data[4]);
        $('#estado').val(data[5]);
        $('#cidade').val(data[6]);
    });
});
</script>

