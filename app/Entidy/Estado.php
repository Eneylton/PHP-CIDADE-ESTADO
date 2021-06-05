<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Estado{

    public $id;
    public $nome;
  

    public function cadastar(){


        $obdataBase = new Database('estados');  
        
        $this->id = $obdataBase->insert([
           
                'nome'             => $this->nome
              

        ]);

        return true;

    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('estados'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getListCliMarca($where = null, $order = null, $limit = null){

    return (new Database ('estados'))->CliMarca($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtdCliMarca($where = null){

    return (new Database ('estados'))->qtdCli($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getQtd($where = null){

    return (new Database ('estados'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('estados'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public static function getclientID($id){
    return (new Database ('estados'))->clientemarcaid('c.id = ' .$id)
                                   ->fetchObject(self::class);
 
}


public function atualizar(){
    return (new Database ('estados'))->update('id = ' .$this-> id, [

                                               
        'nome'             => $this->nome
      

    ]);
  
}

public function excluir(){
    return (new Database ('estados'))->delete('id = ' .$this->id);
  
}


public static function getEmail($foto){

    return (new Database ('estados'))->select('foto = "'.$foto.'"')-> fetchObject(self::class);

}

public static function getPdf(){

    return (new Database ('estados'))->pdf($where = null)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}


}