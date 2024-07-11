var webUrl = 'https://admin.nayakhotels.com/';
var loadingGif = webUrl + 'img/loading.gif';

window.loader = `<div class="loadingCon"><div class="loader"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div></div>`;
window.spinner = `<div class="loadingCon"><div class="spinner"><div class="spinner-item"></div><div class="spinner-item"></div><div class="spinner-item"></div></div></div>`;
window.loaderSpinner = `<div class="spinner-box"><div class="three-quarter-spinner"></div>`;
window.tableSkeleton = `<table class="tg">
                            <tr>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                                <th class="tg-cly1"><div class="tb_line"></div></th>
                            </tr>
                            <tr>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                            </tr>
                            <tr>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                            </tr>
                            <tr>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                            </tr>
                            <tr>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                                <td class="tg-cly1"><div class="tb_line"></div></td>
                            </tr>
                        </table>`;
window.filePath = $(window.location.pathname.split('/')).last()[0];


function showModalBox(title = 'Title', updateBtn = 'Submit', data = '', btnId = '', modalSize = '', target = '#popUpModal') {
    var updateBtnHtml = (updateBtn == '') ? '' : `<div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button id="${btnId}" type="button" class="btn btn-primary">${updateBtn}</button>
                                                </div>`;

    var html =
        `<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ${modalSize}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">${title}</h5>
                        <button style="color:black" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">${data}</div>
                    ${updateBtnHtml}
                </div>
            </div>`;


    $(target).html(html);
}

function removeModal() {
    $('.modal-backdrop.fade.show').remove();
    $('#popUpModal').removeClass('show');
    $('#popUpModal').css('display', 'none');
}

function sweetAlert($msg, $type = 'success') {
    return Swal.fire({
        position: 'center',
        icon: $type,
        title: $msg,
        showConfirmButton: false,
        timer: 2000
    })
};

function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

var statesInIndia = [
    "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", 
    "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", 
    "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", 
    "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", 
    "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
  ];

function ajax_request(data = '',json='') {
    // request_type
    const api_url = `${webUrl}api.php`;
    const api_key = "$2y$10$KIJ70OtaZDZWPZJV5V7bZOfjE2nS9pIGbGXXI3mENV9Fj2JXBLLnS";

    data += "&api_key=" + api_key;
    if(json == 'json'){
        return $.ajax({
            url: api_url,
            method: "post",
            contentType: 'application/json',
            data: JSON.stringify(data),
            cache: false,
        });
    }else{
        return $.ajax({
            url: api_url,
            method: "post",
            data: data,
            cache: false,
        });
    }
}

var elem = document.getElementById("body");
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}

function getBookingSource(id) {
    var data = '';
    if (id == 1) {
        data = webUrl + 'img/icon/source/pms.png';
    }

    return data;
}

function rupeesFormat(number){
    var formattedNumber = number.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
    return formattedNumber;
}


function getCheckInStatus($sid) {
    var data = {};
    if ($sid == '1') {
        data = { 'name': 'Reservation', 'btn': 'Check In', 'btnCls': 'btn-info' }
    }
    if ($sid == '2') {
        data = { 'name': 'Checked In', 'btn': 'Check Out', 'btnCls': 'btn-warning' }
    }
    if ($sid == '3') {
        data = { 'name': 'Checked Out', 'btn': 'Checked Out', 'btnCls': 'btn-danger' }
    }
    if ($sid == '4') {
        data = { 'name': 'Return', 'btn': 'Return', 'btnCls': 'btn-danger' }
    }
    if ($sid == '5') {
        data = { 'name': 'Cancel', 'btn': 'View', 'btnCls': 'btn-danger' }
    }
    if ($sid == '6') {
        data = { 'name': 'No show', 'btn': 'View', 'btnCls': 'btn-danger' }
    }
    if ($sid == '7') {
        data = { 'name': 'Void', 'btn': 'View', 'btnCls': 'btn-danger' }
    }
    return data;
}

function getPaymentMethods(sid) {
    var paymentMethods = {
        '1': 'Cheque',
        '2': 'Credit card',
        '3': 'Debit card',
        '4': 'NEFT/RTGS',
        '5': 'UPI',
        '6': 'Cash',
        '7': 'Payment Gateway',
        '8': 'Other'
    };

    return paymentMethods[sid] || '';
}

function getPosOrderType(id) {
    var data = '';
    if (id == 1) {
        data = 'Table';
    }

    if (id == 2) {
        data = 'Room';
    }

    return data;
}


function generateNumber(num, letter = 3) {
    var remening = (parseInt(num).toString().length <= letter) ? letter - parseInt(num).toString().length : 0;
    var data = '';

    for (i = 0; i < remening; i++) {
        data += '0';
    }

    return data + num;
}

function customModal(title = '', content = '', btn='', width='50vw', height='auto') {
    $('#customModal').remove();
    var html = `
    <div id="customModal">
        <div class="modal-overlay customModal-toggle"></div>

        <div style="width: ${width};height: ${height};" class="modal-wrapper modal-transition">
            <div class="modal-header">
                <button class="customModal-close modal-toggle"><svg class="icon-close icon"><use xlink:href="#closeSvgIcon"></use></svg></button>
                <h2 class="modal-heading">${title}</h2>
            </div>
        
            <div class="modal-body">
                <div class="modal-content">
                ${content}
                </div>
            </div>
        </div>
    </div>`;
    $('body').append(html);

    $('#customModal').toggleClass('is-visible');
}

function customModalClose(){
    $('#customModal').toggleClass('is-visible');
}

function previewPaymentLink(paymentId, link) {
    var html = `
        <div class="shareContent">
            <p>Share this link via</p>
            <ul class="icons">
                <a id="payLinkShareEmail" data-paymentid="${paymentId}" href="javascript:void(0)"><i class="far fa-envelope-open"></i></a>
                <a id="payLinkShareWhatsapp" data-paymentid="${paymentId}" href="javascript:void(0)"><i class="fab fa-whatsapp"></i></a>
                <a id="payLinkShareQrCode" data-paymentid="${paymentId}" href="javascript:void(0)"><i class="fas fa-qrcode"></i></a>
            </ul>
            <p>Or copy link</p>
            <div class="field">
                <svg class="url-icon"><use xlink:href="#linkASvgIcon"></use></svg>
                <input id="shareCopyLink" type="text" readonly="" value="${link}">
                <button id="shareCopyLinkBtn">Copy</button>
            </div>
        </div>
    `;
    return html;
}

$(document).on('click', '.customModal-toggle', function () {
    $('#customModal').toggleClass('is-visible');
});

$(document).on('click', '.customModal-close', function () {
    $('#customModal').toggleClass('is-visible');
});

function GMTTimeConvert(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

function timeToConvertNum(str) {
    const [year, month, day] = str.split('-');
    return year + month + day;
};

function imageValidation($type, $size) {
    var type = $type;
    var fileSize = $size;
    var type_reg = /^image\/(jpg|png|jpeg|gif|ico)$/;
    if (fileSize > 500000) {
        sweetAlert('File too large. File must be less than 500Kb.', 'error');
    }

    if (!type_reg.test(type)) {
        sweetAlert('Invalid file type. Only JPG, GIF and PNG types are accepted.', 'error');
    }
}

function generateArrayToFunction($data) {
    var data = $data;

    const functionMap = {
        'buildReservationDetail': buildReservationDetail,
    };

    const functionName = data[0];
    console.log(functionName);
    const functionToCall = functionMap[functionName];

    if (typeof functionToCall === 'function') {
        const params = data.slice(1); // Get the parameters (excluding the function name)
        functionToCall(...params); // Call the function with the parameters
    } else {
        console.log('The specified function is not found.');
    }
}

function error($msg) {
    $html = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">';
    $html += '<span class="alert-icon"><i class="fas fa-thumbs-down mr8"></i></span>';
    $html += '<span class="alert-text"><strong>Error! </strong> ' + $msg + '</span>';
    $html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">';
    $html += '   <span aria-hidden="true">&times;</span>';
    $html += '</button>';
    $html += '</div>';
    return $html;
}

function success($msg) {
    $html = ' <div class="alert alert-success alert-dismissible fade show" role="alert">';
    $html += '<span class="alert-icon"><i class="ni ni-like-2 mr8"></i></span>';
    $html += '<span class="alert-text"><strong>Success! </strong> ' + $msg + '</span>';
    $html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">';
    $html += '   <span aria-hidden="true">&times;</span>';
    $html += '</button>';
    $html += '</div>';
    return $html;
}

function loadResorvation($rTab = '', $search = '',  $page = 1, serchBy = '', serchByValue = '') {
    
    var rTab = $rTab;
    var search = $search;
    var page = $page;

    if (rTab == '') {
        rTab = 'all';
    }
    
    $('#loadReservationCountContent a').removeClass('active');
    $('#'+rTab).addClass('active');

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'load_resorvation', rTab: rTab, search: search, page: page, serchBy:serchBy, serchByValue:serchByValue },
        success: function (data) {
            var response = JSON.parse(data);
            var resData = response.data;
            var pagination = response.pagination;
            var paginationList = '';
            let paginationHtml = '';

            page = (page == '') ? 1 : page;

            if(pagination > 0){
                for (let i = 1; i <= pagination; i++) {
                    var active = (page == i) ? 'active' :'';
                    paginationList += `<li class="paginate_button ${active}"><a href="javascript:void(0)" onclick="loadResorvation('all','','${i}')">${i}</a></li>`;
                }
            }

            if(pagination > 0){
                paginationHtml = `
                    <ul class="pagination">
                        ${paginationList}
                    </ul>
                `;
            }

            let tableRow = '';
            let countTotalRooms = 0;
            let countTotalPrice = 0;

            let tableFooter = '';

            if(resData.length > 0){
                $.each(resData, (index,val)=>{
                    let bid = val.bookingMainId;
                    let reciptNo = generateNumber(val.reciptNo);
                    let GuestName = val.guestName;
                    let rooms = val.totalRooms;
                    countTotalRooms += parseInt(rooms);
                    let staffName = val.staffName;
                    let travelAgent = val.travelAgent;
                    let checkIn = moment(val.mainCheckIn).format('DD MMM, YY');
                    let checkOut = moment(val.mainCheckOut).format('DD MMM, YY');
                    let checkInTime = val.checkInTime;
                    let checkOutTime = val.checkOutTime;
                    let checkInTimeFormat = (checkInTime != '00:00:00') ? ', '+moment(checkInTime, 'hh:mm:ss').format('LT') : '';
                    let checkOutTimeFormat = (checkInTime != '00:00:00') ? ', '+moment(checkOutTime, 'hh:mm:ss').format('LT') : '';
                    let night = val.nightCount;
                    let pax = val.totalAdult + '/' + val.totalChild;
                    let total = rupeesFormat(val.totalBookingPrice);
                    countTotalPrice += parseFloat(val.totalBookingPrice);

                    let checkinstatusArray = getCheckInStatus(val.status);
                    let statusCls = checkinstatusArray.btnCls;
                    let statusBtn = checkinstatusArray.name;
    
                    let grcLink = `${webUrl}grc?id=${bid}`;
                    let voucherLink = `${webUrl}view-voucher?id=${bid}`;
                    let agentLink = `${webUrl}view-voucher?id=${bid}&type=agent`;
                    let noShowBtn = (val.status == 1) ? `<li><button onclick="makeNoShowReservation(${bid})">Mark As No Show</button></li>` : '';
                    let cancelResBtn = (val.status == 1) ? `<li><button onclick="makeCancelReservation(${bid})">Void Reservation</button></li>` : '';
                    let addPaymentBtn = (val.status == 1) ? `<li><button onclick="loadAddPaymentForm(${bid})">Add Payment</button></li>` : '';

                    tableRow += `
                        <tr>
                            <td>${reciptNo}</td>
                            <td>${GuestName}</td>
                            <td>${rooms}</td>
                            <td>${checkIn}${checkInTimeFormat}</td>
                            <td>${night}</td>
                            <td>${checkOut}${checkOutTimeFormat}</td>
                            <td>${pax}</td>
                            <td>${total}</td>
                            <td><span style="border-radius: 2px;" class="badge ${statusCls}">${statusBtn}</span></span></label></td>
                            <td>${travelAgent}</td>
                            <td>${staffName}</td>
                            <td><button data-tooltip-top="View Booking" onclick="viewBookingReport(${bid})"><i class="fas fa-eye"></i></button></td>
                            <td class="no-export">
                                <div class="customDropdown" style="display: flex;justify-content: center;">
                                    <button class="btnCD reservationDetailActionBtn">
                                        <span></span><span></span><span></span>
                                    </button>
                                    <ul>
                                        ${noShowBtn}
                                        ${cancelResBtn}
                                        ${addPaymentBtn}
                                        <li><a href="${grcLink}" target="_blank" >GRC</a></li>
                                        <li><a onclick="viewBookingReport(${bid})" href="javascript:void(0)">View Booking</a></li>
                                        <li><a target="_blank" href="${agentLink}">Agent Voucher</a></li>
                                        <li> <a href="${voucherLink}" target="_blank">Guest Voucher</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `;
    
                });
                tableFooter = `
                    <tfoot>
                        <tr style="background: #e5e5e5;">
                            <th colspan="2"><h4>Total</h4></th>
                            <th colspan="5"><h4 style="font-weight: 500;">${countTotalRooms}</h4></th>
                            <th colspan="6"><h4 style="font-weight: 500;">${rupeesFormat(countTotalPrice)}</h4></th>
                        </tr>
                    </tfoot>
                `;
            }else{
                tableRow = `<tr><td colspan="100%">No Data</td></tr>`;
            }


            let html = `
                        <table id="reservationTable" class="table">
                            <thead>
                                <tr>
                                    <th>Booking No</th>
                                    <th>Guest Name</th>
                                    <th>Rooms</th>
                                    <th>Arrival</th>
                                    <th>Night</th>
                                    <th>Departure</th>
                                    <th>Pax</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Refer to</th>
                                    <th>Book By</th>
                                    <th>View</th>
                                    <th class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tableRow}
                            </tbody>
                            ${tableFooter}
                        </table>

                        ${paginationHtml}
            `;

            $('#resorvationContent').html(html);

        }
    });



}

function reservationCountNavBar($rTab = '', $group = '', $currentDate = '') {
    var rTab = $rTab;
    var group = $group;
    var currentDate = $currentDate;
    // if (rTab == '') {
    //     rTab = 'reservation';
    // }
    // $.ajax({
    //     url: 'include/ajax/room.php',
    //     type: 'post',
    //     data: {
    //         type: 'loadReservationCountNavBar',
    //         rTab: rTab,
    //         group: group,
    //         currentDate: currentDate
    //     },
    //     success: function (data) {
    //         $('#loadReservationCountContent').html(data);
    //     }
    // });
}

function convertArryToJSON($arry) {
    var array = $arry;
    $.ajax({
        url: webUrl + 'include/ajax/otherDetail.php',
        type: 'post',
        data: { type: 'convertArryToJSON', array: array },
        success: function (data) {
            $('#guestContent').html(data);
        }
    });
}

function loadGuest(page = '', limit=15,action='',form='',to='') {
    var date = $('#filterWithDate').val();
    var district = $('#filterWithDis').val();
    var search = $('#filterWithSearch').val();
    var loadTable = window.tableSkeleton;
    $('#guestListTableContent').html(loadTable);
    $.ajax({
        url: webUrl + 'include/ajax/guest.php',
        type: 'post',
        data: { type: 'loadGuest', search: search, page: page, limit: limit,date: date,district: district,action: action,form: form,to: to },
        success: function (data) {
            var response = JSON.parse(data);
            var data = response.data;
            var totalPage = response.page;
            var paginationHtml = '';
            var paginationList = ''

            page = (page == '') ? 1 : page;

            if(totalPage > 0){
                for (let i = 1; i <= totalPage; i++) {
                    var active = (page == i) ? 'active' :'';
                    paginationList += `<li class="paginate_button ${active}"><a href="javascript:void(0)" onclick='loadGuest(${i})'>${i}</a></li>`;
                }

                paginationHtml = `
                    <ul class="pagination">
                        ${paginationList}
                    </ul>
                `;
            }

            var tableBody = '';
            if(data.length > 0){
                var sn =0;
                $.each(data, (key,val)=>{
                    sn ++;
                    var gId = val.id;
                    var name = val.name;
                    var email = val.email;
                    var phone = val.phone;
                    var state = (val.state == null) ? '' : val.state;
                    var district = (val.district == null) ? '' : val.district;
                    var guestImg = val.guestImg;
                    var userAccess = val.userAccess;
                    var userRole = val.userRole;

                    var deleteHtml = '';
                    var updateHtml = '';

                    if(userRole != 1){
                        if(userAccess == 'editor'){
                            updateHtml = `<a class='tableIcon update bg-gradient-info editGuestOnGuestPage' data-gid="${gId}" data-page='guest' href='javascript:void(0)' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>`;
                        }
                        if(userAccess == 'full'){
                            deleteHtml = `<a data-gid="${gId}" class='tableIcon delete bg-gradient-warning guestDetailBtn'  href='javascript:void(0)' data-tooltip-top='Detail Log'><i class='fas fa-info'></i></a>`;
                            updateHtml = `<a class='tableIcon update bg-gradient-info editGuestOnGuestPage' data-gid="${gId}" data-page='guest' href='javascript:void(0)' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>`;
                        }
                    }else{
                        deleteHtml = `<a data-gid="${gId}" class='tableIcon delete bg-gradient-warning guestDetailBtn'  href='javascript:void(0)' data-tooltip-top='Detail Log'><i class='fas fa-info'></i></a>`;
                        updateHtml = `<a class='tableIcon update bg-gradient-info editGuestOnGuestPage' data-gid="${gId}" data-page='guest' href='javascript:void(0)' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>`;

                    }
                    
                    
                    tableBody += `<tr id="guestNameCheckRow'.$si.'" class="guestCheckRow">
                                <td class="text-center">${sn}</td>
                                <td data-label="Image" class="text-left">
                                <label for="guestNameCheck'.$si.'"><img class="guestImg"src="${guestImg}"> ${name} </label></td>
                                <td data-label="Email" class="text-center">${email}</td>
                                <td data-label="Phone" class="text-center">${phone}</td>
                                <td data-label="Block" class="text-center">${state}</td>
                                <td data-label="Block" class="text-center">${district}</td>
                                <td data-label="Action" class="iconCon ">
                                    <div class="tableCenter">
                                        <span class="tableHide"><i class="fas fa-ellipsis-h"></i></span>
                                        <span class="tableHoverShow">                                            
                                            ${updateHtml}
                                            ${deleteHtml}
                                        </span>
                                    </div>
                                </td>
                            </tr>`;
                })
            }else{
                tableBody += '<tr><td colspan="100%">No Data</td></tr>'
            }


            var html = `

                <div id="guestDataCon">
                    <table id="guestListTable" border="1" class="table align-items-center mb-0 tableLine">
                        <thead>
                            <tr>
                                <th scope="col" class="text-left">SN.</th>
                                <th scope="col" class="text-left">Guest name</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Phone</th>
                                <th scope="col" class="text-center">State</th>
                                <th scope="col" class="text-center">District</th>
                                <th scope="col" class="text-right"></th>
                            </tr>
                        </thead>

                        <tbody>
                            ${tableBody}
                        </tbody>
                    </table>
                </div>


                ${paginationHtml}

                

            `;
            $('#guestListTableContent').html(html);
        }
    });

}

