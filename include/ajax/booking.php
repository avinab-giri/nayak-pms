<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_room.php');
$obj = new add_to_room();
$hotelId = $_SESSION['HOTEL_ID'];
$type = $_POST['type'];


if($type == 'load_book'){
  
    $si = 0;
    $pagination = '';
    $paymentStatus = $_POST['paymentStatus'];
    $page = $_POST['page_no'];
    
    echo '
    <div class="table table-responsive">
        <table border="1" class="table align-items-center mb-0 tableLine">
        <tr>
            <th style="width:5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl</th>
            <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Date</th>
            <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking ID</th>
            <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room Num</th>
            <th style="width:25%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment</th>
            <th style="width:20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Person Details</th>
        </tr>

        <tbody>
    ';
    
    if (count(getAllBooingData()) === 0) {
        echo "

                <tr>
                
                    <td colspan='13'> No Data </td>
                
                </tr>
            
            ";
   }else{
        $si =0;
        foreach(getAllBooingData($page,$paymentStatus) as $bookList){
           
            $bid = $bookList['id'];
            $bookId = $bookList['bookinId'];
            $si ++;
            $time = '';
            $booingAllDataArry = getBookingDetailById($bid);
            $guestId = $booingAllDataArry['guest'][0];
            $guestDataArry = getGuestDetail($bid,1,'','','asc')[0];
           

            $guestName = ($guestDataArry['name'] == '')? 'Null' : $guestDataArry['name'];
            $guestEmail = ($guestDataArry['email'] == '')? 'Null' : $guestDataArry['email'] ;
            $guestPhone =( $guestDataArry['phone'] == '')? 'Null' :  $guestDataArry['phone'];
            $guestComName = ($guestDataArry['company_name'] == '')? '' : $guestDataArry['company_name'];
            $guestComGst = ($guestDataArry['comGst'] == '') ? '' : $guestDataArry['comGst'];
           

            $price = $booingAllDataArry['totalPrice'];      
            $userPay = $bookList['userPay'];   

            $roomNum = $booingAllDataArry['roomNum'];  

            $addOn = date('d-M-Y', strtotime($bookList['add_on']));   
            
            
            $paymentPer = getPercentageValueByAmount($userPay,$price);

            $invoice = FRONT_BOOKING_SITE .'/voucher?oid='.  $bid ;
            $invoice_email = FRONT_BOOKING_SITE .'/email_send.php?oid='.  $bid ;
            $voucher_url = FRONT_BOOKING_SITE .'/voucher?vid='.  $bid ;



            $url = FRONT_BOOKING_SITE."/admin/booking.php?remove={$bid}";
            
            if($bookList['status'] == '0'){
                $remove = 'class="remove"';
            }else{
                $remove = '';
            }
            $voucher = '';

            if($bookList['payment_status'] == '1'){
                $remove_book = '';
                $email = "<a href='$invoice_email'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/email2.png' ></a>";
                $voucher = "<a href='$voucher_url'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/voucher.png' ></a>";
            }else{
                if($bookList['status'] == '1'){
                    $remove_book = "<a class='removeBooking' data-id='$bid' data-page='$page' data-status='0' style='display: inline-block;cursor: pointer;'>
                    <img style='width:25px;padding: 10px 0px;' src='img/icon/delete.png'></a>";
                }else{
                    $remove_book = '';
                }
                $email = '';
            }
            
            
            
            $checkIn = '';
            $checkOut = '';
            
            if($bookList['payment_id'] == ''){
                $paymentId = 'N/A';
            }else{
                $paymentId = $bookList['payment_id'];
            }
            
            $couponHtml = '';
            
            if($bookList['couponCode'] != ''){
                $couponHtml = '
                
                    <span style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="C: '.$bookList['couponCode'].' "> <img style="width:20px; opacity:.5" src="img/icon/couponIcon.png"> </span>
                
                ';
            }
            $numPrice = number_format($price);
            $numberUserPay = number_format($userPay);

            echo "

                <tr $remove>
                
                    <td style='text-align:center'> 
                        <span class='no_box roomDetail' data-bid='$bid'><b style='font-size: 11px;'>$si</b></span> 
                        
                        <span style='display: flex;padding: 10px 0 0;'>
                            <a href='$invoice'><img style='display: block;width: 20px;' src='img/icon/pdf.png'></a>
                            $email
                            $voucher
                        </span>
                        
                    </td>
                    <td class='mb-0 text-sm'> $addOn </td>
                    <td class='mb-0 text-sm'> $bookId <br/> $remove_book </td>

                    <td class='mb-0 text-sm'> $roomNum </td>
                    
                    <td class='mb-0 text-sm'>
                        <ul>
                            <li style='display:block'>
                                <strong>Gross Ch.:</strong>
                                <small>₹ $numPrice</small> $couponHtml
                            </li>
                            <li style='display:block'>
                                <small>$paymentPer% Paid:</small>
                                <strong>₹ $numberUserPay</strong>
                            </li>
                        </ul>                      
                        
                    </td>
                    
                    <td class='mb-0 text-sm'>
                        <dl style='text-align: left;'>
                        <dt><strong>Name:</strong></dt>
                        <dd style='padding-left: 12px;'>{$guestName}</dd>
                        </dl>
                        
                        <div class='personDetailBtn'> More Detail <strong class='text-primary text-gradient mb-0 cp'>Click Here </strong> </div>
                        
                        <div style='display:none' class='personDetailContent'>
                            <dl style='text-align: left;'>
                            <dt><strong>Phone:</strong></dt>
                            <dd style='padding-left: 12px;'>{$guestPhone}</dd>
                            <dt><strong>Email:</strong></dt>
                            <dd style='padding-left: 12px;'>{$guestEmail}</dd>
                            $guestComName $guestComGst
                            </dl>
                            
                        </div>
                    </td>
                    
                    
                
                    
                
                </tr>
            
            ";
        }
   }


    $pagination = '';
    $paginationSql = "select * from booking where hotelId = '$hotelId'";
    $query = mysqli_query($conDB, $paginationSql);
    $total_row = mysqli_num_rows($query);
    $total_page = ceil($total_row / 10);
    
    for($i=1;$i<=$total_page;$i++){
        
        if($page == $i){
            $pagination .= "<li class='page-item active'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }else{
            $pagination .= "<li class='page-item'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }
    }

    echo '
        </tbody>
        </table> </div>
        <div class="s25"></div>
        <ul id="pagination" class="pagination pagination-sm pagination-primary">
            '.$pagination.'
        </ul>
    ';
}

if($type == 'load_quickPay'){

    $si = 0;
    $pagination = '';

    echo '
        <div class="table-responsive">
            <table border="1" class="table align-items-center mb-0 tableLine">
            <tr>
                <th style="width:5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl</th>
                <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Date</th>
                <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pay ID</th>
                <th style="width:25%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                <th style="width:20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Person Details</th>
                <th style="width:20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room Details</th>
            </tr>

            <tbody></tbody>
    ';
    $sql = "select * from quickpay where id !=''";
    
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql .= " and name LIKE '%$search%' or email LIKE '%$search%' or orderId LIKE '%$search%' or paymentId LIKE '%$search%'";
    }
    
    
    $limit_per_page = 10;
    
    $page = '';
    if(isset($_POST['page_no'])){
        $page = $_POST['page_no'];
    }else{
        $page = 1;
    }
    
    if(isset($_POST['paymentStatus'])){
        $paymentStatus = $_POST['paymentStatus'];
        $sql .= " and paymentStatus= '$paymentStatus'";
    }
    
    $offset = ($page -1) * $limit_per_page;
    
    $qpsql = $sql;
    
    $sql .= " ORDER BY `addOn` DESC limit {$offset}, {$limit_per_page}";

    
    $query = mysqli_query($conDB, $sql);
    $si = $si + ($limit_per_page *  $page) - $limit_per_page;
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            
            $bid = $row['id'];
            $bookId = $row['orderId'];
            $si ++;
            

            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $roomId = $row['room'];
            $roomDId = $row['room_id'];
            $payble = $row['amount'];
            $orderId = $row['orderId'];
            $paymentStatus = $row['paymentStatus'];
            $addOn = date('d-M-Y', strtotime($row['addOn'])); 
            $totalPrice = $payble;
            $grossCharge = $row['totalAmount'];
            
            $invoice = FRONT_BOOKING_SITE .'/download_invoice.php?qpid='.  $row['id'] ;
            $invoice_email = FRONT_BOOKING_SITE .'/email_send.php?qpid='.  $row['id'] ;
            $voucher_url = FRONT_BOOKING_SITE .'/download_invoice.php?qpvid='.  $row['id'] ;
            
            $paymentPer = '';
            
            if($row['paymentStatus'] == 'complete'){
                $pay_status = '<div class="d-flex align-items-center">
                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                <span>Paid</span>
                </div>';
                if($grossCharge != '' && $grossCharge >= $payble){
                    $paymentPer = getPercentageValueByAmount($payble,$grossCharge).'%';
                    $grossInputField = "
                        <dd style='padding-left: 12px;'>
                            <span>₹ $grossCharge</span>
                        </dd>
                    ";
                }else{
                    $grossInputField = "
                        <dd style='padding-left: 12px;'>
                            <div class='grossChargeContent' style='display: flex;justify-content: flex-start;align-items: center;padding: 10px 0;'>
                                <img data-qpid='$bid' data-page='$page' value='$grossCharge' class='editGrossCharge' style='width: 25px;' src='img/icon/editIcon.png'/>
                                <span>$grossCharge</span>
                            </div>
                        </dd>
                    ";
                }
                $grossInput = "
                    <dl style='text-align: left;'>
                        <dt><strong>Gross Charge:</strong></dt>
                        $grossInputField
                    </dl>
                    <dl style='text-align: left;'>
                        <dt>$paymentPer<strong> Paid:</strong></dt>
                      <dd style='padding-left: 12px;'>₹ $payble</dd>
                    </dl>
                ";
            }else{
                $pay_status = '<div class="d-flex align-items-center">
                <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                <span>Failed</span>
                </div>';
                $grossInput ="<dl style='text-align: left;'>
                                <dt><strong>Amount:</strong></dt>
                                <dd style='padding-left: 12px;'>₹ $payble</dd>
                            </dl>";
            }
            
            $url = FRONT_BOOKING_SITE."/admin/booking.php?remove={$row['id']}";
            

            $voucher = '';
            
            
            
            if($row['paymentId'] == ''){
                $paymentId = 'N/A';
            }else{
                $paymentId = $row['paymentId'];
            }
            $roomDetailContent = 'N/A';

            

            if($row['room'] != 0){
                $room_name = getRoomNameById($roomId);
                $roomPrice = $row['roomPrice'];
                $gst = getGSTPrice($roomPrice);
                $totalPrice = $roomPrice + $gst;
                $gstpercentage = getGSTPercentage($roomPrice);
        
                $priceSection = "
                    $grossInput
                    
                ";
                $roomDetailContent = "
                
                <dl style='text-align: left;'>
                    <dt><strong>Room:</strong></dt>
                    <dd style='padding-left: 12px;'>$room_name</dd>
                </dl>
              
              
                ";
            }else{
                $priceSection = "
                      <dd style='padding-left: 12px;'>₹ $payble</dd>
                    </dl>
                ";
            }

            if($row['paymentStatus'] == 'complete'){
                $remove_book = '';
                $emailContent = "<a href='$invoice_email'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/email2.png' ></a>";
                $voucher = "<a href='$voucher_url'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/voucher.png' ></a>";
            }else{
                $emailContent  = '';
            }

            $invoiceContent = "
                    <span style='display: flex;padding: 10px 0 0;'>
                        <a class='toggleGross' style='opacity:.6' href=''><img style='display: block;width: 20px;' src='img/icon/pdf.png'></a>
                        $emailContent
                        <a class='toggleGross' style='opacity:.6' href=''><img style='padding: 2px;display: block;width: 20px;' src='img/icon/voucher.png' ></a>
                    </span>
                ";
            
            if($grossCharge != '' && $grossCharge >= $payble){
                $invoiceContent = "
                    <span style='display: flex;padding: 10px 0 0;'>
                        <a href='$invoice'><img style='display: block;width: 20px;' src='img/icon/pdf.png'></a>
                        $emailContent
                        $voucher
                    </span>
                ";
            }
            
            echo "

                <tr>
                
                    <td style='text-align:center'> 
                        <span class='no_box mb-0 text-xs'><b>$si</b></span> 
                        $invoiceContent
                        
                    </td>
                    <td class='mb-0 text-xs'> $addOn </td>
                    <td class='mb-0 text-xs'> $bookId <br/> </td>
                    
                    <td class='mb-0 text-xs'>
                        $priceSection
                    </td>
                    
                    <td class='mb-0 text-xs'>
                        <dl style='text-align: left;'>
                          <dt><strong>Name:</strong></dt>
                          <dd style='padding-left: 12px;'>{$row['name']}</dd>
                        </dl>
                        
                        <div class='personDetailBtn'> More Detail <strong class='text-primary text-gradient mb-0 cp'>Click Here </strong> </div>
                        
                        <div style='display:none' class='personDetailContent'>
                            <dl style='text-align: left;'>
                              <dt><strong>Phone:</strong></dt>
                              <dd style='padding-left: 12px;'>{$row['phone']}</dd>
                              <dt><strong>Email:</strong></dt>
                              <dd style='padding-left: 12px;'>{$row['email']}</dd>
                             
                            </dl>
                            
                        </div>
                    </td>
                    
                    <td class='mb-0 text-xs'>

                        $roomDetailContent
                            
                    </td>
                    
                    
                    
                
                </tr>
                
                
            
            ";
        }
    }else{
        echo "

                <tr>
                
                    <td colspan='13'> No Data </td>
                
                </tr>
            
            ";
    }


    
                
    
    $total_row = mysqli_num_rows(mysqli_query($conDB,$qpsql));
    $total_page = ceil($total_row / 10);
    
    for($i=1;$i<=$total_page;$i++){
        
        if($page == $i){
            $pagination .= "<li class='page-item active'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }else{
            $pagination .= "<li class='page-item'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }
    }

    echo '
        </table> </div>
                    <div class="s25"></div>
        <ul id="qppagination" class="pagination pagination-sm pagination-primary">
            '.$pagination.'
        </ul>
    ';
}

