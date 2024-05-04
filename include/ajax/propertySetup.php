<?php 


include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');


$type = '';

// pr($_POST);

if(isset($_POST['type'])){
    $type = $_POST['type'];
}



if($type == 'setAmenities'){
    $data = $_POST['data'];
    $amenitesArry = explode(',', $data);

    foreach($amenitesArry as $amenitesList){
        $amenitesName = $amenitesList;

        $existAmenites = getAmenitieById('', $amenitesName);
        // if($existAmenites)
    }

    pr($amenitesArry);
}

if($type == 'emailIdAddd'){
    $data = safeData($_POST['data']);

    if(hotelDetail('',$data) == 0){
        $existEmailId = hotelDetail()['hotelEmailId'];
        if($existEmailId == ''){
            $newEmail = $data;
        }else{
            $newEmail = $existEmailId.','.$data;
        }
        
        $result = setHotelDetail('hotelEmailId',$newEmail);
    
        if($result == 1){
            $data = [
                'error' => 'no',
                'msg' => 'Successfully add email id'
            ];
        }else{
            $data = [
                'error' => 'yes',
                'msg'=>'Something went wrong try again!'
            ];
        }
    }else{
        $data = [
            'error' => 'yes',
            'msg'=>'Already Exist!'
        ];
    }
    
    echo json_encode($data);
    
}

if($type == 'removeEmailId'){
    $email = $_POST['data'];
    $existEmailId = hotelDetail()['hotelEmailId'];
    $existEmailIdArry = explode(',',$existEmailId);
    $removeKey = array_search($email,$existEmailIdArry,true);
    unset($existEmailIdArry[$removeKey]);
    $newEmail = implode(',',$existEmailIdArry);
    $result = setHotelDetail('hotelEmailId',$newEmail);

    if($result == 1){
        $data = [
            'error' => 'no',
            'msg' => 'Successfully delete email id.'
        ];
    }else{
        $data = [
            'error' => 'yes',
            'msg'=>'Something went wrong try again!'
        ];
    }
    echo json_encode($data);

}

if($type == 'phoneNumAddd'){
    $data = safeData($_POST['data']);
    if(hotelDetail('',$data) == 0){
        $existPhoneNum = hotelDetail()['hotelPhoneNum'];
        if($existPhoneNum == ''){
            $newPhoneNum = $data;
        }else{
            $newPhoneNum = $existPhoneNum.','.$data;
        }
        
        $result = setHotelDetail('hotelPhoneNum',$newPhoneNum);
    
        if($result == 1){
            $data = [
                'error' => 'no',
                'msg' => 'Successfully add phone number.'
            ];
        }else{
            $data = [
                'error' => 'yes',
                'msg'=>'Something went wrong try again!'
            ];
        }
    }else{
        $data = [
            'error' => 'yes',
            'msg'=>'Already Exist!'
        ];
    }
    
    echo json_encode($data);
    
}

if($type == 'removePhoneNum'){
    $phoneNum = $_POST['data'];
    $existPhoneNum = hotelDetail()['hotelPhoneNum'];
    $existPhoneNumArry = explode(',',$existPhoneNum);
    $removeKey = array_search($phoneNum,$existPhoneNumArry,true);
    unset($existPhoneNumArry[$removeKey]);
    $newPhoneNum = implode(',',$existPhoneNumArry);
    $result = setHotelDetail('hotelPhoneNum',$newPhoneNum);

    if($result == 1){
        $data = [
            'error' => 'no',
            'msg' => 'Successfully delete phone number.'
        ];
    }else{
        $data = [
            'error' => 'yes',
            'msg'=>'Something went wrong try again!'
        ];
    }

    echo json_encode($data);
}


?>