function loadRoomView($slug = '', $currentDate = '', $rTab = '') {
    var slug = $slug;
    var date = $currentDate;
    var rTab = $rTab;
    var html = '<div class="col-xl-3 col-md-4 col-sm-6 col-xs-12"><div class="roomNumDummyCon content roomContent"><div class="blankIcon"></div><div class="iconCon dummystuf"><div></div><div></div></div><div class="caption"><span class="dummystuf"></span> <br><small class="opc5 dummystuf"></small></div><div class="roomViewfoot dFlex jcsb aic"><ul><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li></ul><div class="dummystuf"></div></div></div></div><div class="col-xl-3 col-md-4 col-sm-6 col-xs-12"><div class="roomNumDummyCon content roomContent"><div class="blankIcon"></div><div class="iconCon dummystuf"><div></div><div></div></div><div class="caption"><span class="dummystuf"></span> <br><small class="opc5 dummystuf"></small></div><div class="roomViewfoot dFlex jcsb aic"><ul><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li></ul><div class="dummystuf"></div></div></div></div><div class="col-xl-3 col-md-4 col-sm-6 col-xs-12"><div class="roomNumDummyCon content roomContent"><div class="blankIcon"></div><div class="iconCon dummystuf"><div></div><div></div></div><div class="caption"><span class="dummystuf"></span> <br><small class="opc5 dummystuf"></small></div><div class="roomViewfoot dFlex jcsb aic"><ul><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li></ul><div class="dummystuf"></div></div></div></div><div class="col-xl-3 col-md-4 col-sm-6 col-xs-12"><div class="roomNumDummyCon content roomContent"><div class="blankIcon"></div><div class="iconCon dummystuf"><div></div><div></div></div><div class="caption"><span class="dummystuf"></span> <br><small class="opc5 dummystuf"></small></div><div class="roomViewfoot dFlex jcsb aic"><ul><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li><li class="dummystuf"></li></ul><div class="dummystuf"></div></div></div></div>';
    $('#loadRomeViewRoomNumCon').children('div').html(html);
    $.ajax({
        url: 'include/ajax/roomView.php',
        type: 'post',
        data: {
            type: 'loadRoomView',
            slug: slug,
            date: date,
            rTab: rTab
        },
        success: function (data) {
            $('#loadRomeViewRoomNumCon').children('div').html(data);
        }
    });

}

function getNextDateByCurrentDate($date) {
    var date = $date;
    var checkInDate = $('#checkInReservation').val;
    var checkOutDate = $('#checkOutReservation').val;

    if (date == '') {
        var d = Date();
        a = d.toString();
        date = a;
    }

    if (checkInDate == checkOutDate) {
        $.ajax({
            url: webUrl + 'include/ajax/otherDetail.php',
            type: 'post',
            data: { type: 'getNextDateByCurrentDate', date: date },
            success: function (data) {
                $('#checkOutReservation').val(data).prop('disabled', false);
            }
        });
    }


}

function loadAddGuestData() {
    $.ajax({
        url: webUrl + 'include/ajax/guest.php',
        type: 'post',
        data: { type: 'load_add_guest' },
        success: function (data) {
            $('#loadAddGuest').html(data);
        }
    });
}

function loadBusinessSource($id) {
    var id = $id;
    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'getBusinessSource', id: id },
        success: function (data) {
            $('#businessSourceId').prop('disabled', false);
            $('#businessSourceId').html(data);
        }
    });
}

function loadRoomDetailByRoomNo($rno = '', $action = '', $roomNum = '', $checkIn = '', $checkOut = '') {
    var rno = $rno;
    var action = $action;
    var roomNum = $roomNum;
    var checkIn = $checkIn;
    var checkOut = $checkOut;
    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'getRoomDetailByRoomNo', rno: rno, action: action, roomNum: roomNum, checkIn: checkIn, checkOut: checkOut },
        success: function (data) {
            $('#roomDetailId').append(data);
        }
    });
}

function loadAddResorvation($bid = '', $page = '', $checkIn = '', $checkOut = '', $roomNum = '') {
    var bid = $bid;
    var page = $page;
    var checkIn = $checkIn;
    var checkOut = $checkOut;
    var roomNum = $roomNum;

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'load_add_resorvation', bid: bid, page: page, checkIn: checkIn, checkOut: checkOut, roomNum: roomNum },
        success: function (data) {

            loadBusinessSource(1);
            loadRoomDetailByRoomNo(1, '', roomNum, checkIn, checkOut);
            loadReservationPreview();

            $('#loadRoomViewRoomNumCon').css('display', 'none !important');

            $('#loadAddResorvation').html(data);

            
            // $('#checkInReservation').datepicker({});


            $('#checkOutReservation').datepick({
                dateFormat: 'M d, yyyy', monthsToShow: 1, minDate: 0, defaultDate: '-1w', selectDefaultDate: true, onSelect: function (dates) {
                    loadReservationPreview();
                }
            });


            $('#loadAddResorvation').show();

        }
    });
}

$(document).on('submit','#addReservationForm', function(e){
    e.preventDefault();
});

$(document).on('mouseover', '.reservationRateAreaIcon', function () {
    $(this).siblings('.overflowContent').addClass('show');
});

$(document).on('mouseleave', '.reservationRateAreaIcon', function () {
    $(this).siblings('.overflowContent').removeClass('show');
});

function loadReservationPreview() {
    setTimeout(function(){
        var formData = $('#addReservationForm').serialize() + '&type=loadReservationPreview';

        $.ajax({
            url: webUrl + 'include/ajax/resorvation.php',
            type: 'post',
            data: formData,
            success: function (data) {
                $('#loadAddResorvation .reservationContentPreview').html(data);
            }
        });
    },500) 
}

function getChildData($target, $rid, $adult = '') {
    var id = $rid;
    var target = $target;
    var adult = $adult;

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'getChildCountByRIdAndAdult', id: id, adult: adult },
        success: function (data) {
            target.prop('disabled', false);
            target.html(data);
        }
    });
}

function getRoomNum($target, $rid, $checkIn = '', $checkOut = '', filter = '') {
    var id = $rid;
    var target = $target;
    var checkIn = $checkIn;
    var checkOut = $checkOut;

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'getRoomNumByRID', id: id, checkIn: checkIn, checkOut: checkOut, filter: filter },
        success: function (data) {
            target.prop('disabled', false);
            target.html(data);
        }
    });
}

function getTotalSingleRoomPrice($target, $rid, $rdid = '', $checkIn = '', $checkOut = '', $adult = '', $child = '', $couponCode = '') {
    var rid = $rid;
    var rdid = $rdid;
    var adult = $adult;
    var child = $child;
    var checkIn = $checkIn;
    var checkOut = $checkOut;
    var couponCode = $couponCode;
    var target = $target;
    var overflowContent = target.siblings('.content');

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'getTotalSingleRoomPrice', rid: rid, rdid: rdid, adult: adult, child: child, checkIn: checkIn, checkOut: checkOut, couponCode: couponCode },
        success: function (data) {
            var result = JSON.parse(data);
            var roomPrice = result.roomPrice;
            var adultPrice = result.adultPrice;
            var childPrice = result.childPrice;
            var gstPer = result.gstPer;
            var gstPrice = result.gstPrice;
            var totalPrice = result.totalPrice;
            target.val(totalPrice);
            overflowContent.find('.roomPricesSec').html(roomPrice);
            overflowContent.find('.adultPricesSec').html(adultPrice);
            overflowContent.find('.childPricesSec').html(childPrice);
            overflowContent.find('.gstPricesSec').html(gstPrice);
        }
    });
}

function showGuestDetailPopUp($roomNum = '', $bid = '', $id = '', $btn = '', $rTab = '', $bdid = '', $page = '') {
    var roomNum = $roomNum;
    var bId = $bid;
    var id = $id;
    var btn = $btn;
    var rTab = $rTab;
    var bdid = $bdid;
    var page = $page;
    $('#bookindDetail .content').html('<div class="loadingIcon"><img src="' + loadingGif + '"></div>');

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { 'type': 'showPopUpGuestDetail', roomNum: roomNum, bId: bId, id: id, btn: btn, rTab: rTab, bdid: bdid, page: page },
        success: function (data) {
       
            $('#bookindDetail .content').html(data);

        }
    });
}

function loadAddGuestReservationForm($bId = '', $target, $bdid = '', $gid = '', $serial = '', $gustImg = '', $guestProofImg = '', $rTab = '', $page = '', $function = '', $action = '', $roomNum = '') {
    var bid = $bId;
    var target = $target;
    var bdid = $bdid;
    var gid = $gid;
    var serial = $serial;
    var gustImg = $gustImg;
    var guestProofImg = $guestProofImg;
    var rTab = $rTab;
    var page = $page;
    var customFunction = $function;
    var action = $action;
    var roomNum = $roomNum;
    $.ajax({
        url: webUrl + 'include/ajax/guest.php',
        type: 'post',
        data: { 'type': 'loadAddGuestReservationForm', bid: bid, bdid: bdid, gid: gid, serial: serial, gustImg: gustImg, guestProofImg: guestProofImg, rTab: rTab, page: page, action: action, roomNum: roomNum },
        success: function (data) {

            if (gid == '') {
                var title = 'Add Guest';
                var btn = 'Add Guest';
            } else {
                title = 'Edit Guest';
                btn = 'Update Guest';
            }

            showModalBox(title, btn, data, 'editGuestSubmitBtn', 'modal-xl');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
            myModal.show();

            if (customFunction != '') {
                window.localStorage.setItem('guestCustomFunction', JSON.stringify(customFunction))
            }

            $('#guestBirthday').datepicker({
                format: 'dd-mm',
                autoclose: true,
                todayHighlight: true,
            });

            $('#guestAnniversary').datepicker({
                format: 'dd-mm',
                autoclose: true,
                todayHighlight: true,
            });

        }
    });
}

function loadAddGuestReservationFormSubmit($page = '', rnum='',action='') {
    var page = window.filePath;
    var formData = new FormData($('#reservationAddGuestForm')[0]);
    $.ajax({
        url: webUrl + 'include/ajax/guest.php',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (data) {
            var response = JSON.parse(data);
            var status = response.status;
            var bid = response.bid;
            var bdid = response.bdid;

            // if (window.localStorage.getItem("guestCustomFunction") === null) {

            // } else {
            //     var guestContent = JSON.parse(window.localStorage.getItem
            //         ("guestCustomFunction"));
            //     generateArrayToFunction(guestContent);
            // }
            
            if(status == 'success'){
                
                if (page == 'guest-list') {
                    loadGuest();
                }else if(page == 'todays-event'){
                    generateGuestListById(bid,bdid);
                }else if (filePath == 'reservation-edit') {
                    loadEditResturentReport('guests', bid);
                } else if (action == 'editRes') {
                    buildReservationDetail(bid, rnum);
                }

                sweetAlert("Successfull update guest details.");
            }
        }
    });
}

function closeContent($clickableId, $actionId) {
    var clickableId = $clickableId;
    var actionId = $actionId;
    $(document).on('click', clickableId, function (e) {
        e.preventDefault;
        $(actionId).hide();
    });
}


function imageTagInsert($target, $path, $width = '80', $type = '', $fullPath = '') {
    var path = $path;
    var target = $target;
    var width = $width;
    var type = $type;
    var imgPath = $fullPath;

    var html = "<img width=" + width + " data-img=" + path + " src=" + imgPath + " /> <input type='hidden' name=" + target + " id=" + target + " value=" + path + ">";

    $('.' + target).html(html);
}

function removerImgWithName($target, $filename) {
    var target = $target;
    var filename = $filename;
    $.ajax({
        url: webUrl + 'include/ajax/otherDetail.php',
        type: 'post',
        data: { 'type': 'removerImgWithName', target: target, filename: filename },
        success: function (data) {


        }
    });

}


function getOptionByRoomId($target, $roomId, $type, $bdid = '') {
    var target = $target;
    var roomId = $roomId;
    var type = $type;
    var bdid = $bdid;
    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'getOptionByRoomId', roomId: roomId, opType: type, bdid: bdid },
        success: function (data) {
            $(target).html(data);
        }
    });
}

$(document).on('click', '#configBtn', function () {
    $(this).parent().find('.dropdown-menu').toggleClass('show');
});

$(document).on('change', '#roomQuntityNoId', function () {
    var roomNo = $('#roomQuntityNoId').val();
    loadRoomDetailByRoomNo(roomNo);
    loadReservationPreview();
});

$(document).on('click', '.quantityMinus', function (e) {
    e.preventDefault();
    loadReservationPreview();
    var input = $(this).parent().siblings();
    var value = input.val();
    if (value > 1) {
        value--;
    }
    input.val(value);
    var rowLength = $('#roomDetailId tr').length;
    if (rowLength > 1) {
        $('#roomDetailId tr:last-child').remove();
    }

});

$(document).on('click', '.quantityPlus', function (e) {
    e.preventDefault();
    loadReservationPreview();
    var input = $(this).parent().siblings();
    var value = input.val();
    value++;
    input.val(value);
    loadRoomDetailByRoomNo(value);
});

$(document).on('click', '#guestDetail', function () {
    $('#popupBox').addClass('show');
});

$(document).on('click', '#popupBox .closeBox', function () {
    $('#popupBox').removeClass('show');
});

$(document).on('click', '#popupBox .closeContent', function () {
    $('#popupBox').removeClass('show');
});

$(document).on('change', '#bookngSourceId', function () {
    var id = $(this).val();
    loadBusinessSource(id);
});

$(document).on('change', '#checkIn', function () {
    loadReservationPreview();
});

$(document).on('change', '#couponCode', function () {
    loadReservationPreview();
});

$(document).on('change', '#reservationType', function () {
    loadReservationPreview();
});

$(document).on('change', '#bookngSourceId', function () {
    loadReservationPreview();
});

$(document).on('change', '#businessSourceId', function () {
    loadReservationPreview();
});

$(document).on('click', '#roomDetailIncBtnId', function (e) {
    e.preventDefault();
    loadRoomDetailByRoomNo('', 'btn');
    var value = $('#roomQuntityNoId').val();
    loadReservationPreview();
});

$(document).on('change', '.selectRoomId', function (e) {
    e.preventDefault();

    loadReservationPreview();

});

$('#addReservationForm').on('keypress', 'input', function(e) {
    if (e.which == 13) {
        e.preventDefault();
        return false;
    }
});

$(document).on('change', '.adultSelect', function () {
    loadReservationPreview();
});

$(document).on('change', '.rateTypeId', function () {
    loadReservationPreview();
});

$(document).on('change', '.totalPriceSection', function (e) {
    e.preventDefault();
    loadReservationPreview();
});

$(document).on('change', '.roomGst', function () {
    loadReservationPreview();
});

$(document).on('change', '.childSelect', function () {
    loadReservationPreview();
});

$(document).on('change', '#guestName', function () {
    loadReservationPreview();
});

$(document).on('change', '#paidAmount', function () {
    loadReservationPreview();
});

$(document).on('click', '#backBtnForPoupUpContent', function (e) {
    e.preventDefault();
    var page = window.filePath;
    $('.reservationTab').removeClass('active');

    if (page == 'reservations') {
        loadResorvation('all');
        $('#loadReservationCountContent #all').addClass('active');
        $('.nav-indicator').css({"width": "99px", "left": "45px"});
    }else if (page == 'stay-view'){
        var date = $('#currentDateStart').val();
        loadStayView(date);
    }else if (page == 'walk-in'){
        window.location.href = `${webUrl}reservations`;
    }else if(page == 'room-view'){
        $('#loadAddResorvation').hide();
        loadRoomView();
    }

});

$(document).on('click', '#searchBtnReservation', function (e) {
    e.preventDefault();
    $('#searchForReservation').css('display', 'inline-flex');
});

$(document).on('click', '#searchForCloseBtn', function (e) {
    e.preventDefault();
    $('#searchForReservation').hide();
    $('#searchForReservationValue').val('');
});

$(document).on('click', '#excelExport', function (e) {
    e.preventDefault();
    var idName = $('.reservationTab.active').prop('id');

    $.ajax({
        url: webUrl + 'include/ajax/resorvation.php',
        type: 'post',
        data: { type: 'generatrExcelSheet', sheetType: idName },
        success: function (data) {
            console.log(data);
        }
    });

});

$(document).on('change', '#searchForReservationValue', function (e) {
    e.preventDefault();
    var searchVal = $(this).val();
    loadResorvation('', searchVal);
});

// $(document).on('click', '.reservationDetailActionBtn', function () {
//     var bookingId = $(this).data('bookingid');
//     var rTab = $(this).data('reservationtab');
//     var bdid = $(this).data('bdid');

//     $('#bookindDetail').addClass('show');
//     showGuestDetailPopUp('', bookingId, '', '', rTab, '');

// });

$(document).on('click', '.bookingRoomNumList li', function () {
    var bdid = $(this).data('bdid');
    var bookingId = $(this).data('bookingid');
    showGuestDetailPopUp('', bookingId, '', '', 'reservation', bdid);
});

$(document).on('click', '#editGuestSubmitBtn', function (e) {
    e.preventDefault();
    var page = $('#guestPage').val();
    var bdid = $('#bookingDId').val();
    var bid = $('#bookingId').val();
    var gid = $('#guestId').val();
    var action = $('#guestAction').val();
    var roomNum = $('#guestRoomNum').val();
    var rTab = 'reservation';

    var filePath = window.filePath;
    removeModal();
    loadAddGuestReservationFormSubmit(page,roomNum,action);
    

});

