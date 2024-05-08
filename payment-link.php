<?php


include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

checkProductExistOrNot([6], 22);

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

    <title>Payment Link</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>



</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">

            <div class="row mt-2">
                <?php

                $navHtml = '<ul class="btnGroup">
                                    <li class="dib">
                                        <a href="javascript:void(0)"><button type="button" id="reloadPaymentBtn"><svg><use xlink:href="#reloadSvgIcon"></use></svg></button></a>
                                    </li>
                                    <li class="dib">
                                        <a href="javascript:void(0)"><button type="button" id="addPaymentBtn" class="btn bg-gradient-info m-0">Create Link</button></a>
                                    </li>
                                </ul>';
                $currentTime = date('Y-m-d');
                $leftSide = '<div class="currentDate" style="margin-left:10px">
                                    <input class="form-control" type="text" id="currentDateStart" name="currentDate" value="' . $currentTime . '">
                                </div>';
                echo backNavbarUi('', 'Payment Link', $navHtml, $leftSide); ?>
            </div>

            <div id="paymentLinkContent">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Payment Id</th>
                                    <th>Amount</th>
                                    <th>Name</th>
                                    <th>Email / Phone</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </main>


    
    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>





    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>

    <script>
        $('.linkBtn').removeClass('active');
        $('.paymentLink').addClass('active');

        $('#currentDateStart').datepick({
            maxDate: '0',
            onSelect: function(dates) {
                var currentDate = $(this).val();
                loadPaymentLink(currentDate);
            },
            dateFormat: 'yyyy-mm-dd',
        });


        $(document).ready(() => {

            loadPaymentLink();

            $(document).on('click', '.copyPaymentLink', function(e) {
                e.preventDefault();
                var pid = $(this).data('pid');
                var formData = `request_type=copyPaymentLink&pid=${pid}`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var msg = response.msg;
                    var status = response.status;
                    var link = response.link;
                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                    if (status == 'success') {
                        navigator.clipboard.writeText(link);
                        sweetAlert(msg);
                    }
                });
            });

            $(document).on('click', '.editPaymentLink', function(e) {
                e.preventDefault();
                var pid = $(this).data('pid');
                var formData = `request_type=editPaymentLink&pid=${pid}`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var amount = response.amount;
                    var email = (response.email == null) ? '' : response.email;
                    var name = (response.name == null) ? '' : response.name;
                    var phone = (response.phone == null) ? '' : response.phone;
                    var reason = (response.reason == null) ? '' : response.reason;
                    var pid = response.id;

                    generatePaymentLinkForm(pid, name, email, phone, amount, reason);
                });

            });

            $(document).on('click', '#reloadPaymentBtn', function(e) {
                e.preventDefault();
                var currentDate = $('#currentDateStart').val();
                loadPaymentLink(currentDate);
            });


            $(document).on('click', '#paymentLinkSubmitBtn', function(e) {
                e.preventDefault();
                var perName = $('#perName').val().trim();
                var perEmail = $('#perEmail').val().trim();
                var perPhone = $('#perPhone').val().trim();
                var paymentAmount = $('#paymentAmount').val().trim();
                var paymentReason = $('#paymentReason').val().trim();
                var paymentId = $('#paymentId').val().trim();
                var hid = '41517';

                if (paymentAmount == '') {
                    sweetAlert('Amount is required.', 'error');
                } else {
                    paymentLinkSubmit(hid,paymentId, perName, perEmail, perPhone, paymentAmount, paymentReason);
                }
            });

        });
    </script>

</body>

</html>
