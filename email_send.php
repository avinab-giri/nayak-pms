<?php
include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

$addBy = dataAddBy();

if (!isset($_GET['oid']) && !isset($_GET['qpid'])) {
  redirect('index.php');
  die();
}

if (isset($_GET['oid'])) {

  $oid = $_GET['oid'];

  $guestDataArry = getGuestDetail($oid, 1, '', '', 'asc')[0];
  $guestName = ($guestDataArry['name'] == '') ? 'Null' : $guestDataArry['name'];
  if(isset($_GET['email'])){
    $guestEmail = $_GET['email'];
  }
  else{
    $guestEmail = ($guestDataArry['email'] == '') ? 'Null' : $guestDataArry['email'];
  }
 

  $guest = $guestName;
  $email = $guestEmail;
  $body = generateInvoice('reservationGuest', $guestName, $oid);
  
  $sub = 'Your Booking Confirmed';
}

if (isset($_GET['qpid'])) {

  $oid = $_GET['qpid'];

  $sql = mysqli_query($conDB, "select * from quickpay where id = '$oid'");
  $booking_row = mysqli_fetch_assoc($sql);

  $guest = $booking_row['name'];

  $email = $booking_row['email'];
  $body = quickPayEmail($oid);
  $sub = 'Your Quick Pay Success.';
}

$hotel_email = hotelDetail()['email'];

send_email($email, $guest, $hotel_email, RETROD_MAIL_ID, $body, $sub);




// redirect('booking');
