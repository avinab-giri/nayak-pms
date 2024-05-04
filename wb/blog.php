<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2],18);

$hotelId = $_SESSION['HOTEL_ID'];
$category = '';
if(isset($_GET['delete'])){
    $remove_id = $_GET['delete'];
    $sql = mysqli_query($conDB, "select * from wb_blog where id = '$remove_id'");
    $query = mysqli_fetch_assoc($sql);
    $old_img = $query['img'];
    if(mysqli_num_rows($sql)>0){
        $sql = "update wb_blog set deleteRec='0' where id = '$remove_id'";
        if(mysqli_query($conDB,$sql)){
            // unlink(SERVER_ADMIN_IMG.'post/'.$old_img);
            $_SESSION['SuccessMsg'] = "Successfull Delete";
            redirect('blog.php');
        }else{
            $_SESSION['ErrorMsg'] = "Something Error";
            redirect('blog.php');
        }
    }else{
        $_SESSION['ErrorMsg'] = "Something Error";
        redirect('blog.php');
    }
}



$updateText = '';
$Desc = '';
$required = 'required';
if(isset($_GET['update'])){
    $updateId = $_GET['update']; 
    $sql = mysqli_query($conDB, "select * from wb_blog where id = '$updateId'");
    $query = mysqli_fetch_assoc($sql);
    $updateText =  $query['title'];
    $category =  $query['category'];
    $Desc =  $query['description'];
    $required = '';
    if(isset($_POST['submit'])){
        $text = $_POST['imgText'];
        $category = $_POST['category'];
        $desc = $_POST['Desc']; 
        $extension=array('jpeg','jpg','JPG','png','gif');
        
        $galleryImgName = $_FILES['galleryimg']['name'];
        $galleryImgTemp = $_FILES['galleryimg']['tmp_name'];

        if($galleryImgName == ""){
            $sql = "update blog set title='$text',description='$desc',category='$category' where id = '$updateId'";
        }else{
            $ext=pathinfo($galleryImgName,PATHINFO_EXTENSION);
            if(in_array($ext,$extension)){

                $sql = mysqli_query($conDB, "select * from blog where id = '$updateId'");
                $query = mysqli_fetch_assoc($sql);
                $old_img = $query['img'];
                unlink(SERVER_IMG.'post/'.$old_img);

                $newfilename=rand(100000,999999).".".$ext;
                move_uploaded_file($galleryImgTemp, SERVER_IMG.'post/'.$newfilename);
                $sql = "update blog set title='$text',description='$desc',img='$newfilename' where id = '$updateId'";
            }
        }
        
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfull Update Record";
        }
        redirect('blog.php');
    }
}else{
    if(isset($_POST['submit'])){
        // pr($_FILES); 
        $text = $_POST['imgText'];
        $category = $_POST['category'];
        $desc = $_POST['Desc'];
        $extension=array('jpeg','jpg','JPG','png','gif');
        
        $galleryImgName = $_FILES['galleryimg']['name'];
        $galleryImgTemp = $_FILES['galleryimg']['tmp_name'];
        $ext=pathinfo($galleryImgName,PATHINFO_EXTENSION);
        if(in_array($ext,$extension)){
            $newfilename=rand(100000,999999).".".$ext;
            move_uploaded_file($galleryImgTemp, SERVER_IMG.'post/'.$newfilename);
            mysqli_query($conDB, "insert into wb_blog(title,img,description,category,hotelId) values('$text','$newfilename','$desc','$category','$hotelId')");
            $_SESSION['SuccessMsg'] = "Successfull Add Record";
        }
        redirect('blog.php');
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

    <title>Blog</title>

    <?php include(FO_SERVER_SCREEN_PATH.'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container py-2">
            

            <div class="row">
                <?php 
                    $navHtml = '<a href="javascript:void(0)" id="addWbBlogBtn"><button type="button"
                    class="btn bg-gradient-info">Add </button></a>';
                    echo backNavbarUi('','Blog',$navHtml);
                ?>
                <div class="col-12">
                    <div class="multisteps-form">

                        <div class="s25"></div>
                        
                        <div class="card p-3">
                            <div class="card-body">
                                
                                <div class="table-responsive" id="loadwbBlogData"> 
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th width="250px" ></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>

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

    <?php include(FO_SERVER_SCREEN_PATH.'script.php') ?>
    
    <script src="https://cdn.tiny.cloud/1/905gexvj5vhzvaoykwj6zmka5nvldcjmfmlowpfnt0oqa20t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    </script>

    <script>

        $('.linkBtn').removeClass('active');
        $('.wbLink').addClass('active');
        
        function loadWbBlogList() {
            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'loadWbBlogList'
                },
                success: function(data) {
                    var html = '';

                    var response = JSON.parse(data);

                    $.each(response, function(key,val){

                        var addBy = val.addBy;
                        var category = (val.category == null) ? '' : val.category;
                        var catbg = (val.catbg == null) ? '' : val.catbg ;
                        var catClr = (val.catClr == null) ? '' : val.catClr;
                        var descrip = val.descrip;
                        var description = val.description;
                        var id = val.id;
                        var img = val.img;
                        var si = val.si;
                        var title = val.title;
                        var status = val.status;

                        if(status == 1){
                            var statusHtml = "<a class='tableIcon status bg-gradient-success status deactive' href='javascript:void(0)' data-gid='$id' data-tooltip-top='Deactive' ><i class='far fa-eye'></i></a>";
                        }else{
                            var statusHtml = "<a class='tableIcon status bg-gradient-warning status  active' href='javascript:void(0)' data-gid='$id' data-tooltip-top='Active'  ><i class='far fa-eye-slash'></i></a>";
                        }

                        html += `<tr>
                                    <td width="10%" class="mb-0 text-xs left"><img style="width: 80px;" src="${img}"></td>
                                    <td width="15%" class="mb-0 text-xs">${title}</td>
                                    <td width="10%" class="mb-0 text-xs"><span style="background:${catbg};color:${catClr}">${category}</span></td>
                                    <td width="45%" class="mb-0 text-xs blogDescContent">${description}</td>
                                    <td width="20%" class="mb-0 text-xs">
                                        
                
                                        <div class="tableCenter">
                                            <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                            <span class="tableHoverShow">
                                            ${statusHtml}
                                            <a class="tableIcon update bg-gradient-info" href="javascript:void(0)" data-bid="${id}" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                            <a class="tableIcon delete bg-gradient-danger" href="javascript:void(0)" data-bid="${id}" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>
                                            </span>
                                        </div>
                                    </td>
                                </tr>`;
                    });

                    $('#loadwbBlogData tbody').html(html);
                    $('#loadwbBlogData table').dataTable();
                }
            });
        }

        function addWbBlogFormSec() {
            $('#popUpBox').addClass('show');

            $.ajax({
                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                type: 'post',
                data: {
                    type: 'showAddWbBlogForm'
                },
                success: function(data) {
                    $('#popUpBox .contentArea').html(data);
                    tinymce.init({
                        selector: 'textarea#blogDesc',
                        height:300,
                        plugins: 'code',
                        menubar: false
                    });
                }
            });
        }

        function loadBlogCategory() {
            var data = `request_type=loadBlogCategoryData`;
            var html = '';
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);
                $.each(response, function(key, val) {
                    var id = val.id;
                    var name = val.name;
                    html += `<li><button class="catBtn" data-catid="${id}">${name}</button> <span data-catid="${id}" class="removeBlogCat">X</span></li>`;
                });

                $('#blogCanList').html(html);
            });
        }

        $(document).ready(function() {

            loadWbBlogList();
            

            $('#addWbBlogBtn').on('click', function() {

                addWbBlogFormSec();

            });

            $(document).on('submit', '#addwbBlogForm', function(e) {
                e.preventDefault();
                $('#addwbBlogForm button').prop('disabled', false);
                $('#addwbBlogForm button').html('Loading..');
                var data = new FormData(this);
                data.append('type', 'addWbBlogSubmit');
                $.ajax({
                    url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        loadWbBlogList();       
                        var response = JSON.parse(data);
                        var error = response.error;
                        var msg = response.msg;
                        var img = response.img;
                        var imgMsg = (img == '') ? msg : img.msg;
                        if(error == 'no'){
                            loadWbBlogList();
                            $('#popUpBox').removeClass('show');
                            $('#addwbBlogForm').trigger('reset');
                            sweetAlert(msg);
                        }

                        if(error == 'yes'){
                            sweetAlert(imgMsg, 'error');
                        }
                    }
                });

            });

            $(document).on('click', '.update', function() {
                var rnid = $(this).data('bid');
                $('#popUpBox').addClass('show');
                $.ajax({
                    url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: {
                        type: 'editWbBlogForm',
                        id: rnid
                    },
                    success: function(data) {
                        $('#popUpBox .contentArea').html(data);
                        tinymce.init({
                            selector: 'textarea#blogDesc',
                            height:300,
                            plugins: 'code',
                            menubar: false
                        });
                    }
                });
            });

            $(document).on('submit', '#updatewbBlogForm', function(e) {
                e.preventDefault();
                $('#updatewbBlogForm button').prop('disabled', false);
                $('#updatewbBlogForm button').html('Loading..');
                var data = new FormData(this);
                data.append('type', 'updateWbBlogSubmit');
                $.ajax({
                    url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        loadWbBlogList();
                        $('#popUpBox').removeClass('show');
                        $('#addwbBlogForm').trigger('reset');
                        Swal.fire("Good job!", "Successfully Update.", "success");
                    }
                });

            });

            $(document).on('click', '.delete', function() {
                var gid = $(this).data('bid');



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
                        function deleteRoom() {
                            $.ajax({
                                url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                                type: 'post',
                                data: {
                                    type: 'deleteWbBlog',
                                    gid: gid
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        loadWbBlogList();
                                        Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success' );
                                    } else {
                                        Swal.fire("Your Blog record is safe!");
                                    }
                                }
                            });
                        }

                        if (willDelete.isConfirmed) {
                            deleteRoom();
                        }

                    });
            });

            $(document).on('click', '.status', function() {

                var rid = $(this).data('gid');
                $.ajax({
                    url: "<?= FRONT_SITE.'/include/ajax/webBuilder.php' ?>",
                    type: 'post',
                    data: {
                        type: 'statusUpdateForBlog',
                        rid: rid
                    },
                    success: function(data) {
                        if (data == 1) {
                            loadWbBlogList();
                            Swal.fire("Good job!", "Successfull change status.", "success");
                        }
                    }
                });
            });


            $(document).on('click', '#blogCategoryAdd', function(e) {
                e.preventDefault();
                var html = `<div><label>Blog Category (Press enter to store data)</label><input class="form-control" type="text" id="blogCategoryInput"/><ul id="blogCanList" class="categoryContentList"></ul></div>`;
                showModalBox('Update status', 'Submit', html, 'roomStatusUpdateBtn');
                var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
                    keyboard: false
                });
                myModal.show();
                loadBlogCategory();
            })

            $(document).on('keyup', '#blogCategoryInput', function(e) {

                if (e.keyCode == 13) {
                    var value = $(this).val().trim();
                    var editId = ($(this).data('editid') == undefined) ? '' : $(this).data('editid');
                    var data = `request_type=addBlogCategory&value=${value}&editId=${editId}`;

                    ajax_request(data).done(function(request) {
                        var response = JSON.parse(request);
                        var error = response.error;
                        var msg = response.msg;

                        if (error == 'no') {
                            $('#blogCategoryInput').val('');
                            loadBlogCategory();
                            sweetAlert(msg);
                            addWbGalleryFormSec();
                        }

                        if (error == 'yes') {
                            sweetAlert(msg, 'error')
                        }
                    });


                }
            });

            $(document).on('click', '.catBtn', function(e) {
                var catId = $(this).data('catid');
                var text = $(this).html();
                var target = $('#blogCategoryInput');
                target.val(text);
                target.data('editid', catId);
            });

            $(document).on('click', '.removeBlogCat', function() {
                var catId = $(this).data('catid');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                    function deleteBlogCat() {
                        var data = `request_type=removeBlogCat&catId=${catId}`;
                        ajax_request(data).done(function(request) {
                            var response = JSON.parse(request);
                            var error = response.error;
                            var msg = response.msg;
                            if (error == 'no') {
                                sweetAlert(msg);
                                loadBlogCategory();
                            }
                            if (error == 'yes') {
                                sweetAlert(msg, 'error')
                            }
                        });
                    }

                    if (willDelete.isConfirmed) {
                        deleteBlogCat();
                    }

                });


            });

            $(document).on('change', '#blogImage', function(e){
                e.preventDefault();
                var fileSize = this.files[0].size;
                if(fileSize > 500000){
                    sweetAlert('File too large. File must be less than 500Kb.','error');
                }
            });


        });
    
    </script>

</body>

</html>