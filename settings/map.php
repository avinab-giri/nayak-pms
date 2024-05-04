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

    <title>Google Map</title>

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
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/basic-details' ?>">Basic</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/logos' ?>">Logos</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/page-link' ?>">Page Link</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/social-media' ?>">Social media</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/chatbot' ?>">Chatbot</a></li>
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/map' ?>">Map</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="basicDetailArea">
                        <div class="mapContent">
                            <form action="" id="googleMapForm">
                                <div class="form-group">
                                    <label for="mapLink">Map link</label>
                                    <input type="text" id="mapLink" class="form-control" placeholder="Enter google map link">
                                </div>
                                <div class="form-group">
                                    <label for="mapIfrem">Google map iFrem <span style="opacity: .8;"> ( Only SRC Link )</span></label>
                                    <textarea class="form-control mb-3" name="mapIfrem" id="mapIfrem" cols="30" rows="8" placeholder="Enter chatbot URL."></textarea>
                                </div>
                                <input class="btn bg-gradient-dark" type="submit" value="Save">
                            </form>
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
        $('.hotelNav .basicDetails').addClass('active');

        function loadGoogleMap() {
            var formData = `request_type=hotelDetailAjexFun`;
            var loder = window.spinner;
            $('#mapLink').val('Loading...');
            $('#mapIfrem').val('Loading...');
            $('#loadLogoDetail').html(loder);
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var mapLink = response.mapLink;
                var mapIfrem = response.mapIfrem;
                $('#mapLink').val(mapLink);
                $('#mapIfrem').val(mapIfrem);
            });
        }

        $(document).ready(() => {
            loadGoogleMap();

            $(document).on('submit', '#googleMapForm', function(e) {
                e.preventDefault();
                var mapIfrem = $('#mapIfrem').val();
                var mapLink = $('#mapLink').val();
                var formData = `request_type=googleMapFormUpdate&mapIfrem=${mapIfrem}&mapLink=${mapLink}`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;

                    if(status == 'success'){
                        sweetAlert(msg);
                        loadGoogleMap();
                    }

                    if(status == 'error'){
                        sweetAlert(msg,'error');
                    }
                });
            });
        });
    </script>

</body>

</html>