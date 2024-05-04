<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2], 17);
$hotelId = $_SESSION['HOTEL_ID'];

$backLink = FRONT_SITE . '/wb';
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

    <title>Gallery </title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



        <div class="container">


            <div class="row mt-4">
                <?php
                $navHtml = '<a href="javascript:void(0)" id="addWbGalleryBtn"><button type="button"
                    class="btn bg-gradient-info">Add </button></a>';
                echo backNavbarUi('', 'Gallery', $navHtml);
                ?>

                <div class="col-12">
                    <div class="multisteps-form">


                        <div class="row">

                            <div class="col-12 col-lg-8 m-auto">

                                <div class="s25"></div>
                                <div class="card p-3">
                                    <div class="table-responsive" id="loadwbGalleryData">

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>

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

    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>





    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>



    <script>
        $('.linkBtn').removeClass('active');
        $('.wbLink').addClass('active');

        function loadWbGalleryList() {
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'loadwbGalleryList'
                },
                success: function(data) {
                    $('#loadwbGalleryData').html(data);
                }
            });
        }

        function addWbGalleryFormSec() {
            $('#popUpBox').addClass('show');

            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'showAddWbGalleryForm'
                },
                success: function(data) {
                    $('#popUpBox .contentArea').html(data);
                }
            });
        }

        function loadGalleryCategory() {
            var data = `request_type=loadGalleryCategoryData`;
            var html = '';
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);
                $.each(response, function(key, val) {
                    var id = val.id;
                    var name = val.name;
                    html += `<li><button class="catBtn" data-catid="${id}">${name}</button> <span data-catid="${id}" class="removeGalleryCat">X</span></li>`;
                });

                $('#galleryCanList').html(html);
            });


        }

        $(document).ready(function() {

            loadWbGalleryList();

            $('#addWbGalleryBtn').on('click', function() {

                addWbGalleryFormSec();

            });

            $(document).on('submit', '#addwbGalleryForm', function(e) {
                e.preventDefault();
                $('#addwbGalleryForm button').prop('disabled', false);
                $('#addwbGalleryForm button').html('Loading..');
                var data = new FormData(this);
                data.append('type', 'addWbGallerySubmit');
                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var response = JSON.parse(data);
                        var error = response.error;
                        var msg = response.msg;
                        var img = response.img;
                        var imgMsg = (img == '') ? msg : img.msg;
                        if (error == 'no') {
                            loadWbGalleryList();
                            $('#popUpBox').removeClass('show');
                            sweetAlert(msg);
                        }

                        if (error == 'yes') {
                            sweetAlert(imgMsg, 'error');
                        }
                    }
                });

            });

            $(document).on('click', '.update', function() {
                var rnid = $(this).data('gid');
                $('#popUpBox').addClass('show');
                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: {
                        type: 'editWbGalleryForm',
                        id: rnid
                    },
                    success: function(data) {
                        $('#popUpBox .contentArea').html(data);
                    }
                });
            });

            $(document).on('submit', '#updatewbGalleryForm', function(e) {
                e.preventDefault();
                $('#updatewbGalleryForm button').prop('disabled', false);
                $('#updatewbGalleryForm button').html('Loading..');
                var data = new FormData(this);
                data.append('type', 'updateWbGallerySubmit');
                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var response = JSON.parse(data);
                        var error = response.error;
                        var msg = response.msg;
                        var img = response.img;
                        var imgMsg = (img == '') ? msg : img.msg;
                        if (error == 'no') {
                            loadWbGalleryList();
                            $('#popUpBox').removeClass('show');
                            sweetAlert(msg);
                        }

                        if (error == 'yes') {
                            sweetAlert(imgMsg, 'error');
                        }
                    }
                });

            });

            $(document).on('click', '.delete', function() {
                var gid = $(this).data('gid');
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
                                url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                                type: 'post',
                                data: {
                                    type: 'deleteWbGallery',
                                    gid: gid
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        loadWbGalleryList();
                                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    } else {
                                        Swal.fire("Your Gallery record is safe!");
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
                    url: "<?= FRONT_SITE . '/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: {
                        type: 'statusUpdateForRoom',
                        rid: rid
                    },
                    success: function(data) {
                        if (data == 1) {
                            loadRoomList();
                            Swal.fire("Good job!", "Successfull change status.", "success");
                        }
                    }
                });
            });

            $(document).on('click', '#galleryCategoryAdd', function(e) {
                e.preventDefault();
                var html = `<div><label>Gallery Category (Press enter to store data)</label><input class="form-control" type="text" id="galleryCategoryInput"/><ul id="galleryCanList" class="categoryContentList"></ul></div>`;
                showModalBox('Update status', 'Submit', html, 'roomStatusUpdateBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
                    keyboard: false
                });
                myModal.show();
                loadGalleryCategory();
            });

         
            $(document).on('click', '#roomStatusUpdateBtn', function() {
                console.log('click');
                handleUpdate();
            });

            $(document).on('keyup', '#galleryCategoryInput', function(e) {

                if (e.keyCode == 13) {
                    var value = $(this).val().trim();
                    var editId = ($(this).data('editid') == undefined) ? '' : $(this).data('editid');
                    var data = `request_type=addGalleryCategory&value=${value}&editId=${editId}`;

                    ajax_request(data).done(function(request) {
                        var response = JSON.parse(request);
                        var error = response.error;
                        var msg = response.msg;

                        if (error == 'no') {
                            $('#galleryCategoryInput').val('');
                            loadGalleryCategory();
                            sweetAlert(msg);
                            addWbGalleryFormSec();
                        }

                        if (error == 'yes') {
                            sweetAlert(msg, 'error')
                        }
                    });


                }
            });

            $(document).on('click', '.catBtn', function(e) {
                var catId = $(this).data('catid');
                var text = $(this).html();
                var target = $('#galleryCategoryInput');
                target.val(text);
                target.data('editid', catId);
            });

            $(document).on('click', '.removeGalleryCat', function() {
                var catId = $(this).data('catid');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                    function deleteGalleryCat() {
                        var data = `request_type=removeGalleryCat&catId=${catId}`;
                        ajax_request(data).done(function(request) {
                            var response = JSON.parse(request);
                            var error = response.error;
                            var msg = response.msg;
                            if (error == 'no') {
                                sweetAlert(msg);
                                loadGalleryCategory();
                            }
                            if (error == 'yes') {
                                sweetAlert(msg, 'error')
                            }
                        });
                    }

                    if (willDelete.isConfirmed) {
                        deleteGalleryCat();
                    }

                });


            });

            $(document).on('change', '#galleryimg', function(e) {
                e.preventDefault();
                var fileSize = this.files[0].size;
                var type = this.files[0].type;

                imageValidation(type, fileSize);
            });

            function handleUpdate() {
                console.log('Handling update');
            

                // Your common logic here
                var value = $('#galleryCategoryInput').val().trim();
                var editId = ($('#galleryCategoryInput').data('editid') == undefined) ? '' : $('#galleryCategoryInput').data('editid');
                var data = `request_type=addGalleryCategory&value=${value}&editId=${editId}`;

                ajax_request(data).done(function(request) {
                    var response = JSON.parse(request);
                    var error = response.error;
                    var msg = response.msg;

                    if (error == 'no') {
                        $('#galleryCategoryInput').val('');
                        loadGalleryCategory();
                        sweetAlert(msg);
                        addWbGalleryFormSec();
                    }

                    if (error == 'yes') {
                        sweetAlert(msg, 'error');
                    }
                });
            }


        });
    </script>

</body>

</html>