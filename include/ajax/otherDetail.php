<?php

include('../constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SERVER_INCLUDE_PATH . 'add_to_room.php');
include(SERVER_INCLUDE_PATH . 'add_to_stock.php');
$obj = new add_to_room();

$stockObj = new add_to_stock();

$type = $_POST['type'];


if ($type == 'todayCheckIn') {
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);

    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking.id = bookingdetail.bid and bookingdetail.checkIn = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    $data = '
        <table border="1" style="margin: 30px 0;">
        
    ';
    $count = 0;
    if (mysqli_num_rows($sql) > 0) {

        while ($row = mysqli_fetch_assoc($sql)) {
            $count++;
            if ($count == 1) {
                $data .= '<tr><td></td> <td> <a href="download.php?id=todayCheckInDownload"> <i class="fa fa-download"></i> </a></td></tr>';
            }
            $data .= '
                
                <tr>
                    <td style="text-align:left">
                        <div style="font-weight: 700;">' . ucfirst($row["name"]) . '</div>
                        <div>' . $row["bookinId"] . '</div>
                    </td>
                    <td style="text-align:right">
                        <div>' . getDateFormatByTwoDate($row["checkIn"], $row["checkout"]) . '</div>
                        <div><small>₹ ' . $row["grossCharge"] . '</small> / <strong>₹ ' . $row["userPay"] . '</strong></div>
                    </td>
                </tr>
            ';
        }
    } else {
        $data .= '
                <tr>
                    <td style="text-align:left">
                        No Data
                    </td>
                </tr>
            ';
    }
    $data .= '</table>';

    echo $data;
}

if ($type == 'todayCheckOut') {
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);

    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking.id = bookingdetail.bid and bookingdetail.checkout = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    $data = '
        <table border="1" style="margin: 30px 0;">
        
    ';
    $count = 0;
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $count++;
            if ($count == 1) {
                $data .= '<tr><td></td> <td> <a href="download.php?id=todayCheckOutDownload"> <i class="fa fa-download"></i> </a></td></tr>';
            }
            $data .= '
                <tr>
                    <td style="text-align:left">
                        <div style="font-weight: 700;">' . ucfirst($row["name"]) . '</div>
                        <div>' . $row["bookinId"] . '</div>
                    </td>
                    <td style="text-align:right">
                        <div>' . getDateFormatByTwoDate($row["checkIn"], $row["checkout"]) . '</div>
                        <div><small>₹ ' . $row["grossCharge"] . '</small> / <strong>₹ ' . $row["userPay"] . '</strong></div>
                    </td>
                </tr>
            ';
        }
    } else {
        $data .= '
                <tr>
                    <td style="text-align:left">
                        No Data
                    </td>
                </tr>
            ';
    }
    $data .= '</table>';

    echo $data;
}

if ($type == 'qptodayCheckIn') {
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);

    $sql = mysqli_query($conDB, "select* from quickpay where checkIn = '$today' and paymentStatus = 'complete'");
    $data = '
        
        <table border="1" style="margin: 30px 0;">
        
    ';
    $count = 0;
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $count++;
            if ($count == 1) {
                $data .= '<tr><td></td> <td> <a href="download.php?id=todayQpCheckInDownload"> <i class="fa fa-download"></i> </a></td></tr>';
            }
            $data .= '
            
                <tr>
                    <td style="text-align:left">
                        <div style="font-weight: 700;">' . ucfirst($row["name"]) . '</div>
                        <div>' . $row["orderId"] . '</div>
                    </td>
                    <td style="text-align:right">
                        <div>' . getDateFormatByTwoDate($row["checkIn"], $row["checkOut"]) . '</div>
                        <div><small>₹ ' . $row["totalAmount"] . '</small> / <strong>₹ ' . $row["amount"] . '</strong></div>
                    </td>
                </tr>
            ';
        }
    } else {
        $data .= '
                <tr>
                    <td style="text-align:left">
                        No Data
                    </td>
                </tr>
            ';
    }
    $data .= '</table>';

    echo $data;
}

if ($type == 'qptodayCheckOut') {
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);

    $sql = mysqli_query($conDB, "select* from quickpay where checkOut = '$today' and paymentStatus = 'complete'");
    $data = '
        <table border="1" style="margin: 30px 0;">
        
    ';
    $count = 0;
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $count++;
            if ($count == 1) {
                $data .= '<tr><td></td> <td> <a href="download.php?id=todayQpCheckOutDownload"> <i class="fa fa-download"></i> </a></td></tr>';
            }
            $data .= '
                    <tr>
                        <td style="text-align:left">
                            <div style="font-weight: 700;">' . ucfirst($row["name"]) . '</div>
                            <div>' . $row["orderId"] . '</div>
                        </td>
                        <td style="text-align:right">
                            <div>' . getDateFormatByTwoDate($row["checkIn"], $row["checkOut"]) . '</div>
                            <div><small>₹ ' . $row["totalAmount"] . '</small> / <strong>₹ ' . $row["amount"] . '</strong></div>
                        </td>
                    </tr>
            ';
        }
    } else {
        $data .= '
                <tr>
                    <td style="text-align:left">
                        No Data
                    </td>
                </tr>
            ';
    }
    $data .= '</table>';

    echo $data;
}

