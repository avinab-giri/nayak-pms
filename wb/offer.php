<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2],19);
$hotelId = $_SESSION['HOTEL_ID'];

$otitle = '';
$price = '';
$image = '';
$percentage = '';
$code = '';
$oldImg = '';

if(count(getWbOfferData()) != ''){
    $row = getWbOfferData()[0];
    $otitle = ($row['title'] == '') ? 'Null' : $row['title'];
    $price = ($row['price'] == '') ? 'Null' : $row['price'];
    $image = $row['img'];
    $percentage = ($row['percentage'] == '') ? 'Null' : $row['percentage'];
    $code = ($row['code'] == '') ? 'Null' : $row['code'];
    $oldImg = ($row['img'] == '') ? 'Null' : $row['img'];
}


if(isset($_POST['submit'])){
   
    $otitle = $_POST['otitle'];
    $price = $_POST['price'];
    $percentage = $_POST['percentage'];
    $code = $_POST['code'];
    
    if(count(getWbOfferData()) == ''){
        if($_FILES['image']['name'] != ''){
            $newfilename = imgUploadWithData($_FILES['image'],'offer',$oldImg)['img'];
            $sql = "insert into wb_offersection(title,price,percentage,code,img,hotelId) values('$otitle','$price','$percentage','$code','$newfilename','$hotelId')";
        }else{
            $sql = "insert into wb_offersection(title,price,percentage,code,hotelId) values('$otitle','$price','$percentage','$code','$hotelId')";
        }
    }else{
        if($_FILES['image']['name'] != ''){
            $newfilename = imgUploadWithData($_FILES['image'],'offer',$oldImg)['img'];
            $sql = "update wb_offersection set title='$otitle',price='$price',percentage='$percentage',code='$code',img='$newfilename' where hotelId ='$hotelId'";
        }else{
            $sql = "update wb_offersection set title='$otitle',price='$price',percentage='$percentage',code='$code' where hotelId ='$hotelId'";
        }
    }

    
    if(mysqli_query($conDB, $sql)){
        redirect('offer.php');
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

    <title>Offer </title>

    <?php include(FO_SERVER_SCREEN_PATH.'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">
            

            <div class="row mt-2">
                <?php 
                    echo backNavbarUi('','Offer');
                ?>

                <div class="col-12">
                    <div class="multisteps-form">


                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">

                                <div class="card p-3">
                                    <form method="POST" id="profileForm" enctype="multipart/form-data">
                                        <div class="form_group mb-3">
                                            <label for="otitle">Offer Title</label>
                                            <input class="form-control" type="text" name="otitle" id="otitle"
                                                value="<?php echo $otitle ?>">
                                        </div>
                                        <div class="form_group mb-3">
                                            <label for="price">Price</label>
                                            <input class="form-control" type="number" name="price" id="price"
                                                value="<?php echo $price ?>">
                                        </div>
                                        <div class="form_group mb-3">
                                            <?php
                                            
                                            if($image == ''){
                                                echo '';
                                            }else{
                                                $logo_path = getImgPath('public', $image);
                                                echo "
                                                    <img src='$logo_path' style='width:50px'>
                                                    <br/>
                                                ";
                                            }
                                        
                                        ?>
                                            <label for="image">Image ( Image should be width 460px and height 460px
                                                )</label>
                                            <input class="form-control mb-3" type="file" accept="image/jpeg" name="image" id="image">
                                        </div>
                                        <div class="form_group mb-3">
                                            <label for="percentage">Percentage</label>
                                            <input class="form-control" type="number" name="percentage" id="percentage"
                                                value="<?php echo $percentage ?>">
                                        </div>
                                        <div class="form_group mb-3">
                                            <label for="code">Use Code</label>
                                            <input class="form-control" type="text" name="code" id="code"
                                                value="<?php echo $code ?>">
                                        </div>
                                        <input class="form-control btn bg-gradient-primary btn-sm mb-0" type="submit"
                                            name="submit" value="Update">
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'booing_detail.php') ?>

    <section id="popupBox">
        <div class="closeBox"></div>
        <div class="box">
            <div class="content">

            </div>
        </div>
    </section>



    <?php include(FO_SERVER_SCREEN_PATH.'script.php') ?>

    <script>
    $('.linkBtn').removeClass('active');
    $('.wbLink').addClass('active');

    $(document).on('change', '#image', function(e){
        e.preventDefault();
        var fileSize = this.files[0].size;
        var type = this.files[0].type;

        imageValidation(type,fileSize);
    });

    </script>

</body>

</html>