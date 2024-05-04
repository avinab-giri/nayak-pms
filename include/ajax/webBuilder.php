<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

$type = '';

if(isset($_POST['type'])){
    $type = $_POST['type'];
}

function wbGalleryAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
    
    $formId = 'addwbGalleryForm';
    $galleryTitale =  '';
    $submitBtn = "Add Gallery";

    $imgReq = 'required';
    $updatewbGalleryHtml = '';
    $galleryCategory = '';
    if($rnid != ''){
        $row = getWbGalleryData($rnid)[0];
        $formId = 'updatewbGalleryForm';       
        $galleryTitale = $row['text'];
        $galleryCategory = $row['category'];
        $submitBtn = "Update Gallery";
        $updatewbGalleryHtml = '<input type="hidden" name="wbGalleryId" value="'.$rnid.'" >';
        $imgReq = '';
    }
    $catListHtml = "<option value='0'>Select Category.</option>";
    foreach(getWbGalleryCategory() as $gCatList){
        $catId = $gCatList['id'];
        $catName = ucfirst($gCatList['name']);
        $select = '';
        if($galleryCategory == $catId){
            $select = 'selected';
        }
        $catListHtml .= "<option $select value='$catId'>$catName</option>";
    }


    $html ='
            <form id="'.$formId.'" action="" method="post" enctype="multipart/form-data">
                                            
                <div class="row p0" style="align-items: end;">
                    
                    '.$updatewbGalleryHtml.'
                    <div class="form_group col-md-6 mb-4">
                        <label for="">Image Text</label>
                        <input required type="text" name="imgText" placeholder="Enter Image Text" class="form-control" value="'.$galleryTitale.'">
                    </div>
                    <div class="form_group col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            <select class="form-control" id="galleryCategory" name="galleryCategory">
                                '.$catListHtml.'
                            </select>
                            <span id="galleryCategoryAdd" class="formAddBtn"><i class="bi bi-clipboard-plus"></i></span>
                        </div>
                    </div>
                    <div class="form_group col-md-12 mb-4">
                        <label for="galleryimg">Gallery Image only jpg format(600 x 600)</label>
                        <input '.$imgReq.' class="form-control" type="file" accept="image/jpeg"  id="galleryimg" name="galleryimg">
                        
                    </div>
                    <div class="form_group col-md-12">
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">'.$submitBtn.'</button>
                    </div>
                </div>
                
            </form>
    ';

    return $html;
}

function wbGalleryformDataInsert($id='',$text,$img,$category=''){
   
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';

    $action = 'add';
    if($id != ''){
        $oldImg = '';
        $action = 'update';
    }else{
        $oldImg = '';
    }
    
    $addBy = '';
    $imgPath = '';
    $imgName = '';
    $imgName = $img['name'];
    if($imgName != ''){
        $imgPath = imgUploadWithData($img,'gallery',$oldImg);
        if($imgPath['error'] == 'false'){
            $imgName = $imgPath['img']; 
        }
        
        if($id != ''){
            $sql = "update  wb_gallery set text = '$text', img='$imgName',addBy='$addBy',category='$category' where id = '$id'";
        }else{
            $sql = "insert into  wb_gallery(hotelId,text,img,addBy,category) values('$hId','$text','$imgName','$addBy','$category')";
        }
    }else{
        
        if($id != ''){
            $sql = "update  wb_gallery set text = '$text', addBy='$addBy',category='$category' where id = '$id'";
        }
    }
    
    $data = array();

    if(isset($imgPath['error']) && $imgPath['error'] == 'true'){
        $data = [
            'error'=>'yes',
            'msg'=>'',
            'img'=>$imgPath,
        ];
    }else{     
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully '.$action.' gallery.',
                'img'=>'',
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Something error!',
                'img'=>'',
            ];
        }
    }

    
    echo json_encode($data);

}

