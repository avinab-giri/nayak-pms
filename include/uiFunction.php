<?php

function backNavbarUi($backLink = '', $title = '', $rightHtml = '', $leftHtml = ''){

    if ($backLink == '') {
        $backLink = FRONT_SITE;
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
            $backLink = $_SERVER['HTTP_REFERER'];
        }
    }


    $html = '
        <div class="row">
            <div class="col-12 my-1">
                <div class="card">
                    <div class="card-body p-0" style="padding-right: 10px !important;">
                        <div class="dFlex jcsb aic">
                            <div class="left dFlex wAuto aic">
                                
                                <a class="py-3 dFlex backBtnA wAuto" onclick="window.history.back();">
                                <div class="backBtn">
                                    <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                        <g class="arrow-head">
                                            <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                        </g>
                                        <g class="arrow-body">
                                            <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                        </g>
                                    </svg>
                                </div> 
                                </a>

                                <span class="navTitle">' . $title . '</span>
                                ' . $leftHtml . '
                            </div>
                            <div class="right">' . $rightHtml . '</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    ';
    return $html;
}

function generateActionInReport(){
    $html = '
        <ul>
            <li class="dib"><button onclick="printContent(\'loadReportContainer\')">Print</button></li>
        </ul>
    ';

    return $html;
}

function imageContent($img_path, $imgId = '', $imgSize = '', $elementId = '', $label = '', $actionClass = '', $parendClass = '', $passParam = ''){
    $deleteHtml = '';
    $width = '100%';
    $disabled = '';
    if ($imgId != '') {
        $deleteHtml = "<div class='previewImg'><img src='$img_path'/><span data-imgid='$imgId' class='removeImg'>X</span></div>";
        $width = '80%';
        $disabled = 'disabled';
    }

    $parendClass = ($parendClass != '') ? $parendClass : 'col-md-6 col-sm-12';

    $html = "
        <div class='form_group mb-3 $parendClass'>
            <div class='dFlex aie'>
                $deleteHtml
                <div class='imgCon' style='width:$width'>
                    <label for='$elementId'>$label $imgSize</label>
                    <input $passParam class='form-control $actionClass' type='file' id='$elementId' accept='image/png, image/gif, image/jpeg' $disabled>
                </div>
            </div>
        </div>
    ";

    return $html;
}

// function generateDropdown($array){
//     $data = '';
//     foreach ($array as $item) {
//         $value = $item['value'];
//         $name = $item['name'];
//         $key =$item['key'];
//         $data .= '<option onClick="loadUsersData("",'.$key.')" value="' . $value . '">' . $name . '</option>';
//     }
//     $html = '<div class="customSelectDropdown">
//                 <select>' . $data . '</select>
//             </div>';

//     return $html;
// }

function generateDropdown($array){
    $data = '';
    $actionHtml = '';
    foreach ($array as $itemkey=>$item) {

        
        $value = $item['value'];
        $name = $item['name'];
        $key =$item['key'];

        if($itemkey == 0){
            $actionHtml = $name;
        }

        $data .= " <li><a class='dropdown-item' onClick='loadUsersData(\"\", \"$key\");' href='javascript:void(0)'>$name</a></li>";

    }
    $html = '
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle m0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      '.$actionHtml.'
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        '.$data.'
    </ul>
  </div>';

    return $html;
}


