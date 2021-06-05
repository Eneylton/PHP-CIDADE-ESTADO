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

            $value->nome           = $_GET['nome'];
            $value->estados_id     = $_GET['estados_id'];
            $value->cidades_id     = $_GET['cidades_id'];
           
            $value->atualizar();

            header('location: cliente-list.php?status=success');

            exit;


        
    }

