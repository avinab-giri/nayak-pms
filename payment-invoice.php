<?php


include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH .'svg.php');

checkLoginAuth();


checkProductExistOrNot([3], 5);

$backLink = FRONT_SITE;
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
    $backLink = $_SERVER['HTTP_REFERER'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Guest's Payment</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">


            <div class="row mt-4">
                <?php
                $navHtml = '<ul class="dFlex aic">   
                                                        
                                    <li class="dib "><button id="exportData" class="btn btn-outline-secondary m-0">Export</button></li>
                                </ul>';
                echo backNavbarUi('', 'Payments', $navHtml);
                ?>
                <div class="col-12">


                    <div id="errorBox"></div>

                    <div class="card" id="guestDatabaseContent">
                        <div class="card-head">
                            <div class="dFlex jcsb aic" style="margin-top:25px;">
                                <div class="left dFlex" style="width:50%">
                                    <h4 class="mr10">Guest List</h4>

                                </div>
                                <div class="input-group" style="width:20%;">
                                    <input type="date" id="dateSelect" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="guestPayementList" border="1" class="table align-items-center mb-0 tableLine">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-left">Guest name</th>
                                            <th scope="col" class="text-center">Phone</th>
                                            <th scope="col" class="text-center">Total Amount</th>
                                            <th scope="col" class="text-center">Paid Amount</th>
                                            <th scope="col" class="text-right"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="s25"></div>
                            <ul id="pagination" class="pagination pagination-sm pagination-primary"></ul>
                        </div>
                    </div>





                </div>

    </main>


    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>




    <script>
        $('.linkBtn').removeClass('active');
        $('.pmsLink').addClass('active');


        loadDetails();

        $(document).on('change', "input[type='checkbox']", function() {
            var target = $(this).parent().parent();
            if ($(this).is(':checked')) {
                target.addClass('active');
            } else {
                target.removeClass('active');
            }

        });



        $(document).on('change', '#paaaymentsetteledBtn', function() {
            var data_oprt = $(this).data('oprt');
            var bid = $(this).data('bid');

            var date = $('#dateSelect').val();
            if (date != '') {
                var data = {
                    'type': 'allSetelement',
                    'bid': bid,
                    'date': date
                };
            } else {
                a = formattedDateForInput();
                var data = {
                    'type': 'allSetelement',
                    'bid': bid,
                    'date': a
                };
            }

            $.ajax({
                url: "include/ajax/otherDetail.php",
                type: "POST",
                data: data,
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'ok') {
                        var date = $('#dateSelect').val();
                        loadDetails(date);
                        loadPaymentHistDetails(bid);
                        checkAllBoxSelectOrNot(bid);
                    } else {
                        sweetAlert('Sorry Something Went Wrong!', 'error');
                    }

                },
                error: function(error) {
                    sweetAlert('Sorry Something Went Wrong!', 'error');
                }
            })

        });

        $(document).on('click', '#paymentHistoryBtn', function() {

            var bid = $(this).data('bid');

            loadPaymentHistDetails(bid);
            checkAllBoxSelectOrNot(bid);

        });


        $(document).on('change', '#singlePaaaymentsetteledBtn', function() {
            var id = $(this).data('id');
            var bid = $(this).data('bid');
            var oprt = $(this).data('opr');
            if (oprt == 1) {

                var data = {
                    'type': 'singlePaymentHistDetais',
                    'id': id,
                    'bid': bid
                };
                $.ajax({
                    url: "include/ajax/otherDetail.php",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status == 'ok') {
                            loadPaymentHistDetails(bid);
                            var date = $('#dateSelect').val();
                            loadDetails(date);
                            checkAllBoxSelectOrNot(bid);

                        } else {
                            sweetAlert('Sorry Something Went Wrong!', 'error');
                        }

                    },
                    error: function() {
                        sweetAlert('Sorry Something Went Wrong!', 'error');
                    }
                })
            }
        });

        $(document).on('click', '#detailsall', function() {
            var bid = $(this).data('bid');
            loadPaymentHistDetails(bid);
            checkAllBoxSelectOrNot(bid);

        });
        $(document).on('change', '#dateSelect', function() {
            var date = $('#dateSelect').val();
            loadDetails(date);
        });
        $(document).on('click', '#exportData', function() {
            exportTableToExcel('guestPayementList','payment_list_data');
        });

        function loadDetails(date = '') {

            if (date != '') {
                var data = {
                    'type': 'loadGuestPaymentDetails',
                    'date': date
                };
            } else {
                a = formattedDateForInput();
                date = a;
                var data = {
                    'type': 'loadGuestPaymentDetails',
                    'date': a
                };
            }

            $.ajax({
                url: "include/ajax/otherDetail.php",
                type: "POST",
                data: data,
                success: function(response) {
                    // console.log(response);
                    $('#guestPayementList tbody').html(response);;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function loadPaymentHistDetails(bid) {
            var date = $('#dateSelect').val();
            if (date != '') {
                var data = {
                    'type': 'paymentHistDetails',
                    'bid': bid,
                    'date': date
                };
            } else {
                a = formattedDateForInput();
                var data = {
                    'type': 'paymentHistDetails',
                    'bid': bid,
                    'date': a
                };
            }



            $.ajax({
                url: "include/ajax/otherDetail.php",
                type: "POST",
                data: data,
                success: function(response) {
                    customModal('Payment History Details', response);
                },
                error: function(error) {
                    sweetAlert('Sorry Something Went Wrong!', 'error');
                }
            });

        }

        function checkAllBoxSelectOrNot(bid) {
            var data = {
                'type': 'checkAllBoxSelectOrNot',
                'bid': bid
            };


            $.ajax({
                url: "include/ajax/otherDetail.php",
                type: "POST",
                data: data,
                success: function(response) {
        
                    if (response.trim() == 'ok') {

                        var checkbox = $('input[data-bid="' + bid + '"]');
                        checkbox.prop('checked', true);
                        checkbox.prop('disabled', true);
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }



        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }
    </script>

</body>

</html>