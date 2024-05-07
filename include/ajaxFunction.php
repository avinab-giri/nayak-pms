<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    include ('function.php');

    $hotelId = $_SESSION['HOTEL_ID'];

    function loadSocialMediaContent(){
        global $hotelId;
        $data = array();
        foreach(getHotelSocialLinkData('', $hotelId) as $item){
            $slId = $item['slId'];
            $data[] = [
                'data'=> $item,
                'detail'=> getSysSociallinkData($slId)[0]
            ];
        }
        
        return $data;
    }


    function losdSysExistSocialMedia(){
        return getSysSociallinkData('','no');
    }

    function AddSocialMedia(){
        global $conDB;
        global $hotelId;
        $sid = $_POST['sid'];
        $smurl = $_POST['smurl'];

        if(count(getHotelSocialLinkData('',$hotelId, $sid)) > 0){
            $sql = "update hotelsociallink set link = '$smurl' where hotelId = '$hotelId' and slId = '$sid'";
        }else{
            $sql = "insert into hotelsociallink(hotelId,slId,link) values('$hotelId','$sid', '$smurl')";
        }

        if(mysqli_query($conDB,$sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function hotelDetailReq(){
        $hid = $_SESSION['HOTEL_ID'];
        $data = [
            'profile'=>getHotelProfileData('',$hid)[0],
            'service'=>getHotelServiceData('',$hid)[0],
            'setting'=>getHotelSettingData('',$hid)[0],
            'location'=>getHotelLocationData('',$hid)[0],
            'seo'=> (count(getHotelSeoData('',$hid)) > 0) ? getHotelSeoData('',$hid)[0] : getHotelSeoData('',$hid),
        ];
        return $data;    
    }

    function checkRoomNumber(){
        global $conDB;
        global $hotelId;

        $value = $_POST['value'];
        if($_POST['rid'] !=''){
            if(count(getRoomList('','','','',$_POST['rid'])) > 0){
                $rid = getRoomList('','','','',$_POST['rid'])[0]['id'];
            }else{
                $rid = 0;
            }
        }else{
            $rid = 0;
        }

        $roomExist = count(getRoomNumber($value));
        $addBy = dataAddBy();
        

            if($value != ''){
                if($roomExist == 0 ){
                    mysqli_query($conDB, "insert into roomnumber(hotelId,roomNo,roomId,addBy) values('$hotelId', '$value', '$rid', '$addBy')");
                }
            }

           $roomArry = array();
           $roomNumAry = array();
            
            $data = array();

            if($value != ''){
                if($roomExist == 0 ){
                    if($value != ''){
                        $_SESSION['roomNumUpload'][] = ['roomNo'=>$value];
                    }
                    
        
                    if($rid != ''){
                        $roomArry = getRoomNumber('','',$rid);
                    }else{
                        $roomArry = $_SESSION['roomNumUpload'];
                    }
                    
                    foreach($roomArry as $item){
                        $roomNumAry[] = $item['roomNo'];
                    }

                    $data = [
                        'error'=>'no',
                        'msg'=>'',
                        'num'=>$roomNumAry
                    ];
                }else{

                    if($rid != ''){
                        $roomArry = getRoomNumber('','',$rid);
                    }else{
                        $roomArry = isset($_SESSION['roomNumUpload']) ? $_SESSION['roomNumUpload'] : array();
                    }
                    
                    
                    foreach($roomArry as $item){
                        $roomNumAry[] = $item['roomNo'];
                    }

                    $data = [
                        'error'=>'yes',
                        'msg'=>'Already exist room number',
                        'num'=>$roomNumAry
                    ];
                }
            }else{

                if($rid != '' && $rid != 0){
                    $roomArry = getRoomNumber('','',$rid);
                }else{
                    $roomArry = isset($_SESSION['roomNumUpload']) ? $_SESSION['roomNumUpload'] : array();
                }
                
                foreach($roomArry as $item){
                    $roomNumAry[] = $item['roomNo'];
                }
                $data = [
                    'error'=>'no',
                    'msg'=>'',
                    'num'=>$roomNumAry
                ];
            }

        
        return $data;

    }

    function deleteRoomNumber(){
        global $conDB;
        $val = $_POST['value'];
        $rid = getRoomList('','','','',$_POST['rid'])[0]['id']; 

        mysqli_query($conDB, "delete from roomnumber where roomNo = '$val' and roomId = '$rid'");
    }

    function updateAssignRoom(){
        global $hotelId;
        global $conDB;
        $rid = $_POST['rid'];
        $rnum = $_POST['rnum'];

        $sql = "update roomnumber set roomId = '$rid' where hotelId = '$hotelId' and roomNo = '$rnum'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=> 'no',
                'msg'=> 'Successfully updated room id.',
            ];
        }else{
            $data = [
                'error'=> 'yes',
                'msg'=> 'Something error.'
            ];
        }

        return $data;
    }

    function updateRoomStatusInsert(){
        global $hotelId;
        global $conDB;
        $rnum = $_POST['rnum'];
        $status = $_POST['chooseStatus'];

        return updateRoomStatus($rnum,$status,$status);
    }

    function updateRoomClean(){
        global $hotelId;
        global $conDB;
        $rnum = $_POST['rnum'];

        return updateRoomStatus($rnum,3,1);
    }

    function updateRoomConstuction(){
        global $hotelId;
        global $conDB;
        $rnum = $_POST['rnum'];

        return updateRoomStatus($rnum,4,1,'yes');
    }


    function loadHouseKeepingData(){
        $date = $_POST['date'];
        return getRoomNumber('','','','','','','','','','','','',$date);
    }

    function roomStatusChack(){
        $roomNum = $_POST['roomNum'];
        $data = array();

        $data = [
            'remark'=> (count(getHousekeepingData('',$roomNum)) > 0) ? getHousekeepingData('',$roomNum)[0] : '',
            'roomStatus'=>getRoomStatus('','yes', '1,3,4')
        ];

        return $data;
    }

    function remarkUpdateForm(){
        $hkid = $_POST['hkid'];
        $data = array();

        $data = [
            'remark'=> (count(getHousekeepingData($hkid)) > 0) ? getHousekeepingData($hkid)[0] : '',
            'roomStatus'=>getRoomStatus('','yes')
        ];

        return $data;
    }

    function guestCheckInByBid(){
        global $time;
        global $conDB;
        global $hotelId;
        $bid = $_POST['bid'];
        $data = array();
        $currentDate = date('Y-m-d', strtotime($time));


        $bookingDetailArray = getBookingDetailById($bid);
        $checkIn = $bookingDetailArray['checkIn'];
        $checkOut = $bookingDetailArray['checkOut'];
        $checkInStatus = $bookingDetailArray['checkinstatus'];
        $roomNumber = $bookingDetailArray['room_number'];
        
        $guestEmailId = getGuestDetail($bid)[0]['email'];

        if (strtotime($checkIn) >  strtotime($currentDate)) {
            $data = [
                'msg' => "Check-In date is $checkIn",
                'status' => 'error'
            ];
        }else{

            if($checkInStatus == 1){
                foreach (getBookingDetail('', $bid) as $bdItem) {
                    $bdid = $bdItem['id'];
                    $bdid = $bdItem['id'];
                    checkInOutFun('checkin', $bid, $bdid);
                    setBookingFolio('','',$bid,$bdid);

                    mysqli_query($conDB, "insert into housekeeping(hotelId,roomNum,status) values('$hotelId', '$roomNumber', '3')");
                    $lastHkId = mysqli_insert_id($conDB);
                    mysqli_query($conDB, "update roomnumber set hkid='$lastHkId', status='3' where roomNo = '$roomNumber'");
                    mysqli_query($conDB, "update bookingdetail set hkId='$lastHkId' where id = '$bdid'");
                    $alert = "Room $roomNumber is check-in";
                    setActivityFeed('', 2, $bid, $bdid, '', '', '', '', $alert);
                    
                }

                $msg = generateInvoice('checkinGuest','',$bid);
                send_email($guestEmailId, '', '', '', $msg, 'Thank you for check in.');

                $data = [
                    'msg' => 'checked-In',
                    'status' => 'success'
                ];
                
            }

            if($checkInStatus == 2){
                foreach (getBookingDetail('', $bid) as $bdItem) {
                    $bdid = $bdItem['id'];
                    $bdid = $bdItem['id'];
                    $hkId = $bdItem['hkId'];
                    checkInOutFun('checkin', $bid, $bdid);
                    setBookingFolio('','',$bid,$bdid);

                    if($hkId != 0){
                        mysqli_query($conDB, "update housekeeping set status='3' where roomNo = '$hkId'");
                        mysqli_query($conDB, "update roomnumber set status='3' where roomNo = '$roomNumber'");
                        $alert = "Room $roomNumber is check-Out";
                        setActivityFeed('', 2, $bid, $bdid, '', '', '', '', $alert);
                    }  
                    
                    
                }

                $msg = generateInvoice('checkoutGuest','',$bid);
                send_email($guestEmailId, '', '', '', $msg, 'Thank you for check in.');

                $data = [
                    'msg' => 'checked-Out',
                    'status' => 'success'
                ];
                                        
            }              
            
        }


        return $data;
        
    }

    function addHouseKeeper()  {
        global $hotelId;
        global $conDB;
        $roomNum = $_POST['roomNum'];
        $remark = $_POST['remark'];
        $status = ($_POST['status'] == '') ? getRoomNumber($roomNum)[0]['status'] : $_POST['status'];
        $addBy = '';
        $currentDate = date('Y-m-d');
        
        $sql = "insert into housekeeping(hotelId,roomNum,status,remark,addBy) values('$hotelId','$roomNum', '$status', '$remark', '$addBy')";
        $olData = '';

        if(mysqli_query($conDB, $sql)){
            mysqli_query($conDB, "update roomnumber set status='$status' where roomNo = '$roomNum'");
            setActivityFeed('',23,'','',$olData,$remark);
            $data = [
                'error'=> 'no',
                'msg'=> 'Successfully record add'
            ];
        }else{
            $data = [
                'error'=> 'yes',
                'msg'=> 'Something error'
            ];
        }

        

        return $data;
    }


    function loadGalleryCategoryData(){
        global $conDB;
        return getWbGalleryCategory();
    }

    function loadBeGalleryList(){
        global $conDB;
        $cat = (isset($_POST['category'])) ? $_POST['category'] : '';
        return getWbGalleryData('','','',$cat);
    }

    function addGalleryCategory(){
        global $conDB;
        global $hotelId;
        $value = $_POST['value'];
        $addBy = dataAddBy();
        
        if(isset($_POST['editId']) && $_POST['editId'] != ''){
            $editId = $_POST['editId'];
            $sql = "update wb_gallery_category set name = '$value' where id = '$editId'";
            $chackGalleryCan = getWbGalleryCategory('','','','','',$value,$editId);
        }else{
            $sql = "insert into wb_gallery_category(name,addBy,hotelId) values('$value', '$addBy','$hotelId')";
            $chackGalleryCan = getWbGalleryCategory('','','','','',$value);
        }
        
        if(count($chackGalleryCan) > 0){
            $data = [
                'error'=>'yes',
                'msg'=>'Already exists category'
            ];
        }else{
            if(mysqli_query($conDB, $sql)){
                $data = [
                    'error'=>'no',
                    'msg'=>'Successfully add record'
                ];
            }else{
                $data = [
                    'error'=>'yes',
                    'msg'=>'Something error'
                ];
            }
        }

        return $data;
    }

    function removeGalleryCat(){
        global $conDB;
        $catId = $_POST['catId'];
        $sql = "delete from wb_gallery_category where id = '$catId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully delete record'
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Something error'
            ];
        }

        return $data;
    }



    function loadBlogCategoryData(){
        global $conDB;
        return getWbBlogCategoryData();
    }

    function addBlogCategory(){
        global $conDB;
        global $hotelId;
        $value = $_POST['value'];
        $addBy = dataAddBy();
        
        if(isset($_POST['editId']) && $_POST['editId'] != ''){
            $editId = $_POST['editId'];
            $sql = "update wb_blog_category set name = '$value' where id = '$editId'";
            $chackBlogCan = getWbBlogCategoryData('','','','','',$value,$editId);
        }else{
            $sql = "insert into wb_blog_category(name,addBy,hotelId) values('$value', '$addBy','$hotelId')";
            $chackBlogCan = getWbBlogCategoryData('','','','','',$value);
        }
        
        if(count($chackBlogCan) > 0){
            $data = [
                'error'=>'yes',
                'msg'=>'Already exists category'
            ];
        }else{
            if(mysqli_query($conDB, $sql)){
                $data = [
                    'error'=>'no',
                    'msg'=>'Successfully add record'
                ];
            }else{
                $data = [
                    'error'=>'yes',
                    'msg'=>'Something error'
                ];
            }
        }

        return $data;
    }

    function removeBlogCat(){
        global $conDB;
        $catId = $_POST['catId'];
        $sql = "delete from wb_blog_category where id = '$catId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully delete record'
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Something error'
            ];
        }
        return $data;
    }

    function makeReservationDetail(){
        $bid = $_POST['bid'];
        return getBookingDetailById($bid);
    }

    function getGuestData(){
        $gid = $_POST['gid'];
        return getGuestDetail('','',$gid);
    }

    function getReservationTypeRecord(){
        return getReservationType();
    }

    function reservationGuestDelete(){
        global $conDB;
        $gid = $_POST['gid'];
        $sql = "update guest set deleteRec = 0 where id = '$gid'";
        $data = array();
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=> 'no',
                'msg'=> 'Your guest detail has been deleted.'
            ];
        }else{
            $data = [
                'error'=> 'yes',
                'msg'=> 'Something error!'
            ];
        };

        return $data;
    }

    function reservationTypeChange(){
        global $conDB;
        $value = $_POST['value'];
        $bid = $_POST['bid'];

        $sql = "update booking set reservationType = '$value' where id = '$bid'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=> 'no',
                'msg'=> 'successfully updated.'
            ];
        }else{
            $data = [
                'error'=> 'yes',
                'msg'=> 'Something error!'
            ];
        }

        return $data;
    }

    function reservationCheckInChange(){
        global $conDB;
        $bid = $_POST['bid'];
        $bdid = $_POST['bdid'];
        $value = $_POST['value'];

        return setCheckInCheckOutDate('checkIn', $bid, $bdid, $value);
    }

    function reservationCheckOutChange(){
        global $conDB;
        $bid = $_POST['bid'];
        $bdid = $_POST['bdid'];
        $value = $_POST['value'];

        return setCheckInCheckOutDate('checkOut', $bid, $bdid, $value);
    }

    function loadKotProListByMealTime(){
        global $conDB;
        $mealTime = $_POST['mealTime'];
        return getKotProduct('','','','','',$mealTime);
    }

    function stockAddContent(){
        return stockFormContent();
    }


    function addRatePlanInForm(){
        $data = createRatePlanInputField();
        return $data;
    }

    function deleteRatePlan(){
        global $conDB;
        $rdid = $_POST['rdid'];
        $sql = "delete from roomratetype where id = '$rdid'";
        $data = array();
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=> 'Successfully delete record.'
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=> 'Something error.'
            ];
        }
        return $data;
    }


    function reportContet(){
        $attr = $_POST['attr'];
        return reportContetFun($attr);
    }

    function kotOrderSubmit(){
        $html = kotGuestForm();
        
        $service = getKotService($_SESSION['kotSeviceId'])[0]['bdTable'];
        $data = [
            'action'=>$service,
            'html'=>$html
        ];
        
        return $data;
    }


    function kotQuickOrderData(){
        $data = array();
        foreach(getKotOrder('','','','','','','','0') as $item){
            $kid = $item['id'];
            $data[] = generateKotOrder($kid);
        }
        return $data;
    }

    function kotQuickOrderSettlmentUpdate(){
        global $conDB;
        $kid = $_POST['kid'];
        $kotStatus = getKotOrder($kid)[0]['orderStatus'];
        if($kotStatus == 0){
            $query = "update  kotorder set orderStatus = '1' where id='$kid'";  
        }
        if(mysqli_query($conDB, $query)){
            setActivityFeed('',18);
            $data = [
                'error'=>'success',
                'msg'=>'Successfully update.'
            ];
        }else{
            $data = [
                'error'=>'error',
                'msg'=>'Something wrong!'
            ];
        }
        return $data;
    }

    function kotOrderCount(){
        return count(getKotOrder('','','','','','','','0'));
    }


    function loadUsersData(){
        $uid = $_POST['uid'];
        $html = '';
        $action = $_POST['action'];

        if($action == 'inactive'){
            $data = getHotelUserDetail('','','','','','','','','0');
        }elseif($action == 'delete'){
            $data = getHotelUserDetail('','','','','','','','0');
        }else{
            $data = getHotelUserDetail('','','','','','','','1');
        }

        if(count($data) > 0){
            foreach($data as $item){
                $html .= '<li>';
                $id = $item['id'];
                $active = '';
                if($id == $uid){
                    $active = 'active';
                }
                $html .= generateUserInfo($id,'yes',$active);
    
                $html .= '</li>';
            }
        }else{
            $html .= '<li style="padding: 12px 15px;"><p>No Data</p></li>';
        }
        
        
        return $html;
    }

    function loadUserDetailData(){
        $uid = $_POST['uid'];
        return generateUserInfo($uid);
    }

    function loadHotelDetail(){
        return generateHotelDetail();
    }

    function loadAmenitiesData(){
        return getAmenitieById('', '', 'yes');
    }

    function loadPaymentLink(){
        $date = ($_POST['date'] == '')? date('Y-m-d'): $_POST['date'];
        return getPaymentLink('','','','','','', $date);
    }

    function getPaymentLinkData(){
        $pid = $_POST['pid'];
        return (count(getPaymentLink($pid))>0) ? getPaymentLink($pid) : array();
    }

    function paymentLinkSubmit(){
        global $conDB;
        $pid = $_POST['pid'];
        $perName = $_POST['perName'];
        $perEmail = $_POST['perEmail'];
        $perPhone = $_POST['perPhone'];
        $paymentAmount = $_POST['paymentAmount'];
        $paymentReason = $_POST['paymentReason'];
        $link = $_POST['link'];
        $hid = HOTEL_ID;
        $paymentId = $_POST['paymentId'];

        $paymentArray = [
            'hotelId'=>$hid,
            'paymentId'=>$paymentId,
            'accessId'=>$pid,
            'transactionId'=>$hid,
            'paymentSrtLink'=>'',
            'paymentLink'=>$link,
            'name'=>$perName,
            'email'=>$perEmail,
            'phone'=>$perPhone,
            'amount'=>$paymentAmount,
            'reason'=>$paymentReason,
            'addOn'=>date('Y-m-d'),
        ];
       
        insertData('payment_link', $paymentArray);
        return 1;
        // return setPaymentLinkGenerate($pid,'','',$perName,$perEmail,$perPhone,$paymentAmount,$paymentReason);

    }


    function copyPaymentLink(){
        $pid = $_POST['pid'];
        $paymentLink = getPaymentLink($pid)[0];
        $link = ($paymentLink['paymentSrtLink'] == null) ? $paymentLink['paymentLink'] : $paymentLink['paymentSrtLink'];

        if($paymentLink['paymentStatus'] == 'expired'){
            $data = [
                'status'=> 'error',
                'msg'=> 'Payment link is expired!',
                'link'=>''
            ];
        }else{
            $data = [
                'status'=> 'success',
                'msg'=> 'Payment link is copy to artboard.',
                'link'=> $link
            ];
        }
        return $data;
    }

    function editPaymentLink(){
        $pid = $_POST['pid'];
        $paymentLink = getPaymentLink($pid)[0];
        return $paymentLink;
    }

    function changePassword(){
        global $conDB;
        $currentPswd = $_POST['currentPswd'];
        $newPswd = $_POST['newPswd'];
        $confirmPswd = $_POST['confirmPswd'];
        $userId = $_SESSION['ADMIN_ID'];
        $hotelUserArry = getHotelUserDetail($userId)[0];
        $password = $hotelUserArry['password'];
        
        if($password == $currentPswd){
            if($newPswd == $confirmPswd){
                $sql = "update hoteluser set password = '$newPswd' where id = '$userId'";
                if(mysqli_query($conDB, $sql)){
                    setActivityFeed('','16','','',$currentPswd,$newPswd);
                    $data = [
                        'status'=>'success',
                        'msg' => 'Successfully password is change.'
                    ];
                }
            }else{
                $data = [
                    'status'=>'error',
                    'msg' => 'New Password And Confirm Password Does Not Match!'
                ];
            }
        }else{
            $data = [
                'status'=>'error',
                'msg' => 'Current password is wrong!'
            ];
        }

        return $data;
    }

    function loadUserDetail(){
        $uid = ($_POST['uid'] != '') ? $_POST['uid'] : $_SESSION['ADMIN_ID'];
        return generateUserInfo($uid);
    }


    function loadEditUserDetail(){
        $uid = $_POST['uid'];
        $roleArray = getUserRoleList();
        $admminId =$_SESSION['ADMIN_ID'];
        $detailArray = getHotelUserDetail($admminId)[0];
        $editRole = $detailArray['role'];
        if($uid == ''){
            $data = [
                'user'=>'',
                'role'=>$roleArray,
                'editRole'=>$editRole
            ];
        }else{
            $data = [
                'user'=>getHotelUserDetail($uid)[0],
                'role'=>$roleArray,
                'editRole'=>$editRole
            ];
        }

        return $data;
    }

    function pesonalDetailSubmit(){
        global $conDB;
        global $hotelId;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $bio = $_POST['bio'];
        $shortName = $_POST['shortName'];
        $designation = $_POST['designation'];
        $role = (isset($_POST['role'])) ? $_POST['role']: 0;

        $hotelMainId = hotelDetail('','','','',$hotelId)['hotelMainId'];

        $image = (isset($_POST['imgFile'])) ? $_POST['imgFile'][0] : 0;  

        if(isset($_POST['uerId'])){
            $userId = $_POST['uerId'];
            $imgArry = getHotelUserDetail($userId)[0];
            $imgName = $imgArry['imageId'];
            $image = (isset($_POST['imgFile'])) ? $_POST['imgFile'][0] : $imgName;  

            $sql = "update hoteluser set name='$name',email='$email',phone='$number',bio='$bio',imageId='$image',displayName='$shortName',designation='$designation',role='$role' where id='$userId'";
            $alert = 'Successfully update record.';
        }else{
            $userName = $_POST['userId'];
            $password = $_POST['password'];
            $sql = "insert into hoteluser(hotelMainId,hotelId,name,email,phone,bio,imageId,displayName,designation,role,userId,password) values('$hotelMainId','$hotelId','$name','$email','$number','$bio','$image','$shortName','$designation','$role','$userName','$password')";
            $alert = 'Successfully add record.';
            $userId = mysqli_insert_id($conDB);
        }

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=> 'success',
                'msg'=> $alert,
                'uid'=> $userId,
            ];
        }else{
            $data = [
                'status'=> 'error',
                'msg'=> 'Something error!',
                'uid'=> $userId,
            ];
        }

        return $data;
    }

    function updateDataOnDataBase(){
        global $conDB;
        global $hotelId;
        $tName = $_POST['tName'];
        $column = $_POST['column'];
        $value = $_POST['value'];
        $conKey = $_POST['conKey'];
        $conVal = $_POST['conVal'];
        $oldDataArry = array();
        $condition = ($conVal == 'hid') ? "$conKey='$hotelId'" : "$conKey=$conVal";
        $sql = "update $tName set $column=$value where $condition";

        if($tName == 'hoteluser'){
            $oldDataArry = getHotelUserDetail($conVal);
        }
        
        if(mysqli_query($conDB, $sql)){
            if($tName == 'hoteluser' && $column == 'imageId'){
                $imageId = $oldDataArry[0]['imageId'];
                $imageDataArry = getHotelImageData('','','','',$imageId);
                mysqli_query($conDB, "delete from hotel_image where id = $imageId");
                imgUploadWithData("", "", $imageDataArry[0]["image"],'','','','yes');
            }
            $data = [
                'status'=>'success',
                'msg'=>'Update successfully'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }

        return $data;
    }

    function newUserSubmit(){
        global $conDB;
        global $hotelId;
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $hotelMainId =  hotelDetail()['hotelMainId'];

        if($name == '' && $designation == '' &&  $email == '' &&  $number == '' &&  $userid == '' && $password == ''){
            $data = [
                'status'=> 'error',
                'msg'=> 'All field are requied!',
            ];
        }elseif(count(getHotelUserDetail('',$name)) > 0){
            $data = [
                'status'=> 'error',
                'msg'=> 'User already exists!',
            ];
        }elseif(count(getHotelUserDetail('','','',$email)) > 0){
            $data = [
                'status'=> 'error',
                'msg'=> 'Email id already exists!',
            ];
        }elseif(count(getHotelUserDetail('','','','',$number)) > 0){
            $data = [
                'status'=> 'error',
                'msg'=> 'Phone number already exists!',
            ];
        } elseif(count(getHotelUserDetail('','',$userid)) > 0){
            $data = [
                'status'=> 'error',
                'msg'=> 'User Id already exists!',
            ];
        } else{
            $sql = "insert into hoteluser(hotelMainId,hotelId,name,email,phone,designation,userId,password) values('$hotelMainId','$hotelId','$name','$email','$number','$designation','$userid','$password')";

            if(mysqli_query($conDB, $sql)){
                $data = [
                    'status'=> 'success',
                    'msg'=> 'Successfully add user.',
                ];
            }else{
                $data = [
                    'status'=> 'error',
                    'msg'=> 'Something error!',
                ];
            }
        }

        return $data;
    }

    function newAmenitieSubmit(){
        global $conDB;
        $name = $_POST['name'];
        $imgFile = $_POST['imgFile'][0];
        global $hotelId;

        if(count(getAmenitieById('',$name)) > 0){
            $data = [
                'status'=> 'error',
                'msg'=> 'Name already exists!',
            ];
        } else{
            $sql = "insert into amenities(hotelId,title,img) values('$hotelId','$name','$imgFile')";

            if(mysqli_query($conDB, $sql)){
                $data = [
                    'status'=> 'success',
                    'msg'=> 'Successfully add amenitie.',
                ];
            }else{
                $data = [
                    'status'=> 'error',
                    'msg'=> 'Something error!',
                ];
            }
        }

        return $data;
    }


    function loadPolicyData(){
        $type = (isset($_POST['type'])) ? $_POST['type'] : 'hotel';
        $policyData = (count(hotelTerm('','',$type)) > 0) ? hotelTerm('','',$type) : [['policyType'=>'','content'=>'']];
        $data = [
            'type'=>$policyData[0]['policyType'],
            'content'=>$policyData[0]['content'],
        ];
        return $data;
    }

    function loadImageData(){
        $type = (isset($_POST['type'])) ? $_POST['type'] : 'public';
        $site = getImgPath($type,'','','yes');
        $all_files = glob("$site*.*");
        $data = array();
        foreach($all_files as $item){
            $fileArray = explode('/',$item);
            $fileName = $fileArray[array_key_last($fileArray)];
            $fileSize = size_as_kb(filesize($item));
            $existCheck = (count(getHotelImageData('','','',$fileName,'','yes')) > 0) ? 'yes' : 'no';
            $data[] = [
                'file'=>$item,
                'fileName'=>$fileName,
                'fileSize'=>$fileSize,
                'exist'=>$existCheck
            ];
        }
        return $data;
    }

    function policyDataSubmit(){
        global $conDB;
        global $hotelId;
        $type = $_POST['type'];
        $content = sanitizeStr($_POST['policyDataTextarea']);
        $policyData = hotelTerm('','',$type);
        if(count($policyData) > 0){
            $policyId = $policyData[0]['id'];
            $sql = "update property_term set content = '$content' where id = '$policyId'";
            $alert = "Update record successfully.";
        }else{
            $sql = "insert into property_term(hotelId,policyType,content) values('$hotelId', '$type', '$content')";
            $alert = "Add record successfully.";
        }
        
        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>$alert,
                'content'=>($content == '') ? 'No Data' : $content
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!',
                'content'=>''
            ];
        }

        return $data;
    }

    function hotelImageAction($type,$fileType,$imagname){
        $imgArry = count(getHotelImageData('','','',$imagname,'','yes')) > 0 ? getHotelImageData('','','',$imagname,'','yes')[0] : array();
        $data = array();
        $fullImgPath = getImgPath($fileType,$imagname,'yes');

        if($type == 'edit'){
            $data = [
                'status'=> 'success',
                'msg'=> '',
                'imgArry'=> $imgArry
            ];
        }

        if($type == 'delete'){
            if(unlink($fullImgPath)){
                $data = [
                    'status'=> 'success',
                    'msg'=> 'Successfully delete file.',
                    'imgArry'=> ''
                ];
            }else{
                $data = [
                    'status'=> 'error',
                    'msg'=> 'Something went wrong!',
                    'imgArry'=> ''
                ];
            }
        }
        

        return $data;
    }

    function editImage(){
        $type = $_POST['type'];
        $imagname = $_POST['imagname'];
        return hotelImageAction('edit', $type, $imagname);
    }

    function deleteImage(){
        $type = $_POST['type'];
        $imagname = $_POST['imagname'];
        return hotelImageAction('delete', $type, $imagname);
    }

    function hotelImageDataSubmit(){
        global $conDB;
        $fileId = $_POST['fileId'];
        $fileTitle = $_POST['fileTitle'];
        $fileAlt = $_POST['fileAlt'];

        $sql = "update hotel_image set title='$fileTitle', altTag='$fileAlt' where id='$fileId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=> 'success',
                'msg'=> 'Successfully Update record.',
            ];
        }else{
            $data = [
                'status'=> 'error',
                'msg'=> 'Something went wrong!',
            ];
        }

        return $data;
    }

    function loadHotelData(){
        return generateHotelDetail();
    }

    function hotelDetailAjexFun(){
        global $hotelId;
        return hotelDetail('','','','',$hotelId);
    }

    function submitHotelData(){
        $name = $_POST['name'];
        $landlineNum = $_POST['landlineNum'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $description = $_POST['description'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $checkInTime = $_POST['checkInTime'];
        $checkOutTime = $_POST['checkOutTime'];
        $gstNumberField = $_POST['gstNumberField'];

        global $hotelId;
        global $conDB;

        $sql = "update hotel set hotelName='$name',landlineNum='$landlineNum',hotelPhoneNum='$number',hotelEmailId='$email',website='$website',description='$description' where hCode = '$hotelId'";

        if(mysqli_query($conDB, $sql)){
            mysqli_query($conDB, "update propertylocation set address='$street', city='$city',state='$state',pincode='$pincode' where hotelId = '$hotelId'");
            mysqli_query($conDB, "update hotelprofile set checkIn='$checkInTime', checkOut='$checkOutTime', gst='$gstNumberField' where hotelId = '$hotelId'");
            $data = [
                'status'=> 'success',
                'msg'=> 'Successfully Update record.',
            ];
        }else{
            $data = [
                'status'=> 'error',
                'msg'=> 'Something went wrong!',
            ];
        }

        return $data;
    }

    function loadAmenitieDetail(){
        $catid = $_POST['catid'];
        return getStysAmenitieData('',$catid,'1');
    }

    function updateAmenitieSubmit(){
        global $conDB;
        $aid = $_POST['aid'];
        $name = $_POST['name'];
        $imgFile = $_POST['imgFile'][0];

        $sql = "update amenities set title = '$name', img = '$imgFile' where id = '$aid'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=> 'success',
                'msg'=> 'Successfully Update record.',
            ];
        }else{
            $data = [
                'status'=> 'error',
                'msg'=> 'Something went wrong!',
            ];
        }

        return $data;
    }




    function loadRoomsData() {
        return getRoomList();
    }

    function updateKotStockFormSubmit(){
        global $conDB;
        global $hotelId;
        $product_name = $_POST['product_name'];
        $proCalculateBy = $_POST['proCalculateBy'];
        $proCategoryBy = $_POST['proCategoryBy'];
        $stockQty = $_POST['stockQty'];
        $stockPrice = $_POST['stockPrice'];
        $check = mysqli_query($conDB, "select * from kot_raw_product_list where name = '$product_name' and hotelId = '$hotelId'");
        $addBy = dataAddBy();

        if(mysqli_num_rows($check) > 0){
            $data = [
                'status'=>'error',
                'msg'=>'Already exists product name.'
            ];
        }else{
            $sql = "insert kot_raw_product_list(hotelId,name,priceCalculateBy,proCat,img,qty,price) values('$hotelId','$product_name','$proCalculateBy','$proCategoryBy','','$stockQty','$stockPrice')";
            
            if(mysqli_query($conDB, $sql)){
                $kpid = mysqli_insert_id($conDB);
                mysqli_query($conDB, "insert kot_stock_timeline(hotelId,kotStockId,action,qty,totalPrice,addBy) values('$hotelId','$kpid','buy','$stockQty','$stockPrice','$addBy')");
                $data = [
                    'status'=>'success',
                    'msg'=>'Successfully add product.'
                ];
            }else{
                $data = [
                    'status'=>'error',
                    'msg'=>'Someting error!'
                ];
            }
        }
        

        return $data;
    }

    function reservationPaymentSubmit(){
        $bookingId = $_POST['bookingId'];
        $bdid = $_POST['bdid'];
        return getBookingDetailById($bookingId);
    }

    function reservationPaymentLinkSubmitBtn(){
        $bookingId = $_POST['bookingId'];

        if(isset($_POST['fullPayment'])){
            $bookingArry = getBookingDetailById($bookingId);
            $price = $bookingArry['totalPrice'] - $bookingArry['userPay'];
        }

        if(isset($_POST['paymentAmount'])){
            $price = $_POST['paymentAmount'];
        }

        $data = array();
        if($price > 0){
            $data = setPaymentLinkGenerate('','3',$bookingId,'','','',$price,'');
        }

        return $data;
    }


    function payLinkShareAction(){
        global $hotelDetail;
        $pid = $_POST['pid'];
        $type = $_POST['type'];
        $data = array();
        if(count(getPaymentLink($pid)) > 0){
            $paymentArry = getPaymentLink($pid)[0];
            $payAmount = $paymentArry['amount'];
            $paymentLink = $paymentArry['paymentLink'];
            $invoiceNum = $paymentArry['paymentId'];
            $emailId = $paymentArry['email'];
            $hotelName = $hotelDetail['hotelName'];
            $addOn = $paymentArry['addOn'];
            $expireTimeSec = 1200;
            $expireTime = date('d-M, h:i A', strtotime($addOn) + $expireTimeSec);
            
            if($type == 'mail'){
                $paymentLinkMail = paymentLinkMail($payAmount,$invoiceNum,$expireTime,$paymentLink);
                $subject = "Payment Request - $invoiceNum";
                send_email($emailId,$hotelName,$emailId,$emailId,$paymentLinkMail,$subject);
                $data = [
                    'status'=>'success',
                    'msg'=>'Successfully sent mail.',
                    'link'=>''
                ];
            }
            if($type == 'qr'){
                $data = [
                    'status'=>'success',
                    'msg'=>'Successfully create QR Code.',
                    'link'=>generateQRCord($paymentLink)
                ];
            }
        }

        return $data;
    }

    function payLinkShareQrCode(){

    }

    function loadServices(){
        global $hotelId;
        return getHotelServiceData('',$hotelId);
    }

    function chatBotUpdate(){
        global $conDB;
        global $hotelId;
        $chatbotUrl = $_POST['chatbotUrl'];
        $sql = "update hotelprofile set chatBoturl = '$chatbotUrl' where hotelId = '$hotelId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully update data',
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!',
            ];
        }

        return $data;
    }

    function googleMapFormUpdate(){
        global $conDB;
        global $hotelId;
        $mapIfrem = $_POST['mapIfrem'];
        $mapLink = $_POST['mapLink'];
        $sql = "update propertylocation set mapIfrem = '$mapIfrem',mapLink = '$mapLink' where hotelId = '$hotelId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully update data',
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!',
            ];
        }

        return $data;
    }
    


    function loadAmenitieCatData(){
        $acat = $_POST['acat'];
        $html = '';
        foreach(getStysAmenitieCat() as $item){
            $id = $item['id'];
            $name = $item['name'];
            $active = '';
            if($id == $acat){
                $active = 'active';
            }
            $html .= '<li data-catid="'.$id.'" class="'.$active.'">';
            $html .= $name;
            $html .= '</li>';
        }

        return $html;
    }

    function submitAmenitieId(){
        $aid = $_POST['aid'];
        $exist = $_POST['exist'];
        global $conDB;
        global $hotelId;

        if(count(getHotelAmenitieData('',$aid)) > 0){
            $sql = "delete from amenities where sysAId = '$aid'";
            mysqli_query($conDB, "delete from room_amenities where amenitie_id = '$aid'");
        }else{
            $sql = "insert into amenities(sysAId,hotelId) values('$aid','$hotelId')";
        }
        
        if(mysqli_query($conDB, $sql)){
            return 1;
        }else{
            return 0;
        }
    }

    function loadSocialMedia(){
        global $hotelId;
        $data = array();
        foreach(getSysSociallinkData() as $item){
            $id = $item['id'];
            $link = (count(getHotelSocialLinkData('',$hotelId,$id))>0)?getHotelSocialLinkData('',$hotelId,$id)[0]['link'] : '';
            $smId = (count(getHotelSocialLinkData('',$hotelId,$id))>0)?getHotelSocialLinkData('',$hotelId,$id)[0]['id'] : '';
            $extra = [
                'link'=> $link,
                'smId'=> $smId,
            ];
            $data[] = array_merge($item,$extra);
        }

        return $data;
    }

    function socialMediaSubmit(){
        global $conDB;
        global $hotelId;
        $smIdArry = $_POST['smId'];
        $sKeyArry = $_POST['sKey'];
        $socialMediaArry = $_POST['socialMedia'];

        foreach($sKeyArry as $key=>$val){
            $socialId = $val;
            $smId = $smIdArry[$key];
            $link = $socialMediaArry[$key];
            
            if($link != ''){
                if(count(getHotelSocialLinkData('',$hotelId,$socialId))>0){
                    $sql = "update hotelsociallink set link = '$link' where id='$socialId'";
                }else{
                    $sql = "insert into hotelsociallink(hotelId,slId,link) values('$hotelId','$socialId','$link')";
                }

                // echo $sql;
                mysqli_query($conDB, $sql);
            }
        }
        return 1;
    }


    function restoreRoomID(){
        global $conDB;
        $rid = $_POST['rid'];
        $sql = "update room set deleteRec = '1' where id='$rid'";
        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully restore.'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something wrong!'
            ];
        }

        return $data;
    }


    function themeClrUpdate(){
        global $hotelId;
        global $conDB;
        $target = $_POST['target'];
        $targetVal = $_POST['targetVal'];
        $clrtype = $_POST['clrtype'];
        
        $hotelClrData = getHotelThemeColor($hotelId);
        if(count($hotelClrData) > 0){
            $existValue = explode(',',$hotelClrData[0][$target]);
            $lightClr = (isset($existValue[0])) ? $existValue[0] : '';
            $darkClr = (isset($existValue[1])) ? $existValue[1] : '';
            $clrValue = ($clrtype == 'light') ? "$targetVal,$darkClr" : "$lightClr,$targetVal";
            $sql = "update hotel_theme_color set $target = '$clrValue' where hotelId = '$hotelId'";
            $msg = "Successfully update color";
        }else{
            $clrValue = ($clrtype == 'light') ? "$targetVal,''" : "'',$targetVal";
            $sql = "insert into hotel_theme_color(hotelId,$target) values('$hotelId','$clrValue')";
            $msg = "Successfully add color";
        }

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=> $msg
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=> 'Something went wrong!'
            ];
        }

        return $data;
    }

    function checkCheckoutPrice(){
        $checkValue = $_POST['checkValue'];

        if($checkValue == 'advancePay'){
            $priceClm = 'advancePay';
            $desc = 'advancePayStatus';
        }elseif($checkValue == 'PartialPayment'){
            $priceClm = 'PartialPaymentPrice';
            $desc = 'partialPaymentStatus';
        }elseif($checkValue == 'pickupDrop'){
            $priceClm = 'pckupDropPrice';
            $desc = 'pckupDropStatus';
        }
        $settingValue = settingValue();
        $price = $settingValue[$priceClm];
        $desc = $settingValue[$desc];
        
        return [
            'price'=>$price,
            'desc'=>$desc
        ];
    }

    function loadCheckout(){
        // [
        //     'key'=>'advancePay',
        //     'name'=>'Advance pay'
        // ],
        // [
        //     'key'=>'payByRoom',
        //     'name'=>'Pay by room'
        // ],
        // [
        //     'key'=>'pickupDrop',
        //     'name'=>'Pickup drop'
        // ]
        $proSetting = [
            
            [
                'key'=>'PartialPayment',
                'name'=>'Partial payment'
            ],
            
        ];

        $html = '';

        foreach($proSetting as $item){
            $key = $item['key'];
            $name = $item['name'];
            $settingValue = settingValue();

            if($key == 'advancePay'){
                $clmName = 'advancePayStatus';
                $editBtnVal = 1;
            }elseif($key == 'PartialPayment'){
                $clmName = 'partialPaymentStatus';
                $editBtnVal = 1;
            }elseif($key == 'payByRoom'){
                $clmName = 'payByRoomStatus';
                $editBtnVal = 0;
            }elseif($key == 'pickupDrop'){
                $clmName = 'pckupDropStatus';
                $editBtnVal = 1;
            }

            $editBtn = '';
            $staus = $settingValue[$clmName];
            $checked = '';
            if($staus == 1){
                $checked = 'checked';
                $editBtn = ($editBtnVal == 1) ? '<button data-checkattr="'.$key.'" class="paymentEditBtn"><svg><use xlink:href="#editfilledIcon"></use></svg></button>' : '';
            }

            $html .= '
                <div class="form-group checkOutChoseBox">
                    '.$editBtn.'
                    <input '.$checked.' id="'.$key.'" type="checkbox" value="'.$key.'">
                    <label for="'.$key.'">
                        <svg class="w28 h28"  viewBox="0 0 130.2 130.2">
                            <circle class="path circle" stroke="#fff" fill="none" stroke-width="10" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                            <polyline class="path check tick" stroke="#fff" fill="none" stroke-width="10" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                        </svg>
                        <span>'.$name.'</span>
                    </label>
                </div>
            ';
        }

        return $html;
    }

    function actionCheckBox(){
        global $hotelId;
        global $conDB;
        $check = $_POST['check'];
        $checkValue = $_POST['checkValue'];

        if($checkValue == 'advancePay'){
            $clmName = 'advancePayStatus';
        }elseif($checkValue == 'PartialPayment'){
            $clmName = 'partialPaymentStatus';
        }elseif($checkValue == 'payByRoom'){
            $clmName = 'payByRoomStatus';
        }elseif($checkValue == 'pickupDrop'){
            $clmName = 'pckupDropStatus';
        }
        

        if($check == 'true'){
            $sql = "update propertysetting set $clmName = '1' where hotelId = '$hotelId'";
        }else{
            $sql = "update propertysetting set $clmName = '0' where hotelId = '$hotelId'";
        }

        $data = array();


        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfull update data'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }

        return $data;

    }

    function submitPaymentCheckout(){
        global $conDB;
        global $hotelId;

        $elementId = $_POST['elementId'];
        $price = $_POST['price'];

        if($elementId == 'advancePay'){
            $clmName = 'advancePay';
        }elseif($elementId == 'PartialPayment'){
            $clmName = 'PartialPaymentPrice';
        }elseif($elementId == 'pickupDrop'){
            $clmName = 'pckupDropPrice';
        }

        $sql = "update propertysetting set $clmName = '$price' where hotelId = '$hotelId'";
        $data = array();
        
        if(mysqli_query($conDB,$sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully update.'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something wrong!'
            ];
        }

        return $data;
    }

    function loadFatchCheckout(){
        $settingValue = settingValue();
        return $settingValue;
    }


    function addRestaurantOnKot(){
        global $hotelId;
        return getKotRestaurantData('',$hotelId);
    }
    

    function addRastaurantSubmitBtn(){
        global $hotelId;
        global $conDB;
        global $time;
        $name = $_POST['resName'];
        $checkQuery = mysqli_query($conDB, "select * from kot_restaurant where hotelId = '$hotelId' and name = '$name'");

        if(mysqli_num_rows($checkQuery) > 0){
            $data = 3;
        }else{
            
            $sql = "insert into kot_restaurant(hotelId,name,addOn) values('$hotelId','$name','$time')";

            if(mysqli_query($conDB, $sql)){
                $data = 1;
            }else{
                $data = 0;
            }
        }

        return $data;
    }


    function editRes(){
        global $conDB;
        $target = $_POST['target'];
        $name = $_POST['resName'];

        $sql = "update kot_restaurant set name='$name' where id='$target'";

        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function deleteRes(){
        global $conDB;
        $target = $_POST['target'];
        $sql = "update kot_restaurant set deleteRec='0' where id='$target'";
        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }


    function addTableForKotBtn(){
        global $conDB;
        global $hotelId;
        global $time;
        $resName = $_POST['resName'];
        $num = $_POST['num'];

        $checkQuery = mysqli_query($conDB, "select * from kottable where hotelId = '$hotelId' and tableNum = '$num' and resId = '$resName'");

        if(mysqli_num_rows($checkQuery) > 0){
            $data = 3;
        }else{
            
            $sql = "insert into kottable(hotelId,resId,tableNum,addOn) values('$hotelId','$resName','$num','$time')";

            if(mysqli_query($conDB, $sql)){
                $data = 1;
            }else{
                $data = 0;
            }
        }

        return $data;

    }

    function addFoodCat(){
        global $hotelId;
        return getBeKotCategory();
    }

    function addFCatSubmitBtn(){
        global $hotelId;
        global $conDB;
        global $time;
        $name = $_POST['resName'];
        $checkQuery = mysqli_query($conDB, "select * from kotprouct_cat where hotelId = '$hotelId' and name = '$name'");

        if(mysqli_num_rows($checkQuery) > 0){
            $data = 3;
        }else{
            
            $sql = "insert into kotprouct_cat(hotelId,name,addOn) values('$hotelId','$name','$time')";

            if(mysqli_query($conDB, $sql)){
                $data = 1;
            }else{
                $data = 0;
            }
        }

        return $data;
    }

    function editFCat(){
        global $conDB;
        $target = $_POST['target'];
        $name = $_POST['resName'];

        $sql = "update kotprouct_cat set name='$name' where id='$target'";

        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function deleteFCat(){
        global $conDB;
        $target = $_POST['target'];
        $sql = "update kotprouct_cat set deleteRec='0' where id='$target'";
        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function getPersonForm(){
        global $conDB;
        global $hotelId;
        if(isset($_POST['tid'])){
            $tid = $_POST['tid'];            
            $roomNum = getRoomNumber('','','','','',',',$tid)[0]['roomNo'];
            $bookingdetail = getBookingDetail('','','',$roomNum);
            $bid = $bookingdetail[0]['bid'];
            $guestDetail = getGuestDetail($bid,'','','','','','','','pos');
            if(count($guestDetail)==0){
                
                $guestDetail = getGuestDetail($bid);
            }            
            $personName = $guestDetail[0]['name'];
            $personEmail = $guestDetail[0]['email'];
            $personNumber = $guestDetail[0]['phone'];

         
            $data = kotGuestForm($personName,$personEmail,$personNumber);
            
        }
       else if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $posArry = getKotOrder($posId)[0];
            $guestArray = $posArry['guestDetail'];
            $name = $guestArray['name'];
            $email = $guestArray['email'];
            $phone = $guestArray['phone'];

            $data = kotGuestForm($name,$email,$phone);
        }else{
            $data = kotGuestForm();
        }

        return $data;
    }

    function personSubmit(){
        global $conDB;
        global $hotelId;
        global $time;
        $personName = $_POST['personName'];
        $personNumber = $_POST['personNumber'];
        $personEmail = $_POST['personEmail'];
      
        
        $alert = "Seccessfully add record";
        $data = array();

        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $sql = "update guest set name = '$personName', email = '$personEmail', phone = '$personNumber' where hotelId = '$hotelId' and type = 'pos' and accessId = '$posId'";
            mysqli_query($conDB, $sql);
        }else{
            $_SESSION['kotGuestDetail'] = [
                'name'=>$personName,
                'email'=>$personEmail,
                'phone'=>$personNumber,
            ];
        }

        $data = [
            'status'=>'success',
            'msg'=>$alert
        ];

        return $data;
    }

    function getAddTotalPersonForm(){

        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $posArry = getKotOrder($posId)[0];
            $data = $posArry['totalPerson'];
        }else{
            $data = (isset($_SESSION['kotTotalGuest'])) ? $_SESSION['kotTotalGuest'] : 0;
        }

        return $data;
    }

    function totalPersonSubmit(){
        global $conDB;
        global $hotelId;
        global $time;
        $totalPerson = $_POST['totalPerson'];
      
        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $sql = "update kotorder set totalPerson = '$totalPerson' where  id = '$posId'";
            mysqli_query($conDB, $sql);
        }else{
            $_SESSION['kotTotalGuest'] = $totalPerson;
        }
        
        $alert = "Seccessfully add record";
        $data = array();       

        $data = [
            'status'=>'success',
            'msg'=>$alert
        ];

        return $data;
    }

    function getAddNoteData(){

        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $posArry = getKotOrder($posId)[0];
            $data = $posArry['noteAdd'];
        }else{
            $data = (isset($_SESSION['kotNotes'])) ? $_SESSION['kotNotes'] : '';
        }


        return $data;
    }

    function notesSubmitBtn(){
        global $conDB;
        global $hotelId;
        global $time;
        $notes = $_POST['notes'];
      
        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $sql = "update kotorder set noteAdd = '$notes' where  id = '$posId'";
            mysqli_query($conDB, $sql);
        }else{
            $_SESSION['kotNotes'] = $notes;
        }
        
        $alert = "Seccessfully add record";
        $data = array();        

        $data = [
            'status'=>'success',
            'msg'=>$alert
        ];

        return $data;
    }

    function updateWaiter(){

        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $posArry = getKotOrder($posId)[0];
            $waiter = $posArry['waiter'];
        }else{
            $waiter = (isset($_SESSION['kotWaiter'])) ? $_SESSION['kotWaiter'] : '';
        }

        $data = [
            'all'=>getHotelUserDetail('','','','','',10),
            'waiter'=> $waiter
        ];
        return $data;
    }

    function waiterSubmitBtn(){
        global $conDB;
        global $hotelId;
        global $time;
        $waiter = $_POST['waiter'];
      
        if(isset($_SESSION['existPOSOrderId'])){
            $posId = $_SESSION['existPOSOrderId'];
            $sql = "update kotorder set waiter = '$waiter' where  id = '$posId'";
            mysqli_query($conDB, $sql);
        }else{
            $_SESSION['kotWaiter'] = $waiter;
        }
        
        $alert = "Seccessfully add record";
        $data = array();

        

        $data = [
            'status'=>'success',
            'msg'=>$alert
        ];

        return $data;
    }

    

    function kotOrderSettlement(){
        $posId = $_POST['posId'];
        $total = '';

        if($posId != ''){
            $_SESSION['existPOSOrderId'] = $posId;
        }else{
            $posId = $_SESSION['existPOSOrderId'];   
        }

        $posOrderArry = getKotOrder($posId)[0];
        
        $posArry = getKotOrder($posId)[0];
        $total = $posArry['totalPrice'];

        $data = [
            'total'=>$total,
            'paid'=>$posOrderArry['settlementAmount']
        ];
        
        return $data;
    }

    function kotOrderPayment(){
        $posId = $_POST['posId'];
        $total = '';

        if($posId != ''){
            $_SESSION['existPOSOrderId'] = $posId;
        }else{
            $posId = $_SESSION['existPOSOrderId'];   
        }
        
        $posArry = getKotOrder($posId)[0];
        $total = $posArry['totalPrice'];
        
        return $total;
    }

    function settlementSubmitBtn(){
        global $conDB;
        global $time;
        if($_POST['paymentType'] == 'case'){
            $paymentType = 6;
        }elseif($_POST['paymentType'] == 'upi'){
            $paymentType = 5;
        }elseif($_POST['paymentType'] == 'card'){
            $paymentType = 3;
        }else{
            $paymentType = 8;
        }
        $posId = $_POST['posId'];
        $settlementAmount = isset($_POST['settlementAmount']) ? $_POST['settlementAmount'] : 0;
        $tip = $_POST['tip'];
        $remark = $_POST['remark'];
        $orderTable = (isset($_SESSION['kotServiceProperty'])) ? '' : $_SESSION['kotServiceProperty'];
        $date = date('Y-m-d');

        if(isset($_POST['selectFolio'])){
            $roomNum = $_POST['selectFolio'];
            $bookingDetailArray = getBookingDetailById('',$roomNum);
            $bid = $bookingDetailArray['bid'];
            $bdid = $bookingDetailArray['id'];
            $kotCharge = getKotOrder($posId)[0]['totalPrice'];
            setBookingFolio('', '', $bid, $bdid, '', '', $kotCharge, '','','POS','', $remark,'', $time, 'pos');
        }

        if(isset($_SESSION['existPOSOrderId'])){
            $orderId = $_SESSION['existPOSOrderId'];
            $sql = "update kotorder set settlementAmount='$settlementAmount', orderStatus = '5' where id = '$orderId'";
            mysqli_query($conDB, $sql);
            setPaymentTimeline(4,0,$orderId,$settlementAmount,$paymentType,$remark,'',$tip);
            $alet = "";
            setActivityFeed('',18,$orderId,'','','','','',$alet);
        }        

        $msg = "Seccessfully settlement.";

        $data = [
            'status'=>'success',
            'msg'=>$msg
        ];

        return $data;
    }

    function paidSubmitBtn(){
        global $conDB;
        if($_POST['paymentType'] == 'case'){
            $paymentType = 6;
        }elseif($_POST['paymentType'] == 'upi'){
            $paymentType = 5;
        }elseif($_POST['paymentType'] == 'card'){
            $paymentType = 3;
        }else{
            $paymentType = 8;
        }
        
        $amount = $_POST['paidAmount'];
        $remark = $_POST['remark'];
        $orderTable = $_SESSION['kotServiceProperty'];
        $date = date('Y-m-d');

        if(isset($_SESSION['existPOSOrderId'])){
            $orderId = $_SESSION['existPOSOrderId'];
            $sql = "update kotorder set settlementAmount='$amount' where id = '$orderId'";
            mysqli_query($conDB, $sql);
            setPaymentTimeline(4,0,$orderId,$amount,$paymentType,$remark);
            $alet = "Table No. Paid &#8377; $amount";
            setActivityFeed('',25,$orderId,'','','','','',$alet);
        }  

        $msg = "Seccessfully settlement.";

        $data = [
            'status'=>'success',
            'msg'=>$msg
        ];

        return $data;
    }


    function setKotSevice(){
        $serviceId = $_POST['serviceId'];
        $_SESSION['kotSeviceId'] = $serviceId;
    }


    function addGCatSubmitBtn(){
        global $hotelId;
        global $conDB;
        global $time;
        $name = $_POST['galleryName'];
        $checkQuery = mysqli_query($conDB, "select * from wb_gallery_category where hotelId = '$hotelId' and name = '$name'");
        $addBy = dataAddBy();
        if(mysqli_num_rows($checkQuery) > 0){
            $data = 3;
        }else{
            
            $sql = "insert into wb_gallery_category(hotelId,name,addOn,addBy) values('$hotelId','$name','$time','$addBy')";

            if(mysqli_query($conDB, $sql)){
                $data = 1;
            }else{
                $data = 0;
            }
        }

        return $data;
    }

    function editGCat(){
        global $conDB;
        $target = $_POST['target'];
        $name = $_POST['resName'];

        $sql = "update wb_gallery_category set name='$name' where id='$target'";

        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function deleteGCat(){
        global $conDB;
        $target = $_POST['target'];
        $sql = "update wb_gallery_category set deleteRec='0' where id='$target'";
        if(mysqli_query($conDB, $sql)){
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }



    function loadCollectionReport(){
        global $hotelId;
        $startDate = ($_POST['startDate'] != '') ? date('Y-m-d', strtotime($_POST['startDate'])) : date('Y-m-d');
        $endDate = ($_POST['endDate'] != '') ? date('Y-m-d', strtotime($_POST['endDate'])) : date('Y-m-d');
        $payMode = ($_POST['payMode'] == 0) ? '' : $_POST['payMode'];
        $user = ($_POST['user'] == 0) ? '' : $_POST['user'];
        
        $collactionArry = getGuestPaymentTimeline('','','',$payMode,'','',$hotelId,'',$startDate,$endDate,$user);       

        return $collactionArry;
    }


    function loadInHouseReport(){
        $date = date('Y-m-d');
        $city = $_POST['city'];
        $name = $_POST['name'];
        $data = array();

        if($name != ''){
            foreach(getGuestDetail('','','','','',$date,'','','','',$name) as $item){
                $bid = $item['bookId'];
                $bdid = $item['bookingdId'];
                $bookingArray = getBookingDetail($bdid,'','','',$date,'',2)[0];
                $guestArray = ['guestArry'=>getGuestDetail($bid)];
                $data[] = array_merge($bookingArray,$guestArray);
            }
        }else if($city != ''){
            foreach(getGuestDetail('','','','','',$date,'','','','','',$city) as $item){
                $bid = $item['bookId'];
                $bdid = $item['bookingdId'];
                $bookingArray = getBookingDetail($bdid,'','','',$date,'',2)[0];
                $guestArray = ['guestArry'=>getGuestDetail($bid)];
                $data[] = array_merge($bookingArray,$guestArray);
            }
        }else{
            foreach(getBookingDetail('','','','',$date,'',2) as $item){
                $bid = $item['bid'];
                $guestArray = ['guestArry'=>getGuestDetail($bid)];
    
                $data[] = array_merge($item,$guestArray);
            }
        }
        
        return $data;
    }


    function loadCackoutReport(){
        $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
        $bookingId = $_POST['name'];
        $data = array();

        foreach(getBookingData($bookingId,'','','','yes','','','','roomNum','','','yes',$date,'','','','') as $item){
            $bid = $item['bid'];            
            $data[] = array_merge(getBookingDetailById($bid));
        }

        return $data;
    }


    function loadRomStatusReport(){
        $date = date('Y-m-d');
        $tab = ($_POST['tab'] == '') ? 'occupid' : $_POST['tab'];
        $name = $_POST['name'];
        $room = $_POST['room'];
        $data = array();

        if($tab == 'occupid'){
            foreach(getBookingDetail('','','','',$date,'',2) as $item){
                $bid = $item['bid'];
                $bookingData = getBookingDetailById($bid);
    
                $data[] = $bookingData;
            }
        }

        if($tab == 'vacant'){
            foreach(getRoomNumberWithFilter('','vacat') as $item){
                $roomName = getRoomData($item['roomId'])[0]['header'];
                $advance = ['roomType'=>$roomName];

                $data[] = array_merge($item, $advance);
            }
        }

        if($tab == 'block'){
            foreach(getRoomNumberWithFilter('','blocked') as $item){
                $roomName = getRoomData($item['roomId'])[0]['header'];
                $advance = ['roomType'=>$roomName];

                $data[] = array_merge($item, $advance);
            }
        }


        return $data;

    }

    function loadOccupancyForecastReport(){
        $startDate = ($_POST['startDate'] != '') ? date('Y-m-d', strtotime($_POST['startDate'])) : date('Y-m-d');
        $endDate = ($_POST['endDate'] != '') ? date('Y-m-d', strtotime($_POST['endDate'])) : date("d-m-Y", strtotime("$startDate +1 day"));
        $getRoomDataArry = getRoomData();
        // pr($getRoomDataArry);

        $roomName = array();
        $data = array();
        $cDate = array();
        $dataArry = array();

        $interval = round(abs(strtotime($endDate) - strtotime($startDate)) / 86400);

        for($i = 1; $i <= $interval; $i ++){
            $currentDate = date('Y-m-d', strtotime($startDate) + (86400 * $i));
            $cDate[] = $currentDate;
        }

        foreach($getRoomDataArry as $roomItem){
            $roomId = $roomItem['id'];
            $name = $roomItem['header'];
            $rid = $roomItem['id'];
            $roomName[] = $name;
            $perDayData = array();

            for($i = 1; $i <= $interval; $i ++){
                $currentDate = date('Y-m-d', strtotime($startDate) + (86400 * $i));
                $occupancy = count(getRoomNumberWithFilter($roomId,'reserved',$currentDate));   

                $perDayData[] = [
                    'date'=>$currentDate,                    
                    'occupancy'=>$occupancy,
                ];
            }

            $dataArry[] = [
                'rid'=>$rid,
                'roomName'=>$name,
                'perDayData'=>$perDayData,
                'total'=> count(getRoomNumberWithFilter($roomId))
            ];
            
        }

        $data = [
            'dateList'=>array_unique($cDate),
            'roomName'=>$roomName,
            'data'=>$dataArry,
        ];
        

        return $data;

    }


    function loadBlockReport(){
        $date = date('Y-m-d');
        $data = array();

        foreach(getRoomNumberWithFilter('','blocked',$date) as $item){          
            $roomName = getRoomData($item['roomId'])[0]['header'];
            $houseKeepar = (isset(getHousekeepingData($item['hkid'])[0])) ? getHousekeepingData($item['hkid'])[0] : '';
            $advance = [
                'roomName'=>$roomName,
                'houseKeepar'=>$houseKeepar,
            ];
            $data[] = array_merge($item,$advance);
        }

        return $data;
    }


    function UnblockRoomNumber(){
        global $conDB;
        global $hotelId;
        $roomNum = $_POST['num'];
        $roomNumArry = getRoomNumber($roomNum)[0];
        $hkid = $roomNumArry['hkid'];
        $sql ="update roomnumber set constuctionStatus = '1',hkid='0' where hotelId = '$hotelId' and roomNo = '$roomNum'";
        $alert = "Unblock $roomNum";
        if(mysqli_query($conDB, $sql)){
            setActivityFeed('',23,'','',4,1,'','',$alert);
            mysqli_query($conDB, "delete from housekeeping where id='$hkid'");
        }

        return 1;
    }

    function ViewGuestsFromReport(){
        $gid = $_POST['gid'];
        $bdid = $_POST['bdid'];

        return getGuestDetail('','',$gid,$bdid);
    }

    function loadArrivalsReport(){
        $inserData = $_POST['date'];
        $date = ($inserData == '') ? date('Y-m-d') : date('Y-m-d', strtotime($inserData)) ;
        $name = $_POST['name'];
        $data = array();

        foreach(getBookingData('','',$date,'','yes','','','','roomNum','','No','','','','','','',$name) as $item){
            $bid = $item['bid'];            
            $data[] = array_merge(getBookingDetailById($bid));
        }

        return $data;
    }

    function loadOccupiedRoomsReport(){
        $date = date('Y-m-d');
        $data = array();

        foreach(getBookingData('','',$date,'','','','','','','','yes') as $item){
            $bid = $item['bid'];
            $bookingAllDetailArry = getBookingDetailById($bid);
            $day = getNightByTwoDates($item['checkIn'],$item['checkOut']);

            $AdvanceArray = [
                'guestArry'=>getGuestDetail($bid),
                'totalNight'=>$day,
                'totalRoomPrice'=>$bookingAllDetailArry['totalRoomPrice'],
                'totalDiscount'=>$bookingAllDetailArry['totalDiscount'],
                'gstPrice'=>$bookingAllDetailArry['gstPrice'],
                'grossCharge'=>$bookingAllDetailArry['totalPrice']
            ];
            

            $data[] = array_merge($item,$AdvanceArray);
        }

        return $data;
    }

    function loadHouseKeepingReport(){
        global $time;
        $date = date('Y-m-d');
        $tab = ($_POST['tab'] == '') ? 'dailyStatus' : $_POST['tab'];
        $data = array();
        $today = date('Y-m-d', strtotime($date));

        if($tab == 'dailyStatus'){
            foreach(getRoomNumber('','','','','','','','','','','','',$date) as $item){
                $row = $item;
                $roomNum = $item['roomNo'];
                $advance = [
                    'availability' => (isset(getBookingData('',$roomNum,$date,'','onlyCheckIn')[0]['bid'])) ? 'stay' : 'vacant'
                ];
                $data[] = array_merge($item,$advance);
            }
        }

        if($tab == 'blockedRoom'){

            foreach(getRoomNumberWithFilter('','blocked',$date) as $item){          
                $roomName = getRoomData($item['roomId'])[0]['header'];
                $houseKeepar = (isset(getHousekeepingData($item['hkid'])[0])) ? getHousekeepingData($item['hkid'])[0] : '';
                $advance = [
                    'roomName'=>$roomName,
                    'houseKeepar'=>$houseKeepar,
                ];
                $data[] = array_merge($item,$advance);
            }
            
        }

        if($tab == 'clean'){
            $allData = getHousekeepingData('','','',$today);
            foreach($allData as $item){
                $status = $item['status'];
                
                $checkGuestCheckInStatusArray = getSysRoomStatus($status)[0];
                $statusName = $checkGuestCheckInStatusArray['name'];
                $statusBg = $checkGuestCheckInStatusArray['bg'];

                $advance = [
                    'statusName'=> $statusName,
                    'statusBg'=> $statusBg,
                ];

                $data[] = array_merge($item, $advance);
            }
        }
        
        return $data;

    }

    function selectHouseKeeper(){
        $data = array();
        $hkid = $_POST['hkid'];
        $data = [
            'allData'=> getHotelUserDetail('','','','','',6),
            'selectData'=> ($hkid != '') ? getHousekeepingData($hkid)[0] : array(),
        ];
        return $data;

    }

    function updateHK(){
        global $conDB;
        global $hotelId;
        $data = array();
        $chooseHK = $_POST['chooseHK'];
        $roomNum = $_POST['roomNum'];
        $hkid = $_POST['hkid'];
        $hkName = getHotelUserDetail($chooseHK)[0]['displayName'];

        if($hkid == 0 || $hkid == ''){
            $sql = "insert into housekeeping(hotelId,roomNum,assigningHK) value('$hotelId','$roomNum','$chooseHK')";
        }else{
            $sql = "update housekeeping set assigningHK = '$chooseHK' where id = '$hkid'";
        }       
        
        $alert = ($chooseHK == 0) ? 'Cancel' : "Assign $hkName to room $roomNum";


        if(mysqli_query($conDB, $sql)){
            setActivityFeed('',23,'','','','','','',$alert);
            $data = [
                'status'=>'success',
                'msg'=>'Update successfully'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }
        
        return $data;

    }

    function updateRemarkForHK(){
        global $conDB;
        global $hotelId;
        $data = array();
        $hkid = $_POST['hkid'];
        $hkRemark = $_POST['hkRemark'];
        $rnum = $_POST['rnum'];
        

        if($hkid == 0 || $hkid == ''){
            $sql = "insert into housekeeping(hotelId,roomNum,remark) value('$hotelId','$rnum','$hkRemark')";
            $alert = ($hkRemark == '') ? 'Clear' : "Remark add.";
        }else{            
            $sql = "update housekeeping set remark = '$hkRemark' where id = '$hkid'";
            $alert = ($hkRemark == '') ? 'Clear' : "Remark update.";
        }       

        


        if(mysqli_query($conDB, $sql)){
            setActivityFeed('',23,'','','','','','',$alert);
            $data = [
                'status'=>'success',
                'msg'=>'Update successfully'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }
        
        return $data;

    }


    function loadLiveKotOrderData(){
        $date = date('Y-m-d');
        $data = array();
        $resId = $_POST['resId'];
      
        foreach(getKotOrder('',$date,'','','','','',0) as $item){
            
            if($item['resturantId'] == $resId)
            {
                $koid = $item['id'];
                $advance = [
                    'order'=>getKotOrderDetail($koid)
                ];
                $data[] = array_merge($item,$advance);
            }          
        }
        return $data;
    }

    function loadUnSettledData(){
        $date = date('Y-m-d');
        $data = array();
        foreach(getKotOrder('',$date,'','','','','',0) as $item){
            $koid = $item['id'];

            $advance = [
                'order'=>getKotOrderDetail($koid)
            ];
            $data[] = array_merge($item,$advance);
        }
        return $data;
    }

    function loadInvoicesData(){
        $date = date('Y-m-d');
        $data = array();
        foreach(getKotOrder('',$date) as $item){
            $koid = $item['id'];

            $advance = [
                'order'=>getKotOrderDetail($koid)
            ];
            $data[] = array_merge($item,$advance);
        }
        return $data;
    }


    function printPOSorder(){
        $posId = $_POST['posid'];
        $order = getKotOrder($posId)[0];
        $orderDetail = getKotOrderDetail($posId);
        $totalProductPrice = $order['totalProductPrice'];
        $tax = $order['tax'];
        $totalPrice = $order['totalPrice'];
        $settlementAmount = $order['settlementAmount'];
        $invoice = $order['billno'];
        return posInvoice($invoice,'',$orderDetail,$totalProductPrice,$tax,$totalPrice,$settlementAmount);
    }


    function posShiftTable(){
        $posId = $_POST['posId'];
        $order = getKotOrder($posId)[0];
        $table = $order['servicePropertyId'];
        $tableArry = getKotTableData('','','','','','','','','',$table);

        $data = [
            'data' => $order,
            'table'=> $tableArry
        ];

        return $data;
    }

    function shiftTableSubmit(){
        global $conDB;
        $shiftTableSelect = $_POST['shiftTableSelect'];
        $posId = $_POST['posId'];
        $sql = "update kotorder set servicePropertyId = '$shiftTableSelect' where id = '$posId'";
        $data = array();
        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully Shift Table'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }

        return $data;
    }

    function cancelPosOrder(){
        global $conDB;
        global $hotelId;
        $orderId = $_SESSION['existPOSOrderId'];
        $data = array();

        $sql = "update kotorder set orderStatus = '4' where id = '$orderId' and hotelId = '$hotelId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully cancelled order'
            ];
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }
        

        return $data;
    }


    function loadOrderStatistics(){
        $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
        return posReportMake($date);
    }
    
    function loadMonthlyReport(){
        $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
        return posReportMake($date);
    }

    function loadDayCollections(){
        $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
        return posReportMake($date);
    }

    function editResAddRoomSubmit(){
        global $conDB;
        global $hotelId;
        $bid = $_POST['bid'];
        $rid = $_POST['selectRoom'];
        $rdid = $_POST['selectRateType'];
        $adult = $_POST['selectAdult'];
        $child = $_POST['selectChild'];
        $rnum = $_POST['roomNum'];
        $bookingArray = getBookingData($bid)[0];
        $checkIn = $bookingArray['checkIn'];
        $checkOut = $bookingArray['checkOut'];
        $data = array();
        $addBy = dataAddBy();
        $bookingArray = getBookingDetailById($bid);
        $roomNumList = explode(",",$bookingArray['roomNum']);
        $couponCode = '';

        $roomCharge = getQuickBookingPrice($rid, $rdid, $adult, $child, $checkIn, $checkOut, $couponCode)['totalPrice'];

        if($rnum == 0){
            $data = [
                'status'=>'error',
                'msg'=>'Please select room number.',
                'bid'=>$bid,
                'rnum'=>$rnum,
            ];
        }elseif(in_array($rnum, $roomNumList)){
            $data = [
                'status'=>'error',
                'msg'=>'Room already booked.',
                'bid'=>$bid,
                'rnum'=>$rnum,
            ];
        }else{
            $sql = "insert into bookingdetail(hotelId,bid,roomId,roomDId,room_number,adult,child,checkIn,checkOut,checkinstatus) values('$hotelId','$bid','$rid','$rdid','$rnum','$adult','$child','$checkIn','$checkOut','1')";

            if(mysqli_query($conDB,$sql)){
                $bdid = mysqli_insert_id($conDB);

                $alert = "Room $rnum has been add.";
                setActivityFeed('',24,$bid,'','','','','',$alert);
                mysqli_query($conDB,"insert into guest(hotelId,type,accessId,bookId,bookingdId,serial,addBy) values('$hotelId','booking','$bid','$bid','$bdid','1','$addBy')");
                mysqli_query($conDB,"insert into guestamenddetail(hotelId,bid,bdid) values('$hotelId','$bid','$bdid')");
                setBookingFolio('','',$bid,0,'',0,'',floatval(str_replace(',', '', $roomCharge)),'','Add Room');

                $data = [
                    'status'=>'success',
                    'msg'=>'Successfully add room.',
                    'bid'=>$bid,
                    'rnum'=>$rnum,
                ];
            }
        }

        

        return $data;
    }

    function editExtendStaySubmit(){
        global $conDB;
        global $hotelId;
        // $bid = $_POST['bid'];
        $bdid = $_POST['bookingDetailId'];
        
        $checkOutTime = date('Y-m-d', strtotime($_POST['checkOutTime']));
        $data = array();
        $bookingDetailArray = getBookingDetail($bdid)[0];
        $oldCheckOutDate = $bookingDetailArray['checkOut'];
        $bid = $bookingDetailArray['bid'];
        $room_number = $bookingDetailArray['room_number'];
        $formatCheckDate = date('M d', strtotime($checkOutTime));
        $sql = "update bookingdetail set checkOut='$checkOutTime' where id='$bdid'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'"Stay" Extended Successfully.',
            ];
            $alert = "Stay extended to $formatCheckDate in room number $room_number.";
            setActivityFeed('','29',$bid,$bdid,$oldCheckOutDate,$checkOutTime,'','',$alert);
        }else{
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!',
            ];
        }

        

        return $data;
    }

    function quickBalanceViewFun(){
        $bid = $_POST['bid'];
        
        return getBookingDetailById($bid);
    }

    function loadEditResturentReport(){
        $tab = $_POST['tab'];
        $bid = $_POST['bid'];
        if($tab == 'bill'){
            $activity = [
                            'activityArry'=>getActiveFeed('','',$bid),
                            'folio'=>filterBookingFolio($bid),
                        ];
        }else{
            $activity = ['activityArry'=>getActiveFeed('','',$bid)];
        }
        
        
        return array_merge(getBookingDetailById($bid),$activity);
    }


    function editBookingDetailFun(){
        $bdid = $_POST['bdid'];
        $bookingDetailArry = getBookingDetail($bdid)[0];
        $rid = $bookingDetailArry['roomId'];
        $checkIn = $bookingDetailArry['checkIn'];
        $roomcapacity = getRoomList('',$rid)[0]['roomcapacity'];
        $data = [
            'data'=>$bookingDetailArry,
            'roomType'=> getRoomData(),
            'roomNum'=> getRoomNumberWithFilter($rid,'vacat',$checkIn),
            'capacity'=> $roomcapacity,
        ];

        return $data;
    }


    function editBookingDetailSubmit(){
        global $conDB;
        $bookingDetailId = $_POST['bookingDetailId'];
        $bookingDetailArry = getBookingDetail($bookingDetailId)[0];
        $bid = $bookingDetailArry['bid'];
        $roomNumber = $_POST['roomNumber'];
        $adult = $_POST['adult'];
        $child = $_POST['child'];
        $data = array();
        $sql = "update bookingdetail set room_number='$roomNumber', adult='$adult', child='$child' where id = '$bookingDetailId'";
        if(mysqli_query($conDB, $sql)){
            $alert = "Room $roomNumber has been change.";
            setActivityFeed('',24,$bid,$bookingDetailId,'','','','',$alert);
            $data = [
                'status'=>'success',
                'msg'=>'Successfully update.',
                'bid'=> $bid,
            ];
        }

        return $data;
    }


    function roomNumberChange(){
        global $conDB;
        $gId = $_POST['gId'];
        $bdid = $_POST['bdid'];

        $sql = "update guest set bookingdId='$bdid' where id='$gId'";
        $data = array();
        if(mysqli_query($conDB, $sql)){
            $data = [
                'status'=>'success',
                'msg'=>'Successfully updated.'
            ];
        }

        return $data;
    }


    function loadAddPaymentForm(){
        $bid = $_POST['bid'];
        $bookingData = getBookingDetailById($bid);
        $advance = [
            'paymentMethod'=>getPaymentTypeMethod()
        ];
        return array_merge($bookingData,$advance);
    }
    function loadExtraChargesForm(){
        $bid = $_POST['bid'];
        $bookingData = getBookingDetailById($bid);
        $advance = [
            'paymentMethod'=>getPaymentTypeMethod(),
            'addOnCharge'=>getProAddonCharge(),
        ];
        return array_merge($bookingData,$advance);
    }

    function guestPaymentSubmit(){
        $bid = $_POST['bid'];
        $amount = $_POST['amount'];
        $paymentMethod = $_POST['paymentMethod'];
        $remark = $_POST['remark'];
        setBookingFolio('','',$bid,'','',$amount,'','','','Payment','',$remark);
        return setPaymentTimeline(3,'',$bid,$amount,$paymentMethod,$remark,'','',$bid);
    }


    function openFolioBtn(){
        $bid = $_POST['bid'];
        
        $activity = [
            'activityArry'=>getActiveFeed('','',$bid),
            'folio'=>filterBookingFolio($bid),
        ];

        return array_merge(getBookingDetailById($bid),$activity);
    }


    function loadAllowanceForm(){
        $bid = $_POST['bid'];
        return getBookingDetailById($bid);
    }

    function loadRoomChargeForm(){
        $bid = $_POST['bid'];
        $bookingDetailArry = getBookingDetailById($bid);
        $checkIn = $bookingDetailArry['checkIn'];
        $checkOut = $bookingDetailArry['checkOut'];
        $night = getNightByTwoDates($checkIn, $checkOut);
        $dateArray = array();

        for($i=0;$i < $night; $i++){
            $dateArray[] = date('Y-m-d', strtotime($checkIn) + ($i * 86400));
        }

        $data = [
            'date'=> $dateArray,
            'data'=>$bookingDetailArry
        ];

        return $data;
    }

    function allowanceFormSubmit(){
        $bid = $_POST['booingId'];
        $reference = $_POST['reference'];
        $ChargeId = $_POST['ChargeId'];
        $AmountCharge = $_POST['AmountCharge'];
        $Description = $_POST['Description'];
        $data = array();
        $gName = getBookingFolio('','',$bid)[0]['gName'];
        setBookingFolio('',$gName,$bid,'','',$AmountCharge,0,'','',$ChargeId,$reference,$Description,$AmountCharge);

        return $data;
    }

    function addExtraChargesSubmitBtn(){
        $bid = $_POST['booingId'];
        $roomList = $_POST['roomList'];
        $extraChargeName = $_POST['extraChargeName'];
        $chargeAmount = $_POST['chargeAmount'];
        $discountAmout = $_POST['discountAmout'];
        $remarks = $_POST['remarks'];
        $reference = $_POST['reference'];
        $data = array();
        
        foreach($roomList as $item){
            setBookingFolio('','',$bid,$item,'',0,0,$chargeAmount,'',$extraChargeName,$reference,$remarks,$discountAmout,$extraChargeName);
            $roommNum = getBookingDetail($item)[0]['room_number'];
            $alert = "Room $roommNum has been add $extraChargeName ($chargeAmount)";
            setActivityFeed('',27,$bid,$item,'','','','',$alert);
        }

        return $data;
    }

    function roomChargeFormSubmit(){
        $RoomChargeReferenceNumber = $_POST['RoomChargeReferenceNumber'];
        $bookingId = $_POST['bookingId'];
        $roomList = $_POST['roomList'];
        $txtRoomChargeDate = $_POST['txtRoomChargeDate'];
        $RoomChargeAmountCharge = $_POST['RoomChargeAmountCharge'];
        $RoomChargeAmountDiscount = $_POST['RoomChargeAmountDiscount'];
        $RoomChargeDescription = $_POST['RoomChargeDescription'];
        $roomMainPrice = $_POST['roomMainPrice'];

        $charge = 0;

        if(isset($_POST['RoomChargeIsHalfDayPosting'])){
            $charge = $roomMainPrice - ($roomMainPrice / 2);
        }

        if(isset($_POST['RoomChargeDiscountPercentage'])){
            $charge = $roomMainPrice - ($roomMainPrice * $_POST['RoomChargeDiscountPercentage'] / 100);
        }
        
        
        return setBookingFolio('','',$bookingId,'','','',$charge,'','','Room Charge',$RoomChargeReferenceNumber,$RoomChargeDescription,$RoomChargeAmountDiscount);
    }
    

    function deleteFolio(){
        global $conDB;
        global $hotelId;
        $fid = $_POST['fid'];

        $sql = "update booking_folio set deleteRec = '0' where folioId = '$fid' and hotelId = '$hotelId'";

        if(mysqli_query($conDB, $sql)){
            $data = [
                'msg'=>'Successfully delete folio record.',
                'status'=>'success'
            ];
        }else{
            $data = [
                'msg'=>'Something went wrong.',
                'status'=>'error'
            ];
        }

        return $data;
    }


    function chooseImageCon(){
        global $hotelId;     
        $catId = $_POST['catId'];
        $data = array();
        
        foreach(getHotelImageData($hotelId,'','','','','','public','nameAsc') as $item){
            $select = 'no';
            $imgId = $item['id'];
            $galleryArray = getWbGalleryData('','','','',$imgId)[0];
            $cat = $galleryArray['category'];
            if($catId == $cat){
                $select = 'yes';
            }
            $advance = [
                'select'=> $select
            ];
            $data[] = array_merge($item, $advance);
        }
        return $data;
    }

    function galleryItemFormSubmit(){
        global $conDB;
        global $time;
        global $hotelId;
        $accessKey = $_POST['accessKey'];
        $galleryItem = $_POST['galleryItem'];
        $addBy = dataAddBy();

        foreach($galleryItem as $item){
            $checkSql = mysqli_query($conDB, "select * from wb_gallery where img = '$item' and category = '$accessKey'");
            if(mysqli_num_rows($checkSql) > 0){

            }else{
                $sql = "insert into wb_gallery(hotelId, img, addBy, add_on,category) values('$hotelId', '$item', '$addBy', '$time','$accessKey')";
                mysqli_query($conDB, $sql);
            }
        }

        $data = [
            'status'=>'success',
            'msg'=>'Successfully update.',
        ];

        return $data;
    }
    function submitNewCharge(){
        $name  =  $_POST['chargename'];
        $amount = $_POST['amount'];
        $result = setExtraChargeList($name,$amount);
        if($result){
            return 'ok';
        }
        else{
            return 'no';
        }
    }

    function loadGuestNamesByBkind(){
        $bid = $_POST['bid'];
        $data = guestNamesByBid($bid);
        return $data;                
    }

    function addFolioFormSubmit(){
        $bid = $_POST['booingId'];
        $guestName = $_POST['guestName'];
        $chargeAmount = $_POST['chargeamount'];
        $receivedAmount = $_POST['receivedamount'];
        $reason = $_POST['reason'];

        $data = setBookingFolio('',$guestName,$bid,'','',$receivedAmount,$chargeAmount,'','','','', $reason,'');
        return $data;
    }


    function userPermission(){
        $uid = $_POST['uid'];
        $pageArry = getSysPageData();
        
        foreach($pageArry as $item){
            $pageId = $item['id'];
            $existVal = 'no';
            if(count(getUserAccess($uid,$pageId)) > 0){
                $existVal = 'yes';
            }
            $advance = [
                'exist'=>$existVal
            ];

            $returnData[] = array_merge($item , $advance);
        }
        $productArray = getSysProductData();
        $data = [
            'tap'=>$productArray,
            'content'=>$returnData,
        ];

        return $data;

    }


    function userPermissionSave(){
        $accessId = $_POST['accessId'];
        $uid = $_POST['uid'];
        foreach($accessId as $item){
            userAccessUpdate($uid,$item,$accessId);
        }
    }


    function makeNoShowReservation(){
        global $conDB;
        $bid = $_POST['bid'];
        $sql = "update booking set status = '5' where id = '$bid'";
        $data = '';
        if(mysqli_query($conDB, $sql)){
            foreach(fetchData('bookingdetail',['bid'=>$bid]) as $item){
                updateData('bookingdetail', ['checkinstatus'=> 6], ['id'=>$item['id']]);
            }
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    function makeCancelReservation(){
        global $conDB;
        $bid = $_POST['bid'];
        $sql = "update booking set status = '6' where id = '$bid'";
        $data = '';
        if(mysqli_query($conDB, $sql)){
            foreach(fetchData('bookingdetail',['bid'=>$bid]) as $item){
                updateData('bookingdetail', ['checkinstatus'=> 7], ['id'=>$item['id']]);
            }
            $data = 1;
        }else{
            $data = 0;
        }

        return $data;
    }

    
    // function checkPaymentStatus() {
    //     $addOn = $_POST['addOn'];
    //     $paymentStatus = $_POST['paymentStatus'];
    //     $addOnTimestamp = strtotime($addOn);
    //     $currentTimestamp = time();
    //     $addOnTimestampPlus20Minutes = $addOnTimestamp + (20 * 60);      
    //     echo $addOnTimestamp.'<br>';   
    //     echo $currentTimestamp.'<br>';
    //     echo $addOnTimestampPlus20Minutes;
    //     if ($addOnTimestampPlus20Minutes > $currentTimestamp) {
    //         return "Process";
    //     } elseif ($addOnTimestampPlus20Minutes < $currentTimestamp) {
    //         if($paymentStatus == 'process'){
    //             return 'Expired';
    //         }
    //     } else {
    //         return "Process";
    //     }
    // }
    
    
    function userDelete(){
        global $conDB;
        global $hotelId;
        $uid = $_POST['uid'];
        $sql = "update hoteluser set deleteRecord = 0 where id = '$uid' and hotelId = '$hotelId'";
        $userName = getHotelUserDetail($uid)[0]['name'];
        $adminName= getAddByData(dataAddBy());
        if(mysqli_query($conDB, $sql)){
            $msg = "Remove user <b>($userName)</b> by $adminName";
            setActivityFeed('', 28, '', '', '', '', '', '', $msg);
            $data = [
                'status'=>'success',
                'uid'=> $_SESSION['ADMIN_ID']
            ];
        }else{
            $msg = "Not Remove user <b>($userName)</b> by $adminName";
            setActivityFeed('', 28, '', '', '', '', '', '', $msg);
            $data = [
                'status'=>'error',
                'uid'=> $_SESSION['ADMIN_ID']
            ];
        }


        return $data;
    }


    function loadPageLinkData(){
        global $hotelId;
        return (isset(getHotelPageLink($hotelId)[0])) ? getHotelPageLink($hotelId)[0] : [];
    }
    

    function pageLinkSubmit(){
        global $hotelId;
        $aboutPageLink = $_POST['aboutPageLink'];
        $contactPageLink = $_POST['contactPageLink'];
        $hotelPolicyPageLink = $_POST['hotelPolicyPageLink'];
        $cancelPolicyPageLink = $_POST['cancelPolicyPageLink'];
        $refundPolicyPageLink = $_POST['refundPolicyPageLink'];

        return setHotelPageLink($hotelId,$aboutPageLink,$contactPageLink,$hotelPolicyPageLink,$cancelPolicyPageLink,$refundPolicyPageLink);
    }

    function getRoomNameList(){
        return getRoomList();
    }

    function getFolioList(){
        $data = array();
        foreach(getRoomNumber('','','','','','','','','','kotSearch') as $roomNumList){
            if($roomNumList['checkIn'] == 'yes'){
                $data[] = $roomNumList;
            }
        }

        return $data;
    }


    function loadCatData(){
        return getBeKotCategory('','','name');
    }
    

function editLiveOrder(){
    $qty = $_POST['qty'];
    $proId = $_POST['proId'];
    $orderId = $_POST['oId'];

    $result = updateLiveorderkot($qty,$proId,$orderId);
    if($result){
        return 'ok';
    }
    else{
        return 'no';
    }

}


function loadRestaurant(){
    global $hotelId;
    return getKotRestaurantData('',$hotelId);
}


function loadRevenueReport(){
    $startDate = ($_POST['startDate'] != '') ? date('Y-m-d', strtotime($_POST['startDate'])) : date('Y-m-d');
    $endDate = ($_POST['endDate'] != '') ? date('Y-m-d', strtotime($_POST['endDate'])) : date("d-m-Y", strtotime("$startDate +1 day"));
    
    $interval = round(abs(strtotime($endDate) - strtotime($startDate)) / 86400);
    $data = array();

    for($i = 1; $i <= $interval; $i ++){
        $currentDate = date('Y-m-d', strtotime($startDate) + (86400 * $i));        
        $bookingArray = dailyBookingEarningByAddOn($currentDate,'yes');
        
        foreach($bookingArray as $val){
            $roomDetailArray = getBookingDetailById($val['id']);
            $checkStatusArray = $roomDetailArray['checkinStatusArray'][0];
            $advance = [
                'guestName'=>(isset($roomDetailArray['guestArray'][0])) ? $roomDetailArray['guestArray'][0]['name'] : 'NA',
                'totalAmount'=>$roomDetailArray['totalPrice'],
                'subTotalPrice'=>$roomDetailArray['subTotalPrice'],
                'statusName'=>$checkStatusArray['name'],
                'statusClr'=>$checkStatusArray['color'],
                'statusBg'=>$checkStatusArray['bg'],
                'gstPrice'=>$roomDetailArray['gstPrice'],
            ];
            $data[] = array_merge($val, $advance);
        }
    }

    

    return $data;

}


function loadTodayEventReport() {
    global $time;
    $room = $_POST['room'];
    $tab = $_POST['tab'];
    $currentDate = date('Y-m-d', strtotime($time));
    $data = array();

    if($tab == 'booking'){
        $data = getBookingData('','',$currentDate,'','yes');
    }

    if($tab == 'inHouse'){
        $resuultData = getBookingDetail('','','','','','',2);
        foreach($resuultData as $item){
            $bookingDetailArry = getBookingData($item['bid'])[0];

            $advance = [
                'bookinId'=> $bookingDetailArry['bookinId'],
                'reciptNo'=> threeNumberFormat($bookingDetailArry['reciptNo']),
                'editResLink'=> generateEditReservationLink($item['bid']),
                'guestName'=> $bookingDetailArry['guestName'],
                'guestPhone'=> $bookingDetailArry['guestPhone'],
                'roomTypeName'=> getRoomNameType($item['roomId'])['header'],
                'checkInTime' => guestAmendReport('','',$item['bid'],$item['id'])['checkInTime']
             ];

            $data[] = array_merge($item, $advance);
        }
    }

    if($tab == 'checkOut'){
        $resuultData = getBookingDetail('','','','','','',3);
        foreach($resuultData as $item){
            $bookingDetailArry = getBookingData($item['bid'])[0];

            $advance = [
                'bookinId'=> $bookingDetailArry['bookinId'],
                'reciptNo'=> threeNumberFormat($bookingDetailArry['reciptNo']),
                'editResLink'=> generateEditReservationLink($item['bid']),
                'guestName'=> $bookingDetailArry['guestName'],
                'guestPhone'=> $bookingDetailArry['guestPhone'],
                'roomTypeName'=> getRoomNameType($item['roomId'])['header'],
                'checkOutTime' => guestAmendReport('','',$item['bid'],$item['id'])['checkOutTime']
             ];

            $data[] = array_merge($item, $advance);
        }
    }

    return $data;
}


function generateGuestListById(){
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];

    $bookingDetailArray = getBookingDetail($bdid,$bid)[0];
    $adult = $bookingDetailArray['adult'];
    $child = $bookingDetailArray['child'];
    $pox = intval($adult) + intval($child);
    $guestArray = getGuestDetail($bid,'','',$bdid);
    $guestCount = count($guestArray);
    $differentCount = $pox - $guestCount;

    $returnData = $guestArray;
    $blankArray = array();

    for ($i=0; $i < $differentCount; $i++) { 
        $blankArray[] = [
            'bookId'=>$bid,
            'bookingdId'=>$bdid,
        ];
    }

    return array_merge($returnData,$blankArray);
}


function editExtendStayFun(){
    $bdid = $_POST['bdid'];

    return getBookingDetail($bdid);
}


function noShowFunByBid(){
    global $conDB;
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $guestEmailId = getGuestDetail($bid,'','', $bdid)[0]['email'];

    if($bdid == ''){
        foreach (getBookingDetail('', $bid) as $bdItem) {
            $bdid = $bdItem['id'];
            $bdid = $bdItem['id'];
            $roomNumber = $bdItem['room_number'];
            $checkIn = date('d M, Y', strtotime($bdItem['checkIn']));

            mysqli_query($conDB, "update bookingdetail set checkinstatus = '6' where id = '$bdid'");
            
            $alert = "Room $roomNumber is a no-show.";
            setActivityFeed('', 30, $bid, $bdid, '', '', '', '', $alert);
        }

        $msg = generateInvoice('noShow','',$bid);
        send_email($guestEmailId, '', '', '', $msg, "No-Show Status for Your Reservation on $checkIn");
    }else{

        $bookingDetailArray = getBookingDetail($bdid, $bid);
        $bdid = $bookingDetailArray['id'];
        $bdid = $bookingDetailArray['id'];
        $roomNumber = $bookingDetailArray['room_number'];
        $checkIn = date('d M, Y', strtotime($bookingDetailArray['checkIn']));
        mysqli_query($conDB, "update bookingdetail set checkinstatus = '6' where id = '$bdid'");
            
        $alert = "Room $roomNumber is a no-show.";
        setActivityFeed('', 30, $bid, $bdid, '', '', '', '', $alert);

        $msg = generateInvoice('noShow','',$bid);
        send_email($guestEmailId, '', '', '', $msg, "No-Show Status for Your Reservation on $checkIn");
    }

    $data = [
        'msg' => 'checked-In',
        'status' => 'success'
    ];

    return $data;
}


function loadUnsettledFolioReport(){
    $data = array();
    $bookingDataArray = getAllBooingData('','','','','','2');
    
    foreach($bookingDataArray as $item ){
        $bid = $item['id'];
        $reciptNo = $item['reciptNo'];
        $getBookingDetailById = getBookingDetailById($bid);
        $guestName = $getBookingDetailById['guestName'];
        $checkIn = date('d M, Y', strtotime($getBookingDetailById['checkIn']));
        $checkOut = (date('d M, Y', strtotime($getBookingDetailById['checkOut'])));
        $bookinId = threeNumberFormat($getBookingDetailById['reciptNo']);
        $folioVoucher = generateFolioVoucherName($guestName,$reciptNo);
        $folio = $item['openFolio'];
        $folioArray = getStysFolioList($folio)[0];
        $folioName = $folioArray['name'];
        $folioClr = $folioArray['clr'];
        $folioBg = $folioArray['bg'];

        $advance = [
            'folioVoucher'=>$folioVoucher,
            'guestName'=>$guestName,
            'checkIn'=>$checkIn,
            'checkOut'=>$checkOut,
            'reseNo'=>$bookinId,
            'folioName'=>$folioName,
            'folioClr'=>$folioClr,
            'folioBg'=>$folioBg,
        ];

        $data[] = array_merge($item, $advance);
    }

    return $data;
}


function loadLostAndFound(){
    return getLostAndFoundData();
}

function addLostAndFoundFormSubmit(){
    global $time;
    global $conDB;
    global $hotelId;

    $type = $_POST['type'];
    $activityDate = date('Y-m-d', strtotime($_POST['activityDate']));
    $itemName = $_POST['itemName'];
    $itemColor = $_POST['itemColor'];
    $itemLocation = $_POST['itemLocation'];
    $itemRoom = $_POST['itemRoom'];
    $itemValue = $_POST['itemValue'];
    $coName = $_POST['coName'];
    $coPhone = $_POST['coPhone'];
    $coAddress = $_POST['coAdress'];
    $status = (isset($_POST['status'])) ? $_POST['status'] : '';
    $statusBy = (isset($_POST['statusBy'])) ? $_POST['statusBy'] : '';
    $whoFound = (isset($_POST['whoFound'])) ? $_POST['whoFound'] : '';
    $statusDate = (isset($_POST['statusDate'])) ? date('Y-m-d', strtotime($_POST['statusDate'])) : '';

    $addBy = dataAddBy();

    $data = array();

    if(isset($_POST['id'])){

    }else{
        $sql = "insert into lost_found(hotelId,type,activityDate,item_name,item_color,lost_location,room,item_value,co_name,co_phone,co_address,add_by,add_on,status,status_by,status_date,who_found) values('$hotelId','$type','$activityDate','$itemName','$itemColor','$itemLocation','$itemRoom','$itemValue','$coName','$coPhone','$coAddress','$addBy','$time','$status','$statusBy','$statusDate','$whoFound')";
        $msg = "Save data";
    }


    if(mysqli_query($conDB, $sql)){
        $data = [
            'status'=>'success',
            'msg'=>$msg
        ];
    }else{
        $data = [
            'status'=>'error',
            'msg'=>'Something has gone wrong!'
        ];
    }


    return $data;
}


function loadTravelAgent(){
    return getTravelagent();
}

function addTravelAgentForm(){
    $data = array();


    return $data;
}


function addCompanyForm(){}


function loadCompanyDataBase(){
    return getOrganisationListData();
}


function addBlockRoom(){
    $rnum = $_POST['rnum'];

    $data = [
        'data'=>'',
        'room'=> getRoomNumber($rnum),
    ];

    return $data;
}

function addBlockRoomSubmit(){
    global $time;
    global $hotelId;
    global $conDB;
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $choseRoom = $_POST['choseRoom'];
    $reason = $_POST['reason'];
    $addBy = dataAddBy();
    $data = array();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $type = $_POST['type'];

        if($type == 'extend'){
            $sql = "update room_block set endDate='$end' where id = '$id'";
        }

    }else{
        $sql = "insert into room_block(hotelId,sartDate,endDate,roomNum,reason,addBy,addOn) values('$hotelId','$start','$end','$choseRoom','$reason','$addBy','$time')";
    };

    if(mysqli_query($conDB, $sql)){
        $alert = "Block $choseRoom room.";
        $lastId = mysqli_insert_id($conDB);
        setActivityFeed('',31,'','','','','','',$alert);
        mysqli_query($conDB, "update roomnumber set status = '4', constuctionStatus = '$lastId' where id = '$choseRoom'");
        $data = [
            'status'=>'success',
            'msg'=>'Successful room block'
        ];
    }

    return $data;

}








