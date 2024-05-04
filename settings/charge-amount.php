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
    <title>Users</title>
    <?php
    include(FO_SERVER_SCREEN_PATH . 'link.php');
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


    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">




        <section id="setupSection">
            <div class="setupLeftSide">
                <?php include(FO_SERVER_SCREEN_PATH . 'setupNav.php') ?>
            </div>
            <div class="setupRightSide">
                <div class="innerLink">
                    <ul class="innerNav d-flex justify-content-between">
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/users' ?>">Lists</a></li>
                        <li class="item"><button id="newUserBtn" type="button" class="btn bg-gradient-info m0">New List</button></li>
                    </ul>
                </div>
                <div class="detailView">
                    <div class="table table-responsive" id="loadChargeData"></div>
                </div>
            </div>
        </section>


    </main>


    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>




    <?php
    include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
    include(FO_SERVER_SCREEN_PATH . 'script.php');
    ?>


    <script>
        $('.hotelNav').addClass('active');
        $('.hotelNav .extracharge').addClass('active');

        function loadDetails() {
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                type: 'POST',
                data: {
                    'type': 'loadExtraChargesDetails'
                },
                success: function(data) {
                    $('#loadChargeData').html(data);
                },
                error: function(error) {
                    sweetAlert('error', 'Something Went Wrong');
                }
            })
        }


        $(document).ready(() => {
            loadDetails();

            $(document).on('click', '#newUserBtn', function(e) {
                e.preventDefault();
                var data = `
                            <form id="newChargeForm" enctype= multipart/form-data>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name">Charge Name</label>
                                        <input name="chargename" id="chargename" type="text" class="form-control" value="" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="amount">Amount</label>
                                        <input name="amount" id="amount" type="number" class="form-control" value="" required>
                                    </div>
                                   
                                </div>
                            </form>
                    `;
                showModalBox('Charge', 'Add Charge', data, 'submitNewCharge');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();




            });

            $(document).on('click', '#submitNewCharge', function() {
                var data = $('#newChargeForm').serialize();
                var formData = `request_type=submitNewCharge&${data}`;
                ajax_request(formData).done(function(response) {

                    if (response.trim() === '"ok"') {
                        sweetAlert('Extra Charge List Updated');
                        $('#newChargeForm')[0].reset();
                        $('#popUpModal').modal('hide');
                        loadDetails();
                    } else {
                        sweetAlert("Sorry Something Went Wrong!", 'error');


                    }
                });
            });


            $(document).on('click', '#updateIcon', function(e) {
                e.preventDefault();
                var dataId = $(this).data('id');
                console.log(dataId);

                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                    type: 'POST',
                    data: {
                        'type': 'EditExtraChargesDetails',
                        'dataid': dataId
                    },
                    success: function(data) {


                        var res = JSON.parse(data);
                        var id;
                        var name;
                        var amount;
                        $.each(res, function(key, value) {
                            id = value.id;
                            name = value.name;
                            amount = value.amount;

                        });



                        var data = `
                                    <form id="updateChargeForm" enctype= multipart/form-data>
                                        <input type="text" name="hiddenId" value="${id}"hidden>
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-2">
                                                <label for="name">Charge Name</label>
                                                <input name="chargename" id="chargename" type="text" class="form-control" value="${name}" required>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <label for="amount">Amount</label>
                                                <input name="amount" id="amount" type="number" class="form-control" value="${amount}" required>
                                            </div>
                                           
                                        </div>
                                    </form>
                            `;
                        showModalBox('Update Charge', 'Update Charge', data, 'updateCharge');
                        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                        myModal.show();
                    },
                    error: function(error) {
                        sweetAlert('Something Went Wrong', 'error');
                    }


                })



            });

            $(document).on('click', '#updateCharge', function(e) {
                e.preventDefault();
                var formData = new FormData($('#updateChargeForm')[0]);
                formData.append('type', 'updateChargeList');
                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/otherDetail.php' ?>",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status == 'ok') {
                            sweetAlert(res.msg);
                            $('#updateChargeForm')[0].reset();
                            $('#popUpModal').modal('hide');
                            loadDetails();
                        } else {
                            sweetAlert(res.msg, 'error');
                        }
                    },
                    error: function(error) {
                        sweetAlert('Sorry Something Went Wrong!', 'error');
                    }
                })
            });

            $(document).on('click', '#deleteIcon', function() {


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
                        var dataid = $(this).data('id');

                        function deleteList() {
                            $.ajax({
                                url: '<?= FRONT_ADMIN_SITE_INCLUDE ?>/ajax/otherDetail.php',
                                type: 'post',
                                data: {
                                    type: 'deleteList',
                                    id: dataid
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        loadDetails();
                                        Swal.fire('Deleted!', 'Your record has been deleted.', 'success');
                                    } else {
                                        Swal.fire("Your List record is safe!");
                                    }
                                }
                            });
                        }
                        if (willDelete.isConfirmed) {
                            deleteList();
                        }


                    });
            })


        });
    </script>


</body>


</html>