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

    <title>Amenities</title>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'link.php');
    $userDetailArry = getHotelUserDetail($_SESSION['ADMIN_ID'])[0];
    $name = ucfirst($userDetailArry['name']);
    $designation = $userDetailArry['designation'];
    $hotelName = $userDetailArry['hotelName'];
    $phone = $userDetailArry['phone'];
    $email = $userDetailArry['email'];
    $fullDesignation = ($designation == '') ? '' : "$designation at $hotelName";
    ?>



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
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/amenities' ?>">Amenities</a></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div class="row amenitiesArea">
                        <div class="col-xl-6 col-md-6 col-sm-6 pR0 rightBorder">

                            <div id="loadAmenitiesCatData" class="pR scrollBar">
                                
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div id="loadAmenitieDetail" class="scrollBar"></div>
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
        $('.hotelNav .amenities').addClass('active');

        function loadAmenitieCatData(aCat=''){
            var formData = `request_type=loadAmenitieCatData&acat=${aCat}`;
            var loder = window.loaderSpinner;
            $('#loadAmenitiesCatData').append(loder);
            ajax_request(formData).done((data)=>{
                var response = JSON.parse(data);
                $('.spinner-box').remove();
                $('#loadAmenitiesCatData').html(`<ul class="liDB">${response}</ul>`);
            });
        }

        function loadAmenitieDetail(catid = '') {
            var formData = `request_type=loadAmenitieDetail&catid=${catid}`;
            var loder = window.loader;
            $('#loadAmenitieDetail').html(loder);
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var html ='';
                if(response.length > 0){
                    $.each(response, function(key,val){
                        var catId = val.id;
                        var title = val.title;
                        var img = val.img;
                        console.log(val);
                        var exist = (val.exist == 'yes' ? 'checked' : '');

                        html += `<div class="checkbox">
                                    <label class="amenitieCheckLabel"><input ${exist} class="amenitieCheckBox" type="checkbox" value="${catId}">${img} <span>${title}</span></label>
                                </div>`;
                    })
                }else{
                    html +='No data.';
                }
                


                $('#loadAmenitieDetail').html(html);

            });
        }

        
        

        $(document).ready(() => {
            loadAmenitieCatData(1);
            loadAmenitieDetail(1);

            $(document).on('click', '#loadAmenitiesCatData li', function(e) {
                e.preventDefault();
                $('#loadAmenitiesCatData li').removeClass('active');
                var catId = $(this).data('catid');
                $(this).addClass('active');
                loadAmenitieDetail(catId);
            });

            $(document).on('click', '.amenitieCheckBox', function(e) {
                var amenitieId = $(this).val();
                var exist = 'no';
                if($(this).prop('checked') == true){
                    exist = 'yes';
                }
                var formData = `request_type=submitAmenitieId&aid=${amenitieId}&exist=${exist}`;
                ajax_request(formData);
            });

        });
    </script>

</body>

</html>