$(document).on('submit', '#reservationUpdateGuestForm', function (e) {
    e.preventDefault();
    loadAddGuestReservationUpdateFormSubmit();
    var bid = $(this).data('bid');

    showGuestDetailPopUp('', '', bid);
    $('#addGestOnReservation').hide();
});

$('#addReservationBtn').click(function () {
    console.log('clicked');
    var page = $(this).data('page');
    loadAddResorvation('', page);
});

$(document).on('click', '#noDataClickToReservation', function () {
    var page = $(this).data('page');

    if (page == '') {
        page = 'reservation';
    }

    loadAddResorvation('', page);

});

$(document).on('click', '#addReservationSubmitBtn', function (e) {
    e.preventDefault();
    var idName = $('.reservationTab.active').prop('id');
    var roomId = $('.selectRoomId').val();
    var guestName = $('#guestName').val();
    var page = window.filePath;

    var roomNumArray = $('.selectRoomId').toArray();
    var roomDetailArray = $('.rateTypeId').toArray();
    var errorArray = $('.error').toArray();

    var hasError = false;

    $.each(errorArray, (index, element) => {
        var innerHTMLContent = $(element).html();
        if(innerHTMLContent.trim() != ''){
            hasError = true;
        }
    });   

    var hasZeroValue = false;
    var roomDetailValue = false;

    $.each(roomNumArray, (index, element) => {
        if (element.value === "0") {
            hasZeroValue = true;
            return false;
        }
    });

    $.each(roomDetailArray, (index, element) => {
        var innerHTMLContent = $(element).html();
        if(element.value === "0"){
            roomDetailValue = true;
            return false;
        }
    });


    if (hasError) {
        e.preventDefault();
    }else{

        $(this).html('Loading...');
        $(this).addClass('disabled');

        if (roomId == '') {
            sweetAlert("Please select Room.", "error");
    
            $(this).html('Save');
            $(this).removeClass('disabled');
    
        } else if (hasZeroValue) {
            sweetAlert("Please select Room.", "error");
    
            $(this).html('Save');
            $(this).removeClass('disabled');
    
        } else if (roomDetailValue) {
            sweetAlert("Please select Rate plan.", "error");
    
            $(this).html('Save');
            $(this).removeClass('disabled');
    
        } else if (guestName == '') {
            sweetAlert("Please Enter Guest Detail.", "error");
    
            $(this).html('Save');
            $(this).removeClass('disabled');
    
        } else {
            
            $.ajax({
                url: webUrl + 'include/ajax/resorvationSubmit.php',
                type: 'post',
                data: $('#addReservationForm').serialize(),
                success: function (data) {
                    $('#loadAddResorvation').html('').hide();
                    $('#addReservationForm').trigger('reset');
                    sweetAlert("Successfull Add Reservation.");
    
                    $(this).html('Save');
                    $(this).removeClass('disabled');
    
                    if (page == 'reservations') {
                        $('#loadReservationCountContent a').removeClass('active');
                        loadResorvation('all');
                        $('#loadReservationCountContent #all').addClass('active');
                        $('.nav-indicator').css({"width": "99px", "left": "45px"});
                    }else if (page == 'walk-in'){
                        window.location.href = `${webUrl}reservations`;
                    }else if (page == 'stay-view'){
                        var date = $('#currentDateStart').val();
                        loadStayView(date);
                    }else if(page == 'room-view'){
                        loadRoomView();
                    }
    
                }
            });
        }
    }

    


});

$(document).on('click', '#excelImport', function () {
    $('#popupBox').addClass('show center');
    var html = `<form id="excelImportForm" method="post" enctype="multipart/form-data">
                    <h4>Import CSV File</h4>
                    <div class="btnGroup">
                        <div class="form-group">
                            <input checked type="radio" name="filter" id="beFilter" value="be" type="text">
                            <label for="beFilter">BE</label>
                        </div>
                    </div>
                    <div class="form-group fileInputSec">
                        <label for="csvFile">
                            <span><i class="fas fa-file-csv"></i></span> 
                            <strong class="fileName"></strong>
                        </label>
                        <input accept=".csv" type="file"  accept="image/jpeg" id="csvFile" name="csvFile">
                    </div>
                    <input class="btn bg-gradient-info excelSubmitBtn" type="submit" value="File Import">
                    <input type="hidden" name="type" value="excelImportSubmit">
                </form>`;
    $('#popupBox .content').html(html);


});

$(document).on('click', '#excelImport', function () {
    console.log('import');
    $('.box').css('overflow-x', 'hidden');
});


$(document).on('submit', '#excelImportForm', function (e) {
    e.preventDefault();

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: new FormData($('#excelImportForm')[0]),
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (data) {
            alert(data);
        }
    });

});

$(document).on('change', '#csvFile', function (e) {
    var fileName = e.target.files[0].name;
    $('#excelImportForm .fileName').html(fileName);
});


$(document).on('click', '.roomViewSideTab li', function () {
    $('.roomViewSideTab li').removeClass('active');
    $(this).addClass('active');
    var currentDate = $('#roomViewCurrentDate').val();
    var roomSlug = $(this).data('rslug');

    loadRoomView(roomSlug, currentDate);
});

$(document).on('change', '#roomViewCurrentDate', function () {
    var currentDate = $('#roomViewCurrentDate').val();
    var roomSlug = $('.roomViewSideTab .active').data('rslug');

    loadRoomView(roomSlug, currentDate);
});


// Room View start 

$(document).on('click', '.roomContent', function () {
    var roomNumber = $(this).data('roomnumber');
    var date = $('#roomViewCurrentDate').val();
    var rTab = $('.roomViewNav.active').attr('id');

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'checkRoomNumber', roomNumber: roomNumber, date: date },
        success: function (data) {
            console.log(data);
            var responce = JSON.parse(data);

            if (responce.type == 'popUp') {
                var roomNum = responce.roomNo;
                var bid = responce.bid;
                var bdid = responce.bdid;
                $('#bookindDetail').addClass('show');
                showGuestDetailPopUp(roomNum, bid, bdid, '', rTab, bdid);
            }

            if (responce.type == 'false') {
                $('#loadAddResorvation').show();
                loadAddResorvation('', 'roomView','','',roomNumber);
            }
        }
    });

});

$(document).on('click', '#bookindDetail .closeContent', function () {
    $('#bookindDetail').removeClass('show');
    $('#bookindDetail .container').html('');
});

$(document).on('click', '#bookindDetail .closeBox', function () {
    $('#bookindDetail').removeClass('show');
    $('#bookindDetail .container').html('');
});

// Reservation Btn Start

function guestPopUpBox($bid = '', $serial = '', $gid = '', $type = '') {
    var bid = $bid;
    var serial = $serial;
    var type = $type;
    var gid = $gid;

    var html = '<div id="guestPopupFixContent" data-imgtype="' + $type + '">' +
        '<div class="closeGuestPopupFixContent"></div>' +
        '<div class="guestDocContent">' +
        '<div class="closeContent">x</div>' +
        '<div class="content">' +
        '<div class="dFlex jcsb">' +
        '<div id="guestPhotoWithWebCam" data-bid="' + bid + '" data-serial="' + serial + '" data-gid="' + gid + '" class="leftSide"><i class="fas fa-camera"></i> <span>Webcam</span></div>' +
        '<div id="guestPhotoWithWebsite" data-type="' + type + '" data-bid="' + bid + '" data-serial="' + serial + '" data-gid="' + gid + '" class="rightSide"><i class="fas fa-qrcode"></i> <span>QR Code</span></div>' +
        '</div>' +
        '<div class="dFlex">' +
        '<div class="inputField">' +
        '<label for="guestIdProofImg"><span>Choose Guest Proof Image</span></label>' +
        '<input type="file" accept="image/jpeg" data-bid="' + bid + '" data-gid="' + gid + '" accept="image/jpeg" data-serial="' + serial + '" name="guestIdProofImg" id="guestIdProofImg">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        +'</div>';

    return html;
};

var webcamScript = 'https://unpkg.com/webcam-easy/dist/webcam-easy.min.js';

function checkInGuestFun(roomNumber = '', rBID, bdid = '', currentDate = '', rTab = '') {

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'checkRoomCheckIn', roomNumber: roomNumber, rBID: rBID, bdid: bdid, currentDate: currentDate },
        success: function (data) {
            var result = JSON.parse(data);
            var status = result.status;
            var msg = result.msg;

            var page = window.filePath;
            // console.log(status);
            if (status == 1) {            
                sweetAlert("Successfully " + msg );                   
                     
                
                showGuestDetailPopUp('', '', '', '', rTab, bdid);
                
                if (page == 'stayview') {
                    var pagerid = pageArr[1];
                    loadStayView('', pagerid);
                } else if (page == 'reservations') {
                    loadResorvation('all');
                } else if (page == 'room-view') {
                    loadRoomView();
                } else if (page == 'stay-view') {
                    var currentDate = $.datepicker.formatDate('yy-mm-dd', new Date());
                    loadStayView(currentDate);
                } else if (page == 'reservation-edit') {
                    if(msg == 'checked-out')
                    {
                        loadEditResturentReport('checkOut', rBID);
                    }
                    else if(msg == 'checked-in'){
                        loadEditResturentReport('checkIn', rBID);
                    }
                    
                }
            }

            if (status == 0) {
                showGuestDetailPopUp('', '', '', '', rTab, bdid);
                sweetAlert(msg, "error");
            }

        }
    });
}

$(document).on('click', '#checkInStatus', function () {
    var roomNumber = $(this).data('roomnum');
    var rTab = $(this).data('reservationtab');
    var rBID = $(this).data('bookingid');
    var bdid = $(this).data('bdid');
    var currentDate = $('#currentDateStart').val();
    var spiner = '<div id="spinner" class="spinner"><div class="circle one"></div><div class="circle two"></div><div class="circle three"></div></div>';
    $(this).html(spiner);
    checkInGuestFun(roomNumber, rBID, bdid, currentDate);
});

$(document).on('click', '#paymentBtn', function () {
    console.log('test');
    var rTab = $(this).data('reservationtab');
    var rBID = $(this).data('bookingid');
    var bdid = $(this).data('bdid');



    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'paymentBtnClick', rTab: rTab, rBID: rBID, bdid: bdid },
        success: function (data) {
            $('#bookingOtherDetail').show();
            $('#bookingOtherDetail').html(data);

        }
    });
});

$(document).on('click', '#printBtn', function () {
    var rBID = $(this).data('bookingid');
    var bdid = $(this).data('bdid');

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'printBtnClick', rBID: rBID, bdid: bdid },
        success: function (data) {
            $('#bookingOtherDetail').show();
            $('#bookingOtherDetail').html(data);
        }
    });
});

$(document).on('click', '#checkInOutBtn', function () {
    var rTab = $(this).data('reservationtab');
    var rBID = $(this).data('bookingid');
    var bdid = $(this).data('bdid');
    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'checkInOutBtnClick', bdid: bdid, rTab: rTab, rBID: rBID },
        success: function (data) {
            $('#bookingOtherDetail').show();
            $('#bookingOtherDetail').html(data);
        }
    });
});

$(document).on('click', '#roomMoveBtn', function () {
    var rDId = $(this).data('bdid');
    var rTab = $(this).data('reservationtab');
    var rBID = $(this).data('bookingid');
    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: { type: 'roomMoveBtnClick', rDId: rDId, rTab: rTab, rBID: rBID },
        success: function (data) {
            $('#bookingOtherDetail').show();
            $('#bookingOtherDetail').html(data);
        }
    });
});

$(document).on('click', '#cancleReservation', function () {
    var bid = $(this).data('bookingid');
    var bdid = $(this).data('bdid');
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel It!'
    })
        .then((willDelete) => {
            function deleteRoomNumber() {
                $.ajax({
                    url: 'include/ajax/room.php',
                    type: 'post',
                    data: { type: 'deleteRoomRecord', bid: bid, bdid: bdid },
                    success: function (data) {
                        if (data == 1) {
                            loadResorvation('all');
                            $('#bookindDetail').removeClass('show');
                            $('.Swal.fire2-container').remove();
                            Swal.fire('Deleted!', 'Your booking has been cancel.', 'success');
                        } else {
                            Swal.fire("Your booking is safe!");
                        }
                    }
                });
            }

            if (willDelete.isConfirmed) {
                deleteRoomNumber();
            }

        });
});

$(document).on('change', '#chooseRoomForMove', function () {
    var roomId = $(this).val();
    var bdid = $(this).data('bdid');

    getOptionByRoomId('#chooseRatePlaneForMove', roomId, 'rate', bdid);

    getOptionByRoomId('#chooseRoomTypeForMove', roomId, 'roomNum', bdid);

});

$(document).on('submit', '#paymentBtnClickForm', function (e) {
    e.preventDefault();
    var roomNum = $('#guestRoomNum').val();
    var rTab = $('#reservationtab').val();

    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: $('#paymentBtnClickForm').serialize(),
        success: function (data) {
            var result = JSON.parse(data);
            var error = result.error;
            var msg = result.msg;
            if (error == 'no') {
                sweetAlert(msg);

                $('#bookindDetail').removeClass('show');
                loadResorvation(rTab);
                loadRoomView();
            }

            if (error == 'yes') {
                sweetAlert(msg, "error");
            }

            // $('#alertCon').html(alertData);
        }
    });

});

$(document).on('submit', '#checkInOutBtnClickForm', function (e) {
    e.preventDefault();
    var roomNum = $('#checkInRoomNum').val();
    var rTab = $('#rTabType').val();
    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: $('#checkInOutBtnClickForm').serialize(),
        success: function (data) {
            var response = JSON.parse(data);
            var status = response.status;
            var msg = response.msg;

            if (status == 'success') {
                sweetAlert(msg);
            }
            if (status == 'error') {
                sweetAlert(msg, 'error');
            }
        }
    });

});

$(document).on('submit', '#roomMoveBtnClickForm', function (e) {
    e.preventDefault();
    var rTab = $(this).data('reservationtab');
    console.log($('#roomMoveBtnClickForm').serialize());
    $.ajax({
        url: webUrl + 'include/ajax/roomView.php',
        type: 'post',
        data: $('#roomMoveBtnClickForm').serialize(),
        success: function (data) {
            if (data == 1) {
                sweetAlert("Successfull move room.");
            }
            if (data == 0) {
                sweetAlert('Something Error', 'error');
            }
        }
    });

});

$(document).on('click', '.removeRoomView', function () {
    $('.bookingOtherDetail').html('').hide();
});

$(document).on('click', '#addGustBtn', function () {
    var bid = $(this).data('bookingid');
    var bdid = $(this).data('bdid');
    var rTab = $(this).data('rTab');

    loadAddGuestReservationForm(bid, '#addGestOnReservation .content', bdid, '', '', '', '', rTab);

});

$(document).on('click', '.editGuest', function () {
    var bdid = $(this).data('bdid');
    var bid = $(this).data('bid');
    var gid = $(this).data('id');

    loadAddGuestReservationForm(bid, '#addGestOnReservation .content', bdid, gid);
});

$(document).on('click', '#addGestOnReservation .closeContent', function () {
    if ($('#guestImgSec').length) {
        $img = $('#guestImgSec').val();
        removerImgWithName('guest', $img);
    }

    if ($('#guestProofImgSec').length) {
        $img = $('#guestProofImgSec').val();
        removerImgWithName('guestP', $img);
    }

    $('#addGestOnReservation').hide();
});

$(document).on('click', '#addGestOnReservation .closeGuestSec', function () {

    if ($('#guestImgSec').length) {
        $img = $('#guestImgSec').val();
        removerImgWithName('guest', $img);
    }

    if ($('#guestProofImgSec').length) {
        $img = $('#guestProofImgSec').val();
        removerImgWithName('guestP', $img);
    }

    $('#addGestOnReservation').hide();
});

$(document).on('click', '.guestProofImgSec', function () {
    var bid = $(this).data('bid');
    var serial = $(this).data('serial');
    var gid = $(this).data('gid');

    var html = guestPopUpBox(bid, serial, gid, 'proof');
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = webcamScript;
    $("head").append(s);
    $('body').append(html);
});

$(document).on('click', '#guestPhotoWithWebCam', function () {
    var imgType = $('#guestPopupFixContent').data('imgtype');
    var serial = $(this).data('serial');
    var gid = $(this).data('gid');

    var html = '<div id="webCamPopupFixContent">' +
        '<div class="closeGuestPopupFixContent"></div>' +
        '<div class="guestDocContent">' +
        '<div class="closeContent">x</div>' +
        '<div class="content">' +
        '<div class="webCamContent">' +
        '<video id="webcam" autoplay playsinline height="250px"></video>' +
        '<canvas id="canvas" class="d-none"></canvas>' +
        '<audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>' +
        '</div>' +

        '<div class="btnGroup">' +
        '<button data-imgtype="' + imgType + '" id="startWebCamBtn" class="pinkBtn">Sart Cam</button>' +
        '<button data-imgtype="' + imgType + '" id="captureWebCamBtn" class="disabled greenBtn">Capture</button>' +
        '<button data-imgtype="' + imgType + '" data-serial="' + serial + '" data-gid="' + gid + '" id="SaveWebCamBtn" class="disabled yellowBtn">Save Image</button>' +
        '<button data-imgtype="' + imgType + '" id="stopWebCamBtn" class="disabled redBtn">stop</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        +'</div>';

    $('body').append(html);
});

$(document).on('click', '#startWebCamBtn', function () {
    const webcamElement = document.getElementById("webcam");
    const canvasElement = document.getElementById("canvas");
    const snapSoundElement = document.getElementById("snapSound");
    const webcam = new Webcam(
        webcamElement,
        "user",
        canvasElement,
        snapSoundElement
    );
    $('#captureWebCamBtn').removeClass('disabled');
    $('#stopWebCamBtn').removeClass('disabled');
    webcam.start().then((result) => {
        console.log("webcam started");
    }).catch((err) => {
        console.log(err);
    });

});

$(document).on('click', '#captureWebCamBtn', function () {
    if ($(this).hasClass('disabled')) {
        alert('Please start the webcam');
    } else {
        const webcamElement = document.getElementById("webcam");
        const canvasElement = document.getElementById("canvas");
        const snapSoundElement = document.getElementById("snapSound");
        const webcam = new Webcam(
            webcamElement,
            "user",
            canvasElement,
            snapSoundElement
        );
        $('#SaveWebCamBtn').removeClass('disabled');
        var html = '<form id="webCamSaveDataForm"></form>';
        $('.webCamContent').append(html);
        webcam.snap();
    }

});

