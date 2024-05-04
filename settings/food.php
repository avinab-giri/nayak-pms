<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

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

    <title>Food</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php'); ?>



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
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/food' ?>">Food</a></li>
                        <li class="item"><button id="addFoodCat" class="btn bg-gradient-dark mb-0 mR5" href="javascript:;">Add Category</button></li>
                        <li class="item"><button type="button" id="addKotFootBtn" class="btn bg-gradient-info m-0">Add Food</button></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="servicesArea" style="padding: 10px; margin-top: 8px;">
                        <div id="loadKotFootData"></div>
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
        $('.posNav').addClass('active');
        $('.posNav .food').addClass('active');

        function loadKotFood() {
            var skeleton = window.tableSkeleton;
            $('#loadKotFootData').html(skeleton);
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                type: 'post',
                data: {
                    type: 'loadKotProList'
                },
                success: function(data) {
                    $('#loadKotFootData').html(data);
                    $('#kotDataTable').dataTable();
                }
            });
        }

        function addKotFormBox($id = '') {
            var id = $id;
            var title = (id != '') ? 'Food Update' : 'Food Add';
            var btn = (id != '') ? 'Update Food' : 'Add Food';
            var btnId = 'AddFoodSubmitBtn';
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                type: 'post',
                data: {
                    type: 'addKotForm',
                    id: id
                },
                success: function(data) {
                    // $('#popUpBox .contentArea').html(data);
                    showModalBox(title, btn, data, btnId);
                    var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                    myModal.show();
                }
            });
        }

        function loadFoodCat() {
            var formData = `request_type=addFoodCat`;

            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var list = '';
                $.each(response, function(key, val) {
                    name = val.name;
                    id = val.id;
                    list += `<li><input type="text" readonly value="${name}"/>  <button class="editFCat" data-index="${id}">Edit</button> <button class="deleteFCat" data-index="${id}">X</button></li>`;
                });

                var html = `
                <form id="addFoodCatForm" action="" method="POST">
                    <div class="dFlex aic jcsb categoryGroup">
                        <div class="input-wrap" style="width: calc(100% - 40px)">
                            <span class="lnr lnr-indent-increase"></span>
                            <input class="form-control" type="text" name="foodCatName" id="foodCatName" placeholder="Enter Food categogy name" class="input">
                        </div>
                        <button type="submit" id="foodCatSubBtn">+</button>
                    </div>
                    <span class="error"></span>
                </form>

                <ul class="todoList">${list}</ul>
            `;
                showModalBox('Food Category List', '', html, 'addFoodCatSubmitBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                myModal.show();
            });
        }

        function submitFoodItem($id = '') {
            var data = $('#addKotFoodForm').serialize() + '&type=submitKotAddFood';
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                type: 'post',
                data: data,
                success: function(data) {
                    var result = JSON.parse(data);
                    var error = result.error;
                    var msg = result.msg;

                    if (error == 'no') {
                        $('#popUpModal').modal('hide');
                        loadKotFood();
                        sweetAlert(msg);
                    }


                    if (error == 'yes') {
                        loadKotFood();
                        sweetAlert(msg, "error");
                    }


                }
            });
        }


        $(document).ready(() => {
            loadKotFood();

            $('#addKotFootBtn').on('click', function() {

                addKotFormBox();

            });

            $(document).on('click', '#AddFoodSubmitBtn', function(e) {
                e.preventDefault();
                submitFoodItem();

            });

            $(document).on('click', '.status', function() {
                var rnid = $(this).data('rnid');
                $.ajax({
                    url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                    type: 'post',
                    data: {
                        type: 'statusUpdate',
                        rnid: rnid
                    },
                    success: function(data) {
                        if (data == 1) {
                            loadKotFood();
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
                                url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                                type: 'post',
                                data: {
                                    type: 'deleteRoomNumber',
                                    rnid: rnid
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        loadKotFood();
                                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    } else {
                                        Swal.fire("Your <?= $title ?> record is safe!");
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
                addKotFormBox(rnid);
            });




            $(document).on("click", "#addFoodCat", function(e) {
                e.preventDefault();
                loadFoodCat();
            });

            $(document).on("click", "#alertAddResBtn", function(e) {
                e.preventDefault();
                loadKotRes();
            });

            $(document).on("click", "#foodCatSubBtn", function(e) {
                e.preventDefault();
                var resName = $('#foodCatName').val().trim();
                if (resName == '') {

                } else {
                    var formData = `request_type=addFCatSubmitBtn&resName=${resName}`;
                    ajax_request(formData).done((data) => {
                        if (data == 1) {
                            loadFoodCat();
                        }
                        if (data == 3) {
                            alert('Already restaurant exist!');
                        }
                    });
                }
            });


            $(document).on("click", ".editFCat", function() {
                var targetId = $(this).data('index');
                var thisText = $(this).html();
                if (thisText == 'Edit') {
                    $(this).parent().find('input').attr("readonly", false).focus();
                    $(this).html('Save');
                }

                if (thisText == 'Save') {
                    var resName = $(this).parent().find('input').val().trim();
                    var formData = `request_type=editFCat&target=${targetId}&resName=${resName}`;
                    ajax_request(formData).done((data) => {
                        if (data == 1) {
                            loadFoodCat();
                        }
                    });
                }


            });

            $(document).on("click", ".deleteFCat", function() {
                var targetId = $(this).data('index');
                var formData = `request_type=deleteFCat&target=${targetId}`;
                ajax_request(formData).done((data) => {
                    if (data == 1) {
                        loadFoodCat();
                    }
                });
            });
        });
    </script>

</body>

</html>