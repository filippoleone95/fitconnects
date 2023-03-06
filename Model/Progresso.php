<?php
 namespace FitCon\Model\Progresso;
 use PDO;
    class Progresso{
        private $id_profilo ; 

        public function __construct($id)
        {
            $this->id_profilo = $id;
        }

        public function insertProgressi($pI,$pD,$Alt,$all,$ult,$ults,$Ob,$istr,$r,$conn){

            $sql = "INSERT INTO PESO (ID_PROFILO,PESO,DATA_PESO) VALUES (?,?,NOW())";
            $conn->prepare($sql)->execute([$this->id_profilo ,$pI]);

            $sql = "INSERT INTO PROGRESSI (ID_PROFILO,ALLENAMENTI,ULTIMO_ALL,ULTIMO_SPORT,OBIETTIVO,PESO_DESIDERATO,ALTEZZA) VALUES (?,?,?,?,?,?,?)";
            $conn->prepare($sql)->execute([$this->id_profilo ,$all,$ult,$ults,$Ob,$pD,$Alt]);
            
            if($istr != "NULL"){
                $sql = "INSERT INTO ISTRUTTORI_PREF (ID_PROF,ID_ISTR_PREF) VALUES (?,?)";
                $conn->prepare($sql)->execute([$this->id_profilo ,$istr]);
            }
            

            $r->insertRichiesta($istr,"Nuova scheda","new","",NULL,$conn);
            return true;
        }

        public function insertNewProgressi($pI,$pD,$Alt,$all,$ult,$ults,$Ob,$conn){

            $sql = "INSERT INTO PESO (ID_PROFILO,PESO,DATA_PESO) VALUES (?,?,NOW())";
            $conn->prepare($sql)->execute([$this->id_profilo ,$pI]);
           
            $sql = "UPDATE PROGRESSI SET ALLENAMENTI = ? , ULTIMO_ALL = ? , ULTIMO_SPORT = ?  , OBIETTIVO = ?  , PESO_DESIDERATO = ? , ALTEZZA = ? WHERE ID_PROFILO = ? ";
            $conn->prepare($sql)->execute([$all,$ult,$ults,$Ob,$pD,$Alt,$this->id_profilo]);
            return true;

        }

        public function checkProgressi($conn){
           
            $stmt = $conn->prepare('SELECT * FROM PROGRESSI WHERE ID_PROFILO =?');
            $stmt->bindParam(1, $this->id_profilo, PDO::PARAM_INT);
            $stmt->execute();
            if(!$stmt->fetch(PDO::FETCH_ASSOC))
            {
                return false;
            }else{
                return true;
            }

        }

        public function getPESO($conn){
            
            $stmt = $conn->prepare('SELECT * FROM PESO WHERE ID_PROFILO =?');
            $stmt->bindParam(1, $this->id_profilo, PDO::PARAM_INT);
            $stmt->execute();
            $PESO = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $PESO;
        }

        public  function getProgressi($conn){
           
            $stmt = $conn->prepare('SELECT * FROM PROGRESSI WHERE ID_PROFILO =?');
            $stmt->bindParam(1, $this->id_profilo, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $row ="";
            foreach ($prog as $row) {
              
            }
            
            return $row ;
        }

        public  function getIstruttPref($conn){
           
            $stmt = $conn->prepare('SELECT ID_ISTR_PREF FROM ISTRUTTORI_PREF WHERE ID_PROF =?');
            $stmt->bindParam(1, $this->id_profilo, PDO::PARAM_INT);
            $stmt->execute();
            $prog = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $row ="";
            foreach ($prog as $row) {
              
            }
            
            return $row ;
        }
    }
?>