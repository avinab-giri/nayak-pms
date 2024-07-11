function generateEditReservationLinkInJs(bid,type=''){
    var link = webUrl+'reservation-edit?id='+bid;

    if(type != ''){
        link += '$type='+type;
    }

    return link;
}

function generateFolioLinkInJs(bid){
    var link = webUrl+'folios?id='+bid;

    return link;
}

function arrayToStr(arr){
    cleanArray = arr.filter(e => e);

    return cleanArray.toString();
}

function getInvoiceLink(bid){
    var link = webUrl+'invoice?id='+bid;
    return link;
}

function calculateNight(startDate,endDate){
    return moment(endDate).diff(moment(startDate), 'days');
}

function printContentDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function insertDataInDatabase(tableName, dataToSend, elementId = '') {
    $.ajax({
        url: `${webUrl}include/ajax/pushData.php`,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            table: tableName,
            data: dataToSend,
            elementId: elementId
        }),
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function deleteImageForDatabase(tableName, dataToSend) {
    $.ajax({
        url: `${webUrl}include/ajax/deleteData.php`,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            table: tableName,
            data: dataToSend
        }),
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function viewBookingReport($bid = '', $bdid = '') {
    var bid = $bid;
    var form_data = `request_type=makeReservationDetail&bid=${bid}`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var guestArray = response.guestArray[0];
        var bookinId = response.bookinId;
        var bookingSource = response.bookingSource;
        var addByName = response.addByName;
        var billingMode = response.billingMode;
        var exBd = response.exBd;
        var checkInDetail = response.checkInDetail;
        var checkOutDetail = response.checkOutDetail;
        var compayName = response.compayName;
        var gstno = response.gstno;

        var checkIn = response.checkIn;
        var checkInTime = moment(response.checkInTime, "HH:mm:ss").format("hh:mm A");
        var checkInYr = moment(checkIn).format('YYYY');
        var checkInMonth = moment(checkIn).format('MMM');
        var checkInDay = moment(checkIn).format('DD');
        var checkInDayStr = moment(checkIn).format('ddd');
        
        var checkOut = response.checkOut;
        var checkOutTime = moment(response.checkOutTime, "HH:mm:ss").format("hh:mm A");
        var checkOutYr = moment(checkOut).format('YYYY');
        var checkOutMonth = moment(checkOut).format('MMM');
        var checkOutDay = moment(checkOut).format('DD');
        var checkOutDayStr = moment(checkOut).format('ddd');
        var checkinstatus = response.checkinstatus;
        var bussinessSource = response.bussinessSource;
        var guestSpecialRequest = response.specialRequest;

        var totalPrice = response.totalPrice;
        var userPay = response.userPay;
        var remeningPay = Math.round(totalPrice - userPay);

        var addOn = moment(response.addOn).format('DD-MMM-YYYY, hh:mm A');
        var night = response.night;
        var roomDetailArry = response.roomDetailArry;

        var checkinstatusArray = getCheckInStatus(checkinstatus);
        var statusCls = checkinstatusArray.btnCls;
        var statusBtn = checkinstatusArray.name;
        

        var generateInvoiceLink = getInvoiceLink(bid);
        var voucherLink = `${webUrl}voucher.php?oid=${bid}`;
        
        let bSourceHtml = response.bookingSourceName;

        var gName = guestArray.name;
        var gEmail = guestArray.email;
        let gWhatsAppNo = guestArray.whatsapp;
        let gAddress = arrayToStr([guestArray.full_address, guestArray.district, guestArray.state]);
        var gPhone = guestArray.phone;
        var gImg = guestArray.profileImgFull;
        var bookDetailHtml = '';

        let organitionArray = response.bookByOrga;
        let travelAgentArray = response.bookByAgent;

        let orgaName = '';
        let orgaGst = '';
        let orgaCPName = '';
        let orgaCPNo = '';
        let orgaCPEmail = '';
        let orgaCPCity = '';
        let orgaCPStaa = '';
        let orgConPer = '';

        let travelName = '';
        let travelGst = '';
        let travelCPName = '';
        let travelCPNo = '';
        let travelCPEmail = '';
        let travelCPCity = '';
        let travelCPStaa = '';
        let travelConPer = '';

        if(Object.keys(organitionArray).length > 0){
            orgaName = (organitionArray['name']) ? organitionArray['name'] : '';
            orgaGst = (organitionArray['organisationGstNo']) ? organitionArray['organisationGstNo'] : '';
            orgaCPName = (organitionArray['orgConName']) ? organitionArray['orgConName'] : '';
            orgaCPNo = (organitionArray['organisationNumber']) ? organitionArray['organisationNumber'] : '';
            orgaCPEmail = (organitionArray['organisationEmail']) ? organitionArray['organisationEmail'] : '';
            orgaCPCity = (organitionArray['organisationCity']) ? organitionArray['organisationCity'] : '';
            orgaCPStaa = (organitionArray['organisationState']) ? organitionArray['organisationState'] : '';

            orgConPer = arrayToStr([orgaCPName, orgaCPNo, orgaCPEmail, orgaCPCity, orgaCPStaa]);
        }

        if(Object.keys(travelAgentArray).length > 0){
            travelName = (travelAgentArray['agentName']) ? travelAgentArray['agentName'] : '';
            travelGst = (travelAgentArray['travelagentGstNo']) ? travelAgentArray['travelagentGstNo'] : '';
            travelCPName = (travelAgentArray['travelagentname']) ? travelAgentArray['travelagentname'] : '';
            travelCPNo = (travelAgentArray['travelagentPhoneno']) ? travelAgentArray['travelagentPhoneno'] : '';
            travelCPEmail = (travelAgentArray['travelagentemail']) ? travelAgentArray['travelagentemail'] : '';
            travelCPCity = (travelAgentArray['travelagrntCity']) ? travelAgentArray['travelagrntCity'] : '';
            travelCPStaa = (travelAgentArray['travelagentState']) ? travelAgentArray['travelagentState'] : '';

            travelConPer = arrayToStr([travelCPName, travelCPNo, travelCPEmail, travelCPCity, travelCPStaa]);
        }

        $.each(roomDetailArry, function (key, val) {
            var room_number = val.room_number;
            var adult = val.adult;
            var child = val.child;
            var rateplan = val.rateplan;
            var roomName = val.roomName;
            var subTotal = val.subTotal;
            var total = val.total;
            var gstPrice = val.gstPrice;
            var gstPer = val.gstPer;
            var oneNight = Math.round(total / night);

            bookDetailHtml += `
                    <li class="list-group-item">
                        <div class="row row-flex">
                            <div class="col col-info col-info-first">
                                <span class="dFlex aic"><small class="mR5">Ex Bed's</small> <strong class="db clrBlack fs20"> ${exBd}</strong></span>
                                <span class="dib clrBlack">Adult <strong class="dib clrBlack">${adult}</strong> | Child <strong class="dib clrBlack">${child}</strong></span>
                                <span class="m-t-xs badge  badge-arrived">Check In</span></div>
                            <div class="col col-info col-info-second">
                                    <div class="db">
                                       <span class="clrBlack db">Room Type :- </span>
                                       <strong class="clrBlue fs18 db">${roomName}</strong>
                                    </div>
                                    <div class="db">
                                       <span class="clrBlack db" style="line-height: 2;"> Rate Plan :- </span>
                                       <strong class="clrBlue fs18 db">${rateplan[0]}</strong>
                                    </div>
                            </div>
                            <div class="col col-info col-info-third">
                                <div class="row row-flex">
                                    <div class="col text-center m-l-xs"><span class="clrBlack">Exp. Arrival</span>
                                        <span class="badge date-badge badge-success dFlex fdc aic jcc">
                                            <small class="clri fs14">${checkInDay}</small>
                                            <strong class="fs20">${checkInMonth}</strong>					    
                                            <small class="clri fs14">${checkInYr}</small>
                                        </span>
                                        <p class="time clrBlack">${checkInDayStr}</p>
                                    </div>
                                    <div class="col text-center m-l-xs"><span class="clrBlack">Exp. Dept.</span>
                                        <span class="badge date-badge badge-danger dFlex fdc aic jcc">
                                            <small class="clri fs14">${checkOutDay}</small>
                                            <strong class="fs20">${checkOutMonth}</strong>					    
                                            <small class="clri fs14">${checkOutYr}</small>
                                        </span>
                                        <p class="time clrBlack">${checkOutDayStr}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-info col-amount col-info-fourth">
                                <div class="row">
                                <span class="db clrBlack">Rate:
                                    <strong class="amount">&#x20B9; ${subTotal}</strong>
                                </span>

                                <span class="dib clrBlack">Disc:
                                    <strong class="amount">0.00</strong></span>

                                <span class="dib clrBlack">Extra:
                                    <strong class="amount">0.00</strong>
                                </span>

                                <span class="db clrBlack">Tax (${gstPer}%):
                                    <strong class="amount">&#x20B9; ${gstPrice}</strong>
                                </span>

                                <span class="db clrBlack">Total:
                                    <strong class="amount">&#x20B9; ${total}</strong>
                                </span>

                                </div>
                            </div>
                            <div class="col col-info col-info-fifth">
                                <div class="row">
                                    <span class="db clrBlack">Total For 1 Night(s)</span>
                                    <strong class="db clrBlue fs18">&#x20B9; ${oneNight}</strong>
                                </div>
                            </div>
                        </div>
                    </li>
            `;
        });

        let paymentArrayHtml = '';

        $.each(response.paymentArry, (index, val)=>{
            let amount = val.amount;
            let addOn = moment(val.addOn).format('DD-MMM-YYYY, hh:mm A') ;
            let paymentMethod = getPaymentMethods(val.paymentMethod);
            let paidOn = (val.paidOn == null) ? null : moment(val.paidOn).format('DD-MMM-YYYY, hh:mm A') ;

            paymentArrayHtml += `
                    <tr>
                        <td>${addOn}</td>
                        <td>${paidOn}</td>
                        <td>${paymentMethod}</td>
                        <td>${amount}</td>
                    </tr>
            `;
        });

        bookDetailHtml += `
            <li class="list-group-item data-foot">
                <div class="row row-flex">
                    <div class="col-md-12" style="padding-left:15px;">
                        <div class="panel h-auto no-m-b">
                            <div class="panel-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Add On</th>
                                            <th>Paid On</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${paymentArrayHtml}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;

        let companyBillHtml = '';
        
        if(billingMode == 'company'){
            companyBillHtml = `<div class="col-6">
                <div class="dFlex aic">
                    <div class="mR10">
                        <p class="m0">Company Name: </p>
                        <strong style="text-transform:capitalize;">${compayName}</strong>
                    </div>
                    <div>
                        <p class="m0">GST NO: </p>
                        <strong style="text-transform:capitalize;">${gstno}</strong>
                    </div>
                </div>
            </div>`
        }

        bookDetailHtml += `
            <li class="list-group-item data-foot">
                <div class="row row-flex">
                    <div class="col-md-12" style="padding-left:15px;">
                        <h4>Billing Information:</h4>
                        <div class="row">
                            <div class="col-6">
                                <p class="m0">Billing Mode: </p>
                                <strong style="text-transform:capitalize;">${billingMode}</strong>
                            </div>
                            ${companyBillHtml}

                            <div class="col-12">
                                <p class="m0">Guest Special Request</p>
                                <strong style="text-transform:capitalize;">${guestSpecialRequest}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;

        bookDetailHtml += `
            <li class="list-group-item data-foot">
                <div class="row row-flex">
                    <div class="col col-info">
                         <span class="dib clrBlack">Grand Total:- </span>
                         <strong class="dib fs15 clrBlue">&#x20B9; ${totalPrice}</strong> 
                    </div>
                    <div class="col col-info">
                       <span class="dib clrBlack">Total Advances Paid:- </span>
                       <strong class="dib fs15 clrBlue">&#x20B9; ${userPay}</strong>
                    </div>
                    <div class="col col-info">
                        <span class="dib clrBlack">Pending Balance:- </span>
                        <strong class="dib fs15 clrBlue">&#x20B9; ${remeningPay}</strong>
                    </div>
                </div>
            </li>
        `;

        var html = `
                <div class="panel panel-white no-m-b">
                    <div class="panel-body no-s">
                        <div class="grid-aea" id="section-quick-reservation-form">
                            <div class="form-horizontal">
                                <div class="col-xs-12 col-sm-12 col-md-12 b">
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 left-panel">
                                        <div class="row">
                                            <h3 class="col-sm-12">Guest Name : <span>${gName}</span></h3>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Whatsapp No : <span>${gWhatsAppNo}</span></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Phone : <span>${gPhone}</span></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Email : <span>${gEmail}</span></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Address : <span>${gAddress}</span></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Organisation : <span>${orgaName}</span> </label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">GST : <span>${orgaGst}</span></label>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12">Contact Person : <span>${orgConPer}</span></label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-12" style="font-weight:bold;font-size:15px;">Night(s) : <span>${night}</span></label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-12" style="font-weight:bold;font-size:15px;">Arrival Details : <span style="font-weight:bold;font-size:12px;">${checkInDetail}</span></label>
                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 detail-side-panel">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
                                                <div class="dFlex aic">
                                                    <label>Booking Status : </label>
                                                    <label><span>
                                                    <span style="letter-spacing: .2em;" class="badge ${statusCls}">${statusBtn}</span></span></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>Booked On : </label>
                                                    <label><strong class="fs15">${addOn}</strong></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>Arrival Date :</label>
                                                    <label><strong class="fs15">${checkIn}, ${checkInTime}</strong></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>Departure Date :</label>
                                                    <label><strong class="fs15">${checkOut}, ${checkOutTime}</strong></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>Booking Source :</label>
                                                    <label><strong class="fs15">${bSourceHtml}</strong></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>Travel Agent</label>
                                                    <label><strong class="fs15">${travelName}</strong></label>
                                                </div>
                                                <div class="dFlex aic">
                                                    <label>User :</label>
                                                    <label><strong class="fs15 clrYellow">${addByName}</strong></label>
                                                </div>

                                                <div class="dFlex aic">
                                                    <label>Departure details :</label>
                                                    <label><strong class="fs12">${checkOutDetail}</strong></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-flex">
                        <div class="col-md-12" style="padding-left:15px;">
                            <div class="panel h-auto no-m-b">
                                <div class="panel-body p-0">
                                    <ul class="list-group payment-history-list list-vb-rd" id="tableQuickViewReservationRoomDataBreakup">
                                        ${bookDetailHtml}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body pl-0 pr-0">
                        <div class="form-group text-center m0 py-2">
                            <div class="col-sm-12">
                                <button class="btn btn-info m0" onclick="generateEmailSent(${bid})">Email Booking Voucher</button>
                                <button class="btn btn-danger m0"><a class="text-white" target="_blank" href="${voucherLink}">Download Booking Voucher</a></button>
                            </div>
                        </div>
                    </div>

                </div>
        `;

        showModalBox('Booking Details', '', html, '', 'modal-xl');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
}

function loadRomStatusReport(tab = 'occupid', name = '', room = '') {
    var data = `request_type=loadRomStatusReport&tab=${tab}&name=${name}&room=${room}`;
    var skeleton = window.tableSkeleton;
    $('#loadRomStatusReport').html(skeleton);
    var inputGuestFiled = $('#inputFilterGuestName');
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var tableBody = '';

        if (tab == 'occupid') {
            inputGuestFiled.show();
            var tableHead = `
                <tr>
                    <th width="10%" style="text-align:center;">Room No</th>
                    <th width="15%">Room Type</th>
                    <th width="10%">Booking #</th>
                    <th width="15%">Guest Name</th>
                    <th width="5%">No.of Guests</th>
                    <th width="10%">Check In</th>
                    <th width="10%">Check Out</th>
                    <th width="5%">Room Plan</th>
                    <th width="10%">Amount</th>
                    <th width="10%">Discount</th>
                    <th width="20%">Extra Amount</th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.room_number;
                    var adult = val.adult;
                    var child = val.child;
                    var reciptNo = generateNumber(val.reciptNo);
                    var checkIn = val.checkIn;
                    var checkOut = val.checkOut;
                    var roomType = val.roomType;
                    var roomPlanSrt = val.roomPlanSrt;
                    var bookingMainId = val.bid;
                    var extra_amount = val.extra_amount;
                    var totalPrice = val.totalPrice;
                    var discount = 0;
                    var guestArray = val.guestArray;
                    var gName = (guestArray.length > 0) ? guestArray[0]['name'] : '';

                    var formatDate = moment(checkIn).format('DD-MMM');
                    var formatDate2 = moment(checkOut).format('DD-MMM');

                    tableBody += `<tr>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomNum}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomType}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${reciptNo}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${gName}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${adult} / ${child}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${formatDate}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${formatDate2}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomPlanSrt}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${totalPrice}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${discount}</td>
                        <td style="text-align: center; background-color: rgb(255, 255, 255);">${extra_amount}</td>
                    </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }

        }

        if (tab == 'vacant') {
            inputGuestFiled.hide();
            var tableHead = `
                <tr>
                    <th width="50%" style="text-align:center;">Room No</th>
                    <th width="50%">Room Type</th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.roomNo;
                    var roomType = val.roomType;

                    tableBody += `<tr>
                                    <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomNum}</td>
                                    <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomType}</td>
                                </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="2" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }
        }

        if (tab == 'block') {
            inputGuestFiled.hide();
            var tableHead = `
                <tr>
                    <th width="50%" style="text-align:center;">Room No</th>
                    <th width="50%">Room Type</th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.roomNo;
                    var roomType = val.roomType;

                    tableBody += `<tr>
                                    <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomNum}</td>
                                    <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomType}</td>
                                </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="2" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }
        }

        var html = '<table  id="tableStatusReport" class="table">';
        html += `<thead>${tableHead}</thead>`;

        html += `<tbody>${tableBody}</tbody>`;

        html += "</table>";


        $('#loadRomStatusReport').html(html);



    });


}

function loadTodayEventReport(tab = 'booking', name = '', room = '') {
    var data = `request_type=loadTodayEventReport&tab=${tab}&name=${name}&room=${room}`;
    var skeleton = window.tableSkeleton;
    $('#loadTodayEventReport').html(skeleton);
    var inputGuestFiled = $('#inputFilterGuestName');
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var tableBody = '';

        if (tab == 'booking') {
            inputGuestFiled.show();
            var tableHead = `
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
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.room_number;
                    var adult = val.adult;
                    var child = val.child;
                    var rooms = val.rooms;
                    var reciptNo = generateNumber(val.reciptNo);
                    var checkIn = val.mainCheckIn;
                    var checkOut = val.mainCheckOut;
                    let night = val.nightCount;
                    var checkinstatusVal = val.checkinstatus;
                    var guestName = (val.guestName == undefined) ? 'NaN' : val.guestName;
                    var guestPhone = (val.guestPhone == undefined) ? 'NaN' : val.guestPhone;
                    var checkinstatus = getCheckInStatus(val.checkinstatus);
                    var formatDate = moment(checkIn).format('DD-MMM');
                    var formatDate2 = moment(checkOut).format('DD-MMM');

                    var bid = val.bid;
                    var bdid = val.id;

                    var resEditLink = generateEditReservationLinkInJs(bid);
                    var folioLink = generateFolioLinkInJs(bid);

                    let total = rupeesFormat(1);

                    let pax = adult + '/' + child;

                    let travelAgent = val.travelagent;
                    let staffName = val.staffName;

                    let checkInTimeFormat = '';
                    let checkOutTimeFormat = '';

                    let voucherLink = `${webUrl}view-voucher?id=${bid}`;
                    let agentLink = `${webUrl}view-voucher?id=${bid}&type=agent`;

                    var noShow = '';
                    if(checkinstatusVal == 1){
                        noShow = `<li><button onclick="noShowFunByBid(${bid})">No Show</button></li>`;
                    }

                    tableBody += `<tr>
                                    <td>${reciptNo}</td>
                                    <td>${guestName}</td>
                                    <td>${rooms}</td>
                                    <td>${checkIn}${checkInTimeFormat}</td>
                                    <td>${night}</td>
                                    <td>${checkOut}${checkOutTimeFormat}</td>
                                    <td>${pax}</td>
                                    <td>${total}</td>
                                    <td><span style="border-radius: 2px;" class="${checkinstatus.btnCls} badge">${checkinstatus.name}</span></span></label></td>
                                    <td>${travelAgent}</td>
                                    <td>${staffName}</td>
                                    <td><button data-tooltip-top="View Booking" onclick="viewBookingReport(${bid})"><i class="fas fa-eye"></i></button></td>
                                    <td class="no-export">
                                        <div class="customDropdown" style="display: flex;justify-content: center;">
                                            <button class="btnCD reservationDetailActionBtn">
                                                <span></span><span></span><span></span>
                                            </button>
                                            <ul>
                                                <li> <a href="${voucherLink}" target="_blank">Guest Voucher</a></li>
                                                <li><a target="_blank" href="${agentLink}">Agent Voucher</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }

        }

        if (tab == 'inHouse') {
            inputGuestFiled.hide();
            var tableHead = `
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
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.room_number;
                    var roomTypeName = val.roomTypeName;
                    var guestName = (val.guestName == undefined) ? 'NaN' : val.guestName;
                    var adult = val.adult;
                    var child = val.child;
                    var checkInTime = val.checkInTime;
                    var checkOut = val.checkOut;
                    var reciptNo = val.reciptNo;
                    var editResLink = val.editResLink;
                    var bid = val.bid;
                    var bdid = val.id;
                    var hkId = val.hkId;

                    var checkOutFormat = moment(checkOut).format('DD-MMM');
                    var checkInTimeFormat = moment(checkInTime).format('DD-MMM');
                    var checkInTimeFormat2 = moment(checkInTime).format('hh:mm A');

                    var resEditLink = generateEditReservationLinkInJs(bid);
                    var folioLink = generateFolioLinkInJs(bid);

                    tableBody += `<tr>
                                    <td style="text-align: center;">${roomNum}</td>
                                    <td style="text-align: center;">${roomTypeName}</td>
                                    <td style="text-align: center;"><a href="${editResLink}" target="_blank">${reciptNo}</a></td>
                                    <td style="text-align: center;">${guestName}</td>
                                    <td style="text-align: center;">${adult} / ${child}</td>
                                    <td style="text-align: center; color: #007400">
                                        <span class="db tac">${checkInTimeFormat}</span>
                                        <span class="db tac">${checkInTimeFormat2}</span>
                                    </td>
                                    <td style="text-align: center; color: #b20000">${checkOutFormat}</td>
                                    <td class="tEInhouseActionBtn" style="text-align: center;">
                                        <div class="btnGroup">
                                            <button>Action</button>
                                            <ul class="tEInhouseAction">
                                                <li><button onclick="viewBookingReport(${bid})">View</button></li>
                                                <li><button onclick="generateGuestListById(${bid},${bdid})">View Guests & Photos</button></li>
                                                <li><button>Allot More Rooms</button></li>
                                                <li><button onclick="editBookingDetailFun(${bdid})">Edit Rate</button></li>
                                                <li><button onclick="editBookingDetailFun(${bdid}, 'onlyRoom')">Shift Room</button></li>
                                                <li><button onclick="window.location = '${resEditLink}'">Edit Reservation</button></li>
                                                <li><button>Checkout This Room</button></li>
                                                <li><button onclick="editExtendStayFun(${bdid})">Extend Stay</button></li>
                                                <li><button onclick="quickBalanceViewFun(${bid})">View Quick Balance</button></li>
                                                <li><button onclick="remarkUpdateForm('',${hkId})">Edit HK Remarks</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="2" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }
        }

        if (tab == 'checkOut') {
            inputGuestFiled.hide();
            var tableHead = `
                <tr>
                    <th width="20%" style="text-align:center;">Room #</th>
                    <th width="20%">Reservation #</th>
                    <th width="20%">Checked-out At</th>
                    <th width="20%">Guest Name</th>
                    <th width="20%"></th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNum = val.room_number;
                    var roomTypeName = val.roomTypeName;
                    var guestName = (val.guestName == undefined) ? 'NaN' : val.guestName;
                    var adult = val.adult;
                    var child = val.child;
                    var checkOutTime = val.checkOutTime;
                    var reciptNo = val.reciptNo;
                    var editResLink = val.editResLink;

                    var checkInTimeFormat = moment(checkOutTime).format('DD-MMM');
                    var checkInTimeFormat2 = moment(checkOutTime).format('hh:mm A');

                    tableBody += `<tr>
                                    <td style="text-align: center;">${roomNum}</td>
                                    <td style="text-align: center;"><a href="${editResLink}" target="_blank">${reciptNo}</a></td>
                                    <td style="text-align: center; color: #b20000">
                                        <span class="db tac">${checkInTimeFormat}</span>
                                        <span class="db tac">${checkInTimeFormat2}</span>
                                    </td>
                                    <td style="text-align: center;">${guestName}</td>
                                    <td class="tEInhouseActionBtn" style="text-align: center;">
                                        <div class="btnGroup">
                                            <button>Action</button>
                                            <ul class="tEInhouseAction">
                                                <li><button>Revert Checkout</button></li>
                                                <li><button>Folio</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="2" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }
        }

        var html = '<table  id="tableStatusReport" class="table">';
        html += `<thead>${tableHead}</thead>`;

        html += `<tbody>${tableBody}</tbody>`;

        html += "</table>";


        $('#loadTodayEventReport').html(html);



    });


}

