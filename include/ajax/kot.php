<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_kot.php');
include (SERVER_INCLUDE_PATH.'add_to_stock.php');
$kotObj = new add_to_kot();
$stockObj = new add_to_stock();


if(isset($_POST['type'])){
    $type = $_POST['type'];
}else{
    $type = '';
}

if($type == 'kotSeviceList'){
    $html = '';
   
    foreach(getKotService('','yes') as $key=>$kotServiceList){
        $active = '';
        $name = $kotServiceList['name'];
        $id = $kotServiceList['id'];

        if(isset($_SESSION['kotSeviceId']) && $_SESSION['kotSeviceId'] != ''){
            if($id == $_SESSION['kotSeviceId']){
                $active = 'active';
            }
        }else{
            if($key == 0){
                $active = 'active';
            }
        }
        
        $tableNumberHtml = getServicePropertyListHtml($id);
        $serviceProListHtml = '';
        
        $kotTableUrl = FRONT_SITE.'/kot/table';
        $serviceValueHtml = 'Select';
        $serviceIcon = '';
        

        if($kotServiceList['bdTable'] != ''){

                $serviceIcon = '<i class="bi bi-caret-down"></i>';
                $serviceProListHtml = '
                
                    <ul class="kotOrderContentNumArea">
                        '.$tableNumberHtml.'
                    </ul>
            ';
            
            
        }
        
        $html .= '<ul><li class="kotServiceListItem '.$active.'" data-serviceId="'.$id.'">
                    <div class="textArea"><span class="serviceName">'.$name.'</span> '.$serviceIcon.'</div>
                    '.$serviceProListHtml.'
                </li></ul>';
    }

    echo  $html;
}

