<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

checkProductExistOrNot([3, 1, 5], 2);

$backLink = FRONT_SITE;
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
    $backLink = $_SERVER['HTTP_REFERER'];
}

$grcLink = FRONT_SITE . '/grc';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Walk In</title>

    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <div class="container">

            <div class="reservationNav sNavBar">
                <?php

                $leftNav = reservationLeftNav('New');
                $rightNav = reservationRightNav();

                echo backNavbarUi('', '', $rightNav, $leftNav);

                ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="loadAddResorvation" style="display: block;">
                        <form method="post" id="addReservationForm" autocomplete="off">
                            <div class="row">

                                <div class="col-md-8">
                                    <div class="">
                                        <input type="hidden" value="reservation" name="page">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-area1">
                                                    <button id="backBtnForPoupUpContent">

                                                        <i>
                                                            <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 152.3 98.8" style="enable-background:new 0 0 152.3 98.8;" width="15px" height="15px">
                                                                <style type="text/css">
                                                                    .leftArrowLine {
                                                                        fill: none;
                                                                        stroke: #000000;
                                                                        stroke-width: 12;
                                                                        stroke-linecap: round;
                                                                        stroke-linejoin: round;
                                                                        stroke-miterlimit: 10;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <line class="leftArrowLine" x1="138" y1="50.4" x2="13.1" y2="50.4"></line>
                                                                    <line class="leftArrowLine" x1="48.4" y1="15" x2="13" y2="50.3"></line>
                                                                    <line class="leftArrowLine" x1="48.4" y1="85.7" x2="13" y2="50.3"></line>
                                                                </g>
                                                            </svg>
                                                        </i>
                                                        <h4>Reservation</h4>
                                                    </button>
                                                </div>
                                                <br>


                                                <div class="row">

                                                    <div class="col-md-8">
                                                        <div class="input-daterange input-group" id="datepicker">
                                                            <div class="row align-items-center" style="width: 100%;margin: 0;">
                                                                <div class="col-6">
                                                                    <label for="">Check In</label>
                                                                    <input id="checkInInut" type="text" class="input-sm form-control" name="checkIn" value="<?= date('d-m-Y') ?>" readonly>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="">Check Out</label>
                                                                    <input id="checkOutInput" type="text" class="input-sm form-control" name="checkOut" value="<?= date('d-m-Y', strtotime('+1 day')) ?>" readonly>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group mb0">
                                                            <label for="">Reservation type</label>
                                                            <select class="customSelect" name="reservationType" id="reservationType">

                                                                <option value="1" selected="">Confirm Booking</option>
                                                                <option value="2">Unconfirmed Booking Inquiry</option>
                                                                <option value="3">Online Failed Booking</option>
                                                                <option value="4">Hold Confirm Booking</option>
                                                                <option value="5">Hold Unconfirm Booking</option>

                                                            </select>


                                                        </div>
                                                    </div>

                                                </div>
                                                <br>
                                                <hr>


                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table width="100%" id="roomDetailTable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="20%" class="py10">Room Type</th>
                                                                    <th width="15%" class="py10">Rate Type</th>
                                                                    <th width="15%" class="py10">Adult</th>
                                                                    <th width="10%" class="py10">Child</th>
                                                                    <th width="10%" class="py10">GST</th>
                                                                    <th width="15%" class="py10 reservationRateArea"><span>Rate(Rs)</span></th>
                                                                    <th width="15%" class="py10"><span>Total(Rs)</span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="roomDetailId">
                                                                <tr>
                                                                    <td class="pr10">
                                                                        <div class="form-group">
                                                                            <select class="selectRoomId customSelect" name="selectRoom[]" data-rno="0">
                                                                                <option value="0" selected="">-Select Room</option>
                                                                                <?php
                                                                                foreach (fetchData('room', ['hotelId' => $_SESSION['HOTEL_ID']]) as $item) {
                                                                                    $roomId = $item['id'];
                                                                                    $roomName = $item['header'];
                                                                                    echo '<option value="' . $roomId . '">' . $roomName . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pr10">
                                                                        <div class="form-group">
                                                                            <select class="rateTypeId customSelect" name="selectRateType[]" data-rno="0">
                                                                                <option value="" selected="">-Select</option>
                                                                                <?php
                                                                                foreach (fetchData('sys_rate_plan') as $item) {
                                                                                    $rpId = $item['id'];
                                                                                    $srtcode = $item['srtcode'];
                                                                                    echo '<option value="' . $rpId . '">' . $srtcode . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pr10">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="number" value="0" placeholder="" name="selectAdult[]">
                                                                        </div>
                                                                    </td>

                                                                    <td class="pr10">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="number" value="0" name="selectChild[]">
                                                                        </div>
                                                                    </td>

                                                                    <td class="pr10">
                                                                        <div class="form-group">
                                                                            <select onchange="calculateTotal()" class="customSelect roomGst" name="roomGst[]" id="">
                                                                                <option value="0">0</option>
                                                                                <option selected value="12">12%</option>
                                                                                <option value="18">18%</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="form-group reservationRateArea">
                                                                            <input onchange="calculateTotal()" type="number" value="0" class="form-control totalPriceSection" name="totalPrice[]">
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="form-group reservationRateArea">
                                                                            <input type="number" value="0" class="form-control totalPriceWithGst disabled" name="totalPriceWithGst[]" readonly>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="" class="btn btn-outline-primary" id="roomDetailIncBtnId">Add Room</a>
                                                    </div>
                                                </div>
                                                <br>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4> Booking By :</h4>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Booking Source</label>
                                                            <select class="customSelect" name="bookingSorcelist" id="bookingSorcelist">
                                                                <option value="1">Walk-In</option>
                                                                <option value="2">Booking Engine</option>
                                                                <option value="4">Agoda</option>
                                                                <option value="5">Airbnb</option>
                                                                <option value="6">MakeMyTrip</option>
                                                                <option value="7">Booking.com</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Travel Agent</label>
                                                            <select class="customSelect" name="travelagent" id="travelagent">
                                                                <option value="0">Select</option>
                                                                <?php
                                                                foreach (fetchData('travel_agents', ['hotelId' => $_SESSION['HOTEL_ID']]) as $item) {
                                                                    $taId = $item['id'];
                                                                    $name = $item['travelagentname'];
                                                                    echo '<option value="' . $taId . '">' . $name . '</option>';
                                                                }
                                                                ?>
                                                                <option value="other">Other</option>
                                                            </select>

                                                            <a href="javascript:void(0)" onclick="addTravelAgentForm()" style="color:blue; text-decoration: underline;">Create a Travel Agent
                                                                <svg style="width: 16px;height: 16px;" class="svg-inline--fa fa-external-link-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                                    <path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z"></path>
                                                                </svg></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" id="advanceFieldContent"></div>


                                                </div>

                                                <div class="s15"></div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4> Guest Imformation :</h4>
                                                    </div>
                                                </div>

                                                <div class="s15"></div>

                                                <div id="guestContent">
                                                    <div id="guestGroup">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Guest Name</label>
                                                                    <div class="form-group">
                                                                        <div class="inputLabel left">
                                                                            <input type="text" placeholder="Name" class="form-control" name="guestName" id="guestName" autocomplete="off">
                                                                            <div class="iconBox">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                                    <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" />
                                                                                </svg>
                                                                            </div>
                                                                        </div>

                                                                        <!-- <div class="iconBox">
                                                                            <a onclick="searchGuestView()" href="javascript:void(0)" class="iconCon" data-tooltip-top="Search guest">
                                                                                <svg class="w20 h20">
                                                                                    <use xlink:href="#guestSearchIcon"></use>
                                                                                </svg>
                                                                            </a>
                                                                        </div> -->
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Email</label>
                                                                    <div class="inputLabel left">
                                                                        <input type="text" placeholder="Email Id" class="form-control" name="guestEmail">
                                                                        <div class="iconBox">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                <path d="M494.6 164.5c-4.7-3.9-111.7-90-135.3-108.7C337.2 38.2 299.4 0 256 0c-43.2 0-80.6 37.7-103.3 55.9-24.5 19.5-131.1 105.2-135.2 108.5A48 48 0 0 0 0 201.5V464c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V201.5a48 48 0 0 0 -17.4-37zM464 458a6 6 0 0 1 -6 6H54a6 6 0 0 1 -6-6V204.3c0-1.8 .8-3.5 2.2-4.7 15.9-12.8 108.8-87.6 132.4-106.3C200.8 78.9 232.4 48 256 48c23.7 0 55.9 31.4 73.4 45.4 23.6 18.7 116.5 93.5 132.4 106.3a6 6 0 0 1 2.2 4.7V458zm-32-187.7c4.2 5.2 3.5 12.8-1.7 17-29 23.3-59.3 47.6-70.9 56.9C336.6 362.3 299.2 400 256 400c-43.5 0-81.3-38.2-103.3-55.9-11.3-9-41.7-33.4-70.9-56.9-5.2-4.2-6-11.8-1.7-17l15.3-18.5c4.2-5.1 11.7-5.8 16.8-1.7 28.6 23 58.6 47 70.6 56.6C200.1 320.6 232.3 352 256 352c23.6 0 55.2-30.9 73.4-45.4 12-9.5 41.9-33.6 70.6-56.6 5.1-4.1 12.6-3.3 16.8 1.7l15.3 18.5z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="guestWhatsApp">WhatsApp</label>
                                                                    <div class="inputLabel left">
                                                                        <input type="number" placeholder="WhatsApp number" class="form-control" name="guestWhatsApp" id="guestWhatsApp">
                                                                        <div class="iconBox left">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="guestMobile">Mobile</label>
                                                                    <div class="inputLabel left">
                                                                        <input type="number" placeholder="Mobile No" class="form-control" name="guestMobile" id="guestMobile">
                                                                        <div class="iconBox left">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                <path d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Pin Code</label>
                                                                    <input onkeyup="pinChangeToFetch(event)" type="text" placeholder="Pin code" class="form-control" name="pinCode">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Block</label>
                                                                    <input readonly="" disable="" type="text" placeholder="Block" class="form-control block" name="block">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">District</label>
                                                                    <input readonly="" disable="" type="text" placeholder="District" class="form-control district" name="district">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="state">State</label>
                                                                    <input readonly="" disable="" type="text" placeholder="State" class="form-control state" name="state">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="guestAddress">Address</label>
                                                                <textarea class="form-control" name="guestAddress" id="guestAddress" rows="1"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row ">
                                                        <h4>Billing Information:</h4>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">

                                                                <label class="control-label">Billing Mode</label>
                                                                <select class="customSelect" name="billingmode" id="billingmode">
                                                                    <option value="1">Guest</option>
                                                                    <option value="2">Complementary</option>
                                                                    <option value="3">Company</option>
                                                                </select>


                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Organisation</label>
                                                                <select class="selectOrganisation customSelect" name="organisation" data-rno="0" id="organisation">
                                                                    <option value="0" selected="">-Select Organisation</option>
                                                                    <?php
                                                                    foreach (fetchData('organisations', ['hotelId' => $_SESSION['HOTEL_ID']]) as $item) {
                                                                        $orgId = $item['id'];
                                                                        $name = $item['name'];
                                                                        echo '<option value="' . $orgId . '">' . $name . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <a href="javascript:void(0)" onclick="loadAddOrganisation()" style="color:blue; text-decoration: underline;">Create a organisation
                                                                    <svg style="width: 16px;height: 16px;" class="svg-inline--fa fa-external-link-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z"></path>
                                                                    </svg></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">GST Number</label>
                                                                <input type="text" placeholder="GST Number" id="gstNoField" class="form-control" name="gstnumber">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="specialRequest">Special Request</label>
                                                            <textarea class="form-control" name="specialRequest" id="specialRequest" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="s15"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="dFlex jce">
                                            <button class="btn btn-outline-secondary mr10">cancel</button>
                                            <button class="btn bg-gradient-info" id="addReservationSubmitBtn" type="submit" name="reservationSubmit">Save</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 rightSideAddReservation">
                                    <div class="form-area">
                                        <div class="cardTop">
                                            <svg width="497" height="219" viewBox="0 0 497 219" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M-38.5 196C-38.5 196 34 91 133.5 91C233 91 427 159 532.5 30C638 -99 518 236 518 236L-49 246.5L-38.5 196Z" fill="#FF768E"></path>
                                            </svg>
                                        </div>
                                        <div class="row insertContrnt">
                                            <div class="reservationContentPreview" data-bookingid="balkrishna-a940ab" data-reservationtab="" data-bdid="">

                                                <div class="head dFlex aic jcsb">
                                                    <div class="leftSide dFlex aic">
                                                        <div class="icon">
                                                            <svg style="width: 16px;height: 16px;" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                                <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="userName">
                                                            <h4>_ _ _</h4>
                                                            <span> - / --- </span>
                                                        </div>
                                                    </div>
                                                    <div class="rightSide">
                                                        <div class="checkinStatus center"><span style="background: #008000;color: #ffffff;">Confirm</span></div>
                                                    </div>
                                                </div>

                                                <div class="body">
                                                    <div class="checkInDetail">
                                                        <div class="left">
                                                            <strong><?= getDateFormatByTwoDate(date('Y-m-d'), date('Y-m-d', strtotime('+1 day'))); ?></strong>
                                                        </div>
                                                        <div class="right">
                                                            <span>Night </span>
                                                            <strong>1</strong>
                                                        </div>
                                                    </div>
                                                    <div class="bookingDate">
                                                        <div class="left">
                                                            <strong>Booking Date:- </strong>
                                                            <span> 01-May</span>
                                                        </div>
                                                        <div class="right">
                                                            <ul>
                                                                <li>
                                                                    <svg style="width: 16px;height: 16px;" class="svg-inline--fa fa-male fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="male" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                                                        <path fill="currentColor" d="M96 0c35.346 0 64 28.654 64 64s-28.654 64-64 64-64-28.654-64-64S60.654 0 96 0m48 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H48c-26.51 0-48 21.49-48 48v136c0 13.255 10.745 24 24 24h16v136c0 13.255 10.745 24 24 24h64c13.255 0 24-10.745 24-24V352h16c13.255 0 24-10.745 24-24V192c0-26.51-21.49-48-48-48z"></path>
                                                                    </svg>
                                                                    <strong>0</strong>
                                                                </li>
                                                                <li>
                                                                    <svg style="width: 16px;height: 16px;" class="svg-inline--fa fa-child fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="child" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                                        <path fill="currentColor" d="M120 72c0-39.765 32.235-72 72-72s72 32.235 72 72c0 39.764-32.235 72-72 72s-72-32.236-72-72zm254.627 1.373c-12.496-12.497-32.758-12.497-45.254 0L242.745 160H141.254L54.627 73.373c-12.496-12.497-32.758-12.497-45.254 0-12.497 12.497-12.497 32.758 0 45.255L104 213.254V480c0 17.673 14.327 32 32 32h16c17.673 0 32-14.327 32-32V368h16v112c0 17.673 14.327 32 32 32h16c17.673 0 32-14.327 32-32V213.254l94.627-94.627c12.497-12.497 12.497-32.757 0-45.254z"></path>
                                                                    </svg>
                                                                    <strong>0</strong>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="bookingDetail">
                                                        <ul>
                                                            <li>
                                                                <small>Total</small>
                                                                <strong>Rs 0.00</strong>
                                                            </li>
                                                            <li>
                                                                <small>Paid</small>
                                                                <strong>Rs 0.00</strong>
                                                            </li>
                                                            <li>
                                                                <small>Pay To Hotel</small>
                                                                <strong>Rs 0.00</strong>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form">
                                                    <label for="paymentMethod">Payment Method</label>
                                                    <select name="paymentMethod" id="paymentMethod" class="form-control">
                                                        <option value="" selected="">-Select-</option>
                                                        <option value="8">Other</option>
                                                        <option value="7">Payment Gateway</option>
                                                        <option value="6">Cash</option>
                                                        <option value="5">UPI</option>
                                                        <option value="4">NEFT/RTGS</option>
                                                        <option value="3">Debit card</option>
                                                        <option value="2">Credit card</option>
                                                        <option value="1">Cheque</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form">
                                                    <label for="paidAmount">Paid Amount</label>
                                                    <input value="" name="paidAmount" id="paidAmount" class="form-control" placeholder="Enter Amount">

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form" style="position: relative;">
                                                    <label for="paymentRemark">Payment Remark</label>
                                                    <span class="form-group reservationRateArea w85p" style="position: absolute; display: inline-block !important;">
                                                        <div class="content" style="position: absolute; padding: 2px; left: 8px;">
                                                            <div class="overflowContent">
                                                                A payment remark is a note or comment <br> associated with a payment transaction.
                                                            </div>
                                                            <span class="icon reservationRateAreaIcon" style="width: 20px; height: 22px; border-radius: 50%; padding-left: 2px;"><i class="bi bi-info-lg"></i></span>
                                                        </div>
                                                    </span>

                                                    <input name="paymentRemark" id="paymentRemark" class="form-control" placeholder="Enter voucher number, receipt number etc">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $('.resLink').addClass('active');

        const indicator = document.querySelector('.nav-indicator');
        const items = document.querySelectorAll('.reservationTab');
        var date = new Date();

        $('#checkInInut').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: date,
            todayHighlight: true,
        }).on('changeDate', function(selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#checkOutInput').datepicker('setStartDate', minDate);

            var nextDate = new Date(minDate);

            nextDate.setDate(nextDate.getDate() + 1);

            $('#checkOutInput').datepicker('setStartDate', nextDate);
            $('#checkOutInput').datepicker('setDate', nextDate);
        });

        $('#checkOutInput').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            todayHighlight: true,
        });


        function handleIndicator(el) {
            items.forEach(item => {
                item.classList.remove('active');
                item.removeAttribute('style');
            });

            indicator.style.width = `${el.offsetWidth}px`;
            indicator.style.left = `${el.offsetLeft}px`;

            el.classList.add('active');
        }

        $(document).on('click', '#fullPayment', function() {
            if ($('#fullPayment').is(':checked')) {
                $("#paymentAmount").prop('disabled', true);
            } else {
                $("#paymentAmount").prop('disabled', false);
            }
        });

        $(document).on('click', '.reservationPaymentBtn', function(e) {
            e.preventDefault();
            var bookingId = $(this).data('bookingid');
            var reservationtab = $(this).data('reservationtab');
            var bdid = $(this).data('bdid');
            var formData = `request_type=reservationPaymentSubmit&bookingId=${bookingId}&bdid=${bdid}`;
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var totalPrice = response.totalPrice;
                var userPay = response.userPay;
                var pendding = numberWithCommas(totalPrice - userPay);
                var html = `
                            <form id="reservationPaymentForm" class="priceSec">
                                <p>Total payment is Rs <strong>${pendding}</strong></p>
                                <input type="hidden" name="bookingId" value="${bdid}"/>
                                <div class="row">
                                    <div class="col-4">
                                        <input name="fullPayment" class="form-check-input" type="checkbox" value="" id="fullPayment" checked="">
                                        <label class="custom-control-label" for="fullPayment">Full payment</label>
                                    </div>
                                    <div class="col-8">
                                        <label for="paymentAmount">Enter Amount</label>
                                        <input name="paymentAmount" disabled class="form-control" type="text" id="paymentAmount" placeholder="Enter payment amount.">
                                    </div>
                                </div>
                            </form>`;

                showModalBox('Get paid', 'Create link', html, 'reservationPaymentLinkSubmitBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();
            });
        });



        $(document).ready(() => {

            // loadAddResorvation('', 'reservation');


            $('#currentDateStart').datepick({
                onSelect: function(dates) {
                    var currentDate = $(this).val();
                    var rTab = $('.reservationTab.active').attr('id');
                    loadResorvation(rTab, '', '', '1', currentDate);
                },
                dateFormat: 'yyyy-mm-dd',
            });

            $(document).on('click', '.reservationTab', function(e) {
                var tag = e.target.tagName.toLowerCase();
                if (tag == 'a') {
                    var tabName = $(this).attr('id');
                    var singleGroupBtn = $(".singleGroupToggleBtn").hasClass("active");
                    var currentDate = $('#currentDateStart').val();
                    handleIndicator(e.target);
                    if (singleGroupBtn == true) {
                        loadResorvation(tabName, '', '', '1', currentDate);
                        reservationCountNavBar(tabName, '', currentDate);
                    } else {
                        loadResorvation(tabName, '', '', '1', currentDate);
                        reservationCountNavBar(tabName, '', currentDate);
                    }
                }

            });

            items.forEach((item, index) => {
                item.addEventListener('click', e => {
                    console.log(e.target);
                    handleIndicator(e.target);
                });
                item.classList.contains('active') && handleIndicator(item);
            });

            $(document).on('click', '.reservationRemoveRateArea', function(e) {
                e.preventDefault();
                var target = $(this).parent().parent();
                target.remove();
                loadReservationPreview();
            });

            $(document).on('click', '#reservationPaymentLinkSubmitBtn', function(e) {
                e.preventDefault();
                var formData = $('#reservationPaymentForm').serialize() + '&request_type=reservationPaymentLinkSubmitBtn';
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var link = response.link;
                    var msg = response.msg;
                    var status = response.status;
                    var paymentId = response.paymentId;
                    var amount = numberWithCommas(response.amount);

                    if (status == 'success') {
                        var title = `Rs ${amount} Payment.`;
                        var html = previewPaymentLink(paymentId, link);
                        customModal(title, html);
                    }

                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }

                });
            });




        });

        $('#excelExport').click(function() {
            var element = document.getElementById('resorvationContent');
            html2pdf(element);
        });

        function hideAddReservation() {
            console.log('clicked');
            $("#loadAddResorvation").html("").hide();
            loadResorvation('all');
        }
    </script>


</body>

</html>