function exportContent(target='tableStatusReport') {
    var currentDate = new Date();
    var day = currentDate.getDate()
    var month = currentDate.getMonth() + 1;
    $(`#${target}`).table2excel({
        exclude: ".no-export",
        filename: `roomStatus-${day}-${month}.xls`,
        fileext: ".xls",
        exclude_links: true,
        exclude_inputs: true
    });
}

function printContent(target='tableStatusReport') {
    var divElements = document.getElementById(target).innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML =
        "<html><head><title></title></head><body><table border='1' cellpadding='3'>" +
        divElements + "</table></body>";
    window.print();
    document.body.innerHTML = oldPage;
}

function loadBlockReport() {
    var data = `request_type=loadBlockReport`;
    var skeleton = window.tableSkeleton;
    $('#loadBlockReport').html(skeleton);
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);

        var html = '<table id="table-data-report-collections" class="table">';
        html += `
            <thead>
                <tr>
                    <th width="10%" style="text-align:left;">Room #</th>
                    <th width="15%" style="text-align:center;">Room Type</th>
                    <th width="20%">From</th>
                    <th width="20%">To</th>
                    <th width="15%">Reason</th>
                    <th width="10%" style="text-align:right;">Status</th>
                    <th width="10%">Username</th>
                    <th width="10%"></th>
                </tr>
            </thead>

        `;
        html += "<tbody>";
        var sn = 0;
        if (response.length > 0) {
            $.each(response, function (key, val) {
                sn++;
                var roomNo = val.roomNo;
                var roomName = val.roomName;
                var houseKeepar = val.houseKeepar;
                var formDate = houseKeepar.formDate;
                var toDate = houseKeepar.toDate;
                var remark = houseKeepar.remark;
                var addByName = houseKeepar.addByUsername;

                html += `<tr>
                            <td style="text-align: left; background-color: rgb(255, 255, 255);">${roomNo}</td>
                            <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomName}</td>
                            <td style="background-color: rgb(255, 255, 255);">${formDate}</td>
                            <td style="background-color: rgb(255, 255, 255);">${toDate}</td>
                            <td style="background-color: rgb(255, 255, 255);">${remark}</td>
                            <td style="text-align: right; color:var(--pClr); background-color: rgb(255, 255, 255);"><span class="badge badge-danger">Blocked</span></td>
                            <td style="background-color: rgb(255, 255, 255);">${addByName}</td>
                            <td style="background-color: rgb(255, 255, 255);">
                                <div class="dropdown">
                                    <button style="margin-bottom: 0rem;" class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="javascript:;" onclick="UnblockRoomNumber(${roomNo});">Unblock</a></li>
                                        <li><a class="dropdown-item" href="javascript:;" onclick="ExtendBlockDate(${roomNo});">Extend Block Date</a></li>
                                        <li><a class="dropdown-item" href="javascript:;" onclick="OpenFolioHistoryPopup(${roomNo});">View History</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>`;
            });
        } else {
            html += `<tr>
                    <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                </tr>`;
        }


        html += "</tbody>";

        html += "</table>";


        $('#loadBlockReport').html(html);
    });


}

function ViewGuestsFromReport(bdid = '', gid = '') {
    var data = `request_type=ViewGuestsFromReport&gid=${gid}&bdid=${bdid}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);

        var html = '<ul class="guestReportList">';

        $.each(response, function (key, val) {
            var img = val.profileImgFull;
            var name = val.name;
            var phone = val.phone;
            var email = val.email;
            html += `<li class="dib">
                        <div className="guestGroup">
                            <div class="imgArea">
                                <img src="${img}"/>
                            </div>
                            <div class="testArea">
                                <h4>${name}</h4>
                                <span>${phone}</span>
                                <span>${email}</span>
                            </div>
                        </div>
                    </li>`;
        });
        html += '</ul>';
        showModalBox('Guests', '', html, '');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
}

function UnblockRoomNumber(num) {
    if (confirm('Are you sure you want to unblock this room?')) {
        var data = `request_type=UnblockRoomNumber&num=${num}`;
        ajax_request(data).done(function (request) {
            sweetAlert('Successfully unblock room')
            loadRomStatusReport('block');
        });
    }
}

function loadOccupiedRoomsReport() {
    var data = `request_type=loadOccupiedRoomsReport`;
    var skeleton = window.tableSkeleton;
    $('#loadOccupiedRoomsReport').html(skeleton);
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);

        var html = '<table id="table-data-report-collections" class="table">';
        html += `
            <thead>
                <tr>
                    <th style="text-align:left;">Reservation #</th>
                    <th style="text-align:center;">Guest</th>
                    <th>Booked On</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th style="text-align:right;">Days</th>
                    <th>Adult</th>
                    <th>Child</th>
                    <th>Room #</th>
                    <th>Room Type</th>
                    <th>Room Plan</th>
                    <th>Tariff</th>
                    <th>Extra Person</th>
                    <th>Discount</th>
                    <th>Tax %</th>
                    <th>Tax</th>
                    <th>Total Amount</th>
                    <th>Total Receipt</th>
                    <th>Status</th>
                </tr>
            </thead>

        `;
        html += "<tbody>";
        var sn = 0;
        var totalAdult = 0;
        var totalChild = 0;
        var totalRoomPrice = 0;
        var totalDiscountPrice = 0;
        var totalGSTPrice = 0;
        var totalUserPayPrice = 0;
        var totalAmountPrice = 0;
        if (response.length > 0) {
            $.each(response, function (key, val) {
                sn++;
                var roomName = val.roomName;
                var bookingMainId = val.bid;
                var guestArry = val.guestArry;
                var guestName = guestArry[0]['name'];
                var adult = val.adult;
                var child = val.child;
                var addOn = moment(val.addOn).format('DD-MMM');
                var checkIn = moment(val.checkIn).format('DD-MMM');
                var checkOut = moment(val.checkOut).format('DD-MMM');
                var room_number = val.room_number;
                var roomType = val.roomType;
                var roomPlanSrt = val.roomPlanSrt;
                var reciptNo = generateNumber(val.reciptNo);
                var totalNight = val.totalNight;
                var grossCharge = val.grossCharge;
                var roomPrice = val.totalRoomPrice;
                var discount = val.totalDiscount;
                var gstPrice = val.gstPrice;
                var userPay = val.userPay;
                var bookingdetailId = val.bookingdetailId;
                var checkinstatus = val.checkinstatus;
                var gstPer = 12;
                totalAdult += parseInt(adult);
                totalChild += parseInt(child);
                totalRoomPrice += parseInt(roomPrice);
                totalDiscountPrice += parseInt(discount);
                totalGSTPrice += parseInt(gstPrice);
                totalUserPayPrice += parseInt(userPay);
                totalAmountPrice += parseInt(grossCharge);

                html += `<tr>
                            <td style="text-align:center;">
                                <a class="linkBtnWrap" href="javascript:void(0)" onclick="viewBookingReport(${bookingMainId})">${reciptNo}</a>
                            </td>
                            <td style="text-align:center;">
                                <a class="linkBtnWrap" href="javascript:void(0)" onclick="ViewGuestsFromReport(${bookingdetailId})">${guestName}</a>
                            </td>
                            <td style="text-align:center;">${addOn}</td>
                            <td style="text-align:center;">${checkIn}</td>
                            <td style="text-align:center;">${checkOut}</td>
                            <td style="text-align:center;"">${totalNight}</td>
                            <td style="text-align:center;">${adult}</td>
                            <td style="text-align:center;">${child}</td>
                            <td style="text-align:center;">${room_number}</td>
                            <td style="text-align:center;">${roomType}</td>
                            <td style="text-align:center;">${roomPlanSrt}</td>
                            <td style="text-align:center;">&#8377; ${roomPrice}</td>
                            <td style="text-align:center;">&#8377; 0</td>
                            <td style="text-align:center;">&#8377; ${discount}</td>
                            <td style="text-align:center;">12 %</td>
                            <td style="text-align:center;">&#8377; ${gstPrice}</td>
                            <td style="text-align:center;">&#8377; ${grossCharge}</td>
                            <td style="text-align:center;">&#8377; ${userPay}</td>
                            <td style="text-align:center;">Status</td>
                        </tr>`;
            });

            html += `<tr>
                <td style="text-align:center;" colspan="6">
                    <h4>Total</h4>
                </td>
                <td style="text-align:center;">${totalAdult}</td>
                <td style="text-align:center;">${totalChild}</td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;">&#8377; ${totalRoomPrice}</td>
                <td style="text-align:center;">&#8377; 0</td>
                <td style="text-align:center;">&#8377; ${totalDiscountPrice}</td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;">&#8377; ${totalGSTPrice}</td>
                <td style="text-align:center;">&#8377; ${totalAmountPrice}</td>
                <td style="text-align:center;">&#8377; ${totalUserPayPrice}</td>
                <td style="text-align:center;"></td>
            </tr>`;

        } else {
            html += `<tr>
                    <td colspan="18" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                </tr>`;
        }


        html += "</tbody>";

        html += "</table>";


        $('#loadOccupiedRoomsReport').html(html);
    });


}

function addBlockRoom(rnum=''){
    var data = `request_type=addBlockRoom&rnum=${rnum}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var data = response.data;
        var room = response.room;
        var roomList = '';

        $.each(room,(key,val)=>{
            var roomNo = val.roomNo;
            var rnid = val.id;
            roomList += `<option value="${rnid}">${roomNo}</option>`;
        })

        var html = `
            <form id="addBlockRoomForm" action="">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="input-daterange input-group" id="blockRoomDatepicker">
                                <input type="date" class="input-sm start form-control" name="start" />
                                <span class="input-group-addon">to</span>
                                <input type="date" class="input-sm end form-control" name="end" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="choseRoom">Room <span class="requireSym">*</span></label>
                        <select class="w100 h40" name="choseRoom" id="choseRoom">
                            <option value="0">Select</option>
                            ${roomList}
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="reason">Reason <span class="requireSym">*</span></label>
                        <textarea class="form-control" name="reason" id="reason" rows="10" placeholder="Reason"></textarea>
                    </div>
                </div>
            </form>
        `;

        showModalBox('Block Room', 'Apply', html, 'addBlockRoomSubmit');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();

        $('#blockRoomDatepicker input').datepicker({
            format: 'mm-dd-yyyy',
            endDate: '+0d',
            autoclose: true
        });
    });
}

function loadHouseKeepingReport(tab = 'dailyStatus', date='') {
    var data = `request_type=loadHouseKeepingReport&tab=${tab}&date=${date}`;
    var skeleton = window.tableSkeleton;
    $('#loadHouseKeepingReport').html(skeleton);
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var tableBody = '';

        var advanceHtml = '';

        if (tab == 'dailyStatus') {
            var tableHead = `
                <tr>
                    <th width="15%" style="text-align:center;">Room No</th>
                    <th width="15%">Room Type</th>
                    <th width="10%">Status</th>
                    <th width="15%">Availability</th>
                    <th width="25%">Remarks</th>
                    <th width="10%" style="text-align: right;">Housekeeper</th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNo = val.roomNo;
                    var roomName = val.room.header;
                    var roomStatus = val.roomStatus;
                    var roomStatusName = roomStatus.name;
                    var roomStatusClr = roomStatus.color;
                    var roomStatusBg = roomStatus.bg;
                    var houseKeeper = val.houseKeeper;
                    var availability = val.availability;
                    var hkid = (houseKeeper.id) ? houseKeeper.id : '';
                    var hkName = (houseKeeper.hkName) ? houseKeeper.hkName : 'Select HK';
                    var remark = (val.houseKeeper.remark == undefined) ? '' : val.houseKeeper.remark;


                    tableBody += `<tr>
                        <td style="text-align: center;">${roomNo}</td>
                        <td style="text-align: center;">${roomName}</td>
                        <td style="text-align: center;">
                            <a style="background: ${roomStatusBg};color: ${roomStatusClr};" class="roomStatusBtn" href="javascript:void(0)" data-rnum="${roomNo}" onclick="roomStatusUpdateForm(${roomNo})"><span>${roomStatusName} <i><svg><use xlink:href="#arrowIcon"></use></svg></i></span></a>
                        </td>
                        <td style="text-align: center;">
                            <span><i class="${availability}"></i>  ${availability}</span>
                        </td>
                        <td style="text-align: center;" class="wsn">${remark} <button data-rnum="${roomNo}" onclick="remarkUpdateForm(${roomNo},${hkid})" class="housekeeperEditBtn"><svg><use xlink:href="#editfilledIcon"></use></svg></button></td>

                        <td style="text-align: right;">
                            <buttont class="hkSelect" onclick="selectHouseKeeper(${roomNo},${hkid})">${hkName} <svg><use xlink:href="#rightArrowIcon"></use></svg> </button>
                        </td>
                    </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }

        }

        if (tab == 'blockedRoom') {
            advanceHtml = `<div class="dFlex aic jce"><button onclick="addBlockRoom()">Block Room</button></div>`;
            var tableHead = `
                <tr>
                    <th width="10%" style="text-align:left;">Room #</th>
                    <th width="15%" style="text-align:center;">Room Type</th>
                    <th width="20%">From</th>
                    <th width="20%">To</th>
                    <th width="15%">Reason</th>
                    <th width="10%" style="text-align:right;">Status</th>
                    <th width="10%">Username</th>
                    <th width="10%"></th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var roomNo = val.roomNo;
                    var roomName = val.roomName;
                    var houseKeepar = val.houseKeepar;
                    var formDate = (houseKeepar.formDate === undefined) ? '' : houseKeepar.formDate;
                    var toDate = (houseKeepar.toDate === undefined) ? '' : houseKeepar.toDate;
                    var remark = (houseKeepar.remark === undefined) ? '' : houseKeepar.remark;
                    var addByName = houseKeepar.addByUsername;

                    tableBody += `<tr>
                            <td style="text-align: left; background-color: rgb(255, 255, 255);">${roomNo}</td>
                            <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomName}</td>
                            <td style="background-color: rgb(255, 255, 255);">${formDate}</td>
                            <td style="background-color: rgb(255, 255, 255);">${toDate}</td>
                            <td style="background-color: rgb(255, 255, 255);">${remark}</td>
                            <td style="text-align: right; color:var(--pClr); background-color: rgb(255, 255, 255);"><span class="badge badge-danger">Blocked</span></td>
                            <td style="background-color: rgb(255, 255, 255);">${addByName}</td>
                            <td style="background-color: rgb(255, 255, 255);">
                                <div class="dropdown">
                                    <button style="margin-bottom: 0rem;" class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="javascript:;" onclick="UnblockRoomNumber(${roomNo});">Unblock</a></li>
                                        <li><a class="dropdown-item" href="javascript:;" onclick="ExtendBlockDate(${roomNo});">Extend Block Date</a></li>
                                        <li><a class="dropdown-item" href="javascript:;" onclick="OpenFolioHistoryPopup(${roomNo});">View History</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }

        }

        if (tab == 'workOrder') {
            var tableHead = `
                <tr>
                    <th width="15%" style="text-align:center;">Room No</th>
                    <th width="15%">Room Type</th>
                    <th width="10%">Status</th>
                    <th width="15%">Availability</th>
                    <th width="25%">Remarks</th>
                    <th width="10%" style="text-align: right;">Housekeeper</th>
                </tr>
            `;
            tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
        }

        if (tab == 'clean') {
            var tableHead = `
                <tr>
                    <th width="15%" style="text-align:center;">Room No</th>
                    <th width="10%" style="text-align: center;">Status</th>
                    <th width="15%" style="text-align: center;">Housekeeper</th>
                    <th width="25%" style="text-align: center;">Remarks</th>
                    <th width="10%" style="text-align: center;">Assigned</th>
                    <th width="10%" style="text-align: right;">completed</th>
                </tr>
            `;

            if (response.length > 0) {
                $.each(response, function (key, val) {
                    var hkid = val.id;
                    var roomNo = val.roomNum;
                    var houseKeepar = (val.hkName == 0) ? 'Select HK' : val.hkName;
                    var remark = (val.remark == '') ? 'NaN' : val.remark;
                    var processTime = val.processTime;
                    var completeTime = val.completeTime;
                    var addOn = val.addOn;

                    var statusName = val.statusName;
                    var statusBg = val.statusBg;

                    var completeOn = (completeTime != null) ? moment(completeTime).format('ddd, h:mm a') : '';
                    var assignOn = (addOn != null) ? moment(addOn).format('ddd, h:mm a') : '';

                    tableBody += `<tr>
                            <td style="text-align: center;">${roomNo}</td>
                            <td style="text-align: center;"> <strong style="color: ${statusBg}">${statusName}</strong> </td>
                            <td style="text-align: center;">
                            <buttont class="hkSelect" onclick="selectHouseKeeper(${roomNo},${hkid})">${houseKeepar} 
                            <svg><use xlink:href="#rightArrowIcon"></use></svg> 
                            </buttont></td>
                            <td style="text-align: center;">
                            ${remark} 
                                <button data-rnum="101" onclick="remarkUpdateForm(${roomNo},${hkid})" class="housekeeperEditBtn"><svg><use xlink:href="#editfilledIcon"></use></svg></button>
                            </td>
                            <td style="text-align: center; color:var(--pClr); ">${assignOn}</td>
                            <td style="text-align: right;">${completeOn}</td>
                        </tr>`;

                });
            } else {
                tableBody += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
            }
        }


        var html = `${advanceHtml}<table  id="tableStatusReport" class="table">`;
        html += `<thead>${tableHead}</thead>`;

        html += `<tbody>${tableBody}</tbody>`;

        html += "</table>";


        $('#loadHouseKeepingReport').html(html);

    });


}