if($type == 'loadwbGalleryList'){

    $si = 0;

    $html = '
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-left">Image</th>
                    <th class="text-center">Text</th>
                    <th class="text-center">Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
    
   
    if(count(getWbGalleryData()) > 0 ){
        foreach(getWbGalleryData() as $wbGalleryList){
            
            $img = getImgPath('public',$wbGalleryList['img']);
            $id = $wbGalleryList['id'];
            $category = (count(getWbGalleryCategory($wbGalleryList['category'])) > 0) ? ucfirst(getWbGalleryCategory($wbGalleryList['category'])[0]['name']) : '';
            $text = $wbGalleryList['text'];
            $si ++;
    
            
    
            $html .='
                    <tr>
                        <td width="20%" class="mb-0 left"><img style="width: 80px;" src="'.$img.'"></td>
                        <td width="40%" class="mb-0">'.$text.'</td>
                        <td width="20%" class="mb-0">'.$category.'</td>
                        <td width="20%" class="mb-0">
                        
                            <div class="tableCenter">
                                <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                <span class="tableHoverShow">
                                    <a class="tableIcon update bg-gradient-info" href="javascript:void(0)" data-gid="'.$id.'" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                    <a class="tableIcon delete bg-gradient-danger" href="javascript:void(0)" data-gid="'.$id.'" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>
                                </span>
                            </div>
                        </td>
                    </tr>
            ';
        }
    }else{
        $html .='
                    <tr>
                        <td colspan="4" class="mb-0 text-xs">No Data</td>
                    </tr>
            ';
    }

    $html .= '
    
    </tbody>
    </table>
    
    ';

    echo $html;
}

if($type == 'showAddWbGalleryForm'){
    echo wbGalleryAddForm();
}

if($type == 'addWbGallerySubmit'){
    $text = $_POST['imgText'];
    $category = $_POST['galleryCategory'];
    $img = $_FILES['galleryimg'];
    wbGalleryformDataInsert('',$text,$img,$category);
}

if($type == 'editWbGalleryForm'){
    $id = $_POST['id'];
    echo wbGalleryAddForm($id);
}

if($type == 'updateWbGallerySubmit'){
    $text = $_POST['imgText'];
    $img = $_FILES['galleryimg'];
    $id = $_POST['wbGalleryId'];
    $galleryCategory = $_POST['galleryCategory'];
    wbGalleryformDataInsert($id,$text,$img,$galleryCategory);
}

if($type == 'deleteWbGallery'){
    $gid = $_POST['gid']; 
    $sql = "update wb_gallery set deleteRec = '0' where id='$gid'";
    $oldImg = getWbGalleryData($gid)[0]['img'];
    if (mysqli_query($conDB, $sql)) {
        // imgUploadWithData('','gallery',$oldImg);
        echo 1;
    }else{
        echo 0;
    }
}



// Blog Function 



function wbBlogAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
    
    $formId = 'addwbBlogForm';
    $blogTitle = '';
    $blogCat = '';
    $blogDesc = '';
    $blogImg = '';
    $submitBtn = "Add Blog";

    $imgReq = 'required';
    $updatewbBlogHtml = '';
    $blogCatHtml = '<option value="0">Select Category</option>';

    if($rnid != ''){
        $row = getWbBlogData($rnid)[0];
        $formId = 'updatewbBlogForm';       
        $blogTitle = $row['title'];
        $blogCat = $row['category'];
        $blogDesc = $row['description'];
        $blogImg = $row['img'];
        $submitBtn = "Update Blog";
        $updatewbBlogHtml = '<input type="hidden" name="wbBlogId" value="'.$rnid.'" >';

        $imgReq = '';
    }

    foreach(getSysBlogCategoryData('','','name','asc') as $blogCatList){
        $name = $blogCatList['name'];
        $id = $blogCatList['id'];
        if($blogCat == $id){
            $blogCatHtml .= "<option selected value='$id'>$name</option>";
        }else{
            $blogCatHtml .= "<option value='$id'>$name</option>";
        }
    }
    // <span id="blogCategoryAdd" class="formAddBtn"><i class="bi bi-clipboard-plus"></i></span>
    $html ='

            <form id="'.$formId.'" action="" method="post" enctype="multipart/form-data">
                                
                <div class="row p0" style="align-items: end;">

                    <div class="form_group col-md-6 mb-3">
                        <label for="">Title</label>
                        <input '.$imgReq.' type="text" name="imgText" placeholder="Enter Image Text" class="form-control" value="'.$blogTitle.'">
                    </div>
                    '.$updatewbBlogHtml.'
                    <div class="form_group col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <select '.$imgReq.' name="category" id="category" class="form-control">
                                '.$blogCatHtml.'
                            </select>
                            
                        </div>
                    </div>

                    <div class="form_group col-md-12 mb-3">
                        <label for="blogImage">Image Only JPG Format.( 700 X 812 )</label>
                        <input '.$imgReq.' class="form-control" type="file" accept="image/jpeg"  id="blogImage" name="blogImage">
                        
                    </div>

                    <div class="form_group col_12 mb-3">
                        <label for="blogDesc">Description</label>
                        <textarea class="form-control" name="blogDesc" id="blogDesc" >'.$blogDesc.'</textarea>
                    </div>
                    
                    <div class="form_group col_12">
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">'.$submitBtn.'</button>
                    </div>
                </div>
                
            </form>
    ';

    return $html;
}