function generateUserInfo($uid, $label = '', $active = ''){
    $userDetailArry = getHotelUserDetail($uid)[0];
    $name = ucfirst($userDetailArry['name']);
    $userId = $userDetailArry['id'];
    $role = $userDetailArry['role'];
    $designation = $userDetailArry['designation'];
    $hotelName = $userDetailArry['hotelName'];
    $phone = $userDetailArry['phone'];
    $email = $userDetailArry['email'];
    $imageId = $userDetailArry['imageId'];
    $fullDesignation = ($designation == '') ? '' : "$designation at $hotelName";
    $imgArry = getHotelImageData('', '', '', '', $imageId)[0];
    $imgName = $imgArry['image'];
    $img = getImgPath('private', $imgName);

    $accessArrayList = ['viewer','editor','full'];
    $reservationAccessHtml = '';
    $guestAccessHtml = '';

    foreach($accessArrayList as $item){
        $itemName = ucfirst($item);
        $selectAccess = (isset(fetchData('user_access', ['userId'=>$userId, 'pageId'=>2])[0])) ? fetchData('user_access', ['userId'=>$userId, 'pageId'=>2])[0]['activityRole'] : '';
        $active = ( $selectAccess == $item) ? 'selected' : '';
        $reservationAccessHtml .= "<option $active value='$item'>$itemName</option>";
    }

    foreach($accessArrayList as $item){
        $itemName = ucfirst($item);
        $selectAccess = (isset(fetchData('user_access', ['userId'=>$userId, 'pageId'=>5])[0])) ? fetchData('user_access', ['userId'=>$userId, 'pageId'=>5])[0]['activityRole'] : '';
        $active = ( $selectAccess == $item) ? 'selected' : '';
        $guestAccessHtml .= "<option $active value='$item'>$itemName</option>";
    }

    $advanceHtml = '';
    $userDeleteHtml = '';
    if ($role == 1) {
    } else {
        $accessArray = getUserAccess($uid);
        $productArray = getSysProductData();
        $dataArray = arrayFormatingByTree($productArray, $accessArray);
        $userDeleteHtml = '<div class="deleteFooterSec">
                                <button class="" onclick="userDelete(' . $userId . ')">Delete User</button>
                            </div>';
        $advanceHtml = '
            <div>
                <h4>Permission </h4>
                <ul>
                    <li>
                        <h6 class="dib">Reservation</h6>
                        <select name="reservationAccess" id="reservationAccess" onchange="userAccessChange(\'' . htmlspecialchars($uid) . '\',2,this)">
                            '.$reservationAccessHtml.'
                        </select>
                    </li>
                    <li>
                        <h6 class="dib">Guest</h6>
                        <select name="guestAccess" id="guestAccess" onchange="userAccessChange('.$uid.',5,this)">
                            '.$guestAccessHtml.'
                        </select>
                    </li>
                </ul>
            </div>
        ';
    }


    if ($label != '') {
        $html = '
            <div class="dFlex usersLabel ' . $active . '" data-uid="' . $userId . '">
                <div class="userImg mR10">
                    <label for="userLableImg"><img src="' . $img . '"></label>
                    <input id="userLableImg" type="file" style="opacity:0"/>
                </div>
                <div class="userText">
                    <h4 class="m0">' . $name . '</h4>
                    <p class="m0">' . $designation . '</p>
                    <a href="mailto:' . $email . '">' . $email . '</a>
                </div>
            </div>
        ';
    } else {
        $html = '
            <div class="userInfoView w100">
                <div class="userContent">
                    <div claass="dFlex aic">
                        <div class="userImg mR30">
                            <label for="userImgUpload"><img id="previewImg" src="' . $img . '"><div class="hoverEffect dFlex aic jcc"><i class="fas fa-camera-retro"></i></div></label>
                            <input data-uid="' . $userId . '" data-name="' . $name . '" data-target="previewImg" id="userImgUpload" type="file" style="opacity:0"/>
                        </div>
                        <div class="userDetail">
                            <div class="title dFlex aic mB5"><h4 class="dib m0">' . $name . '</h4> <button data-uid="' . $userId . '" id="editUserDetailBtn" class="btnNoEffect w28 h28 mL10 dFlex dif aic jcc"><svg> <use href="#editfilledIcon"></use> </svg></button></div>
                            <p class="mB10">' . $fullDesignation . '</p>
                            <ul>
                                <li class="dib"><a href="mailto:' . $email . '"><svg class="w20 h20 mR10"> <use href="#mailEnvelopIcon"></use> </svg> <span class="bold">' . $email . '</span></a></li>
                                <li class="dib mL30"><a href="tel:' . $phone . '"><svg class="greenFilled w20 h20 mR10"> <use href="#phoneGreenFilledIcon"></use> </svg> <span class="bold">' . $phone . '</span></a></li>
                            </ul>
                        </div>
                    </div>
                    ' . $advanceHtml . '
                </div> 
                '.$userDeleteHtml.'               
            </div>
        ';
    }


    return $html;
}

