<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Cliente{

    public $id;
    public $nome;
    public $estados_id;
    public $cidades_id;
   

    public function cadastar(){


        $obdataBase = new Database('clientes');  
        
        $this->id = $obdataBase->insert([
           
                'nome'             => $this->nome, 
                'cidades_id'       => $this->cidades_id, 
                'estados_id'       => $this->estados_id

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('clientes'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getListCidadeEstado($where = null, $order = null, $limit = null){

    return (new Database ('clientes'))->cidadeEstado($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtdCidEstado($where = null){

    return (new Database ('clientes'))->qtdCid($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getQtd($where = null){

    return (new Database ('clientes'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('clientes'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}


public function atualizar(){
    return (new Database ('clientes'))->update('id = ' .$this-> id, [

                                               
        'nome'             => $this->nome, 
        'cidades_id'       => $this->cidades_id, 
        'estados_id'       => $this->estados_id


    ]);
  
}

public function excluir(){
    return (new Database ('clientes'))->delete('id = ' .$this->id);
  
}


public static function getEmail($foto){

    return (new Database ('clientes'))->select('foto = "'.$foto.'"')-> fetchObject(self::class);

}

public static function getPdf(){

    return (new Database ('clientes'))->pdf($where = null)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}


}