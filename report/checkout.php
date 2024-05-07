<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2], 15);
$hotelName = ucfirst(hotelDetail()['hotelName']);

$backLink = FRONT_SITE;


$user = getHotelUserDetail('', '', '', '', '', '', 'name');
$paymentMethod = getPaymentTypeMethod('', '', 'name');

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Checked Out Guests</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'Checked Out Guests');
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <form id="checkOutFilterForm">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="SearchByDateFrom" maxlength="10" name="SearchByDateFrom" placeholder="DD/MM/YYYY" type="text" value="<?= date('d-m-Y') ?>" readonly="readonly">
                                    </div>

                                    <div class="col-md-4"><input autocomplete="new-password" class="form-control input-number" id="name" name="name" placeholder="Enter booking id" type="text" value=""></div>

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
                            <div id="loadCackoutReport"></div>
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

        $('#SearchByDateFrom').datepick({
            showTrigger: '#calImg'
        });

        function loadCackoutReport(date = '', name = '') {
            var data = `request_type=loadCackoutReport&name=${name}&date=${date}`;
            var skeleton = window.tableSkeleton;
            $('#loadCackoutReport').html(skeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                var html = '<table id="table-data-report-collections" class="table">';
                html += `
                    <thead>
                        <tr>
                            <th width="15%" style="text-align:center;">Room</th>
                            <th width="10%">Booking #</th>
                            <th width="15%">Check In</th>
                            <th width="10%">Check Out</th>
                            <th width="20%">Guest</th>
                            <th width="10%">Adult</th>
                            <th width="10%">Child</th>
                            <th width="10%">Checkout By</th>
                        </tr>
                    </thead>

                `;
                html += "<tbody>";

                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        var roomNum = val.room_number;
                        var bookingMainId = val.bid;
                        var bookinId = val.bookinId;
                        var reciptNo = generateNumber(val.reciptNo);
                        var checkIn = val.checkIn;
                        var checkOut = val.checkOut;
                        var adult = val.adult;
                        var child = val.child;
                        var guestArray = val.guestArray;
                        var gNmae = (guestArray.length > 0) ? guestArray[0]['name'] : '';

                        var formatDate = moment(checkIn).format('DD-MMM');
                        var formatDate2 = moment(checkOut).format('DD-MMM');

                        html += `<tr>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomNum}</td>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${reciptNo}</td>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${formatDate}</td>
                                <td style="background-color: rgb(255, 255, 255);">${formatDate2}</td>
                                <td style="background-color: rgb(255, 255, 255);"><div class="dFlex aic jcc fdc">
                                    <span>${gNmae}</span> 
                                    <a id="btnViewGuests_${bookinId}" href="javascript:;" onclick="ViewGuestsFromReport(${bookingMainId})" class="btn btn-info">View Guests</a>
                                </div></td>
                                <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);"> ${adult}</td>
                                <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);"> ${child}</td>
                                <td style="background-color: rgb(255, 255, 255);"></td>
                            </tr>`;
                    });
                } else {
                    html += `<tr>
                                <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                            </tr>`;
                }


                html += "</tbody>";

                html += "</table>";


                $('#loadCackoutReport').html(html);
            });


        }

        $(document).ready(function() {
            loadCackoutReport();


            $(document).on('submit', '#checkOutFilterForm', function(e) {
                e.preventDefault();
                var date = $('#SearchByDateFrom').val();
                var name = $('#name').val();
                loadCackoutReport(date, name);
            });
        });
    </script>

</body>

</html>