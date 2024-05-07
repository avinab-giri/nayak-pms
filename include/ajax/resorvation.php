
<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('../constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

$type = '';
// pr($_POST);
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

if ($type == 'load_resorvation') {
    // pr($_POST);
    $hotelId = $_SESSION['HOTEL_ID'];
    $currentDate = date('y-m-d');
    $search = $_POST['search'];
    $rTabType = $_POST['rTab'];
    $reserveType = $_POST['reserveType'];
    $bookingType = $_POST['bookingType'];
    $currentDate = ($_POST['currentDate'] == '') ? date('Y-m-d') : $_POST['currentDate'];
    $paymentStatus = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';

    if ($bookingType == '') {
        $bookingType = 1;
    }

    if ($rTabType == 'reservation') {
        $rTabType = 'all';
    }

    $sql = reservationReturnQuery($rTabType, $currentDate, $search, $paymentStatus);


    // $si = 0;
    // $pagination = '';    
    // $limit_per_page = 9;

    // $page = '';
    // if(isset($_POST['page_no'])){
    //     $page = $_POST['page_no'];
    // }else{
    //     $page = 1;
    // }



    // $offset = ($page -1) * $limit_per_page;



    $clrPreviewHtml = clrPreviewHtml();
    $html = '<div class="row">';
   
    $query = mysqli_query($conDB, $sql);
    // $si = $si + ($limit_per_page *  $page) - $limit_per_page;

    if (mysqli_num_rows($query) > 0) {
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                // pr($row);
                $html .= '<div class="col-xl-3 col-md-4 col-sm-6 col-xs-12">';
                $bid = $row['bookingMainId'];
                $bookinId = $row['bookinId'];
                $reciptNo = $row['reciptNo'];
                $userPay = $row['userPay'];
                $checkIn = $row['checkIn'];
                $checkOut = $row['checkOut'];
                $nroom = $row['nroom'];
                $couponCode = $row['couponCode'];

                $pickUp = $row['pickUp'];
                $payment_status = $row['payment_status'];
                $payment_id = $row['payment_id'];
                $bookingSource = $row['bookingSource'];
                $add_on = $row['add_on'];
                $bookingDetailMainId = '';
                if (isset($row['bookingDetailMainId'])) {
                    $bookingDetailMainId = $row['bookingDetailMainId'];
                }
                $addBy = explode(',', $row['addBy']);
                $maxAddBy = count($addBy);
                $addByValue = $addBy[$maxAddBy - 1];
                $addByValueArr = explode('_', $addByValue);

                $bookingDetailArray = getBookingDetailById($bid);

                $grossCharge = $bookingDetailArray['totalPrice'];
                $gname = $bookingDetailArray['name'];
                $nAdult = $bookingDetailArray['totalAdult'];
                $nChild = $bookingDetailArray['totalChild'];
                $checkinStatusArray = $bookingDetailArray['checkinStatusArray'][0];

                $statusArray = [
                    'name' => $checkinStatusArray['name'],
                    'bg' => $checkinStatusArray['bg'],
                    'clr' => $checkinStatusArray['color'],
                ];


                $html .= reservationContentView($bid, $reciptNo, $gname, $checkIn, $checkOut, $add_on, $nAdult, $nChild, $grossCharge, $userPay, 'yes', $rTabType, $bookingDetailMainId, '', $bookingSource, '', $bookinId, $statusArray);

                $html .= '</div>';
            }
        } else {
            $html .= '
        
                <div class="noDataContent">
                    <div class="content">
                        <h4>No Data</h4>
                    </div>
                </div>
            
            ';
        }
    } else {
        if ($rTabType == 'all') {
            $html .= '
                <div class="noDataContent">
                    <div class="content">
                        <h4>No Data</h4>
                        <button id="noDataClickToReservation" class="btn bg-gradient-info">Add Reservation</button>
                    </div>
                </div>
            ';
        } else {
            $html .= '
            <div class="noDataContent">
                <div class="content">
                    <h4>No Data</h4>                      
                </div>
            </div>
        ';
        }
    }

    $html .= '</div>';

    echo $html;
}

if ($type == 'bookingreport') {
    // pr($_POST);
    $hotelId = $_SESSION['HOTEL_ID'];
    // $sql = "select booking.*,bookingdetail.checkinstatus,bookingdetail.checkIn,bookingdetail.checkOut from booking,bookingdetail where booking.id != ''";
    $currentDate = date('y-m-d');
    $search = $_POST['search'];
    $rTabType = $_POST['rTab'];
    $reserveType = $_POST['reserveType'];
    $bookingType = $_POST['bookingType'];
    $currentDate = ($_POST['currentDate'] == '') ? date('Y-m-d') : $_POST['currentDate'];
    $paymentStatus = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';

    if ($bookingType == '') {
        $bookingType = 1;
    }

    $sql = reservationReturnQuery($rTabType, $currentDate, $search, $paymentStatus);
    $query = mysqli_query($conDB, $sql);


    // $si = 0;
    // $pagination = '';    
    // $limit_per_page = 9;

    // $page = '';
    // if(isset($_POST['page_no'])){
    //     $page = $_POST['page_no'];
    // }else{
    //     $page = 1;
    // }



    // $offset = ($page -1) * $limit_per_page;




    $html = '<div class="row"><table class="reservation-table">';

    // Add table header
    $html .= '<thead><tr>';
    $html .= '<th>Reservation ID</th>';
    $html .= '<th>Receipt No</th>';
    $html .= '<th>Guest Name</th>';
    $html .= '<th>Check-In</th>';
    $html .= '<th>Check-Out</th>';
    $html .= '<th>Add-On</th>';
    $html .= '<th>Adults</th>';
    $html .= '<th>Children</th>';
    $html .= '<th>Gross Charge</th>';
    $html .= '<th>User Pay</th>';
    $html .= '<th>Booking Source</th>';
    $html .= '<th>View Details</th>';
    $html .= '</tr></thead><tbody>';

    // Fetch and display reservation data in table rows
    if (checkBEStatus($_SESSION['HOTEL_ID']) == 'Improper') {
        // Display setup link if setup is not proper
        // ... (existing code)
    } else {
        if (count(getBookingData()) > 0) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $html .= '<tr>';
                    $html .= '<td>' . $row['bid'] . '</td>';
                    $html .= '<td>' . $row['reciptNo'] . '</td>';
                    $html .= '<td>' . getBookingDetailById($row['bid'])['name'] . '</td>';
                    $html .= '<td>' . $row['checkIn'] . '</td>';
                    $html .= '<td>' . $row['checkOut'] . '</td>';
                    $html .= '<td>' . $row['add_on'] . '</td>';
                    $html .= '<td>' . getBookingDetailById($row['bid'])['totalAdult'] . '</td>';
                    $html .= '<td>' . getBookingDetailById($row['bid'])['totalChild'] . '</td>';
                    $html .= '<td>' . getBookingDetailById($row['bid'])['totalPrice'] . '</td>';
                    $html .= '<td>' . $row['userPay'] . '</td>';
                    //    $html .= '<td>' . reservationContentView($row['bid'], $row['reciptNo'], getBookingDetailById($row['bid'])['name'], $row['checkIn'], $row['checkOut'], $row['add_on'], getBookingDetailById($row['bid'])['totalAdult'], getBookingDetailById($row['bid'])['totalChild'], getBookingDetailById($row['bid'])['totalPrice'], $row['userPay'], 'yes', $rTabType, $row['bookingDetailMainId'], '', $row['bookingSource']) . '</td>';
                    $bSourceHtml = '';
                    if ($row['bookingSource'] == 1) {
                        $bSourceHtml = 'PMS';
                    } else if ($row['bookingSource'] == 2) {
                        $bSourceHtml = 'BE';
                    }
                    $html .= '<td>' . $bSourceHtml . '</td>';
                    $html .= '<td>' . reservationContentView($row['bid'], $row['reciptNo'], getBookingDetailById($row['bid'])['name'], $row['checkIn'], $row['checkOut'], $row['add_on'], getBookingDetailById($row['bid'])['totalAdult'], getBookingDetailById($row['bid'])['totalChild'], getBookingDetailById($row['bid'])['totalPrice'], $row['userPay'], 'yes', $rTabType, $row['bookingDetailMainId'], '', $row['bookingSource'], 'yes') . '</td>';

                    $html .= '</tr>';
                }
            } else {
                // Display message if there is no data
                $html .= '<tr><td colspan="12">No Data</td></tr>';
            }
        } else {
            // Display message to add reservation
            $html .= '<tr><td colspan="12">';
            $html .= '<h4>No Data</h4>';
            $html .= '</td></tr>';
        }
    }

    $html .= '</tbody></table></div>';
    echo $html;
}

