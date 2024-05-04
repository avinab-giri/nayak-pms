<?php

include('../constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// pr($_POST);
$page = $_POST['page'];
global $hotelId;


$hotelDeatailArry = fetchData('hotel', ['hCode' => $_SESSION['HOTEL_ID']])[0];
$bookingCode = getHotelServiceData('', HOTEL_ID, '3')[0]['voucher'];

$slug = $hotelDeatailArry['slug'];
$hotelName = $hotelDeatailArry['hotelName'];

if (isset($_SESSION['reservatioId']) && $_SESSION['reservatioId'] != '') {
    $bookId = $_SESSION['reservatioId'];
} else {
    $code = ($bookingCode == '') ? $slug : $bookingCode;
    $bookId = $code . '-' . unique_id(6);
    $_SESSION['reservatioId'] = $bookId;
}

$checkInDat = (isset($_POST['checkIn'])) ? $_POST['checkIn'] : date('Y-m-d');
$checkIn = date('Y-m-d', strtotime($checkInDat));

$checkOut = (isset($_POST['checkOut'])) ? date('Y-m-d', strtotime($_POST['checkOut'])) : date('Y-m-d', strtotime('+1 day', strtotime($checkIn)));

$nightCount = getNightCountByDay($checkIn, $checkOut);

$checkOut = (strtotime($checkIn) == strtotime($checkOut)) ? date('Y-m-d', strtotime('+1 day', strtotime($checkOut))) : $checkOut;


$reservationType = safeData($_POST['reservationType']);
$bookinSource = safeData($_POST['bookingSorcelist']);
$bsName = getBookingSource($bookinSource)[0]['name'];


$selectRoom = $_POST['selectRoom'];
$selectRateType = $_POST['selectRateType'];
$selectAdult = $_POST['selectAdult'];
$selectChild = $_POST['selectChild'];
$roomGst = $_POST['roomGst'];
$totalPrice = $_POST['totalPrice'];

$travelagent = $_POST['travelagent'];
$bookByName = (isset($_POST['bookByName'])) ? $_POST['bookByName'] : '';
$bookByEmail = (isset($_POST['bookByEmail'])) ? $_POST['bookByEmail'] : '';
$bookByWhatsApp = (isset($_POST['bookByWhatsApp'])) ? $_POST['bookByWhatsApp'] : '';
$bookByMobile = (isset($_POST['bookByMobile'])) ? $_POST['bookByMobile'] : '';
$bookBypinCode = (isset($_POST['bookBypinCode'])) ? $_POST['bookBypinCode'] : '';
$bookByblock = (isset($_POST['bookByblock'])) ? $_POST['bookByblock'] : '';
$bookBydistrict = (isset($_POST['bookBydistrict'])) ? $_POST['bookBydistrict'] : '';
$bookBystate = (isset($_POST['bookBystate'])) ? $_POST['bookBystate'] : '';

$guestName = safeData($_POST['guestName']);
$guestEmail = safeData($_POST['guestEmail']);
$guestWhatsApp = safeData($_POST['guestWhatsApp']);
$guestMobile = safeData($_POST['guestMobile']);
$guestAddress = safeData($_POST['guestAddress']);
$pinCode = safeData($_POST['pinCode']);
$block = safeData($_POST['block']);
$district = safeData($_POST['district']);
$state = safeData($_POST['state']);


$paymentMethod = ($_POST['paymentMethod'] == '') ? 0 : safeData($_POST['paymentMethod']);
$paidAmount = ($_POST['paidAmount'] == '') ? 0 : safeData($_POST['paidAmount']);
$paymentRemark = safeData($_POST['paymentRemark']);

$specialRequest = $_POST['specialRequest'];



$reciptNo = generateRecipt();
$addBy = dataAddBy();

$billingMode = safeData($_POST['billingmode']);
$organisation = safeData($_POST['organisation']);
$gstnumber = safeData($_POST['gstnumber']);
$travelagent = (isset($_POST['travelagent'])) ? safeData($_POST['travelagent']) : '';

global $time;

$bookingDataArray = [
    'bookinId' => $bookId,
    'hotelId' => $_SESSION['HOTEL_ID'],
    'reciptNo' => $reciptNo,
    'payment_status' => 1,
    'bookingSource' => $bookinSource,
    'userPay' => $paidAmount,
    'addBy' => $addBy,
    'billingMode' => $billingMode,
    'organisation' => $organisation,
    'status' => $reservationType,
    'add_on' => $time,
];

$lastId = insertData('booking', $bookingDataArray);

setPaymentTimeline($lastId, '', $lastId, $paidAmount, $paymentMethod, $paymentRemark, $addBy, '', $lastId);

// setBookingFolio('',$guestName,$lastId,0,'',$paidAmount,'',$totalPrice,'','Booking','',$bsName);

if (isset($selectRoom)) {
    foreach ($selectRoom as $key => $val) {
        $room = $val;
        $rateType = $selectRateType[$key];
        $adult = $selectAdult[$key];
        $child = $selectChild[$key];
        $gst = $roomGst[$key];
        $totalPrice = $totalPrice[$key];

        $bookingDetailsDataArray = [
            'hotelId' => $_SESSION['HOTEL_ID'],
            'bid' => $lastId,
            'roomId' => $room,
            'roomDId' => $rateType,
            'adult' => $adult,
            'child' => $child,
            'gstPer' => $gst,
            'totalPrice' => $totalPrice,
            'addOn' => $time,
        ];

        $lastBookingDetailId = insertData('bookingdetail', $bookingDetailsDataArray);


        insertData('guestamenddetail', ['hotelId' => $hotelId, 'bid' => $lastId, 'bdid' => $lastBookingDetailId]);
    }
}

$guestDataArray = [
    'hotelId' => $_SESSION['HOTEL_ID'],
    'bookId' => $lastId,
    'bookingdId' => $lastBookingDetailId,
    'serial' => 1,
    'name' => $guestName,
    'email' => $guestEmail,
    'phone' => $guestMobile,
    'whatsapp' => $guestWhatsApp,
    'zip' => $pinCode,
    'block' => $block,
    'district' => $district,
    'state' => $state,
    'full_address' => $guestAddress,
    'addOn' => $time,
    'groupadmin' => 1,
];

insertData('guest', $guestDataArray);

$voucherHtml = orderEmail2($lastId);
$msg = generateInvoice('reservationGuest',$guestName,$lastId);
send_email($guestEmail, $guestName, '', '', $msg, "Your Booking Confirmed : $hotelName",$voucherHtml, $bookId);

$editLink = generateEditReservationLink($lastId);
$alert = 'Reservation <a class="pClr" target="_blank" href="' . $editLink . '">' . $bookId . '</a> has been created';
setActivityFeed('', 6, '', '', '', '', '', '', $alert);
unset($_SESSION['reservatioId']);
echo $page;
