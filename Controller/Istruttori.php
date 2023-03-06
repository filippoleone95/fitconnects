<?php 
    namespace FitCon\Controller\Istruttori;
    use FitCon\Model\Istruttore\Istruttore;
    require_once "Includer.php";
    require_once "../Model/Istruttore.php";
   // use FitCon\Model\Istruttore\Istruttore;
    if (isset($_POST['code'])){
        $sql = "SELECT * FROM istruttore WHERE codice = " . $db->quote($_POST['code']);
        $res = $db->query($sql);
        $count = $res->fetchColumn();  
        if($count > 0){
            echo "Istruttore già inserito";
        }else{
            echo "".Istruttore::insertNewIstruttore($_POST['code'],$db);
        }
    }
   
?>