if ($type == 'nightChange') {
    $rid = $_POST['rid'];
    $date = $_POST['date'];

    $current_date = strtotime(date('Y-m-d'));
    $one_day = strtotime('1 day 00 second', 0);
    $datearr = explode("-", $date);
    $month = $datearr[1];
    $day = $datearr[2];
    $year = $datearr[0];


    if (checkdate($month, $day, $year)) {
        if ($current_date <= strtotime($date)) {
            $obj->checkInDateUpdate($date, date('Y-m-d', strtotime($date) + $one_day));
        } else {
            $current_date = strtotime(date('Y-m-d'));
            $obj->checkInDateUpdate(date('Y-m-d', $current_date), date('Y-m-d', $current_date + $one_day));
        }
    } else {
        $current_date = strtotime(date('Y-m-d'));
        $obj->checkInDateUpdate(date('Y-m-d', $current_date), date('Y-m-d', $current_date + $one_day));
    }
}

if ($type == 'convertArryToJSON') {
    $arry = $_POST['array'];

    echo convertArryToJSON($arry);
}

if ($type == 'singleGroupBtnValue') {
    $btnType = $_POST['btnType'];
    $tab = $_POST['tab'];

    if ($btnType == 1) {
        $_SESSION['singleGroupBtn'] = 1;
    } else {
        $_SESSION['singleGroupBtn'] = 0;
    }
}


if ($type == 'removerImgWithName') {
    $target = $_POST['target'];
    $filename = $_POST['filename'];

    unlink(SERVER_IMG . $target . '/' . $filename);
}

if ($type == 'setSessionWithValue') {
    $sessionKey = $_POST['sessionKey'];
    $sessionValue = $_POST['sessionValue'];
    $kotValid = $_POST['kotValid'];
    $status = $_POST['status'];
    $arry = $_POST['arry'];

    if ($arry != '') {
        if ($arry[0] == 'stockAdd') {
            if (isset($_SESSION['stock'][$arry[1]])) {
                if ($arry[2] != '') {
                    $stockObj->updateStockQt($arry[1], $arry[2], $arry[3]);
                } elseif ($arry[3] != '') {
                    $stockObj->updateStockUnit($arry[1], $arry[3]);
                } elseif ($arry[4] != '') {
                    $stockObj->updateStockPrice($arry[1], $arry[4]);
                }
            } else {
                $stockObj->addStock($arry[1]);
            }
        }
    }

    if ($kotValid == 'max') {
        $kotTotalPrice = getAddKotProductDetail()['totalPrice'];
        if ($sessionValue >= $kotTotalPrice) {
            $sessionValue = $kotTotalPrice;
        }
    }

    if ($status != '') {
        if ($status == 'removeStock') {
            $stockObj->removeStock($arry[1]);
        } else {
            unset($_SESSION[$sessionKey]);
        }
    } else {
        $_SESSION[$sessionKey] = $sessionValue;
    }


    pr($arry);
}

if ($type == 'getLiveSearchData') {
    $dbt = safeData($_POST['dbt']);
    $sdata = safeData($_POST['data']);
    $serviceId = safeData($_POST['serviceId']);
    $data = '';
    $result = '';
    if ($dbt != '') {
    } else {

        $result = getServicePropertyListHtml($serviceId, $sdata);
    }

    echo $result;
}


// Amenities Block 




function amenitiesAddForm($rnid = '')
{
    global $conDB;
    global $cashingTitle;

    $formId = 'addAmenitiesForm';
    $amenitiesTitle = '';
    $submitBtn = "Add Amenities";
    $imgReq = 'required';
    $updateAmenitiesHtml = '';

    if ($rnid != '') {
        $row = getAmenitieById($rnid, '', 'yes')[0];
        $formId = 'updateAmenitiesForm';
        $amenitiesTitle = $row['title'];
        $submitBtn = "Update Amenities";
        $updateAmenitiesHtml = '<input type="hidden" name="wbBlogId" value="' . $rnid . '" >';

        $imgReq = '';
    }

    $html = '

            <form id="' . $formId . '" action="" method="post" enctype="multipart/form-data">
                                
                <div class="row p0" style="align-items: end;">

                    <div class="form_group col-md-12 mb-3">
                        <label for="">Title</label>
                        <input ' . $imgReq . ' type="text" name="title" placeholder="Enter Image Text" class="form-control" value="' . $amenitiesTitle . '" autocomplete="off">
                    </div>
                    ' . $updateAmenitiesHtml . '
                    
                    <div class="form_group col_12">
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">' . $submitBtn . '</button>
                    </div>
                </div>
                
            </form>
    ';

    return $html;
}