function roomStatusUpdateForm(rnum) {
    var data = `request_type=roomStatusChack&roomNum=${rnum}`;
    ajax_request(data).done(function (data) {
        var response = JSON.parse(data);
        var statusHtml = '';
        var remark = (response.remark.remark == undefined) ? '' : response.remark.remark;
        var statusId = response.remark.status;
        var roomStatusArry = response.roomStatus;
        var hkid = 0;
        $.each(roomStatusArry, function (key, val) {
            var id = val.id;
            var name = val.name;
            var check = '';
            if (statusId == id) {
                var check = 'selected';
            }
            statusHtml += `<option ${check} value="${id}">${name}</option>`;
        });

        var html = `<form id="roomStatusUpdateForm" data-rnum="${rnum}">  
                    <input type="hidden" name="hkid" value="${hkid}">
                    <input type="hidden" name="rnum" value="${rnum}">
                    <div class="form-group">
                        <label for="chooseStatus">Choosse status</label> <br/>
                        <select class="form-control ttc" name="chooseStatus" id="chooseStatus">
                            <option value="0">Select status</option>
                            ${statusHtml}
                        </select>
                    </div>
                </form>`;

        showModalBox('Update status', 'Submit', html, 'roomStatusUpdateBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
}

function remarkUpdateForm(rnum, hkid = '') {
    var data = `request_type=remarkUpdateForm&hkid=${hkid}&rnum=${rnum}`;
    ajax_request(data).done(function (data) {
        var response = JSON.parse(data);
        var statusHtml = '';
        var remark = (response.remark.remark == undefined) ? '' : response.remark.remark;


        var html = `<form id="hkRemarkUpdateForm">      
                    <div class="form-group">
                        <input type="hidden" name="hkid" value="${hkid}">
                        <input type="hidden" name="rnum" value="${rnum}">
                        <label for="hkRemark">Remark</label> <br/>
                        <textarea class="form-control" name="hkRemark" id="hkRemark" cols="30" rows="10">${remark}</textarea>
                    </div>
                </form>`;

        showModalBox('Update remark', 'Submit', html, 'hkRemarkUpdateBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
}

function guestCheckInByBid(bid) {
    var data = `request_type=guestCheckInByBid&bid=${bid}`;
    ajax_request(data).done(function (data) {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;

        if(window.filePath == 'todays-event'){
            sweetAlert('Successfully checked in.');
            var target = $('#section-tab-nav li.active').data('target');
            loadTodayEventReport(target);
        }
    });
}

function noShowFunByBid(bid,bdid='') {
    var data = `request_type=noShowFunByBid&bid=${bid}&bdid=${bdid}`;
    ajax_request(data).done(function (data) {
        var response = JSON.parse(data);
        var status = response.status;
        var msg = response.msg;

        if(window.filePath == 'todays-event'){
            sweetAlert('Successfully checked in.');
            var target = $('#section-tab-nav li.active').data('target');
            loadTodayEventReport(target);
        }
    });
}

function selectHouseKeeper(rnum, hkid = '') {
    var data = `request_type=selectHouseKeeper&roomNum=${rnum}&hkid=${hkid}`;
    ajax_request(data).done(function (data) {
        var response = JSON.parse(data);
        var allData = response.allData;
        var selectData = response.selectData;
        var assigningHK = (selectData.assigningHK) ? selectData.assigningHK : '';
        var statusHtml = '';
        $.each(allData, function (key, val) {
            var id = val.id;
            var name = val.name;
            var check = '';

            if (assigningHK == id) {
                var check = 'selected';
            }
            statusHtml += `<option ${check} value="${id}">${name}</option>`;
        });

        var html = `<form id="assignHousekeeperForm" data-rnum="${rnum}"> 
                        <input type="hidden" name="roomNum" value="${rnum}">     
                        <input type="hidden" name="hkid" value="${hkid}">     
                        <div class="form-group">
                            <label for="chooseHK">Choosse status</label> <br/>
                            <select class="form-control ttc" name="chooseHK" id="chooseHK">
                                <option value="0">Select</option>
                                ${statusHtml}
                            </select>
                        </div>
                    </form>`;

        showModalBox('Assign Housekeeper', 'Submit', html, 'assignHousekeeperBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });
}

function kotOrderSettlement(posId = '') {
    var form_data = `request_type=kotOrderSettlement&posId=${posId}`;
    kotOrderSubmit('','','','settlement');
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var total = response.total;
        var paid = response.paid;

        var html = `
            <form action="" id="settlementForm">
                <h4>Payment Type</h4>
                <div class="dFlex aic jcse mb-3">
                    <div class="form-check ">
                        <input checked class="form-check-input" type="radio" name="paymentType" id="case" value="case" data-paidamout="${paid}">
                        <label class="custom-control-label" for="case">Cash</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="card" value="card" data-paidamout="${paid}">
                        <label class="custom-control-label" for="card">Card</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="upi" value="upi" data-paidamout="${paid}">
                        <label class="custom-control-label" for="upi">UPI</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="roomSettle" value="roomSettle" data-paidamout="${paid}">
                        <label class="custom-control-label" for="roomSettle">Room</label>
                    </div>
                </div>
                <input type="hidden" name="posId" value="${posId}"/>
                <div id="replaceContent" class="form-group">
                    <label for="settlementAmount">Settlement Amount</label>
                    <input class="form-control" type="text" id="settlementAmount" name="settlementAmount" value="${paid}" placeholder="Enter settlement amount.">
                </div>

                <div class="form-group">
                    <label for="tip">Tip</label>
                    <input class="form-control" type="text" id="tip" name="tip" value="0">
                </div> 

                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input class="form-control" type="text" id="remark" name="remark" placeholder="Enter remark.">
                </div> 

            </form>
        `;

        showModalBox(`Settle (&#8377; ${total})`, 'Settlement', html, 'settlementSubmitBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
            keyboard: false
        });
        myModal.show();

    });
}


function kotOrderSubmit($name = '', $number = '', $email = '', $type = '', callback) {
    var name = $name;
    var number = $number;
    var email = $email;
    var tid = $('#guestDetailIdField').val();
    var resId = $('#selectRest').val();
    var data;

    if(tid ==''){
        data={
            type: 'conformKotOrder',
            name: name,
            number: number,
            email: email,
            resId:resId
      
        };
    } else if(tid !=''){
        data={
            type: 'conformKotOrder',
            name: name,
            number: number,
            email: email,
            tid:tid,
            resId:resId
        };
    }

    $.ajax({
        url: webUrl + 'include/ajax/kot.php',
        type: 'post',
        data: data,
        success: function(data) {
            var response = JSON.parse(data);
            var msg = response.msg;
            var status = response.status;

            if (status == 'success') {

                if($type == 'payment'){

                }else if($type == 'settlement'){

                }else{
                    sweetAlert(msg);
                    kotProductsList();
                    $('.tableArea').addClass('show');
                    $('.kotProductArea').removeClass('show');
                    loadKotTable();
                }    
                
                if (typeof callback === 'function') {
                    callback();
                }

            }

            if (status == 'error') {
                sweetAlert(msg, 'error');
            }
        }
    });
}

function kotOrderPayment(posId = '') {
    kotOrderSubmit('','','','payment', function(){
        kotOrderPaymentFun(posId);
    });
}

function kotOrderPaymentFun(posId = '') {
    var form_data = `request_type=kotOrderPayment&posId=${posId}`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var html = `
            <form action="" id="paymentForm">
                <h4>Payment Type</h4>
                <div class="dFlex aic jcse mb-3">
                    <div class="form-check ">
                        <input checked class="form-check-input" type="radio" name="paymentType" id="case" value="case">
                        <label class="custom-control-label" for="case">Cash</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="card" value="card">
                        <label class="custom-control-label" for="card">Card</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="upi" value="upi">
                        <label class="custom-control-label" for="upi">UPI</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="other" value="other">
                        <label class="custom-control-label" for="other">Other</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="paidAmount">Paid Amount</label>
                    <input class="form-control" type="text" id="paidAmount" name="paidAmount" placeholder="Enter settlement amount.">
                </div>

                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input class="form-control" type="text" id="remark" name="remark" placeholder="Enter remark.">
                </div> 

            </form>
        `;

        showModalBox(`Payment (&#8377; ${response})`, 'Paid', html, 'paidSubmitBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
            keyboard: false
        });
        myModal.show();

    });
}

function printPOSorder(posId) {
    var form_data = `request_type=printPOSorder&posid=${posId}`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        showModalBox(`POS Order`, '', response, '', 'modal-lg');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
            keyboard: false
        });
        myModal.show();
    });
}

function loadKotTable(resIdByusr = '') {
    $.ajax({
        url: webUrl + "include/ajax/kot.php",
        type: 'post',
        data: {
            type: 'loadKotTableList'
        },
        success: function (data) {

            var response = JSON.parse(data);
            var service = response.service;
            var restaurant = response.restaurant;
            var table = response.table;
            var roomsection = response.roomsection;
            if (roomsection == '0') {

                if (restaurant.length > 0) {
                    var dasable = '';
                    var alertText = "";
                } else {
                    var alertText = "Please <button id='alertAddResBtn'>add a restaurant</button> then add a table";
                    var dasable = 'disable';
                }

                var resList = '';
                var displayData = '';
                if (resIdByusr == '') {
                    resIdByusr = localStorage.getItem('restaurant');
                }
                $.each(restaurant, function (key, val) {


                    if (resIdByusr != '') {
                        if (val.id == resIdByusr) {
                            var id = val.id;
                            if (service == 1) {
                                var name = val.name;
                            }

                            if (service == 2) {
                                var name = val.header;
                            }

                            var select = (key == 0) ? 'selected' : '';
                            resList += `<option ${select} value="${id}">${name}</option>`;
                            var tableHtml = '';

                            if (service == 1) {
                                $.each(table.filter(v => v.resId === id), function (tkey, tval) {

                                    var tid = tval.id;
                                    var tableNum = tval.tableNum;
                                    var orderCount = tval.orderCount;
                                    var posOrderId = tval.posOrderId;
                                    var posOrderPrice = tval.posOrderPrice;
                                    var active = '';
                                    var book = '';
                                    var moreOptHtml = '';
                                    if (orderCount > 0) {
                                        active = 'active';
                                        book = 'bookPos';
                                        moreOptHtml = `                            
                                <ul class="moreOpt">
                                    <li><button data-tooltip-top="Shift Table" onclick="posShiftTable(${posOrderId})"><svg><use xlink:href="#reloadSvgIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="Settled"  onclick="kotOrderSettlement(${posOrderId})" ><svg><use xlink:href="#trueIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="View Invoice" onclick="printPOSorder(${posOrderId})"><svg><use xlink:href="#fileIcon"></use></svg></button></li>
                                </ul>
                            
                            `;
                                    }



                                    tableHtml += `<li class="dib ${book}">
                                <button data-service="${service}" data-tid="${tid}" class="tableNumBtn alert alert-secondary text-white mr5 ${active}">
                                    <span>${tableNum}</span>
                                    <div class="tableIcon"><img src="https://login.retrod.in/img/icon/dining-table.png" alt="tableIcon"></div>
                                </button>
                                ${moreOptHtml}
                            </li>`;

                                });
                            }

                            if (service == 2) {
                                $.each(table.filter(v => v.roomId === id), function (tkey, tval) {

                                    var tid = tval.id;
                                    var tableNum = tval.name;
                                    var kotOrderCount = tval.kotOrderCount;
                                    var checkIn = tval.checkIn;
                                    var active = '';
                                    var checkInStatus = (checkIn == 'yes') ? '' : 'disable';
                                    var posOrderId = tval.kotOrderId;
                                    var moreOptHtml = '';

                                    if (kotOrderCount > 0) {
                                        active = 'active';
                                        book = 'bookPos';
                                        moreOptHtml = `
                                <ul class="moreOpt">
                                    <li><button data-tooltip-top="Shift Table" onclick="posShiftTable(${posOrderId})"><svg><use xlink:href="#reloadSvgIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="Settled"  onclick="kotOrderSettlement(${posOrderId})"><svg><use xlink:href="#trueIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="View Invoice" onclick="printPOSorder(${posOrderId})"><svg><use xlink:href="#fileIcon"></use></svg></button></li>
                                </ul>                            
                            `;
                                    }

                                    tableHtml += `<li class="dib bookPos"><button data-service="${service}" data-tid="${tid}" class="tableNumBtn alert alert-secondary text-white mr5 ${active} ${checkInStatus}">${tableNum}</button>${moreOptHtml}</li>`;
                                });
                            }


                            displayData += `
                    <div class="db">
                        <h6 class="db">${name}</h6>
                        <ul class="db">${tableHtml}</ul> 
                    </div>
                `;
                        }

                    }


                });


            } else if (roomsection == '1') {
                if (restaurant.length > 0) {
                    var dasable = '';
                    var alertText = "";
                } else {
                    var alertText = "Please <button id='alertAddResBtn'>add a restaurant</button> then add a table";
                    var dasable = 'disable';
                }

                var resList = '';
                var displayData = '';

                $.each(restaurant, function (key, val) {




                    var id = val.id;
                    if (service == 1) {
                        var name = val.name;
                    }

                    if (service == 2) {
                        var name = val.header;
                    }

                    var select = (key == 0) ? 'selected' : '';
                    resList += `<option ${select} value="${id}">${name}</option>`;
                    var tableHtml = '';

                    if (service == 1) {
                        $.each(table.filter(v => v.resId === id), function (tkey, tval) {

                            var tid = tval.id;
                            var tableNum = tval.tableNum;
                            var orderCount = tval.orderCount;
                            var posOrderId = tval.posOrderId;
                            var posOrderPrice = tval.posOrderPrice;
                            var active = '';
                            var book = '';
                            var moreOptHtml = '';
                            if (orderCount > 0) {
                                active = 'active';
                                book = 'bookPos';
                                moreOptHtml = `                            
                                <ul class="moreOpt">
                                    <li><button data-tooltip-top="Shift Table" onclick="posShiftTable(${posOrderId})"><svg><use xlink:href="#reloadSvgIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="Settled"  onclick="kotOrderSettlement(${posOrderId})" ><svg><use xlink:href="#trueIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="View Invoice" onclick="printPOSorder(${posOrderId})"><svg><use xlink:href="#fileIcon"></use></svg></button></li>
                                </ul>
                            
                            `;
                            }



                            tableHtml += `<li class="dib ${book}">
                                <button data-service="${service}" data-tid="${tid}" class="tableNumBtn alert alert-secondary text-white mr5 ${active}">
                                    <span>${tableNum}</span>
                                    <div class="tableIcon"><img src="https://login.retrod.in/img/icon/dining-table.png" alt="tableIcon"></div>
                                </button>
                                ${moreOptHtml}
                            </li>`;

                        });
                    }

                    if (service == 2) {
                        $.each(table.filter(v => v.roomId === id), function (tkey, tval) {

                            var tid = tval.id;
                            var tableNum = tval.name;
                            var kotOrderCount = tval.kotOrderCount;
                            var checkIn = tval.checkIn;
                            var active = '';
                            var checkInStatus = (checkIn == 'yes') ? '' : 'disable';
                            var posOrderId = tval.kotOrderId;
                            var moreOptHtml = '';

                            if (kotOrderCount > 0) {
                                active = 'active';
                                book = 'bookPos';
                                moreOptHtml = `
                                <ul class="moreOpt">
                                    <li><button data-tooltip-top="Shift Table" onclick="posShiftTable(${posOrderId})"><svg><use xlink:href="#reloadSvgIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="Settled"  onclick="kotOrderSettlement(${posOrderId})"><svg><use xlink:href="#trueIcon"></use></svg></button></li>
                                    <li><button data-tooltip-top="View Invoice" onclick="printPOSorder(${posOrderId})"><svg><use xlink:href="#fileIcon"></use></svg></button></li>
                                </ul>                            
                            `;
                            }

                            tableHtml += `<li class="dib bookPos"><button data-service="${service}" data-tid="${tid}" class="tableNumBtn alert alert-secondary text-white mr5 ${active} ${checkInStatus}">${tableNum}</button>${moreOptHtml}</li>`;
                        });
                    }


                    displayData += `
                    <div class="db">
                        <h6 class="db">${name}</h6>
                        <ul class="db">${tableHtml}</ul> 
                    </div>
                `;



                });

            }

            $('.tableArea').addClass('show');
            $('#loadKotTableData').html(displayData);


        }

    });
}

