<?php
require __DIR__.'../../../vendor/autoload.php';

use  \App\Db\Pagination;
use   \App\Entidy\Cidade;
use    \App\Session\Login;

define('TITLE','Listar Cidade');
define('BRAND','Cidade');


Login::requireLogin();


$buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);

$condicoes = [
    strlen($buscar) ? 'nome LIKE "%'.str_replace(' ','%',$buscar).'%" or 
                       id LIKE "%'.str_replace(' ','%',$buscar).'%"' : null
];

$condicoes = array_filter($condicoes);

$where = implode(' AND ', $condicoes);

$qtd = Cidade:: getQtd($where);

$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1, 7);

$listar = Cidade::getList($where, 'id desc',$pagination->getLimit());


include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/cidade/cidade-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';


?>
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
        $('#telefone').val(data[2]);
        $('#email').val(data[3]);
        $('#placa').val(data[4]);
        $('#marcas_id').val(data[5]);
        $('#fabricante').val(data[6]);
    });
});
</script>