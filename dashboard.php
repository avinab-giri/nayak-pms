<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');


checkLoginAuth();


$hotelData = hotelDetail();
$hotelName = ucfirst($hotelData['hotelName']);
$hotelNum = $hotelData['retrodId'];
$hotelSlug = $hotelData['slug'];

$beLink = $hotelSlug . '.' . DOMAIN;

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>
        <?= $hotelName ?> Dashboard
    </title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container py-2">

            <div class="row mb-2 justify-content-between dashboardHead">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column h-100">
                                <h2 class="font-weight-bolder mb-0">
                                    <?= $hotelName . ' (<span class="pclr">' . $hotelNum . '</span>)' ?>
                                </h2>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 d-flex justify-content-end">
                    <div class="card" style="width: 100%;">
                        <div class="card-body dFlex aic jcc">
                            <div class="homeBtnGroup">
                                <a href="<?= FRONT_SITE . '/reservations' ?>"><button type="button" class="btn bg-gradient-primary mt-2 me-2">Reservation</button></a>
                                <a href="<?= FRONT_SITE . '/stay-view' ?>"><button type="button" class="btn bg-gradient-info mt-2 me-2">Stay View</button></a>
                                <a href="<?= FRONT_SITE . '/pos' ?>"> <button type="button" class="btn bg-gradient-warning mt-2 me-2">POS</button></a>
                                <a href="<?= FRONT_SITE . '/be' ?>"> <button type="button" class="btn bg-gradient-secondary mt-2 me-2">BE</button> </a>
                                <a href="<?= FRONT_SITE . '/wb' ?>"><button type="button" class="btn bg-gradient-success mt-2 me-2">Web Builder</button></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="overviewSec">
                <div class="row">

                    <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                        <div class="card overflow-hidden">
                            <div class="card-body p-3">
                                <a href="<?= FRONT_SITE . '/report/rooms-status' ?>">
                                    <div class="d-flex positionA">
                                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md overviewIcon">
                                            <?= getSysActivityStatusData(2)[0]['svg'] ?>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Check In</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                <?= countCheckIn()['checkin'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="positionA top65f">
                                                <span class="badge badge-dot d-block text-start pb-0 mt-3">
                                                    <i class="bg-gradient-info"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countCheckIn()['checkin'] ?>Check In</span>
                                                </span>
                                                <span class="badge badge-dot d-block text-start">
                                                    <i class="bg-gradient-secondary"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countCheckIn()['pending'] ?> Pendding</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-auto">
                                            <div class="chart ms-auto">
                                                <canvas id="checkInBar" class="chart-canvas" height="150" width="145" style="display: block; box-sizing: border-box; height: 150px; width: 145.9px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                        <div class="card overflow-hidden">
                            <div class="card-body p-3">
                                <a href="<?= FRONT_SITE . '/report/due-out-guests' ?>">
                                    <div class="d-flex positionA">
                                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md overviewIcon">
                                            <?= getSysActivityStatusData(3)[0]['svg'] ?>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Check Out</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                <?= countCheckOut()['checkOut'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="positionA top65f">
                                                <span class="badge badge-dot d-block text-start pb-0 mt-3">
                                                    <i class="bg-gradient-warning"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countCheckOut()['checkOut'] ?> Check Out</span>
                                                </span>
                                                <span class="badge badge-dot d-block text-start">
                                                    <i class="bg-gradient-secondary"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countCheckOut()['pending'] ?> Pendding</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-auto">
                                            <div class="chart ms-auto">
                                                <canvas id="checkOutBar" class="chart-canvas" height="150" width="145" style="display: block; box-sizing: border-box; height: 150px; width: 145.9px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                        <div class="card overflow-hidden">
                            <div class="card-body p-3">
                                <a href="<?= FRONT_SITE . '/report/in-house' ?>">
                                    <div class="d-flex positionA">
                                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md overviewIcon">
                                            <?= getSysActivityStatusData(1)[0]['svg'] ?>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">In House Guest</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                <?= countInHouseAdultNChild()['adult'] + countInHouseAdultNChild()['child'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="positionA top65f">
                                                <span class="badge badge-dot d-block text-start pb-0 mt-3">
                                                    <i class="bg-gradient-success"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countInHouseAdultNChild()['adult'] ?> Adult</span>
                                                </span>
                                                <span class="badge badge-dot d-block text-start">
                                                    <i class="bg-gradient-secondary"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countInHouseAdultNChild()['child'] ?> Child</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-auto">
                                            <div class="chart ms-auto">
                                                <canvas id="guestInHouseBar" class="chart-canvas" height="150" width="145" style="display: block; box-sizing: border-box; height: 150px; width: 145.9px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                        <div class="card overflow-hidden">
                            <div class="card-body p-3">
                                <a href="<?= FRONT_SITE . '/report/rooms-status' ?>">
                                    <div class="d-flex positionA">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md overviewIcon">
                                            <svg><use xlink:href="#roomIcon"></use></svg>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Room Status</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="positionA top65f">
                                                <span class="badge badge-dot d-block text-start pb-0 mt-3">
                                                    <i class="bg-gradient-info"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countRoomStatus()['book'] ?> Booked</span>
                                                </span>
                                                <span class="badge badge-dot d-block text-start pb-0">
                                                    <i class="bg-gradient-danger"></i>
                                                    <span class="clrBlack text-xs font-weight-bold "><?= countRoomStatus()['block'] ?> Blocked</span>
                                                </span>
                                                <span class="badge badge-dot d-block text-start ">
                                                    <i class="bg-gradient-warning"></i>
                                                    <span class="clrBlack text-xs font-weight-bold"><?= countRoomStatus()['vacant'] ?> Vacant</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-auto">
                                            <div class="chart ms-auto">
                                                <canvas id="roomStatusBar" class="chart-canvas" height="150" width="145" style="display: block; box-sizing: border-box; height: 150px; width: 145.9px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div id="natificationSection">
                <div class="row">

                    <div class="col-xl-6 col-md-12 col-sm-12 mb-3">
                        <div id="revenueSec" class="card">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between">
                                    <h4>Overview</h4>
                                    <div class="dropdownSec">
                                        <button class="actionBtn">Today</button>
                                        <ul>
                                            <li><button data-value="today">Today</button></li>
                                            <li><button data-value="week">Week</button></li>
                                            <li><button data-value="month">Month</button></li>
                                            <li><button data-value="year">Year</button></li>
                                            <li><button data-value="alltime">All Time</button></li>
                                        </ul>
                                       <span  class="aroorwbtn" style="position: absolute; right: 10px; font-size:26px;"><i id="aroorwbtn" class='fas fa-angle-down'></i></span>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 mb-2">
                                        <div class="content">
                                            <h6><span id="action"><span class="dummystuf"></span></span> Revenue.</h6>
                                            <div class="d-flex align-items-center">
                                                <div class="icon">
                                                    <svg viewBox="0 0 500 500" width="500" height="500" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;">
                                                        <defs>
                                                            <clipPath id="__lottie_element_1942">
                                                                <rect width="500" height="500" x="0" y="0"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <g clip-path="url(#__lottie_element_1942)">
                                                            <g clip-path="url(#__lottie_element_1945)" transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                                                <g class="primary design" transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                                                    <g opacity="1" transform="matrix(1,0,0,1,249.9980010986328,422.31298828125)">
                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M171.9149932861328,-15.215999603271484 C171.9149932861328,-15.215999603271484 -171.8350067138672,-16.083999633789062 -171.8350067138672,-16.083999633789062 C-180.4739990234375,-16.086000442504883 -187.5030059814453,-9.116999626159668 -187.52499389648438,-0.4740000069141388 C-187.54600524902344,8.168999671936035 -180.55799865722656,15.194000244140625 -171.91400146484375,15.215999603271484 C-171.91400146484375,15.215999603271484 171.8350067138672,16.083999633789062 171.8350067138672,16.083999633789062 C171.8489990234375,16.083999633789062 171.86099243164062,16.083999633789062 171.875,16.083999633789062 C180.49899291992188,16.083999633789062 187.5030059814453,9.102999687194824 187.52499389648438,0.4740000069141388 C187.54600524902344,-8.168999671936035 180.55799865722656,-15.194000244140625 171.9149932861328,-15.215999603271484z">
                                                                        </path>
                                                                    </g>
                                                                    <g opacity="1" transform="matrix(1,0,0,1,249.9980010986328,359.3789978027344)">
                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M171.875,-15.649999618530273 C171.875,-15.649999618530273 -171.875,-15.649999618530273 -171.875,-15.649999618530273 C-180.5189971923828,-15.649999618530273 -187.52499389648438,-8.642999649047852 -187.52499389648438,0 C-187.52499389648438,8.642999649047852 -180.5189971923828,15.649999618530273 -171.875,15.649999618530273 C-171.875,15.649999618530273 171.875,15.649999618530273 171.875,15.649999618530273 C180.5189971923828,15.649999618530273 187.52499389648438,8.642999649047852 187.52499389648438,0 C187.52499389648438,-8.642999649047852 180.5189971923828,-15.649999618530273 171.875,-15.649999618530273z">
                                                                        </path>
                                                                    </g>
                                                                    <g opacity="1" transform="matrix(1,0,0,1,249.9980010986328,187.4980010986328)">
                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-62.525001525878906 C-34.47700119018555,-62.525001525878906 -62.525001525878906,-34.47700119018555 -62.525001525878906,0 C-62.525001525878906,34.47700119018555 -34.47700119018555,62.525001525878906 0,62.525001525878906 C34.47700119018555,62.525001525878906 62.525001525878906,34.47700119018555 62.525001525878906,0 C62.525001525878906,-34.47700119018555 34.47700119018555,-62.525001525878906 0,-62.525001525878906z M0,31.225000381469727 C-17.218000411987305,31.225000381469727 -31.225000381469727,17.218000411987305 -31.225000381469727,0 C-31.225000381469727,-17.216999053955078 -17.218000411987305,-31.225000381469727 0,-31.225000381469727 C17.218000411987305,-31.225000381469727 31.225000381469727,-17.216999053955078 31.225000381469727,0 C31.225000381469727,17.218000411987305 17.218000411987305,31.225000381469727 0,31.225000381469727z">
                                                                        </path>
                                                                    </g>
                                                                    <g opacity="1" transform="matrix(1,0,0,1,249.9980010986328,187.4980010986328)">
                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M171.875,-125.0250015258789 C171.875,-125.0250015258789 140.625,-125.0250015258789 140.625,-125.0250015258789 C140.6219940185547,-125.0250015258789 140.6179962158203,-125.02400207519531 140.61500549316406,-125.02400207519531 C140.61500549316406,-125.02400207519531 -140.61500549316406,-125.02400207519531 -140.61500549316406,-125.02400207519531 C-140.6179962158203,-125.02400207519531 -140.6219940185547,-125.0250015258789 -140.625,-125.0250015258789 C-140.625,-125.0250015258789 -171.875,-125.0250015258789 -171.875,-125.0250015258789 C-180.5189971923828,-125.0250015258789 -187.52499389648438,-118.01799774169922 -187.52499389648438,-109.375 C-187.52499389648438,-109.375 -187.52499389648438,-109.375 -187.52499389648438,-109.375 C-187.52499389648438,-109.375 -187.52499389648438,-78.125 -187.52499389648438,-78.125 C-187.52499389648438,-78.125 -187.52499389648438,78.125 -187.52499389648438,78.125 C-187.52499389648438,78.125 -187.52499389648438,109.375 -187.52499389648438,109.375 C-187.52499389648438,109.375 -187.52499389648438,109.375 -187.52499389648438,109.375 C-187.52499389648438,118.01799774169922 -180.5189971923828,125.0250015258789 -171.875,125.0250015258789 C-171.875,125.0250015258789 171.875,125.0250015258789 171.875,125.0250015258789 C180.5189971923828,125.0250015258789 187.52499389648438,118.01799774169922 187.52499389648438,109.375 C187.52499389648438,109.375 187.52499389648438,109.375 187.52499389648438,109.375 C187.52499389648438,109.375 187.52499389648438,78.125 187.52499389648438,78.125 C187.52499389648438,78.125 187.52499389648438,-78.125 187.52499389648438,-78.125 C187.52499389648438,-78.125 187.52499389648438,-109.375 187.52499389648438,-109.375 C187.52499389648438,-109.375 187.52499389648438,-109.375 187.52499389648438,-109.375 C187.52499389648438,-118.01799774169922 180.5189971923828,-125.0250015258789 171.875,-125.0250015258789z M-126.55000305175781,93.7249984741211 C-130.5540008544922,79.375 -141.875,68.05500030517578 -156.22500610351562,64.05000305175781 C-156.22500610351562,64.05000305175781 -156.22500610351562,-65.16999816894531 -156.22500610351562,-65.16999816894531 C-142.93600463867188,-69.88899993896484 -132.38900756835938,-80.43599700927734 -127.66999816894531,-93.7249984741211 C-127.66999816894531,-93.7249984741211 126.55000305175781,-93.7249984741211 126.55000305175781,-93.7249984741211 C130.5540008544922,-79.375 141.875,-68.05400085449219 156.22500610351562,-64.05000305175781 C156.22500610351562,-64.05000305175781 156.22500610351562,64.05000305175781 156.22500610351562,64.05000305175781 C141.875,68.05400085449219 130.5540008544922,79.375 126.55000305175781,93.7249984741211 C126.55000305175781,93.7249984741211 -126.55000305175781,93.7249984741211 -126.55000305175781,93.7249984741211z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>

                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="textArea">
                                                    <h2 id="totalRev"><span class="dummystuf"></span></h2>
                                                    <h4>Booking:- <span id="tatalBook"><span class="dummystuf"></span></h4>
                                                </div>
                                            </div>
                                            <div class="perDayRevenueList">
                                                <ul>
                                                    <li class="dummystuf">
                                                        <h4></h4>
                                                        <p></p>
                                                    </li>
                                                    <li class="dummystuf">
                                                        <h4></h4>
                                                        <p></p>
                                                    </li>
                                                    <li class="dummystuf">
                                                        <h4></h4>
                                                        <p></p>
                                                    </li>
                                                    <li class="dummystuf">
                                                        <h4></h4>
                                                        <p></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <a href="<?= FRONT_SITE . '/reservations' ?>">
                                                    <div class="content borderCon">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="smallIcon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500" width="500" height="500" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;">
                                                                    <defs>
                                                                        <clipPath id="__lottie_element_1869">
                                                                            <rect width="500" height="500" x="0" y="0"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                    <g clip-path="url(#__lottie_element_1869)">
                                                                        <g clip-path="url(#__lottie_element_1876)" transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                                                            <g class="primary design" transform="matrix(20.829999923706055,0,0,20.829999923706055,-4957.498046875,-4957.498046875)" opacity="1" style="display: block;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,249.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M7.25,-7.5 C7.25,-7.5 4.75,-7.5 4.75,-7.5 C4.75,-7.5 4.75,-8.75 4.75,-8.75 C4.75,-9.15999984741211 4.409999847412109,-9.5 4,-9.5 C3.5899999141693115,-9.5 3.25,-9.15999984741211 3.25,-8.75 C3.25,-8.75 3.25,-7.5 3.25,-7.5 C3.25,-7.5 -3.25,-7.5 -3.25,-7.5 C-3.25,-7.5 -3.25,-8.75 -3.25,-8.75 C-3.25,-9.15999984741211 -3.5899999141693115,-9.5 -4,-9.5 C-4.409999847412109,-9.5 -4.75,-9.15999984741211 -4.75,-8.75 C-4.75,-8.75 -4.75,-7.5 -4.75,-7.5 C-4.75,-7.5 -7.25,-7.5 -7.25,-7.5 C-8.210000038146973,-7.5 -9,-6.710000038146973 -9,-5.75 C-9,-5.75 -9,7.75 -9,7.75 C-9,8.710000038146973 -8.210000038146973,9.5 -7.25,9.5 C-7.25,9.5 7.25,9.5 7.25,9.5 C8.210000038146973,9.5 9,8.710000038146973 9,7.75 C9,7.75 9,-5.75 9,-5.75 C9,-6.710000038146973 8.210000038146973,-7.5 7.25,-7.5z M-7.25,-6 C-7.25,-6 7.25,-6 7.25,-6 C7.389999866485596,-6 7.5,-5.889999866485596 7.5,-5.75 C7.5,-5.75 7.5,-3.5 7.5,-3.5 C7.5,-3.5 -7.5,-3.5 -7.5,-3.5 C-7.5,-3.5 -7.5,-5.75 -7.5,-5.75 C-7.5,-5.889999866485596 -7.389999866485596,-6 -7.25,-6z M7.25,8 C7.25,8 -7.25,8 -7.25,8 C-7.389999866485596,8 -7.5,7.889999866485596 -7.5,7.75 C-7.5,7.75 -7.5,-2 -7.5,-2 C-7.5,-2 7.5,-2 7.5,-2 C7.5,-2 7.5,7.75 7.5,7.75 C7.5,7.889999866485596 7.389999866485596,8 7.25,8z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,246.0050048828125,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.004999999888241291,-1 C-0.5550000071525574,-1 -1.0049999952316284,-0.550000011920929 -1.0049999952316284,0 C-1.0049999952316284,0.550000011920929 -0.5550000071525574,1 -0.004999999888241291,1 C-0.004999999888241291,1 0.004999999888241291,1 0.004999999888241291,1 C0.5550000071525574,1 1.0049999952316284,0.550000011920929 1.0049999952316284,0 C0.9950000047683716,-0.550000011920929 0.5450000166893005,-1 -0.004999999888241291,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.5600000023841858,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,254,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.550000011920929,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,246.0050048828125,254.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.004999999888241291,-1 C-0.5550000071525574,-1 -1.0049999952316284,-0.550000011920929 -1.0049999952316284,0 C-1.0049999952316284,0.550000011920929 -0.5550000071525574,1 -0.004999999888241291,1 C-0.004999999888241291,1 0.004999999888241291,1 0.004999999888241291,1 C0.5550000071525574,1 1.0049999952316284,0.550000011920929 1.0049999952316284,0 C0.9950000047683716,-0.550000011920929 0.5450000166893005,-1 -0.004999999888241291,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,254.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.5600000023841858,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,0,3.592987060546875)" opacity="1" style="display: none;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,260.45001220703125)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M-171.7519989013672,-78.12300109863281 C-171.7519989013672,-78.12300109863281 -171.77099609375,-45.007999420166016 -171.77999877929688,-21.917856216430664 C-171.81199645996094,56.673641204833984 -176.88185119628906,134.0803985595703 -176.88185119628906,134.0803985595703 C-178.9332733154297,147.5658416748047 -167.2821044921875,154.9154052734375 -155.4407501220703,154.9154052734375 C-155.4407501220703,154.9154052734375 155.43893432617188,154.9154052734375 155.43893432617188,154.9154052734375 C167.28228759765625,154.9154052734375 178.92672729492188,149.6107177734375 176.88185119628906,134.0803985595703 C176.88185119628906,134.0803985595703 171.93899536132812,58.530765533447266 171.9709930419922,-19.1313533782959 C171.9810028076172,-43.15005874633789 172,-78.12300109863281 172,-78.12300109863281 C172,-78.12300109863281 -171.7519989013672,-78.12300109863281 -171.7519989013672,-78.12300109863281z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,182.29400634765625)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M171.7519989013672,-0.37599998712539673 C171.7519989013672,-0.37599998712539673 171.8350067138672,-62.62300109863281 171.8350067138672,-62.62300109863281 C171.8350067138672,-74.13099670410156 162.5070037841797,-83.45899963378906 150.99899291992188,-83.45899963378906 C150.99899291992188,-83.45899963378906 -151.08200073242188,-83.45899963378906 -151.08200073242188,-83.45899963378906 C-162.58799743652344,-83.45899963378906 -171.91700744628906,-74.13099670410156 -171.91700744628906,-62.62300109863281 C-171.91700744628906,-62.62300109863281 -172,-0.12600000202655792 -172,-0.12600000202655792">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,166.7740020751953,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.9184366464614868,0 C-0.9184366464614868,0 -1.1264365911483765,0 -1.1264365911483765,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.9184366464614868,0 C-0.9184366464614868,0 -1.1264365911483765,0 -1.1264365911483765,0">
                                                                                        </path>
                                                                                    </g>
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.10400000214576721,0 C-0.10400000214576721,0 0.10400000214576721,0 0.10400000214576721,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.10400000214576721,0 C-0.10400000214576721,0 0.10400000214576721,0 0.10400000214576721,0">
                                                                                        </path>
                                                                                    </g>
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,333.2330017089844,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0.9184366464614868,0 C0.9184366464614868,0 1.1264365911483765,0 1.1264365911483765,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M0.9184366464614868,0 C0.9184366464614868,0 1.1264365911483765,0 1.1264365911483765,0">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,166.7740020751953,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-2.9633097648620605,-1.0224366188049316 C-2.9633097648620605,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-2.9633097648620605,-1.0224366188049316 C-2.9633097648620605,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.10400000214576721,-1.0224366188049316 C-0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.10400000214576721,-1.0224366188049316 C-0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="0" transform="matrix(1,0,0,1,250.00399780273438,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.3540000021457672,0 C-0.3540000021457672,0 83.35399627685547,0 83.35399627685547,0">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.3540000021457672,0 C-0.3540000021457672,0 83.35399627685547,0 83.35399627685547,0">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,0,3.592987060546875)" opacity="1" style="display: none;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,166.6699981689453,78.1259994506836)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M0,-20.83300018310547 C0,-20.83300018310547 0,20.83300018310547 0,20.83300018310547"></path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,333.3370056152344,78.1259994506836)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M0,-20.83300018310547 C0,-20.83300018310547 0,20.83300018310547 0,20.83300018310547"></path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,250,507.2618408203125)" opacity="1" style="display: none;">
                                                                                <path fill="rgb(18,19,49)" fill-opacity="1" d=" M169.5,-111 C169.5,-111 169.5,-111 169.5,-111 C169.5,-110.72 169.28,-110.5 169,-110.5 C169,-110.5 -171,-110.5 -171,-110.5 C-171.28,-110.5 -171.5,-110.72 -171.5,-111 C-171.5,-111 -171.5,-111 -171.5,-111 C-171.5,-111.28 -171.28,-111.5 -171,-111.5 C-171,-111.5 169,-111.5 169,-111.5 C169.28,-111.5 169.5,-111.28 169.5,-111z">
                                                                                </path>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,-1,-111)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M170.5,0 C170.5,0 170.5,0 170.5,0 C170.5,0.27595001459121704 170.2759552001953,0.5 170,0.5 C170,0.5 -170,0.5 -170,0.5 C-170.2759552001953,0.5 -170.5,0.27595001459121704 -170.5,0 C-170.5,0 -170.5,0 -170.5,0 C-170.5,-0.27595001459121704 -170.2759552001953,-0.5 -170,-0.5 C-170,-0.5 170,-0.5 170,-0.5 C170.2759552001953,-0.5 170.5,-0.27595001459121704 170.5,0z">
                                                                                    </path>
                                                                                    <path stroke-linecap="butt" stroke-linejoin="miter" fill-opacity="0" stroke-miterlimit="4" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="32" d=" M170.5,0 C170.5,0 170.5,0 170.5,0 C170.5,0.27595001459121704 170.2759552001953,0.5 170,0.5 C170,0.5 -170,0.5 -170,0.5 C-170.2759552001953,0.5 -170.5,0.27595001459121704 -170.5,0 C-170.5,0 -170.5,0 -170.5,0 C-170.5,-0.27595001459121704 -170.2759552001953,-0.5 -170,-0.5 C-170,-0.5 170,-0.5 170,-0.5 C170.2759552001953,-0.5 170.5,-0.27595001459121704 170.5,0z">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <h4>Nights</h4>
                                                        </div>
                                                        <h5 id="nightDisplay"><span class="dummystuf"></span></h5>
                                                    </div>
                                                </a>
                                            </div> 
                                            <div class="col-12 mb-3">
                                                <a href="<?= FRONT_SITE . '/guest' ?>">
                                                    <div class="content borderCon">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="smallIcon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500" width="500" height="500" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;">
                                                                    <defs>
                                                                        <clipPath id="__lottie_element_1869">
                                                                            <rect width="500" height="500" x="0" y="0"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                    <g clip-path="url(#__lottie_element_1869)">
                                                                        <g clip-path="url(#__lottie_element_1876)" transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                                                            <g class="primary design" transform="matrix(20.829999923706055,0,0,20.829999923706055,-4957.498046875,-4957.498046875)" opacity="1" style="display: block;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,249.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M7.25,-7.5 C7.25,-7.5 4.75,-7.5 4.75,-7.5 C4.75,-7.5 4.75,-8.75 4.75,-8.75 C4.75,-9.15999984741211 4.409999847412109,-9.5 4,-9.5 C3.5899999141693115,-9.5 3.25,-9.15999984741211 3.25,-8.75 C3.25,-8.75 3.25,-7.5 3.25,-7.5 C3.25,-7.5 -3.25,-7.5 -3.25,-7.5 C-3.25,-7.5 -3.25,-8.75 -3.25,-8.75 C-3.25,-9.15999984741211 -3.5899999141693115,-9.5 -4,-9.5 C-4.409999847412109,-9.5 -4.75,-9.15999984741211 -4.75,-8.75 C-4.75,-8.75 -4.75,-7.5 -4.75,-7.5 C-4.75,-7.5 -7.25,-7.5 -7.25,-7.5 C-8.210000038146973,-7.5 -9,-6.710000038146973 -9,-5.75 C-9,-5.75 -9,7.75 -9,7.75 C-9,8.710000038146973 -8.210000038146973,9.5 -7.25,9.5 C-7.25,9.5 7.25,9.5 7.25,9.5 C8.210000038146973,9.5 9,8.710000038146973 9,7.75 C9,7.75 9,-5.75 9,-5.75 C9,-6.710000038146973 8.210000038146973,-7.5 7.25,-7.5z M-7.25,-6 C-7.25,-6 7.25,-6 7.25,-6 C7.389999866485596,-6 7.5,-5.889999866485596 7.5,-5.75 C7.5,-5.75 7.5,-3.5 7.5,-3.5 C7.5,-3.5 -7.5,-3.5 -7.5,-3.5 C-7.5,-3.5 -7.5,-5.75 -7.5,-5.75 C-7.5,-5.889999866485596 -7.389999866485596,-6 -7.25,-6z M7.25,8 C7.25,8 -7.25,8 -7.25,8 C-7.389999866485596,8 -7.5,7.889999866485596 -7.5,7.75 C-7.5,7.75 -7.5,-2 -7.5,-2 C-7.5,-2 7.5,-2 7.5,-2 C7.5,-2 7.5,7.75 7.5,7.75 C7.5,7.889999866485596 7.389999866485596,8 7.25,8z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,246.0050048828125,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.004999999888241291,-1 C-0.5550000071525574,-1 -1.0049999952316284,-0.550000011920929 -1.0049999952316284,0 C-1.0049999952316284,0.550000011920929 -0.5550000071525574,1 -0.004999999888241291,1 C-0.004999999888241291,1 0.004999999888241291,1 0.004999999888241291,1 C0.5550000071525574,1 1.0049999952316284,0.550000011920929 1.0049999952316284,0 C0.9950000047683716,-0.550000011920929 0.5450000166893005,-1 -0.004999999888241291,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.5600000023841858,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,254,251)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.550000011920929,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,246.0050048828125,254.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.004999999888241291,-1 C-0.5550000071525574,-1 -1.0049999952316284,-0.550000011920929 -1.0049999952316284,0 C-1.0049999952316284,0.550000011920929 -0.5550000071525574,1 -0.004999999888241291,1 C-0.004999999888241291,1 0.004999999888241291,1 0.004999999888241291,1 C0.5550000071525574,1 1.0049999952316284,0.550000011920929 1.0049999952316284,0 C0.9950000047683716,-0.550000011920929 0.5450000166893005,-1 -0.004999999888241291,-1z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250,254.5)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0,-1 C0,-1 0,-1 0,-1 C-0.5600000023841858,-1 -1,-0.550000011920929 -1,0 C-1,0.550000011920929 -0.550000011920929,1 0,1 C0.550000011920929,1 1,0.550000011920929 1,0 C1,-0.550000011920929 0.5600000023841858,-1 0,-1z">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,0,3.592987060546875)" opacity="1" style="display: none;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,260.45001220703125)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M-171.7519989013672,-78.12300109863281 C-171.7519989013672,-78.12300109863281 -171.77099609375,-45.007999420166016 -171.77999877929688,-21.917856216430664 C-171.81199645996094,56.673641204833984 -176.88185119628906,134.0803985595703 -176.88185119628906,134.0803985595703 C-178.9332733154297,147.5658416748047 -167.2821044921875,154.9154052734375 -155.4407501220703,154.9154052734375 C-155.4407501220703,154.9154052734375 155.43893432617188,154.9154052734375 155.43893432617188,154.9154052734375 C167.28228759765625,154.9154052734375 178.92672729492188,149.6107177734375 176.88185119628906,134.0803985595703 C176.88185119628906,134.0803985595703 171.93899536132812,58.530765533447266 171.9709930419922,-19.1313533782959 C171.9810028076172,-43.15005874633789 172,-78.12300109863281 172,-78.12300109863281 C172,-78.12300109863281 -171.7519989013672,-78.12300109863281 -171.7519989013672,-78.12300109863281z">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,182.29400634765625)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M171.7519989013672,-0.37599998712539673 C171.7519989013672,-0.37599998712539673 171.8350067138672,-62.62300109863281 171.8350067138672,-62.62300109863281 C171.8350067138672,-74.13099670410156 162.5070037841797,-83.45899963378906 150.99899291992188,-83.45899963378906 C150.99899291992188,-83.45899963378906 -151.08200073242188,-83.45899963378906 -151.08200073242188,-83.45899963378906 C-162.58799743652344,-83.45899963378906 -171.91700744628906,-74.13099670410156 -171.91700744628906,-62.62300109863281 C-171.91700744628906,-62.62300109863281 -172,-0.12600000202655792 -172,-0.12600000202655792">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,166.7740020751953,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.9184366464614868,0 C-0.9184366464614868,0 -1.1264365911483765,0 -1.1264365911483765,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.9184366464614868,0 C-0.9184366464614868,0 -1.1264365911483765,0 -1.1264365911483765,0">
                                                                                        </path>
                                                                                    </g>
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.10400000214576721,0 C-0.10400000214576721,0 0.10400000214576721,0 0.10400000214576721,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.10400000214576721,0 C-0.10400000214576721,0 0.10400000214576721,0 0.10400000214576721,0">
                                                                                        </path>
                                                                                    </g>
                                                                                    <g opacity="1" transform="matrix(1,0,0,1,333.2330017089844,270.83599853515625)">
                                                                                        <path fill="rgb(18,19,49)" fill-opacity="1" d=" M0.9184366464614868,0 C0.9184366464614868,0 1.1264365911483765,0 1.1264365911483765,0">
                                                                                        </path>
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M0.9184366464614868,0 C0.9184366464614868,0 1.1264365911483765,0 1.1264365911483765,0">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,166.7740020751953,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-2.9633097648620605,-1.0224366188049316 C-2.9633097648620605,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-2.9633097648620605,-1.0224366188049316 C-2.9633097648620605,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316 -3.1713099479675293,-1.0224366188049316">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,250.00399780273438,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.10400000214576721,-1.0224366188049316 C-0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.10400000214576721,-1.0224366188049316 C-0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316 0.10400000214576721,-1.0224366188049316">
                                                                                    </path>
                                                                                </g>
                                                                                <g opacity="0" transform="matrix(1,0,0,1,250.00399780273438,343.86199951171875)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M-0.3540000021457672,0 C-0.3540000021457672,0 83.35399627685547,0 83.35399627685547,0">
                                                                                    </path>
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="41.73" d=" M-0.3540000021457672,0 C-0.3540000021457672,0 83.35399627685547,0 83.35399627685547,0">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,0,3.592987060546875)" opacity="1" style="display: none;">
                                                                                <g opacity="1" transform="matrix(1,0,0,1,166.6699981689453,78.1259994506836)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M0,-20.83300018310547 C0,-20.83300018310547 0,20.83300018310547 0,20.83300018310547"></path>
                                                                                </g>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,333.3370056152344,78.1259994506836)">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="31.3" d=" M0,-20.83300018310547 C0,-20.83300018310547 0,20.83300018310547 0,20.83300018310547"></path>
                                                                                </g>
                                                                            </g>
                                                                            <g class="primary design" transform="matrix(1,0,0,1,250,507.2618408203125)" opacity="1" style="display: none;">
                                                                                <path fill="rgb(18,19,49)" fill-opacity="1" d=" M169.5,-111 C169.5,-111 169.5,-111 169.5,-111 C169.5,-110.72 169.28,-110.5 169,-110.5 C169,-110.5 -171,-110.5 -171,-110.5 C-171.28,-110.5 -171.5,-110.72 -171.5,-111 C-171.5,-111 -171.5,-111 -171.5,-111 C-171.5,-111.28 -171.28,-111.5 -171,-111.5 C-171,-111.5 169,-111.5 169,-111.5 C169.28,-111.5 169.5,-111.28 169.5,-111z">
                                                                                </path>
                                                                                <g opacity="1" transform="matrix(1,0,0,1,-1,-111)">
                                                                                    <path fill="rgb(18,19,49)" fill-opacity="1" d=" M170.5,0 C170.5,0 170.5,0 170.5,0 C170.5,0.27595001459121704 170.2759552001953,0.5 170,0.5 C170,0.5 -170,0.5 -170,0.5 C-170.2759552001953,0.5 -170.5,0.27595001459121704 -170.5,0 C-170.5,0 -170.5,0 -170.5,0 C-170.5,-0.27595001459121704 -170.2759552001953,-0.5 -170,-0.5 C-170,-0.5 170,-0.5 170,-0.5 C170.2759552001953,-0.5 170.5,-0.27595001459121704 170.5,0z">
                                                                                    </path>
                                                                                    <path stroke-linecap="butt" stroke-linejoin="miter" fill-opacity="0" stroke-miterlimit="4" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="32" d=" M170.5,0 C170.5,0 170.5,0 170.5,0 C170.5,0.27595001459121704 170.2759552001953,0.5 170,0.5 C170,0.5 -170,0.5 -170,0.5 C-170.2759552001953,0.5 -170.5,0.27595001459121704 -170.5,0 C-170.5,0 -170.5,0 -170.5,0 C-170.5,-0.27595001459121704 -170.2759552001953,-0.5 -170,-0.5 C-170,-0.5 170,-0.5 170,-0.5 C170.2759552001953,-0.5 170.5,-0.27595001459121704 170.5,0z">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <h4>Guest</h4>
                                                        </div>
                                                        <h5 id="guestDisplay"><span class="dummystuf"></span></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-3">
                                <div class="d-flex align-items-center">
                                    <div class="leftSide col-8 d-flex align-items-center justify-content-evenly">
                                        <div class="monthbyRev dFlex aic jcse">
                                            <div class="content dummystuf">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                            <div class="content dummystuf">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rightSide col-4 d-flex align-items-center justify-content-evenly">
                                        <!-- <a href="<?= FRONT_SITE . '/expense' ?>">
                                            <div class="content">
                                                <h4>Expenses</h4>
                                                <p id="totalExpens"><span class="dummystuf"></span></p>
                                            </div>
                                        </a> -->
                                        <a href="<?= FRONT_SITE . '/pos' ?>">
                                            <div class="content">
                                                <h4>POS</h4>
                                                <p id="totalKotExpense"><span class="dummystuf"></span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12 col-sm-12 mb-3">
                        <div id="activitySec" class="card" style="overflow: hidden;">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between">
                                    <a class="dFlex aic wAuto" href="<?= FRONT_SITE . '/activity' ?>">
                                        <h4 class="mr8">Activity Feeds</h4> <svg class="icon">
                                            <use href="#lunchIcon"></use>
                                        </svg>
                                    </a>
                                    <div class="dFlex aic wAuto">
                                        <button id="reloadActiveFeed"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500" width="500" height="500" preserveAspectRatio="xMidYMid meet" style="width: 35px; height: 35px; transform: translate3d(0px, 0px, 0px); content-visibility: visible;">
                                                <defs>
                                                    <clipPath id="__lottie_element_11761">
                                                        <rect width="500" height="500" x="0" y="0"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#__lottie_element_11761)">
                                                    <g transform="matrix(-4,0,0,-4,250,250)" opacity="1" style="display: block;">
                                                        <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                            <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="3.15" d=" M-36.54399871826172,16.277999877929688 C-38.76499938964844,11.303999900817871 -40,5.795000076293945 -40,0 C-40,-22.076000213623047 -22.076000213623047,-40 0,-40 C0,-40 0,-40 0,-40 C11.788000106811523,-40 22.391000747680664,-34.88999938964844 29.71500015258789,-26.766000747680664"></path>
                                                        </g>
                                                    </g>
                                                    <g transform="matrix(0,4.1276397705078125,-3.946239948272705,0,214.2352294921875,414.84967041015625)" opacity="1" style="display: block;">
                                                        <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                            <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(18,19,49)" stroke-opacity="1" stroke-width="3.15" d=" M-16.437999725341797,11.713000297546387 C-16.437999725341797,11.713000297546387 -16.437999725341797,23.5 -16.437999725341797,23.5 C-16.437999725341797,23.5 -4.688000202178955,23.5 -4.688000202178955,23.5"></path>
                                                        </g>
                                                    </g>
                                                    <g transform="matrix(4,0,0,4,250,250)" opacity="1" style="display: block;">
                                                        <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                            <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(8,168,138)" stroke-opacity="1" stroke-width="3.15" d=" M-36.54399871826172,16.277999877929688 C-38.76499938964844,11.303999900817871 -40,5.795000076293945 -40,0 C-40,-22.076000213623047 -22.076000213623047,-40 0,-40 C0,-40 0,-40 0,-40 C11.788000106811523,-40 22.391000747680664,-34.88999938964844 29.71500015258789,-26.766000747680664"></path>
                                                        </g>
                                                    </g>
                                                    <g transform="matrix(0,-4.074480056762695,3.9616000652313232,0,285.90399169921875,87.27342224121094)" opacity="1" style="display: block;">
                                                        <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                                                            <path stroke-linecap="round" stroke-linejoin="round" fill-opacity="0" stroke="rgb(8,168,138)" stroke-opacity="1" stroke-width="3.15" d=" M-16.437999725341797,11.713000297546387 C-16.437999725341797,11.713000297546387 -16.437999725341797,23.5 -16.437999725341797,23.5 C-16.437999725341797,23.5 -4.688000202178955,23.5 -4.688000202178955,23.5"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></button>
                                        <div class="dropdownSec">
                                            <button>All</button>
                                            <ul>
                                                <li><button data-value="newBooking">New Booking</button></li>
                                                <li><button data-value="modificatio">Modification</button></li>
                                                <li><button data-value="cancellation">Cancellation</button></li>
                                                <li><button data-value="userAction">User Action</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body scrollBar">
                                <ul>
                                    <li class="dummystuf">
                                        <div class="d-flex align-item-center">
                                            <div class="leftSide">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                            <div class="rightSide"><a class="checkin" href="#"></a></div>
                                        </div>
                                    </li>
                                    <li class="dummystuf">
                                        <div class="d-flex align-item-center">
                                            <div class="leftSide">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                            <div class="rightSide"><a class="newBook" href="#"></a></div>
                                        </div>
                                    </li>
                                    <li class="dummystuf">
                                        <div class="d-flex align-item-center">
                                            <div class="leftSide">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                            <div class="rightSide"><a class="checkin" href="#"></a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row mt-4">

                <div class="col-xl-6 col-md-12 col-sm-12 mb-3">
                    <div class="card z-index-2 stayViewReport">
                        <div class="card-header px-3 py-2" style="border-bottom: 1px solid #e9e9e9;">
                            <div class="dFlex jcsb aic">
                                <h6 class="mb0">
                                    <a class="dFlex aic wAuto" href="<?= FRONT_SITE . '/stay-view' ?>">
                                        <h4 class="mr8">Occupancy Forecast</h4> <svg class="icon">
                                            <use href="#lunchIcon"></use>
                                        </svg>
                                    </a>
                                </h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="loadOccupancyForecastReport" class="scrolableTable"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header px-3 py-2">
                            <div class="dFlex jcsb aic">
                                <h6>Monthly Revenue overview</h6>
                                <div class="actionBtn">
                                    <div class="perDayLeftArrow leftArrow" data-cdate="<?= date('Y-m-d') ?>" data-pdate="<?= date('Y-m-d', strtotime(date('Y-m-d') . ' -1 months')) ?>">
                                        <i class="bi bi-arrow-left"></i>
                                        <svg class="circleSvg" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <ellipse class="background" ry="15" rx="15" cy="17.5" cx="17.5" stroke-width="1" />
                                                <ellipse class="foreground" ry="15" rx="15" cy="17.5" cx="17.5" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="perDayRightArrow rightArrow disable">
                                        <i class="bi bi-arrow-right"></i>
                                        <svg class="circleSvg" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <ellipse class="background" ry="15" rx="15" cy="17.5" cx="17.5" stroke-width="1" />
                                                <ellipse class="foreground" ry="15" rx="15" cy="17.5" cx="17.5" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
                                </div>
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


    // if(checkBEStatus('e5740') == 'Improper'){
    //     echo '<script> configurationForm(); </script>';
    // }


    ?>
    <script>
        $('.linkBtn').removeClass('active');
        $('.homeLink').addClass('active');
        var checkInBarChart = document.getElementById("checkInBar").getContext("2d");

        new Chart(checkInBarChart, {
            type: "doughnut",
            data: {
                labels: ['Check In', 'Pendding'],
                datasets: [{
                    label: "Projects",
                    weight: 9,
                    cutout: 50,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ['#2152ff', '#a8b8d8'],
                    data: [<?= countCheckIn()['checkin'] ?>, <?= (countCheckIn()['pending'] == 0 && countCheckIn()['checkin'] == 0) ? 1 : countCheckIn()['pending'] ?>],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });

        var checkOutBarChart = document.getElementById("checkOutBar").getContext("2d");

        new Chart(checkOutBarChart, {
            type: "doughnut",
            data: {
                labels: ['Check Out', 'Pendding'],
                datasets: [{
                    label: "Projects",
                    weight: 9,
                    cutout: 50,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ['#fd7e14', '#a8b8d8'],
                    data: [<?= countCheckOut()['checkOut'] ?>, <?= (countCheckOut()['pending'] == 0 && countCheckOut()['checkOut'] == 0) ? '1' : countCheckOut()['pending'] ?>],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });

        var guestInHouseBarChart = document.getElementById("guestInHouseBar").getContext("2d");

        new Chart(guestInHouseBarChart, {
            type: "doughnut",
            data: {
                labels: ['Adult', 'Child'],
                datasets: [{
                    label: "Guest In House",
                    weight: 9,
                    cutout: 50,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ['#17ad37', '#a8b8d8'],
                    data: [<?= countInHouseAdultNChild()['adult'] ?>, <?= (countInHouseAdultNChild()['child'] == 0 && countInHouseAdultNChild()['adult'] == 0) ? 1 : countInHouseAdultNChild()['child'] ?>],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });

        var roomStatusBarChart = document.getElementById("roomStatusBar").getContext("2d");

        new Chart(roomStatusBarChart, {
            type: "doughnut",
            data: {
                labels: ['Booked', 'Blocked', 'Vacant'],
                datasets: [{
                    label: "Room Status",
                    weight: 9,
                    cutout: 50,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ['#2152ff', '#e13f33', '#f0b505'],
                    data: [<?= countRoomStatus()['book'] ?>, <?= countRoomStatus()['block'] ?>, <?= countRoomStatus()['vacant'] ?>],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });


        function loadRevenueOverviewSec($action = '') {
            var act = $action;
            var action = $('#action');
            var totalRev = $('#totalRev');
            var tatalBook = $('#tatalBook');
            var nightDisplay = $('#nightDisplay');
            var kotRevDisplay = $('#kotRevDisplay');
            var guestDisplay = $('#guestDisplay');
            var visiterDisplay = $('#visiterDisplay');
            var totalExpens = $('#totalExpens');
            var totalKotExpense = $('#totalKotExpense');
            var perDayRevenueList = $('.perDayRevenueList ul');
            var monthbyRevList = $('.monthbyRev');

            var demoCon = '<span class="dummystuf"></span>';

            action.html(demoCon);
            totalRev.html(demoCon);
            tatalBook.html(demoCon);
            nightDisplay.html(demoCon);
            kotRevDisplay.html(demoCon);
            guestDisplay.html(demoCon);
            visiterDisplay.html(demoCon);
            totalExpens.html(demoCon);
            totalKotExpense.html(demoCon);
            perDayRevenueList.html('<li class="dummystuf"> <h4></h4> <p></p></li><li class="dummystuf"> <h4></h4> <p></p></li><li class="dummystuf"> <h4></h4> <p></p></li><li class="dummystuf"> <h4></h4> <p></p></li>');
            monthbyRevList.html(' <div class="content dummystuf"><h4></h4><p></p></div><div class="content dummystuf"><h4></h4><span></span></div>');
            $.ajax({
                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'loadRevenueOverviewSec',
                    act: act
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    action.html(result.action);
                    totalRev.html(result.totalRev);
                    tatalBook.html(result.tatalBook);
                    nightDisplay.html(result.night);
                    kotRevDisplay.html(result.kotRev);
                    guestDisplay.html(result.guest);
                    visiterDisplay.html(result.visitor);
                    totalExpens.html(result.totalExpens);
                    totalKotExpense.html(result.totalKotExpense);
                    perDayRevenueList.html('');
                    $.each(result.daybyRevList, function(key, value) {
                        var book = value.book;
                        var day = value.day;
                        var active = '';
                        if (key + 1 == 4) {
                            var active = 'active';
                        }
                        var html = '<li class="' + active + '"> <h4>' + book + '</h4> <span>' + day + '</span></li>'
                        perDayRevenueList.append(html);
                    });
                    monthbyRevList.html(result.monthbyRevList);

                }
            });
        }


        function loadActiveFeed() {
            var html = '<li class="dummystuf"><div class="d-flex align-item-center"><div class="leftSide"><h4></h4><p></p></div><div class="rightSide"><a class="checkin" href="#"></a></div></div></li><li class="dummystuf"><div class="d-flex align-item-center"><div class="leftSide"><h4></h4><p></p></div><div class="rightSide"><a class="newBook" href="#"></a></div></div></li><li class="dummystuf"><div class="d-flex align-item-center"><div class="leftSide"><h4></h4><p></p></div><div class="rightSide"><a class="checkin" href="#"></a></div></div></li>';
            $('#activitySec .card-body ul').html(html);
            $.ajax({
                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'loadActiveFeed'
                },
                success: function(data) {
                    $('#activitySec .card-body ul').html(data);
                }
            });
        }

        $(document).ready(function() {
            loadRevenueOverviewSec('today');
            loadActiveFeed();

            loadOccupancyForecastReport('<?= date("Y-m-d", strtotime('-2 days')) ?>', '<?= date("Y-m-d", strtotime('2 days')) ?>');

            $(document).on('click', '.dropdownSec ul button', function() {
                var content = $(this).html();
                var action = $(this).data('value');
                $(this).parent().parent().siblings('.actionBtn').html(content);
                $(this).parent().parent().removeClass('show');
                loadRevenueOverviewSec(action);
            });

            $(document).on('click', '.aroorwbtn', function() {
               
                $(this).siblings('ul').toggleClass('show');
            });
            $(document).on('click', '.perDayLeftArrow', function() {
                var pdate = $(this).data('pdate');
                var cdate = $(this).data('cdate');
                loadDailyReport(pdate);
            });

            $(document).on('click', '#reloadActiveFeed', function() {
                loadActiveFeed();
            });

        });


        $('#todayCheckIn').on('click', function() {
            $.ajax({
                url: 'include/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'todayCheckIn'
                },
                success: function(data) {
                    $('#indexSlidBar').addClass('show');
                    $('#indexSlidBar .box').html(data);
                }
            });
        });


        $('#todayCheckOut').on('click', function() {
            $.ajax({
                url: 'include/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'todayCheckOut'
                },
                success: function(data) {
                    $('#indexSlidBar').addClass('show');
                    $('#indexSlidBar .box').html(data);
                }
            });
        });

        $('#qpTodayCheckIn').on('click', function() {
            $.ajax({
                url: 'include/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'qptodayCheckIn'
                },
                success: function(data) {
                    $('#indexSlidBar').addClass('show');
                    $('#indexSlidBar .box').html(data);
                }
            });
        });

        $('#qpTodayCheckOut').on('click', function() {
            $.ajax({
                url: 'include/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'qptodayCheckOut'
                },
                success: function(data) {
                    $('#indexSlidBar').addClass('show');
                    $('#indexSlidBar .box').html(data);
                }
            });
        });

        $(document).on('click', '#todayCheckInDownloadData', function() {
            $.ajax({
                url: 'include/ajax/otherDetail.php',
                type: 'post',
                data: {
                    type: 'todayCheckInDownload'
                },
                success: function(data) {

                }
            });
        })


        $('#indexSlidBar .closeContent').on('click', function() {
            $('#indexSlidBar').removeClass('show');
        });

        $('#indexSlidBar .close').on('click', function() {
            $('#indexSlidBar').removeClass('show');
        });


        <?php


        for ($i = 7; $i > -1; $i--) {
            $currentDate = strtotime(date('Y-m-d'));
            $months = date("F Y", strtotime(date('Y-m-01') . " -$i months"));
            $timestamp = strtotime($months);
            $first_second = date('Y-m-01 ', $timestamp);
            $last_second = date('Y-m-t ', $timestamp);
            $booking = 0;
            $quickPay = 0;
            $booking = MonthlyBookingEarning($first_second, $last_second);
            $quickPay = MonthlyQuickPayEarning($first_second, $last_second);
            $totalBook = round($booking + $quickPay);

            $dateprint = date('M', strtotime($months));
            $chartBarData[] = [
                'day' => $dateprint,
                'booking' => $totalBook,
            ];
        }

        ?>


        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: [
                    <?php foreach ($chartBarData as $dateList) {
                        $date = $dateList['day'];
                        echo '"' . $date . '",';
                    } ?>
                ],
                datasets: [{
                    label: "Booking",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data: [
                        <?php foreach ($chartBarData as $priceList) {
                            $date = $priceList['booking'];
                            echo "$date ,";
                        } ?>
                    ],
                    maxBarThickness: 8
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fff'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true,
                            color: '#fff',
                            padding: 10
                        }
                    },
                },
            },
        });



        <?php

        $date = date('F Y');
        $date = date('F Y');
        $nOfDay = date('t', strtotime($date));
        for ($i = 0; $i < $nOfDay; $i++) {
            $oneDate = date("Y-m-d", strtotime(date('Y-m-01')) + (86400 * $i));
            $booking = dailyBookingEarningByAddOn($oneDate);
            $quickPay = dailyQuickPayEarningByAddOn($oneDate);

            $datePrint = date('d', strtotime($oneDate));
            $dailyBooking[] = [
                'day' => $datePrint,
                'book' => $booking,
                'qp' => $quickPay,
            ];
        }


        ?>
    </script>

</body>

</html>