function loadUnSettledData(resId = '') {
    var skeleton = window.tableSkeleton;
    $('#loadUnSettledData').html(skeleton);
    var form_data = `request_type=loadUnSettledData&resId=${resId}`;

    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var cardContent = '';

        var html = '<table id="table-data-report-collections" class="table">';
        html += `
                <thead>
                    <tr>
                        <th width="10%">Invoice #</th>
                        <th width="15%">Order Type</th>
                        <th width="10%">Table/Room</th>
                        <th width="20%">Guest Name</th>
                        <th width="10%">Guest Mobile</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Tax</th>
                        <th width="10%">Discount</th>
                        <th width="10%">Balance</th>
                        <th width="10%">Pay</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
            `;

        html += "<tbody>";

        if (response.length > 0) {

            $.each(response, function (key, val) {
                var billno = generateNumber(val.billno);
                var posId = val.id;
                var orderType = getPosOrderType(val.orderType);
                var totalPrice = val.totalPrice;
                var table = val.table;
                var bookingDetailId = (val.bookingDetailId == 0) ? table : val.bookingDetailId;
                var orderArry = val.order;
                var totalProductPrice = val.totalProductPrice;
                var tax = val.tax;
                var totalPrice = val.totalPrice;
                var kotDisValue = val.kotDisValue;
                var kotAdvancePay = val.kotAdvancePay;
                var addOn = val.addOn;
                var guestDetail = val.guestDetail;
                var gName = guestDetail['name'];
                var gPhone = guestDetail['phone'];

                html += `<tr>
                            <td style="text-align: center; "><a href="javascript:void(0)">${billno}</a></td>
                            <td style="text-align: center; ">${orderType}</td>
                            <td style="text-align: center; ">${bookingDetailId}</td>
                            <td style="text-align: center; ">${gName}</td>
                            <td style="text-align: center; ">${gPhone}</td>
                            <td style="text-align: center; ">&#8377; ${totalProductPrice}</td>
                            <td style="text-align: center; ">&#8377; ${tax}</td>
                            <td style="text-align: center; ">&#8377; ${kotDisValue}</td>
                            <td style="text-align: center; ">&#8377; ${totalPrice}</td>
                            <td style="text-align: center; ">&#8377; ${kotAdvancePay}</td>
                            <td style="text-align: center; "><button onclick="kotOrderSettlement(${posId})">Sattlement</button></td>
                        </tr>`;
            });

            html += `<tr>
                        <td style="text-align: left; ">Total</td>
                        <td style="text-align: center; "></td>
                        <td style="text-align: center; "></td>
                        <td style="text-align: center; "></td>
                        <td style="text-align: center; "></td>
                        <td style="text-align: center; ">&#8377; </td>
                        <td style="text-align: center; ">&#8377; </td>
                        <td style="text-align: center; ">&#8377; </td>
                        <td style="text-align: center; ">&#8377; </td>
                        <td style="text-align: center; ">&#8377; </td>
                        <td style="text-align: center; "></td>
                    </tr>`;


        } else {
            html += `<tr>
                        <td colspan="11" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
        }


        html += "</tbody>";

        html += "</table>";

        $('#loadUnSettledData').html(html);

    });
}

function loadInvoicesData(resId = '', startDate = '', endDate = '', invoiceNo = '') {
    var skeleton = window.tableSkeleton;

    $('#loadInvoicesData').html(skeleton);
    var form_data = `request_type=loadInvoicesData&resId=${resId}&startDate=${startDate}&endDate=${endDate}&invoiceNo=${invoiceNo}`;

    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var cardContent = '';

        var totalAmount = 0;
        var totalDiscount = 0;
        var totalTax = 0;
        var totalSumAmount = 0;
        var totalPaid = 0;
        var totalAdj = 0;

        var html = '<table id="table-data-report-collections" class="table">';
        html += `
            <thead>
                <tr>
                    <th width="10%">Invoice #</th>
                    <th width="10%">Table/Room</th>
                    <th width="20%">Guest Detail</th>
                    <th width="10%">Amount</th>
                    <th width="10%">Discount</th>
                    <th width="10%">Tax</th>
                    <th width="10%">Total</th>
                    <th width="10%">Paid</th>
                    <th width="10%">Adj.</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>

        `;
        html += "<tbody>";

        if (response.length > 0) {
            $.each(response, function (key, val) {
                var billno = generateNumber(val.billno);
                var posId = val.id;
                var orderType = val.orderType;
                var totalPrice = val.totalPrice;
                var table = val.table;
                var bookingDetailId = (val.bookingDetailId == 0) ? table : val.bookingDetailId;
                var orderArry = val.order;
                var totalProductPrice = val.totalProductPrice;
                var tax = val.tax;
                var kotDisValue = val.kotDisValue;
                var settlementAmount = val.settlementAmount;
                var addOn = val.addOn;
                var guestDetail = val.guestDetail;
                var adj = 0;
                var gName = guestDetail['name'];
                var gPhone = guestDetail['phone'];
                var orderStatus = val['orderStatus'];

                var status = '';
                var statusClass = '';
                var actionFun = '';

                totalAmount += parseFloat(totalProductPrice);
                totalDiscount += parseFloat(kotDisValue);
                totalTax += parseFloat(tax);
                totalSumAmount += parseFloat(totalPrice);
                totalPaid += parseFloat(settlementAmount);


                if (orderStatus == 1) {
                    status = 'Sattlement';
                    statusClass = 'badge-success';
                    actionFun = 'printPOSorder';
                    adj = parseFloat(settlementAmount) - parseFloat(totalPrice);
                }

                if (orderStatus == 0) {
                    status = 'Unsattlement';
                    statusClass = 'badge-info';
                    actionFun = 'kotOrderSettlement';
                }

                if (orderStatus == 4) {
                    status = 'Cancl';
                    statusClass = 'badge-danger';
                    actionFun = 'printPOSorder';
                }

                var timer = moment(addOn).format('DD-MMM');

                totalAdj += parseFloat(adj);

                html += `<tr>
                            <td style="text-align: left; "><a href="javascript:void(0)" onclick="printPOSorder(${posId})">${billno}</a></td>
                            <td style="text-align: center; ">${bookingDetailId}</td>
                            <td style="text-align: center; ">${gName}</td>
                            <td style="text-align: center; ">&#8377; ${totalProductPrice}</td>
                            <td style="text-align: center; ">&#8377; ${kotDisValue}</td>
                            <td style="text-align: center; ">&#8377; ${tax}</td>
                            <td style="text-align: center; color:var(--infoClr)">&#8377; ${totalPrice}</td>
                            <td style="text-align: center; color:var(--successClr)">&#8377; ${settlementAmount}</td>
                            <td style="text-align: center; color:var(--dangerClr)">&#8377; ${adj}</td>
                            <td style="text-align: center; "><button onclick="${actionFun}(${posId})" style="border: none;" class="badge ${statusClass}">${status}</button></td>
                        </tr>`;
            });



            html += `<tr>
                            <td style="text-align: left; " colspan="3"><strong>Total</strong></td>
                            <td style="text-align: center; ">&#8377; ${totalAmount}</td>
                            <td style="text-align: center; ">&#8377; ${totalDiscount}</td>
                            <td style="text-align: center; ">&#8377; ${totalTax}</td>
                            <td style="text-align: center; color:var(--infoClr)">&#8377; ${totalSumAmount}</td>
                            <td style="text-align: center; color:var(--successClr)">&#8377; ${totalPaid}</td>
                            <td style="text-align: center; color:var(--dangerClr)">&#8377; ${totalAdj}</td>
                            <td style="text-align: center; "></td>
                        </tr>`;
        } else {
            html += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
        }


        html += "</tbody>";

        html += "</table>";

        $('#loadInvoicesData').html(html);

    });
}


function posShiftTable(posId) {
    var form_data = `request_type=posShiftTable&posId=${posId}`;
    ajax_request(form_data).done((result) => {
        var response = JSON.parse(result);
        var table = response.table;
        var optionForTable = '';
        $.each(table, function (key, val) {
            var tableId = val.id;
            var orderCount = val.orderCount;
            var tableNum = val.tableNum;
            if (orderCount == 0) {
                optionForTable += `<li>
                                        <input value="${tableId}" type="radio" name="shiftTableSelect" id="shiftTableSelect${tableId}">
                                        <label for="shiftTableSelect${tableId}">${tableNum}</label>
                                    </li>`;
            }
        })


        var html = `<form action="" id="shiftTableForm">
                        <input type="hidden" name="posId" value="${posId}"/>
                        <ul>
                            ${optionForTable}
                        </ul>

                    </form>`;

        showModalBox(`Shift Table`, 'Submit', html, 'shiftTableSubmit');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), {
            keyboard: false
        });
        myModal.show();
    });
}


function loadEditResturentReport(tab = 'room', bid = '') {

    var data = `request_type=loadEditResturentReport&tab=${tab}&bid=${bid}`;
    var skeleton = window.tableSkeleton;
    $('#loadEditResturentReport').html(skeleton);

    tab = (tab == '') ? 'room' : tab;

    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var bid = response.bid;
        var bookinId = response.bookinId;
        var totalAdult = response.totalAdult;
        var totalChild = response.totalChild;
        var totalGuest = totalAdult + totalChild;
        var bookingSource = response.bookingSource;
        var bookingref = response.bookingref;
        var checkIn = response.checkIn;
        var checkOut = response.checkOut;
        var addOn = response.addOn;
        var night = response.night;
        var totalPrice = response.totalPrice;
        var roomDetailArry = response.roomDetailArry;
        var paymentArry = response.paymentArry;
        var guestArray = response.guestArray;
        var existGuest = guestArray.length;
        var activityArry = response.activityArry;
        var reciptNo = generateNumber(response.reciptNo);
        var totalPrice = rupeesFormat(response.totalPrice);
        var userPay = (response.userPay == undefined) ? 0 : rupeesFormat(response.userPay);

        var totalRoom = roomDetailArry.length;

        var checkIntimer = moment(checkIn).format('DD-MMM');
        var checkOuttimer = moment(checkOut).format('DD-MMM');
        var addOntimer = moment(addOn).format('DD-MMM');

        var tableBody = '';

        var html = '';

        if (tab == 'room') {
            var roomHtml = '';
            var sn = 0;
            $.each(roomDetailArry, function (key, val) {
                sn++;
                var bookngDId = val.bookngDId;
                var roomName = val.roomName;
                var room_number = val.room_number;
                var total = val.total;
                var adult = val.adult;
                var child = val.child;
                var gstPrice = val.gstPrice;
                var rateplan = val.rateplan;
                var roomPrice = val.room;
                var adultPrice = val.adultPrice;
                var childPrice = val.childPrice;
                var extPrice = parseFloat(adultPrice) + parseFloat(childPrice);


                var editBtn = (val.checkinstatus < 3) ? `<div class="editBtn"><button style="height:30px" onclick="editBookingDetailFun(${bookngDId})" class="m0 btn btn-info pull-right" type="button">Edit</button></div>` : '<span style="height:30px; display:inline-block"></span>';


                roomHtml += `
                            <div class="col-md-4 mb-3">
                                <div class="contentGroup">
                                    <div class="content">
                                        <ul class="reservationRoomDetail">
                                            <li><span>Room Type:- </span> <strong>${roomName}</strong></li>
                                            <li><span>Room:- </span> <strong>${room_number}</strong></li>
                                            <li><span>Adult:- </span> <strong>${adult}</strong></li>
                                            <li><span>Child:- </span> <strong>${child}</strong></li>
                                            <li><span>Room Plan:- </span> <strong>${rateplan[0]}</strong></li>
                                            <li><span>Room Rate:- </span> <strong>${roomPrice}</strong></li>
                                            <li><span>Extra charge:- </span> <strong>${extPrice}</strong></li>
                                            <li><span>Discount:- </span> <strong></strong></li>
                                            <li><span>Tax:- </span> <strong>${gstPrice}</strong></li>
                                        </ul>
                                        <ul class="reservationTotalAmout">
                                            <li><span>Total Amount:- </span> <strong>${total}</strong></li>
                                        </ul>
                                        <ul class="reservationExtraDetail">
                                            <li><span>Status:- </span> <strong></strong></li>
                                            <li><span>Check In:- </span> <strong>${checkIntimer}</strong></li>
                                            <li><span>Exp Check Out:- </span> <strong>${checkOuttimer}</strong></li>
                                        </ul>
                                    </div>
                                </div>
                                ${editBtn}
                            </div>
                `;

            })

            html = `
                <div class="row">
                    <div class="col-md-6">
                        <h2>Rooms(${totalRoom}) x Nights(${night}) : ${totalPrice}</h2>
                    </div>
                    <div class="col-md-6">
                        <button data-bid="${bid}" class="btn btn-outline-primary" id="addRoomBtnForReservation">Add Room</button>
                    </div>
                </div>
                <div class="row">
                    ${roomHtml}
                </div>
            `;
        }

        if (tab == 'guests') {
            html += `
                <div class="row">
                    <div class="col-md-6">
                        <h2>Total guest :- ${totalGuest}, Exist Guest :- ${existGuest}</h2>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary" onclick="loadAddGuestReservationForm(${bid}, '#addGestOnReservation .content')">Add Guest</button>
                    </div>
                </div>
            `;
            html += '<table id="table-data-report-collections" class="table">';
            html += `
                <thead>
                    <tr>
                        <th width="15%" style="text-align:center;">Room #</th>
                        <th width="25%">Name</th>
                        <th width="15%">Phone</th>
                        <th width="25%">Email</th>
                        <th width="20%"></th>
                    </tr>
                </thead>

            `;
            html += "<tbody>";

            if (guestArray.length > 0) {
                var roomSelectArray = [];
                $.each(roomDetailArry, function (key, val) {
                    var roonNum = { 'rNum': val.room_number, 'bdid': val.bookngDId };
                    roomSelectArray.push(roonNum);
                });

                $.each(guestArray, function (key, val) {
                    var roonNum = val.roonNum;
                    var name = val.name;
                    var email = val.email;
                    var phone = val.phone;
                    var bookingdId = val.bookingdId;
                    var gId = val.id;

                    var roomSelect = '<option value="0">Select</option>';
                    $.each(roomSelectArray, function (key, val) {
                        var bDId = val.bdid;
                        var select = '';
                        if (val.rNum == roonNum) {
                            select = 'selected';
                        }
                        roomSelect += `<option ${select} value="${bDId}">${val.rNum}</option>`;
                    });

                    html += `<tr>
                                <td style="text-align: center;"><select class="form-control" onchange="roomNumberChange(this,${gId},${bid})">${roomSelect}</select></td>
                                <td style="text-align: center; ">${name}</td>
                                <td style="text-align: center; ">${phone}</td>
                                <td style="text-align: center; ">${email}</td>
                                <td style=""><button type="button" class="btn btn-info" onClick="loadAddGuestReservationForm(${bid}, '#addGestOnReservation .content', ${bookingdId}, ${gId})">Edit Guest</button></td>
                            </tr>`;
                });
            } else {
                html += `<tr>
                            <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                        </tr>`;
            }


            html += "</tbody>";

            html += "</table>";
        }

        if (tab == 'checkIn') {

            html += '<table id="table-data-report-collections" class="table">';
            html += `
                <thead>
                    <tr>
                        <th class="" style="text-align:center;"><label class="dFlex aic" for="roomCheckBoxAll"><input class="mR5" type="checkbox" id="roomCheckBoxAll" name="roomAllCheckBox"/> Room Type</label></th>
                        <th >Room #</th>
                        <th >Adult</th>
                        <th >Child</th>
                        <th >Room Plan</th>
                        <th >Rate</th>
                        <th >Disc</th>
                        <th >Extra Charge</th>
                        <th >Tax</th>
                        <th >Total</th>
                        <th ></th>
                    </tr>
                </thead>

            `;
            html += "<tbody>";

            if (roomDetailArry.length > 0) {
                var checkCount = 0;
                var totalCount = 0;
                $.each(roomDetailArry, function (key, val) {
                    var bookngDId = val.bookngDId;
                    var roomName = val.roomName;
                    var room_number = val.room_number;
                    var total = val.total;
                    var adult = val.adult;
                    var child = val.child;
                    var gstPrice = val.gstPrice;
                    var rateplan = val.rateplan;
                    var roomPrice = val.room;
                    var adultPrice = val.adultPrice;
                    var childPrice = val.childPrice;
                    var checkinstatus = val.checkinstatus;
                    var actionArray = getCheckInStatus(checkinstatus);
                    var extPrice = parseFloat(adultPrice) + parseFloat(childPrice);
                    var checkRadio = `<input type="checkbox" data-roomno='${room_number}' data-bid='${bid}' data-bdid='${bookngDId}' id="roomCheckBox${room_number}" name="roomCheckBox" value="${room_number}" />`;
                    var cButton = `<button class="btn ${actionArray.btnCls}" onclick="checkInGuestFun(${room_number},${bid},${bookngDId})">${actionArray.btn}</button>`;
                    totalCount++;
                    if (actionArray.btn != 'Check In') {
                        checkCount++;
                        cButton = `<button class="btn ${actionArray.btnCls}" onclick="checkInGuestFun(${room_number},${bid},${bookngDId})" disabled>${actionArray.btn}</button>`;
                        checkRadio = `<input type="checkbox" data-roomno='${room_number}' data-bid='${bid}' data-bdid='${bookngDId}' id="roomCheckBox${room_number}" name="roomCheckBox" value="${room_number}" checked disabled/>`;
                    }



                    html += `<tr>
                                <td style="text-align: center;"><label for="roomCheckBox${room_number}"> ${checkRadio} ${roomName} </label></td>
                                <td style="text-align: center; ">${room_number}</td>
                                <td style="text-align: center; ">${adult}</td>
                                <td style="text-align: center; ">${child}</td>
                                <td style="text-align: center; ">${rateplan[0]}</td>
                                <td style="text-align: center; ">${roomPrice}</td>
                                <td style="text-align: center; "></td>
                                <td style="text-align: center; ">${extPrice}</td>
                                <td style="text-align: center; ">${gstPrice}</td>
                                <td style="text-align: center; ">${total}</td>
                                <td style="">${cButton}</td>
                            </tr>`;
                });

                localStorage.clear();
                localStorage.setItem('totalCount', totalCount);
                localStorage.setItem('checkCount', checkCount);

            } else {
                html += `<tr>
                            <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                        </tr>`;
            }


            html += "</tbody>";

            html += "</table>";

            html += `<button id="bulkCheckIn">Check In selected Rooms</button>`;
        }

        if (tab == 'payment') {
            html += `
                <div class="row">
                    <div class="col-md-8">
                        <h2>Total amount :- ${totalPrice}, Paid amount :- ${userPay}</h2>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary" onclick="loadAddPaymentForm(${bid},'payment')">Add Payment</button>
                    </div>
                </div>
            `;
            html += '<table id="table-data-report-collections" class="table">';
            html += `
                <thead>
                    <tr>
                        <th style="text-align:center;">Invoice number #</th>
                        <th >Received</th>
                        <th >Payment Method</th>
                        <th >Remark</th>
                        <th >Add on</th>
                        <th ></th>
                    </tr>
                </thead>

            `;
            html += "<tbody>";

            if (paymentArry.length > 0) {
                var totalAmout = 0;
                $.each(paymentArry, function (key, val) {
                    var amount = val.amount;
                    var addOn = val.addOn;
                    var billingNo = val.billingNo;
                    var remark = val.remark;
                    var modeHtml = val.modeHtml;

                    var addOnTime = moment(addOn).format('DD-MMM');
                    totalAmout += parseFloat(amount);
                    html += `<tr>
                                <td style="text-align: center;">${billingNo}</td>
                                <td style="text-align: center; ">${amount}</td>
                                <td style="text-align: center; ">${modeHtml}</td>
                                <td style="text-align: center; ">${remark}</td>
                                <td style="text-align: center; ">${addOnTime}</td>
                                <td style=""></td>
                            </tr>`;
                });

                html += `<tr>
                                <td style="text-align: center;">Total</td>
                                <td style="text-align: center; ">${totalAmout}</td>
                                <td colspan="4"></td>
                            </tr>`;
            } else {
                html += `<tr>
                            <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                        </tr>`;
            }


            html += "</tbody>";

            html += "</table>";
        }

        if (tab == 'bill') {
            html += generateFolioContent(response.folio,bid,totalPrice,userPay,roomDetailArry);
        }

        if (tab == 'checkOut') {
            html += '<table id="table-data-report-collections" class="table">';
            html += `
                <thead>
                    <tr>
                        <th class="" style="text-align:center;"><label class="dFlex aic" for="roomCheckOutBoxAll"><input class="mR5" type="checkbox" id="roomCheckOutBoxAll" name="roomCheckOutBoxAll"/> Room Type</label></th>
                        <th style="text-align:center;">Room #</th>
                        <th >Guest name</th>
                        <th >Exp Check-out</th>
                        <th ></th>
                    </tr>
                </thead>

            `;
            html += "<tbody>";
            var checkShowSelectBtn = false;
            if (roomDetailArry.length > 0) {
                $.each(roomDetailArry, function (key, val) {

                    var checkinstatus = val.checkinstatus;
                    var actionArray = getCheckInStatus(checkinstatus);
                    var bookngDId = val.bookngDId;

                    var room_number = val.room_number;
                    var roomName = val.roomName;
                    var newArray = guestArray.filter(function (el) {
                        return el.roonNum == room_number;
                    });
                    var guestName = (newArray.length > 0) ? newArray[0]['name'] : '';
                    var guestHtml = '';
                    $.each(newArray, function (key, val) {
                        var gName = val.name;
                        guestHtml += `
                                <tr>
                                    <td style="text-align:left;">${gName}</td>
                                    <td>Checkout Guest</td>
                                </tr>
                        `;
                    });
                    if (actionArray.btn == 'Check In') {

                    }
                    else {
                        checkShowSelectBtn = true;
                        var checkRadio = `<input type="checkbox" data-roomno='${room_number}' data-bid='${bid}' data-bdid='${bookngDId}' id="roomCheckBox${room_number}" name="roomCheckBox" value="${room_number}" />`;
                        var cButton = `<button class="btn ${actionArray.btnCls}" onclick="checkInGuestFun(${room_number},${bid},${bookngDId})">${actionArray.btn}</button>`;
                        if (actionArray.btn != 'Check Out') {
                            checkRadio = `<input type="checkbox" data-roomno='${room_number}' data-bid='${bid}' data-bdid='${bookngDId}' id="roomCheckBox${room_number}" name="roomCheckBox" value="${room_number}" checked disabled/>`;
                            cButton = `<button class="btn ${actionArray.btnCls}" onclick="checkInGuestFun(${room_number},${bid},${bookngDId})" disabled>${actionArray.btn}</button>`;
                        }
                        html += `<tr>
                               <td style="text-align: center;"><label for="roomCheckBox${room_number}"> ${checkRadio} ${roomName} </label></td>
                                <td style="text-align: center; ">${room_number}</td>
                                <td style="text-align: center; ">${guestName}</td>
                                <td style="text-align: center; ">${checkOuttimer}</td>
                                <td style="text-align: center; ">${cButton}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table" style="display:none">
                                        <thead>
                                            <tr>
                                                <th style="text-align:left;">Guest Name</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${guestHtml}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            `;
                    }
                });
            } else {
                html += `<tr>
                            <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                        </tr>`;
            }

            html += "</tbody>";
            html += "</table>";
            if (checkShowSelectBtn) {
                html += `<button id="bulkCheckOut">Check Out selected Rooms</button>`;
            }

        }

        if (tab == 'activity') {
            html += '<table id="table-data-report-collections" class="table">';
            html += `
                <thead>
                    <tr>
                        <th style="text-align:center;">Activity</th>
                        <th >Created By</th>
                        <th >Created On</th>
                    </tr>
                </thead>

            `;
            html += "<tbody>";

            if (activityArry.length > 0) {
                $.each(activityArry, function (key, val) {
                    var addOn = val.addOn;
                    var reason = val.reason;
                    var addByName = val.addByName;

                    html += `<tr>
                                <td style="text-align: center;">${reason}</td>
                                <td style="text-align: center; ">${addByName}</td>
                                <td style="text-align: center; ">${addOn}</td>
                            </tr>`;
                });
            } else {
                html += `<tr>
                            <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                        </tr>`;
            }


            html += "</tbody>";

            html += "</table>";
        }

        $('#loadEditResturentReport').html(html);



    });


}

{/* <button class="btn btn-outline-primary" onclick="loadRoomChargeForm(${bid})">Room Charge</button> */}
function generateFolioContent(folio,bid,totalPrice,userPay,roomDetailArry,active='') {
    var html= '';
    var activeTop = `
        <button class="btn btn-outline-primary" onclick="loadAddPaymentForm(${bid}, 'folio')">Receipts</button>
        <button class="btn btn-outline-primary" onclick="loadExtraChargesForm(${bid})">Charges</button>
        
        <button class="btn btn-outline-primary" onclick="loadAllowanceForm(${bid})">Allowance</button>
    `;
    var activeBottom = `
        <button class="btn btn-outline-primary" onclick="addFolioBtn(${bid})">Add Folio</button>
        <button class="btn btn-outline-primary" onclick="folioHistoryBtn(${bid})">Folio History</button>
    `;
    var folioLink = generateFolioLinkInJs(bid);
    if(active == 'no'){
        activeTop = `<a class="btn btn-outline-primary" href="${folioLink}">Open Folio</a>`;
        activeBottom = '';
    }
    html += `
            <div class="row">
                <div class="col-md-6">
                    <h2>Total amount :- ${totalPrice}, <br/> Paid amount :- ${userPay}</h2>
                </div>
                <div class="col-md-6" style="text-align: end;">
                    ${activeTop}
                </div>
            </div>
        `;
    html += '<table id="table-data-report-collections" class="table">';
    html += `
        <thead>
            <tr>
                <th  style="text-align:center;">Date #</th>
                <th >Room #</th>
                <th>Ref.</th>
                <th>Particulars</th>
                <th>Description</th>
                <th>Charged</th>
                <th>Receipts</th>
                <th>Balance</th>
                <th>Username</th>
            </tr>
        </thead>`;
        
    html += "<tbody>";
    var folioArray = folio;
    var totalReceived = 0;
    var totalCharge = 0;
    var balance = 0;
    var discount = 0;
    var totalBalance = 0;

    if (folioArray.length > 0) {
        var charged = 0;
        var gst = 0;
        var received = 0;
        var sumBalance = 0;
        var fId = 0;

        var roomName = '';
        var room_number = '';
        var rateplan = '';

        $.each(folioArray, function (key, val) {



            var invoiceId = '';

            if (val.folioId == 0) {
                var particulars = val.particulars;
                var charged = val.charged;
                var balance = val.balance;
                var received = val.received;
                html += `<tr class="h20">
                        <td class="fw700 fs20" style="text-align: center;" colspan="5">${particulars}</td>
                        <td class="fw700 fs20" style="text-align: center;">&#8377;  ${charged}</td>
                        <td class="fw700 fs20" style="text-align: center;">&#8377;  ${received}</td>
                        <td class="fw700 fs20" style="text-align: center;" colspan="2">&#8377;  ${balance}</td>
                    </tr>`;
            } else {

                fId = val.folioId;
                var gName = val.gName;
                var faddOn = (val.chargeDate == '0000-00-00') ? val.addOn : val.chargeDate;
                var particulars = val.particulars;
                var remark = val.remark;
                var ref = val.ref;
                var folioBdid = val.bdId;
                var userName = val.userName;
                var gst = val.gst;
                balance = val.balance;
                discount += parseFloat(val.discount);

                charged = val.charged;
                received = val.received;
                gst = val.gst;

                totalReceived += parseFloat(received);
                totalCharge += parseFloat(charged);
                totalBalance += parseFloat(balance);

                invoiceId = generateNumber(fId) + ' - ' + gName;
                sumBalance = parseFloat(charged) - parseFloat(received);

                $.each(roomDetailArry, function (key, value) {
                    var bookingDID = value.bookngDId;
                    if (folioBdid == bookingDID) {
                        room_number = value.room_number;
                    }
                });

                var gstHtml = '';
                if (gst['CGST'] != undefined) {
                    var cgst = gst['CGST'];
                    var sgst = gst['SGST'];
                    gstHtml = `<tr>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="fw500" width="10%">CGST</td>
                                <td class="h35" width="10%"></td>
                                <td class="fw500 h35" width="10%">&#8377; ${cgst}</td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td width="10%"></td>
                            </tr>
                            <tr>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="fw500" width="10%">SGST</td>
                                <td class="h35" width="10%"></td>
                                <td class="fw500 h35" width="10%">&#8377; ${sgst}</td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                                <td class="h35" width="10%"></td>
                            </tr>`;
                }

                var folioDate = moment(faddOn).format('DD-MMM');


                html += `<tr class="h20">
                        <td class="fw500" style="text-align: center;">
                            <div class="dFlex aic jcc">
                                <input class="mr5" type="checkbox" name="folioIdCheck" value="${fId}"/> <span>${folioDate}</span>
                            </div>
                        </td>
                        <td class="fw500" style="text-align: center;">${room_number}</td>
                        <td class="fw500" style="text-align: center;">${ref}</td>
                        <td class="fw500" style="text-align: center;">${particulars}</td>
                        <td class="fw500" style="text-align: center;">${remark}</td>
                        <td class="fw500" style="text-align: center;">&#8377;  ${charged}</td>
                        <td class="fw500" style="text-align: center;">&#8377;  ${received}</td>
                        <td class="fw500" style="text-align: center;">&#8377;  ${balance}</td>
                        <td class="fw500" style="text-align: center;">${userName}</td>
                    </tr>

                    ${gstHtml}`;
            }
        });

        var folioBalance = parseFloat(totalBalance) - parseFloat(totalReceived);

        {/* <button onclick="loadRoomChargeForm(${bid},${fId})">
                                    <svg class="w15 h15"><use xlink:href="#editfilledIcon"></use></svg>
                                </button> */}

        html += `<tr>
                        <td colspan="5" style="text-align: center;font-weight: 700;font-size: 20px;">Grand Total</td>
                        <td class="yellowClr" style="text-align: center;font-weight: 700;font-size: 20px;">&#8377;  ${rupeesFormat(totalCharge)}</td>
                        <td class="greenClr" style="text-align: center;font-weight: 700;font-size: 20px;">&#8377;  ${rupeesFormat(totalReceived)}</td>
                        <td colspan="2" style="text-align: center;font-weight: 700;font-size: 20px;">Balance: <span class="redClr">&#8377; ${rupeesFormat(folioBalance)}</span></td>
                    </tr>`;
    } else {
        html += `<tr>
                    <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                </tr>`;
    }


    html += "</tbody>";

    html += "</table>";

    html += `
        <div class="row">
            <div class="col-md-12">
                ${activeBottom}
            </div>
        </div>
    `;

    return html;
}

function editBookingDetailFun(bdid = '', type='') {
    var data = `request_type=editBookingDetailFun&bdid=${bdid}`;

    ajax_request(data).done(function (request) {
        var responce = JSON.parse(request);
        var data = responce.data;
        var adult = data.adult;
        var child = data.child;
        var roomId = data.roomId;
        var roomDId = data.roomDId;
        var room_number = data.room_number;

        var roomType = responce.roomType;
        var roomNum = responce.roomNum;
        var capacity = responce.capacity;

        var roomTypeHtml = '';
        $.each(roomType, function (key, val) {
            var rid = val.id;
            var header = val.header;
            var select = (rid == roomId) ? 'selected' : '';
            roomTypeHtml += `<option ${select} value="${rid}">${header}</option>`;
        });

        var roomNumHtml = '';
        $.each(roomNum, function (key, val) {
            var rNumid = val.id;
            var roomNo = val.roomNo;
            var select = (roomNo == room_number) ? 'selected' : '';
            roomNumHtml += `<option ${select} value="${roomNo}">${roomNo}</option>`;
        });

        var AdultHtml = '';
        for (let i = 1; i <= capacity; i++) {
            var select = (i == adult) ? 'selected' : '';
            AdultHtml += `<option ${select} value="${i}">${i}</option>`;
        }

        childPrint = 2;
        var childHtml = '';
        for (let i = 0; i < childPrint; i++) {
            var select = (i == child) ? 'selected' : '';
            childHtml += `<option ${select} value="${i}">${i}</option>`;
        }

        $rtdisplay = 'flex';
        $rndisplay = 'flex';
        $adisplay = 'flex';
        $cdisplay = 'flex';
        if(type == 'onlyRoom'){
            $adisplay = 'none';
            $cdisplay = 'none';
        }

        var html = `
            <form id="editBookingDetailForm" class="priceSec">
                <input type="hidden" name="bookingDetailId" value="${bdid}"/>
                <div class="row">
                    <div style="display: ${$rtdisplay}" class="col-12 row mb-2">
                        <label class="col-4 m0" for="roomType">Room Type</label>
                        <select class="col-8 customControl" disabled name="roomType" id="roomType">
                            ${roomTypeHtml}
                        </select>
                    </div>

                    <div style="display: ${$rndisplay}" class="col-12 row mb-2">
                        <label class="col-4 m0" for="roomNumber">Room Number</label>
                        <select class="col-8 customControl" name="roomNumber" id="editroomNumber">
                            ${roomNumHtml}
                        </select>
                    </div>

                    <div style="display: ${$adisplay}" class="col-5 mb-2 row align-items-center justify-content-center">
                        <label class="col-6 m0" for="adult">Adult</label>
                        <select class="col-6 customControl" name="adult" id="adult">
                            ${AdultHtml}
                        </select>
                    </div>

                    <div style="display: ${$cdisplay}" class="col-5 offset-2 row align-items-center justify-content-center">
                        <label class="col-6 m0" for="child">Child</label>
                        <select class="col-6 customControl" name="child" id="child">
                            ${childHtml}
                        </select>
                    </div>
                    

                </div>
            </form>`;

        showModalBox('Edit details', 'Submit', html, 'editBookingDetailSubmit');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    });
}


function editExtendStayFun(bdid = '') {
    var data = `request_type=editExtendStayFun&bdid=${bdid}`;

    ajax_request(data).done(function (request) {
        var responce = JSON.parse(request);
        var checkIn = responce.checkIn;
        var checkOut = responce.checkOut;    
        
        var checkInTime = moment(checkIn).format('DD/MM/YYYY');
        var checkOutTime = moment(checkOut).format('DD/MM/YYYY');

        var html = `
            <form id="editExtendStayForm" class="priceSec">
                <input type="hidden" name="bookingDetailId" value="${bdid}"/>
                <div class="row">
                    <div class="col-12 row mb-2">
                        <label class="col-4 m0" for="roomType">Check In</label>
                        <input disabled type="text" name="checkInTime" class="form-control datePicker" value="${checkInTime}">
                    </div>

                    <div class="col-12 row mb-2">
                        <label class="col-4 m0" for="roomNumber">Check Out</label>
                        <input type="text" name="checkOutTime" class="form-control CheckOutdatePicker" value="${checkOutTime}">
                    </div>
                    

                </div>
            </form>`;

        showModalBox('Stay Extend', 'Submit', html, 'editExtendStaySubmit');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();

        $('.datePicker').datepicker({});

         $('.CheckOutdatePicker').datepicker({  
            minDate:new Date()
         });
    });
}

function quickBalanceViewFun(bid = '') {
    var data = `request_type=quickBalanceViewFun&bid=${bid}`;

    ajax_request(data).done(function (request) {
        var responce = JSON.parse(request);
        var roomDetailArry = responce.roomDetailArry;
        var totalRoomPrice = 0;
        var totalGstPrice = 0;
        var roomHtml = '';
        var gstHtml = '';
        $.each(roomDetailArry, (key,val)=>{
            var gst = val.gstPrice;
            var roomPrice = val.subTotal;
            var roomName = val.roomName;
            var gstPer = val.gstPer;
            
            totalRoomPrice += parseInt(roomPrice);
            totalGstPrice += parseInt(gst);
            roomHtml += `<tr><td class="tal">${roomName}</td> <td class="tal">${roomPrice}</td></tr>`;
            gstHtml += `<tr><td class="tal">CGST ${gstPer/2}%</td> <td class="tal">${gst/2}</td></tr>
                       <tr><td class="tal">SGST ${gstPer/2}%</td> <td class="tal">${gst/2}</td></tr>`;
        })

        var html = `
                    <table class="borderTable" border="1">
                        <tr><td class="tal" colspan="2">Room Charges</td></tr>
                        ${roomHtml}
                        <tr><td class="tal"><strong>Group Total (Room Charges)</strong></td> <td class="tal"><strong>${totalRoomPrice}</strong></td></tr>
                        <tr><td class="tal" colspan="2">Taxes</td></tr>
                        ${gstHtml}
                        <tr><td class="tal"><strong>Group Total (Taxes)</strong></td> <td class="tal"><strong>${totalRoomPrice}</strong></td></tr>
                    </table>
                `;

        showModalBox('View Quick Balance', '', html, '');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();

        $('.datePicker').datepicker({});

         $('.CheckOutdatePicker').datepicker({  
            minDate:new Date()
         });
    });
}


function roomNumberChange(item, gId, bid) {
    var bdid = item.value;
    var data = `request_type=roomNumberChange&gId=${gId}&bdid=${bdid}`;

    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var status = response.status;
        var msg = response.msg;

        if (status == 'success') {
            sweetAlert(msg);
            loadEditResturentReport('guests', bid);
        }

    });
}

function loadAddPaymentForm($bId = '', tab = '') {
    var bid = $bId;
    var data = `request_type=loadAddPaymentForm&bid=${bid}`;
    ajax_request(data).done(function (request) {
        var responce = JSON.parse(request);
        var totalPrice = responce.totalPrice;
        var paymentMethod = responce.paymentMethod;
        var paymentMethodHtml = '';
        $.each(paymentMethod, function (key, val) {
            var name = val.name;
            var pmId = val.id;
            paymentMethodHtml += `<option value="${pmId}">${name}</option>`;
        })
        {/* <div class="form-group">
                    <input class="form-check-input" type="checkbox" value="" id="remainingAmount">
                    <label class="custom-control-label" for="remainingAmount">Full Amount</label>
                </div> */}
        var html = `
            <form id="addPaymentAmountForm" method="post">
                <input class="form-control" type="hidden" value="${bid}" id="bid">
                <input class="form-control" type="hidden" value="${tab}" id="tabData">
                
                <div class="form-group">
                    <label for="amountPaid" class="form-control-label">Amount</label>
                    <input class="form-control" type="number" step="any" value="" id="amountPaid" placeholder="Enter amount.">
                </div>

                <div class="form-group dFlex aic jcsb">
                    <label style="width: 35%; margin-bottom: 0;" for="paymentMethod" class="form-control-label mr5">Payment type</label>
                    <select style="width: 60%;height: 40px;padding: 0 5px;" name="paymentMethod" id="paymentMethod">
                        <option selected value="0">Select payment method </option>
                        ${paymentMethodHtml}
                    </select>
                </div>

                <div class="form-group">
                    <label for="paidDate" class="form-control-label">Paid Date</label>
                    <input class="form-control" type="datetime-local" id="paidDate" >
                </div>

                <div class="form-group">
                    <label for="remark" class="form-control-label">Remark</label>
                    <input class="form-control" type="text" value="" id="remark" placeholder="Enter bill no, UPI ID etc">
                </div>
            </form>
        `;

        showModalBox(`Add Payment (&#8377; ${totalPrice})`, 'Add Payment', html, 'addPaymentSubmitBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();
    });

}