function amenitiesformDataInsert($id = '', $text)
{

    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';

    $addBy = dataAddBy();

    $existAmenities = getAmenitieById('', $text, 'yes', '', '', $id);

    if ($id != '') {

        if (count($existAmenities) == 0) {
            $sql = "update  amenities set title = '$text' where id = '$id'";

            if (mysqli_query($conDB, $sql)) {
                $data = [
                    'error' => 'no',
                    'msg' => 'Successfully Update Amenities.'
                ];
            } else {
                $data = [
                    'error' => 'yes',
                    'msg' => 'Something error.'
                ];
            }
        } else {
            $data = [
                'error' => 'yes',
                'msg' => 'Already exists amenities name.'
            ];
        }
    } else {
        if (count($existAmenities) == 0) {
            $sql = "insert into amenities(hotelId,title,addBy) values('$hId','$text','$addBy')";

            if (mysqli_query($conDB, $sql)) {
                $data = [
                    'error' => 'no',
                    'msg' => 'Successfully Add Amenities.'
                ];
            } else {
                $data = [
                    'error' => 'yes',
                    'msg' => 'Something error.'
                ];
            }
        } else {
            $data = [
                'error' => 'yes',
                'msg' => 'Already exists amenities name.'
            ];
        }
    }




    echo json_encode($data);
}

if ($type == 'loadAmenitiesList') {

    $si = 0;

    $html = '
        <table class="table align-items-center mb-0 rt br hover">
            <thead>
                <tr>
                    <th scope="col">SL.</th>
                    <th scope="col">Amenities Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
    ';

    if (count(getAmenitieById('', '', 'yes')) > 0) {
        $sl = 0;
        foreach (getAmenitieById('', '', 'yes') as $wbBlogList) {
            $sl++;

            $id = $wbBlogList['id'];
            $title = ucfirst($wbBlogList['title']);
            $addBy = $wbBlogList['addBy'];
            $si++;

            $html .= '
                    <tr>
                        <td data-label="SL" width="10%" class="mb-0 text-xs opacity-5"><strong>' . $sl . '</strong></td>
                        <td data-label="Amenities Name" width="15%" class="mb-0 text-xs"><strong>' . $title . '</strong></td>
                        <td data-label="Action" width="20%" class="mb-0 text-xs">

                            <div class="tableCenter">
                                <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                <span class="tableHoverShow">
                                <a class="tableIcon update bg-gradient-info editAmenitiesBtn" href="javascript:void(0)" data-bid="' . $id . '" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                <a class="tableIcon delete bg-gradient-danger deleteAmenitiesBtn" href="javascript:void(0)" data-bid="' . $id . '" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>
                                </span>
                            </div>

                        </td>
                    </tr>
            ';
        }
    } else {
        $html .= '
                    <tr>
                        <td class="mb-0 text-xs" colspan="3">No Data</td>
                    </tr>
            ';
    }


    $html .= '
    
    </tbody>
    </table>
    
    ';

    echo $html;
}

if ($type == 'showAddAmenitiesForm') {
    echo amenitiesAddForm();
}

if ($type == 'addAmenitiesSubmit') {
    $text = $_POST['title'];
    amenitiesformDataInsert('', $text);
}

if ($type == 'editAmenitiesForm') {
    $id = $_POST['id'];
    echo amenitiesAddForm($id);
}

if ($type == 'updateAmenitiesSubmit') {
    $text = $_POST['title'];
    $id = $_POST['wbBlogId'];
    amenitiesformDataInsert($id, $text);
}

if ($type == 'deleteAmenities') {
    $gid = $_POST['gid'];
    $sql = "update amenities set deleteRec = '0' where id='$gid'";
    // $oldImg = getWbGalleryData($gid)[0]['img'];
    if (mysqli_query($conDB, $sql)) {
        // imgUploadWithData('','gallery',$oldImg);
        echo 1;
    } else {
        echo 0;
    }
}




// Coupon Block 




function couponAddForm($rnid = '')
{
    global $conDB;
    global $cashingTitle;

    $formId = 'addCouponForm';
    $submitBtn = "Add Coupon";
    $imgReq = 'required';
    $updateCouponHtml = '';
    $couponCode = '';
    $couponType = '';
    $couponValue = '';
    $couponMinimumPrice = '';
    $couponExpireOn = '';

    if ($rnid != '') {
        $row = getCouponArry($rnid)[0];
        // pr($row);
        $formId = 'updateCouponForm';
        $submitBtn = "Update Coupon";
        $updateCouponHtml = '<input type="hidden" name="couponId" value="' . $rnid . '" >';
        $couponCode = $row['coupon_code'];
        $couponType = $row['coupon_type'];
        $couponValue = $row['coupon_value'];
        $couponMinimumPrice = $row['min_value'];
        $couponExpireOn = $row['expire_on'];

        $imgReq = '';
    }

    // $coupontype = ['P' => 'Percentage','F' => 'Fixed'];
    $coupontype = ['P' => 'Percentage'];
    foreach ($coupontype as $key => $val) {
        $couponTypeHtml =  "<option selected value='$key'>$val</option>";
    }

    $previewCouponValue = getCouponDiscountShort($couponType, $couponValue);

    $html = '

            <form id="' . $formId . '" action="" method="post" enctype="multipart/form-data">
                                
                <div class="row p0" style="align-items: end;">

                    <div class="form_group col-md-12 mb-3">
                        <label for="">Title</label>
                        <input ' . $imgReq . ' type="text" name="couponCode" id="couponCode" placeholder="Enter Coupon Code." class="form-control" value="' . $couponCode . '" autocomplete="off">
                    </div>

                    <div class="form_group col-md-5 mb-3">
                        <label for="couponType">Coupon Type </label>
                        <select name="couponType" id="couponType" class="form-control">
                            ' . $couponTypeHtml . '
                        </select>
                    </div>

                    <div class="form_group col-md-5 mb-3">
                        <label for="couponValue">Coupon Value</label>
                        <input ' . $imgReq . ' type="number" name="couponValue" id="couponValue" placeholder="Enter Coupon Value." class="form-control" value="' . $couponValue . '" autocomplete="off">
                    </div>

                    <div class="form_group col-md-2 mb-3">
                        <label>' . $previewCouponValue . '</label>
                    </div>

                    ' . $updateCouponHtml . '

                    <div class="form_group col-md-6 mb-3">
                        <label for="couponMinimumPrice">Minimum Booking Price</label>
                        <input ' . $imgReq . ' type="number" name="couponMinimumPrice" id="couponMinimumPrice" placeholder="Enter Minimum Price." class="form-control" value="' . $couponMinimumPrice . '" autocomplete="off">
                    </div>

                    <div class="form_group col-md-6 mb-3">
                        <label for="couponExpireOn">Expire On</label>
                        <input ' . $imgReq . ' type="date" name="couponExpireOn" id="couponExpireOn" class="form-control" value="' . $couponExpireOn . '" autocomplete="off">
                    </div>
                    
                    <div class="form_group col_12">
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit">' . $submitBtn . '</button>
                    </div>
                </div>
                
            </form>
    ';

    return $html;
}

