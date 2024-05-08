<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use Mpdf\Tag\A;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include(SERVER_INCLUDE_PATH . 'uiFunction.php');
include(SERVER_INCLUDE_PATH . 'mailFunction.php');


function currentPage(){
    $page = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $page;
}

function redirect($link){
    ob_start();
    header('Location: '.$link);
    ob_end_flush();
    die();    
}


$time = date('Y-m-d h:i:s');

define('HOTEL_ID', (isset($_SESSION['HOTEL_ID'])) ? $_SESSION['HOTEL_ID'] : '');

if (isset($_SESSION['HOTEL_ID'])) {
    $hotelId = $_SESSION['HOTEL_ID'];
} else {
    $hotelId = '';
    if (currentPage() != FRONT_SITE . '/login') {
        // redirect(FRONT_SITE.'/login');
    }
}


function orginalHotelId($hotelId){   
    
    if(isset($_SESSION['HOTEL_ID'])){
        
        $hotelArray = fetchData('hotel', ['hCode' => "$hotelId"])[0];
        $pid = $hotelArray['pid'];
        if($pid != 0){
            $hotelArginalArray = fetchData('hotel', ['id' => "$pid"])[0];
            $data =  $hotelArginalArray['hCode'];
        }else{
            $data = $hotelId;
        }
    
        return $data;
    }
    
    
}


function pr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

function websiteLink(){
    $frontSite = FRONT_SITE;

    return '
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <META HTTP-EQUIV="Expires" CONTENT="-1">

        <link rel="apple-touch-icon" sizes="76x76" href="' . $frontSite . '/favicons/img-apple-icon.png">
        <link rel="icon" type="image/png" href="' . $frontSite . '/favicons/img-favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="' . $frontSite . '/css/icons.css" rel="stylesheet">
        <link href="' . $frontSite . '/css/svg.css" rel="stylesheet">
        <link id="pagestyle" href="' . $frontSite . '/css/getbootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
        <link id="pagestyle" href="' . $frontSite . '/css/multiStep.min.css" rel="stylesheet">
        <link id="pagestyle" href="' . $frontSite . '/css/multiStep-theme.min.css" rel="stylesheet">
        <link id="pagestyle" href="' . $frontSite . '/css/hierarchy-select.min.css" rel="stylesheet">
        <link rel="stylesheet" href="' . $frontSite . '/css/jstable.css">
        <link rel="stylesheet" href="' . $frontSite . '/css/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="' . $frontSite . '/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="' . $frontSite . '/css/fancybox.css"/>
        <link rel="stylesheet" href="' . $frontSite . '/css/jph-tooltip.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
        <link id="pagestyle" href="' . $frontSite . '/css/style.css" rel="stylesheet">
    
        <style>
        :root {
            --varClr: transparent;
            --zcicn-color-baseStroke: #313949;
            --baseFontSize: 1.2rem;
            --mediumFontSize: 1.5rem;
            --extraMediumFontSize: 1.4rem;
            --smallFontSize: 1.3rem;
            --extraSmallFontSize: 1.1rem;
            --mediumLargeFontSize: 1.8rem;
            --largeFontSize: 2rem;
            
            --pClr : #cb0c9f;
            --dangerClr : #ea0606;
            --successClr : #5a9f00;
            --infoClr : #0093b5;
        }
        </style>';
}

function websiteNav(){
    $logo = getHotelImageData('','','','',LOGO('',1))[0]['fullUrl'];
    $deshboardLink = FO_FRONT_SITE.'/dashboard';
    $pmsLink = FO_FRONT_SITE.'/pms';
    $posLink = POS_FRONT_SITE;
    $cashieringLink = CASH_FRONT_SITE;
    $beLink = FO_FRONT_SITE ."/be";
    $webLink = WB_FRONT_SITE;
    $reportLink = FO_FRONT_SITE.'/report';
    $logoutLink = FRONT_SITE.'/logout';
    $hkLink = FRONT_SITE.'/housekeeping';
    $cashingLink = FRONT_SITE.'/cashiering';

    $reservationLink = FRONT_SITE.'/reservations';
    $stayViewLink = FRONT_SITE.'/stay-view';
    $inventoryLink = FRONT_SITE.'/inventory';
    $guestLink = FRONT_SITE.'/guest-list';
    $paymentLink = FRONT_SITE.'/payment-link';
    $roomViewLink = FRONT_SITE.'/room-view';
    $channelManagerLink = FRONT_SITE.'/channel-manager';
    $userImg = userImg();
    $userName = getHotelUserDetail($_SESSION['ADMIN_ID'])[0]['name'];

    $personalSettingLink = FRONT_SITE.'/settings/personal-settings';
    $basicDetailLink = FRONT_SITE.'/settings/basic-details';
    $nightAuditLink = FRONT_SITE.'/night-audit';

    $reservationLinkHtml = '';
    if (checkWebsiteUserAccess('', 22) == 1) {
        $reservationLink = FRONT_SITE . '/reservations';
        $reservationLinkHtml = '<div class="col-md-6">
                    <a href="' . $reservationLink . '">Reservation</a>
                </div>';
    }

    $stayViewLinkHtml = '';
    if (checkWebsiteUserAccess('', 22) == 1) {
        $stayViewLink = FRONT_SITE . '/stay-view';
        $stayViewLinkHtml = '<div class="col-md-6">
                    <a href="' . $stayViewLink . '">Stay View</a>
                </div>';
    }

    $inventoryLinkHtml = '';
    if (checkWebsiteUserAccess('', 22) == 1) {
        $inventoryLink = FRONT_SITE . '/inventory';
        $inventoryLinkHtml = '<div class="col-md-6">
                    <a href="' . $inventoryLink . '">Inventory</a>
                </div>';
    }
    

    $guestDataHtml = '';
    if (checkWebsiteUserAccess('', 22) == 1) {
        $reservationLink = FRONT_SITE . '/reservations';
        $guestDataHtml = '<div class="col-md-6">
                    <a href="' . $reservationLink . '">Guest Potal</a>
                </div>';
    }

    $settingHtml = '';
    if (checkWebsiteUserAccess('', 28) == 1) {
        $basicDetailsLink = FRONT_SITE . '/settings/basic-details';
        $settingHtml =  '<li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="' . $basicDetailsLink . '">
                        <div class="d-flex py-1">
                            <div class="my-auto mr-4">
                                <svg><use xlink:href="#hotelSetupSvgIcon"></use></svg>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Hotel Setup</span>
                                </h6>
                            </div>
                        </div>
                    </a>
                </li>';
    }

    $nightAuditHtml = '';
    if (checkWebsiteUserAccess('', 24) == 1) {
        $nightAuditLink = FRONT_SITE . '/night-audit';
        $nightAuditHtml = '<li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="' . $nightAuditLink . '">
                        <div class="d-flex py-1">
                            <div class="my-auto mr-4">
                                <svg><use xlink:href="#nightAuditSvgIcon"></use></svg>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Night Audit</span>
                                </h6>
                            </div>
                        </div>
                    </a>
                </li>';
    }

    $reportHtml = '';
    if (checkWebsiteUserAccess('', 21) == 1) {
        $reportLink = FRONT_SITE . '/report';
        $reportHtml = '<li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="' . $reportLink . '">
                        <div class="d-flex py-1">
                            <div class="my-auto mr-4">
                                <svg><use xlink:href="#reportSvgIcon"></use></svg>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Report</span>
                                </h6>
                            </div>
                        </div>
                    </a>
                </li>';
    }
    // <li><a class="beLink linkBtn" href="'.$beLink.'">Booking Engine</a></li>
    // <li> <a class="wbLink linkBtn" href="'.$webLink.'">Web Builder</a></li>a

    $propertyList = genLinkPropertyList();

    $paymentSvg = getSysActivityStatusData(4)[0]['svg'];

    $proListItem = '';
    $proListCon = '';
    foreach($propertyList as $key => $proList){
        $hotelName = $proList['hotelName'];
        $hCode = $proList['hCode'];
        if($key == 0){

            $proListCon = 
                '<a href="javascript:void(0);" class="nav-link text-body p-0 propertyArea dropdownBtn" id="userDropdownBtn">
                    <i class="fas fa-hotel"></i>
                    <h4>'.$hotelName.'</h4>
                    <i class="fas fa-chevron-down"></i>
                </a>';
        }else{
            $proListItem .= 
                '<li class="mb-2">
                    <a onclick="activeProperty(\''.$hCode.'\')" class="dropdown-item border-radius-md" href="javascript:void(0)">
                        <div class="d-flex justify-content-between align-items-center py-1 px-1">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">'.$hotelName.'</span>
                            </h6>
                        </div>
                    </a>
                </li>';
        }
    }

    return '

        <nav id="topNavBar" class="navbar navbar-main navbar-expand-lg"
            id="navbarBlur" data-scroll="true">
            <div class="container py-1 px-3">
                
                <div aria-label="breadcrumb" class="navFlex">

                    <div class="mainNavbar">
                        <ul class="mainNav">
                            <li><a class="homeLink logo" href="'.$deshboardLink.'"><img src="'.$logo.'" alt=""></a></li>
                            <li><a class="homeLink linkBtn" href="'.$deshboardLink.'">Dashboard</a></li>
                            <li><a class="resLink linkBtn" href="'.$reservationLink.'">Reservation</a></li>
                            <li><a class="cashingLink linkBtn" href="'.$cashingLink.'">Cashiering</a></li>
                            <li><a class="guestLink linkBtn" href="'.$guestLink.'">Guest</a></li>                          
                            <li> <a class="reportLink linkBtn" href="'.$reportLink.'">Reports</a></li>
                            <li> <a class="paymentLink linkBtn" href="'.$paymentLink.'"> <span style="margin-right: 5px;display: inline-block; width: 20px;height: 20px;">'.$paymentSvg.'</span> Payment</a></li>
                        </ul>
                    </div>

                    <ul class="d-flex justify-content-end align-items-center propertyAreaList">

                        <li class="d-flex align-items-center">
                            '.$proListCon.'                
                            <ul class="" id="userDropdownContent">
                                '.$proListItem.'
                            </ul>
                        </li>
                        

                    </ul>

                </div>

            </div>
        </nav>
        

        <div class="modal" id="addOrganisationModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Organisation</h5>
                            <button type="button" class="closeOrganisation" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="organisationbody" style="margin:0 auto;"></div>
                        <div class="modal-footer">
                            <button type="button" id="submitOrganisation" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal" id="addTravelAgentModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Travel Agent</h5>
                            <button type="button" class="closeTravelAgent" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="TravelAgentbody" style="margin:0 auto;">

                            <div class="travelaagent-modal-body">
                                
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submitTravelAgent" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


    ';
}

function websiteFooter(){
    $frontSite = FRONT_SITE;
    $frontSiteImg = FRONT_SITE_IMG;

    $supportSectionHTML = '
        <div class="supportSec">
        <div class="content">
            <img src="' . $frontSite . '/img/support.gif" alt="">
        </div>
        <div class="textContent">
            <div class="arrow"></div>
            <ul>
            <li>
                <a href="tel:8118031833">
                <img src="' . $frontSiteImg . '/icon/callgif.gif" alt="Call Gif">
                <div>
                    <span>Call</span>
                    <h6>+91 8118 031 833</h6>
                </div>
                </a>
            </li>
            <li>
                <a href="mailto:support@retrodtech.com"><img src="' . $frontSiteImg . '/icon/emailgif.gif" alt="Email Gif">
                <div>
                    <span>Email</span>
                    <h6>support@retrodtech.com</h6>
                </div>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=918118031833"><img src="' . $frontSiteImg . '/icon/whatsappgif.gif" alt="Whatsapp Gif"> 
                <div>
                    <span>Whatsapp</span>
                    <h6>Lets chat</h6>
                </div>
                </a>
            </li>
            </ul>
        </div>
        </div>';

    $footerHTML = '
        <footer class="footer">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-lg-start">
                &copy; <script>
                    document.write(new Date().getFullYear())
                </script>,
                All rights reserved, Powered By <a class="primaryClr bold" target="_blank" href="https://retrodtech.com">Retrod</a>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                    <a href="https://retrodtech.com" class="nav-link" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="https://retrodtech.com" class="nav-link" target="_blank">Support</a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </footer>';

    return $supportSectionHTML . $footerHTML;
}

function websiteScript(){
    $frontSite = FRONT_SITE;
    return '
    <div class="modal fade" id="popUpModal" tabindex="-1"></div>
    <script type="text/javascript" src="' . $frontSite . '/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/core-bootstrap.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/core-popper.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/plugins-smooth-scrollbar.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/plugins-chartjs.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/dragula-dragula.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/jkanban-jkanban.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/multiStep.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/jquery.plugin.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/jquery.datepick.js"></script>
    <script src="' . $frontSite . '/js/fancybox.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/table2excel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/tilt.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="' . $frontSite . '/js/jolty.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/moment.js"></script>
    <script src="https://cdn.tiny.cloud/1/905gexvj5vhzvaoykwj6zmka5nvldcjmfmlowpfnt0oqa20t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/jph-tooltip-plugin.min.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/customFun.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/script.js"></script>
    <script type="text/javascript" src="' . $frontSite . '/js/main.js"></script>
    ';
}

function cashNavHtml($active=''){
    $array = [
        [
            'slug'=>'travel-agent',
            'link'=> FRONT_SITE.'/cashiering/travel-agent',
            'name'=>'Travel Agent',
        ],
        [
            'slug'=>'company',
            'link'=> FRONT_SITE.'/cashiering/company',
            'name'=>'Company',
        ]
    ];
    
    $body = '';

    foreach($array as $item){
        $link = $item['link'];
        $name = $item['name'];
        $slug = $item['slug'];

        $clsActive = ($active == $slug) ? 'active' : '';

        $body .= '<li class="dib"><a class="'.$clsActive.'" href="'.$link.'">'.$name.'</a></li>';
    }


    $html = '
        <ul class="cashNav">
            '.$body.'
        </ul>
    ';

    return $html;
}


function reservationLeftNav($active){
    $links = [
        ['id' => 'New', 'text' => 'New', 'link' => FRONT_SITE.'/walk-in'],
        ['id' => 'all', 'text' => 'All Reservations', 'link' => FRONT_SITE.'/reservations'],
        ['id' => 'noShow', 'text' => 'No Show', 'link' => 'javascript:void(0)'],
        ['id' => 'void', 'text' => 'Void', 'link' => 'javascript:void(0)']
    ];

    $leftNav = '<div class="mainNavContent">
        <ul id="loadReservationCountContent">';
    
    foreach ($links as $link) {
        $isActive = ($link['id'] === $active) ? 'active' : '';
        $leftNav .= '<li><a id="'.$link['id'].'" href="'.$link['link'].'" class="reservationTab py-3 '.$isActive.'">'.$link['text'].'</a></li>';
    }

    $leftNav .= '</ul>
        <span class="nav-indicator"></span>
    </div>';

    return $leftNav;
}


function reservationRightNav(){
    $grcLink = FRONT_SITE . '/grc';
    $rightNav = '
        <ul>
        
            <li style="margin-right: 5px;"><a class="btn btn-success" id="excelImport" href="javascript:void(0)"> <i class="fas fa-file-import"></i> Import</a> </li>
            <li style="margin-right: 5px;"><a target="_blank" class="mb-0 btn btn-secondary" href="' . $grcLink . '"><i class="fas fa-print"></i> Print Blank GRC</a></li>
            <li><a class="btn btn-warning" id="searchBtnReservation" href="javascript:void(0)"> <i class="fas fa-search"></i></a> </li>
        </ul>
        <div id="searchForReservation">
            <input id="searchForReservationValue" type="text" class="form-contol" placeholder="Search Text.">
            <button id="searchForCloseBtn">X</button>
        </div>';
    return $rightNav;
}

function clrPreviewHtml($type=''){

    $clrHtml = '';
    if($type == 'resType'){
        foreach (fetchData('sys_reservationtype',array(),'id','ASC') as $checkInStatusList) {
            $name = $checkInStatusList['name'];
            $clr = $checkInStatusList['bg'];
            $clrHtml .= "<li><span>$name</span> <span style='background:$clr' class='clrRev'></span></li>";
        }
    }else{
        foreach (checkGuestCheckInStatus() as $checkInStatusList) {
            $name = $checkInStatusList['name'];
            $clr = $checkInStatusList['bg'];
            $clrHtml .= "<li><span>$name</span> <span style='background:$clr' class='clrRev'></span></li>";
        }
    }
    

    $html = "<div class='reverenceClr dFlex jce'>
                <ul>
                    $clrHtml
                    <ul>
            </div>";

    return $html;
}

function createSession($key, $val){
    if (isset($_SESSION[$key])) {
        $array = explode(',', $_SESSION[$key]);
        $valArray = explode(',', $val);
        $mainVal = array_merge($array, $valArray);
        $data = implode(',', array_unique($mainVal));
    } else {
        $data = $val;
    }

    $_SESSION[$key] = $data;
}

function createCookie($key, $val){
    if (isset($_COOKIE[$key])) {
        $array = explode(',', $_COOKIE[$key]);
        $valArray = explode(',', $val);
        $mainVal = array_merge($array, $valArray);
        $data = implode(',', array_unique($mainVal));
    } else {
        $data = json_encode($val);
    }
    setcookie($key, $data, time() + 3600, "/");
}

function deleteSession($key){
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

function deleteCookie($key, $val){
    setcookie($key, $val, time() - 3600, "/");
}

function QueryGen($db, $array = array(), $order = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from $db where id != ''";

    foreach (array_filter($array) as $key => $val) {

        if (gettype($val) == 'array') {
            $key = array_key_first($val);
            $firstVal = $val[$key];
        }

        if (gettype($val) == 'string') {
            $key = $key;
            $firstVal = $val;
        }

        $separate = explode('*', $firstVal);

        if (count($separate) > 1) {
            $command = "$key like '%$separate[1]%'";
        } else {
            $command = "$key = '$separate[0]'";
        }

        $sql .= " and $command";
    }

    if ($order != '') {
        $sql .= " order by $order";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function sanitizeStr($str, $type = "'", $sparet = ' '){
    $strngArry = explode($type, $str);

    return implode($sparet, $strngArry);
}

function generateQRCord($link){
    $data = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=$link";
    return $data;
}

function get_IP_address(){
    foreach (array(
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ) as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $IPaddress) {
                $IPaddress = trim($IPaddress);

                if (
                    filter_var(
                        $IPaddress,
                        FILTER_VALIDATE_IP,
                        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
                    )
                    !== false
                ) {

                    return $IPaddress;
                }
            }
        }
    }
}

function genLinkPropertyList(){
    $hotelID = $_SESSION['HOTEL_ID'];
    
    $item = fetchData('hotel', ['hCode' => "$hotelID"])[0];
    $data[] = array_merge($item);

    $pid = $item['pid'];
    $id = $item['id'];

    if ($pid != 0) {
        $data[] = fetchData('hotel', ['id' => $pid])[0];
        foreach (fetchData('hotel', ['pid' => $pid, 'hCode' => "!$hotelID"]) as $item) {
            $data[] = $item;
        }
    } else {
        foreach (fetchData('hotel', ['pid' => $id, 'hCode' => "!$hotelID"]) as $item) {
            $data[] = $item;
        }
    }

    return $data;
}

function size_as_kb($fileSize)
{
    if ($fileSize < 1024) {
        return "{$fileSize} bytes";
    } elseif ($fileSize < 1048576) {
        $size_kb = round($fileSize / 1024);
        return "{$size_kb} KB";
    } else {
        $size_mb = round($fileSize / 1048576, 1);
        return "{$size_mb} MB";
    }
}

function hotelDetail($id = "", $email = '', $phone = '', $withOutUser = '', $hotelCode = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    ($hotelId == '') ? $hotelIdSql = 'hotel.hCode' : $hotelIdSql = "'$hotelId'";
    $data = array();
    $query = "select hotelprofile.*,hotel.*,hotel.id as hotelMainId, propertylocation.* , propertylocation.id as propertylocationId, propertysetting.* , propertysetting.id as propertysettingId from hotelprofile,hotel,propertylocation,propertysetting where hotel.hCode = hotelprofile.hotelId and hotel.hCode=propertylocation.hotelId and hotel.hCode=propertysetting.hotelId and  hotelprofile.hotelId = $hotelIdSql ";
    if ($id != '') {
        $query .= " and hotel.id = '$id'";
    }
    if ($email != '') {
        $query .= " and hotel.hotelEmailId like '%$email%'";
    }
    if ($phone != '') {
        $query .= " and hotel.hotelPhoneNum like '%$phone%'";
    }
    if ($hotelCode != '') {
        $query .= " and hotel.hCode = '$hotelCode'";
    }
    
    $sql = mysqli_query($conDB, $query);

    if ($email != '' || $phone != '') {
        $data = mysqli_num_rows($sql);
    } else {
        $row = mysqli_fetch_assoc($sql);
        if ($row === null) {
        } else {
            if ($id == '' && $withOutUser == '') {
                $otherDetail = (count(getHotelUserDetail()) > 0) ? getHotelUserDetail()[0] : array();
                $logos = [
                    'fullLightlogoUrl' => getHotelImgDataById($row['lightlogo'])['fullUrl'],
                    'fullDarklogoUrl' => getHotelImgDataById($row['darklogo'])['fullUrl'],
                    'fullFaviconUrl' => getHotelImgDataById($row['favicon'])['fullUrl'],
                    'fullKotLogoUrl' => getHotelImgDataById($row['kotLogo'])['fullUrl'],
                ];
                $data = array_merge($row, $otherDetail, $logos);
            } else {
                $data = $row;
            }
        }
    }

    return $data;
}

$hotelDetail = hotelDetail();
$HotelSlug = (isset($hotelDetail['slug'])) ? $hotelDetail['slug'] : '';


function generateSlug($str,$key=''){
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $str)));
    if($key != ''){
        $array = explode('-',$slug);
        if($key == 'first'){
            $slug = $array[0];
        }
    }
    return $slug;
}


function getRandomWord($len = 10)
{
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function safeData($data){
    global $conDB;
    $return = '';
    if($data != ''){
        $return = mysqli_real_escape_string($conDB, $data);
    }
    return $return;
}

function dataAddBy()
{
    if (isset($_SESSION['SUPER_ADMIN_ID'])) {
        $data = 's_' . $_SESSION['SUPER_ADMIN_ID'];
    } elseif (isset($_SESSION['ADMIN_ID'])) {
        $data = 'a_' . $_SESSION['ADMIN_ID'];
    } else {
        $data = '';
    }

    return $data;
}

function getAddByData($addBy='', $arry = ''){
    $name = '';
    $userType = '';
    $return = '';
    
    if ($arry != '') {
        $return = [
            'user' => '',
            'name' => '',
        ];
    } else {
        $return = '';
    }

    if ($addBy != '') {
        $array = explode('_', $addBy);
        $userType = $array[0];
        $addById = $array[1];

        if ($userType == 'a') {
            $name = (count(getHotelUserDetail($addById)) > 0) ? getHotelUserDetail($addById)[0]['name'] : 'Null';
            $displayName = (count(getHotelUserDetail($addById)) > 0) ? getHotelUserDetail($addById)[0]['displayName'] : 'Null';
            $user = "Admin";
        }

        if ($userType == 's') {
            $name = (count(getSuperAdminData($addById)) > 0) ? getSuperAdminData($addById)[0]['name'] : 'Null';
            $displayName = (count(getSuperAdminData($addById)) > 0) ? getSuperAdminData($addById)[0]['displayName'] : 'Null';
            $user = "Super admin";
        }

        $name = ucfirst($name);

        if ($arry != '') {
            $return = [
                'user' => $user,
                'name' => $name,
                'displayName' => $displayName,
            ];
        } else {
            $return = $name;
        }
    }


    return $return;
}

function getStysBookingType($id = '', $satus = '')
{
    $array = array();
    if ($id != '') {
        $array[] = ['id' => $id];
    }

    if ($satus != '') {
        $array[] = ['status' => $satus];
    }

    return QueryGen('sys_booking_type', $array);
}

function getStysReportList($id = '', $type = '', $key = ''){
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }

    if ($type != '') {
        $array[] = ['typeId' => $type];
    }

    if ($key != '') {
        $array[] = ['accesKey' => $key];
    }

    return QueryGen('sys_report_list', $array);
}

function getStysFolioList($id = ''){
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }

    return QueryGen('sys_folio_status', $array);
}

function getStysReportType($id = '', $satus = '')
{
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }
    if ($satus != '') {
        $array[] = ['status' => $satus];
    }
    return QueryGen('sys_report_type', $array);
}

function getRoomData($id = ''){
    $hotelId = HOTEL_ID;
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }

    $array[] = ['hotelId' => $hotelId];

    return QueryGen('room', $array);
}

function getLostAndFoundData($id = ''){
    $hotelId = HOTEL_ID;
    global $conDB;
    $sql = "select * from lost_found where hotelId = '$hotelId'";

    if($id != ''){
        $sql .= " and id = '$id'";
    }

    $sql .= " order by id desc";

    $query = mysqli_query($conDB, $sql);
    $data = array();

    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }

    return $data;
}

function getSysPageData($id = '',$accessKey = ''){
    global $conDB;

    $sql = "select * from sys_pms_pages where id != ''";

    if($id != ''){
        $sql .= " and id = '$id'";
    }

    if($accessKey != ''){
        $sql .= " and accessKey = '$accessKey'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while($row = mysqli_fetch_assoc($query)){
        $productArray = (isset(getSysProductData($row['pId'])[0])) ? getSysProductData($row['pId'])[0] : '';
        $advance = [
            'productName' => (isset(($productArray['name']))) ? $productArray['name'] : '',
        ];
        $data[] = array_merge($row, $advance);
    }


    return $data;
}

function getSysPageAllData($id)
{
    $rowData = getSysPageData($id)[0];
    $parentData = ['parentData' => []];
    if ($rowData['pId'] != 0) {
        $parentData = [
            'parentData' => getSysPageData($rowData['pId'])[0]
        ];
    }

    return array_merge($rowData, $parentData);
}

function getSysProductData($id = '')
{
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }
    return QueryGen('sys_product', $array);
}


function getRoomDetailData($id = '', $rid = '')
{
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }
    if ($rid != '') {
        $array[] = ['room_id' => $rid];
    }
    return QueryGen('roomratetype', $array);
}

function getBookingDetail($id = '', $bid = '', $rid = '', $rnum = '', $checkIn = '', $checkOut = '', $checkinStatus = '', $totalPrice = '', $addBy = '', $checkinBy = '', $checkOutBy = '', $addOn = '', $folio=''){
   
    $hotelId = HOTEL_ID;
    global $conDB;

    $sql = "select * from bookingdetail where hotelId = '$hotelId'";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($bid != '') {
         $sql .= " and bid = '$bid'";
    }

    if ($rid != '') {
        $sql .= " and roomId = '$rid'";
    }

    if ($rnum != '') {
        $sql .= " and room_number = '$rnum'";
    }

    if ($checkIn != '') {
        $sql .= " and checkIn = '$checkIn'";
    }

    if ($checkOut != '') {
        $sql .= " and checkOut = '$checkOut'";
    }

    if ($checkinStatus != '') {
        $sql .= " and checkinstatus = '$checkinStatus'";
    }

    if ($totalPrice != '') {
        $sql .= " and totalPrice = '$totalPrice'";
    }

    if ($addBy != '') {
        
    }

    if ($checkinBy != '') {
        $sql .= " and checkinBy = '$checkinBy'";
    }

    if ($checkOutBy != '') {
        $sql .= " and checkOutBy = '$checkOutBy'";
    }

    if ($addOn != '') {
        $sql .= " and addOn = '$addOn'";
    }

    if ($folio != '') {
        $sql .= " and openFolio = '$folio'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getPaymentLink($id = '', $paymentId = '', $transactionId = '', $paymentStatus = '', $status = '1', $deletRec = '1', $addOn = '')
{
    $array = ['hotelId' => HOTEL_ID];

    if ($id != '') {
        $array[] = ['id' => $id];
    }

    if ($paymentId != '') {
        $array[] = ['paymentId' => $paymentId];
    }

    if ($transactionId != '') {
        $array[] = ['transactionId' => $transactionId];
    }

    if ($paymentStatus != '') {
        $array[] = ['paymentStatus' => $paymentStatus];
    }

    if ($status != '') {
        $array[] = ['status' => $status];
    }

    if ($deletRec != '') {
        $array[] = ['deletRec' => $deletRec];
    }

    if ($addOn != '') {
        $array[] = ['addOn' => "*$addOn"];
    }

    return QueryGen('payment_link', $array, 'id desc');
}


function getStysAmenitieCat($id = '', $satus = '')
{
    $array = array();
    if ($id != '') {
        $array[] = ['id' => $id];
    }

    if ($satus != '') {
        $array[] = ['status' => $satus];
    }

    return QueryGen('sys_amenities_cat', $array);
}

function getHotelAmenitieData($aid = '', $said = '', $single = '', $hid = '', $status = '', $order = '')
{
    global $conDB;
    $query = "select * from amenities where deleteRec = '1'";

    if ($aid != '') {
        $query .= " and id = '$aid'";
    }
    if ($said != '') {
        $query .= " and sysAId = '$said'";
    }

    if ($hid != '') {
        $query .= " and hotelId = '$hid'";
    }

    if ($status != '') {
        $query .= " and status = '$status'";
    }

    if ($order != '') {
        $query .= " order by orderBy";
    }

    $data = array();
    $sql = mysqli_query($conDB, $query);

    while ($row = mysqli_fetch_assoc($sql)) {
        $sid = $row['sysAId'];
        $exist = ['exist' => 'yes', 'data' => getStysAmenitieData($sid, '', '', 'yes')];
        $data[] = array_merge($row, $exist);
    }

    return $data;
}

function getStysAmenitieData($id = '', $catId = '', $satus = '', $single = '')
{
    global $conDB;

    $sql = "select * from sys_amenities where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($catId != '') {
        $sql .= " and catId = '$catId'";
    }

    if ($satus != '') {
        $sql .= " and status = '$satus'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $exist = ['exist' => 'no'];
        $id = $row['id'];

        if (count(getAmenitieById('', '', 'yes', '', '', '', $id)) > 0) {
            $exist = ['exist' => 'yes'];
        }

        $data[] = array_merge($row, $exist);;
    }
    if ($single != '') {
        $data = (isset($data[0]) > 0) ? $data[0] : $data;
    }

    return $data;
}

function getStysThemeColor()
{
    $array = array();
    return QueryGen('sys_theme_color');
}

function getHotelThemeColor($hid = '')
{
    $array = array();
    if ($hid != '') {
        $array[] = ['hotelId' => $hid];
    }
    return QueryGen('hotel_theme_color', $array);
}

function getThemeColor($hid = '')
{
    $sysThemeClr = getStysThemeColor()[0];
    $hotelThemeClr = (count(getHotelThemeColor($hid)) > 0) ? getHotelThemeColor($hid)[0] : array();

    $data = array();
    foreach ($sysThemeClr as $key => $item) {
        if ($key != 'id') {
            $hotelClr = (isset($hotelThemeClr[$key])) ? $hotelThemeClr[$key] : '';
            $data[$key] = ($hotelClr == '') ? $item : $hotelClr;
        }
    }

    return array_merge($data);
}

function geyPayRoll($getway = '')
{
    $array = array();

    if ($getway != '') {
        // $array[] = ['addOn'=>"*$addOn"];
    }

    return QueryGen('sts_pay_roll', $array);
}

function str_openssl_dec($data, $iv = '')
{
    $key = KEY;
    $cipher = "aes128";
    $option = 0;
    $iv = '1234567891234567';
    return openssl_decrypt($data, $cipher, $key, $option, $iv);
}

function str_openssl_enc($data, $iv = '')
{
    $key = KEY;
    $cipher = "aes128";
    $option = 0;
    $iv = '1234567891234567';
    return openssl_encrypt($data, $cipher, $key, $option, $iv);
}

function ErrorMsg()
{
    if (isset($_SESSION['ErrorMsg'])) {
        $output = "<div class='alert error_box'><i class='ti-face-sad'></i>";
        $output .= $_SESSION['ErrorMsg'];
        $output .= "</div>";
        $_SESSION['ErrorMsg'] = null;
        return $output;
    }
}

function SuccessMsg()
{
    if (isset($_SESSION['SuccessMsg'])) {
        $output = "<div class='alert success_box'><i class='far fa-smile mr-4'></i>";
        $output .= $_SESSION['SuccessMsg'];
        $output .= "</div>";
        $_SESSION['SuccessMsg'] = null;
        return $output;
    }
}

function setActivityFeed($hId = '', $type = '', $bid = '', $bdid = '', $oldData = '', $changedata = '', $ipaddres = '', $result = '', $reason = '', $addBy = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    global $time;
    $hotelId = ($hId == '') ? $hotelId : $hId;
    $bid = ($bid == '') ? 0 : $bid;
    $bdid = ($bdid == '') ? 0 : $bdid;
    $ipaddres = ($ipaddres == '') ? get_IP_address() : $ipaddres;
    $addBy = ($addBy == '') ? dataAddBy() : $addBy;
  
    mysqli_query($conDB, "insert into activityfeed(hotelId,type,bid,bdid,oldData,changedata,ipaddres,result,reason,addBy,addOn) values('$hotelId','$type','$bid','$bdid','$oldData','$changedata','$ipaddres','$result','$reason','$addBy','$time')");
}

function getPageHeader($title, $backLink = '', $secPreName = '', $secPreLink = '')
{
    $headerBgImg = FRONT_SITE_IMG . 'headerBg.webp';
    $homeLink = FRONT_BOOKING_SITE;
    $secPreHtml = '';
    if ($secPreName != '') {
        $secPreHtml = '<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="' . $secPreLink . '">' . $secPreName . '</a></li>';
    }
    $backLink = ($backLink == '') ? $homeLink : $backLink;
    $html = '
    
        <div class="container-fluid">
            <div class="page-header min-height-140 border-radius-xl mt-4"
                style="background-image: url("' . $headerBgImg . '"); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-6 col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                ' . $title . '
                            </h5>
                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                <li class="breadcrumb-item text-sm">
                                    <a class="opacity-3 text-dark" href="javascript:;.html">
                                        <svg width="12px" height="12px" class="mb-1" viewbox="0 0 45 40" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>shop </title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1716.000000, -439.000000)" fill="#252f40"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(0.000000, 148.000000)">
                                                            <path
                                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                            </path>
                                                            <path
                                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                        href="' . $homeLink . '">Home</a></li>
                                ' . $secPreHtml . '
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">' . $title . '</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="' . $backLink . '">
                            <div class="primaryBtn border">
                                <div class="icon"><i class="bi bi-arrow-left"></i></div>
                                <div class="text">Back</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
    ';

    echo $html;
}

function checkLoginAuth(){    
    if (!isset($_SESSION['HOTEL_ID']) || !isset($_SESSION['ADMIN_ID'])) {
        $url = FRONT_SITE . '/login';
        redirect($url);
        die();
    }

    if(isset($_SESSION['ADMIN_ID'])){
        $userId = $_SESSION['ADMIN_ID'];
        $userRole = getHotelUserDetail($userId)[0]['role'];
        $pathArry = array_filter(explode("/",$_SERVER['REQUEST_URI']));
        $lastVal = end($pathArry);
        if($userRole != 1){
            if(isset(getSysPageData('',$lastVal)[0])){
                $pageId = getSysPageData('',$lastVal)[0]['id'];
                if(count(getUserAccess($userId,$pageId)) > 0){
                    
                }else{
                    echo genNotFoundScreen('Page not found.');
                    die();
                }
            }
        }else{
            
        }
        
    }
    
}



function convertArryToJSON($arry)
{
    return $arry;
}

function reservationReturnQuery($tab, $currentDate = '', $search = '', $paymentStatus = '', $roomNum = ''){

    $hotelId = HOTEL_ID;
    $tab = ($tab == '') ? 'all' : $tab;
    $roomNumQuery = ($roomNum != '') ? "and bookingdetail.room_number = '$roomNum'" : '';

    if ($tab == 'all') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where booking.id != ''";
    }

    if ($tab == 'reservationAllBtn') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where  bookingdetail.checkIn >= '$currentDate'";
    }
    if ($tab == 'reservation') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where  bookingdetail.checkIn >= '$currentDate'";
    }
    if ($tab == 'arrives') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where bookingdetail.checkIn <= '$currentDate' and bookingdetail.checkOut >= '$currentDate' and booking.payment_status = '1' and bookingdetail.checkinstatus = '1'";
    }

    if ($tab == 'failed') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where booking.payment_status = '2' and booking.add_on like '%$currentDate%'";
    }

    if ($tab == 'inHouse') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where bookingdetail.checkinstatus = '2' and booking.payment_status = '1' and bookingdetail.checkIn <= '$currentDate' and bookingdetail.checkOut >= '$currentDate' $roomNumQuery ";
    }

    if ($tab == 'checkOut') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where bookingdetail.checkinstatus = '3' and booking.payment_status = '1' and bookingdetail.checkIn >= '$currentDate'";
    }

    if ($tab == 'noShow') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where bookingdetail.checkinstatus = '6' ";
    }

    if ($tab == 'void') {
        $sql = "select booking.*,bookingdetail.*,bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId from booking,bookingdetail where  bookingdetail.checkinstatus = '7'";
    }
    

    if ($search != '') {
        $sql = "select booking.*, bookingdetail.*, bookingdetail.id as bookingDetailMainId,booking.id as bookingMainId, guest.name, guest.email, guest.phone,bookingdetail.checkIn,bookingdetail.checkOut from booking,bookingdetail,guest where  guest.bookId= booking.id and booking.id=guest.bookId and bookingdetail.id=guest.bookingdId and guest.name like '%$search%' or guest.email like '%$search%' or guest.phone like '%$search%' or booking.reciptNo like '%$search%' or booking.bookinId like '%$search%'";
    }


    $sql .= " and booking.hotelId = '$hotelId'";

    if ($paymentStatus != '') {
        $sql .= " and booking.payment_status= '$paymentStatus'";
    }

    $sql .= " and booking.id=bookingdetail.bid and booking.deleteRec = '1' ";

    $sql .= " group by booking.id";

    if($tab == 'all'){
        // $sql .= " ORDER BY bookingdetail.checkIn DESC, booking.id DESC";
        $sql .= " ORDER BY booking.id DESC";
    }else{
        $sql .= " ORDER BY booking.id DESC ";
    }
    

    return $sql;
}

function checkPageBySupperAdmin($pg = '', $title = '', $ttext = '')
{
    global $conDB;
    // $hotelId = $_SESSION['HOTEL_ID'];
    // $sql = "select * from hotel where status = '1' and hCode = '$hotelId'";

    // if($pg == 'pms'){
    //     $sql .= " and pms = '1'";
    // }

    // if($pg == 'webBilder'){
    //     $sql .= " and webBilder = '1'";
    // }

    // if($pg == 'bookingEngine'){
    //     $sql .= " and bookingEngine = '1'";
    // }

    // $query = mysqli_query($conDB, $sql);
    // if(mysqli_num_rows($query) > 0){

    // }else{
    //     include(FO_SERVER_PATH.'/subscription.php');
    //     $html = subscriptionData($title,$ttext);
    //     echo  $html;
    //     die();
    // }


}

function checkProductExistOrNot($proId, $mainProId = '', $onlyArry = '')
{
    $hotelId = HOTEL_ID;
    $data = array();

    return $data;
}

function unique_id($l = 8)
{
    $better_token = md5(uniqid(rand(), true));
    $rem = strlen($better_token) - $l;
    $unique_code = substr($better_token, 0, -$rem);
    $uniqueid = $unique_code;
    return $uniqueid;
}

function printBooingId($bid, $obid = '', $or = ''){
    $bookingData = fetchData('booking', ['id'=>$bid])[0];
    $reciptNum = threeNumberFormat($bookingData['reciptNo']);
    $bookingId = $bookingData['bookinId'];

    $data = $bookingId . ' / ' . $reciptNum;
    if ($obid != '') {
        $data = $bookingId;
    }

    if ($or != '') {
        $data = $reciptNum;
    }

    return $data;
}

function checkImg($path, $demo = '')
{

    $data = $path;

    if ($demo == 'guest') {

        if ($path == '') {
            $data = FRONT_SITE_IMG . 'demo/person-icon.png';
        } else {
            $data = FRONT_SITE_IMG . 'guest/' . $path;
        }
    }

    return $data;
}

function LOGO($light = '', $dark = ''){
    $darkLogo = hotelDetail()['darklogo'];
    $lightLogo = hotelDetail()['lightlogo'];
    $data = 'logodemo.jpg';
    if ($light != '') {
        $data = ($lightLogo == '') ? $darkLogo : $lightLogo;
    }
    if ($dark != '') {
        $data = ($darkLogo == '') ? $lightLogo : $darkLogo;
    }
    if ($darkLogo == '' && $darkLogo == '') {
        $data = 'logodemo.jpg';
    }
    return $data;
}

function userImg()
{
    $data = FRONT_SITE_IMG . '/user/userIcon.png';
    $userDetailArry = getHotelUserDetail($_SESSION['ADMIN_ID'])[0];
    $imageId = $userDetailArry['imageId'];
    $imgArry = getHotelImageData('', '', '', '', $imageId)[0];
    $imgName = $imgArry['image'];
    $img = getImgPath('private', $imgName);

    return $img;
}

function getImgPath($type, $name = '', $server = '', $parentPath = '',$source='')
{
    global $HotelSlug;
    $hotelSlug = $HotelSlug;
    $site = ($server != '') ? SERVER_IMG : WS_FRONT_SITE_IMG;
    if ($parentPath != '') {
        $data = "proimg/$hotelSlug/$type/";
    } else {
        if ($name == 'demo-img.png') {
            $data = ($name == null || $name == '') ? '' : $site . $name;
        } else {
                if($source!=''){
                    if($source == 'retrod.in'){
                        $site = 'https://retrod.in/proimg/';
                    }
                }
            $data = ($name == null || $name == '') ? '' : $site . $hotelSlug . '/' . $type . '/' . $name;
        }
    }

    return $data;
}

function imgUploadWithData($img = '', $accessValue='', $oldImg = '', $compress = '', $newName = '', $value = '', $private = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = array();
    global $HotelSlug;
    $hotelSlug = $HotelSlug;
    $value = ($value == '') ? 0 : $value;

    $fileDir = SERVER_IMG . $hotelSlug;

    if (!file_exists($fileDir)) {
        mkdir($fileDir);
    }

    if ($private != '') {
        $filename = $fileDir . '/private';
        if (!file_exists($filename)) {
            mkdir($filename);
        }
        $path = 'private';
    } else {
  
        $filename = $fileDir . '/public';
        if (!file_exists($filename)) {
            mkdir($filename);
        }
        $path = 'public';
    }



    if ($img == '') {

        if ($oldImg != '') {
            $fileDelete = getImgPath($path, $oldImg, 'yes');
            (file_exists($fileDelete)) ? unlink($fileDelete) : '';
        }
    } else {

        $image = $img['name'];
        $imageTemp = $img['tmp_name'];
        $file_size = $img['size'];
        $extension = array('jpeg', 'jpg', 'JPG', 'png', 'gif');
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $imgSize = $img['size'];
        $addBy = dataAddBy();

        if (!in_array($ext, $extension)) {
            $data["img"] = '';
            $data['error'] = 'true';
            $data['msg'] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
            $data['imgId'] = '';
        } elseif (($file_size > 500000)) {
            $data = [
                'img' => '',
                'error' => 'true',
                'msg' => 'File too large. File must be less than 500Kb.',
                'imgId' => '',
            ];
        } else {
            if ($oldImg != '') {
                $fileDelete = SERVER_IMG . $oldImg;
                (file_exists($fileDelete)) ? unlink($fileDelete) : '';
            }

            $newfilename = generateSlug($newName) . '-' . rand(100000, 999999) . "." . $ext;
            $compressAmount = 0;

            move_uploaded_file($imageTemp, $filename . '/' . $newfilename);

            $_SESSION['roomImgUpload'][] = $newfilename;
            
            mysqli_query($conDB, "insert into hotel_image(hotelId,accessId,image,accessValue,addBy,private) values('$hotelId','$value','$newfilename','$accessValue','$addBy','$path')");

            $imgId = mysqli_insert_id($conDB);

            $data["img"] = $newfilename;
            $data["imgFullPath"] = WS_FRONT_SITE_IMG . $hotelSlug . '/' . $path . '/' . $newfilename;
            $data['error'] = 'false';
            $data['imgId'] = $imgId;
            $data['msg'] = '';
        }
    }

    return $data;
}

function setImage($item, $accessKey = '')
{
    global $conDB;
    $sql = "update hotel_image ";
    if ($accessKey != '') {
        $sql .= " set accessId = '$accessKey' ";
    }
    $sql .= " where image = '$item'";
    mysqli_query($conDB, $sql);
}

function generateRecipt(){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select MAX(reciptNo) as recipt from booking where hotelId = '$hotelId'";
    $query = mysqli_query($conDB, $sql);

    $row = mysqli_fetch_assoc($query);

    $incRecipt = $row['recipt'] + 1;
    return $incRecipt;
}


function generateBillNo(){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select MAX(billingNo) as maxBillingNo from payment_timeline where hotelId = '$hotelId'";
    $query = mysqli_query($conDB, $sql);

    $row = mysqli_fetch_assoc($query);

    $incRecipt = $row['maxBillingNo'] + 1;
    return $incRecipt;
}

function generateInvoiceNum($bid){
    $reciptNo = getBookingData($bid)[0]['reciptNo'];
    $bookingSerialNo = threeNumberFormat($reciptNo);
    $booingCode = hotelDetail()['shortCode'];
    $response = $booingCode . '-' . $bookingSerialNo;

    return $response;
}

function generateBooingId($bid = ''){
    if ($bid == '') {
    } else {
        $resId = $bid;
    }

    $bookingNum = threeNumberFormat($resId);
    $booingCode = hotelDetail()['shortCode'];
    $response = $booingCode . '-' . $bookingNum;

    return $response;
}

function generateFolioVoucherName($gNmae = '',$reciptNo=''){
    $name = generateSlug($gNmae,'first');
    $num = threeNumberFormat($reciptNo);
    return $name.'-'.$num;
}

function getArryDataToString($data, $key)
{
    foreach ($data as $dataList) {
        $singleValue[] = $dataList[$key];
    }

    return $singleValue;
}

// generateNumberById

function threeNumberFormat($oid, $inc = '')
{
    if ($oid == '') {
        $oid = 0;
    }
    if ($inc != '') {
        $oid++;
    }
    if (strlen($oid) == 1) {
        $oid = "00" . $oid;
    } elseif (strlen($oid) == 2) {
        $oid = "0" . $oid;
    } else {
        $oid = $oid;
    }

    return $oid;
}

function getNumberFormat($num, $letter = '')
{
    if ($num == '') {
        $num = 0;
    }
    if ($letter == '') {
        if (strlen($num) == 1) {
            $num = "0" . $num;
        } else {
            $num = number_format($num);
        }
    } else {
        if (strlen($num) == 1) {
            $num = "00" . $num;
        } elseif (strlen($num) == 2) {
            $num = "0" . $num;
        } else {
            $num = number_format($num);
        }
    }


    return $num;
}

function setRoomNumerByData($action, $roomNum, $roomId, $id = "")
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $existRoomNum = count(getRoomNumber($roomNum, '', '', '', '', '', '', '', '', '', '', 'yes'));
    $existRoomData = getRoomNumber($roomNum, '', '', '', '', '', '', '', '', '', '', 'yes')[0];


    if ($action == 'add') {
        if ($existRoomNum == 0) {
            $sql = "insert into roomnumber(hotelId,roomNo,roomId) values('$hotelId','$roomNum','$roomId')";
        }
        if ($existRoomNum == 1) {
            if ($existRoomData['deleteRec'] == 0) {
                $sql = "update roomnumber set deleteRec = '1' where roomNo = '$roomNum'";
            } else {
                $sql = "update roomnumber set roomId = '$roomId' where roomNo = '$roomNum'";
            }
        }
    }
    if ($action == 'delete') {
        if ($existRoomNum == 1) {
            if ($existRoomData['deleteRec'] == 0) {
                $sql = "update roomnumber set deleteRec = '1' where roomNo = '$roomNum'";
            }
            if ($existRoomData['deleteRec'] == 1) {
                $sql = "update roomnumber set deleteRec = '0' where roomNo = '$roomNum'";
            }
        }
    }

    if (mysqli_query($conDB, $sql)) {
        echo 1;
    } else {
        echo 0;
    }
}

function getRoomNumber($rNo = '', $status = '', $rid = '', $checkIn = '', $checkOut = '', $ridRes = '', $rnid = '', $bdid = '', $searchData = '', $kotSearch = '', $onlyRoom = '', $delete = '', $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    if ($status != '') {
        $sql = "select * from roomnumber where status = '1' and hotelId = '$hotelId'";
    } else {
        $sql = "select * from roomnumber where hotelId = '$hotelId'";
    }

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec= '1' ";
    }

    if ($rNo != '') {
        $sql .= " and roomNo = '$rNo'";
    }

    if ($rnid != '') {
        $sql .= " and id = '$rnid'";
    }

    if ($rid != '') {
        $roomNumCheck = "";
        $checkIn = ($checkIn == '') ? '' : $checkIn;
        $checkOut = ($checkOut == '') ? '' : $checkOut;
        
        foreach (checkRoomNumberExiist($rid, $checkIn, $checkOut, $rNo) as $roomNumList) {
            $value = $roomNumList['room_number'];
            $roomNumCheck .= " and roomNo != '$value'";
        }
        if ($ridRes != '') {
            $sql .= " and roomId = '$rid' $roomNumCheck";
        } else {
            $sql .= " and roomId = '$rid' ";
        }
    }

    if ($bdid != '') {
        $grapRoomNum = mysqli_fetch_assoc(mysqli_query($conDB, "select * from bookingdetail where hotelId = '$hotelId' and id = '$bdid'"));
        $room_number = $grapRoomNum['room_number'];
        $sql .= " and roomNo != '$room_number' ";
    }

    if ($searchData != '') {
        $sql .= " and roomNo like '%$searchData%'";
    }

   $sql .= " order by roomNo asc";

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($kotSearch != '') {
                $data[] = [
                    'id' => $row['id'],
                    'name' => $row['roomNo'],
                    'roomId' => $row['roomId'],
                    'kotOrderCount' => count(getKotOrder('', '', '', '', '', '2', $row['id'],0)),
                    'kotOrderId' => (isset(getKotOrder('', '', '', '', '', '2', $row['id'],0)[0])) ? getKotOrder('', '', '', '', '', '2', $row['id'],0)[0]['id'] : 0,
                    'folioId'=> '',
                    'checkIn' => (countBookingRow('inHouse', date('Y-m-d'), '', '', $row['roomNo']) > 0) ? 'yes' : 'no',
                ];
            } else {
                if ($onlyRoom != '') {
                    $data[] = $row['roomNo'];
                } else {

                    $roomListArry = (count(getRoomList('', $row['roomId'])) > 0) ? getRoomList('', $row['roomId'])[0] : array();
                    $roomData = ['room' => $roomListArry];

                    $roomStatusArry = (count(getRoomStatus($row['status'])) > 0) ? getRoomStatus($row['status'])[0] : array();
                    $roomStatusData = ['roomStatus' => $roomStatusArry];

                    $houseKeeperArry = (count(getHousekeepingData('', $row['roomNo'])) > 0) ? getHousekeepingData('', $row['roomNo'])[0] : array();
                    $houseKeeperData = ['houseKeeper' => $houseKeeperArry];

                    $data[] = array_merge($row, $roomData, $roomStatusData, $houseKeeperData);
                }
            }
        }
    }

    return $data;
}

function getHousekeepingData($id = '', $roomNum = '', $addBy = '', $addOn = '', $delete = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from housekeeping where hotelId = '$hotelId'";

    if ($delete == '') {
        $sql .= " and deleteRec = 1";
    }

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($roomNum != '') {
        $sql .= " and roomNum = '$roomNum'";
    }

    if ($addBy != '') {
        $sql .= " and addBy = '$addBy'";
    }

    if ($addOn != '') {
        $sql .= " and addOn like '$addOn%'";
    }

    $sql .= " order by id desc";
    
    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $advance = [
            'addByUsername' => getAddByData($row['addBy']),
            'hkName' => (isset(getHotelUserDetail($row['assigningHK'])[0])) ? getHotelUserDetail($row['assigningHK'])[0]['displayName'] : '',
        ];
        $data[] = array_merge($row, $advance);
    }

    return $data;
}

function getRoomNumberWithFilter($rid = '', $rtab = '', $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from roomnumber where hotelId = '$hotelId'";

    if ($rid != '') {
        $sql .= " and roomId = '$rid'";
    }

    if ($rtab == 'blocked') {
        $sql .= " and status = '4'";
    }

    $sql .= " ORDER BY roomNo ASC ";
    $bookRoom = array();
    if ($date != '') {
        if (count(getBookingData('', '', $date, '', '', $rid)) > 0) {
            foreach (getBookingData('', '', $date, '', '', $rid) as $val) {
                $bookRoom[] = $val['room_number'];
            };
        }
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($rtab == 'reserved') {
                if (in_array($row['roomNo'], $bookRoom)) {
                    $data[] = $row;
                }
            } elseif ($rtab == 'vacat') {
                if (!in_array($row['roomNo'], $bookRoom)) {
                    $data[] = $row;
                }
            } else {
                $data[] = $row;
            }
        }
    }



    return array_filter($data);
}

function getRoomList($status = '', $rid = '', $header = '', $exceptrid = '', $slug = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from room where hotelId = '$hotelId' and deleteRec = '1'";

    if ($status != '') {
        $sql .= " and status = '1'";
    }

    if ($rid != '') {
        $sql .= " and id = '$rid'";
    }

    if ($header != '') {
        $sql .= " and header = '$header'";
    }

    if ($exceptrid != '') {
        $sql .= " and id != '$exceptrid'";
    }

    if ($slug != '') {
        $sql .= " and slug = '$slug'";
    }



    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = array_merge($row, ['fullImgUrl' => '']);
        }
    }

    return $data;
}

function getBookingFolio($id='',$gName='',$bid='',$bdId='',$posId='',$addOn='',$groupBy='',$filterByDate='',$getDate='',$particulars='',$type=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $currentDate = date('Y-m-d', time());
    $sql = "select * from booking_folio where hotelId = '$hotelId' and deleteRec = '1'";

    if ($id != '') {
        $sql .= " and status = '1'";
    }

    if ($gName != '') {
        $sql .= " and gName like '%$gName%'";
    }

    if ($bid != '') {
        $sql .= " and bid = '$bid'";
    }

    if ($bdId != '') {
        $sql .= " and bdId = '$bdId'";
    }

    if ($particulars != '') {
        $sql .= " and particulars like '%$particulars%'";
    }

    if ($posId != '') {
        $sql .= " and posId != '$posId'";
    }

    if ($addOn != '') {
        $sql .= " and addOn like '$addOn%'";
    }

    if ($getDate != '') {
        $sql .= " and chargeDate = '$getDate'";
    }

    if($filterByDate != ''){
        $sql .= " and chargeDate <= '$currentDate'";
    }

    if ($groupBy != '') {
        if($groupBy == 'date'){
            $sql .= " group by chargeDate";
        }
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $gst = array();
            if($row['particulars'] == 'Room Charge'){
                $gstPer = $row['gstPer'];
                $roomPrice = $row['charged'];
                $gstCheck = $row['gst'];
                if($gstCheck == 1){
                    $gst = [
                        'CGST'=>getPriceCalculate('percentage', $gstPer /2 , $roomPrice),
                        'SGST'=>getPriceCalculate('percentage', $gstPer /2 , $roomPrice)
                    ];
                }else{
                    $gst = [
                        'CGST'=>getPriceCalculate('percentage', $gstPer /2 , $roomPrice),
                        'SGST'=>getPriceCalculate('percentage', $gstPer /2 , $roomPrice)
                    ];
                }
                
            }
            $advance = [
                'userName'=> getAddByData($row['addBy'],'yes')['displayName'],
                'gst'=> $gst,
            ];
            $data[] = array_merge($row,$advance);
        }
    }

    return $data;
}

function filterBookingFolio($bid='',$bdId='',$type=''){
    $dateArry = getBookingFolio('','',$bid,$bdId,'','','date','','',$type);

    $data = array();
    foreach($dateArry as $item){
        $changeDate = $item['chargeDate'];
        $itemArray = getBookingFolio('','',$bid,'','','','','yes',$changeDate,$type);
        $totalCharge = 0;
        $totalReceived = 0;
        $totalBalance = 0;
        
        foreach($itemArray as $dataItem){
            $discount = $dataItem['discount'];
            $charged = $dataItem['charged'];
            $balance = $dataItem['balance'];
            $cgst = (isset($dataItem['gst']['CGST'])) ? $dataItem['gst']['CGST'] : 0;
            $sgst = (isset($dataItem['gst']['SGST'])) ? $dataItem['gst']['SGST'] : 0;

            $totalCharge += ($charged + $cgst + $sgst);
            $totalReceived += $dataItem['received'];
            $totalBalance += $balance;
            $data[] = $dataItem;
        }

        $day = date('d-M-Y', strtotime($changeDate));

        $totalCount = [
            'folioId'=>0,
            'particulars'=>"Day Total For $day",
            'charged'=> $totalCharge,
            'received'=>$totalReceived,
            'balance'=> $totalBalance,
            
        ];

        $data[] = $totalCount;
    }

    return $data;
}

function setBookingFolio($id = '', $gName = '', $bid = '', $bdId = '', $posId = '', $recived = '', $charged = '', $balance = '', $gst = '', $particulars = '', $ref = '', $remark = '', $discount = '',$chargeDate='', $chargeType = ''){
    $hotelId = HOTEL_ID;
    global $conDB;
    global $time;
    $chargeDate = ($chargeDate == '') ? date('Y-m-d', strtotime($time)) : $chargeDate;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    $bid = ($bid == '') ? 0 : $bid;
    $bdId = ($bdId == '') ? 0 : $bdId;
    $posId = ($posId == '') ? 0 : $posId;
    $recived = ($recived == '') ? 0 : $recived;
    $charged = ($charged == '') ? 0 : $charged;
    $gst = ($gst == '') ? 0 : $gst;
    $balance = ($balance == '') ? 0 : $balance;
    $discount = ($discount == '') ? 0 : $discount;
    $data = 0;
    $addBy = dataAddBy();

    if ($gName == '') {
        $gName = getBookingFolio('', '', $bid)[0]['gName'];
    }

    if ($id != '') {
        $sql = "update booking_folio set gName = '$gName', bid='$bid', bdId='$bdId', posId='$posId', received='$recived', charged='$charged', gst='$gst'";
    } else {

        $sql = "insert into booking_folio(gName,hotelId,bid,bdId,posId,received,addBy,addOn,charged,particulars,ref,remark,balance,discount,ipaddress,chargeDate) values('$gName','$hotelId','$bid','$bdId','$posId','$recived','$addBy','$time','$charged','$particulars','$ref','$remark','$balance','$discount','$ip_address','$chargeDate')";

        if($chargeType == ''){
            if ($bdId != 0) {

                $getBookingDataArray = getBookingData($bid,'','',$bdId)[0];
                $roomPrice = $getBookingDataArray['roomPrice'];
                $gstPer = ($getBookingDataArray['gstPer'] == '') ? 0 : $getBookingDataArray['gstPer'];
                $checkIn = $getBookingDataArray['checkIn'];
                $checkOut = $getBookingDataArray['checkOut'];
                $gstPrice = round(getPercentageValu($roomPrice, $gstPer),2);
                $nightCount = getNightCountByDay($checkIn,$checkOut);
                $querySql = '';
                for($i =0; $i < $nightCount; $i++){
                    $comma = ',';
                    if($i == $nightCount){
                        $comma = '';
                    }
                    if($nightCount==1){
                        $comma = '';
                    }
                    $nowDate = date('Y-m-d', strtotime($checkIn) + ($i * 86400));
                    $querySql .= "('$gName','$hotelId','$bid','$bdId','$posId','0','$addBy','$time','$roomPrice','Room Charge','$ref','','$balance','$nowDate',1,'$gstPer','$ip_address')$comma";
                }
    
               $sql = "insert into booking_folio(gName,hotelId,bid,bdId,posId,received,addBy,addOn,charged,particulars,ref,remark,balance,chargeDate,gst,gstPer,ipaddress) values
                $querySql";
                
            }
        }
    }
    
    if (mysqli_query($conDB, $sql)) {
        $data = 1;
    } else {
        $data = 0;
    }

    return $data;
}


function getSysDeliveryService($id = ''){
    global $conDB;
    $sql = "select * from sys_kot_delivery_service where status = '1'";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = array_merge($row, ['fullImgUrl' => '']);
        }
    }

    return $data;
}

function getUserRoleList($id = ''){
    global $conDB;
    $sql = "select * from sys_userrole where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getGuestIdProofData($status = '', $gip = '')
{
    global $conDB;
    $sql = "select * from sys_guestidproof where id != ''";

    if ($status != '') {
        $sql .= " and status = '1'";
    }

    if ($gip != '') {
        $sql .= " and id = '$gip'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getSysPropertyRatePlaneList($id = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from sys_rate_plan where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getPropertyRatePlaneList($id = '', $hid = '', $str = '', $systmData = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from propertyrateplan where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hotelId'";
    }

    if ($str != '') {
        $sql .= " and srtcode = '$str'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    if ($systmData != '') {
        $data =  array_merge($data, getSysPropertyRatePlaneList());
    }

    return $data;
}

function getRatePlanTitleData($id = '')
{
    $hotelId = HOTEL_ID;
    foreach (getSysPropertyRatePlaneList($id) as $item) {
        $str = $item['srtcode'];
        if (count(getPropertyRatePlaneList('', $hotelId, $str)) > 0) {
            $data[] = getPropertyRatePlaneList('', $hotelId, $str)[0];
        } else {
            $data[] = $item;
        }
    }

    return $data;
}

function getCouponList($status = '', $hid = '', $cid = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    if ($status != '') {
        $sql = "select * from couponcode where status = '1'";
    } else {
        $sql = "select * from couponcode where id != ''";
    }

    if ($cid != '') {
        $sql .= " and id = '$cid'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hotelId'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getExpenseTypeData($eid = '')
{
    global $conDB;
    $sql = "select * from expense_type where status = '1'";

    if ($eid != '') {
        $sql .= " and id = '$eid'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getExpenseData($eid = '', $monthly = '', $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from expense where hotelId = '$hotelId'";

    if ($eid != '') {
        $sql .= " and id = '$eid'";
    }

    if ($date != '') {
        $sql .= " and addOn like '$date%'";
    }

    if ($monthly != '') {
        $currentDate = strtotime(date('Y-m-d'));
        $months = date("F Y", strtotime(date('Y-m-01')));
        $timestamp    = strtotime($months);
        $firstDay = date('Y-m-01 ', $timestamp);
        $lastDay  = date('Y-m-t ', $timestamp);

        $sql .= " and date >= '$firstDay' && date <= '$lastDay' ";
    }

    $data = array();
    $totalPrice = 0;

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        if ($monthly != '') {
            while ($row = mysqli_fetch_assoc($query)) {
                $totalPrice += $row['amount'];
            }
            $data[] = $totalPrice;
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
    }

    return $data;
}

function getExpensePrice($date = '', $monthly = '')
{
    $arry = getExpenseData('', $monthly, $date);
    $amount = 0;
    foreach ($arry as $val) {
        $amount += $val['amount'];
    }

    return $amount;
}

// Booking Detail Start

function getBookingDetailTableData($id = '', $bid = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from bookingdetail where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($bid != '') {
        $sql .= " and bid = '$bid'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getBookingIdByBVID($bvid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select id from booking where bookinId = '$bvid'"));
    return $sql['id'];
}

function getBookingData($bid = '', $rNum = '', $checkIn = '', $id = '', $onlyCheckIn = '', $rid = '', $bookingSourse = '', $limit = '', $order = '', $addOn = '', $group = '', $checkinDone = '', $checkOut = '', $user = '', $salesId = '', $reservationId = '', $cancel = '', $search = '', $exceptCancel='', $status = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "select booking.*, bookingdetail.*, bookingdetail.id as bookingdetailId , guest.id as guestId , guest.name as guestName , guest.phone as guestPhone from booking,bookingdetail,guest where booking.id=bookingdetail.bid and booking.id=guest.bookId and bookingdetail.id = guest.bookingdId and booking.hotelId='$hotelId' ";

    if ($cancel != '') {
        $query .= " and booking.deleteRec = '0'";
    } else {
        $query .= " and booking.deleteRec = '1'";
    }

    if ($bid != '') {
        $query .= " and bookingdetail.bid = '$bid'";
    }
    if ($rNum != '') {
        $query .= " and bookingdetail.room_number = '$rNum'";
    }
    if ($id != '') {
        $query .= " and bookingdetail.id = '$id'";
    }else{
        $query .= " and guest.groupadmin = 1 ";
    }

    if ($rid != '') {
        $query .= " and bookingdetail.roomId = '$rid'";
    }

    if ($bookingSourse != '') {
        $query .= " and booking.bookingSource = '$bookingSourse'";
    }

    if ($status != '') {
        $query .= " and bookingdetail.checkinstatus = '$status'";
    }

    if ($salesId != '') {
        $query .= " and booking.salesType = '$salesId'";
    }

    if ($reservationId != '') {
        $query .= " and booking.reservationType = '$reservationId'";
    }

    if ($addOn != '') {
        $query .= " and booking.add_on like '$addOn%'";
    }

    if ($exceptCancel != '') {
        $query .= " and bookingdetail.checkinstatus != '5' and bookingdetail.checkinstatus != '6' and bookingdetail.checkinstatus != '7'";
    }

    if ($search != '') {
        $query .= " and booking.bookinId like '$search%' or booking.reciptNo like '$search%'";
    }

    if ($checkIn != '' && $checkOut == '') {
        if ($checkinDone != '') {
            $query .= " and bookingdetail.checkIn = '$checkIn' and bookingdetail.checkinstatus = 2";
        }
        if ($onlyCheckIn != '') {
            $query .= " and bookingdetail.checkIn = '$checkIn' ";
        } else {
            $query .= " and bookingdetail.checkIn <= '$checkIn' and bookingdetail.checkOut > '$checkIn'";
        }
    }

    if ($checkOut != '') {
        if ($checkIn != '') {
            $query .= " and bookingdetail.checkOut like '$checkIn%'";
        } else if ($checkinDone != '') {
            $query .= " and bookingdetail.checkOut like '$checkOut%' and bookingdetail.checkinstatus = 2 or bookingdetail.checkinstatus = 3";
        } else {
            $query .= " and bookingdetail.checkOut like '$checkOut%' and bookingdetail.checkinstatus = 3";
        }
    }

    if ($user != '') {
        $user = 'a_' . $user;
        $query .= " and booking.addBy = '$user'";
    }

    if ($group != '') {
        $query .= ' group by bookingdetail.id';
    } else {
        $query .= ' group by booking.id';
    }


    if ($order != '') {
        if ($order == 'roomNum') {
            $query .= " order by  `bookingdetail`.`room_number` asc";
        }
    } else {
        $query .= ' order by booking.id desc';
    }

    if ($limit != '') {
        $query .= ' limit ' . $limit;
    }
    // echo $query;
    $sql = mysqli_query($conDB, $query);
    $data = array();
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $couponCode = $row['couponCode'];
            $roomDetailArry = getSysPropertyRatePlaneList($row['roomDId'])[0];
            $addByArray = getAddByData($row['addBy'],'yes');
            $coompanyArray = isset(getOrganisationData($row['organisation'], 'yes')[0]) ? getOrganisationData($row['organisation'],'yes')[0] : array();
            $totalAdult = 0;
            $totalChild = 0;
            $totalFullPrice = 0;
            $totalGstPrice = 0;
            $totalRoomPrice = 0;
            $totalCouponPrice = 0;
            foreach(getBookingDetailTableData('', $row['bid']) as $bdList){
                $rid = $bdList['roomId'];
                $rdid = $bdList['roomDId'];
                $adult = $bdList['adult'];
                $child = $bdList['child'];
                $addOn = $bdList['addOn'];
                $checkIn = $bdList['checkIn'];
                $checkOut = $bdList['checkOut'];
                $night = getNightByTwoDates($checkIn,$checkOut);
                $totalAdult += $bdList['adult'];
                $totalChild += $bdList['child'];
                $priceArry = getSingleRoomPrice($rid,$rdid,$adult,$child,$addOn,$couponCode);
                
                $totalFullPrice += floatval($priceArry['roundTotal']);
                $totalGstPrice += floatval($priceArry['gst']);
                $totalRoomPrice += floatval($priceArry['night']);
                $totalCouponPrice += floatval($priceArry['couponPrice']);
            }
            $advance = [
                'rooms'=> count(getBookingDetail('',$row['bid'])),
                'addByName' => $addByArray['name'],
                'addByDName' => $addByArray['displayName'],
                'companyName' => (isset($coompanyArray['name'])) ? $coompanyArray['name'] : '',
                'gstPrice' => $priceArry['gst'],
                'commision' => $priceArry['commission'],
                'subTotal' => $priceArry['nightPrice'],
                'totalAdult' => $totalAdult,
                'totalChild' => $totalChild,
                'totalFullPrice' => $totalFullPrice,
                'totalGstPrice' => $totalGstPrice,
                'totalRoomPrice' => $totalRoomPrice,
                'totalCouponPrice' => $totalCouponPrice,
                'roomType' => (isset(getRoomData($row['roomId'])[0])) ? getRoomData($row['roomId'])[0]['header'] : '',
                'roomPlanSrt' => (isset($roomDetailArry)) ? $roomDetailArry['srtcode'] : '',
                'roomPlanFull' => (isset($roomDetailArry)) ? $roomDetailArry['fullForm'] : '',
            ];
            $data[] = array_merge($row, $advance);
        }
    }
    return $data;
}

function getAllBooingData($page = '', $paymentStatus = '', $date = '', $type = '', $search = '', $folio='',$travelAgent='',$company='',$addOn='',$billingMode='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from booking where hotelId = '$hotelId'";

    if ($paymentStatus != '') {
        $sql .= " and payment_status = '$paymentStatus'";
    }

    if ($folio != '') {
        $sql .= " and openFolio = '$folio'";
    }

    if ($travelAgent != '') {
        $sql .= " and travelagent = '$travelAgent'";
    }

    if ($company != '') {
        $sql .= " and organisation = '$company'";
    }

    if ($billingMode != '') {
        $sql .= " and billingMode = '$billingMode'";
    }

    if ($addOn != '') {
        $sql .= " and add_on like '%$addOn%'";
    }

    if ($date != '') {
        $dateArr = explode('/', $date);
        $dateStr = $dateArr['2'] . -$dateArr['0'] . -$dateArr['1'];
        $sql .= " and checkIn<='{$dateStr}' and checkOut>='{$dateStr}'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }


    return $data;
}

// function getBookDetailByRoomNumber ($rNo,$checkIn=''){
//     global $conDB;
//     $sql = mysqli_query($conDB, "select * from bookingdetail where room_number = $rNo");
//     $data = '';
//     if(mysqli_num_rows($sql) > 0){
//         $row = mysqli_fetch_assoc($sql);
//         $bid = $row['bid'];
//         $bookingData = getBookingData($bid,$checkIn);
//         $data = array_merge($row,$bookingData);
//     }
//     return $data;
// }

function getGuestDetail($bId = '', $sno = '', $gid = '', $bdid = '', $order = 'desc', $date = '', $delete = '', $kotId = '', $type = '', $accessId = '', $searchName = '', $searchCity = ''){

    global $conDB;
    $hotelId = HOTEL_ID;
    $data =  array();
    $query = "select * from guest where hotelId = '$hotelId'";

    if ($bId  != '') {
        $query .= " and bookId = '$bId'";
    }
    if ($sno != '') {
        $query .= " and serial = '$sno'";
    }
    if ($gid  != '') {
        $query .= " and id = '$gid'";
    }
    if ($kotId  != '') {
        $query .= " and kotId = '$kotId'";
    }
    if ($bdid != '') {
        $query .= " and bookingdId = '$bdid'";
    }

    if ($type != '') {
        $query .= " and type = '$type'";
    }

    if ($accessId != '') {
        $query .= " and accessId = '$accessId'";
    }

    if ($searchName != '') {
        $query .= " and name like '%$searchName%'";
    }

    if ($searchCity != '') {
        $query .= " and city like '%$searchCity%'";
    }

    if ($delete == '') {
        $query .= " and deleteRec = '1'";
    } else {
        $query .= "";
    }

    if ($date != '') {
        $query .= " and addOn like '$date%'";
    }

    if ($order == 'asc') {
        $query .= " ORDER BY `guest`.`id` ASC";
    }

    $sql = mysqli_query($conDB, $query);
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $bdid = $row['bookingdId'];
            $rnum = (count(getBookingDetail($bdid)) > 0) ? getBookingDetail($bdid)[0]['room_number'] : 0;
            $room_number = ['roonNum' => $rnum];
            $profileImgFull = ['profileImgFull' => ($row['image'] == null) ? FRONT_SITE_IMG . 'demo/userIcon.png' : getHotelImageData('', '', '', '', $row['image'])[0]['fullUrl']];
            $varifyImgFull = ['varifyImgFull' => ($row['kyc_file'] == null) ? FRONT_SITE_IMG . 'demo/document.png' : getHotelImageData('', '', '', '', $row['kyc_file'])[0]['fullUrl']];
            $varifyFileName = ['varifyFileName' => ($row['kyc_type'] == null || $row['kyc_type'] == 0) ? '' : getGuestIdProofData('', $row['kyc_type'])[0]['name']];

            $data[] = array_merge($row, $room_number, $profileImgFull, $varifyImgFull, $varifyFileName);
        }
    }
    return $data;
}

function totalGuestCount()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from guest where hotelId = '$hotelId'";
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        $num = mysqli_num_rows($query);
    } else {
        $num = 0;
    }
    return $num;
}

function getBookingDetailById($bid = '', $roomNo = '', $bdid = '', $date = ''){
    global $conDB;
    $checkIn = '';
    $checkOut = '';
    $userPay = '';
    $paymentStatus = '';
    $paymentId = '';
    $addOn = '';
    $couponCode = '';
    $pickUp = '';
    $reciptNo = '';
    $night = 1;
    $roomDetailArry = array();
    $checkinstatus = '';
    $bookingArray = array();
    $checkInDate = '';
    $checkOutDate = '';

    if (isset(getBookingData($bid)[0])) {
        $bookingArray = getBookingData($bid)[0];
        
        $checkIn = $bookingArray['checkIn'];
        $checkOut = $bookingArray['checkOut'];
        $bookinId = $bookingArray['bookinId'];
        $userPay = $bookingArray['userPay'];
        $paymentStatus = $bookingArray['payment_status'];
        $paymentId = $bookingArray['payment_id'];
        $addOn = $bookingArray['add_on'];
        $couponCode = $bookingArray['couponCode'];
        $pickUp = $bookingArray['pickUp'];
        $night = getNightByTwoDates($checkIn, $checkOut);
        $reciptNo = $bookingArray['reciptNo'];
        $checkinstatus = $bookingArray['checkinstatus'];
        $bookingSource = $bookingArray['bookingSource'];
        $reservationType = $bookingArray['reservationType'];
    }


    $guestRow = getGuestDetail($bid, '', '', $bdid);

    $name = '';
    $guistId = '';
    $guest = array();
    $totalAdult = 0;
    $totalChild = 0;
    $bookingQuery = "select * from bookingdetail where bid = '$bid'";
    if ($roomNo != '') {
        $bookingQuery .= " and room_number = '$roomNo' ";
    }
    if ($bdid != '') {
        $bookingQuery .= " and id = '$bdid' ";
    }
    $bookingQuery .= " and deleteRec = '1'";
    $bookingSql = mysqli_query($conDB, $bookingQuery);
 
    $totalCouponPrice = 0;
    $totalGst = 0;
    $totalRoomPrice = 0;
    $totalDiscount = 0;
    $totalExtra = 0;
    $roomNum = array();
    $bookingStatus = 1;
    $bStatusBy = '';
    $kotSubPrice = 0;
    $kotPrice = 0;
    $kotTax = 0;
    $kotPaidAmount = 0;
    $sumSubTotalPrice = 0;

    if (mysqli_num_rows($bookingSql) > 0) {
        while ($row = mysqli_fetch_assoc($bookingSql)) {
            
            $subTotalPrice = 0;
            $checkInDate = $row['checkIn'];
            $checkOutDate = $row['checkOut'];
            $bookngDId = $row['id'];
            $adult = $row['adult'];
            $child = $row['child'];
            $checkinstatus = $row['checkinstatus'];
            $room_number = $row['room_number'];
            // $room_number_id = getRoomNumber($room_number)[0]['id'];
            $kotOrderArry = getKotOrder('', '', '', '', '', '', '', '', $bookngDId);
            if (count($kotOrderArry) > 0) {
                $kotArryVal = $kotOrderArry[0];
                $kotSubPrice += $kotArryVal['subTotal'];
                $kotPrice += $kotArryVal['totalPrice'];
                $kotPaidAmount += $kotArryVal['sumPricePaid'];
                $kotTax += $kotArryVal['tax'];
            }
            $roomId = $row['roomId'];
            $roomDId = $row['roomDId'];
            $roomNum[] = $row['room_number'];

            $roomPrice = $row['roomPrice'];
            $adultPrice = 0;
            $childPrice = 0;
            $couponPrice = 0;
            $totalCouponPrice = 0;
            $roomWithCoupon = $roomPrice - $couponPrice;
            $totalRoomPrice += $roomPrice;
            $totalDiscount += $couponPrice;
            $totalExtra += $adultPrice + $child;

            $subTotalPrice += $roomWithCoupon + $adultPrice + $childPrice;
            $totalAdult += $adult;
            $totalChild += $child;
            $totalStay = $adult +  $child;

            $sumSubTotalPrice += $subTotalPrice;

            $gstPer = $row['gstPer'];
            $gst = getPercentageValu($roomPrice, $gstPer);
            $totalGst += $gst * $night;

            $rateTypeS = getSysPropertyRatePlaneList($roomDId)[0]['srtcode'];
            $rateTypeF = getSysPropertyRatePlaneList($roomDId)[0]['fullForm'];

            $totalPrice = $sumSubTotalPrice + $totalGst;

            $roomDetailArry[] = [
                'rdid' => $roomDId,
                'roomName' => getRoomList('yes', $roomId)[0]['header'] ?? '',
                'rateplan' => [$rateTypeS, $rateTypeF],
                'room' => $roomPrice,
                'couponPrice' => $couponPrice,
                'roomWithCoupon' => $roomWithCoupon,
                'adult' => $adult,
                'adultPrice' => $adultPrice,
                'child' => $child,
                'childPrice' => $childPrice,
                'gstPer' => $gstPer,
                'gstPrice' => $gst,
                'checkinstatus' => $checkinstatus,
                'room_number' => $room_number,
                'subTotal' => $subTotalPrice,
                'total' => $totalPrice,
                'totalStay' => $totalStay,
                'bookngDId' => $bookngDId,
                'bookingStatus' => $bookingStatus,
                'bStatusBy' => $bStatusBy,
            ];
        }
    }

    foreach ($guestRow as $key => $val) {
        if ($key == 0) {
            $name = getGuestDetail('', '', $val['id'])[0]['name'];
            $guistId = getGuestDetail('', '', $val['id'])[0]['id'];
        }
        $guest[] =  $val['id'];
    };

    $sumSubTotalPrice = $sumSubTotalPrice * $night;
    $gstPer = 12;
    $roomTotalPrice = $sumSubTotalPrice + $totalGst;
    $totalPrice = $roomTotalPrice + ($kotPrice - $kotPaidAmount);

    $roomNum = implode(', ', $roomNum);

    foreach(getBookingFolio('','',$bid) as $folioItem){
        $folioDiscount = $folioItem['discount'];
        $addService = $folioItem['addService'];
        $folioBalance = $folioItem['balance'];
        if($addService != ''){
            $totalPrice += $folioBalance;
        }
        if($folioDiscount != 0){
            $totalPrice -= $folioDiscount;
            $totalDiscount += $folioDiscount;
        }
    }

    $data2 = [
        'name' => $name,
        'guistId' => $guistId,
        'guest' => $guest,
        'guestArray' => $guestRow,
        'roomDetailArry' => $roomDetailArry,
        'totalAdult' => $totalAdult,
        'totalChild' => $totalChild,
        'night' => $night,
        'roomNum' => $roomNum,
        'couponPrice' => $totalCouponPrice,
        'totalRoomPrice' => $totalRoomPrice,
        'totalDiscount' => $totalDiscount,
        'subTotalPrice' => $sumSubTotalPrice,
        'gstPrice' => $totalGst,
        'totalPrice' => round($totalPrice,2),
        'checkIn'=>$checkInDate,
        'checkOut'=>$checkOutDate,
        'checkinstatus' => $checkinstatus,
        'roomTotalPrice' => $roomTotalPrice,
        'kotPrice' => $kotPrice,
        'kotSubPrice' => $kotSubPrice,
        'kotPaidAmount' => $kotPaidAmount,
        'kotPaidAmount' => $kotPaidAmount,
        'kotTax' => $kotTax,
        'checkinStatusArray'=>checkGuestCheckInStatus($checkinstatus),
        'paymentArry'=>getGuestPaymentTimeline('',$bid,'','','','','','','','','','yes')
    ];

    $data = array_merge($bookingArray, $data2);



    return $data;
}

function getGuestReviewById($gid = '', $pid = '', $firstReview = '', $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = array();
    $pidData = array();
    $sql = "select * from guest_review where hotelId = '$hotelId'";

    if ($gid != '') {
        $sql .= " and guestId = '$gid'";
    }

    if ($firstReview != '') {
        $sql .= " and pid = '0'";
    }

    if ($date != '') {
        $sql .= " and addOn like '$date%'";
    }

    if ($pid != '') {
        $pidSql = $sql . " and pid = '$pid'";
        $sql .= " and id = '$pid'";
        $pidquery = mysqli_query($conDB, $pidSql);
        while ($row = mysqli_fetch_assoc($pidquery)) {
            $pidData[] = $row;
        }
    }

    $query = mysqli_query($conDB, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    $result = array_merge($pidData, $data);

    return $result;
}



// Booking Detail End

function getRoomNameType($rtid = '')
{
    global $conDB;

    $data = getRoomList()[0];
    if ($rtid != '') {
        $data = getRoomList('', $rtid)[0];
    }

    return $data;
}

function getDateFormatByTwoDate($date, $date2)
{
    $dateString = date('M-d', strtotime($date));
    $date2String = date('M-d', strtotime($date2));

    $dateArr = explode('-', $dateString);
    $date2Arr = explode('-', $date2String);

    return $dateArr[0] . ' ' . $dateArr[1] . ' - ' . $date2Arr['1'];
}

function checkGuestCheckInStatus($status = '')
{
    global $conDB;

    $data = array();
    if ($status != '') {
        $sql = mysqli_query($conDB, "select * from sys_check_in_status where id = '$status' and status = '1'");
    } else {
        $sql = mysqli_query($conDB, "select * from sys_check_in_status where status = '1'");
    }

    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    };


    return $data;
}

function getPaymentTypeMethod($pid = '', $status  = '', $order = '')
{
    global $conDB;
    if ($status != '') {
        $sql = "select * from sys_banktypemethod where status = 1";
    } else {
        $sql = "select * from sys_banktypemethod where id != ''";
    }
    if ($pid != '') {
        $sql .= " and id = '$pid'";
    }

    if ($order != '') {
        if ($order == 'id') {
            $sql .= " order by id desc";
        }

        if ($order == 'name') {
            $sql .= " order by name asc";
        }
    } else {
        $sql .= " order by id desc";
    }

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

//    Frontoffice function 

function getBookingSource($bsid = '')
{
    global $conDB;
    $sql = "select * from sys_bookingsource where status = '1'";
    if ($bsid != '') {
        $sql .= " and id = '$bsid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

// function checkAmenitiesById($rid,$aid){
//     global $conDB;
//     $sql = mysqli_query($conDB, "select * from room_amenities where room_id  = '$rid' and amenitie_id  = '$aid'");
//     if(mysqli_num_rows($sql)){
//         $data = 1;
//     }else{
//         $data = 0;
//     }
//     return $data;
// }

function getReservationType($rid = '')
{
    global $conDB;
    $sql = "select * from sys_reservationtype";
    if ($rid != '') {
        $sql .= " where id = '$rid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getSalesType($sid = '')
{
    global $conDB;
    $sql = "select * from sales_type_list";
    if ($sid != '') {
        $sql .= " where id = '$sid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}


function getCashiering($tpe = '', $bs = '', $cid = '', $status = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from cashiering where hotelId = '$hotelId'";
    if ($status != '') {
        $sql .= " and status = '1'";
    }
    if ($tpe != '') {
        $sql .= " and type = '$tpe'";
    }
    if ($bs != '') {
        $sql .= " and bookingSource like '%$bs%'";
    }
    if ($cid != '') {
        $sql .= " and id = '$cid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getRoomType($rid = '', $status = '', $slug = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    if ($status != '') {
        $sql = "select * from room where deleteRec = '1' and hotelId = '$hotelId'";
    } else {
        $sql = "select * from room where hotelId = '$hotelId'";
    }
    if ($rid != '') {
        $sql .= " and id = '$rid'";
    }

    if ($slug != '') {
        $sql .= " and slug = '$slug'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getRateType($rid = '', $rdid = '', $status = '')
{
    global $conDB;
    $sql = "select * from roomratetype where id != ''";
    if ($rid != '' || $status != '' || $rdid != '') {
        $sql .= " and status = '1'";
    }
    if ($rid != '') {
        $sql .= " and room_id = '$rid'";
    }
    if ($rdid != '') {
        $sql .= " and id = '$rdid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $sysPlanArry = getSysPropertyRatePlaneList($row['title'])[0];
            $advance = [
                'name'=> $sysPlanArry['fullForm'],
                'srtcode'=> $sysPlanArry['srtcode'],
            ];
            $data[] = array_merge($row, $advance);
        }
    }

    return $data;
}

function getMaxAdultCountByRId($rid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room where id = '$rid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $data = $row['roomcapacity'];
    }
    return $data;
}

function getNoAdultCountByRId($rid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room where id = '$rid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $data = $row['noAdult'];
    }
    return $data;
}

function getNightByTwoDates($date1, $date2)
{
    $earlier = new DateTime($date1);
    $later = new DateTime($date2);

    $abs_diff = $later->diff($earlier)->format("%a");
    return $abs_diff;
}

function getCountChildData($rid, $nAdult = '')
{
    global $conDB;
    $maxAdult = getMaxAdultCountByRId($rid);
    $minAdult = getNoAdultCountByRId($rid);
    if ($nAdult != '') {
        $minAdult = $nAdult;
    }

    $data = $maxAdult - $minAdult;
    return $data;
}

function getGSTPercentage($price)
{
    if ($price <= 999) {
        $data = 0;
    } elseif ($price <= 7499) {
        $data = 12;
    } else {
        $data = 18;
    }
    return $data;
}

function getGSTPrice($price)
{
    if ($price <= 999) {
        $gstprice = 0;
    } elseif ($price <= 7499) {
        $gstprice = $price * 12 / 100;
    } else {
        $gstprice = $price * 18 / 100;
    }
    return $gstprice;
}

function couponActualPrice($code, $price,$array='')
{
    global $conDB;
    $totalPrice = 0;

    $coupon_value = '';
    $coupon_type = '';

    if ($code != 0 && $code != '') {
        $sql = mysqli_query($conDB, "select * from couponcode where coupon_code = '$code'");
        $row = mysqli_fetch_assoc($sql);
        $coupon_type = $row['coupon_type'];
        $coupon_value = $row['coupon_value'];


        if ($coupon_type == 'P') {
            $totalPrice = $price * ($coupon_value / 100);
        }
        if ($coupon_type == 'F') {
            $totalPrice = $coupon_value;
        }
    }

    if($array != ''){
        $data = [
            'code'=>$code,
            'type'=>$coupon_type,
            'per'=>$coupon_value,
            'price'=>$totalPrice,
        ];
    }else{
        $data = $totalPrice;
    }
    

    return  $data;
}

function getRoomPriceById($rid, $rdid = '', $nadult='', $date = '', $date2 = '')
{
    global $conDB;
    if ($date == '') {
        $date = date('Y-m-d');
    }
    $countAdult = getMinRoomAdultCountById($rid);
    if ($countAdult < $nadult) {
        $nadult = $countAdult;
    }
    if ($nadult > 2) {
        $nadult = 2;
    }
    $price = 0;

    if ($nadult == 1) {
        $sql = "select price as price from inventory where room_id = '$rid' and room_detail_id = '$rdid'  and add_date = '$date'  and price != 'Null' and price != ''";
        $query = mysqli_query($conDB, $sql);
        if (mysqli_num_rows($query) > 0) {
            $inven_row = mysqli_fetch_assoc($query);
            $price = $inven_row['price'];
        } else {
            $sql = "select singlePrice as price from roomratetype where room_id = '$rid' and id='$rdid'";
            $query = mysqli_query($conDB, $sql);
            if (mysqli_num_rows($query) > 0) {
                $inven_row = mysqli_fetch_assoc($query);
                $price = $inven_row['price'];
            }
        }
    }

    if ($nadult == 2) {
        $sql = "select price2 as price from inventory where room_id = '$rid' and room_detail_id = '$rdid'  and add_date = '$date'  and price != 'Null' and price2 != ''";
        $query = mysqli_query($conDB, $sql);
        if (mysqli_num_rows($query) > 0) {
            $inven_row = mysqli_fetch_assoc($query);
            $price = $inven_row['price'];
        } else {
            $sql = "select doublePrice as price from roomratetype where room_id = '$rid' and id='$rdid' and doublePrice != 0";
            $query = mysqli_query($conDB, $sql);
            if (mysqli_num_rows($query) > 0) {
                $inven_row = mysqli_fetch_assoc($query);
                $price = $inven_row['price'];
            } else {
                $sql = "select doublePrice as price from roomratetype where room_id = '$rid' and id='$rdid' and doublePrice != 0";
                $query = mysqli_query($conDB, $sql);
                if (mysqli_num_rows($query) > 0) {
                    $inven_row = mysqli_fetch_assoc($query);
                    $price = $inven_row['price'];
                } else {
                    $sql = "select singlePrice as price from roomratetype where room_id = '$rid' and id='$rdid'";
                    $query = mysqli_query($conDB, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $inven_row = mysqli_fetch_assoc($query);
                        $price = $inven_row['price'];
                    }
                }
            }
        }
    }

    return $price;
}

function getRoomAdultCountById($rid)
{
    global $conDB;
    $query = "select max(room.roomcapacity) as maxAdult from room,roomratetype where room.id=roomratetype.room_id and roomratetype.room_id = '$rid'";
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, $query));
    return $query;
}

function getMinRoomAdultCountById($rid){
    global $conDB;
    $data = '';
    if ($rid != 0 && $rid != null) {
        $query = "select * from room where id = '$rid'";
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, $query));
        $data = $sql['noAdult'];
    }
    return $data;
}

function getMinRoomAdultCountByIdRdid($rid, $rdid = '')
{
    global $conDB;
    $query = "select room.*,roomratetype.*, roomratetype.id as room_detailId from room,roomratetype where room.id=roomratetype.room_id and roomratetype.room_id = '$rid' and  roomratetype.id = '$rdid'";
    $query = mysqli_query($conDB, $query);
    $sql = mysqli_fetch_assoc($query);
    $single = getRoomPriceById($rid, $rdid, 1, date('Y-m-d'));
    $double = getRoomPriceById($rid, $rdid, 2, date('Y-m-d'));
    if ($single == $double) {
        $data = $sql['noAdult'];
    } elseif ($double == 0) {
        $data = 1;
    } elseif ($single < $double) {
        $data = 1;
    }
    return $data;
}

function getRoomChildCountById($rid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select max(room.noChild) as maxChild from room,roomratetype where room.id=roomratetype.room_id and roomratetype.room_id = '$rid'"));
    return $sql['maxChild'];
}

function getRoomExtraAdultPriceById($rdid, $date = '')
{
    // global $conDB;
    // $invenSql = mysqli_query($conDB, "select eAdult from inventory where room_detail_id = '$rdid' and add_date = '$date' and eAdult != '0'");
    // if (mysqli_num_rows($invenSql) > 0) {
    //     $row = mysqli_fetch_assoc($invenSql);
    //     $price = $row['eAdult'];
    // } else {
    //     $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select extra_adult from roomratetype where id = '$rdid'"));
    //     $price = $sql['extra_adult'];
    // }

    return 0;
}

function getAdultPriceByNoAdult($n, $rid, $rdid, $date = '')
{
    $data = '';
    if ($rid != 0) {
        if (getMinRoomAdultCountById($rid) >= $n) {
            $data = 0;
        } else {
            $data = ($n - getMinRoomAdultCountById($rid)) * getRoomExtraAdultPriceById($rdid, $date);
        }
    }
    return $data;
}

function getRoomExtraChildPriceById($rdid, $date = '')
{
    global $conDB;
    $invenSql = mysqli_query($conDB, "select eChild from inventory where room_detail_id = '$rdid' and add_date = '$date' and eChild != '0'");
    if (mysqli_num_rows($invenSql) > 0) {
        $row = mysqli_fetch_assoc($invenSql);
        $price = $row['eChild'];
    } else {
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select extra_child from roomratetype where id = '$rdid'"));
        $price = $sql['extra_child'];
    }

    return $price;
}

function getChildPriceByNoChild($n, $rid, $rdid, $date = '')
{
    if (getRoomChildCountById($rid) >= $n) {
        $data = 0;
    } else {
        $data = ($n - getRoomChildCountById($rid)) * getRoomExtraChildPriceById($rdid, $date);
    }
    return $data;
}

function getRoomLowPriceById($rid, $date)
{
    global $conDB;
    $data = array();
    if (isset($_SESSION['checkout'])) {
        $date2 = $_SESSION['checkout'];
    } else {
        $oneDay = strtotime('1 day 30 second', 0);
        $date2 = date('Y-m-d', strtotime($date) + $oneDay);
    }
    $sql = "select * from inventory where room_id = '$rid' and add_date <= '$date'  and price !='' order by price desc";
    $inven_sql = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($inven_sql) > 0) {
        while ($inven_row = mysqli_fetch_assoc($inven_sql)) {
            $price = $inven_row['price'];
        }
    } else {
        $sql = "select * from room_detail where room_id = '$rid' and price !='' order by price desc";
        $inven_sql = mysqli_query($conDB, $sql);
        while ($inven_row = mysqli_fetch_assoc($inven_sql)) {
            $price = $inven_row['price'];
        }
    }

    return $price;
}

function getRoomLowPriceByIdWithDate($rid, $date, $date2 = '')
{
    global $conDB;
    if ($date2 == '') {
        $date2 = $date;
    }
    $data = array();
    $sql = "select * from inventory where  room_id = '$rid' and add_date = '$date' and price !='' order by price desc";
    $inven_sql = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($inven_sql) > 0) {
        while ($inven_row = mysqli_fetch_assoc($inven_sql)) {
            $price = $inven_row['price'];
        }
    } else {
        $sql = "select * from roomratetype where room_id = '$rid' order by singlePrice desc";
        $inven_sql = mysqli_query($conDB, $sql);
        while ($inven_row = mysqli_fetch_assoc($inven_sql)) {
            $price = $inven_row['singlePrice'];
        }
    }

    return $price;
}

function getSingleRoomPrice($rid, $rdid, $adult, $child, $date, $nNight, $couponCode = '')
{
    global $conDB;
    if ($rid == 0) {
        return array();
        die();
    }
    $date = ($date == '') ? date('Y-m-d') : $date;
    $nNight = ($nNight == '' || $nNight == 0) ? 1 : $nNight;
    $singleRoom = getRoomPriceById($rid, $rdid, $adult, $date);
    $adultPrice = getAdultPriceByNoAdult($adult, $rid, $rdid, $date);
    $childPrice = getChildPriceByNoChild($child, $rid, $rdid, $date);

    $roomPrice = $singleRoom;
    $couponPrice = 0;
    $couponType = '';
    $couponPer = '';

    if ($couponCode != '') {
        $couponArray = couponActualPrice($couponCode, $roomPrice,'yes');
        $couponPrice = $couponArray['price'];
        $couponType = $couponArray['type'];
        $couponPer = $couponArray['per'];
        $roomPrice = $roomPrice - $couponPrice;
    }

    $nightPrice = $roomPrice + $adultPrice + $childPrice;

    $totalRoomPrice = ($nightPrice  * $nNight);

    $gstper = getGSTPercentage($roomPrice);

    if ($gstper == 0) {
        $gst = 0;
    }else{
        $gst = ($totalRoomPrice * $gstper) / 100;
    }

    $totalPrice = $totalRoomPrice + $gst;
    $nightPriceHtml = $nightPrice;
    if ($nNight > 1) {
        $nightPriceHtml = $nightPrice . ' * ' . $nNight;
    }


    $data = array();

    $data = [
        'room' => $singleRoom,
        'adultPrint' => $adult,
        'childPrint' => $child,
        'adult' => $adultPrice,
        'child' => $childPrice,
        'noNight' => $nNight,
        'night' => $nightPrice,
        'nightPrice' => $nightPriceHtml,
        'couponCode' => $couponCode,
        'couponPrice' => $couponPrice,
        'couponType' => $couponType,
        'couponPer' => $couponPer,
        'gstPer' => $gstper,
        'gst' => $gst,
        'total' => $totalPrice,
        'commission' => 0,
        'roundTotal' => round($totalPrice),
    ];

    return $data;
}

function getPercentageByTwoValue($first, $sec)
{
    $data = $first * 100 / $sec;
    return round($data);
}

function getPercentageValu($amount, $value)
{
    $data = $value * $amount / 100;

    return $data;
}

// (bookingdetail.checkIn <= '$checkIn' AND bookingdetail.checkOut >= '$checkIn' AND bookingdetail.checkOut <= '$checkOut') 
//                 OR

function checkRoomNumberExiist($rId, $checkIn = '', $checkOut = '', $rnum = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $checkOut = ($checkOut == '') ? date('Y-m-d', strtotime('+1 day', strtotime($checkIn))) : $checkOut;

    $sql = "SELECT  bookingdetail.roomId,bookingdetail.hotelId, bookingdetail.checkIn, bookingdetail.checkOut, bookingdetail.room_number FROM booking, bookingdetail
        WHERE bookingdetail.hotelId = '$hotelId' and booking.id = bookingdetail.bid AND bookingdetail.roomId = '$rId' AND (
                 (bookingdetail.checkIn >= '$checkIn' AND bookingdetail.checkOut <= '$checkOut') 
                OR(bookingdetail.checkIn >= '$checkIn' AND bookingdetail.checkOut >= '$checkIn' AND bookingdetail.checkOut >= '$checkOut' AND bookingdetail.checkIn <= '$checkOut') 
                OR(bookingdetail.checkIn <= '$checkIn' AND bookingdetail.checkOut >= '$checkOut')
            )";



    if ($rnum != '') {
        $sql .= " and bookingdetail.room_number = '$rnum'";
    }

    $sql .= " and bookingdetail.checkinstatus != 4 and bookingdetail.checkinstatus != 5 and bookingdetail.checkinstatus != 6 and bookingdetail.checkinstatus != 7 group by bookingdetail.room_number";

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }


    return $data;
}

function countBookingRow($rTab = '', $currentDate = '', $search = '', $paymentStatus = '', $roomNum = '')
{
    if ($currentDate == '') {
        $currentDate = date('Y-m-d');
    }
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = reservationReturnQuery($rTab, $currentDate, $search, $paymentStatus, $roomNum);

    $query = mysqli_query($conDB, $sql);

    $data = mysqli_num_rows($query);

    return $data;
}

function getPageName($page)
{
    $page = explode('/', $page);
    return explode('.', end($page))[0];
}


function roomMoveOptionByRoomId($roomId, $opType, $bdid, $roomNum=''){
    $data = '';

    if ($opType == 'rate') {
        foreach (getRatePlanArrById($roomId) as $ratePlaneList) {
            $id = $ratePlaneList['id'];
            $rplan = ucfirst(getSysPropertyRatePlaneList($ratePlaneList['rplan'])[0]['srtcode']);

            $data .= "<option value='$id'>$rplan</option>";
        }
    }
    if ($opType == 'roomNum') {
        foreach (getRoomNumber('', '1', $roomId, '', '', '', '', $bdid) as $roomTypeList) {
            $num = $roomTypeList['roomNo'];
            $numId = $roomTypeList['id'];
            $select = '';
            if($num == $roomNum){
                $select = "selected";
            }
            $data .= "<option $select value='$num'>$num</option>";
        }
    }



    return $data;
}



// Reservation

function reservationContent($bid, $reciptNo, $gname, $checkIn, $checkOut, $bDate, $nAdult, $nChild, $total, $paid, $preview = '', $rTab = '', $BDId = '', $clickBtn = '', $couponCode = '',$couponPrice='',$couponType='',$couponPer='',$resType='')
{
    // pr($paid);
    
    if ($checkIn == '') {
        $checkIn = date('Y-m-d');
    }
    if ($checkOut == '') {
        $checkOut = date("Y-m-d", strtotime("1 day", strtotime(date('Y-m-d'))));
    }
    if (strtotime($checkIn) == strtotime($checkOut)) {
        $checkOut = date("Y-m-d", strtotime("1 day", strtotime($checkIn)));
    }
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
    if ($preview != '') {
        $bidCode = (count(getBookingData($bid)) > 0) ? getBookingData($bid)[0]['bookinId'] : '';
    } else {
        $bidCode = $_SESSION['reservatioId'];
    }
    $gname = ucfirst($gname);

    $checkInOut = getDateFormatByTwoDate($checkIn, $checkOut);
    $totalAmount = number_format($total, 2);
    $paidAmount = number_format($paid, 2);
    $pending = number_format($total - $paid, 2);
    $countNight = getNightByTwoDates($checkIn, $checkOut);
    $paymentMethodHtml = '';
    foreach (getPaymentTypeMethod('', 1) as $paymentMethodList) {
        $paymentName = $paymentMethodList['name'];
        $paymentId = $paymentMethodList['id'];
        $paymentMethodHtml .= "<option value='$paymentId'>$paymentName</option>";
    }

    $previewContent = '';
    $bDate = date('d-M', strtotime($bDate));
    $hotelVoucerLink = FRONT_SITE . '/voucher?vid=' . $bid;
    $guestVoucerLink = FRONT_SITE . '/voucher?oid=' . $bid;
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

    $resStatusArray = fetchData('sys_reservationtype', ['id'=>$resType])[0];

    $statusName = $resStatusArray['name'];
    $statusBg = $resStatusArray['bg'];
    $statusClr = $resStatusArray['clr'];

    $statusHtml = '<div class="checkinStatus center"><span style="background: '.$statusBg.';color: '.$statusClr.';">'.$statusName.'</span></div>';

    $viewDetailBtn = '<a class="reservationViewBtn" data-bookingId="' . $bid . '" data-reservationTab="' . $rTab . '" data-bdid="' . $BDId . '" href="javascript:void(0)"><button>View Booking</button></a>';

    if ($preview == 'yes') {
        $previewContent = "        
                <div class='foot'>
                    <div class='dFlex aic jcsb'>
                        <ul>
                            <li><a href='javascript:void(0)' data-tooltip-top='Hotel Voucher'><i class='fas fa-print'></i></a></li>
                            <li><a href='javascript:void(0)' data-tooltip-top='Email'><i class='far fa-envelope-open'></i></a></li>
                            <li><a href='javascript:void(0)' data-tooltip-top='Guest Voucher'><i class='far fa-file-alt'></i></a></li>
                        </ul>
                        $viewDetailBtn
                    </div>
                </div>
        
        ";
        $actionBtn = '<a data-bookingId="' . $bid . '" data-reservationTab="' . $rTab . '" data-bdid="' . $BDId . '" href="javascript:void(0)" class="reservationDetailActionBtn"><span></span><span></span><span></span></a>';
    }

    $reservationBtn = 'reservationContent';
    if ($clickBtn != '') {
        $reservationBtn = 'reservationContentPreview';
    }

    $couponCodeHtml = '';
    if($couponCode != '' && $couponCode != 0){
        $codeText = ($couponType == 'P') ? "<strong>$couponPer%</strong> Discount :- <strong>$couponPrice</strong>" : "Flat <strong>$couponPer</strong> Off *";
        $couponCodeHtml = '<div class="coupon_price">'.$codeText.'</div>';
    }

    $html = "
            <div class='$reservationBtn' data-bookingId='$bid' data-reservationTab='$rTab' data-bdid='$BDId'>
                            
                <div class='head dFlex aic jcsb'>
                    <div class='leftSide dFlex aic'>
                        <div class='icon'><i class='fas fa-user'></i></div>
                        <div class='userName'>
                            <h4>$gname</h4>
                            <span> $reciptNo / $bidCode </span>
                        </div>
                    </div>
                    <div class='rightSide'>$statusHtml</div>
                </div>

                <div class='body'>
                    <div class='checkInDetail'>
                        <div class='left'>
                            <strong>$checkInOut</strong>
                        </div>
                        <div class='right'>
                            <span>Night </span>
                            <strong>$countNight</strong>
                        </div>
                    </div>
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
                    $couponCodeHtml
                    <div class='bookingDetail'>
                        <ul>
                            <li>
                                <small>Total</small>
                                <strong>Rs $totalAmount</strong>
                            </li>
                            <li>
                                <small>Paid</small>
                                <strong>Rs $paidAmount</strong>
                            </li>
                            <li>
                                $paymentCheckStatusHtml
                            </li>
                        </ul>
                    </div>

                </div>

                $previewContent

            </div>
    ";


    return $html;
}


function bookingDetailPopUpContent($bid, $bdid = '', $rTab = ''){

    $bookDetailArry = getBookingData($bid)[0];
    
    $roomNum = $bookDetailArry['room_number'];

    $roomNumList = '';
    $page  = '';
    $roomNumListHtml  = '';
    $bookingRoomArry = getBookingDetailById($bid)['roomDetailArry'];
    $bookingDetailTable = '';
    $getBookingTimeLine = getBookingTimeLine($bid, $bdid);
    
    foreach ($bookingRoomArry as $key => $val) {
        
        $checkInStatus = $val['checkinstatus'];
        $bookngDId = $val['bookngDId'];
        $rdid = $val['rdid'];
        $num = $val['room_number'];
        $checkinstatus = $val['checkinstatus'];        

        if($checkinstatus == 2){
            $checkInClass = 'check-in';
        }elseif($checkinstatus == 3){
            $checkInClass = 'check-out';
        }elseif($checkinstatus == 5){
            $checkInClass = 'cencel';
        }else{
            $checkInClass = 'resevation';
        }

        $active = '';

        if ($bdid != '') {
            if ($bdid == $bookngDId) {
                $active = 'active';
                $bookingDetailTable = bookingDetailTable($bid, $bookngDId);
                $bookingDetailGuestHtml = bookingDetailGuestHtml($bid, $bookngDId, $rTab, $num, $checkInStatus);
                $btnGroupHtml = bookingDetailBtnGroupHtml($bid, $bookngDId, $num, $rTab, $checkInStatus);
            }
        } else {
            if ($key == 0) {
                $getBookingTimeLine = getBookingTimeLine($bid, $bookngDId);
                $active = 'active';
                $bookingDetailTable = bookingDetailTable($bid, $bookngDId);
                $bookingDetailGuestHtml = bookingDetailGuestHtml($bid, $bookngDId, $rTab, $num, $checkInStatus);
                $btnGroupHtml = bookingDetailBtnGroupHtml($bid, $bookngDId, $num, $rTab, $checkInStatus);
            }
        }

        $roomNumList .= '<li data-bdid="'.$bookngDId.'" data-bookingId="' . $bid . '" class="' . $active . '"><span class="status '.$checkInClass.'"></span>' . $num . '</li>';
    }

    if (count(getBookingDetailById($bid)['roomDetailArry']) > 0) {
        $roomNumListHtml = '<div class="bookingRoomNumList">
                                <ul>
                                    ' . $roomNumList . '
                                </ul>
                            </div>';
    }

    $roomId = $bookDetailArry['roomId'];
    $checkInStatus = $bookDetailArry['checkinstatus'];

    $bookingVId = $bookDetailArry['bookinId'];
    $reciptNo = $bookDetailArry['reciptNo'];
    $room_number = $bookDetailArry['room_number'];

    $checkIn = date('d M, y', strtotime($bookDetailArry['checkIn']));
    $checkOut = date('d M, y', strtotime($bookDetailArry['checkOut']));
    $add_on = date('d-M-Y', strtotime($bookDetailArry['add_on']));

    $night = getNightByTwoDates($bookDetailArry['checkIn'], $bookDetailArry['checkOut']);

    $roomName = strtoupper(getRoomNameType($bookDetailArry['roomId'])['header']);
    $roomDId = $bookDetailArry['roomDId'];
    $bookingSourceArray = getBookingSource($bookDetailArry['bookingSource'])[0];
    $bookingSourceImg = FRONT_SITE_IMG . 'icon/source/' . $bookingSourceArray['img'];
    $bookingSourceName = $bookingSourceArray['name'];

    $grossCharge = getBookingDetailById($bid)['totalPrice'];
    $avgPrice = $grossCharge / $night;
    $userPay = $bookDetailArry['userPay'];
    $guestPayable = $grossCharge - $userPay;



    $guestList = '';
    $groupGuestName = '';
    $groupGuestPhone = 'Null';
    $goupGuestImg = '';

    foreach (getBookingDetailById($bid, '', $bdid)['guest'] as $key => $guest) {

        $gusetArray = getGuestDetail('', '', $guest)[0];
        $guestName = ($gusetArray['name'] == null) ? '' : ucfirst($gusetArray['name']);
        $guestUploadType = $gusetArray['file_upload_type'];
        $guestImg = checkImg($gusetArray['image'], 'guest');
        if ($guestUploadType == 'qr') {
            $guestImg = 'https://retrod.in/img/guest/' . $gusetArray['image'];
        }

        $kayNum = $key + 1;
        $guestId = $gusetArray['id'];

        $guestList .= '
            <div class="group">
                                        
                <div class="box">
                    <img src="' . $guestImg . '">
                    <div class="caption">
                        <h5>' . $guestName . '</h5>
                        <p>' . $bookingVId . '/' . $kayNum . '|' . $room_number . '-' . $kayNum . '</p>
                        <div class="editGuest" data-bdid="' . $bdid . '" data-bid="' . $bid . '" data-id="' . $guestId . '"><i class="far fa-edit"></i></div>
                    </div>
                </div>
                
            </div>
        ';

        if ($gusetArray['serial'] == 1) {
            $groupGuestName = ($gusetArray['name'] == null) ? '' : ucfirst($gusetArray['name']);
            $groupGuestPhone = ($gusetArray['phone'] == null) ? '' :ucfirst($gusetArray['phone']);
            $goupGuestImg = checkImg($gusetArray['image'], 'guest');
        }
    }

    // Check in status start


    $cardHeight = '';



    $paymentStatusHtml = "Pay To Hotel";
    if ($guestPayable < 0) {
        $paymentStatusHtml = "Pay To Guest";
    }


    // Check in status end


    $html = '
           
            <div class="row">
            
                <div class="col-md-6">

                    <div id="guestDetailCard" class="card" data-page="' . $page . '">
                        
                            <div class="card-header">
                                <div class="booking">
                                    <div class="sourseImg" title="' . $bookingSourceName . '"><i class="bi bi-globe2"></i></div>                                
                                    <div class="title">
                                        <div class="name"><h4>' . $groupGuestName . '</h4> <i class="fas fa-users"></i> </div>
                                        <div class="location">
                                            <i class="bi bi-telephone"></i>
                                            <span>' . $groupGuestPhone . '</span>
                                        </div>
                                    </div>
                                </div>
                                ' . $roomNumListHtml . '
                                ' . $btnGroupHtml . '

                            </div>

                            <div class="card-body">
                                ' . $bookingDetailTable . '
                                <div class="row"><div class="col-12 popUpTimeline"><h6 class="mb-3">Guest Activity</h6>' . $getBookingTimeLine . '</div></div>
                            </div>

                        <div class="card-footer">
                            <table width="100%">
                                <tr>
                                    <td><p>Total</p></td>                                    
                                    <td align="right"><p>₹ ' . number_format($grossCharge, 2) . '</p></td>                                    
                                </tr> 
                                <tr>
                                    <td><p>Paid</p></td>                                    
                                    <td align="right"><p>₹ ' . number_format($userPay, 2) . '</p></td>                                    
                                </tr> 
                                <tr>
                                    <td><p>' . $paymentStatusHtml . '</p></td>                                    
                                    <td align="right"><p>₹ ' . number_format($guestPayable, 2) . '</p></td>                                    
                                </tr>                                
                            </table>
                        </div>
                    </div>
                    

                </div>

                <div class="col-md-6" style="position:relative">
                    
                        
                    <div class="bookingGuestList bookingRoomList">
                        ' . $bookingDetailGuestHtml . '
                    </div>

                    <div class="bookingOtherDetail" id="bookingOtherDetail">
                        
                    </div>

                    
                </div>

            </div>

    ';


    return $html;
}


function bookingDetailBtnGroupHtml($bid='', $bdid='', $roomNum='', $rTab='', $checkInStatus='')
{
    $btnGroupHtml = '';

    $paymentBtnHtml = '<button data-reservationtab="' . $rTab . '" data-bookingId="' . $bid . '" data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="paymentBtn" class="btn btn-outline-secondary"><span><svg viewBox="64 64 896 896" width="15px" height="15px" focusable="false" data-icon="credit-card" fill="currentColor" aria-hidden="true"><path d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-792 72h752v120H136V232zm752 560H136V440h752v352zm-237-64h165c4.4 0 8-3.6 8-8v-72c0-4.4-3.6-8-8-8H651c-4.4 0-8 3.6-8 8v72c0 4.4 3.6 8 8 8z"></path></svg></span><h4>Payment</h4></button>';

    $printBtn = '<button data-reservationtab=' .$rTab. ' data-bookingId=' .$bid. ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="printBtn" class="btn btn-outline-secondary" ><span><svg viewBox="64 64 896 896" focusable="false" width="15px" height="15px" data-icon="printer" fill="currentColor" aria-hidden="true"><path d="M820 436h-40c-4.4 0-8 3.6-8 8v40c0 4.4 3.6 8 8 8h40c4.4 0 8-3.6 8-8v-40c0-4.4-3.6-8-8-8zm32-104H732V120c0-4.4-3.6-8-8-8H300c-4.4 0-8 3.6-8 8v212H172c-44.2 0-80 35.8-80 80v328c0 17.7 14.3 32 32 32h168v132c0 4.4 3.6 8 8 8h424c4.4 0 8-3.6 8-8V772h168c17.7 0 32-14.3 32-32V412c0-44.2-35.8-80-80-80zM360 180h304v152H360V180zm304 664H360V568h304v276zm200-140H732V500H292v204H160V412c0-6.6 5.4-12 12-12h680c6.6 0 12 5.4 12 12v292z"></path></svg></span><h4>Print</h4></button>';

    $checkOutBtn = '<button data-reservationtab="' . $rTab . '" data-bookingId="' . $bid . '" data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="checkInStatus" class="btn btn-outline-secondary mr4" ><span><svg fill="none" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g clip-path="url(#clip0)"><path d="M8.6778 9.3207v2.5994H10v-3.516l-3.4633-1.51c-.323-.1277-.6687-.1352-1.0142-.03-.3456.1052-.6236.3155-.8264.6236l-.7062 1.1118c-.278.5034-.6762 1.0292-1.217 1.3448-.5335.3155-1.1345.4733-1.788.4733v1.3748c.7512 0 1.5024-.1578 2.156-.4733.6536-.3155 1.2246-.8564 1.6904-1.3748l.4282 2.096-1.48 1.3823v5.2589H5.192v-4.132l1.4274-1.4649 1.2997 5.5969h1.48l-1.9758-9.849 1.2546.4882zm-5.4392-4.162c0 .834.6686 1.5026 1.5025 1.5026a1.4973 1.4973 0 001.5026-1.5026c0-.8339-.6762-1.5025-1.5026-1.5025-.8264 0-1.5025.6761-1.5025 1.5025z" fill="currentColor"></path><path d="M12.0204 10.0513l-3.9565 3.265a.236.236 0 00-.047.0816A.312.312 0 008 13.5a.312.312 0 00.0168.1021.236.236 0 00.0472.0816l3.9564 3.265c.1083.1224.2708.0117.2708-.1837V15h5.5421c.0917 0 .1667-.1049.1667-.2332v-2.5336c0-.1283-.075-.2332-.1667-.2332h-5.5421v-1.765c0-.1954-.1604-.3061-.2708-.1837z" fill="#F39406"></path><path d="M10 .119v.8929c0 .0655.0605.119.1345.119h8.5882V18H20V.4762C20 .2128 19.7597 0 19.4622 0h-9.3277C10.0605 0 10 .0536 10 .119z" fill="currentColor"></path></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"></path></clipPath></defs></svg></span><h4>Checkout</h4></button>';

    $checkInBtn = '<button data-reservationtab="' . $rTab . '" data-bookingId="' . $bid . '" data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="checkInStatus" class="btn btn-outline-secondary mr4" ><span><svg fill="none" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g clip-path="url(#clip0)"><path d="M2.307 9.3207v2.5994H.9848v-3.516l3.4633-1.51c.323-.1277.6687-.1352 1.0142-.03.3456.1052.6236.3155.8265.6236l.7061 1.1118c.278.5034.6762 1.0292 1.217 1.3448.5335.3155 1.1345.4733 1.7881.4733v1.3748c-.7513 0-1.5025-.1578-2.1561-.4733s-1.2246-.8564-1.6904-1.3748l-.4282 2.096 1.48 1.3823v5.2589H5.7929v-4.132l-1.4274-1.4649-1.2997 5.5969h-1.48l1.9759-9.849-1.2547.4882zm5.4392-4.162c0 .834-.6686 1.5026-1.5025 1.5026A1.4973 1.4973 0 014.741 5.1586c0-.8339.6762-1.5025 1.5026-1.5025.8264 0 1.5025.6761 1.5025 1.5025z" fill="currentColor"></path><path d="M13.9796 10.0513l3.9564 3.265a.2352.2352 0 01.0472.0816A.3141.3141 0 0118 13.5a.3141.3141 0 01-.0168.1021.2352.2352 0 01-.0472.0816l-3.9564 3.265c-.1083.1224-.2708.0117-.2708-.1837V15H8.1667C8.075 15 8 14.8951 8 14.7668v-2.5336c0-.1283.075-.2332.1667-.2332h5.5421v-1.765c0-.1954.1604-.3061.2708-.1837z" fill="#0068FF"></path><path d="M10 .119v.8929c0 .0655.0605.119.1345.119h8.5882V18H20V.4762C20 .2128 19.7597 0 19.4622 0h-9.3277C10.0605 0 10 .0536 10 .119z" fill="currentColor"></path></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"></path></clipPath></defs></svg></span><h4>Checkin</h4></button>';

    $checkInOutBtn = '<button data-reservationtab="' . $rTab . '" data-bookingId="' . $bid . '" data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="checkInOutBtn" class="btn btn-outline-secondary"><span><svg width="15px" height="15px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.4643 2.67854H18.2143C18.6094 2.67854 18.9286 2.99774 18.9286 3.39282V11H17.3215V8.83925H2.67862V17.3214H12V18.9285H1.78576C1.39067 18.9285 1.07147 18.6093 1.07147 18.2143V3.39282C1.07147 2.99774 1.39067 2.67854 1.78576 2.67854H5.53576V1.24997C5.53576 1.15175 5.61612 1.0714 5.71433 1.0714H6.96433C7.06254 1.0714 7.1429 1.15175 7.1429 1.24997V2.67854H12.8572V1.24997C12.8572 1.15175 12.9375 1.0714 13.0358 1.0714H14.2858C14.384 1.0714 14.4643 1.15175 14.4643 1.24997V2.67854ZM2.67862 4.28568V7.3214H17.3215V4.28568H14.4643V5.35711C14.4643 5.45532 14.384 5.53568 14.2858 5.53568H13.0358C12.9375 5.53568 12.8572 5.45532 12.8572 5.35711V4.28568H7.1429V5.35711C7.1429 5.45532 7.06254 5.53568 6.96433 5.53568H5.71433C5.61612 5.53568 5.53576 5.45532 5.53576 5.35711V4.28568H2.67862Z" fill="currentColor"></path><path d="M19.3257 14.4617C19.3471 14.445 19.3643 14.4236 19.3762 14.3993C19.3881 14.3749 19.3943 14.3482 19.3943 14.3211C19.3943 14.294 19.3881 14.2672 19.3762 14.2429C19.3643 14.2185 19.3471 14.1971 19.3257 14.1804L16.1628 11.6804C16.0467 11.5889 15.8748 11.6715 15.8748 11.8211V13.4751H8.32127C8.22306 13.4751 8.1427 13.5554 8.1427 13.6537V14.9929C8.1427 15.0912 8.22306 15.1715 8.32127 15.1715L15.8726 15.1715V16.8211C15.8726 16.9706 16.0445 17.0532 16.1606 16.9617L19.3257 14.4617Z" fill="currentColor"></path></svg></span><h4>Amend Stay</h4></button>';

    $reservationBtn = '<button data-reservationtab=' . $rTab . ' data-bookingId=' . $bid . ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" class="btn  btn2 btn-primary" id="editReservationsbtn"><i class="fas fa-print"></i> Edit Reservation</button>';


    $roomMoveBtn = '<button data-reservationtab=' . $rTab . ' data-bookingId=' . $bid . ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="roomMoveBtn" class="btn btn-outline-secondary" ><span><svg  width="15px" height="15px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.7143 6.0625H16.4286C17.3754 6.06359 18.2832 6.42611 18.9527 7.07053C19.6222 7.71495 19.9989 8.58865 20 9.5V12H18.5714V9.5C18.5709 8.95316 18.3449 8.42887 17.9432 8.0422C17.5414 7.65552 16.9967 7.43805 16.4286 7.4375H10.7143V12H12V13.375H1.42857V16H0V4H1.42857V12H9.28571V7.4375C9.28609 7.07294 9.43672 6.72341 9.70455 6.46563C9.97238 6.20785 10.3355 6.06286 10.7143 6.0625Z" fill="currentColor"></path><path d="M5.25 7.28571C5.44072 7.28571 5.62715 7.34227 5.78573 7.44823C5.9443 7.55418 6.0679 7.70478 6.14088 7.88098C6.21387 8.05718 6.23296 8.25107 6.19576 8.43812C6.15855 8.62518 6.06671 8.79699 5.93185 8.93185C5.797 9.06671 5.62518 9.15855 5.43812 9.19576C5.25107 9.23296 5.05718 9.21387 4.88098 9.14088C4.70478 9.0679 4.55418 8.9443 4.44823 8.78573C4.34227 8.62715 4.28571 8.44072 4.28571 8.25C4.28606 7.99436 4.38776 7.74929 4.56852 7.56852C4.74929 7.38776 4.99436 7.28605 5.25 7.28571ZM5.25 6C4.80499 6 4.36998 6.13196 3.99997 6.37919C3.62996 6.62643 3.34157 6.97783 3.17127 7.38896C3.00097 7.8001 2.95642 8.2525 3.04323 8.68895C3.13005 9.12541 3.34434 9.52632 3.65901 9.84099C3.97368 10.1557 4.37459 10.3699 4.81105 10.4568C5.2475 10.5436 5.6999 10.499 6.11104 10.3287C6.52217 10.1584 6.87357 9.87004 7.12081 9.50003C7.36804 9.13002 7.5 8.69501 7.5 8.25C7.5 7.65326 7.26295 7.08097 6.84099 6.65901C6.41903 6.23705 5.84674 6 5.25 6V6Z" fill="currentColor"></path><path d="M19.3257 16.1407C19.3471 16.124 19.3643 16.1027 19.3762 16.0783C19.3881 16.0539 19.3943 16.0272 19.3943 16.0001C19.3943 15.973 19.3881 15.9462 19.3762 15.9219C19.3643 15.8975 19.3471 15.8762 19.3257 15.8595L16.1628 13.3595C16.0467 13.2679 15.8748 13.3505 15.8748 13.5001V15.1541H8.32127C8.22306 15.1541 8.1427 15.2345 8.1427 15.3327V16.672C8.1427 16.7702 8.22306 16.8505 8.32127 16.8505H15.8726V18.5001C15.8726 18.6496 16.0445 18.7322 16.1606 18.6407L19.3257 16.1407Z" fill="currentColor"></path></svg></span><h4>Room Move</h4></button>';

    $cancleReservation = '<button data-bookingId='.$bid.' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="cancleReservation" class="btn btn-outline-secondary" ><span><svg width="15px" height="15px" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18.2143 2.6785h-3.75V1.25a.179.179 0 00-.1785-.1786h-1.25a.179.179 0 00-.1786.1786v1.4285H7.1429V1.25a.179.179 0 00-.1786-.1786h-1.25a.179.179 0 00-.1785.1786v1.4285h-3.75a.7135.7135 0 00-.7143.7143v14.8215c0 .395.3192.7142.7143.7142h16.4285a.7135.7135 0 00.7143-.7142V3.3928a.7135.7135 0 00-.7143-.7143zm-.8928 14.6429H2.6786V8.8392h14.6429v8.4822zm-14.6429-10V4.2857h2.8572V5.357a.179.179 0 00.1785.1786h1.25a.1791.1791 0 00.1786-.1786V4.2857h5.7143V5.357a.179.179 0 00.1786.1786h1.25a.179.179 0 00.1785-.1786V4.2857h2.8572v3.0357H2.6786z" fill="currentColor"></path><g clip-path="url(#clip0)"><circle cx="15" cy="15" r="3" fill="#fff"></circle><path d="M15 10c-2.7612 0-5 2.2388-5 5s2.2388 5 5 5 5-2.2388 5-5-2.2388-5-5-5zm1.846 6.8996l-.7366-.0034L15 15.5737l-1.1083 1.3214-.7377.0033a.0888.0888 0 01-.0893-.0892.0929.0929 0 01.0212-.0581l1.452-1.7299-1.452-1.7288a.0935.0935 0 01-.0212-.058.0896.0896 0 01.0893-.0893l.7377.0033L15 14.471l1.1083-1.3214.7366-.0034a.0889.0889 0 01.0893.0893.0927.0927 0 01-.0213.058l-1.4497 1.7288 1.4509 1.7299a.093.093 0 01.0212.0581.0896.0896 0 01-.0893.0893z" fill="#FF5353"></path></g><defs><clipPath id="clip0"><path fill="#fff" transform="translate(10 10)" d="M0 0h10v10H0z"></path></clipPath></defs></svg></span><h4>Reservation Cancel</h4></button>';
    
    $Noshow = '<button onclick="makeNoShowReservation('.$bdid.')" data-reservationtab="' . $rTab . '" data-bookingId="' . $bid . '" data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" id="noshow" class="btn btn-outline-secondary mr4" ><svg class="w20 h20 mr10"><use xlink:href="#reservationNoshowSvgIcon"></use></svg><h4>No show</h4></button>';
    
    $folioLink = generateFolioLink($bid);

    $folioBtn = '<button onclick="window.location.href = \''.$folioLink.'\'" id="folio" class="btn btn-outline-secondary mr4" ><svg class="w15 h15 mr10"><use xlink:href="#folioIcon"></use></svg><h4>Folio</h4></button>';


    $editReservationLink = FRONT_SITE.'/reservation-edit?id='.$bid;
    
    if ($checkInStatus == 1) {

        $btnGroupHtml = '
            <div class="guestDetailRow">
                <a href="'.$editReservationLink.'" class="reservationBtn" data-reservationtab=' . $rTab . ' data-bookingId=' . $bid . ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" class="btn  btn2 btn-primary" id="">Edit Reservation</a>
                <div class="dropdownSec block">
                <button><span>More Option</span><i class="bi bi-chevron-down"></i></button>
                    <div class="content">
                        <ul>
                            <li>' . $checkInBtn . '</li>
                            <li>' . $paymentBtnHtml . '</li>
                            <li>' . $printBtn . '</li>
                            <li>' . $checkInOutBtn . '</li>
                            <li>' . $roomMoveBtn . '</li>
                            <li>' . $folioBtn . '</li>
                            <li>' . $Noshow . '</li>
                            <li>' . $cancleReservation . '</li>
                         
                        </ul>
                    </div>
                </div>
            </div>            
        ';
    }

    if ($checkInStatus == 2) {
        
        $btnGroupHtml = '
            <div class="guestDetailRow">
            <a href="'.$editReservationLink.'" class="reservationBtn" data-reservationtab=' . $rTab . ' data-bookingId=' . $bid . ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" class="btn  btn2 btn-primary" id="">Edit Reservation</a>
                <div class="dropdownSec block">
                <button><span>More Option</span><i class="bi bi-chevron-down"></i></button>
                    <div class="content">
                        <ul>
                            <li>' . $checkOutBtn . '</li>
                            <li>' . $printBtn . '</li>
                            <li>' . $paymentBtnHtml . '</li>
                            <li>' . $checkInOutBtn . '</li>
                            <li>' . $roomMoveBtn . '</li>
                            <li>' . $folioBtn . '</li>
                    
         
                        </ul>
                    </div>
                </div>
            </div>            
        ';
    }

    if ($checkInStatus == 3) {

        $btnGroupHtml = '
        
            <div class="guestDetailRow">
                <a href="'.$editReservationLink.'" class="reservationBtn" data-reservationtab=' . $rTab . ' data-bookingId=' . $bid . ' data-roomnum="' . $roomNum . '" data-bdid="' . $bdid . '" class="btn  btn2 btn-primary" id="">View Reservation</a>
                <div class="dropdownSec block">
                    <button><span>More Option</span><i class="bi bi-chevron-down"></i></button>
                    <div class="content">
                        <ul>
                            <li>' . $printBtn . '</li>
                        </ul>
                    </div>
                </div>
            </div>
        
        ';
    }

    return $btnGroupHtml;
}

function bookingDetailTable($bid, $bdid)
{
    $bookDetailArry = getBookingData($bid, '', '', $bdid)[0];
    $roomNum = $bookDetailArry['room_number'];
    $roomId = $bookDetailArry['roomId'];
    $checkInStatus = $bookDetailArry['checkinstatus'];
    
    $bookingVId = $bookDetailArry['bookinId'];
    $reciptNo = $bookDetailArry['reciptNo'];
    $room_number = $bookDetailArry['room_number'];

    $checkIn = date('d M, y', strtotime($bookDetailArry['checkIn']));
    $checkOut = date('d M, y', strtotime($bookDetailArry['checkOut']));
    $add_on = date('d-M-Y', strtotime($bookDetailArry['add_on']));

    $night = getNightByTwoDates($bookDetailArry['checkIn'], $bookDetailArry['checkOut']);

    $roomName = strtoupper(getRoomNameType($bookDetailArry['roomId'])['header']);
    $roomDId = $bookDetailArry['roomDId'];
    $bookingSourceArray = getBookingSource($bookDetailArry['bookingSource'])[0];
    $bookingSourceImg = FRONT_SITE_IMG . 'icon/source/' . $bookingSourceArray['img'];
    $bookingSourceName = $bookingSourceArray['name'];

    $grossCharge = getBookingDetailById($bid)['totalPrice'];
    // pr($grossCharge);
    // $avgPrice = $grossCharge / $night;
    $avgPrice = $grossCharge / $night;
    $userPay = $bookDetailArry['userPay'];
    $guestPayable = $grossCharge - $userPay;
    $html = '
        <table width="100%">

            <tr>
                <td><p><small>Reservation Number</small><br/><span>' . $reciptNo . '</span></p></td>                                    
                <td align="right"><p><small>Voucher Number</small><br/><span>' . $bookingVId . '</span></p></td>                                    
            </tr>

            <tr>
                <td colspan="2" class="confirme paymentStatus"><p><small>Status</small><br/> <span>Confirmed Booking</span></p></td>                                                         
            </tr>

            <tr>
                <td><p><small>Arrival Date</small><br/><span>' . $checkIn . '</span></p></td>                                    
                <td align="right"><p><small>Departure Date</small><br/><span>' . $checkOut . '</span></p></td>                                    
            </tr>

            <tr>
                <td><p><small>Booking Date</small><br/><span>' . $add_on . '</span></p></td>                                    
                <td align="right"><p><small>Room Type</small><br/><span>' . $roomName . '</span></p></td>                                    
            </tr>

            <tr>
                <td><p><small>Room Number</small><br/><span>' . $roomNum . '</span></p></td>                                    
                <td align="right"><p><small>Avg. Daily Rate</small><br/><span>Rs ' . number_format($avgPrice, 2) . '</span></p></td>                                    
            </tr>
        
        </table>
    ';

    return $html;
}

function bookingDetailGuestHtml($bid, $bdid, $rTab = '', $room_number = '', $checkInStatus = '')
{
    $bookDetailArry = getBookingData($bid)[0];
    $bookingVId = $bookDetailArry['bookinId'];
    foreach (getBookingDetailById($bid, '', $bdid)['roomDetailArry'] as $key => $guestValue) {
        // pr($bdid);
        if ($guestValue['bookngDId'] == $bdid) {
            $maxAdult = $guestValue['totalStay'];
        }
    }

    $bookGuest = count(getBookingDetailById($bid, '', $bdid)['guest']);
    $addGouestBtn = '';

    if ($maxAdult > $bookGuest) {
        $addGouestBtn = '<div class="s25"></div><button id="addGustBtn" data-reservationtab="' . $rTab . '" data-bookingId = "' . $bid . '" data-roomNum = "' . $room_number . '" data-bdid="' . $bdid . '" class="btn btn-outline-primary">Add Guest</button>';
    }

    if($checkInStatus == 5){
        $addGouestBtn='';
    }

    $guestList = '';
    $groupGuestName = '';
    $groupGuestPhone = 'Null';
    $goupGuestImg = '';

    foreach (getBookingDetailById($bid, '', $bdid)['guest'] as $key => $guest) {

        $gusetArray = getGuestDetail('', '', $guest)[0];
        // pr($gusetArray);
        $guestName = ucfirst($gusetArray['name']);
        $guestUploadType = $gusetArray['file_upload_type'];
        $guestImg = $gusetArray['profileImgFull'];
        $kayNum = $key + 1;
        $guestId = $gusetArray['id'];

        $guestList .= '
            <div class="group">                                        
                <div class="box">
                    <img src="' . $guestImg . '">
                    <div class="caption">
                        <h5>' . $guestName . '</h5>
                        <p>' . $bookingVId . '/' . $kayNum . '|' . $room_number . '-' . $kayNum . '</p>
                        <div class="editGuest" data-bdid="' . $bdid . '" data-bid="' . $bid . '" data-id="' . $guestId . '"><i class="far fa-edit"></i></div>
                    </div>
                </div>
                
            </div>
        ';

        if ($gusetArray['serial'] == 1) {
            $groupGuestName = ucfirst($gusetArray['name']);
            $groupGuestPhone = ucfirst($gusetArray['phone']);
            $goupGuestImg = checkImg($gusetArray['image'], 'guest');
        }
    }

    $guestList .= $addGouestBtn;
    $guestListHtml = '<h4>Guest List</h4> ' . $guestList;

    if ($checkInStatus == 3) {
        $guestListHtml = printBtnClickToHtml($bid, $bdid);
    }
    

    return $guestListHtml;
}

// Web Builder Function 

function getSlider($sid = '', $limit = '', $delete = '', $order = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sidStatus = '';
    $limitSql = '';
    $deleteSql = " and deleteRec='1'";

    $query = "select * from wb_slider where hotelId = '$hotelId'";

    if ($sid != '') {
        $query .= " and id = '$sid'";
    }

    if ($delete == '') {
        $query .= " and deleteRec='1'";
    } else {
        $query .= "";
    }

    if ($order != '') {
        $query .= " order by sliderorder ASC";
    } else {
        $query .= " order by id DESC";
    }

    if ($limit != '') {
        $query .= " limit $limit";
    }



    $sql = mysqli_query($conDB, $query);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    return $data;
}

function getWbBlogData($bid = '', $limit = '', $delete = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_blog where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($bid != '') {
        $sql .= " and id = '$bid' ";
    }

    $sql .= "  order by id DESC";

    if ($limit != '') {
        $sql .= " limit $limit";
    }

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getWbBlogCategoryData($bid = '', $limit = '', $delete = '', $orderBy = '', $orderIn = '', $checkName = '', $notId = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_blog_category where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($bid != '') {
        $sql .= " and id = '$bid' ";
    }

    if ($checkName != '') {
        $sql .= " and name = '$checkName' ";
    }

    if ($notId != '') {
        $sql .= " and id != '$notId' ";
    }

    if ($orderBy != '') {
        $sql .= "  order by $orderBy $orderIn";
    } else {
        $sql .= "  order by id DESC";
    }

    if ($limit != '') {
        $sql .= " limit $limit";
    }


    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getSysBlogCategoryData($bid = '', $limit = '', $orderBy = '', $orderIn = '', $checkName = '')
{
    global $conDB;

    $sql = "select * from sys_blog_cat where id !='' ";

    if ($bid != '') {
        $sql .= " and id = '$bid' ";
    }

    if ($checkName != '') {
        $sql .= " and name = '$checkName' ";
    }

    if ($orderBy != '') {
        $sql .= "  order by $orderBy $orderIn";
    } else {
        $sql .= "  order by id DESC";
    }

    if ($limit != '') {
        $sql .= " limit $limit";
    }


    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getWbGalleryCategory($gid = '', $limit = '', $delete = '', $orderBy = '', $orderIn = '', $checkName = '', $notId = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_gallery_category where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($gid != '') {
        $sql .= " and id = '$gid' ";
    }

    if ($checkName != '') {
        $sql .= " and name = '$checkName' ";
    }

    if ($notId != '') {
        $sql .= " and id != '$notId' ";
    }

    if ($orderBy != '') {
        $sql .= "  order by $orderBy $orderIn";
    } else {
        $sql .= "  order by id asc";
    }


    if ($limit != '') {
        $sql .= " limit $limit";
    }

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}


function getWbGalleryData($gid = '', $limit = '', $delete = '', $cat = '',$img=''){
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_gallery where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($gid != '') {
        $sql .= " and id = '$gid' ";
    }

    if ($img != '') {
        $sql .= " and img = '$img' ";
    }

    if ($cat != '') {
        $sql .= " and category = '$cat' ";
    }

    $sql .= "  order by id DESC";

    if ($limit != '') {
        $sql .= " limit $limit";
    }

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $galleryArry = getHotelImageData('','','','',$row['img'])[0];
            $advance = [
                'fullUrl'=>$galleryArry['fullUrl']
            ];
            $data[] = array_merge($row,$advance);
        }
    }

    return $data;
}


function getWbOfferData($gid = '', $delete = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_offersection where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($gid != '') {
        $sql .= " and id = '$gid' ";
    }

    $sql .= "  order by id DESC";

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getWbFeedbackData($gid = '', $limit = '', $delete = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from wb_feedback where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($gid != '') {
        $sql .= " and id = '$gid' ";
    }

    $sql .= "  order by id DESC";

    if ($limit != '') {
        $sql .= " limit $limit";
    }

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getSysRoomStatus($id = '', $name = '', $get='')
{
    global $conDB;

    $sql = "select * from sys_roomstatus where id !='' ";


    if ($id != '') {
        $sql .= " and id = '$id' ";
    }

    if($get != ''){
        $sql .= " and id in($get)";        
    }

    if ($name != '') {
        $sql .= "  order by name asc";
    } else {
        $sql .= "  order by id DESC";
    }
    
    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getHotelRoomStatus($id = '', $pid = '')
{
    global $conDB;

    $sql = "select * from roomstatus where id !='' ";


    if ($id != '') {
        $sql .= " and id = '$id' ";
    }

    if ($pid != '') {
        $sql .= " and pId = '$pid' ";
    }

    $sql .= "  order by id DESC";

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getRoomStatus($id = '', $name = '',$get='')
{
    global $conDB;
    $data = array();

    foreach (getSysRoomStatus($id, $name, $get) as $item) {
        $statusId = $item['id'];
        if (count(getHotelRoomStatus('', $statusId)) > 0) {
            $data[] = getHotelRoomStatus('', $statusId)[0];
        } else {
            $data[] = $item;
        }
    }

    return $data;
}

function getRatePlanArrById($rid, $bdid = '')
{
    global $conDB;

    $query = "select * from roomratetype where room_id = '$rid'";
    $rdid = getRoomDetailData('', $rid)[0]['id'];
    $adult = '2';

    if ($bdid != '') {
        $bookingArry = getBookingDetail($bdid)[0];
        $rdid = $bookingArry['roomDId'];
        $adult = $bookingArry['adult'];
    }

    $sql = mysqli_query($conDB, $query);
    $data = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = [
            'id' => $row['id'],
            'rplan' => $row['title'],
            'price' => getRoomPriceById($rid, $rdid, $adult)
        ];
    }
    return $data;
}


function inventoryCheck($date, $rid = '', $rdid = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = 1;
    $rdidStatus = '';
    if ($rdid != '') {
        $rdidStatus = " and room_detail_id = '$rdid' ";
    }

    $sql = mysqli_query($conDB, "select status from inventory where add_date = '$date' and room_id = '$rid' and hotelId='$hotelId' $rdidStatus");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $data = $row['status'];
    }

    return $data;
}

function inventoryRoomUpdate($updateId, $room, $date, $status)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $oneDay = strtotime('1 day 30 second', 0);
    $nxtDate = date('Y-m-d', strtotime($date) + $oneDay);
    $countTotalBooking = countTotalBooking($updateId, $date, $nxtDate);

    if ($countTotalBooking > 0) {
        $Bookroom = $countTotalBooking + $room;
    } else {
        $Bookroom = $room;
    }

    foreach (getRatePlanArrById($updateId) as $roomDetail) {
        $rdid = $roomDetail['id'];
        foreach (buildRatePlanView($updateId) as $roomList) {

            $roomId = $roomList['id'];
            $rdid = $roomList['rdid'];

            $reExistQuery = mysqli_query($conDB, "select * from inventory where hotelId='$hotelId' and room_id='$roomId' and room_detail_id='$rdid' and add_date = '$date' ");
            if (mysqli_num_rows($reExistQuery) > 0) {
                mysqli_query($conDB, "update inventory set room='$Bookroom',status='$status' where room_id='$updateId' and room_detail_id='$rdid' and add_date = '$date' and hotelId='$hotelId'");
            } else {
                mysqli_query($conDB, "insert into inventory(room_id,room_detail_id,add_date,room,status,hotelId) values('$roomId','$rdid','$date','$Bookroom','$status','$hotelId')");
            }
        }
    }
}

function inventoryRateUpdate($updateId, $updateDId='', $price = '', $price2 = '', $date='', $child='', $adult='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $oneDay = strtotime('1 day 30 second', 0);
    $addBy = dataAddBy();

    if ($price != '') {
        $priceUpade = "price='$price'";
    }

    if ($price2 != '') {
        $priceUpade = "price2='$price2'";
    }

    $price = ($price == '') ? 0 : $price;
    $price2 = ($price2 == '') ? 0 : $price2;
    $child = ($child == '') ? 0 : $child;
    $adult = ($adult == '') ? 0 : $adult;

    $roomExist = roomExist($updateId, $date, '', '', 'yes');

    $existQuery = mysqli_query($conDB, "select * from inventory where hotelId='$hotelId' and room_id='$updateId' and room_detail_id='$updateDId'  and add_date = '$date'");
    if (mysqli_num_rows($existQuery) > 0) {
        $sql = "update inventory set $priceUpade, room= '$roomExist', eAdult='$adult', eChild='$child' where  room_id='$updateId' and room_detail_id='$updateDId' and add_date = '$date'";
        mysqli_query($conDB, $sql);
        $msg = '';
    } else {
        $sql = "insert into inventory(room_id,room_detail_id,add_date,price,price2,eAdult,eChild,hotelId,room,addBy) values('$updateId','$updateDId','$date','$price','$price2','$adult','$child','$hotelId','$roomExist','$addBy')";
        mysqli_query($conDB, $sql);
        $msg = '';
    }

    setActivityFeed('', 20, '', '', '', '', '', '', $msg);
}

function buildRatePlanView($rid)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "SELECT room.*,roomratetype.id as roomDetailID,roomratetype.room_id FROM room, roomratetype where hotelId='$hotelId' and roomratetype.room_id = '$rid' and room.id = roomratetype.room_id";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'id' => $row['id'],
                'adult' => $row['noAdult'],
                'rdid' => $row['roomDetailID'],
            ];
        }
    }

    return $data;
}

function roomExist($rid, $date = "", $date2 = '', $rdid = '', $onlyRoom = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "SELECT * FROM room where id = '$rid'";
    $status = mysqli_fetch_assoc(mysqli_query($conDB, $sql));
    $checkIn = $date;
    $checkOut = $date2;
    $advancePayOpPrice = settingValue()['advancePay'];

    if ($date == '') {
        $checkIn = $_SESSION['checkIn'];
    }

    if ($date2 == '') {
        $checkOut = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : '';
    }

    if (getRoomLowPriceByIdWithDate($rid, $date) > $advancePayOpPrice && $advancePayOpPrice != 0) {
        $check_sold = countTotalQPBooking($rid, $checkIn);
    } else {
        $check_sold = countTotalBooking($rid, $checkIn);
    }

    $check_stock = getTotalRoom($rid, $checkIn, '', $onlyRoom);

    $result =  $check_stock - $check_sold;

    if ($rdid != '') {
        if (isset($_SESSION['checkIn'])) {
            $checkInTime = $_SESSION['checkIn'];
        }
    }


    if ($result < 0) {
        $result = 0;
    }

    return $result;
}

function totalRoomExist()
{
    $hotelId = HOTEL_ID;
    $roomListArry = getRoomList();
    $totalRoom = 0;
    $currentDate = date('Y-m-d');
    $previousDate = date('Y-m-d', strtotime(' -1 day'));
    foreach ($roomListArry as $roomList) {
        $id = $roomList['id'];
        $totalRoom += roomExist($id, $previousDate, $currentDate);
    }
    return $totalRoom;
}

function totalRoomInventory()
{
    $hotelId = HOTEL_ID;
    $roomListArry = getRoomList();
    $totalRoom = 0;
    $currentDate = date('Y-m-d');
    $previousDate = date('Y-m-d', strtotime(' -1 day'));
    foreach ($roomListArry as $roomList) {
        $id = $roomList['id'];
        $totalRoom += getTotalRoom($id, $previousDate, $currentDate);
    }
    return $totalRoom;
}

function settingValue()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from propertysetting where hotelId = '$hotelId'");
    $test = 'true';
    if (mysqli_num_rows($sql) > 0) {
    } else {
        mysqli_query($conDB, "insert into propertysetting(hotelId) values('$hotelId')");
        $sql = mysqli_query($conDB, "select * from propertysetting where hotelId = '$hotelId'");
        $test = 'false';
    }

    $row = mysqli_fetch_assoc($sql);
    return  $row;
}

function countTotalBooking($rid, $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $BookSql = "SELECT booking.*,bookingdetail.*, bookingdetail.id as bookingDetailMainId FROM booking,bookingdetail where booking.hotelId = '$hotelId' and booking.id = bookingdetail.bid and booking.payment_status='1' and bookingdetail.roomId ='$rid' and bookingdetail.checkIn <= '$date' && bookingdetail.checkOut > '$date'";

    $check_sql = mysqli_query($conDB, $BookSql);
    $roomNo = 0;
    if (mysqli_num_rows($check_sql) > 0) {
        while ($row = mysqli_fetch_assoc($check_sql)) {
            $bId = $row['id'];
            $roomNo += countTotalBookingDetailByBID($bId);
        }
    }

    return $roomNo;
}

function countTotalBookingDetailByBID($bid)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from bookingdetail where bid = '$bid'";
    $totalRow = mysqli_num_rows(mysqli_query($conDB, $sql));

    return $totalRow;
}

function getTotalRoom($rid, $date, $date2 = '', $onlyRoom = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    if ($date2 == '') {
        $date2 = $date;
    }
    $room = 0;
    if ($onlyRoom != '') {
        $room = count(getRoomNumber('', '', $rid));
    } else {
        $query = "select room from inventory where hotelId  = '$hotelId' and room_id  = '$rid' and add_date = '$date'";
        $sql = mysqli_query($conDB, $query);
        if (mysqli_num_rows($sql) > 0) {
            while ($inven_row = mysqli_fetch_assoc($sql)) {
                $room = $inven_row['room'];
            }
        } else {
            $room = count(getRoomNumber('', '', $rid));
        }
    }


    return $room;
}

function countTotalQPBooking($rid, $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $BookSql = "SELECT sum(nOfRoom) as noRoom FROM quickpay where  room = '$rid' and paymentStatus='1' and checkIn <= '$date' && checkOut > '$date'";

    $check_sold_arr = mysqli_fetch_assoc(mysqli_query($conDB, $BookSql));

    $check_sold = $check_sold_arr['noRoom'];
    return $check_sold;
}

function getRatePlanByRoomId($rid)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = array();
    $sql = mysqli_query($conDB, "select * from roomratetype where room_id  = '$rid'");
    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }
    return $data;
}

function getHotelUserDetail($uid = '', $name = '', $userId = '', $email = '', $phone = '', $role = '', $order = '',$delete='',$status=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $hotelId = orginalHotelId($hotelId);
    $sql = "select hotel.*,hoteluser.*,hoteluser.id as hotelUserId from hotel,hoteluser where hotel.id = hoteluser.hotelMainId ";

    $sql .= " and hotel.hCode = '$hotelId'";

    if ($uid != '') {
        $sql .= " and hoteluser.id = '$uid'";
    }

    if ($name != '') {
        $sql .= " and hoteluser.name = '$name'";
    }

    if ($userId != '') {
        $sql .= " and hoteluser.userId = '$userId'";
    }

    if ($email != '') {
        $sql .= " and hoteluser.email = '$email'";
    }

    if ($phone != '') {
        $sql .= " and hoteluser.phone = '$phone'";
    }

    if ($role != '') {
        $sql .= " and hoteluser.role = '$role'";
    }

    if ($delete != '') {
        $sql .= " and hoteluser.deleteRecord = '$delete'";
    }

    if ($status != '') {
        $sql .= " and hoteluser.status = '$status'";
    }

    if ($order != '') {
        if ($order == 'id') {
            $sql .= " order by hoteluser.id desc";
        }

        if ($order == 'name') {
            $sql .= " order by hoteluser.name asc";
        }
    } else {
        $sql .= " order by hoteluser.id desc";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $imgArry = getHotelImageData('', '', '', '', $row['imageId'])[0];
        $imgName = $imgArry['image'];
        $img = getImgPath('private', $imgName);
        $image = ['fullImgUrl' => $img];
        $data[] = array_merge($row, $image);
    }

    return $data;
}

function getUserAccess($uid = '',$pageId=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from user_access where hotelId = '$hotelId' ";

    if ($uid != '') {
        $sql .= " and userId = '$uid'";
    }

    if ($pageId != '') {
        $sql .= " and pageId = '$pageId'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
       
        $advance = [
            'productId'=> (isset(getSysPageData($row['pageId'])[0])) ? getSysPageData($row['pageId'])[0]['pId'] : 0,
            'productName'=> (isset(getSysPageData($row['pageId'])[0])) ? getSysPageData($row['pageId'])[0]['name'] : '',
        ];
               
        
        $data[] = array_merge($advance,$row);
    }
    

    return $data;
}


function getSuperAdminData($sid = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from superadmin where id != '' ";

    if ($sid != '') {
        $sql .= " and id = '$sid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}



function getHotelSettingData($id = '', $hid = '')
{
    global $conDB;
    $sql = "select * from propertysetting where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getHotelServiceData($id = '', $hid = '', $sid = '', $status = '')
{
    global $conDB;
    $sql = "select * from hotelservice where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    if ($sid != '') {
        $sql .= " and serviceId = '$sid'";
    }

    if ($status != '') {
        $sql .= " and status = '$status'";
    }
    
    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $productArry = getSysProductData($row['serviceId'])[0];
        $serviceName = $productArry['name'];
        $serviceKey = $productArry['accessKey'];
        $serviceIcon = $productArry['icon'];
        $serviceShortCode = $productArry['shortForm'];
        $servicePid = $productArry['pid'];
        $serviceAddArray = [
            'serviceName' => $serviceName,
            'serviceKey' => $serviceKey,
            'serviceIcon' => $serviceIcon,
            'serviceShortCode' => $serviceShortCode,
            'servicePid' => $servicePid,
        ];
        $data[] = array_merge($row, $serviceAddArray);
    }

    return $data;
}

function getHotelProfileData($id = '', $hid = '')
{
    global $conDB;
    $sql = "select * from hotelprofile where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getHotelLocationData($id = '', $hid = '')
{
    global $conDB;
    $sql = "select * from propertylocation where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getHotelSeoData($id = '', $hid = '')
{
    global $conDB;
    $sql = "select * from property_seo where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function setHotelDetail($cname, $value)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "update hotel set $cname = '$value' where hCode = '$hotelId'";
    if (mysqli_query($conDB, $sql)) {
        $data = 1;
    } else {
        $data = 0;
    }
    return $data;
}

function hotelTerm($id = '', $hid = '', $type = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $hid = ($hid == '') ? $hotelId : $hid;
    if ($id != '') {
        $array[] = ['id' => $id];
    }
    if ($hid != '') {
        $array[] = ['hotelId' => $hid];
    }
    if ($type != '') {
        $array[] = ['policyType' => $type];
    }

    return QueryGen('property_term', $array);
}

function getPropertyCounList($id = '', $pid = '', $name = '')
{

    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from propertycounlist where id != '' ";

    if ($id != '') {
        $sql .= " and id = '$id' ";
    }

    if ($pid != '' || $pid == 0) {
        $sql .= " and pid = '$pid' ";
    }

    if ($name != '') {
        $sql .= " and name like '%$name%'";
    }


    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            $data[] = $row;
        }
    }

    return $data;
}

function getHotelImageData($hid = '', $accessValue = '', $accessKey = '', $imgName = '', $imgId = '', $array = '', $private='',$order='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "select * from hotel_image where id != ''";
    if ($imgId != '') {
        $query .= " and id = '$imgId'";
    }
    if ($hid != '') {
        $query .= " and hotelId = '$hotelId'";
    }
    if ($accessValue != '') {
        $query .= " and accessValue = '$accessValue'";
    };
    if ($accessKey != '') {
        $query .= " and accessId = '$accessKey'";
    };
    if ($private != '') {
        $query .= " and private = '$private'";
    };
    if ($imgName != '') {
        $query .= " and image = '$imgName'";
    };

    if ($order == 'idAsc') {
        $query .= " order by id asc";
    }elseif($order == 'nameAsc'){
        $query .= " order by image asc";
    }else{
        $query .= " order by id desc";
    }


    $sql = mysqli_query($conDB, $query);
    $img = array();

    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $fullUrl = getImgPath($row['private'], $row['image'],'','',$row['source']);
            $img[] = array_merge($row, ['fullUrl' => $fullUrl]);
        }
    }

    if ($array == '') {
        if (mysqli_num_rows($sql)) {
        } else {
            $img[] = ['image' => 'demo-img.png'];
        }
    }


    return $img;
}

function getHotelImgDataById($id)
{
    $blacnkArry = [
        'id' => '',
        'hotelId' => '',
        'accessId' => '',
        'accessValue' => '',
        'image' => '',
        'altTag' => '',
        'title' => '',
        'private' => '',
        'addBy' => '',
        'addOn' => '',
        'fullUrl' => '',
    ];
    $data = (count(getHotelImageData('', '', '', '', $id, 'yes')) > 0) ? getHotelImageData('', '', '', '', $id)[0] : $blacnkArry;
    return $data;
}

function getImageById($rid = '', $riid = '', $order = '')
{
    global $conDB;
    $query = "select * from room_img where id != ''";
    if ($rid != '') {
        $query .= " and room_id = '$rid'";
    }
    if ($riid != '') {
        $query .= " and id = '$riid'";
    };
    if ($order != '') {
        $query .= " order by $order ASC";
    } else {
        $query .= " order by id DESC";
    }
    $sql = mysqli_query($conDB, $query);

    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $img[] = $row;
        }
    } else {
        $img[] = ['image' => 'demoRoom.jpg'];
    }

    return $img;
}

function getFacingDetailById($fid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from facing where id = '$fid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $data = $row;
    }

    return $data;
}

function getPackageArr()
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from package where status = '1'");
    $data = array();
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = [
                'id' => $row['id'],
                'slug' => $row['slug'],
                'name' => $row['name'],
                'img' => $row['img'],
                'duration' => $row['duration'],
                'description' => $row['description'],
                'room' => $row['room'],
                'discount' => $row['discount'],
                'rdid' => $row['rdid'],
            ];
        }
    }

    return $data;
}

function getRoomIdBySlug($slug)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select id from room where slug = '$slug'"));
    return $sql['id'];
}

function getDataBaseDate2($date)
{

    $checkInArr = explode('/', $date);
    $checkIn = $checkInArr['2'] . '-' . $checkInArr['1'] . '-' . $checkInArr['0'];
    return $checkIn;
}

function getAmenitieById($aid = '', $aname = '', $arr = '', $count = '', $order = '', $notid = '', $said = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $query =  "select * from amenities where hotelId = '$hotelId' and deleteRec = '1'";

    if ($aid != '') {
        $query .=  " and id = '$aid'";
    }
    if ($aname != '') {
        $query .=  " and title = '$aname'";
    }

    if ($notid != '') {
        $query .=  " and id != '$notid'";
    }

    if ($said != '') {
        $query .=  " and sysAId = '$said'";
    }

    $query .= " order by id desc";
    if ($order != '') {
        $query .= " order by id $order";
    }
    $sql = mysqli_query($conDB, $query);
    $countRow = mysqli_num_rows($sql);
    $title = array();
    if ($count != '') {
        $title = $countRow;
    }

    if ($countRow > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            if ($arr != '') {
                $imgUrl = getHotelImgDataById($row['img'])['fullUrl'];
                $title[] = array_merge($row, ['fullImgUrl' => $imgUrl]);
            } else {
                $title = $row['title'];
            }
        }
    }

    return $title;
}

function getAmenitieIdByRoomId($rid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_amenities where room_id = '$rid'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $aid[] = $row['amenitie_id'];
    }
    return $aid;
}

function countRoomViewByDate($slug = '', $date = '', $tab = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from roomnumber where hotelId = '$hotelId'";
    $blockedrromsql = "select * from roomnumber where hotelId = '$hotelId' and constuctionStatus =4";
    $bookSql = "select booking.*,bookingdetail.roomId from booking,bookingdetail where booking.id = bookingdetail.bid and booking.hotelId = '$hotelId'";
    if ($slug != '') {
        $rid = getRoomType('', '', $slug)[0]['id'];
        $sql .= " and roomId = '$rid'";
        $bookSql .= " and bookingdetail.roomId = '$rid'";
    }
    if ($date != '') {
        $bookSql .= " and bookingdetail.checkIn <= '$date' and bookingdetail.checkOut > '$date'";
    }
    // echo $blockedrromsql;
    $roomExist = mysqli_num_rows(mysqli_query($conDB, $sql));
    $roomBook = mysqli_num_rows(mysqli_query($conDB, $bookSql));
    $blockroom = mysqli_num_rows(mysqli_query($conDB, $blockedrromsql));


    $data = [
        'exist' => $roomExist - $roomBook,
        'book' => $roomBook,
        'blockroom' =>$blockroom
    ];

    return $data;
}

function loopRoomExist($rid, $date = '', $date2 = '', $rdid = '')
{

    if (roomExist($rid, $date, $date2, $rdid) > 0) {
        $oneDay = strtotime('1 day 30 second', 0);

        $datediff = strtotime($date2) - strtotime($date);
        $output = round($datediff / (60 * 60 * 24));
        $data = 1;
        $countTotalBooking = array();
        for ($i = 1; $i <= $output; $i++) {
            $predate = date('Y-m-d', strtotime($date) + ($oneDay * $i) - $oneDay);
            $countTotalBooking[] = roomExist($rid, $predate, $predate, $rdid);
        }
        if (in_array('0', $countTotalBooking)) {
            $data = 0;
        }
    } else {
        $data = 0;
    }
    return $data;
}

function roomMaxCapacityById($rid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from room where id = '$rid'"));
    return $sql['roomcapacity'];
}

function getNightCountByDay($date1, $date2)
{
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%a');
}

function SingleRoomPriceCalculator($rid='', $rdid='', $adult='', $child='', $nRoom = '', $nNight='', $roomPrice = '', $childPrice = '', $adultPrice = '', $couponCode = '')
{
    global $conDB;

    $singleRoom = $roomPrice;
    $couponPrice = '';
    if ($couponCode != '') {
        $couponPrice = couponActualPrice($couponCode, $roomPrice);
        $roomPrice = $roomPrice - $couponPrice;
    }

    $nightPrice = $roomPrice + $adultPrice + $childPrice;

    $totalRoomPrice = ($nightPrice  * $nNight);

    $gstper = getGSTPercentage($roomPrice);

    $gst = ($totalRoomPrice * $gstper) / 100;
    if ($gstper == 0) {
        $gst = 0;
    }

    $totalPrice = $totalRoomPrice + $gst;
    $nightPriceHtml = $nightPrice;
    if ($nNight > 1) {
        $nightPriceHtml = $nightPrice . ' * ' . $nNight;
    }


    $data = array();

    $data[] = [
        'room' => $singleRoom,
        'adultPrint' => $adult,
        'childPrint' => $child,
        'adult' => $adultPrice,
        'child' => $childPrice,
        'noNight' => $nNight,
        'night' => $nightPrice,
        'nightPrice' => $nightPriceHtml,
        'couponCode' => $couponCode,
        'couponPrice' => $couponPrice,
        'gstPer' => $gstper,
        'gst' => $gst,
        'total' => $totalPrice
    ];

    return $data;
}

function formatingDate($date)
{
    return  date("d-M-Y", strtotime($date));
}

function getRoomHeaderById($rid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select header from room where id = '$rid'"));
    return $sql['header'];
}

function totalSessionPrice()
{
    $price = 0;
    global $obj;
    foreach ($_SESSION['room'] as $key => $val) {
        $rdid = explode('-', $key)[0];

        $total_price = 0;
        $rid = $_SESSION['room'][$key]['roomId'];
        $child = $_SESSION['room'][$key]['child'];
        $adult = $_SESSION['room'][$key]['adult'];
        $checkInTime = $_SESSION['room'][$key]['checkIn'];
        $checkInOut = $_SESSION['room'][$key]['checkout'];
        $noAdult = $_SESSION['room'][$key]['adult'];
        $noRoom = $_SESSION['room'][$key]['room'];
        $night = $_SESSION['room'][$key]['night'];

        $percentage = settingValue()['PartialPaymentPrice'];

        if (roomExist($rid, $checkInTime) == 0) {
            $obj->removeroom($key);
        }

        $roomPrice = getRoomPriceById($rid, $rdid, $adult, $checkInTime);
        $adultPrice = getAdultPriceByNoAdult($adult, $rid, $rdid, $checkInTime);
        $childPrice = getChildPriceByNoChild($child, $rid, $rdid, $checkInTime);


        if (isset($_SESSION['couponCode'])) {
            $couponCode = $_SESSION['couponCode'];
        } else {
            $couponCode = '';
        }

        $nNight = getNightByTwoDates($checkInTime, $checkInOut);
        $singleRoomPriceCalculator = SingleRoomPriceCalculator($rid, $rdid, $adult, $child, $noRoom, $night, $roomPrice, $childPrice, $adultPrice, $couponCode);

        $price += $singleRoomPriceCalculator[0]['total'];
        $gst[$key] = $singleRoomPriceCalculator[0]['gst'];
        $nightPrint[$key] = $singleRoomPriceCalculator[0]['nightPrice'];
        $noNight[$key] = $singleRoomPriceCalculator[0]['noNight'];
        $shortDate[$key] = getDateFormatByTwoDate($_SESSION['room'][$key]['checkIn'], $_SESSION['room'][$key]['checkout']);
        $total[$key] = $singleRoomPriceCalculator[0]['total'];
    }


    $_SESSION['gossCharge'] = $price;
    $_SESSION['roomTotalPrice'] = $price;

    if (isset($_SESSION['pickUp']) && $_SESSION['pickUp'] != '') {
        $pickup = $_SESSION['pickUp'];
        $price += $pickup;
        $_SESSION['roomTotalPrice'] = $price;
    }

    if (isset($_SESSION['partial']) && $_SESSION['partial'] == 'Yes') {
        $percentage = settingValue()['PartialPaymentPrice'];
        $price = $price * $percentage / 100;
        $_SESSION['roomTotalPrice'] = $price;
    }

    $data = [
        'gst' => $gst,
        'night' => $nightPrint,
        'price' => $price,
        'noNight' => $noNight,
        'shortDateUpdate' => $shortDate,
        'total' => $total,
    ];



    return $data;
}

function calculateTotalBookingPrice()
{
    $price = $_SESSION['gossCharge'];
    $result = $price;


    if (isset($_SESSION['pickUp']) && $_SESSION['pickUp'] != '') {
        $pickup = $_SESSION['pickUp'];
        $result += $pickup;
    }

    if (isset($_SESSION['partial']) && $_SESSION['partial'] == 'Yes') {
        $percentage = settingValue()['PartialPaymentPrice'];
        $result = $result * $percentage / 100;
    }

    // $_SESSION['roomTotalPrice'] = $result;

    return $result;
}

function getBookingNumber()
{
    global $conDB;

    $oid = BOOK_GENERATE . unique_id(6);

    return $oid;
}

function checkLive()
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from live where id = '1'"));
    return $sql['status'];
}

function buildSGLView($rid, $rdid)
{
    global $conDB;
    $sql = "select room.*,roomratetype.*, roomratetype.id as roomDetailID from room,roomratetype where room.id = '$rid'  and roomratetype.room_id = room.id and roomratetype.id='$rdid'";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'id' => $row['id'],
                'singlePrice' => $row['singlePrice'],
                'doublePrice' => $row['doublePrice'],
            ];
        }
    }

    return $data;
}


function getDateByDay($date, $nday)
{
    $date = strtotime($date);
    $one_day = strtotime('1 day 00 second', 0);
    return date('Y-m-d', $date + ($nday * $one_day));
}


function hotelPolicyEmail()
{
    $checkInTime = hotelDetail()["checkIn"];
    $checkOutTime = hotelDetail()['checkOut'];
    $html = "
    <h4 style='background: #cce6cc;padding: 5px 10px;'>IMPORTANT INFORMATION</h4>
    <table style='width:100%; '>
    <tr style='vertical-align: top;'>
        <td>                    
            <h5>POLICY</h5>
            <ul style='list-style: circle;'>
                <li>
                    <span>Check In </span><span>$checkInTime</span>
                </li>
                <li>
                    <span>Check Out </span><span>$checkOutTime</span>
                </li>
            </ul>
            
        </td>
    </tr>
    </table>

    <table style='width:100%; '>

        <tr>
            <td>
                        
                <h5>CANCELLATION POLICY</h5>
                <ul>
                    <li>
                        <p>Visit our website <a href=''>Click Here</a>.</p>
                    </li>
                </ul>
                
            </td>
        </tr>

    </table>

    <table style='width:100%; '>
        <tr>
            <td>
                
                <h4>ID proof</h4>
                <ul style='list-style: circle;'>
                    <li>
                        <span>Voter ID, </span> <span>Aadhar card, </span> <span>DL, </span> <span>Pass Port</span> 
                    </li>
                    <li>
                        <span>Pan Card * Not Acceptable</span>
                    </li>
                </ul>
                
            </td>
        </tr>
    </table>
    ";

    return $html;
}

function getBookingIdById($bid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select bookinId from booking where id = '$bid'"));
    return $sql['bookinId'];
}

function getRoomNameById($rid)
{
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select header from room where id = '$rid'"));
    return $sql['header'];
}

function getRatePlanByRoomDetailId($rdid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from roomratetype where id  = '$rdid'");
    $row = mysqli_fetch_assoc($sql);
    return $row['title'];
}

function getOrderDetailByOrderId($oid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from booking where id= '$oid'");
    $row = mysqli_fetch_assoc($sql);
    return $row;
}

function getOrderDetailArrByOrderId($oid)
{
    global $conDB;
    $data = array();
    $sql = "select booking.*, bookingdetail.*, bookingdetail.id as bookindetailId from booking,bookingdetail where booking.id = '$oid' and booking.id = bookingdetail.bid";
    $query = mysqli_query($conDB, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    return $data;
}

function checkInOutFun($status, $rBID, $bdid){
    global $conDB;
    global $time;
    $addBy = dataAddBy();
    if ($status == 'checkin') {
        $sql = "update bookingdetail set checkinstatus = '2' where bid = '$rBID' and id = '$bdid'";
        $ammendsql = "update guestamenddetail  set checkInTime = '$time', addbycheckin = '$addBy' where bid='$rBID' and bdid = '$bdid'";
        mysqli_query($conDB, $sql);
        mysqli_query($conDB, $ammendsql);
    }
    if ($status == 'checkout') {
        $sql = "update bookingdetail set checkinstatus = '3' where bid = '$rBID' and id = '$bdid'";
        $ammendsql = "update guestamenddetail  set checkOutTime = '$time', addbycheckin = '$addBy' where bid='$rBID' and bdid = '$bdid'";
        mysqli_query($conDB, $sql);
        mysqli_query($conDB, $ammendsql);
    }
}

function orderEmail($oid)
{

    $invoiceNo = printBooingId($oid);
    $name = getGuestDetail($oid)[0]['name'];
    $email = getGuestDetail($oid)[0]['email'];
    $phone = getGuestDetail($oid)[0]['phone'];
    $company_name = getGuestDetail($oid)[0]['company_name'];
    $gst = getGuestDetail($oid)[0]['comGst'];
    $bid = $oid;
    $userPay = getBookingDetailById($oid)['userPay'];

    $price = getBookingDetailById($oid)['userPay'];
    $grossCharge = getBookingDetailById($oid)['totalPrice'];
    // $payment_status = getBookingDetailById($oid)['paymentStatus'];
    $payment_status = 'complete';
    // $payment_id = getBookingDetailById($oid)['paymentId'];
    $payment_id = 'gg';
    $add_on = date('d-m-Y g:i A', strtotime(getBookingDetailById($oid)['addOn']));

    $couponCode = getBookingDetailById($oid)['couponCode'];
    $pickUp = getBookingDetailById($oid)['pickUp'];
    $pickupHtml = '';

    $sitename = SITE_NAME;
    $bookingSite = FRONT_BOOKING_SITE;

    $img = FRONT_SITE_IMG . hotelDetail()['darklogo'];


    $priceHtml = '';
    $couponCodeHtml = '';
    $buttomBar = '';

    $partial = '';



    if ($payment_status == 'pending') {
        $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#b51d0e">
                        <p
                            style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            <strong>₹ ' . $price . '</strong>
                            amount has been failed payment on <br/>
                            ' . $add_on . '
                        </p>
                    </div>';

        if ($partial == 'Yes') {
            $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#b51d0e">
                        <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            50%, <strong>₹ ' . $price . '</strong>
                            amount has been Failed Payment on <br/>
                            ' . $add_on . '
                        </p>
                    </div>';
        }
    }

    if ($payment_status == '1') {

        $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#0eb550">
                        <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            <strong>₹ ' . $price . '</strong>
                            amount has been Successful Payment <br/> with Payment ID is <b>' . $payment_id . '</b> on <br/>
                            ' . $add_on . '
                        </p>
                    </div>';



        if ($grossCharge > $price) {
            $userPercentage = getPercentageValueByAmount($userPay, $grossCharge);
            $payAtHotel = number_format($grossCharge - $userPay);
            $buttomBar = '
                                <tr>
                                    <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">' . $userPercentage . '% Paid</td>
                                    <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ ' . $price . '</td>
                                </tr>
                                ';

            $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#0eb550">
                                    <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                                        ' . $userPercentage . '%, <strong>₹ ' . $price . '</strong>
                                        amount has been Successful Payment <br/> with Payment ID is <b>' . $payment_id . '</b> <br/>
                                        on  ' . $add_on . ' and <br/> Pay at Hotel Rs <strong>' . $payAtHotel . '</strong>.
                                    </p>
                                </div>';
        }
    }
    $paymentListHtml = '';
    foreach (getOrderDetailArrByOrderId($oid) as $bidrow) {

        $checkIn = $bidrow['checkIn'];
        $checkOut = $bidrow['checkOut'];
        $roomId = $bidrow['roomId'];
        $room_detail_id = $bidrow['roomDId'];

        $adult = $bidrow['adult'];
        $child = $bidrow['child'];

        $room_name = getRoomNameById($roomId);
        $rate_plane = getRatePlanByRoomDetailId($room_detail_id);

        $checkDate = getDateFormatByTwoDate($checkIn, $checkOut);

        $paymentListHtml .= '<table style="background-color:white;width:100%">
                    <tbody>
                        <tr>
                            <td style="color:#7b8199;text-align:left;padding:0px 0px 10px 10px">
                            <b>' . $room_name . '</b>
                            </td>
                            <td style="text-align:right;padding:0px 10px 10px 0px">
                            <small>' . $checkDate . '</small>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#7b8199;text-align:left;padding:0px 0px 10px 10px">
                                <table>
                                    <tr>
                                        <td><strong>Adult</strong>: ' . $adult . '</td>
                                        <td><strong>Child</strong>: ' . $child . '</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="text-align:right;padding:0px 10px 10px 0px">
                                <strong>' . $rate_plane . '</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="border-top-style:solid;border-top-color:#ebedf2;border-top-width:1px;background-color:white">
                </p>';
    };


    $bookingDetailArry = getBookingDetailById($oid);
    $total_price = $bookingDetailArry['totalPrice'];
    $gst_price = $bookingDetailArry['gstPrice'];;
    $couponBalance = 0;
    $paymentBackupHtml = '';
    foreach ($bookingDetailArry['roomDetailArry'] as $bidrow) {
        $roomName = $bidrow['roomName'];
        $roomPrice = $bidrow['room'];
        $couponPrice = $bidrow['couponPrice'];
        $adult = $bidrow['adult'];
        $child = $bidrow['child'];
        $adultPrice = $bidrow['adultPrice'];
        $childPrice = $bidrow['childPrice'];
        $gstPer = $bidrow['gstPer'];
        $gstPrice = $bidrow['gstPrice'];
        $couponPriceHtml = '';
        if ($couponPrice != 0) {
            $couponPriceHtml = "<br/><span style='font-size: 10px;font-weight: 700;'>- $couponPrice</span>";
        }

        $paymentBackupHtml .= '<tr>
                    <td style="text-align:start;padding:10px 10px 20px 0px;">
                        <span style="color:#000;font-weight:lighter"> ' . $roomName . ' </span>
                    </td>
                    <td style="text-align:center;padding:10px 10px 10px 0px">
                        ' . $roomPrice . $couponPriceHtml . ' 
                    </td>
                    <td style="text-align:center;padding:10px 10px 10px 0px">
                        ' . $adult . '
                    </td>
                    <td style="text-align:center;padding:10px 10px 10px 0px">
                        ' . $child . '
                    </td>
                    <td style="text-align:center;padding:10px 10px 10px 0px">
                        ₹ ' . $gstPrice . '
                    </td>
                </tr>';
    }

    if ($pickUp > 0) {
        $pickupHtml = '

                        <tr>
                            <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">PickUp</td>
                            <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ ' . $pickUp . '</td>
                        </tr>
                        
                        ';
    }


    if ($couponCode != '') {

        $couponCodeHtml = '
                        <tr>
                            <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">Coupon Code(' . $couponCode . ')</td>
                            <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ ' . $couponBalance . '</td>
                        </tr>
                        ';
    }

    $html = '
        
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>' . $sitename . ' || Payment Invoice</title>
                </head>
                <body>
                    <blockquote style="font-family:Trebuchet MS">
                        <div style="background-image:linear-gradient(to bottom,#e54b76 0%,#cc1e4f 200px,#f8f9f9 200px,#f8f9f9 90%);height:100%">

                            <div style="text-align:center;margin-bottom:30px; max-width:588px;margin:auto;">
                                <table style="width:100%; max-width:600px; min-height:90px">
                                    <tr>
                                    <td align="left"><img width="80px" src="' . $img . '"></td>
                                    <td align="right"><strong style="color:#000">Invoice #' . $invoiceNo . '</strong></td>
                                    </tr>
                                </table>
                            </div>
                            ​
                            <div style="max-width:588px;margin:auto">

                                <div style="max-width:588px;margin:auto">
                                    <div
                                    style="background-color:#ffffff;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto">
                                    <table style="width:100%; max-width:600px;">
                                        <tr>
                                        <td align="left" style="width:10%">
                                            <div> Hello <b>' . $name . '</b>,</div>
                                            <div> ' . $email . '</div>
                                            <div> ' . $company_name . '</div>
                                            <div> ' . $gst . '</div>
                                        </td>

                                        <td align="right" style="width:70%">
                                            <div><b>' . hotelDetail()['hotelName'] . '</b></div>
                                            <div>' . hotelDetail()['pincode'] . '</div>
                                            <div>' . ucfirst(hotelDetail()['district']) . '</div>
                                            <div>' . ucfirst(hotelDetail()['address']) . '</div>
                                            <div>GST:- ' . hotelDetail()['gst'] . '</div>
                                        </td>
                                        </tr>
                                    </table>
                                    </div>
                                    ' . $priceHtml . '
                                </div>
                                <div style="max-width:588px;margin:auto">
                                    <div style="background-color:#ffffff;padding:20px 20px 2px 20px;max-width:550px;margin-left:auto;margin-right:auto;border-top: 1px solid #000;font-size:15px">
                                        <table style="background-color:white;width:100%;margin-bottom: 10px;">
                                            <tr>
                                                <td style="text-align:left;font-size:17px;padding:15px 0px;border-bottom:1px solid #ebedf2;margin-bottom:10px">Booking details</td>
                                                <td style="text-align:right;font-size:17px;padding:15px 0px;border-bottom:1px solid #ebedf2;margin-bottom:10px;color:#528ff0;">Booking guide</td>
                                            </tr>
                                        </table>
                                        ' . $paymentListHtml . '
                                    </div>
                                </div>


                                <div style="max-width:588px;margin:auto">
                                    <div
                                    style="background-color:#ffffff;padding:20px 20px 2px 20px;max-width:550px;margin-left:auto;margin-right:auto;margin-top:5px;font-size:15px">
                                    <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;color:#000;text-align:center;margin-top:0px; border-bottom-style:solid;border-bottom-color:#ebedf2;border-bottom-width:2px;padding-bottom:18px"> Breakup for Payout </p>
                                    <table style="background-color:white;width:100%;border-spacing:0px">
                                        <thead style="color:#7b8199">
                                        <tr>
                                            <th style="padding:0px 0px 10px 0px;text-align:start;border-bottom:1px solid #ebedf2"> Room Name </th>
                                            <th style="padding:0px 0px 10px 0px;text-align:center;border-bottom:1px solid #ebedf2"> Amount </th>
                                            <th style="padding:0px 0px 10px 0px;text-align:center;border-bottom:1px solid #ebedf2"> Adult </th>
                                            <th style="padding:0px 10px 10px 0px;text-align:center;border-bottom:1px solid #ebedf2"> Child </th>
                                            <th style="padding:0px 10px 10px 0px;text-align:center;border-bottom:1px solid #ebedf2"> GST </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            ' . $paymentBackupHtml . '
                                        </tbody>
                                    </table>

                                    <table style="width:100%;border-spacing: 0px">
                                        ' . $pickupHtml . '
                                        <tr>
                                            <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199;padding: 10px 10px 10px 0px;">GST</td>
                                            <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199;padding: 10px 10px 10px 0px;">₹ ' . $gst_price . '</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;text-align:left;padding-left:8px;color:#000;padding: 10px 10px 10px 0px;">Total Payout amount</td>
                                            <td style="width:50%;text-align:right;padding-left:8px;color:#000;padding: 10px 10px 10px 0px;font-weight: 700;">₹ ' . $total_price . '</td>
                                        </tr>
                                        ' . $buttomBar . '
                                    </table>
                                    

                                    </div>
                                </div>
                                ​

                                <div style="max-width:588px;margin:auto">
                                    <div style="text-align:center;margin-bottom:16px;margin-top:8px;max-width:588px;margin:auto">
                                    <a href="' . $bookingSite . '" style="color:white;text-decoration:unset" target="_blank">
                                        <div style="padding:15px 0px 15px 0px;background:#ec407a;border-radius:3px;margin:10px 0px;color:white">
                                        View Rooms
                                        </div>
                                    </a>
                                    </div>

                                    <p style="font-size:14px;text-align:center;color:#7b8199">
                                    If you have any issue with the service from ' . $sitename . ' Software Private Ltd, please raise
                                    your request
                                    <a href=" " target="_blank">here</a>
                                    </p>
                                </div>

                                ' . hotelPolicyEmail() . '
                            </div>
                        </div>
                     
                    </blockquote>
                    
                </body>
                </html>
  
    
    ';

    return $html;
}

function getBookingDetailByBId($bid, $night = '')
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from bookingdetail where bid = '$bid'");
    $bookingsql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from booking where id = '$bid'"));
    $coupon = $bookingsql['couponCode'];
    if ($coupon == '') {
        $coupon = '';
    }
    $data = array();
    $sellPrice = 0;
    $couponDis = 0;
    $actualPrice = 0;
    $GstPrice = 0;
    $roomPrice = 1200;
    $childPrice = 0;
    $adultPrice = 0;
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {

            $detail = SingleRoomPriceCalculator($row['roomId'], $row['roomDId'], $row['adult'], $row['child'], '', $night, $roomPrice, $childPrice, $adultPrice, $coupon);
            $sellPrice += ($detail[0]['room'] + $detail[0]['adult'] + $detail[0]['child']) * $detail[0]['noNight'];
            $couponValue = $detail[0]['couponPrice'];
            if ($detail[0]['couponPrice'] == '') {
                $couponValue = 0;
            }
            $couponDis += $couponValue * $detail[0]['noNight'];
            $GstPrice += $detail[0]['gst'];
        }
        $data[] = [
            'sellPrice' => $sellPrice,
            'couponDis' => $couponDis,
            'actualPrice' => $sellPrice - $couponDis,
            'GstPrice' => $GstPrice,
        ];
    }
    return $data;
}

function getBookingDetailArrByBId($bid, $date, $night, $coupon = '')
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from bookingdetail where bid = '$bid'");
    $bookingsql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from booking where id = '$bid'"));
    $data = array();
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {

            $detail = getSingleRoomPrice($row['roomId'], $row['roomDId'], $row['adult'], $row['child'], $date, $night, $coupon);
            // pr($detail);
            $data[] = [
                'id' => $row['id'],
                'room' => getRoomHeaderById($row['roomId']),
                'ratePlan' => getRatePlanByRoomDetailId($row['roomDId']),
                'noAdult' => $row['adult'],
                'noChild' => $row['child'],
                'adultPrice' => 0,
                'childPrice' => 0,
                'checkIn' => '2022-10-08',
                'checkout' => '2022-10-10',
                'gstPer' => $detail['gstPer'],
                'gst' => $detail['gst'],
                'roomPrice' => 1200,
                'totalPrice' => $detail['total'],
            ];
        }
    }
    return $data;
}

function getBookingVoucher($oid)
{

    $invoiceNo = printBooingId($oid);
    $bookingDetailArray = getBookingDetailById($oid);
    $guestId = $bookingDetailArray['guest'][0];
    $guestDetailArry = getGuestDetail('', '', $guestId)[0];
    $roomDetailArry = $bookingDetailArray['roomDetailArry'];

    $name = $bookingDetailArray['name'];
    $email = $guestDetailArry['email'];
    $phone = $guestDetailArry['phone'];
    $company_name = $guestDetailArry['company_name'];
    $gst = $guestDetailArry['comGst'];
    $payment_status = $bookingDetailArray['paymentStatus'];
    $add_on = date('d-m-Y g:i A', strtotime($bookingDetailArray['addOn']));
    $oderId = getOrderDetailByOrderId($oid)['bookinId'];

    $grossCharge = $bookingDetailArray['totalPrice'];
    $userPay = $bookingDetailArray['userPay'];

    $checkInTime = hotelDetail()['checkIn'];
    $checkOutTime = hotelDetail()['checkOut'];

    $addOn = $add_on;

    $couponCode = $bookingDetailArray['couponCode'];
    $pickUp = $bookingDetailArray['pickUp'];
    $checkIn = $bookingDetailArray['checkIn'];
    $checkOut = $bookingDetailArray['checkOut'];
    $couponCode = $bookingDetailArray['couponCode'];
    $night = getNightByTwoDates($checkIn, $checkOut);

    $COMM_PRICE = getBookingData($oid)[0]['commission'];

    $pickupHtml = '';

    $logo = FRONT_SITE_IMG . 'logo/' . LOGO('', 'yes');


    $couponCodeHtml = '';
    $couponPrice = 0;




    if ($pickUp > 0) {
        $pickupHtml = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                    <h4>Pickup Charges</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($pickUp, 2) . '</td>
            </tr>
        ';
    } else {
        $pickupHtml = '';
    }

    $guestBook = '';
    $roomBackupData = '';
    $roomBackUpRoomName = '';
    $totalRoomBrackupPrice = 0;
    $totalAdultRoomBrackupPrice = 0;
    $totslGstPrice = 0;

    foreach ($roomDetailArry as $bookingList) {
        // pr($bookingList);
        // $bookindDetailId = $bookingList['id'];
        $gstPer = $bookingList['gstPer'];
        $gstPrice = $bookingList['gstPrice'];
        $roomPrice = $bookingList['room'];
        $checkInStatus = $bookingList['checkinstatus'];
        $rateplan = $bookingList['rateplan'];
        $room_number = $bookingList['room_number'];


        $guestBook .= '
                <tr>
                    <td style="padding: 5px 10px;">Rate Plan <br/> Room Price <br/>
                        <small>Adult ' . $bookingList['adult'] . '</small> <br/>
                        <strong>Room Number</strong> <br/>
                        <strong>Night</strong>
                    </td>
                    <td style="padding: 5px 10px;" ><strong>' . $rateplan . '</strong><br/><strong>₹ ' . $roomPrice . '</strong><br/>
                            <small>Child ' . $bookingList['child'] . '</small> <br/>
                            <strong> ' . $room_number . '</strong> <br/>
                            <strong> ' . $night . '</strong> 
                        </td>
                </tr>
        ';

        $roomBackupData .= '<tr> <td colspan="4" style="padding:10px">' . $bookingList['roomName'] . '</td> </tr> ';

        for ($i = 0; $i < $night; $i++) {
            $chilAdult = $bookingList['adultPrice'] + $bookingList['childPrice'];
            $totalRoomBrackupPrice += $roomPrice;
            $totalAdultRoomBrackupPrice += $chilAdult;
            $totslGstPrice += $gstPrice;
            // pr($checkIn);
            $roomBackupData .= '<tr>
                                    <td style="padding:10px">' . date('d-M-Y', strtotime(getDateByDay($checkIn, $i))) . '</td>
                                    <td style="padding:10px; text-align:center">₹ ' . $roomPrice . '</td>
                                    <td style="padding:10px;text-align:right">₹ ' . $chilAdult . '</td>
                                    <td style="padding:10px;text-align:right">₹ ' . $gstPrice . ' @ ' . $gstPer . ' %</td>
                                </tr>';
        }
    }

    $calculateHotelVoucher = getBookingDetailByBId($oid, $night);


    if ($couponCode != '' && $couponCode != 0) {
        $couponCodeHtml = '<tr>
                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                    <h4>Coupon Discount</h4>
                                    <p><small>( ' . $couponCode . ' )</small></p>
                                </td>
                                <td style="padding: 5px 10px;border-bottom: 1px solid #00000033;text-align: right;">₹ ' . number_format($calculateHotelVoucher[0]['couponDis'], 2) . '</td>
                            </tr>
                            
                            <tr>
                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                    <h4>Actual Sell Rates</h4>
                                </td>
                                <td style="padding: 5px 10px;border-bottom: 1px solid #00000033;text-align: right;">₹ ' . number_format($calculateHotelVoucher[0]['actualPrice'], 2) . '</td>
                            </tr>
                            
                            ';
    }


    if ($checkInStatus == 4) {

        $actualPrice = $userPay * 100 / 112;
    } else {

        $actualPrice = $calculateHotelVoucher[0]['actualPrice'];
    }

    $gstActualPrice = $calculateHotelVoucher[0]['GstPrice'];

    $retroCommPrice = $actualPrice * $COMM_PRICE / 100;
    $commTax = $retroCommPrice * 18 / 100;

    $tcsPrice = $actualPrice * 1 / 100;
    $tdsPrice = $actualPrice * 1 / 100;

    $totalCommission = $retroCommPrice + $commTax + $tcsPrice + $tdsPrice;


    $bookingCancleHtml = '';

    if ($checkInStatus == 4) {

        $natAmount = $userPay - $totalCommission;

        $bookingCancleHtml = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                    <h4>Booking Status</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;background: darkred;text-align: center;color: white;font-weight: 700;">No Show</td>
            </tr>
        ';
    } else {

        $natAmount = $grossCharge - $totalCommission;
    }


    $hotelPayable = $userPay - $totalCommission;
    $partialStatus = '';

    $paymentStatusPrint = '
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                <h4>Hotel Net payment</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ ' . number_format($hotelPayable, 2) . '</td>
        </tr>
    ';

    if ($grossCharge > $userPay) {
        $userPayPercentage = round(($userPay / $grossCharge) * 100);
        $userHotelPay = $grossCharge - $userPay;
        $userPayAtHotelHtml = '<tr>
                                    <td style="padding: 5px 10px;"><strong style="color:#3f51b5">Pay at hotel</strong></td>
                                    <td style="padding: 5px 10px;"><strong style="color:black">₹ ' . $userHotelPay . '</strong></td>
                                </tr>';
        if ($userHotelPay == 0) {
            $userPayAtHotelHtml = '';
        }
        if ($checkInStatus == 4) {
            $userPayAtHotelHtml = '
                <tr>
                    <td style="padding: 5px 10px;"><strong style="color:#3f51b5">Pay at hotel</strong></td>
                    <td style="padding: 5px 10px;"><strong style="color:black">₹ 0</strong></td>
                </tr>
            ';
        }
        $partialStatus = '
            <tr>
                <td style="padding: 5px 10px;"><strong style="color:red">Advance Pay(' . $userPayPercentage . '%)</strong></td>
                <td style="padding: 5px 10px;"><strong style="color:green">₹ ' . $userPay . '</strong></td>
            </tr>

            ' . $userPayAtHotelHtml . '
        ';

        $paymentStatusPrint = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Online payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darksalmon;color: black;font-weight: 700;">
                <span> <small>Guest Payment</small> :- <small> ₹ ' . number_format($userPay) . '</small> </span> <br/>
                    <span> <small>Total Com</small> :- <small>₹ ' . number_format($totalCommission) . '</small> </span> <br/>
                ₹ ' . number_format($hotelPayable, 2) . '</td>
            </tr>
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ ' . number_format($natAmount, 2) . '</td>
            </tr>
        ';
    }


    if ($payment_status == 'pending') {

        $html = '
            <table>
                <tr>
                    <th>Payment Failed!</th>
                </tr>
            </table>
        ';
    } else {




        $html = '
    
    
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Web Booking Voucher</title>
                </head>
                <body>
            
                    <table width="100%" style="border-top: 1px solid #00000033;border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        <tr>
                            <td>
                                <h2>Web Booking Voucher</h2> <br/>
                                <p><small>Booking ID</small> <strong> ' . $oderId . '</strong></p>
                                <p>Booking Date: ' . $addOn . '</p>
                            </td>
                            <td style="text-align:right">
                                <img src="' . $logo . '" alt="Logo" style="width: 80px;">
                                <table style="width: 100%;padding: 10px 15px;">
                                    <tr>
                                        <td>
                                            <p><strong>GST No.-</strong> ' . RETROD_GST . '</p>
                                            <p><strong>PAN No.-</strong> ' . RETROD_PAN . '</p>
                                            <p><strong>TAN No. -</strong> ' . RETROD_TAN . '</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td >
                                <p><strong>Dear Valuable Partner,</strong></p> <br/>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td style="padding: 0 20px;">
                                <p>Congratulations, You have got a booking from your Website Please find the details below . Guest Name <strong>' . $name . '</strong></p>
                                <p>The amount payable to hotel for this booking is INR <strong style="color: green;font-size: 21px;"> ' . number_format($natAmount, 2) . '</strong> as per the details below.</p>
                            </td>
                        </tr>
                    </table>
            
                    <table width="100%" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        
                        
            
                        <tr>
                            <td>
                            
                                <table style="padding: 10px 20px; width: 100%; border-collapse: collapse; ">
                                    <tr>
                                        <th style="padding: 10px;border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-left: 2px solid #96D4D4;">BOOKING DETAILS</th>
                                        <th style="padding: 10px;width: 80%; border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-right: 2px solid #96D4D4;border-left: 2px solid #96D4D4;">PAYMENT BREAKUP</th>
                                    </tr>
                                    <tr>
                                    
                                        <td width="40%" style="padding: 20px 20px; vertical-align: top; width: 40%; border-left: 2px solid #96D4D4; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
            
                                            <table border="1" style="border-collapse: collapse; text-align:center; border-color: #96D4D4; width: 100%">
                                                <tr>
                                                    <td style="padding: 5px 10px;"><strong>Guest Name</strong></td>
                                                    <td style="padding: 5px 10px;">' . $name . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 10px;"><strong>Phone No</strong></td>
                                                    <td style="padding: 5px 10px;">' . $phone . '</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="" style="padding: 5px 10px;"><span>' . $checkIn . '</span> </th>
                                                    <th colspan="" style="padding: 5px 10px;"><span>' . $checkOut . '</span></th>
                                                </tr>
                                                ' . $guestBook . '
                                                ' . $partialStatus . '
                                            </table>
                                        </td>
                                        
                                        <td width="60%" style="padding: 10px; width: 60%; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
                                            <table style="width: 100%;">
                                                <tr style="vertical-align: top;">
                                                   
                                                    <td >
                                                        <table style="border-collapse: collapse;padding: 10px 20px;">
                        
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Hotel Sell Price</h4>
                                                                    <p><small>(  Room x  Nights )</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;text-align: right;">₹ ' . number_format($calculateHotelVoucher[0]['sellPrice'], 2) . '</td>
                                                            </tr>
                                                            
                                                            ' . $couponCodeHtml . '
                                    
                                                            ' . $pickupHtml . '
                                    
                                    
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>GST @ </h4>
                                                                    <p><small>(Including IGST or (SGST & CGST))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($gstActualPrice, 2) . '</td>
                                                            </tr>
                                    
                                                            
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Gross Charges</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($grossCharge, 2) . '</td>
                                                            </tr>
                                                            
                                                            ' . $bookingCancleHtml . '
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; ">
                                                                    <h4><strong>Retrod</strong> <small>- Comm ( ' . $COMM_PRICE . '% )</small></h4>
                                                                    <p><small>(Including Tax (18%))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; text-align: right;">
                                                                    ₹ ' . number_format($retroCommPrice, 2) . ' + <br/> ₹ ' . number_format($commTax, 2) . '
                                                                    
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 0 0 10px 0; border-bottom: 1px solid #00000033;" colspan="2">
                                                                    
                                                                    <table style="width:100%; border-collapse: collapse; border-color: gainsboro;">
                                                                    
                                                                        <tr>
                                                                            <td style="padding:5px 10px;border: 1px solid black;">TAC including Tax</td>
                                                                            <td style="padding: 5px 10px; text-align: right;border: 1px solid black;">₹ ' . number_format($retroCommPrice + $commTax, 2) . '</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px;border: 1px solid black;">TCS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; text-align: right;border: 1px solid black;">₹ ' . number_format($tcsPrice, 2) . '</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px;border: 1px solid black;">TDS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;border: 1px solid black;">₹ ' . number_format($tdsPrice, 2) . '</td>
                                                                        </tr>
                                                                    
                                                                    
                                                                    </table>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                            
                                                            
                                                            ' . $paymentStatusPrint . '
                                                            
                                                            
                                    
                                                        </table>
                                                        
                                                    </td>
                                                    
                                                </tr>
                                            </table>
            
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    
                    <br/>
                    
                    <h4>Room wise Break up</h4>
                    
                    <table border="1" style="width:100%;border-collapse: collapse;">
                        <tr>
                            <th style="padding:10px;text-align:left">Payment Breakup</th>
                            <th style="padding:10px;text-align:center">Room Charges</th>
                            <th style="padding:10px;text-align:right">Extra Guest/Child</th>
                            <th style="padding:10px;text-align:right">GST</th>
                        </tr>
                        ' . $roomBackupData . '
                        ';





        $html .= '
                            <tr>
                                <td style="padding:10px"><strong>Total</strong></td>
                                <td style="padding:10px;text-align:center"><strong>₹ ' . $totalRoomBrackupPrice . '</strong></td>
                                <td style="padding:10px;text-align:right"><strong>₹ ' . $totalAdultRoomBrackupPrice . '</strong></td>
                                <td style="padding:10px;text-align:right"><strong>₹ ' . $totslGstPrice . '</strong></td>
                            </tr>
                        
                    
                    </table>
            
                    
                    
                </body>
            </html>
    
    
    ';
    }




    return $html;
}

function getPercentageValueByAmount($actualAmout, $totalAmount)
{
    $data = 0;
    if ($actualAmout != 0 && $totalAmount != 0) {
        $data = ($actualAmout / $totalAmount) * 100;
    }

    return round($data);
}

function quickPayEmail($qpid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from quickpay where id = '$qpid'");
    $row = mysqli_fetch_assoc($sql);

    $name = $row['name'];
    $qporderId = $row['orderId'];
    $phone = $row['phone'];
    $email = $row['email'];
    $room = $row['room'];
    $room_id = $row['room_id'];
    $qickPayNote = $row['qickPayNote'];
    $amount = 0;
    $paymentStatus = $row['paymentStatus'];
    $add_on = $row['addOn'];
    $gross = $row['totalAmount'];

    $img = FRONT_SITE_IMG . hotelDetail()['logo'];

    $totalPrice = $row['amount'];

    $payble = $row['amount'];

    $userPayPercentage = '';
    $amountPrint = '<strong style="font-size: 14px;"> Total Price : </strong>' . $totalPrice . ' Rs ';

    if ($gross >= $payble) {
        $totalPrice = $gross;
        $userPayPercentage = ' (' . getPercentageValueByAmount($payble, $gross) . ' %)';
        $payAtHotelHtml = '';
        $payAtHotel = $gross - $payble;
        if ($payAtHotel > 0) {
            $payAtHotelHtml = '<strong style="font-size: 14px;"> Pay at hotel : </strong>' . $payAtHotel . ' Rs ';
        }
        $amountPrint = ' 
                    <strong style="font-size: 14px;"> Total Price : </strong>' . $totalPrice . ' Rs  <br/> 
                    <strong style="font-size: 14px;"> Pay' . $userPayPercentage . ' : </strong>' . $payble . ' Rs <br/>
                    ' . $payAtHotelHtml . '';
    }



    $checkIn = $row['checkIn'];
    $checkOut = $row['checkOut'];
    $noOfNight = getNightByTwoDates($checkIn, $checkOut);

    $buttomBar = '';
    $gstSection = '';



    $content = '
        
            <tr>
                <td align="left"><strong>01</strong></td>
                <td align="left"><strong>Room</strong></td>
                <td align="right"><strong>' . getRoomNameById($room) . '</strong></td>
            </tr>
            
            
            <tr>
                <td align="left"><strong>02</strong></td>
                <td align="left"><strong>Name</strong></td>
                <td align="right"><strong>' . $name . '</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>03</strong></td>
                <td align="left"><strong>Phone</strong></td>
                <td align="right"><strong>' . $phone . '</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>04</strong></td>
                <td align="left"><strong>Email</strong></td>
                <td align="right"><strong>' . $email . '</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>05</strong></td>
                <td align="left"><strong>Check In</strong></td>
                <td align="right"><strong>' . $checkIn . '</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>06</strong></td>
                <td align="left"><strong>Check Out</strong></td>
                <td align="right"><strong>' . $checkOut . '</strong></td>
            </tr>
            
            <tr>
                <td align="left"><strong>07</strong></td>
                <td align="left"><strong>Night</strong></td>
                <td align="right"><strong>' . $noOfNight . '</strong></td>
            </tr>

            <tr>
                <td align="left"><strong>08</strong></td>
                <td align="left"><strong>Request</strong></td>
                <td align="right" style="width: 50%;"><p>' . $qickPayNote . '</p></td>
            </tr>
        
        ';



    if ($paymentStatus == '1') {
        $priceStatus = 'Successful Payment';
        $priceHtml = '<tr>
                            <td style="width: 100%;color: #0f5132;background-color: #d1e7dd;border-color: #0f5132;text-align: center;padding: 20px 10px;border-radius: 3px;border: 2px dashed;">
                                <div>
                                    <strong>' . $priceStatus . ' </strong> <br/>
                                    ' . $amountPrint . '
                                </div>
                            </td>
                        </tr>';
    } else {
        $priceStatus = 'Failed Payment';
        $priceHtml = '<tr><td style="width: 100%;text-align: center;padding: 20px 10px;border-radius: 3px;border: 2px dashed;color: #842029;background-color: #f8d7da;border-color: #d1898f; "><div><strong>' . $priceStatus . ' </strong> <br/> <strong style="font-size: 14px;"> <strong>Total Price : ' . $payble . ' Rs </div></td></tr>';
    }








    $html = '
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Order Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Order confirmation </title>
        <meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

            div,
            p,
            a,
            li,
            td {
                -webkit-text-size-adjust: none;
                word-break: break-all;
            }

            body {
                margin: 0;
                padding: 0;
                background: #e1e1e1;
            }

            body {
                width: 100%;
                height: 100%;
                background-color: #e1e1e1;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                max-width: 600px;
                margin: 0 auto;
                font-family: "Open Sans", sans-serif;
            }

            html {
                width: 100%;
            }

            #invoice {
                background: white;
                background: white;
                border-radius: 25px 25px 0 0;
                padding: 2em;
            }

            .dish_list td {
                padding: 1em;
                border-bottom: 1px solid rgba(0, 0, 0, .1);
            }

            .dish_list td strong {
                color: rgba(0, 0, 0, .7);
            }
        </style>

    </head>

    <body>
        <div style="background-color: #e1e1e1; -webkit-font-smoothing: antialiased;padding: 1em; max-width:600px;">
            <div id="invoice">
                <table style="width:100%; max-width:600px;">
                    <tr>
                        <td align="left"><img width="80px" src="' . $img . '"></td>
                        <td align="right"><strong>Invoice #' . $qporderId . '</strong></td>
                    </tr>
                </table>
                <hr>

                <table style="width:100%; margin-bottom: 35px; max-width:600px;">
                    <tr>
                        <td align="left">
                            <div> Hello <b>' . $name . '</b>,</div>
                            <div> ' . $email . '</div>
                        </td>

                        <td align="right" style="width:50%;">
                            <div><b>' . hotelDetail()['hotelName'] . '</b></div>
                            <div>' . hotelDetail()['pincode'] . '</div>
                            <div>' . ucfirst(hotelDetail()['district']) . '</div>
                            <div>' . ucfirst(hotelDetail()['address']) . '</div>
                            <div>GST:- ' . hotelDetail()['gst'] . '</div>
                        </td>
                    </tr>
                </table>

                <table style="width:100%; margin-bottom: 35px; max-width:600px;">
                    <tr>
                        <td align="left">
                            <div style="margin-bottom:10px;"><small>Invoice Date: ' . $add_on . '</small></div>
                        </td>
                    </tr>
                    ' . $priceHtml . '
                </table>

                <table class="dish_list"
                    style="width:100%; margin-bottom: 25px;transform: translateX(0); border-collapse: collapse; max-width:600px;">
                    
                   ' . $content . '
                   
                </table>
                
                <table style="width:70%; margin-bottom: 25px;margin-left: 30%;">
                   
                    
                    <tr align="right">
                        <td><strong>Total:</strong></td>
                        <td><strong>' . $totalPrice . ' Rs</strong></td>
                    </tr>
                    
                </table>
                
                ' . hotelPolicyEmail() . '
                
            </div>
        </div>

    </body>

    </html>
  
    
    ';
    return $html;
}

function getQPVoucher($qpid)
{

    global $conDB;
    $sql = mysqli_query($conDB, "select * from quickpay where id = '$qpid'");
    $row = mysqli_fetch_assoc($sql);

    $qporderId = $row['orderId'];
    $name = $row['name'];
    $phone = $row['phone'];
    $emailId = $row['email'];
    $room = $row['room'];
    $room_id = $row['room_id'];
    $amount = 0;
    $paymentStatus = $row['paymentStatus'];
    $add_on = $row['addOn'];
    $gross = $row['totalAmount'];

    $checkIn = date('d-M-y', strtotime($row['checkIn']));
    $checkOut = date('d-M-y', strtotime($row['checkOut']));

    $img = FRONT_SITE_IMG . hotelDetail()['logo'];

    $totalPrice = $row['amount'];

    $payble = $row['amount'];
    $userPayPercentage = '';
    $groosHtml = '';
    $payAtHotel = 0;

    $COMM_PRICE = hotelDetail()['commission'];

    $noOfNight = getNightByTwoDates($checkIn, $checkOut);



    $priceSection = '
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                <h4>Room Price</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;text-align: right;">₹ ' . number_format($amount, 2) . '</td>
        </tr>
    ';


    $totalRoomPrice = $gross * 100 / 112;


    $retroCommPrice = $totalRoomPrice * $COMM_PRICE / 100;
    $commTax = $retroCommPrice * 18 / 100;

    $tcsPrice = $totalRoomPrice * 1 / 100;
    $tdsPrice = $totalRoomPrice * 1 / 100;
    $retrodTotalCom = $retroCommPrice + $commTax + $tcsPrice + $tdsPrice;

    $natAmount = $payble - $retrodTotalCom;
    $userPayment = '
            <tr>
                <th style="padding: 5px 10px;">Total Price</th>
                <th style="padding: 5px 10px;">₹ ' . $payble . '</th>
            </tr>
        ';

    if ($gross >= $payble) {
        $totalPrice = $gross;
        $userPayPercentage = ' (' . round(($payble / $gross) * 100) . ' %)';
        $payAtHotel = $gross - $payble;
        if ($payAtHotel > 0) {
            $groosHtml = '
                <tr>
                    <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                        <h4>Gross Amount</h4>
                    </td>
                    <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($totalPrice, 2) . '</td>
                </tr>
        ';
            $displayPayment = '
        
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ ' . number_format($natAmount, 2) . '</td>
            </tr>
        
        ';
            $userPayment = '
            <tr>
                <th style="padding: 5px 10px;">Total Price</th>
                <th style="padding: 5px 10px;">₹ ' . $totalPrice . '</th>
            </tr>
            <tr>
                <th style="padding: 5px 10px;">Pay ' . $userPayPercentage . '</th>
                <th style="padding: 5px 10px;">₹ ' . $payble . '</th>
            </tr>
            <tr>
                <th style="padding: 5px 10px;">Pay At Hotel</th>
                <th style="padding: 5px 10px;">₹ ' . $payAtHotel . '</th>
            </tr>
        ';
        }
    }


    $displayPayment = '
        
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                <h4>Hotel Net payment</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">
                ₹ ' . number_format($natAmount, 2) . '
            </td>
        </tr>
    
    ';



    if ($gross >= $payble) {
        if ($payAtHotel > 0) {
            $hotelPayble = $natAmount + $payAtHotel;

            $displayPayment = '
        
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Online Payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darksalmon;color: black;font-weight: 700;">
                    <span> <small>Guest Payment</small> <small>' . $payble . '</small> </span>
                    <span> <small>Total Com</small> <small>' . $retrodTotalCom . '</small> </span>
                
                    ₹ ' . number_format($natAmount, 2) . '
                </td>
            </tr>
            
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net Payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ ' . number_format($hotelPayble, 2) . '</td>
            </tr>
        
        ';

            $natAmount = $hotelPayble;
        }
    }


    $content = '
            
        <tr>
            <td style="padding: 5px 10px;">Name</td>
            <td style="padding: 5px 10px;">' . $name . '</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;">Phone</td>
            <td style="padding: 5px 10px;">' . $phone . '</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;">Room</td>
            <td style="padding: 5px 10px;">' . getRoomHeaderById($room) . '</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;" >Check In <br/> <strong>' . $checkIn . '</strong></td>
            <td style="padding: 5px 10px;" >Check Out <br/> <strong>' . $checkOut . '</strong></td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;" >Night</td>
            <td style="padding: 5px 10px;" >' . $noOfNight . '</td>
        </tr>
        
        ' . $userPayment . '

    ';

    if ($paymentStatus == 'pending') {

        $html = '
            <table>
                <tr>
                    <th>Payment Failed!</th>
                </tr>
            </table>
        ';
    } else {








        $html = '
    
    
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Web Quick Pay Voucher</title>
                </head>
                <body>
            
                    <table width="100%" style="border-top: 1px solid #00000033;border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        <tr>
                            <td>
                                <h2>Web Quick Pay Voucher</h2> <br/>
                                <p><small>Booking ID</small> <strong> ' . $qporderId . '</strong></p>
                                <p>Booking Date: ' . $add_on . '</p>
                            </td>
                            <td style="text-align:right">
                                <img src="https://retrox.in/logo.png" alt="Logo" style="width: 80px;">
                                <table style="width: 100%;padding: 10px 15px;">
                                    <tr>
                                        <td>
                                            <p><strong>GST No.-</strong> ' . RETROD_GST . '</p>
                                            <p><strong>PAN No.-</strong> ' . RETROD_PAN . '</p>
                                            <p><strong>TAN No. -</strong> ' . RETROD_TAN . '</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td >
                                <p><strong>Dear Valuable Partner,</strong></p> <br/>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td style="padding: 0 20px;">
                                <p>Congratulations, You have got a Quick Pay from your Website Please find the details below . Guest Name <strong>' . $name . '</strong></p>
                                <p>The amount payable to hotel for this Quick Pay is INR <strong style="color: green;font-size: 21px;"> ' . number_format($natAmount, 2) . '</strong> as per the details below.</p>
                            </td>
                        </tr>
                    </table>
            
                    <table width="100%" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;border-bottom: 1px solid #00000033;padding: 10px 20px;">
                        
                        
            
                        <tr>
                            <td>
                            
                                <table style="padding: 10px 20px; width: 100%; border-collapse: collapse; ">
                                    <tr>
                                        <th style="padding: 10px;border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-left: 2px solid #96D4D4;">BOOKING DETAILS</th>
                                        <th style="padding: 10px;width: 80%; border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-right: 2px solid #96D4D4;border-left: 2px solid #96D4D4;">PAYMENT BREAKUP</th>
                                    </tr>
                                    
                                    <tr>
                                    
                                        <td style="padding: 20px 20px; vertical-align: top; width: 40%; border-left: 2px solid #96D4D4; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
            
                                            <table border="1" style="border-collapse: collapse; text-align:center; border-color: #96D4D4; width: 100%">
                                                
                                                ' . $content . '
                                                
                                            </table>
                                            
                                        </td>
                                        
                                        <td style="padding: 10px; width: 60%; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
                                            <table style="width: 100%;">
                                                <tr style="vertical-align: top;">
                                                   
                                                    <td >
                                                        <table style="border-collapse: collapse;padding: 10px 20px;"> 
                                                            
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Total Amount Paid ' . $userPayPercentage . '</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($payble, 2) . '</td>
                                                            </tr>
                                                            ' . $groosHtml . '
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Actual Amount</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($totalRoomPrice, 2) . '</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; ">
                                                                    <h4><strong>Retrod</strong> <small>- Comm ( ' . $COMM_PRICE . '% )</small></h4>
                                                                    <p><small>(Including Tax (18%))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; text-align: right;">
                                                                    ₹ ' . number_format($retroCommPrice, 2) . ' + <br/> ₹ ' . number_format($commTax, 2) . '
                                                                    
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 0 0 10px 0; border-bottom: 1px solid #00000033;" colspan="2">
                                                                    
                                                                    <table border="1" style="width:100%; border-collapse: collapse; border-color: gainsboro;">
                                                                    
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TAC including Tax</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ ' . number_format($retroCommPrice + $commTax, 2) . '</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TCS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ ' . number_format($tcsPrice, 2) . '</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TDS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ ' . number_format($tdsPrice, 2) . '</td>
                                                                        </tr>
                                                                    
                                                                    
                                                                    </table>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                            
                                                            
                                                            ' . $displayPayment . '
                                                            
                                                            
                                    
                                                        </table>
                                                        
                                                    </td>
                                                    
                                                </tr>
                                            </table>
            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <br/>
                    
                </body>
            </html>
    
    
    ';
    }




    return $html;
}


function getGuestEmailId($gid = '', $grid = '', $kotid = ''){
    global $conDB;
    if ($gid == '') {
        $sql = "select * from guest_review where id = $grid";
        $row = mysqli_fetch_assoc(mysqli_query($conDB, $sql));
        $gid = $row['guestId'];
    }

    $getGuestDetailArry = getGuestDetail('', '', $gid)[0];


    return $getGuestDetailArry['email'];
}



function send_email($email='', $gname = '', $cc = '', $bcc = '', $html='', $subject='',$invoice_html='',$file_name='invoice') {


    if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        include(SERVER_INCLUDE_PATH . 'smtp/autoload.php');
    }

    if (!class_exists('\Mpdf\Mpdf')) {
        require_once(SERVER_INCLUDE_PATH . 'mpdf/autoload.php');
    }
    $hotelDetail = fetchData('hotel', ['hCode'=>$_SESSION['HOTEL_ID']])[0];
    $hotel_name = $hotelDetail['hotelName'];
    $hotel_Email = $hotelDetail['hotelEmailId'];
    $retrodEmail = RETROD_MAIL_ID;
    $data = 0;

    try {
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.zeptomail.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'emailapikey';
        $mail->Password = 'PHtE6r0KRbjviWIvpxgJ5ae7HselZ4smqepvfwdD4o0RD/UAHE1Wqdp9xjCxqEssUqFAFPefyto5ueud5bqNJDu5PGsZX2qyqK3sx/VYSPOZsbq6x00cslsbd03VXIDocdBr0yDRstqX';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('noreply@retrod.in', $hotel_name);
        $mail->addAddress($email, $gname);
        $mail->addCC($hotel_Email);
        $mail->addBCC($retrodEmail);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;

        // Attach invoice if provided
        if ($invoice_html) {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($invoice_html);
            $pdf_content = $mpdf->Output('', 'S');
            $temp_file = tempnam(sys_get_temp_dir(), 'invoice_');
            file_put_contents($temp_file, $pdf_content);
            $mail->addAttachment($temp_file, 'invoice.pdf');
            register_shutdown_function(function () use ($temp_file) {
                unlink($temp_file);
            });
        }

        $mail->SMTPOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => false,
            ),
        );

        if ($mail->send()) {
            $data = 1;
        } else {
            // Handle error
            error_log("Email sending failed: " . $mail->ErrorInfo);
        }
    } catch (Exception $e) {
        // Handle exception
        error_log("Email sending failed: " . $e->getMessage());
    }

    return $data;
}


function custom_number_format($n, $precision = 1){
    if ($n < 900) {
        $n_format = number_format($n);
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision) . 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    } else {
        $n_format = number_format($n / 1000000000000, $precision) . 'T';
    }
    return $n_format;
}

// function roomBooking(){
//     global $conDB;
//     $sql = mysqli_query($conDB, "select * from booking,bookingdetail where booking.id = bookingdetail.bid and  booking.payment_status = 'complete'");
//     $data = mysqli_num_rows($sql);
//     if(mysqli_num_rows($sql) == ''){
//         $data = 0;
//     }
//     return $data;
// }

// function qpRoomBooking(){
//     global $conDB;
//     $sql = mysqli_query($conDB, "select * from quickpay where paymentStatus = 'complete'");
//     return mysqli_num_rows($sql);
// }



function checkAmenitiesById($rid, $aid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_amenities where room_id  = '$rid' and amenitie_id  = '$aid'");
    if (mysqli_num_rows($sql)) {
        $data = 1;
    } else {
        $data = 0;
    }
    return $data;
}

function visitor_count($ip)
{
    global $conDB;
    mysqli_query($conDB, "insert into visitor(visitor_ip) values('$ip')");
}

function roomBooking()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from booking,bookingdetail where booking.id = bookingdetail.bid and  booking.payment_status = '1' and booking.hotelId = '$hotelId' and booking.deleteRec = '1'");
    $data = mysqli_num_rows($sql);
    if (mysqli_num_rows($sql) == '') {
        $data = 0;
    }
    return $data;
}

function qpRoomBooking()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from quickpay where paymentStatus = '1'");
    return mysqli_num_rows($sql);
}

function roomNight()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $count = roomBooking();
    $currennt_date = date('Y-m-d');
    if ($count > 0) {
        $sql = mysqli_query($conDB, "select * from bookingdetail,booking where booking.id = bookingdetail.bid and bookingdetail.checkIn <= '$currennt_date' && bookingdetail.checkout >= '$currennt_date' and booking.payment_status = '1' and booking.hotelId = '$hotelId' and booking.deleteRec = '1'");
        $result = mysqli_num_rows($sql);
    } else {
        $result = 0;
    }
    return $result;
}

function getRoomNight($date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $count = roomBooking();
    $result = 0;
    $currennt_date = date('Y-m-d');
    if ($count > 0) {
        $query = "select * from bookingdetail,booking where booking.id = bookingdetail.bid and booking.payment_status = '1' and booking.hotelId = '$hotelId' and booking.deleteRec = '1'";
        if ($date != '') {
            $query .= " and booking.add_on like '$date%'";
        }
        $sql = mysqli_query($conDB, $query);
        while ($row = mysqli_fetch_assoc($sql)) {
            $checkIn = $row['checkIn'];
            $checkOut = $row['checkOut'];
            $result += getNightByTwoDates($checkIn, $checkOut);
        }
    } else {
        $result = 0;
    }
    return $result;
}

function getActiveFeed($limit = '', $type = '', $bid = '', $bdid = '', $groupBy = '', $notin = '', $date = '',$ip=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "select * from activityfeed where hotelId = '$hotelId'";

    if ($type != '') {
        $query .= " and type = '$type'";
    }

    if ($bid != '') {
        $query .= " and bid = '$bid'";
    }

    if ($bdid != '') {
        $query .= " and bdid = '$bdid'";
    }

    if ($ip != '') {
        $query .= " and ipaddres = '$ip'";
    }

    if ($date != '') {
        $query .= " and addOn like '$date%'";
    }

    if ($notin != '') {
        $query .= " and type not in($notin)";
    }

    if ($groupBy != '') {
        $query .= " group by type";
    }

    $query .= " order by id desc";

    if ($limit != '') {
        $query .= " limit $limit";
    }



    $sql = mysqli_query($conDB, $query);
    $data = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $extra = [
            'addByName'=>getAddByData($row['addBy'])
        ];
        $data[] = array_merge($row,$extra);
    }

    return $data;
}


function earnig()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $count = roomBooking();
    if ($count > 0) {
        $sql = mysqli_query($conDB, "select id from booking where hotelId = '$hotelId' and payment_status = '1' and deleteRec = '1'");
        $totalGrosePrice = 0;
        $totalUserpay = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            $totalGrosePrice += getBookingDetailById($row['id'])['totalPrice'];
            $totalUserpay += (isset(getBookingDetailById($row['id'])['userPay'])) ? getBookingDetailById($row['id'])['userPay'] : 0;
        }
        $result = [
            'gross' => $totalGrosePrice,
            'pay' => $totalUserpay,
        ];
    } else {
        $result = [
            'gross' => 0,
            'pay' => 0,
        ];
    }
    return $result;
}

function quickPayEarnig()
{
    global $conDB;
    $count = roomBooking();
    if ($count > 0) {
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where paymentStatus = '1'"));
        $result = custom_number_format($sql['sum(totalAmount)']);
    } else {
        $result = 0;
    }
    return $result;
}

function visitor($date = '')
{
    global $conDB;
    $query = "select * from visitor";
    if ($date != '') {
        $query .= " where addOn like '$date%'";
    }
    $sql = mysqli_query($conDB, $query);
    return mysqli_num_rows($sql);
}

function revenueCalculate($date1 = '', $date2 = '', $bookingSourse = '', $bookingType = '')
{
    global $conDB;
    $count = roomBooking();
    $currennt_date = date('Y-m-d');

    $nightCount = getNightCountByDay($date1, $date2);
    $revenue[] = ['gross' => 0, 'pay' => 0];
    $totalRevenue = 0;
    $userPayRevenue = 0;
    $bookingCount = 0;
    $totalVisitor = 0;
    $room = array();
    $roomArry = array();
    $roomList = array();
    $roomPrice = array();
    $price = 0;
    for ($i = 0; $i < $nightCount; $i++) {
        $currentDate = date('Y-m-d', strtotime($date1) + $i * 86430);
        $dailyEarn = dailyBookingEarning($currentDate, $bookingSourse, $bookingType);
        $visitor = visitor($currentDate);

        $total = $dailyEarn['total'];
        $userPay = $dailyEarn['userPay'];
        $bookingCountlist = $dailyEarn['bookingCount'];
        $roomListArry = $dailyEarn['roomList'];
        $roomId = array();
        if ($roomListArry != '') {
            foreach (getRoomList() as $val) {
                $id = $val['id'];
                $roomId[$id] = count(array_keys($roomListArry, $id));
            }
        }


        $totalRevenue += $total;
        $userPayRevenue += $userPay;
        $bookingCount += $bookingCountlist;
        $totalVisitor += $visitor;
        $room[] = $roomId;
    }

    foreach (getRoomList() as $val) {
        $price = 0;
        $id = $val['id'];
        foreach ($room as $key => $roomVal) {
            foreach ($roomVal as $key => $val) {
                if ($key == $id) {
                    $price += $val;
                }
            }
        }

        $roomPrice[$id] = $price;
    }


    $totalRevenue = round($totalRevenue);
    $userPayRevenue = round($userPayRevenue);
    return [
        'total' => $totalRevenue,
        'userpay' => $userPayRevenue,
        'bookingCount' => $bookingCount,
        'visitor' => $totalVisitor,
        'room' => $roomPrice,
    ];
}

// function dailyRoomBook($date=''){
//     global $conDB;
//     $hotelId = HOTEL_ID;
//     $
// }

function revenue()
{
    global $conDB;
    $count = roomBooking();
    $currennt_date = date('Y-m-d');

    if ($count > 0) {
        $sql = mysqli_query($conDB, "select id from booking where add_on = '$currennt_date' and payment_status = '1'");
        $qpsql = mysqli_fetch_assoc(mysqli_query($conDB, "select id as gross,sum(amount) as pay from quickpay where addOn = '$currennt_date' and paymentStatus = '1'"));
        $gross = 0;
        $qpgross = 0;
        $pay = 0;
        $qppay = 0;

        while ($row = mysqli_fetch_assoc($sql)) {
            $gross += getBookingDetailById($row['id'])['totalPrice'];
            $pay += getBookingDetailById($row['id'])['userPay'];
        }
        $revenue[] = [
            'gross' => $gross + $qpgross,
            'pay' => $pay + $qppay
        ];
    } else {
        $revenue[] = [
            'gross' => 0,
            'pay' => 0
        ];
    }
    return $revenue;
}

function dailyQuickPay()
{
    global $conDB;
    $revenue = 0;
    $currennt_date = date('Y-m-d');

    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sqlQuery = "select sum(amount) from quickpay where  addOn >= '$currennt_date' && addOn <= '$nextDay' and paymentStatus = '1' ";
    $query = mysqli_query($conDB, $sqlQuery);
    if (mysqli_num_rows($query) > 1) {
        $sql = mysqli_fetch_assoc($query);
        $revenue = $sql['sum(amount)'];
    } else {
        $revenue = 0;
    }

    return $revenue;
}

function dailyQuickPayEarning($date)
{
    global $conDB;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where  checkIn >= '$currennt_date' && checkIn <= '$nextDay' and paymentStatus = '1' "));
    $revenue = $sql['sum(totalAmount)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return $revenue;
}

function dailyBookingEarning($date, $bookingSourse = '', $bookingType = '', $payStatus = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $revenue = array();
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $query = "select id from booking where hotelId = '$hotelId'";

    if ($bookingSourse != '') {
        $query .= " and bookingSource = '$bookingSourse'";
    }

    if ($bookingType == 3) {
        $query .= " and checkout >= '$currennt_date' && checkout >= '$nextDay'";
    } elseif ($bookingType == 2) {
        $query .= " and checkIn >= '$currennt_date' && checkIn >= '$nextDay'";
    } else {
        $query .= " and add_on like '$currennt_date%'";
    }

    if ($payStatus != '') {
        $query .= " and payment_status = '$payStatus'";
    } else {
        $query .= " and payment_status = '1'";
    }

    $bookingCount = 0;
    $sql = mysqli_query($conDB, $query);
    $revenue = [
        'total' => 0,
        'userPay' => 0,
        'bookingCount' => 0,
        'roomList' => '',
    ];
    while ($row = mysqli_fetch_assoc($sql)) {
        $bookingCount++;
        $id = $row['id'];
        foreach (getBookingData($id) as $val) {
            $roomId = $val['roomId'];
            $roomList[] = $roomId;
        }

        $revenue = [
            'total' => (getBookingDetailById($id)['totalPrice'] == '') ? 0 : getBookingDetailById($id)['totalPrice'],
            'userPay' => (getBookingDetailById($id)['userPay'] == '') ? 0 : getBookingDetailById($id)['userPay'],
            'bookingCount' => $bookingCount,
            'roomList' => $roomList,
        ];
    }

    return $revenue;
}

function dailyBookingEarningByAddOn($date,$array='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from booking where hotelId = '$hotelId' and  add_on LIKE  '$date%'  and payment_status = '1' and deleteRec = '1'");
    $revenue = 0;
    $data = array();

    while ($row = mysqli_fetch_assoc($sql)) {
        if($array != ''){
            $data[] = $row;
        }else{
            $revenue += getBookingDetailById($row['id'])['totalPrice'];
        }
        
    }

    if($array != ''){
        
    }else{
        if ($revenue == '') {
            $revenue = 0;
        }else{
            $data = round($revenue);
        }
    }

    
    return $data;
}

function dailyBookingEarningByAddOnCount($date){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select id from booking where hotelId = '$hotelId' and  add_on LIKE  '$date%'  and payment_status = '1' and deleteRec = '1'");
    $revenueCount = mysqli_num_rows($sql);

    return $revenueCount;
}

function dailyQuickPayEarningByAddOn($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where  hotelId = '$hotelId' and addOn LIKE  '$date %' and paymentStatus = '1' "));
    $revenue = $sql['sum(totalAmount)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return round($revenue);
}

function dailyQuickPayEarningByAddOnCount($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from quickpay where hotelId = '$hotelId' and addOn LIKE  '$date %' and paymentStatus = '1' ");
    $revenueCount = mysqli_num_rows($sql);
    if ($revenueCount == '') {
        $revenueCount = 0;
    }
    return $revenueCount;
}

function dailyUserPayQuickPayEarning($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from quickpay where hotelId = '$hotelId' and checkIn >= '$currennt_date' && checkIn <= '$nextDay' and paymentStatus = '1' "));
    $revenue = 0;
    if ($revenue == '') {
        $revenue = 0;
    }
    return $revenue;
}

function dailyUserPayBookingEarning($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $revenue = 0;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(userPay) from booking where hotelId = '$hotelId' and  checkIn >= '$currennt_date' && checkout <= '$nextDay' and payment_status = '1' "));
    $revenue = $sql['sum(userPay)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return $revenue;
}

function dailyUserPayBookingEarningByAddOn($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $revenue = 0;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(userPay) from booking where hotelId = '$hotelId' and  add_on LIKE  '$date %'  and payment_status = '1' "));
    $revenue = $sql['sum(userPay)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return round($revenue);
}

function dailyUserPayQuickPayEarningByAddOn($date)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(amount) from quickpay where hotelId = '$hotelId' and  addOn LIKE  '$date %' and paymentStatus = '1' "));
    $revenue = $sql['sum(amount)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return round($revenue);
}


function MonthlyBookingEarning($date, $date2, $be='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $revenue = 0;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($date2) + $one_day);
    $sql = mysqli_query($conDB, "select id from booking where hotelId = '$hotelId' and add_on >= '$currennt_date' && add_on <= '$nextDay' and payment_status = '1'");
    if($be!=''){
        $sql = mysqli_query($conDB, "select id from booking where hotelId = '$hotelId' and add_on >= '$currennt_date' && add_on <= '$nextDay' and payment_status = '1' and bookingSource =2");
    }
   
    $revenue = 0;
    while ($row = mysqli_fetch_assoc($sql)) {
        $revenue += getBookingDetailById($row['id'])['totalPrice'];
    }
    if ($revenue == '') {
        $revenue = 0;
    }
    return $revenue;
}

function MonthlyQuickPayEarning($date, $date2)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($date2) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where hotelId = '$hotelId' and addOn >= '$currennt_date' && addOn <= '$nextDay' and paymentStatus = '1' "));
    $revenue = $sql['sum(totalAmount)'];
    if ($revenue == '') {
        $revenue = 0;
    }
    return $revenue;
}


function averageStay()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $total_booking = roomBooking();
    if ($total_booking == 0) {
        $result = 0;
    } else {
        $sql = mysqli_query($conDB, "select * from booking where hotelId = '$hotelId' and payment_status = '1' and status = '1'");
        $count_complete_booking = mysqli_num_rows($sql);
        $result = ($count_complete_booking * 100) / $total_booking;
    }
    return ceil($result);
}

function rate_performance()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $total_booking = roomBooking();
    $currennt_date = date('Y-m-d');
    if ($total_booking == 0) {
        $result = 0;
    } else {
        $query = "select * from booking where hotelId = '$hotelId' and checkIn <= '$currennt_date' && checkOut >= '$currennt_date' GROUP BY room_detail_id and status = '1'";
        $sql = mysqli_query($conDB, $query);
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $roomDId = $row['room_detail_id'];
                $query = "select * from booking where hotelId = '$hotelId' and checkIn <= '$currennt_date' && checkOut >= '$currennt_date' and room_detail_id = '$roomDId' and status = '1'";
                $sqlById = mysqli_query($conDB, $query);
                $count[] = mysqli_num_rows($sqlById);
            }
            $result = getRatePlanByRoomDetailId(max($count));
        } else {
            $result = 0;
        }
    }
    return $result;
}

// function settingValue(){
//     global $conDB;
//     $sql = mysqli_query($conDB, "select * from setting where id = '1'");
//     $row = mysqli_fetch_assoc($sql);
//     return $row;
// }

function getGuestamenddetailData($cin='',$cout='',$bid='',$bdid=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from guestamenddetail where hotelId = '$hotelId'";

    if($cin != ""){
        $sql .= "  and checkInTime like '$cin%'";
    }

    if($cout != ""){
        $sql .= "  and checkOutTime like '$cout%'";
    }

    if($bid != ""){
        $sql .= "  and bid = '$bid'";
    }

    if($bdid != ""){
        $sql .= "  and bdid = '$bdid'";
    }
    $data = array();
    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    
    return $data;
}


function guestAmendReport($checkInDate = '', $checkOutDate = '', $bid='',$bdid='')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $data = array();
    $sql = "select booking.*,guestamenddetail.*,guestamenddetail.id as amendDetailId,bookingdetail.checkIn,bookingdetail.checkOut, booking.add_on as bookingAddOn from booking,guestamenddetail,bookingdetail where booking.id = guestamenddetail.bid and bookingdetail.id = guestamenddetail.bdid and booking.hotelId = '$hotelId'  ";

    if ($checkInDate != '') {
        $sql .= " and bookingdetail.checkIn = '$checkInDate'";
    }

    if ($checkOutDate != '') {
        $sql .= " and bookingdetail.checkout = '$checkOutDate'";
    }

    if ($bid != '') {
        $sql .= " and guestamenddetail.bid = '$bid'";
    }

    if ($bdid != '') {
        $sql .= " and guestamenddetail.bdid = '$bdid'";
    }


    $sql .= " and booking.payment_status = '1' group by booking.id";
  
    // echo $sql;
    $query = mysqli_query($conDB, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            // pr($row);
        // $data[] =$row;
        $checkInTime = $row['checkInTime'];
        $checkOutTime = $row['checkOutTime'];

        if ($checkInDate != '') {
            if ($checkInTime == null) {
                $data[] = [
                    'checkIn' => '',
                    'pending' => $row['id'],
                ];
            } else {
                $data[] = [
                    'checkIn' => $row['id'],
                    'pending' => '',
                ];
            }
        }elseif ($checkOutDate != null) {
            if ($checkOutTime == null) {
                $data[] = [
                    'checkOut' => '',
                    'pending' => $row['id'],
                ];
            } else {
                $data[] = [
                    'checkOut' => $row['id'],
                    'pending' => '',
                ];
            };
        }else{
            $data =  $row;
        }

    }
    return $data;
}


function countCheckIn($date = ''){
    $date = ($date == '') ? date('Y-m-d') : date('Y-m-d', strtotime($date));
    $arry = fetchData('bookingdetail', ['hotelId'=>HOTEL_ID, 'checkIn' => $date]);
    
    $checkin = 0;
    $pending = 0;
    foreach ($arry as $val) {
        $adult = $val['adult'];
        $child = $val['child'];
        $pax = intval($adult) + intval($child);
        $checkin += $pax;
        $pending += $pax;
        // if ($val['checkIn'] == '') {
        //     $pending++;
        // } else {
        //     $checkin++;
        // }
    }

    return ['checkin' => $checkin, 'pending' => $pending];
}

function countCheckOut($date = ''){
    $date = ($date == '') ? date('Y-m-d') : date('Y-m-d', strtotime($date));
    $arry = fetchData('bookingdetail', ['hotelId'=>HOTEL_ID, 'checkOut' => $date]);
    $checkOut = 0;
    $pending = 0;
    foreach ($arry as $val) {
        $adult = $val['adult'];
        $child = $val['child'];
        $pax = intval($adult) + intval($child);
        $checkOut += $pax;
        $pending += $pax;
        // if ($val['checkIn'] == '') {
        //     $pending++;
        // } else {
        //     $checkin++;
        // }
    }

    return ['checkOut' => $checkOut, 'pending' => $pending];
}

function countInHouseAdultNChild($date = '')
{
    $date = ($date == '') ? date('Y-m-d') : $date;
    $arry = guestAmendReport($date);
    $adult = 0;
    $child = 0;
    foreach ($arry as $val) {
        if ($val['checkIn'] != '') {
            $id = $val['checkIn'];
            $adult += getBookingDetailById($id)['totalAdult'];
            $child += getBookingDetailById($id)['totalChild'];
        }
    }

    return ['adult' => $adult, 'child' => $child];
}

function countRoomStatus($date = '')
{
    $book = 0;
    $vacant = 0;
    $block = 0;
    $date = ($date == '') ? date('Y-m-d') : $date;
    foreach (getRoomNumberWithFilter() as $roomNumList) {
        $roomNo = $roomNumList['roomNo'];
        $status = $roomNumList['status'];
        if ($status == 1) {
            if (count(getBookingData('', $roomNo, $date)) != 0) {
                $book++;
            } else {
                $vacant++;
            }
        }
        if ($status == 4) {
            $block++;
        }
    }

    return ['book' => $book, 'vacant' => $vacant, 'block' => $block];
}


function todayCheckIn()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from booking where hotelId = '$hotelId' and checkIn = '$today' and payment_status = '1'");
    return mysqli_num_rows($sql);
}

function todayCheckOut()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from booking where hotelId = '$hotelId' and checkout = '$today' and payment_status = '1'");
    return mysqli_num_rows($sql);
}

function qpTodayCheckIn()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from quickpay where hotelId = '$hotelId' and checkIn = '$today' and paymentStatus = '1'");
    return mysqli_num_rows($sql);
}

function qpTodayCheckOut()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from quickpay where hotelId = '$hotelId' and checkOut = '$today' and paymentStatus = '1'");
    return mysqli_num_rows($sql);
}

function tryRoomBooking()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = mysqli_query($conDB, "select * from booking,bookingdetail where hotelId = '$hotelId' and booking.id = bookingdetail.bid and booking.payment_status= '2' and booking.status = '1'");
    return mysqli_num_rows($sql);
}

function tryBook()
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $count = roomBooking();
    if ($count > 0) {
        $sql = mysqli_query($conDB, "select booking.id from booking,bookingdetail where hotelId = '$hotelId' and booking.id = bookingdetail.bid and booking.payment_status= '2' and booking.status = '1'");
        $revenue = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            $revenue += getBookingDetailById($row['id'])['totalPrice'];
        }
    } else {
        $revenue = 0;
    }
    return $revenue;
}


function printBtnClickToHtml($rBID, $bdid)
{

    $bookingArray = getBookingData($rBID, '', '', $bdid)[0];
    $roomNum = $bookingArray['room_number'];
    $paymentMwthod = '';
    $url = FRONT_SITE . '/voucher.php?oid=' . $rBID;
    foreach (getPaymentTypeMethod() as $paymentList) {
        $data = $paymentList['name'];
        $dataId = $paymentList['id'];
        $paymentMwthod .= "<option value='$dataId'>$data</option>";
    }

    $html = '
            <div class="paymentBlock">
                <h4>Print Voucher </h4>
                <div id="printGuestBooingVoucherForm">

                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="chooseVoucher">Choose</label>
                            <select id="chooseVoucher" class="form-control">
                                <option value="guest">Guest</option>
                            </select>
                        </div>
                        <input id="rBID" type="hidden" value="' . $rBID . '">
                        <input id="bdid" type="hidden" value="' . $bdid . '">
                        <input id="roomNum" type="hidden" value="' . $roomNum . '">
                    </div>

                    <div class="row">
                    <div class="col-6"><button class="btn btn-outline-secondary removeRoomView">Cancel</button></div>
                    <div class="col-6 flexEnd"><a id="printGuestBooingVoucherBtn" href="' . $url . '"><button class="btn bg-gradient-primary">Download</button></a></div>
                    </div>

                </div>
            </div>
    ';

    return $html;
}


function paymentBtnClickToHtml($rBID, $bdid, $rTab = ''){
    $paymentMwthod = '';
    $bookingArray = getBookingData($rBID, '', '', $bdid)[0];
    $roomNum = $bookingArray['room_number'];

    foreach (getPaymentTypeMethod() as $paymentList) {
        $data = $paymentList['name'];
        $dataId = $paymentList['id'];
        $paymentMwthod .= "<option value='$dataId'>$data</option>";
    }

    $bookingDetail = getBookingDetailById($rBID);

    $totalAmount = number_format($bookingDetail['totalPrice'], 2);
    $userPay = number_format($bookingDetail['userPay'], 2);
    $pending = number_format($bookingDetail['totalPrice'] - $bookingDetail['userPay'], 2);

    $totalRoomPrice = $bookingDetail['totalRoomPrice'];
    $gstPrice = $bookingDetail['gstPrice'];
    $roomTotalPrice = $bookingDetail['roomTotalPrice'];
    $kotSubPrice = $bookingDetail['kotSubPrice'];
    $kotPrice = $bookingDetail['kotPrice'];
    $kotTax = $bookingDetail['kotTax'];
    $totalPrice = $bookingDetail['totalPrice'];

    $priceBackupHtml = generatePriceBreakup($totalRoomPrice, $gstPrice, $roomTotalPrice, $kotSubPrice, $kotTax, $kotPrice, $totalPrice);

    if ($bookingDetail['totalPrice'] - $bookingDetail['userPay'] == 0) {
        $html = successfullPaymentHtnl($rBID) . $priceBackupHtml;
    } else {
        $html = '
            <div class="paymentBlock">
                <ul>
                    <li>
                        <span>Total</span>
                        <span>Rs ' . $totalAmount . '</span>
                    </li>
                    <li>
                        <span>Paid</span>
                        <span>Rs ' . $userPay . '</span>
                    </li>
                    <li>
                        <span>Pending</span>
                        <span>Rs ' . $pending . '</span>
                    </li>
                </ul>
                <form id="paymentBtnClickForm">
                    <div class="form-group">
                        <label for="amoutInput">Amount<span style="color:red; font-size: 18px;">*</span></label>
                        <input type="number" class="form-control" id="amoutInput" placeholder="Enter amount" name="amount" required>
                    </div>
                    <input type="hidden" value="' . $roomNum . '" name="roomNum" id="guestRoomNum">
                    <input type="hidden" value="' . $rTab . '" name="rTab" id="reservationtab">
                    <input type="hidden" value="' . $rBID . '" name="roomBID" id="roomBID">
                    <input type="hidden" value="' . $bdid . '" name="bdid" id="bdid">
                    <input type="hidden" value="paymentBtnClickFormSubmit" name="type">
                    <div class="row mb-4">
                  
                        <div class="col-12">
                    
                            <label for="">Payment Method <span style="color:red; font-size: 18px;">*</span> </label>                    
                                  <i class="bi bi-info-lg" data-tooltip-top="Walk-In"></i>                                            
                            <select class="form-control" name="paymentMethod" required>
                                <option disabled selected>Select*</option>
                                ' . $paymentMwthod . '
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="paymentRemark">Payment Remark <span style="color:red; font-size: 18px;">*</span> </label>
                            <input type="text" class="form-control" id="paymentRemark" placeholder="Enter Remark" name="paymentRemark" required>
                        </div>
                    </div>

                    

                    <div class="row">
                    <div class="col-6"><span class="btn btn-outline-secondary removeRoomView">Cancel</span></div>
                    <div class="col-6 flexEnd"><button type="submit" class="btn bg-gradient-primary">Submit</button></div>
                    </div>

                </form>
            </div>
    ';
    }



    return $html;
}


function checkInOutBtnClickToHtml($rBID, $bdid, $rTab = '')
{


    $bookingArray = getBookingData($rBID, '', '', $bdid)[0];
    $roomNum = $bookingArray['room_number'];

    $checkIn = $bookingArray['checkIn'];
    $checkOut = $bookingArray['checkOut'];
    $checkinstatus = $bookingArray['checkinstatus'];
    $disable = '';
    if ($checkinstatus == 2) {
        $disable = 'disabled';
    }
    $html = '
            <div class="paymentBlock">
                <h4>Check In Change</h4>
                <form id="checkInOutBtnClickForm">
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="checkInPoupUp">Check In</label>
                            <input ' . $disable . ' type="date" id="checkInPoupUp" class="form-control" value="' . $checkIn . '" name="checkIn" required>
                        </div>
                        <div class="col-6">
                            <label for="checkOutPoupUp">Check Out</label>
                            <input type="date" id="checkOutPoupUp" class="form-control" value="' . $checkOut . '" name="checkOut" required>
                        </div>
                    </div>

                    <input type="hidden" value="' . $roomNum . '" name="roomNum" id="checkInRoomNum">
                    <input type="hidden" value="' . $rTab . '" name="rTabType" id="rTabType">
                    <input type="hidden" value="' . $rBID . '" name="roomBID" id="roomBID">
                    <input type="hidden" value="checkInOutBtnClickFormSubmit" name="type">

                    <div class="row">
                    <div class="col-6"><span class="btn btn-outline-secondary removeRoomView">Cancel</span></div>
                    <div class="col-6 flexEnd"><button type="submit" class="btn bg-gradient-primary">Update</button></div>
                    </div>

                </form>
            </div>
    ';

    return $html;
}

function roomMoveBtnClickToHtml($rBID, $rDId, $rTab = ''){
    $bookingArray = getBookingData($rBID, '', '', $rDId)[0];
    $bdid = $bookingArray['id'];
    $roomNum = $bookingArray['room_number'];
    $roomId = $bookingArray['roomId'];
    $roomDId = $bookingArray['roomDId'];
    $checkIn = $bookingArray['checkIn'];
    $checkOut = $bookingArray['checkOut'];


    $roomTypeHtml = '';
    $roomNumHtml = roomMoveOptionByRoomId($roomId, 'roomNum', $bdid,$roomNum);
    $rateTypeHtml = roomMoveOptionByRoomId($roomId, 'rate', $bdid);

    foreach (getRoomType() as $roomTypeList) {
        $name = $roomTypeList['header'];
        $roomTypeId = $roomTypeList['id'];
        if ($roomTypeId == $roomDId) {
            $roomTypeHtml .= "<option selected value='$roomTypeId'>$name</option>";
        } else {
            $roomTypeHtml .= "<option value='$roomTypeId'>$name</option>";
        }
    }


    $pageName = getPageName($_SERVER['PHP_SELF']);

    $html = '
        <div class="paymentBlock">
            <h4>Room change</h4>
            <form id="roomMoveBtnClickForm" data-page="' . $pageName . '">

                <div class="row mb-4">
                    <div class="col-12">
                        <label for="currentRoom">Current Room</label>
                        <input class="form-control" type="text" disabled value="' . $roomNum . '" id="currentRoom" name="currentRoomNum">
                    </div>
                </div>

                <input type="hidden" value="' . $roomNum . '" name="oldRoomNum" id="moveRoomNum">
                <input type="hidden" value="' . $rTab . '" name="reservationTab" id="reservationTab">
                <input type="hidden" value="' . $rBID . '" name="roomBID" id="roomBID">
                <input type="hidden" value="' . $rDId . '" name="bookingDId" id="bookingDId">
                <input type="hidden" value="' . $roomId . '" name="roomType" id="roomType">
                <input type="hidden" value="roomMoveBtnClickFormSubmit" name="type">

                <div class="row mb-4">
                    <div class="col-12">
                        <label for="chooseRoomForMove">Room </label>
                        <select disabled class="form-control" id="chooseRoomForMove" name="" data-bdid="' . $rDId . '">
                            ' . $roomTypeHtml . '
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <label for="chooseRatePlaneForMove">Rate Plane</label>
                        <select class="form-control" id="chooseRatePlaneForMove" name="ratePlane">
                            ' . $rateTypeHtml . '
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <label for="chooseRoomTypeForMove">Room Number</label>
                        <select class="form-control" id="chooseRoomTypeForMove" name="roomNumber">
                            ' . $roomNumHtml . '
                        </select>
                    </div>
                </div>

                <div class="row">
                <div class="col-6"><span class="btn btn-outline-secondary removeRoomView">Cancel</span></div>
                <div class="col-6 flexEnd"><button type="submit" class="btn bg-gradient-primary">Move</button></div>
                </div>

            </form>
        </div>
    ';

    return $html;
}

function getHotelService()
{
    global $conDB;
    $sql = "select * from hotelservice";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row  = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getCouponArry($cid = '', $status = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;


    if ($status == '') {
        $sql = "select * from couponcode where hotelId = '$hotelId' and deleteRec='1'";
    } else {
        $sql = "select * from couponcode where hotelId = '$hotelId' and deleteRec='1' and status = 1";
    }

    if ($cid != '') {
        $sql .= " and id ='$cid'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getCouponDiscountShort($type, $value)
{
    $data = '0.00%';
    if ($type == 'P') {
        $data = $value . ' %';
    }

    if ($type == 'F') {
        $data = '₹ ' . $value;
    }

    return $data;
}


function getRoomArr($payAdvance = '')
{
    global $conDB;
    $sql = mysqli_query($conDB, "select room.*,room_detail.id as rdid from room,room_detail where room.id=room_detail.room_id and room.status = '1' group by(room.id) ORDER BY `room_detail`.`price` asc");
    if ($payAdvance != '') {
        $sql = mysqli_query($conDB, "select room.*,room_detail.id as rdid from room,room_detail where room.id=room_detail.room_id and room.status = '1' and room_detail.singlePrice > '$payAdvance' group by(room.id) ORDER BY `room_detail`.`price` asc");
    }
    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = [
                'id' => $row['id'],
                'name' => $row['header'],
            ];
        }
    } else {
        $data[] = 'No Room';
    }

    return $data;
}








// Super Admin 



function countRoomOnHotelId($hId)
{
    global $conDB;
    $sql = "select * from room where hotelId = '$hId' and deleteRec = 1";
    $data = mysqli_num_rows(mysqli_query($conDB, $sql));

    return $data;
}

function countRoomNumberOnHotelId($hId)
{
    global $conDB;
    $sql = "select * from roomnumber where hotelId = '$hId' and deleteRec = 1";
    $data = mysqli_num_rows(mysqli_query($conDB, $sql));

    return $data;
}

function countAmenitiesHotelId($hId)
{
    global $conDB;
    $sql = "select * from amenities where hotelId = '$hId' and deleteRec = 1";
    $data = mysqli_num_rows(mysqli_query($conDB, $sql));

    return $data;
}

function checkBEStatus($hId)
{

    global $conDB;


    if (countRoomOnHotelId($hId) > 0 && countRoomNumberOnHotelId($hId) > 0  && countAmenitiesHotelId($hId) > 0) {
        $status = 'Proper';
    } else {
        $status = 'Improper';
    }

    return $status;
}


function getPercentageByClass($percentage, $fst = '35', $snd = '45', $fth = '75')
{
    if ($percentage <= $fst) {
        $class = 'bg-gradient-danger';
    } elseif ($percentage <= $snd) {
        $class = 'bg-gradient-warning';
    } elseif ($percentage <= $fth) {
        $class = 'bg-gradient-info';
    } else {
        $class = 'bg-gradient-success';
    }

    return $class;
};


function setKOTOrderConform($name = '', $number = '', $email = '',$tid='',$resId=''){
    global $conDB;
    $hotelId = HOTEL_ID;

    if (isset($_SESSION['kot']) && count($_SESSION['kot']) > 0) {
        $hotelDetailArry = hotelDetail('', '', '', '', $hotelId);
        $lastAddRow = mysqli_insert_id($conDB);

        $kotProductDetailArry = getAddKotProductDetail();

        $totalProduct = $kotProductDetailArry['totalProduct'];
        $kotDisPro = $kotProductDetailArry['kotDisPro'];
        $kotDisValue = $kotProductDetailArry['kotDisValue'];
        $subTotal = $kotProductDetailArry['subTotal'];
        $tax = $kotProductDetailArry['tax'];
        $totalPrice = $kotProductDetailArry['totalPrice'];
        $kotAdvancePay = $kotProductDetailArry['kotAdvancePay'];
        $kotBalancePay = $kotProductDetailArry['kotBalancePay'];
       
        $bookingDetailId = 0;

        $serviceId = $_SESSION['kotSeviceId'];
        $servicePropertyId = $_SESSION['kotServiceProperty'];

        $kotTotalGuest = (isset($_SESSION['kotTotalGuest'])) ? $_SESSION['kotTotalGuest'] : 0;
        $kotNotes = (isset($_SESSION['kotNotes'])) ? $_SESSION['kotNotes'] : '';
        $kotWaiter = (isset($_SESSION['kotWaiter'])) ? $_SESSION['kotWaiter'] : 0;

        if ($serviceId == 2) {
            $roomNum = getRoomNumber('', '', '', '', '', '', $servicePropertyId, '', '', 'kotSearch')[0]['name'];
            $bookingDetailId = $roomNum;
        }

        $date = date('Y-m-d');
        $data = array();

        if(count(getKotOrder('',$date,'','','',$serviceId,$servicePropertyId,0)) > 0){
            $orderArry = getKotOrder('',$date,'','','',$serviceId,$servicePropertyId,0)[0];
            $orderId = $orderArry['id'];
            $kotOrderSql = "update kotorder set totalProductPrice='$totalProduct', kotDisPro='$kotDisPro', subTotal='$subTotal', tax='$tax', totalPrice='$totalPrice' where id = '$orderId'";
            mysqli_query($conDB, $kotOrderSql);

            foreach ($_SESSION['kot'] as $key => $val) {
                $qty = $val['qty'];
                posDetailUpload($orderId,$key,$qty);
            }
            $data = [
                'status' => 'success',
                'msg' => 'Successfully Update.',
            ];
        }else{
            
            $billNo = threeNumberFormat((isset(getKotOrder('', 'max', '', '', 'yes')[0])) ? getKotOrder('', '', '', '', 'yes')[0]['billno'] : 0, 'inc');
          
            global $time;
            $kotOrderSql = "insert into kotorder(hotelId,serviceId,servicePropertyId,totalProductPrice,kotDisPro,kotDisValue,subTotal,tax,totalPrice,kotAdvancePay,kotBalancePay,billno,bookingDetailId,noteAdd,totalPerson,waiter,addOn,orderType,resturantId) values('$hotelId','$serviceId', '$servicePropertyId', '$totalProduct','$kotDisPro','$kotDisValue','$subTotal','$tax','$totalPrice','$kotAdvancePay','$kotBalancePay','$billNo','$bookingDetailId','$kotNotes','$kotTotalGuest','$kotWaiter','$time','$serviceId',$resId)";
    
            mysqli_query($conDB, $kotOrderSql);

            $lastAddKotOrder = mysqli_insert_id($conDB);
            
            $roomNum = getRoomNumber('','','','','',',',$tid)[0]['roomNo'];
            $bookingdetail = getBookingDetail('','','',$roomNum);
            $bid = $bookingdetail[0]['bid'];

            $sql = "insert into guest(hotelId,type,accessId,name,email,phone,bookId) values('$hotelId','pos','$lastAddKotOrder','$name','$email','$number','$bid')";
            mysqli_query($conDB, $sql);
            setActivityFeed('', 17, $lastAddKotOrder);
            $_SESSION['kotOrderId'] = $lastAddKotOrder;

            foreach ($_SESSION['kot'] as $key => $val) {
                $qty = $val['qty'];
                posDetailUpload($lastAddKotOrder,$key,$qty);
            }
            
            $data = [
                'status' => 'success',
                'msg' => 'Successfully Saved.',
            ];
        }
        

    } else {
        $data = [
            'status' => 'error',
            'msg' => 'Please select item!',
        ];
    }


    return $data;
}


function getKotService($id = '', $status = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from sys_kotservice where id !=''";

    if ($status != '') {
        $sql .= " and status = '1'";
    }

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotCategory($id = '', $accessKey = ''){
    global $conDB;
    $sql = "select * from sys_kotcategory where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($accessKey != '') {
        $sql .= " and accessKey = '$accessKey'";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotMealTime($id = '')
{
    global $conDB;
    $sql = "select * from sys_kot_meal_time ";

    if ($id != '') {
        $sql .= " where id = '$id'";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getAllKotProduct($mealTime = '')
{
    $data = array();

    $getKotProduct = getKotProduct('', '', '', '', '', $mealTime);

    foreach (getSysKotProduct() as $val) {
        $data[] = $val;
    }

    return $data;
}

function getKotProduct($id = '', $status = '', $productCat = '', $delete = '', $proName = '', $mealTime = '', $pid = '', $checkId = '', $cat = '', $order=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = array();
    $sql = "select * from kotprouct_hotel where hotelId ='$hotelId'";

    if ($delete != '') {
        $sql .= '';
    } else {
        $sql .= 'and deleteRec = 1';
    }

    if ($status != '') {
        $sql .= " and status = '1'";
    }

    if ($cat != '' && $cat != 0) {
        $sql .= " and pCat = '$cat'";
    }

    if ($pid != '') {
        if ($pid == '0') {
            $sql .= " and pid = '0'";
        } else {
            $sql .= " and pid != '0'";
        }
    }


    if ($id != '' && $id != 0) {
        $sql .= " and id = '$id'";
    }

    if ($checkId != '') {
        $sql .= " and id != '$checkId'";
    }


    if ($productCat != '') {
        if (gettype($productCat) == 'string') {
            $productCat = (count(getKotCategory('', $productCat)) > 0) ? getKotCategory('', $productCat)[0]['id'] : '';
        }
        $sql .= " and productcat like '%$productCat%'";
    }

    if ($proName != '') {
        $sql .= " and name like '%$proName%'";
    }

    if ($order != '') {
        if($order == 'name'){
            $sql .= " order by name asc";
        }
    }else{
        $sql .= " order by id desc";
    }
    
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['pid'] != 0 && $row['pid'] != '') {
                $data[] = getSysKotProduct($row['pid'])[0];
            } else {
                $data[] = $row;
            }
        }
    }

    return $data;
}

function getSysKotProduct($id = '', $status = '', $productCat = '', $delete = '', $proName = '')
{
    global $conDB;
    $sql = "select * from kotprouct_sys where id !=''";

    if ($delete != '') {
        $sql .= '';
    } else {
        $sql .= ' and deleteRec = 1';
    }

    if ($status != '') {
        $sql .= " and status = '1'";
    }


    if ($id != '') {
        $sql .= " and id = '$id'";
    }


    if ($productCat != '') {
        if (gettype($productCat) == 'string') {
            $productCat = (count(getKotCategory('', $productCat)) > 0) ? getKotCategory('', $productCat)[0]['id'] : '';
        }
        $sql .= " and productcat like '%$productCat%'";
    }

    if ($proName != '') {
        $sql .= " and name like '%$proName%'";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotStockRawProductList($id = '', $sIt = '', $order = '', $orderBy = "", $filter = '')
{
    global $conDB;
    $sql = "select * from kot_raw_product_list where id !=''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($filter != '') {
        if (isset($_SESSION['stock'])) {
            foreach ($_SESSION['stock'] as $key => $val) {
                $sql .= " and id != '$key'";
            }
        }
        foreach (getKotStaockExistData() as $key => $val) {
            $id = $val['id'];
            $sql .= " and id != '$id'";
        }
    }

    if ($sIt != '') {
        $sql .= " and sku LIKE '%$sIt%' OR name LIKE '%$sIt%' OR tag LIKE '%$sIt%' ";
    }
    $sql .= " order by name asc";
    if ($order != '') {
        $sql .= " order by $order $orderBy";
    }

    $data = array();
    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotQtyUnitList($id = '')
{
    global $conDB;
    $sql = "select * from kot_qty_unit where id !=''";


    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotStaockExistData($id = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from kot_stock where id != ''";
    if ($id != '') {
        $sql .= " and id = '$id'";
    }
    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotStockManagment($id = '', $sIt = '', $order = '', $orderBy = "", $date = '', $orderType = 'buy')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select kot_stock.*, kot_raw_product_list.name, kot_raw_product_list.priceCalculateBy,kot_raw_product_list.img,kot_stock_timeline.qty,kot_stock_timeline.addBy,kot_stock_timeline.addOn as timelineAddOn from kot_raw_product_list,kot_stock, kot_stock_timeline where kot_stock.hotelId ='$hotelId' and kot_raw_product_list.id = kot_stock.rawProId and kot_stock_timeline.kotStockId = kot_stock.id and kot_stock_timeline.action = '$orderType'";


    if ($id != '') {
        $sql .= " and kot_stock.id = '$id'";
    }


    if ($sIt != '') {
        $sql .= " and kot_raw_product_list.name LIKE '%$sIt%'";
    }
    $sql .= " group by kot_stock.id";
    $sql .= " order by kot_raw_product_list.name asc ";
    if ($order != '') {
        $sql .= " order by kot_raw_product_list.$order $orderBy";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}


function getKotStockTimeline($sid = '', $action = '', $date = '', $sum = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * ";

    if ($sum != '') {
        $sql .= ",sum(qty) as sumQty ";
    }

    $sql .= "from kot_stock_timeline where hotelId = '$hotelId'";

    if ($sid != '') {
        $sql .= " and kotStockId='$sid'";
    }
    if ($action != '') {
        $sql .= " and action = '$action'";
    }
    if ($date != '') {
        $sql .= " and addOn like '%$date%'";
    }

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getKotStockExpnce($action = '', $date = '')
{
    $array = getKotStockTimeline('', $action, $date);
    $price = 0;
    foreach ($array as $val) {
        $price += $val['totalPrice'];
    }

    return $price;
}

function getKotStockBuyAndSellData($sid)
{
    $rest = 0;
    $totalSell = 0;
    $totalQty = 0;

    $perviceBuy = 0;
    $perviceSell = 0;
    foreach (getKotStockTimeline($sid) as $timeline) {
        $action = $timeline['action'];
        $qty = $timeline['qty'];

        if ($action == 'buy') {
            $totalQty += $qty;
        }
        if ($action == 'sell') {
            $totalSell += $qty;
        }

        $rest = $totalQty - $totalSell;

        if ($rest == 0) {
            $perviceBuy = $totalQty;
            $perviceSell = $totalSell;

            $totalQty = 0;
            $rest = 0;
            $totalSell = 0;
        }
    }

    $totalQty = ($totalQty == 0) ? $perviceBuy : $totalQty;
    $totalSell = ($totalSell == 0) ? $perviceSell : $totalSell;

    $data = [
        'buy' => $totalQty,
        'sell' => $totalSell,
        'rest' => $rest,
    ];

    return $data;
}


function getPriceCalculate($disPro = '', $disValue = '', $total = '', $perfect = ''){
    $result = 0;

    if ($disPro == 'percentage') {
        $result = $total * $disValue / 100;
    }

    if ($disPro == 'fixed') {
        $result = $disValue;
    }

    if ($disPro == 'includeP') {
        $result =  round((($total / (100 + $disValue)) * 100 ) * ($disValue / 100), 2); 
    }

    if ($disPro == 'includeF') {
        $result =  round((($total / (100 + $disValue)) * 100 ), 2); 
    }

    if ($perfect != '') {
        $result = $total - $result;
    }

    return $result;
}

function getKotGstPrice($type = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from kotgstprice where deleteRec = '1'";

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    } else {
        $data = 0;
    }

    if ($type != '') {
        $data = $data[0][$type];
    }

    return $data;
}

function getAddKotProductDetail()
{
    $totalProctPrice = 0;
    $data = [
        'totalProduct' => 0,
        'kotDisPro' => 0,
        'kotDisValue' => 0,
        'subTotal' => 0,
        'tax' => 0,
        'totalPrice' => 0,
        'kotAdvancePay' => 0,
        'kotBalancePay' => 0,
    ];
    if (isset($_SESSION['kot']) && count($_SESSION['kot']) > 0) {
        foreach ($_SESSION['kot'] as $key => $kotList) {
            $id = $key;
            $qty = $kotList['qty'];
            $price = getKotProduct($id)[0]['price'];

            $totalProctPrice += $price * $qty;
        };

        $kotDisPro = isset($_SESSION['kotDiscountProperty']) ? $_SESSION['kotDiscountProperty'] : '';
        $kotDisValue = isset($_SESSION['kotDiscountAmount']) ? $_SESSION['kotDiscountAmount'] : 0;

        $subTotal = getPriceCalculate($kotDisPro, $kotDisValue, $totalProctPrice, 'perfect');
        $taxPrice = 0;
        $kotAdvancePay = 0;

        // if(isset($_SESSION['kotTypeCgst']) && $_SESSION['kotTypeCgst'] == 'true'){
        //     $taxPrice += getPriceCalculate('percentage', getKotGstPrice('cgst') , $subTotal);
        // }
        // if(isset($_SESSION['kotTypeSgst']) && $_SESSION['kotTypeSgst'] == 'true'){
        //     $taxPrice += getPriceCalculate('percentage', getKotGstPrice('sgst') , $subTotal);
        // }
        // if(isset($_SESSION['kotTypeIgst']) && $_SESSION['kotTypeIgst'] == 'true'){
        //     $taxPrice += getPriceCalculate('percentage', getKotGstPrice('igst') , $subTotal);
        // }

        $taxPrice += getPriceCalculate('percentage', 5, $subTotal);

        if (isset($_SESSION['kotAdvaceBalance']) && $_SESSION['kotAdvaceBalance'] != '') {
            $kotAdvancePay = $_SESSION['kotAdvaceBalance'];
        }

        $kotTotalPrice = $subTotal + $taxPrice;

        $kotBalancePay = $kotTotalPrice - $kotAdvancePay;

        $data = [
            'totalProduct' => $totalProctPrice,
            'kotDisPro' => $kotDisPro,
            'kotDisValue' => $kotDisValue,
            'subTotal' => $subTotal,
            'tax' => $taxPrice,
            'totalPrice' => $kotTotalPrice,
            'kotAdvancePay' => $kotAdvancePay,
            'kotBalancePay' => $kotBalancePay,
        ];
    }

    return $data;
}

function getKotOrder($koid = '', $date = '', $page = '', $search = '', $getMaxBillNo = '', $sid = '', $spid = '', $status = '', $bdid = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $date = ($date == '') ? date('Y-m-d') : $date;
    $sql = "select * from kotorder where hotelId = '$hotelId' ";

    if ($getMaxBillNo != '') {
        $sql .= " and billno = (select max(billno) from kotorder)";
    }

    if ($koid != '') {
        $sql .= " and id = '$koid' ";
    }

    if ($date != '') {
        if($date != 'max'){
            $nextDate = date('Y-m-d', strtotime("1 day", strtotime($date)));
            $sql .= " and addOn >= '$date' and addOn <='$nextDate'";
        }
        
    }

    if ($sid != '') {
        $sql .= " and serviceId = '$sid' ";
    }

    if ($spid != '') {
        $sql .= " and servicePropertyId = '$spid' ";
    }

    if ($status != '') {
        $sql .= " and orderStatus = '$status' ";
    }

    if ($bdid != '') {
        $sql .= " and bookingDetailId = '$bdid' ";
    }

    $sql .= " order by id desc";
    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $orginalData = $row;
            $advance = [
                'table' => ($row['serviceId'] == 1) ? getKotTableData($row['servicePropertyId'],'','yes')[0]['name'] : '',
                'guestDetail'=>isset(getGuestDetail('','','','','','','','','',$row['id'])[0]) ?getGuestDetail('','','','','','','','','',$row['id'])[0] : array()
            ];
            $sumAmountArry = getKotPriceActivity($id);
            $data[] = array_merge($orginalData, $sumAmountArry,$advance);
        }
    }

    return $data;
}

function posDetailUpload($posId,$proId,$qty){
    global $conDB;
    $checkQuery = mysqli_query($conDB, "select * from kotorderdetail where orderId = '$posId' and proId = '$proId'");

    if(mysqli_num_rows($checkQuery) > 0){
        $kotDetailSql = "update kotorderdetail set qty = '$qty' where orderId = '$posId' and proId = '$proId'";
    }else{
        $kotDetailSql = "insert into kotorderdetail(orderId,proId,qty) values('$posId', '$proId', '$qty')";
    }
    
    mysqli_query($conDB, $kotDetailSql);
}

function kotReport($type = '', $attr = ''){
    $return = 0;

    if ($attr == 'revenue') {
        if ($type = 'today') {
            foreach (getKotOrder() as $kotItem) {
                $return += $kotItem['totalPrice'];
            }
        }
    }

    if ($attr == 'customer') {
        if ($type = 'today') {
            foreach (getKotOrder() as $kotItem) {
                $return += ($kotItem['totalPerson'] == 0) ? 1 : $kotItem['totalPerson'];
            }
        }
    }


    return $return;
}

function getKotPriceActivity($kid){
    
    $kotPriceArry = getGuestPaymentTimeline('', $kid, '', '', 4);
    $sumAmount = getGuestPaymentTimeline('', $kid, '', '', 4, '', '', 'yes')[0]['sum(amount)'];
    $data = [
        'array' => $kotPriceArry,
        'sumPricePaid' => $sumAmount,
    ];
    return $data;
}

function getKotOrderPrice($date = ''){
    
    $arry = getKotOrder('', $date);
    $price = 0;
    foreach ($arry as $val) {
        $price += $val['totalPrice'];
    }
    return $price;
}

function generateKotOrder($koid){

    $data = getKotOrder($koid)[0];
    $billno = $data['billno'];
    $serviceId = $data['serviceId'];
    $servicePropertyId = $data['servicePropertyId'];
    $billNoHtml = 'kot-' . threeNumberFormat($billno);
    $billToHtml = (count(getServicePropertyListHtml($serviceId, '', $servicePropertyId, 'yes')) > 1) ? getKotService($serviceId)[0]['name'] . '@' . getServicePropertyListHtml($serviceId, '', $servicePropertyId, 'yes')['name'] : getKotService($serviceId)[0]['name'];
    $data2 = [
        'billNoHtml' => $billNoHtml,
        'billToHtml' => $billToHtml,
    ];

    return array_merge($data, $data2);
}

function getKotOrderDetail($koid = ''){
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from kotorderdetail where orderId = '$koid'";


    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $getKotProductDetail = getKotProduct($row['proId'])[0];
            $data[] = [
                'qty' => $row['qty'],
                'note' => $row['note'],
                'proId' => $row['proId'],
                'proName' => $getKotProductDetail['name'],
                'proPrice' => $getKotProductDetail['price'],
            ];
        }
    } else {
        $data[] = [
            'qty' => '',
            'note' => '',
            'proName' => '',
            'proPrice' => ''
        ];
    }

    return $data;
}

function getKotOrderGuestDetail($kgid = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from kotguestdetail where hotelId = '$hotelId' ";

    if ($kgid != '') {
        $sql .= " and id = '$kgid'";
    }


    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    } else {
        $data = 0;
    }

    return $data;
}

function getKotTableData($tid = '', $name = '', $kotSearch = '', $sName = '', $status = '', $delete = '', $order = '', $orderby = '', $date = '',$except='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $date = ($date == '') ? date('Y-m-d') : $date;
    $sql = "select * from kottable where hotelId = '$hotelId' ";


    if ($delete != '') {
        $sql .= '';
    } else {
        $sql .= 'and deleteRec = 1';
    }

    if ($status != '') {
        $sql .= '';
    } else {
        $sql .= " and status = '1'";
    }

    if ($sName != '') {
        $sql .= " and tableNum = '$sName'";
    }

    if ($tid != '') {
        $sql .= " and id = '$tid' ";
    }

    if ($except != '') {
        $sql .= " and id != '$except' ";
    }

    if ($name != '') {
        $sql .= " and tableNum like '%$name%'";
    }

    $sql .= " order by tableNum asc";

    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            if ($kotSearch != '') {
                $data[] = [
                    'id' => $row['id'],
                    'name' => $row['tableNum'],
                ];
            } else {
                $posOrderArry = getKotOrder('', $date, '', '', '', 1, $id, 0);
                $orderDataId = (isset($posOrderArry[0])) ? $posOrderArry[0]['id'] : '';
                $posOrderPrice = (isset($posOrderArry[0])) ? $posOrderArry[0]['totalPrice'] : array();
                $orderData = count($posOrderArry);
                $addArry = ['posOrderId' => $orderDataId,'posOrderPrice' => $posOrderPrice, 'orderCount' => $orderData];
                $data[] = array_merge($row, $addArry);
            }
        }
    }

    return $data;
}

function restartKot(){
    unset($_SESSION['kotServiceProperty']);
    unset($_SESSION['existPOSOrderId']);
    unset($_SESSION['kotGuestDetail']);
    unset($_SESSION['kotTotalGuest']);
    unset($_SESSION['kotWaiter']);
    unset($_SESSION['kotNotes']);
    unset($_SESSION['kot']);
}

function getKotOrderStatus($id = '')
{
    global $conDB;

    $sql = "select * from kotorderstatus";

    if ($id != '') {
        $sql .= " where id = '$id'";
    }


    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
    } else {
        $data = 0;
    }

    return $data;
}

function getServicePropertyListHtml($serviceId, $sdata = '', $serProId = '', $arry = '')
{

    $serviceDataArry = getKotService($serviceId)[0];
    $result = '';

    $dataArry = array();
    $active = '';
    $currennt_date = date('Y-m-d');
    if ($serviceDataArry['bdTable']  == 'kottable') {
        $dataArry  = getKotTableData($serProId, $sdata, 'kotSearch', '', '', '', 'asc', 'tableNum');
    }

    if ($serviceDataArry['bdTable']  == 'room') {
        $dataArry  = getRoomNumber('', '', '', '', '', '', $serProId, '', $sdata, 'kotSearch');
    }

    if ($serviceDataArry['bdTable']  == 'serviceList') {
        $dataArry  = getSysDeliveryService();
    }

    if ($arry != '') {
        $result = (count($dataArry) > 0) ?  $dataArry[0] : array();
    } else {
        if ($dataArry != 0) {
            foreach ($dataArry as $list) {
                $id = $list['id'];
                $name = $list['name'];
                if (isset($_SESSION['kotServiceProperty']) && $_SESSION['kotServiceProperty'] != '') {
                    $active = '';
                    if ($id == $_SESSION['kotServiceProperty']) {
                        $active = 'active';
                    }
                }
                $bookStatus = '';
                if (count(getKotOrder('', date('Y-m-d'), '', '', '', $serviceId, $id, '0')) > 0) {
                    $bookStatus = 'book';
                    $active = '';
                }
                $exist = '';
                if ($serviceId == 2) {
                    $exist = 'vacant';
                    if (countBookingRow('inHouse', $currennt_date, '', '', $name) > 0) {
                        $exist = 'exist';
                    }
                }

                $result .= "<li class='kotServiceTableId $active $bookStatus $exist' data-sid='$serviceId' data-tid='$id'><span>$name</span></span>";
            }
        }
    }


    return $result;
}

function getRupeesFormat($num)
{
    // $num = round($num);
    $rupees = number_format($num, 2);
    if ($num == 0) {
        $rupees = '0.00';
    }
    return $rupees;
}


function posInvoiceReceipt($orderId)
{
    $hotelName = ucfirst(hotelDetail()['hotelName']);
    $hotelLogo = hotelDetail()['fullKotLogoUrl'];

    $guestName = '';
    $guestEmail = '';
    $guestPhone = '';
    $kotOrderDetailArry = array();

    $kotOrderArry = getKotOrder($orderId)[0];
    if (isset(getGuestDetail('', '', '', '', '', '', '', $orderId)[0])) {
        $kotOrderGuestArry = getGuestDetail('', '', '', '', '', '', '', $orderId)[0];
        $kotOrderDetailArry = getKotOrderDetail($orderId);
        $guestName = ucfirst($kotOrderGuestArry['name']);
        $guestEmail = $kotOrderGuestArry['email'];
        $guestPhone = $kotOrderGuestArry['phone'];
    }


    $serviceId = $kotOrderArry['serviceId'];
    $serviceName = getKotService($serviceId)[0]['name'];
    $servicePropertyId = $kotOrderArry['servicePropertyId'];
    $serviceProName = (count(getServicePropertyListHtml($serviceId, '', $servicePropertyId, 'arry')) > 1) ? getServicePropertyListHtml($serviceId, '', $servicePropertyId, 'arry')['name'] : '';
    $serviceProNameHtml = (count(getServicePropertyListHtml($serviceId, '', $servicePropertyId, 'arry')) > 1) ? "<td style='border-top: none;'>$serviceProName</td>" : '';
    $kotDetailHtml = '';
    $encCod = base64_encode($orderId);
    $url = "https://retrod.in/kot-bill.php?id='$encCod'";
    $qrCodeImg = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$url";

    if (count($kotOrderDetailArry) > 0) {
        foreach ($kotOrderDetailArry as $orderDetail) {
            $proName = ucfirst($orderDetail['proName']);
            $proQty = $orderDetail['qty'];
            $proPrice = $orderDetail['proPrice'];
            $totalPrice = number_format($proPrice * $proQty, 2);
            $kotDetailHtml .= "<tr> <td style='text-align:left'>$proName</td><td>$proQty</td><td style='text-align:right'>&#x20B9; $totalPrice</td></tr>";
        }
    }


    $html = '
    
            <!DOCTYPE html>
            <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        * {
                            font-size: 12px;
                        }
                        
                        td,
                        th,
                        tr,
                        table {
                            border-top: 1px solid black;
                            border-collapse: collapse;
                        }
                        
                        td.description,
                        th.description {
                            width: 75px;
                            max-width: 75px;
                        }
                        
                        td.quantity,
                        th.quantity {
                            width: 40px;
                            max-width: 40px;
                            word-break: break-all;
                        }
                        
                        td.price,
                        th.price {
                            width: 40px;
                            max-width: 40px;
                            word-break: break-all;
                        }
                        
                        .centered {
                            text-align: center;
                            align-content: center;
                        }
                        
                        .ticket {
                            width: 155px;
                            max-width: 155px;
                        }
                        
                        .ticket td{
                            font-size:9px;
                        }
                        .ticket th{
                            font-size:8px;
                        }
                        
                        img {
                            max-width: inherit;
                            width: inherit;
                        }
                        @media print {
                            .hidden-print,
                            .hidden-print * {
                                display: none !important;
                            }
                        }
                    </style>
                </head>

                <body>
                    <div class="ticket">

                        <table style="border-top: none; width: 100%;"><tr style="border-top: none;"><td style="border-top: none;"><img style="width: 45px;" src="' . $hotelLogo . '" /></td></tr></table>
                        <hr/>
                        <table style="border-top: none;" width="100%" ><tr style="border-top: none;"> <td style="border-top: none;">' . $serviceName . '</td> ' . $serviceProNameHtml . '</tr></table>
                        <hr/>
                        <table style="border-top: none;" width="100%" ><tr style="border-top: none;"> <td style="border-top: none;">Name</td><td style="border-top: none;">' . $guestName . '</td></tr><tr style="border-top: none;"> <td style="border-top: none;">Phone</td><td style="border-top: none;">' . $guestPhone . '</td></tr></table>
                        <hr/>
                        <table width="100%" border="1"><tr> <th>Item</th><th>Qty</th><th>Sub Total</th></tr>' . $kotDetailHtml . '</table><center>Thank you for Order!</center>
                        
                    </div>
                </body>

            </html>

    
    
    
    ';

    return $html;
}


function countEmptyFieldPercentageByArry($array = [], $total = '', $remove = [])
{

    if (count($remove) > 0) {
        foreach ($remove as $removeList) {
            unset($array[$removeList]);
        }
    }

    if ($total != '') {
        $totalField = $total;
        $notEmaptyFild = count($array);
    } else {
        $totalField = count($array);
        $notEmaptyFild = count(array_filter($array, function ($x) {
            return !empty($x);
        }));
    }

    return getPercentageValueByAmount($notEmaptyFild, $totalField);
}
function setPaymentTimeline($proId, $proSubId, $accessId, $amount, $paymentMethod = '', $remark = '', $addBy = '', $tip = '',$bid='',$posId='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $addBy = dataAddBy();
    $billNo = generateBillNo();

    $bid = ($bid == '') ? 0 : $bid;
    $posId = ($posId == '') ? 0 : $posId;
    $tip = ($tip == '') ? 0 : $tip;
    $proSubId = ($proSubId == '') ? 0 : $proSubId;

    $data = '';

    if ($amount > 0) {
       $sql = "insert into payment_timeline(hotelId,proId,proSubId,accessId,amount,paymentMethod,remark,addBy,tip,billingNo,bid,posId) values('$hotelId','$proId',$proSubId,'$accessId','$amount','$paymentMethod','$remark','$addBy','$tip','$billNo','$bid','$posId')";
       
        if (mysqli_query($conDB, $sql)) {
            if($bid != 0){
                $bookingDetailArray = getBookingData($bid)[0];
                $userPay = $bookingDetailArray['userPay'];
                $reciptNo = threeNumberFormat($bookingDetailArray['reciptNo']);
                $totalPay = $userPay + $amount;
                $bookingSql = "update booking set userPay= '$totalPay' where id ='$bid'";
                mysqli_query($conDB,$bookingSql);

                $folioLink = generateFolioLink($bid);
                $alert = '<strong>'.$amount.'</strong> payment received from <a class="pClr" target="_blank" href="'.$folioLink.'">#'.$reciptNo.'</a>';  

                setActivityFeed('',4,$bid,'','','','','',$alert);
            }
            $data = 1;
        } else {
            $data = 0;
        }
    }


    return $data;
}

function getGuestPaymentTimeline($pid = '', $accessId = '', $date = '', $method = '', $proId = '', $subProId = '', $hId = '', $sum = '', $sDate = '', $eDate = '', $user = '',$dateFilter='',$bid='',$posId='',$payStatus='',$statusUpdateOn='')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sDate = ($sDate == '') ? date('Y-m-d') . " 00:00:00" :  date('Y-m-d', strtotime($sDate)) . " 00:00:00";
    $eDate = ($eDate == '') ? date('Y-m-d') . " 23:59:59" :  date('Y-m-d', strtotime($eDate)) . " 23:59:59";
    $hId = ($hId == '') ? $hotelId : $hId;

    $sql = '';
    if ($sum != '') {
        $sql .= "select *,sum(amount)";
    } else {
        $sql .= "select *";
    }

    $sql .= " from payment_timeline where id != '' ";

    if ($pid != '') {
        $sql .= " and id = '$pid'";
    }

    if ($hId != '') {
        $sql .= " and hotelId = '$hId'";
    }

    if ($proId != '') {
        $sql .= " and proId = '$proId'";
    }

    if ($subProId != '') {
        $sql .= " and proSubId = '$subProId'";
    }

    if ($accessId != '') {
        $sql .= " and accessId = '$accessId'";
    }

    if ($bid != '') {
        $sql .= " and bid = '$bid'";
    }

    if ($posId != '') {
        $sql .= " and posId = '$posId'";
    }

    if ($method != '') {
        $sql .= " and paymentMethod = '$method'";
    }

    if ($payStatus != '') {
        $sql .= " and payment_status = '$payStatus'";
    }

    if ($statusUpdateOn != '') {
        $sql .= " and statusUpdateOn like '$statusUpdateOn%'";
    }

    if($dateFilter != ''){
        $sql .= " ";
    }else{
        $sql .= " and addOn  >= '$sDate' and  addOn <= '$eDate'";
    }
    

    if ($user != '') {
        $user = "a_" . $user;
        $sql .= " and addBy = '$user'";
    }

    if ($date != '') {
        $sql .= " and addOn like '$date%'";
        $sql .= " order by bid asc";
    } else {
        $sql .= " order by id desc";
    }
    
    $data = array();

    $query = mysqli_query($conDB, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $advance = ['recipt' => ''];
            if ($row['accessId'] != '') {
                if (isset(getBookingData($row['accessId'])[0])) {
                    $bookingDetail = getBookingData($row['accessId'])[0];
                    $bookinId = $bookingDetail['bookinId'];
                    $modeHtml = getPaymentTypeMethod($row['paymentMethod'])[0]['name'];
                    $guestArry = getGuestDetail('', '', $bookingDetail['guestId'])[0];
                    $bookingDetailArry = getBookingDetail('', $bookingDetail['id']);
                    $roomNum = array();
                    foreach ($bookingDetailArry as $item) {
                        $roomNum[] = $item['room_number'];
                    }
                    $advance = [
                        'recipt' => $bookingDetail['reciptNo'],
                        'guestName' => $guestArry['name'],
                        'addByName' => getAddByData($row['addBy'],'yes')['displayName'],
                        'roomNum' => implode(',', $roomNum),
                        'bookinId' => $bookinId,
                        'modeHtml' => $modeHtml,
                    ];
                }
            }
            $data[] = array_merge($row, $advance);
        }
    }

    return $data;
}


function successfullPaymentHtnl($bid)
{
    $checkImg = FRONT_SITE_IMG . 'icon/check.gif';
    $paymentHtml = '';
    foreach (getGuestPaymentTimeline('', $bid) as $paymentList) {
        $amount = number_format($paymentList['amount']);
        $paymentMethod = getPaymentTypeMethod($paymentList['paymentMethod'])[0]['name'];
        $addOn = date('d-M, y', strtotime($paymentList['addOn']));
        $paymentHtml .= '
                <li>
                    <div><span>Amount Paid:</span><span>₹ ' . $amount . '</span></div>
                    <div><span>Payment Method:</span><span>' . $paymentMethod . '</span></div>
                    <div><span>Payment On:</span><span>' . $addOn . '</span></div>
                </li>
        ';
    }
    $html = '
            <div class="successfullyPaymentContent">
                <div class="status">
                    <div class="successIcon">
                        <img src="' . $checkImg . '" >
                    </div>
                    <h4>Payment Successfull!</h4>
                    
                </div>
                <div class="detailBox">
                    <ul>
                        ' . $paymentHtml . '
                    </ul>
                </div>
            </div>
    ';


    return $html;
}




//  Report 

function createTableBodyByArry($data)
{

    $html = '';
    $dataType = gettype($data);

    if ($dataType == 'string') {
        $html .= "<td>$data</td>";
    }

    if ($dataType == 'array') {
        foreach ($data as $key => $val) {
            $html .= "<td style='font-size:14px;padding:5px 10px;text-align:center'>$val</td>";
        }
    }

    return $html;
}

function createTableByArray($data, $head)
{

    $html = '<tr>';
    foreach ($head as $headVal) {
        $html .= "<th style='font-size:14px;padding:5px 10px;text-align:center;background: #c0c0c0;'>$headVal</th>";
    }
    $html .= "</tr> ";

    foreach ($data as $dataVal) {
        $data2 = createTableBodyByArry($dataVal);
        $html .= "<tr>$data2</tr>";
    }


    $response = '';
    if (count($data) > 0) {
        $response = $html;
    }

    return $response;
}



// $action 1 = add on, 2 = check in, 3= check out 

function getRoomChargeHtml($date = '', $action = '1', $user = '')
{
    $date = ($date == '') ? date('Y-m-h') : $date;
    $action = ($action == '') ? '1' : $action;
    $head = ['Room', 'Recive No.', 'Guest', 'Source', 'Company', 'Rent Date', 'Rate Type', 'Normal Rate', 'Coupon', 'Price', 'Tax', 'Checkin By'];

    if ($action == 1) {
        $roomArry = getBookingData('', '', '', '', '', '', '', '', 'roomNum', $date, 'No', $user);
    }

    if ($action == 2) {
        $roomArry = getBookingData('', '', $date, '', '', '', '', '', 'roomNum', '', 'No', 'Yes', $user);
    }

    if ($action == 3) {
        $roomArry = getBookingData('', '', '', '', '', '', '', '', 'roomNum', '', 'No', '', $date, $user);
    }

    $data = array();
    if (count($roomArry) > 0) {
        foreach ($roomArry as $list) {
            // pr($list);
            $roomNum = $list['room_number'];
            $reciptNo = $list['reciptNo'];
            $id = $list['id'];
            $bookingdetailId = $list['bookingdetailId'];
            $roomId = $list['roomId'];
            $roomDId = $list['roomDId'];
            $bookingDetailArry = getBookingDetailById($id, '', $bookingdetailId);
            $guestName = (count(getGuestDetail($id, 1, '', $bookingdetailId)) > 0) ? getGuestDetail($id, 1, '', $bookingdetailId)[0]['name'] : '';
            $company_name = (count(getGuestDetail($id, 1, '', $bookingdetailId)) > 0) ? getGuestDetail($id, 1, '', $bookingdetailId)[0]['company_name'] : '';

            $bookSource = $list['bookingSource'];
            $roomNum = $list['room_number'];
            $ratePlan = (count($bookingDetailArry['roomDetailArry']) > 0) ? $bookingDetailArry['roomDetailArry'][0]['rateplan'][0] : '';
            $addOn = date('d M', strtotime($list['addOn']));
            $normslPrice = $bookingDetailArry['totalPrice'];
            $couponCode = $bookingDetailArry['couponCode'];
            $couponPrice = $bookingDetailArry['couponPrice'];
            $subTotal = $bookingDetailArry['subTotalPrice'];
            $gstPrice = $bookingDetailArry['gstPrice'];
            $bStatusBy = '';

            $data[] = [$roomNum, $reciptNo, $guestName, $bookSource, $company_name, $addOn, $ratePlan, $normslPrice, $couponPrice, $subTotal, $gstPrice, $bStatusBy];
        }
    }


    return createTableByArray($data, $head);
}

function getDailySalesReport($date = '')
{
    $date = ($date == '') ? date('Y-m-d') : $date;
    $reservationTypeArry = getSalesType();
    $salesData = array();
    foreach ($reservationTypeArry as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $getBookingData = getBookingData('', '', '', '', '', '', '', '', '', $date, '', '', '', '', $id);

        $totalRoomPrice = 0;
        $totalTax = 0;
        $totalTotalPrice = 0;
        $totalDiscountPrice = 0;
        $totalExtra = 0;
        foreach ($getBookingData as $val) {
            $bookId = $val['id'];
            $bookingDetailArry = getBookingDetailById($bookId);

            $totalPrice = $bookingDetailArry['totalPrice'];
            $gstPrice = $bookingDetailArry['gstPrice'];
            $totalRoomPrice = $bookingDetailArry['totalRoomPrice'];
            $totalDiscount = $bookingDetailArry['totalDiscount'];
            $totalExtra = $bookingDetailArry['totalExtra'];

            $totalRoomPrice += $totalRoomPrice;
            $totalTax += $gstPrice;
            $totalTotalPrice += $totalPrice;
            $totalExtra += $totalPrice;
            $totalDiscountPrice += $totalDiscount;
        }

        $data[] = [$name, $totalRoomPrice, $totalExtra, $totalTax, $totalDiscountPrice, $totalTotalPrice];
    }
    $data = array();
    // $head = ['Sales Type', 'Room Charges (Rs)', 'Extra Charges (Rs)', 'Tax (Rs)', 'Discount (Rs)', 'Total Sales (Rs)'];
    $head = [];
    return   createTableByArray($data, $head);
}

function getReceiptDetailReport($date = '', $method = '')
{
    $date = ($date == '') ? date('Y-m-d') : $date;
    $receiptArray = getGuestPaymentTimeline('', '', $date, $method);

    $head = ['Date', 'Receipt', 'Reference', 'Amount', 'User', 'Entered On', 'Remark'];
    $methodName = getPaymentTypeMethod($method)[0]['name'];
    $data1 = ["<strong>Pay Method</strong>: $methodName"];
    $data2 = array();
    foreach ($receiptArray as $receiptVal) {
        $addOn = $receiptVal['addOn'];
        $payDate = date('d M', strtotime($addOn));
        $addBy = getAddByData($receiptVal['addBy']);
        $entryTime = date('h:s A', strtotime($addOn));
        $remark = $receiptVal['remark'];
        $amount = $receiptVal['amount'];
        $bid = $receiptVal['bid'];
        $bookingDataArray = getBookingDetailById($bid);
        $reciptNo = $bookingDataArray['reciptNo'];
        $referance = 'Room : ' . $bookingDataArray['roomNum'];

        $data2[] = [$payDate, $reciptNo, $referance, $amount, $addBy, $entryTime, $remark];
    }

    if (count($data2) > 0) {
        $data = array_merge($data1, $data2);
    } else {
        $data = $data1;
    }


    return  createTableByArray($data, $head);
}

function showUserAddForm($id = '')
{
    $userName = '';
    $userNum = '';
    $userEmail = '';
    $userId = '';
    $userPassword = '';
    $btn = 'Add User';
    if ($id != '') {
        $idHtml = "<input value=''/>";
    }

    $userRoleHtml = '';
    foreach (getUserRoleList() as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $userRoleHtml .= "<option value='$id'>$name</option>";
    }
    $html = '
        <form id="userAddForm" method="post" enctype="multipart/form-data">

            <div class="row p0">
                <div class="form_group col-12 col-sm-6 mb-3">
                    <label for="userName">Name</label>
                    <input class="form-control" type="text" id="userName" name="userName" placeholder="Enter User Name." value="' . $userName . '" required>
                </div>
                <div class="form_group col-12 col-sm-6 mb-3">
                    <label for="userPhoneNum">Phone Number *</label>
                    <input class="form-control" type="number" id="userPhoneNum" name="userPhoneNum" placeholder="Enter Phone Number" value="' . $userNum . '" required>
                </div>
            </div>

            <div class="row p0">
                <div class="form_group col-md-6 mb-3">
                    <label for="userEmaiId">Email Id *</label>
                    <input class="form-control" type="email" id="userEmaiId" name="userEmaiId" placeholder="Enter Email Id." value="' . $userEmail . '" required >
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="userRole">Role *</label>
                    <select class="form-control" type="text" id="userRole" name="userRole" required>
                        <option value="0">Select Role</option>
                        ' . $userRoleHtml . '
                    </select>
                </div>
            </div>

            <div class="row p0">
                <div class="form_group col-md-6 mb-3">
                    <label for="userId">User Id *</label>
                    <input class="form-control" type="text" id="userId" name="userId" placeholder="Enter User Id." value="' . $userId . '" required >
                </div>
                <div class="form_group col-md-6 mb-3">
                    <label for="userPassword">Password *</label>
                    <input class="form-control" type="password" id="userPassword" name="userPassword" placeholder="Enter Password." value="' . $userPassword . '" required >
                </div>
            </div>
            
            <button class="btn bg-gradient-primary mb-0 mt-lg-auto deactive" type="submit" name="addUserSubmitBtn"> ' . $btn . ' </button>

        </form>
    ';

    return $html;
}

function userAddFormSubmit($id = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $userName = $_POST['userName'];
    $userPhoneNum = $_POST['userPhoneNum'];
    $userEmaiId = $_POST['userEmaiId'];
    $userRole = $_POST['userRole'];
    $userId = $_POST['userId'];
    $userPassword = $_POST['userPassword'];

    $mainId = hotelDetail('', '', '', '', $hotelId)['id'];
    $addBy = dataAddBy();
    $data = array();
    if (count(getHotelUserDetail('', '', $userId)) > 0) {
        $data = [
            'status' => 'error',
            'msg' => 'Userid Already Exist.'
        ];
    } else {
        $sql = "insert into hoteluser(hotelMainId,name,email,phone,role,userId,password,addBy) values('$mainId','$userName','$userEmaiId','$userPhoneNum','$userRole','$userId','$userPassword','$addBy')";

        if (mysqli_query($conDB, $sql)) {
            $data = [
                'status' => 'success',
                'msg' => 'Success Add User',
            ];
        } else {
            $data = [
                'status' => 'error',
                'msg' => 'Something Wrong!',
            ];
        }
    }


    echo json_encode($data);
    die();
}

function reportContetFun($attr = '')
{
    $curretDate = date('Y-m-d');
    $nextDate = date('Y-m-d', strtotime(' +1 day'));
    if (isset($_POST['attr'])) {
        $attr = $_POST['attr'];
    }
    $html = '';

    if ($attr == 'arrive') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">
                       
        ';
    }

    if ($attr == 'cancelres') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">

        ';
    }

    if ($attr == 'departure') {
        $html = '
            
        <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
        <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">   
        ';
    }

    if ($attr == 'checkin') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">

        ';
    }

    if ($attr == 'checkout') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">

        ';
    }

    if ($attr == 'guestlist') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">        
        ';
    }

    if ($attr == 'inventory') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
        ';
    }

    if ($attr == 'nightaudit') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
        ';
    }

    if ($attr == 'roomava') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">        
        ';
    }

    if ($attr == 'roomstatus') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">        
        ';
    }

    if ($attr == 'tasklist') {
        $html = '
            
            <input name="startDate" type="date" class="customDate" id="startDate" value="' . $curretDate . '">
            <input name="endDate" type="date" class="customDate" id="endDate" value="' . $nextDate . '">        
        ';
    }

    $html .= "
        <div class='btnGroup'>
            <button data-attr='$attr' class='reportBtn dark' id='exportData' >Export</button>
            <button data-attr='$attr' class='reportBtn primary' id='printData' >Report</button>
            <button data-attr='$attr' class='reportBtn' id='resetData'>Reset</button>
        </div>
    ";


    return $html;
}

function displayReport($attr = '', $formDate = '', $toDate = '')
{
    $formDate = ($formDate == '') ? date('Y-m-d') : $formDate;
    $toDate = ($toDate == '') ? $formDate : $toDate;

    $day = getNightByTwoDates($formDate, $toDate);
    $data = array();
    $sn = 0;
    $html = '';


    if ($attr == '' || $attr == 'arrive') {
        $head = ['Res. No', 'Guest', 'Room', 'Rate(Rs)', 'Arrival', 'Departure', 'Pax', 'Company', 'Res.Type', 'Status', 'User'];
        for ($i = 0; $i <= $day; $i++) {
            $oneDate = date("Y-m-d", strtotime($formDate) + (86400 * $i));
            $arrayData = getarriveData($oneDate);
            $data = array_merge($data, $arrayData);
        }
    }

    if ($attr == 'departure') {
        $head = ['Res. No', 'Guest', 'Room', 'Rate(Rs)', 'Arrival', 'Departure', 'Pax', 'Company', 'Res.Type', 'Status', 'User'];
        for ($i = 0; $i <= $day; $i++) {
            $oneDate = date("Y-m-d", strtotime($formDate) + (86400 * $i));
            $arrayData = getarriveData($oneDate, 2);
            $data = array_merge($data, $arrayData);
        }
    }

    if ($attr == 'cancelres') {
        $head = ['Res. No', 'Guest', 'Room', 'Rate(Rs)', 'Arrival', 'Departure', 'Pax', 'Company', 'Res.Type', 'Status', 'User'];
        for ($i = 0; $i <= $day; $i++) {
            $oneDate = date("Y-m-d", strtotime($formDate) + (86400 * $i));
            $arrayData = getarriveData($oneDate, 3);
        }
        $data = array_merge($data, $arrayData);
    }

    if ($attr == 'checkin') {
        $head = ['Res. No', 'Guest', 'Room', 'Rate(Rs)', 'Arrival', 'Departure', 'Pax', 'Company', 'Res.Type', 'Status', 'User'];
        for ($i = 0; $i <= $day; $i++) {
            $oneDate = date("Y-m-d", strtotime($formDate) + (86400 * $i));
            $arrayData = getarriveData($oneDate);
        }
        $data = array_merge($data, $arrayData);
    }

    if ($attr == 'guestlist') {
        $head = ['Res. No', 'Guest', 'Mobile', 'Room', 'Arrival', 'Departure', 'Res.Type', 'Status', 'Add On'];
        $arrayData = array();
        $roomId = '';
        $checkIn = '';
        $checkOut = '';
        $reservationName = '';
        for ($i = 0; $i <= $day; $i++) {

            $oneDate = date("Y-m-d", strtotime($formDate) + (86400 * $i));
            $guestArry = getGuestDetail('', '', '', '', '', $oneDate);

            if (count($guestArry) > 0) {
                $guestArry = $guestArry[0];
                $sn++;
                $bookingArry = getBookingData($guestArry['bookId'])[0];
                $roomId = $bookingArry['roomId'];
                $checkIn = date('d-M', strtotime($bookingArry['checkIn']));
                $checkOut = date('d-M', strtotime($bookingArry['checkOut']));
                $addOn = date('d-M-y', strtotime($guestArry['addOn']));
                $reservationType = $bookingArry['reservationType'];
                $reservationName = (count(getStysBookingType($reservationType)) > 0) ? getStysBookingType($reservationType)[0]['name'] : '';

                $arrayData[] = [$sn, $guestArry['name'], $guestArry['phone'], getRoomList('', $roomId)[0]['header'], $checkIn, $checkOut, $reservationName, '', $addOn];
            }
        }

        $data = array_merge($data, $arrayData);
    }

    if ($attr == 'nightaudit') {
    }

    if ($attr == 'roomava') {
    }

    if ($attr == 'roomstatus') {
    }

    if ($attr == 'tasklist') {
    }



    if (isset($head)) {
        $tableRow = createTableByArray($data, $head);
        if ($tableRow == '') {
            $html = '';
        } else {
            $html = '<table border="1" style="border-collapse: collapse;"> ';

            $html .= $tableRow;

            $html .= '</table>';
        }
    }





    return $html;
}


// function getReceiptSummary($date=''){
//     $userArry = getHotelUserDetail();

//     foreach($userArry as $val){
//         $id = $val['id'];
//         $name = $val['name'];


//     }
// }

function getUserTotalRevenue($date = '', $uid = '')
{
    $bookingArray = getBookingData('', '', '', '', '', '', '', '', '', $date, '', '', '', $uid);
    $totalRev = 0;
    foreach ($bookingArray as $bookVal) {
        $bid = $bookVal['id'];
        $bookAllData = getBookingDetailById($bid);
        $totalPrice = $bookAllData['totalPrice'];
        $totalRev += $totalPrice;
    }

    return $totalRev;
}

function getTotalRevenueByAttr($date = '', $attr = '', $attrVal = '')
{
    $date = ($date == '') ? date('Y-m-d') : $date;
    $revenue = 0;

    if ($attr != '') {
        if ($attr == 'user') {
            $bookingArray = getBookingData('', '', '', '', '', '', '', '', '', $date, '', '', '', $attrVal);
        }
        if ($attr == 'method') {
            $bookingArray = getGuestPaymentTimeline('', '', $date, $attrVal);
        }
    }

    foreach ($bookingArray as $bookVal) {
        $bid = $bookVal['id'];

        if ($attr == 'user') {
            $bookAllData = getBookingDetailById($bid);
            $totalPrice = $bookAllData['totalPrice'];
        }
        if ($attr == 'method') {
            $totalPrice = $bookVal['amount'];
        }

        $revenue += $totalPrice;
    }

    return $revenue;
}

function getNightAuditReportHtml($date = '')
{

    $html = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                <body>
                    <table border="1" style="border-collapse: collapse;"> ';

    if (getRoomChargeHtml($date) != '') {
        $html .= '<tr>
                    <td>Room Charges</td>
                </tr>
            ';
        $html .= getRoomChargeHtml($date);
        $html .= '';
    }

    if (getRoomChargeHtml($date, 2) != '') {
        $html .= '<tr>
                    <td>Checked In</td>
                </tr>
            ';
        $html .= getRoomChargeHtml($date, 2);
        $html .= '';
    }

    if (getRoomChargeHtml($date, 3) != '') {
        $html .= '<tr>
                    <td>Checked Out</td>
                </tr>
            ';
        $html .= getRoomChargeHtml($date, 3);
        $html .= '';
    }

    $html .= '
              <tr>
                  <td>Daily sales</td>
              </tr>';

    $html .= getDailySalesReport($date);
    $html .= '</td></tr>
              <tr>
                  <td>Recipt Detail</td>
              </tr>';

    $html .= getReceiptDetailReport($date);
    $html .= '
                </table>
            </body>
        </html>
    ';



    return $html;
}

function getBookingTimeLine($bid, $bdid = '')
{
    $html = '<div class="timeline timeline-one-side scrollBar">';
    foreach (getActiveFeed('', '', $bid, $bdid) as $item) {
        $bookType = $item['type'];
        $addOn = date('d M h:i A', strtotime($item['addOn']));
        $addByarr = getAddByData($item['addBy'],'arr');
        $addBy = $addByarr['displayName'];
        $oldData = $item['oldData'];
        $changedata = $item['changedata'];

        $sysActiveStatusArry = getSysActivityStatusData($bookType)[0];
        $accessKey = $sysActiveStatusArry['accessKey'];
        $title = $sysActiveStatusArry['title'];
        $svg = $sysActiveStatusArry['svg'];
        $color = $sysActiveStatusArry['color'];

        if ($oldData == null && $oldData == '') {
            $footerActiveHtml = '
                                <div class="dFlex jcsb">
                                    <div>
                                        <h6 style="color: ' . $color . '" class="text-sm font-weight-bold mb-0">' . $title . '</h6>
                                    </div>
                                    <div class="dFlex aie fdc wAuto">
                                        <span class="text-dark font-weight-bold text-xs mt-1 mb-0">' . $addBy . '</span>
                                        <span class="text-secondary font-weight-bold text-xs mt-1 mb-0">' . $addOn . '</span>
                                    </div>
                                </div>';
        } else {
            $footerActiveHtml = '<div class="dFlex jcsb">
                                    <div>
                                        <h6 style="color: ' . $color . '" class="text-sm font-weight-bold mb-0">' . $title . '</h6>
                                        <span class="text-secondary font-weight-bold text-xs mt-1 mb-0">' . $oldData . ' - <strong>' . $changedata . '</strong></span>
                                    </div>
                                    <div class="dFlex aie fdc wAuto">
                                        <span class="text-dark font-weight-bold text-xs mt-1 mb-0">' . $addBy . '</span>
                                        <span class="text-secondary font-weight-bold text-xs mt-1 mb-0">' . $addOn . '</span>
                                    </div>
                                </div>';
        }
        $html .= '
            <div class="timeline-block mb-3">
                <span class="timeline-step" style="color: ' . $color . '">
                    ' . $svg . '
                </span>
                <div class="timeline-content">
                    
                    ' . $footerActiveHtml . '
                </div>
            </div>
        ';
    }

    $html .= '</div>';

    return $html;
}

function getSysActivityStatusData($id = '', $accessKey = '')
{
    global $conDB;
    $sql = "select * from sys_activitystatus where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($accessKey != '') {
        $sql .= " and accessKey = '$accessKey'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getSysSvgIconData($id = '', $name = '', $type = '')
{
    global $conDB;
    $sql = "select * from sys_svg_icon where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($name != '') {
        $sql .= " and name = '$name'";
    }

    if ($type != '') {
        $sql .= " and type = '$type'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

function getHotelSocialLinkData($id = '', $hid = '', $sid = '')
{
    global $conDB;
    $sql = "select * from hotelsociallink where id != ''";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($hid != '') {
        $sql .= " and hotelId = '$hid'";
    }

    if ($sid != '') {
        $sql .= " and slId = '$sid'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $detailArray = getSysSociallinkData($row['slId'])[0];
        $advance = [
            'name'=>$detailArray['name'],
            'icon'=>$detailArray['icon'],
            'color'=>$detailArray['color'],
            'bgClr'=>$detailArray['bgClr'],
            'img'=>$detailArray['img'],
        ];
        $data[] = array_merge($row,$advance);
    }

    return $data;
}

function getRatePlanDetailById($rdid)
{
    global $conDB;
    $sql = mysqli_query($conDB, "select * from roomratetype where id = '$rdid'");
    $data = array();
    $row = mysqli_fetch_assoc($sql);
    $data[] = [
        'rplan' => $row['title'],
        'price' => $row['price']
    ];

    return $data;
}

function getSysSociallinkData($id = '', $exist = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $sql = "select * from sys_sociallink where status = '1'";

    if ($id != '') {
        $sql .= " and id = '$id'";
    }

    if ($exist != '') {
        if ($exist == 'no') {
            foreach (getHotelSocialLinkData('', $hotelId) as $key => $item) {

                $sid = $item['slId'];
                $sql .= "and id != $sid ";
            }
        }
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    return $data;
}

// action=1 means checkin || action = 2 means checkout || action 3 cancel 
function getarriveData($date = '', $action = '')
{
    $date = ($date == '') ? date('Y-m-d') : $date;
    $action = ($action == '') ? 1 : $action;

    if ($action == 1) {
        $roomArry = getBookingData('', '', $date, '', 'yes', '', '', '', 'roomNum', '', 'No', '');
    }

    if ($action == 2) {
        $roomArry = getBookingData('', '', $date, '', 'yes', '', '', '', 'roomNum', '', 'No', '', 'yes');
    }

    if ($action == 3) {
        $roomArry = getBookingData('', '', $date, '', 'yes', '', '', '', 'roomNum', '', 'No', '', '', '', '', '', 'yes');
    }

    $data = array();
    if (count($roomArry) > 0) {
        foreach ($roomArry as $list) {

            $bookingId = generateBooingId($list['id']);
            $roomNum = $list['room_number'];
            $reciptNo = $list['reciptNo'];
            $id = $list['id'];
            $bookingdetailId = $list['bookingdetailId'];
            $roomId = $list['roomId'];
            $roomDId = $list['roomDId'];
            $addBy = $list['addBy'];
            $checkIn = date('d M', strtotime($list['checkIn']));
            $checkOut = date('d M', strtotime($list['checkOut']));
            $bookingDetailArry = getBookingDetailById($id, '', $bookingdetailId);
            // pr($bookingDetailArry);
            $guestName = (count(getGuestDetail($id, 1, '', $bookingdetailId)) > 0) ? ucfirst(getGuestDetail($id, 1, '', $bookingdetailId)[0]['name']) : '';
            $company_name = (count(getGuestDetail($id, 1, '', $bookingdetailId)) > 0) ? getGuestDetail($id, 1, '', $bookingdetailId)[0]['company_name'] : '';

            $bookSource = $list['bookingSource'];
            $roomNum = $list['room_number'];
            $ratePlan = (count($bookingDetailArry['roomDetailArry']) > 0) ? $bookingDetailArry['roomDetailArry'][0]['rateplan'][0] : '';
            $addOn = date('d M', strtotime($list['addOn']));
            $normslPrice = $bookingDetailArry['totalPrice'];
            // $couponCode = $bookingDetailArry['couponCode'];
            // $couponPrice = $bookingDetailArry['couponPrice'];
            $subTotal = $bookingDetailArry['subTotalPrice'];
            $gstPrice = $bookingDetailArry['gstPrice'];
            $bStatusBy = '';
            $pax = $bookingDetailArry['totalAdult'] + $bookingDetailArry['totalChild'];
            $resertionType = getReservationType($list['reservationType'])[0]['name'];
            $checkinstatus = checkGuestCheckInStatus($bookingDetailArry['checkinstatus'])[0]['name'];

            $data[] = [$bookingId, $guestName, $roomNum, $subTotal, $checkIn, $checkOut, $pax, $company_name, $resertionType, $checkinstatus, $addBy];
        }
    }

    return $data;
}

function updateRoomStatus($rnum, $value, $check = '', $constuction = ''){
    $hotelId = HOTEL_ID;
    global $conDB;
    global $time;
    $addBy = dataAddBy();

    $csql = "SELECT constuctionStatus from roomnumber where hotelId = '$hotelId' and roomNo = '$rnum'";
    $result = mysqli_query($conDB, $csql);
    $row = mysqli_fetch_assoc($result);
    $constuctionStatus = $row['constuctionStatus'];

    $roomStatus = getRoomNumber($rnum)[0]['status'];

    if($value == 3){
        mysqli_query($conDB,"insert into housekeeping(hotelId,roomNum,status,addOn,addBy) values('$hotelId','$rnum','$value','$time','$addBy')");
    }elseif($value == 1){       
        $recentArray = getHousekeepingData('',$rnum,'',date('Y-m-d', strtotime($time)))[0];
        $recentId = $recentArray['id'];
        mysqli_query($conDB, "update housekeeping set status = '$value', completeTime='$time' where hotelId = '$hotelId' and id  = '$recentId'");
    }

    if ($constuction != '') {
        if ($check == $constuctionStatus) {
            $sql = "update roomnumber set constuctionStatus = '$value' where hotelId = '$hotelId' and roomNo = '$rnum'";
        } else {
            $sql = "update roomnumber set constuctionStatus = '$check' where hotelId = '$hotelId' and roomNo = '$rnum'";
        }
    } else {
        if ($check == $roomStatus) {
            $sql = "update roomnumber set status = '$value' where hotelId = '$hotelId' and roomNo = '$rnum'";
        } else {
            $sql = "update roomnumber set status = '$check' where hotelId = '$hotelId' and roomNo = '$rnum'";
        }
    }
   

    
    if (mysqli_query($conDB, $sql)) {
        $data = [
            'error' => 'no',
            'msg' => 'Successfully updated status.',

        ];
    } else {
        $data = [
            'error' => 'yes',
            'msg' => 'Something error.'
        ];
    }

    return $data;
}



function getSystemLayout($id = '', $accessKey = '')
{
    $para = array();
    if ($id != '') {
        $para[] = "id='$id'";
    }
    if ($accessKey != '') {
        $para[] = "accessKey='$accessKey'";
    }

    return QueryGen('sys_layout');
}

function setCheckInCheckOutDate($type, $bid, $bdid, $value)
{
    global $conDB;

    $checkBookingData = QueryGen('bookingdetail', ['id' => $bdid])[0];
    $bookCheckIn = $checkBookingData['checkIn'];
    $bookCheckOut = $checkBookingData['checkOut'];
    $date = explode("GMT", $value);

    if ($type == 'checkIn') {
        $night = getNightByTwoDates($bookCheckIn, $bookCheckOut);
        $checkIn = date('Y-m-d', strtotime($date[0]));
        $checkOut = date('Y-m-d', strtotime($date[0] . ' +' . $night . ' day'));
    }

    if ($type == 'checkOut') {
        $checkIn = $bookCheckIn;
        $checkOut = date('Y-m-d', strtotime($date[0]));
    }

    $sql = "update bookingdetail set checkIn = '$checkIn', checkOut = '$checkOut' where id = '$bdid'";

    if (mysqli_query($conDB, $sql)) {
        $data = [
            'error' => 'no',
            'msg' => 'successfully updated.'
        ];
    } else {
        $data = [
            'error' => 'yes',
            'msg' => 'Something error!'
        ];
    }

    return $data;
}


function getKotStockCat($id = '')
{
    $db = 'kot_stock_category';
    $data = array();

    if ($id != '') {
        $data[] = ['id' => $id];
    }

    $order = 'name asc';


    return QueryGen($db, $data, $order);
}


function stockFormContent($id = '')
{

    $proUnitHtml = '';
    foreach (getKotQtyUnitList() as $unitItem) {
        $id = $unitItem['id'];
        $name = ucfirst($unitItem['name']);
        $proUnitHtml .= "<option value='$id'>$name</option>";
    }

    $proCatHtml = '';
    foreach (getKotStockCat() as $catItem) {
        $id = $catItem['id'];
        $name = ucfirst($catItem['name']);
        $proCatHtml .= "<option value='$id'>$name</option>";
    }

    $html =
        '<div class="row align-items-end">
            <div class="form-group col-md-4">
                <label for="product_name">Product Name</label>
                <input class="form-control" type="text" name="product_name" id="product_name">
            </div>

            <div class="form-group col-md-4">
                <label for="proCalculateBy">Product Calculate By</label>
                <select class="form-control" name="proCalculateBy" id="proCalculateBy">
                    ' . $proUnitHtml . '
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="proCategoryBy">Product Category</label>
                <select class="form-control" name="proCategoryBy" id="proCategoryBy">
                    ' . $proCatHtml . '
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="stockQty">Quantity in </label>
                <input class="form-control" type="text" name="stockQty" id="stockQty">
            </div>

            <div class="form-group col-md-6">
                <label for="stockPrice">Price</label>
                <input class="form-control" type="text" name="stockPrice" id="stockPrice">
            </div>       

            <div class="form-group col-md-4">
                <label for="productImageCheck" style="display:block">Want to insert Product Image</label>
                <input type="checkbox" name="productImageCheck" id="productImageCheck">
            </div>

            <div class="col-md-8">
                <div class="form-group productImageCon"><input class="form-control" type="file" name="productImage[]" id="productImage"></div>
            </div>
            
        </div>';

    return $html;
}


function activityGenerate($data)
{

    $type = $data['type'];
    $addBy = $data['addBy'];
    $h4 = '';
    $addOn = date('d-M, h:i A', strtotime($data['addOn']));
    $btnCls = '';

    $typeArry = getSysActivityStatusData($type)[0];
    $btnName = $typeArry['title'];
    $clr = $typeArry['color'];
    $reason = $data['reason'];

    if ($type == 'reservation') {
        $bid = $data['bid'];
        $bdid = $data['bdid'];
        $bookingType = $data['type'];      

        $bookinArry = getBookingDetailById($bid);
        $guestName = ucfirst($bookinArry['name']);
        $reciptNo = threeNumberFormat($bookinArry['reciptNo']);

        foreach ($bookinArry['roomDetailArry'] as $roomList) {
            $roomNameArray[] = $roomList['roomName'];
        }

        $roomName = implode(' & ', array_unique($roomNameArray));

        if ($bookingType == 6) {
            $btnName = "New Booking";
            $btnCls = "newBook";
        } elseif ($bookingType == 2) {
            $btnName = "Check In";
            $btnCls = "checkin";
        } elseif ($bookingType == 3) {
            $btnName = "Check Out";
            $btnCls = "checkout";
        }

        
    } else {
        $addByData = getAddByData($addBy, 'yes');
        $user = $addByData['user'];
        $name = $addByData['name'];
    }

    $h4 = '<h4>'.$reason.'</h4>';

    $html = '<li>
                <div class="d-flex align-item-center">
                    <div class="leftSide">
                        ' . $h4 . '
                        <p>' . $addOn . '</p>
                    </div>
                    <div class="rightSide">
                        <span class="actionFeedBtn" style="color:'.$clr.'">' . $btnName . '</span>
                    </div>
                </div>
            </li>';

    return $html;
}


function createSelectItem($data, $select = '', $existData = '')
{
    $ratePlanHtml = '';
    // $existDataArry = explode(',', $existData);
    $existDataArry = array();

    foreach ($data as $val) {
        $id = $val['id'];

        $name = $val['srtcode'];
        $check = "";
        $exist = "";
        if (in_array($id, $existDataArry)) {
            $exist = "disabled";
        }
        if ($select == $id) {
            $check = "selected";
        }
        if ($existDataArry != '') {
            $ratePlanHtml .= '<option ' . $exist . ' value="' . $id . '"  ' . $check . '>' . $name . '</option>';
        } else {
            $existDataArry = explode(',', $_SESSION['ratePlanCon']);
            if (!in_array($id, $existDataArry)) {
                $ratePlanHtml .= '<option value="' . $id . '"  ' . $check . '>' . $name . '</option>';
            }
        }
    }

    return $ratePlanHtml;
};

function createRatePlanInputField($rid = '', $rdid = '', $rpid = '', $sPrice = '', $dPrice = '', $exAPrice = '', $exCPrice = '', $existrpArry = '')
{
    $hotelId = HOTEL_ID;
    $ratePlanHtml = createSelectItem(getPropertyRatePlaneList('', $hotelId, '', 'yes'), $rpid, $existrpArry);
    $sprice = $sPrice;
    $dprice = $dPrice;
    $eAdult = $exAPrice;
    $eChild = $exCPrice;

    $uniqeId = unique_id(4);
    $html =

        '
            <div class="ratePlaneContent hide" id="' . $uniqeId . '">
                <div class="row">
                    <input type="hidden" name="room_detail_id[]" value="' . $rdid . '">
                    <div class="row p0" style="align-items: center;">
                        <div class="form_group col-md-4 mb-3">
                            <label for="title' . $uniqeId . '">Rate Plan</label>
                            <select class="form-control" id="title' . $uniqeId . '" name="title[]" >
                                <option value="">Select Plan</option>
                                ' . $ratePlanHtml . '
                            </select>
                        </div>

                        <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                            <label for="singlePrice' . $uniqeId . '"><i class="bi bi-person"></i> Single occupancy</label>
                            <input class="form-control" type="number" id="singlePrice' . $uniqeId . '" name="singleRoomPrice[]" placeholder="Enter Price." value="' . $sprice . '">
                        </div>

                        <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                            <label for="doblePrice' . $uniqeId . '"><i class="bi bi-people"></i> Double occupancy</label>
                            <input class="form-control" type="number" id="doblePrice' . $uniqeId . '" name="doubleRoomPrice[]" placeholder="Enter Price." value="' . $dprice . '">
                        </div>

                        <div class="col-md-2"><a class="deleteRatePlan" href="javascript:void(0)" data-target="' . $uniqeId . '" data-rdid="' . $rpid . '"><div class="btn delete">Remove</div></a></div>

                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                            <div class="form_group">
                                <label for="">Extra charge of Adult</label>
                                <input class="form-control" type="number" id="" name="extraAdult[]" placeholder="Enter Extra charge of Adult" value="' . $eAdult . '">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                            <div class="form_group">
                                <label for="">Extra charge of Child</label>
                                <input class="form-control" type="number" id="" name="extraChild[]" placeholder="Enter Extra charge of Child" value="' . $eChild . '">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    ';

    return $html;
}



function phonePePaymentGatway($mid, $salt, $indexId, $paymentId, $amount, $mobile = '', $email=''){

    $merchantTransactionId = $paymentId;

    $amount = $amount * 100;

    $pay = [
        "merchantId" => $mid,
        "merchantTransactionId" => $merchantTransactionId,
        "merchantUserId" => $merchantTransactionId,
        "amount" => $amount,
        "redirectUrl" => "https://test.retrod.in/phonepe/thank-you.php",
        "redirectMode" => "POST",
        "callbackUrl" => "https://test.retrod.in/phonepe/callback.php",
        "mobileNumber" => $mobile,
        "paymentInstrument" => ["type" => "PAY_PAGE"]
    ];

    $phonepay_payload = json_encode($pay);
    $phonepay_base64_payload = base64_encode($phonepay_payload);
    $xVerify = $phonepay_base64_payload . "/pg/v1/pay" . $salt;
    $xVerify = hash('sha256', $xVerify) . "###$indexId";


    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode(['request' => $phonepay_base64_payload]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: {$xVerify}",
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


    // if ($err) {
    // echo "cURL Error #:" . $err;
    // } else {
    //     echo "<pre/>";
    //     print_r(json_decode($response));
    // }

    return json_decode($response);
}


function setPaymentLinkGenerate($pid = '', $proId = '0', $accessId = '0', $perName = '', $perEmail = '', $perPhone = '', $paymentAmount = '', $paymentReason = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $linkIdCode = (count(getHotelServiceData('', $hotelId, 6)) > 0) ? getHotelServiceData('', $hotelId, 6)[0]['voucher'] : '';
    $paymentId = "$linkIdCode-" . rand(100, 999999);
    $data = array();
    
    if ($paymentAmount == '') {
        $data = [
            'status' => 'error',
            'msg' => 'Amount is required.',
            'link' => '',
        ];
    } else {

        $payentLink = generatePaymentLink($paymentId, $paymentAmount, $perPhone, $perEmail);

        $paymentStatus = $payentLink->success;

        $paymentLink = $payentLink->data->instrumentResponse->redirectInfo->url;

        if ($paymentStatus == 1) {
            if ($pid == '') {
                $oldDataArry = array();
                $changeDataArry = array();
                $sql = "insert into payment_link(hotelId,proId,paymentId,`accessId`,name,email,phone,amount,reason,paymentLink) values('$hotelId','$proId','$paymentId','$accessId','$perName','$perEmail','$perPhone','$paymentAmount','$paymentReason','$paymentLink')";
            } else {
                $paymentLinkArry = getPaymentLink($pid)[0];
                $oldDataArry = [
                    'name' => $paymentLinkArry['name'],
                    'email' => $paymentLinkArry['email'],
                    'phone' => $paymentLinkArry['phone'],
                    'amount' => $paymentLinkArry['amount'],
                    'reason' => $paymentLinkArry['reason'],
                ];
                $sql = "update payment_link set paymentId='$paymentId', name='$perName',email='$perEmail',phone='$perPhone',amount='$paymentAmount',reason='$paymentReason',paymentLink='$paymentLink' where id = '$pid'";
                $changeDataArry = [
                    'name' => $perName,
                    'email' => $perEmail,
                    'phone' => $perPhone,
                    'amount' => $paymentAmount,
                    'reason' => $paymentReason,
                ];
            }


            if (mysqli_query($conDB, $sql)) {
                setActivityFeed('', 15, $accessId, '', json_encode($oldDataArry), json_encode($changeDataArry));
                $paymentId = mysqli_insert_id($conDB);
                $data = [
                    'status' => 'success',
                    'msg' => 'Successfully create payment link.',
                    'amount' => $paymentAmount,
                    'link' => $paymentLink,
                    'paymentId' => $paymentId,
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'msg' => 'Something went wrong!',
                    'amount' => '',
                    'link' => '',
                    'paymentId' => '',
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'msg' => 'Something went wrong !',
                'amount' => '',
                'link' => '',
                'paymentId' => '',
            ];
        }
    }

    return $data;
}

function generatePaymentLink($paymentId, $amount, $mobile = '', $email = ''){
    $payrollArray = geyPayRoll()[0];
    $getwayId = $payrollArray['getwayId'];
    $keyId = $payrollArray['keyId'];
    $keySecret = $payrollArray['keySecret'];
    $env = $payrollArray['env'];
    $keyIndex = $payrollArray['keyIndex'];


    if ($getwayId == 5) {
        $data = phonePePaymentGatway($keyId, $keySecret, $keyIndex, $paymentId, $amount, $mobile, $email);
    }
    return $data;
}


function amenitiesFilter($array)
{

    $atitle = $array['title'];
    $aimg = $array['img'];

    $data = $array['data'];
    $dataTitle = $data['title'];
    $dataImg = $data['img'];

    $title = ($atitle == '') ? $dataTitle : $atitle;
    $img = ($aimg == 0) ? $dataImg : $aimg;


    $data = [
        'hotelAID' => $array['id'],
        'title' => $title,
        'img' => $img,
    ];

    return $data;
}

function getBeGalleryCategory($gid = '', $limit = '', $delete = '', $orderBy = '', $orderIn = '', $checkName = '', $notId = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $sql = "select * from be_gallery_category where hotelId='$hotelId' ";

    if ($delete != '') {
        $sql .= "";
    } else {
        $sql .= " and deleteRec = '1'";
    }

    if ($gid != '') {
        $sql .= " and id = '$gid' ";
    }

    if ($checkName != '') {
        $sql .= " and name = '$checkName' ";
    }

    if ($notId != '') {
        $sql .= " and id != '$notId' ";
    }

    if ($orderBy != '') {
        $sql .= "  order by $orderBy $orderIn";
    } else {
        $sql .= "  order by id DESC";
    }


    if ($limit != '') {
        $sql .= " limit $limit";
    }

    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function getBeKotCategory($id = '', $name = '', $order = ''){
    global $conDB;
    $hotelId = HOTEL_ID;
    
    $sql = "select * from kotprouct_cat where hotelId='$hotelId' and deleteRec = '1'";

    if ($id != '' && $id != 0) {
        $sql .= " and id = '$id' ";
    }

    if ($name != '') {
        $sql .= " and name = '$name' ";
    }

    if ($order == 'name') {
        $sql .= " order by name asc";
    } else {
        $sql .= " order by id desc";
    }


    $sql = mysqli_query($conDB, $sql);
    $data = array();

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}



function getKotRestaurantData($id = '', $hid = '')
{
    $array = array();
    $array[] = ['deleteRec' => 1];

    if ($id != '') {
        $array[] = ['id' => $id];
    }

    if ($hid != '') {
        $array[] = ['hotelId' => $hid];
    }

    return QueryGen('kot_restaurant', $array);
}


function kotGuestForm($gname = '',$gemail = '',$gphone = ''){

    if($gname == ''){
        if (isset($_SESSION['kotGuestDetail'])) {
            $guestArray = $_SESSION['kotGuestDetail'];
            $gname = $guestArray['name'];
            $gemail = $guestArray['email'];
            $gphone = $guestArray['phone'];
        }
    }
    


    $html = '
        <form action="" id="personConformationForm">
            <div class="form-group"><label for="personName">Person Name *</label>
            <input type="text" name="personName" id="personName" class="form-control" placeholder="Enter Name" value="' . $gname . '"></div>
            <div class="form-group"><label for="personNumber">Person Phone Number *</label>
            <input type="number" name="personNumber" id="personNumber" class="form-control" placeholder="Enter Phone Number" value="' . $gphone . '"></div>
            <div class="form-group"><label for="personEmail">Person Email Id</label>
            <input type="email" name="personEmail" id="personEmail" class="form-control" placeholder="Enter Email Id" value="' . $gemail . '"></div>
        </form>
    ';

    return $html;
}


function posReportMake($fDate='',$eDate=''){
    $fDate = ($fDate == '') ? date('Y-m-d') : $fDate;
    $eDate = ($eDate == '') ? $fDate : $eDate;
    $begin = new DateTime( $fDate );
    $end   = new DateTime( $eDate );

    $data = array();

    $successOrder = 0;
    $cancelledOrder = 0;
    $complimentaryOrder = 0;
    $totalTurnAroundTime = 0;
    $totalMenus = 0;
    $totalOders = 0;
    $totalRevenue = 0;
    $totalCustomers = 0;

    $cardPayment = 0;
    $upiPayment = 0;
    $casePayment = 0;
    $bankPayment = 0;
    $otherPayment = 0;

    for($i = $begin; $i <= $end; $i->modify('+1 day')){
        $currentDate =  $i->format("Y-m-d");
        $posOrderArray = getKotOrder('',$currentDate);
        foreach($posOrderArray as $itemDetail){
            $posId = $itemDetail['id'];
            $posOrderDetailArry = getKotOrderDetail($posId);
            $orderStatus = $itemDetail['orderStatus'];
            $orderType = $itemDetail['orderType'];
            $turnAroundTime = $itemDetail['turnAroundTime'];
            $settlementAmount = $itemDetail['settlementAmount'];
            $totalPerson = $itemDetail['totalPerson'];
            $menus = count($posOrderDetailArry);
            
            $totalOders ++;

            if($orderStatus == 5){
                $successOrder ++;
                $paymentTimeLineArray = getGuestPaymentTimeline('',$posId,'','',4,'','','','','','','no');
                if(isset($paymentTimeLineArray[0])){
                    $paymentMethod = $paymentTimeLineArray[0]['paymentMethod'];
                    $amount = $paymentTimeLineArray[0]['amount'];

                    if($paymentMethod == '2' || $paymentMethod == '3'){
                        $cardPayment += $amount;
                    }

                    if($paymentMethod == '4'){
                        $bankPayment += $amount;
                    }

                    if($paymentMethod == '5'){
                        $upiPayment += $amount;
                    }

                    if($paymentMethod == '6'){
                        $casePayment += $amount;
                    }

                    if($paymentMethod == '8'){
                        $otherPayment += $amount;
                    }
                }
            }

            if($orderStatus == 4){
                $cancelledOrder ++;
            }

            $totalTurnAroundTime += $turnAroundTime;
            $totalMenus += $menus;
            $totalRevenue += $settlementAmount;
            $totalCustomers += $totalPerson;
            
        }
        
    }

    $data = [
        'successOrder'=>$successOrder,
        'cancelledOrder'=>$cancelledOrder,
        'complimentaryOrder'=>$complimentaryOrder,
        'turnAroundTime'=>$totalTurnAroundTime,
        'totalMenus'=>$totalMenus,
        'totalOders'=>$totalOders,
        'totalRevenue'=>$totalRevenue,
        'totalCustomers'=>$totalCustomers,
        'collection'=>[
            ['amount'=>$bankPayment,'name'=> 'Bank'],
            ['amount'=>$cardPayment,'name'=> 'Card'],
            ['amount'=>$casePayment,'name'=> 'Cash'],
            ['amount'=>$bankPayment,'name'=> 'Bank'],
            ['amount'=>$otherPayment,'name'=> 'Other'],
        ]
    ];
    
    return $data;
}

function orderEmail2Body($oid){
    
    $hotelDetailArray = fetchData('hotel', ['hCode'=>$_SESSION['HOTEL_ID']])[0];
    $hotelprofileArray = fetchData('hotelprofile', ['hotelId'=>$_SESSION['HOTEL_ID']])[0];
    $proLocarion = fetchData('propertylocation', ['hotelId'=>$_SESSION['HOTEL_ID']])[0];
    $guestArray = (isset(fetchData('guest', ['bookId'=>$oid, 'groupadmin'=> 1])[0])) ? fetchData('guest', ['bookId'=>$oid, 'groupadmin'=> 1])[0] : array();
    $onlyBookingArray = fetchData('booking', ['id'=>$oid])[0];
    $travelagent = $onlyBookingArray['travelagent'];
    
    $name = (isset($guestArray['name'])) ? $guestArray['name']: '';
    $email = (isset($guestArray['email'])) ? $guestArray['email']: '';
    $phoneNumber = (isset($guestArray['phone'])) ? $guestArray['phone'] : '';
    $company_name = (isset($guestArray['company_name']))?$guestArray['company_name'] : '';
    $gst = (isset($guestArray['comGst'])) ? $guestArray['comGst'] : '';
    
    $userPay = $onlyBookingArray['userPay'];
    $grossCharge = $onlyBookingArray['totalPrice'];
    $payStatus = $onlyBookingArray['payment_status'];
    $add_on = date('d M, Y g:i A', strtotime($onlyBookingArray['add_on']));
    $payment_id = $onlyBookingArray['payment_id'];
    $bookingSource = $onlyBookingArray['bookingSource'];

    $payStatusArray = fetchData('payment_status', ['id'=>$payStatus])[0];

    $payment_status = $payStatusArray['name'];


    $sitename = SITE_NAME;
    $bookingSite = FRONT_BOOKING_SITE;

    $logo = (isset(getHotelImageData('','','','',$hotelprofileArray['darklogo'])[0]['fullUrl'])) ? getHotelImageData('','','','',$hotelprofileArray['darklogo'])[0]['fullUrl'] : 'https://retrod.in/asset/img/demo-hotel.png';
    
    $hotelName = $hotelDetailArray['hotelName'];



    $roomdetailsHtml='';
    

    $bookingDetailArry = getBookingDetailById($oid);
    
    $total_price = $bookingDetailArry['totalPrice'];
    $gst_price = $bookingDetailArry['gstPrice'];;
    $couponBalance = 0;
    $paymentBackupHtml = '';
    $sn = 0;
    $bookingStatus = '';
    
    foreach ($bookingDetailArry['roomDetailArry'] as $bidrow) {
        $sn ++;
        $roomName = $bidrow['roomName'];
        $roomPrice = $bidrow['room'];
        $couponPrice = $bidrow['couponPrice'];
        $adult = $bidrow['adult'];
        $child = $bidrow['child'];
        $adultPrice = $bidrow['adultPrice'];
        $childPrice = $bidrow['childPrice'];
        $gstPer = $bidrow['gstPer'];
        $gstPrice = ($bidrow['gstPrice'] == 0) ? 0 : '&#x20b9; '.$bidrow['gstPrice'];
        $couponPriceHtml = '';
        $bookingStatus = $bidrow['bookingStatus'];
        $plan =$bidrow['rateplan'][0];
        $total = $bidrow['total'];
        $discount = ($bookingDetailArry['totalDiscount'] == 0) ? 0 : '&#x20b9; '.$bookingDetailArry['totalDiscount'];

        $extraCharge = 0.00;

        if($travelagent == '' || $travelagent == 'other'){
            $roomdetailsHtml.='
                <tr>
                    <td>
                        '.$sn.'. Room Type :'. $roomName.'
                    </td>

                    <td>Room Rate:</td>
                    
                    <td>&#x20b9; '. $roomPrice.'</td>
                </tr>

                <tr>
                    <td>
                        Plan: '. $plan.'
                    </td>
                    <td>Discount:</td>
                    <td>'. $discount.'</td>
                </tr>

                <tr>
                    <td>
                        Adult: '. $adult.'
                    </td>
                    <td>Extra Charge:</td>
                    <td>'. $extraCharge.'</td>
                </tr>

                <tr>
                    <td>Child: '. $child.'</td>
                    <td>Tax:</td>
                    <td>'. $gstPrice.'</td>
                </tr>

                <tr>
                    <td></td>
                    <td>Total:</td>
                    <td>&#x20b9; '. $total.'</td>
                </tr>

                <tr style="height: 10px;">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>          
            
        ';
        }else{
            $roomdetailsHtml.='
                <tr>
                    <td>
                        '.$sn.'. Room Type :'. $roomName.'
                    </td>
                </tr>

                <tr>
                    <td>
                        Plan: '. $plan.' , Adult: '. $adult.' , Child: '. $child.'</td>
                    </td>
                </tr>

                <tr style="height: 10px;">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>          
            
        ';
        }

        
    }

    $reservationNumber = printBooingId($oid);
    $date = date('Y-m-d');
    $hotelMail=ucfirst($hotelDetailArray['hotelEmailId']);
    $hotelPhonenumber = ucfirst($hotelDetailArray['hotelPhoneNum']);
    $hotelWebsite = ucfirst($hotelDetailArray['website']);
    $hotelAdd = ucfirst($proLocarion['address']);

    $hotelDetails = '';

    $hotelDetails.='<p>'.$hotelAdd.'</p>';
    $hotelDetails.='<p>'.$hotelPhonenumber.'</p>';
    $hotelDetails.='<p>'.$hotelMail.'</p>';
    $hotelDetails.='<p>'.$hotelWebsite.'</p>';


    $bookedOn = $add_on;
    $arrivalDate = date('d-M', strtotime($bookingDetailArry['checkIn']));
    $departureDate = date('d-M', strtotime($bookingDetailArry['checkOut']));
    $night = $bookingDetailArry['night'];
    
    $totalRoom = 2;
    $bookingType = getBookingSource($bookingSource)[0]['name'];



    $total = $total_price;
    $paid = $userPay;
    $ToBePay = $total - $paid;


    if($travelagent == '' || $travelagent == 'other'){
        $footerPrice = '
            <hr>
            <table style="width:100%; border-collapse:collapse;">
                <tbody>
                    <tr style="width: 100%;">
                        <td style="width: 33%;">
                            <h3>Grand Total: &#x20b9; '. $total.'</h3>
                        </td>
                        <td style="width: 33%;">
                            <h3>Total Advances: &#x20b9; '. $paid.'</h3>
                        </td>
                        <td style="width: 33%;">
                            <h3>Est. Balance: &#x20b9; '. $ToBePay.'</h3>
                        </td>
                    </tr>
                </tbody>

            </table>
        ';
    }else{
        $footerPrice = '';
    }

        $html = '
            <table style="width: 95%; border:2px solid black; margin: 0 auto;">
                <tbody>

                    <tr>
                        <td>


                            <table style="width:100%; border-collapse :collapse;">
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">
                                            <img src="'.$logo.'" alt="logo">
                                            <p>Reservation number: '. $reservationNumber.'</p>
                                        </td>
                                        <td style="width: 60%; text-align: center;">
                                            <h1>'. $hotelName.'</h1>
                                            '. $hotelDetails.'
                                        </td>
                                        <td style="width: 20%;">
                                            <p>Date:'. $date.'</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr style=" height: 3px; background: black;">

                            <table style="width:100%; border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>Guest Information</h3>
                                        </td>
                                        <td>
                                            <h3>Stay Information</h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table style="width:100%; border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>'. $name.'</td>
                                        <td>Booking Status:</td>
                                        <td>'. $bookingStatus.'</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number::</td>
                                        <td>'. $phoneNumber.'</td>
                                        <td>Booked On:</td>
                                        <td>'. $bookedOn.'</td>
                                    </tr>
                                    <tr>
                                        <td>Email::</td>
                                        <td>'. $email.'</td>
                                        <td>Arrival Date:</td>
                                        <td>'. $arrivalDate.'</td>
                                    </tr>
                                    <tr>
                                        <td>Organisation:</td>
                                        <td>'. $company_name.'</td>
                                        <td>Departure Date:</td>
                                        <td>'. $departureDate.'</td>
                                    </tr>
                                    <tr>
                                        <td>GST:</td>
                                        <td>'. $gst.'</td>
                                        <td>Night:</td>
                                        <td>'. $night.'</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Booking Type:</td>
                                        <td>'. $bookingType.'</td>
                                    </tr>

                                </tbody>
                            </table>

                            <hr>

                            <table style="width:100%; border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <td style="40%">
                                            <h3>Room Details</h3>
                                        </td>
                                        <td style="30%"></td>
                                        <td style="30%"></td>
                                    </tr>                            
                                </thead>
                                <tbody>'.$roomdetailsHtml.'</tbody>
                            </table>
                        
                            

                            '.$footerPrice.'

                        </td>
                    </tr>
                </tbody>
            </table>
        ';
    return  $html;

}

 function orderEmail2($oid){    
    $body = orderEmail2Body($oid);
    $html = '
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Voucher</title>
        </head>
        <body>
            '.$body.'
        </body>

    </html>';
    return  $html;

 }

 function invoiceOrderEmail($oid){

    $name = getGuestDetail($oid)[0]['name'];
    $email = getGuestDetail($oid)[0]['email'];
    $phoneNumber = getGuestDetail($oid)[0]['phone'];
    $company_name = getGuestDetail($oid)[0]['company_name'];
    $gst = getGuestDetail($oid)[0]['comGst'];
    $bid = 1;
    $userPay = getBookingDetailById($oid)['userPay'];
    $grossCharge = getBookingDetailById($oid)['totalPrice'];

    $payment_status = 'complete';

    $payment_id = 'gg';
    $add_on = date('d-m-Y g:i A', strtotime(getBookingDetailById($oid)['addOn']));

    $couponCode = getBookingDetailById(1)['couponCode'];
    $pickUp = getBookingDetailById(1)['pickUp'];
    $pickupHtml = '';

    $sitename = SITE_NAME;
    $bookingSite = FRONT_BOOKING_SITE;

    $logo = FRONT_SITE_IMG . hotelDetail()['darklogo'];


    $hotelName = hotelDetail()['hotelName'];



    $roomdetailsHtml='';

    foreach (getOrderDetailArrByOrderId($oid) as $bidrow) {
        $checkIn = $bidrow['checkIn'];
        $checkOut = $bidrow['checkOut'];
        $totralPrice = $bidrow['total'];
    };

    $bookingDetailArry = getBookingDetailById($oid);


    $total_price = $bookingDetailArry['totalPrice'];
    $gst_price = $bookingDetailArry['gstPrice'];;
    $couponBalance = 0;
    $paymentBackupHtml = '';
    foreach ($bookingDetailArry['roomDetailArry'] as $bidrow) {
        $roomName = $bidrow['roomName'];
        $roomPrice = $bidrow['room'];
        $couponPrice = $bidrow['couponPrice'];
        $adult = $bidrow['adult'];
        $child = $bidrow['child'];
        $adultPrice = $bidrow['adultPrice'];
        $childPrice = $bidrow['childPrice'];
        $gstPer = $bidrow['gstPer'];
        $gstPrice = $bidrow['gstPrice'];
        $couponPriceHtml = '';
        $bookingStatus = $bidrow['bookingStatus'];
        $plan =$bidrow['rateplan'][0];
        $total = $bidrow['total'];
        $discount = $bookingDetailArry['totalDiscount'];

        $extraCharge = 0.00;
        
        $roomdetailsHtml.='
        <table style="width:100%; border-collapse:collapse;">
        <tbody>
            <tr>
                <td>
                    <h3>Room Details</h3>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    1. Room Type :'. $roomName.'
                </td>
                <td>Room Rate:</td>
                <td>'. $roomPrice.'</td>
            </tr>
            <tr>
                <td>
                    Plan: '. $plan.'
                </td>
                <td>Discount:</td>
                <td>'. $discount.'</td>
            </tr>
            <tr>
                <td>
                    Adult: '. $adult.'
                </td>
                <td>Extra Charge:</td>
                <td>'. $extraCharge.'</td>
            </tr>
            <tr>
                <td>Child: '. $child.'</td>
                <td>Tax:</td>
                <td>'. $gstPrice.'</td>
            </tr>
            <tr>
                <td></td>
                <td>Total:</td>
                <td>'. $total.'</td>
            </tr>
    
        </tbody>
    </table>

        ';
    }

    $reservationNumber = printBooingId($oid);
    $date = date('Y-m-d');
    $hotelMail=ucfirst(hotelDetail()['hotelEmailId']);
    $hotelPhonenumber = ucfirst(hotelDetail()['hotelPhoneNum']);
    $hotelAdd = ucfirst(hotelDetail()['address']);
    $hotelWebsite = ucfirst(hotelDetail()['website']);

    $hotelDetails = '';

    $hotelDetails.='<p>'.$hotelAdd.'</p>';
    $hotelDetails.='<p>'.$hotelPhonenumber.'</p>';
    $hotelDetails.='<p>'.$hotelMail.'</p>';
    $hotelDetails.='<p>'.$hotelWebsite.'</p>';





    $bookedOn = $add_on;

    $arrivalDate = $checkIn;

    $departureDate = $checkOut;

    $night = $bookingDetailArry['night'];

    $totalRoom = 2;
    $bookingType = $bookingDetailArry['bookingSource'];



    $total = $total_price;
    $paid = $userPay;
    $ToBePay = $total - $paid;

    $html = '

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>demo</title>


        </head>

        <body>
            <table style="width: 95%; border:2px solid black; margin: 0 auto;">
                <tbody>

                    <tr>
                        <td>


                            <table style="width:100%; border-collapse :collapse;">
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">
                                            <img src="'.$logo.'" alt="logo">
                                            <p>Reservation number: '. $reservationNumber.'</p>
                                        </td>
                                        <td style="width: 60%; text-align: center;">
                                            <h1>'. $hotelName.'</h1>
                                            '. $hotelDetails.'
                                        </td>
                                        <td style="width: 20%;">
                                            <p>Date:'. $date.'</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr style=" height: 3px; background: black;">

                            <table style="width:100%; border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>Guest Information</h3>
                                        </td>
                                        <td>
                                            <h3>Stay Information</h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>'. $name.'</td>
                                        <td>Booking Status:</td>
                                        <td>'. $bookingStatus.'</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number::</td>
                                        <td>'. $phoneNumber.'</td>
                                        <td>Booked On:</td>
                                        <td>'. $bookedOn.'</td>
                                    </tr>
                                    <tr>
                                        <td>Email::</td>
                                        <td>'. $email.'</td>
                                        <td>Arrival Date:</td>
                                        <td>'. $arrivalDate.'</td>
                                    </tr>
                                    <tr>
                                        <td>Organisation:</td>
                                        <td>'. $company_name.'</td>
                                        <td>Departure Date:</td>
                                        <td>'. $departureDate.'</td>
                                    </tr>
                                    <tr>
                                        <td>GST:</td>
                                        <td>'. $gst.'</td>
                                        <td>Night:</td>
                                        <td>'. $night.'</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Booking Type:</td>
                                        <td>'. $bookingType.'</td>
                                    </tr>

                                </tbody>
                            </table>

                            <hr>

                        '.$roomdetailsHtml.'
                            <hr>

                            <table style="width:100%; border-collapse:collapse;">
                                <tbody>
                                    <tr style="width: 100%;">
                                        <td style="width: 33%;">
                                            <h3>Grand Total: '. $total.'</h3>
                                        </td>
                                        <td style="width: 33%;">
                                            <h3>Total Advances: '. $paid.'</h3>
                                        </td>
                                        <td style="width: 33%;">
                                            <h3>Est. Balance: '. $ToBePay.'</h3>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </td>
                    </tr>
                </tbody>
            </table>
        </body>

    </html>';
    return  $html;

 }

 function getSysMailinvoice($id = ''){
    $hotelId = HOTEL_ID;
    $array = array();

    if ($id != '') {
        $array[] = ['id' => $id];
    }
    

    return QueryGen('sys_mailinvoice', $array);
}

function getmailinvoice(){
    $hotelId = HOTEL_ID;
    $array = array();
    $array[] = ['hotelId' => $hotelId];

    return QueryGen('mailinvoice', $array);
}

function mailInvoiceData($type){
    $mailArry = (isset(getmailinvoice()[0])) ? getmailinvoice()[0] : array();
    $sysMailArry = getSysMailinvoice()[0];
    $data = '';
    if(count($mailArry) == 0 || $mailArry[$type] == ''){
        $data = $sysMailArry[$type];
    }else{
        $data = $mailArry[$type];
    }

    return $data;
}


function getQuickBookingPrice($rid=0,$rdid='',$adult='',$child='',$date='',$date2='',$couponCode=''){
    
    if($rid == 0){
        $data = [
            'roomPrice'=> number_format(0,2),
            'adultPrice'=> number_format(0,2),
            'childPrice'=> number_format(0,2),
            'gstPer'=> 0,
            'gstPrice'=> number_format(0,2),
            'totalPrice'=> number_format(0,2)
        ];
    }else{
        if($rdid == '' || $rdid == 0){
            $rdid = getRateType($rid,'',1)[0]['id'];
        }
    
        if($adult == ''){
            $adult = getNoAdultCountByRId($rid);
        }
    
        if($child == ''){
            $child = 0;
        }
    
        if($date == ''){
            $date = date('Y-m-d');
        }
    
        if($date2 == ''){
            $date2 = date("Y-m-d", strtotime("$date +1 day"));
        }
        
        
        $nNight = getNightByTwoDates($date,$date2);
    
        $result = getSingleRoomPrice($rid, $rdid, $adult, $child ,$date, $nNight,$couponCode);
    
        $totalPrice = $result['total'];
    
        $data = [
            'roomPrice'=> number_format($result['room'],2),
            'adultPrice'=> number_format($result['adult'],2),
            'childPrice'=> number_format($result['child'],2),
            'gstPer'=> $result['gstPer'],
            'gstPrice'=> number_format($result['gst'],2),
            'totalPrice'=> number_format($totalPrice,2)
        ];
    }

    return $data;
}

function getBookingSourceList(){
    global $conDB;
    $html ='';
    $query = "SELECT * FROM sys_bookingsource where status = 1";
    $sql= mysqli_query($conDB,$query);
    if (mysqli_num_rows($sql) > 0) {
       while($row = mysqli_fetch_assoc($sql)){
            $img = FRONT_SITE_IMG.'icon/source/'.$row['img'];
            $id = $row['id'];
            $name = $row['name'];
         $html .= "<option value='$id'>$name</option>";
       }
    }

return $html;
}

function getOrganisationListData(){
    global $conDB;
    $hotelId = HOTEL_ID;
    $html ='';
     $query = "SELECT * FROM organisations where hotelId = '$hotelId' and status = 1";
     $data = array();
     $sql = mysqli_query($conDB,$query);
     if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $company = $row['name'];
            $bookingArray = getAllBooingData('','','','','','','',$company);
            $totalPrice = 0;
            foreach($bookingArray as $booking){
                $bid = $booking['id'];
                $bookingAllDetail = getBookingDetailById($bid);
                $price = $bookingAllDetail['totalPrice'];
                $totalPrice += floatval($price);
            }

            $advance = [
                'balance'=>$totalPrice,
            ];

            $data[] = array_merge($row,$advance);
        }
     }
     return $data;
}

function getOrganisationData($id='', $catcheck=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $data = array();
    $id = ($catcheck != '') ? (($id == '') ? 0 : $id) : $id;
     $query = "SELECT * FROM organisations where hotelId = '$hotelId'";

     if($id != ''){
        $query .= " and id = '$id'";
     }

     $sql = mysqli_query($conDB,$query);
     if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $data[]= $row;
        }
     }
     
     return $data;
}

function getOrganisationList(){
    global $conDB;
    $hotelId = HOTEL_ID;
    $html ='';
     $query = "SELECT * FROM organisations where hotelId = '$hotelId' and status = 1";

     $sql = mysqli_query($conDB,$query);
     if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $html.= ' <option value="'.$row['name'].'" data-option-id='.$row['id'].'></option>';
        }
     }
     else{
        $html.='No Data';
     }
     return $html;
}

    function setOrganisationDetails($organisationName, $organisationEmail='', $organisationAddress='', $organisationCity='', $organisationState='', $organisationCountry='', $organisationPostCode='', $organisationNumber='', $organisationGstNo='', $ratePlan='', $salesManager='', $organisationDiscount='', $organisationNote=''){
        $hotelId = HOTEL_ID;
        global $conDB;
        $query = "INSERT INTO organisations (hotelId,name,organisationEmail, organisationAddress, organisationCity, organisationState, organisationCountry, organisationPostCode, organisationNumber, organisationGstNo, ratePlan, salesManager, organisationDiscount, organisationNote)
        VALUES ('$hotelId','$organisationName','$organisationEmail', '$organisationAddress', '$organisationCity', '$organisationState', '$organisationCountry', '$organisationPostCode', '$organisationNumber', '$organisationGstNo', '$ratePlan', '$salesManager', $organisationDiscount, '$organisationNote');
        ";
        $sql = mysqli_query($conDB,$query);
        
        return $sql;
    }

    function getGstNumberFromOrganisationName($name='',$dataid=''){
        global $conDB;
        $hotelId = HOTEL_ID;
        $query = "SELECT organisationGstNo FROM organisations WHERE hotelId = '$hotelId' AND name = '$name' AND id = '$dataid'";

        $sql = mysqli_query($conDB,$query);

        if($sql){
            $row = mysqli_fetch_assoc($sql);
            if($row){
                $organisationGstNo = $row['organisationGstNo'];
                $data = array(
                    'status'=>'ok',
                    'gstNo'=> $organisationGstNo
                );
            }
            else{
                $data = array(
                    'status'=>'no',
                    'gstNo'=> ''
                );
            }
        }
        return $data;

    }

    function getTravelagent(){
        global $conDB;
        $hotelId = HOTEL_ID;
        $sql = "SELECT * FROM  travel_agents WHERE hotelId = '$hotelId'";
        
        $data = array();
        $query = mysqli_query($conDB, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $tid = $row['id'];
                $bookingArray = getAllBooingData('','','','','','',$tid);
                $totalPrice = 0;
                foreach($bookingArray as $booking){
                    $bid = $booking['id'];
                    $bookingAllDetail = getBookingDetailById($bid);
                    $price = $bookingAllDetail['totalPrice'];
                    $totalPrice += floatval($price);
                }

                $advance = [
                    'balance'=>$totalPrice,
                ];

                $data[] = array_merge($row,$advance);
            }
        }

        return $data;
    }


function setTraveAgentData($travelagentname, $travelagentemail, $travelagentAddress, $travelagrntCity, $travelagentState, $travelagentCountry, $travelagentPostCode, $travelagentPhoneno, $travelagentGstNo, $travelagentcommission, $travelaaagentGstonCommision, $travelaaagentTcs, $travelaaagentTds, $travelagentNote){
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "INSERT INTO travel_agents (hotelId,travelagentname, travelagentemail, travelagentAddress, travelagrntCity, travelagentState, travelagentCountry, travelagentPostCode, travelagentPhoneno, travelagentGstNo, travelagentcommission, travelaaagentGstonCommision, travelaaagentTcs, travelaaagentTds, travelagentNote) VALUES('$hotelId','$travelagentname', '$travelagentemail', '$travelagentAddress', '$travelagrntCity', '$travelagentState', '$travelagentCountry', '$travelagentPostCode', '$travelagentPhoneno', '$travelagentGstNo', $travelagentcommission, $travelaaagentGstonCommision, $travelaaagentTcs, $travelaaagentTds, '$travelagentNote')";
    $sql = mysqli_query($conDB,$query);

    if($sql){
        return mysqli_insert_id($conDB);
    }


}


function getSysAddonCharge($id = ''){
    global $conDB;
    $query = "select * from sys_addon_charge where id != ''";

    if ($id != '') {
        $query .= " and id = '$id'";
    }
    
    $sql = mysqli_query($conDB, $query);
    $data = array();

    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}


function getProAddonCharge(){
    return getSysAddonCharge();
}
function setExtraChargeList($name,$amount,$id=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    if($id !=''){
        $query = "UPDATE property_addon_charges SET name = '$name', amount = $amount WHERE id = $id";
    }
    else{
        $query = "insert into property_addon_charges (hotelid, name, amount) values ('$hotelId','$name',$amount)";
    }


    $sql = mysqli_query($conDB,$query);
    if($sql){
        return true;
    }else{
        return false;
    }
}

function guestNamesByBid($bid)
{
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "SELECT name FROM guest Where hotelId = $hotelId and bookingdId = $bid";
    $sql = mysqli_query($conDB, $query);

    if ($sql) {
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
    }

    return $data;
}

function getFolioHistory($bid)
{
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "SELECT * FROM booking_folio WHERE hotelId = $hotelId and bid = $bid";
    $sql = mysqli_query($conDB, $query);
    $data = []; 
    if ($sql) {
        while ($row = mysqli_fetch_assoc($sql)) {         
            $row['userName'] = getAddByData($row['addBy']);
            $data[] = $row;
        }
    }
    return $data;
}


function getExtraChargeDetails($id=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    if($id!=''){
        $query = "SELECT * FROM property_addon_charges WHERE hotelid=$hotelId AND id = $id";
    }
    else{
        $query = "SELECT * FROM property_addon_charges WHERE hotelid=$hotelId";
    }
   
    $sql = mysqli_query($conDB,$query);
    $data = array();
    if($sql){
        if(mysqli_num_rows($sql)>0){
            while($row = mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }            
        }else{
            echo '<h2>No Data</h2>';
        }
    }
    return $data;
}

function deleteChargeList($id){
    global $conDB;
    $hotelId = HOTEL_ID;


    $query = "DELETE From property_addon_charges WHERE hotelid=$hotelId AND id = $id";
    $sql = mysqli_query($conDB,$query);
    if($sql){
        return true;
    }
    else{
        return false;
    }
}


function checkUserAccess($uid,$pageId=''){
    $hotelId = HOTEL_ID;
    global $conDB;
    $uid = ($uid == '') ? $_SESSION['ADMIN_ID'] : $uid;
    $userArry = getHotelUserDetail($uid)[0];
    $userRole = $userArry['role'];
    if($userRole == 1){
        $data = [
            'access'=> 'true'
        ];
    }else{      
        if(isset(getUserAccess($uid,$pageId)[0])){
            $userAccessArray = getUserAccess($uid,$pageId)[0];
            $data = [
                'access'=> 'true'
            ];
        }else{
            $data = [
                'access'=> 'false'
            ];
        }
    }

    return $data;
    
}

function userAccessUpdate($uid,$pageId,$fullArry=[]){
    $hotelId = HOTEL_ID;
    global $conDB;
    global $time;

    $addBy = dataAddBy();
    $userCheck = getUserAccess($uid,$pageId);
    $userHoleCheck = getUserAccess($uid);

    foreach($userHoleCheck as $item){
        $id = $item['id'];
        if (in_array($item['pageId'], $fullArry, TRUE)) { 
            
        } else { 
            echo $sql = "delete from user_access where id ='$id'";
            mysqli_query($conDB, $sql);
        } 

    }

    if(count($userCheck) > 0){
        $sql = "";
    }else{
        $sql = "insert into user_access(hotelId,userId,pageId,addBy,addOn) value('$hotelId', '$uid', '$pageId', '$addBy', '$time')";
        mysqli_query($conDB, $sql);
    }
    echo 1;
}

function checkWebsiteUserAccess($role='',$uid='', $pageId=''){
    $userArry = getHotelUserDetail($_SESSION['ADMIN_ID'])[0];
    $userRole = $userArry['role'];
    $data = 0;
    if($userRole == 1){
        $data = 1;
    }

    return $data;
}

function arrayFormatingByTree($tab,$pdata){
    $data = array();
    $html = '<ul class="ui-tree">';
    foreach($tab as $tabItem){
        $pId = $tabItem['id'];
        $pName = $tabItem['name'];
        $itemData =  array();
        $html .= "<li>$pName</li> <li> <ul>";
        
        foreach($pdata as $dataItem){
            $dataId = $dataItem['id'];
            $dataPId = $dataItem['productId'];
            if($pId == $dataPId){
                $dataPName = $dataItem['productName'];
                $html .= "<li>$dataPName</li>";
            }
        }

        $html .= '</ul></li>';

    }

    $html .= '</ul>';

    return $html;
}


//code written by abinash in 27/02/2024
function setPaymentVerifyCheckBox($unCheck=''){
    global $conDB;  
    $hotelId = HOTEL_ID;

    $query = "SELECT * FROM payment_verify where hotelId = $hotelId";
    $sql = mysqli_query($conDB,$query);

   
    if(mysqli_num_rows($sql)>0){
        if($unCheck !=''){
            $sqlquery = "UPDATE payment_verify SET verified = 0 WHERE hotelId = $hotelId";
        }else{
            $sqlquery = "UPDATE payment_verify SET verified = 1 WHERE hotelId = $hotelId";
        }
    }else if(mysqli_num_rows($sql)==0){
        $sqlquery = "INSERT INTO payment_verify (hotelId, verified) VALUES ($hotelId,1)";
    }

    $secSql = mysqli_query($conDB,$sqlquery);
    if($secSql){
        $data=[
            'status'=>'ok'
        ];
    }
    else{
        $data=[
            'status'=>'no'
        ];
    }

    return $data;
 
}
function checkVerifiedOrNot(){
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "SELECT * FROM payment_verify WHERE hotelId = $hotelId";
    $sql = mysqli_query($conDB,$query);
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);

        $verified = $row['verified'];
        $proof = $row['proof'];
    }
    $data = [
        'verified' => $verified,
        'proof'=> $proof
    ];
    return $data;

}

function getGuestPaymentDetails($bid = '', $date = '')
{
    global $conDB;
    $hotelId = HOTEL_ID;

            $query = "SELECT 
            proId, 
            SUM(amount) AS total_amount, 
            COUNT(CASE WHEN openFolio = 1 THEN 1 END) AS number_of_openFolio 
        FROM 
            payment_timeline 
        WHERE 
            hotelId = 41517 AND 
            DATE(addOn) = '$date' 
        GROUP BY 
        proId;
        ";
    if ($bid != '') {
        $query = "SELECT bid, SUM(amount) AS total_amount, COUNT(CASE WHEN openFolio = 1 THEN 1 END) AS number_of_openFolio FROM payment_timeline  WHERE hotelId = $hotelId AND bid = $bid";
    }
    $sql = mysqli_query($conDB, $query);

    if (mysqli_num_rows($sql) > 0) {
        while ($rows = mysqli_fetch_assoc($sql)) {
            $data[] = $rows;
        }
    }
    else{
        echo '<h4>No Data Found</h4>';
    }

    return $data;
}

function setSettelement($bid, $listId = '',$date='') {
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "UPDATE payment_timeline SET openFolio = 0 WHERE bid = $bid AND hotelId = $hotelId";
    if (!empty($listId)) {
        $query .= " AND id = $listId";
    }
    if(!empty($date)){
        $query .= " AND DATE(addOn) = '$date'";
    }
 
    $sql = mysqli_query($conDB, $query);
    if ($sql) {
        return true;
    } else {
        return false;
    }
}

function getPaymentHistDetails($bid,$date){
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "SELECT * FROM payment_timeline WHERE proId = $bid AND hotelId = $hotelId AND DATE(addOn) = '$date'";

    $sql = mysqli_query($conDB,$query);

    if(mysqli_num_rows($sql)>0){
        while($rows = mysqli_fetch_assoc($sql)){
            $data[]=$rows;
        }
    }
    return $data;

}
function setPaymentProofCheckBox($unCheck=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "SELECT * FROM payment_verify where hotelId = $hotelId";
    $sql = mysqli_query($conDB,$query);

   
    if(mysqli_num_rows($sql)>0){
        if($unCheck !=''){
            $sqlquery = "UPDATE payment_verify SET proof = 0 WHERE hotelId = $hotelId";
        }else{
            $sqlquery = "UPDATE payment_verify SET proof = 1 WHERE hotelId = $hotelId";
        }
    }else if(mysqli_num_rows($sql)==0){
        $sqlquery = "INSERT INTO payment_verify (hotelId, proof) VALUES ($hotelId,1)";
    }

    $secSql = mysqli_query($conDB,$sqlquery);
    if($secSql){
        $data=[
            'status'=>'ok'
        ];
    }
    else{
        $data=[
            'status'=>'no'
        ];
    }

    return $data;
}

function getHotelPageLink($hId=''){
    global $conDB;
    $sql = "select * from hotelpagelink where id != ''";

    if($hId != ''){
        $sql .= " and hotelId = '$hId'";
    }
    
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $data[] = $row;
        }
    }else{
        mysqli_query($conDB, "insert into hotelpagelink(hotelId) values('$hId')");
    }

    return $data;
}


function setHotelPageLink($hid, $aboutPage='',$conPage='',$hotelP='',$cancelP='',$rPolicy=''){
    global $conDB;
    $hotelId = HOTEL_ID;
    
    if(count(getHotelPageLink($hid)) > 0){        
        $sqlArray = array();

        if($aboutPage != ''){
            $sqlArray[]= " aboutPage = '$aboutPage'";
        }
        if($conPage != ''){
            $sqlArray[] = " contactPage = '$conPage'";
        }
        if($hotelP != ''){
            $sqlArray[] = " hotelPolicy = '$hotelP'";
        }
        if($cancelP != ''){
            $sqlArray[] = " cancelPolicy = '$cancelP'";
        }
        if($rPolicy != ''){
            $sqlArray[] = " refundPolicy = '$rPolicy'";
        }
        $arrayToStr = implode(',', $sqlArray);

        if($arrayToStr != ''){
            $sql = "update hotelpagelink set $arrayToStr where hotelId = '$hotelId'";
        }        

    }else{
        $sql = "insert into hotelpagelink(hotelId,aboutPage,contactPage,hotelPolicy,cancelPolicy,refundPolicy) values('$hid','$aboutPage','$conPage','$cancelP','$rPolicy')";
    }
    
    if(mysqli_query($conDB,$sql)){
        $data = 1;
    }else{
        $data = 0;
    }

    return $data;
}
 function getGuestInformationByBid($bid){
    global $conDB;
    $hotelId = HOTEL_ID;

    $query = "SELECT * FROM guest WHERE bookId = $bid and hotelId = '$hotelId'";

    $sql = mysqli_query($conDB,$query);
    $data = array();
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }
    }
    return $data;

 }



 function convertNumberToWords($number) {
    $words = array(
        '0' => 'zero',
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve',
        '13' => 'thirteen',
        '14' => 'fourteen',
        '15' => 'fifteen',
        '16' => 'sixteen',
        '17' => 'seventeen',
        '18' => 'eighteen',
        '19' => 'nineteen',
        '20' => 'twenty',
        '30' => 'thirty',
        '40' => 'forty',
        '50' => 'fifty',
        '60' => 'sixty',
        '70' => 'seventy',
        '80' => 'eighty',
        '90' => 'ninety',
        '100' => 'hundred',
        '1000' => 'thousand',
        '1000000' => 'million',
        '1000000000' => 'billion',
        '1000000000000' => 'trillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    $result = '';

    if ($number < 21) {
        $result = $words[$number];
    } elseif ($number < 100) {
        $tens = floor($number / 10) * 10;
        $units = $number % 10;
        $result = $words[$tens];
        if ($units) {
            $result .= ' ' . $words[$units];
        }
    } elseif ($number < 1000) {
        $hundreds = floor($number / 100);
        $remainder = $number % 100;
        $result = $words[$hundreds] . ' ' . $words[100];
        if ($remainder) {
            $result .= ' ' . convertNumberToWords($remainder);
        }
    } else {
        foreach (array(1000000000000, 1000000000, 1000000, 1000) as $unit) {
            if ($number >= $unit) {
                $number_units = floor($number / $unit);
                $number -= $number_units * $unit;
                $result .= convertNumberToWords($number_units) . ' ' . $words[$unit];
                if ($number) {
                    $result .= $number < 100 ? ' and ' : ', ';
                }
            }
        }
        if ($number) {
            $result .= convertNumberToWords($number);
        }
    }

    return $result;
}


function customEncodeBase64($input) {
    
    $encoded = base64_encode($input);
    
    $encoded = str_replace('=', '_', $encoded);
    $encoded = str_replace('+', '-', $encoded);
    $encoded = str_replace('/', '~', $encoded);

    return $encoded;
}

function customDecodeBase64($input) {
    
    $input = str_replace('_', '=', $input);
    $input = str_replace('-', '+', $input);
    $input = str_replace('~', '/', $input);
    
    $decoded = base64_decode($input);

    return $decoded;
}


function getResList(){
    global $conDB;
    $hotelId = HOTEL_ID;
    
    $query = "SELECT * FROM kot_restaurant WHERE hotelId = $hotelId AND deleteRec = 1";
    $sql = mysqli_query($conDB,$query);
    if(mysqli_num_rows($sql)>0){
        while($rows = mysqli_fetch_assoc($sql)){
            $data[] = $rows;
        }
    }
    return $data;
}

function getRestIdFromTableId($tid){
    global $conDB;
    $hotelId = HOTEL_ID;
    $query = "SELECT resId FROM kottable WHERE hotelId = $hotelId AND id=$tid";
    $sql = mysqli_query($conDB,$query);
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);
            $resId = $row['resId'];       
    }
    return $resId;
}

function updateLiveorderkot($qty='',$proId='',$orderId=''){
    global $conDB;
    $hotelId = HOTEL_ID;

    $qTyquery ="SELECT qty FROM kotorderdetail WHERE proId = $proId AND orderId = $orderId";
    $qTysql = mysqli_query($conDB,$qTyquery);
    if($qTysql){
        $qtydata = mysqli_fetch_assoc($qTysql);
        $previousQty = $qtydata['qty'];
    }



    $totaltPrice= 0;
    $taxPrice = 0;
    $kotQuery = "SELECT * FROM kotorder WHERE id = $orderId AND hotelId = $hotelId";
    $kotsql = mysqli_query($conDB,$kotQuery);
    if($kotsql){
        $data = mysqli_fetch_assoc($kotsql);
        $subTotal = $data['subTotal'];
        $price = getKotProduct($proId)[0]['price'];

        if($previousQty < $qty){
            $updatedqty = $qty-$previousQty;
            $totaltPrice += $price * $updatedqty;
            echo 'totalprice='.$totaltPrice;
            echo 'subTotal='.$subTotal;
            $allTotal = $subTotal + $totaltPrice;
        }
        else if($previousQty > $qty){
            $updatedqty = $previousQty- $qty;
            $totaltPrice += $price * $updatedqty;
            echo 'totalprice='.$totaltPrice;
            echo 'subTotal='.$subTotal;
            $allTotal = $subTotal - $totaltPrice;
        }
        
        //totalproprice
        
        //gst
        $taxPrice += getPriceCalculate('percentage', 5, $allTotal);
        echo 'taxPrice='.$taxPrice;
        //totalprice
        $finalTotalPrice = $allTotal + $taxPrice;

        $updtaeKotQuery = "UPDATE kotorder SET subTotal = $allTotal,tax=$taxPrice,totalPrice=$finalTotalPrice WHERE id = $orderId AND hotelId = $hotelId";
        $updtaeKotsql = mysqli_query($conDB,$updtaeKotQuery);
        if($updtaeKotsql){

            $query ="UPDATE kotorderdetail SET qty=$qty WHERE proId = $proId AND orderId = $orderId";
            $sql = mysqli_query($conDB,$query);
            if($sql){
                return true;
            }
            else{
                false;
            }
        }


    }else{
        return false;
    }


}

function generateEditReservationLink($bid,$type=''){

    $link = FRONT_SITE."/reservation-edit?id=$bid";

    if($type != ''){
        $link .= "&type=$type";
    }

    return $link;
}


function generateFolioLink($bid,$type=''){

    $link = FRONT_SITE."/folios?id=$bid";

    if($type != ''){
        $link .= "&type=$type";
    }

    return $link;
}

function getRoomChargeData($date){
    $data = array();
    foreach(getBookingFolio('','','','','','','','',$date,'Room Charge') as $item){
        $data[] = $item;
    }

    return $data;
}

function getCheckOutData($date){
    $data = array();
    foreach(getGuestamenddetailData('',$date) as $item){
        $data[] = $item;
    }

    return $data;
}

function getDailySalesData($date){
    $salesData = [
        'roomSales' => [
            'roomCharge' => 0,
            'extraCharge' => 0,
            'roomTax' => 0,
            'extraTax' => 0,
            'discount' => 0,
            'totalSales' => 0,
        ],
        'cancellationSales' => [
            'roomCharge' => 0,
            'extraCharge' => 0,
            'roomTax' => 0,
            'extraTax' => 0,
            'discount' => 0,
            'totalSales' => 0,
        ],
        'noShowSales' => [
            'roomCharge' => 0,
            'extraCharge' => 0,
            'roomTax' => 0,
            'extraTax' => 0,
            'discount' => 0,
            'totalSales' => 0,
        ],
        'incidentalSales' => [
            'roomCharge' => 0,
            'extraCharge' => 0,
            'roomTax' => 0,
            'extraTax' => 0,
            'discount' => 0,
            'totalSales' => 0,
        ],
    ];

    foreach(getAllBooingData('','','','','','','','',$date) as $bookingItem){
        $bs = $bookingItem['bookingSource'];
        $bid = $bookingItem['id'];
        if(isset(getBookingData($bid)[0])){
            $getBookingDArray = getBookingData($bid)[0];
            
            $checkinstatus = $getBookingDArray['checkinstatus'];
            $totalPrice = $getBookingDArray['totalFullPrice'];
            $extra_amount = $getBookingDArray['extra_amount'];
            $totalRoomPrice = $getBookingDArray['totalRoomPrice'];
            $totalGstPrice = $getBookingDArray['totalGstPrice'];
            $discount = 0;

            if($checkinstatus == 5 || $checkinstatus == 7){
                $salesData['cancellationSales']['roomCharge'] += floatval($totalRoomPrice);
                $salesData['cancellationSales']['extraCharge'] += floatval($extra_amount);
                $salesData['cancellationSales']['discount'] += floatval($discount);
                $salesData['cancellationSales']['totalSales'] += floatval($totalPrice);
            }elseif($checkinstatus == 6){
                $salesData['noShowSales']['roomCharge'] += floatval($totalRoomPrice);
                $salesData['noShowSales']['extraCharge'] += floatval($extra_amount);
                $salesData['noShowSales']['discount'] += floatval($discount);
                $salesData['noShowSales']['totalSales'] += floatval($totalPrice);
            }else{
                if($bs == 1 || $bs == 2 ){
                    $salesData['roomSales']['roomCharge'] += floatval($totalRoomPrice);
                    $salesData['roomSales']['extraCharge'] += floatval($extra_amount);
                    $salesData['roomSales']['discount'] += floatval($discount);
                    $salesData['roomSales']['totalSales'] += floatval($totalPrice);
                } elseif($bs == 4 || $bs == 5 || $bs == 6 || $bs == 7 ){
                    $salesData['incidentalSales']['roomCharge'] += floatval($totalRoomPrice);
                    $salesData['incidentalSales']['extraCharge'] += floatval($extra_amount);
                    $salesData['incidentalSales']['discount'] += floatval($discount);
                    $salesData['incidentalSales']['totalSales'] += floatval($totalPrice);
                }
            }
        }
    }

    return $salesData;
}

function getReceiptPaymentData($date){
    $data = array();

    foreach(getPaymentTypeMethod() as $payType){
        $payId = $payType['id'];
        $payName = $payType['name'];

        $timeLineData = array();
        foreach(getGuestPaymentTimeline('','',$date,$payId) as $item){
            $timeLineData[] = $item;
        }

        $data[] = [
            'method'=>$payName,
            'data'=>$timeLineData
        ];

    }
    

    return $data;
}

function getReceiptSummaryData($date){
    
}

function getMiscChargeData($date){}

function getRoomStatusData($date){}

function getRatePlanData($date){}

function getPosSummaryData($date){}

function getPosPaymentSummaryData($date){}


function createNightAuditReport($date){

    $data = [
        'roomCharges'=>getRoomChargeData($date),
        'checkOut'=>getCheckOutData($date),
        'dailySales'=>getDailySalesData($date),
        'receiptPayment'=>getReceiptPaymentData($date),
        'receiptSummary'=>getReceiptSummaryData($date),
        'miscCharges'=>getMiscChargeData($date),
        'roomStatus'=>getRoomStatusData($date),
        'ratePlan'=>getRatePlanData($date),
        'posSummary'=>getPosSummaryData($date),
        'posPaymentSummary'=>getPosPaymentSummaryData($date),
    ];

    return $data;
}



function buildQuery($tableName, $conditions=array(), $orderByColumn = 'id', $orderDirection = 'DESC') {
    $sql = "SELECT * FROM $tableName WHERE 1=1";
    foreach ($conditions as $key => $value) {

        if (strpos($value, '%') !== false) {
            $sql .= " AND $key LIKE '$value'";
        }elseif((strpos($value, '!') !== false)){
            $val = str_replace('!', '', $value);
            $sql .= " AND $key != '$val'";
        } else {
            $sql .= " AND $key = '$value'";
        }
    }
    $sql .= " ORDER BY $orderByColumn $orderDirection";

    return $sql;
}

function fetchData($tableName, $conditions=array(), $orderByColumn = 'id', $orderDirection = 'DESC'){
    global $conDB;
    $sql = buildQuery($tableName, $conditions, $orderByColumn, $orderDirection);   
    $query = mysqli_query($conDB, $sql);
    $data = array();
    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }
    return $data;
}


function insertData($tableName, $data=array()) {
    global $conDB;
    
    if (empty($data)) {
        return false;
    }
    
    $columns = implode(', ', array_keys($data));
    $values = implode("', '", array_values($data));
    
    $sql = "INSERT INTO $tableName ($columns) VALUES ('$values')";

    if (mysqli_query($conDB, $sql)) {
        return mysqli_insert_id($conDB);         
    } else {
        return false; 
    }
}

function updateData($tableName, $data=array(), $conditions=array()) {
    global $conDB;
    
    if (empty($data) || empty($conditions)) {
        return false;
    }

    $wherePart = '';
    foreach ($conditions as $key => $value) {
        $wherePart .= "$key = '" . mysqli_real_escape_string($conDB, $value) . "' AND ";
    }
    $wherePart = rtrim($wherePart, 'AND '); 
    
    if(mysqli_num_rows(mysqli_query($conDB, "select  * from $tableName WHERE $wherePart")) > 0){
        $setPart = '';
        foreach ($data as $key => $value) {
            $setPart .= "$key = '" . mysqli_real_escape_string($conDB, $value) . "', ";
        }
        $setPart = rtrim($setPart, ', '); 
        $sql = "UPDATE $tableName SET $setPart WHERE $wherePart";

        if (mysqli_query($conDB, $sql)) {
            return true; 
        } else {
            return false; 
        }

    }else{
        return insertData($tableName,array_merge($conditions,$data));
    }
    
}




function sendDataReservation($key,$url,$table,$data){
    $target_url = 'https://retrod.in/api/insert.php';
    $sendRequest = [
        'key'=>$key,
        'url'=>$url,
        'table'=>$table,
        'data'=>$data,
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sendRequest));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
}



function listOfOdishaDistric(){
    $districts = [
        "Khurda",
        "Navaragpur",
        "Navapada",
        "Gajapati",
        "Boudh",
        "Bhadrak",
        "Ganjam",
        "Dhenkanal",
        "Angul",
        "Puri",
        "Cuttak",
        "Sambalpur",
        "Kalhandi",
        "Koraput",
        "Phulbani",
        "Balangir",
        "Bargah",
        "Deogarh",
        "Jagatsinghpur",
        "Jajpur",
        "Jharsuguda",
        "Kendrapara",
        "Malkangiri",
        "Nayagarh",
        "Rayagada",
        "Sonepur",
        "Balasore",
        "Mayurbhanj",
        "Keonjhar",
        "Sundergarh"
    ];
    
    $json_data = json_encode($districts);
    
    return $json_data;
    
}



 ?>



 

