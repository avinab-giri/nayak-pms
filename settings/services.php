<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

$hotelId = $_SESSION['HOTEL_ID'];

$backLink = FRONT_SITE;
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''){
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

    <title>Services</title>

    <?php  include(FO_SERVER_SCREEN_PATH.'link.php');?>

    

</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <section id="setupSection">
            <div class="setupLeftSide">
                <?php include(FO_SERVER_SCREEN_PATH.'setupNav.php') ?>
            </div>
            <div class="setupRightSide">
                <div class="innerLink">
                    <ul class="innerNav">
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/services' ?>">Services</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="servicesArea">
                        <div id="loadServices"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    
    <div class="itemContent">
        <div class="icon"></div>
        <h4></h4>
    </div>

    <?php
        include(FO_SERVER_SCREEN_PATH.'booing_detail.php');
        include(FO_SERVER_SCREEN_PATH.'script.php');    
    ?>

    <script>

        $('.hotelNav').addClass('active');
        $('.hotelNav .services').addClass('active');

        function loadServices(){
            var formData = `request_type=loadServices`;
            var loder = window.loaderSpinner;
            $('#loadUsersData').append(loder);
            var serviceList = '';
            ajax_request(formData).done((data)=>{
                var response = JSON.parse(data);
                $.each(response, (key,val)=>{
                    var icon = (val.serviceIcon == null) ? '' : val.serviceIcon;
                    var name = val.serviceName;
                    var servicePid = val.servicePid;
                    if(servicePid == 0){
                        serviceList += `
                            <li>
                                <a href="javascript:void(0)" class="itemContent dFlex aic">
                                    <div class="icon">${icon}</div>
                                    <h4>${name}</h4>
                                </a>
                            </li>`;
                    }
                    
                })
                $('#loadServices').html(`<ul>${serviceList}</ul>`);
            });
        }

        $(document).ready(()=>{
            loadServices();
        });
        
    </script>

</body>

</html>