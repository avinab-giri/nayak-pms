<?php
include('../constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

$type = '';

if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

if ($type == 'loadRoomView') {

    $si = 0;
    $pagination = '';
    $postSlug = $_POST['slug'];
    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
    $rid = ($_POST['slug'] == '') ? '' : getRoomType('', '', $postSlug)[0]['id'];
    $rtab = ($_POST['rTab'] == '') ? 'all' : $_POST['rTab'];
    $html = '';
    
    if (count(getRoomNumberWithFilter($rid, $rtab, $date)) != 0) {
        foreach (getRoomNumberWithFilter($rid, $rtab, $date) as $row) {
            // pr($row);
            $rnid = $row['id'];
            $rn = $row['roomNo'];
            $roomId = $row['roomId'];
            $assignContent = '';
            $roomDetailArray = (isset(getRoomList('', $roomId)[0])) ? getRoomList('', $roomId)[0] : [];
            foreach (getRoomList() as $item) {
                $rid = $item['id'];
                $srt = $item['shortCode'];
                $assignContent .= "<li><a class='assignValue' data-rid='$rid' data-rnum='$rn' href='javascript:void(0)'>$srt</a></li>";
            }
            
            $status = $row['status'];

            $constuctionStatus = $row['status'];
            
            $roomTypeSName = (isset($roomDetailArray['shortCode'])) ? $roomDetailArray['shortCode'] : '';
            $bid = '';
            $bookingdetailId = '';

            $passParameter = "";
            $countAdult = 0;
            $maxAdult = 0;

            $positionPer = 0;
            $bookingImgUrl = '';

            $bookPersion = '___';
            $persionCheckin = 'Vacant';

            $roomStatusArray = getRoomStatus($constuctionStatus)[0];
            $bgClr = $roomStatusArray['bg'];

            $topGroupIconHtml = '';
            $bottomActionSection = '';

            $cleanStatusArray = ($constuctionStatus == 3) ? getRoomStatus(1)[0] : getRoomStatus(3)[0];
            $cleanBtnBg =  $cleanStatusArray['bg'];
            $cleanBtnText =  $cleanStatusArray['name'];
            $cleanSvg = ($constuctionStatus == 3) ? '<svg><use xlink:href="#cleanSvgIcon"></use></svg>' : '<svg><use xlink:href="#dirtySvgIcon"></use></svg>';

            $blockStatusArray = ($constuctionStatus == 4) ? getRoomStatus(5)[0] : getRoomStatus(4)[0];
            $blockBtnBg =  $blockStatusArray['bg'];
            $blockBtnText =  $blockStatusArray['name'];
            $blockSvg = ($constuctionStatus == 4) ? '<svg><use xlink:href="#unblockSvgIcon"></use></svg>' : '<svg><use xlink:href="#constroctionSvgIcon"></use></svg>';

            
            
            

            $roomActionBtnHtml = '
                <li> <button style="border-color: '.$cleanBtnBg.'" class="cleanBtn iconBtn" data-rnum="' . $rn . '" data-tooltip-top="'.$cleanBtnText.'">
                    <div style="background:'.$cleanBtnBg.'" class="iconbg"></div>
                    '.$cleanSvg.'
                    </button>
                </li>
                <li> <button onclick="addBlockRoom('.$rn.')" style="border-color: '.$blockBtnBg.'" class="iconBtn" data-rnum="' . $rn . '" data-tooltip-top="'.$blockBtnText.'">
                    <div style="background:'.$blockBtnBg.'" class="iconbg"></div>
                    '.$blockSvg.'
                </li>
            ';

            if (isset(getBookingData('', $rn, $date,'','','','','','','','','','','','','','','','yes')[0]['bid'])) {

                $maxAdult = getRoomAdultCountById($roomId);
                $bookinDetailArry = getBookingData('', $rn)[0];
                $countAdult = $bookinDetailArry['adult'];
                $bid = $bookinDetailArry['bid'];
                $checkinstatus = $bookinDetailArry['checkinstatus'];
                $bSourceArray = getBookingSource($bookinDetailArry['bookingSource'])[0];
                $bookingdetailId = $bookinDetailArry['bookingdetailId'];
                $bookingImgUrl = FRONT_SITE_IMG . 'icon/source/' . $bSourceArray['img'];
                $bookingSourceName = $bSourceArray['name'];
                $bottomActionSection = "<strong class='zi5' data-tooltip-top='$bookingSourceName'><img style='width:20px' src='$bookingImgUrl'/></strong>";
                $passParameter = "$bid,$bookingdetailId";
                if($checkinstatus == 2){
                    if (isset(getGuestDetail($bid, 1)[0]['name'])) {
                        $bookPersion = ucfirst(getGuestDetail($bid, 1)[0]['name']);
                        $persionCheckin = 'Checked In';
    
                        $bookinDetailArray = getBookingDetailById($bid);
    
                        $rooms = $bookinDetailArry['rooms'];
                        $smoking = $bookinDetailArry['smoking'];
                        $roomPlanSrt = $bookinDetailArry['roomPlanSrt'];
    
                        $totalPrice = $bookinDetailArray['totalPrice'];
                        $userPay = $bookinDetailArray['userPay'];
    
                        $gropAdminBtn = ($rooms > 1) ? '<li> <button class="groupAdmin smallIconBtn" data-tooltip-top="Group Admin"><i class="fas fa-crown"></i></button></li>' : '';
                        $gropBookinBtn = ($rooms > 1) ? '<li> <button class="groupBooking smallIconBtn" data-tooltip-top="Group Booking"><i class="fas fa-user-friends"></i></button></li>' : '';
                        $mealPlanBtn = ($roomPlanSrt != '') ? '<li> <button class="mealPlan smallIconBtn" data-tooltip-top="CP"><i class="fas fa-utensils"></i></button></li>' : '';
                        $paymentDueBtn = ($totalPrice <= $userPay) ? '<li> <button class="paymentDue smallIconBtn" data-tooltip-top="Payment Pending"><i class="fas fa-rupee-sign"></i></button></li>' : '';
                        $noSmokingBtn = ($smoking == 'yes') ? '<li> <button class="smoking smallIconBtn" data-tooltip-top="Smoking"><i class="fas fa-smoking"></i></button></li>' : '<li> <button class="noSmoking smallIconBtn" data-tooltip-top="No Smoking"><i class="fas fa-smoking-ban"></i></button></li>';
    
    
                        $topGroupIconHtml = "
                            $paymentDueBtn
                            $gropAdminBtn
                            $mealPlanBtn
                            $gropBookinBtn
                            $noSmokingBtn
                        ";
                    }
                }                

            }



            $html .=
                '<div class="col-xl-3 col-md-4 col-sm-6 col-xs-12">
                    <div style="border-color:' . $bgClr . ' " class="content" data-roomnumber="' . $rn . '">
                        <div class="roomViewAction" onclick="reservationDetailPopUp('.$passParameter.')"></div>
                        <div class="iconCon"">
                            <h2 style="color:' . $bgClr . '">' . $rn . '</h2>
                            <h4>(' . $roomTypeSName . ')</h4>    
                        </div>
                        <div style="background: ' . $bgClr . '" class="bg" ></div>
                        <div class="caption">
                            <span>' . $bookPersion . '</span> <br/>
                            <small>' . $persionCheckin . '</small>
                        </div>
                        <div class="roomViewfoot dFlex jcsb aic">
                            <ul>
                                ' . $roomActionBtnHtml . '
                            </ul>
                            ' . $bottomActionSection . '
                        </div>

                        <ul class="topGroupIcon">
                            ' . $topGroupIconHtml . '
                        </ul>
                    </div>
                </div>';
        }
    } else {
        $html .=
            '<div>No Room</div>';
    }






    echo $html;
}

if ($type == 'load_add_guest') {
    $bookingSource = '';
    $reservationType = '';
    foreach (getReservationType() as $key => $reservationTypeList) {
        $select = '';
        if ($key == 0) {
            $select = 'selected';
        }
        $id = $reservationTypeList['id'];
        $name = ucfirst($reservationTypeList['name']);
        $reservationType .=   "<option value='$id' $select>$name</option>";
    }

    foreach (getBookingSource() as $key => $getBookingSourceList) {
        $select = '';
        if ($key == 0) {
            $select = 'selected';
        }
        $id = $getBookingSourceList['id'];
        $name = ucfirst($getBookingSourceList['name']);
        $bookingSource .=   "<option value='$id' $select>$name</option>";
    }

    $html = '
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

if ($type == 'checkRoomNumber') {
    $roomNum = safeData($_POST['roomNumber']);

    if (!isset($_POST['date'])) {
        $currentDate = date('Y-m-d');
    } else {
        $currentDate = safeData($_POST['date']);
    }

    $roomNumArry = getBookingData('', $roomNum, $currentDate);
    if (count($roomNumArry) > 0) {
        $bid = $roomNumArry[0]['bid'];
        $bdid = $roomNumArry[0]['bookingdetailId'];

        if (count($roomNumArry) > 0) {
            $data = [
                'type' => 'popUp',
                'roomNo' => $roomNum,
                'bid' => $bid,
                'bdid' => $bdid
            ];
        } else {
            $data = [
                'type' => 'false',
                'roomNo' => '',
                'bid' => '',
                'bdid' => ''
            ];
        }
    } else {
        $data = [
            'type' => 'false',
            'roomNo' => '',
            'bid' => '',
            'bdid' => ''
        ];
    }


    echo json_encode($data);
}

if ($type == 'showPopUpGuestDetail') {
    $rTab = ($_POST['rTab'] == '') ? '' : $_POST['rTab'];
    $bdid = ($_POST['bdid'] == '') ? '' : $_POST['bdid'];
    $page = ($_POST['page'] == '') ? '' : $_POST['page'];
    $bookingMainId = ($_POST['bId'] == '') ? getBookingDetailTableData($bdid)[0]['bid'] : $_POST['bId'];
    $data = bookingDetailPopUpContent($bookingMainId, $bdid, $rTab);
    echo $data;
}

if ($type == 'checkRoomCheckIn') {
    global $hotelId;
    $hotelName = hotelDetail()['hotelName'];
    $rBID = safeData($_POST['rBID']);
    $bdid = safeData($_POST['bdid']);
    $roomNumber = safeData($_POST['roomNumber']);

    $bookDetailArry = getBookingData('', '', '', $bdid)[0];
    $checkInStatus = $bookDetailArry['checkinstatus'];
    $guestId = $bookDetailArry['guestId'];

    if (isset($_POST['currentDate']) && $_POST['currentDate'] != '') {
        $currentDate = safeData($_POST['currentDate']);
    } else {
        $currentDate =  date('Y-m-d');
    };

    $checkIn = $bookDetailArry['checkIn'];
    $guestEmailId = getGuestDetail($rBID,'','', $bdid)[0]['email'];

    $currentTime = date('Y-m-d h:i:s', time());
    $addBy = dataAddBy();
    $data = array();
    if (strtotime($checkIn) >  strtotime($currentDate)) {
        $data = [
            'msg' => "Check-In date is $checkIn",
            'status' => '0'
        ];
    } else {
        if ($checkInStatus == 1) {
            if ($bdid == '') {
                foreach (getBookingDetail('', $rBID) as $bdItem) {
                    $bdid = $bdItem['id'];
                    checkInOutFun('checkin', $rBID, $bdid);
                    setBookingFolio('','',$rBID,$bdid);
                }
            } else {
                checkInOutFun('checkin', $rBID, $bdid);
                setBookingFolio('','',$rBID,$bdid);
            }

            mysqli_query($conDB, "insert into housekeeping(hotelId,roomNum,status) values('$hotelId', '$roomNumber', '3')");
            $lastHkId = mysqli_insert_id($conDB);
            mysqli_query($conDB, "update roomnumber set hkid='$lastHkId', status='3' where roomNo = '$roomNumber'");
            mysqli_query($conDB, "update bookingdetail set hkId='$lastHkId', openFolio = '2' where id = '$bdid'");
            mysqli_query($conDB, "update booking set openFolio = '2' where id = '$rBID'");
            $alert = "Room $roomNumber is check-in";
            setActivityFeed('', 2, $rBID, $bdid, '', '', '', '', $alert);

            $msg = generateInvoice('checkinGuest','',$rBID);
            send_email($guestEmailId, '', '', '', $msg, 'Thank you for check in.');
            $data = [
                'msg' => 'checked-in',
                'status' => '1'
            ];
        }

        if ($checkInStatus == 2) {
            $bookingDetailArray = getBookingDetailById($rBID);
            $totalPrice = $bookingDetailArray['totalPrice'];
            $userPay = $bookingDetailArray['userPay'];
            $checkOutdate = $bookingDetailArray['checkOut'];
            $guestPayable = $totalPrice - $userPay;
            $checkOutDateFormat = date('M d, Y', strtotime($checkOutdate));
            
            if($guestPayable > 0){
                $data = [
                    'msg' => 'Guests have to pay the full amount',
                    'status' => '0'
                ];
            }elseif(getNightCountByDay($checkOutdate,date('Y-m-d')) != 0){

                $data = [
                    'msg' => "Checked-out date is $checkOutDateFormat",
                    'status' => '0'
                ];

            }else{

                if ($bdid == '') {
                    foreach (getBookingDetail('', $rBID) as $bdItem) {
                        $bdid = $bdItem['id'];
                        checkInOutFun('checkout', $rBID, $bdid);
                    }
                } else {
                    checkInOutFun('checkout', $rBID, $bdid);
                }

                $alert = "Room $roomNumber is check-out";
                mysqli_query($conDB, "update bookingdetail set openFolio = '3' where id = '$bdid'");
                mysqli_query($conDB, "update booking set openFolio = '3' where id = '$rBID'");
                setActivityFeed('', 3, $rBID, $bdid, '', '', '', '', $alert);
                $msg = generateInvoice('checkoutGuest','',$rBID);
                send_email($guestEmailId, '', '', '', $msg, "Thank you for choosing $hotelName.");
                $data = [
                    'msg' => 'checked-out',
                    'status' => '1'
                ];
            }
        }

        if ($checkInStatus == 3) {
        }
    }

    echo json_encode($data);
}

if ($type == 'paymentBtnClick') {

    $rBID = safeData($_POST['rBID']);
    $rTab = safeData($_POST['rTab']);
    $bdid = safeData($_POST['bdid']);

    echo paymentBtnClickToHtml($rBID, $bdid, 'all');
}

if ($type == 'printBtnClick') {
    $bdid = safeData($_POST['bdid']);
    $rBID = safeData($_POST['rBID']);

    echo printBtnClickToHtml($rBID, $bdid);
}

if ($type == 'checkInOutBtnClick') {
    $rTab = safeData($_POST['rTab']);
    $rBID = safeData($_POST['rBID']);
    $bdid = safeData($_POST['bdid']);

    echo checkInOutBtnClickToHtml($rBID, $bdid, $rTab);
}

if ($type == 'roomMoveBtnClick') {

    $rDId = safeData($_POST['rDId']);
    $rTab = safeData($_POST['rTab']);
    $rBID = safeData($_POST['rBID']);

    echo roomMoveBtnClickToHtml($rBID, $rDId, $rTab);
}

if ($type == 'cancleReservationClick') {
    $roomNum = safeData($_POST['roomNumber']);
    $paymentMwthod = '';
    foreach (getPaymentTypeMethod() as $paymentList) {
        $data = $paymentList['name'];
        $dataId = $paymentList['id'];
        $paymentMwthod .= "<option value='$dataId'>$data</option>";
    }

    $html = '
            <div class="paymentBlock">
                <h4>Print Voucher </h4>
                <form>

                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="chooseVoucher">Choose</label>
                            <select id="chooseVoucher" class="form-control">
                                <option>Guest</option>
                                <option>Hotel</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-6"><span class="btn btn-outline-secondary removeRoomView">Cancel</span></div>
                    <div class="col-6 flexEnd"><button type="submit" class="btn bg-gradient-primary">Download</button></div>
                    </div>

                </form>
            </div>
    ';

    echo $html;
}

if ($type == 'getOptionByRoomId') {
    $roomId = safeData($_POST['roomId']);
    $opType = safeData($_POST['opType']);
    $bdid = safeData($_POST['bdid']);
    $data = '';

    echo roomMoveOptionByRoomId($roomId, $opType, $bdid);
}

if ($type == 'chooseRAtePlaneForMoveClick') {
    $roomId = safeData($_POST['roomId']);
    $data = '';
    foreach (getRateType($roomId, '', '1') as $ratePlaneList) {
        $rateName = $ratePlaneList['title'];
        $rateId = $ratePlaneList['id'];

        $data .= "<option value='$rateId'>$rateName</option>";
    }

    echo $data;
}

if ($type == 'paymentBtnClickFormSubmit') {
    global $hotelId;
    $amount = safeData($_POST['amount']);
    $amountPaid = $amount;
    $roomNum = safeData($_POST['roomNum']);
    $paymentMethod = safeData($_POST['paymentMethod']);
    $roomBID = safeData($_POST['roomBID']);
    $bdid = safeData($_POST['bdid']);
    $paymentRemark = safeData($_POST['paymentRemark']);
    $addBy = dataAddBy();
    $bookingDetailArray = getBookingDetailById($roomBID);
    $userPay = $bookingDetailArray['userPay'];
    $reciptNo = threeNumberFormat($bookingDetailArray['reciptNo']);

    $tatoalAmount = $bookingDetailArray['totalPrice'];
    $paidAmount = getBookingData($roomBID)[0]['userPay'];
    $paymethodId = getBookingData($roomBID)[0]['paymethodId'];
    $toBePaid = $tatoalAmount - $paidAmount;

    if ($toBePaid < 0) {
        $amount = "-$amount";
    }

    $totalPaid = $amount + $paidAmount;

    $bid = $roomBID;

    $sql = "update booking set userPay = '$totalPaid', paymethodId ='$paymentMethod' where id = '$bid'";

    if (mysqli_query($conDB, $sql)) {
        setPaymentTimeline($bid, '', $bid, $amount, $paymentMethod, $paymentRemark, $addBy);
        setBookingFolio('','',$bid,'','',$amount,'','','','Payment','',$paymentRemark);
        $folioLink = generateFolioLink($bid);
        $alert = '<strong>'.$amountPaid.'</strong> payment received from <a class="pClr" target="_blank" href="'.$folioLink.'">#'.$reciptNo.'</a>';        
        setActivityFeed($hotelId, '4', $bid, $bdid, 'Rs ' . $userPay, 'Rs ' . $amount, '', '', $alert, $addBy);
        $data = [
            'error' => 'no',
            'msg' => "Payment update."
        ];
    } else {
        $data = [
            'error' => 'yes',
            'msg' => "Something wrong!"
        ];
    }
    // } else {
    //     $data = [
    //         'error' => 'yes',
    //         'msg' => "Total payble amount $toBePaid"
    //     ];
    // }


    echo json_encode($data);
}

if ($type == 'checkInOutBtnClickFormSubmit') {

    $checkOut = safeData($_POST['checkOut']);
    $rbi = safeData($_POST['roomBID']);
    $bookingDetailArray = getBookingDetailById($rbi);
    $checkIn = $bookingDetailArray['checkIn'];

    $data = array();

    if(strtotime($checkIn) == strtotime($checkOut)){
        $data = [
            'status'=>'error',
            'msg'=>'Check-in and check-out dates provided are not the same.'
        ];
    }else{
        $sql = "update bookingdetail set checkOut ='$checkOut'";

        if (isset($_POST['checkIn'])) {
            $checkIn = safeData($_POST['checkIn']);
            $sql .= " ,checkIn = '$checkIn'";
        }
    
        $sql .= " where bid = '$rbi'";
    
        if (isset($_POST['roomNum'])) {
            $roomNum = safeData($_POST['roomNum']);
            $sql .= " and room_number = '$roomNum'";
        }
    
        if (mysqli_query($conDB, $sql)) {
            $data = [
                'status'=>'success',
                'msg'=>'Successfully updated.'
            ];
        } else {
            $data = [
                'status'=>'error',
                'msg'=>'Something went wrong!'
            ];
        }
    }

    echo json_encode($data);
}

if ($type == 'roomMoveBtnClickFormSubmit') {

    $oldRoomNum = safeData($_POST['oldRoomNum']);
    $roomType = safeData($_POST['roomType']);
    $roomNumber = safeData($_POST['roomNumber']);
    $roomBID = safeData($_POST['roomBID']);
    $ratePlane = safeData($_POST['ratePlane']);
    $bookingDId = safeData($_POST['bookingDId']);

    $bookDetailArry = getBookingData('', '', '', $bookingDId)[0];
    $roomId = $bookDetailArry['roomId'];
    $adult = $bookDetailArry['adult'];
    $child = $bookDetailArry['child'];
    $checkinstatus = $bookDetailArry['checkinstatus'];
    $roomDId = $bookDetailArry['roomDId'];
    $room_number = $bookDetailArry['room_number'];

    $bid = $bookDetailArry['bid'];
    $addBy = dataAddBy();;

    $sql = "update bookingdetail set roomId = '$roomType', roomDId='$ratePlane', room_number = '$roomNumber' where id = '$bookingDId'";
   
    $activeDataPuse = json_encode([['roomId' => $roomId], ['roomDId' => $roomDId], ['roomNum' => $room_number]]);
    $newActiveDataPuse = json_encode([['roomId' => $roomBID], ['roomDId' => $ratePlane], ['roomNum' => $roomNumber]]);
    
    if (mysqli_query($conDB, $sql)) {
        echo 1;
        setActivityFeed($hotelId, '13', $bid, $bookingDId, $activeDataPuse, $newActiveDataPuse);
    } else {
        echo 0;
    }
}

if ($type == 'addGuestResurvationForm') {
    $html = '
        
    ';
}

if ($type == 'excelImportSubmit') {
    $filter = $_POST['filter'];
    if (!empty($_FILES['csvFile']['name'])) {
        $csvFile = fopen($_FILES['csvFile']['tmp_name'], 'r');
        fgetcsv($csvFile);

        $rec = 0;
        while (($line = fgetcsv($csvFile)) !== FALSE) {

            $rec++;
            if ($filter == 'be') {
                $add_on   = $line[1];
                $bookingId   = $line[2];

                $guestName  = $line[3];
                $guestNumber  = $line[4];
                $guestEmail = $line[5];

                $checkIn = $line[6];
                $checkOut = $line[7];

                $ridName = $line[8];
                $rid = getRoomList('', '', $ridName)[0]['id'];
                $rdid = getRateType($rid)[0]['id'];

                $adult = $line[9];
                $child = $line[10];

                $coupon = $line[11];

                $total = $line[12];
                $pay = $line[13];
            }


            mysqli_query($conDB, "insert into booking(hotelId,bookinId,reciptNo,userPay,nroom,payment_status,bookingSource,addBy,add_on,reservationType,couponCode) values('c1f91','$bookingId','$rec','$pay','1','1','2','s_1','$add_on','1','$coupon')");
            $bookingId = mysqli_insert_id($conDB);
            mysqli_query($conDB, "insert into bookingdetail(bid,roomId,roomDId,checkIn,checkOut,adult,child) values('$bookingId','$rid','$rdid','$checkIn','$checkOut','$adult','$child')");
            $bookingDId = mysqli_insert_id($conDB);
            mysqli_query($conDB, "insert into guest(hotelId,bookId,bookingdId,name,email,phone) values('c1f91','$bookingId','$bookingDId','$guestName','$guestEmail','$guestNumber')");

            $fileArray[] = $line;
        }
    }
}


if ($type == 'loadRoomViewCountNavBar') {

    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
    if ($_POST['rTab'] == '') {
        $rTab = 'all';
    } else {
        $rTab = $_POST['rTab'];
    }

    $countArry = countRoomViewByDate('', $date);

    $reservationBtn = ['all', 'vacat', 'reserved', 'blocked'];

    $data = array();

    foreach ($reservationBtn as $rTabList) {
        $active = '';


        if ($rTabList == 'all') {
            $count = $countArry['book'] + $countArry['exist'];
        } elseif ($rTabList == 'vacat') {
            $count = $countArry['exist'];
        } elseif ($rTabList == 'reserved') {
            $count = $countArry['book'];
        } elseif($rTabList == 'blocked') {
            $count = $countArry['blockroom'];
        } else{
            $count = 0;
        }

        $data[] = [
            'menu' => $rTabList,
            'num' => $count
        ];
    }

    echo json_encode($data);
}

if ($type == 'loadRoomViewSideNav') {
    $postSlug = $_POST['postSlug'];
    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];

    $roomVacant = countRoomViewByDate('', $date)['exist'];
    $roomBook = countRoomViewByDate('', $date)['book'];
    if ($postSlug != '') {
        $roomTypeHtml = "<li class='' data-rslug=''><h6>All</h6> <div class='roomViewAlert'><span>$roomBook</span><span>$roomVacant</span></div></li>";
    } else {
        $roomTypeHtml = "<li class='active' data-rslug=''><h6>All</h6> <div class='roomViewAlert'><span>$roomBook</span><span>$roomVacant</span></div></li>";
    }

    $roomTypeHtml .= "<ul>";
    foreach (getRoomType('', 1) as $roomTypeList) {
        $id = $roomTypeList['id'];
        $header = $roomTypeList['header'];
        $slug = $roomTypeList['slug'];
        $roomVacant = countRoomViewByDate($slug, $date)['exist'];
        $roomBook = countRoomViewByDate($slug, $date)['book'];
        if ($postSlug == $slug) {
            $roomTypeHtml .= "<li class='active' data-rslug='$slug'><h6>$header</h6> <div class='roomViewAlert'><span>$roomBook</span><span>$roomVacant</span></div></li>";
        } else {
            $roomTypeHtml .= "<li data-rslug='$slug'><h6>$header</h6> <div class='roomViewAlert'><span>$roomBook</span><span>$roomVacant</span></div></li>";
        }
    }

    $roomTypeHtml .= "</ul>";

    echo $roomTypeHtml;
}