// Report Area 


function loadCackinReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $name = $_POST['name'];
    $data = array();
    
    foreach(getBookingData('','',$date,'','','','','','','','no','','','','','','',$name) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}

function loadCancelReservationReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getBookingData('','',$date,'','','','','','','','','','','','','','','','',5) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}

function loadNoShowReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getBookingData('','',$date,'','','','','','','','','','','','','','','','',6) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}

function loadCackOutListReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getBookingData('','',$date,'','','','','','','','','','','','','','','','',3) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}


function loadReservationReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getBookingData('','','','','','','','','',$date) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}

function loadVoidReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getBookingData('','',$date,'','','','','','','','','','','','','','','','',7) as $item){
        $bid = $item['bid'];       
        $data[] = $item;
    }

    return $data;
}

function loadGuestCeckinReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getGuestamenddetailData($date) as $item){  
        $bid = $item['bid'];
        $bdid = $item['bdid'];
        $advance = [
            'checkInTime'=> $item['checkInTime']
        ];
        $data[] = array_merge($advance, getBookingData($bid,'','',$bdid)[0]);
    }

    return $data;
}

function loadGuestCeckoutReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();
    
    foreach(getGuestamenddetailData('',$date) as $item){  
        $bid = $item['bid'];
        $bdid = $item['bdid'];
        $advance = [
            'checkInTime'=> $item['checkInTime']
        ];
        $data[] = array_merge($advance, getBookingData($bid,'','',$bdid)[0]);
    }

    return $data;
}

function loadInvoiceBreakdownReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();

    foreach(getBookingData('','',$date,'','','','','','','','no') as $item){
        $bid = $item['bid'];   
        $checkStatusArray = checkGuestCheckInStatus($item['checkinstatus'])[0];
        $bookingSourceArray = getBookingSource($item['bookingSource'])[0];
        $advance = [
            'statusName'=> $checkStatusArray['name'],
            'statusClr'=>  $checkStatusArray['color'],
            'statusBg'=>  $checkStatusArray['bg'],
            'sourceName'=>  $bookingSourceArray['name'],
        ];    
        $data[] = array_merge($item, $advance);
    }

    return $data;
}


function loadNightAuditReport(){
    $date = ($_POST['date'] == '')? date('Y-m-d') : date('Y-m-d', strtotime($_POST['date']));
    $data = array();

    foreach(getBookingData('','',$date,'','','','','','','','no') as $item){
        $bid = $item['bid'];   
        $checkStatusArray = checkGuestCheckInStatus($item['checkinstatus'])[0];
        $bookingSourceArray = getBookingSource($item['bookingSource'])[0];
        $advance = [
            'statusName'=> $checkStatusArray['name'],
            'statusClr'=>  $checkStatusArray['color'],
            'statusBg'=>  $checkStatusArray['bg'],
            'sourceName'=>  $bookingSourceArray['name'],
        ];    
        $data[] = array_merge($item, $advance);
    }

    return $data;
}