$(document).on('click', '#SaveWebCamBtn', function () {
    var imgType = $(this).data('imgtype');
    var serial = $(this).data('serial');
    var gid = $(this).data('gid');

    if ($(this).hasClass('disabled')) {
        alert('Please Capture Image.');
    } else {
        const webcamElement = document.getElementById("webcam");
        const canvasElement = document.getElementById("canvas");
        const snapSoundElement = document.getElementById("snapSound");
        const webcam = new Webcam(
            webcamElement,
            "user",
            canvasElement,
            snapSoundElement
        );

        var canvas = document.getElementById("canvas");
        var imageData = canvas.toDataURL('image/jpeg');
        var binaryData = dataURItoBlob(imageData);

        var formData = new FormData();
        var fileName = 'snap.jpg';    // filename
        formData.append('photo', binaryData, fileName);
        formData.append('imgType', imgType);
        formData.append('serial', serial);
        formData.append('gid', gid);

        $.ajax({
            type: "POST",
            url: webUrl + 'include/ajax/webScanSaveImg.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                try {
                    var returnData = JSON.parse(data);
                    var imgId = returnData.imgId;
                    var img = returnData.img;
                    var error = returnData.error;
                    var guestImg = returnData.imgFullPath;
                    var guestProofImg = returnData.guestProofImg;

                    if (error === "false") {

                        $('#webCamPopupFixContent').remove();
                        $('#guestPopupFixContent').remove();

                        if (imgType == 'guestImg') {
                            imageTagInsert('guestImgSec', img, '', 'guest', guestImg);
                            var imgObj = {'image': imgId};
                            insertDataInDatabase('guest', imgObj, gid);
                        }

                        if (imgType == 'proof') {
                            imageTagInsert('guestProofImgSec', img, '', 'guestP', guestProofImg);
                            var fileImgObj = {'kyc_file': imgId};
                            insertDataInDatabase('guest', fileImgObj, gid);
                        }
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });

    }
});

function dataURItoBlob(dataURI) {
    var byteString = atob(dataURI.split(',')[1]);
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: mimeString });
}
;


// $(document).on('click', '#SaveWebCamBtn', function () {
//     var imgType = $(this).data('imgtype');
//     var serial = $(this).data('serial');
//     // webCamSaveDataForm

//     var gid = $(this).data('gid');
//     if ($(this).hasClass('disabled')) {
//         alert('Please Capture Image.');
//     } else {
//         const webcamElement = document.getElementById("webcam");
//         const canvasElement = document.getElementById("canvas");
//         const snapSoundElement = document.getElementById("snapSound");
//         const webcam = new Webcam(
//             webcamElement,
//             "user",
//             canvasElement,
//             snapSoundElement
//         );
//         var canvas = document.getElementById("canvas");
//         // image = canvas;
//         image = document.getElementById('canvas');
//         var photo = image.toDataURL('image/jpeg');

//         var formData = new FormData();


//         var blob = new Blob([image], { type: 'application/octet-binary' });
//         var fileName = 'snap.png';    //filename
//         formData.append('something', photo);
//         formData.append('fileName', fileName);
//         formData.append('imgType',imgType);
//         formData.append('serial',serial);
//         formData.append('gid',gid);
//         formData.append('photo',photo);
//         $.ajax({
//             type: "POST",
//             url: webUrl + 'include/ajax/webScanSaveImg.php',
//             data: formData,
//             cache: false,
//             contentType: false,
//             processData: false,

//             success: function (data) {
//                 var returnData = JSON.parse(data);
//                 var bid = returnData.bid;
//                 var bdid = returnData.bdid;
//                 var status = returnData.status;
//                 var guestImg = returnData.guestImg;
//                 var guestProofImg = returnData.guestProofImg;

//                 if (status == 1) {

//                     $('div').remove('#webCamPopupFixContent');
//                     $('div').remove('#guestPopupFixContent');

//                     if (guestImg != '') {
//                         imageTagInsert('guestImgSec', guestImg, '', 'guest');
//                     }

//                     if (guestProofImg != '') {
//                         imageTagInsert('guestProofImgSec', guestProofImg, '', 'guestP');
//                     }

//                 }



//             }
//         });




//     }

// });

$(document).on('click', '#stopWebCamBtn', function () {
    if ($(this).hasClass('disabled')) {
        alert('Please start the webcam');
    } else {
        const webcamElement = document.getElementById("webcam");
        const canvasElement = document.getElementById("canvas");
        const snapSoundElement = document.getElementById("snapSound");
        const webcam = new Webcam(
            webcamElement,
            "user",
            canvasElement,
            snapSoundElement
        );
        webcam.stop();
    }

});


$(document).on('click', '#webCamPopupFixContent .closeContent', function () {
    $('#webCamPopupFixContent').remove();
    $('head script[src*="' + webcamScript + '"]').remove();
});

$(document).on('click', '#webCamPopupFixContent .closeGuestPopupFixContent', function () {
    $('#webCamPopupFixContent').remove();
    $('head script[src*="' + webcamScript + '"]').remove();
});

$(document).on('click', '#guestPopupFixContent .closeContent', function () {
    $('#guestPopupFixContent').remove();
});

$(document).on('click', '#guestPopupFixContent .closeGuestPopupFixContent', function () {
    $('#guestPopupFixContent').remove();
});

$(document).on('click', '#guestPhotoWithWebsite', function () {

    var gid = $(this).data('gid');
    var type = $(this).data('type');

    $.ajax({
        url: webUrl + 'include/ajax/guest.php',
        type: 'post',
        data: { type: 'guestPhotoProofeWithWebsite', gid: gid, fileType: type },
        success: function (data) {
            $('body').append(data);
        }
    });

});

$(document).on('change', '#guestIdProofImg', function () {

    var property = document.getElementById('guestIdProofImg').files[0];
    var image_name = property.name;
    var image_extension = image_name.split('.').pop().toLowerCase();
    var url = 'include/ajax/guest.php';
    if (jQuery.inArray(image_extension, ['jpg', 'jpeg', 'png']) == -1) {
        $('#msg').html('Invalid image file');
        return false;
    }

    var imgType = $('#guestPopupFixContent').data('imgtype');

    if (imgType == 'guestImg') {
        var guestImgType = 'guestIdImgSubmit';
    }

    if (imgType == 'proof') {
        var guestImgType = 'guestIdProofImgSubmit';
    }

    var file = $(this);
    var form_data = new FormData();
    var bid = $(this).data('bid');
    var serial = $(this).data('serial');
    var gid = $(this).data('gid');
    var error = $(this).attr('id');
    form_data.append("file", property);
    form_data.append("type", guestImgType);
    form_data.append("bid", bid);
    form_data.append("serial", serial);
    form_data.append("gid", gid);
    var guestNmae = $('[name="guestName"]').val();

    imageFileCheckAndUpdate(file, error, guestNmae, 'guest', '', gid, imgType, 'yes');
    
});

$(document).on('click', '.guestImgSec', function () {
    var bid = $(this).data('bid');
    var serial = $(this).data('serial');
    var gid = $(this).data('gid');

    var html = guestPopUpBox(bid, serial, gid, 'guestImg');
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = webcamScript;
    $("head").append(s);
    $('body').append(html);

});

$(document).on('change', '#chooseVoucher', function () {
    var select = $('#chooseVoucher').find(":selected").val();
    var roomNum = $('#roomNum').val();
    var rBID = $('#rBID').val();
    var bdid = $('#bdid').val();

    if (select == 'guest') {
        var url = webUrl + '/voucher.php?oid=' + rBID;
    }

    if (select == 'hotel') {
        var url = webUrl + '/voucher.php?vid=' + rBID;
    }

    $('#printGuestBooingVoucherBtn').attr("href", url);

});


// Room View end


// Stay View Start


function loadStayView($date = '', $rid = '') {
    var date = $date;
    var rid = $rid;
    var html = '<table class="dummystuf table align-items-center mb-0 tableLine vertical-scroll"><thead><tr><th></th><th></th><th></th><th ></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead><tbody><tr><td > </td></tr></tbody><tbody><tr><td></td><td ></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td ></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td ></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td ></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>';
    $('#stayViewContent .card-body').html(html);
    $.ajax({
        url: webUrl + 'include/ajax/stayView.php',
        type: 'post',
        data: { type: 'loadStayView', date: date, rid: rid },
        success: function (data) {
            $('#stayViewContent .card-body').html(data);
        }
    });

}

$(document).on('mouseover', '#stayViewContent .roomNum td', function () {
    $('thead th').css('background', '#e1e8f2');
    var className = $(this).attr('class');
    $('#' + className).css({ 'background': '#ff9800', 'color': '#fff ' });
});

$(document).on('click', '.guestOnStayView', function () {
    var bookId = $(this).data('bid');
    var bdid = $(this).data('bdid');
    var rid = $('.toggleTableBtn.show').data('rid');
    $('#bookindDetail').addClass('show');
    showGuestDetailPopUp('', bookId, bdid, '', '0', bdid, 'stayview_' + rid);

});



// Stay View End




// Guest Page start

$(document).on('click', '.editGuestOnGuestPage', function () {
    var gid = $(this).data('gid');
    loadAddGuestReservationForm('', '#addGestOnReservation .content', '', gid, '', '', '', '', 'guest');

});

// Guest page end


// Review section start


function showReplay($rid) {
    var rid = $rid;
    $.ajax({
        url: webUrl + 'include/ajax/review.php',
        type: 'post',
        data: { type: 'showReplay', rid: rid },
        success: function (data) {
            $('#sideBox .content').html(data);
            $('#sideBox').show();
        }
    });
}

function loadReview() {
    $.ajax({
        url: webUrl + 'include/ajax/review.php',
        type: 'post',
        data: { type: 'loadReview' },
        success: function (data) {
            $('#reviewContent').html(data);
        }
    });

}

$(document).on('click', '.showReplayOnReview', function () {
    var rid = $(this).data('rid');
    showReplay(rid);

});

$(document).on('click', '#sideBox .closeContent', function () {
    $('#sideBox').hide();
});

$(document).on('submit', '#guestReviewForm', function (e) {
    e.preventDefault();
    var rid = $('#guestReviewId').val();
    var data = $('#guestReviewForm').serialize() + '&type=addGuestReviewReplay';

    $('#guestReviewSubmitBtn').val('Loading...');
    $("#guestReviewSubmitBtn").prop('disabled', true);
    $.ajax({
        url: webUrl + 'include/ajax/review.php',
        type: 'post',
        data: data,
        success: function (data) {
            showReplay(rid);
            $('#guestReviewSubmitBtn').val('Submit');
            $("#guestReviewSubmitBtn").prop('disabled', false);
        }
    });
});


// Review section end





// Nav bar fixed


var num = 100;

$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('#topNavBar').addClass('stickyNav');
    } else {
        $('#topNavBar').removeClass('stickyNav');
    }
});


// Toggle btn iconSidenav

$(document).on('click', '#iconNavbarSidenav', function () {
    $('body').toggleClass('g-sidenav-pinned');
    $('#sidenav-main').toggleClass('bg-white');
});


// Confirm Model iconSidenav

function Confirm(title, msg, $true, $false, $data, $dataValue, $link = '') {
    var $content = "<div class='dialog-ovelay'>" +
        "<div class='dialog'><header>" +
        " <h3> " + title + " </h3> " +
        "<i class='fa fa-close'></i>" +
        "</header>" +
        "<div class='dialog-msg'>" +
        " <p> " + msg + " </p> " +
        "</div>" +
        "<footer>" +
        "<div class='controls'>" +
        " <button class='button button-danger doAction'>" + $true + "</button> " +
        " <button class='button button-default cancelAction'>" + $false + "</button> " +
        "</div>" +
        "</footer>" +
        "</div>" +
        "</div>";
    $('body').prepend($content);
    $('.doAction').click(function () {
        if ($link != '') {
            window.open($link, "_blank");
        } else {
            var obj = {
                name: 'name',
                totalScore: 'totalScore',
                gamesPlayed: 'gamesPlayed'
            };
            console.log(obj);
        }
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
            $(this).remove();
        });
    });

    $('.cancelAction, .fa-close').click(function () {
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
            $(this).remove();
        });
    });

}



$('#popUpBox .closeBox').on('click', function () {
    $('#popUpBox').removeClass('show');
});

$('#popUpBox .closeBtn').on('click', function () {
    $('#popUpBox').removeClass('show');
});

$('.cb-value').click(function () {
    var getRTab = $('.reservationTab.active').attr('id');

    var mainParent = $(this).parent('.toggle_btn');
    if ($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
        loadResorvation(getRTab, '', 0);
    } else {
        $(mainParent).removeClass('active');
        loadResorvation(getRTab, '', 1);
    }

});


$('#nightAuditExcelExport').click(function () {
    var currentDate = (new Date()).toISOString().split('T')[0];
    $("#loadNightAudit table").table2excel({
        exclude: ".noExl",
        name: "Excel Document Name",
        filename: "nightAudit-" + currentDate + ".xls",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true,
        // preserveColors: preserveColors
    });
});

function amenitiesConfigFiled() {
    var html =
        '<div class="form-group">' +
        '<label for="">Amenities Input</label>' +
        '<div class="bs-example">' +
        '<input type="text" id="inputTag" value="" data-role="tagsinput">' +
        '</div>' +
        '</div>'
        ;
    $("#inputTag").tagsinput('items');
    return html;
}

function roomAddConfigField() {
    var html =
        '<div class="row">' +
        '<div class="col-12">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="Room Name">' +
        '</div>' +
        '</div>' +
        '<div class="col-4">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="No of Adult">' +
        '</div>' +
        '</div>' +
        '<div class="col-4">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="No of Child">' +
        '</div>' +
        ' </div>' +
        '<div class="col-4">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="Rack Rate">' +
        '</div>' +
        '</div>' +
        '<div class="col-6">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="Rate Plan">' +
        '</div>' +
        '</div>' +
        '<div class="col-6">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="Price">' +
        ' </div>' +
        '</div>' +
        '</div>'

    return html;
}

function roomNumberAddConfigField() {
    var html =
        '<div class="row">' +
        '<div class="col-6">' +
        '<div class="form-group">' +
        '<input type="text" class="form-control" placeholder="Room Number">' +
        '</div>' +
        '</div>' +
        '<div class="col-6">' +
        '<div class="form-group">' +
        '<select name="" id=""  class="form-control">' +
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</div>'

    return html;
}

function configurationForm() {
    $('#configurationForm').MultiStep({
        title: 'Configuration process',
        data: [{
            content: amenitiesConfigFiled(),
        }, {
            content: roomAddConfigField()
        }, {
            content: roomNumberAddConfigField(),
            skip: false
        }, {
            content: `<small>You can include html content as well!</small><br><br>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            `,
            skip: false
        }, {
            content: `This is the end<br>Hold your breath and count to ten`,
        }],
        final: 'You can have your own final message',
        modalSize: 'lg'
    });
}


$(document).on('change', '#inputTag', function () {
    var data = $(this).val();
    $.ajax({
        url: webUrl + 'include/ajax/propertySetup.php',
        type: 'post',
        data: { data: data, type: 'setAmenities' },
        success: function (data) {
            console.log(data);
        }
    });
});

$(document).on('click', '#configurationForm .modal-footer .btn-next', function () {
    var text = $(this).html();
    if (text == 'Finish') {
        alert('finish')
    }
});


$(document).on('click', '.dropdownBtn', function () {
    if ($(this).siblings('.dropdown-menu').hasClass('show')) {
        $(this).siblings('.dropdown-menu').removeClass('show');
    } else {
        $('.dropdown-menu').removeClass('show');
        $(this).siblings('.dropdown-menu').addClass('show');
    }
});

$(document).click(function(event) { 
    if(!$(event.target).closest('.dropdownBtn').length && !$(event.target).is('.dropdownBtn')) {
        $('.dropdown-menu').removeClass('show');
    }  
});


function setSessionWithValue($session = '', $sessionValue = '', $kotValid = '', $status = '', $arry = '') {
    var sessionKey = $session;
    var sessionValue = $sessionValue;
    var kotValid = $kotValid;
    var status = $status;
    var arry = $arry;
    $.ajax({
        url: webUrl + '/ajax/otherDetail.php',
        type: 'post',
        data: {
            sessionKey: sessionKey,
            sessionValue: sessionValue,
            kotValid: kotValid,
            status: status,
            arry: arry,
            type: 'setSessionWithValue'
        },
        success: function (data) {

        }
    });
}


$(document).on('click', '.roomViewNav', function () {
    $('.roomViewNav').removeClass('active');
    $(this).addClass('active');
    var navType = $(this).data('navtype');
    var date = $('#roomViewCurrentDate').val();
    loadRoomView('', date, navType)
});


$(document).on('click', '.dropdownSec .actionBtn', function () {
    $(this).siblings().toggleClass('show');
});

$(document).click(function(event) { 
    if(!$(event.target).closest('.dropdownSec').length && !$(event.target).is('.dropdownSec')) {
        $('.dropdownSec ul').removeClass('show');
    }  
});

// $(document).on('blur', '.dropdownSec', function () {
//     $('.dropdownSec ul').removeClass('show');
// });


function deleteRoomImgWithData($imgId = '', $targetPath = '', $imgPath = '', $filePath = '', $accessid = '') {
    var imgId = $imgId;
    var targetPath = $targetPath;
    var imgPath = $imgPath;
    var filePath = $filePath;
    var accessid = $accessid;

    if (imgId != '') {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
            .then((willDelete) => {
                function deleteRoom() {
                    $.ajax({
                        url: webUrl + "/include/ajax/room.php",
                        type: 'post',
                        data: {
                            type: 'deleteRoomImg',
                            imgId: imgId,
                            filePath: filePath
                        },
                        success: function (data) {
                            if (data == 1) {
                                targetPath.remove();
                                if (imgPath != '') {
                                    imgPath.css('width', '100%');
                                    imgPath.find('.progress-wrapper').remove();
                                    imgPath.find('.previewImg').remove();
                                    imgPath.find('input').val('').prop('disabled', false);

                                    
                                }
                                if (filePath == 'users') {
                                    loadUserDetail(accessid);
                                }
                                
                                if (filePath == 'rooms') {
                                    deleteImageForDatabase('room_img',{'image' : imgId});
                                }
                                sweetAlert('Your file has been deleted.');
                            } else {
                                sweetAlert("Your Image record is safe!");
                            }
                        }
                    });
                }

                if (willDelete.isConfirmed) {
                    deleteRoom();
                }

            });
    } else {
        targetPath.remove();
    }

}

