<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();


checkProductExistOrNot([3], 5);

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

    <title>Guest data </title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">


            <div class="row mt-4">
                <?php
                $navHtml = '<ul class="dFlex aic">
                                    <li class="dib mr4"><button id="addGuestDataBtn" class="btn btn-outline-primary m-0">Add Guest</button></li>
                                    <li class="dib "><button id="exportData" class="btn btn-outline-secondary m-0">Export</button></li>
                                </ul>';
                echo backNavbarUi('', 'Guest', $navHtml);
                ?>
                <div class="col-12">


                    <div id="errorBox"></div>

                    <div class="card" id="guestDatabaseContent">
                        <div class="card-head">
                            <div class="table_nav">
                                <div class="dFlex">
                                    <div class="leftSide">
                                        <ul>
                                            <li class="dib">
                                                <label for="filterWithDate">Date</label>
                                                <input class="customInput" type="date" id="filterWithDate">
                                            </li>
                                            <li class="dib">
                                                <label for="filterWithDis">District</label>
                                                <select class="customInput" name="filterWithDis" id="filterWithDis">
                                                    <option value="">---</option>
                                                    <?php
                                                    foreach (json_decode(listOfOdishaDistric()) as $item) {
                                                        echo "<option value='$item'>$item</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </li>
                                            <li class="dib">
                                                <label for="filterWithSearch">Search</label>
                                                <input class="customInput" type="text" placeholder="Enter name, email or phone" id="filterWithSearch">
                                            </li>

                                            <li class="dib">
                                                <label for="filterWithBirthday">Birthday</label>
                                                <input class="customInput" type="date" id="filterWithBirthday">
                                            </li>
                                            <li class="dib">
                                                <label for="filterWithAnniversary">Anniversary</label>
                                                <input class="customInput" type="date" id="filterWithAnniversary">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="rightSide">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div id="guestListTableContent" class="table table-responsive">
                                <?= loadTableSkeleton() ?>
                            </div>
                            <div class="s25"></div>
                            <ul id="pagination" class="pagination pagination-sm pagination-primary"></ul>
                        </div>
                    </div>

                    <div id="loadAddGuest"></div>



                </div>

    </main>

    <section id="popupBox">
        <div class="closeBox"></div>
        <div class="box">
            <div class="content">
                <form action="">
                    <div class="card">
                        <div class="card-head">
                            <h4>Add Guest</h4>
                            <a href="javascript:void(0)">X</a>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="file" accept="image/jpeg" name="guestImg[]">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" placehold="Enter Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" placehold="Enter Phone Number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" placehold="Enter Email Id" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender</label> <br />
                                                <input type="radio" name="gender" value="male" id="male"><label class="mr5" for="male">Male</label>
                                                <input type="radio" name="gender" value="female" id="female"><label class="mr5" for="female">Female</label>
                                                <input type="radio" name="gender" value="other" id="other"><label for="other">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Zip</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>


                            </div>

                            <hr>
                            <h4>Other Information</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="file" accept="image/jpeg" name="guestIdProofImg[]">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ID Number</label>
                                                <input type="text" placehold="Enter ID Number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ID Type</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Issuing Country</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">-Select-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Issuing City</label>
                                                <input type="text" placehold="Issuing City" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Expiry Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-foot">
                            <button class="btn btn-outline-secondary">Close</button>
                            <button type="submit" class="btn bg-gradient-info">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>




    <script>
        $('.linkBtn').removeClass('active');
        $('.guestLink').addClass('active');


        $(document).on('change', "input[type='checkbox']", function() {
            var target = $(this).parent().parent();
            if ($(this).is(':checked')) {
                target.addClass('active');
            } else {
                target.removeClass('active');
            }

        });

        $(document).ready(() => {

            loadGuest();


            $('#addGuestDataBtn').click(function() {
                loadAddGuestReservationForm('', '#addGestOnReservation .content', '', '', '', '', '', '',
                    'guest');
            });

            $(document).on('click', '.guestDetailBtn', function(e) {
                e.preventDefault();
                var gid = $(this).data('gid');
                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/guest.php',
                    type: 'post',
                    data: {
                        type: 'loadGuestDetail',
                        gid: gid,
                    },
                    success: function(data) {
                        $('#popupBox').addClass('show center');
                        $('#popupBox .content').html(data);
                    }
                });
            });

            $(document).on('change', '#guestSearchForm', function() {
                var search = $('#quickSearchGuest').val();
                loadGuest('', search);
            });

            $(document).on('click', '#guestSearchBtn', function() {
                var search = $('#quickSearchGuest').val();
                loadGuest('', search);
            });

            $(document).on('change', '#filterWithBirthday', function() {
                var birthday = $("#filterWithBirthday").val();
                loadGuest('', '', 'birthday',birthday);
            });

            $(document).on('change', '#filterWithAnniversary', function() {
                var anniversay = $("#filterWithAnniversary").val();
                loadGuest('', '', 'anniversay',anniversay);
            });

        });

        function exportFile() {
            var currentDate = new Date();
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1;
            $('#guestListTable').table2excel({
                exclude: ".no-export",
                filename: `guestDetails-${day}-${month}.xls`,
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: true
            });
        }

        $(document).on('click', '#exportData', function() {
            exportFile();
        });


        $(document).on('change', '#filterWithDate', function(e) {
            e.preventDefault();
            loadGuest();
        });

        $(document).on('change', '#filterWithDis', function(e) {
            e.preventDefault();
            loadGuest();
        });

        $(document).on('change', '#filterWithSearch', function(e) {
            e.preventDefault();
            loadGuest();
        });
    </script>

</body>

</html>