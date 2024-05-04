<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

$type = '';

if(isset($_POST['type'])){
    $type = $_POST['type'];
}

if($type == 'loadStayView'){
    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
    $rid =  $_POST['rid'];
    $thHtml = '<th style="width:calc(100% / 13)"><button class="bg-gradient-primary" id="collapsAll" style="border:none; color:white; font-weight:bold;">Close All</button></th>';
    
    $tdForRT = '';
    
    $tfootHtml = '<td>Total</td>';
    

    for ($i=0; $i < 10; $i++) { 
        $oneDate = date("Y-m-d", strtotime($date) + (86400 * $i));
        $formatDate = date('M-d', strtotime($oneDate));
        $thHtml .= "<th style='width:calc(100% / 13)' id='$formatDate'>$formatDate</th>";
    }

    $hdHtmlRow = "<tr>$thHtml</tr>";

    foreach(getRoomType("",1) as $key=>$roomTypeList){
        $roomTypeId = $roomTypeList['id'];
        $roomTypeName = $roomTypeList['header'];
        $roomTypeHdHtml = '';
        $active = 'show';

        // if($rid != ''){
        //     if($rid == $roomTypeId){
        //         $active = 'show';
        //     }
        // }else{
        //     if($key == 0){
        //         $active = 'show';
        //     }
        // }
        

        for ($i=0; $i < 10; $i++) { 
            $roomTypeHdHtml .= "";
        };

        $tdForRT .= "<tbody class='toggleTableBtn $active' data-rid='$roomTypeId'><tr>
            <td class='remove-hover' style='z-index: 5;position: relative'><span>$roomTypeName</span> <i class='bi bi-caret-right'></i></td> $roomTypeHdHtml
        </tr></tbody><tbody class='dropdownTableContent $active' data-rid='$roomTypeId'>";

         $counter=1;
        foreach(getRoomNumber('','',$roomTypeId) as $roomNumList){
            $roomNumId = $roomNumList['id'];
            $roomNum = $roomNumList['roomNo'];
            $hdHtml = '';
    
            for ($i=0; $i < 10; $i++) { 

                $oneDate = date("Y-m-d", strtotime($date) + (86400 * $i));
                $formatDate = date('M-d', strtotime($oneDate));
                $bid = '';
                $bookPersion = '';
                $nightCount = '';
                $btn = '';
                $checkInStatusClr = '';
                $bdid = '';
                $stringDate = "'$oneDate'";
                $classDate = $oneDate;
                
                $funcTionDate = '';
                
                if (new DateTime($oneDate) >= new DateTime(date('d.m.Y'))) {
                    $funcTionDate = 'onmousedown="handleMouseDown('.$stringDate.','.$roomNum.')" onmousemove="handleMouseOver('.$stringDate.','.$roomNum.')" onmouseup="handleMouseUp()"';
                }              
                $bookPersionHtml = '';
                if(isset(getBookingData('',$roomNum,$oneDate,'','onlyCheckIn','','','','','','','','','','','','','','yes')[0]['bid'])){
                    $bookinDetailArry = getBookingData('',$roomNum,$oneDate,'','onlyCheckIn')[0];
                    $bid = $bookinDetailArry['bid'];
                    $bdid = $bookinDetailArry['id'];

                    $bookinDetailArray = getBookingDetailById($bid);
                    
                    $checkIn = $bookinDetailArry['checkIn'];
                    $checkOut = $bookinDetailArry['checkOut'];
                    $nightCount = getNightByTwoDates($checkIn,$checkOut);

                    $checkInStatusAray = checkGuestCheckInStatus($bookinDetailArry['checkinstatus'])[0];
                
                    $checkInStatusId = $checkInStatusAray['id'];
                    $checkInStatus = $checkInStatusAray['name'];
                    $checkInStatusClr = $checkInStatusAray['bg'];
                    $bookingSource = $bookinDetailArry['bookingSource'];
                    $bookingSourceHtml = FRONT_SITE . '/img/icon/source/' . getBookingSource($bookingSource)[0]['img'];
                    $bookingSourceName = getBookingSource($bookingSource)[0]['name'];
                    
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

                    
                    $funcTionDate = '';

                    $advanceBtnHtml = "
                        $paymentDueBtn
                        $gropAdminBtn
                        $mealPlanBtn
                        $gropBookinBtn
                        $noSmokingBtn
                    ";
                    
                    if(($checkInStatusId !=4) && ($checkInStatusId !=5) && ($checkInStatusId !=6)){  
                                        
                        if(isset(getGuestDetail($bid,1)[0]['name'])){
                            $bookPersion = ucfirst(getGuestDetail($bid,'','',$bdid)[0]['name']);
                            $bookPersionHtml = '<span onclick="reservationDetailPopUp('.$bid.','.$bdid.',all)" class="'.$bid.'" style="width: calc(100% * '.$nightCount.'); background: '.$checkInStatusClr.'">
                                <strong class="zi5 staySource" data-tooltip-top="'.$bookingSourceName.'"><img style="width:20px" src="'.$bookingSourceHtml.'"/></strong> 
                                <h4 class="responsiveText stayText">'.$bookPersion.'</h4>
                                <ul class="topGroupIcon">'.$advanceBtnHtml.'</ul>
                            </span>';
                            $btn = 'badge guestOnStayView';
                        }
                    }
    
                }

                $hdHtml .= '<td '.$funcTionDate.' style="width:calc(100% / 11)" id='.$counter.' class="'.$formatDate.' '.$classDate.' '.$roomNum.'">
                                '.$bookPersionHtml.'
                            </td>';

            }
            

            $tdForRT .= "<tr id=".$counter." style='width: 100%;display: flex;align-items: center;justify-content: space-between;' class='roomNum'><td style='width:calc(100% / 11)'>$roomNum</td>$hdHtml</tr>";
            $counter++;
        }

        $tdForRT .= "</tbody>";
     
        

    }

    for ($i=-2; $i < 10; $i++) { 
        $oneDate = date("Y-m-d", strtotime($date) + (86400 * $i));
        $formatDate = date('M-d', strtotime($oneDate));
        $countBookingArry = countRoomViewByDate('',$oneDate);
        $exist = $countBookingArry['exist'];
        $book = $countBookingArry['book'];
        $tfootHtml .= "<td style='width:calc(100% / 13)'><strong>$book</strong> <strong>$exist</strong></td>";
    }

    

    $html = "<table width='100%'>
                <thead>$hdHtmlRow</thead>
            </table>
            <div class='scrollBar' style='max-height: 70vh;height: 100%;'><table width='100%'> $tdForRT </table></div>
            <table width='100%'>
                <tbody class='totalBookShowCase'><tr>$tfootHtml</tr></tbody>
            </table>
            ";

    
    echo $html;
}



?>
<script>
$(document).ready(function(){
    $('#collapsAll').click(function(){
        $('tbody').removeClass('show');
    });   
});
</script>