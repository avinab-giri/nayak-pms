<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2],16);
$hotelId = $_SESSION['HOTEL_ID'];

if(isset($_GET['remove'])){
    $remove_img = $_GET['remove'];
    
    $title = getSlider($remove_img)[0]['title'];
    $subTitle = getSlider($remove_img)[0]['subtitle'];
    $oldImg = getSlider($remove_img)[0]['img'];
    
    
    $sql = "update herosection set deleteRec = '0' where id = '$remove_img'";
 
    if(mysqli_query($conDB,$sql)){
        // unlink(SERVER_HERO_IMG.$oldImg);
        $_SESSION['SuccessMsg'] = "Successfull Delete";
            redirect('slider.php');
    }else{
        $_SESSION['ErrorMsg'] = "Something Error";
        redirect('slider.php');
    }
    
}

$title = '';
$subTitle = '';
if(isset($_GET['update'])){
    $upId = $_GET['update'];
    $title = getSlider($upId)[0]['title'];
    $subTitle = getSlider($upId)[0]['subtitle'];
    $oldImg = getSlider($upId)[0]['img'];
    
    if(isset($_POST['submit'])){
        // pr($_POST);
        $image = $_FILES['heroImage']['name'];
        if($image == ''){
            $title = $_POST['title'];
            $subTitle = $_POST['subTitle'];
            $sql = "update herosection set title='$title',subTitle='$subTitle' where id = '$upId' ";
        }else{
            $extension=array('jpeg','jpg','JPG','png','gif');
            $roomImgName = $_FILES['heroImage']['name'];
            $roomImgTemp = $_FILES['heroImage']['tmp_name'];
            $ext=pathinfo($roomImgName,PATHINFO_EXTENSION);
            if(in_array($ext,$extension)){
                $newfilename=rand(100000,999999).".".$ext;
                $title = $_POST['title'];
                $subTitle = $_POST['subTitle'];
                
                unlink(SERVER_HERO_IMG.$oldImg);
                
                move_uploaded_file($roomImgTemp, SERVER_HERO_IMG.$newfilename);
                
                $sql = "update herosection set img='$newfilename', title='$title',subTitle='$subTitle' where id = '$upId' ";
                
            }
        }
        
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfull Add Record";
            redirect('slider.php');
        }else{
            $_SESSION['ErrorMsg'] = "Something Wrong";
            redirect('slider.php');
        }
        
        
    }
    
}else{
    if(isset($_POST['submit'])){
        // pr($_FILES);
        $image = $_FILES['heroImage']['name'];
        $extension=array('jpeg','jpg','JPG','png','gif');
        $roomImgName = $_FILES['heroImage']['name'];
        $roomImgTemp = $_FILES['heroImage']['tmp_name'];
        $ext=pathinfo($roomImgName,PATHINFO_EXTENSION);
        if(in_array($ext,$extension)){
            $newfilename=rand(100000,999999).".".$ext;
            $title = $_POST['title'];
            $subTitle = $_POST['subTitle'];
            move_uploaded_file($roomImgTemp, SERVER_IMG.'hero/'.$newfilename);
            
            $sql = "insert into herosection(img,title,subTitle,hotelId) values('$newfilename','$title','$subTitle','$hotelId')";
            
        }
        
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfull Add Record";
            redirect('slider.php');
        }else{
            $_SESSION['ErrorMsg'] = "Something Wrong";
            redirect('slider.php');
        }
        
        
    }
}

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

    <title>Slider</title>

    <?php include(FO_SERVER_SCREEN_PATH.'link.php') ?>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container py-2" id="manage_room">

            <div class="row">
                <?php 
                    $navHtml = '<a href="javascript:void(0)" id="addWbSliderBtn"><button type="button"
                    class="btn bg-gradient-info">Add </button></a>';
                    echo backNavbarUi('','Slider',$navHtml);
                ?>
                <div class="col-12 ">


                    
                    <div class="card p-3">
                        <div class="card-body">
                            <div class="table-responsive" id="loadwbSliderData"></div>
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







    <script>
    $('.linkBtn').removeClass('active');
    $('.wbLink').addClass('active');
    </script>

    <script>
    function loadWbSliderList() {
        $.ajax({
            url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
            type: 'post',
            data: {
                type: 'loadWbSliderList'
            },
            success: function(data) {
                $('#loadwbSliderData').html(data);
                $('#loadwbSliderData table').dataTable();
            }
        });
    }

    function addWbSliderFormSec() {
        $('#popUpBox').addClass('show');

        $.ajax({
            url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
            type: 'post',
            data: {
                type: 'showAddWbSliderForm'
            },
            success: function(data) {
                $('#popUpBox .contentArea').html(data);
            }
        });
    }

    $(document).ready(function() {

        loadWbSliderList();

        $('#addWbSliderBtn').on('click', function() {

            addWbSliderFormSec();

        });

        $(document).on('submit', '#addwbSliderForm', function(e) {
            e.preventDefault();
            $('#addwbSliderForm button').prop('disabled', false);
            $('#addwbSliderForm button').html('Loading..');
            var data = new FormData(this);
            data.append('type', 'addWbSliderSubmit');
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
                    var img = response.img;
                    var msg = response.msg;
                    var imgError = (img.error == 'true') ? img.msg : msg;
                    $('#popUpBox').removeClass('show');
                    loadWbSliderList();

                    if(error == 'no'){                        
                        sweetAlert(imgError);
                    }

                    if(error == 'yes'){
                        sweetAlert(imgError,'error');
                    }
                    
                    
                }
            });

        });

        $(document).on('click', '.update', function() {
            var rnid = $(this).data('sid');
            $('#popUpBox').addClass('show');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'editWbSliderForm',
                    id: rnid
                },
                success: function(data) {
                    $('#popUpBox .contentArea').html(data);
                }
            });
        });

        $(document).on('submit', '#updatewbSliderForm', function(e) {
            e.preventDefault();
            $('#updatewbSliderForm button').prop('disabled', false);
            $('#updatewbSliderForm button').html('Loading..');
            var data = new FormData(this);
            data.append('type', 'updateWbSliderSubmit');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    loadWbSliderList();
                    $('#popUpBox').removeClass('show');
                    Swal.fire("Good job!", "Successfully Update Record.", "success");
                }
            });

        });

        $(document).on('click', '.delete', function() {
            var gid = $(this).data('sid');

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
                                type: 'deleteWbSlider',
                                sid: gid
                            },
                            success: function(data) {
                                if (data == 1) {
                                    loadWbSliderList();
                                    Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success' );
                                } else {
                                    Swal.fire("Your Slider record is safe!");
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

            var rid = $(this).data('sid');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'statusUpdateForSlider',
                    rid: rid
                },
                success: function(data) {
                    if (data == 1) {
                        loadWbSliderList();
                        Swal.fire("Good job!", "Successfull change status.", "success");
                    }
                }
            });
        });


        $(document).on('change', '.wbSliderOrder', function() {
            var order = $(this).val();
            var sid = $(this).data('sid');
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'updateWbSliderOrder',
                    sid: sid,
                    order: order
                },
                success: function(data) {
                    if (data == 1) {
                        loadWbSliderList();
                        Swal.fire("Good job!", "Successfull change Order.", "success");
                    }
                }
            });
        });

        $(document).on('change', '#roomImage1', function(e){
            e.preventDefault();
            var fileSize = this.files[0].size;
            if(fileSize > 500000){
                sweetAlert('File too large. File must be less than 500Kb.','error');
            }
        });

    });
    </script>



</body>

</html>