if ($type == 'dayReport') {

    $hotelId = $_SESSION['HOTEL_ID'];
    $currentDate = date('y-m-d');
    $search = $_POST['search'];
    $rTabType = $_POST['rTab'];
    $reserveType = $_POST['reserveType'];
    $bookingType = $_POST['bookingType'];
    $currentDate = ($_POST['currentDate'] == '') ? date('Y-m-d') : $_POST['currentDate'];
    $paymentStatus = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';
    if ($bookingType == '') {
        $bookingType = 1;
    }

    $sql = reservationReturnQuery($rTabType, $currentDate, $search, $paymentStatus);

    $query = mysqli_query($conDB, $sql);
    $html = '<div class="row"><table class="reservation-table">';

    // Add table header
    $html .= '<thead><tr>';
    $html .= '<th>Room No</th>';
    $html .= '<th>Room Type</th>';
    $html .= '<th>Guest Name</th>';
    $html .= '<th>Booking Id</th>';
    $html .= '<th>Check-In</th>';
    $html .= '<th>Check-Out</th>';
    $html .= '<th>Adults</th>';
    $html .= '<th>Children</th>';
    $html .= '<th>Room Price</th>';
    $html .= '<th>Gst</th>';
    $html .= '<th>Total Price</th>';
    $html .= '<th>User Pay</th>';
    $html .= '<th>Booking Source</th>';
    $html .= '<th>Room Plan</th>';
    $html .= '</tr></thead><tbody>';
    if (count(getBookingData()) > 0) {
        if (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_assoc($query)) {

                $details = getBookingDetailById($row['bid']);

                $roomPrice = $details['subTotalPrice'];
                $gstPrice = $details['gstPrice'];


                $roomNumber =  $details['roomNum'];
                $roomType =  $details['roomType'];
                $guestName = $details['name'];
                $recpNo = $detais['reciptNo'];
                $checkIn = $details['checkIn'];
                $checkOut = $details['checkOut'];
                $adult = $details['adult'];
                $child = $details['child'];
                $totalprice = $details['totalPrice'];
                $paidAmmount = $details['userPay'];
                $bookingSource = $details['bookingSource'];
                $roomPlan = $details['roomPlanSrt'];

                if ($bookingSource == 1) {
                    $bookingSource = 'PMS';
                } else if ($bookingSource == 2) {
                    $bookingSource == 'BE';
                }

                $html .= '<tr>';
                $html .= '<td>' . $roomNumber . '</td>';
                $html .= '<td>' . $roomType . '</td>';
                $html .= '<td>' . $guestName . '</td>';
                $html .= '<td>' . $details['reciptNo'] . '</td>';
                $html .= '<td>' . $checkIn . '</td>';
                $html .= '<td>' . $checkOut . '</td>';
                $html .= '<td>' . $adult . '</td>';
                $html .= '<td>' . $child . '</td>';
                $html .= '<td>' . $roomPrice . '</td>';
                $html .= '<td>' . $gstPrice . '</td>';
                $html .= '<td>' . $totalprice . '</td>';
                $html .= '<td>' . $paidAmmount . '</td>';
                $html .= '<td>' . $bookingSource . '</td>';
                $html .= '<td>' . $roomPlan . '</td>';
                $html .= '</tr>';
            }
        } else {
            // Display message if there is no data
            $html .= '<tr><td colspan="12">No Data</td></tr>';
        }
    } else {
        // Display message to add reservation
        $html .= '<tr><td colspan="12">';
        $html .= '<h4>No Data</h4>';
        $html .= '</td></tr>';
    }
    echo $html;
}
if ($type == 'ratePlan') {
    $rTabType = $_POST['rTab'];
    $sql = reservationReturnQuery($rTabType);
    $query = mysqli_query($conDB, $sql);
    $html = '<div class="row"><table class="reservation-table">';

    // Add table header
    $html .= '<thead><tr>';
    $html .= '<th>Room No</th>';
    $html .= '<th>Room Type</th>';
    $html .= '<th>Guest Name</th>';
    $html .= '<th>Room Plan</th>';
    $html .= '<th>Check-In</th>';
    $html .= '<th>Check-Out</th>';
    $html .= '<th>Adults/Children</th>';




    $html .= '</tr></thead><tbody>';

    if (count(getBookingData()) > 0) {
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $details = getBookingDetailById($row['bid']);
                // pr($details);

                $roomNumber =  $details['roomNum'];
                $roomType =  $details['roomType'];
                $guestName = $details['name'];
                $checkIn = $details['checkIn'];
                $checkOut = $details['checkOut'];
                $adult = $details['adult'];
                $child = $details['child'];
                $roomPlan = $details['roomPlanSrt'];

                $html .= '<tr>';
                $html .= '<td>' . $roomNumber . '</td>';
                $html .= '<td>' . $roomType . '</td>';
                $html .= '<td>' . $guestName . '</td>';
                $html .= '<td>' . $roomPlan . '</td>';
                $html .= '<td>' . $checkIn . '</td>';
                $html .= '<td>' . $checkOut . '</td>';
                $html .= '<td>' . $adult . '/' . $child . '</td>';


                $html .= '</tr>';
            }
        } else {
            // Display message if there is no data
            $html .= '<tr><td colspan="12">No Data</td></tr>';
        }
    } else {
        // Display message to add reservation
        $html .= '<tr><td colspan="12">';
        $html .= '<h4>No Data</h4>';
        $html .= '</td></tr>';
    }
    echo $html;
}
if ($type == 'getBusinessSource') {
    $bid = safeData($_POST['id']);
    $bs = getCashiering('', $bid);
    $html = '';
    if (count($bs) != 0) {
        foreach ($bs as $key => $bsList) {
            $select = '';
            if ($key == 0) {
                $select = 'selected';
            }
            $id = $bsList['id'];
            $name = ucfirst($bsList['name']);
            $html .= "<option value='$id' $select>$name</option>";
        }
    } else {
        $html .= "<option value='0' selected>No Data</option>";
    }
    echo $html;
}

