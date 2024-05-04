<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

$hotelId = $_SESSION['HOTEL_ID'];

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

    <title>Payment checkout</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php'); ?>

    <style>
        .paymentEditBtn {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 15;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translate(1px, -1px);
            border: 1px solid #cb0c9f;
            padding: 8px;
            background: white;
        }

        #domiCheckOut {
            display: block;
            box-shadow: 0 0 15px #d1d1d1;
            max-width: 350px;
            border-radius: 3px;
            padding: 25px 10px;
            position: sticky;
            top: 0;
            margin: 0 0 0 auto;
        }

        #domiCheckOut .skltline {
            width: 25px;
            height: 5px;
            display: inline-block;
            background: #d9d9d9;
            border-radius: 5px;
        }

        #domiCheckOut .advanceOpt {
            position: relative;
            margin: 5px 0;
        }

        #domiCheckOut .advanceOpt li {
            border: 1px solid black;
            padding: 2px 10px;
        }

        #domiCheckOut button {
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: green;
            color: white;
            font-weight: 700;
            letter-spacing: .05em;
            opacity: .5;
        }
    </style>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <section id="setupSection">
            <div class="setupLeftSide">
                <?php include(FO_SERVER_SCREEN_PATH . 'setupNav.php') ?>
            </div>
            <div class="setupRightSide">
                <div class="innerLink">
                    <ul class="innerNav">
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/checkout' ?>">Checkout</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="checkOutArea row h100p">
                        <div class="col-xl-6 col-md-6 col-sm-6 pR0 rightBorder h100p">
                            <div id="loadCheckout">

                                <form action="">

                                </form>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6 h100p">
                            <div id="domiCheckOut">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    
    <div class="itemContent">
        <div class="icon"></div>
        <h4></h4>
    </div>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.beNav').addClass('active');
        $('.beNav .checkout').addClass('active');

        function loadFatchCheckout() {
            var formData = `request_type=loadFatchCheckout`;
            var loder = window.loader;
            $('#domiCheckOut').html(loder);

            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var partialPaymentStatus = response.partialPaymentStatus;
                var payByRoomStatus = response.payByRoomStatus;
                var pckupDropStatus = response.pckupDropStatus;
                var PartialPaymentPrice = (response.PartialPaymentPrice == null) ? 0 : response.PartialPaymentPrice;
                var pckupDropPrice = (response.pckupDropPrice == null) ? 0 : response.pckupDropPrice;

                var advanceOpt = '';

                if (partialPaymentStatus == 1) {
                    advanceOpt += `
                                    <li class="dFlex jcsb aic mb-2">
                                        <div>
                                            <input type="checkbox" name="partialPay">
                                            <span style="color:#000000">${PartialPaymentPrice}%</span>
                                        </div>
                                        <span style="color:#000000">Partial Payment</span>
                                    </li>
                                `;
                }

                if (payByRoomStatus == 1) {
                    advanceOpt += `
                                    <li class="dFlex jcsb aic mb-2">
                                        <div>
                                            <input type="checkbox" name="payByRoom">
                                        </div>
                                        <span style="color:#000000">Pay by room</span>
                                    </li>
                                `;
                }

                if (pckupDropStatus == 1) {
                    advanceOpt += `
                                    <li class="dFlex jcsb aic mb-2">
                                        <div>
                                            <input type="checkbox" name="payByRoom">
                                            <span style="color:#000000">&#8377; ${pckupDropPrice}</span>
                                        </div>
                                        <span style="color:#000000">Picup & drop</span>
                                    </li>
                                `;
                }

                var html = `<ul>
                                <li class="demoRoom db">
                                    <ul>
                                        <li class="dFlex jcsb aic">
                                            <div>
                                                <span class="skltline"></span>
                                                <div>
                                                    <span class="skltline"></span>
                                                    <span class="skltline"></span>
                                                    <span class="skltline"></span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="skltline"></span>
                                                <span class="skltline"></span>
                                            </div>
                                        </li>
                                        <li class="db"></li>
                                    </ul>
                                </li>
                                <li class="demoSummry db">
                                    <ul>
                                        <li class="dFlex jcsb aic">
                                            <span>Total room charge</span>
                                            <span class="skltline"></span>
                                        </li>
                                        <li class="dFlex jcsb aic">
                                            <span>Total taxes</span>
                                            <span class="skltline"></span>
                                        </li>
                                    </ul>
                                </li>
                                <li class="advanceOpt db">
                                    <ul>
                                        ${advanceOpt}
                                    </ul>
                                </li>
                                <li class="demoFooter db">
                                    <ul>
                                        <li class="dFlex jcsb aic">
                                            <span>Total Price</span>
                                            <span class="skltline"></span>
                                        </li>
                                        <li class="dFlex jcsb aic">
                                            <span>Pay Now</span>
                                            <span class="skltline"></span>
                                        </li>
                                        <li class="dFlex jcsb aic">
                                            <span>Pay at hotel</span>
                                            <span class="skltline"></span>
                                        </li>
                                    </ul>
                                    <button>Review Booking</button>
                                </li>
                            </ul>`;

                $('#domiCheckOut').html(`${html}`);
            });

        }

        function loadCheckout() {
            var formData = `request_type=loadCheckout`;
            var loder = window.loaderSpinner;
            $('#loadCheckout form').append(loder);
            var serviceList = '';
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);

                $('#loadCheckout form').html(`${response}`);
                loadFatchCheckout();
            });
        }

        function checkoutMoreData(check, checkValue) {
            if (checkValue == 'advancePay') {
                name = 'Advance pay';
            } else if (checkValue == 'PartialPayment') {
                name = 'Partial payment';
            } else if (checkValue == 'payByRoom') {
                name = 'Pay by room';
            } else if (checkValue == 'pickupDrop') {
                name = 'Pickup drop';
            }

            data = '';
            var formData = `request_type=checkCheckoutPrice&checkValue=${checkValue}`;
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var price = response.price;
                var desc = response.desc;
                data = `
                    <form id="checkoutDetail" enctype= multipart/form-data>
                        <div class="row">
                            <input type="hidden" id="elementAttr" value="${checkValue}"/>
                            <div class="form-group col-md-12 mb-2">
                                <label for="paymentCheckVal">${name} price</label>
                                <input name="checkoutValue" id="checkoutValue" type="number" class="form-control" placeholder="Enter ${name} price" value="${price}">
                            </div>                                    
                        </div>
                    </form>
                `;

                if (check == true) {
                    if (checkValue == 'advancePay') {
                        showModalBox(name, 'Update', data, 'submitPaymentCheckout');

                        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                        myModal.show();
                    } else if (checkValue == 'PartialPayment') {
                        showModalBox(name, 'Update', data, 'submitPaymentCheckout');
                        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                        myModal.show();
                    } else if (checkValue == 'pickupDrop') {
                        showModalBox(name, 'Update', data, 'submitPaymentCheckout');
                        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                        myModal.show();
                    }


                }
            });


        }

        $(document).ready(() => {
            loadCheckout();

            $(document).on('click', '.checkOutChoseBox input', function() {
                var check = $(this).prop('checked');
                var checkValue = $(this).val();
                var formData = `request_type=actionCheckBox&check=${check}&checkValue=${checkValue}`;
                ajax_request(formData).done((data) => {
                    var name = '';
                    loadCheckout();
                    checkoutMoreData(check, checkValue);
                });
            });

            $(document).on('click', '.paymentEditBtn', function(e) {
                e.preventDefault();
                var checkattr = $(this).data('checkattr');
                checkoutMoreData(true, checkattr);
            });

            $(document).on('click', '#submitPaymentCheckout', function(e) {
                e.preventDefault();
                var elementId = $('#elementAttr').val();
                var price = $('#checkoutValue').val().trim();
                var formData = `request_type=submitPaymentCheckout&price=${price}&elementId=${elementId}`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;

                    if (status == 'success') {
                        sweetAlert(msg);
                        loadCheckout();
                        $('#popUpModal').modal('hide');
                    }

                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                });
            });
        });
    </script>

</body>

</html>