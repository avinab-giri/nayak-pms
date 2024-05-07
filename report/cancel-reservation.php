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

    <title>Cancel Reservation</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'Cancel Reservation');
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
            loadCackinReport(date);
        });

        function loadCackinReport(date = '', name = '') {
            var data = `request_type=loadCancelReservationReport&date=${date}`;
            var skeleton = window.tableSkeleton;
            $('#loadReportContainer').html(skeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                var html = '<table id="table-data-report-collections" class="table">';
                html += `
                    <thead>
                        <tr>
                            <th style="text-align:center;">Res #</th>
                            <th>Booking Date</th>
                            <th>Guest Name</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Rooms</th>
                            <th>Pax</th>
                            <th>Amount</th>
                            <th>Can. Date</th>
                        </tr>
                    </thead>

                `;
                html += "<tbody>";

                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        var roomNum = val.room_number;
                        var bookingMainId = val.bid;
                        var bookinId = val.bookinId;
                        var checkIn = val.checkIn;
                        var checkOut = val.checkOut;
                        var adult = val.adult;
                        var child = val.child;
                        var gNmae = val.guestName;
                        var companyName = val.companyName;
                        var addByName = val.addByDName;
                        var actionOn = val.actionOn;
                        var addOn = val.addOn;
                        var rooms = val.rooms;
                        var totalPrice = val.totalPrice;

                        var formatDate = moment(checkIn).format('DD-MMM');
                        var formatDate2 = moment(checkOut).format('DD-MMM');
                        var actionOn2 = moment(actionOn).format('DD-MMM');
                        var addOn2 = moment(addOn).format('DD-MMM');

                        html += `<tr>
                                <td style="text-align: center; ">${bookinId}</td>
                                <td style="text-align: center; ">${addOn2}</td>
                                <td style="text-align: center; ">${gNmae}</td>
                                <td style="">${formatDate}</td>
                                <td style="">${formatDate2}</td>
                                <td style="">${rooms}</td>
                                <td style="text-align: center; color:var(--pClr); "> ${adult} / ${child}</td>
                                <td style="text-align: center; color:var(--pClr); "> ${totalPrice}</td>
                                <td style="">${actionOn2}</td>
                            </tr>`;
                    });
                } else {
                    html += `<tr>
                                <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                            </tr>`;
                }


                html += "</tbody>";

                html += "</table>";


                $('#loadReportContainer').html(html);
            });
        }

        $(document).ready(function() {
            loadCackinReport();


            $(document).on('submit', '#checkInFilterForm', function(e) {
                e.preventDefault();
                var date = $('#SearchByDateFrom').val();
                var name = $('#name').val();
                loadCackinReport(date, name);
            });

        });
    </script>

</body>

</html>