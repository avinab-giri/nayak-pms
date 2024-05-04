<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
$ipAddres = get_IP_address();
$addBy = dataAddBy();
$username = getHotelUserDetail($_SESSION['ADMIN_ID'])[0]['email'];
$alert = "<b>$username</b> username is logout.";
setActivityFeed($_SESSION['HOTEL_ID'],'9','','','','',$ipAddres,'success',$alert,$addBy);
unset($_SESSION['ADMIN_ID']);
unset($_SESSION['HOTEL_ID']);
$_SESSION['SuccessMsg'] = "Successfully Logout";
redirect(FRONT_SITE.'/login');

?>
