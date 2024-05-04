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

    <title>Gallery</title>

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
                    <ul class="innerNav d-flex align-items-center">
                        <li class="item active"><a href="<?= FRONT_SITE . '/settings/gallery' ?>">Gallery</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="detailView scrollBar">
                        <ul class="categoryArea">
                            <li class="dib mr5"><button class="buttonHover skeleton"></button></li>
                            <li class="dib mr5"><button class="buttonHover skeleton"></button></li>
                            <li class="dib mr5"><button class="buttonHover skeleton"></button></li>
                            <li class="dib"><button id="addGalleryCatBtn" class="buttonHover"> + Add Category</button></li>
                        </ul>

                        <ul class="itemArea" id="galleryCanList">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include(FO_SERVER_SCREEN_PATH . 'booing_detail.php');
        include(FO_SERVER_SCREEN_PATH . 'script.php');
        ?>
    </main>
    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>

    <div id="popUpBox">
        <div class="closeBox"></div>
        <div class="content">
            <div class="closeBtn" id="closeBtn">X</div>
            <div class="contentArea">

            </div>
        </div>
    </div>

</body>

</html>
<script>

    function loadGalleryCategory() {
        var data = `request_type=loadGalleryCategoryData`;
        var html = '';
        ajax_request(data).done(function(request) {
            var response = JSON.parse(request);

            $.each(response, function(key, val) {
                var id = val.id;
                var name = val.name;
                var active = '';
                if(key == 0){
                    loadBeGalleryList(id);
                    active = 'active';
                }
                
                html += `<li class="dib mr5"><button data-cat="${id}" class="buttonHover ${active}">${name}</button></li>`;
            });

            html += '<li class="dib"><button id="addGalleryCatBtn" class="buttonHover categoryBtn"> + Add Category</button></li>';

            $('.categoryArea').html(html);
        });


    }

    function loadBeGalleryList(catid = '') {
        var data = `request_type=loadBeGalleryList&category=${catid}`;
        var html = '';
        ajax_request(data).done(function(request) {
            var response = JSON.parse(request);

            $.each(response, function(key, val) {
                var id = val.id;
                var name = val.name;
                var fullUrl = val.fullUrl;
                html += `<li>
                            <button class="removeGalleryCat" onclick="removeGalleryCat(${id})">X</button>
                            <img src="${fullUrl}"/>
                        </li>`;
            });

            html += `<li>
                        <button onclick="chooseImageCon('galleryPageSave',${catid})" class="buttonHover" id="addImgForGallery">Add Image</button>
                    </li>`;

            $('#galleryCanList').html(html);
        });
    }

    function loadGalleryCat() {
        var formData = `request_type=loadGalleryCategoryData`;
        
        ajax_request(formData).done((data) => {
            var response = JSON.parse(data);
            var list = '';
            $.each(response, function(key, val) {
                name = val.name;
                id = val.id;
                list += `<li class="db" style="padding: 0 0 5px;">
                            <input style="width: calc(100% - 100px);height: 35px;padding: 5px;border: 1px solid #858585;border-radius: 2px;" type="text" readonly value="${name}"/>  
                            <button style="width: 62px;height: 35px;border: 1px solid #858585;" class="editGCat" data-index="${id}">Edit</button> 
                            <button style="width: 30px;height: 35px;border: 1px solid #858585;" class="deleteGCat" data-index="${id}">X</button>
                        </li>`;
            });

            var html = `
                <form id="addGalleryCatForm" class="dFlex aic jcsb mb-2" method="POST">
                    <div class="input-wrap" style="width: calc(100% - 45px);">
                        <input class="form-control" type="text" name="galleyCatName" id="galleyCatName" placeholder="Enter gallery categogy name" class="input">
                    </div>
                    <button style="width: 40px;height: 40px;border: 1px solid #bbbbbb;font-size: 35px;display: flex;align-items: center;justify-content: center;" type="submit" id="galleryCatSubBtn">+</button>
                </form>

                <ul class="todoList">${list}</ul>
            `;

            $('#popUpModal .modal-body').html(html);

            loadGalleryCategory();
        });
    }

    $(document).ready(function() {

        $('.beNav').addClass('active');
        $('.beNav .gallery').addClass('active');

        loadGalleryCategory();
        loadBeGalleryList();

        $(document).on('click', '#addGalleryCatBtn', function(e) {
            e.preventDefault(); 
            showModalBox('Gallery List', '', '', 'addGalleryCatSubmitBtn');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
            myModal.show();

            loadGalleryCat();
        });

        $(document).on("click", "#galleryCatSubBtn", function(e) {
            e.preventDefault();
            var galleryName = $('#galleyCatName').val().trim();
            if (galleryName == '') {

            } else {
                var formData = `request_type=addGCatSubmitBtn&galleryName=${galleryName}`;
                ajax_request(formData).done((data) => {
                    if (data == 1) {
                        loadGalleryCat();
                    }
                    if (data == 3) {
                        alert('Already gallery category exist!');
                    }
                });
            }
        });


        $(document).on("click", ".editGCat", function() {
            var targetId = $(this).data('index');
            var thisText = $(this).html();
            if (thisText == 'Edit') {
                $(this).parent().find('input').attr("readonly", false).focus();
                $(this).html('Save');
            }

            if (thisText == 'Save') {
                var resName = $(this).parent().find('input').val().trim();
                var formData = `request_type=editGCat&target=${targetId}&resName=${resName}`;
                ajax_request(formData).done((data) => {
                    if (data == 1) {
                        loadGalleryCat();
                    }
                });
            }


        });

        $(document).on("click", ".deleteGCat", function() {
            var targetId = $(this).data('index');
            var formData = `request_type=deleteGCat&target=${targetId}`;
            ajax_request(formData).done((data) => {
                if (data == 1) {
                    loadGalleryCat();
                }
            });
        });



        $(document).on('click', '.categoryBtn', function(e) {
            e.preventDefault(); 
            var catId = $(this).data('cat');

            loadBeGalleryList(catId);
        });

    });
</script>