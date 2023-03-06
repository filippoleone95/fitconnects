<?php
 namespace FitCon\Model\Allenamento;
 
 use PDO;
    class Allenamento{
        private $id ; 

        public function __construct()
        {
          
        }

        /* Funzioni esercizi allenamento */
        public  function esFatto($ide,$ida,$conn){

            if(!self::checkEs($ide,$ida,$conn)){
                $sql = "INSERT INTO ESERCIZI_ALLENAMENTO (SVOLTO,ID_ESERCIZIO,ID_ALLENAMENTO) VALUES (?,?,?)";
               
            }else{
                $sql = "UPDATE ESERCIZI_ALLENAMENTO SET SVOLTO = ? WHERE ID_ESERCIZIO = ? AND ID_ALLENAMENTO = ? ";
               
            }
            $conn->prepare($sql)->execute([1,$ide,$ida]);
            return true;
        }

        public  function esIgnorato($ide,$ida,$conn){
            if(!self::checkEs($ide,$ida,$conn)){
                $sql = "INSERT INTO ESERCIZI_ALLENAMENTO (SVOLTO,ID_ESERCIZIO,ID_ALLENAMENTO) VALUES (?,?,?)";
            }else{
                $sql = "UPDATE ESERCIZI_ALLENAMENTO SET SVOLTO = ? WHERE ID_ESERCIZIO = ? AND ID_ALLENAMENTO = ? ";
            }
            $conn->prepare($sql)->execute([0,$ide,$ida]);
            return true;
        }

        public static function checkEs($ide,$ida,$conn){
            $sql = "SELECT * FROM ESERCIZI_ALLENAMENTO WHERE ID_ESERCIZIO = ? AND ID_ALLENAMENTO = ?";
            $result = $conn->prepare($sql);
            $result->execute([$ide,$ida]);
            if ($result->rowCount() > 0) { return true; } else { return false; }
        }

        public static function getEsFatto($ida,$conn){
            $sql = "SELECT * FROM ESERCIZI_ALLENAMENTO WHERE SVOLTO = ? AND ID_ALLENAMENTO = ?";
            $result = $conn->prepare($sql);
            $result->execute([1,$ida]);
            return $result->fetchAll();
        }
        public static function getEsIgnorato($ida,$conn){
            $sql = "SELECT * FROM ESERCIZI_ALLENAMENTO WHERE SVOLTO = ? AND ID_ALLENAMENTO = ?";
            $result = $conn->prepare($sql);
            $result->execute([0,$ida]);
            return $result->fetchAll();
        }
        public static function getEsTralasciato($ids,$b,$ida,$conn){
            if($b == 'f'){
                $sql = "SELECT * FROM ESERCIZI_IN_SCHEDA WHERE ID_SCHEDA = ? AND ID_ESERCIZIO NOT IN  (SELECT ID_ESERCIZIO FROM ESERCIZI_ALLENAMENTO WHERE  ID_ALLENAMENTO = ?)";
            }else{
                $sql = "SELECT * FROM ESERCIZI_IN_SCHEDA_B WHERE ID_SCHEDA_B = ? AND ID_ESERCIZIO NOT IN  (SELECT ID_ESERCIZIO FROM ESERCIZI_ALLENAMENTO WHERE  ID_ALLENAMENTO = ?)";
            }
           
            $result = $conn->prepare($sql);
            $result->execute([$ids,$ida]);
            return $result->fetchAll();
        }

        /* Funzioni allenamento */

        public  function getAllenamentiForMonth($id,$conn){
            for($i = 1 ; $i <= 12 ; $i++){
                $sql = "SELECT COUNT(*) as NUM FROM ALLENAMENTI WHERE ID_USER = ? AND MONTH(ORA_INIZIO) = $i ";
                $result = $conn->prepare($sql);
                $result->execute([$id]);
                $mese[$i] = $result->fetch()['NUM'];
            }
            
           
            return $mese;
        }

        public  function getLastAllenamento($id,$conn){
            $sql = "SELECT * FROM ALLENAMENTI WHERE ID_USER = ? ORDER BY ORA_FINE DESC LIMIT 1 ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }
        public  function getAllenamenti($id,$conn){
            $sql = "SELECT * FROM ALLENAMENTI WHERE ID_USER = ?  ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetchAll();
        }
        public  function getAllenamentoEnd($id,$conn){
            $sql = "SELECT * FROM ALLENAMENTI WHERE ID_ALLENAMENTO = ? ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }

        public  function getAllenamento($id,$conn){
            $sql = "SELECT * FROM ALLENAMENTI WHERE ID_USER =? AND ORA_FINE  IS NULL";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }

        public  function newAll($id,$ids,$conn){
            $sql = "INSERT INTO ALLENAMENTI (ID_USER,id_scheda,ora_inizio) VALUES (?,?,NOW())";
            $conn->prepare($sql)->execute([$id,$ids]);
            return true;
        }

        public  function endAll($id,$b,$conn){
            if($b == 'f'){
                $sql = "UPDATE  ALLENAMENTI SET ORA_FINE = NOW() , base = 0 WHERE ID_ALLENAMENTO = ?";
            }else{
                $sql = "UPDATE  ALLENAMENTI SET ORA_FINE = NOW() , base = 1 WHERE ID_ALLENAMENTO = ?";
            }
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function check($id,$conn){
            $sql = "SELECT * FROM ALLENAMENTI WHERE ID_USER =? AND ORA_FINE  IS NULL";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
            if ($result->rowCount() > 0) { return true; } else { return false; }
        }

       

        public function delAll($id,$conn){
            $sql = "DELETE FROM ALLENAMENTI WHERE ID_ALLENAMENTO =?";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function del($id,$conn){
            $sql = "DELETE FROM ALLENAMENTI WHERE ID_USER =? AND ORA_FINE IS NULL";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

    }