function loadRoomAvailabilityReport(){
    $startDate = ($_POST['startDate'] != '') ? date('Y-m-d', strtotime($_POST['startDate'])) : date('Y-m-d');
        $endDate = ($_POST['endDate'] != '') ? date('Y-m-d', strtotime($_POST['endDate'])) : date("d-m-Y", strtotime("$startDate +1 day"));
        $getRoomDataArry = getRoomData();
        // pr($getRoomDataArry);

        $roomName = array();
        $data = array();
        $cDate = array();
        $dataArry = array();

        $interval = round(abs(strtotime($endDate) - strtotime($startDate)) / 86400);

        for($i = 1; $i <= $interval; $i ++){
            $currentDate = date('Y-m-d', strtotime($startDate) + (86400 * $i));
            $cDate[] = $currentDate;
        }

        foreach($getRoomDataArry as $roomItem){
            $roomId = $roomItem['id'];
            $name = $roomItem['header'];
            $rid = $roomItem['id'];
            $roomName[] = $name;
            $perDayData = array();

            for($i = 1; $i <= $interval; $i ++){
                $currentDate = date('Y-m-d', strtotime($startDate) + (86400 * $i));
                $occupancy = count(getRoomNumberWithFilter($roomId,'reserved',$currentDate));   

                $perDayData[] = [
                    'date'=>$currentDate,                    
                    'occupancy'=>$occupancy,
                ];
            }

            $dataArry[] = [
                'rid'=>$rid,
                'roomName'=>$name,
                'perDayData'=>$perDayData,
                'total'=> count(getRoomNumberWithFilter($roomId))
            ];
            
        }

        $data = [
            'dateList'=>array_unique($cDate),
            'roomName'=>$roomName,
            'data'=>$dataArry,
        ];
        

        return $data;
}

