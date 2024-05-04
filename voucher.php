<?php


include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SERVER_INCLUDE_PATH.'mpdf/autoload.php'); 

$addBy = dataAddBy();
 
 if(!isset($_GET['oid']) && !isset($_GET['vid']) && !isset($_GET['qpid']) && !isset($_GET['qpvid'])  && !isset($_GET['kot']) && (!isset($_GET['paymentInvoice']))){

    redirect('index.php');
    die();
 }
 
 $optype = 'D';
if(isset($_GET['vid'])){
    $vid=$_GET['vid'];
    $orderEmail=getBookingVoucher($vid);
    $fileName = getBookingIdById($vid).'_Hotel';
   }
   
   
if(isset($_GET['oid'])){
      $oid=$_GET['oid'];
    $orderEmail=orderEmail2($oid);
    $fileName = getBookingIdById($oid).'_Guest';
 } 
 
  if(isset($_GET['qpid'])){
    $qpid=$_GET['qpid'];
    $orderEmail=quickPayEmail($qpid);
    $fileName = getQuickPayBookingIdById($qpid).'_Guest';
 }
 
 if(isset($_GET['qpvid'])){
    $qpid=$_GET['qpvid'];
    $orderEmail=getQPVoucher($qpid);
    $fileName = getQuickPayBookingIdById($qpid).'_Hotel';
 }

 if(isset($_GET['kot'])){
   $kot=$_GET['kot'];
   $optype = $_GET['type'];
   $orderEmail=posInvoiceReceipt($kot);
   $billno = getKotOrder($kot)[0]['billno'];
   $fileName = 'kot-'.threeNumberFormat($billno);
}

if(isset($_GET['paymentInvoice'])){
   $orderEmail = $_GET['html'];
   $fileName =  $_GET['fileName'];
}



$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($orderEmail);
$file=$fileName.'.pdf';
$mpdf->Output($file, $optype);



?>