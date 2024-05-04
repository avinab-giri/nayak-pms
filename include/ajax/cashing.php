<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
// pr($_POST);
$hotelId = $_SESSION['HOTEL_ID'];

$type = $_POST['type'];




function cashingAddForm($rnid = ''){
    global $conDB;
    global $cashingTitle;
  
    
    $formId = 'addCashingForm';
    $salesNameValue =  '';
    $roomNumBtn = "Add";
    $updateSalesHtml = '';

    $contactPersonName = '';
    $contactPersonEmail = '';
    $contactPersonNumber = '';

    $bseOption = '';
    foreach(getBookingSource() as $bsList){
        $name = $bsList['name'];
        $id = $bsList['id'];
        $img = $bsList['img'];
        $bseOption .= "<option value='$id'>$name</option>";
    }

    if($rnid != ''){
        $row = mysqli_fetch_assoc(mysqli_query($conDB, "select * from cashiering where id = '$rnid'"));
        $formId = 'updateCashingForm';       
        $salesNameValue = $row['name'];
        $roomNumBtn = "Update";
        $updateSalesHtml = '<input type="hidden" name="salesId" value="'.$rnid.'" required>';

        $contactPersonName = $row['contactPerson'];
        $contactPersonEmail = $row['phone'];
        $contactPersonNumber = $row['email'];
    }

    $html ='
        <form action="" method="post" id="'.$formId.'">
            <div class="form-group">
                <label for="salePersonName">'.$cashingTitle.' Name</label>
                <input type="text" class="form-control" name="salePersonName" id="salePersonName" value="'.$salesNameValue.'" required>
            </div>
            '.$updateSalesHtml.'
            <div class="form-group">
                <label for="bs">Booking Source</label>
                <select class="form-control" name="bs" id="bs">
                    '.$bseOption.'
                </select>
            </div>
            
            <h4>Contact Persion Detail</h4>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="contactPersonName">Contact Person Name</label>
                    <input type="text" class="form-control" name="contactPersonName" placeholder="Enter Name" id="contactPersonName" value="'.$contactPersonName.'">
                </div>
                <div class="col-md-4">
                    <label for="contactPersonEmail">Contact Person Email</label>
                    <input type="text" class="form-control" name="contactPersonEmail" placeholder="Enter Email Id" id="contactPersonEmail" value="'.$contactPersonEmail.'">
                </div>
                <div class="col-md-4">
                    <label for="contactPersonNumber">Contact Person Number</label>
                    <input type="text" class="form-control" name="contactPersonNumber" placeholder="Enter Number" id="contactPersonNumber" value="'.$contactPersonNumber.'">
                </div>
            </div>

            <button type="submit" class="btn bg-gradient-primary">'.$roomNumBtn.'</button>
        </form>
    ';

    return $html;
}

function formDataInsert($bs,$salePersonName,$contactPersonName,$contactPersonNumber,$contactPersonEmail,$addBy, $cId = ''){
    global $type;
    global $conDB;
    global $cashingTitle;
    $hId = $_SESSION['HOTEL_ID'];
   
    
    if($cId != ''){
        $sql = "update cashiering set bookingSource = '$bs', name='$salePersonName',contactPerson='$contactPersonName',phone='$contactPersonNumber',email='$contactPersonEmail',type='$type',addBy='$addBy' where id = '$cId'";
    }else{
        $sql = "insert into cashiering(hotelId,bookingSource,name,contactPerson,phone,email,addBy,type) values('$hId','$bs','$salePersonName','$contactPersonName','$contactPersonNumber','$contactPersonEmail','$addBy','$type')";
    }
    
    
    if(mysqli_query($conDB, $sql)){
        echo 1;
    }else{
        echo 0;
    }

}


