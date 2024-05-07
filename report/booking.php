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

    <title>Booking rooms</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>


        <div class="container">

            <?php
            echo backNavbarUi('', 'Booking Rooms');
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="loadBookingReport">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
        </div>




        </div>

        <div id="configurationForm" class="show"></div>

    </main>




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

        function loadResorvation($rTab = '', $search = '', $reserveType = '', $bookingType = '', $currentDate = '') {

            var rTab = $rTab;
            var search = $search;
            var reserveType = $reserveType;
            var bookingType = $bookingType;
            var currentDate = $currentDate;

            if (rTab == '') {
                rTab = 'reservation';
            }
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/resorvation.php' ?>",
                type: 'post',
                data: {
                    type: 'bookingreport',
                    rTab: rTab,
                    search: search,
                    reserveType: reserveType,
                    bookingType: bookingType,
                    currentDate: currentDate
                },
                success: function(data) {
                    $('#loadBookingReport').html(data);
                    // reservationCountNavBar(rTab, '', currentDate);
                }
            });

        }

        $(document).on('click','.reservationViewBtn',function(){

            var bid = $(this).data('bookingid');
                var bdid = $(this).data('bdid');

                reservationView(bid,bdid);
        });

        function reservationView($bid,$bdid){
            var bid = $bid;
            var form_data = `request_type=makeReservationDetail&bid=${bid}`;
                ajax_request(form_data).done((result) => {
                    var response = JSON.parse(result);
                    var guestArray = response.guestArray[0];
                    var bookinId = response.bookinId;
                    var bookingSource = response.bookingSource;
                    var checkIn = response.checkIn;
                    var checkOut = response.checkOut;
                    var checkinstatus = response.checkinstatus;
                    var bussinessSource = response.bussinessSource;

                    var totalPrice = response.totalPrice;
                    var userPay = response.userPay;
                    var remeningPay = totalPrice - userPay;

                    var addOn = response.addOn;
                    var night = response.night;
                    var roomDetailArry = response.roomDetailArry;

                    var statusCls= '';
                    var statusBtn= '';

                    if(checkinstatus == 1){
                        statusCls = 'bg-warning';
                        statusBtn = 'Arrived';
                    }else if(checkinstatus == 2){
                        statusCls = 'bg-success';
                        statusBtn = 'In House';
                    }else if(checkinstatus == 3){
                        statusCls = 'bg-danger';
                        statusBtn = 'Check out';
                    }

                    var bSourceHtml = '';
                    if(bussinessSource == 1){
                        bSourceHtml = 'PMS';
                    }else if(bussinessSource == 2){
                        bSourceHtml = 'BE';
                    }
                    
                    var gName = guestArray.name;
                    var gEmail = guestArray.email;
                    var gPhone = guestArray.phone;
                    var gImg = guestArray.profileImgFull;
                    var bookDetailHtml = '';
                    $.each(roomDetailArry, function(key,val){
                        var room_number = val.room_number;
                        var adult = val.adult;
                        var child = val.child;
                        var rateplan = val.rateplan;
                        var roomName = val.roomName;
                        var subTotal = val.subTotal;
                        var total = val.total;
                        var gstPrice = val.gstPrice;
                        var gstPer = val.gstPer;
                        var oneNight = Math.round(total / night);

                        bookDetailHtml += `
                                <li class="list-group-item">
                                    <div class="row row-flex">
                                        <div class="col col-info col-info-first">
                                            <span>${room_number}</span> <br/>
                                                <span class="lister-item-subtitle">Adult <strong>${adult}</strong> | Child <strong>${child}</strong></span>
                                            <span class="m-t-xs badge  badge-arrived">Check In</span></div>
                                        <div class="col col-info col-info-second"><span class="lister-item-subtitle m-b-xxs">Room Type</span><span
                                                class="lister-item-title">${roomName}</span><span class="lister-item-subtitle m-b-xxs"
                                                style="line-height: 2;">Rate Plan</span><span class="lister-item-title no-m-b">${rateplan[0]}</span></div>
                                        <div class="col col-info col-info-third">
                                            <div class="row row-flex">
                                                <div class="col text-center m-l-xs"><span class="lister-item-subtitle m-b-xxs">Exp. Arrival</span>
                                                    <span class="badge date-badge badge-success">
                                                        ${checkIn}
                                                    </span>
                                                    <p class="time"><i class="fa fa-clock-o"></i> 12:00 PM</p>
                                                </div>
                                                <div class="col text-center m-l-xs"><span class="lister-item-subtitle m-b-xxs">Exp. Dept.</span>
                                                    <span class="badge date-badge badge-danger">
                                                        ${checkOut}
                                                    </span>
                                                    <p class="time"><i class="fa fa-clock-o"></i> 10:00 AM</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-info col-amount col-info-fourth">
                                            <div class="row">
                                            <span class="lister-item-subtitle m-b-xxs">Rate:
                                                <span class="amount">&#x20B9; ${subTotal}</span>
                                            </span>
                                            <span class="lister-item-subtitle m-b-xxs">Disc:
                                                <span class="amount">0.00</span></span>
                                            <span class="lister-item-subtitle m-b-xxs">Extra:
                                                <span class="amount">0.00</span>
                                            </span>
                                            <span class="lister-item-subtitle m-b-xxs">Tax (${gstPer}%):
                                                <span class="amount">&#x20B9; ${gstPrice}</span>
                                            </span>
                                            <span class="lister-item-subtitle m-b-xxs">Total:
                                                <span class="amount">&#x20B9; ${total}</span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col col-info col-info-fifth">
                                            <div class="row">
                                                <span class="lister-item-subtitle m-b-xxs">Total For 1 Night(s)</span>
                                                <spanclass="lister-item-title">&#x20B9; ${oneNight}</spanclass=>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                        `;
                    });


                    bookDetailHtml += `
                        <li class="list-group-item data-foot">
                            <div class="row row-flex">
                                <div class="col col-info"><span class="lister-item-subtitle m-b-xxs">Grand Total:- </span><span
                                        class="lister-item-title">&#x20B9; ${totalPrice}</span></div>
                                <div class="col col-info"><span class="lister-item-subtitle m-b-xxs">Total Advances:- </span><span
                                        class="lister-item-title">&#x20B9; ${userPay}</span></div>
                                <div class="col col-info"><span class="lister-item-subtitle m-b-xxs">Estimated Balance:- </span><span
                                        class="lister-item-title">&#x20B9; ${remeningPay}</span></div>
                            </div>
                        </li>
                    `;
                    var html = `
                            <div class="panel panel-white no-m-b">
                                <div class="panel-body no-s">
                                    <div class="grid-aea" id="section-quick-reservation-form">
                                        <div class="form-horizontal">
                                            <div class="col-xs-12 col-sm-12 col-md-12 b">
                                                <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 left-panel">
                                                    <div class="row">
                                                        <h3 class="col-sm-12">Guest Name : <span>${gName}</span></h3>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12">Phone : <span>${gPhone}</span></label>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12">Email : <span>${gEmail}</span></label>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12">Organisation : <span></span></label>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12">GST : <span></span></label>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12" style="font-weight:bold;font-size:15px;">Night(s) : <span>${night}</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 detail-side-panel">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
                                                            <div class="dFlex aic">
                                                                <label>Booking Status : </label>
                                                                <label><span>
                                                                <span class="badge ${statusCls}">${statusBtn}</span></span></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>Booked On : </label>
                                                                <label><strong>${addOn}</strong></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>Arrival Date :</label>
                                                                <label><strong>${checkIn}</strong></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>Departure Date :</label>
                                                                <label><strong>${checkOut}</strong></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>Booking Source :</label>
                                                                <label><strong>${bSourceHtml}</strong></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>Travel Agent</label>
                                                                <label><strong></strong></label>
                                                            </div>
                                                            <div class="dFlex aic">
                                                                <label>User :</label>
                                                                <label><strong></strong></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-flex">
                                    <div class="col-md-12" style="padding-left:15px;">
                                        <div class="panel h-auto no-m-b">
                                            <div class="panel-body p-0">
                                                <ul class="list-group payment-history-list list-vb-rd" id="tableQuickViewReservationRoomDataBreakup">
                                                    ${bookDetailHtml}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body pl-0 pr-0">
                                    <div class="form-group text-center">
                                        <div class="col-sm-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;

                    showModalBox('Booking Details','',html,'','modal-xl');
                });
        }



        $(document).ready(function() {
            loadResorvation('all');
        });
    </script>

</body>

</html>