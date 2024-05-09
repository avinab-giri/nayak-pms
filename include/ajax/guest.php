<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

$type = '';

// pr($_POST);

if(isset($_POST['type'])){
    $type = $_POST['type'];
}

if($type == 'loadGuest'){
  
    $si = 0;
    $pagination = '';
    $search = safeData($_POST['search']);
    $page = safeData($_POST['page']);
    $limit = safeData($_POST['limit']);
    $date = safeData($_POST['date']);
    $district = safeData($_POST['district']);

    $hotelId = $_SESSION['HOTEL_ID'];
    
    $sql = "select * from guest where  hotelId = '$hotelId'";
        
    $sql .= " and name != ''";

    if($date != ''){
        $sql .= " and addOn Like '%$date%'";
    }

    if($district != ''){
        $sql .= " and district Like '%$district%'";
    }

    if($search != ''){
        $sql .= " and name  LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' " ;
    }

    $limit_per_page = $limit;
    
    $page = '';
    if(isset($_POST['page_no'])){
        $page = $_POST['page_no'];
    }else{
        $page = 1;
    }
    
    
    
    $offset = ($page -1) * $limit_per_page;
    
    $sql .= " ORDER BY id DESC ";
    
    // $sql .= " ORDER BY id DESC limit {$offset}, {$limit_per_page}";
    
    $html = '';
    $data =array();

    $query = mysqli_query($conDB, $sql);
    $si = $si + ($limit_per_page *  $page) - $limit_per_page;
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $gid = $row['id'];
            $getGuestDetail = getGuestDetail('','',$gid)[0];
            $guestImg = $getGuestDetail['profileImgFull'];
            $advance = [
                'guestImg'=>$guestImg
            ];
            $data[] = array_merge($row, $advance);            

        }
    }else{
       
    }

    echo json_encode(['data'=>$data, 'pagination'=>'']);
}

if($type == 'load_add_guest'){
    $bookingSource = '';
    $reservationType = '';
    foreach(getReservationType() as $key=>$reservationTypeList){
        $select = '';
        if($key == 0){
            $select = 'selected';
        }
        $id = $reservationTypeList['id'];
        $name = ucfirst($reservationTypeList['name']);
        $reservationType .=   "<option value='$id' $select>$name</option>";
    }

    foreach(getBookingSource() as $key=>$getBookingSourceList){
        $select = '';
        if($key == 0){
            $select = 'selected';
        }
        $id = $getBookingSourceList['id'];
        $name = ucfirst($getBookingSourceList['name']);
        $bookingSource .=   "<option value='$id' $select>$name</option>";
    }

    $html ='
            <div class="card">
                <div class="card-body">
                    <form action="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-area1">
                                    <h4><i class="fas fa-caret-right"></i> Add Guest</h4>
                                </div>
                                <br />



                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="guestImgUpload">
                                            <label for="guestImg"><span>Upload</span></label>
                                            <input type="file" accept="image/jpeg" name="guestImg" id="guestImg">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">Name</label>
                                            <input type="text" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form">
                                                    <label for="">EMail</label>
                                                    <input type="text" placeholder="Mail" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">Phone</label>
                                            <input type="text" placeholder="Phone" class="form-control">
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form">
                                                    <label for="">Gender</label>
                                                    <div class="text-area">
                                                        <input type="radio" name="gender" value="male" id="male"> <label for="male">male</label>
                                                        <input type="radio" name="gender" value="female" id="female"> <label for="female">Female</label>
                                                        <input type="radio" name="gender" value="other" id="other"> <label for="other">Other</label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">Mobile</label>
                                            <input type="text" placeholder="Name" class="form-control">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form">
                                            <label for="">Address</label>
                                            <input type="text" placeholder="Contact" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">Counrty</label>
                                            <select class="form-control" name="" id="">
                                                <option value="" selected>Select country</option>
                                                <option value="">India</option>
                                                <option value="">Pk</option>
                                                <option value="">Uk</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">State</label>
                                            <input type="text" placeholder="India" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form">
                                            <label for="">City</label>
                                            <input type="text" placeholder="India" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-12">
                                <h4> <i class="fas fa-caret-right"></i>Other Imformation</h4>
                                <br />
                                <div class="form-1">
                                    <button class="btn btn-outline-dark">Clear</button>
                                    <button class="btn bg-gradient-primary">Save</button>
                                </div>
                            </div>

                        </div>
                        </form>
                </div>
            </div>
    ';

    echo $html;
}

