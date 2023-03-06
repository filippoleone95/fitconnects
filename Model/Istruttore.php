<?php
    namespace FitCon\Model\ISTRUTTORE;

use LDAP\Result;

    class Istruttore{
        
        public function __construct()
        {
            
        }

        public static function insertNewIstruttore($code,$db){
  
            $sql = "INSERT INTO ISTRUTTORE (CODICE) VALUES (?)";
            $stmt= $db->prepare($sql);
            $stmt->execute([$code]);
            return true;
        }
        public function getIstruttori($db){
         
            $sth = $db->prepare("SELECT * FROM ISTRUTTORE");
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            
            return $result;
        }

        public function controlCode($code,$db){
           
            $sql = "SELECT COUNT(*) FROM ISTRUTTORE WHERE CODICE = ? AND ID_USER = 'NULL'";
            $result = $db->prepare($sql);
            $result->execute([$code]);
            if ($result->rowCount() > 0) { return true; } else { return false; }
                        
            
        }
        public function attivaISTRUTTORE($id,$code,$db){
            
            
            $sql = "UPDATE ISTRUTTORE SET ID_USER = $id WHERE CODICE = '$code' ";
            $res = $db->query($sql);
            
            
            
        }
    
    }
?>