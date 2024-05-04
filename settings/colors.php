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


$themeColor = getThemeColor();

$primaryClr = explode(',', $themeColor['primaryClr']);
$primaryClrHover = explode(',', $themeColor['primaryClrHover']);
$textClr = explode(',', $themeColor['textClr']);
$bgClr = explode(',', $themeColor['bgClr']);
$bgClr2 = explode(',', $themeColor['bgClr2']);
$borderClr = explode(',', $themeColor['borderClr']);
$borderClr2 = explode(',', $themeColor['borderClr2']);
$borderHoverClr = explode(',', $themeColor['borderHoverClr']);
$waBtnClr = explode(',', $themeColor['waBtnClr']);
$warning = explode(',', $themeColor['warning']);
$warning2 = explode(',', $themeColor['warning2']);
$tooltipClr = explode(',', $themeColor['tooltipClr']);
$tooltipBg = explode(',', $themeColor['tooltipBg']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Colors</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/colors' ?>">Colors</a></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div id="loadColorDetail" class="h100p">
                        <div class="row h100p">
                            <div class="col-md-6 col-sm-12 p-o h100p">
                                <div class="lightColor scrollBar">
                                    <div class="item">
                                        <h4>Text Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="textClr" data-target="textClr" data-clrtype="light" value="<?= $textClr[0] ?>">
                                            </li>
                                        </ul>

                                        <h4>Background Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="bgClr" data-target="bgClr" data-clrtype="light" value="<?= $bgClr[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="bgClr2" data-target="bgClr2" data-clrtype="light" value="<?= $bgClr2[0] ?>">
                                            </li>
                                        </ul>

                                        <h4>Primary Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="primaryClr" data-target="primaryClr" data-clrtype="light" value="<?= $primaryClr[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="primaryClrHover" data-target="primaryClrHover" data-clrtype="light" value="<?= $primaryClrHover[0] ?>">
                                            </li>
                                        </ul>

                                        <h4>Border Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderClr" data-target="borderClr" data-clrtype="light" value="<?= $borderClr[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderClr2" data-target="borderClr2" data-clrtype="light" value="<?= $borderClr2[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderHoverClr" data-target="borderHoverClr" data-clrtype="light" value="<?= $borderHoverClr[0] ?>">
                                            </li>
                                        </ul>


                                        <h4>Whatsapp Button</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="waBtnClr" data-target="waBtnClr" data-clrtype="light" value="<?= $waBtnClr[0] ?>">
                                            </li>
                                        </ul>

                                        <h4>Tooltip Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="tooltipClr" data-target="tooltipClr" data-clrtype="light" value="<?= $tooltipClr[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="tooltipBg" data-target="tooltipBg" data-clrtype="light" value="<?= $tooltipBg[0] ?>">
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 p-o h100p">
                                <div class="darkColor scrollBar">
                                    <div class="item">
                                        <h4>Text Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="textClr" data-target="textClr" data-clrtype="dark" value="<?= $textClr[1] ?>">
                                            </li>
                                        </ul>

                                        <h4>Background Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="bgClr" data-target="bgClr" data-clrtype="dark" value="<?= $bgClr[1] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="bgClr2" data-target="bgClr2" data-clrtype="dark" value="<?= $bgClr2[1] ?>">
                                            </li>
                                        </ul>

                                        <h4>Primary Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="primaryClr" data-target="primaryClr" data-clrtype="dark" value="<?= $primaryClr[1] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="primaryClrHover" data-target="primaryClrHover" data-clrtype="dark" value="<?= $primaryClrHover[1] ?>">
                                            </li>
                                        </ul>

                                        <h4>Border Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderClr" data-target="borderClr" data-clrtype="dark" value="<?= $borderClr[1] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderClr2" data-target="borderClr2" data-clrtype="dark" value="<?= $borderClr2[1] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="borderHoverClr" data-target="borderHoverClr" data-clrtype="dark" value="<?= $borderHoverClr[1] ?>">
                                            </li>
                                        </ul>


                                        <h4>Whatsapp Button</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="waBtnClr" data-target="waBtnClr" data-clrtype="dark" value="<?= $waBtnClr[1] ?>">
                                            </li>
                                        </ul>

                                        <h4>Tooltip Color</h4>
                                        <ul>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="tooltipClr" data-target="tooltipClr" data-clrtype="dark" value="<?= $tooltipClr[0] ?>">
                                            </li>
                                            <li class="dib">
                                                <input class="themeClrBtn" type="color" id="tooltipBg" data-target="tooltipBg" data-clrtype="dark" value="<?= $tooltipBg[0] ?>">
                                            </li>
                                        </ul>

                                    </div>
                                </div>
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
        $('.beNav').addClass('active');
        $('.beNav .colors').addClass('active');

        $(document).ready(() => {
            
            $(document).on('change','.themeClrBtn',function(e){
                e.preventDefault();
                var target = $(this).data('target');
                var clrtype = $(this).data('clrtype');
                var targetVal = $(this).val();
                var formData = `request_type=themeClrUpdate&target=${target}&targetVal=${targetVal}&clrtype=${clrtype}`;
                ajax_request(formData).done(function(data){

                });
            });

        });
    </script>

</body>

</html>