<?php


include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');


$type = '';

if(isset($_POST['type'])){
    $type = $_POST['type'];
}


if($type == 'loadNightAudit'){
    $currentDate = date('Y-m-d', strtotime($_POST['currentDate']));
    if($currentDate == ''){
        $currentDate = date('Y-m-d');
    }
    
    $html = '
    
            <table class="table align-items-center mb-0 tableLine">
                <thead>
                    <tr>
                        <th> S No</th>
                        <th> Name</th>
                        <th> Room Number</th>
                        <th> Check In</th>
                        <th> Pax</th>
                        <th> Rent </th>
                    </tr>
                </thead>
            
    
    ';



        $sl = 0;
        
        foreach(getBookingData('','',$currentDate) as $bookList){
           
            $sl ++;
            $bId = $bookList['bid'];
            $bookingdetailId = $bookList['bookingdetailId'];
            $room_number = $bookList['room_number'];
            $checkIn = date('d-M', strtotime($bookList['checkIn']));
            $guestArry = getGuestDetail($bId,'','',$bookingdetailId);
            $gName = '';
            $pax = count($guestArry);
            foreach ($guestArry as $guestValue) {
                $gName .= $guestValue['name'].'<br/>';
            }

            $totalPrice = number_format(getBookingDetailById($bId)['totalPrice'], 2);
         
            $html .= "
                    <tr>

                        <td class='center mb-0 bold'>$sl</td>
                        <td class='center mb-0 bold'>$gName </td>
                        <td class='text-sm mb-0'>$room_number</td>
                        <td class='text-sm mb-0'>$checkIn</td>
                        <td class='text-sm mb-0'>$pax</td>
                        <td class='text-sm mb-0'>Rs $totalPrice</td>
                    </tr>
            ";
           
            
        }
    
        if(!isset($bId)){
            $html .= '
                <tr>
                    <td colspan="6" style="text-align:center">No Data</td>
                </tr>
            ';
        }





    $html .= '</table>';

    echo $html;
}


?>