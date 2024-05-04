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

    <title>Delete rooms</title>

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
                <div class="innerLink dFlex aic">
                    <ul class="innerNav" style="margin-right: 25px;">
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/rooms' ?>">Rooms</a></li>
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/room-number' ?>">Room Number</a></li>
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/delete-rooms' ?>">Delete rooms</a></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div class="table table-responsive" id="loadRoomData"></div>
                </div>
            </div>
        </section>

    </main>
    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    
    <div id="popUpBox">
        <div class="closeBox"></div>
        <div class="content">
            <div class="closeBtn">X</div>
            <div class="contentArea">

            </div>
        </div>
    </div>

    <div id="amenitiesBox">
        <div class="closeBox"></div>
        <div class="content">
            <div class="closeBtn">X</div>
            <div class="contentArea">
                <form action="" method="post" id="amenitiesForm">
                    <div class="form-group mb-4">
                        <label for="amenitiesName">Amenities (Press Enter To Add Amenities.)</label>
                        <input class="form-control" type="text" name="amenitiesName" id="amenitiesName"
                            placeholder="Enter Amenities." autocomplete="off">
                        <span id="amenitiesErrorBox"></span>
                    </div>
                    <input type="hidden" value="" id="amenitiesFormRId">
                    <ul id="amenitiesContentPreview">

                    </ul>
                    <!-- <input class="btn bg-gradient-primary" type="submit" name="aminitiesSub" value="Add"> -->
                </form>
            </div>
        </div>
    </div>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.hotelNav').addClass('active');
        $('.hotelNav .rooms').addClass('active');
        

    function loadDeleteRoomList() {
        $.ajax({
            url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
            type: 'post',
            data: {
                type: 'loadDeleteRoomList'
            },
            success: function(data) {
                $('#loadRoomData').html(data);
                $('#loadRoomData table').DataTable();
            }
        });
    }
    

    $(document).ready(function() {

        loadDeleteRoomList();

        $(document).on('click', '.restore', function(e){
            e.preventDefault();
            var rid = $(this).data('rid');
            
            var alert = `You won't be restore!`;
            Swal.fire({
                title: 'Are you sure?',
                text: alert,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var formdata = 'rid='+rid+'&request_type=restoreRoomID';
                ajax_request(formdata).done(function(data){
                    var responseData = JSON.parse(data);
                    var status = responseData.status;
                    var msg = responseData.msg;
                    
                    if(status == 'success'){
                        sweetAlert(msg)
                        loadDeleteRoomList();
                    }

                    if(status == 'error'){
                        sweetAlert(msg, 'error')
                    }
                    
                });

                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            });
            
        });

        var imgCount = 0;
        $(document).on('click','#addImageBtn',function(e){
            imgCount ++;
            rid = $(this).data('rid');
            var html = `<div class="form_group col-md-6 col-sm-12 mb-3" id="addImage${imgCount}">
                            <div class="row align-items-end">
                                <div class="col-auto" style="width: calc(100% - 40px);">
                                    <div class="dFlex aie">
                                        <div class="imgCon">
                                            <label for="addRoomImage${imgCount}">Room Image </label>
                                            <input data-rid="${rid}" class="form-control checkRoomImg" type="file" id="addRoomImage${imgCount}" accept="image/jpeg" name="roomImage[]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto p-0">
                                    <a class="removeImageBtn" data-target="addImage${imgCount}" href="javascript:void(0)">X</a>
                                </div>
                            </div>                     
                    </div>`;
            $('#roomImgContent').append(html);
        });

        $(document).on('click','.removeImageBtn',function(e){
            var target = $(this).data('target');
            var rid = $(this).parent().siblings().find('.removeImg').data('imgid');
            var targetPath = $('#'+target);
            deleteRoomImgWithData(rid,targetPath);
        });


        $(document).on('click', '.deleteRatePlan', function(){
           var targetId = $(this).data('target');
           var rdid = $(this).data('rdid');
           
           Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    function deleteCon() {
                        if(rdid == '' || rdid == 0){
                            $(`#${targetId}`).remove();
                            sweetAlert('Successfully delete record.');
                        }else{
                            var data = 'rdid='+rdid+'&request_type=deleteRatePlan';
                            ajax_request(data).done(function(data){
                                var response = JSON.parse(data);
                                var error = response.error;
                                var msg = response.msg;

                                if(error == 'no'){
                                    $(`#${targetId}`).remove();
                                    sweetAlert(msg);
                                }
                                if(error == 'yes'){
                                    sweetAlert(msg,'error');
                                }
                            });
                        }
                        
                    }
                if (result.isConfirmed) {
                    deleteCon();
                }
            });
        });




    });
        
    </script>

</body>

</html>