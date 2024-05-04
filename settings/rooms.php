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

    <title>Rooms</title>

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
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/rooms' ?>">Rooms</a></li>
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/room-number' ?>">Room Number</a></li>
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/delete-rooms' ?>">Delete rooms</a></li>
                    </ul>
                    <ul>
                        <li class="db"><a href="javascript:void(0)"><button type="button" id="addRoomBtn"
                                                class="btn bg-gradient-info m-0">Add
                                                Room</button></a></li>
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

        function tagList($val='',$rid=''){
        var val = $val;
        var rid = $('#slug').val();
        var html = '';
        var data = 'value='+val+'&rid='+rid+'&request_type=checkRoomNumber';
        ajax_request(data).done(function(result){
            var array = JSON.parse(result);
            var error = array.error;
            var msg = array.msg;
            var num = array.num;

            $.each(num, function(key,val){
                html += `<li>${val}<a class="removeRoomNum" data-value="${val}" href="javascript:void(0)" data-rid="${rid}">X</a></li>`;
            });

            $('#rnDisplayLabelInputField .tagList').html(html);
            if(error == 'yes'){
                sweetAlert(msg,'error');
            }

        });
    }

    function loadRoomList() {
        $.ajax({
            url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
            type: 'post',
            data: {
                type: 'loadRoomList'
            },
            success: function(data) {
                $('#loadRoomData').html(data);
            }
        });
    }

    function addRoomFormSec($rid = '') {
        $('#popUpBox').addClass('show');
        var rid = $rid;
        var type = 'showAddRoomForm';
        if (rid != '') {
            var type = 'showUpdateRoomFrom';
        }
        var loader = window.spinner;
        $('#popUpBox .contentArea').html(loader);
        $.ajax({
            url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
            type: 'post',
            data: {
                type: 'showAddRoomForm',
                rid: rid
            },
            success: function(data) {
                $('#popUpBox .contentArea').html(data);
                tinymce.init({
                    selector: 'textarea#roomDescription',
                    height: 250,
                    plugins: 'code',
                    menubar: false
                });
                tagList('',rid);
                removeClassAfterSomeTime('hide','add_content');
            }
        });
    }

    function checkInputData($cname, $target, $value, $rid) {
        var cname = $cname;
        var target = $target;
        var cnamevalue = $value;
        var rid = $rid;
        $('#errorHeader').html('');
        $('form button').removeAttr('disabled');
        $.ajax({
            url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
            type: 'post',
            data: {
                type: 'checkRoomInputData',
                cname: cname,
                cnamevalue: cnamevalue,
                rid: rid,
            },
            success: function(data) {
                var result = JSON.parse(data);
                var type = result.type;
                var msg = result.msg;
                if (result.error == 'yes') {
                    if (type == 'header') {
                        $('#errorHeader').html(msg);
                    }
                    $('form button').attr('disabled', 'disabled');
                }
            }
        });
    }

    $(document).ready(function() {

        loadRoomList();

        setInterval(loadRoomList(),5000);

        $(document).on('change', '.checkRoomImg', function(){
            var file = $(this);
            var error = $(this).attr('id');
            var slug = $('#slug').val();
            if(slug != ''){
                var elementId = $(this).attr('id');
                var accessValue = $(this).data('rid');
                imageFileCheckAndUpdate(file,error,slug,'room',elementId,accessValue);
            }else{
                file.val('');
                alert('Room name is required.');
            }

        });

        $('#addRoomBtn').on('click', function(e) {

            e.preventDefault();
            addRoomFormSec();

        });


        $(document).on('click', '.add_sub', function() {
            var form_data = "request_type=addRatePlanInForm";

            ajax_request(form_data).done((data)=>{
                var response = JSON.parse(data);
                $('#add_content').append(response);
                removeClassAfterSomeTime('hide','add_content');
                
            });
            
        });

        $(document).on('click', '.remove_sub', function() {
            var id = $(this).data('id');
            $('#add_content_id' + id).parent().remove();
        });

        $(document).on('keyup', '#header', function() {
            var rid = $(this).data('rid');
            var hotelInputName = $(this).val().trim();
            var hotelName = hotelInputName.toLowerCase();
            let result = hotelName.replace(" ", "-");
            result = result.replace(/ +(?=)/g, '');
            $('#slug').val(result);
            
            checkInputData('header', '', hotelInputName, rid);
        });

        $(document).on('click', '#loadRoomData .update', function(e) {
            var rid = $(this).data('rid');
            $('#popUpBox').addClass('show');
            addRoomFormSec(rid);
            removeClassAfterSomeTime('hide','add_content');
        });

        $(document).on('submit','#manageForm',function(e){
            e.preventDefault();
        });

        $(document).on('submit','#updateManageForm',function(e){
            e.preventDefault();
        });

        $(document).on('click', '#addRoomSubmitBtn', function(e) {
            e.preventDefault();
            $('#manageForm button').prop('disabled', false);
            $('#manageForm button').html('Loading..');
            console.log('addRoomSubmitBtn');

            if($("#updateManageForm").length != 0) {
                const form = document.getElementById("updateManageForm");
                const submitter = document.querySelector("button[value=submit]");
                var data = new FormData(form,submitter);
                data.append('type', 'update_room');
                $.ajax({
                    url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        loadRoomList();
                        $('#popUpBox').removeClass('show');
                        Swal.fire("Good job!", "Successfully Update.", "success");
                    }
                });
            }

            if($("#manageForm").length != 0) {
                const form = document.getElementById("manageForm");
                const submitter = document.querySelector("button[value=submit]");
                var data = new FormData(form, submitter);
                var roomNumber = $('#roomNumber').data('value');
                var slug = $('#slug').val();
                data.append('roomNumber', roomNumber);
                data.append('type', 'add_room');
                data.append('slug', slug);

                $.ajax({
                    url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        loadRoomList();
                        $('#popUpBox').removeClass('show');
                        Swal.fire("Good job!", "Successfully Add Room.", "success");
                    }
                });
            }
            

        });

        $(document).on('click', '#loadRoomData .delete', function() {
            var rid = $(this).data('rid');
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((willDelete) => {
                    function deleteRoom() {
                        $.ajax({
                            url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                            type: 'post',
                            data: {
                                type: 'deleteRoom',
                                rid: rid
                            },
                            success: function(data) {
                                if (data == 1) {
                                    loadRoomList();
                                    Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success' );
                                } else {
                                    Swal.fire("Your room record is safe!");
                                }
                            }
                        });
                    }

                    if (willDelete.isConfirmed) {
                        deleteRoom();
                    }

                });
        });

        $(document).on('click', '.status', function() {
            var rid = $(this).data('rid');
            $.ajax({
                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                type: 'post',
                data: {
                    type: 'statusUpdateForRoom',
                    rid: rid
                },
                success: function(data) {
                    if (data == 1) {
                        loadRoomList();
                        sweetAlert("Successfull change status.");
                    }
                }
            });
        });

        $(document).on('submit', '#amenitiesForm', function(e) {
            e.preventDefault();
            var data = $('#amenitiesName').val().trim();
            var errorBox = $('#amenitiesErrorBox');
            var amenitiesContent = $('#amenitiesContentPreview');
            errorBox.html('');
            var rid = $('#amenitiesFormRId').val();

            $.ajax({
                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                type: 'post',
                data: {
                    'type': 'amenitiesAdd',
                    'amenities': data
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    var msg = result.msg;
                    var name = result.name;
                    var status = result.status;

                    if (status == 'no') {
                        var amenitiesHtml = "<li><span class='amenitiesName'>" + name +
                            "</span><i class='bi bi-trash deleteAmenitieBtn'></i></li>";
                        amenitiesContent.append(amenitiesHtml);
                        addRoomFormSec(rid);
                        $('#amenitiesForm').trigger('reset');
                    }

                    if (status == 'yes') {
                        errorBox.html(msg);
                        $('#amenitiesForm').trigger('reset');
                    }
                }
            });
        });

        $(document).on('click', '.deleteAmenitieBtn', function() {
            var name = $(this).siblings().html();
            var target = $(this).parent();
            var rid = $('#amenitiesFormRId').val();
            $.ajax({
                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/room.php',
                type: 'post',
                data: {
                    'type': 'amenitiesDelete',
                    'amenities': name
                },
                success: function(data) {


                    if (data == '1') {
                        target.remove();
                        addRoomFormSec(rid);
                    }
                }
            });
        });

        $(document).on('click', '#roomAmenitesAdd', function() {
            $('#amenitiesBox').addClass('show');
            var id = $(this).data('rid');
            $('#amenitiesFormRId').val(id);
        });

        $(document).on('click', '#amenitiesBox .closeBtn', function() {
            $('#amenitiesBox').removeClass('show');
        });

        $(document).on('click', '#amenitiesBox .closeBox', function() {
            $('#amenitiesBox').removeClass('show');
        });

        $(document).on('keydown','#roomNumber', function(e){    
            var rid = $(this).data('rid');   
            if (e.keyCode == 13) {
                var value = $(this).val();
                var isValid = false;
                var regex = /^[0-9-+()]*$/;
                isValid = regex.test(value);

                if(!isValid){
                    var msg = 'Only number acceptable.';
                    sweetAlert(msg,'error');
                    $(this).val('');
                }else if(value == 0){
                    var msg = "Can't enter zero.";
                    sweetAlert(msg,'error');
                    $(this).val('');
                }else{
                    var numberValue = $('#roomNumber').data('value');
                    $('#roomNumber').data('value',numberValue+','+value);
                    tagList(value,rid);
                    $(this).val('');
                }

                return false;

            }
        });

        $(document).on('click', '.removeRoomNum', function(e){
            e.preventDefault();
            var rid = $(this).data('rid');
            var val = $(this).data('value');
            var alert = `You won't be delete ${val} room number!`;
            Swal.fire({
                title: 'Are you sure?',
                text: alert,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var data = 'value='+val+'&rid='+rid+'&request_type=deleteRoomNumber';
                ajax_request(data);
                tagList('',rid);

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
            var imgId = $(this).parent().siblings().find('input').val();
            var targetPath = $('#'+target);
            deleteRoomImgWithData(imgId,targetPath,'','rooms');
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