if($type == 'kotProductList'){
    $kpid = $_POST['kpid'];
    $serviceIdWhenBlack = getKotService('','yes')[0]['id'];
    $kcid = $_POST['kcid'];
    $spname = $_POST['spname'];
    $mealTime = $_POST['spname'];
    $catId = $_POST['cat'];
    $tableId = $_POST['tableId'];
    $html = '';
    $date = date('Y-m-d');

    if($catId == ''){
        restartKot();
    }
    
    $serviceId = (isset($_SESSION['kotSeviceId'])) ? $_SESSION['kotSeviceId'] : 1;
    $_SESSION['kotServiceProperty'] = $tableId;
    if(isset(getKotOrder('',$date,'','','',$serviceId,$tableId,0)[0])){
        $orderArry = getKotOrder('',$date,'','','',$serviceId,$tableId,0)[0];  
        $_SESSION['existPOSOrderId'] = $orderArry['id'];
        $_SESSION['kotTotalGuest'] = $orderArry['totalPerson'];
        $_SESSION['kotWaiter'] = $orderArry['waiter'];
        $_SESSION['kotNotes'] = $orderArry['noteAdd'];
        $orderId = $_SESSION['existPOSOrderId'];
        if(isset(getGuestDetail('','','','','','','','','pos',$orderId)[0])){
            $guestArry = getGuestDetail('','','','','','','','','pos',$orderId)[0];
            $_SESSION['kotGuestDetail'] = [
                'name'=>$guestArry['name'],
                'email'=>$guestArry['email'],
                'phone'=>$guestArry['phone'],
            ];
        }

        foreach(getKotOrderDetail($orderId) as $orderItem){
            $proId = $orderItem['proId'];
            $qty = $orderItem['qty'];

            $oderDetailArry[$proId] = ['qty'=>$qty,'note'=>''];
        }
        
        $_SESSION['kot'] = $oderDetailArry;
    }

    if(count(getKotProduct($kpid,'yes',$kcid,'',$spname,'','','',$catId)) > 0){

        foreach(getKotProduct($kpid,'yes',$kcid,'',$spname,'','','',$catId,'name') as $kotServiceList){
            $name = $kotServiceList['name'];
            $price = $kotServiceList['price'];
            $id = $kotServiceList['id'];
            $productcat = $kotServiceList['productcat'];
            $checked = '';            
            $catClass = '';
            if($productcat == 2){
                $catClass = 'veg';
            }
            if($productcat == 3){
                $catClass = 'non-veg';
            }
            // echo var_dump(isset($_SESSION['kot']));
            
            if(isset($_SESSION['kot'])){
                if(array_key_exists($id, $_SESSION['kot'])){                   
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
            }
            
            $html .= "<li><input $checked type='checkbox' class='kotProductItemList' name='kotServiceMenu' id='kotServiceMenu$id' value='$id'/>
                <label class='hoverEffect $catClass' for='kotServiceMenu$id'><span class='circle'></span><div class='item'><p>$name</p></div></label>
            </li>";
            
        }
    }else{
        $html .= "<li><span>No Data</span></li>";
    }    

    echo $html;
}

if($type == 'kotInvoice'){

    $kotItemId = $_POST['itemId'];
    $kotServiceId = $_POST['serviceId'];
    $kotItemRemove = $_POST['itemRemove'];
    $kotType = $_POST['kotType'];
    $resultType = 'test';
    $kotItemPrice = '';
    $html = '';
    $totalKotProductPrice = '';

    
    if($kotServiceId != ''){
        $kotObj->emptyKot();
    }

    if($kotItemRemove == ''){
        $kotObj->addkot($kotItemId,1);
    }else{
        $kotObj->removekot($kotItemId);
    }

    if($kotType == 'kotItemQt'){
        $kotItemId = $_POST['itemId'];
        $kotItemQt = $_POST['itemQt'];
        $kotObj->updateKotQt($kotItemId,$kotItemQt);
        $kotPrice = getKotProduct($kotItemId)[0]['price'];
        $kotItemPrice = $kotPrice * $kotItemQt;
        $totalKotProductPrice = getRupeesFormat(getAddKotProductDetail()['totalProduct']);
    }
   
    if(!isset($_SESSION['kot'])){
        $_SESSION['kot'] = array();
    }

    if(empty($_SESSION['kot'])){
        unset($_SESSION['kotDiscountProperty']);
        unset($_SESSION['kotDiscountAmount']);
        unset($_SESSION['kotTypeSgst']);
        unset($_SESSION['kotTypeCgst']);
        unset($_SESSION['kotTypeIgst']);
        unset($_SESSION['kotAdvaceBalance']);
    }

    $kotDetailArray = getAddKotProductDetail();
    $totalKotProductPrice = getRupeesFormat($kotDetailArray['totalProduct']);
    $subTotalAmount = getRupeesFormat($kotDetailArray['subTotal']);

    $activeCgstCheck = '';
    $activeSgstCheck = '';
    $activeIgstCheck = '';
    $kotAdvaceBalance = '';
    
    if(isset($_SESSION['kotTypeCgst']) && $_SESSION['kotTypeCgst'] == 'true'){
        $activeCgstCheck = 'checked'; 
    }
    if(isset($_SESSION['kotTypeSgst']) && $_SESSION['kotTypeSgst'] == 'true'){
        $activeSgstCheck = 'checked';
    }

    if(isset($_SESSION['kotTypeIgst']) && $_SESSION['kotTypeIgst'] == 'true'){
        $activeIgstCheck = 'checked';
    }

    if(isset($_SESSION['kotAdvaceBalance']) && $_SESSION['kotAdvaceBalance'] != ''){
        $kotAdvaceBalance = $_SESSION['kotAdvaceBalance'];
    }

    
    $taxAmount = getRupeesFormat($kotDetailArray['tax']);
    $totalAmount = getRupeesFormat($kotDetailArray['totalPrice']);
    
    $kotAdvancePay = getRupeesFormat($kotDetailArray['kotAdvancePay']);

    $kotBalancePay = getRupeesFormat($kotDetailArray['kotBalancePay']);

    $disable = 'disabled';
    if(count($_SESSION['kot']) > 0){
        $disable = '';
    }

    $countItem = 0;
    
    if($kotType == ''){
        $resultType = 'test';
        
        $kotItemListHtml = '';
        $editIcin = FRONT_SITE_IMG.'/icon/edit.png';
        
        if(isset($_SESSION['kot'])){
            foreach($_SESSION['kot'] as $key => $kotItemList){
                $countItem ++;
                $kotItemId = $key;
                $kotItemQty = $kotItemList['qty'];
                $kotItemNote = $kotItemList['note'];
                $kotItemArray = getKotProduct($kotItemId)[0];
                $itemName = $kotItemArray['name'];
                $itemPrice = $kotItemArray['price'] * $kotItemQty;
               
                
                $kotItemListHtml .= '
                    <li>
                        <div class="rightSide">
                            <h6>'.$itemName.'</h6>
                        </div>
                        <div class="incDecBtn">
                             <button type="button" class="altera decrescimo" data-kotitemid="'.$kotItemId.'">-</button>
                            <input type="text" class="txtAcrescimo kotItemQuantity" data-kotitemid="'.$kotItemId.'" value="'.$kotItemQty.'"/>
                           
                            <button type="button" class="altera acrescimo" data-kotitemid="'.$kotItemId.'">+</button>
                        </div>
                        <div class="leftSide">
                            <p>₹ <strong id="kotSingleItemPrice'.$kotItemId.'">'.$itemPrice.'</strong></p>
                            
                        </div>
                    </li>
                ';
            }
        }

        $kotItemListHtml = ($kotItemListHtml == '') ? '<li> No Data </li>' : $kotItemListHtml;

        $discountContent = '';
        $kotDiscountPro = ['percentage'=>'%', 'fixed'=>'₹'];

        $kotDiscountProperty = '';
        $kotDiscountAmount = '';

        if(isset($_SESSION['kotDiscountProperty']) && isset($_SESSION['kotDiscountAmount'])){
            $kotDiscountProperty = $_SESSION['kotDiscountProperty'];
            $kotDiscountAmount = $_SESSION['kotDiscountAmount'];
            $discountContent = 'show';
        }
        $proCoontent = '';
        foreach($kotDiscountPro as $key=>$val){
            $proId = $key;
            $proName = $val;
            if($kotDiscountProperty == $key){
                $proCoontent .= "<option selected value='$proId'>$proName</option>";
            }else{
                $proCoontent .= "<option value='$proId'>$proName</option>";
            }
        }

        $paymentMethodHtml = '';

        foreach(getPaymentTypeMethod('',1) as $paymentMethodList){
            $paymentName = $paymentMethodList['name'];
            $paymentId = $paymentMethodList['id'];
            $paymentMethodHtml .= "<option value='$paymentId'>$paymentName</option>";
        }

        $paymentType = (isset($_SESSION['kotAdvaceBalance']) && $_SESSION['kotAdvaceBalance'] > 0) ? '' : 'disabled';
        
        $html = '
                <ul class="kotTableLi content scrollBar">
                    <li>
                        <ul>
                            '.$kotItemListHtml.'
                        </ul>
                    </li>

                    <li>
                        <p> Total product Amount </p>
                        <p class="strong" id="totalaKotPrice"> ₹ '.$totalKotProductPrice.' </p>
                    </li>
                    
                    
                    <li>
                        <p>Sub Total</p>
                        <p class="strong" id="subTotalPrice">₹ '.$subTotalAmount.'</p>
                    </li>

                    <li>
                        <p>Tax Amount</p>
                        <p class="strong" id="taxPrice">₹ '.$taxAmount.'</p>
                    </li>
                    
                </ul>

        
        ';

    }
    
    $data = [
        'type'=>$resultType,
        'data'=> $html,
        'kotSingleItemPrice'=>$kotItemPrice,
        'totalKotProductPrice'=>$totalKotProductPrice,
        'subTotalPrice'=>$subTotalAmount,
        'taxPrice'=>$taxAmount,
        'totalAmount'=>$totalAmount,
        'kotAdvancePay'=>$kotAdvancePay,
        'payBalance'=>$kotBalancePay,
        'disable'=>$disable,
        'countItem'=>$countItem,
    ];

    echo json_encode($data);
}

if($type == 'conformKotOrder'){
    
    $name= '';$num='';$email='';
    $tid=(isset($_SESSION['kotServiceProperty'])) ? $_SESSION['kotServiceProperty'] : '';
    if(isset($_SESSION['kotGuestDetail'])){
        $arrayData = $_SESSION['kotGuestDetail'];
        $name= (isset($arrayData['name'])) ? $arrayData['name'] : '';
        $num=(isset($arrayData['phone'])) ? $arrayData['phone'] : '';
        $email=(isset($arrayData['email'])) ? $arrayData['email'] : '';        
    }
    $resId = $_POST['resId'];
    $data = setKOTOrderConform($name,$num,$email,$tid,$resId);
    

    echo json_encode($data);


}

if($type == 'showPosInvoice'){
    echo posInvoiceReceipt($_SESSION['kotOrderId']);
}


function kotAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
    
    $formId = 'addKotFoodForm';
    $kotFoodItemName =  '';
    $roomBtn = "Add Food";
    $updateSalesHtml = '';

    $kotFoodItemPrice = '';
    $kotFoodCatId = '';
    $FoodCat = 0;
    $kotMealTimeId = array();

    $bseOption = '';
    foreach(getBookingSource() as $bsList){
        $name = $bsList['name'];
        $id = $bsList['id'];
        $img = $bsList['img'];
        $bseOption .= "<option value='$id'>$name</option>";
    }

    if($rnid != ''){
        $row = getKotProduct($rnid)[0];  
        $kotFoodItemName = $row['name'];
        $roomBtn = "Update Food";
        $updateSalesHtml = '<input type="hidden" name="kotFoodId" value="'.$rnid.'" required>';
        $kotFoodItemPrice = $row['price'];
        $kotFoodCatId = $row['productcat'];
        $FoodCat = $row['pCat'];
    }

    $fotCatHtml = '';

    foreach(getKotCategory() as $foodCatList){
        $id = $foodCatList['id'];
        $name = ucfirst($foodCatList['name']);
        $active = '';
        if($id == $kotFoodCatId){
            $active = 'checked'; 
        }

        $fotCatHtml .= '
                <div class="form-check form-check-inline">
                    <input name="kotFoodCat[]" '.$active.' class="form-check-input" type="radio" value="'.$id.'" id="kotFoodCat'.$id.'">
                    <label class="form-check-label" for="kotFoodCat'.$id.'">'.$name.'</label>
                </div>
        ';
    }

    $foodCatListHtml = '';

    foreach(getBeKotCategory() as $catItem){
        $id = $catItem['id'];
        $name = ucfirst($catItem['name']);
        $active = '';
        
        if($id == $FoodCat){
            $active = 'selected'; 
        }

        $foodCatListHtml .= '
            <option '.$active.' value="'.$id.'">'.$name.'</option>
        ';
    }

    $html ='
        <form action="" method="post" id="'.$formId.'">
            <div class="form-group">
                <label for="kotFoodItemName">Item Name</label>
                <input type="text" class="form-control" name="kotFoodItemName" id="kotFoodItemName" value="'.$kotFoodItemName.'" required>
            </div>
            '.$updateSalesHtml.'

            <div class="row">
                <div class="col-md-6">
                    <div class="dFlex aic jcsb">
                        <div>
                            '.$fotCatHtml.'
                        </div>
                    </div>                    
                </div>

                <div class="col-md-6">
                    <select name="foodCat" id="foodCat" class="form-control">
                        <option value="0">Select category</option>
                        '.$foodCatListHtml.'
                    </select>                   
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="kotFoodItemPrice">Item Price</label>
                        <input type="text" class="form-control" name="kotFoodItemPrice" id="kotFoodItemPrice" value="'.$kotFoodItemPrice.'" required>
                    </div>
                </div>

            </div>
        </form>
    ';

    return $html;
}

