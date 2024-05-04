<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

checkLoginAuth();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Activity</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">

            <div class="row mt-4 justify-content-center">

                <?= backNavbarUi('', 'Activity') ?>

                <div class="col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="guestListTable" border="1" class="table align-items-center mb-0 tableLine">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-left">SN</th>
                                        <th scope="col" class="text-right">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sn = 0;
                                        $currentDate = date('Y-m-d');
                                        if(count(getActiveFeed(15,'','','','','19',$currentDate)) > 0){
                                            foreach(getActiveFeed(15,'','','','','19',$currentDate) as $item){
                                                $sn ++;
                                                $addOn = $item['addOn'];
                                                $reason = $item['reason'];
                                                echo '
                                                    <tr>
                                                        <td>'.$sn.'</td>
                                                        <td>'.$reason.'</td>
                                                    </tr>
                                                ';
                                            }
                                        }else{
                                            echo '<tr>
                                                    <td colspan="2">No data</td>
                                                </tr>';
                                        }
                                        
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>


    <script>
        $('.linkBtn').removeClass('active');
        $('.setupLink').addClass('active');
    </script>

</body>

</html>