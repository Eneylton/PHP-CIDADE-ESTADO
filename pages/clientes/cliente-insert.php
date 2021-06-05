<?php 

require __DIR__.'../../../vendor/autoload.php';

define('TITLE','Nova Cliente');
define('BRAND','Cliente');

use  \App\Session\Login;
use   \App\Entidy\Cliente;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login:: getUsuarioLogado();

$usuarios_id = $usuariologado['id'];

Login::requireLogin();

if(isset($_POST['nome'])){

    $item = new Cliente;
    $item->nome              = $_POST['nome'];
    $item->cidades_id        = $_POST['cidades'];
    $item->estados_id        = $_POST['estados_id'];
   
    $item->cadastar();

    header('location: cliente-list.php?status=success');
    exit;
}