function generateHotelDetail(){
    $hotelDetailArry = hotelDetail();
    $hotelName = $hotelDetailArry['hotelName'];
    $description = $hotelDetailArry['description'];
    $hotelEmailId = $hotelDetailArry['hotelEmailId'];
    $landlineNum = $hotelDetailArry['landlineNum'];
    $hotelPhoneNum = $hotelDetailArry['hotelPhoneNum'];
    $website = $hotelDetailArry['website'];
    $gst = ($hotelDetailArry['gst'] == '') ? 'No GST' : $hotelDetailArry['gst'];

    $checkIn = date('h:i A', strtotime($hotelDetailArry['checkIn']));
    $checkOut = date('h:i A', strtotime($hotelDetailArry['checkOut']));

    $locationArry = [$hotelDetailArry['address'], $hotelDetailArry['city'], $hotelDetailArry['state'], $hotelDetailArry['pincode']];
    $location = implode(', ', array_filter($locationArry));

    $html = '
        <div class="hotelDetails dFlex">
            <div class="setUpImgCon mR30">
                <svg style="padding: 10px;fill: #656565;"><use xlink:href="#hotelIcon"></use></svg>
            </div>
            <div class="content">
                <div class="title dFlex aic">
                    <h4 class="mR30 mB0">' . $hotelName . '</h4>
                    <button id="editHotelDetailBtn" class="btnNoEffect w28 h28 mL10 dFlex dif aic jcc"><svg> <use href="#editfilledIcon"></use> </svg></button>
                </div>
                
                <ul>
                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="mailEnvolopeClr w20 h20 mR10"> <use href="#mailEnvelopIcon"></use> </svg> <span>' . $hotelEmailId . '</span>
                        </a>
                    </li>

                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="greenFilled w20 h20 mR10"> <use href="#phoneGreenFilledIcon"></use> </svg> <span>' . $landlineNum . '</span>
                        </a>
                    </li>

                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="backstageClr w20 h20 mR10"> <use href="#callSvgIcon"></use> </svg> <span>' . $hotelPhoneNum . '</span>
                        </a>
                    </li>

                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="yellowFilled w20 h20 mR10"> <use href="#linkSvgIcon"></use> </svg> <span>' . $website . '</span>
                        </a>
                    </li>

                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="greenFilled w20 h20 mR10"> <use href="#locationSvgIcon"></use> </svg> <span>' . $location . '</span>
                        </a>
                    </li>
                    

                    <li class="db dFlex mb-2">
                        <div class="dib mR30"><svg class="greenFilled w28 h28 mR10"> <use href="#checkInIcon"></use> </svg> <span class="fw700 secondaryClr">' . $checkIn . '</span></div>
                        <div class="dib"><svg class="greenFilled w28 h28 mR10"> <use href="#checkOutIcon"></use> </svg> <span class="fw700 secondaryClr">' . $checkOut . '</span></div>
                    </li>

                    <li class="db">
                        <a class="dFlex aic mB10 bold" href="">
                            <svg class="greenFilled w20 h20 mR10"> <use href="#gstClrSvgIcon"></use> </svg> <span>' . $gst . '</span>
                        </a>
                    </li>
                    
                </ul>
            </div>    
        </div>
        <p class="p-4">' . $description . '</p>
    ';

    return $html;
}