function couponformDataInsert($id = '', $couponCode, $couponType, $couponValue, $couponMinimumPrice, $couponExpireOn)
{

    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';

    $addBy = '';

    if ($id != '') {
        $sql = "update  couponcode set coupon_code = '$couponCode',coupon_type = '$couponType',min_value = '$couponMinimumPrice',coupon_value = '$couponValue',expire_on = '$couponExpireOn' where id = '$id'";
    } else {
        $sql = "insert into  couponcode(hotelId,coupon_code,coupon_type,min_value,coupon_value,expire_on,addBy) values('$hId','$couponCode','$couponType','$couponMinimumPrice','$couponValue','$couponExpireOn','$addBy')";
    }

    if (mysqli_query($conDB, $sql)) {
        echo 1;
    } else {
        echo 0;
    }
}

if ($type == 'loadCouponList') {

    $si = 0;

    $html = '
        <table class="table align-items-center mb-0 rt hover br">
            <thead>
                <tr>
                    <th scope="col">SL.</th>
                    <th scope="col">Coupon Code</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Minimum Book Value</th>
                    <th scope="col">Expires On</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
    ';

    if (count(getCouponArry()) > 0) {
        $sl = 0;
        foreach (getCouponArry() as $couponList) {
            $sl++;

            $id = $couponList['id'];
            $coupon_code = $couponList['coupon_code'];
            $coupon_type = $couponList['coupon_type'];
            $min_value = $couponList['min_value'];
            $coupon_value = $couponList['coupon_value'];
            $expire_on = date('d - M , y', strtotime($couponList['expire_on']));
            $addBy = $couponList['addBy'];
            $si++;

            $discount = getCouponDiscountShort($coupon_type, $coupon_value);

            if ($couponList['status'] == 1) {
                $statusHtml = "<a class='tableIcon status bg-gradient-success status deactive' href='javascript:void(0)' data-gid='$id' data-tooltip-top='Deactive' ><i class='far fa-eye'></i></a>";
            } else {
                $statusHtml = "<a class='tableIcon status bg-gradient-warning status  active' href='javascript:void(0)' data-gid='$id' data-tooltip-top='Active'  ><i class='far fa-eye-slash'></i></a>";
            }

            $html .= '
                    <tr>
                        <td data-label="SL." width="10%" class="mb-0 text-xs"><strong>' . $sl . '</strong></td>
                        <td data-label="Coupon Code" width="25%" class="mb-0 text-xs"><strong>' . $coupon_code . '</strong></td>
                        <td data-label="Discount" width="15%" class="mb-0 text-xs">' . $discount . '</td>
                        <td data-label="Minimum Book Value" width="15%" class="mb-0 text-xs">₹ ' . $min_value . '</td>
                        <td data-label="Expires On" width="15%" class="mb-0 text-xs">' . $expire_on . '</td>
                        <td data-label="Action" width="20%" class="mb-0 text-xs">    
                            <div class="tableCenter">
                                <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                <span class="tableHoverShow">
                                    ' . $statusHtml . '
                                    <a class="tableIcon update bg-gradient-info editAmenitiesBtn" href="javascript:void(0)" data-bid="' . $id . '" data-tooltip-top="Edit"><i class="far fa-edit"></i></a>
                                </span>
                            </div>
                        </td>
                    </tr>
            ';
        }
    } else {
        $html .= '
                    <tr>
                        <td class="mb-0 text-xs" colspan="3">No Data</td>
                    </tr>
            ';
    }


    $html .= '
    
    </tbody>
    </table>
    
    ';

    echo $html;
}

if ($type == 'showCouponForm') {
    $id = $_POST['cid'];
    echo couponAddForm($id);
}

