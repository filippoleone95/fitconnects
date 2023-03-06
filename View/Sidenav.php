<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="#">
        <h4 class="text-white font-weight-bold">Fit <i class="fa-solid fa-circle-nodes"></i> Connects</h4>
            
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main" style="height: 80%;">
        <ul class="navbar-nav">
            <?php
            if (!isset($Amministratore)) { 
                header("Location:" . $Public->getURL() . "/Home");
            }
            if (!$Amministratore) {
                if ($Profilo->getSesso($db) == "M") {
            ?>
                    <li class="nav-item">
                        <img src="<?= $Assets->getURL() . '/assets/img/PNG/boy.png' ?>" style=" width: 35%;     margin-left: 30%;">
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <img src="<?= $Assets->getURL() . '/assets/img/PNG/girl.png' ?>" style=" width: 30%;     margin-left: 30%;">
                    </li>
                <?php  }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Dashbord"; ?>" id="nav_dash">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Scheda"; ?>" id="nav_sched">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">playlist_add_check</i>
                        </div>
                        <span class="nav-link-text ms-1">Schede di allenamento</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Esercizi"; ?>" id="nav_eser">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">fitness_center</i>
                        </div>
                        <span class="nav-link-text ms-1">Esercizi</span>
                    </a>
                </li>
                <?php
                    if (!$Istruttore) {
                    
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Contatti"; ?>" id="nav_not">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">chat</i>

                        </div>
                        <span class="nav-link-text ms-1">Contatti</span>
                    </a>
                </li>
                <?php
            } else {
            ?>
            <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Richieste"; ?>" id="nav_not">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">chat</i>

                        </div>
                        <span class="nav-link-text ms-1">Richieste</span>
                    </a>
                </li>
            <?php
                    }
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Admin->getURL() . "/DashbordAdmin"; ?>" id="nav_dash">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Admin->getURL() . "/Istruttori"; ?>" id="nav_not">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">chat</i>

                        </div>
                        <span class="nav-link-text ms-1">Istruttori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="<?= $Public->getURL() . "/Richieste"; ?>" id="nav_not">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">chat</i>

                        </div>
                        <span class="nav-link-text ms-1">Richieste</span>
                    </a>
                </li>
            <?php
            }
            ?>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Funzioni Account</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= $Public->getURL() . "/Profilo"; ?>" id="nav_prof">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profilo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= $Controller->getURL() . "/Logout"; ?>" id="logout">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Log out</span>
                </a>
            </li>

        </ul>
    </div>

</aside>