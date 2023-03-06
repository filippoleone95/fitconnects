<?php
 namespace FitCon\Model\Esercizio;
 
 use PDO;
    class Esercizio{
        private $id_profilo ; 

        public function __construct()
        {
          
        }

        public function insertEsercizi($nome,$descr,$code,$idg,$conn){
           
            $sql = "INSERT INTO ESERCIZI (NOME,DESCRIZIONE,CODICE_VIDEO) VALUES (?,?,?)";
            $conn->prepare($sql)->execute([$nome,$descr,$code]);

            $stmt = $conn->prepare('SELECT ID_ESERCIZIO FROM ESERCIZI WHERE NOME = ?');
            $stmt->execute([$nome]);
            $es = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = "INSERT INTO ESERCIZIO_GRUPPO (ID_ESERCIZIO,ID_GRUPPO_MUS) VALUES (?,?)";
            $conn->prepare($sql)->execute([$es["ID_ESERCIZIO"],$idg]);
            return true;
        }

        public function updateEsercizio($nome,$desc,$code,$id,$conn){
           
            $sql = "UPDATE ESERCIZI SET NOME = ? , DESCRIZIONE = ? , CODICE_VIDEO = ? WHERE ID_ESERCIZIO = ? ";
            $conn->prepare($sql)->execute([$nome,$desc,$code,$id]);
            return true;
        }

        public function deleteEsercizio($id,$conn){
            $sql = "DELETE FROM ESERCIZIO_GRUPPO WHERE ID_ESERCIZIO = ? ";
            $conn->prepare($sql)->execute([$id]);
            $sql = "DELETE FROM ESERCIZI WHERE ID_ESERCIZIO =? ";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public  function getEserciziForGroup($g,$conn){
           
            $stmt = $conn->prepare('SELECT ID_ESERCIZIO FROM ESERCIZIO_GRUPPO WHERE ID_GRUPPO_MUS = ?');
            $stmt->bindParam(1, $g, PDO::PARAM_INT);
            $stmt->execute();
            $eser_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $eser_s;

        }

        public  function getInfoEsercizio($e,$conn){
           
            $stmt = $conn->prepare('SELECT * FROM ESERCIZI WHERE ID_ESERCIZIO = ?');
            $stmt->bindParam(1, $e, PDO::PARAM_INT);
            $stmt->execute();
            $eser = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $eser;

        }

        public  function getEsercizi($conn){
           
            $stmt = $conn->prepare('SELECT * FROM ESERCIZI');
            $stmt->execute();
            $es = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $es;

        }

        
      
    }
?>