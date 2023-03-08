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
                $sql = "INSERT INTO esercizi_allenamento (svolto,id_esercizio,id_allenamento) VALUES (?,?,?)";
               
            }else{
                $sql = "UPDATE esercizi_allenamento SET svolto = ? WHERE id_esercizio = ? AND id_allenamento = ? ";
               
            }
            $conn->prepare($sql)->execute([1,$ide,$ida]);
            return true;
        }

        public  function esIgnorato($ide,$ida,$conn){
            if(!self::checkEs($ide,$ida,$conn)){
                $sql = "INSERT INTO esercizi_allenamento (svolto,id_esercizio,id_allenamento) VALUES (?,?,?)";
            }else{
                $sql = "UPDATE esercizi_allenamento SET svolto = ? WHERE id_esercizio = ? AND id_allenamento = ? ";
            }
            $conn->prepare($sql)->execute([0,$ide,$ida]);
            return true;
        }

        public static function checkEs($ide,$ida,$conn){
            $sql = "SELECT * FROM esercizi_allenamento WHERE id_esercizio = ? AND id_allenamento = ?";
            $result = $conn->prepare($sql);
            $result->execute([$ide,$ida]);
            if ($result->rowCount() > 0) { return true; } else { return false; }
        }

        public static function getEsFatto($ida,$conn){
            $sql = "SELECT * FROM esercizi_allenamento WHERE svolto = ? AND id_allenamento = ?";
            $result = $conn->prepare($sql);
            $result->execute([1,$ida]);
            return $result->fetchAll();
        }
        public static function getEsIgnorato($ida,$conn){
            $sql = "SELECT * FROM esercizi_allenamento WHERE svolto = ? AND id_allenamento = ?";
            $result = $conn->prepare($sql);
            $result->execute([0,$ida]);
            return $result->fetchAll();
        }
        public static function getEsTralasciato($ids,$b,$ida,$conn){
            if($b == 'f'){
                $sql = "SELECT * FROM esercizi_in_scheda WHERE id_scheda = ? AND id_esercizio NOT IN  (SELECT id_esercizio FROM esercizi_allenamento WHERE  id_allenamento = ?)";
            }else{
                $sql = "SELECT * FROM esercizi_in_scheda_b WHERE id_scheda_b = ? AND id_esercizio NOT IN  (SELECT id_esercizio FROM esercizi_allenamento WHERE  id_allenamento = ?)";
            }
           
            $result = $conn->prepare($sql);
            $result->execute([$ids,$ida]);
            return $result->fetchAll();
        }

        /* Funzioni allenamento */

        public  function getAllenamentiForMonth($id,$conn){
            for($i = 1 ; $i <= 12 ; $i++){
                $sql = "SELECT COUNT(*) as num FROM allenamenti WHERE id_user = ? AND MONTH(ora_inizio) = $i ";
                $result = $conn->prepare($sql);
                $result->execute([$id]);
                $mese[$i] = $result->fetch()['num'];
            }
            
           
            return $mese;
        }

        public  function getLastAllenamento($id,$conn){
            $sql = "SELECT * FROM allenamenti WHERE id_user = ? ORDER BY ora_fine DESC LIMIT 1 ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }
        public  function getAllenamenti($id,$conn){
            $sql = "SELECT * FROM allenamenti WHERE id_user = ?  ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetchAll();
        }
        public  function getAllenamentoEnd($id,$conn){
            $sql = "SELECT * FROM allenamenti WHERE id_allenamento =? ";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }

        public  function getAllenamento($id,$conn){
            $sql = "SELECT * FROM allenamenti WHERE id_user =? AND ora_fine  IS NULL";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
           
            return $result->fetch();
        }

        public  function newAll($id,$ids,$conn){
            $sql = "INSERT INTO allenamenti (id_user,id_scheda,ora_inizio) VALUES (?,?,NOW())";
            $conn->prepare($sql)->execute([$id,$ids]);
            return true;
        }

        public  function endAll($id,$b,$conn){
            if($b == 'f'){
                $sql = "UPDATE  allenamenti SET ora_fine = NOW() , base = 0 WHERE id_allenamento = ?";
            }else{
                $sql = "UPDATE  allenamenti SET ora_fine = NOW() , base = 1 WHERE id_allenamento = ?";
            }
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function check($id,$conn){
            $sql = "SELECT * FROM allenamenti WHERE id_user =? AND ora_fine  IS NULL";
            $result = $conn->prepare($sql);
            $result->execute([$id]);
            if ($result->rowCount() > 0) { return true; } else { return false; }
        }

       

        public function delAll($id,$conn){
            $sql = "DELETE FROM allenamenti WHERE id_allenamento =?";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

        public function del($id,$conn){
            $sql = "DELETE FROM allenamenti WHERE id_user =? AND ora_fine IS NULL";
            $conn->prepare($sql)->execute([$id]);
            return true;
        }

    }
