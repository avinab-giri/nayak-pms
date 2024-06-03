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

    <title>Reservations </title>

    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <div class="container-fluid">

            <div class="reservationNav sNavBar">
                <?php

                $leftNav = reservationLeftNav('all');

                $rightNav = reservationRightNav();

                echo backNavbarUi('', '', $rightNav, $leftNav);
                ?>
            </div>

            <div class="row">
                <div class="col-12 mb-1">
                    <?= clrPreviewHtml('resType') ?>
                </div>
                <!-- <div class="col-3">
                    <div class="reservationContent skeleton">
                        <div class="head dFlex aic jcsb">
                            <div class="leftSide dFlex aic">
                                <div class="icon"><svg class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                    </svg></div>
                                <div class="userName">
                                    <h4></h4>
                                    <span></span>
                                </div>
                            </div>
                            <div class="rightSide"></div>
                        </div>

                        <div class="body">
                            <div class="checkInDetail">
                                <span></span>
                                <strong class="zi5"><img style="width:20px" src="http://localhost/nayak-pms/img/icon/source/pms.png"></strong>
                            </div>
                            <div class="checkinStatus center"><span style="background: #00a1a1;color: #ffffff;"></span></div>
                            <div class="bookingDate">
                                <div class="left">
                                    <strong></strong>
                                    <span></span>
                                </div>
                                <div class="right">
                                    <ul>
                                        <li>
                                            <svg style="width: 15px;height: 15px;" class="svg-inline--fa fa-male fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="male" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M96 0c35.346 0 64 28.654 64 64s-28.654 64-64 64-64-28.654-64-64S60.654 0 96 0m48 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H48c-26.51 0-48 21.49-48 48v136c0 13.255 10.745 24 24 24h16v136c0 13.255 10.745 24 24 24h64c13.255 0 24-10.745 24-24V352h16c13.255 0 24-10.745 24-24V192c0-26.51-21.49-48-48-48z"></path>
                                            </svg>
                                            <strong></strong>
                                        </li>
                                        <li>
                                            <svg style="width: 15px;height: 15px;" class="svg-inline--fa fa-child fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="child" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M120 72c0-39.765 32.235-72 72-72s72 32.235 72 72c0 39.764-32.235 72-72 72s-72-32.236-72-72zm254.627 1.373c-12.496-12.497-32.758-12.497-45.254 0L242.745 160H141.254L54.627 73.373c-12.496-12.497-32.758-12.497-45.254 0-12.497 12.497-12.497 32.758 0 45.255L104 213.254V480c0 17.673 14.327 32 32 32h16c17.673 0 32-14.327 32-32V368h16v112c0 17.673 14.327 32 32 32h16c17.673 0 32-14.327 32-32V213.254l94.627-94.627c12.497-12.497 12.497-32.757 0-45.254z"></path>
                                            </svg>
                                            <strong></strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="bookingDetail">
                                <ul class="dFlex aic jcsb">
                                    <li class="dFlex aic jcc fdc dif wAuto">
                                        <small></small>
                                        <div class="badge badge-secondary item dFlex aic jcc fdc">
                                            <strong></strong>
                                        </div>
                                    </li>
                                    <li class="dFlex aic jcc fdc dif wAuto">
                                        <small></small>
                                        <div class="dFlex aic jcc fdc dif wAuto badge badge-success item">
                                            <span></span>
                                            <strong></strong>
                                            <span></span>
                                        </div>
                                    </li>
                                    <li class="dFlex aic jcc fdc dif wAuto">
                                        <small></small>
                                        <div class="badge badge-dark item dFlex aic jcc fdc">
                                            <strong></strong>
                                        </div>
                                    </li>
                                    <li class="dFlex aic jcc fdc dif wAuto">
                                        <small></small>
                                        <div class="dFlex aic jcc fdc dif wAuto badge badge-danger item">
                                            <span></span>
                                            <strong></strong>
                                            <span></span>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>


                        <div class="foot resevationFooter">
                            <div class="dFlex aic jcsb item withOutHover">
                                <div><span class="clrBlack"></span> <strong class="totalPrice"></strong></div>
                                <div><span class="clrBlack"></span> <strong class="paidPrice"></strong></div>
                            </div>
                        </div>


                    </div>


                </div> -->
                <div class="col-12">
                    <div id="resorvationContent"></div>
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


        function exportFile() {
            var currentDate = new Date();
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1;
            $('#reservationTable').table2excel({
                exclude: ".no-export",
                filename: `reservation-${day}-${month}.xls`,
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: true
            });
        }

        $(document).on('click', '#exportData', function() {
            exportFile();
        });


        $(document).ready(() => {
            loadResorvation('all');
        });

        $('#excelExport').click(function() {
            // Use html2pdf to generate and download the PDF
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