if ($type == 'getRateTypeByRID') {
    $rid = safeData($_POST['id']);
    $rt = getRateType($rid);
    $html = '';
    if (count($rt) != 0) {
        foreach ($rt as $key => $rtList) {
            $select = '';
            if ($key == 0) {
                $select = 'selected';
            }
            $id = $rtList['id'];
            $name = ucfirst(getSysPropertyRatePlaneList($rtList['title'])[0]['srtcode']);
            $html .= "<option value='$id' $select>$name</option>";
        }
    } else {
        $html .= "<option value='0' selected>No Data</option>";
    }
    echo $html;
}

if ($type == 'getAdultCountByRId') {
    global $conDB;
    $rid = safeData($_POST['id']);
    $rt = getMaxAdultCountByRId($rid);
    $nAdult = getNoAdultCountByRId($rid);
    $html = '';

    if ($rt != 0) {
        for ($i = 1; $i <= $rt; $i++) {
            $select = '';
            if ($i == $nAdult) {
                $select = 'selected';
            }
            $html .= "<option value='$i' $select>$i</option>";
        }
    } else {
        $html .= "<option value='0' >0</option>";
    }


    echo $html;
}

if ($type == 'getChildCountByRIdAndAdult') {
    $rid = safeData($_POST['id']);
    $adult = safeData($_POST['adult']);
    $rt = getCountChildData($rid, $adult);


    $html = "<option value='0' >0</option>";

    if ($rt != 0) {
        for ($i = 1; $i <= $rt; $i++) {
            $html .= "<option value='$i' >$i</option>";
        }
    }



    echo $html;
}

if ($type == 'getTotalSingleRoomPrice') {
    $rid = safeData($_POST['rid']);
    $rdid = safeData($_POST['rdid']);
    $adult = safeData($_POST['adult']);
    $child = safeData($_POST['child']);
    $date = safeData($_POST['checkIn']);
    $date2 = safeData($_POST['checkOut']);
    $couponCode = safeData($_POST['couponCode']);


    $data = getQuickBookingPrice($rid, $rdid, $adult, $child, $date, $date2, $couponCode);


    echo json_encode($data);
}

if ($type == 'getRoomDetailByRoomNo') {
    $removeBtn = '';
    if (isset($_POST['action']) && $_POST['action'] != '') {
        $removeBtn = '<a href="javascript:void(0)" class="form-group reservationRemoveRateArea">X</a>';
    }
    $nRoom = 1;
    $roomNum = $_POST['roomNum'];
    $roomId = 0;
    $roomDId = 0;

    $roomNumHtml = '';
    $ratePlanHtml = '';
    $adultHtml = '';
    $childHtml = '';
    $disabled = '';
    

    if ($roomNum != '') {
        $roomNumArry = getRoomNumber($roomNum)[0];
        $roomId = $roomNumArry['roomId'];
        $roomArry = getRoomData($roomId)[0];
        $totalCapacity = $roomArry['roomcapacity'];
        $noAdult = $roomArry['noAdult'];

        $disabled = '';
        foreach (getRoomNumber('', '', $roomId) as $key => $item) {
            $id = $item['id'];
            $roomNo = $item['roomNo'];
            $select = ($roomNo == $roomNum) ? 'selected' : '';
            $roomNumHtml .=  "<option $select value='$roomNum'>$roomNo</option>";
        }

              
    }

    foreach (fetchData('sys_rate_plan') as $item) {
        $rpId = $item['id'];
        $srtcode = $item['srtcode'];
        $ratePlanHtml .= '<option value="' . $rpId . '">' . $srtcode . '</option>';
    }  

    $html = '';

    for ($i = 0; $i < $nRoom; $i++) {
        $room = '';
        
        foreach (fetchData('room', ['hotelId' => $_SESSION['HOTEL_ID']]) as $item) {
            $roomId = $item['id'];
            $roomName = $item['header'];
            $room .= '<option value="' . $roomId . '">' . $roomName . '</option>';
        }

        $html .= '
            <tr>
                <td class="pr10">
                    <div class="form-group">
                        <select class="customSelect" name="selectRoom[]" data-rno="' . $i . '">
                            <option value="0" selected>-Select Room</option>
                            ' . $room . '
                        </select>
                    </div>
                </td>
                <td class="pr10">
                    <div class="form-group">
                        <select class="customSelect" name="selectRateType[]" ' . $disabled . ' data-rno="' . $i . '">
                            <option value="" selected>-Select</option>
                            ' . $ratePlanHtml . '
                        </select>
                    </div>
                </td>
                <td class="pr10">
                    <div class="form-group">
                        <input class="form-control" type="number" value="0" placeholder="" name="selectAdult[]">
                    </div>
                </td>
                <td class="pr10">
                    <div class="form-group">
                        <input class="form-control" type="number" value="0" name="selectChild[]">
                    </div>
                </td>

                <td class="pr10">
                    <div class="form-group">
                        <select class="customSelect roomGst" name="roomGst[]" id="">
                            <option value="0">0</option>
                            <option selected value="12">12%</option>
                            <option value="18">18%</option>
                        </select>
                    </div>
                </td>

                <td>
                    <div class="form-group reservationRateArea">
                        <input onchange="calculateTotal()" value="0" type="number" class="form-control totalPriceSection" name="totalPrice[]">
                    </div>
                </td>

                <td>
                    <div class="form-group reservationRateArea">
                        <input type="number" readonly  value="0" class="form-control totalPriceWithGst disabled" name="totalPriceWithGst[]">
                    </div>
                </td>
            </tr>
        ';
    }

    echo $html;
}

