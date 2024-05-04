<?php
include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
$type = '';

if(isset($_POST['type'])){
    $type = $_POST['type'];
}

if($type=='getCatList'){
    echo beGalleryAddForm()['catListHtml'];
}

if($type == 'addBeGalleryForm'){
    echo beGalleryAddForm()['html'];
}


function beGalleryAddForm($rnid=''){
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
    $catListHtml = "<option value='0'>All</option>";
    // $catList=array();
    foreach(getWbGalleryCategory() as $gCatList){
        $catId = $gCatList['id'];
        $catName = ucfirst($gCatList['name']);
        $select = '';
        if($galleryCategory == $catId){
            $select = 'selected';
        }
        $catListHtml .= "<option $select value='$catId'>$catName</option>";
    //     $catList = array(
    //         $catId => $catName
    //     );
    }


    $html ='
            <form id="'.$formId.'" action="" method="post" enctype="multipart/form-data">
                                            
                <div class="row p0" style="align-items: end;">
                    
                    '.$updatewbGalleryHtml.'
                    <div class="form_group col-md-6">
                        <label for="">Image Text</label>
                        <input required type="text" name="imgText" placeholder="Enter Image Text" class="form-control" value="'.$galleryTitale.'">
                    </div>
                    <div class="form_group col-md-6">
                        <div class="d-flex align-items-center">
                            <select class="form-control" id="galleryCategory" name="galleryCategory">
                                '.$catListHtml.'
                            </select>
                            <span id="galleryCategoryAdd" class="formAddBtn"><i class="bi bi-clipboard-plus"></i></span>
                        </div>
                    </div>
                    <div class="form_group col-md-12">
                        <label for="galleryimg">Gallery Image only jpg format(600 x 600)</label>
                        <input '.$imgReq.' class="form-control" type="file" accept="image/jpeg"  id="galleryimg" name="galleryimg">
                        
                    </div>
                    <div class="form_group col-md-12">
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">'.$submitBtn.'</button>
                    </div>
                </div>
                
            </form>
    ';

    return ['html' => $html,
            'catListHtml' => $catListHtml,     
            // 'catList' => $catList       
            ];

    // return $html;

}
?>