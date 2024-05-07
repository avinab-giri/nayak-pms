<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2], 15);
$hotelName = ucfirst(hotelDetail()['hotelName']);

$backLink = FRONT_SITE;


$roomArry = getRoomType();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Revenue</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'Revenue');
            ?>

            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <form id="occupancyForecastFilterForm">
                                <div class="row justify-content-center">

                                    <div class="col-md-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 pl-0 pr-0">
                                                <input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="EntryDateValue" maxlength="10" name="EntryDateValue" placeholder="DD/MM/YYYY" type="text" value="<?= date("m/d/Y", strtotime('-1 days')) ?>" readonly="readonly">
                                            </div>
                                            <label class="col-sm-2 control-label search-box-label text-center m0">To</label>

                                            <div class="col-md-5 pl-0 pr-0"><input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="EntryDateValueTo" maxlength="10" name="EntryDateValueTo" placeholder="DD/MM/YYYY" type="text" value="<?= date('m/d/Y') ?>" readonly="readonly"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="checker" id="uniform-inputFilterIsCommonSeries" style="display: none;"><span><input type="checkbox" id="inputFilterIsCommonSeries" style="display:none!important;visibility:hidden!important;opacity:0!important;"></span></div>
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div id="loadRevenueReport" class="scrolableTable"></div>
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

        $('#EntryDateValue,#EntryDateValueTo').datepick({
            onSelect: customRange,
            showTrigger: '#calImg'
        });

        function customRange(dates) {
            if (this.id == 'EntryDateValue') {
                $('#EntryDateValueTo').datepick('option', 'minDate', dates[0] || null);
            } else {
                $('#EntryDateValue').datepick('option', 'maxDate', dates[0] || null);
            }
        }
        

        $(document).ready(function() {
            loadRevenueReport('<?= date("Y-m-d", strtotime('-1 days')) ?>', '<?= date("Y-m-d") ?>');


            $(document).on('submit', '#occupancyForecastFilterForm', function(e) {
                e.preventDefault();
                var sDate = $('#EntryDateValue').val();
                var eDate = $('#EntryDateValueTo').val();
                loadRevenueReport(sDate, eDate);
            });
        });
    </script>

</body>

</html> 