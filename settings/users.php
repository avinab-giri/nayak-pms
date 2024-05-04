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
    <title>Users</title>
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
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/users' ?>">Users</a></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div class="row usersArea">
                        <div class="col-xl-4 col-md-6 col-sm-6 pR0 rightBorder">
                            <div class="dFlex aic jcsb p10 actionArea">
                                <div class="dropDownArea">
                                    <?php
                                        $dropdownData = [
                                            [
                                                'value'=>'activeUser',
                                                'name'=>'Active Users',
                                                'key'=>'active'
                                            ],
                                            [
                                                'value'=>'inactiveUser',
                                                'name'=>'Inactive Users',
                                                'key'=>'inactive'
                                            ],
                                            [
                                                'value'=>'deleteUser',
                                                'name'=>'Deleted Users',
                                                'key'=>'delete'
                                            ],
                                        ];
                                        echo generateDropdown($dropdownData);
                                    ?>
                                </div>
                                <button id="newUserBtn" type="button" class="btn bg-gradient-info m0">New User</button>
                            </div>
                            <div id="loadUsersData" class="pR scrollBar"></div>
                        </div>
                        <div class="col-xl-8 col-md-6 col-sm-6 h100p">
                             <div id="loadUserDetail" class="scrollBar"></div>
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
        $('.ganeralNav .users').addClass('active');

        $(document).ready(()=>{
            loadUsersData(<?= $_SESSION['ADMIN_ID'] ?>);
            loadUserDetail(<?= $_SESSION['ADMIN_ID'] ?>);

            $(document).on('click', '#newUserBtn', function(e){
                e.preventDefault();
                createUserDetailForm();
            });

            $(document).on('click','#submitNewUserBtn', function(e){
                e.preventDefault;
                var formData =  $('#newUserForm').serialize()+`&request_type=newUserSubmit`;
                
                ajax_request(formData).done((data) => {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;
                    var uid = response.uid;

                    if(status == 'success'){
                        sweetAlert(msg);
                        loadUsersData(uid);
                        $('#popUpModal').modal('hide');
                        $('#newUserForm').trigger("reset");
                    }
                    if(status == 'error'){
                        sweetAlert(msg, 'error');
                    }
                });
            });

            $(document).on('click','.usersLabel', function(e){
                e.preventDefault();
                var uid = $(this).data('uid');
                $('.usersLabel').removeClass('active');
                $(this).addClass('active');
                loadUserDetail(uid,'yes');
            });

            $(document).on('click','.dropdown-item',function(){
                var element = $(this).text();
                $('#dropdownMenuButton1').text(element);
            })

        });
        
    </script>

</body>

</html>