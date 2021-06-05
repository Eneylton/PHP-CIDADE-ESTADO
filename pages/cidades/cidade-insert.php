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
    $item->nome        = $_POST['nome'];
    $item->telefone    = $_POST['telefone'];
    $item->email       = $_POST['email'];
    $item->placa       = $_POST['placa'];
    $item->marcas_id   = $_POST['marcas_id'];
    $item->usuarios_id = $usuarios_id;
    $item->cadastar();

    header('location: cliente-list.php?status=success');
    exit;
}