if ($type == 'load_add_resorvation') {
    $bid = $_POST['bid'];
    $roomDetailListHtml = '';
    $addRoomBtn = '';
    $guestInfoHtml = '';
    $formId = 'addReservationForm';
    $formSubmitBtn = 'Save';
    $formSubmitBtnId = 'addReservationSubmitBtn';
    $_SESSION['SelectedRoomNumber'] = [];

    if ($bid != '') {
        $formSubmitBtn = 'Update';
        $formSubmitBtnId = 'updateReservationSubmitBtn';
        $bookingDetailArray = getBookingDetailById($bid);
        $reciptNo = $bookingDetailArray['reciptNo'];
        $gname = $bookingDetailArray['name'];
        $checkIn = $bookingDetailArray['checkIn'];
        $checkOut = $bookingDetailArray['checkOut'];
        $bDate = $bookingDetailArray['addOn'];
        $nAdult = $bookingDetailArray['totalAdult'];
        $nChild = $bookingDetailArray['totalChild'];
        $total = $bookingDetailArray['totalPrice'];
        $paid = $bookingDetailArray['userPay'];
        $couponCode = $bookingDetailArray['couponCode'];
        $reservationContentHtml = reservationContent($bid, $reciptNo, $gname, $checkIn, $checkOut, $bDate, $nAdult, $nChild, $total, $paid, '', '', '', 'no');
        $pageHtml = '';
        $couponCodeHtml = '';
        $reservationType = '';
        $bookingSource = '';
        $paymentMethodHtml = '';


        $topBookingDetailHtml = '        
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Checkin</label>
                        <div class="dFlex jcsb aic">
                            <div class="form-group w100 mb0">
                                <input type="text" disabled class="form-control" name="checkIn" value="' . $checkIn . '" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Checkout</label>
                        <div class="dFlex jcsb aic">
                            <div class="form-group w100 mb0">
                                <input type="text" disabled class="form-control" name="checkOut" value="' . $checkOut . '" />
                            </div>
                        </div>
                    </div>
                </div>                            

                <div class="col-md-2">
                    <div class="form-group mb0">
                        <label for="couponCode">Coupon Code</label>                                    
                        <div class="couponContent">
                            <input type="text" disabled class="form-control" name="checkOut" value="' . $couponCode . '" />
                        </div>
                    </div>
                </div>  

           
                
                

            </div>
        
        ';

        $reservationContentPreviewHtml = '<div class="row insertContrnt">' . $reservationContentHtml . '</div>';

        foreach ($bookingDetailArray['roomDetailArry'] as $key => $val) {

            $roomDetailListHtml .= '
                <tr>
                    <td >
                        <div class="form-group">
                            ' . $val['roomName'] . '
                        </div>
                    </td>
                    <td >
                        <div class="form-group">
                            ' . $val['rateplan'] . '
                        </div>
                    </td>
                    <td >
                        <div class="form-group">
                            ' . $val['adult'] . '
                        </div>
                    </td>
                    <td >
                        <div class="form-group">
                            ' . $val['child'] . '
                        </div>
                    </td>

                    <td >
                        <div class="form-group">
                            ' . $val['room_number'] . '
                        </div>
                    </td>

                    <td class="dFlex aic jcsb">
                        <div class="form-group reservationRateArea w85p">
                            <input type="text" value="' . $val['total'] . '" class="form-control totalPriceSection" disabled>
                            <div class="content">
                                <div class="overflowContent">
                                    <ul>
                                        <li><span>Room Price :</span> <span>Rs <strong class="roomPricesSec">' . $val['room'] . '</strong></span></li>
                                        <li><span>Adult Price :</span> <span>Rs <strong class="adultPricesSec">' . $val['adultPrice'] . '</strong></span></li>
                                        <li><span>Child Price :</span> <span>Rs <strong class="childPricesSec">' . $val['childPrice'] . '</strong></span></li>
                                        <li><span>Gst :</span> <span>Rs <strong class="gstPricesSec">' . $val['gstPrice'] . '</strong></span></li>
                                    </ul>
                                </div>
                                <span class="icon reservationRateAreaIcon"><i class="bi bi-info-lg"></i></span>
                            </div>
                        </div>
                    </td>
                </tr>
            ';
        }

        $addRoomBtn = '
            <div class="row">
                <div class="col-12">
                    <a href="" class="btn btn-outline-primary" id="roomDetailIncBtnId">Add Room</a>
                </div>
            </div>
        ';
    } else {

        $checkInDate = ($_POST['checkIn'] == '') ? date('M d, Y') : date('M d, Y', strtotime($_POST['checkIn']));

        $checkOutDate = date('M d, Y', strtotime("1 day", strtotime(date('Y-m-d'))));

        if ($_POST['checkOut'] != '') {
            $checkOutDate =  date('M d, Y', strtotime("1 day", strtotime($_POST['checkOut'])));
        }



        $pageHtml = '';
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
            $pageHtml = "<input type='hidden' value='$page' name='page'>";
        }
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

        $paymentMethodHtml = '';

        foreach (getPaymentTypeMethod('', 1) as $paymentMethodList) {
            $paymentName = $paymentMethodList['name'];
            $paymentId = $paymentMethodList['id'];
            $paymentMethodHtml .= "<option value='$paymentId'>$paymentName</option>";
        }

        $couponCodeHtml = "<option value='0'>No Coupon</option>";

        foreach (getCouponList(1, 1) as $couponList) {
            $code = $couponList['coupon_code'];
            $value = $couponList['coupon_value'];
            $couponCodeHtml .= "<option value='$code'>$code</option>";
        }

        $bookingSorcelist = getBookingSourceList();
        $organisationlist = getOrganisationList();
        $companyList = ' <option value=0>Select</option>';
        foreach (getCashiering() as $val) {
            $companyList .= '
            <option value=' . $val['id'] . '>' . $val['name'] . '</option>
        ';
        }
        $travelagentList = '<option value="0">Select</option>';
        foreach (getTravelagent() as $val) {
            $travelagentList .= ' <option value=' . $val['id'] . '>' . $val['travelagentname'] . '</option>';
        }

        $topBookingDetailHtml = '
                <div class="row">

                    <div class="col-md-6">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="start" />
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" name="end" />
                        </div>
                    </div>

                    <div class="col-md-2">

                        <div class="form-group">
                            <label for="">
                                Checkin
                            </label>

                            <div class="dFlex jcsb aic">
                                <div class="form-group w100 mb0">
                                    <input type="text" id="checkInReservation" class="form-control" name="checkIn" value="' . $checkInDate . '" autocomplete="off"/>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="">Checkout</label>

                            <div class="dFlex jcsb aic">
                                <div class="form-group w100 mb0">
                                    <input type="text" id="checkOutReservation" class="form-control" name="checkOut" value="' . $checkOutDate . '" />
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb0">
                            <label for="">
                                Reservation type

                            </label>
                            <select class="form-control" name="reservationType" id="reservationType">
                                
                                ' .  $reservationType . '

                            </select>


                        </div>
                    </div>

                </div>
                <input type="hidden" name="bookinSource" value="1" />
        ';


        //     <div class="row">

        //     <div class="col-md-3">

        //         <div class="form-group">
        //             <label for="">
        //                 Booking Source

        //             </label>


        //             <select class="form-control" name="bookinSource" id="bookngSourceId">
        //                 '. $bookingSource .'

        //             </select>

        //         </div>

        //     </div>

        //     <div class="col-md-3">

        //         <div class="form-group">
        //             <label for="">Business Source</label>

        //             <select class="form-control" name="businessSource" id="businessSourceId" disabled>
        //                 <option value="0" selected>-Select-</option>
        //             </select>

        //         </div>

        //     </div>

        // </div>

        $reservationContentPreviewHtml = '
            <div class="row insertContrnt">
                <div class="reservationContentPreview" >
                                        
                    <div class="head">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <div class="userName">
                            <h4>_ _ _</h4>
                            <p> _ _ / _ _ _ _ _ </p>
                        </div>
                    </div>

                    <div class="body">
                        <div class="checkInDetail">
                            <div class="left">
                                <strong>_ _ _ - _ _</strong>
                            </div>
                            <div class="right">
                                <span>Night </span>
                                <strong>_ _</strong>
                            </div>
                        </div>
                        <div class="bookingDate">
                            <div class="left">
                                <strong>Booking Date:- </strong>
                                <span> _ _ _</span>
                            </div>
                            <div class="right">
                                <ul>
                                    <li>
                                        <i class="fas fa-male"></i>
                                        <strong>0</strong>
                                    </li>
                                    <li>
                                        <i class="fas fa-child"></i>
                                        <strong>0</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="bookingDetail">
                            <ul>
                                <li>
                                    <small>Total</small>
                                    <strong>Rs 0.00</strong>
                                </li>
                                <li>
                                    <small>Paid</small>
                                    <strong>Rs 0.00</strong>
                                </li>
                                <li>
                                    <small>Paid To Hotel</small>
                                    <strong>Rs 0.00</strong>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

           
        ';

        $addRoomBtn = '
            <div class="row">
                <div class="col-12">
                    <a href="" class="btn btn-outline-primary" id="roomDetailIncBtnId">Add Room</a>
                </div>
            </div>
        ';

        $guestInfoHtml = '
            <hr/>
            <div class="s15"></div>
            <div class="row">
                <div class="form-group3">
                    <div class="col-md-12">
                        <h4> Guest Imformation :</h4>
                    </div>
                </div>
            </div>
            <div class="s15"></div>

            <div id="guestContent">
                <div id="guestGroup">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Guest Name</label>
                                <div class="form-group">
                                        <input type="text" placeholder="Name" class="form-control" name="guestName" id="guestName">
                                        <div class="iconBox">
                                            <a onclick="searchGuestView()" href="javascript:void(0)" class="iconCon" data-tooltip-top="Search guest">
                                                <svg class="w20 h20"><use xlink:href="#guestSearchIcon"></use></svg>
                                            </a>
                                        </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="guestMobile">Mobile</label>
                                <input type="number" placeholder="Mobile No" class="form-control" name="guestMobile" id="guestMobile">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" placeholder="Email Id" class="form-control" name="guestEmail">

                            </div>
                        </div>

                    </div>

                    <div class="row align-items-end">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Pin Code</label>
                                <input onchange="pinChangeToFetch" type="text" placeholder="Pin code" class="form-control" name="pinCode">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">State</label>
                                <input readonly disable type="text" placeholder="Address" class="form-control" name="state" id="state">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">District</label>
                                <input readonly disable type="text" placeholder="District" class="form-control" name="district" id="district">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">City</label>
                                <input readonly disable type="text" placeholder="City" class="form-control" name="city" id="city">
                            </div>
                        </div>


                    </div> 
                </div>
                <div class="row ">
                    <h4>Billing Information:</h4>
                    
                </div>

                          <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        
                                            <label class="control-label">Billing Mode</label>
                                           
                                            <select class="form-control" name="billingmode" id="billingmode">
                                                    <option value=1>Guest</option>
                                                    <option value=2>Complementary</option>
                                                    <option value=3>Company</option>
                                            </select>
                                      
                                       
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                  <div class="form-group">
                                     
                                          <label class="control-label">Organisation</label>
                                         
                                         <input list="inputOrganisationList" id="organisationfield" placeholder="Organisation" class="form-control" name="organisation">
                                        
                                         <datalist id="inputOrganisationList">
                                                                        ' . $organisationlist . '                                                                     
                                         </datalist>
                                         <a href="javascript:void(0)" id="addOrganisation" style="color:blue; text-decoration: underline;">Create an Organisation <i class="fas fa-external-link-alt"></i> </a>

                                  </div>
                                </div>
                                </div>
                                

                                <div class="row" id="companyrow" style="display:none;">

                                    <div class="form-group">

                                        <label class="control-label">Direct Billing A/C</label>

                                        <select class="form-control" name="companyname" id="companyname">                        
                                   
                                        ' . $companyList . '
                                          
                
                                     </select>
                                    
                                    </div>
                                </div>



                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                   
                                        <label class="control-label">GST Number</label>
                                      
                                           <input type="text" placeholder="GST Number" id="gstNoField" class="form-control" name="gstnumber">
                                   
                                </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                                 
                                      <label class="control-label">Booking Source</label>
                                     
                                      <select class="form-control" name="bookingSorcelist" id="bookingSorcelist">
                            
                                      ' .  $bookingSorcelist . '
          
                                       </select>
                                      
                              </div>
                            </div>

                            </div>


                            <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                
                                    <label class="control-label">Travel Type</label>
                                   
                                    <select class="form-control" name="traveltype" id="traveltype">                        
                                   
                                            <option value=1>Business Trip</option>
                                            <option value=2>Tourist</option>
                                          
                
                                     </select>
                                 
                            </div>
                          </div>



                          
                          <div class="col-md-6">
                          <div class="form-group">
                             
                                  <label class="control-label">Booking Ref.</label>
                            
                                     <input type="text" placeholder="Booking Ref." class="form-control" name="bookingref">
                               
                          </div>
                        </div>


                        </div>

                        <div class="row">
                        <div class="col-md-6">
                        
                            <div class="form-group">
                                <label class="control-label">Travel Agent</label>
                                <select class="form-control" name="travelagent" id="travelagent">                     
                                   
                                       ' . $travelagentList . '                          
    
                                 </select>
                                 <a href="javascript:void(0)" onclick="addTravelAgentForm()" style="color:blue; text-decoration: underline;">Create a Travel Agent <i class="fas fa-external-link-alt"></i> </a>
                            </div>

                        </div>

                        <div class="col-md-6">
                        
                                <div class="form-group">
                                    <label class="control-label">Room Charge</label>
                                    <input type="text" placeholder="Room Charge" class="form-control" name="roomcharge">
                                </div>

                         </div>
                        
                        </div>
            
            </div>
        
        
        ';
    }



    $html = '
            <form method="post" id="' . $formId . '">
                <div class="row">

                    <div class="col-md-8">
                        <div class=""> 
                                ' . $pageHtml . '
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-area1">
                                        <button id="backBtnForPoupUpContent">

                                                <i>
                                                    <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 152.3 98.8" style="enable-background:new 0 0 152.3 98.8;" width="15px" height="15px">
                                                        <style type="text/css">
                                                            .leftArrowLine{fill:none;stroke:#000000;stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                                        </style>
                                                        <g>
                                                            <line class="leftArrowLine" x1="138" y1="50.4" x2="13.1" y2="50.4"/>
                                                            <line class="leftArrowLine" x1="48.4" y1="15" x2="13" y2="50.3"/>
                                                            <line class="leftArrowLine" x1="48.4" y1="85.7" x2="13" y2="50.3"/>
                                                        </g>
                                                    </svg>
                                                </i> 
                                                <h4>Reservation</h4> 
                                            </button>
                                        </div>
                                        <br />
                                        
                                        ' . $topBookingDetailHtml . '

                                        <br/>
                                        <hr/>

                                        
                                        <br/>
                                        <div class="row">
                                            <div class="col-12">
                                                <table width="100%" id="roomDetailTable">
                                                    <thead>
                                                        <tr>
                                                            <th width="30%" class="py10">Room Type</th>
                                                            <th width="20%" class="py10">Rate Type</th>
                                                            <th width="10%" class="py10">Adult</th>
                                                            <th width="10%" class="py10">Child</th>
                                                            <th width="10%" class="py10">RN</th>
                                                            <th width="20%" class="py10 reservationRateArea" ><span>Rate(Rs)</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="roomDetailId">
                                                        ' . $roomDetailListHtml . '
                                                    </tbody>
                                                </table>
                                            </div>
                                            

                                        </div>
                                        <br/>' . $addRoomBtn . '<br/>' . $guestInfoHtml . '                                        
                                        <div class="s15"></div>                                       
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="dFlex jce">
                                    <button class="btn btn-outline-secondary mr10">cancel</button>
                                    <button class="btn bg-gradient-info" id="' . $formSubmitBtnId . '" type="submit" name="reservationSubmit">' . $formSubmitBtn . '</button>
                                </div>                           
                        </div>
                    </div>

                    <div class="col-md-4 rightSideAddReservation">                        
                        <div class="form-area">
                        <div class="cardTop">        
                        <svg width="497" height="219" viewBox="0 0 497 219" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M-38.5 196C-38.5 196 34 91 133.5 91C233 91 427 159 532.5 30C638 -99 518 236 518 236L-49 246.5L-38.5 196Z" fill="#FF768E"></path>
                        </svg>
                        </div>' . $reservationContentPreviewHtml . '
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="paymentMethod">Payment Method</label>
            
                                    <select name="paymentMethod" id="paymentMethod" class="form-control">
                                        <option value="" selected>-Select-</option>
                                        ' . $paymentMethodHtml . '
                                    </select>
            
                                </div>        
                            </div>
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="paidAmount">Paid Amount</label>
                                    <input value="" name="paidAmount" id="paidAmount" class="form-control" placeholder="Enter Amount"/>
            
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form" style="position: relative;">
                                
                                        <label for="paymentRemark">Payment Remark</label>
                                        

                                       
                                            <span class="form-group reservationRateArea w85p" style="position: absolute; display: inline-block !important;">
                                                <div class="content" style="position: absolute; padding: 2px; left: 8px;">
                                                    <div class="overflowContent">
                                                       A payment remark is a note or comment <br> associated with a payment transaction.
                                                    </div>
                                                    <span class="icon reservationRateAreaIcon" style="width: 20px; height: 22px; border-radius: 50%; padding-left: 2px;"><i class="bi bi-info-lg"></i></span></div>
                                            </span>
                                       
                                        <input name="paymentRemark" id="paymentRemark" class="form-control" placeholder="Enter voucher number, receipt number etc"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
    ';

    echo $html;
}