if($type == 'loadAddGuestReservationForm'){
    // pr($_POST);
    $bid = safeData($_POST['bid']);
    $bdid = safeData($_POST['bdid']);
    $gid = safeData($_POST['gid']);
    $serial = safeData($_POST['serial']);
    $gustImg = safeData($_POST['gustImg']);
    $guestProofImg = safeData($_POST['guestProofImg']);
    $rTab = safeData($_POST['rTab']);
    $page = safeData($_POST['page']);
    $action = safeData($_POST['action']);
    $roomNum = safeData($_POST['roomNum']);
   
    if($serial == ''){
        $lstKey = array_key_last(getGuestDetail($bid,'','',$bdid));
        $serial = getGuestDetail($bid,'','',$bdid)[$lstKey]['serial'] + 1;
    }

    $title = 'Add Guest';
    $guestName = '';
    $guestEmail = '';
    $guestPhone = '';
    $guestCountry = '';
    $guestState = '';
    $guestCity = '';
    $guestBlock = '';
    $guestDistrict = '';
    $guestZip = '';
    $guestGender = '';
    $guestImage = '';
    $guestKycFile = '';
    $guestKycNumber = '';
    $guestKycType = '';
    $guestImgHtml  = '';
    $guestPImgHtml = '';
    $guestSerialNum ='';
    $guestUploadType = '';
    $guestProofUploadType = '';

    $birthdayDate = '';
    $anniversaryDate = '';

    $actionBtn = 'reservationAddGuestForm';
    $guestArray = array();
    if($gid != '' && !empty(getGuestDetail($bid,'',$gid))){
        $title = 'Edit Guest';
        $guestArray = getGuestDetail($bid,'',$gid)[0];
        $actionBtn = 'reservationAddGuestForm';
        // $actionBtn = 'reservationUpdateGuestForm';
    }

    // if($serial != '' && !empty(getGuestDetail($bid,$serial))){
    //     $guestArray = getGuestDetail($bid,$serial)[0];
    // }
    // pr($guestArray);
    if(!empty($guestArray)){
        
        $guestName = $guestArray['name'];
        $guestEmail = $guestArray['email'];
        $guestPhone = $guestArray['phone'];
        $guestBlock = $guestArray['block'];
        $guestDistrict = $guestArray['district'];
        $guestState = $guestArray['state'];
        $guestCity = $guestArray['city'];
        $guestZip = $guestArray['zip'];
        $guestGender = $guestArray['gender'];
        $guestImage = $guestArray['image'];
        $guestKycFile = $guestArray['kyc_file'];
        $guestKycNumber = $guestArray['kyc_number'];
        $guestSerialNum = $guestArray['serial'];
        $guestKycType = $guestArray['kyc_type']; 
        $guestUploadType = $guestArray['file_upload_type'];
        $guestProofUploadType = $guestArray['proof_file_upload_type'];
        
        $birthdayDate = $guestArray['birthday'];
        $anniversaryDate = $guestArray['anniversary'];
        
    }

    $idProofHtml = '';
    foreach(getGuestIdProofData(1) as $idPList){
        $id = $idPList['id'];
        $name = $idPList['name'];
        if($id == $guestKycType){
            $idProofHtml .= "<option selected value='$id'>$name</option>";
        }else{
            $idProofHtml .= "<option value='$id'>$name</option>";
        }
    }

    
    if(!empty($guestArray) || $gustImg != '' || $guestProofImg != ''){

        ($gustImg == '') ? '' : $guestImage = $gustImg;
        ($guestProofImg == '') ? '' : $guestKycFile = $guestProofImg;

        $guestImgUrl = $guestArray['profileImgFull'];        
        $guestPImgUrl = $guestArray['varifyImgFull'];

        $guestPImgHtml =  "<img width='80' data-img='$guestKycFile' src='$guestPImgUrl' />";
        $guestImgHtml = "<img width='80' data-img='$guestImage' src='$guestImgUrl' />";
        
    }
    


    $gender = ['male','female','other'];
    $genderHtml = '';
    
    foreach($gender as $genderList){
        $genderName = ucfirst($genderList);
        if($genderList == $guestGender){
            $genderHtml .= "<input type='radio' checked name='gender' value='$genderList' id='$genderList'><label class='mr5' for='$genderList'>$genderName</label>";
        }else{
            $genderHtml .= "<input type='radio' name='gender' value='$genderList' id='$genderList'><label class='mr5' for='$genderList'>$genderName</label>";
        }
        
    }

    $html = '
            <form data-page="'.$page.'" data-rTab="'.$rTab.'" data-bid="'.$bid.'" data-bdid="'.$bdid.'" id="'.$actionBtn.'" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <div class="guestImgSec" data-bid="'.$bid.'" data-gid="'.$gid.'" data-serial="'.$guestSerialNum.'">
                                '.$guestImgHtml.'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="guestName" placehold="Enter Name" class="form-control" value="'.$guestName.'">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="guestPhone" placehold="Enter Phone Number" class="form-control" value="'.$guestPhone.'">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="guestEmail" placehold="Enter Email Id" class="form-control" value="'.$guestEmail.'">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Gender</label> <br/>
                                    '.$genderHtml.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Block</label>
                            <input type="text" name="guestBlock" class="form-control" placeholder="Enter Block" value="'.$guestBlock.'">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">District</label>
                            <input type="text" name="guestDistrict" class="form-control" placeholder="Enter District" value="'.$guestDistrict.'">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" name="guestState" class="form-control" placeholder="Enter State" value="'.$guestState.'">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Zip</label>
                            <input type="text" name="guestZip" class="form-control" placeholder="Enter Address" value="'.$guestZip.'">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Birthday</label>
                            <input type="date" name="guestBirthday" class="form-control" placeholder="Enter Address" value="'.$birthdayDate.'">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Anniversary</label>
                            <input type="date" name="guestAnniversary" class="form-control" placeholder="Enter Anniversary" value="'.$anniversaryDate.'">
                        </div>
                    </div>



                </div>
                <input type="hidden" name="type" value="loadAddGuestReservationFormSubmit"/>
                <input type="hidden" name="guestId" id="guestId" value="'.$gid.'"/>
                <input type="hidden" name="bookingId" id="bookingId" value="'.$bid.'"/>
                <input type="hidden" name="bookingDId" id="bookingDId" value="'.$bdid.'"/>
                <input type="hidden" name="guestRTab" id="guestRTab" value="'.$rTab.'"/>
                <input type="hidden" name="guestPage" id="guestPage" value="'.$page.'"/>
                <input type="hidden" name="guestAction" id="guestAction" value="'.$action.'"/>
                <input type="hidden" name="guestRoomNum" id="guestRoomNum" value="'.$roomNum.'"/>
                <hr>
                <h4>Identity Verification</h4>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <div class="guestProofImgSec" data-bid="'.$bid.'" data-gid="'.$gid.'" data-serial="'.$guestSerialNum.'">
                                '.$guestPImgHtml.'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">ID Type</label>
                                    <select name="guestIdType" id="" class="form-control">
                                        <option value="">-Select-</option>
                                        '.$idProofHtml.'
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">ID Number</label>
                                    <input type="text" name="guestIdNumber" placehold="Enter ID Number" class="form-control" value="'.$guestKycNumber.'">
                                </div>
                            </div>
                            <div class="col-md-4"></div>                            

                        </div>
                    </div>
                </div>
            </form>
    ';


    echo $html;
}