function loadOccupancyForecastReport(sDate = '', eDate = '') {
    var data = `request_type=loadOccupancyForecastReport&startDate=${sDate}&endDate=${eDate}`;
    var skeleton = window.tableSkeleton;
    $('#loadOccupancyForecastReport').html(skeleton);
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var dateList = response.dateList;
        var roomName = response.roomName;
        var data = response.data;

        var headHtml = '';

        var html = '<table id="table-data-report-collections" class="table">';

        $.each(dateList, function (key, val) {
            var date = moment(val).format('DD-MMM');
            headHtml += `<th width="">${date}</th>`;
        })

        html += `
                    <thead>
                        <tr>
                            <th width="140px" style="text-align:center;">Room No</th>
                            ${headHtml}
                        </tr>
                    </thead>

                `;
        html += "<tbody>";

        if (data.length > 0) {

            $.each(data, function (key, val) {
                var rid = val.rid;
                var roomName = val.roomName;
                var perDayData = val.perDayData;

                var occupayHtml = '';
                $.each(perDayData, function (key, val) {
                    var date = val.date;
                    var occupancy = val.occupancy;
                    occupayHtml += `<td style="text-align: center; background-color: rgb(255, 255, 255);">
                                                <button class="span-badge" onclick="OpenOccupancyDetail(1,4,'classic deluxe (9)',8)" style="cursor:pointer;">${occupancy}</button>
                                            </td>`;
                });

                html += `<tr>
                                        <td style="text-align: left; color:var(--pClr); background-color: rgb(255, 255, 255);">${roomName}</td>
                                        ${occupayHtml}
                                </tr>`;
            });
        } else {
            html += `<tr>
                                <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                            </tr>`;
        }
        //Jquery Code written by Abinash
        var footerHtml = '';
        var lastforecasthtml = '';
        var summaryHeading = `<small style="font-weight:bold;">${" " + sDate + " "} to ${" " + eDate}</small>`;




        var transposedData = [];

        // Transpose the data
        for (var i = 0; i < dateList.length; i++) {
            var columnData = [];
            var sum = 0;

            $.each(data, function (key, val) {
                var perDayData = val.perDayData;
                if (perDayData[i]) {
                    columnData.push(perDayData[i].occupancy);
                    sum = sum + perDayData[i].occupancy;
                } else {
                    columnData.push(0); // If data for a specific date is not available, set the occupancy to 0
                }
            });

            transposedData.push(sum);


            footerHtml += `<th style="text-align: center; background-color: rgb(255, 255, 255);">${transposedData[i]}</th>`;




        }








        html += `
                        <tr>
                            <th style="text-align:center;">Total Booking</th>
                            ${footerHtml}
                        </tr>

                `;

        html += "</tbody>";

        html += "</table>";


        $('#loadOccupancyForecastReport').html(html);
        var totalNoOfDays = loadOccupancyForecastDayReport(sDate, eDate);
        var totalNumOfRooms = totalNoOfDays * data.length;
        var sum = 0;
        for (var i = 0; i < transposedData.length; i++) {
            sum = sum + transposedData[i];
        }
        var totalOcuupancy = sum;
        var totalRoomAvialabel = totalNumOfRooms - totalOcuupancy;
        var occupancyPercentage = (totalOcuupancy / totalNumOfRooms) * 100;
        lastforecasthtml = `                                        <tr>
                                            <td>No. of Days</td>
                                            <td style="text-align:right;">${totalNoOfDays}</td>
                                        </tr>
                                        <tr>
                                            <td>Rooms</td>
                                            <td style="text-align:right;">${totalNumOfRooms}</td>
                                        </tr>
                                        <tr>
                                            <td>Occupancy</td>
                                            <td style="text-align:right;">${totalOcuupancy}</td>
                                        </tr>
                                        <tr>
                                            <td>Available</td>
                                            <td style="text-align:right;">${totalRoomAvialabel}</td>
                                        </tr>
                                        <tr>
                                            <td>Occupancy %</td>
                                            <td style="text-align:right;">${occupancyPercentage}%</td>
                                        </tr>`;
        $('#sectionDataSummaryTitle').html(summaryHeading);
        $('#sectionDataSummary').html(lastforecasthtml);


    });

    function loadOccupancyForecastDayReport(sDate = '', eDate = '') {
        var startDate = new Date(sDate);
        var endDate = new Date(eDate);

        // Calculate the difference in milliseconds
        var timeDifference = endDate.getTime() - startDate.getTime();

        // Convert the difference to days
        var totalNoOfDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

        return totalNoOfDays;

    }
}

function loadFoliosReport(bid) {
    var data = `request_type=openFolioBtn&bid=${bid}`;
    var skeleton = window.tableSkeleton;
    $('#loadFolioReport').html(skeleton);

    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var bid = response.bid;
        var totalPrice = rupeesFormat(response.totalPrice);
        var userPay = (response.userPay == undefined) ? 0 : rupeesFormat(response.userPay);
        var roomDetailArry = response.roomDetailArry;
        var html = generateFolioContent(response.folio,bid,totalPrice,userPay,roomDetailArry);
        $('#loadFolioReport').html(html);
    })

}

function loadRoomChargeForm(bid, fid) {
    var data = `request_type=loadRoomChargeForm&bid=${bid}&fid=${fid}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var data = response.data;
        var date = response.date;
        var roomarr = data.roomDetailArry;
        var roomPrice = data.roomPrice;
        var totalPrice = data.totalPrice;
        var dateHtml = '';
        var roomNumHtml = '';

        var roomCount = 0;
        roomarr.forEach(element => {
            roomCount++;
            var select = '';
            if (roomCount == 1) {
                select = "checked";
            }
            var bookngDId = element.bookngDId;
            var room_number = element.room_number;
            roomNumHtml += `<div class="form-check mr5">
                                 <input ${select} class="form-check-input" type="checkbox" name="roomList[]" value="${bookngDId}" id="roomNum${bookngDId}">
                                 <label class="form-check-label" for="roomNum${bookngDId}">
                                     ${room_number}
                                 </label>
                             </div>`
        });

        $.each(date, function (key, val) {
            dateHtml += `<option value="${val}">${val}</option>`;
        });

        var html = `
            <form method="post" id="roomChargeForm">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtRoomChargeReferenceNumber" class="col-sm-4 control-label m0">Ref</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="txtRoomChargeReferenceNumber" name="RoomChargeReferenceNumber" type="text" value="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="roomList" class="form-control-label col-sm-4 m0">Room Number</label>
                            <div class="col-sm-8 m0">
                                <div class="dFlex aic" id="roomNumList">
                                    ${roomNumHtml}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtRoomChargeDate" class="col-sm-4 control-label m0">Date</label>
                                <div class="col-sm-8"><select style="width: 100%;height: 40px;padding: 0 6px;" name="txtRoomChargeDate">${dateHtml}</select></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="RoomChargeChargeId" class="col-sm-4 control-label m0">Room Charge</label>
                                <div class="col-sm-8">
                                    <select autocomplete="off" class="form-control" data-val="true" data-val-number="The field ChargeId must be a number." id="RoomChargeChargeId" name="RoomChargeChargeId">
                                        <option selected="selected" value="1">Room Charges</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtRoomChargeChargeAmount" class="col-sm-4 control-label m0">Charge Amount</label>
                                <div class="col-sm-8">
                                    <input class="form-control required-field input-decimal-no-minus" data-val="true" data-val-number="The field AmountCharge must be a number." id="txtRoomChargeChargeAmount" name="RoomChargeAmountCharge" onblur="CalculateDiscountAmount();" type="text" value="${rupeesFormat(roomPrice)}" autocomplete="new-password" style="border-color: rgb(97, 97, 97);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtRoomChargeExtraPersonChargeAmount" class="col-sm-4 control-label m0">Extra Person Charge</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-decimal-no-minus" data-val="true"
                                        data-val-number="The field AmountExtraPerson must be a number." id="txtRoomChargeExtraPersonChargeAmount" name="RoomChargeAmountExtraPerson"
                                        type="text" value="0.00" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtRoomChargeDiscountPercentage" class="col-sm-4 control-label m0">Discount Amount</label>
                                <div class="col-sm-3">
                                    <div class="input-group input-append">
                                        <input class="form-control input-decimal-no-minus" data-val="true" data-val-number="The field DiscountPercentage must be a number." id="txtRoomChargeDiscountPercentage" name="RoomChargeDiscountPercentage" type="text" value="0" >
                                        <span class="input-group-addon add-on input-group-addon-blank">%</span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input class="form-control input-decimal-no-minus" data-val="true"
                                        data-val-number="The field AmountDiscount must be a number." id="txtRoomChargeDiscountAmount" name="RoomChargeAmountDiscount" readonly="readonly" type="text" value="0.00" autocomplete="new-password">                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-4 control-label m0" for="inputRoomChargeHalfDay">Half Day Charges</label>
                                <div class="col-sm-2 m0">
                                    <input id="inputRoomChargeHalfDay" name="RoomChargeIsHalfDayPosting"  type="checkbox" value="true"></span>
                                </div>

                                <label class="col-sm-4 control-label m0">Is Tax Inclusive</label>
                                <div class="col-sm-2 m0" id="sectionIsTaxInclusive">
                                    <i class="fa fa-check true-icon"></i>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-4 control-label m0">Is Tax After Discount</label>
                                <div class="col-sm-2" id="sectionIsTaxAfterDiscount">
                                    <i class="fa fa-check true-icon"></i>
                                </div>
                                <label class="col-sm-5 control-label m0">Is Discount On Extra Charge</label>
                                <div class="col-sm-1" id="sectionIsDiscountOnExtraCharge">
                                    <i class="fa fa-close false-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-4 control-label m0">Remarks</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" cols="20" id="txtRoomChargeRemarks"
                                        name="RoomChargeDescription" rows="2"></textarea>
                                    <span class="field-validation-valid" data-valmsg-for="RoomChargeDescription"
                                        data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="${roomPrice}" id="roomMainPrice"/>
                    <input type="hidden" value="${bid}" id="bookingId" name="bookingId"/>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-12 text-center">
                                    <strong>Balance: <span class="section-folio-balance-popup" style="color: rgb(242, 86, 86);">${rupeesFormat(totalPrice)}</span></strong>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 dFlex jcc">
                        <input id="roomChargeSubmitBtn" class="btn btn-info" type="submit" type="hidden" value="Add">
                    </div>

                </div>
            <form>
        `;

        customModal('Room Charge', html);

    })
}

function loadAllowanceForm(bid) {
    var data = `request_type=loadAllowanceForm&bid=${bid}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var totalPrice = rupeesFormat(response.totalPrice);
        var html = `
            <form method="post" id="allowanceForm">
                <div class="row">                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <input type="hidden" id="booingId" name="booingId" value="${bid}"/>
                                <label for="txtChargeReferenceNumberDiscount" class="col-sm-3 control-label m0">Ref</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="txtChargeReferenceNumberDiscount" name="reference" type="text" value="" autocomplete="new-password" placeholder="Enter Reference.">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="ddlChargeTypeDiscount" class="col-sm-3 control-label m0">Allowance</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-alternative required-field" data-val="true" data-val-number="The field ChargeId must be a number." id="ddlChargeTypeDiscount" name="ChargeId" style="border-color: rgb(97, 97, 97);">
                                        <option selected="selected" value="0">Select</option>
                                        <option value="discount">Discount</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtChargeChargeAmountDiscount" class="col-sm-3 control-label m0">Amount</label>
                                <div class="col-sm-9">
                                    <input class="form-control required-field input-decimal-no-minus" data-val="true" data-val-number="The field AmountCharge must be a number." id="txtChargeChargeAmountDiscount" name="AmountCharge" type="text" value="0" autocomplete="new-password" style="border-color: rgb(97, 97, 97);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="txtChargeRemarksDiscount" class="col-sm-3 control-label m0">Remarks</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" cols="20" id="txtChargeRemarksDiscount" name="Description" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-sm-12 magin-six">
                            <input id="button-folio-charges-discount-submit" type="submit" value="Add" class="btn btn-lg btn-success">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-12 text-center"><strong>Balance: 
                                <h2 style="color: rgb(242, 86, 86);">Rs ${totalPrice}</h2></strong></label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        `;
        customModal('Allowance', html);
    })
}

