<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

checkLoginAuth();

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

    <title>Payment</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php'); ?>

    <style>
        .paymentEditBtn {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 15;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translate(1px, -1px);
            border: 1px solid #cb0c9f;
            padding: 8px;
            background: white;
        }

        #domiCheckOut {
            display: block;
            box-shadow: 0 0 15px #d1d1d1;
            max-width: 350px;
            border-radius: 3px;
            padding: 25px 10px;
            position: sticky;
            top: 0;
            margin: 0 0 0 auto;
        }

        #domiCheckOut .skltline {
            width: 25px;
            height: 5px;
            display: inline-block;
            background: #d9d9d9;
            border-radius: 5px;
        }

        #domiCheckOut .advanceOpt {
            position: relative;
            margin: 5px 0;
        }

        #domiCheckOut .advanceOpt li {
            border: 1px solid black;
            padding: 2px 10px;
        }

        #domiCheckOut button {
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: green;
            color: white;
            font-weight: 700;
            letter-spacing: .05em;
            opacity: .5;
        }
    </style>

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
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/payment' ?>">Payment</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="checkOutArea row h100p">
                        <form action="" id="verifayPaymentForm">
                            <div class="form-group">
                                <input type="checkbox" id="varifayPaymentCheck" name="varifayPaymentCheck">
                                <label for="varifayPaymentCheck">Verify payment</label>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="paymentProofCheck" name="paymentProofCheck">
                                <label for="paymentProofCheck">Payment Proof</label>
                            </div>


                            <input type="submit" value="Submit">

                        </form>
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
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.pmsNav').addClass('active');
        $('.pmsNav .payment').addClass('active');






        $(document).ready(function() {
            checkVerifiedOrNot();
            $('#verifayPaymentForm').on('submit', function(event) {
                event.preventDefault();
                var verifyPaymentChecked = $('#varifayPaymentCheck').is(':checked');
                var paymentProofChecked = $('#paymentProofCheck').is(':checked');
                if (verifyPaymentChecked) {
                    var data = new FormData();
                    data.append('type', 'varifyPaymentCheck');
                    $.ajax({
                        url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                } else {
                    var data = new FormData();
                    data.append('type', 'cancelVarifyPaymentCheck');
                    $.ajax({
                        url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
                if (paymentProofChecked) {
                    
                    var data = new FormData();
                    data.append('type','paymentProofChecked');
                    $.ajax({
                        url:"<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                        type:"POST",
                        data:data,
                        processData: false,
                        contentType: false,
                        success: function(data){
                            console.log(response);
                        },
                        error: function(error){
                            comsole.log(error);
                        }
                    })

                } else {
                    var data = new FormData();
                    data.append('type','cancelPaymentProofChecked');
                    $.ajax({
                        url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                        type:"POST",
                        data:data,
                        processData:false,
                        contentType: false,
                        success: function(response){
                            console.log(response);
                        },
                        error: function(error){
                            console.log(response);
                        }
                    })
                }

            });

        });

        function checkVerifiedOrNot() {

            var data = new FormData();
            data.append('type', 'checkVerifiedOrNot');
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    var verifd= res.verified; 
                    var prf = res.proof;

                    if(verifd.trim()=='1'){
                        $('#varifayPaymentCheck').prop('checked', true);
                    }
                    if(prf.trim() =='1'){
                        $('#paymentProofCheck').prop('checked',true);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    </script>

</body>

</html>