if ($type == 'getGstNumber') {

    $name = $_POST['organisation'];
    $dataid = $_POST['dataid'];
    $result = getGstNumberFromOrganisationName($name, $dataid);

    echo json_encode($result);
}

if ($type == 'add_travelagent') {

    $travelagentname = $_POST["travelagentname"];
    $travelagentemail = $_POST["travelagentemail"];
    $travelagentAddress = $_POST["travelagentAddress"];
    $travelagrntCity = $_POST["travelagrntCity"];
    $travelagentState = $_POST["travelagentState"];
    $travelagentCountry = $_POST["travelagentCountry"];
    $travelagentPostCode = $_POST["travelagentPostCode"];
    $travelagentPhoneno = $_POST["travelagentPhoneno"];
    $travelagentGstNo = $_POST["travelagentGstNo"];
    $travelagentcommission = $_POST["travelagentcommission"];
    $travelaaagentGstonCommision = $_POST["travelaaagentGstonCommision"];
    $travelaaagentTcs = $_POST["travelaaagentTcs"];
    $travelaaagentTds = $_POST["travelaaagentTds"];
    $travelagentNote = $_POST["travelagentNote"];

    $result = setTraveAgentData($travelagentname, $travelagentemail, $travelagentAddress, $travelagrntCity, $travelagentState, $travelagentCountry, $travelagentPostCode, $travelagentPhoneno, $travelagentGstNo, $travelagentcommission, $travelaaagentGstonCommision, $travelaaagentTcs, $travelaaagentTds, $travelagentNote);
    
    $data = [
        'status'=> 'error',
        'id'=> 0,
        'name'=>''
    ];

    if ($result != '') {
        $data = [
            'status'=> 'success',
            'id'=>$result,
            'name'=>$travelagentname
        ];
    } 

    echo json_encode($data);
}

