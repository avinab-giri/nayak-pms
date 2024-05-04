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

    <title>Logos</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/logos' ?>">Logos</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/page-link' ?>">Page Link</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/social-media' ?>">Social media</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/chatbot' ?>">Chatbot</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/map' ?>">Map</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="basicDetailArea">
                        <div id="loadLogoDetail"></div>
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

        function loadHotelLogo() {
            var formData = `request_type=hotelDetailAjexFun`;
            var loder = window.spinner;
            $('#loadLogoDetail').html(loder);
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var slug = response.slug;
                var fullDarklogoUrl = response.fullDarklogoUrl;
                var fullFaviconUrl = response.fullFaviconUrl;
                var fullKotLogoUrl = response.fullKotLogoUrl;
                var fullLightlogoUrl = response.fullLightlogoUrl;
                var html = `
                    <input type="hidden" name="hotelSlug" id="hotelSlug" value="${slug}">
                    <div class="row">
                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                            <label class="imgLabel" for="websiteLightLogo">
                                <div class="content"><img src="${fullLightlogoUrl}"/></div>
                                <span>Website Light Logo</span>
                            </label>
                            <input type="file" name="website" id="websiteLightLogo" data-index="lightlogo" class="form-control imgInput">
                        </div>

                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                            <label class="imgLabel" for="websiteDarkLogo">
                                <div class="content"><img src="${fullDarklogoUrl}"/></div>
                                <span>Website Dark Logo</span>
                            </label>
                            <input type="file" name="website" id="websiteDarkLogo" data-index="darklogo" class="form-control imgInput">
                        </div>

                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                            <label class="imgLabel" for="faviconIcon">
                                <div class="content"><img src="${fullFaviconUrl}"/></div>
                                <span>Favicon Logo</span>
                            </label>
                            <input type="file" name="website" id="faviconIcon" data-index="favicon" class="form-control imgInput">
                        </div>

                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                            <label class="imgLabel" for="kotLogo">
                                <div class="content"><img src="${fullKotLogoUrl}"/></div>
                                <span>Kot Logo</span>
                            </label>
                            <input type="file" name="website" id="kotLogo" data-index="kotLogo" class="form-control imgInput">
                        </div>
                    </div>
                `;
                $('#loadLogoDetail').html(html);
            });
        }

        $(document).ready(() => {
            loadHotelLogo();

            $(document).on('change', '.imgInput', function() {
                var file = $(this);
                var error = $(this).attr('id');
                var index = $(this).data('index');
                var slug = $('#hotelSlug').val();
                
                if (slug != '') {
                    var accessValue = 'logo';
                    var loaderHtml = window.loaderSpinner;
                    $(this).siblings('label').html(loaderHtml);
                    imageFileUpdateWithAjax(file, slug, 'logo', '', '', '', '', index).done((returnData) => {
                        var response = JSON.parse(returnData);
                        var error = response.error;
                        var img = response.img;
                        var imgFullPath = response.imgFullPath;
                        var imgId = response.imgId;
                        var msg = response.msg;

                        updateDataOnDataBase('hotelprofile',index, imgId, 'hotelId', 'hid');

                        sweetAlert(msg);
                        $(this).siblings('label').html(`<div class="content"><img src="${imgFullPath}"></div>`);

                    });
                } else {
                    file.val('');
                    alert('Room name is required.');
                }

            });
        });
    </script>

</body>

</html>