function generatePriceBreakup($roomPrice = '', $roomGst = '', $roomTotal = '', $kotPrice = '', $kotTax = '', $kotTotal = '', $total = ''){
    $roomPriceHtml = '';
    $kotPriceHtml = '';
    if ($roomPrice != '') {
        $roomPriceHtml = '
            <tr>
                <td>01</td>
                <th class="text-center" style="font-size: 15px;" scope="row" colspan="2">Room Price</th>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>Room Price</td>
                <td>₹ ' . number_format($roomPrice, 2) . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>Gst</td>
                <td>₹ ' . number_format($roomGst, 2) . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td >Total</td>
                <td >₹ ' . number_format($roomTotal, 2) . '</td>
            </tr>
        ';
    }
    if ($kotPrice != '') {
        $kotPriceHtml = '
            <tr>
                <td>02</td>
                <th class="text-center" style="font-size: 15px;" scope="row" colspan="2">POS</th>
            </tr>
            <tr>
                <th scope="row"></th>
                <td >Sub Total</td>
                <td >₹ ' . number_format($kotPrice, 2) . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td >Tax</td>
                <td >₹ ' . number_format($kotTax, 2) . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td >Total</td>
                <td >₹ ' . number_format($kotTotal, 2) . '</td>
            </tr>
        ';
    }

    $html = '
            <table class="table table-striped table-hover" border="1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $roomPriceHtml . '
                    ' . $kotPriceHtml . '       
                    <tr>
                        <th >Total</th>
                        <th class="text-center" style="font-size: 18px;" colspan="2">₹ ' . number_format($total, 2) . '</th>
                    </tr>             
                </tbody>
            </table>
    ';

    return $html;
}