function formDataInsert($id='',$name,$cat,$price,$itemCategory){
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $statusSec = '';
    $cat = implode(',', $cat);
    

    if($id != ''){
        $sql = "update  kotprouct_hotel  set name = '$name', price='$price',productcat='$cat',pCat='$itemCategory' where id = '$id'";
    }else{
        if(count(getKotProduct('','','','',$name)) == 0){
            $sql = "insert into  kotprouct_hotel (hotelId,name,price,productcat,pCat) values('$hId','$name','$price','$cat','$itemCategory')";
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Already exist Food Name !'
            ];
        }
    }
    
    if($sql != ''){
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully add food name'
            ];
        }else{
            $data = [
                'error'=>'yes',
                'msg'=>'Something wrong!'
            ];
        }
    }
    
    
    
    
    echo json_encode($data);
    

}

if($type == 'loadKotProList'){    

    $html = '<table id="kotDataTable" class="table align-items-center mb-0 tableLine rt hover" >
                <thead><tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr></thead>';   
    
            $si = 0;
            if(count(getKotProduct()) > 0){
                foreach(getKotProduct() as $kotProList){
                    $si++;
                    $id = $kotProList['id'];
                    $name = $kotProList['name'];
                    $price = $kotProList['price'];
                    $productcat = $kotProList['productcat'];
                    $mealTimeArray = explode(',', $kotProList['mealTime']);
                    $productcatName = getKotCategory($productcat)[0]['name'];
                    $productcatClr = getKotCategory($productcat)[0]['color'];
                    $status = $kotProList['status'];
                    $time = formatingDate($kotProList['addOn']);

                    $mealTimeData = array();
                    foreach($mealTimeArray as $item){
                        $mealTimeData[] = getKotMealTime($item)[0]['name'];
                    };

                    $mealTimeDataStr = ucfirst((isset(getBeKotCategory($kotProList['pCat'])[0])) ? getBeKotCategory($kotProList['pCat'])[0]['name'] : '');
    
                    if($status == 1){
                        $statusHtml = "<a class='tableIcon status bg-gradient-success deactive' href='javascript:void(0)' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Deactive'><i class='far fa-eye'></i></a>";
                    }else{
                        $statusHtml = "<a class='tableIcon status bg-gradient-warning  active' href='javascript:void(0)' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Active'><i class='far fa-eye-slash'></i></a>";
                    }
    
                    $deleteHtml = "<a class='tableIcon delete bg-gradient-danger' href='javascript:void(0)' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Delete'><i class='far fa-trash-alt'></i></a>";
                    $updateHtml = "<a class='tableIcon update bg-gradient-info' href='javascript:void(0)' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>";
                    
                    $html .= "<tr>
    
                                <td data-label='Sl' class='center mb-0 bold'>$si</td>
                                <td data-label='Item Name' class='center mb-0 bold'>$name</td>
                                <td data-label='Price' class='center mb-0 bold'>$price</td>
                                <td data-label='Category' class='center mb-0 bold'>
                                    <div class='mealCat'>
                                        <span class='colorBox' style='border: 1px solid $productcatClr;'>
                                            <span style='background: $productcatClr;'></span>
                                        </span> $productcatName
                                    </div> 
                                </td>
                                <td data-label='Add On' class='center mb-0 bold'> $mealTimeDataStr </td>
                                <td data-label='Action'>
                                    <div class='tableCenter'>
                                        <span class='tableHide'><i class='fas fa-ellipsis-h'></i></span>
                                        <span class='tableHoverShow'>
                                            $statusHtml
                                            $updateHtml
                                            $deleteHtml
                                        </span>
                                    </div>
                                    
                                </td>
                            </tr>";
                }
            }else{
                $html .= "<tr>
                            <td colspan='6' style='text-align:center'>No Data</td>
                        </tr>";
            }
            

            $html .= "</table>";

            echo $html;
}

