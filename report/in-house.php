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

    <title>In House Guests</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'In House Guests');
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <form id="inHouseFilterForm">
                                <div class="row justify-content-center">

                                    <div class="col-md-4">
                                        <input autocomplete="new-password" class="form-control input-number" id="name" name="name" placeholder="Enter guest name" type="text" value="">
                                    </div>

                                    <div class="col-md-4">
                                        <input autocomplete="new-password" class="form-control input-number" id="city" name="city" placeholder="Enter city name" type="text" value="">
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
                            <div id="loadInHouseReport"></div>
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

        function loadInHouseReport(name = '', city = '') {
            var data = `request_type=loadInHouseReport&name=${name}&city=${city}`;
            var skeleton = window.tableSkeleton;
            $('#loadInHouseReport').html(skeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                var html = '<table id="table-data-report-collections" class="table">';
                html += `
                    <thead>
                        <tr>
                            <th width="15%" style="text-align:center;">Name</th>
                            <th width="15%">Phone</th>
                            <th width="10%">Email</th>
                            <th width="20%">City</th>
                            <th width="10%">Country</th>
                            <th width="10%">VIP</th>
                            <th width="10%">Organisation</th>
                        </tr>
                    </thead>

                `;
                html += "<tbody>";

                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        var roomNum = val.room_number;
                        var adult = val.adult;
                        var child = val.child;
                        var totalGuest = parseInt(adult) + parseInt(child);
                        var bookingMainId = val.bid;
                        var guestArray = val.guestArry;
                        html += `<tr>
                                    <td colspan="7" style="text-align: left; background-color: #f2f2f2;font-size: 18px;font-weight: 700;color:#9f0000!important;">${roomNum}</td>
                                </tr>`;

                        for (n = 0; n < totalGuest; n++) {
                            var guestDetailArry = guestArray[n];
                            if (guestDetailArry != undefined) {
                                var gName = guestDetailArry.name;
                                var gEmail = guestDetailArry.email;
                                var gPhone = guestDetailArry.phone;
                                var gCity = (guestDetailArry.city == null) ? '' : guestDetailArry.city;
                                var gCountry = guestDetailArry.country;
                                var company_name = guestDetailArry.company_name;
                                html += `<tr>
                                        <td style="text-align: left; color:var(--pClr); background-color: rgb(255, 255, 255);">${gName}</td>
                                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${gPhone}</td>
                                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${gEmail}</td>
                                        <td style="background-color: rgb(255, 255, 255);">${gCity}</td>
                                        <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);">${gCountry}</td>
                                        <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);"></td>
                                        <td style="text-align: right; color:var(--pClr); background-color: rgb(255, 255, 255);">${company_name}</td>
                                </tr>`;
                            } else {
                                html += `<tr>
                                        <td colspan="7" style="text-align: left; background-color: rgb(255, 255, 255);"><a href="javascript:;" onclick="ViewGuestsFromReport(${bookingMainId})">Add Guest</a></td>
                                </tr>`;
                            }

                        }
                    });
                } else {
                    html += `<tr>
                                <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                            </tr>`;
                }


                html += "</tbody>";

                html += "</table>";


                $('#loadInHouseReport').html(html);
            });


        }

        $(document).ready(function() {
            loadInHouseReport();


            $(document).on('submit', '#inHouseFilterForm', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var city = $('#city').val();
                loadInHouseReport(name, city);
            });
        });
    </script>

</body>

</html>