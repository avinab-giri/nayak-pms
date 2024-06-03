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

    <title>Todays Event</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">

        <div class="container">

            <?php

            $rightNav = '
                    <ul>
                        <li class="dib"><button onclick="exportContent()" class="m0 btn btn-info pull-right" type="button">Export To Excel  <i class="fa fa-download"></i></button></li>
                        <li class="dib"><button onclick="printContent()" class="m0 btn btn-secondary pull-right" type="button">Print <i class="fa fa-print"></i></button></li>
                    </ul>                
                ';
            echo backNavbarUi('', 'Todays Event', $rightNav);
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <form id="roomStatusFilterForm">
                                <div class="row justify-content-center">

                                    <div class="col-md-5">
                                        <ul class="nav nav-tabs-strong" role="tablist" id="section-tab-nav">
                                            <li role="presentation" data-target="booking" class="active">
                                                <a href="javascript:void(0)" role="tab" data-toggle="tab" onclick="GetBookings()" aria-expanded="true">
                                                    <i class="fas fa-users"></i>
                                                    Bookings
                                                </a>
                                            </li>

                                            <li role="presentation" data-target="inHouse" class="">
                                                <a href="javascript:void(0)" role="tab" data-toggle="tab" onclick="GetInhouse()" aria-expanded="false">
                                                    <svg class="w20 h20">
                                                        <use xlink:href="#inHouseSvgIcon"></use>
                                                    </svg>
                                                    Inhouse
                                                </a>
                                            </li>
                                            <li role="presentation" data-target="checkOut" class="">
                                                <a href="javascript:void(0)" role="tab" data-toggle="tab" onclick="GetCheckedOut()" aria-expanded="false">
                                                    <svg class="w20 h20">
                                                        <use xlink:href="#checkOutIcon"></use>
                                                    </svg>
                                                    Checked-Out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="row justify-content-end">
                                            <div class="col-md-4 align-right"><select class="form-control" id="RoomTypes" name="RoomTypes">
                                                    <option value="0">All Room Types</option>
                                                    <?php
                                                    foreach (getRoomType() as $roomItem) {
                                                        $header = ucfirst($roomItem['header']);
                                                        $rid = $roomItem['id'];
                                                        echo "<option value='$rid'>$header</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div id="loadTodayEventReport"></div>
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

        function GetBookings() {
            loadTodayEventReport('booking');
        }

        function GetInhouse() {
            loadTodayEventReport('inHouse');
        }

        function GetCheckedOut() {
            loadTodayEventReport('checkOut');
        }

        $(document).ready(function() {

            loadTodayEventReport();



            $(document).on('submit', '#roomStatusFilterForm', function(e) {
                e.preventDefault();
                var date = $('#SearchByDateFrom').val();
                var name = $('#name').val();
                loadRomStatusReport(date, name);
            });

            $(document).on('click', '#section-tab-nav li', function(e) {
                e.preventDefault();
                $('#section-tab-nav li').removeClass('active');
                $(this).addClass('active');
            });




        });
    </script>

</body>

</html>