if($type == 'addKotForm'){
    $id = (isset($_POST['id']) ? $_POST['id'] : '');
    echo kotAddForm($id);
}

if($type == 'submitKotAddFood'){
    
    $kotFoodItemName = $_POST['kotFoodItemName'];
    $foodCat = $_POST['kotFoodCat'];
    $kotFoodItemPrice = $_POST['kotFoodItemPrice'];
    $itemCategory = $_POST['foodCat'];
    $kotFoodId = (isset($_POST['kotFoodId']))? $_POST['kotFoodId'] : '';
    
    formDataInsert($kotFoodId,$kotFoodItemName,$foodCat,$kotFoodItemPrice,$itemCategory);
    
} 

if($type == 'statusUpdate'){
    $sid = $_POST['rnid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from  kotprouct where id='$sid'"));
    if($sql['status'] == 1){
        $query = "update  kotprouct set status = '0' where id='$sid'";
    }else{
        $query = "update  kotprouct set status = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}

if($type == 'deleteRoomNumber'){
    $did = $_POST['rnid']; 
    $sql = "update kotprouct set deleteRec = '0' where id='$did'";
    if (mysqli_query($conDB, $sql)) {
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'editKotFoodForm'){
    $hid = $_POST['rnid'];
    echo kotAddForm($hid);
}

if($type == 'updateKotFood'){
    
    $kotFoodId = $_POST['kotFoodId'];
    $kotFoodItemName = $_POST['kotFoodItemName'];
    $foodCat = $_POST['kotFoodCat'];
    $kotFoodItemPrice = $_POST['kotFoodItemPrice'];
    $kotMealTime = $_POST['kotMealTime'];
    
    formDataInsert($kotFoodId,$kotFoodItemName,$foodCat,$kotFoodItemPrice,$kotMealTime);
    
} 

if($type == 'loadKotTableList'){
    global $conDB;
    (isset($_SESSION['kotSeviceId'])) ? $_SESSION['kotSeviceId'] : $_SESSION['kotSeviceId'] = 1;

    if(isset($_POST['serviceId'])){
        $_SESSION['kotSeviceId'] = $_POST['serviceId'];
    }

    if($_SESSION['kotSeviceId'] == 1){
        $kotRestaurantData = getKotRestaurantData('',$hotelId);   

        $data = [
            'roomsection'=>'0',
            'service'=>$_SESSION['kotSeviceId'],
            'restaurant'=>$kotRestaurantData,
            'table'=>getKotTableData(),
        ];
    }

    if($_SESSION['kotSeviceId'] == 2){
        $kotRestaurantData = getKotRestaurantData('',$hotelId);  

        $data = [
            'roomsection'=>'1',
            'service'=>$_SESSION['kotSeviceId'],
            'restaurant'=>getRoomData(),
            'table'=>getRoomNumber('','','','','','','','','','kotSearch'),
        ];
    }

    echo json_encode($data);
}

if($type == 'addKotTableData'){
    $tNum = trim(safeData($_POST['tNum']));
    if(count(getKotTableData('','','',$tNum)) > 0){
        echo 'exist';
    }else{
        $sql = "insert into kottable(hotelId,tableNum) values('$hotelId','$tNum')";
        if(mysqli_query($conDB, $sql)){
            echo 1;
        }else{
            echo 0;
        }
    }
    
}

if($type == 'deleteKotTableData'){
    $tid = safeData($_POST['tid']);
    $sql = "update kottable set deleteRec='0' where id='$tid'";
    if(mysqli_query($conDB,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}


if($type == 'loadKotOrderList'){
    $date = ($_POST['date'] == '') ? date('Y-m-d') : $_POST['date'];
    $page = $_POST['page'];
    $search = $_POST['search'];

    $html = '<table id="kotDataTable" class="table align-items-center mb-0 tableLine rt hover br" >
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Date</th>
                        <th scope="col">Bill No</th>
                        <th scope="col">Bill To</th>
                        <th scope="col">Sub total</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';

   
    
            $si = 0;
            
            if(count(getKotOrder('',$date)) > 0){
                $countSubTotal = 0;
                $countkotDisValue = 0;
                $countTax = 0;
                $countTotalPrice = 0;
                foreach(getKotOrder('',$date) as $kotOrderList){
                    $si++;
                    $id = $kotOrderList['id'];
                    $personId = $kotOrderList['personId'];
                    $totalProductPrice = $kotOrderList['totalProductPrice'];
                    $kotDisPro = $kotOrderList['kotDisPro'];
                    $countkotDisValue += $kotOrderList['kotDisValue'];
                    $kotDisValue = number_format($kotOrderList['kotDisValue']);
                    $countSubTotal += $kotOrderList['subTotal'];
                    $subTotal = number_format($kotOrderList['subTotal'],2);
                    $countTax += $kotOrderList['tax'];
                    $tax = number_format($kotOrderList['tax'], 2);
                    $countTotalPrice +=  $kotOrderList['totalPrice'];
                    $totalPrice = number_format($kotOrderList['totalPrice'],2);
                    $kotBalancePay = $kotOrderList['kotBalancePay'];
                    $orderStatus = $kotOrderList['orderStatus'];
                    $billno = $kotOrderList['billno'];
                    $serviceId = $kotOrderList['serviceId'];                
                    $servicePropertyId = $kotOrderList['servicePropertyId'];
                    $time = date('M d', strtotime($kotOrderList['addOn']));
                    
                    $billNoHtml = 'kot-'.threeNumberFormat($billno);
                    $billToHtml = (count(getServicePropertyListHtml($serviceId,'',$servicePropertyId,'yes')) > 1) ? getKotService($serviceId)[0]['name'].'@'.getServicePropertyListHtml($serviceId,'',$servicePropertyId,'yes')['name'] : getKotService($serviceId)[0]['name'];
    
                    $disPeoHtml = ($kotDisPro == '' || $kotDisPro == 0) ? '' : "($kotDisPro %)";
    
                    $downloadLink = FRONT_SITE.'/voucher?kot='.$id;
                    $downloadHtml = "<a class='tableIcon bg-gradient-info downloadKotOrder' href='$downloadLink' data-rnid='$id' data-tooltip-top='Download'><i class='bi bi-download'></i></a>";
                    $printLink = FRONT_SITE.'/voucher?kot='.$id.'&type=I';
                    $printHtml = "<a target='_blank' class='tableIcon bg-gradient-info downloadKotOrder' href='$printLink' data-rnid='$id' data-tooltip-top='Print'><i class='bi bi-printer'></i></a>";
    
                    if($orderStatus == 1){
                        $statusHtml = "<a class='bg-gradient-success settleOrderBtn' href='javascript:void(0)' data-rnid='$id' data-tooltip-top='Confirm'>Settle</a>";     
                        $orderStatusClass = 'confirmOrder';               
                    }else{
                        $statusHtml = "<a class='bg-gradient-warning settleOrderBtn settleKotOrder' href='javascript:void(0)' data-tooltip-top='Settle' data-rnid='$id'>Unsettle</i></a>";
                        $orderStatusClass = '';
                        $deleteHtml = "<a class='tableIcon delete bg-gradient-danger deleteKotOrder' href='javascript:void(0)' data-rnid='$id' data-tooltip-top='Delete'><i class='far fa-trash-alt'></i></a>";
                    }
    
                    
                  
                    
                    $html .= "<tr class='$orderStatusClass'>
    
                                <td data-label='SN' class='center mb-0 bold'>$si</td>
                                <td data-label='Date' class='center mb-0 bold'>$time</td>
                                <td data-label='Bill No' class='center mb-0 bold'>$billNoHtml</td>
                                <td data-label='Bill To' class='center mb-0 bold'>$billToHtml</td>
                                <td data-label='Sub total' class='center mb-0 bold'>₹ $subTotal</td>
                                <td data-label='Discount' class='center mb-0 bold'>₹ $kotDisValue $disPeoHtml</td>
                                <td data-label='Tax' class='center mb-0 bold'>₹ $tax</td>
                                <td data-label='Total' class='center mb-0 bold'>₹ $totalPrice</td>
                                <td data-label='Status' class='center mb-0 bold'>$statusHtml</td>
                                <td data-label='Credit'>
                                    <div class='tableCenter'>
                                        <span class='tableHide'><i class='fas fa-ellipsis-h'></i></span>
                                        <span class='tableHoverShow'>
                                            $downloadHtml $printHtml
                                        </span>
                                    </div>
                                    
                                </td>
                            </tr>";
                }

                $countSubTotal = number_format($countSubTotal, 2);
                $countkotDisValue = number_format($countkotDisValue, 2);
                $countTax = number_format($countTax, 2);
                $countTotalPrice = number_format($countTotalPrice, 2);
    
                $html .= "
                    <tr>
    
                        <td class='center mb-0 bold' colspan='4'>Total</td>
                        <td class='center mb-0 bold'>₹ $countSubTotal</td>
                        <td class='center mb-0 bold'>₹ $countkotDisValue</td>
                        <td class='center mb-0 bold'>₹ $countTax</td>
                        <td class='center mb-0' colspan='3' style='font-weight: 900;'>₹ $countTotalPrice</td>
                    </tr>
                ";
            }else{
                $html .= "
                    <tr>
                        <td colspan='10'>No Data</td>
                    </tr>
                ";
            }
            
            

            $html .= "</tbody>
            </table>";

            echo $html;
}

if($type == 'checkSeviceProExist'){
    if(isset($_SESSION['kotSeviceId'])){
        $msg = getKotService($_SESSION['kotSeviceId'])[0]['name'];
        $data = [
            'error'=> 'yes',
            'msg'=>$msg
        ];
    }
    if(isset($_SESSION['kotServiceProperty'])){
        $data = [
            'error'=> 'no',
            'msg'=>''
        ];
    }

    echo json_encode($data);
}

if($type == 'settleStatusUpdate'){
    $sid = $_POST['rnid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from  kotorder where id='$sid'"));
    if($sql['orderStatus'] == 1){
        $query = "update  kotorder set orderStatus = '0' where id='$sid'";
    }else{
        $query = "update  kotorder set orderStatus = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}


// Stock Managment List 

function stockFormContentWithData($stockId='',$qty='',$price='',$actionStatus = 'add',$updateContent=''){
    
    $stockNamleSize = '';
    $show ='';
    $proName = '';
    $proPriceCalculate = '';
    $updateSalesHtml = '<input type="hidden" name="stockPId[]" value="'.$stockId.'"/>';
    $disable = '';
  
    if($stockId != ''){
        $stockNamleSize = 'col-5 rawProAdded';
        $show ='show';
        
        $rowpId = getKotStaockExistData($stockId) ;
        // $rowpId = '';
        $pid = getKotStockRawProductList($rowpId)[0]['id'];
        $proName = getKotStockRawProductList($pid)[0]['name'];
        $proPriceCalculate = getKotStockRawProductList($pid)[0]['priceCalculateBy'];    
    }

    if($qty == 0){
        $stockHtml = '<input name="totalQty[]" id="buyQty'.$stockId.'" class="buyQtyInput form-control" value="'.$qty.'" autocomplete="off"/><input name="stockAction[]" type="hidden" value="buy"/><span class="error"></span>';
        $sellHtml = '<p></p>';
        $priceRequied = 'required';
        $stockPriceHtml = '<input name="stockPrice[]" id="stockPrice'.$stockId.'" class="stockPriceInput form-control '.$priceRequied.'" placeholder="Enter Price" /><span class="error"></span>';
    }else{
        $stockHtml = "<p>$qty $proPriceCalculate</p>";
        $sellHtml = '<input name="totalQty[]" id="sellQty'.$stockId.'" class="sellQtyInput form-control" value="" autocomplete="off"/><input name="stockAction[]" type="hidden" value="sell"/>';
        $priceRequied = '';
        $stockPriceHtml = '<div>'.$price.'</div>';
    }

    


    $qntWrapHtml = '
                        <label for="stockQty">Quantity In '.$proPriceCalculate.'</label>
                        <div class="inputField">
                            <input name="stockQty[]" id="stockQty'.$stockId.'" class="stockQtyInput form-control" value="'.$qty.'"/>
                        </div>';

    if($updateContent != ''){
        $qntWrapHtml = '<div class="qtyWrap">
            <div class="stockField">
                <h4>Stock</h4>
                '.$stockHtml.'
            </div>
            <div class="inputField">
                <label for="sellQty">Consume</label>                                
                '.$sellHtml.'
            </div>
        </div>';
        $disable = 'disable';
        $updateSalesHtml = '<input type="hidden" name="updateStockPId[]" value="'.$stockId.'" required>';           
    }

    if($actionStatus == 'add'){
        $actionContent = '<i class="bi bi-folder-plus stockListAddBtn '.$disable.'"></i>';
    }else{
        $actionContent = '<i class="bi bi-trash3 stockListDeleteBtn '.$disable.'"></i>';
    }
    
    $data = '
        <div class="row align-items-end justify-content-between">
            <div class="form-group '.$stockNamleSize.'">
                <label for="kotFoodItemName'.$stockId.'">Item Name</label>
                <input type="text" class="form-control kotFoodItemName" name="kotFoodItemName[]" id="kotFoodItemName'.$stockId.'" value="'.$proName.'" data-pid="'.$stockId.'" required autocomplete="off"/>
                <div class="dropdownRawProduct"></div>
            </div>
            '.$updateSalesHtml.'
            <div class="form-group stockQty col-3 '.$show.'">
                '.$qntWrapHtml.'
            </div>
            <div class="form-group stockPrice col-3 '.$show.'">
                <label for="stockPrice'.$stockId.'">Price</label>
                '.$stockPriceHtml.'
            </div>
            <div class="actionBtn col-auto '.$show.'">
                '.$actionContent.'                
            </div>
            <input type="hidden" id="updateKotStockCheck">
        </div>
        
    ';
    return $data;
}

function getAllStockFormCon($pid=array()){
    // pr($pid);
    $currentDate = date('Y-m-d');
    $html ='';
    if($pid != ''){
        
        foreach($pid as $listOfSId){
            $stockAction = 'delete';
            $stockQty = getKotStockBuyAndSellData($listOfSId)['rest'];
            $stockPrice = getKotStockManagment($listOfSId)[0]['totalPrice'];
            
            $html .= stockFormContentWithData($listOfSId,$stockQty,$stockPrice,$stockAction,'yes');
        }

    }else{
        if(isset($_SESSION['stock'])){
            $lastStockKey = array_key_last($_SESSION['stock']);
            foreach($_SESSION['stock'] as $key=>$stockList){
                $stockAction = 'add';
                if($key != $lastStockKey){
                    $stockAction = 'delete';
                }
                $stockId = $key;
                $stockQty = $stockList['qty'];
                $stockPrice = $stockList['price'];
                $stockUnit = isset($stockList['unit'])?$stockList['unit']:'';
                $html .= stockFormContentWithData($stockId,$stockQty,$stockPrice,$stockAction);
            }
        }else{
            $html .= stockFormContentWithData();
        }
    }
    

    return $html;
}

function kotAddStockForm($sid = ''){
    global $conDB;
    
    $formId = 'addKotStockForm';
    $kotFoodItemName =  '';

    if($sid != ''){
        $formId = 'updateKotStockForm';       
        $roomNumBtn = "Update Stock";       
    }

    $stockFormContent = stockFormContent();
    

    $html ='
        <form class="stockRawProForm" action="" method="post" id="'.$formId.'">
            <div class="stockFormContent">
                '.$stockFormContent.'
            </div>
        </form>
    ';

    return $html;
}

function kotStockFormInsert($id='',$pid='',$totalPrice='',$totalQty='',$action='buy'){
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $addBy = '';
    
    
    
    if($id != ''){
        
        $stock = getKotStockBuyAndSellData($id)['rest'];
        ;
        if($stock == 0){
            $sql = "insert into  kot_stock_timeline(hotelId,action,qty,kotStockId,totalPrice) values('$hId','$action','$totalQty','$id','$totalPrice')";
            mysqli_query($conDB, $sql);
        }else{
            if($stock >= $totalQty){
                $sql = "insert into  kot_stock_timeline(hotelId,action,qty,kotStockId,totalPrice) values('$hId','$action','$totalQty','$id','$totalPrice')";
                mysqli_query($conDB, $sql);
            }
        }
    }else{
        $sql = "insert into  kot_stock(hotelId,rawProId,totalPrice) values('$hId','$pid','$totalPrice')";
        mysqli_query($conDB, $sql);
        $lstId = mysqli_insert_id($conDB);
        mysqli_query($conDB, "insert into kot_stock_timeline(hotelId,action,qty,addBy,kotStockId,totalPrice) values('$hId','$action','$totalQty','$addBy','$lstId','$totalPrice')");
    }
    echo $sql;
    
    
 
}

if($type == 'loadKotRawProduct'){
    $dropdownRawProductHtml = '';
    $searchName = $_POST['searchName'];
    if(count(getKotStockRawProductList('',$searchName,'','','yes')) > 0){
        foreach(getKotStockRawProductList('',$searchName,'','','yes') as $rawProList){
            $rawProId = $rawProList['id'];
            $rawProName = $rawProList['name'];
            $rawProImg = FRONT_SITE_IMG.'kotFood/'.$rawProList['img'];
            $dropdownRawProductHtml .= "
                <li data-rpid='$rawProId'><img width='50px' src='$rawProImg'> <h4>$rawProName</h4></li>
            ";
        }
    }else{
        $dropdownRawProductHtml .= "
                <li><p style='margin: 0;'>No Data</p></li>
            ";
    }
    

    $html = '<div class="closeKotRawProCon">X</div><ul class="dropDownRawProductCon">'.$dropdownRawProductHtml.'</ul>';

    echo $html;
}

if($type == 'loadKotStockList'){

    $html = '<table id="kotDataTable" class="table align-items-center mb-0 tableLine" >
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>In Stock</th>
                    <th>Price</th>
                    <th>Add By</th>
                </tr>
            </thead><tbody>';     

            foreach(getKotStockManagment() as $kotStockList){
                // pr($kotStockList);
                $currentDate = date('Y-m-d');
                $id = $kotStockList['id'];
                $rawProId = $kotStockList['rawProId'];
                $name = ucfirst($kotStockList['name']);
                $totalPrice = number_format($kotStockList['totalPrice']);
                $priceCalculateBy = $kotStockList['priceCalculateBy'];
                $totalQty = getKotStockBuyAndSellData($id)['buy'];
                $addBy = $kotStockList['addBy'];
                $priceCalculateBy = $kotStockList['priceCalculateBy'];
                $img = FRONT_SITE_IMG.'kotFood/'.$kotStockList['img'];
                $time = date('d-M', strtotime($kotStockList['addOn']));
                
                $restQty = getKotStockBuyAndSellData($id)['rest'];
                
                $averagePercentage = round(getPercentageValueByAmount($restQty,$totalQty));
             

                $progressBarClass = getPercentageByClass($averagePercentage);
                
                $inStockHtml = "<div class='inStockContent'>
                                    <div class='numberCon'>
                                        <div class='resultStockCon'>
                                            <span class='restQty'>$restQty</span>
                                            <span>/</span>
                                            <span class='totalQty'>$totalQty</span>
                                            <span> ($priceCalculateBy)</span>
                                        </div>
                                        <div class='editStockConten' data-kotid='$id'><i class='bi bi-pen'></i></div>
                                    </div>
                                    <div class='progress'>
                                        <div class='progress-bar $progressBarClass' style='width: $averagePercentage%;'></div>
                                    </div>
                                </div>";

                $updateHtml = "<a class='tableIcon update bg-gradient-info' href='javascript:void(0)' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>";
                
                $html .= "<tr>

                            <td width='15%' class='center mb-0 bold left'>
                                <input value='$id' class='kotProductInput cp' type='checkbox' name='kotProductStockCheck[]' id='kotProductStockCheck$id'/>
                                <label class='kotProductLabel cp' for='kotProductStockCheck$id'><img width='80px' src='$img' /></label>
                            </td>
                            <td width='25%' class='center mb-0 bold'>$name</td>
                            <td width='30%' class='center mb-0 bold'>$inStockHtml</td>
                            <td width='15%' class='center mb-0 bold'>₹ $totalPrice</td>
                            <td width='15%' class='center mb-0 bold'>$addBy</td>
                        </tr>";
            }


            $html .= "</tbody></table>";

    echo $html;
}

if($type == 'addKotStockForm'){
    $sid = $_POST['sid'];
    echo kotAddStockForm($sid);
}

if($type == 'getAddStockFormCon'){
    echo stockFormContentWithData();
}

if($type == 'kotStockFormSubmit'){
    $kotFoodItemNameArry = $_POST['kotFoodItemName'];
    $stockPIdArry = $_POST['stockPId'];
    $stockQtyArry = $_POST['stockQty'];
    $stockPriceArry = $_POST['stockPrice'];

    foreach($stockPIdArry as $key=>$stockPIdList){
        $pid = $stockPIdArry[$key];
        $qty = $stockQtyArry[$key];
        $price = $stockPriceArry[$key];
        kotStockFormInsert('',$pid,$price,$qty);
    }

    $stockObj->emptyStock();
}


if($type == 'updateKotStockFormSubmit'){
    
    $updateStockPIdArry = $_POST['updateStockPId'];
    $stockPriceArry = $_POST['stockPrice'];
    $totalQtyArry = $_POST['totalQty'];
    $stockActionArry = $_POST['stockAction'];

    foreach($updateStockPIdArry as $key=>$sellPIdList){
        $stockId = $updateStockPIdArry[$key];
        $qty = $totalQtyArry[$key];
        $action = $stockActionArry[$key];
        $price = $stockPriceArry[$key];
 
        kotStockFormInsert($stockId,'',$price,$qty,$action);
    }
}



function addRawProForm($rid = ''){
        
    global $conDB;
    $btn = 'Add Raw Product';
    $header_text = 'Add Raw Product';
    $roomCapacity = '';

    $imgSize = '(900 x 1060)';
    $formBtn ='addRawProSubmitBtn';

    $proName = '';
    $priceCalculateBy = '';
    $proImg = FRONT_SITE_IMG.'demo/kotFood.gif';
    $proTag = '';
    $proSku = '';
    $updateFormHtml = '';

    if($rid != ''){
        $formBtn ='updateRawProSubmitBtn';
        $header_text = 'Update Raw Product';
        $updateFormHtml = "<input name='updateRawProId' value='$rid' type='hidden'/>";

        foreach(getKotStockRawProductList($rid) as $proList){
            $proName = $proList['name'];
            $proSku = $proList['sku'];
            $priceCalculateBy = $proList['priceCalculateBy'];
            $proImg = FRONT_SITE_IMG.'kotFood/'.$proList['img'];
            $proTag = $proList['tag'];
        }

    }

    $inventoryHtml = '';
    
    $roomRateField = '';
    $imgBoxContent = '';


    
        $html = '
        
            <form action="" id="'.$formBtn.'" method="post" enctype="multipart/form-data">

                <div class="row p0">
                    <div class="form_group col-md-6 mb-3">
                        <label for="proName">Product Name *</label>
                        <input class="form-control" type="text" id="proName" name="proName" placeholder="Enter Product Name." value="'.$proName.'" required data-rid="'.$rid.'">
                        <span class="errormsg" id="errorHeader"></span>
                    </div>
                    <div class="form_group col-md-6 mb-3">
                        <label for="prosku">SKU *</label>
                        <input class="form-control" type="text" id="prosku" name="prosku"
                            placeholder="Enter SKU." value="'.$proSku.'" required >
                    </div>
                </div>
                '.$updateFormHtml.'
                <div class="row p0">
                    <div class="form_group col-md-4 mb-3">
                        <label for="priceCalculateBy">Calculate By *</label>
                        <input class="form-control" type="text" id="priceCalculateBy" name="priceCalculateBy"
                            placeholder="Enter Calculate By." value="'.$priceCalculateBy.'" required >
                    </div>
                    <div class="form_group col-md-8 col-sm-12 mb-3 d-flex">
                        <img style="width: 80px;height: auto;margin-right: 10px;object-fit: cover;border-radius: 3px;box-shadow: 0 0 10px #00000029;" src="'.$proImg.'"/>
                        <div>
                            <label for="proImg">Raw product image.</label>
                            <input class="form-control checkRoomImg" type="file" id="proImg" accept="image/jpeg" name="proImg">
                            <span id="proImgError"></span>
                        </div>
                    </div>
                </div>

                <div class="row p0">
                    <div class="form_group col-md-12 mb-3">
                        <label for="proTag">Product Tag *</label>
                        <input class="form-control" type="text" id="proTag" name="proTag"
                            placeholder="Enter Tag." value="'.$proTag.'" required >
                    </div>
                    
                <button class="btn bg-gradient-primary mb-0 mt-lg-auto deactive" type="submit"
                    name="addRoom">
                    '. $btn.'
                </button>

            </form>
        
        ';

    return $html;
}

function kotRawProInsert($id='',$sku='',$name='',$priceCalculateBy='',$img='',$tag=''){
    global $conDB;
    $hId = $_SESSION['HOTEL_ID'];
    $addBy = '';
    $addBy='';
    $imgUpload = '';
    $oldImg = '';

    if($id != ''){
        $oldDetailArry = getKotStockRawProductList($id)[0];
        $oldImg = $oldDetailArry['img'];
        if($img['name'] != ''){
            $img = imgUploadWithData($img,'kotFood',$oldImg)['img'];
            $imgUpload = ",img='$img'";
        }
    }
    
    if($id != ''){
        $sql = "update kot_raw_product_list set sku='$sku', name='$name', priceCalculateBy='$priceCalculateBy', tag='$tag' $imgUpload where id = '$id'";
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully Update Data.'
            ];
        }else{
            $data = [
                'error'=>'no',
                'msg'=>'Something Wrong.'
            ];
        }
    }else{
        $img = imgUploadWithData($img,'kotFood',$oldImg)['img'];
        $sql = "insert into  kot_raw_product_list(sku,name,priceCalculateBy,img,tag,addBy) values('$sku','$name','$priceCalculateBy','$img','$tag','$addBy')";
        if(mysqli_query($conDB, $sql)){
            $data = [
                'error'=>'no',
                'msg'=>'Successfully Add Data.'
            ];
        }else{
            $data = [
                'error'=>'no',
                'msg'=>'Something Wrong.'
            ];
        }
    }
    
    echo json_encode($data);
}

if($type == 'loadRawProductList'){

    $si = 0;
    $roomRowData = '<tbody>';
    if(count(getKotStockRawProductList()) > 0){
        foreach(getKotStockRawProductList() as $proList){
            $si++;
            $proId = $proList['id'];
            $proName = $proList['name'];
            $proSku = $proList['sku'];
            $priceCalculateBy = $proList['priceCalculateBy'];
            $proImg = FRONT_SITE_IMG.'kotFood/'.$proList['img'];
            $proTag = $proList['tag'];
            $update = "<a class='tableIcon update bg-gradient-info' href='javascript:void(0)' data-rid='$proId' data-tooltip-top='Edit'><i class='far fa-edit'></i></a>";
            $roomRowData .= "
            
                <tr>
                    <td width='10%' class='left'><img width='65px' src='$proImg'/></td>
                    <td width='20%' class='center mb-0 bold'>{$proName} </br> <small>$proSku</small></td>
                    <td width='10%' class='text-sm text-secondary mb-0'>{$priceCalculateBy}</td>
                    <td width='10%' class='center mb-0 bold'>{$proTag}</td>
                    <td width='25%'>
                        <div class='tableCenter'>
                            <span class='tableHide'><i class='fas fa-ellipsis-h'></i></span>
                            <span class='tableHoverShow'>
                                $update
                            </span>
                        </div>
                        
                    </td>
                </tr>
            
            ";
        }
    }else{
        $roomRowData .= "
            
            <tr>
                <td colspan='5'>No Data</td>
            </tr>
        
        ";
    }
    $roomRowData .= '</tbody>';
    
    $html = '
    
            <table class="table align-items-center mb-0 tableLine">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Calculate By</th>
                        <th>Tag</th>
                        <th>Action</th>
                    </tr>
                <thead>
                '.$roomRowData.'
            </table>
    
    ';

    echo $html;
}

if($type == 'addRawProSubmitBtn'){
    $proName = safeData($_POST['proName']);
    $prosku = safeData($_POST['prosku']);
    $priceCalculateBy = safeData($_POST['priceCalculateBy']);
    $proTag = safeData($_POST['proTag']);
    $proImg = $_FILES['proImg'];
    kotRawProInsert('',$prosku,$proName,$priceCalculateBy,$proImg,$proTag);
}

if($type == 'showAddRawProForm'){
    $rid = $_POST['rid'];
    echo addRawProForm($rid);
}

if($type == 'updateRawProSubmitBtn'){
    $proName = safeData($_POST['proName']);
    $prosku = safeData($_POST['prosku']);
    $priceCalculateBy = safeData($_POST['priceCalculateBy']);
    $proTag = safeData($_POST['proTag']);
    $proImg = $_FILES['proImg'];
    $updateRawProId = $_POST['updateRawProId'];
    kotRawProInsert($updateRawProId,$prosku,$proName,$priceCalculateBy,$proImg,$proTag);
}

if($type == 'getResList'){
    $data = getResList();
    $html = ' <select class="form-select mx-2" id="selectRest">';
    foreach($data as $item){
        $html.= '
        <option value="'.$item['id'].'">'.$item['name'].'</option>
       ';  
    }
    $html.='</select>';
    echo $html;

}

?>