if($type == 'load_wibooking'){

    $si = 0;
    $pagination = '';

    echo '
    <div class="table table-responsive">
        <table border="1" class="table align-items-center mb-0 tableLine">
        <tr>
            <th style="width:5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl</th>
            <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Date</th>
            <th style="width:10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking ID</th>
            <th style="width:25%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment</th>
            <th style="width:20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Person Details</th>
        </tr>

        <tbody>
    ';
    $sql = "select booking.*,bookingdetail.checkIn from booking,bookingdetail where booking.booking_type=2 and booking.id = bookingdetail.bid";
    
    if(isset($_POST['date'])){
        $date = $_POST['date'];
        $dateArr = explode('/',$date);
        $dateStr = $dateArr['2'].-$dateArr['0'].-$dateArr['1'];
        $sql .= " and bookingdetail.checkIn<='{$dateStr}' and bookingdetail.checkOut>='{$dateStr}'";
    }
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql .= " and booking.status='1' and booking.payment_status= 'complete' and booking.name LIKE '%$search%' or booking.email LIKE '%$search%' or booking.bookinId LIKE '%$search%' or booking.payment_id LIKE '%$search%'";
    }
    
    
    $limit_per_page = 10;
    
    $page = '';
    if(isset($_POST['page_no'])){
        $page = $_POST['page_no'];
    }else{
        $page = 1;
    }
    
    $offset = ($page -1) * $limit_per_page;
    
    $qpsql = $sql;
    
    $sql .= " ORDER BY booking.id DESC limit {$offset}, {$limit_per_page}";

    $query = mysqli_query($conDB, $sql);
    $si = $si + ($limit_per_page *  $page) - $limit_per_page;
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
          
            $bid = $row['id'];
            $bookId = $row['bookinId'];
            $si ++;
            $time = '';

            $price = $row['grossCharge'];      
            $userPay = $row['userPay'];   

            $addOn = date('d-M-Y', strtotime($row['add_on']));   
            
            
            $paymentPer = getPercentageValueByAmount($userPay,$price);

            $invoice = FRONT_BOOKING_SITE .'/download_invoice.php?oid='.  $row['id'] ;
            $invoice_email = FRONT_BOOKING_SITE .'/email_send.php?oid='.  $row['id'] ;
            $voucher_url = FRONT_BOOKING_SITE .'/download_invoice.php?vid='.  $row['id'] ;
            
            
            if($row['payment_status'] == 'complete'){
                $pay_status = '<div class="d-flex align-items-center">
                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                <span>Paid</span>
                </div>';
            }else{
                $pay_status = '<div class="d-flex align-items-center">
                <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                <span>Failed</span>
                </div>';
            }
            $url = FRONT_BOOKING_SITE."/admin/booking.php?remove={$row['id']}";
            
            if($row['status'] == '0'){
                $remove = 'class="remove"';
            }else{
                $remove = '';
            }
            $voucher = '';

            if($row['payment_status'] == 'complete'){
                $remove_book = '';
                $email = "<a href='$invoice_email'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/email2.png' ></a>";
                $voucher = "<a href='$voucher_url'><img style='padding: 2px;display: block;width: 20px;' src='img/icon/voucher.png' ></a>";
            }else{
                if($row['status'] == '1'){
                    $remove_book = "<a class='removeBooking' data-id='$bid' data-page='$page' data-status='0' style='display: inline-block;cursor: pointer;'>
                    <img style='width:25px;padding: 10px 0px;' src='img/icon/delete.png'></a>";
                }else{
                    $remove_book = '';
                }
                $email = '';
            }
            
            
            if($row['company_name'] == ''){
                $company = '';
            }else{
                $company= $row['company_name'];
            }
            
            if($row['comGst'] == ''){
                $companygst = '';
            }else{
                $companygst= $row['gst'];
            }
            $checkIn = '';
            $checkOut = '';
            
            if($row['payment_id'] == ''){
                $paymentId = 'N/A';
            }else{
                $paymentId = $row['payment_id'];
            }
            
            $couponHtml = '';
            
            if($row['couponCode'] != ''){
                $couponHtml = '
                
                    <span style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="C: '.$row['couponCode'].' "> <img style="width:20px; opacity:.5" src="img/icon/couponIcon.png"> </span>
                
                ';
            }
            $numPrice = number_format($price);
            $numberUserPay = number_format($userPay);
            echo "

                <tr $remove>
                
                    <td style='text-align:center'> 
                        <span class='no_box roomDetail' data-bid='$bid'><b style='font-size: 11px;'>$si</b></span> 
                        
                        <span style='display: flex;padding: 10px 0 0;'>
                            <a href='$invoice'><img style='display: block;width: 20px;' src='img/icon/pdf.png'></a>
                            $email
                            $voucher
                        </span>
                        
                    </td>
                    <td class='mb-0 text-sm'> $addOn </td>
                    <td class='mb-0 text-sm'> $bookId <br/> $remove_book </td>
                    
                    <td class='mb-0 text-sm'>
                        <ul>
                            <li style='display:block'>
                                <strong>Gross Ch.:</strong>
                                <small>₹ $numPrice</small> $couponHtml
                            </li>
                            <li style='display:block'>
                                <small>$paymentPer% Paid:</small>
                                <strong>₹ $numberUserPay</strong>
                            </li>
                        </ul>                      
                         
                    </td>
                    
                    <td class='mb-0 text-sm'>
                        <dl style='text-align: left;'>
                          <dt><strong>Name:</strong></dt>
                          <dd style='padding-left: 12px;'>{$row['name']}</dd>
                        </dl>
                        
                        <div class='personDetailBtn'> More Detail <strong class='text-primary text-gradient mb-0 cp'>Click Here </strong> </div>
                        
                        <div style='display:none' class='personDetailContent'>
                            <dl style='text-align: left;'>
                              <dt><strong>Phone:</strong></dt>
                              <dd style='padding-left: 12px;'>{$row['phone']}</dd>
                              <dt><strong>Email:</strong></dt>
                              <dd style='padding-left: 12px;'>{$row['email']}</dd>
                              $company $companygst
                            </dl>
                            
                        </div>
                    </td>
                    
                    
                   
                    
                
                </tr>
            
            ";
        }
    }else{
        echo "

                <tr>
                
                    <td colspan='13'> No Data </td>
                
                </tr>
            
            ";
    }


    
                
    
    $total_row = mysqli_num_rows(mysqli_query($conDB,$qpsql));
    $total_page = ceil($total_row / 10);
    
    for($i=1;$i<=$total_page;$i++){
        
        if($page == $i){
            $pagination .= "<li class='page-item active'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }else{
            $pagination .= "<li class='page-item'>
                                <a class='page-link' href='javascript:;'>$i</a>
                            </li>";
        }
    }

    echo '
        </table> </div>
                    <div class="s25"></div>
        <ul id="qppagination" class="pagination pagination-sm pagination-primary">
            '.$pagination.'
        </ul>
    ';
}