if ($type == 'addNewOrganisation') {

    $organisationName = $_POST['organisationname'];
    $organisationEmail = $_POST['organisationemail'];
    $organisationAddress = $_POST['organisationaddress'];
    $organisationCity = $_POST['organisationcity'];
    $organisationState = $_POST['organisationState'];
    $organisationCountry = $_POST['organisationCountry'];
    $organisationPostCode = $_POST['organisationPostCode'];
    $organisationNumber = $_POST['organisationNumber'];
    $organisationGstNo = $_POST['organisationGstNo'];
    $ratePlan = $_POST['rateplan'];
    $salesManager = $_POST['salesManager'];
    $organisationDiscount = ($_POST['organisationDiscount'] == '') ? 0 : $_POST['organisationDiscount'];
    $organisationNote = $_POST['organisationNote'];
    $data = array();

    $response = setOrganisationDetails($organisationName, $organisationEmail, $organisationAddress, $organisationCity, $organisationState, $organisationCountry, $organisationPostCode, $organisationNumber, $organisationGstNo, $ratePlan, $salesManager, $organisationDiscount, $organisationNote);

    $data = [
        'status'=>'error',
        'id'=>'',
        'name'=>'',
        'msg'=>'Something went wrong!',
    ];

    if ($response != '') {

        $data = [
            'status'=>'success',
            'id'=>$response,
            'name'=>$organisationName,
            'msg'=>'Add Record.',
        ];

    }

    echo json_encode($data);
}

