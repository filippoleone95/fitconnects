<?php

namespace FitCon\Model\Notizia;

use PDO;

class Notizia
{
  

    public function __construct()
    {
    }

    public function nuovaNotizia($t,$c,$conn){
           
        $sql = "INSERT INTO NOTIZIE (TITOLO,CORPO) VALUES (?,?)";
        $conn->prepare($sql)->execute([$t,$c]);
        return true;
    }
    public function delNotizia($id,$conn){
           
        $sql = "DELETE FROM  NOTIZIE  WHERE ID_NOTIZIA = ?";
        $conn->prepare($sql)->execute([$id]);
        return true;
    }
    public function updateNotizia($id,$t,$c,$conn){
           
        $sql = "UPDATE NOTIZIE SET TITOLO = ?, CORPO = ? WHERE ID_NOTIZIA = ?";
        $conn->prepare($sql)->execute([$id,$t,$c]);
        return true;
    }
    public function getNOTIZIE($conn){
           
             
        $sql = "SELECT * FROM NOTIZIE ORDER BY ID_NOTIZIA DESC ";
        $result = $conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC); 

    }
}
