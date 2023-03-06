<?php
    namespace FitCon\Model\Gruppo;
    use PDO;
    class Gruppo{
        
        public function __construct()
        {
            
        }
        
        public function insertGruppo($nome,$conn){
           
            $sql = "INSERT INTO GRUPPO_MUSCOLARE (NOME_GRUPPO) VALUES (?)";
            $conn->prepare($sql)->execute([$nome]);
            return true;
        }

        public function deleteGruppo($idg,$conn){
           
            $sql = "DELETE FROM GRUPPO_MUSCOLARE WHERE ID_GRUPPO  =? ";
            $conn->prepare($sql)->execute([$idg]);
            return true;
        }

        public function updateGruppo($idg,$nome,$conn){
           
            $sql = "UPDATE GRUPPO_MUSCOLARE SET NOME_GRUPPO = ? WHERE ID_GRUPPO  = ? ";
            $conn->prepare($sql)->execute([$nome,$idg]);
            return true;
        }

        public function getGruppi($conn){
            $stmt = $conn->prepare('SELECT * FROM GRUPPO_MUSCOLARE ');
            $stmt->execute();
            $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $groups;
        }
    }
?>