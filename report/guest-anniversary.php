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

    <title>Guest Anniversary</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
            echo backNavbarUi('', 'Guest Anniversary');
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header p-0 py-2 position-relative z-index-1" style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="checkInFilterForm">
                                        <div class="row justify-content-center input-daterange">
                                            <div class="col-md-4">
                                                <input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="SearchByDateFrom" maxlength="10" name="SearchByDateFrom" placeholder="DD/MM/YYYY" type="text" value="<?= date('d-m-Y') ?>" readonly="readonly">
                                            </div>
                                            <div class="col-md-4">
                                                <input autocomplete="off" class="form-control input-nothing date-picker" data-date-format="dd/mm/yyyy" id="SearchByDateTo" maxlength="10" name="SearchByDateTo" placeholder="DD/MM/YYYY" type="text" value="<?= date('d-m-Y') ?>" readonly="readonly">
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

        $('.input-daterange').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });

        $('#SearchByDateFrom').on('change', function(e) {
            var date = $(this).val();
            var toDate = $('#SearchByDateTo').val();
            loadGuesAniReport(date,toDate);
        });

        $('#SearchByDateTo').on('change', function(e) {
            var date = $(this).val();
            var formDate = $('#SearchByDateFrom').val();
            loadGuesAniReport(formDate,date);
        });

        function loadGuesAniReport(from = '',to = '', name = '') {
            var data = `request_type=loadGuesAniReport&from=${from}&to=${to}`;
            var skeleton = window.tableSkeleton;
            $('#loadReportContainer').html(skeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                var html = '<table id="table-data-report-collections" class="table">';
                html += `
                    <thead>
                        <tr>
                            <th style="text-align:center;">Anniversary</th>
                            <th style="text-align:center;">Res #</th>
                            <th style="text-align:center;">Guest Name</th>
                            <th style="text-align:center;">Email Id</th>
                            <th style="text-align:center;">Whatsapp</th>
                            <th style="text-align:center;">State</th>
                            <th style="text-align:center;">Add On</th>
                            
                        </tr>
                    </thead>

                `;
                html += "<tbody>";

                if (response.length > 0) {
                    $.each(response, function(key, val) {
                        var addOn = val.addOn;
                        var anniversary = val.anniversary;
                        var name = val.name;
                        var email = val.email;
                        var whatsapp = val.whatsapp;
                        var state = val.state;
                        var recipt = generateNumber(val.recipt);

                        var addOnFormat = moment(addOn).format('DD-MMM, YYYY');
                        var eventDateFormat = moment(`${anniversary}-2024`).format('DD-MMM');

                        html += `<tr>
                                <td style="text-align: center; ">${eventDateFormat}</td>
                                <td style="text-align: center; ">${recipt}</td>
                                <td style="text-align: center; ">${name}</td>
                                <td style="text-align: center; ">${email}</td>
                                <td style="text-align: center; ">${whatsapp}</td>
                                <td style="text-align: center; ">${state}</td>
                                <td style="text-align: center; ">${addOnFormat}</td>
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
            loadGuesAniReport();


            $(document).on('submit', '#checkInFilterForm', function(e) {
                e.preventDefault();
                var date = $('#SearchByDateFrom').val();
                var name = $('#name').val();
                loadGuesAniReport(date, name);
            });

        });
    </script>

</body>

</html>