if ($type == 'loadReservationPreview') {
    // pr($_POST);couponCode
    $hotelDeatailArry = hotelDetail();
    $bookingCode = getHotelServiceData('',HOTEL_ID, '3')[0]['voucher'];
    $slug = $hotelDeatailArry['slug'];
    if (isset($_SESSION['reservatioId']) && $_SESSION['reservatioId'] != '') {
        $bid = $_SESSION['reservatioId'];
    } else {
        $code = ($bookingCode == '') ? $slug : $bookingCode;
        $bid = $code . '-' . unique_id(6);
        $_SESSION['reservatioId'] = $bid;
    }

    $reciptNo = generateRecipt();
    $gname = '';

    if (isset($_POST['checkIn'])) {
        $checkIn = ($_POST['checkIn'] == '') ? date('Y-m-d') : $_POST['checkIn'];
    } else {
        $checkIn = '';
    }

    if (isset($_POST['checkOut'])) {
        $checkOut = ($_POST['checkOut'] == '') ? date('Y-m-d') : $_POST['checkOut'];
        if (strtotime($checkIn) >= strtotime($checkOut)) {
            $checkOut = date('Y-m-d', strtotime($checkIn . ' +1 day'));
        }
    } else {
        $checkOut = '';
    }
    $selectRoom = '';
    $selectRateType = '';
    $selectAdult = '';
    $selectChild = '';

    $reservationType = safeData($_POST['reservationType']);

    if (isset($_POST['guestName'])) {
        $gname = safeData($_POST['guestName']);
    }

    if (isset($_POST['selectRoom'])) {
        $selectRoom = $_POST['selectRoom'];
    }

    if (isset($_POST['selectRateType'])) {
        $selectRateType = $_POST['selectRateType'];
    }

    if (isset($_POST['selectAdult'])) {
        $selectAdult = ($_POST['selectAdult'] == '') ? [] : $_POST['selectAdult'];
        $adultSum = array_sum($selectAdult);
    }

    if (isset($_POST['selectChild'])) {
        $selectChild = ($_POST['selectChild'] == '') ? [] : $_POST['selectChild'];
        $childSum = array_sum($selectChild);
    }

    $bDate = date('Y-m-d');

    $countNight = getNightByTwoDates($checkIn, $checkOut);

    $nAdult = 0;
    $nChild = 0;
    $totalPrice = 0;
    $total = '';


    if (isset($_POST['paidAmount'])) {
        $paid = ($_POST['paidAmount'] == '') ? '' : $_POST['paidAmount'];
    } else {
        $paid = '';
    }
    $sumTotalPrice = 0;
    $gstArray = $_POST['roomGst'];
    if (isset($_POST['totalPrice'])) {
        $totalPrice = ($_POST['totalPrice'] == '') ? [] : $_POST['totalPrice'];
        foreach($totalPrice as $key=>$val){
            $gst = $gstArray[$key];
            $gstPrice = getPriceCalculate('percentage',$gst,$val);
            $sumTotalPrice += $val + $gstPrice;
        }
    }

    $couponCode = (isset($_POST['couponCode'])) ? $_POST['couponCode'] : '';
    $_SESSION['couponCode'] = $couponCode;
    $couponPrice = 0;
    $couponPer = '';
    $couponType = '';

    


    $html = reservationContent($bid, $reciptNo, $gname, $checkIn, $checkOut, $bDate, $adultSum, $childSum, $sumTotalPrice, $paid, '', '', '', 'no', $couponCode, $couponPrice, $couponType, $couponPer,$reservationType);

    echo $html;
}

if ($type == 'generatrExcelSheet') {

    $sheetType = $_POST['sheetType'];
    $currentDate = date('y-m-d');

    if ($sheetType == 'reservationBtn') {
        $sql = "select booking.*,bookingdetail.checkinstatus from booking,bookingdetail where bookingdetail.checkinstatus = '1'";
    }

    if ($sheetType == 'ariveBtn') {
        $sql = "select booking.*,bookingdetail.checkinstatus from booking,bookingdetail where booking.checkIn = '$currentDate'";
    }

    if ($sheetType == 'failedBtn') {
        $sql = "select booking.*,bookingdetail.checkinstatus from booking,bookingdetail where booking.payment_status = 'pending'";
    }

    if ($sheetType == 'inHouseBtn') {
        $sql = "select booking.*,bookingdetail.checkinstatus from booking,bookingdetail where bookingdetail.checkinstatus = '2'";
    }
    $sql .= " and booking.id=bookingdetail.bid ORDER BY booking.id DESC ";
    $query = mysqli_query($conDB, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            $bid = $row['id'];
            $bookinId = $row['bookinId'];
            $reciptNo = $row['reciptNo'];
            $grossCharge = getBookingDetailById($bid)['totalPrice'];
            $userPay = $row['userPay'];
            $checkIn = $row['checkIn'];
            $checkOut = $row['checkOut'];
            $nroom = $row['nroom'];
            $couponCode = $row['couponCode'];
            $payment_status = $row['payment_status'];
            $payment_id = $row['payment_id'];
            $bookingSource = $row['bookingSource'];
            $add_on = $row['add_on'];
        }
    }

    echo $sql;
}