function formattedDateForInput() {
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; // Months are zero-indexed, so we add 1
    var year = currentDate.getFullYear();

    // Add leading zeros if needed
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var formattedDate = year + '-' + month + '-' + day;
    return formattedDate;
}

function loadExtraChargesForm($bid = '') {
    var bid = $bid;
    var data = `request_type=loadExtraChargesForm&bid=${bid}`;
    ajax_request(data).done(function (request) {
        var responce = JSON.parse(request);
        var totalPrice = responce.totalPrice;
        var addOnCharge = responce.addOnCharge;
        var roomarr = responce.roomDetailArry;
        var roomNumList = '';
        var extraChargeHtml = '';
        $.each(addOnCharge, (key, chargeVal) => {
            var eCName = chargeVal.name;
            extraChargeHtml += `<option value="${eCName}">${eCName}</option>`;
        });
        roomarr.forEach(element => {
            var bookngDId = element.bookngDId;
            var room_number = element.room_number;
            roomNumList += `<div class="form-check mr5">
                                <input class="form-check-input" type="checkbox" name="roomList[]" value="${bookngDId}" id="roomNum${bookngDId}">
                                <label class="form-check-label" for="roomNum${bookngDId}">
                                    ${room_number}
                                </label>
                            </div>`
        });

        var html = `
            <form id="addExtraChargesForm" method="post">
                <input class="form-control" type="hidden" name="booingId" value="${bid}" id="booingId">
                <div class="form-group">
                        <label for="refNum" class="form-control-label">Ref. No.</label>
                        <input name="reference" class="form-control" type="text" value="" id="refNum">
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="roomList" class="form-control-label">Room Number</label>
                            <div class="dFlex aic">
                                ${roomNumList}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                                
                            <label for="chargesList" class="form-control-label chargelist">Charge</label>
                            <select class="form-control" name="extraChargeName">
                                <option value="0">Select</option>
                                ${extraChargeHtml}
                            </select>
                    
                        </div>
                    </div>
                </div>    


                <div class="form-group">
                    <label for="tax" class="form-control-label tax">Tax Inclusive</label>
                    <input name="taxtInclusive" type="checkbox" id="tax" value="true">
                </div>
            
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="chargeamount" class="form-control-label">Charge Amount</label>
                                <input name="chargeAmount" type="number" class="form-control required-field input-decimal-no-minus valid" value="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discountamount" class="form-control-label">Discount Amount</label>
                                <input name="discountAmout" type="number" class="form-control" value="0">
                            </div>
                        </div>
                </div>
                
            
                    <div class="form-group">
                        <label for="txtChargeRemarks" class="form-control-label">Remarks</label>
                        <textarea name="remarks" class="form-control" cols="20" id="txtChargeRemarks" rows="2"></textarea>
                    </div>
    
            
            </form>`;

        showModalBox(`Add Extra Charges (&#8377; ${totalPrice})`, 'Add Extra Charge', html, 'addExtraChargesSubmitBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'), { keyboard: false });
        myModal.show();

    });

}

function OnChangeHalfDayPosting() {
    var roomPrice = $('#txtRoomChargeChargeAmount').val().trim();
    if ($(this).prop('checked') == true) {
        console.log('true');
    }
}

function deleteFolioBtn(fid, bid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        function deleteCon() {
            if (fid == '' || fid == 0) {
                sweetAlert('Successfully delete record.');
            } else {
                var data = 'fid=' + fid + '&request_type=deleteFolio';
                ajax_request(data).done(function (data) {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;


                    if (status == 'success') {
                        loadEditResturentReport('bill', bid);
                        sweetAlert(msg);
                    }
                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                });
            }

        }
        if (result.isConfirmed) {
            deleteCon();
        }
    });
}

function chooseImageCon(btn, id = '') {
    var data = `request_type=chooseImageCon&catId=${id}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var item = '';

        $.each(response, (key, val) => {
            var fullName = val.fullUrl;
            var id = val.id;
            var checked = (val.select == 'yes') ? 'checked' : '';

            item += `<li>
                        <input ${checked} type="checkbox" name="galleryItem[]" id="galleryItem${id}" value="${id}">
                        <label for="galleryItem${id}">
                            <img src="${fullName}" alt="">
                        </label>
                    </li>`;
        });

        var html = `
            <div class="galleryContent">
                
                <form id="galleryItemForm" class="mainItem">
                    <ul>
                        <input type="hidden" name="accessKey" value="${id}"/>
                        ${item}
                    </ul>
                    <button class="btn">Save</button>
                </form>
            </div>
        `;

        var title = `
            <ul class="galleryContentNavItem">
                <li><button class="active"><svg class="w28 h28"><use xlink:href="#galleryIcon"></use></svg> Image</button></li>
                <li><button><svg class="w28 h28"><use xlink:href="#computerIcon"></use></svg> For Computer</button></li>
            </ul>
        `;

        customModal(title, html, btn, '80vw', '90vh');
    });

}

function removeGalleryCat(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        function deleteCon() {
            if (id == '' || id == 0) {
                sweetAlert('Successfully delete record.');
            } else {
                var data = 'id=' + id + '&request_type=removeGalleryCat';
                ajax_request(data).done(function (data) {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg = response.msg;


                    if (status == 'success') {
                        loadEditResturentReport('bill', bid);
                        sweetAlert(msg);
                    }
                    if (status == 'error') {
                        sweetAlert(msg, 'error');
                    }
                });
            }

        }
        if (result.isConfirmed) {
            deleteCon();
        }
    });
}

function addFolioBtn(bid) {
    var data = `request_type=loadGuestNamesByBkind&bid=${bid}`;
    ajax_request(data).done(function (response) {
        var data = JSON.parse(response);
        var guestNameList = ``;
        data.forEach(element => {
            guestNameList += `<option value="${element.name}">${element.name}</option>`
        });



        var html = `
        <form method="post" id="addFolioForm">
            <div class="row"> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" id="booingId" name="booingId" value="${bid}"/>
                            <label for="guestName" class="col-sm-12 control-label m0">Guest Name</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-alternative required-field" data-val="true"  id="guestName" name="guestName" style="border-color: rgb(97, 97, 97);">
                                    <option selected="selected" value="0">Select</option>
                                   ${guestNameList}
                                </select>
                            </div>
                        </div>
                    </div>
                 </div>

                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <label for="reason" class="col-sm-12 control-label m0">Charge Amount</label>
                            <div class="col-sm-12">
                            <input class="form-control required-field input-decimal-no-minus" data-val="true" data-val-number="The field AmountCharge must be a number." id="chargeamount" name="chargeamount" type="number" value="0" style="border-color: rgb(97, 97, 97);">
                            </div>
                        </div>
                    </div>
                 </div>

                 <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                     <div class="row">
                         <label for="reason" class="col-sm-12 control-label m0">Received Amount</label>
                         <div class="col-sm-12">
                         <input class="form-control required-field input-decimal-no-minus" data-val="true" data-val-number="The field AmountCharge must be a number." id="receivedamount" name="receivedamount" type="number" value="0" style="border-color: rgb(97, 97, 97);">
                         </div>
                     </div>
                 </div>
              </div>


                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <label for="reason" class="col-sm-12 control-label m0">Reason</label>
                            <div class="col-sm-12">
                               <textarea class="form-control" cols="20" id="reason" name="reason" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                 </div>

            </div>
        </form>
        `
        showModalBox('Add Folio', 'Add', html, 'submitAddFolio');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    });
}



function folioHistoryBtn(bid) {
    $.ajax({
        url: webUrl + "/include/ajax/otherDetail.php",
        type: 'POST',
        data: {
            'type': 'folioHistory',
            'bid': bid
        },
        success: function (data) {

            var res = JSON.parse(data);
            var tablebody = ``;
            res.forEach(element => {
                tablebody += `  <tr>
                                    <td style="text-align:center;">${element.particulars}</td>
                                    <td style="text-align:center;">${element.ipaddress}</td>
                                    <td style="text-align:center;">${element.userName}</td>
                                    <td style="text-align:center;">${element.addOn}</td>
                                </tr>`
            });

            var html = `

            <div class="table-responsive">
                            <table id="tableDataGridFolioActivity" class="table">
                                <thead>
                                    <tr>
                                        <th>Activity Type</th>                               
                                        <th>IP</th>
                                        <th>Username</th>
                                        <th class="text-right">Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tablebody}
                                </tbody>
                            </table>
              </div>
            
            `;

            showModalBox('Folio History', '', html, '', 'modal-xl');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
            myModal.show();

        },
        error: function (error) {
            sweetAlert('error', 'Something Went Wrong');
        }

    });
}


function userPermission(uid) {
    var data = `request_type=userPermission&uid=${uid}`;
    ajax_request(data).done(function (response) {
        var returnData = JSON.parse(response);
        var tab = returnData.tap;
        var content = returnData.content;
        var tabHtml = '';
        var contentHtml = '';
        $.each(tab, (key, val) => {
            var active = '';
            var tabName = val.name;
            var tabId = val.id;
            if (key == 0) {
                active = 'show';
            }
            tabHtml += `<li> <a class="${active}" href="#tabs-${tabId}">${tabName}</a> </li>`;
            contentManu = '';

            $.each(content, (key, val) => {
                var pId = val.pId;
                var exist = val.exist;
                var existHtml = (exist == 'yes') ? 'checked' : '';

                if (tabId == pId) {
                    var conName = val.name;
                    var conId = val.id;
                    contentManu += `<div class="form-group"><input ${existHtml} type="checkbox" name="accessId[]" id="access${conId}" value="${conId}"/> <label for="access${conId}">${conName}</label></div>`;
                }

            });
            contentManu = (contentManu == '') ? 'No Data' : contentManu;
            contentHtml += `<div class="item scrollBar ${active}" id="tabs-${tabId}">${contentManu}</div>`;
        });



        var html = `
        
        <div id="userAccessTabs">
            <ul>${tabHtml}</ul>

            <form id="tabsContentForm" >
                <input id="uid" name="uid" type="hidden" value="${uid}"/>
                ${contentHtml}
            </form>

        </div>
        
        `;

        showModalBox('Permissions', 'Save', html, 'userPermissionSave',);
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    });
}


function makeNoShowReservation(bid) {
    var data = `request_type=makeNoShowReservation&bid=${bid}`;
    ajax_request(data).done(function (response) {
        if (response == 1) {
            sweetAlert('done');
            $('#bookindDetail').removeClass('show');
            loadResorvation('all');
            loadRoomView();
        } else {
            sweetAlert('Sorry Something Went Wrong!', 'error')
        }


    });
}

function makeCancelReservation(bid) {
    var data = `request_type=makeCancelReservation&bid=${bid}`;
    ajax_request(data).done(function (response) {
        if (response == 1) {
            sweetAlert('done');
            $('#bookindDetail').removeClass('show');
            loadResorvation('all');
            loadRoomView();
        } else {
            sweetAlert('Sorry Something Went Wrong!', 'error')
        }


    });
}


function createUserDetailForm(uid = '') {
    var formData = `request_type=loadEditUserDetail&uid=${uid}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var userData = response.user;
        var role = response.role;
        var editRole = response.editRole;

        var name = (userData.name == undefined) ? '' : userData.name;
        var designation = (userData.designation == undefined) ? '' : userData.designation;
        var phone = (userData.phone == undefined) ? '' : userData.phone;
        var email = (userData.email == undefined) ? '' : userData.email;
        var name = (userData.name == undefined) ? '' : userData.name;
        var fullImgUrl = (userData.fullImgUrl == undefined) ? '' : userData.fullImgUrl;
        var bio = (userData.bio == undefined) ? '' : userData.bio;
        var uid = (userData.id == undefined) ? '' : userData.id;
        var shortName = (userData.displayName == undefined) ? '' : userData.displayName;
        var imageId = (userData.imageId == undefined) ? 0 : userData.imageId;
        var userRole = (editRole == undefined) ? 0 : editRole;

        var roleHtml = '';

        $.each(role, (key, val) => {
            var id = val.id;
            var name = val.name;
            var select = '';
            if (userRole == id) {
                select = "selected";
            }
            roleHtml += `<option ${select} value="${id}">${name}</option>`;
        });
        var checkAdmin = '';
        if (userRole != 1) {
            checkAdmin = 'disabled';
        }
        var selectTagOfRoles = ` <select name="role" id="role" class="customSelect" ${checkAdmin}>
                                    <option value="0">Select Role</option>
                                    ${roleHtml}
                                 </select>`;
        var userIdInputHtml = '';

        if (uid == '') {
            userIdInputHtml = `
                <div class="form-group col-md-6 col-sm-12">
                    <label for="userId">User Id</label>
                    <input name="userId" id="userId" type="text" class="form-control" value="">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="text" class="form-control" value="">
                </div>
            `;
        }


        var imgHtml = (imageId != 0) ? `<div class="dFlex aie"><div class="previewImg"><img src="${fullImgUrl}"><span data-accessid="${uid}" data-imgid="${imageId}" class="removeImg">X</span><input type="hidden" name="imgFile[]" value="${imageId}"></div>
                                                <div class="imgCon" style="width: 80%;"><label for="image">Image</label><input data-uid="${uid}" name="image" id="image" type="file" class="form-control" disabled=""></div>
                                            </div>` : `<div class="dFlex aie"><div class="imgCon" style="width: 100%;"><label for="image">Image</label><input data-uid="${uid}" name="image" id="image" type="file" class="form-control" ></div>
                                                        </div>`;

        var userIdHtml = (uid != '') ? `<input type="hidden" name="uerId" value="${uid}"/>` : '';

        var data = `
            <form id="personDetailForm" enctype= multipart/form-data>
                <div class="row">
                    <div class="form-group col-8">
                        <label for="name">Full Name</label>
                        <input name="name" id="name" type="text" class="form-control" value="${name}">
                    </div>
                    <div class="form-group col-4">
                        <label for="shortName">Short Name</label>
                        <input name="shortName" id="shortNameshortName" type="text" class="form-control" value="${shortName}">
                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="designation">Designation</label>
                        <input name="designation" id="designation" type="text" class="form-control" value="${designation}">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="role">Role</label>
                       ${selectTagOfRoles}
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="text" class="form-control" value="${email}">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="number">Number</label>
                        <input name="number" id="number" type="text" class="form-control" value="${phone}">
                    </div>
                    ${userIdHtml}
                    <div class="form-group col-12" style="podition:relative">
                    ${imgHtml}
                    </div>
                    ${userIdInputHtml}
                    <div class="form-group col-12">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" rows="5" class="form-control">${bio}</textarea>
                    </div>
                </div>
            </form>
        `;

        showModalBox('Personal details', 'Submit', data, 'submitPersonalDetailsBtn');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    });
}

function loadUsersData(uid = '', action = 'active') {
    var formData = `request_type=loadUsersData&uid=${uid}&action=${action}`;
    var loder = window.loaderSpinner;
    $('#loadUsersData').append(loder);
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        $('.spinner-box').remove();
        $('#loadUsersData').html(`<ul class="liDB">${response}</ul>`);
    });
}


function userDelete(uid) {
    var formData = `request_type=userDelete&uid=${uid}`;
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var status = response.status;
        var uid = response.uid;
        if (status == 'success') {
            loadUsersData();
            loadUserDetail(uid);
        }
    });
}



function reservationDetailPopUp(bookingId='', bdid='', rTab='', roomNumber='') {
    // $('#bookindDetail').addClass('show');
    // if(bookingId == ''){
    //     $('#bookindDetail').removeClass('show');
    //     $('#loadAddResorvation').show();
    //     loadAddResorvation('', 'roomView','','',roomNumber);
    // }else{
    //     showGuestDetailPopUp('', bookingId, '', '', rTab, bdid, '');
    // }
    
}


function loadPageLinkData() {
    var formData = `request_type=loadPageLinkData`;
    var loder = window.loaderSpinner;
    $('#loadPageLinkDetail').html(loder);
    ajax_request(formData).done((data) => {
        var response = JSON.parse(data);
        var aboutPage = response.aboutPage;
        var cancelPolicy = response.cancelPolicy;
        var contactPage = response.contactPage;
        var hotelPolicy = response.hotelPolicy;
        var refundPolicy = response.refundPolicy;

        var html = `
                    <form id="pageLinkDataForm" method="post">
                        <div class="form-group">
                            <label for="aboutPageLink">About Page</label>
                            <input type="text" class="form-control" name="aboutPageLink" placeholder="Enter about page link." id="aboutPageLink" value="${aboutPage}">
                        </div>
                        <div class="form-group">
                            <label for="contactPageLink">Contact Page</label>
                            <input type="text" class="form-control" name="contactPageLink" placeholder="Enter contact page link." id="contactPageLink" value="${contactPage}">
                        </div>
                        <div class="form-group">
                            <label for="hotelPolicyPageLink">Hotel Policy</label>
                            <input type="text" class="form-control" name="hotelPolicyPageLink" placeholder="Enter hotelPolicy page link." id="hotelPolicyPageLink" value="${hotelPolicy}">
                        </div>
                        <div class="form-group">
                            <label for="cancelPolicyPageLink">Cancel Policy</label>
                            <input type="text" class="form-control" name="cancelPolicyPageLink" placeholder="Enter cancelPolicy page link." id="cancelPolicyPageLink" value="${cancelPolicy}">
                        </div>
                        <div class="form-group">
                            <label for="refundPolicyPageLink">Refund Policy</label>
                            <input type="text" class="form-control" name="refundPolicyPageLink" placeholder="Enter refundPolicy page link." id="refundPolicyPageLink" value="${refundPolicy}">
                        </div>
                    
                        <input type="submit" value="Submit">
                    </form>
        `;

        $('#loadPageLinkDetail').html(html);
    });
}


function generateEmailSent(bid) {
    var data = {
        'bid': bid,
        'type': 'getGuestDetailsByBid'
    };
    $.ajax({
        url: webUrl + "/include/ajax/resorvation.php",
        type: 'post',
        data: data,
        success: function (data) {
            customModal('Guests', data);
        },
        error: function (error) {
            console.log(error);
        }
    });
}


