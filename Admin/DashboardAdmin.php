<?php
if(!isset($_COOKIE["dark"])){
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashboard.php");
if (!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
    header("Location:".$Public->getURL()."/Login.php");
}
include($View->getURL()."/Panel.php");
?>

        <div class="container-fluid py-4">
            <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Istruttori</p>
                                <h4 class="mb-0">5</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <a class="mb-0" href="./Istruttori.php">Aggiungi o modifica Istruttori</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    include($View->getURL()."/Footer.php");
                    include($View->getURL()."/JS_Script.php");
                ?>  
            
        </div>
    </main>
    
</body>

</html>