if ($type == 'addCouponSubmit') {
    $couponCode = $_POST['couponCode'];
    $couponType = $_POST['couponType'];
    $couponValue = $_POST['couponValue'];
    $couponMinimumPrice = $_POST['couponMinimumPrice'];
    $couponExpireOn = $_POST['couponExpireOn'];
    couponformDataInsert('', $couponCode, $couponType, $couponValue, $couponMinimumPrice, $couponExpireOn);
}

if ($type == 'updateCouponSubmit') {
    $id = $_POST['couponId'];
    $couponCode = $_POST['couponCode'];
    $couponType = $_POST['couponType'];
    $couponValue = $_POST['couponValue'];
    $couponMinimumPrice = $_POST['couponMinimumPrice'];
    $couponExpireOn = $_POST['couponExpireOn'];
    couponformDataInsert($id, $couponCode, $couponType, $couponValue, $couponMinimumPrice, $couponExpireOn);
}


if ($type == 'getNextDateByCurrentDate') {
    $date = $_POST['date'][0];
    $chkdtarr = explode("GMT", $date);
    $newdt = strtotime($chkdtarr[0] . ' +1 day');
    echo date('M d, Y', $newdt);
}


if ($type == 'loadRevenueOverviewSec') {

    $action = ($_POST['act'] == '') ? 'alltime' : $_POST['act'];
    $daybyRevList = '';

    if ($action == 'today') {
        $actionHtml = 'Today';
        $toalRev = '₹ ' . custom_number_format(dailyBookingEarningByAddOn(date('Y-m-d')));
        $totalBooking = custom_number_format(dailyBookingEarningByAddOnCount(date('Y-m-d')));
        $visitor = visitor(date('Y-m-d'));
        $night = getRoomNight(date('Y-m-d'));
        $guest = count(getGuestDetail('', '', '', '', '', date('Y-m-d')));
        $totalExpens = '₹ ' . custom_number_format(getExpensePrice(date('Y-m-d')));
        $kotRev = '₹ ' . custom_number_format(getKotOrderPrice(date('Y-m-d')));
        $totalKotExpense = '₹ ' . custom_number_format(getKotStockExpnce('buy', date('Y-m-d')));
    }

    if ($action == 'week') {
        $actionHtml = 'This Week';
        $toalRev = '₹ ' . custom_number_format(dailyBookingEarningByAddOn(date('Y-m-d')));
        $totalBooking = custom_number_format(dailyBookingEarningByAddOnCount(date('Y-m-d')));
        $visitor = visitor(date('Y-m-d'));
        $night = getRoomNight(date('Y-m-d'));
        $guest = count(getGuestDetail('', '', '', '', '', date('Y-m-d')));
        $totalExpens = '₹ ' . custom_number_format(getExpensePrice(date('Y-m-d')));
        $kotRev = '₹ ' . custom_number_format(getKotOrderPrice(date('Y-m-d')));
        $totalKotExpense = '₹ ' . custom_number_format(getKotStockExpnce('buy', date('Y-m-d')));
    }

    if ($action == 'month') {
        $actionHtml = 'This Month';
        $toalRev = '₹ ' . custom_number_format(dailyBookingEarningByAddOn(date('Y-m-d')));
        $totalBooking = custom_number_format(dailyBookingEarningByAddOnCount(date('Y-m-d')));
        $visitor = visitor(date('Y-m-d'));
        $night = getRoomNight(date('Y-m-d'));
        $guest = count(getGuestDetail('', '', '', '', '', date('Y-m-d')));
        $totalExpens = '₹ ' . custom_number_format(getExpensePrice(date('Y-m-d')));
        $kotRev = '₹ ' . custom_number_format(getKotOrderPrice(date('Y-m-d')));
        $totalKotExpense = '₹ ' . custom_number_format(getKotStockExpnce('buy', date('Y-m-d')));
    }

    if ($action == 'year') {
        $actionHtml = 'This Year';
        $toalRev = '₹ ' . custom_number_format(dailyBookingEarningByAddOn(date('Y-m-d')));
        $totalBooking = custom_number_format(dailyBookingEarningByAddOnCount(date('Y-m-d')));
        $visitor = visitor(date('Y-m-d'));
        $night = getRoomNight(date('Y-m-d'));
        $guest = count(getGuestDetail('', '', '', '', '', date('Y-m-d')));
        $totalExpens = '₹ ' . custom_number_format(getExpensePrice(date('Y-m-d')));
        $kotRev = '₹ ' . custom_number_format(getKotOrderPrice(date('Y-m-d')));
        $totalKotExpense = '₹ ' . custom_number_format(getKotStockExpnce('buy', date('Y-m-d')));
    }

    if ($action == 'alltime') {
        $actionHtml = 'All Time';
        $toalRev = '₹ ' . custom_number_format(earnig()['gross']);
        $totalBooking = custom_number_format(roomBooking() + qpRoomBooking());
        $visitor = visitor();
        $night = getRoomNight();
        $guest = count(getGuestDetail());
        $totalExpens = '₹ ' . custom_number_format(getExpensePrice());
        $kotRev = '₹ ' . custom_number_format(getKotOrderPrice());
        $totalKotExpense = '₹ ' . custom_number_format(getKotStockExpnce('buy'));

        $daybyRevList = array();
        for ($i = 4; $i > 0; $i--) {
            $currentDate = strtotime(date('Y-m-d'));
            $oneDay = strtotime('1 day 00 second', 0);
            $date = $currentDate - ($oneDay * $i) + $oneDay;
            $getDate = date('Y-m-d', $date);
            $booking = custom_number_format(round(dailyBookingEarningByAddOn($getDate)));
            $dateprint = date('D', $date);

            $daybyRevList[] = [
                'day' => $dateprint,
                'book' => "₹ $booking"
            ];
        }
    }
    $monthbyRevList = '';
    for ($i = 2; $i > -1; $i--) {
        $currentDate = strtotime(date('Y-m-d'));
        $months = date("F Y", strtotime(date('Y-m-01') . " -$i months"));
        $timestamp = strtotime($months);
        $first_second = date('Y-m-01 ', $timestamp);
        $last_second = date('Y-m-t ', $timestamp);
        $booking = 0;
        $quickPay = 0;
        $booking = MonthlyBookingEarning($first_second, $last_second);
        $totalBook = number_format(round($booking));

        $dateprint = date('M', strtotime($months));

        $monthbyRevList .= '<div class="content"><h4>' . $dateprint . '</h4><p>₹ ' . $totalBook . '</p></div>';
    }

    $data = [
        'action' => $actionHtml,
        'totalRev' => $toalRev,
        'tatalBook' => $totalBooking,
        'night' => $night,
        'kotRev' => $kotRev,
        'guest' => $guest,
        'visitor' => $visitor,
        'totalExpens' => $totalExpens,
        'totalKotExpense' => $totalKotExpense,
        'daybyRevList' => $daybyRevList,
        'monthbyRevList' => $monthbyRevList,
    ];

    echo json_encode($data);
}