if($type == 'loadAddGuestReservationFormSubmit'){

  
    $guestName = safeData($_POST['guestName']);
    $guestPhone = safeData($_POST['guestPhone']);
    $guestEmail = safeData($_POST['guestEmail']);
    $guestZip = safeData($_POST['guestZip']);
    $guestIdNumber = safeData($_POST['guestIdNumber']);
    $guestIdType = safeData($_POST['guestIdType']);

    $guestIdState = safeData($_POST['guestState']);

    $guestBirthday = safeData($_POST['guestBirthday']);
    $guestAnniversary = safeData($_POST['guestAnniversary']);

    $hotelId = $_SESSION['HOTEL_ID'];
    $bookId = safeData($_POST['bookingId']);
    // $roomnum = safeData($_POST['bookingDId']);
    $bookingDId = ($_POST['bookingDId'] == '') ? 0 : safeData($_POST['bookingDId']);

    $guestImgSec ='';
    $guestProofImgSec = '';

    if(isset($_POST['guestImgSec'])){
        $guestImgSec = safeData($_POST['guestImgSec']);
    }
    if(isset($_POST['guestProofImgSec'])){
        $guestProofImgSec = safeData($_POST['guestProofImgSec']);
    }

    $addBy = 1;

    isset($_FILES['guestImg']) ? $guestImg = $_FILES['guestImg'] : $guestImg['name'] = '';
    isset($_FILES['guestIdProofImg']) ? $kycImg = $_FILES['guestIdProofImg'] : $kycImg['name'] = '';


    $guestImage = '';
    $guestKycFile = '';

    if($_POST['guestId'] != ''){
        $gId = $_POST['guestId'];
        $guestArray = getGuestDetail('','',$gId)[0];
        $guestImage = $guestArray['image'];
        $guestKycFile = $guestArray['kyc_file'];
    }

    $guestImgStr = '';
    $guestProofStr = '';
    $guestImgStrSql = '';
    $guestProofStrSql = '';

    if($guestImg['name'] != ''){
        $guestImgStr = imgUploadWithData($guestImg,'guest',$guestImage)['img'];
        $guestImgStrSql = ",image='$guestImgStr'" ;
    }

    
    if($kycImg['name'] != ''){
        $guestProofStr = imgUploadWithData($kycImg,'guestP',$guestKycFile)['img'];
        $guestProofStrSql = ",kyc_file='$guestProofStr'"; 
    }

    if(!empty(getGuestDetail($bookId))){
        $lastKey = array_key_last(getGuestDetail($bookId));
        $getSerialNo = getGuestDetail($bookId)[$lastKey]['serial'];
        $serialNo = $getSerialNo + 1;
    }else{
        $serialNo = 1;
    }


    $sql = "insert into guest(hotelId,bookId,bookingdId,name,email,phone,state,zip,image,kyc_file,kyc_number,kyc_type,addBy,serial,birthday,anniversary) values('$hotelId','$bookId','$bookingDId','$guestName','$guestEmail','$guestPhone','$guestIdState','$guestZip','$guestImgSec','$guestProofImgSec','$guestIdNumber','$guestIdType','$addBy','$serialNo','$guestBirthday','$guestAnniversary')";

    if($_POST['guestId'] != ''){
        
        $sql = "update guest set name='$guestName',email='$guestEmail',phone='$guestPhone',state='$guestIdState',zip='$guestZip',kyc_number='$guestIdNumber',kyc_type='$guestIdType',addBy='$addBy',birthday='$guestBirthday',anniversary='$guestAnniversary' $guestImgStrSql $guestProofStrSql where id = '$gId'";
    }
    

    if(mysqli_query($conDB, $sql)){
        $data = [
            'status'=>'success',
            'bid'=>$bookId,
            'bdid'=>$bookingDId,
        ];
    }else{
        $data = [
            'status'=>'error',
            'bid'=>$bookId,
            'bdid'=>$bookingDId,
        ];
    }
    echo json_encode($data);
}

