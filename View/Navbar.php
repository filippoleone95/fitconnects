<!-- Navbar -->
<?php

if ($base == "Allenamento") {
?>
    <nav class="navbar navbar-main  bg-gradient-dark mt-3 px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 text-white">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $base ?></li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-white"><?= $base ?></h6>
            </nav>
            <ul class="navbar-nav  justify-content-center">
                <li class="nav-item d-flex align-items-center mx-3 mt-2">
                    <h4 class="text-white" id="time"></h4>
                </li>
            </ul>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center mx-3 mt-2">
                    <button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='endAll()'>
                        Esci dalla modalità allenamento &nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </li>
            </ul>
        </div>
        </div>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 text-dark">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="../Public/Dashbord">Home</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $base ?></li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-dark"><?= $base ?></h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-start">
                    <li class="nav-item d-xl-none ps-2 m-4 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a href="<?= $Public->getURL() . "/Profilo"; ?>" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?= $auth->getUsername(); ?></span>
                        </a>
                    </li>


                    <?php

                    if ($base != "Allenamento" && $base != "Profilo") {
                    ?>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <?php
                            if ($Istruttore) {
                                $n = 0;
                                foreach ($Richieste->getRichieste($db) as $r) {
                                    if ($r["STATO"] == "new") {
                                        $n++;
                                        $p = $Profilo->getProfiloFromId($r["ID_ATLETA"], $db);
                            ?>

                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="../Public/Richieste">
                                                <div class="d-flex py-1">
                                                    <div class="my-auto">
                                                        <img src="../Assets/assets/img/PNG/user.png" class="avatar avatar-sm  me-3 ">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold"><?= $p["NOME"] . " " . $p["COGNOME"] ?></span>
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <?= $r["TIPO_RICHIESTA"] ?>
                                                            <i class="fa fa-clock me-1"></i>
                                                            <?php if ($r["STATO"] == "new") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-danger\">Nuova</span>";
                                                            } else if ($r["STATO"] == "view") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-info\">Vista</span>";
                                                            } else if ($r["STATO"] == "complete") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-success\">Completata</span>";
                                                            } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>

                                    <?php
                                    }
                                }
                                if ($n == 0) {
                                    echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-2x" data-bs-placement="top"></i><br>Nessuna nuova richiesta</p>';
                                }
                            } else {
                                $n = 0;
                                if ($r = $Richieste->getRichiestaUser("complete", $db)) {
                                    $n++;
                                    if ($r["STATO"] == "complete") {
                                        $p = $Profilo->getProfiloFromId($r["ID_ISTRUTT"], $db);
                                    ?>
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="../Public/Scheda">
                                                <div class="d-flex py-1">
                                                    <div class="my-auto">
                                                        <img src="../Assets/assets/img/PNG/user.png" class="avatar avatar-sm  me-3 ">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold"><?= $p["NOME"] . " " . $p["COGNOME"] ?></span>
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <?= $r["TIPO_RICHIESTA"] ?>
                                                            <i class="fa fa-clock me-1"></i>
                                                            <?php if ($r["STATO"] == "new") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-danger\">Nuova</span>";
                                                            } else if ($r["STATO"] == "view") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-info\">Vista</span>";
                                                            } else if ($r["STATO"] == "complete") {
                                                                echo " <span class=\"badge badge-sm bg-gradient-success\">Completata</span>";
                                                            } ?>
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-x  mt-3 mx-3" style="z-index:200" onclick="cancelReq(<?= $r['ID_RICHIESTA'] ?>)"></i>
                                                </div>

                                            </a>

                                        </li>
                            <?php
                                    }
                                }

                                if ($n == 0) {
                                    echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-2x" data-bs-placement="top"></i><br>Nessuna nuova notifica</p>';
                                }
                            }
                            ?>

                        </ul>
            </div>
        </div>
    </nav>
<?php } ?>