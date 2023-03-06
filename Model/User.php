<?php
    namespace FitCon\Model\User;
    use PDO;
class User{
        
        public function __construct()
        {
            
        }
        public function getListUser($conn){
            $stmt = $conn->prepare('SELECT * FROM USERS');
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }

        public function getUserAtleti($auth,$listUser){
            foreach ($listUser as $row ){
            
                    $col = $auth->admin()->doesUserHaveRole($row["ID"], \Delight\Auth\Role::COLLABORATOR);
                    $adm = $auth->admin()->doesUserHaveRole($row["ID"], \Delight\Auth\Role::ADMIN);
                    if (!$col && !$adm) {
                        $atleta[] = $row;
                    }

                
            }
            return $atleta;
        }

        public function getUserIstr($auth,$listUser){
            foreach ($listUser as $row ){
            
                    $col = $auth->admin()->doesUserHaveRole($row["ID"], \Delight\Auth\Role::COLLABORATOR);
                    $adm = $auth->admin()->doesUserHaveRole($row["ID"], \Delight\Auth\Role::ADMIN);
                    if ($col) {
                        $atleta[] = $row;
                    }

                
            }
            return $atleta;
        }
    }
