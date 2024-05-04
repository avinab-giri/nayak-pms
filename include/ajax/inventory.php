<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
$hotelId = $_SESSION['HOTEL_ID'];
$type = '';

if(isset($_POST['type'])){
    $type = $_POST['type'];
}
if(!empty($_POST['datepicker'])){
    // $current_date = strtotime(date('y-m-d'));
    $date = $_POST['datepicker'];
    $dateArr = explode('/',$date);
    $dateStr = $dateArr['2'].-$dateArr['0'].-$dateArr['1'];
    $current_date = strtotime($dateStr);

}else{
    $current_date = strtotime(date('y-m-d'));
}
$oneDay = strtotime('1 day 30 second', 0);




if($_POST['inventoryAction'] == 'rate'){
    
?>
    <ul class="accordion">
        <div class="mb-1">
            <table class="table align-items-center mb-0 tableLine">
                <thead>
                    <tr>
                        <th width='5%'>Sl.</th>
                        <th width="15%" >Rate Plan</th>
                        <?php
                        
                            $oneDay = strtotime('1 day 30 second', 0);

                            for($i=1;$i<=10;$i++){
                                $day = $current_date + ($i * $oneDay) - $oneDay;
                                $inDay = date('y-m-d', $day);
                                $inDay = date('d-M', $day);

                                echo "
                                    <th width='8%' >$inDay</th>
                                ";
                            }

                        ?>
                    </tr>
                </thead>
            </table> 
        </div>
            
            <?php
                $si = 0;
                $sql = mysqli_query($conDB, "select * from room where hotelId = '$hotelId'");
                $rowCount = 0;
                if(mysqli_num_rows($sql)>0){
                    while($row = mysqli_fetch_assoc($sql)){
                        $rowCount ++;
                        $room_id = $row['id'];
                        $si++; 
                        $getRatePlanByRoomId = getRatePlanByRoomId($room_id);
                    if($rowCount == 1){
                        $show = 'show';
                        $display = 'style="display: block"';
                    }else{
                        $show = '';
                        $display = '';
                    }; ?>

                    
                    <li>
                        <a class="toggle" href=#><?php echo $si." ". $row['header'] ?></a>
                        <div class="inner <?php echo $show ?>" <?php echo $display ?>> 
                        <div class="">
                            <table class="table align-items-center mb-0 tableLine">
                        <?php 
                        $sl2 =0;
                        //    pr($getRatePlanByRoomId);
                        foreach($getRatePlanByRoomId as $key=>$val){
                            $sl2++;
                                $rdid = $getRatePlanByRoomId[$key]['id'];
                                $rateplantitleid=$getRatePlanByRoomId[$key]['title'];
                                $rateplanname = getSysPropertyRatePlaneList($rateplantitleid)[0]['srtcode'];
                                ?>
                                <tr style="height: 100px;">
                                    <td width='5%' class="center">
                                    <b> <?php echo $sl2 ?></b>
                                        
                                    </td>
                                    <td width='15%'>
                                        <span class="db" style="margin-bottom: 5px;"><?php echo $rateplanname ?></span>
                                        <span class="tableHoverShow">
                                            <i data-tooltip-top="Rate"><img class="rate_update in_btn edit btn bg-gradient-success dib mr8" data-id="<?php echo $rdid ?>" data-rid="<?php echo $room_id ?>" src="<?php echo FRONT_SITE_IMG.'/icon/edit.png' ?>" alt=""></i>
                                            <!-- <img class="reload_rate in_btn remove" data-id="<?php echo $rdid ?>" data-rid="<?php echo $room_id ?>" src="<?php echo FRONT_SITE_IMG.'/icon/reload.png' ?>" alt=""> -->
                                        </span>
                                    </td>
                                    <?php
                                    
                                    

                                    
                                    for($i=1;$i<=10;$i++){
                                        $day = $current_date + ($i * $oneDay) - $oneDay;
                                        $active = 1;
                                        $rateData2 = '';
                                        $statusCheck = inventoryCheck(date('Y-m-d',$day));
                                        $dateCheck = date('Y-m-d',$day);
                                        if($statusCheck == 0){
                                            $statusClass = 'deactivate';
                                        }else{
                                            $statusClass = 'activate';
                                        }
                                        
                                        $id = $val['id'];
                                        $date = date('Y-m-d',$day);
                                        if($val['singlePrice'] != 0){
                                            $price = getRoomPriceById($room_id,$rdid,1,$dateCheck);
                                            $rateData = "
                                            <div class='inventoryRateContent'>
                                                <div class='inventoryRateBox'>
                                                    <i class='fas fa-user'></i> 
                                                    <input data-date='$dateCheck' data-rid='$room_id' data-rdid='$rdid' data-adult='1' type='text' value='$price' class='inlineRoomPrice db inventoryInput'>
                                                </div>
                                            </div>"; 
                                        }
                                        if($val['doublePrice'] != 0){
                                            $price = getRoomPriceById($room_id,$rdid,2,$date);
                                            $rateData2 = "<div class='inventoryRateContent'>
                                                            <div class='inventoryRateBox'>
                                                                <i class='fas fa-user-friends'></i> 
                                                                <input data-date='$dateCheck' data-rid='$room_id' data-rdid='$rdid' data-adult='2' type='text' value='$price' class='inlineRoomPrice db inventoryInput'>
                                                            </div>
                                                        </div>"; 
                                        }

                                        echo "
                                            <td width='8%' class='center $statusClass'>
                                                <div class='content'>$rateData $rateData2</div>
                                            </td>
                                        ";
                                        
                                    } 
                                
                                    
                                    ?>

                                </tr>

                        <?php  } ?> </table> </div>
                        </div>
                        
                    </li> 
                    <?php

                    }

                }
            ?>
    

    </ul>


<?php }else{ ?>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0 tableLine">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Room</th>
                    <?php
                    

                        for($i=1;$i<=10;$i++){                            
                            $day = $current_date + ($i * $oneDay) - $oneDay;
                            $inDay = date('d-M', $day);
                            $statusCheck = inventoryCheck(date('Y-m-d',$day));                          
                                                        
                            if($statusCheck == 0){
                                $statusClass = 'deactivate';
                            }else{
                                $statusClass = 'activate';
                            }
                            echo "
                                <th class='$statusClass '>$inDay</th>
                            ";
                        }

                    ?>
                </tr>
                    </thead>
                <?php
                    $si = 0;
                    $sql = mysqli_query($conDB, "select * from room where hotelId = '$hotelId'");
                    if(mysqli_num_rows($sql)>0){
                        while($row = mysqli_fetch_assoc($sql)){
                            $room_id = $row['id'];
                            $si++; ?>
                                <tr style="height: 100px;">
                                    <td class="mb-0 text-xs">
                                        <span><b><?php echo $si ?></b></span>
                                        
                                    </td>
                                    <td class="mb-0 text-xs">
                                        <span class="db bold"><?php echo $row['header'] ?></span> <br/> 
                                        <span class="tableHoverShow">
                                            <i data-tooltip-top="Inventory" ><img class="room_update in_btn edit btn bg-gradient-success dib mr8" data-id="<?php echo $room_id ?>" src="<?php echo FRONT_SITE_IMG.'icon/edit.png' ?>" alt=""></i>
                                            <!-- <img class="room_reload in_btn remove" data-id="<?php echo $room_id ?>" src="<?php echo FRONT_SITE_IMG.'icon/reload.png' ?>" alt=""> -->
                                            <i data-tooltip-top="Block" ><img class="room_block in_btn remove btn bg-gradient-danger " data-id="<?php echo $room_id ?>" src="<?php echo FRONT_SITE_IMG.'icon/block.png' ?>" alt="" style="padding: 7px;"></i>
                                        </span>
                                    </td>
                                <?php
                                
                                $oneDay = strtotime('1 day 30 second', 0);

                                for($i=1;$i<=10;$i++){
                                    $day = $current_date + ($i * $oneDay) - $oneDay; 
                                    $room = roomExist($room_id,date('Y-m-d',$day),date('Y-m-d',$current_date + ($i * $oneDay)));
                                    $active = 1;
                                    $countBookRoom = countTotalBooking($room_id,date('Y-m-d',$day));
                                    $countQPBookRoom = countTotalQPBooking($room_id,date('Y-m-d',$day));

                                    $roomPrice = getRoomLowPriceByIdWithDate($room_id, date('Y-m-d',$day));
                                    $advancePayOpPrice = settingValue()['advancePay'];
                                    
                                    if($roomPrice > $advancePayOpPrice && $advancePayOpPrice != 0){
                                        $bookRoom = ($countQPBookRoom > 0) ? "<span class='bookRoom bg-gradient-primary '>".$countQPBookRoom."</span>": "";
                                       
                                    }else{
                                        $bookRoom = ($countBookRoom > 0) ? "<span class='bookRoom bg-gradient-info'>".$countBookRoom."</span>" : "";
                                        
                                    }

                                    // $bookRoom = ($countBookRoom > 0) ? "<span class='bookRoom bg-gradient-info'>".$countBookRoom."</span>" : "";

                                    
                                    $dateCheck = date('Y-m-d',$day);
                                    $statusCheck = inventoryCheck($dateCheck, $room_id);
                                    
                                    

                                    if($statusCheck == 0){
                                        $statusClass = 'deactivate';
                                    }else{
                                        $statusClass = 'activate';
                                    }
                                    
                                    if($room == 0){
                                        $statusClass = 'deactivate';
                                    }


                                    
                                    // if($countBookRoom == '' && $countQPBookRoom == ''){
                                    //     $bookRoom = '';
                                    // }
                                    
                                    

                                    echo " 
                                        <td class='center $statusClass'> 
                                            <span class='inventorySpan'><input data-date='$dateCheck' data-rid='$room_id' class='inlineRoomNo inventoryInput' type='text' name='inlineRoomNo' value='$room'></span>
                                            $bookRoom
                                        </td>
                                    ";
                                }
                                
                                ?>
                            </tr>
                        <?php }
                    }
                ?>
            </table>
        </div>
    </div>


<?php } ?>