function loadRevenueReport(sDate = '', eDate = '') {
    var data = `request_type=loadRevenueReport&startDate=${sDate}&endDate=${eDate}`;

    var skeleton = window.tableSkeleton;
    $('#loadRevenueReport').html(skeleton);
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);

        var headHtml = '';

        var html = '<table id="table-data-report-collections" class="table">';
        // var date = moment(val).format('DD-MMM');

        html += `
                    <thead>
                        <tr>
                            <th width="10%" style="text-align:left;">SL</th>
                            <th width="10%" style="text-align:center;">Booking Id</th>
                            <th width="10%" style="text-align:center;">Recipt No</th>
                            <th width="20%" style="text-align:center;">Guest Name</th>
                            <th width="10%" style="text-align:center;">Sub Total</th>
                            <th width="10%" style="text-align:center;">Gst</th>
                            <th width="20%" style="text-align:center;">Total Amount</th>                            
                            <th width="10% style="text-align:center;">Status</th>                            
                        </tr>
                    </thead>

                `;
        html += "<tbody>";
        var totalSubTotal = 0;
        var totalGst = 0;
        var totalFullPrice = 0;

        if (response.length > 0) {
            var count = 0;

            $.each(response, function (key, val) {
                count++;
                var bookinId = val.bookinId;
                var bussinessSource = val.bussinessSource;
                var reciptNo = val.reciptNo;
                var guestName = val.guestName;
                var totalAmount = val.totalAmount;
                var statusName = val.statusName;
                var statusBg = val.statusBg;
                var statusClr = val.statusClr;
                var subTotalPrice = val.subTotalPrice;
                var gstPrice = val.gstPrice;

                totalSubTotal += parseFloat(subTotalPrice);
                totalGst += parseFloat(gstPrice);
                totalFullPrice += parseFloat(totalAmount);

                var occupayHtml = '';

                html += `<tr>
                            <td style="text-align: left; color:var(--pClr); padding: 0 1.5rem;">${count}</td>
                            <td style="text-align: center;">${bookinId}</td>
                            <td style="text-align: center;">${reciptNo}</td>
                            <td style="text-align: center;">${guestName}</td>
                            <td style="text-align: center;">${subTotalPrice}</td>
                            <td style="text-align: center;">${gstPrice}</td>
                            <td style="text-align: center;">${totalAmount}</td>
                            <td style="text-align: center; background: ${statusBg}; color: ${statusClr}">${statusName}</td>
                        </tr>`;
            });
        } else {
            html += `<tr>
                        <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
        }
        //Jquery Code written by Abinash
        var footerHtml = '';
        var lastforecasthtml = '';
        var summaryHeading = `<small style="font-weight:bold;">${" " + sDate + " "} to ${" " + eDate}</small>`;

        html += "</tbody>";

        html += `
                        <tfood>
                            <tr style="border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                                <th colspan="4" style="text-align:center;">Total</th>
                                <th style="text-align:center;">${totalSubTotal}</th>
                                <th style="text-align:center;">${totalGst}</th>
                                <th style="text-align:center;">${totalFullPrice}</th>                            
                                <th style="text-align:center;"></th>                            
                            </tr>
                        </tfoot>

                `;


        html += "</table>";


        $('#loadRevenueReport').html(html);


    });
}


function generateGuestListById(bid,bdid){
    var data = `request_type=generateGuestListById&bid=${bid}&bdid=${bdid}`;
    ajax_request(data).done(function (request) {        
        var response = JSON.parse(request);
        var guestListHtml = '';
        $.each(response, (key,val)=>{
            var name = (val.name == undefined) ? '' : val.name;
            var email = (val.email == undefined) ? '' : val.email;
            var phone = (val.phone == undefined) ? '' : val.phone;
            var profileImgFull = (val.profileImgFull == undefined) ? '' : val.profileImgFull;
            var varifyImgFull = (val.varifyImgFull == undefined) ? '' : val.varifyImgFull;
            var varifyFileName = (val.varifyFileName == undefined) ? '' : val.varifyFileName;
            var kyc_number = (val.kyc_number == undefined) ? '' : val.kyc_number;
            var gid = (val.id == undefined) ? '' : val.id;
            var bookId = (val.bookId == undefined) ? '' : val.bookId;
            var bookingdId = (val.bookingdId == undefined) ? '' : val.bookingdId;
            
            guestListHtml += `
                <div class="guestContent">
                    <button onclick="loadAddGuestReservationForm(${bookId}, '#addGestOnReservation .content', ${bookingdId}, ${gid})" class="editBtn"></button>
                    <div class="imgArea">
                        <img src="${profileImgFull}" alt="">
                    </div>
                    <div class="textArea">
                        <h4>${name}</h4>
                        <span>${phone}</span>
                        <span>${email}</span>
                        <div class="identyField">
                            <img src="${varifyImgFull}" alt="">
                            <div class="identyText">
                                <h4>${varifyFileName}</h4>
                                <span>${kyc_number}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        var html =`<div class="guestDetailconGroup">
                    ${guestListHtml}
                </div>`;

        customModal('Guest Detail',html);
    });
}


function loadUnsettledFolioReport(){
    var data = `request_type=loadUnsettledFolioReport`;
    var skeleton = window.tableSkeleton;
    $('#loadTodayEventReport').html(skeleton);
    
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var tableBody = '';

        var tableHead = `
            <tr>
                <th width="15%" style="text-align:center;">Folio #</th>
                <th width="15%">Reservation #</th>
                <th width="20%">Guest Name</th>
                <th width="15%">Check In</th>
                <th width="15%">Check Out</th>
                <th width="10%">Status</th>
            </tr>
        `;

        if (response.length > 0) {
            $.each(response, function (key, val) {
                var bid = val.id;
                var folioVoucher = val.folioVoucher;
                var reseNo = val.reseNo;
                var guestName = val.guestName;
                var checkIn = val.checkIn;
                var checkOut = val.checkOut;
                var folioName = val.folioName;
                var folioClr = val.folioClr;
                var folioBg = val.folioBg;
                var reseLink = webUrl+'reservation-edit?id='+bid;

                tableBody += `<tr>
                    <td style="text-align: center;"><button class="transBtn" style="color:${folioClr};" onclick="loadQuickFolio(${bid})">${folioVoucher}</button></td>
                    <td style="text-align: center;"><a href="${reseLink}">${reseNo}</a></td>                    
                    <td style="text-align: center;">${guestName}</td>
                    <td style="text-align: center;">${checkIn}</td>
                    <td style="text-align: center;">${checkOut}</td>
                    <td style="text-align: center;"><span class="spanBtn" style="border-color:${folioBg};color: ${folioClr};"><div class="bg" style="background:${folioBg};"></div>${folioName}</span></td>
                    </td>
                </tr>`;

            });
        } else {
            tableBody += `<tr>
                    <td colspan="8" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                </tr>`;
        }

        var html = '<table  id="tableStatusReport" class="table">';
        html += `<thead>${tableHead}</thead>`;

        html += `<tbody>${tableBody}</tbody>`;

        html += "</table>";


        $('#loadUnsettledFolio').html(html);



    });
}

function loadQuickFolio(bid){
    var data = `request_type=loadEditResturentReport&tab=bill&bid=${bid}`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);
        var bid = response.bid;
        var bookinId = response.bookinId;
        var totalAdult = response.totalAdult;
        var totalChild = response.totalChild;
        var totalGuest = totalAdult + totalChild;
        var bookingSource = response.bookingSource;
        var bookingref = response.bookingref;
        var checkIn = response.checkIn;
        var checkOut = response.checkOut;
        var addOn = response.addOn;
        var night = response.night;
        var totalPrice = response.totalPrice;
        var roomDetailArry = response.roomDetailArry;
        var paymentArry = response.paymentArry;
        var guestArray = response.guestArray;
        var existGuest = guestArray.length;
        var activityArry = response.activityArry;
        var reciptNo = generateNumber(response.reciptNo);
        var totalPrice = rupeesFormat(response.totalPrice);
        var userPay = (response.userPay == undefined) ? 0 : rupeesFormat(response.userPay);

        var totalRoom = roomDetailArry.length;

        var checkIntimer = moment(checkIn).format('DD-MMM');
        var checkOuttimer = moment(checkOut).format('DD-MMM');
        var addOntimer = moment(addOn).format('DD-MMM');
        var html = generateFolioContent(response.folio,bid,totalPrice,userPay,roomDetailArry,'no');

        customModal('Folio',html,'','80vw', '90vh');
    });
}

function loadAddLostAndFoundForm(type = 'lost', id = '') {
    var data = `request_type=loadAddLostAndFound&id=${id}`;
    var title = (type == 'lost') ? 'Lost Information' : 'Found Information';
    var keyType = (type == 'lost') ? 'Lost' : 'Found';
    var submitId = 'LostInformation';
    var currentDate = moment().format('MM/DD/YYYY');
    var foundHtml = '';

    if(type == 'found'){
        foundHtml = `
            <div class="col-12">
                <h4>Found Information</h4>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="whoFound">Who Found </label>
                    <input class="form-control" type="text" name="whoFound" id="whoFound" placeholder="Who Found">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="currentLocation">Current Location</label>
                    <input class="form-control" type="text" name="currentLocation" id="currentLocation" placeholder="Current Location">
                </div>
            </div>
        `;
    }


    ajax_request(data).done(function(request) {
        var response = JSON.parse(request);
        var roomNum = response.roomNum;
        var data = response.data;
        var roomHtml = '';

        $.each(roomNum, (key,val)=>{
            var roomId = val.id;
            var roomNo = val.roomNo;
            roomHtml += `<option value="${roomId}">${roomNo}</option>`;
        });

        var html = `
            <form id="addLostAndFoundForm" action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <h4>Item Information</h4>
                    </div>

                    <input type="hidden" name="type" id="type" value="${type}"/>

                    <div class="col-md-3">
                        <div class="form-group" id="lostDateField">
                            <label for="activityDate">${keyType} On <span class="requireSym">*</span></label>
                            <div class="inputLabel">
                                <input readonly class="form-control datePicker" type="text" name="activityDate" value="${currentDate}">
                                <div class="iconBox right"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="itemName">Item Name <span class="requireSym">*</span></label>
                            <input class="form-control" type="text" name="itemName" id="itemName" placeholder="Item Name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="itemColor">Item Color <span class="requireSym">*</span></label>
                            <input class="form-control" type="text" name="itemColor" id="itemColor" placeholder="Item Color">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="itemLocation">${keyType} Location <span class="requireSym">*</span></label>
                            <input class="form-control" type="text" name="itemLocation" id="itemLocation" placeholder="${keyType} Location">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="itemRoom">Room</label>
                            <select class="w100 customSelect" name="itemRoom" id="itemRoom">
                                <option value="0">Select</option>
                                ${roomHtml}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="itemValue">Item Value <span class="requireSym">*</span></label>
                            <div class="inputLabel">
                                <input class="form-control" type="number" name="itemValue" id="itemValue" placeholder="Item Value">
                                <div class="iconBox left"><i class="fas fa-rupee-sign"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h4>Complaint Information</h4>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="coName">Name <span class="requireSym">*</span></label>
                            <input class="form-control" type="text" name="coName" id="coName" placeholder="Name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="coPhone">Phone <span class="requireSym">*</span></label>
                            <input class="form-control" type="text" name="coPhone" id="coPhone" placeholder="Phone">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="coAdress">Address</label>
                            <input class="form-control" type="text" name="coAdress" id="coAdress" placeholder="Address">
                        </div>
                    </div>

                    ${foundHtml}

                    <div class="col-12">
                        <h4>Status</h4>
                    </div>

                    <div class="col-12">
                        <div class="form-check dib mR10">
                            <input class="form-check-input lostFoundRadio" type="radio" name="status" id="returned" value="return">
                            <label class="custom-control-label" for="returned">Returned</label>
                        </div>
                        <div class="form-check dib">
                            <input class="form-check-input lostFoundRadio" type="radio" name="status" id="discarded" value="discarded">
                            <label class="custom-control-label" for="discarded">Discarded</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="statusAdvance"></div>
                    </div>

                    <div class="col-12">
                        <label for="">Remark</label>
                        <textarea class="form-control" name="" id="" rows="5" placeholder="Remark"></textarea>
                    </div>


                </div>
                
            </form>
        `;
        

        showModalBox(title, 'Save', html, 'addLostAndFoundFormSubmit', 'modal-xl');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();


        $('#lostDateField input').datepicker({
            format: 'mm-dd-yyyy',
            endDate: '+0d',
            autoclose: true
        });
    });
}


function loadLostAndFound(){
    var data = `request_type=loadLostAndFound`;
    ajax_request(data).done(function (request) {
        var response = JSON.parse(request);

        var tableHead = `
            <tr>
                <th width="15%" style="text-align:center;">Status</th>
                <th width="15%">Date</th>
                <th width="20%">Who Found</th>
                <th width="15%">Item Name</th>
                <th width="15%">Item Color</th>
                <th width="10%">Location</th>
                <th width="10%">Room</th>
                <th width="10%"></th>
            </tr>
        `;

        var tableBody = '';

        if(response.length > 0){
            $.each(response, (key,val)=>{
                var activityDate = moment(val.activityDate).format('DD-MMM, YY');
                var status = (val.status == null) ? '' : val.status;
                var who_found = (val.who_found == null) ? '' : val.who_found;
                var item_name = val.item_name;
                var item_color = val.item_color;
                var lost_location = val.lost_location;
                var room = (val.room == 0) ? '' : val.room;
    
                var statusName = 'NaN';
                var statusBg = '';
                var statusClr = '';
    
                if(status == 'return'){
                    statusName = 'Returned';
                    statusBg = '#00b300';
                    statusClr = '#006300';
                }
    
                if(status == 'discarded'){
                    statusName = 'Discarded';
                    statusBg = '#2196F3';
                    statusClr = '#1565C0';
                }
    
                tableBody += `<tr>
                        <td style="text-align: center;">
                            <span style="border-color: ${statusBg}; color: ${statusClr};" class="spanBtn">
                                <div style="background: ${statusBg};" class="bg"></div>
                                ${statusName}
                            </span>
                        </td>
                        <td style="text-align: center;">${activityDate}</td>
                        <td style="text-align: center;">${who_found}</td>                    
                        <td style="text-align: center;">${item_name}</td>
                        <td style="text-align: center;">${item_color}</td>
                        <td style="text-align: center;">${lost_location}</td>
                        <td style="text-align: center;">${room}</td>
                        <td style="text-align: center;"></td>
                        </td>
                    </tr>`;
            })
    
        }else{
            tableBody += `<tr>
                        <td colspan="100%" style="text-align: center;">No Data</td>
                    </tr>`;
        }
        var html = `
                <table  id="tableStatusReport" class="table">
                    <thead>${tableHead}</thead>
                    <tbody>${tableBody}</tbody>
                </table>
        `;

        $('#loadLostAndFound').html(html);
    });
}

function submitTravelAgent(){
    
    var name = $("#travelagentname").val();
    var travelagentPhoneno = $('#travelagentPhoneno').val();
    var taConPerson = $('#taConPerson').val();

    
    if(name == ''){
        sweetAlert('Name is required','error');
    }else if(travelagentPhoneno == ''){
        sweetAlert('Phone no is required','error');
    }else if(taConPerson == ''){
        sweetAlert('Person name is required','error');
    }else{
        var formData = $('#travelagent-add-form').serialize();
        formData += '&type=add_travelagent';
    
        var requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData
        };
        var endpoint = webUrl+"/include/ajax/resorvation.php";
        fetch(endpoint, requestOptions).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        }).then(data => {
            var responce = JSON.parse(data);
            var lastId = responce.id;
            var name = responce.name;
            
            if (responce.status === 'success') {
                sweetAlert('Travel Agent Details Updated');
                $('#travelagent-add-form')[0].reset();
                $('#popUpModal').modal('hide');
                
                
                if (window.filePath == 'travel-agent') {
                    loadTravelAgent();
                }else if (window.filePath == 'walk-in'){
                    var html = `<option selected value="${lastId}">${name}</option>`;
                    $('#travelagent').append(html);
                }
                
            }else {
                sweetAlert('error', 'Sorry Something Went Wrong!')
            }
            
        }).catch(error => {
            console.log('Error:', error);
        });
    }

    
}

function addTravelAgentForm(id=''){
    var html = '';
    var data = `request_type=addTravelAgentForm&id=${id}`;
    var title = (id == '') ? 'Add Travel Agent' : 'Update Travel Agent';
    ajax_request(data).done(function(request) {
        var response = JSON.parse(request);
        var states = response.states;
        var data = response.data;
        
        var agentName = (data.agentName) ? data.agentName : '';
        var travelagentname = (data.travelagentname) ? data.travelagentname : '';
        var travelagentemail = (data.travelagentemail) ? data.travelagentemail : '';
        var travelagentAddress = (data.travelagentAddress) ? data.travelagentAddress : '';
        var travelagrntCity = (data.travelagrntCity) ? data.travelagrntCity : '';
        var travelagentCountry = (data.travelagentCountry) ? data.travelagentCountry : '';
        var travelagentPostCode = (data.travelagentPostCode) ? data.travelagentPostCode : '';
        var travelagentPhoneno = (data.travelagentPhoneno) ? data.travelagentPhoneno : '';
        var travelagentGstNo = (data.travelagentGstNo) ? data.travelagentGstNo : '';
        var travelagentcommission = (data.travelagentcommission) ? data.travelagentcommission : 0; 
        var travelaaagentGstonCommision = (data.travelaaagentGstonCommision) ? data.travelaaagentGstonCommision : 0;
        var travelaaagentTcs = (data.travelaaagentTcs) ? data.travelaaagentTcs : 0; 
        var travelaaagentTds = (data.travelaaagentTds) ? data.travelaaagentTds : 0; 
        var travelagentNote = (data.travelagentNote) ? data.travelagentNote : '';
        var travelagentState = (data.travelagentState) ? data.travelagentState : '';
        
        var statesHtml = '<option value="">Select ...</option>';
        let travelagentGroupHtml = '';
        
        $.each(states, (index,val)=>{
            var active = (val == travelagentState) ? 'selected' : '';
            statesHtml += `<option ${active} value="${val}">${val}</option>`;
        })
        
        $.each(response.group, (key,val)=>{
            var active = (val.id == response.group) ? 'selected' : '';
            travelagentGroupHtml += `<option ${active} value="${val.id}">${val.name}</option>`;
        })
        
        
        
        html =`
            <form action="" id="travelagent-add-form" autocomplete="off">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Name <span class="requireSym">*</span></label>
                            <input type="text" placeholder="Travel Agent Name" class="form-control" name="travelagentname" id="travelagentname" value="${agentName}">
                            <input name="actionId" type="hidden" value="${id}"/>
                            <ul id="travelDropDown" class="inputDropDown"></ul >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="taConPerson">Contact person Name<span class="requireSym">*</span></label>
                            <input type="text" placeholder="Contact person Name" class="form-control" name="taConPerson" id="taConPerson" value="${travelagentname}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="text" placeholder="Travel Agent Email" class="form-control" name="travelagentemail" value="${travelagentemail}">
                        </div>
                    </div>


                </div>

                <div class="row">
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">Group</label>
                            <select class="customSelect" name="travelagentGroup" id="travelagentGroup">
                                <option value="">Select Group</option>
                                ${travelagentGroupHtml}
                            </select>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">Address</label>
                            <input id="travelagentAddress" type="text" placeholder="Address" name="travelagentAddress" class="form-control" value="${travelagentAddress}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">City</label>
                            <input id="travelagrntCity" type="text" placeholder="City" name="travelagrntCity" class="form-control" value="${travelagrntCity}">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">State</label>
                            <select id="travelagentState" name="travelagentState" class="customSelect">
                                ${statesHtml}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Country</label>
                            <input id="travelagentCountry" type="text" name="travelagentCountry" placeholder="Country" class="form-control" value="${travelagentCountry}">
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <laabel class="control-label">Post Code</laabel>
                            <input id="travelagentPostCode" type="text" name="travelagentPostCode" placeholder="Post Code" class="form-control" value="${travelagentPostCode}">
                        </div>   
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Phone Number <span class="requireSym">*</span></label>
                            <input type="text" name="travelagentPhoneno" id="travelagentPhoneno" placeholder="eg:+91 ***** *****" class="form-control" value="${travelagentPhoneno}">
                        </div>
                    </div>
                
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="control-label">GST Number</label>
                        <input id="travelagentGstNo" type="text" class="form-control" placeholder="Enter Your Gst Number" name="travelagentGstNo" value="${travelagentGstNo}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Commission</label>
                            <input type="number" name="travelagentcommission" value="0" class="form-control" value="${travelagentcommission}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">GST On Commission</label>
                            <input type="number" class="form-control" value="0" name="travelaaagentGstonCommision" value="${travelaaagentGstonCommision}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">TCS</label>
                            <input type="number" class="form-control" value="0" name="travelaaagentTcs" value="${travelaaagentTcs}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">TDS</label>
                            <input type="number" class="form-control" value="0" name="travelaaagentTds" value="${travelaaagentTds}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="control-label">Notes</label>
                        <input type="text" class="form-control" placeholder="Enter Note" name="travelagentNote" value="${travelagentNote}">
                    </div>
                </div>

            </form>
        `;

        showModalBox(title, 'Save', html, 'addTravelAgentFormSubmit', 'modal-xl');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    })
}