function wbBlogformDataInsert($id='',$text,$cat,$desc,$img){
   
    global $conDB;
    global $hotelId;
    $hId = $hotelId;
    $statusSec = '';

    if($id != ''){
        $oldImg = '';
        $action = 'update';
    }else{
        $oldImg = '';
        $action = 'add';
    }
    
    $addBy = '';
    $imgPath = '';
    $imgName = '';
    $imgName = $img['name'];
    if($imgName != ''){
        $imgPath = imgUploadWithData($img,'post',$oldImg);

        if($imgPath['error'] == 'false'){
            $imgName = $imgPath['imgId']; 
        }
        
        if($id != ''){
            $sql = "update  wb_blog set title = '$text', category = '$cat', description = '$desc', img='$imgName',addBy='$addBy' where id = '$id'";
        }else{
            $sql = "insert into  wb_blog(hotelId,title,category,description,img,addBy) values('$hId','$text','$cat','$desc','$imgName','$addBy')";
        }
    }else{
        
        if($id != ''){
            $sql = "update  wb_blog set title = '$text', category = '$cat', description = '$desc', addBy='$addBy' where id = '$id'";
        }
    }
    

    if(isset($imgPath['error']) && $imgPath['error'] == 'true'){
        $data = [
            'error'=>'yes',
            'msg'=>'',
            'img'=>$imgPath,
        ];
    }else{        

        
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>"Successfully $action record.",
                'img'=>"",
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Something error!',
                'img'=>'',
            ];
        }
    }

    
    echo json_encode($data);

}

if($type == 'loadWbBlogList'){

    $si = 0;

    $html = '';
    $data = array();

    if(count(getWbBlogData()) > 0){
        foreach(getWbBlogData() as $wbBlogList){
        
            
            $img = (isset(getHotelImageData('','','','',$wbBlogList['img'])[0])) ? getHotelImageData('','','','',$wbBlogList['img'])[0] : getHotelImageData('','','','',$slideList['img']);
            $imgName = (isset($img['fullUrl'])) ? $img['fullUrl'] : $img['image'];
            $id = $wbBlogList['id'];
            $title = $wbBlogList['title'];
            $catData = getSysBlogCategoryData($wbBlogList['category'])[0];
            $category = (isset($catData)) ? $catData['name'] : '';
            $catbg = (isset($catData)) ? $catData['bgClr'] : '';
            $catClr = (isset($catData)) ? $catData['clr'] : '';
            $descrip = $wbBlogList['description'];
            $description = (strlen($descrip) <= 150) ? $descrip : substr($descrip, 0, 150).'...';
            $addBy = $wbBlogList['addBy'];
            $si ++;
            $status =$wbBlogList['status'];

            $data[] = [
                'id'=>$id,
                'title'=>$title,
                'category'=>$category,
                'catbg'=>$catbg,
                'catClr'=>$catClr,
                'descrip'=>$descrip,
                'description'=>$description,
                'addBy'=>$addBy,
                'img'=>$imgName,
                'si'=>$si,
                'status'=>$status,
            ];
        }
    }

    echo json_encode($data);
}

if($type == 'showAddWbBlogForm'){
    echo wbBlogAddForm();
}

if($type == 'addWbBlogSubmit'){
    $text = $_POST['imgText'];
    $category = $_POST['category'];
    $blogDesc = $_POST['blogDesc'];
    $img = $_FILES['blogImage'];
    wbBlogformDataInsert('',$text,$category,$blogDesc,$img);
}

if($type == 'editWbBlogForm'){
    $id = $_POST['id'];
    echo wbBlogAddForm($id);
}

