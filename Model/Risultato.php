<?php
 namespace FitCon\Model\Risultato;
 
 use PDO;
    class Risultato{
        private $id ; 

        public function __construct()
        {
          
        }
        
        public function addRis($m,$q,$e,$u,$conn){
            
            $sql = "INSERT INTO RISULTATI (MISURA,QUANTITA,DATA_RIS,ID_ESERCIZIO,ID_USER) VALUES (?,?,NOW(),?,?)";
            $conn->prepare($sql)->execute([$m,$q,$e,$u]);
            return true;
        }

        public function delRis($id,$conn){
            
            $sql = "DELETE FROM RISULTATI WHERE ID_RISULTATO = ?)";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function getRisultatiEs($u,$e,$conn){
            
            $sql = "SELECT * FROM RISULTATI WHERE ID_USER =? AND ID_ESERCIZIO  =?";
            $result = $conn->prepare($sql);
            $result->execute([$u,$e]);
           
            return $result->fetchAll();
        }
        public function getLastRisultatoEs($u,$e,$conn){
            
            $sql = "SELECT * FROM RISULTATI WHERE ID_USER =? AND ID_ESERCIZIO  =?  ORDER BY DATA_RIS DESC LIMIT 1 ";
            $result = $conn->prepare($sql);
            $result->execute([$u,$e]);
           
            return $result->fetch();
        }
    }