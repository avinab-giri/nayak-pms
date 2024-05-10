

<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'ajaxFunction.php');
include(SERVER_INCLUDE_PATH . 'add_to_kot.php');


include(SERVER_INCLUDE_PATH . 'add_to_stock.php');
include(SERVER_INCLUDE_PATH . 'calendar.php');




// $genrateInvoce = orderEmail2Body(15);

// send_email('avinabgiri7978@gmail.com', 'Avinab', 'avinabgiri7978@gmail.com', 'avinabgiri7978@gmail.com', 'test', 'For Test', $genrateInvoce);



// $text = "1";
// $encoded = customEncodeBase64($text);
// echo "Encoded: $encoded<br>";

// $decoded = customDecodeBase64($encoded);
// echo "Decoded: $decoded";

// pr(getHotelPageLink());
// global $hotelId;
// pr(getBookingFolio('','',1,'','','','','yes','2024-02-16'));
// pr(getRoomNumber('','1','4'));
// pr(getRoomNumber('', '1', 6, '2024-03-11', '2024-03-12', 'res'));

die();
// pr(getBookingFolio('','',4));

// setcookie("TestCookie", 'test', time()+3600, "/");
// pr($_COOKIE);
// setcookie("ratePlanCon", null, time()-3600, "/");


// createCookie('avi','test3');
// deleteCookie('ratePlanCon');
// deleteCookie('avi');
// unset($_COOKIE['avi']);

// unset($_SESSION['reservatioId']);
// pr(roomMoveOptionByRoomId('1','rate','1'));
// pr(generateKotOrder(1));
// pr(getBookingData(1))

// pr(getHotelUserDetail($_SESSION['ADMIN_ID']))

// pr(getBookingDetailById(2));

// pr(hotelTerm())
// session_destroy();

// pr(getActiveFeed('','',1))

// pr(getHotelImageData('','','','',16))
// $currentDate = date('Y-m-d');

// pr(getPropertyRatePlaneList('','9ba80','yes'))
// pr($_SESSION);
// pr(getHotelSocialLinkData('','9ba80',7))
// pr(getBookingDetailById(12,'',3))

// pr(getKotOrder('','','','','',1,13,0))
// $_SESSION['kotSeviceId'] =2;
// pr($_SESSION)


// pr(getKotOrder('', 'no', '', '', 'yes')[0]['maxBillNo'], 'inc')
// $date = date('Y-m-d');
// pr(getKotOrder('',$date))



$oid = 1;


$name = getGuestDetail($oid)[0]['name'];
$email = getGuestDetail($oid)[0]['email'];
$phoneNumber = getGuestDetail($oid)[0]['phone'];
$company_name = getGuestDetail($oid)[0]['company_name'];
$gst = getGuestDetail($oid)[0]['comGst'];
$bid = 1;
$userPay = getBookingDetailById(1)['userPay'];

$price = getBookingDetailById(1)['userPay'];
$grossCharge = getBookingDetailById(1)['totalPrice'];
// $payment_status = getBookingDetailById(1)['paymentStatus'];
$payment_status = 'complete';
// $payment_id = getBookingDetailById(1)['paymentId'];
$payment_id = 'gg';
$add_on = date('d-m-Y g:i A', strtotime(getBookingDetailById(1)['addOn']));

$couponCode = getBookingDetailById(1)['couponCode'];
$pickUp = getBookingDetailById(1)['pickUp'];
$pickupHtml = '';

$sitename = SITE_NAME;
$bookingSite = FRONT_BOOKING_SITE;

$logo = FRONT_SITE_IMG . hotelDetail()['darklogo'];


$hotelName = hotelDetail()['hotelName'];





foreach (getOrderDetailArrByOrderId($oid) as $bidrow) {
    $checkIn = $bidrow['checkIn'];
    $checkOut = $bidrow['checkOut'];
};

$bookingDetailArry = getBookingDetailById($oid);

