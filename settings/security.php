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

    <title>Security</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.css"
        rel="stylesheet" />
    <?php 
        include(FO_SERVER_SCREEN_PATH.'link.php');
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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/security' ?>">Security</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="row securityArea">
                        <div class="col-xl-4 col-md-6 col-sm-6 pR0 rightBorder">
                            <ul id="securityContent">
                                <li>
                                    <a href="javascript:void(0)" data-target="password" class="db dFlex aic jcsb active">
                                        <span class="dib">Password</span> 
                                        <svg class="w20 h20"><use href="#rightArrowIcon"></use></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-target="twoStepVerification" class="db dFlex aic jcsb">
                                        <span class="dib">Two-step verification</span> 
                                        <svg class="w20 h20"><use href="#rightArrowIcon"></use></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-8 col-md-6 col-sm-6">
                             <div id="loadSecurityDetail">
                                
                             </div>
                        </div>
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

        $('.ganeralNav').addClass('active');
        $('.ganeralNav .security').addClass('active');

        function loadUsersData(uid=''){
            var formData = `request_type=loadUsersData&uid=${uid}`;
            ajax_request(formData).done((data)=>{
                var response = JSON.parse(data);
                $('#loadUsersData').html(response);
            });
        }

        function loadSecurityData(target=''){
            var html ='';
            if(target == 'security'){
                html = `
                        <h4 class="mB10">Change Password</h4>
                        <p>When you change your password, we keep you logged in to this device but may log you out from your other devices.</p>
                        <form id="changePasswordForm">
                            <div class="form-group">
                                <label for="currentPswd">Current Password</label>
                                <input id="currentPswd" type="password" minlength="6" class="form-control" placeholder="Enter current password.">
                                <div class="input-group-append toggle-password">
                                    <span class="mdi mdi-eye-outline"></span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="newPswd">New Password</label>
                                <input id="newPswd" minlength="6" type="password" class="form-control" placeholder="Enter New password.">
                                <div class="input-group-append toggle-password">
                                    <span class="mdi mdi-eye-outline"></span>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="confirmPswd">Confirm Password</label>
                                <input id="confirmPswd" minlength="6" type="password" class="form-control" placeholder="Enter Confirm password.">
                                <div class="input-group-append toggle-password">
                                    <span class="mdi mdi-eye-outline"></span>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark mb-0 text-end" href="javascript:;">Change Password</button>
                        </form>`;
            }
            $('#loadSecurityDetail').html(html);
        }

        $(document).ready(()=>{
            loadSecurityData('security');
            

            $('.toggle-password').click(function() {
                $(this).children().toggleClass('mdi-eye-outline mdi-eye-off-outline');
                let input = $(this).prev();
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });

            $(document).on('submit','#changePasswordForm', function(e){
                e.preventDefault();
                var currentPswd = $('#currentPswd').val().trim();
                var newPswd = $('#newPswd').val().trim();
                var confirmPswd = $('#confirmPswd').val().trim();
                var formData = `request_type=changePassword&currentPswd=${currentPswd}&newPswd=${newPswd}&confirmPswd=${confirmPswd}`;

                if(currentPswd == ''){
                    sweetAlert('Current password is required!','error');
                }else if(newPswd == ''){
                    sweetAlert('New password is required!','error');
                }else if(confirmPswd == ''){
                    sweetAlert('Confirm password is required!','error');
                }else{
                    ajax_request(formData).done((data)=>{
                        var response = JSON.parse(data);
                        console.log(response);
                        var status = response.status;
                        var msg = response.msg;

                        if(status == 'success'){
                            $('#changePasswordForm').trigger('reset');
                            sweetAlert(msg);
                        }
                        if(status == 'error'){
                            sweetAlert(msg,'error');
                        }

                    });
                }
            });
        });
        
    </script>

</body>

</html>