if($type == 'roomDetail'){

        $bid = $_POST['bid'];
        $bookingHtml = '';
        foreach(getBookingData($bid) as $bookingList){
            $bookingAllDataArry = getBookingDetailById($bid);
            $checkIn = $bookingAllDataArry['checkIn'];
            $checkOut = $bookingAllDataArry['checkOut'];
            $paymentId = $bookingAllDataArry['paymentId'];

            $roomNum = $bookingList['room_number'];
            $adult = $bookingList['adult'];
            $child = $bookingList['child'];
            $roomId = $bookingList['roomId'];
            $bookingHtml .= '
                        <li>
                            <h4>'.ucfirst(getRoomHeaderById($roomId)).'</h4>
                            <div class="dFlex">
                                <div class="col">
                                    <img src="img/icon/room.png" alt="">
                                    <span>'.$roomNum.'</span>
                                </div>
                                <div class="col">
                                    <img src="img/icon/adult.png" alt="">
                                    <span>'.$adult.'</span>
                                </div>
                                <div class="col">
                                    <img src="img/icon/child.png" alt="">
                                    <span>'.$child.'</span>
                                </div>
                            </div>
                            <div class="dFlex">
                                <div class="rowCol">
                                    <strong>Check In:</strong>
                                    <span>'.date('d-M-Y', strtotime($checkIn)).'</span>
                                </div>
                                <div class="rowCol">
                                    <strong>Check Out:</strong>
                                    <span>'.date('d-M-Y', strtotime($checkOut)).'</span>
                                </div>
                            </div>
                        </li>
                ';
        }
        


    
    
    $html = '
            <div class="closeSideBar"></div>
            <div class="box">
                <div class="close icon icon-shape bg-gradient-danger shadow text-center border-radius-md">X</div>
                <div class="content">
                    <h2>Booking Details</h2>
                    <p style="margin-bottom: 15px;"><b>Payment Id</b>: '.$paymentId.'</p>
                    <ul>

                        '.$bookingHtml.'

                        

                    </ul>
                </div>
            </div>
    ';

    echo $html;
}