$(document).on('click', '.removeImg', function () {
    var imgId = $(this).data('imgid');
    var accessid = $(this).data('accessid');
    var targetPath = $(this).parent();
    var imgPath = $(this).parent().siblings();
    var filePath = window.filePath;
    deleteRoomImgWithData(imgId, targetPath, imgPath, filePath, accessid);
});


function imageFileUpdateWithAjax($file, $newName, $path, $elementId = '', $accessValue = '', $private, $target = '', $imgType) {
    var file = $file;
    var generateImgName = $newName;
    var accessValue = $accessValue;
    var private = $private;
    var target = $target;
    var imgType = $imgType;

    var imgname = file.val();
    var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
    data = new FormData();
    data.append('imgFile', file[0].files[0]);
    data.append('newName', generateImgName);
    data.append('path', $path);
    data.append('type', 'imageFileUpdate');
    data.append('accessValue', accessValue);
    data.append('private', private);
    data.append('imgType', imgType);

    if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
        return $.ajax({
            url: webUrl + "include/ajax/otherDetail.php",
            type: "POST",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (data) { }
        });
    } else {
        file.val(null);
        sweetAlert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ', 'error');
    }
}


function imageFileCheckAndUpdate($file, $error, $newName = '', $path, $elementId = '', $accessValue = '', $imgType = '', $private = '') {
    var file = $file;
    var elementId = $elementId;
    var generateImgName = $newName;
    var accessValue = $accessValue;
    var imgType = $imgType;
    var private = $private;
    data = new FormData();
    data.append('imgFile', file[0].files[0]);
    data.append('newName', generateImgName);
    data.append('path', $path);
    data.append('type', 'imageFileUpdate');
    data.append('accessValue', accessValue);
    data.append('imgType', imgType);
    data.append('private', private);
    var imgname = file.val();
    var size = file[0].files[0].size;
    var ext = imgname.substr((imgname.lastIndexOf('.') + 1));

    if ($("#" + elementId).siblings().find('.progress-wrapper')[0]) {
        // Do something if class exists
    } else {
        var progress = `<div class="progress-wrapper"><div class="progress-info"><div class="progress-percentage"><span class="text-sm font-weight-bold progress-value">0%</span></div></div><div class="progress"><div class="progress-bar bg-gradient-info" role="progressbar" style="width: 0%;"></div></div>
        </div>`;
        $("#" + elementId).parent().prepend(progress);
    }

    if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
        $('#' + elementId).parent().find(".progress-wrapper").addClass('show');
        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt(((evt.loaded / evt.total) * 100));
                        $('#' + elementId).siblings().find(".progress-value").html(percentComplete + '%');
                        $('#' + elementId).siblings().find(".progress-bar").width(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: webUrl + "include/ajax/otherDetail.php",
            type: "POST",
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#' + elementId).siblings().find(".progress-bar").width('0%');
            },
            success: function (data) {
                var returnData = JSON.parse(data);
                var error = returnData.error;
                var imgFullPath = returnData.imgFullPath;
                var imgId = returnData.imgId;
                var msg = returnData.msg;
                var img = returnData.img;

                if (error == "false") {
                    if ($path == 'guest') {
                        $('#guestPopupFixContent').remove();

                        if (imgType == 'guestImg') {
                            imageTagInsert('guestImgSec', img, '', 'guest', imgFullPath);
                            var imgObj = {'image': imgId};
                            insertDataInDatabase('guest', imgObj, accessValue);
                        }

                        if (imgType == 'proof') {
                            imageTagInsert('guestProofImgSec', img, '', 'guestP', imgFullPath);
                            var fileImgObj = {'kyc_file': imgId};
                            insertDataInDatabase('guest', fileImgObj, accessValue);
                        }
                    }

                    if ($path == 'room') {
                        var fileImgObj = {'image': imgId, 'room_id': accessValue};
                        insertDataInDatabase('room_img', fileImgObj);
                    }

                    if (elementId != '') {
                        $('#' + elementId).prop('disabled', true);
                        $('#' + elementId).parent().parent().prepend(`<div class="previewImg"><img src="${imgFullPath}"/><span data-imgid="${imgId}" class="removeImg">X</span><input type="hidden" name="imgFile[]" value="${imgId}"/></div>`);
                        $('#' + elementId).parent().css('width', '80%');
                        setTimeout(function () {
                            $('#' + elementId).parent().find(".progress-wrapper").removeClass('show');
                        }, 5000);
                    }

                }

                if (error == "true") {
                    if (elementId != '') {
                        $('#' + elementId).parent().find(".progress-wrapper").removeClass('show');
                    }

                    sweetAlert(msg, 'error');
                }
            }

        });
    } else {
        file.val(null);
        sweetAlert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ', 'error');
    }
}

function getReservationType() {
    var data = `request_type=getReservationTypeRecord`;
    ajax_request(data).done(function (data) {
        var responce = JSON.parse(data);
        window.localStorage.setItem('reservationType', JSON.stringify(responce));
    })
}


function makeRoomByReservation(data = '', $roomNum = '', $tab = '') {
    if (data == '') {
        var dataArray = JSON.parse(window.localStorage.getItem('makeReservationDetail'));
    } else {
        var dataArray = JSON.parse(data);
    }

    var tab = $tab;
    var defaltRoomNum = $roomNum;
    var roomDetailArry = dataArray.roomDetailArry;
    var totalPrice = dataArray.totalPrice;
    var userPay = dataArray.userPay;
    var bookingId = dataArray.bookinId;
    var bid = dataArray.bid;
    var checkIn = dataArray.checkIn;
    var checkOut = dataArray.checkOut;
    var commission = dataArray.commission;
    var couponCode = dataArray.couponCode;
    var gstPrice = dataArray.gstPrice;
    var reservationType = dataArray.reservationType;
    var guestArray = dataArray.guestArray;
    var inputHtml = '';
    var labelHtml = '';
    var contentHtml = '';

    function makeSubTabByRoomNum(roomNum, bdid, totalStay, bid) {

        function makeRoomDetail($checkIn = '', $checkOut = '', $couponCode = '', $reservationType = '') {
            var couponCode = $couponCode;
            var checkIn = $checkIn;
            var checkOut = $checkOut;
            var reservationType = $reservationType;

            if (couponCode != '') {
                var couponHtml = `<div class="col-12 line"><div class="item"><span>Coupon Code : </span><strong>${couponCode}</strong></div></div>`;
            } else {
                var couponHtml = '';
            }
            var reservationTypeHtml = `<select class="reservationType" data-bid="${bid}" data-roomnum="${roomNum}">`;

            var reservationArray = JSON.parse(window.localStorage.getItem('reservationType'));
            console.log(reservationArray);
            if (reservationArray == null) {
            } else {
                $.each(reservationArray, function (key, val) {
                    var rId = val.id;
                    var rName = val.name;
                    var check = "";
                    if (reservationType == rId) {
                        check = "selected";
                    }
                    reservationTypeHtml += `<option ${check} value="${rId}">${rName}</option>`;
                })
            }



            reservationTypeHtml += '<select class="form-control">';
            var html = `
                <input type="hidden" id="bookingId" value="${bid}"/>
                <input type="hidden" id="roomNumber" value="${roomNum}"/>
                <input type="hidden" id="bookingDetailId" value="${bdid}"/>
                <input type="hidden" id="bookingCheckIn" value="${checkIn}"/>
                <input type="hidden" id="bookingCheckOut" value="${checkOut}"/>
                <div class="row">
                    <div class="col-md-6 line">
                        <div class="item"><lable for="reCheckIn">Check In : </lable><input id="reCheckIn" class="reCheckIn" value="${checkIn}"/></div>
                        <div class="item"><lable for="reCheckOut">Check Out : </lable><input id="reCheckOut" class="reCheckOut" value="${checkOut}"/></div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            ${couponHtml}
                            <div class="col-12 line">
                                ${reservationTypeHtml}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            return html;
        }

        function makeGuestDetail($dataArry = [], $roomNum = '', $totalStay) {
            var html = '';
            var dataArry = $dataArry;
            var roomNum = $roomNum;
            var totalStay = $totalStay;

            var filterGuestInRoom = dataArry.filter(function (obj) {
                return (obj.roonNum === roomNum);
            });

            if (1 > 0) {
                var bookGuest = filterGuestInRoom.length;
                $.each(filterGuestInRoom, function (key, val) {
                    var gid = val.id;
                    var request = `request_type=getGuestData&gid=${gid}`;
                    var gname = val.name;
                    var gemail = val.email;
                    var gphone = val.phone;
                    var gkyc_file = val.varifyImgFull;
                    var gkyc_number = (val.kyc_number == '') ? 'Null' : val.kyc_number;
                    var varifyFileName = (val.varifyFileName == '') ? 'Null' : val.varifyFileName;
                    var bookId = val.bookId;
                    var bookingdId = val.bookingdId;
                    var gkyc_type = val.kyc_type;


                    var editBtn = `<a class="reservationGuestEditBtn btn tableIcon update bg-gradient-info" href="javascript:void(0)" data-rid="1" data-tooltip-top="Edit" data-action="editRes" data-rnum="${defaltRoomNum}" data-gid="${gid}" data-bid="${bookId}" data-bdid="${bookingdId}"><i class="far fa-edit"></i></a>`;
                    var deleteBtn = `<a class="reservationGuestDeleteBtn btn tableIcon delete bg-gradient-danger" data-gid="${gid}" data-rnum="${roomNum}" data-bid="${bid}" href="javascript:void(0)" data-rid="1" data-tooltip-top="Delete"><i class="far fa-trash-alt"></i></a>`;

                    var addGuestBtn = '';

                    if (totalStay > bookGuest) {
                        addGuestBtn = `<li>
                                        <button id="addReservationGuestBtn" data-rnum="${defaltRoomNum}" data-action="editRes" data-bookingid="${bid}" data-bdid="${bdid}">Add Guest</button>
                                    </li>`;
                    }

                    var fileImg = '';
                    if (gkyc_file != '') {
                        fileImg = `<a data-fancybox="varifyDoc" data-src="${gkyc_file}" data-caption="" ><img src="${gkyc_file}"/> </a>`;
                    }

                    html += `
                            <li class="guestInfoDetail">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12 line d-flex align-items-center justify-content-center">
                                        <div class="item"><span>${gname}</span></div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 line d-flex align-items-center justify-content-center">
                                        <div class="item"><span>${gphone}</span></div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 line d-flex align-items-center justify-content-center">
                                        <div class="item"><span>${gemail}</span></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 line">
                                        <div class="item">
                                            <div class="personalDetail">
                                                  <div class="imgCon">${fileImg}</div>
                                                <div class="testCon">
                                                    <h4>${varifyFileName}</h4>
                                                    <p>${gkyc_number}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 line d-flex align-items-center justify-content-center">
                                        <div class="item">${editBtn} ${deleteBtn}</div>
                                    </div>
                                </div>
                            </li>
                            ${addGuestBtn}
                        `;

                })
            }

            return html;
        }

        var makeRoomDetail = makeRoomDetail(checkIn, checkOut, couponCode, reservationType);
        var makeGuestDetail = makeGuestDetail(guestArray, roomNum, totalStay);



        var html = `
            <div class="title">
                <h4>Booking Id:- <strong>${bookingId}</strong></h4>
                <h4><strong>₹ ${userPay}</strong> / <strong>₹ ${totalPrice}</strong></h4>
            </div>

            <div class="subTabContent">
                <div data-ui-tablist="navigation" class="tabs">
                    <div class="tabs-marker"></div>
                    <button data-ui-tablist-tab="roomDetail-${roomNum}" class="tabs-tab">Room</button>
                    <button data-ui-tablist-tab="guestDetail-${roomNum}" class="tabs-tab">Guest</button>
                </div>

                <div class="tabpanels">

                    <div id="roomDetail-${roomNum}" class="roomDetail-${roomNum} tabpanel">
                        <ul>
                            <li>${makeRoomDetail}</li>
                        </ul>
                    </div>

                    <div id="guestDetail-${roomNum}" class="guestDetail-${roomNum} tabpanel" hidden>
                        <ul>
                            ${makeGuestDetail}
                        </ul>
                    </div>

                </div>
            </div>
        `;

        return html;
    }

    var list = 0;
    $.each(roomDetailArry, function (key, val) {
        list++;
        var room_number = val.room_number;
        var bookngDId = val.bookngDId;
        var publicId = 'reservation' + room_number;
        var show = '';
        var checked = '';
        var active = '';
        var totalStay = val.totalStay;
        if (defaltRoomNum != '') {
            if (room_number == defaltRoomNum) {
                var show = 'show';
                var checked = 'checked';
                active = 'active';
            }
        } else {
            if (key == 0) {
                var show = 'show';
                var checked = 'checked';
                active = 'active';
            }
        }

        var detail = makeSubTabByRoomNum(room_number, bookngDId, totalStay, bid);
        inputHtml += `<input type="radio" name="slider" ${checked} id="${publicId}">`;
        labelHtml += `<label class="${active}" for="${publicId}" data-list="${list}"><span>${room_number}</span></label>`;
        contentHtml += `<div data-target="${publicId}" class="${publicId} text ${show} reservationText">${detail}</div>`;

    });

    var html = `            
        ${inputHtml}

        <div class="list">
            ${labelHtml}
            <div style="position: absolute;bottom: 0;" class="dFlex aic jcc"><button style="width:80%" class="btn bg-gradient-info" data-bid="${bid}" id="addRoomBtnForReservation">Add Room</button></div>
        </div>

        <div class="text-content">
            ${contentHtml}
        </div>
    
    `;

    $('#reservationEditContect .content').html(html);

    $('.reCheckIn').datepick({
        dateFormat: 'yyyy-mm-dd', monthsToShow: 1, minDate: 0, defaultDate: '-1w', selectDefaultDate: true,
        onClose: function (dates) {
            var value = dates;
            var roomNum = $('#roomNumber').val();
            var bid = $('#bookingId').val();
            var bdid = $('#bookingDetailId').val();
            var checkIn = $('#bookingCheckIn').val();
            var orgCheckIn = GMTTimeConvert(value);

            var alert = `You won't be change the check-in date.`;
            var data = `request_type=reservationCheckInChange&bid=${bid}&value=${value}&bdid=${bdid}`;

            if (checkIn != orgCheckIn) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: alert,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ajax_request(data).done(function (data) {
                            var responce = JSON.parse(data);
                            var error = responce.error;
                            var msg = responce.msg;
                            if (error == 'no') {
                                sweetAlert(msg);
                                buildReservationDetail(bid, roomNum);
                            }
                            if (error == 'yes') {
                                sweetAlert(msg, error);
                            }
                        });
                    }
                });
            }
        }
    });

    $('.reCheckOut').datepick({
        dateFormat: 'yyyy-mm-dd', monthsToShow: 1, minDate: 0, defaultDate: '-1w', selectDefaultDate: true,
        onClose: function (dates) {
            var value = dates;
            var roomNum = $('#roomNumber').val();
            var bid = $('#bookingId').val();
            var bdid = $('#bookingDetailId').val();
            var checkOut = $('#bookingCheckOut').val();
            var checkIn = $('#bookingCheckIn').val();
            var orgCheckOut = GMTTimeConvert(value);

            var alert = `You won't be change the check-out date.`;
            var data = `request_type=reservationCheckOutChange&bid=${bid}&value=${value}&bdid=${bdid}`;

            if (checkOut == orgCheckOut) {

            } else if (timeToConvertNum(checkIn) >= timeToConvertNum(orgCheckOut)) {
                sweetAlert(`Can't do that. Due to check in is ${checkIn}`, 'error');
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: alert,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ajax_request(data).done(function (data) {
                            var responce = JSON.parse(data);
                            var error = responce.error;
                            var msg = responce.msg;
                            if (error == 'no') {
                                sweetAlert(msg);
                                buildReservationDetail(bid, roomNum);
                            }
                            if (error == 'yes') {
                                sweetAlert(msg, error);
                            }
                        });
                    }
                });
            }
        }
    });

    const { Tablist } = jolty;

    Tablist.data("navigation", (tablist) => {
        const marker = tablist.firstElementChild;

        const setMarker = (tab) => {
            marker.style.width = tab.offsetWidth + "px";
            marker.style.translate = tab.offsetLeft + "px";
        };

        return {
            data: "ui-tabs",
            on: {
                show(instance, {
                    tab
                }) {
                    setMarker(tab);
                }
            }
        };
    });

    Tablist.initAll();
}

function makeReservationDetail(data, roomNum = '', tab = '') {
    var reservationContent = `<div id="reservationEditContect">
                                <div class="bg"></div>
                                <div class="mainContent">
                                    <div class="topic">Edit Reservation</div>
                                    <div class="closeBox">X</div>
                                    <div class="content"></div>
                                </div>
                            </div>`;

    if ($('#reservationEditContect').length) {

    } else {
        $('body').prepend(reservationContent);
    }

    makeRoomByReservation(data, roomNum, tab);
    var responce = JSON.parse(data);

    window.localStorage.setItem('makeReservationDetail', JSON.stringify(responce));
}

function buildReservationDetail($bid, $roomNum = '', $tab = '') {
    var bid = $bid;
    var roomNum = $roomNum;
    var tab = $tab;
    var data = `request_type=makeReservationDetail&bid=${bid}&tab=${tab}`;
    ajax_request(data).done(function (data) {
        makeReservationDetail(data, roomNum, tab);
    });
}

$(document).on('click', '#editReservationsbtn', function (e) {
    e.preventDefault();
    var bid = $(this).data('bookingid');
    var rNum = $(this).data('roomnum');
    buildReservationDetail(bid, rNum);
});

$(document).on('click', '#reservationEditContect .bg', function () {
    $('#reservationEditContect').remove();
});

$(document).on('click', '#reservationEditContect .closeBox', function () {
    $('#reservationEditContect').remove();
});


$(document).on('click', '.list label', function () {
    var target = $(this).attr('for');
    var listPlace = $(this).data('list') - 1;
    var top = listPlace * 60;
    var spanVal = $(this).children().html();

    $('.list .slider').css('top', top + 'px');
    $('.reservationText').removeClass('show');
    $(`.${target}`).addClass('show');
    $(`.${target} .tabs-marker`).css({ 'width': '74px', 'translate': '8px' });
    $(`.${target} .tabpanel`).removeClass('ui-active');
    $(`.${target} .tabpanel`).attr('hidden', true);
    $(`.${target} .tabs-tab`).removeClass('ui-active');

    $(`.${target} .tabs button`).first().addClass('ui-active');
    $(`.${target} .tabpanels div`).first().addClass('ui-active');
    $(`.${target} .tabpanels div`).first().removeAttr('hidden');


    makeRoomByReservation('', spanVal);
    // const { Tablist2 } = jolty;

    // Tablist2.data("navigation", (tablist) => {
    //     console.log(tablist);
    //     const marker = tablist.firstElementChild;

    //     const setMarker = (tab) => {
    //         marker.style.width = tab.offsetWidth + "px";
    //         marker.style.translate = tab.offsetLeft + "px";
    //     };

    //     return {
    //         data: "ui-tabs",
    //         on: {
    //             show(instance, {
    //                 tab
    //             }) {
    //                 setMarker(tab);
    //             }
    //         }
    //     };
    // });

    // Tablist2.initAll();
});