if($type == 'loadCashing'){
    global $conDB;
    $bsid = $_POST['bsid'];
    $html = '
    
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    
    ';

    foreach(getBookingSource() as $key=>$bookingSList){
        $bsId = $bookingSList['id'];
        $bsName = ucfirst($bookingSList['name']);
        $active = '';
        $sl = $key + 1;
        if($key == 0 || $bsid == $sl){
            $active = 'active';
        }
        $html .= '
                <li class="nav-item" role="presentation">
                    <button class="nav-link '.$active.'" id="bookingSource'.$bsId.'-tab" data-bs-toggle="pill" data-bs-target="#bookingSource'.$bsId.'" type="button" role="tab" aria-controls="bookingSource'.$bsId.'" aria-selected="true">'.$bsName.'</button>
                </li>
        ';
    }

    $html .= '
            </ul> <div class="tab-content" id="pills-tabContent">';


    foreach(getBookingSource() as $key=>$bookingSList){
        $bsId = $bookingSList['id'];
        $bsName = ucfirst($bookingSList['name']);
        $active = '';
        if($key == 0){
            $active = 'active';
        }
        $html .= '
                <div class="tab-pane fade show '.$active.'" id="bookingSource'.$bsId.'" role="tabpanel" aria-labelledby="bookingSource'.$bsId.'-tab">
        ';

        $html .= '
            <h4>'.$bsName.' Record</h4>
            <table class="table align-items-center mb-0 tableLine br hover rt" >
                <thead><tr>
                <th scope="col">Sl</th>
                <th scope="col">Name</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Action</th>
            </tr></thead>';

   
    
            $si = 0;

            if(count(getCashiering('',$bsId)) > 0){
                foreach(getCashiering('',$bsId) as $cashList){
                    $si++;
                    $id = $cashList['id'];    
                    $name = $cashList['name'];
                    $contactPerson = $cashList['contactPerson'];
                    $phone = $cashList['phone'];
                    $email = $cashList['email'];
                    $time = formatingDate($cashList['addOn']);
    
                    if($cashList['status'] == 1){
                        $status = "<a class='tableIcon status bg-gradient-success deactive' href='javascript:void(0)' data-bsid='$bsId' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Deactive'><i class='far fa-eye'></i></a>";
                    }else{
                        $status = "<a class='tableIcon status bg-gradient-warning  active' href='javascript:void(0)' data-bsid='$bsId' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Active'><i class='far fa-eye-slash'></i></a>";
                    }
    
                    $delete = "<a class='tableIcon delete bg-gradient-danger' href='javascript:void(0)' data-bsid='$bsId' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Delete'><i class='far fa-trash-alt'></i></a>";
                    $update = "<a class='tableIcon update bg-gradient-info' href='javascript:void(0)' data-bsid='$bsId' data-rnid='$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>";
                    
                    $html .= "<tr>
    
                                <td data-label='Sl' class='center mb-0 bold'>{$si}</td>
                                <td data-label='Name' class='center mb-0 bold'>{$name}</td>
                                <td data-label='Contact Person' class='center mb-0 bold'>{$contactPerson} <br/> {$phone} <br/> {$email}</td>
                                <td data-label='Action'>
                                    <div class='tableCenter'>
                                        <span class='tableHide'><i class='fas fa-ellipsis-h'></i></span>
                                        <span class='tableHoverShow'>
                                            $status
                                            $update
                                            $delete
                                        </span>
                                    </div>
                                    
                                </td>
                            </tr>";
                }
            }else{
                $html .= "
                    
                        <tr>
                            <td colspan='4' style='text-align:center'>No Data</td>
                        </tr>
                    
                    ";
            };

            $html .= "</table></div>";
    }
    

    

            
            

            echo $html;
}


if($type == 'addCashingForm'){
    echo cashingAddForm();
}


if($type == 'submitCashing'){
    
    $salePersonName = $_POST['salePersonName'];
    $bs = $_POST['bs'];
    
    $aId = $_SESSION['ADMIN_ID'];

    $contactPersonName = $_POST['contactPersonName'];
    $contactPersonEmail = $_POST['contactPersonEmail'];
    $contactPersonNumber = $_POST['contactPersonNumber'];

    $currentDate = date('d-m-Y');
    $addBy = $aId.'_'.$currentDate;
    
    formDataInsert($bs,$salePersonName,$contactPersonName,$contactPersonNumber,$contactPersonEmail,$addBy);
    
} 


if($type == 'statusUpdate'){
    $sid = $_POST['rnid'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from cashiering where id='$sid'"));
    if($sql['status'] == 1){
        $query = "update cashiering set status = '0' where id='$sid'";
    }else{
        $query = "update cashiering set status = '1' where id='$sid'";          
    }

    if(mysqli_query($conDB, $query)){
        echo 1;
    }else{
        echo 0;
    }

}

if($type == 'deleteRoomNumber'){
    $did = $_POST['rnid']; 
    $sql = "update cashiering set deleteRec = '0' where id='$did'";
    if (mysqli_query($conDB, $sql)) {
        echo 1;
    }else{
        echo 0;
    }
}

if($type == 'editCashingForm'){
    $hid = $_POST['rnid'];
    echo cashingAddForm($hid);
}


if($type == 'updateCashing'){

    $salePersonName = $_POST['salePersonName'];
    $bs = $_POST['bs'];
    $hId = $_SESSION['HOTEL_ID'];
    $aId = $_SESSION['ADMIN_ID'];

    $contactPersonName = $_POST['contactPersonName'];
    $contactPersonEmail = $_POST['contactPersonEmail'];
    $contactPersonNumber = $_POST['contactPersonNumber'];

    $salesId = $_POST['salesId'];

    $currentDate = date('d-m-Y');
    $addBy = $aId.'_'.$currentDate;
    
    formDataInsert($bs,$salePersonName,$contactPersonName,$contactPersonNumber,$contactPersonEmail,$addBy,$salesId);
    
} 


?>