if($type == 'updateWbBlogSubmit'){
    $text = $_POST['imgText'];
    $img = $_FILES['galleryimg'];
    $id = $_POST['wbBlogId'];
    $category = $_POST['category'];
    $desc = $_POST['blogDesc'];
    wbBlogformDataInsert($id,$text,$category,$desc,$img);
}

if($type == 'deleteWbBlog'){
    $gid = $_POST['gid']; 
    $sql = "update wb_blog set deleteRec = '0' where id='$gid'";
    $oldImg = getWbGalleryData($gid)[0]['img'];
    if (mysqli_query($conDB, $sql)) {
        // imgUploadWithData('','gallery',$oldImg);
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'statusUpdateForBlog'){
    $sid = $_POST['rid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from  wb_blog where id='$sid'"));
    if($sql['status'] == 1){
        $query = "update  wb_blog set status = '0' where id='$sid'";
    }else{
        $query = "update  wb_blog set status = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}



// Slider Function


function wbSliderAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
    
    $formId = 'addwbSliderForm';
    $title = '';
    $subTitle = '';
    $blogImg = '';
    $submitBtn = "Add Slide";
    $button = '';
    $buttonLink ='';

    $imgReq = 'required';
    $updatewbSliderHtml = '';
    

    if($rnid != ''){
        $row = getSlider($rnid)[0];
        $submitBtn = "Update Slide";
        $formId = 'updatewbSliderForm';       
        $title = $row['title'];
        $subTitle = $row['subTitle'];
        $button = $row['button'];
        $buttonLink = $row['buttonLink'];
        $blogImg = $row['img'];
        $updatewbSliderHtml = '<input type="hidden" name="wbBlogId" value="'.$rnid.'" >';

        $imgReq = '';
    }
    

    $html ='

        <form id="'.$formId.'" action="" method="post" enctype="multipart/form-data">
                            
            <div class="row p0" style="align-items: center;">
                
                '.$updatewbSliderHtml.'
                <div class="form_group col-md-6 mb-3">
                    <label for="title">Title</label>
                    <input required class="form-control" type="text" name="title" id="title" value="'.$title.'">
                </div>
                <div class="form_group col-md-6">
                    <label for="subTitle">Sub Title</label>
                    <input required class="form-control" type="text" name="subTitle" id="subTitle" value="'.$subTitle.'">
                </div>
                <div class="form_group col-md-12 mb-3">
                    <label for="roomImage1">Slider Image Only JPEG Format(1350 x 450)</label>
                    <input '.$imgReq.' class="form-control" type="file" accept="image/jpeg" id="roomImage1" name="heroImage">
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="button">Button Text (Optional)</label>
                    <input class="form-control" type="text" name="button" id="button" value="'.$button.'">
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="buttonUrl">Button Url (Optional)</label>
                    <input class="form-control" type="text" name="buttonUrl" id="buttonUrl" value="'.$buttonLink.'">
                </div>
                <div class="form_group col-md-6" style="margin-bottom: 0;">
                    <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">'.$submitBtn.'</button>
                </div>
            </div>
            
        </form>
    ';

    return $html;
}

function wbSliderformDataInsert($id='',$text,$subTitle,$img,$btn='',$btnLink=''){
   
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';

    if($id != ''){
        $oldImg = '';
        $action = 'update';
    }else{
        $oldImg = '';
        $action = 'add';
    }
    
    $addBy = dataAddBy();
    $imgPath = array();
    $imgName = '';
    $imgName = $img['name'];

    if($imgName != ''){

        $imgPath = imgUploadWithData($img,'hero',$oldImg);
        $imgId = $imgPath['imgId'];
        
        if($imgPath['error'] == 'false'){
            $imgName = $imgPath['img']; 

            if($id != ''){
                $sql = "update  wb_slider set title = '$text', subTitle = '$subTitle',img='$imgId',addBy='$addBy',button='$btn',buttonLink='$btnLink' where id = '$id'";
            }else{
                $sql = "insert into  wb_slider(hotelId,title,subTitle,img,addBy,button,buttonLink) values('$hId','$text','$subTitle','$imgId','$addBy','$btn','$btnLink')";
            }
        }

        if($imgPath['error'] == 'true'){
            $data = [
                'error' => 'yes',
                'img' => $imgPath,
                'msg' => '',
            ];
        }
    }else{
        if($id != ''){
            $sql = "update  wb_slider set title = '$text', subTitle = '$subTitle', addBy='$addBy',button='$btn',buttonLink='$btnLink' where id = '$id'";
        }
    }
    

    if(isset($imgPath['error']) && $imgPath['error'] == 'true'){
        
    }else{     
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error' => 'no',
                'img' => $imgPath,
                'msg' => 'Successfully '.$action.' Slider',
            ];
        }else{
            $data = [
                'error' => 'no',
                'img' => $imgPath,
                'msg' => 'Something error.',
            ];
        }
    }

    echo json_encode($data);

}

if($type == 'loadWbSliderList'){

    $si = 0;

    $html = '
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Button</th>
                    <th>Order</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
    

    function sliderOrderCheck($sliderOrder){
        $data = "<option value='0'>Select Order</option>";
        foreach(getSlider() as $key => $sliderList){
            $orderNum = $key + 1;
            if($sliderOrder == $orderNum){
                $data .= "<option selected value='$orderNum'>$orderNum</option>";
            }else{
                $data .= "<option value='$orderNum'>$orderNum</option>";
            }
        }

        return $data;
    }
    
    if(count(getSlider()) > 0){
        foreach(getSlider() as $slideList){                    

            $si ++;
            $id = $slideList['id'];
            $title = $slideList['title'];
            $subtitle = $slideList['subTitle'];
            $img = (isset(getHotelImageData('','','','',$slideList['img'])[0])) ? getHotelImageData('','','','',$slideList['img'])[0] : getHotelImageData('','','','',$slideList['img']);
            $imgName = (isset($img['fullUrl'])) ? $img['fullUrl'] : $img['image'];
            $status = $slideList['status'];
            $button = $slideList['button'];

            $sliderorder = $slideList['sliderorder'];
            
            $sliderOrderHtml = sliderOrderCheck($sliderorder);
            
            if($slideList['status'] == 1){
                $statusHtml = "<a class='tableIcon status bg-gradient-success status deactive' href='javascript:void(0)' data-sid='$id' data-tooltip-top='Deactive' ><i class='far fa-eye'></i></a>";
            }else{
                $statusHtml = "<a class='tableIcon status bg-gradient-warning status  active' href='javascript:void(0)' data-sid='$id' data-tooltip-top='Active'  ><i class='far fa-eye-slash'></i></a>";
            }

            $html .= '
                <tr>
                    <td width="5%" class="mb-0 text-xs left">'.$si.'</td>
                    <td width="15%" class="mb-0 text-xs left"><img style="height: 50px;" src="'.$imgName.'"></td>
                    <td width="20%" class="mb-0 text-xs">'.$title.'</td>
                    <td width="12%" class="mb-0 text-xs">'.$subtitle.'</td>
                    <td width="12%" class="mb-0 text-xs">'.$button.'</td>
                    <td width="11%" class="mb-0 text-xs">
                        <select class="form-control wbSliderOrder" style="width: 113px;font-size: 12px;" data-sid="'.$id.'">
                            '.$sliderOrderHtml.'
                        </selsect>
                    </th>
                    <td width="20%" class="mb-0 text-xs">
                        
                        <div class="tableCenter">
                            <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                            <span class="tableHoverShow">
                            '.$statusHtml.'
                                <a class="tableIcon update bg-gradient-info" href="javascript:void(0)" data-sid="'.$id.'" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                <a class="tableIcon delete bg-gradient-danger" href="javascript:void(0)" data-sid="'.$id.'" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>
                            </span>
                        </div>
                    </td>
                </tr>
            ';
        }
    }else{
        $html .='
                    <tr>
                        <th class="mb-0 text-xs" colspan="5">No Data</th>
                    </tr>
            ';
    }
    

    $html .= '
    
    </tbody>
    </table>
    
    ';

    echo $html;
}

if($type == 'showAddWbSliderForm'){
    echo wbSliderAddForm();
}

if($type == 'addWbSliderSubmit'){
    $text = $_POST['title'];
    $subTitle = $_POST['subTitle'];
    $img = $_FILES['heroImage'];
    $button = $_POST['button'];
    $buttonUrl = $_POST['buttonUrl'];
    wbSliderformDataInsert('',$text,$subTitle,$img,$button,$buttonUrl);
}

if($type == 'editWbSliderForm'){
    $id = $_POST['id'];
    echo wbSliderAddForm($id);
}

if($type == 'updateWbSliderSubmit'){
    $text = $_POST['title'];
    $subTitle = $_POST['subTitle'];
    $img = $_FILES['heroImage'];
    $id = $_POST['wbBlogId'];
    $button = $_POST['button'];
    $buttonUrl = $_POST['buttonUrl'];
    wbSliderformDataInsert($id,$text,$subTitle,$img,$button,$buttonUrl);
}

if($type == 'deleteWbSlider'){
    $gid = $_POST['sid']; 
    $sql = "update wb_slider set deleteRec = '0' where id='$gid'";
    $oldImg = getWbGalleryData($gid)[0]['img'];
    if (mysqli_query($conDB, $sql)) {
        // imgUploadWithData('','gallery',$oldImg);
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'statusUpdateForSlider'){
    $sid = $_POST['rid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from  wb_slider where id='$sid'"));
    if($sql['status'] == 1){
        $query = "update  wb_slider set status = '0' where id='$sid'";
    }else{
        $query = "update  wb_slider set status = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}

if($type == 'updateWbSliderOrder'){
    $sid = $_POST['sid']; 
    $order = $_POST['order']; 
    $sql = "update wb_slider set sliderorder = '$order' where id='$sid'";
    if (mysqli_query($conDB, $sql)) {
        echo 1;
    }else{
        echo 0;
    }
}



// Feedback Function 



function wbFeedbackAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
    
    $formId = 'addwbFeedForm';
    $name = '';
    $email = '';
    $blogImg = '';
    $description = '';
    $submitBtn = "Add Blog";

    $imgReq = 'required';
    $updatewbSliderHtml = '';
    $rating = 0;
    

    if($rnid != ''){
        $row = getWbFeedbackData($rnid)[0];
        $formId = 'updatewbFeedForm';       
        $name = $row['name'];
        $email = $row['email'];
        $blogImg = $row['img'];
        $description = $row['description'];
        $rating = $row['rating'];
        $updatewbSliderHtml = '<input type="hidden" name="wbFeedId" value="'.$rnid.'" >';
        $submitBtn = "Update Blog";
        $imgReq = '';
    }
    $ratingHtml = '<option value=0> Select Rating</option>';
    for($i=1; $i<=5; $i ++){
        if($i == $rating){
            $ratingHtml .= "<option selected value='$i'> $i </option>";
        }else{
            $ratingHtml .= "<option value='$i'> $i </option>";
        }
    }

    $html ='

        <form id="'.$formId.'" action="" method="post" enctype="multipart/form-data">
                            
            <div class="row p0" style="align-items: center;">
                
                '.$updatewbSliderHtml.'
                <div class="form_group col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input required class="form-control" type="text" name="name" id="name" value="'.$name.'">
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input required class="form-control" type="text" name="email" id="email" value="'.$email.'">
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="rating">Rating</label>
                    <select class="form-control" type="text" name="rating" id="rating">
                        '.$ratingHtml.'
                    </select>
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="feedbackImg">Person image(540 x 540)</label>
                    <input '.$imgReq.' class="form-control" type="file" accept="image/jpeg" id="feedbackImg" name="feedImg">
                </div>
                <div class="form_group col-md-12 mb-4">
                    <label for="feedback">Feedback</label>
                    <textarea class="form-control feedbackContent" name="feedback" id="feedback">'.$description.'</textarea>
                </div>
                <div class="form_group col-md-6" style="margin-bottom: 0;">
                    <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">'.$submitBtn.'</button>
                </div>
            </div>
            
        </form>
    ';

    return $html;
}

function wbFeedbackformDataInsert($id='',$name,$email,$rating,$description,$img){
   
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';

    if($id != ''){
        $oldImg = '';
        $action = 'update';
    }else{
        $oldImg = '';
        $action = 'add';
    }
    
    $addBy = '';
    $imgPath = '';
    $imgName = '';
    $imgName = $img['name'];
    if($imgName != ''){
        $imgPath = imgUploadWithData($img,'testimonial',$oldImg);
        if($imgPath['error'] == 'false'){
            $imgName = $imgPath['img']; 
        }
        
        if($id != ''){
            $sql = "update  wb_feedback set name = '$name', email = '$email',rating = '$rating',description = '$description',img='$imgName',addBy='$addBy' where id = '$id'";
        }else{
            $sql = "insert into  wb_feedback(hotelId,name,email,rating,description,img,addBy) values('$hId','$name','$email','$rating','$description','$imgName','$addBy')";
        }
    }else{
        
        if($id != ''){
            $sql = "update  wb_feedback set name = '$name', email = '$email', rating = '$rating',description = '$description', addBy='$addBy' where id = '$id'";
        }
    }
    

    if(isset($imgPath['error']) && $imgPath['error'] == 'true'){
        $data = [
            'error' => 'yes',
            'img' => $imgPath,
            'msg' => '',
        ];
    }else{        

        
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error' => 'no',
                'img' => $imgPath,
                'msg' => 'Successfully '.$action.' Slider',
            ];
        }else{
            $data = [
                'error' => 'no',
                'img' => $imgPath,
                'msg' => 'Something error.',
            ];
        }
    }

    echo json_encode($data);
    

}

if($type == 'loadWbFeedbackList'){

    $si = 0;

    $data = array();
    

    function feedOrderCheck($sliderOrder){
        $data = "<option value='0'>Select Order</option>";

        foreach(getWbFeedbackData() as $key => $sliderList){
            $orderNum = $key + 1;
            if($sliderOrder == $orderNum){
                $data .= "<option selected value='$orderNum'>$orderNum</option>";
            }else{
                $data .= "<option value='$orderNum'>$orderNum</option>";
            }
        }

        return $data;
    }
    

    if(count(getWbFeedbackData()) > 0){
        foreach(getWbFeedbackData() as $feedbackList){                    

            $si ++;
            $id = $feedbackList['id'];
            $name = $feedbackList['name'];
            $email = $feedbackList['email'];
            $rating = $feedbackList['rating'];
            $description = $feedbackList['description'];
            $img = getImgPath('public',$feedbackList['img']);
            $status = $feedbackList['status'];
            $feedbackorder = ($feedbackList['feedbackorder'] == 0) ? $id : $feedbackList['feedbackorder'];
            
            $feedbackOrderHtml = feedOrderCheck($feedbackorder);

            $data[] = [
                'sn'=>$si,
                'id'=>$id,
                'name'=>$name,
                'email'=>$email,
                'rating'=>$rating,
                'description'=>$description,
                'img'=>$img,
                'status'=>$status,
                'feedbackorder'=>$feedbackorder,
                'feedbackOrderHtml'=>$feedbackOrderHtml,
                'status'=>$status
            ];
        }
    }   

    echo json_encode($data);
}

if($type == 'showAddWbFeedForm'){
    echo wbFeedbackAddForm();
}

if($type == 'addWbFeedSubmit'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $img = $_FILES['feedImg'];
    wbFeedbackformDataInsert('',$name,$email,$rating,$feedback,$img);
}

if($type == 'editWbFeedForm'){
    $id = $_POST['id'];
    echo wbFeedbackAddForm($id);
}

if($type == 'updateWbFeedSubmit'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $img = $_FILES['feedImg'];
    $id = $_POST['wbFeedId'];
    wbFeedbackformDataInsert($id,$name,$email,$rating,$feedback,$img);
}

if($type == 'deleteWbFeed'){
    $gid = $_POST['sid']; 
    $sql = "update wb_feedback set deleteRec = '0' where id='$gid'";
    // $oldImg = getWbGalleryData($gid)[0]['img'];
    if (mysqli_query($conDB, $sql)) {
        // imgUploadWithData('','gallery',$oldImg);
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'statusUpdateForFeed'){
    $sid = $_POST['rid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from  wb_feedback where id='$sid'"));
    if($sql['status'] == 1){
        $query = "update  wb_feedback set status = '0' where id='$sid'";
    }else{
        $query = "update  wb_feedback set status = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}

if($type == 'updateWbFeedOrder'){
    $sid = $_POST['sid']; 
    $order = $_POST['order']; 
    $sql = "update wb_feedback set feedbackorder = '$order' where id='$sid'";
    if (mysqli_query($conDB, $sql)) {
        echo 1;
    }else{
        echo 0;
    }
}





?>