if ($type == 'getRoomNumByRID') {
    $id = $_POST['id'];
    $bookingDetailArray = getBookingDetail('', $id)[0];
    $filter = $_POST['filter'];
    $checkIn = ($_POST['checkIn'] == '') ? $bookingDetailArray['checkIn'] : date('Y-m-d', strtotime($_POST['checkIn']));
    $checkOut = ($_POST['checkOut'] == '') ? $bookingDetailArray['checkOut']  : date('Y-m-d', strtotime($_POST['checkOut']));

    $html = '';
    $roomNumArry = getRoomNumber('', '1', $id, $checkIn, $checkOut, 'res');
    $bookingArray = getBookingDetailById($id);
    $sn = 0;
    // pr(getRoomNumber('', '1', $id, $checkIn, $checkOut, 'res'));
    $existRoomNumArray = $_SESSION['SelectedRoomNumber'];
    foreach ($roomNumArry as $key => $roomNumList) {
        $select = '';
        $rn = $roomNumList['roomNo'];

        if ($filter == 'yes') {
            $sn++;
            if ($sn == 1) {
                $select = 'selected';
            }
            $html .= "<option $select value='$rn'>$rn</option>";
        } else {
            if (!in_array($rn, $existRoomNumArray)) {
                $sn++;

                if ($sn == 1) {
                    $select = 'selected';
                    array_push($_SESSION['SelectedRoomNumber'], $rn);
                }

                $html .= "<option $select value='$rn'>$rn</option>";
            }
        }
    }

    if ($sn == 0) {
        $html .= "<option value='0'>No</option>";
    }

    echo $html;
}

if (isset($_POST['submitStatus'])) {
    if ($_POST['submitStatus'] == 'addReservationSubmit') {


        $bookId = BOOK_GENERATE . unique_id(5);

        $checkIn = safeData($_POST['checkIn']);
        $checkOut = safeData($_POST['checkOut']);
        $roomQuntity = safeData($_POST['roomQuntity']);
        $reservationType = safeData($_POST['reservationType']);
        $bookinSource = safeData($_POST['bookinSource']);
        $businessSource = safeData($_POST['businessSource']);
        // $bookAvailable = safeData($_POST['bookAvailable']);

        $selectRoom = $_POST['selectRoom'];
        $selectRateType = $_POST['selectRateType'];
        $selectAdult = $_POST['selectAdult'];
        $selectChild = $_POST['selectChild'];

        $guestName = safeData($_POST['guestName']);
        $guestMobile = safeData($_POST['guestMobile']);
        $guestEmail = safeData($_POST['guestEmail']);
        $guestAddress = safeData($_POST['guestAddress']);
        $guestCuntry = safeData($_POST['guestCuntry']);
        $guestState = safeData($_POST['guestState']);
        $guestCity = safeData($_POST['guestCity']);
        $guestZip = safeData($_POST['guestZip']);

        $paymentMethod = safeData($_POST['paymentMethod']);
        $paidAmount = safeData($_POST['paidAmount']);

        $reciptNo = generateRecipt();

        $hotrlId = $_SESSION['ADMIN_ID'];



        mysqli_query($conDB, "insert into booking(bookinId,hotelId,reciptNo,checkIn,checkOut,payment_status,bookingSource,bussinessSource,paymethodId,userPay) values('$bookId','$hotrlId','$reciptNo','$checkIn','$checkOut','$reservationType','$bookinSource','$businessSource','$paymentMethod','$paidAmount')");

        $lastId = mysqli_insert_id($conDB);

        mysqli_query($conDB, "insert into guest(hotelId,bookId,serial,name,email,phone,country) values('$hotrlId','$lastId','1','$guestName','$guestEmail','$guestMobile','$guestCuntry')");
        $guestLastId = mysqli_insert_id($conDB);

        if (isset($selectRoom)) {
            foreach ($selectRoom as $key => $val) {
                $room = $val;
                $rateType = $selectRateType[$key];
                $adult = $selectAdult[$key];
                $child = $selectChild[$key];

                $roomPrice = getRoomPriceById($room, $rateType, $adult, $checkIn);
                $adultPrice = getAdultPriceByNoAdult($adult, $lastId, $room, $checkIn);
                $childPrice = getChildPriceByNoChild($child, $lastId, $room, $checkIn);
                if (isset(getRoomNumber('', '', 1, $room, $checkIn)[0])) {
                    $roomNum = getRoomNumber('', '', 1, $room, $checkIn)[0]['roomNo'];
                    mysqli_query($conDB, "insert into bookingdetail(bid,roomId,roomDId,adult,child,room_number) values('$lastId','$room','$rateType','$adult','$child','$roomNum')");
                }
            }
        }
    }
}

if ($type == 'getGuestDetailsByBid') {
    $bid = $_POST['bid'];
    $guestDetailsArray = getGuestInformationByBid($bid);

    $html = '
    <div class="guestbox" style="max-height:400px; overflow-y:auto;">
    <table class="table">
    <thead>
      <tr>
        <th scope="col">sl</th>
        <th scope="col">Name</th>
        <th scope="col">Mail</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>';
    $sl = 1;

    if (count($guestDetailsArray) > 0) {
        foreach ($guestDetailsArray as $val) {

            $name = $val['name'];
            $mailId  = $val['email'];

            if ($mailId != '') {
                $html .= ' <tr>
                        <td>' . $sl . '</td>
                        <td>' . $name . '</td>
                        <td>' . $mailId . '</td>
                        <td><button class="emailSendBtn btn" data-email="' . $mailId . '" data-bid="' . $bid . '">Send</button></td>
                    </tr>';
                $sl++;
            }
        }
    } else {
        $html .= '<tr><td>No Data</td></tr>';
    }
    $html .= '</div>';
    $html .= '</tbody>';
    $html .= '</table>';

    echo $html;
}


?>