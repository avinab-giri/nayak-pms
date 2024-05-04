<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_room.php');
$obj = new add_to_room();
$site = SERVER_INCLUDE_PATH;

// pr($_POST);

if(isset($_POST['type'])){
    $type = $_POST['type'];

    function addExpenseForm($eid = ''){
        
        global $conDB;
        $expenseDate = '';
        $expenseBId = '';
        $expenseRoomNum = '';
        $expenseFile ='';
        $expenseAmount = '';
        $expensePayMode = '';
        $expenseNote = '';
        $expenseAddBy = '';
        $expenseAddOn = '';
        $expenseType = '';
        $btn = 'Add Room';
        $header_text = 'Add Room';

        $imgSize = '(900 x 1060)';
        $formBtn ='manageForm';

        if($eid != ''){
            $expenseArry = getExpenseData($eid)[0];
            $expenseDate = $expenseArry['date'];
            $expenseBId = $expenseArry['bookingId'];
            $expenseType = $expenseArry['type'];
            $expenseRoomNum = $expenseArry['roomNum'];
            $expenseFile = $expenseArry['file'];
            $expenseAmount = $expenseArry['amount'];
            $expensePayMode = $expenseArry['paymentMode'];
            $expenseNote = $expenseArry['note'];
            $expenseAddBy = $expenseArry['addBy'];
            $expenseAddOn = $expenseArry['addOn'];
            $formBtn ='manageForm';
            $header_text = 'Update Room';
            $btn = 'Update Room';
            $formBtn ='updateManageForm';
        }

        $expenseTypeHtml = "<option disabled selected >Choose Expense Type</option>";
        $imgBoxContent =''; 
        $modeOfPayment = '';
        
        foreach(getExpenseTypeData() as $expenseList){
            $expenseTypeId = $expenseList['id'];
            $expenseTypeName = $expenseList['name'];
            if($expenseTypeId == $expenseType){
                $expenseTypeHtml .="<option selected value='$expenseTypeId'>$expenseTypeName</option>";
            }else{
                $expenseTypeHtml .="<option value='$expenseTypeId'>$expenseTypeName</option>";
            }
        };

        foreach(getPaymentTypeMethod('','yes') as $expenseList){
            $paymentTypeId = $expenseList['id'];
            $paymentTypeName = $expenseList['name'];
            if($paymentTypeId == $expensePayMode){
                $modeOfPayment .="<option checked value='$paymentTypeId'>$paymentTypeName</option>";
            }else{
                $modeOfPayment .="<option value='$paymentTypeId'>$paymentTypeName</option>";
            }
        };


        if($eid != ''){
            $imgBoxContent =  "<div class='row p0'>";
            $imageSql = mysqli_query($conDB, "select * from room_img where room_id= {$eid}");

            while($image_row = mysqli_fetch_assoc($imageSql)){

                $img_path = FRONT_SITE_ROOM_IMG.$image_row['image'];
                $img_remove_path = FRONT_BOOKING_SITE.'/admin/manage-room.php?removeImage='.$image_row['id'];

                $imgBoxContent .=  "
                    
                    <div class='img_old'>
                        <a href='$img_remove_path'>X</a>
                        <img src='$img_path' >
                    </div>
                    
                ";
            }
            $imgBoxContent .=  "</div> <br/>";
            
            $imgBoxContent .=  '
            
                    <div class="form_group col-md-12 col-sm-12 mb-3">
                        <label for="roomImage">Room Image '.$imgSize.'</label>
                        <input class="form-control checkRoomImg" type="file" accept="image/jpeg" id="roomImage" accept="image/png, image/jpeg" name="roomImage">
                        <span id="errorImage1"></span>
                    </div>
                    
            
            ';
        }else{
            $imgBoxContent .=  '
            
            
                <div class="form_group col-md-12 col-sm-12 mb-3">
                    <label for="roomImage">Room Image '.$imgSize.'</label>
                    <input class="form-control checkRoomImg" type="file" accept="image/jpeg" id="roomImage" accept="image/png, image/jpeg" name="roomImage">
                    <span id="errorImage"></span>
                </div>
                
            
            ';
        }

        $exInputField = '';

        if($eid != ''){
            $exInputField .=  '<input type="hidden" value="update_room" name="type">';
            $exInputField .= "<input type='hidden' value='$uid' name='update_id'>";
        }else{
            $exInputField .= '<input type="hidden" value="add_room" name="type">';
        }
        $amenitiesField = '';
        $hotelId = $_SESSION['HOTEL_ID'];
        $query = "select * from amenities where hotelId = '$hotelId'";
        $sql = mysqli_query($conDB, $query);

        $roomRateField = '';
        

        
        
            $html = '
            
                <form action="" id="'.$formBtn.'" method="post" enctype="multipart/form-data">



                    <div class="row p0">

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="expenseDate">Date Of Expense</label>
                            <input class="form-control" type="date" id="expenseDate" name="expenseDate" value="'.$expenseDate.'">
                        </div>

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="referenceBookingId">Booking Reference No</label>
                            <input class="form-control" type="text" id="referenceBookingId" name="referenceBookingId"
                                placeholder="Enter Booking No" value="'.$expenseBId.'">
                        </div>

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="expenseType">Expense Type</label>
                            <select class="form-control" name="expenseType" id="expenseType" required>
                                '.$expenseTypeHtml.'
                            </select>
                        </div>

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="roomNum">Room Number</label>
                            <select class="form-control" type="text" id="roomNum" name="roomNum" disabled>
                                <option>Select Room Number</option>
                            </select>
                        </div>

                        '.$imgBoxContent.'

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="expenseAmount">Expense Amount</label>
                            <input class="form-control" type="number" id="expenseAmount" name="expenseAmount"
                                placeholder="Enter Expense Amount." value="'.$expenseAmount.'" required>
                        </div>

                        <div class="form_group col-12 col-sm-6 mb-3">
                            <label for="modeOfPayment">Mode of Payment</label>
                            <select class="form-control" name="modeOfPayment" id="modeOfPayment" required> 
                                '.$modeOfPayment.'
                            </select>
                        </div>

                        <div class="form_group col-12 mb-3">
                            <label for="expenseNote">Expense Note</label>
                            <textarea class="form-control" name="expenseNote" id="expenseNote">'.$expenseNote.'</textarea>
                        </div>

                    </div>



                    <div id="add_content"></div>
                    <div class="s25"></div>
                    <button class="btn bg-gradient-primary mb-0 mt-lg-auto deactive" type="submit"
                        name="addRoom">
                        '. $btn.'
                    </button>
                </form>
            
            ';

        return $html;
    }


    if($type == 'loadExpenseList'){

        $si = 0;
        $sql = mysqli_query($conDB, "select * from room where hotelId = '$hotelId' and deleteRec = '1'");
        $expenseRowData = '';

        foreach(getExpenseData() as $expenseList){
            $id = $expenseList['id'];
            $hotelId = $expenseList['hotelId'];
            $date = date('d-M, Y', strtotime($expenseList['date']));
            $bookingId = ($expenseList['bookingId'] == '')? 'Null' : $expenseList['bookingId'];
            $type = $expenseList['type'];
            $roomNum = $expenseList['roomNum'];
            $file = $expenseList['file'];
            $amount = $expenseList['amount'];
            $paymentMode = $expenseList['paymentMode'];
            $note = $expenseList['note'];
            $addBy = $expenseList['addBy'];

            $imgCon = ($file == '') ? FRONT_SITE_IMG.'demo/bill.png': FRONT_SITE_IMG.'expense/'.$file; 

            $imgShowBtn = ($file == '') ? '': 'showImg'; 
            
            $printBtn = '
            
            <a href="javascript:void(0)">
            
                <div class="d-flex mb-2">
                    <div
                        class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                        <svg style="fill: white;padding: 3px;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 5 3 C 3.9069372 3 3 3.9069372 3 5 L 3 19 C 3 20.093063 3.9069372 21 5 21 L 19 21 C 20.093063 21 21 20.093063 21 19 L 21 5 C 21 3.9069372 20.093063 3 19 3 L 5 3 z M 5 5 L 19 5 L 19 19 L 5 19 L 5 5 z M 14 7 L 14 9 L 17 9 L 17 7 L 14 7 z M 8.4355469 7.0019531 C 7.9755469 6.9829531 7.5543438 7.211125 7.2773438 7.578125 C 6.3113437 8.854125 8.1403125 10.347047 8.5703125 10.748047 C 8.8273125 10.988047 9.1469375 11.273406 9.3359375 11.441406 C 9.4309375 11.526406 9.5710156 11.526406 9.6660156 11.441406 C 9.8560156 11.272406 10.172688 10.987047 10.429688 10.748047 C 10.859687 10.347047 12.688656 8.854125 11.722656 7.578125 C 11.444656 7.211125 11.024453 6.9829531 10.564453 7.0019531 C 9.8794531 7.0299531 9.5 7.5214844 9.5 7.5214844 C 9.5 7.5214844 9.1205469 7.0299531 8.4355469 7.0019531 z M 12 11 L 12 13 L 17 13 L 17 11 L 12 11 z M 7 15 L 7 17 L 17 17 L 17 15 L 7 15 z"/></svg>
                    </div>
                    <p class="text-xs mt-1 mb-0 font-weight-bold">Print</p>
                </div>
            
            </a>
            
            ';

            $expenseRowData .= "
                
                    <tr>
                        <td class='center'><div class='$imgShowBtn'><img width='80px' src='$imgCon'/></div></td>
                        <td class='text-sm  mb-0 bold'>{$date}</td>
                        <td class='center mb-0 text-secondary'>{$bookingId}</td>
                        <td class='text-sm text-secondary mb-0'>Rs {$amount}</td>
                        <td class='text-sm text-secondary mb-0'>{$note}</td>
                       
                    </tr>
                
                ";
        }

        if($expenseRowData == ''){
            $expenseRowData .= "
                
                    <tr>
                        <td class='center'>No Data</td>
                        
                    </tr>
                
                ";
        }
        // <td class='text-sm text-secondary mb-0'>{$printBtn}</td>
        // <th width="30%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
        $html = '
        
                <table class="table align-items-center mb-0 tableLine">
                    <tr>
                        <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                        <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                        <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Id</th>
                        <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                        <th width="30%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
        
                    </tr>
                    '.$expenseRowData.'
                </table>
        
        ';

        echo $html;
    }
   
    if($type == 'showAddExpenseForm'){
        echo addExpenseForm();
    }


    if($type == 'add_expense'){

        
        $expenseDate = $_POST['expenseDate'];
        $referenceBookingId = $_POST['referenceBookingId'];
        $expenseType = $_POST['expenseType'];
        $roomNum = '';
        if(isset($_POST['roomNum'])){
            $roomNum = $_POST['roomNum'];
        }
        $expenseAmount = $_POST['expenseAmount'];
        $modeOfPayment = $_POST['modeOfPayment'];
        $expenseNote = $_POST['expenseNote'];

        $image = $_FILES['roomImage']['name'];

        $added_on = $_SESSION['ADMIN_ID'];
        $hotelId = $_SESSION['HOTEL_ID'];

        if($image == ''){
            $sql = "insert into expense(hotelId,date,bookingId,type,roomNum,amount,paymentMode,note,addBy) values('$hotelId','$expenseDate','$referenceBookingId','$expenseType','$roomNum','$expenseAmount','$modeOfPayment','$expenseNote','$added_on')";
        }else{

            $fileName = imgUploadWithData($_FILES['roomImage'],'expense')['img'];
            $sql = "insert into expense(hotelId,date,bookingId,type,roomNum,amount,paymentMode,note,addBy,file) values('$hotelId','$expenseDate','$referenceBookingId','$expenseType','$roomNum','$expenseAmount','$modeOfPayment','$expenseNote','$added_on','$fileName')";

            
        }
        
        if(mysqli_query($conDB, $sql)){
            echo 1;
        }
        

        
    
        

    
    }

    if($type == 'showRoomNumber'){
        $bvid = $_POST['bid'];
        $bid = getBookingIdByBVID($bvid);
        $bookingArry = getBookingData($bid);
        
        $html = '<option>Select Room Number</option>';

        foreach($bookingArry as $bookingList){
            $roomNum = $bookingList['room_number'];
            $html .= "<option val='$roomNum'>$roomNum</option>";
        }

        echo $html;

    }

   
}


?>