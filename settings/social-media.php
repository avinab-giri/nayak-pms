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

    <title>Social media</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/social-media' ?>">Social media</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/chatbot' ?>">Chatbot</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/map' ?>">Map</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="basicDetailArea">
                        <div id="socialMediaDetail"></div>
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

        function loadSocialMedia() {
            var formData = `request_type=loadSocialMedia`;
            var loder = window.spinner;
            $('#socialMediaDetail').html(loder);
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var html = '<form id="socialMediaForm"><div class="row">';
                $.each(response, function(key,val){

                    var id = val.id;
                    var smId = val.smId;
                    var accesKey = val.accesKey;
                    var bgClr = val.bgClr;
                    var color = val.color;
                    var icon = val.icon;
                    var link = val.link;
                    var name = val.name;
                    var placeholder = val.placeholder;

                    html += `
                        <div class="col-md-12">
                            <div class="iconWithInput">
                                <input name="sKey[]" type="hidden" value="${id}">
                                <input name="smId[]" type="hidden" value="${smId}">
                                <label for="${accesKey}" style="background: ${bgClr}">
                                    <span class="rightBar" style="background: ${bgClr}"></span>
                                    <span class="icon" style="color:${color}">${icon}</span>
                                </label>
                                <input type="text" class="form-control" placeholder="${placeholder}" name="socialMedia[]" id="${accesKey}" value="${link}">
                            </div>
                        </div>`;
                });

                html += `</div>
                            <input class="btn bg-gradient-primary" type="submit" value="Submit"/>
                        </form>`;
                
                $('#socialMediaDetail').html(html);
            });
        }

        $(document).ready(() => {
            loadSocialMedia();

            $(document).on('submit', '#socialMediaForm', function(e){
                e.preventDefault();
                var formData = $(this).serialize()+'&request_type=socialMediaSubmit';
                ajax_request(formData).done((data) => {
                    if(data == 1){
                        sweetAlert('Successfully update data!');
                        loadSocialMedia();
                    }
                });

            });
            
        });
    </script>

</body>

</html>