$(document).on('click', '#addReservationGuestBtn', function () {
    var bid = $(this).data('bookingid');
    var bdid = $(this).data('bdid');
    var rNum = '';
    var customFunction = ['buildReservationDetail', bid, rNum];
    loadAddGuestReservationForm(bid, '#addGestOnReservation .content', bdid, '', '', '', '', '', '', customFunction);
});

$(document).on('click', '.reservationGuestEditBtn', function () {
    var bdid = $(this).data('bdid');
    var bid = $(this).data('bookingid');
    var gid = $(this).data('gid');
    var action = $(this).data('action');
    console.log(action);
    var rNum = $(this).data('roomnum');
    var customFunction = 'buildReservationDetail';
    loadAddGuestReservationForm(bid, '#addGestOnReservation .content', bdid, gid, '', '', '', '', '', customFunction, action);
});


$(document).on('click', '.reservationGuestDeleteBtn', function (e) {
    e.preventDefault();
    var gid = $(this).data('gid');
    var rNum = $(this).data('rnum');
    var bid = $(this).data('bid');
    var tab = 'guest';
    var alert = `You won't be delete this guest details`;
    var data = `request_type=reservationGuestDelete&gid=${gid}`;
    Swal.fire({
        title: 'Are you sure?',
        text: alert,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            ajax_request(data).done(function (data) {
                var responce = JSON.parse(data);
                var error = responce.error;
                var msg = responce.msg;
                if (error == 'no') {
                    Swal.fire('Deleted!', msg, 'success');
                    buildReservationDetail(bid, rNum, tab);
                }

                if (error == 'yes') {
                    Swal.fire('Deleted!', msg, 'error');
                }
            });


        }
    });

});

$(document).on('change', '.reservationType', function () {
    var value = $(this).val();
    var roomNum = $(this).data('roomnum');
    var bid = $(this).data('bid');
    var alert = `You won't be change the reservation type.`;
    var data = `request_type=reservationTypeChange&bid=${bid}&value=${value}`;
    Swal.fire({
        title: 'Are you sure?',
        text: alert,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            ajax_request(data).done(function (data) {
                var responce = JSON.parse(data);
                var error = responce.error;
                var msg = responce.msg;
                if (error == 'no') {
                    sweetAlert(msg)
                    buildReservationDetail(bid, roomNum);
                }
                if (error == 'yes') {
                    sweetAlert(msg, error)
                }
            });
        }
    });
});


Fancybox.bind("[data-fancybox]", {});

function removeClassAfterSomeTime($target, parentTarget) {
    var target = $target;
    setTimeout(function () {
        $(`#${parentTarget} .${target}`).removeClass(target);
    }, 50);
}


$(document).on('click', '#setupSection .navItem', function (e) {
    e.preventDefault();
    $(this).parent().toggleClass('active');
});

// function loadPaymentLink($date = '') {
//     console.log('test');
//     var date = $date;

//     var html = window.tableSkeleton;
//     $('#paymentLinkContent tbody').html(html);
//     var form_data = `request_type=loadPaymentLink&date=${date}`;
//     ajax_request(form_data).done((result) => {
//         var response = JSON.parse(result);
//         var html = '';
//         var count = 0;

//         if (response.length > 0) {
//             $.each(response, (key, val) => {
//                 count++;
//                 var id = val.id;
//                 var amount = numberWithCommas(val.amount);
//                 var email = (val.email == null) ? '' : val.email;
//                 var name = (val.name == null) ? '' : val.name;
//                 var paymentId = val.paymentId;
//                 var paymentStatus = val.paymentStatus;
//                 var phone = (val.phone == null) ? '' : val.phone;
//                 var reason = val.reason;
//                 var transactionId = val.transactionId;
//                 var addOn = val.addOn;
         
//                 var date = moment(addOn);
//                 var formatdate = date.format("Do-MMM");
//                 var editPaymentLinkBtn = `<a data-pid="${id}" href="javascript:;" class="editPaymentLink icon bg-primary-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc" >
//                                         <i class="fas fa-edit text-primary text-gradient opacity-10" aria-hidden="true"></i>
//                                         </a>`;
//                 var copyPaymentLink = ` <a data-pid="${id}" href="javascript:;" class="copyPaymentLink icon bg-info-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc">
//                                             <i class="fas fa-copy text-secondary opacity-10" aria-hidden="true"></i>
//                                         </a>`;
//                 var sharePaymentLinkBtn = `<a data-pid="${id}" href="javascript:;" class="sharePaymentLink icon bg-info-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc">
//                                                 <i class="fas fa-share-alt"></i>
//                                             </a>`;

                  
//                 var paymentStatusText =await checkpaymentstatus(addOn,paymentStatus);
//                 // console.log(paymentStatus);
//                 var paymentStatusHtml = `<span class="badge badge-secondary badge-sm">${paymentStatusText}</span>`;

//                 if (paymentStatus == 'expired') {
//                     paymentStatusHtml = `<span class="badge badge-warning badge-sm">Expired</span>`;
//                 }
//                 if (paymentStatus == 'failed') {
//                     paymentStatusHtml = `<span class="badge badge-danger badge-sm">Failed</span>`;
//                 }
//                 if (paymentStatus == 'success') {
//                     paymentStatusHtml = `<span class="badge badge-success badge-sm">Success</span>`;
//                     editPaymentLinkBtn = `
//                     <a class="tableIcon status bg-gradient-success" href="javascript:void(0)" data-pid="${id} data-tooltip-top="Active"><svg class="svg-inline--fa fa-eye fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg><!-- <i class="far fa-eye"></i> Font Awesome fontawesome.com --></a>
//                     `;
//                     copyPaymentLink ='';
//                     sharePaymentLinkBtn='<i class="fa fa-download" aria-hidden="true"></i>';

//                 }


//                 html += `<tr>
//                             <td>${count}</td>
//                             <td>${paymentId}</td>
//                             <td>₹ ${amount}</td>
//                             <td>${name}</td>
//                             <td>
//                                 <ul>
//                                     <li class="db email"><a href="mailto:${email}">${email}</a></li>
//                                     <li class="db phone"><a href="tel:${phone}">${phone}</a></li>
//                                 </ul>
//                             </td>
//                             <td>${formatdate}</td>
//                             <td>${paymentStatusHtml}</td>
//                             <td>
//                               ${editPaymentLinkBtn}
//                                ${sharePaymentLinkBtn}
//                                ${copyPaymentLink}
                             
//                             </td>
//                         </tr>`;
//             });
//         } else {
//             html += `<tr><td colspan="8">No Data</td></tr>`;
//         }



//         $('#paymentLinkContent tbody').html(html);
//     });

// }

// function checkpaymentstatus(addOn, paymentStatus) {
// var ans='';
//     var formData = 'request_type=checkPaymentStatus' +
//     '&addOn=' + addOn +
//     '&paymentStatus=' + paymentStatus;

//     ajax_request(formData).done((data) => {
//        ans = data.trim();
//        console.log(ans);
//     });
//     return ans;
// }


function loadPaymentLink($date = '') {
    console.log('test');
    var date = $date;

    var html = window.tableSkeleton;
    $('#paymentLinkContent tbody').html(html);
    var form_data = `request_type=loadPaymentLink&date=${date}`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var html = '';
        var count = 0;

                                // ${sharePaymentLinkBtn}
        if (response.length > 0) {
            Promise.all(response.map(async (val) => {
                count++;
                var id = val.id;
                var amount = numberWithCommas(val.amount);
                var email = (val.email == null) ? '' : val.email;
                var name = (val.name == null) ? '' : val.name;
                var paymentId = val.paymentId;
                var paymentStatus = val.paymentStatus;
                var phone = (val.phone == null) ? '' : val.phone;
                var reason = val.reason;
                var transactionId = val.transactionId;
                var addOn = val.addOn;
                
                var date = moment(addOn);
                var formatdate = date.format("Do-MMM");
                var editPaymentLinkBtn = `<a data-pid="${id}" href="javascript:;" class="editPaymentLink icon bg-primary-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc" >
                                        <i class="fas fa-edit text-primary text-gradient opacity-10" aria-hidden="true"></i>
                                        </a>`;
                var copyPaymentLink = ` <a data-pid="${id}" href="javascript:;" class="copyPaymentLink icon bg-info-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc">
                                            <i class="fas fa-copy text-secondary opacity-10" aria-hidden="true"></i>
                                        </a>`;
                var sharePaymentLinkBtn = `<a data-pid="${id}" href="javascript:;" class="sharePaymentLink icon bg-info-soft shadow text-center border-radius-md shadow-none w28 h28 dFlex dif aic jcc">
                                                <i class="fas fa-share-alt"></i>
                                            </a>`;

       
                var paymentStatusHtml = `<span class="badge badge-secondary badge-sm">Process</span>`;

                if (paymentStatus == 'expired') {
                    paymentStatusHtml = `<span class="badge badge-warning badge-sm">Expired</span>`;
                }
                if (paymentStatus == 'failed') {
                    paymentStatusHtml = `<span class="badge badge-danger badge-sm">Failed</span>`;
                }
                if (paymentStatus == 'success') {
                    paymentStatusHtml = `<span class="badge badge-success badge-sm">Success</span>`;
                    editPaymentLinkBtn = `
                    <a class="tableIcon status bg-gradient-success" onClick="showPaymentInvoice('${name}','${amount}','${paymentId}','${email}','${phone}','${formatdate}','${transactionId}');" href="javascript:void(0)" data-pid="${id}" data-tooltip-top="Active">
                    <svg class="svg-inline--fa fa-eye fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                    </svg><!-- <i class="far fa-eye"></i> Font Awesome fontawesome.com -->
                </a>
                
                    `;
                    copyPaymentLink = '';
                    sharePaymentLinkBtn = '<i class="fa fa-download" aria-hidden="true"></i>';
                }

                html += `<tr>
                            <td>${count}</td>
                            <td>${paymentId}</td>
                            <td>₹ ${amount}</td>
                            <td>${name}</td>
                            <td>
                                <ul>
                                    <li class="db email"><a href="mailto:${email}">${email}</a></li>
                                    <li class="db phone"><a href="tel:${phone}">${phone}</a></li>
                                </ul>
                            </td>
                            <td>${formatdate}</td>
                            <td>${paymentStatusHtml}</td>
                            <td>
                                ${editPaymentLinkBtn}
                                ${copyPaymentLink}
                            </td>
                        </tr>`;
            })).then(() => {
                $('#paymentLinkContent tbody').html(html);
            });
        } else {
            html += `<tr><td colspan="8">No Data</td></tr>`;
            $('#paymentLinkContent tbody').html(html);
        }
    });
}

function checkpaymentstatus(addOn, paymentStatus) {
    return new Promise((resolve, reject) => {
        var formData = 'request_type=checkPaymentStatus' +
            '&addOn=' + addOn +
            '&paymentStatus=' + paymentStatus;

        ajax_request(formData).done((data) => {
            resolve(data.trim());
        }).fail((error) => {
            reject(error);
        });
    });
}

function showPaymentInvoice(name,amount,paymentId,email,phone,formatdate,transactionId){
    var html =`
    
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; background-color: #464646; margin: 0; padding: 0;">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="format-detection" content="telephone=no">
        <title>GO Email Templates: Generic Template</title>
        
    </head>
    <body bgcolor="#d7d7d7" class="generic-template" style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; background-color: #d7d7d7; margin: 0; padding: 0;">
        <table cellpadding="0" cellspacing="0" cols="1" bgcolor="#d7d7d7" align="center" style="max-width: 600px;">
      

            <tr bgcolor="#d7d7d7">
                <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">

           

                    <table align="center" cellpadding="0" cellspacing="0" cols="3" bgcolor="white" class="bordered-left-right" style="border-left: 10px solid #d7d7d7; border-right: 10px solid #d7d7d7; max-width: 600px; width: 100%;">
                        
                        <tr align="center">
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td class="text-primary" style="color: #10e000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
                                <img src="http://dgtlmrktng.s3.amazonaws.com/go/emails/generic-email-template/tick.png" alt="GO" width="50" style="border: 0; font-size: 0; margin: 0; max-width: 100%; padding: 0;">
                            </td>
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>
                        <tr height="17"><td colspan="3" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td></tr>
                        <tr align="center">
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td class="text-primary" style="color: #10e000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
                                <h1 style="color: #10e000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 30px; font-weight: 700; line-height: 34px; margin-bottom: 0; margin-top: 0;">Payment received</h1>
                            </td>
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>
                        <tr height="30"><td colspan="3" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td></tr>
                        <tr align="left">
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">
                                    Hi ${name}, 
                                </p>
                            </td>
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>
                        <tr height="10"><td colspan="3" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td></tr>
                        <tr align="left">
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">Your transaction was successful!</p>
                                <br>
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0; "><strong>Payment Details:</strong><br/>

Amount: Rs.${amount} <br/>
Payment Id: ${paymentId}.<br/></p>
                                    <br>
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">We advise to keep this email for future reference.&nbsp;&nbsp;&nbsp;&nbsp;<br/></p>
                            </td>
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>
                        <tr height="30">
                            <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td style="border-bottom: 1px solid #D3D1D1; color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>
                        <tr height="30"><td colspan="3" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td></tr>
                        <tr align="center">
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                            <td style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;">
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;"><strong>Transaction Id: ${transactionId}</strong></p>
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;">Order date: ${formatdate}</p>
                                <p style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 22px; margin: 0;"></p>
                            </td>
                            <td width="36" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>

                        <tr height="50">
                            <td colspan="3" style="color: #464646; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 16px; vertical-align: top;"></td>
                        </tr>

                    </table>
                 
                </td>
            </tr>
        </table>    
    </body>
</html>
    `;
    customModal(name, html);
}