if($type == 'removeBooking'){
    $remove_id = $_POST['bid'];
    $sql ="update booking set status='0' where id = '$remove_id'";
    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'updateGross'){
    $qpid = $_POST['qpid'];
    $price = $_POST['price'];
    
    $sql = "update quickpay set totalAmount = '$price' where id = '$qpid'";
    
    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'changeRoomDetailById'){
    $id = $_POST['id'];
    $html = '';
    foreach(getRatePlanByRoomId($id) as $roomDetailList){
        $id = $roomDetailList['id'];
        $title = $roomDetailList['title'];
        $html .= "<option value='$id'>$title</option>";
    }

    echo $html;
}

if($type == 'changeAdultById'){
    $id = $_POST['id'];
    $html = '';

    for ($i=1; $i <= getRoomCapacityById($id); $i++) { 
        $html .= "<option value='$i'>$i</option>";
    }

    echo $html;
}

// if($type == 'addWalkInBooking'){
//     $checkInDate = $_POST['checkInDate'];
//     $checkOutDate = $_POST['checkOutDate'];
//     $couponCode = $_POST['couponCode'];
//     $roomTypeArry = $_POST['roomType'];
//     $rateTypeArry = $_POST['rateType'];
//     $adultArry = $_POST['adult'];
//     $childArry = $_POST['child'];
//     $guestName = $_POST['guestName'];
//     $guestEmail = $_POST['guestEmail'];
//     $guestNumber = $_POST['guestNumber'];
//     $companyName = $_POST['companyName'];
//     $companyGstNumber = $_POST['companyGstNumber'];

