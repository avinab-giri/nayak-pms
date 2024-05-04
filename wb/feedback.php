<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2],20);
$hotelId = $_SESSION['HOTEL_ID'];

$backLink = FRONT_SITE.'/wb';
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

    <title>Feedback</title>

    <?php include(FO_SERVER_SCREEN_PATH.'link.php') ?>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <div class="container py-2" id="manage_room">

            <div class="row">
                <?php 
                    $navHtml = '<a href="javascript:void(0)" id="addWbFeedbackBtn"><button type="button"
                    class="btn bg-gradient-info mb-0">Add </button></a>';
                    echo backNavbarUi('','Feed-back',$navHtml);
                ?>

                <div class="col-12">
                    <div class="multisteps-form">


                        <div class="card p-3">
                            <div class="card-body">
                                <div class="table-responsive" id="loadwbFeedbackData">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Rating</th>
                                                <th>Description</th>
                                                <th>Order</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        
    </main>
    
    <?php include(FO_SERVER_SCREEN_PATH.'footer.php') ?>
    <div id="indexSlidBar">
        <div class="closeContent"></div>
        <div class="contatent">
            <div class="close"></div>
            <div class="box">

            </div>
        </div>
    </div>


    <div id="popUpBox">
        <div class="closeBox"></div>
        <div class="content">
            <div class="closeBtn">X</div>
            <div class="contentArea">

            </div>
        </div>
    </div>

    <?php include(FO_SERVER_SCREEN_PATH.'script.php') ?>

    <script src="https://cdn.tiny.cloud/1/399rrg57heum2xqy7vargq4wj08owmm8o5jb3bxjxfpuwnge/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>





    <script>
    $('.linkBtn').removeClass('active');
    $('.wbLink').addClass('active');
    </script>

    <script>

    function loadWbFeedbackList() {
        $.ajax({
            url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
            type: 'post',
            data: {
                type: 'loadWbFeedbackList'
            },
            success: function(data) {
                var response = JSON.parse(data);
                var html = '';
                $.each(response, function(key,val){
                    var sn = val.sn;
                    var id = val.id;
                    var name = val.name;
                    var email = val.email;
                    var rating = val.rating;
                    var description = val.description;
                    var img = val.img;
                    var status = val.status;
                    var feedbackorder = val.feedbackorder;
                    var feedbackOrderHtml = val.feedbackOrderHtml;

                    if(status == 1){
                        var statusHtml = "<a class='tableIcon status bg-gradient-success status deactive' href='javascript:void(0)' data-fid='$id' data-tooltip-top='Deactive' ><i class='far fa-eye'></i></a>";
                    }else{
                        var statusHtml = "<a class='tableIcon status bg-gradient-warning status  active' href='javascript:void(0)' data-fid='$id' data-tooltip-top='Active'  ><i class='far fa-eye-slash'></i></a>";
                    }

                    html += `
                        <tr>
                            <td width="5%" class="mb-0 text-xs left"><img style="width: 100%;" src="${img}"></td>
                            <td width="15%" class="mb-0 text-xs">${name}</td>
                            <td width="20%" class="mb-0 text-xs">${email}</td>
                            <td width="10%" class="mb-0 text-xs">${rating}</td>
                            <td width="25%" class="mb-0 text-xs">${description}</td>
                            <td width="10%" class="mb-0 text-xs">
                                <select class="form-control wbFeedOrder" style="width: 113px;font-size: 12px;" data-fid="${id}">${feedbackOrderHtml}</selsect>
                            </th>
                            <td width="15%" class="mb-0 text-xs">
                                
                                <div class="tableCenter">
                                    <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                    <span class="tableHoverShow">
                                    ${statusHtml}
                                        <a class="tableIcon update bg-gradient-info" href="javascript:void(0)" data-fid="${id}" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                        <a class="tableIcon delete bg-gradient-danger" href="javascript:void(0)" data-fid="${id}" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                $('#loadwbFeedbackData tbody').html(html);
                $('#loadwbFeedbackData table').dataTable();
            }
        });
    }

    function addWbFeedFormSec() {
        $('#popUpBox').addClass('show');

        $.ajax({
            url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
            type: 'post',
            data: {
                type: 'showAddWbFeedForm'
            },
            success: function(data) {
                $('#popUpBox .contentArea').html(data);
                tinymce.init({
                    selector: 'textarea#feedback',
                    height:300,
                    plugins: 'code',
                    menubar: false
                });
            }
        });
    }

    $(document).ready(function() {

        loadWbFeedbackList();

        $('#addWbFeedbackBtn').on('click', function() {

            addWbFeedFormSec();

        });

        $(document).on('submit', '#addwbFeedForm', function(e) {
            e.preventDefault();
            $('#addwbFeedForm button').prop('disabled', false);
            $('#addwbFeedForm button').html('Loading..');
            var data = new FormData(this);
            data.append('type', 'addWbFeedSubmit');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
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
                    if(error == 'no'){
                        loadWbFeedbackList();
                        $('#popUpBox').removeClass('show');
                        sweetAlert(msg);
                    }

                    if(error == 'yes'){
                        sweetAlert(imgMsg, 'error');
                    }
                }
            });

        });

        $(document).on('click', '.update', function() {
            var rnid = $(this).data('fid');
            $('#popUpBox').addClass('show');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'editWbFeedForm',
                    id: rnid
                },
                success: function(data) {
                    $('#popUpBox .contentArea').html(data);
                    tinymce.init({
                            selector: 'textarea#feedback',
                            height:300,
                            plugins: 'code',
                            menubar: false
                        });
                }
            });
        });

        $(document).on('submit', '#updatewbFeedForm', function(e) {
            e.preventDefault();
            $('#updatewbFeedForm button').prop('disabled', false);
            $('#updatewbFeedForm button').html('Loading..');
            var data = new FormData(this);
            data.append('type', 'updateWbFeedSubmit');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    loadWbFeedbackList();
                    $('#popUpBox').removeClass('show');
                    Swal.fire("Good job!", "Successfully Update.", "success");
                }
            });

        });

        $(document).on('click', '.delete', function() {
            var gid = $(this).data('fid');

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
                            url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                            type: 'post',
                            data: {
                                type: 'deleteWbFeed',
                                sid: gid
                            },
                            success: function(data) {
                                if (data == 1) {
                                    loadWbFeedbackList();
                                    Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success' );
                                } else {
                                    Swal.fire("Your Blog record is safe!");
                                }
                            }
                        });
                    }

                    if (willDelete.isConfirmed) {
                        deleteRoom();
                        loadWbFeedbackList();
                    }

                });
        });

        $(document).on('click', '.status', function() {

            var rid = $(this).data('fid');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'statusUpdateForFeed',
                    rid: rid
                },
                success: function(data) {
                    if (data == 1) {
                        loadWbFeedbackList();
                        Swal.fire("Good job!", "Successfull change status.", "success");
                    }
                }
            });
        });

        $(document).on('change', '.wbFeedOrder', function() {
            var order = $(this).val();
            var sid = $(this).data('fid');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'updateWbFeedOrder',
                    sid: sid,
                    order: order
                },
                success: function(data) {
                    if (data == 1) {
                        loadWbFeedbackList();
                        Swal.fire("Good job!", "Successfull change Order.", "success");
                    }
                }
            });
        });

        $(document).on('change', '#feedbackImg', function(e){
            e.preventDefault();
            var fileSize = this.files[0].size;
            var type = this.files[0].type;

            imageValidation(type,fileSize);
        });

    });
    </script>



</body>

</html>