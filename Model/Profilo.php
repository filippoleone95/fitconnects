<?php
 namespace FitCon\Model\Profilo;
 use PDO;
    class Profilo{
        private $id_user ; 

        public function __construct($id)
        {
            $this->id_user = $id;
        }

        public static function insertProfilo($id,$nome,$cognome,$data_n,$ind,$sex,$conn){
           
            $sql = "INSERT INTO PROFILO (ID_USER,NOME,COGNOME,DATA_NASCITA,INDIRIZZO,SESSO) VALUES (?,?,?,?,?,?)";
            $conn->prepare($sql)->execute([$id,$nome,$cognome,$data_n,$ind,$sex]);
            return true;
        }
        public static function checkProfilo($id, $conn){
           
            $stmt = $conn->prepare('SELECT * FROM PROFILO WHERE ID_USER =?');
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if(!$stmt->fetch(PDO::FETCH_ASSOC))
            {
                return false;
            }else{
                return true;
            }

        }
        public function getAge ($birthday){
            list($year,$month,$day) = explode("-",$birthday);
            $year_diff  = date("Y") - $year; 
            $month_diff = date("m") - $month;
            $day_diff   = date("d") - $day;
            if ($day_diff < 0 || $month_diff < 0)       
               $year_diff--;     
             return $year_diff;  
        } 

        public  function getProfiloFromId($id_user,$conn){
           
            $stmt = $conn->prepare('SELECT * FROM PROFILO WHERE ID_USER =?');
            $stmt->bindParam(1, $id_user, PDO::PARAM_INT);
            $stmt->execute();
            $profilo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profilo;

        }

        public  function getProfilo($conn){
           
            $stmt = $conn->prepare('SELECT * FROM PROFILO WHERE ID_USER =?');
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $profilo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profilo;

        }

        public  function getSESSO($conn){
           
            $stmt = $conn->prepare('SELECT SESSO FROM PROFILO WHERE ID_USER =?');
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $profilo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profilo["SESSO"];

        }

        public  function getProfiloId($conn){
           
            $stmt = $conn->prepare('SELECT id_profilo FROM PROFILO WHERE ID_USER =?');
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $profilo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profilo["ID_PROFILO"] ?? 'default value';
          

        }
        
        public function updateProfilo($nome,$cognome,$data_n,$ind,$sex,$conn){
           
            $sql = "UPDATE PROFILO
                    SET NOME = ?,
                        COGNOME = ?,
                        DATA_NASCITA = ?,
                        INDIRIZZO = ?,
                        SESSO = ?
                    WHERE ID_USER = ?";

            $conn->prepare($sql)->execute([$nome,$cognome,$data_n,$ind,$sex,$this->id_user]);
            return true;
        }
        public function updatePhone($n,$id,$conn){
           
            $sql = "UPDATE PROFILO
                    SET TELEFONO = ?               
                    WHERE ID_PROFILO = ?";
            $conn->prepare($sql)->execute([$n,$id]);
            return true;
        }
    }
?>