if($type == 'guestPhotoProofeWithWebsite'){
    
    $gid = $_POST['gid'];
    $bid = getGuestDetail('','',$gid)[0]['bookId'];
    $bookinId = getBookingData($bid)[0]['bookinId'];
    $Filetype = $_POST['fileType'];

    if($Filetype == 'guestImg'){
        $type = 'guestPhoto';
    }
    if($Filetype == 'proof'){
        $type = 'guestPhotoProof';
    }
    
    $prmtr = customEncodeBase64($bookinId);

    $link = GUEST_QR_CODE.'/'.$prmtr;

    $url = 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$link.'';
    $html = '<div id="webCamPopupFixContent">
                 <div class="closeGuestPopupFixContent"></div>
                 <div class="guestDocContent" style="max-width: 500px;">
                     <div class="closeContent">x</div>
                     <div class="content">

                         <div class="websiteContent">
                             <div class="form-group" style="display: flex;align-items: center;justify-content: center;border: 1px solid #d2d6da;border-radius: .3rem;">
                             <img src="'.$url.'">
                             </div>
                         </div>

                     </div>
                 </div>
             </div>';

    echo $html;
}

if($type == 'guestIdProofImgSubmit'){
    $file = $_FILES['file'];
    $post = $_POST;
    $bid = $post['bid'];
    $gid = $post['gid'];
    
    (getGuestDetail($bid,'', $gid)[0]['kyc_file'] == '') ? $oldImg = getGuestDetail($bid,'', $gid)[0]['kyc_file'] : $oldImg ='';


    (file_exists(SERVER_IMG.'/guestP/'.$oldImg) == 1) ? $guestImgStr = imgUploadWithData($file,'guestP',$oldImg)['img'] : $guestImgStr = imgUploadWithData($file,'guestP')['img'];
    
    if($gid != ''){
        $sql = "update guest set kyc_file = '$guestImgStr' where id = '$gid' ";
        mysqli_query($conDB, $sql);
    }   


    $data = [
        'name'=>$guestImgStr,
        'msg'=>'Successfull update guest image',
    ];

    echo json_encode($data);
}

