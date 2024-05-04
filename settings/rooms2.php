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

    <title>Profile</title>

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


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

        <section id="setupSection">
            <div class="setupLeftSide">
                <?php include(FO_SERVER_SCREEN_PATH . 'setupNav.php') ?>
            </div>
            <div class="setupRightSide">
                <div class="innerLink">
                    <ul class="innerNav">
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/rooms' ?>">Rooms</a></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div class="row amenitiesArea">
                        <div class="col-xl-6 col-md-6 col-sm-6 pR0 rightBorder">
                            <div class="dFlex aic jcsb p10 actionArea">
                                <div class="dropDownArea">
                                    <?php
                                    $dropdownData = [
                                        [
                                            'value' => 'activeRooms',
                                            'name' => 'Active Rooms'
                                        ],
                                        [
                                            'value' => 'inactiveRooms',
                                            'name' => 'Inactive Rooms'
                                        ],
                                        [
                                            'value' => 'deleteRooms',
                                            'name' => 'Deleted Rooms'
                                        ]
                                    ];
                                    echo generateDropdown($dropdownData);
                                    ?>
                                </div>
                                <button id="newRoomBtn" type="button" class="btn bg-gradient-info m0">New Rooms</button>
                            </div>
                            <div id="loadRoomsData" class="pR scrollBar">
                                
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div id="loadRoomDetail" class="scrollBar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.hotelNav').addClass('active');
        $('.hotelNav .rooms').addClass('active');

        function loadRoomDetail(aid = '') {
            var formData = `request_type=loadRoomDetail&aid=${aid}`;
            var loder = window.loader;
            $('#loadRoomDetail').html(loder);

            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var aid = response.id;
                var title = response.title;
                var fullImgUrl = response.fullImgUrl;
                var html = `
                        <div class="amenitieDetail">
                            <div class="imgCon"><img src="${fullImgUrl}"/></div>
                            <div class="textCon">
                                <div class="title dFlex aic"> <h4 class="dib">${title}</h4> <button data-aid="${aid}" id="editAmenitieDetailBtn" class="btnNoEffect w28 h28 mL10 dFlex dif aic jcc"><svg> <use href="#editfilledIcon"></use> </svg></button></div>
                            </div>
                        </div>
                `;
                $('#loadRoomDetail').html(html);

            });
        }

        function amenitieForm($aid='',$title='',$img='',$imgId=''){
            var aid = $aid;
            var title = $title;
            var img = $img;
            var imgId = $imgId;

            var imgHtml = `<div class="dFlex aie">
                            <div class="imgCon w100">
                                <label for="amenitieIcon">Amenitie Icon</label>
                                <input data-rid="" class="form-control checkAmenitieImg" type="file" id="amenitieIcon" accept="image/jpeg" name="amenitieIcon[]">
                            </div>
                        </div>`;

            if($imgId != ''){
                imgHtml = `<div class="dFlex aie">
                                <div class="previewImg">
                                    <img src="${img}">
                                    <span data-imgid="${imgId}" class="removeImg">X</span><input type="hidden" name="imgFile[]" value="${imgId}">
                                </div>
                                <div class="imgCon" style="width: 80%;">
                                    <label for="amenitieIcon">Amenitie Icon</label>
                                    <input data-rid="" class="form-control checkAmenitieImg" type="file" id="amenitieIcon" accept="image/jpeg" name="amenitieIcon[]" disabled="">
                                </div>
                            </div>`;
            }

            var data = `
                            <form id="newAmenitieForm" enctype= multipart/form-data>
                                <input type="hidden" name="aid" value="${aid}" id="aid"/>
                                <div class="row">
                                    <div class="form_group col-md-12 col-sm-12 mb-3">
                                        ${imgHtml}
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Enter amenities name." value="${title}">
                                    </div>
                                </div>
                            </form>
                    `;
            return data;
        }

        function loadRoomsData(rid = '') {
            var formData = `request_type=loadRoomsData&rid=${rid}`;
            var loder = window.loaderSpinner;
            $('#loadRoomsData').html(loder);
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                $('#loadRoomsData').html('<ul class="listItem"></ul>');
                var html = '';
                $.each(response, (key, val) => {
                    var roomId = val.id;
                    var header = val.header;
                    var bedtype = val.bedtype;
                    var mrp = val.mrp;
                    var roomcapacity = val.roomcapacity;
                    var noAdult = val.noAdult;
                    var noBathroom = val.noBathroom;
                    var noBed = val.noBed;
                    var noChild = val.noChild;
                    var fullImgUrl = val.fullImgUrl;
                    var active = '';

                    if(rid != ''){
                        if(rid == roomId){
                            loadRoomDetail(rid);
                            active = 'active';
                        }
                    }else{
                        if(key == 0){
                            loadRoomDetail(roomId);
                            active = 'active';
                        }
                    }
                    
                    html = `<li class="db">
                                <a data-rid="${roomId}" class="listAnchor dFlex aic amenitieItem ${active}" href="javascript:void(0)">
                                    <div class="image w50 h50"><img src="${fullImgUrl}"/></div>
                                    <h4>${header}</h4>
                                </a>
                            </li>`;

                    $('#loadRoomsData .listItem').append(html);
                });
            });
        }

        
        

        $(document).ready(() => {
            loadRoomsData();
            // loadUserDetail(<?= $_SESSION['ADMIN_ID'] ?>);

            $(document).on('click', '#newRoomBtn', function(e) {
                e.preventDefault();
                var data = amenitieForm();
                showModalBox('New Amenitie', 'Add Amenitie', data, 'submitNewAmenitieBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();
            });

            $(document).on('change', '.checkAmenitieImg', function(){
                var file = $(this);
                var error = $(this).attr('id');
                var slug = $('#slug').val();
                if(slug != ''){
                    var elementId = $(this).attr('id');
                    var accessValue = $(this).data('rid');
                    imageFileCheckAndUpdate(file,error,slug,'amenitie',elementId);
                }else{
                    file.val('');
                    alert('Room name is required.');
                }

            });

            $(document).on('click', '#submitNewAmenitieBtn', function(e) {
                e.preventDefault;
                var formData = $('#newAmenitieForm').serialize() + `&request_type=newAmenitieSubmit`;

                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;
                    var uid = response.uid;

                    if (status == 'success') {
                        sweetAlert(msg);
                        // loadUsersData(uid);
                        $('#popUpModal').modal('hide');
                        $('#newUserForm').trigger("reset");
                    }
                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                });
            });

            $(document).on('click', '.amenitieItem', function(e) {
                e.preventDefault();
                console.log('tesr');
                var aid = $(this).data('aid');
                $('.amenitieItem').removeClass('active');
                $(this).addClass('active');
                loadAmenitieDetail(aid);
            });

            $(document).on('click', '#editAmenitieDetailBtn', function(e){
                e.preventDefault();
                var aid = $(this).data('aid');
                var formData = `request_type=loadAmenitieDetail&aid=${aid}`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var aid = response.id;
                    var title = response.title;
                    var fullImgUrl = response.fullImgUrl;
                    var img = response.img;

                    var data = amenitieForm(aid,title,fullImgUrl,img);
                    showModalBox('Update Amenitie', 'Update', data, 'submitUpdateAmenitieBtn');
                    var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                    myModal.show();
                });
                
            });

            $(document).on('click','#submitUpdateAmenitieBtn', function(e){
                var aid = $('#aid').val();
                var formData = $('#newAmenitieForm').serialize()+ `&request_type=updateAmenitieSubmit`;
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;

                    if (status == 'success') {
                        sweetAlert(msg);
                        loadAmenitiesData(aid);
                        loadAmenitieDetail(aid);
                        $('#popUpModal').modal('hide');
                        $('#newUserForm').trigger("reset");
                    }
                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                });
            });

        });
    </script>

</body>

</html>