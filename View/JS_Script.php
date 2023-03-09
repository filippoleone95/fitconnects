<?php
if ($base != "Login" && $base != "Signup" && $base != "Administrator" && $base != "SignupAllenatore" && $base != "Complete") { //Escusione barra colori 
    include($View->getURL() . "/DashGuiSetting.php");
}
?>

<!--   Core JS Files   -->
<script src="../Lib/dash/js/core/popper.min.js"></script>

<script src="../Lib/dash/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../Lib/dash/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../Lib/dash/js/plugins/chartjs.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Bootstrap core JS-->
<?php if ($base == "Profilo") { ?>
    <!--   <script src="<?= $Vendor->getURL() ?>/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>  -->
<?php } ?>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="<?= $Lib->getURL() ?>/js/scripts.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php if ($base == "Dashboard" && !$Istruttore) { ?>
    <script src="../Lib/dash/personal/chart.js"></script>
<?php } ?>
<script src="../Lib/dash/js/material-dashboard.js?"></script>
<script src="<?= $Vendor->getURL() ?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    base = "<?= $base ?>";
    if (base == "Dashboard") {
        $("#nav_dash").addClass("active bg-gradient-warning");
    }
    if (base == "Scheda") {
        $("#nav_sched").addClass("active bg-gradient-warning");
    }
    if (base == "Profilo") {
        $("#nav_prof").addClass("active bg-gradient-warning");
    }
    if (base == "Esercizi") {
        $("#nav_eser").addClass("active bg-gradient-warning");
    }
    if (base == "Contatti") {
        $("#nav_not").addClass("active bg-gradient-warning");
    }

    if ($("#body").hasClass("dark-version")) {
        $("#darkV").prop('checked', true);
    }

    function cancelReq(idr) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Richieste.php',
            data: {
                'idr': idr,
                'user': 'cancel'
            },
            success: function(data) {
                window.location.href = './Scheda';
            }
        });
    }

    function dark() {

        if ($("#darkV").is(":checked")) {
            $dark = "dark-version"
            $("#body").addClass("dark-version");
            document.cookie = "dark=" + $dark + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";

        } else {
            $dark = ""
            $("#body").removeClass("dark-version");
            document.cookie = "dark=" + $dark + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
        }


    };


    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    <?php if (isset($Prog) && $Prog == false) { ?>
        $('#labelPr').text('Benvenuto , aiutaci a conoscerti!');
        $('#labelPr2').text('Parlaci di te');
        $('#labelPr3').text('Abbiamo quasi finito!');

        var myModal = new bootstrap.Modal(document.getElementById('modalProgressi'), {
            backdrop: 'static',
            keyboard: false
        });
        myModal.show();

        function salvaProg() {
            $peso = $("#peso").val();
            $pesoD = $("#pesoD").val();
            $altezza = $("#altezza").val();
            $allenamento = $("#allenamento").val();
            $ultimo = $("#ultimo").val();
            $ultimos = $("#ultimos").val();
            $obiettivo = $("#obiettivo").val();
            $istruttore = $("#istruttore").val();

            $user = $("#userP").val();

            if ($peso == "" || $pesoD == "" || $altezza == "" || $allenamento == "" ||
                $ultimo == "" || $ultimos == "" || $obiettivo == "" || $istruttore == "") {
                alert("Nessun campo può essere lasciato vuoto")
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= $Controller->GetURL() ?>/Profilo.php",
                    data: {
                        peso: $peso,
                        pesoD: $pesoD,
                        alt: $altezza,
                        all: $allenamento,
                        ult: $ultimo,
                        ults: $ultimos,
                        obie: $obiettivo,
                        istr: $istruttore,
                        user: $user
                    },
                    dataType: "text",
                    success: function(risposta) {
                        if (risposta == "true") {

                            alert("La tua richiesta è stata presa in carico dai nostri istruttori !");

                            location.reload();
                        } else {
                            console.log(risposta);
                        }

                    },
                    error: function() {
                        allert("errore AJAX");
                    }
                });
            }
        }
    <?php } ?>
</script>