function reservationContentView($bid, $reciptNo, $gname, $checkIn, $checkOut, $bDate, $nAdult, $nChild, $total, $paid, $preview = '', $rTab = '', $BDId = '', $clickBtn = '', $bookingSource = '', $reportview = '', $bidCode = '', $status = []){
    $onlyBookingArray = fetchData('booking', ['id'=>$bid])[0];
    $userId = $_SESSION['ADMIN_ID'];
    $userArry = fetchData('hoteluser', ['id'=>$userId])[0];
    $userRole = $userArry['role'];
    

    $resType = $onlyBookingArray['status'];

    $totlaRoom = count(getBookingDetailTableData('', $bid));
    if ($checkIn == '') {
        $checkIn = date('Y-m-d');
    }
    if ($checkOut == '') {
        $checkOut = date("Y-m-d", strtotime("1 day", strtotime(date('Y-m-d'))));
    }

    if (strtotime($checkIn) == strtotime($checkOut)) {
        $checkOut = date("Y-m-d", strtotime("1 day", strtotime($checkIn)));
    }

    $checkInMonth = date('M', strtotime($checkIn));
    $checkInDay = date('d', strtotime($checkIn));
    $checkInYear = date('Y', strtotime($checkIn));

    $checkOutMonth = date('M', strtotime($checkOut));
    $checkOutDay = date('d', strtotime($checkOut));
    $checkOutYear = date('Y', strtotime($checkOut));

    $actionCon = '';
    if ($gname == '') {
        $gname = '_ _ _';
    }
    if ($total == '') {
        $total = 0;
    }
    if ($paid == '') {
        $paid = 0;
    }
    if ($nAdult == '') {
        $nAdult = 0;
    }
    if ($nChild == '') {
        $nChild = 0;
    }

    $resStatusArray = fetchData('sys_reservationtype', ['id'=>$resType])[0];

    $statusName = $resStatusArray['name'];
    $statusBg = $resStatusArray['bg'];
    $statusClr = $resStatusArray['clr'];

    $statusHtml = "<span style='background: $statusBg;color: $statusClr;'>$statusName</span>";


    $gname = ucfirst($gname);

    $checkInOut = getDateFormatByTwoDate($checkIn, $checkOut);
    $totalAmount = number_format($total, 2);
    $paidAmount = number_format($paid, 2);
    $pending = number_format($total - $paid, 2);
    $countNight = getNightByTwoDates($checkIn, $checkOut);
    $bookingSourceHtml = FRONT_SITE . '/img/icon/source/' . getBookingSource($bookingSource)[0]['img'];
    $bookingSourceName = getBookingSource($bookingSource)[0]['name'];
    $previewContent = '';
    $bDate = date('d-M', strtotime($bDate));
    $hotelVoucerLink = FRONT_SITE . '/voucher?vid=' . $bid;
    $guestVoucerLink = FRONT_SITE . '/view-voucher?id=' . $bid;
    $grcLink = FRONT_SITE . '/grc?id=' . $bid;
    $emailLink = FRONT_SITE . '/email_send?oid=' . $bid;
    $actionBtn = '';

    $paymentStatusHtml = "Pay To Hotel";
    if ($pending < 0) {
        $paymentStatusHtml = "Pay To Guest";
    }

    if ($total != '' && $total != 0 && $pending == 0) {
        $paymentCheckStatusHtml = "<strong class='paymentDone'>Payment Done</strong>";
    } else {
        $paymentCheckStatusHtml = "<small>$paymentStatusHtml</small>
        <strong>Rs $pending</strong>";
    }

    $viewDetailBtn = '<a onclick="viewBookingReport(' . $bid . ')" class="reservationViewBtn" data-bookingId="'. $bid .'" data-reservationTab="'.$rTab.'" data-bdid="'.$BDId.'" href="javascript:void(0)"><button class="btn bg-gradient-primary m0">View Booking</button></a>';

    if ($reportview == 'yes') {
        return $viewDetailBtn;
    }

    if ($preview == 'yes') {
        $previewContent = "        
                <div class='foot resevationFooter'>
                    <div class='dFlex aic jcsb item withOutHover'>
                        <div><span class='clrBlack'>Total</span> <strong class='totalPrice'>&#8377; $totalAmount</strong></div>
                        <div><span class='clrBlack'>Paid</span> <strong class='paidPrice'>&#8377; $paidAmount</strong></div>
                    </div>
                    <div class='dFlex aic jcsb item withHover'>
                        <ul>                        
                            <li><a href='$grcLink' target='_blank' data-oid='".$bid."' data-tooltip-top='GRC'><i class='fas fa-print'></i></a></li>
                            <li><a href='$guestVoucerLink' target='_blank' data-tooltip-top='Guest Voucher'><i class='far fa-file-alt'></i></a></li>
                        </ul>
                        $viewDetailBtn
                    </div>
                </div>        
        ";
        if($userRole != 1){
            $userAccess = (isset(fetchData('user_access', ['userId'=>$userId, 'pageId'=>2])[0])) ? fetchData('user_access', ['userId'=>$userId, 'pageId'=>2])[0]['activityRole'] :'';
            if($userAccess == 'editor' || $userAccess == 'full'){
                $actionBtn = 
            '
                <div class="customDropdown">
                    <button class="btnCD reservationDetailActionBtn">
                        <span></span><span></span><span></span>
                    </button>
                    <ul>
                        <li><button onclick="makeNoShowReservation('.$bid.')">Mark As No Show</button></li>
                        <li><button onclick="makeCancelReservation('.$bid.')">Cancel Reservation</button></li>
                    </ul>
                </div>
            ';
            }else{
                $actionBtn = '';
            }
        }else{
            $actionBtn = 
            '
                <div class="customDropdown">
                    <button class="btnCD reservationDetailActionBtn">
                        <span></span><span></span><span></span>
                    </button>
                    <ul>
                        <li><button onclick="makeNoShowReservation('.$bid.')">Mark As No Show</button></li>
                        <li><button onclick="makeCancelReservation('.$bid.')">Cancel Reservation</button></li>
                    </ul>
                </div>
            ';
        }        

    }

    $reservationBtn = 'reservationContent';
    if ($clickBtn != '') {
        $reservationBtn = 'reservationContentPreview';
    }

    if($onlyBookingArray['status'] == 5 || $onlyBookingArray['status'] == 6){
        $actionBtn = '';
    }


    $html = "
            <div class='$reservationBtn' data-bookingId='$bid' data-reservationTab='$rTab' data-bdid='$BDId'>  
                <div class='actionSec' onclick='reservationDetailPopUp($bid, $BDId)'></div>                          
                <div class='head dFlex aic jcsb'>
                    <div class='leftSide dFlex aic'>
                        <div class='icon'><i class='fas fa-user'></i></div>
                        <div class='userName'>
                            <h4>$gname</h4>
                            <span>$reciptNo / $bidCode</span>
                        </div>
                    </div>
                    <div class='rightSide'>$actionBtn</div>
                </div>

                <div class='body'>
                    <div class='checkInDetail'>
                        <span>Booking Source </span>
                        <strong class='zi5' data-tooltip-top='$bookingSourceName'><img style='width:20px' src='$bookingSourceHtml'/></strong>
                    </div>
                    <div class='checkinStatus center'>$statusHtml</div>
                    <div class='bookingDate'>
                        <div class='left'>
                            <strong>Booking Date:- </strong>
                            <span> $bDate</span>
                        </div>
                        <div class='right'>
                            <ul>
                                <li>
                                    <i class='fas fa-male'></i>
                                    <strong>$nAdult</strong>
                                </li>
                                <li>
                                    <i class='fas fa-child'></i>
                                    <strong>$nChild</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class='bookingDetail'>
                        <ul class='dFlex aic jcsb'>
                            <li class='dFlex aic jcc fdc dif wAuto'>
                                <small>Room</small>
                                <div class='badge badge-secondary item dFlex aic jcc fdc'>
                                    <strong>$totlaRoom</strong>
                                </div>
                            </li>
                            <li class='dFlex aic jcc fdc dif wAuto'>
                                <small>Arrival </small>
                                <div class='dFlex aic jcc fdc dif wAuto badge badge-success item'>
                                    <span>$checkInMonth</span>
                                    <strong>$checkInDay</strong>
                                    <span>$checkInYear</span>
                                </div>
                            </li>
                            <li class='dFlex aic jcc fdc dif wAuto'>
                                <small>Night</small>
                                <div class='badge badge-dark item dFlex aic jcc fdc'>
                                    <strong>$countNight</strong>
                                </div>
                            </li>
                            <li class='dFlex aic jcc fdc dif wAuto'>
                                <small>Departure </small>
                                <div class='dFlex aic jcc fdc dif wAuto badge badge-danger item'>
                                    <span>$checkOutMonth</span>
                                    <strong>$checkOutDay</strong>
                                    <span>$checkOutYear</span>
                                </div>
                            </li>
                            
                        </ul>
                    </div>

                </div>

                $previewContent

            </div>
    ";


    return $html;
}


function genNotFoundScreen($title = '', $desc = ''){

    $link = websiteLink();
    $navBar = websiteNav();
    $footer = websiteFooter();
    $script = websiteScript();

    $frontSite = FRONT_SITE;

    $html = '
            <!DOCTYPE html>
            <html lang="en">
            
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>' . $title . '</title>
                    ' . $link . '
                </head>
                
                <body>
                    ' . $navBar . '
                    <main>
                        <div class="notFoundScreen">
                            <div class="content">
                                <div class="font-404">
                                    <h1>4<span>0</span>4</h1>
                                </div>
                                <p>' . $desc . '</p>
                                <a href="' . $frontSite . '">home page</a>
                            </div>
                        </div>
                    </main>
                    ' . $footer . $script . '
                </body>
            
            </html>
    ';

    return $html;
}
