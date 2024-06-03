<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([12], 29);
$hotelName = ucfirst(hotelDetail()['hotelName']);

$backLink = FRONT_SITE;

$retoprtLink = FRONT_SITE . '/report/';
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Reports</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">

            <?php
                echo backNavbarUi('', 'Reports');


                $getStysReportTypeArray = getStysReportType('',1);
                $sn = 0;
                foreach($getStysReportTypeArray as $reportType){
                    $sn ++;
                    $rtid = $reportType['id'];
                    $rtname = $reportType['name'];

                    echo '
                        <div class="row">
                            <div class="col-12">
                                <h2>'.$sn.'. '.$rtname.'</h2>
                            </div>
                        </div>
                        <hr />
                    ';

                    $getStysReportListArray = getStysReportList('',$rtid,'',1);

                    $rlhtml = '';

                    foreach($getStysReportListArray as $reportList){
                        $accesKey = $reportList['accesKey'];
                        $rlname = $reportList['name'];
                        $rlsvg = $reportList['svg'];
                        $link = $retoprtLink . $accesKey;

                        $rlhtml .= '
                            <div class="col-xl-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                                <a class="reportContent" href="'.$link.'">
                                    <div class="card h-100">
                                        <div class="card-body  dFlex aic jcc fdc">
                                            <div class="iconCon">
                                                '.$rlsvg.'
                                            </div>
                                            <h4>'.$rlname.'</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ';
                       
                    }


                    echo '
                        <div class="row">
                            '.$rlhtml.'
                        </div>
                    ';
                }
            ?>

            

            

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




        $(document).ready(function() {

        });
    </script>

</body>

</html>