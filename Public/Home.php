<?php

use FitCon\Model\Notizia\Notizia;

include "Includer.php";
$Notizie = new Notizia();

?>

<body id="page-top">
    <!-- Navigation-->
    <?php
    include($View->getURL() . "/JS_Script.php"); ?>
    <nav class="navbar navbar-expand-lg  fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#top">FitConnects</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">Notizie</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Login">Accedi/Registrati</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <a class="navbar-brand m-0 tex justify-content-center" href="#">
                        <h1 class="text-white font-weight-bold">Fit <i class="fa-solid fa-circle-nodes"></i> Connects</h1>
                    </a>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Allenati, spensierato ...</p>
                    <a class="btn btn-primary btn-xl" href="./Login">Vieni con noi</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section bg-primary" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Tutto ciò che ti serve!</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">Non perdere tempo vedi le ultime notizie per tenerti aggiornato!</p>
                    <!-- <a class="btn btn-light btn-xl" href="#">Notizie!</a> -->
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 col-md-12 mt-4 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-warning text-center shadow-warning border-radius-lg py-3 pe-1">
                                    <h3 class="text-light mx-3"><i class="fa-solid fa-newspaper"></i>&nbsp;&nbsp; Ultime novità</h3>
                                </div>

                            </div>
                            <div class="card-body">
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php $i = 0;
                                        foreach ($Notizie->getNotizie($db) as $n) {
                                            $i++; ?>
                                            <div class="carousel-item <?php if ($i == 1) echo "active"; ?>">

                                                <div class="container d-block w-100" style="background-image: linear-gradient(rgb(255 255 255 / 82%), rgb(255 255 255 / 78%)), url(../Assets/assets/img/news.jpg); background-size: cover; min-height:300px;">
                                                    <div class="container d-block w-100" style="height: 300px; overflow-y: auto;">

                                                        <h2 class="text-dark text-center my-3"><?= $n['TITOLO'] ?></h2>
                                                        <p class="text-dark text-center "><strong><?= $n['CORPO'] ?></strong></p>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php   }
                                        if ($i == 0) echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessuna notizia</p>';

                                        ?>

                                    </div>
                                    <button class="carousel-control-prev  my-8" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next  my-8" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="background-image: none;">
                                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2022 - FitConnects</div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= $Lib->getURL() ?>/js/scripts.js"></script>

</body>

</html>