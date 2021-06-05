<?php

require __DIR__ . '../../../vendor/autoload.php';

$alertaCadastro = '';

define('TITLE', 'Editar Cliente');
define('BRAND', 'Cliente');

use \App\Entidy\Cliente;
use  \App\Session\Login;


Login::requireLogin();

$usuariologado = Login:: getUsuarioLogado();

$usuarios_id = $usuariologado['id'];


$value = Cliente::getID($_GET['id']);


if (!$value instanceof Cliente) {
    header('location: index.php?status=error');

    exit;
}

        if (isset($_GET['nome'])) {

            $value->nome      = $_GET['nome'];
            $value->telefone  = $_GET['telefone'];
            $value->email     = $_GET['email'];
            $value->placa     = $_GET['placa'];
            $value->marcas_id = $_GET['marcas_id'];
            $value->usuarios_id = $usuarios_id;
            $value->atualizar();

            header('location: cliente-list.php?status=success');

            exit;


        
    }

