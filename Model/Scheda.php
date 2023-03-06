<?php
namespace FitCon\Model\Scheda;

use FitCon\Model\EserciziScheda\EserciziScheda;
require "../Model/EserciziScheda.php";
use PDO;
    class Scheda{
        private $id ; 

        public function __construct($id)
        {
            $this->id = $id;
        }

        /* Funzioni per schede base */

        public  function getSchedeBase($conn){
           
            $stmt = $conn->prepare('SELECT * FROM SCHEDA_BASE');
            $stmt->execute();
            $prog = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $prog;

        }
        public  function getSchedaBase($id,$conn){
           
            $stmt = $conn->prepare('SELECT * FROM SCHEDA_BASE WHERE ID_SCHEDA_B =?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetch(PDO::FETCH_ASSOC);

            return $prog;

        }
  

        public  function getEserciziSchedaB($id_scheda,$conn){
            
            $EserciziScheda = new EserciziScheda();
            $e = $EserciziScheda ->getEserciziInScheda($id_scheda,$conn);
            return $e;

        }

        public  function getEserciziInSchedaBForGroup($id_g,$id_scheda,$conn){
            
            $EserciziScheda = new EserciziScheda();
            $e = $EserciziScheda ->getEserciziInSchedaBForGroup($id_g,$id_scheda,$conn);
            return $e;

        }

        public function insertSchedaBase($n,$amin,$amax,$sex,$conn){
           
            $sql = "INSERT INTO SCHEDA_BASE (NOME,ANNI_MIN,ANNI_MAX,SESSO_C) VALUES (?,?,?,?)";
            $conn->prepare($sql)->execute([$n,$amin,$amax,$sex]);
            return true;
        }
        
        public function updateSchedaBase($ids,$n,$amin,$amax,$sex,$conn){
           
            $sql = "UPDATE SCHEDA_BASE SET NOME = ? , ANNI_MIN = ? , ANNI_MAX = ?  , SESSO_C = ?  WHERE ID_SCHEDA_B = ? ";
            $conn->prepare($sql)->execute([$n,$amin,$amax,$sex,$ids]);
            return true;
        }

        public function deleteSchedaBase($id,$conn){
            $sql = "DELETE FROM SCHEDA_BASE WHERE ID_SCHEDA_B = ? ";
            $conn->prepare($sql)->execute([$id]);
           
            return true;
        }

        /* Funzioni per schede normali */
        public function insertScheda($idu,$ns,$di,$ds,$a,$p,$is,$conn){
           
            $sql = "INSERT INTO SCHEDA (ID_USER,NOME_SCHEDA,DATA_INIZIO,DATA_SCADENZA,ATTIVA,PERS,ID_ISTRUTTORE) VALUES (?,?,?,?,?,?,?)";
            $conn->prepare($sql)->execute([$idu ,$ns,$di,$ds,$a,$p,$is]);
            return true;
        }
        
        public function updateScheda($ids,$ns,$di,$ds,$a,$p,$is,$conn){
           
            $sql = "UPDATE SCHEDA SET NOME_SCHEDA = ? , DATA_INIZIO = ? , DATA_SCADENZA = ?  , ATTIVA = ?  , PERS = ? ,ID_ISTRUTTORE = ? WHERE ID_SCHEDA = ? ";
            $conn->prepare($sql)->execute([$ns,$di,$ds,$a,$p,$is,$ids]);
            return true;
        }

        public function deleteScheda($id,$conn){
            $sql = "DELETE FROM SCHEDA WHERE ID_SCHEDA = ? ";
            $conn->prepare($sql)->execute([$id]);
           
            return true;
        }

        public  function getScheda($id,$conn){
           
            $stmt = $conn->prepare('SELECT * FROM SCHEDA WHERE ID_SCHEDA =?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetch(PDO::FETCH_ASSOC);

            return $prog;

        }
        public  function getSchedeScadute($conn){
           
            $stmt = $conn->prepare('SELECT * FROM `SCHEDA` WHERE `DATA_SCADENZA` < now()');
            $stmt->execute();
            $schedas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $schedas;

        }

    
        public  function getSchede($conn){
           
            $stmt = $conn->prepare('SELECT * FROM SCHEDA WHERE ID_USER =?');
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $prog;

        }
        public  function getSchedeFromId($id,$conn){
           
            $stmt = $conn->prepare('SELECT * FROM SCHEDA WHERE ID_USER = ?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $prog;

        }

        public  function getEserciziScheda($id_scheda,$conn){
            
            $EserciziScheda = new EserciziScheda();
            $e = $EserciziScheda ->getEserciziInScheda($id_scheda,$conn);
            return $e;

        }

        public  function getEserciziInSchedaForGroup($id_g,$id_scheda,$conn){
            
            $EserciziScheda = new EserciziScheda();
            $e = $EserciziScheda ->getEserciziInSchedaForGroup($id_g,$id_scheda,$conn);
            return $e;

        }
        
      
    }
?>