<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

checkPageBySupperAdmin('pms','Stay View', 'Stay View');

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

    <title>Basic Details</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/basic-details' ?>">Basic</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/logos' ?>">Logos</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/page-link' ?>">Page Link</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/social-media' ?>">Social media</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/chatbot' ?>">Chatbot</a></li>
                        <li class="item"><a href="<?= FRONT_SITE.'/settings/map' ?>">Map</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="basicDetailArea">
                        <div id="loadHotelDetail"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>

    <?php
        include(FO_SERVER_SCREEN_PATH.'booing_detail.php');
        include(FO_SERVER_SCREEN_PATH.'script.php');    
    ?>

    <script>

        $('.hotelNav').addClass('active');
        $('.hotelNav .basicDetails').addClass('active');

        $(document).ready(()=>{
            loadHotelData();

            $(document).on('click', '#editHotelDetailBtn', function(e){
                e.preventDefault();
                var formData = `request_type=hotelDetailAjexFun`;
                ajax_request(formData).done((data)=>{
                    var response = JSON.parse(data);
                    var hotelName = response.hotelName;
                    var landlineNum = response.landlineNum;
                    var hotelPhoneNum = response.hotelPhoneNum;
                    var hotelEmailId = response.hotelEmailId;
                    var website = response.website;
                    var description = response.description;
                    var address = response.address;
                    var city = response.city;
                    var state = response.state;
                    var pincode = response.pincode;
                    var checkInTime = response.checkIn;
                    var checkOutTime = response.checkOut;
                    var gst = response.gst;
                    
                    var data = `
                            <form id="newHotelForm" enctype= multipart/form-data>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name">Hotel Name</label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Enter hotel name" value="${hotelName}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="landlineNum">Landline Number</label>
                                        <input name="landlineNum" id="landlineNum" type="number" class="form-control" placeholder="Enter landline number" value="${landlineNum}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="number">Mobile Number</label>
                                        <input name="number" id="number" type="number" class="form-control" placeholder="Enter mobile number." value="${hotelPhoneNum}">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <label for="email">Email</label>
                                        <input name="email" id="email" type="text" class="form-control" placeholder="Enter email id." value="${hotelEmailId}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="website">Website</label>
                                        <input name="website" id="website" type="text" class="form-control" placeholder="Enter website." value="${website}">
                                    </div>

                                    <div class="form-group col-md-3 col-sm-6 mb-2">
                                        <label for="checkInTime">Check In Time</label>
                                        <input name="checkInTime" id="checkInTime" type="time" class="form-control" placeholder="Enter Guest Check In Time" value="${checkInTime}">
                                    </div>

                                    <div class="form-group col-md-3 col-sm-6 mb-2">
                                        <label for="checkOutTime">Check Out Time</label>
                                        <input name="checkOutTime" id="checkOutTime" type="time" class="form-control" placeholder="Enter Guest Check Out Time." value="${checkOutTime}">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <label for="gstNumberField">GST Number</label>
                                        <input name="gstNumberField" id="gstNumberField" type="text" class="form-control" placeholder="Enter GST Number." value="${gst}">
                                    </div>
                                    

                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter description.">${description}</textarea>
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="street">Street</label>
                                        <input name="street" id="street" type="text" class="form-control" placeholder="Enter street or landmark." value="${address}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="city">City</label>
                                        <input name="city" id="city" type="text" class="form-control" placeholder="Enter city name." value="${city}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="state">State</label>
                                        <input name="state" id="state" type="text" class="form-control" placeholder="Enter state name." value="${state}">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="pincode">Pincode</label>
                                        <input name="pincode" id="pincode" type="text" class="form-control" placeholder="Enter pincode." value="${pincode}">
                                    </div>
                                    
                                </div>
                            </form>
                    `;
                showModalBox('Hotel Detail', 'Update', data, 'submitHotelBtn','modal-lg');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();

                });

                
            });

            $(document).on('click','#submitHotelBtn', function(e){
                e.preventDefault();
                var formData = $('#newHotelForm').serialize()+'&request_type=submitHotelData';
                ajax_request(formData).done((data)=>{
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;

                    if(status == "success"){
                        sweetAlert(msg);
                        $('#popUpModal').modal('hide');
                        loadHotelData();
                    }

                    if(status == "error"){
                        sweetAlert(msg,'error');
                    }
                });
            });

        });
        
    </script>

</body>

</html>