<?php
    namespace FitCon\Model\EserciziScheda;
    use PDO;
    class EserciziScheda{
        
        public function __construct()
        {
            
        }
        
        /* Funzioni schede base */

        public static function insertEsInSchedaB($scheda,$es,$conn){
            $sql = "INSERT INTO ESERCIZI_IN_SCHEDA_B (ID_ESERCIZIO,ID_SCHEDA_B) VALUES (?,?)";
            $conn->prepare($sql)->execute([$es,$scheda]);
            return true;
        }

        public static function deleteEsInSchedaB($scheda,$es,$conn){
            $sql = "DELETE FROM ESERCIZI_IN_SCHEDA_B WHERE ID_ESERCIZIO = ? AND ID_SCHEDA_B = ?";
            $conn->prepare($sql)->execute([$es,$scheda]);
            return true;
        }

        public function getEserciziInSchedaBForGroup($scheda,$group,$conn){
            $stmt = $conn->prepare("SELECT ID_ESERCIZIO FROM ESERCIZI_IN_SCHEDA_B WHERE ID_SCHEDA_B  = ? AND ID_ESERCIZIO IN (SELECT ID_ESERCIZIO FROM ESERCIZIO_GRUPPO WHERE ID_GRUPPO_MUS = ?)");
            $stmt->execute([$scheda,$group]); 
            $eser_s = $stmt->fetchAll();
            
            return $eser_s;
        }

        public function getEserciziInSchedaB($scheda,$conn){
            $stmt = $conn->prepare('SELECT ID_ESERCIZIO FROM ESERCIZI_IN_SCHEDA_B WHERE ID_SCHEDA_B  = ? ');
            $stmt->bindParam(1, $scheda, PDO::PARAM_INT);
            $stmt->execute();
            $eser_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $eser_s;
        }

        
        /* Funzioni schede normali */
        public static function insertEsInScheda($r,$s,$scheda,$es,$conn){
            $sql = "INSERT INTO ESERCIZI_IN_SCHEDA (ID_ESERCIZIO,ID_SCHEDA,RIPETIZIONI,SERIE) VALUES (?,?,?,?)";
            $conn->prepare($sql)->execute([$es,$scheda,$r,$s]);
            return true;
        }

        public static function deleteEsInScheda($scheda,$es,$conn){
            $sql = "DELETE FROM ESERCIZI_IN_SCHEDA WHERE ID_ESERCIZIO = ? AND ID_SCHEDA = ?";
            $conn->prepare($sql)->execute([$es,$scheda]);
            return true;
        }

        public function getEserciziInSchedaForGroup($scheda,$group,$conn){
            $stmt = $conn->prepare("SELECT * FROM ESERCIZI_IN_SCHEDA WHERE ID_SCHEDA  = ? AND ID_ESERCIZIO IN (SELECT ID_ESERCIZIO FROM ESERCIZIO_GRUPPO WHERE ID_GRUPPO_MUS = ?)");
            $stmt->execute([$scheda,$group]); 
            $eser_s = $stmt->fetchAll();
            
            return $eser_s;
        }

        public function getEserciziInScheda($scheda,$conn){
            $stmt = $conn->prepare('SELECT * FROM ESERCIZI_IN_SCHEDA WHERE ID_SCHEDA  = ? ');
            $stmt->bindParam(1, $scheda, PDO::PARAM_INT);
            $stmt->execute();
            $eser_s = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $eser_s;
        }
    }
?>