$total_price = $bookingDetailArry['totalPrice'];
$gst_price = $bookingDetailArry['gstPrice'];;
$couponBalance = 0;
$paymentBackupHtml = '';
foreach ($bookingDetailArry['roomDetailArry'] as $bidrow) {
    $roomName = $bidrow['roomName'];
    $roomPrice = $bidrow['room'];
    $couponPrice = $bidrow['couponPrice'];
    $adult = $bidrow['adult'];
    $child = $bidrow['child'];
    $adultPrice = $bidrow['adultPrice'];
    $childPrice = $bidrow['childPrice'];
    $gstPer = $bidrow['gstPer'];
    $gstPrice = $bidrow['gstPrice'];
    $couponPriceHtml = '';
    $bookingStatus = $bidrow['bookingStatus'];
    $plan = $bidrow['rateplan'][0];
    $total = $bidrow['total'];
    $discount = $bookingDetailArry['totalDiscount'];

    $roomdetailsHtml .= '
    <table style="width:100%; border-collapse:collapse;">
    <tbody>
        <tr>
            <td>
                <h3>Room Details</h3>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                1. Room Type :' . $roomName . '
            </td>
            <td>Room Rate:</td>
            <td>' . $roomPrice . '</td>
        </tr>
        <tr>
            <td>
                Plan: ' . $plan . '
            </td>
            <td>Discount:</td>
            <td>' . $discount . '</td>
        </tr>
        <tr>
            <td>
                Adult: ' . $adult . '
            </td>
            <td>Extra Charge:</td>
            <td>' . $extraCharge . '</td>
        </tr>
        <tr>
            <td>Child: ' . $child . '</td>
            <td>Tax:</td>
            <td>' . $gstPrice . '</td>
        </tr>
        <tr>
            <td></td>
            <td>Total:</td>
            <td>' . $total . '</td>
        </tr>
   
    </tbody>
</table>

    ';
}

$reservationNumber = printBooingId($oid);
$date = date('Y-m-d');
$hotelMail = ucfirst(hotelDetail()['hotelEmailId']);
$hotelPhonenumber = ucfirst(hotelDetail()['hotelPhoneNum']);
$hotelAdd = ucfirst(hotelDetail()['address']);
$hotelWebsite = ucfirst(hotelDetail()['website']);

$hotelDetails = '';

$hotelDetails .= '<p>' . $hotelAdd . '</p>';
$hotelDetails .= '<p>' . $hotelPhonenumber . '</p>';
$hotelDetails .= '<p>' . $hotelMail . '</p>';
$hotelDetails .= '<p>' . $hotelWebsite . '</p>';





$bookedOn = $add_on;

$arrivalDate = $checkIn;

$departureDate = $checkOut;

$night = $bookingDetailArry['night'];

$totalRoom = 2;
$bookingType = $bookingDetailArry['bookingSource'];









$extraCharge = 0.00;


$total = $total_price;
$paid = $userPay;
$ToBePay = $total - $paid;

$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>demo</title>


</head>

<body>
    <table style="width: 95%; border:2px solid black; margin: 0 auto;">
        <tbody>

            <tr>
                <td>


                    <table style="width:100%; border-collapse :collapse;">
                        <tbody>
                            <tr>
                                <td style="width: 20%;">
                                    <img src="' . $logo . '" alt="logo">
                                    <p>Reservation number: ' . $reservationNumber . '</p>
                                </td>
                                <td style="width: 60%; text-align: center;">
                                    <h1>' . $hotelName . '</h1>
                                    ' . $hotelDetails . '
                                </td>
                                <td style="width: 20%;">
                                    <p>Date:' . $date . '</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr style=" height: 3px; background: black;">

                    <table style="width:100%; border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Guest Information</h3>
                                </td>
                                <td>
                                    <h3>Stay Information</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%; border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>' . $name . '</td>
                                <td>Booking Status:</td>
                                <td>' . $bookingStatus . '</td>
                            </tr>
                            <tr>
                                <td>Phone Number::</td>
                                <td>' . $phoneNumber . '</td>
                                <td>Booked On:</td>
                                <td>' . $bookedOn . '</td>
                            </tr>
                            <tr>
                                <td>Email::</td>
                                <td>' . $email . '</td>
                                <td>Arrival Date:</td>
                                <td>' . $arrivalDate . '</td>
                            </tr>
                            <tr>
                                <td>Organisation:</td>
                                <td>' . $company_name . '</td>
                                <td>Departure Date:</td>
                                <td>' . $departureDate . '</td>
                            </tr>
                            <tr>
                                <td>GST:</td>
                                <td>' . $gst . '</td>
                                <td>Night:</td>
                                <td>' . $night . '</td>
                            </tr>
                            <tr>
                                <td>Total Room:</td>
                                <td>' . $totalRoom . '</td>
                                <td>Booking Type:</td>
                                <td>' . $bookingType . '</td>
                            </tr>

                        </tbody>
                    </table>

                    <hr>

                   ' . $roomdetailsHtml . '
                    <hr>

                    <table style="width:100%; border-collapse:collapse;">
                        <tbody>
                            <tr style="width: 100%;">
                                <td style="width: 33%;">
                                    <h3>Grand Total: ' . $total . '</h3>
                                </td>
                                <td style="width: 33%;">
                                    <h3>Total Advances: ' . $paid . '</h3>
                                </td>
                                <td style="width: 33%;">
                                    <h3>Est. Balance: ' . $ToBePay . '</h3>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>';
echo  $html;
