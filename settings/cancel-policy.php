<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

checkPageBySupperAdmin('pms', 'Stay View', 'Stay View');

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

    <title>Cancel policy</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php'); ?>



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
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/hotel-policy' ?>">Hotel Policy</a></li>
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/cancel-policy' ?>">Cancel Policy</a></li>
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/refund-policy' ?>">Refund Policy</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="row policyArea">
                        <div class="col-md-6 col-sm-12 pR0 rightBorder">
                            <div id="loadPolicyData" class="pR px-2 py-3 h100p"></div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div id="loadPolicyPreview">
                                <h4>Preview Content</h4>
                                <div class="content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.hotelNav').addClass('active');
        $('.hotelNav .termsAndPolicy').addClass('active');


        $(document).ready(() => {
            loadPolicyData('cancel');
        });
    </script>

</body>

</html>