function addCompanyForm(id=''){
    var html = '';
    var data = `request_type=addCompanyForm&id=${id}`;
    var title = (id == '') ? 'Add Company' : 'Update Company';
    ajax_request(data).done(function(request) {
        
        var response = JSON.parse(request);
        var states = response.states;
        var data = response.data;
        
        var orgId = (data.id) ? data.id : '';
        var name = (data.name) ? data.name : '';
        var orgConName = (data.orgConName) ? data.orgConName : '';
        var organisationAddress = (data.organisationAddress) ? data.organisationAddress : '';
        var organisationCity = (data.organisationCity) ? data.organisationCity : '';
        var organisationCountry = (data.organisationCountry) ? data.organisationCountry : '';
        var organisationDiscount = (data.organisationDiscount) ? data.organisationDiscount : 0; // assuming discount is numeric
        var organisationEmail = (data.organisationEmail) ? data.organisationEmail : '';
        var organisationGstNo = (data.organisationGstNo) ? data.organisationGstNo : '';
        var organisationNote = (data.organisationNote) ? data.organisationNote : '';
        var organisationNumber = (data.organisationNumber) ? data.organisationNumber : '';
        var organisationPostCode = (data.organisationPostCode) ? data.organisationPostCode : '';
        var organisationState = (data.organisationState) ? data.organisationState : '';
        var ratePlan = (data.ratePlan) ? data.ratePlan : '';
        var salesManager = (data.salesManager) ? data.salesManager : '';
        var designation = (data.designation) ? data.designation : '';
        var cpwhatsappNumber = (data.cpwhatsappNumber) ? data.cpwhatsappNumber : '';
        var cpPhoneNumber = (data.cpPhoneNumber) ? data.cpPhoneNumber : '';
        var orgType = (data.orgType) ? data.orgType : '';
        
        var rateList = '';
        var ratePlan = response.ratePlan;
        
        $.each(ratePlan, (key,val)=>{
            var name = val.srtcode;
            var id = val.id;
            rateList += `<option value="${id}">${name}</option>`;
        })
        
        var statesHtml = '<option value="">Select ...</option>';
        
        $.each(states, (index,val)=>{
            var active = (val == organisationState) ? 'selected' : '';
            statesHtml += `<option ${active} value="${val}">${val}</option>`;
        })

    html =`
        <form action="" id="organisationForm" autocomplete="off">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="organisationName" class="control-label">Name *</label>                     
                        <input type="text" placeholder="Organisation Name" class="form-control" name="organisationname" value="${name}" id="organisationName">
                        <input name="actionId" type="hidden" value="${id}"/>
                        <ul id="organisationDropDown" class="inputDropDown"></ul >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Org Type</label>                     
                        <input type="text" placeholder="Org Type" class="form-control" name="orgType" id="orgType" value="${orgType}">            
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Contact Person Name *</label>                     
                        <input type="text" placeholder="Contact person Name" class="form-control" name="oConPerName" id="orgConName" value="${orgConName}">            
                    </div>
                </div> 
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Email *</label>                     
                        <input type="text" placeholder="Organisation Email" class="form-control" name="organisationemail" id="organisationemail" value="${organisationEmail}">            
                    </div>
                </div>  


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">CP Designation</label>                     
                        <input type="text" placeholder="Enter Designation" class="form-control" name="designation" id="designation" value="${designation}">            
                    </div>
                </div>    

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="whatsappNumber" class="control-label">CP WhatsApp Number</label>                     
                        <input type="text" placeholder="Enter WhatsApp Number" class="form-control" name="cpwhatsappNumber" id="whatsappNumber" value="${cpwhatsappNumber}">            
                    </div>
                </div>    

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cpPhoneNumber" class="control-label">CP Phone Number</label>                     
                        <input type="text" placeholder="Enter Phone Number" class="form-control" name="cpPhoneNumber" id="cpPhoneNumber" value="${cpPhoneNumber}">            
                    </div>
                </div>    
            
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Address</label>                     
                        <input type="text" placeholder="Organisation Address" class="form-control" name="organisationaddress" value="${organisationAddress}">            
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">City</label>                     
                        <input type="text" placeholder="City" class="form-control" name="organisationcity" value="${organisationCity}">            
                    </div>
                </div>           
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">State</label>                     
                        <select id="organisationState" name="organisationState" class="customSelect">
                                ${statesHtml}
                        </select>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Country</label>                     
                        <input id="organisationCountry" type="text" placeholder="Country" class="form-control" name="organisationCountry" value="${organisationCountry}">
            
                    </div>
                </div>
            
            
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Post Code</label>                     
                        <input id="organisationPostCode" type="text" placeholder="Post Code" class="form-control" name="organisationPostCode" value="${organisationPostCode}">
            
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Office Phone Number</label>                     
                        <input type="text" placeholder="eg:+91 ***** *****" class="form-control" name="organisationNumber" value="${organisationNumber}">
            
                    </div>
                </div>
            
            
            </div>
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">GST Number</label>                     
                        <input type="text" id="gstNoField" placeholder="GST Number" class="form-control" name="organisationGstNo" value="${organisationGstNo}">
            
                    </div>
                </div>       
            </div>
            
            
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Rate Plan</label>       
            
                        <select class="form-control" name="rateplan" id="rateplan">                        
                        
                        <option value="0" select="selected">Select</option>   
                        <option value="1">EP</option>   <option value="2">CP</option>   <option value="3">MAP</option>   <option value="4">AP</option>                              
            
                        </select>
                        
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Sales Manager</label>                  
                        <input type="text" id="salesManager" placeholder="Sales Manager" class="form-control" name="salesManager" value="${salesManager}">
                    </div>
                </div>
            
            
            </div>
            
            
            
            
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Discount</label>       
                        <input type="number" placeholder="eg:5%" class="form-control" name="organisationDiscount" value="${organisationDiscount}">
                    </div>
                </div>
            
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label">Notes</label>                     
                                        
                        <input type="text" placeholder="note" class="form-control" name="organisationNote" value="${organisationNote}">
                                                    
            
                    
                
            
                    </div>
                </div>
            
            
            </div>
            
            
            
            
            </form>
        `;

        showModalBox(title, 'Save', html, 'submitOrganisation', 'modal-xl');
        var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
        myModal.show();
    })
}



function loadReportContainer(type,date = '', name = '') {
    var data = `request_type=loadReportContainer&type=${type}&name=${name}&date=${date}`;
    var skeleton = window.tableSkeleton;
    $('#loadReportContainer').html(skeleton);
    ajax_request(data).done(function(request) {
        var response = JSON.parse(request);
        var property = response.property;
        var title = response.title;
        var checkDate = response.checkDate;
        var responseData = response.data;

        var price1 = 0;
        var price2 = 0;
        var price3 = 0;
        

        var tableHead = '';
        var tableBody = '';
        
        tableHead += `<tr>
                        <td colspan="100%" style="text-align: left; ">
                            <ul>
                                <li class="dFlex aic jcsb">
                                    <span>${property}</span>
                                    <span>${title}</span>
                                </li>
                                <li class="db">
                                    <p><strong>As On Date</strong> ${checkDate} </p>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    `;

        if(type == 'complimentary-room'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Res #</th>
                    <th>Folio No</th>
                    <th>Room No</th>
                    <th>Guest</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Ref.</th>
                    <th>Nights</th>
                    <th>Pax</th>
                </tr>
            `;
        }else if(type == 'daily-refund'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Date</th>
                    <th>Receipt</th>
                    <th>Referance</th>
                    <th>Amount</th>
                    <th>User</th>
                    <th>Entered On</th>
                </tr>
            `;
        }else if(type == 'daily-revenue'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Guest Name</th>
                    <th>Room</th>
                    <th>Rate Type</th>
                    <th>Room Charges</th>
                    <th>Tax </th>
                    <th>Net </th>
                </tr>
            `;
        }else if(type == 'detail-revenue'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Sr. No</th>
                    <th>Guest Name</th>
                    <th>Source</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Night</th>
                    <th>Vouc No</th>
                    <th>Rate Type</th>
                    <th>Folio No</th>
                    <th>Room Price</th>
                    <th>Total</th>
                    <th>Commission</th>
                    <th>Total Revenue</th>
                </tr>
            `;
        }else if(type == 'expense-voucher'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Date</th>
                    <th>Voucher No</th>
                    <th>Bill To</th>
                    <th>Charge</th>
                    <th>Amount</th>
                    <th>Pay Method</th>
                    <th>User</th>
                </tr>
            `;
        }else if(type == 'folio-list'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Folio No</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Pax</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Charges</th>
                    <th>Tax</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </tr>
            `;
        }else if(type == 'guest-ledger'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Room No</th>
                    <th>Rate Type</th>
                    <th>Guest Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Advance</th>
                    <th>Balance B/F</th>
                    <th>Charges</th>
                    <th>Credits</th>
                    <th>Balance</th>
                </tr>
            `;
        }else if(type == 'house-status'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Unit/Room</th>
                    <th>Rate Type</th>
                    <th>Guest Name</th>
                    <th>Pax </th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Status</th>
                    <th>Availability</th>
                    <th>House Keeper</th>
                    <th>HK Remarks</th>
                </tr>
            `;
        }else if(type == 'police-inquiry-list'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Sr No</th>
                    <th>Master Folio</th>
                    <th>Status</th>
                    <th>Room No</th>
                    <th>Customer Personal Information</th>
                    <th>Purpose of Visit</th>
                    <th>Pax</th>
                    <th>Birth Date</th>
                    <th>No. of Days Stayed</th>
                    <th>Arrival Date & Time</th>
                    <th>Departure Date & Time</th>
                    <th>Coming From</th>
                    <th>Going To</th>
                </tr>
            `;
        }else if(type == 'revenue-by-room-type'){
            tableHead += `
                <tr>
                    <th style="text-align:center;">Rate Type</th>
                    <th>Room Nights</th>
                    <th>%</th>
                    <th>Room Revenue</th>
                    <th>%</th>
                    <th>ADR</th>
                    <th>%</th>
                    <th>PTD Room Revenue</th>
                    <th>%</th>
                    <th>PTD ADR</th>
                    <th>YTD Room Nights</th>
                    <th>%</th>
                    <th>YTD Room Revenue</th>
                    <th>%</th>
                    <th>YTD ADR</th>
                </tr>
            `;
        }else{
            tableHead += `
                <tr>
                    <th style="text-align:center;">Room</th>
                    <th>Res #</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Guest</th>
                    <th>Adult</th>
                    <th>Child</th>
                    <th>Company</th>
                    <th>User</th>
                </tr>
            `;
        }

        

        if (responseData.length > 0) {
            var sn = 0;
            $.each(responseData, function(key, val) {

                if(type == 'complimentary-room'){
                    var bookingref = val.bookingref;
                    var folioNumber = val.folioNumber;
                    var roomNum = val.room_number;
                    var bookinId = generateNumber(val.reciptNo);
                    var guestName = val.guestName;
                    var checkIn = val.checkIn;
                    var checkOut = val.checkOut;

                    var bookingref = val.bookingref;

                    var adult = val.adult;
                    var child = val.child;

                    var formatDate = moment(checkIn).format('DD-MMM');
                    var formatDate2 = moment(checkOut).format('DD-MMM');

                    var daysDifference = calculateNight(checkIn,checkOut);

                    tableBody += `<tr>
                                <td style="text-align: center; ">${bookinId}</td>
                                <td style="text-align: center; ">${folioNumber}</td>
                                <td style="text-align: center; ">${roomNum}</td>
                                <td style="">${guestName}</td>
                                <td style="">${formatDate}</td>
                                <td style="text-align: center; "> ${formatDate2}</td>
                                <td style="text-align: center; color:var(--pClr); "> ${bookingref}</td>
                                <td style="">${daysDifference}</td>
                                <td style="">${adult} / ${child}</td>
                            </tr>`;
                }else if(type == 'daily-refund'){
                    var modeHtml = val.modeHtml;
                    var addOn = val.addOn;
                    var referance = val.referance;
                    var amount = val.amount;
                    var addByName = val.addByName;
                    var statusUpdateOn = val.statusUpdateOn;
                    var statusUpdateRemark = val.statusUpdateRemark;
                    var billingNo = generateNumber(val.billingNo);

                    var addOnformatDate = moment(addOn).format('DD-MMM');
                    var statusUpdateOnformatDate = moment(statusUpdateOn).format('DD MMM YYYY h:mm A');

                    tableBody += `<tr>
                                    <td style="text-align: left; ">
                                        <ul>
                                            <li class="db"><strong>Payment Mode: ${modeHtml}</strong></li>
                                            <li class="db">${addOnformatDate}</li>
                                        </ul>
                                    </td>
                                    <td style="text-align: center; ">${billingNo}</td>
                                    <td style="text-align: center; ">${referance}</td>
                                    <td style="">Rs - ${amount}</td>
                                    <td style="">${addByName}</td>
                                    <td style="text-align: center; "> ${statusUpdateOnformatDate} </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: left;"><strong>Remark</strong> : ${statusUpdateRemark}</td> 
                                </tr>
                                `;
                }else if(type == 'daily-revenue'){
                    var guestName = val.guestName;
                    var room_number = val.room_number;
                    var roomPlanSrt = val.roomPlanSrt;
                    var roomPrice = val.roomPrice;
                    var gstPrice = val.gstPrice;
                    var totalPrice = val.totalPrice;
                    price1 += parseFloat(roomPrice);
                    price2 += parseFloat(gstPrice);
                    price3 += parseFloat(totalPrice);

                    tableBody += `<tr>
                                    <td style="text-align: center; ">${guestName}</td>
                                    <td style="text-align: center; ">${room_number}</td>
                                    <td style="">${roomPlanSrt}</td>
                                    <td style="">Rs ${roomPrice}</td>
                                    <td style="">Rs ${gstPrice}</td>
                                    <td style="text-align: center; color:var(--pClr);">Rs ${totalPrice} </td>
                                </tr>
                                `;
                }else if(type == 'detail-revenue'){
                    sn ++;
                    var guestName = val.guestName;
                    var source = val.source;
                    var checkIn = val.checkIn;
                    var checkOut = val.checkOut;
                    var night = calculateNight(checkIn,checkOut);
                    var voucherNumber = val.voucherNumber;


                    var room_number = val.room_number;
                    var roomPlanSrt = val.roomPlanSrt;
                    var roomPrice = val.roomPrice;
                    var gstPrice = val.gstPrice;
                    var totalPrice = val.totalPrice;
                    var folioId = val.folioId;
                    var commision = val.commision;
                    var subTotal = val.subTotal;

                    var checkInformatDate = moment(checkIn).format('DD-MMM');
                    var checkOutformatDate = moment(checkOut).format('DD-MMM');

                    price1 += parseFloat(roomPrice);
                    price2 += parseFloat(gstPrice);
                    price3 += parseFloat(totalPrice);

                    tableBody += `<tr>
                                    <td style="text-align: center;">${sn}</td>
                                    <td style="text-align: center;">${guestName}</td>
                                    <td style="text-align: center;">${source}</td>
                                    <td style="text-align: center;">${checkInformatDate}</td>
                                    <td style="text-align: center;">${checkOutformatDate}</td>
                                    <td style="text-align: center;">${night}</td>
                                    <td style="text-align: center;">${voucherNumber}</td>
                                    <td style="text-align: center;">${roomPlanSrt}</td>
                                    <td style="text-align: center;">${folioId}</td>

                                    <td style="text-align: center;">Rs ${roomPrice}</td>
                                    <td style="text-align: center;">Rs ${subTotal}</td>
                                    <td style="text-align: center;">Rs ${commision}</td>

                                    <td style="text-align: center; color:var(--pClr);">Rs ${totalPrice} </td>
                                </tr>
                                `;
                }else{
                    var roomNum = val.room_number;
                    var bookingMainId = val.bid;
                    var bookinId = generateNumber(val.reciptNo);
                    var checkIn = val.checkIn;
                    var checkOut = val.checkOut;
                    var adult = val.adult;
                    var child = val.child;
                    var gNmae = val.guestName;
                    var companyName = val.companyName;
                    var addByName = val.addByDName;

                    var formatDate = moment(checkIn).format('DD-MMM');
                    var formatDate2 = moment(checkOut).format('DD-MMM');

                    tableBody += `<tr>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${roomNum}</td>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${bookinId}</td>
                                <td style="text-align: center; background-color: rgb(255, 255, 255);">${formatDate}</td>
                                <td style="background-color: rgb(255, 255, 255);">${formatDate2}</td>
                                <td style="background-color: rgb(255, 255, 255);"><div class="dFlex aic jcc fdc">
                                    <span>${gNmae}</span>
                                </div></td>
                                <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);"> ${adult}</td>
                                <td style="text-align: center; color:var(--pClr); background-color: rgb(255, 255, 255);"> ${child}</td>
                                <td style="background-color: rgb(255, 255, 255);">${companyName}</td>
                                <td style="background-color: rgb(255, 255, 255);">${addByName}</td>
                            </tr>`;
                }                
            });

            price1 = price1.toFixed(2);
            price2 = price2.toFixed(2);
            price3 = price3.toFixed(2);

            if(type == 'daily-revenue'){
                tableBody += `<tr>
                                <td colspan="3" style="text-align: center; "><strong>Total</strong></td>
                                
                                <td style=""><strong>Rs ${price1}</strong></td>
                                <td style=""><strong>Rs ${price2}</strong></td>
                                <td style="text-align: "><strong>Rs ${price3}</strong></td>
                            </tr>
                            `;
            }
        } else {
            tableBody = `<tr>
                        <td colspan="100%" style="text-align: center; background-color: rgb(255, 255, 255);">No Data</td>
                    </tr>`;
        }


        html += "</tbody>";

        html += "</table>";

        var html = `
            <table id="table-data-report-collections" class="table">
                <thead>${tableHead}</thead>
                <tbody>${tableBody}</tbody>
            </table>
        `;


        $('#loadReportContainer').html(html);
    });
}


function activeProperty(hid){
    var data = `request_type=activeProperty&hid=${hid}`;
    ajax_request(data).done(function(request){
        location.reload();
    })
}

function pinChangeToFetch(e){
    e.preventDefault();
    // var parentDiv = e.target.closest('.row');
    // var blockDiv = parentDiv.querySelector('.block');
    // var districtDiv = parentDiv.querySelector('.district');
    // var stateDiv = parentDiv.querySelector('.state');
    
    // var value = e.target.value;
    // var numericInput = /^[0-9]+$/;

    // if (!numericInput.test(value)) {
    //     console.log('true');
    //     sweetAlert('Pin code should contain only digits.','error')
    //     e.target.value = ''; 
    //     blockDiv.value ='';
    //     districtDiv.value ='';
    //     stateDiv.value ='';
    // }else if(value.length > 6){
    //     sweetAlert('Pin code should be exactly 6 characters.','error');
    //     blockDiv.value ='';
    //     districtDiv.value ='';
    //     stateDiv.value ='';
    // } else {
    //     if (value.length === 6) {
    //         var data = `request_type=pinChangeToFetch&pinCode=${value}`;
    //         blockDiv.value = 'Loading...';
    //         districtDiv.value =  'Loading...';
    //         stateDiv.value = 'Loading...';

    //         ajax_request(data).done(function(request){
    //             var response = JSON.parse(request);
    //             var block = response.block;
    //             var district = response.district;
    //             var state = response.state;

    //             blockDiv.value =block;
    //             districtDiv.value =district;
    //             stateDiv.value =state;
    //         })
    //     }
    // }


}


function calculateTotal() {
    $("#roomDetailId tr").each(function() {
        var gstPercentage = parseInt($(this).find(".roomGst").val());
        var price = parseFloat($(this).find(".totalPriceSection").val());
        console.log(gstPercentage);
        console.log(price);
        var totalPriceWithGst = price + (price * gstPercentage / 100);

        $(this).find(".totalPriceWithGst").val(totalPriceWithGst.toFixed(2));
    });
}


function validateNumberField(inputField,num=10) {
    var mobileNumber = inputField.value.trim();
    var error = '';
    var counterDiv = inputField.parentElement.parentElement.querySelector('.charCount');
    var errorDiv = inputField.parentElement.parentElement.querySelector('.error');
    counterDiv.textContent = mobileNumber.length;

    if (mobileNumber === '') {
        error = 'Mobile number is required.';
    } else {
        if (!/^\d+$/.test(mobileNumber)) {
            error = 'Only numeric input is allowed.';
        } else {
            if (mobileNumber.length > num) {
                error = `Mobile number should be exactly ${num} digits.`;
            }
        }
    }
    errorDiv.textContent = error;
}


function checkNumber(inputField,num=10) {
    var mobileNumber = inputField.value.trim();
    var error = '';
    var counterDiv = inputField.parentElement.parentElement.querySelector('.charCount');
    var errorDiv = inputField.parentElement.parentElement.querySelector('.error');
    counterDiv.textContent = mobileNumber.length;

    if (mobileNumber === '') {
        error = 'Mobile number is required.';
    } else {
        if (!/^\d+$/.test(mobileNumber)) {
            error = 'Only numeric input is allowed.';
        } else {
            if (mobileNumber.length !== num) {
                error = `Mobile number should be exactly ${num} digits.`;
            }
        }
    }
    errorDiv.textContent = error;
}


function userAccessChange(userId,pageId,element){
    var value = element.value;
    var data = `request_type=userAccessChange&userId=${userId}&pageId=${pageId}&role=${value}`;

    ajax_request(data).done(function(request){
        var response = JSON.parse(request);
        
        if(response){
            sweetAlert('Successfully Update');
        }else{
            sweetAlert('Something went wrong!', 'error');
        }
    })
}

function getInputNameCheck(type,name,targetId,returnTargetId=''){
    
    if(name.length > 2){
        var data = `request_type=getInputNameCheck&name=${name}&type=${type}`;
        ajax_request(data).done(function(request) {
            var response = JSON.parse(request);
            let listHtml = '';
            
            if(response.length > 0){
                $.each(response, (key,val)=>{
                    let agentName = ''
                    if(type == 'travel_agents'){
                        agentName = val.agentName;
                    }
                    if(type == 'organisations'){
                        agentName = val.name;
                    }
                    const onClickAction = (returnTargetId == '') ? '' : `onclick="setValue('${returnTargetId}','${agentName}', '${targetId}', '${type}')"`;
                    listHtml += `<li ${onClickAction} >${agentName}</li>`;
                });
                $(`#${targetId}`).addClass('show');
            }else{
                $(`#${targetId}`).removeClass('show');
            }
            
            $(`#${targetId}`).html(listHtml);
            
        })
    }else{
        $(`#${targetId}`).removeClass('show');
    }
}

function setValue(targetId, setValue,actionId='',type = ''){
    var data = `request_type=setValue&type=${type}&type=${type}&setValue=${setValue}`;

    ajax_request(data).done(function(request) {
        var response = JSON.parse(request);
        var responseData = response[0];
        let listHtml = '';

        $(`#${targetId}`).val(`${setValue}`);
        if(actionId != ''){
            $(`#${actionId}`).removeClass('show');
        }

        if(type == 'travel_agents'){
            let travelagentState = responseData.travelagentState;
            let travelagentCountry = responseData.travelagentCountry;
            let travelagentPostCode = responseData.travelagentPostCode;
            $('#travelagentState').val(travelagentState).attr('selected', true);
            $('#travelagentCountry').val(travelagentCountry);
            $('#travelagentPostCode').val(travelagentPostCode);
        }

        if(type == 'organisations'){
            let organisationCountry = responseData.organisationCountry;
            let organisationState = responseData.organisationState;
            let organisationPostCode = responseData.organisationPostCode;

            $('#organisationState').val(organisationState).attr('selected', true);
            $('#organisationCountry').val(organisationCountry);
            $('#organisationPostCode').val(organisationPostCode);
        }

        
        
    })

    
}


