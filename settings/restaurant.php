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

    <title>Restaurant</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/restaurant' ?>">Restaurant</a></li>
                        <li class="item"><button id="addRestaurant" class="btn bg-gradient-info m-0">Add Restaurant</button></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="servicesArea" style="padding: 10px;margin-top: 5px;">
                        <div id="loadRestaurant"></div>
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

        $('.posNav').addClass('active');
        $('.posNav .restaurant').addClass('active');

        function loadRestaurant(){
            var formData = `request_type=loadRestaurant`;
            var loder = window.loaderSpinner;
            $('#loadRestaurant').append(loder);
            var serviceList = '';
            ajax_request(formData).done((data)=>{
                var response = JSON.parse(data);
                $.each(response, (key,val)=>{
                    var name = val.name;
                    var id = val.id;

                    serviceList += `
                            <li>
                                <a href="javascript:void(0)" class="itemContent dFlex aic">
                                    <h4>${name}</h4>
                                </a>
                            </li>`;
                    
                })
                $('#loadRestaurant').html(`<ul>${serviceList}</ul>`);
            });
        }

        function loadKotRes() {
            var formData = `request_type=addRestaurantOnKot`;

            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var list = '';
                $.each(response, function(key, val) {
                    name = val.name;
                    id = val.id;
                    list += `<li><input type="text" readonly value="${name}"/>  <button class="editRes btn bg-gradient-warning mb-0 text-center" data-index="${id}">Edit</button> <button class="deleteRes btn bg-gradient-danger mb-0 text-center" data-index="${id}">X</button></li>`;
                });

                var html = `
                <form id="addRastaurantForm" action="" method="POST" style="position:relative;">
                    <div class="input-wrap">
                    <span class="lnr lnr-indent-increase"></span>
                    <input class="form-control" type="text" name="resturateName" id="resturateName" placeholder="Enter restaurant name" class="input">
                    </div>
                    <button class="submitbtn btn bg-gradient-dark mb-0 text-end" type="submit" id="resSubBtn" style="  position: absolute;  right: 0;  margin: 3px;  top: 0;">+</button>
                    <span class="error"></span>
                </form>

                <ul class="todoList">${list}</ul>
            `;
                showModalBox('Restaurant List', '', html, 'addRastaurantSubmitBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();
            });
        }

        $(document).ready(()=>{
            loadRestaurant();


            $(document).on("click", "#addRestaurant", function(e) {
                e.preventDefault();
                loadKotRes();
            });
        });
        
    </script>

</body>

</html> 