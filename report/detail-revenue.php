<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2], 15);
$hotelName = ucfirst(hotelDetail()['hotelName']);

$backLink = FRONT_SITE;


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Detail Revenue</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'Detail Revenue');
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 py-2 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="checkInFilterForm">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4">
                                                <input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="SearchByDateFrom" maxlength="10" name="SearchByDateFrom" placeholder="DD/MM/YYYY" type="text" value="<?= date('d-m-Y') ?>" readonly="readonly">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <?= generateActionInReport() ?>
                                </div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">                            
                            <div id="loadReportContainer"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        </div>

        <div id="configurationForm" class="show"></div>

    </main>
    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>




    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>



    <?php



    ?>
    <script>
        $('.linkBtn').removeClass('active');
        $('.reportLink').addClass('active');

        $('#SearchByDateFrom').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#SearchByDateFrom').on('change', function(e){
            var date = $(this).val();
            loadReportContainer('detail-revenue',date);
        });

        $(document).ready(function() {
            loadReportContainer('detail-revenue');
        });
    </script>

</body>

</html>