if ($type == 'loadDailyReport') {
    $date = ($_POST['date'] == '') ? date('F Y') : date('F Y', strtotime($_POST['date']));
    $nOfDay = date('t', strtotime($date));
    for ($i = 0; $i < $nOfDay; $i++) {
        $oneDate = date("Y-m-d", strtotime($date) + (86400 * $i));
        $booking = dailyBookingEarningByAddOn($oneDate);
        $quickPay = dailyQuickPayEarningByAddOn($oneDate);

        $datePrint = date('d', strtotime($oneDate));
        $dailyBooking[] = [
            'day' => $datePrint,
            'book' => $booking,
            'qp' => $quickPay,
        ];
    }

    echo json_encode($dailyBooking);
}


if ($type == 'loadWeeklyReport') {
    for ($i = 7; $i > 0; $i--) {
        $currentDate = strtotime(date('Y-m-d'));
        $oneDay = strtotime('1 day 00 second', 0);
        $date = $currentDate - ($oneDay * $i) + $oneDay;
        $getDate = date('Y-m-d', $date);
        $booking = round(dailyBookingEarning($getDate));
        $booking = '';
        $quickPay = round(dailyQuickPayEarning($getDate));
        $dateprint = date('D', $date);
        $cartLineData[] = [
            'day' => $dateprint,
            'booking' => $booking,
            'quickpay' => $quickPay,
        ];
    }

    echo json_encode($cartLineData);
}

if ($type == 'loadActiveFeed') {
    $activityArry = getActiveFeed(15,'','','','','19');
    $html = '';

    if (count($activityArry) > 0) {
        foreach ($activityArry as $val) {

            $html .= activityGenerate($val);
        }
    } else {
        $html .= '<li>
                        No Data
                    </li>';
    }


    echo $html;
}


if ($type == 'imageFileUpdate') {
    $file = $_FILES['imgFile'];
    $path = $_POST['path'];
    $newName = $_POST['newName'];
    $accessValue = $_POST['accessValue'];
    $private = $_POST['private'];
    $imgType = (isset($_POST['imgType'])) ? $_POST['imgType'] : '';

    $data = imgUploadWithData($file, $path, '', '', $newName, $accessValue,$private);
    $imagName = $data['imgId'];

    echo json_encode($data);
}



