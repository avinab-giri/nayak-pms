<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

checkProductExistOrNot([3, 1, 5], 2);

$backLink = FRONT_SITE;
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
    $backLink = $_SERVER['HTTP_REFERER'];
}

$grcLink = FRONT_SITE . '/grc';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Reservations </title>

    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <div class="container">

            <div class="reservationNav sNavBar">
                <?php

                $leftNav = reservationLeftNav('void');

                $rightNav = reservationRightNav();

                echo backNavbarUi('', '', $rightNav, $leftNav);
                ?>
            </div>
            
            <div class="row">
                <div class="col-12 mb-1">
                    <?= clrPreviewHtml('resType') ?>
                </div>
                <div class="col-12">
                    <div id="resorvationContent"></div>
                </div>
            </div>
        </div>



    </main>
    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>
    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>




    <script>

        $('.linkBtn').removeClass('active');
        $('.resLink').addClass('active');


        $(document).ready(() => {
            loadResorvation('void');
        });

        $('#excelExport').click(function() {
            // Use html2pdf to generate and download the PDF
            var element = document.getElementById('resorvationContent');
            html2pdf(element);
        });

        function hideAddReservation() {
            console.log('clicked');
            $("#loadAddResorvation").html("").hide();
            loadResorvation('all');
        }
    </script>


</body>

</html>