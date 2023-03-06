<?php
namespace FitCon\Model\Richiesta;


use PDO;
    class Richiesta{
        private $id ; 

        public function __construct($id)
        {
            $this->id = $id;
        }

        
        public function insertRichiesta($id,$tipo,$s,$n,$i,$conn){
            if($id == "NULL"){
                $sql = "INSERT INTO RICHIESTE (ID_ATLETA,TIPO_RICHIESTA,STATO,ID_SCHEDA,NOTE) VALUES (?,?,?,?,?)";
                $conn->prepare($sql)->execute([$this->id ,$tipo,$s,$i,$n]);
            }else{
                $sql = "INSERT INTO RICHIESTE (ID_ATLETA,ID_ISTRUTT,TIPO_RICHIESTA,STATO,ID_SCHEDA,NOTE) VALUES (?,?,?,?,?,?)";
                $conn->prepare($sql)->execute([$this->id ,$id,$tipo,$s,$i,$n]);
            }
            
            
            return true;
        }
       

        public function delReq($id,$conn){
           
            $sql = "DELETE FROM  RICHIESTE  WHERE ID_RICHIESTA = ?";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function setState($s,$id,$conn){
           
            $sql = "UPDATE RICHIESTE SET STATO = ? WHERE ID_RICHIESTA = ?";
            $conn->prepare($sql)->execute([$s,$id]);
            return true;
        }

        public function checkRichiestaIstr($s,$conn){
           
            $sql = "SELECT * FROM RICHIESTE WHERE ID_ISTRUTT =? AND STATO = ?";
            $result = $conn->prepare($sql);
            $result->execute([$this->id,$s]);
            if ($result->rowCount() > 0) { return true; } else { return false; }

        }

        public function checkRichiestaUser($s,$conn){
           
             
            $sql = "SELECT * FROM RICHIESTE WHERE ID_ATLETA =? AND STATO = ?";
            $result = $conn->prepare($sql);
            $result->execute([$this->id,$s]);
            if ($result->rowCount() > 0) { return true; } else { return false; }

        }
        public function getRichiestaUser($s,$conn){
           
             
            $sql = "SELECT * FROM RICHIESTE WHERE ID_ATLETA =? AND STATO = ?";
            $result = $conn->prepare($sql);
            $result->execute([$this->id,$s]);
            return $result->fetch(PDO::FETCH_ASSOC); 

        }
        
        public  function getRichieste($conn){
           
            $stmt = $conn->prepare('SELECT * FROM `RICHIESTE` WHERE `ID_ISTRUTT` = ? OR ID_ISTRUTT IS NULL');
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $schedas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $schedas;

        }

        public  function getAllRichieste($conn){
           
            $stmt = $conn->prepare('SELECT * FROM `RICHIESTE`');
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $schedas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $schedas;

        }

        public  function countNewRichiesteGen($conn){
           
            $stmt = $conn->prepare('SELECT COUNT(*) as NUM FROM `RICHIESTE` WHERE `ID_ISTRUTT` IS NULL AND STATO = \'new\'');
           
            $stmt->execute();
            $n = $stmt->fetch(PDO::FETCH_ASSOC);

            return $n['NUM'];

        }

        public  function countNewRichieste($conn){
           
            $stmt = $conn->prepare('SELECT COUNT(*) as NUM FROM `RICHIESTE` WHERE `ID_ISTRUTT` = ? AND STATO = \'new\'');
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $n = $stmt->fetch(PDO::FETCH_ASSOC);

            return $n['NUM'];

        }
       
    }
?>