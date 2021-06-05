<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Cidade
{

    public $id;
    public $nome;
    public $estados_id;


    public function cadastar()
    {


        $obdataBase = new Database('cidades');

        $this->id = $obdataBase->insert([

            'nome'             => $this->nome,
            'estados_id'       => $this->estados_id


        ]);

        return true;
    }

    public static function getList($where = null, $order = null, $limit = null)
    {

        return (new Database('cidades'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getListCliMarca($where = null, $order = null, $limit = null)
    {

        return (new Database('cidades'))->CliMarca($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQtdCliMarca($where = null)
    {

        return (new Database('cidades'))->qtdCli($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getQtd($where = null)
    {

        return (new Database('cidades'))->select($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }


    public static function getID($id)
    {
        return (new Database('cidades'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }

    public static function getEstados($id)
    {
        return (new Database('cidades'))->select('estados_id = ' . $id)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getclientID($id)
    {
        return (new Database('cidades'))->clientemarcaid('c.id = ' . $id)
            ->fetchObject(self::class);
    }


    public function atualizar()
    {
        return (new Database('cidades'))->update('id = ' . $this->id, [


            'nome'             => $this->nome,
            'estados_id'       => $this->estados_id


        ]);
    }

    public function excluir()
    {
        return (new Database('cidades'))->delete('id = ' . $this->id);
    }


    public static function getEmail($foto)
    {

        return (new Database('cidades'))->select('foto = "' . $foto . '"')->fetchObject(self::class);
    }

    public static function getPdf()
    {

        return (new Database('cidades'))->pdf($where = null)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