//     $totalPrice = $_POST['totalPrice'];
//     $userPay = $_POST['userPay'];
//     $bid = getBookingNumber();
//     $add_on=date('Y-m-d h:i:s');

//     $sql = "insert into booking(bookinId,booking_type,name,email,phone,company_name,comGst,payment_status,add_on,partial,couponCode,pickUp,grossCharge,userPay) values('$bid','2','$guestName','$guestEmail','$guestNumber','$companyName','$companyGstNumber','complete','$add_on','','$couponCode','','$totalPrice','$userPay')";

//     mysqli_query($conDB, $sql);

//     $lastBId = mysqli_insert_id($conDB);

//     $night = getNightByTwoDates($checkInDate,$checkOutDate);

//     foreach ($roomTypeArry as $key => $value) {
//         $roomType = $roomTypeArry[$key];
//         $rateType = $rateTypeArry[$key];
//         $adult = $adultArry[$key];
//         $child = $childArry[$key];

//         $roomPrice = getRoomPriceById($roomType,$rateType, $adult, $checkInDate);
//         $adultPrice = getAdultPriceByNoAdult($adult,$roomType,$rateType, $checkInDate);
//         $childPrice = getChildPriceByNoChild($child,$roomType,$rateType, $checkInDate);

//         $singleRoomPriceCalculator = SingleRoomPriceCalculator($roomType, $rateType, $adult, $child , 1, $night, $roomPrice, $childPrice , $adultPrice, $couponCode);

//         $gstPer = $singleRoomPriceCalculator[0]['gstPer'];
//         $total = $singleRoomPriceCalculator[0]['total'];

//         $detailSql = "insert into bookingdetail(bid,roomId,roomDId,adult,child,night,checkIn,checkout,roomPrice,adultPrice,childPrice,gstPer,totalPrice) values('$lastBId','$roomType','$rateType','$adult','$child','$night','$checkInDate','$checkOutDate','$roomPrice','$adultPrice','$childPrice','$gstPer','$total')";
//         mysqli_query($conDB, $detailSql);
//     }
// }

?>