function loadRoomStatusReport(){
    
}


function loadReportContainer(){
    $type = $_POST['type'];
    global $hotelId;
    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
    $date2 = ($_POST['date2'] == '') ? $date : $_POST['date2'];
    $data = array();
    $addDate = ($_POST['date2'] == '') ? '' : " to ".date('d-M-Y', strtotime($date2));
    $checkDate = date('d-M-Y', strtotime($date)).$addDate;

    $title = '';


    if($type == 'complimentary-room'){
        $month = date('m', strtotime($date)); 
        $year = date('Y', strtotime($date));
        $title = 'Complimentary Room';

        $start_date = new DateTime(date('Y-m-01', strtotime("$year-$month-01")));
        $end_date = new DateTime(date('Y-m-t', strtotime("$year-$month-01")));

        for ($cdate = $start_date; $cdate <= $end_date; $cdate->modify('+1 day')) {
            $currentDate = $cdate->format('Y-m-d');
            foreach(getAllBooingData('','','','','','','','',$currentDate,2) as $item){
                $bid = $item['bid'];
                $bdid = $item['bdid'];
                $bookingDetailArray = getBookingData($bid,'','',$bdid)[0];
                $guestName = $bookingDetailArray['guestName'];
                $reciptNo = $bookingDetailArray['reciptNo'];
                $advance = [
                    'folioNumber'=>generateFolioVoucherName($guestName,$reciptNo),
                ];
                $data[] = array_merge($advance, $bookingDetailArray);
            }
        }
    }

    if($type == 'daily-refund'){
        $month = date('m', strtotime($date)); 
        $year = date('Y', strtotime($date));
        $title = 'Daily Refund';

        $start_date = new DateTime(date('Y-m-d', strtotime("$date")));
        $end_date = new DateTime(date('Y-m-d', strtotime("$date2")));

        for ($cdate = $start_date; $cdate <= $end_date; $cdate->modify('+1 day')) {
            $currentDate = $cdate->format('Y-m-d');
            
            foreach(getGuestPaymentTimeline('','','','','','','','','','','','no','','','return',$currentDate) as $item){
              
                $bid = $item['bid'];
                $posId = $item['posId'];
                $bookingDetailArray = array();
                $referance = '';

                if($bid != 0){
                    $bookingDetailArray = getBookingData($bid)[0];
                    $guestName = $bookingDetailArray['guestName'];
                    $reciptNo = $bookingDetailArray['reciptNo'];
                    $room_number = $bookingDetailArray['room_number'];
                    $folioNo = generateFolioVoucherName($guestName,$reciptNo);
                    $referance = "Front Desk Folio - $folioNo , Room : $room_number";
                }

                $advance = [
                    'referance'=>$referance
                ];
                
                $data[] = array_merge($advance, $item);
            }
        }
    }

    if($type == 'daily-revenue'){
        $month = date('m', strtotime($date)); 
        $year = date('Y', strtotime($date));
        $title = 'Daily Revenue';

        $start_date = new DateTime(date('Y-m-d', strtotime("$date")));
        $end_date = new DateTime(date('Y-m-d', strtotime("$date2")));

        for ($cdate = $start_date; $cdate <= $end_date; $cdate->modify('+1 day')) {
            $currentDate = $cdate->format('Y-m-d');
            
            foreach(getBookingData('','','','','','','','','',$currentDate,'no','','','','','','') as $item){
              
                $bid = $item['bid'];
                $posId = $item['posId'];
                $bookingDetailArray = array();
                $referance = '';

                $advance = [
                    'referance'=>$referance
                ];
                
                $data[] = array_merge($advance, $item);
            }
        }
    }

    if($type == 'detail-revenue'){
        $month = date('m', strtotime($date)); 
        $year = date('Y', strtotime($date));
        $title = 'Detail Revenue';

        $start_date = new DateTime(date('Y-m-d', strtotime("$date")));
        $end_date = new DateTime(date('Y-m-d', strtotime("$date2")));

        for ($cdate = $start_date; $cdate <= $end_date; $cdate->modify('+1 day')) {
            $currentDate = $cdate->format('Y-m-d');
            
            foreach(getBookingData('','','','','','','','','',$currentDate,'no','','','','','','') as $item){
              
                $bid = $item['bid'];
                $posId = $item['posId'];
                $bookingDetailArray = array();
                $referance = '';

                $advance = [
                    'referance'=>$referance,
                    'source'=>$referance,
                    'folioId'=>$referance,
                ];
                
                $data[] = array_merge($advance, $item);
            }
        }
    }


    $returnData = [
        'property'=>hotelDetail('', '', '', '', $hotelId)['hotelName'],
        'title'=>$title,
        'checkDate'=>$checkDate,
        'data'=>$data
    ];


    return $returnData;
}


function loadAddLostAndFound(){
    $id = $_POST['id'];

    $data = [
        'roomNum'=>getRoomNumber(),
        'data'=>''
    ];

    return $data;

}


function activeProperty(){
    $hid = $_POST['hid'];
    $_SESSION['HOTEL_ID'] = $hid;
    return 1;
}


function pinChangeToFetch(){
    $pincode = $_POST['pinCode'];
    $result = file_get_contents('https://api.postalpincode.in/pincode/'.$pincode);
    $result = json_decode($result);
    $data = array();

    if(isset($result['0']->PostOffice['0'])){
        $arr_data['state'] = $result['0']->PostOffice['0']->State;
        $arr_data['district'] = $result['0']->PostOffice['0']->District;
        $arr_data['block'] = $result['0']->PostOffice['0']->Block;

        $data = $arr_data;
        
    }else{
        echo "No";
    }

    return $data;
}


function load_form_organisation(){

    $rateplanList =  getSysPropertyRatePlaneList();
    
    $data = [
        'ratePlan'=>$rateplanList,
        'data'=>''
    ];
    
    
    return $data;
}


?>