$(document).on('click', '.sharePaymentLink', function (e) {
    e.preventDefault();
    var paymentId = $(this).data('pid');
    var formData = `request_type=getPaymentLinkData&pid=${paymentId}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        if (response.length > 0) {
            response = response[0];
            var link = (response.paymentSrtLink == null) ? response.paymentLink : response.paymentSrtLink;
            var amount = numberWithCommas(response.amount);
            var title = `Rs ${amount} Payment.`;
            var html = previewPaymentLink(paymentId, link);
            customModal(title, html);
        } else {
            sweetAlert('Something went wrong!', 'error');
        }
    });

});

function generatePaymentLinkForm($pid = '', $name = '', $email = '', $phone = '', $amount = '', $reason = '') {
    var alertBtn = ($pid == '') ? 'Create' : 'Update';

    var html = `
        <form id="paymentLinkForm" action="" method="post" enctype="multipart/form-data">                                
            <div class="row p0" style="align-items: end;">
                <div class="form_group col-md-12 mb-3">
                    <label for="perName">Name</label>
                    <input type="text" name="perName" id="perName" placeholder="Enter person name" class="form-control" value="${$name}" autocomplete="off">
                </div>   
                <input type="hidden" id="paymentId" value="${$pid}" />
                <div class="form_group col-md-6 mb-3">
                    <label for="perEmail">Email</label>
                    <input type="text" name="perEmail" id="perEmail" placeholder="Enter email id." class="form-control" value="${$email}" autocomplete="off">
                </div>  
                <div class="form_group col-md-6 mb-3">
                    <label for="perPhone">Phone</label>
                    <input type="text" name="perPhone" id="perPhone" placeholder="Enter phone number." class="form-control" value="${$phone}" autocomplete="off">
                </div>  

                <div class="form_group col-md-12 mb-3">
                    <label for="paymentAmount">Amount *</label>
                    <input required="" type="text" name="paymentAmount" id="paymentAmount" placeholder="Enter amount." class="form-control" value="${$amount}" autocomplete="off">
                </div>

                <div class="form_group col-md-12 mb-3">
                    <label for="paymentReason">Reason</label>
                    <textarea rows="4" cols="50" class="form-control" placeholder="Enter Reason." name="paymentReason" id="paymentReason">${$reason}</textarea>
                </div>

            </div>            
        </form>
    `;

    showModalBox('Create Link', alertBtn, html, 'paymentLinkSubmitBtn');
    var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
    myModal.show();
}

function paymentLinkSubmit(hid, pid, perName, perEmail, perPhone, paymentAmount, paymentReason) {
    var formData = `request_type=paymentLinkSubmit&hid=${hid}&pid=${pid}&perName=${perName}&perEmail=${perEmail}&perPhone=${perPhone}&paymentAmount=${paymentAmount}&paymentReason=${paymentReason}`;

    $.ajax({
        url: "https://retrod.in/api/payment.php",
        cache: false,
        type: "POST",
        data: formData,
        success: function (data) {
            console.log(data);
            var status = data.status;
            var msg = data.msg;
            var link = data.link;
            var paymentId = data.paymentId;
            var returnData = `request_type=paymentLinkSubmit&link=${link}&hid=${hid}&pid=${pid}&perName=${perName}&perEmail=${perEmail}&perPhone=${perPhone}&paymentAmount=${paymentAmount}&paymentReason=${paymentReason}&paymentId=${paymentId}`;
            console.log(returnData);

            ajax_request(returnData).done(function () {
                if (status == 'success') {
                    $('#popUpModal').modal('hide');
                    sweetAlert(msg);
                    loadPaymentLink();
                }
            });

            

        }
    });
}

$(document).on('click', '#addPaymentBtn', function (e) {
    e.preventDefault();
    generatePaymentLinkForm();
});




function updateDataOnDataBase($tName, $column, $value, $conKey, $conVal) {
    var tName = $tName;
    var column = $column;
    var value = $value;
    var conKey = $conKey;
    var conVal = $conVal;
    var formData = `request_type=updateDataOnDataBase&tName=${tName}&column=${column}&value=${value}&conKey=${conKey}&conVal=${conVal}`;
    return ajax_request(formData);
}



function loadUserDetail(uid = '', $noLoad = '') {
    var formData = `request_type=loadUserDetail&uid=${uid}`;
    var noLoad = $noLoad;
    var loder = window.loader;
    if (window.filePath == 'users') {
        (noLoad == '') ? $('#loadUserDetail').html(loder) : '';
    } else {
        $('.detailView').html(loder);
    }

    ajax_request(formData).done((data) => {
        var html = JSON.parse(data);
        if (window.filePath == 'users') {
            $('#loadUserDetail').html(html);
            if (noLoad == '') {             
                loadUsersData(uid);
            }
        } else {
            $('.detailView').html(html);
        }

    });
}

$(document).on('click', '#editUserDetailBtn', function (e) {
    e.preventDefault();
    var uid = $(this).data('uid');
    createUserDetailForm(uid);

});

$(document).on('change', '#image', function () {
    var file = $(this);
    var error = $(this).attr('id');
    var slug = $('#name').val();

    if (slug != '') {
        var elementId = $(this).attr('id');
        var accessValue = $(this).data('uid');
        imageFileCheckAndUpdate(file, error, slug, 'room', elementId, accessValue, '', 'yes');
    } else {
        file.val('');
        alert('Room name is required.');
    }

});

$(document).on('change', '#userImgUpload', function () {
    var file = $(this);
    var error = $(this).attr('id');
    var slug = $(this).data('name');
    var accessValue = $(this).data('uid');

    if (slug != '') {
        var elementId = $(this).attr('id');
        var loaserHtml = window.loaderSpinner;
        $(this).siblings('label').html(loaserHtml);
        imageFileUpdateWithAjax(file, slug, 'logo', elementId, '', 'yes').done((returnData) => {
            var response = JSON.parse(returnData);
            var error = response.error;
            var img = response.img;
            var imgFullPath = response.imgFullPath;
            var imgId = response.imgId;
            var msg = response.msg;

            if (error == 'false') {
                updateDataOnDataBase('hoteluser', 'imageId', imgId, 'id', accessValue).done((userImgData) => {
                    var responseUserImg = JSON.parse(userImgData);
                    var usersStatus = responseUserImg.status;
                    var userMsg = responseUserImg.msg;
                    if (usersStatus == 'success') {
                        sweetAlert(userMsg);
                        loadUserDetail(accessValue);
                    }

                    if (usersStatus == 'error') {
                        sweetAlert(userMsg, 'error');
                    }
                });

            }
            if (error == 'true') {
                sweetAlert(msg, 'error');
                $(this).siblings('label').empty();
            }
        });
    } else {
        file.val('');
        alert('Room name is required.');
    }

});

$(document).on('click', '#submitPersonalDetailsBtn', function (e) {
    e.preventDefault;
    var formData = $('#personDetailForm').serialize() + `&request_type=pesonalDetailSubmit`;
    var userName = $('#personDetailForm #name').val().trim();
    var userId = $('#personDetailForm #userId').val().trim();
    var password = $('#personDetailForm #password').val().trim();


    if(userName == ''){
        sweetAlert('Name is required!', 'error');
    }else if(userId == ''){
        sweetAlert('User ID is required!', 'error');
    }else if(password == ''){
        sweetAlert('Password is required!', 'error');
    }
    else{
        ajax_request(formData).done((data) => {
            var response = JSON.parse(data);
            var status = response.status;
            var msg = response.msg;
            var uid = response.uid;
    
            if (status == 'success') {
                sweetAlert(msg);
                var filePath = $(window.location.pathname.split('/')).last()[0];
                loadUserDetail(uid);
    
                $('#popUpModal').modal('hide');
                $('#personDetailForm').trigger("reset");
            }
            
            if (status == 'error') {
                sweetAlert(msg, 'error');
            }
        });
    }
});




function loadPolicyData($type = '') {
    var type = $type;
    var formData = `request_type=loadPolicyData&type=${type}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var content = response.content;
        var html = `<form id="policyDataForm" data-type="${type}" >
                        <div class="form-group">
                            <textarea name="policyDataTextarea" id="policyDataTextarea"  class="form-control">${content}</textarea>
                        </div>
                        <div class="button-row d-flex mt-2"><button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" id="policyDataSubmit">Submit</button></div>
                    </form>`;
        $('#loadPolicyData').html(html);
        $('#loadPolicyPreview .content').html((content == '') ? 'No Data' : content);
        tinymce.init({
            selector: 'textarea#policyDataTextarea',
            height: 250,
            plugins: ['advlist', 'autolink', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'code'
            ],
            toolbar: 'styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist ',
            menubar: false,
            setup: function (ed) {
                ed.on('keyup', function (e) {
                    $('#loadPolicyPreview .content').html(ed.getContent());
                });
            }
        });

    });
}

function loadImageData($type = '') {
    var type = $type;
    var formData = `request_type=loadImageData&type=${type}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var html = '';
        if (response.length > 0) {
            $.each(response, function (key, val) {
                var file = val.file;
                var exist = val.exist;
                var imagPath = webUrl + file;
                var imgFullName = $(file.split('/')).last()[0];
                var imgName = $(imgFullName.split('.')).first()[0];
                var imgFinalName = (imgName.length >= 11) ? imgName.substring(0, 11) + ' ...' : imgName;
                var existHtml = (exist == 'yes') ? `<button data-type="${type}" data-imagname="${imgFullName}" class="btnNoEffect w28 h28 mL10 dFlex dif aic jcc editImgBtn">
                                                        <svg> <use href="#editfilledIcon"></use> </svg>
                                                    </button>` :
                    `<button data-type="${type}" data-imagname="${imgFullName}" class="btnNoEffect w28 h28 mL10 dFlex dif aic jcc deleteImgBtn">
                                                        <svg> <use href="#deletefilledIcon"></use> </svg>
                                                    </button>`;
                html += `
                        <div class="imgBox">
                            <div class="imgcon">
                                <img src="${imagPath}" alt="">
                                <div class="action">
                                    ${existHtml}
                                </div>
                                <div class="textArea">
                                    <h4>${imgFinalName}</h4>
                                </div>
                            </div>
                        </div>
                `;
            });
        } else {
            html = '<div class="imageArea"><span>No data</span></div>';
        }
        console.log(html);

        $('#loadHotelImage').html(html);
        // $('#loadBElImage').html(html);
    });
}

$(document).on('submit', '#policyDataForm', function (e) {
    e.preventDefault();
    var type = $(this).data('type');
    var value = $(this).serialize();
    var loder = window.spinner;
    $('#loadPolicyPreview .content').html(loder);
    var formData = `request_type=policyDataSubmit&type=${type}&${value}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;
        var content = response.content;

        if (status == 'success') {
            $('#loadPolicyPreview .content').html(content);
        }

        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });
});

$(document).on('click', '.editImgBtn', function (e) {
    e.preventDefault();
    var imagname = $(this).data('imagname');
    var type = $(this).data('type');
    var formData = `request_type=editImage&type=${type}&imagname=${imagname}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var imgArry = response.imgArry;
        var title = imgArry.title;
        var altTag = imgArry.altTag;
        var fullUrl = imgArry.fullUrl;
        var id = imgArry.id;
        html = `<div class="hotelImgContent">
                    <div class="imgCon"><img src="${fullUrl}"/></div>
                    <input class="form-control" type="hidden" name="fileId" id="fileId" value="${id}">
                    <div class="texCon">
                        <div class="form-group">
                            <label for="fileTitle">File Name</label>
                            <input class="form-control" type="text" name="fileTitle" id="fileTitle" placeholder="Enter title" value="${title}">
                        </div>
                        <div class="form-group">
                            <label for="fileAlt">File Alt Tag <span>(Alt tags help search engine crawlers)</span></label>
                            <input class="form-control" type="text" name="fileAlt" id="fileAlt" placeholder="Enter alt tag" value="${altTag}">
                        </div>
                    </div>
                </div>`;
        showModalBox('Update Image', 'Update', html, 'hotelImageDataUpdate', 'modal-lg');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
});

$(document).on('click', '.deleteImgBtn', function (e) {
    e.preventDefault();
    var imagname = $(this).data('imagname');
    var type = $(this).data('type');
    var alert = `You won't be delete image file.`;
    Swal.fire({
        title: 'Are you sure?',
        text: alert,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = `request_type=deleteImage&type=${type}&imagname=${imagname}`;
            ajax_request(formData).done((data) => {
                var response = JSON.parse(data);
                var msg = response.msg;
                var status = response.status;

                if (status == 'success') {
                    sweetAlert(msg);
                    $(this).parent().parent().parent().remove();
                }
                if (status == 'error') {
                    sweetAlert(msg, 'error');
                }
            });
        }
    });

});

$(document).on('click', '#hotelImageDataUpdate', function (e) {
    e.preventDefault();
    var type = $(this).data('type');
    var fileTitle = $('#fileTitle').val().trim();
    var fileAlt = $('#fileAlt').val().trim();
    var fileId = $('#fileId').val();
    var loder = window.spinner;
    $('#loadPolicyPreview .content').html(loder);
    var formData = `request_type=hotelImageDataSubmit&fileTitle=${fileTitle}&fileAlt=${fileAlt}&fileId=${fileId}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;

        if (status == 'success') {
            sweetAlert(msg);
            $('#popUpModal').modal('hide');
        }

        if (status == 'error') {
            sweetAlert(msg, 'error');
        }

    });
});


function loadHotelData() {
    var formData = `request_type=loadHotelData`;
    var loder = window.loaderSpinner;
    $('#loadHotelDetail').html(loder);
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        $('#loadHotelDetail').html(response);
    });
}

$(document).on('click', '#shareCopyLinkBtn', function (e) {
    e.preventDefault();
    var value = $('#shareCopyLink').val();
    html = `<svg class="animationTickIcon"><use xlink:href="#animationTickIcon"></use></svg>`;
    $(this).html(html);
    navigator.clipboard.writeText(value);
});

$(document).on('click', '#payLinkShareEmail', function (e) {
    e.preventDefault();
    var pid = $(this).data('paymentid');
    var formData = `request_type=payLinkShareAction&type=mail&pid=${pid}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;
        $('#customModal').removeClass('is-visible');
        if (status == 'success') {
            sweetAlert(msg);
        }
        if (status == 'error') {
            sweetAlert(msg, 'error');
        }

    });

});

