<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');




// $newfilename=$path.'_'.rand(100000,999999).".".$ext;

// $dest = SERVER_PATH.'/'.$_FILES['something']['name'];

// move_uploaded_file($_FILES['something']['tmp_name'],$dest);
// $file = file_get_contents($dest);

// $tmp = explode(',',$file);                       //remove data: header
// file_put_contents($dest,base64_decode($tmp[1])); //decode base64 n save




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_FILES['photo'], $_POST['imgType'], $_POST['serial'], $_POST['gid'])) {
     

        $fileName = 'guest';
        $imgType = $_POST['imgType'];
        $serial = $_POST['serial'];
        $gid = $_POST['gid'];

       
        $imageData = $_FILES['photo'];

 
        $guestArry = getGuestDetail('', '', $gid)[0];
        $oldGuestImg = $guestArry['image'];
        $oldGuestProofImg = $guestArry['kyc_file'];

  
        $fileName = 'guest';
        $ans = imgUploadWithData($imageData, $gid, $oldGuestImg, '', $fileName, $gid, 'private');
        echo json_encode($ans);
        
    } else {
        // If required data is not sent, return an error response
        echo json_encode([
            'error' => 'Required data is missing.',
        ]);
    }
} else {
    // If the request method is not POST, return an error response
    echo json_encode([
        'error' => 'Invalid request method.',
    ]);
}


    // if($imgtype == 'guestImg'){
       
    //     $path = 'guest';
    //     if($oldGuestImg != '') {
    //         (file_exists(SERVER_IMG.'/guest/'.$oldGuestImg) == 1) ? unlink(SERVER_IMG.'guest/'.$oldGuestImg) : '';
    //     };
    //     // echo "update guest set image = '$fileName' where id = '$gid' and serial = '$serial'";
    //     mysqli_query($conDB, "update guest set image = '$fileName' where id = '$gid' and serial = '$serial'");
    //     $guestImg = $fileName;
    // }

    // if($imgtype == 'proof'){
    //     $path = 'guestP';
    //     if($oldGuestProofImg != '') {
    //         (file_exists(SERVER_IMG.'/guestP/'.$oldGuestProofImg) == 1) ? unlink(SERVER_IMG.'guestP/'.$oldGuestProofImg) : '';
    //     };
    //     mysqli_query($conDB, "update guest set kyc_file = '$fileName' where id = '$gid' and serial = '$serial'");
    //     $guestProofImg = $fileName;
    // }



    // file_put_contents( SERVER_IMG .$path. "/".$fileName, $data);

    // $guestDetailArray = getGuestDetail('','',$gid);


    // $return = [
    //     'status'=> 1,
    //     'bid'=> $guestDetailArray[0]['bookId'],
    //     'bdid'=> $guestDetailArray[0]['bookingdId'],
    //     'guestImg'=> $guestImg,
    //     'guestProofImg'=> $guestProofImg,
    // ];

    // echo json_encode($return);

    die();


?>