if ($type == 'beLoadCardDetails') {

    $hotelName = hotelDetail()['hotelName'];
    $beSourceId = 2;
    $currentDate = $_POST['sdate'];
    $nextDate = $_POST['edate'];


    $revenueCalculateArry = revenueCalculate($currentDate, $nextDate, $beSourceId);

    $totalRevenue = $revenueCalculateArry['total'];
    $totalBooking = $revenueCalculateArry['bookingCount'];
    $totalVisitor = $revenueCalculateArry['visitor'];




    $colorArry = ['#17c1e8', '#cb0c9f', '#3A416F', '#a8b8d8'];
    foreach (getRoomList() as $key => $val) {
        $id = $val['id'];
        $roomName = $val['header'];
        $clr = $colorArry[$key];
        $circleBar[] = [
            'room' => $roomName,
            'clr' => $clr,
            'book' => $revenueCalculateArry['room'][$id],
        ];
    }
    $totalRevenue = number_format($totalRevenue);
    $currentDate = date('d M', strtotime($currentDate));
    $nextDate = date('d M', strtotime($nextDate));
    $totalBooking = number_format($totalBooking);
    $totalVisitor = number_format($totalVisitor);
    $html = '
<div class="col-sm-4">
<div class="card">
    <div class="card-body p-3 position-relative">
        <div class="row">
            <div class="col-7 text-start">
                <p class="text-sm mb-1 text-capitalize font-weight-bold">Revenue</p>
                <h5 class="font-weight-bolder mb-0">
                    ₹ ' . $totalRevenue . '
                </h5>
            </div>
            <div class="col-5">
                <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-xs text-secondary">' . $currentDate . ' - ' . $nextDate . '</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-sm-4 mt-sm-0 mt-4">
<div class="card">
    <div class="card-body p-3 position-relative">
        <div class="row">
            <div class="col-7 text-start">
                <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Booking</p>
                <h5 class="font-weight-bolder mb-0">
                    ' . $totalBooking . '
                </h5>
            </div>
            <div class="col-5">
                <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-xs text-secondary">' . $currentDate . ' - ' . $nextDate . '</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-sm-4 mt-sm-0 mt-4">
<div class="card">
    <div class="card-body p-3 position-relative">
        <div class="row">
            <div class="col-7 text-start">
                <p class="text-sm mb-1 text-capitalize font-weight-bold">Visitor</p>
                <h5 class="font-weight-bolder mb-0">
                   ' . $totalVisitor . '
                </h5>

            </div>
            <div class="col-5">
                <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-xs text-secondary">' . $currentDate . ' - ' . $nextDate . '</span>
                    </a>
                    <!-- <ul class="dropdown-menu dropdown-menu-end px-2 py-3"
                        aria-labelledby="dropdownUsers3">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7
                                days</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last
                                week</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30
                                days</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
';

    $htmlBookingGraph = '';
    $colorArry = ['bg-info', 'bg-primary', 'bg-dark', 'bg-secondary'];
    foreach (getRoomList() as $key => $val) {
        $id = $val["id"];
        $roomName = $val["header"];
        $clr = $colorArry[$key];
        $htmlBookingGraph .= '
                    <span class="badge badge-md badge-dot me-4 d-block text-start">
                        <i class="' . $clr . '"></i>
                        <span class="text-dark text-xs">' . $roomName . '</span>
                    </span>';
    }


    $dataarr = array(
        'cardDetails' => $html,
        'bookingGraph' => $htmlBookingGraph,
        'circleBar' => $circleBar,
    );
    echo json_encode($dataarr);
}
//Code written by aabinash in 27/02/2024

if ($type == 'beLoadRevenueGraphDetails') {
    if (isset($_POST['all'])) {
        $all = $_POST['all'] == '' ? '' : $_POST['all'];
        $date = date('Y-m-01');
    }
    else{
        $sdate = $_POST['sdate'] == '' ? '' :$_POST['sdate'];
        $edate = $_POST['edate'] == '' ? '' :$_POST['edate'];
        $date = date('Y-m-01', strtotime($_POST['edate']));
    }
    
    for ($i = 7; $i > -1; $i--) {
        $months = date("F Y", strtotime( $date. " -$i months"));
        $timestamp = strtotime($months);
        $first_second = date('Y-m-01 ', $timestamp);
        $last_second = date('Y-m-t ', $timestamp);
        $booking = 0;
        $quickPay = 0;
        $booking = MonthlyBookingEarning($first_second, $last_second,'be');
        $quickPay = MonthlyQuickPayEarning($first_second, $last_second);
        $totalBook = round($booking + $quickPay);

        $dateprint = date('M', strtotime($months));
        $chartBarData[] = [
            'day' => $dateprint,
            'booking' => $totalBook,
        ];
    }
    echo json_encode($chartBarData);
}


if ($type == 'varifyPaymentCheck') {

    $result = setPaymentVerifyCheckBox();
    echo json_encode($result);
}

if ($type == 'cancelVarifyPaymentCheck') {
    $result = setPaymentVerifyCheckBox('uncheck');
    echo json_encode($result);
}
if ($type == 'checkVerifiedOrNot') {
    $ans = checkVerifiedOrNot();
    echo json_encode($ans);
}
if ($type == 'loadGuestPaymentDetails') {
    $date = $_POST['date'];
    $data = getGuestPaymentDetails('', $date);
    $html = '';

    foreach ($data as $val) {
        $guestDetails =  getBookingDetailById($val['proId']);
        // pr($guestDetails);
        if ($val['number_of_openFolio'] > 0) {
            $setteledbtn_name = 'Show <span class="numberoffoliomsg">' . $val['number_of_openFolio'] . '</span>';
            $data_operation = 1;
            $paymentvalue = "";
        } else if ($val['number_of_openFolio'] == 0) {
            $setteledbtn_name = 'Show';
            $data_operation = 0;
            $paymentvalue = "checked disabled";
        }
        $total_amount_paid = $val['total_amount'];
        $html .= '<tr>
    <td>' . $guestDetails['name'] . '</td>
    <td>' . $guestDetails['guestArray'][0]['phone'] . '</td>  
    <td>' . $guestDetails['totalPrice'] . '</td>
    <td>' . $total_amount_paid . '</td>  
    <td>
    <button type="button" class="btn mt-1 me-2 mb-1" data-bid="' . $val['bid'] . '" data-oprt="' . $data_operation . '" id="detailsall" style="position:relative;">' . $setteledbtn_name . '</button>
    </td>
    </tr>';
    }
    echo $html;
}