if($type == 'guestPhotoWithWebsite'){
    $bid = $_POST['bid'];
    $serial = $_POST['serial'];
    $type = 'guestPhoto';
    $prameter = $type.'-'.$bid.'-'.$serial;
    $prmtr = str_openssl_enc($prameter);
    $link = GUEST_QR_CODE.'?id='.$prmtr;
    $url = 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$link.'';
    $html = '<div id="webCamPopupFixContent">
                 <div class="closeGuestPopupFixContent"></div>
                 <div class="guestDocContent" style="max-width: 500px;">
                     <div class="closeContent">x</div>
                     <div class="content">

                         <div class="websiteContent">
                             <div class="form-group" style="display: flex;align-items: center;justify-content: center;border: 1px solid #d2d6da;border-radius: .3rem;">
                             <img src="'.$url.'">
                             </div>
                         </div>

                     </div>
                 </div>
             </div>';

    echo $html;
}

if($type == 'guestIdImgSubmit'){
    $file = $_FILES['file'];
    
    $post = $_POST;
    $bid = $post['bid'];
    $gid = $post['gid'];
    $fileName = $post['gid'];

    (getGuestDetail($bid,'', $gid)[0]['image'] == '') ? $oldImg = getGuestDetail($bid,'', $gid)[0]['image'] : $oldImg ='';
    
    $guestImgStr = imgUploadWithData($file,'guest',$oldImg,'',$fileName,$bid,'private')['img'];

    if($gid != ''){
        $sql = "update guest set image = '$guestImgStr' where id = '$gid'";
        mysqli_query($conDB, $sql);
    }

    $data = [
        'name'=>$guestImgStr,
        'msg'=>'Successfull update guest image',
    ];

    echo json_encode($data);
}