$(document).on('click', '#payLinkShareQrCode', function (e) {
    e.preventDefault();
    var pid = $(this).data('paymentid');
    var formData = `request_type=payLinkShareAction&type=qr&pid=${pid}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var link = response.link;
        var html = `<img src="${link}">`;
        customModal('QR Code', html);
    });

});


var guestCount = 0;
$(document).on('click', '#guestAddBtn', function (e) {
    e.preventDefault();
    guestCount++;
    var html = `
        <hr/>
            <div id="guestGroup${guestCount}">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Guest Name</label>
                            <div class="form-group">
                                    <input type="text" placeholder="Name" class="form-control" name="guestName" id="guestName">
                                    <div class="iconBox">
                                        <a href="javascript:void(0)" class="iconCon" data-tooltip-top="Identity">
                                            <i class="far fa-address-card"></i>
                                        </a>
                                    </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="guestMobile">Mobile</label>
                            <input type="number" placeholder="Mobile No" class="form-control" name="guestMobile" id="guestMobile">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" placeholder="Email Id" class="form-control" name="guestEmail">

                        </div>
                    </div>

                </div>

                <div class="row align-items-end">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" placeholder="Address" class="form-control" name="guestAddress">

                        </div>
                    </div>
                    <div class="col-md-4 guestContentBtn">
                        <button id="guestAddBtn" class="btn bg-gradient-dark">Add Guest</button>
                    </div>


                </div> 
            </div>
    `;
    $('#guestContent').append(html);
});

$(document).on('click', '#assignHousekeeperBtn', function (e) {
    e.preventDefault();
    var data = $('#assignHousekeeperForm').serialize();
    var formData = `${data}&request_type=updateHK`;
    ajax_request(formData).done(function (data) {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;

        var target = $('#roomStatusFilterForm li.active').data('target');

        if (status == 'success') {
            loadHouseKeepingReport(target);
            $('#popUpModal').modal('hide');
            sweetAlert(msg);
        }

        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });
});


$(document).on('click', '#hkRemarkUpdateBtn', function (e) {
    e.preventDefault();
    var data = $('#hkRemarkUpdateForm').serialize();
    var formData = `${data}&request_type=updateRemarkForHK`;
    ajax_request(formData).done(function (data) {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;

        if (status == 'success') {
            loadHouseKeepingReport('dailyStatus');
            $('#popUpModal').modal('hide');
            sweetAlert(msg);
        }

        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });
});

$(document).on('click', '#roomStatusUpdateBtn', function (e) {
    e.preventDefault();
    var data = $('#roomStatusUpdateForm').serialize();
    var formData = `${data}&request_type=updateRoomStatusInsert`;
    ajax_request(formData).done(function (data) {
        var response = JSON.parse(data);
        var status = response.error;
        var msg = response.msg;

        if (status == 'no') {
            loadHouseKeepingReport('dailyStatus');
            $('#popUpModal').modal('hide');
            sweetAlert(msg);
        }

        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });
});

$(document).on('click', '#settlementSubmitBtn', function () {
    var data = $('#settlementForm').serialize();
    var form_data = data + "&request_type=settlementSubmitBtn";

    if ($('#settlementAmount').val() == '') {
        console.log('Settlement amout required!');
    } else {
        ajax_request(form_data).done((result) => {
            var response = JSON.parse(result);
            var status = response.status;
            var msg = response.msg;

            if (status == 'success') {
                sweetAlert(msg);

                if (window.filePath == 'unsettled') {
                    loadUnSettledData();
                    $('#popUpModal').modal('hide');
                }
                if (window.filePath == 'invoices') {
                    loadInvoicesData();
                    $('#popUpModal').modal('hide');
                }
                if (window.filePath == 'order') {
                    loadKotTable();
                    $('.tableArea').addClass('show');
                    $('.kotProductArea').removeClass('show');
                    $('#popUpModal').modal('hide');
                }
            }
            if (status == 'error') {
                sweetAlert(msg, 'error');
            }
        });
    }
});

$(document).on('click', '#paidSubmitBtn', function () {
    var data = $('#paymentForm').serialize();
    var form_data = data + "&request_type=paidSubmitBtn";

    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var status = response.status;
        var msg = response.msg;

        if (status == 'success') {
            sweetAlert(msg);

            loadKotTable();
            $('.tableArea').addClass('show');
            $('.kotProductArea').removeClass('show');
            $('#popUpModal').modal('hide');

        }
        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });

});

$(document).on('click', '#shiftTableSubmit', function (e) {
    e.preventDefault();
    var data = $('#shiftTableForm').serialize();
    var form_data = data + "&request_type=shiftTableSubmit";
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var status = response.status;
        var msg = response.msg;

        if (status == 'success') {
            sweetAlert(msg);
            loadKotTable();
            $('#popUpModal').modal('hide');
        }
        if (status == 'error') {
            sweetAlert(msg, 'error');
        }
    });
});


$(document).on('click', '#addRoomBtnForReservation', function (e) {
    e.preventDefault();
    var bid = $(this).data('bid');
    var form_data = `request_type=getRoomNameList`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var roomTypeHtml = '<option value="0">-Select Room</option>';
        $.each(response, (key,val)=>{
            var id = val.id;
            var header = val.header;
            roomTypeHtml += `<option value="${id}">${header}</option>`;
        });
        var html = `
            <form id="editResAddRoomForm">
                <input type="hidden" value="${bid}" name="bid"/>
                <div class="form-group">
                    <label for="roomTypeSelect">Room Type</label>
                    <select id="roomTypeSelect" class="form-control addRoomSelectRoomId" name="selectRoom" data-rno="0">
                        ${roomTypeHtml}
                    </select>
                </div>
                <div class="form-group">
                    <label for="ratePlanSelect">Rate Plan</label>
                    <select id="ratePlanSelect" class="form-control addRoomRateTypeId" name="selectRateType" disabled="" data-rno="0">
                        <option value="" selected="">-Select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="adultSelect">Adult</label>
                    <select id="adultSelect" class="form-control addRoomAdultSelect" name="selectAdult" disabled="">
                        <option value="" selected="">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="childSelect">Child</label>
                    <select class="form-control addRoomChildSelect" name="selectChild" disabled="">
                        <option value="" selected="">0</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="roomNumberSelect">Room number</label>
                    <select id="roomNumberSelect" class="form-control addRoomNumSelect" name="roomNum" disabled="">
                        <option value="" selected="">No</option>
                    </select>
                </div>
                <div class="form-group reservationRateArea">
                    <label for="ratePlanSelect">Total Price</label>
                    <input type="text" value="0.00" class="form-control addRoomTotalPriceSection" disabled="">                
                </div>
                <input type="submit" value="Add Room" class="form-control btn bg-gradient-info"/>
            </form>
    `;
    customModal('Add Room', html);
    });
    
});


$(document).on('click', '#editBookingDetailSubmit', function (e) {
    {
        e.preventDefault();
        var data = $('#editBookingDetailForm').serialize();
        var formData = `request_type=editBookingDetailSubmit&${data}`;
        ajax_request(formData).done(function (request) {
            var response = JSON.parse(request);
            var status = response.status;
            var msg = response.msg;
            var bid = response.bid;

            if (status == 'success') {
                sweetAlert(msg);
                $('#popUpModal').modal('hide');

                if(window.filePath == 'reservation-edit'){
                    loadEditResturentReport('room', bid);
                }

                if(window.filePath == 'todays-event'){
                    var target = $('#section-tab-nav li.active').data('target');
                    loadTodayEventReport(target);
                }
            }
        });
    }
});

$(document).on('click', '#editExtendStaySubmit', function (e) {
    {
        e.preventDefault();
        var data = $('#editExtendStayForm').serialize();
        var formData = `request_type=editExtendStaySubmit&${data}`;
        ajax_request(formData).done(function (request) {
            var response = JSON.parse(request);
            var status = response.status;
            var msg = response.msg;
            var bid = response.bid;

            if (status == 'success') {
                sweetAlert(msg);
                $('#popUpModal').modal('hide');

                if(window.filePath == 'todays-event'){
                    var target = $('#section-tab-nav li.active').data('target');
                    loadTodayEventReport(target);
                }
            }
        });
    }
});


$(document).on('click', '#addPaymentSubmitBtn', function (e) {
    e.preventDefault();
    var bid = $('#bid').val().trim();
    var tabData = $('#tabData').val();
    var paidDate = $('#paidDate').val();
    var amount = $('#amountPaid').val().trim();
    var paymentMethod = $('#paymentMethod option:selected').val();
    var remark = $('#remark').val().trim();
    var page = window.filePath;

    var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
    if (bid == '') {
        sweetAlert('Something went wrong, please try after sometime.', 'error');
    } else if (amount == '') {
        sweetAlert('Amount is required.', 'error');
    } else if (!float.test(amount)) {
        sweetAlert('Amount must be number.', 'error');
    } else if (paymentMethod == '0') {
        sweetAlert('Payment method is required.', 'error');
    } else if (remark == '') {
        sweetAlert('Remark is required.', 'error');
    } else {
        var data = `request_type=guestPaymentSubmit&amount=${amount}&paymentMethod=${paymentMethod}&remark=${remark}&bid=${bid}&paidDate=${paidDate}`;
        ajax_request(data).done(function (request) {
            $('#popUpModal').modal('hide');
            sweetAlert('Successfully add payment.');
            
            if(page == 'folios'){
                loadFoliosReport(bid);
            }else{
                if(tabData == 'folio'){
                    loadEditResturentReport('bill', bid);
                }
    
                if(tabData == 'payment'){
                    loadEditResturentReport('payment', bid);
                }
            }
            
            

        });
    }
});

$('.supportSec .content').on('click', function () {
    $('.supportSec .textContent').toggleClass('show');
});




$(document).on('click', '#addOrganisation', function () {
    loadAddOrganisation();
});
$('.closeOrganisation').click(function () {
    $('#addOrganisationModal').modal('hide');
});

$('.closeTravelAgent').click(function () {
    $('#addTravelAgentModal').modal('hide');
});


function loadAddOrganisation(id='') {
    var data = `request_type=load_form_organisation&id=${id}`;
    var title = (id == '') ? 'Add Organisation' : 'Update Organisation';
    var rateList = '';

    ajax_request(data).done(function(request) {
        var response = JSON.parse(request);
        var ratePlan = response.ratePlan;
        var data = response.data;

        $.each(ratePlan, (key,val)=>{
            var name = val.srtcode;
            var id = val.id;
            rateList += `<option value="${id}">${name}</option>`;
        })

        html =`
        <div class="organisation-modal-body">
        <form action="" id="organisationForm">
            <div class="row">
                <input name="actionId" type="hidden" value="${id}"/>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Name *</label>                     
                        <input type="text" placeholder="Organisation Name" class="form-control" id="organisationname" name="organisationname">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="orgConName">Contact Person Name *</label>                     
                        <input type="text" placeholder="Contact Person Name" class="form-control" name="orgConName" id="orgConName">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Email *</label>                     
                        <input type="text" placeholder="Organisation Email" class="form-control" name="organisationemail" id="organisationemail">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Address</label>                     
                        <input type="text" placeholder="Organisation Address" class="form-control" name="organisationaddress">

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">City</label>                     
                        <input type="text" placeholder="City" class="form-control" name="organisationcity">

                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">State</label>                     
                        <input type="text" placeholder="State" class="form-control" name="organisationState">

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Country</label>                     
                        <input type="text" placeholder="Country" class="form-control" name="organisationCountry">

                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Post Code</label>                     
                        <input type="text" placeholder="Post Code" class="form-control" name="organisationPostCode">

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Phone Number</label>                     
                        <input type="text" placeholder="eg:+91 ***** *****" class="form-control" name="organisationNumber">

                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">GST Number</label>                     
                        <input type="text" id="gstNoField" placeholder="GST Number" class="form-control" name="organisationGstNo">

                    </div>
                </div>       
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Rate Plan</label>       

                        <select class="form-control" name="rateplan" id="rateplan">                        
                        
                        <option value="0" select="selected">Select</option>   
                        ${rateList}                          

                        </select>
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Sales Manager</label>                  
                        <input type="text" id="salesManager" placeholder="Sales Manager" class="form-control" name="salesManager">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Discount</label>     

                        <input type="number" placeholder="eg:5%" class="form-control" name="organisationDiscount">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label">Notes</label>                    
                        <input type="text" placeholder="note" class="form-control" name="organisationNote">
                    </div>
                </div>


            </div>

        </form>
    </div>
        `;

        showModalBox(title, 'Save', html, 'submitOrganisation', 'modal-xl');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    })
}

$(document).on('click', '#submitOrganisation', function () {

    var formData = $('#organisationForm').serialize();

    formData += '&type=addNewOrganisation';

    let organisationname = $('#organisationName').val();
    let orgConName = $('#orgConName').val();
    let organisationemail = $('#organisationemail').val();

    if(organisationname == ''){
        sweetAlert('Name Is Required!', 'error');
    }else if(orgConName == ''){
        sweetAlert('Contact Person Name Is Required!', 'error');
    }else if(organisationemail == ''){
        sweetAlert('Email Id Is Required!', 'error');
    }else{
        $.ajax({
            url:  webUrl+"/include/ajax/resorvation.php",
            type: 'post',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                var id = res.id;
                var status = res.status;
                var name = res.name;
                var msg = res.name;
    
                if (res.status == 'success') {
                    sweetAlert(res.msg);
                    $('#organisationForm')[0].reset();
                    $('#popUpModal').modal('hide');
                    
                    
                    if (window.filePath == 'company') {
                        loadCompanyDataBase();
                    }else if (window.filePath == 'walk-in'){
                        var html = `<option seleted value="${id}" selected="">${name}</option>`;
                        $('#organisation').append(html);
                    }
                } else {
                    sweetAlert('error', res.msg);
                }
            }
        });
    }
});

$(document).on('change', '#billingmode', function () {
    var selectedValue = $(this).val();

    if (selectedValue == 3) {
        $('#companyrow').css('display', 'block');
    } else {
        $('#companyrow').css('display', 'none');
    }
});
$(document).on('change', '#organisationfield', function () {
    var organisation = $(this).val();
    var dataid = $('#inputOrganisationList').find('option[value="' + organisation + '"]').data('option-id');

    var data = {
        organisation: organisation,
        dataid: dataid,
        type: 'getGstNumber'
    };

    var formData = new FormData();

    for (var key in data) {
        formData.append(key, data[key]);
    }

    var endpoint = webUrl+"/include/ajax/resorvation.php";
    var requestOptions = {
        method: 'POST',
        body: formData
    };

    fetch(endpoint, requestOptions)
        .then(response => response.json())
        .then(data => {
            if (data.status == 'ok') {
                $('#gstNoField').val(data.gstNo);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });


});

$(document).on('click', '#addTravelAgent', function () {
    $('#addTravelAgentModal').modal('show');
});

$(document).on('click', '#submitTravelAgent', function () {
    submitTravelAgent();        
});

$(document).on('click', '#addTravelAgentFormSubmit', function () {
    submitTravelAgent();        
});


$(document).on('submit', '#allowanceForm', function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var formData = `${data}&request_type=allowanceFormSubmit`;
    var bid = $('#booingId').val();
    ajax_request(formData).done(function (request){
        customModalClose();
        loadEditResturentReport('bill', bid);
    })
});


$(document).on('click','#addExtraChargesSubmitBtn',function(e){
    e.preventDefault();
    var data = $('#addExtraChargesForm').serialize();
    var formData = `${data}&request_type=addExtraChargesSubmitBtn`;
    var bid = $('#booingId').val();
    var page = window.filePath;

    ajax_request(formData).done(function (request){
        customModalClose();

        if(page == 'folios'){
            loadFoliosReport(bid);
        }else{
            loadEditResturentReport('bill', bid);
        }
        
        $('#popUpModal').modal('hide');
    })

});

$(document).on('submit','#roomChargeForm', function(e){
    e.preventDefault();
});

$(document).on('change','#inputRoomChargeHalfDay', function(e){
    e.preventDefault();
    var roomPrice = $('#roomMainPrice').val().trim();
    if ($(this).prop('checked')==true){ 
        var result = roomPrice / 2;
    }else{
        var result = roomPrice;
    }
    $('#txtRoomChargeChargeAmount').val(rupeesFormat(result));
});

$(document).on('change','#txtRoomChargeDiscountPercentage', function(e){
    e.preventDefault();
    var roomPrice = $('#roomMainPrice').val().trim();
    $('#inputRoomChargeHalfDay').attr('checked', false);
    var value = $(this).val().trim();
    var presenValue = parseFloat(roomPrice) * parseFloat(value) / 100;
    var remainAmount = parseFloat(roomPrice) - parseFloat(presenValue);

    $('#txtRoomChargeDiscountAmount').val(rupeesFormat(presenValue));
    $('#txtRoomChargeChargeAmount').val(rupeesFormat(remainAmount));
});

$(document).on('click','#roomChargeSubmitBtn', function(e){
    e.preventDefault();
    var bid = $('#bookingId').val();
    var page = window.filePath;

    if ($("#roomNumList input:checkbox:checked").length == 0)    {
        alert('Room number is required.');
    }else{
        var data = $('#roomChargeForm').serialize();
        var formData = `${data}&request_type=roomChargeFormSubmit`;
        ajax_request(formData).done(function (request){

            if(page == 'folios'){
                loadFoliosReport(bid);
            }else{
                loadEditResturentReport('bill', bid);
            }
                        
            customModalClose();
        })
    }
});


$(document).on('submit','#galleryItemForm', function(e){
    e.preventDefault();
    var data = $('#galleryItemForm').serialize();
    var formData = `${data}&request_type=galleryItemFormSubmit`;
    ajax_request(formData).done(function (request) {
        
    })
});


$(document).on('click','#userAccessTabs a', function(e){
    e.preventDefault();
    var target = $(this).attr('href');
    $('#userAccessTabs .item').removeClass('show');
    $('#userAccessTabs a').removeClass('show');
    $(this).addClass('show');
    $(target).addClass('show');
});

$(document).on('click','#userPermissionSave', function(e){
    e.preventDefault();
    var data = $('#tabsContentForm').serialize();
    var formData = `${data}&request_type=userPermissionSave`;
    var uid = $('#uid').val();
    ajax_request(formData).done(function (request) {
        loadUserDetail(uid);
        $('#popUpModal').modal('hide');
    })
});

$(document).on('click','.sendMailToGuest',function(e){
    e.preventDefault();
    var bid = $(this).data('oid');
    generateEmailSent(bid);
});

$(document).on('click','.emailSendBtn',function(){
    var bid = $(this).data('bid');
    var email = $(this).data('email');
    email = email.trim();
    data ={
        'oid':bid,
        'email':email
    }
    $.ajax({
        url: webUrl+"/email_send.php",
        type: 'GET',
        data : data,
        success: function(response){
            customModalClose();
            sweetAlert('Mail sent');
        },
        error: function(error){
            sweetAlert('Error','error');
        }
    })
})


$(document).on('change', 'input:radio[name=paymentType]:checked', function(e){
    e.preventDefault();
    var value = $(this).val();
    var paidamout = $(this).data('paidamout');
    var html = `<label for="settlementAmount">Settlement Amount</label>
                <input class="form-control" type="text" id="settlementAmount" name="settlementAmount" value="${paidamout}" placeholder="Enter settlement amount.">`;

    if(value == 'roomSettle'){
        var form_data = `request_type=getFolioList`;
        ajax_request(form_data).done((result) => {
            var responce = JSON.parse(result);
            var optionHtml = '<option value="0">Select Room Num</option>';
            if(responce.length > 0){
                $.each(responce, (key,val)=>{
                    var folioId = val.folioId;
                    var roomNum = val.name;
                    optionHtml += `<option value="${roomNum}">${roomNum}</option>`;
                })
            }else{
                optionHtml += `<option value="0">No Check In</option>`;
            }
            html = `
                <label for="selectFolio">Select Folio</label>
                <select class="customControl w100" name="selectFolio" id="selectFolio">
                    ${optionHtml}
                </select>
            `;

            $('#replaceContent').html(html);
        });
       
    }else{
        $('#replaceContent').html(html);
    }


});


$(document).on('change', '.lostFoundRadio', function(e){
    e.preventDefault();
    var value = ($(this).val() == 'return') ? 'Returned' : 'Discarded';

    var html = `
        <div class="row">

            <div class="col-md-5">
                <div class="form-group">
                    <label for="statusBy">${value} By</label>
                    <input class="form-control" type="text" name="statusBy" id="statusBy" placeholder="${value} By">
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group" id="lostDateField">
                    <label for="statusDate">${value} On</label>
                    <div class="inputLabel">
                        <input readonly class="form-control statusDatePicker" type="text" name="statusDate" placeholder="${value} On">
                        <div class="iconBox right"><i class="far fa-calendar"></i></div>
                    </div>
                </div>
            </div>

        </div>
    `;

    $('#statusAdvance').html(html);

    $('.statusDatePicker').datepicker({
        endDate: new Date()
    });

});


$(document).on('click','#addBlockRoomSubmit', function(e){
    e.preventDefault();   

    var start = $('#blockRoomDatepicker start').val();
    var end = $('#blockRoomDatepicker end').val();
    var choseRoom = $('#choseRoom').val();
    var reason = $('#reason').val();

    if(start == ''){
        sweetAlert('Start date is required','error');
    }else if(end == ''){
        sweetAlert('End date is required','error');
    }else if(choseRoom == ''){
        sweetAlert('Room is required','error');
    }else if(reason == ''){
        sweetAlert('Reason is required','error');
    }else{
        var data = $('#addBlockRoomForm').serialize();
        var formdata = `${data}&request_type=addBlockRoomSubmit`;
        ajax_request(formdata).done(function (request) {
            var response = JSON.parse(request);
            var status = response.status;
            var msg = response.msg;

            if(status == 'success'){
                $('#popUpModal').modal('hide');
                if(window.filePath == 'housekeeping'){
                    loadHouseKeepingReport('blockedRoom');
                }

                if(window.filePath == 'room-view'){
                    loadHouseKeepingReport('blockedRoom');
                    loadRoomViewSideNav();
                    loadRoomView();
                    loadRoomViewCountNavBar();
                }
                
            }

        });
    }


    
});

$(document).on('change','#bookByOther',function(){
    if($(this).is(':checked')) {
        var data = `request_type=getStateInIndia`;
        var stateHtml = '<option value="">Select _</option>';
        ajax_request(data).done((returnData)=>{
            returnData = JSON.parse(returnData);
            $.each(returnData, (key,val)=>{
                stateHtml += `<option value="${val}">${val}</option>`;
            });

            var html = `
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="form-group">
                            <div class="inputLabel left">
                                <input type="text" placeholder="Name" class="form-control" name="bookByName" id="bookByName" autocomplete="off">
                                <div class="iconBox">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <div class="inputLabel left">
                            <input type="text" placeholder="Email Id" class="form-control" name="bookByEmail">
                            <div class="iconBox">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M494.6 164.5c-4.7-3.9-111.7-90-135.3-108.7C337.2 38.2 299.4 0 256 0c-43.2 0-80.6 37.7-103.3 55.9-24.5 19.5-131.1 105.2-135.2 108.5A48 48 0 0 0 0 201.5V464c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V201.5a48 48 0 0 0 -17.4-37zM464 458a6 6 0 0 1 -6 6H54a6 6 0 0 1 -6-6V204.3c0-1.8 .8-3.5 2.2-4.7 15.9-12.8 108.8-87.6 132.4-106.3C200.8 78.9 232.4 48 256 48c23.7 0 55.9 31.4 73.4 45.4 23.6 18.7 116.5 93.5 132.4 106.3a6 6 0 0 1 2.2 4.7V458zm-32-187.7c4.2 5.2 3.5 12.8-1.7 17-29 23.3-59.3 47.6-70.9 56.9C336.6 362.3 299.2 400 256 400c-43.5 0-81.3-38.2-103.3-55.9-11.3-9-41.7-33.4-70.9-56.9-5.2-4.2-6-11.8-1.7-17l15.3-18.5c4.2-5.1 11.7-5.8 16.8-1.7 28.6 23 58.6 47 70.6 56.6C200.1 320.6 232.3 352 256 352c23.6 0 55.2-30.9 73.4-45.4 12-9.5 41.9-33.6 70.6-56.6 5.1-4.1 12.6-3.3 16.8 1.7l15.3 18.5z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bookByWhatsApp">WhatsApp</label>
                        <div class="inputLabel left">
                            <input type="number" placeholder="bookByWhatsApp" class="form-control" name="bookByWhatsApp" id="bookByWhatsApp">
                            <div class="iconBox left">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bookByMobile">Mobile</label>
                        <div class="inputLabel left">
                            <input type="number" placeholder="Mobile No" class="form-control" name="bookByMobile" id="bookByMobile">
                            <div class="iconBox left">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bookBypinCode">Pin Code</label>
                        <input onkeyup="pinChangeToFetch(event)" type="text" placeholder="Pin code" class="form-control" name="bookBypinCode">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bookBydistrict">District</label>
                        <input type="text" placeholder="District" class="form-control district" name="bookBydistrict">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bookBystate">State</label>
                        <select class="customSelect" name="bookBystate" id="bookBystate">
                            ${stateHtml}
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="bookByAddress">Address</label>
                        <input id="bookByAddress" type="text" placeholder="Address" class="form-control state" name="bookByAddress">
                    </div>
                </div>

            </div>
        `;
        $('#advanceFieldContent').html(html);
        })
        
    } else {
        $('#advanceFieldContent').html('');
        console.log('false');
    }
});



$(document).on('click', '.customDropdown .btnCD', function(e) {
    e.preventDefault();
    $('.customDropdown ul').removeClass('show');
    $(this).siblings('ul').toggleClass('show');
});

$(document).on('click', function(e) {
    if (!$(e.target).closest('.customDropdown').length) {
        $('.customDropdown ul').removeClass('show');
    }
});

$(document).on('click', '.propertyAreaList .propertyArea', function(e) {
    e.preventDefault();
    $(this).siblings('.propertyAreaList ul').toggleClass('show');
});

$(document).on('click', function(e) {
    if (!$(e.target).closest('.propertyAreaList').length) {
        $('.propertyAreaList ul').removeClass('show');
    }
});

$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown').length) {
        $('.dropdown-menu').removeClass('show');
    }
});


$(document).on('keyup','#travelagentname', function(){
    var name = $(this).val().trim();
    getInputNameCheck('travel_agents',name,'travelDropDown','travelagentname');
});

$(document).on('keyup','#organisationName', function(){
    var name = $(this).val().trim();
    getInputNameCheck('organisations',name, 'organisationDropDown','organisationName');
});

$(document).on('change', '#billingmode', function(e){
    var value = $(this).val();
    
    if(value == 'company'){
        $('.companySection').addClass('show');
    }else{
        $('.companySection').removeClass('show');
    }
})