if ($type == 'allSetelement') {
    $bid = $_POST['bid'] == '' ? 0 : $_POST['bid'];
    $date = $_POST['date'];
    $result = setSettelement($bid, '', $date);
    if ($result) {
        $data = [
            'status' => 'ok',
            'msg' => "Updated"
        ];
    } else {
        $data = [
            'status' => 'no',
            'msg' => "Sorry"
        ];
    }
    echo json_encode($data);
}

if ($type == 'paymentHistDetails') {
    $bid = $_POST['bid'];
    $date = $_POST['date'];

    $data = getPaymentHistDetails($bid, $date);

    $html = '
    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
    <table class="table">
    <thead>
      <tr>
        <th > 
        <input type="checkbox" class="" data-bid=' . $bid . ' id="paaaymentsetteledBtn"></th>
        <th >sl</th>
        <th >Amount</th>
        <th >Type</th>
      </tr>
    </thead>
    <tbody>
   

';
    $sl = 1;
    // pr($data);
    foreach ($data as $val) {
        if ($val['openFolio'] == 0) {
            $value = "checked disabled";
            $data_opr = 0;
        } else {
            $value = "";
            $data_opr = 1;
        }
        $payment_type = getPaymentTypeMethod($val['paymentMethod'])[0]['name'];

        $html .= '
    <tr>
        <td> <input type="checkbox" class="" data-opr= ' . $data_opr . ' data-bid = ' . $val['bid'] . ' data-id=' . $val['id'] . '  id="singlePaaaymentsetteledBtn" ' . $value . '/></td>
        <td>' . $sl . '</td>
        <td>' . $val['amount'] . '</td>
        <td>' . $payment_type . '</td>
  </tr>
    ';
        $sl++;
    }

    $html .= '
</tbody>
</table>
</div>
';
    echo $html;
}
if ($type == 'singlePaymentHistDetais') {
    $id = $_POST['id'];
    $bid = $_POST['bid'];
    $result =  setSettelement($bid, $id);
    if ($result) {
        $data = [
            'status' => 'ok',
            'msg' => 'Updated'
        ];
    } else {
        $data = [
            'status' => 'no',
            'msg' => "Sorry"
        ];
    }
    echo json_encode($data);
}

if ($type == 'checkAllBoxSelectOrNot') {
    $bid = $_POST['bid'];
    // $date = $_POST['date']==''?;
    $result = getGuestPaymentDetails($bid);
    // pr($result);
    if ($result[0]['number_of_openFolio'] > 0) {
        echo 'no';
    } else if ($result[0]['number_of_openFolio'] == 0) {
        echo 'ok';
    }
}

if ($type == 'paymentProofChecked') {
    $result = setPaymentProofCheckBox();
    echo json_encode($result);
}
if ($type == 'cancelPaymentProofChecked') {
    $result = setPaymentProofCheckBox('uncheck');
    echo json_encode($result);
}

if ($type == 'loadExtraChargesDetails') {
    $html = '';
    $tablebody = '';
    $sl = 1;
    foreach (getExtraChargeDetails() as $val) {
        $editbtn = '<a class="tableIcon update bg-gradient-info" id="updateIcon" href="javascript:void(0)" data-id="'.$val['id'].'" data-tooltip-top="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a>';
        $deletebtn ='<a class="tableIcon delete bg-gradient-danger" id="deleteIcon" href="javascript:void(0)" data-id="'.$val['id'].'" data-tooltip-top="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path></svg><!-- <i class="far fa-trash-alt"></i> Font Awesome fontawesome.com --></a>';
        $tablebody .= '
                <tr>
                <td scope="row">' . $sl . '</td>
                <td>' . $val['name'] . '</td>
                <td>' . $val['amount'] . '</td>
                <td>' . $editbtn .'  '.$deletebtn.'</td>  
                </tr>
            ';
        $sl++;
    }


    $html .= '
                <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Sl no</th>
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                    ' . $tablebody . '
            </tbody>
            </table>
        ';
    echo $html;
}
if($type =='EditExtraChargesDetails'){
    $dataId = isset($_POST['dataid']) ?$_POST['dataid'] : '';


    $data = getExtraChargeDetails($dataId);
   
    echo json_encode($data);
}

if($type == 'updateChargeList'){


    $dataId =$_POST['hiddenId'];
    $name =$_POST['chargename'];
    $amount =$_POST['amount'];




    $result = setExtraChargeList($name,$amount,$dataId);
    if($result){
        $data = array(
            'status'=>'ok',
            'msg'=>'Charge List Updated'            
        );
    }
    else{
        $data = array(
            'status'=>'no',
            'msg'=>'Sorry Something Went Wrong!'            
        );
    }


    echo json_encode($data);
}
if($type == 'deleteList'){
    $id = $_POST['id'];
    $result = deleteChargeList($id);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
if($type == 'folioHistory'){
    $bid = $_POST['bid'];
    $data = array();
    $val = getFolioHistory($bid);   
    echo json_encode($val);
}

?>