if($type == 'saveWebCamCapture'){

    $imgtype = $_POST['imgtype'];
    $serial = $_POST['serial'];
    $gid = $_POST['gid'];


    $data = $_POST['photo'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    $guestArry = getGuestDetail('','',$gid)[0];

    $oldGuestImg = $guestArry['image'];
    $oldGuestProofImg = $guestArry['kyc_file'];
    

    $fileName = 'guest-'.rand(100000,999999).'.jpg';
    $guestImg = '';
    $guestProofImg = '';
    if($imgtype == 'guestImg'){
        $path = 'guest';
        if($oldGuestImg != '') {
            (file_exists(SERVER_IMG.'/guest/'.$oldGuestImg) == 1) ? unlink(SERVER_IMG.'guest/'.$oldGuestImg) : '';
        };
        mysqli_query($conDB, "update guest set image = '$fileName' where id = '$gid' and serial = '$serial'");
        $guestImg = $fileName;
    }

    if($imgtype == 'proof'){
        $path = 'guestP';
        if($oldGuestProofImg != '') {
            (file_exists(SERVER_IMG.'/guestP/'.$oldGuestProofImg) == 1) ? unlink(SERVER_IMG.'guestP/'.$oldGuestProofImg) : '';
        };
        mysqli_query($conDB, "update guest set kyc_file = '$fileName' where id = '$gid' and serial = '$serial'");
        $guestProofImg = $fileName;
    }



    file_put_contents( SERVER_IMG .$path. "/".$fileName, $data);

    $guestDetailArray = getGuestDetail('','',$gid);


    $return = [
        'status'=> 1,
        'bid'=> $guestDetailArray[0]['bookId'],
        'bdid'=> $guestDetailArray[0]['bookingdId'],
        'guestImg'=> $guestImg,
        'guestProofImg'=> $guestProofImg,
    ];

    echo json_encode($return);

    die();
}


if($type == 'loadGuestDetail'){
    $gid = safeData($_POST['gid']);
    $guestArray = getGuestDetail('','',$gid)[0];
    $guestReviwArry = getGuestReviewById($gid);

    $guestName = $guestArray['name'];
    $guestEmail = $guestArray['email'];
    $guestEmailHtml = ($guestEmail == '') ? "<span> Null </span>" : "<a href='mailto:$guestEmail'>$guestEmail</a>";
    $guestPhone = $guestArray['phone'];
    $guestPhoneHtml = ($guestPhone == '') ? "<span> Null </span>" : "<a href='tel:$guestPhone'>$guestPhone</a>";
    $guestCity = $guestArray['city'];
    $guestCityHtml =  ($guestCity == '') ? "Null" : "$guestCity";
    $guestState = $guestArray['state'];
    $guestzip = $guestArray['zip'];
    $guestImage = ($guestArray['image'] == '') ? WS_FRONT_SITE_IMG.'demo/person-icon.png' : WS_FRONT_SITE_IMG.'guest/'.$guestArray['image'];
    $guestKycFile = ($guestArray['kyc_file'] == '') ? WS_FRONT_SITE_IMG.'demo/identiProofIcon.png' : WS_FRONT_SITE_IMG.'guestp/'.$guestArray['kyc_file'];
    $guestKycNumber = $guestArray['kyc_number'];
    $guestKycType = $guestArray['kyc_type'];
    $guestKycTypeName = '';

    $guestAddress = $guestArray['full_address'];

    if($guestKycType == '' || $guestKycType == 0){
        $identiProofHtml = '
            <li><span>No Data</span></li>
        ';
    }else{
        $guestKycTypeName = getGuestIdProofData('',$guestKycType)[0]['name'];
        $identiProofHtml = '
            <li><span>'.$guestKycTypeName.'</span></li>
            <li class="dFlex">
                <img src="'.$guestKycFile.'" alt="">
                <strong>'.$guestKycNumber.'</strong>
            </li>
        ';
    }


    $html = '
    
            <div class="guestDetailBox">
                <div class="imgArea">
                    <img src="'.$guestImage.'" alt="">
                    <ul>
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="userDetail">
                    <div class="dFlex aic guestName">
                        <h4>'.$guestName.'</h4>
                        <h6><i class="fas fa-map-marker-alt"></i> '.$guestAddress.'</h6>
                    </div>
                    <div class="review">
                        <span>Rating</span>
                        <div class="dFlex">
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        <div class="showReview">See Review</div>
                    </div>
                    </div>
                    <div class="h6">Contatact Information</div>
                    <ul class="contactInfo">
                        <li>
                            <span>Phone:</span>
                            '.$guestPhoneHtml.'
                        </li>
                        <li>
                            <span>Email:</span>
                            '.$guestEmailHtml.'
                        </li>
                        <li>
                            <span>Address:</span>
                            <strong>'.$guestAddress.'</strong>
                        </li>
                    </ul>
                    <h6>Identity Proof</h6>
                    <ul class="identiProof">
                        '.$identiProofHtml.'
                    </ul>
                </div>
            </div>
    
    ';


    echo $html;
}






?>