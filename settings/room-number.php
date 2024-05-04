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

    <title>Room Number</title>

    <?php
    include(FO_SERVER_SCREEN_PATH . 'link.php');
    ?>



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
                <div class="innerLink dFlex aic">
                    <ul class="innerNav" style="margin-right: 25px;">
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/rooms' ?>">Rooms</a></li>
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/room-number' ?>">Room Number</a></li>
                        <li class="item"><a href="<?= FRONT_SITE . '/settings/delete-rooms' ?>">Delete rooms</a></li>
                    </ul>

                    <ul>
                        <li class="db"><a href="javascript:void(0)"><button type="button" id="addRoomNumerBtn" class="btn bg-gradient-info m-0">Add Room Number</button></a></li>
                    </ul>

                </div>
                <div class="detailView">
                    <div id="loadRoomNumData"></div>
                </div>
            </div>
        </section>

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

    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>

    <script>
        $('.hotelNav').addClass('active');
        $('.hotelNav .rooms').addClass('active');


        function loadRoomNumber() {
            $.ajax({
                url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                type: 'post',
                data: {
                    type: 'loadRoomNumber'
                },
                success: function(data) {
                    $('#loadRoomNumData').html(data);
                }
            });
        }


        $(document).ready(function() {

            loadRoomNumber();

            $('#addRoomNumerBtn').on('click', function() {
                $('#popUpBox').addClass('show');

                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                    type: 'post',
                    data: {
                        type: 'addRoomNumForm'
                    },
                    success: function(data) {
                        $('#popUpBox .contentArea').html(data);
                    }
                });

            });

            $(document).on('submit', '#addRoomNumberForm', function(e) {
                e.preventDefault();
                var data = $('#addRoomNumberForm').serialize() + '&type=submitRoomNumber';

                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                    type: 'post',
                    data: data,
                    success: function(data) {
                        loadRoomNumber();
                        if (data == 0) {
                            Swal.fire("Something error?", "Already exist room number.", "error");
                        }
                        if (data == 1) {
                            Swal.fire("Good job!", "Successfull add room number.", "success");
                        }

                        $('#popUpBox').removeClass('show');
                    }
                });

            });

            $(document).on('click', '.status', function() {
                var rnid = $(this).data('rnid');
                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                    type: 'post',
                    data: {
                        type: 'statusUpdate',
                        rnid: rnid
                    },
                    success: function(data) {
                        if (data == 1) {
                            loadRoomNumber();
                            Swal.fire("Good job!", "Successfull change status.", "success");
                        }
                    }
                });
            });

            $(document).on('click', '.delete', function() {
                var rnid = $(this).data('rnid');
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
                        function deleteRoomNumber() {
                            $.ajax({
                                url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                                type: 'post',
                                data: {
                                    type: 'deleteRoomNumber',
                                    rnid: rnid
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        loadRoomNumber();
                                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    } else {
                                        Swal.fire("Your room number record is safe!");
                                    }
                                }
                            });
                        }

                        if (willDelete.isConfirmed) {
                            deleteRoomNumber();
                        }

                    });
            });


            $(document).on('click', '.update', function() {
                var rnid = $(this).data('rnid');
                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                    type: 'post',
                    data: {
                        type: 'editRoomNumberForm',
                        rnid: rnid
                    },
                    success: function(data) {
                        showModalBox('Room number', '', data);
                        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
                        myModal.show();
                    }
                });
            });

            $(document).on('submit', '#updateRoomNumberForm', function(e) {
                e.preventDefault();
                var data = $('#updateRoomNumberForm').serialize() + '&type=updateSubmitRoomNumber';

                $.ajax({
                    url: '<?= FRONT_SITE ?>/include/ajax/room.php',
                    type: 'post',
                    data: data,
                    success: function(data) {
                        loadRoomNumber();
                        if (data == 0) {
                            Swal.fire("Something error?", "Already exist room number.", "error");
                        }
                        if (data == 1) {
                            $('#popUpModal').modal('hide');
                            sweetAlert("Successfull update room number.");
                        }
                        $('#popUpBox').removeClass('show');
                    }
                });

            });

        });
    </script>

</body>

</html>