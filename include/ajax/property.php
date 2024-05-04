<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

$type = $_POST['type'];

if($type == 'addressProfileSubmit'){
    $streetAddress = $_POST['streetAddress'];
    $district = $_POST['district'];
    $postCode = $_POST['postCode'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $coordinate = $_POST['coordinate'];
    $googleMap = $_POST['googleMap'];
    $googleMapIfremCheck = 0;
    
    if(isset($_POST['googleMapIfremCheck'])){
        $googleMapIfremCheck = 1;
    }

    $sql = "update propertylocation set address = '$streetAddress', district = '$district', pincode = '$postCode', country = '$country', state = '$state', coordinate = '$coordinate',  mapIfrem = '$googleMap' , mapIfremStatus = '$googleMapIfremCheck' where hotelId = '$hotelId'";

    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'loadTermData'){
    $termArry = hotelTerm();
    $policy = $termArry['policy'];
    $cancel = $termArry['cancel'];
    $refund = $termArry['refund'];

    $policyHtml = '
        <form id="policyForm">
            <textarea class="basic-example" name="policy">
                '.$policy.'
            </textarea>
            <div class="btnGroup"><div class="cancelBtn btn btn-outline-secondary"><div class="label-wrapper btn">Cancel</div></div><button class="termsAndPolicyBtn btn bg-gradient-info"><div class="label-wrapper">Save</div></button></div>
        </form>
    ';

    $cancelHtml = '
        <form id="cancelForm">
            <textarea class="basic-example" name="cancel">
                '.$cancel.'
            </textarea>
            <div class="btnGroup"><div class="cancelBtn btn btn-outline-secondary"><div class="label-wrapper">Cancel</div></div><button class="termsAndPolicyBtn btn bg-gradient-danger"><div class="label-wrapper">Save</div></button></div>
        </form>
    ';
    $refundHtml = '
        <form id="refundForm">
            <textarea class="basic-example" name="refund">
                '.$refund.'
            </textarea>
            <div class="btnGroup"><div class="cancelBtn btn btn-outline-secondary"><div class="label-wrapper">Cancel</div></div><button class="termsAndPolicyBtn btn bg-gradient-primary"><div class="label-wrapper">Save</div></button></div>
        </form>
    ';

    $data = [
        'policy' => $policyHtml,
        'cancel' => $cancelHtml,
        'refund' => $refundHtml,
    ];

    echo json_encode($data);
}

if($type == 'addPolicySubmit'){
    $policy = $_POST['policy'];
    
    $sql = "update property_term set policy = '$policy' where hotelId = '$hotelId'";

    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'cancelFormSubmit'){
    $cancel = $_POST['cancel'];
    
    $sql = "update property_term set cancel = '$cancel' where hotelId = '$hotelId'";

    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'refundFormSubmit'){
    $refund = $_POST['refund'];
    
    $sql = "update property_term set refund = '$refund' where hotelId = '$hotelId'";

    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

$url = parse_url('https://example.org');

   if ($url['scheme'] == 'https') {
       // is https;
   }

if($type == 'propertyAllUpdate'){
    global $hotelId;
    $hname = $_POST['hname'];
    $hemail = $_POST['hemail'];
    $phone = $_POST['phone'];
    $gst = $_POST['gst'];
    $description  = sanitizeStr($_POST['description']);
    $hWebUrl = parse_url($_POST['hurl']);
    $hurl  = (isset($hWebUrl['scheme'])) ? 'https://'.$hWebUrl['host'] : 'https://'.$_POST['hurl'];
    $checkIn  = $_POST['checkIn'];
    $checkout  = $_POST['checkout'];
    
    $socialMediaArry = $_POST['socialMedia'];
    $sKeyArry = $_POST['sKey'];

    $oldLogoImgDark = hotelDetail()['darklogo'];
    $oldLogoImgLight = hotelDetail()['lightlogo'];
    $websiteFavLogo = hotelDetail()['favicon'];
    $kotLogo = hotelDetail()['kotLogo'];

    foreach($sKeyArry as $key=>$val){
        $sVal = $socialMediaArry[$key];
        mysqli_query($conDB, "update hotelsociallink set link = '$sVal' where hotelId = '$hotelId' and slId = '$val'");
    }
    
    mysqli_query($conDB, "update hotel set hotelName = '$hname', website = '$hurl' where hCode = '$hotelId'");
    
    $sql = "update hotelprofile set gst='$gst',description='$description',checkIn='$checkIn',checkOut='$checkout'";

    if($_FILES['hllogo']['name'] != ''){
        $newfilename=imgUploadWithData($_FILES['hllogo'],'logo',$oldLogoImgLight,'no')['img'];        
        $sql .= ",lightlogo='$newfilename'";
    }

    if($_FILES['hdlogo']['name'] != ''){
        $newfilename=imgUploadWithData($_FILES['hdlogo'],'logo',$oldLogoImgDark,'no')['img'];
        $sql .= ",darklogo='$newfilename'";
    }

    if($_FILES['hfavicon']['name'] != ''){
        $newfilename=imgUploadWithData($_FILES['hfavicon'],'logo',$websiteFavLogo,'no')['img'];
        $sql .= ",favicon='$newfilename'";
    }

    if($_FILES['kotlogo']['name'] != ''){
        $newfilename=imgUploadWithData($_FILES['kotlogo'],'logo',$kotLogo,'no')['img'];
        $sql .= ",kotLogo='$newfilename'";
    }

    $sql .= " where hotelId ='$hotelId'";
    
    if(mysqli_query($conDB, $sql)){
        $data = [
            'error'=>'no',
            'msg'=>'Successfully Updated Data'
        ];
    }

    echo json_encode($data);
}


?>