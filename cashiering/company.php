<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');


checkLoginAuth();
checkProductExistOrNot([1], 14);
$hotelName = hotelDetail()['hotelName'];
$beSourceId = 2;

$currentDate = date('m/d/Y');
$nextDate = date('m/d/Y', strtotime("+1 day"));

if (isset($_GET['sdate'])) {
    $currentDate = $_GET['sdate'];
}

if (isset($_GET['edate'])) {
    $nextDate = $_GET['edate'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Company Database</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container">

            <?php echo backNavbarUi('', 'Company Database'); ?>

            <div style="height: 85vh;overflow: hidden;" class="card">
                <div class="card-head dFlex jcsb aic">
                    <div class="leftSide">
                        <?= cashNavHtml('company') ?>
                    </div>
                    <div class="rightSide">
                        <input class="customInput" id="companySearchFilter" placeholder="Search name"/>
                        <select class="customInput" id="companyStatesFilter">
                            <option value=''>Select States</option>
                            <?php
                                foreach(getStatesOfIndia() as $val){
                                    echo "<option value='$val'>$val</option>";
                                }
                            ?>
                        </select>
                        <a class="mb-0 btn btn-info" href="javascript:void(0)" onclick="addCompanyForm()">Add Company</a>
                        <?php
                        
                            if(fetchData('hoteluser', ['id' => $_SESSION['ADMIN_ID']])[0]['role'] == 1){
                                echo '<button onclick="exportFile()" class="btn btn-outline-secondary m-0">Export</button>';
                            }

                        ?>
                    </div>
                </div>
                <div style="padding-top: 0;" class="card-body">
                    <div id="loadCompanyDataBase"></div>
                </div>
            </div>

        </div>


        </div>

        </div>


    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>



    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>

    <table id="exportCompanyTable" style="display: none;"></table>

    <script>
        $('.linkBtn').removeClass('active');
        $('.cashingLink').addClass('active');
        
        function exportFile() {
            var currentDate = new Date();
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1;
            $('#exportCompanyTable').table2excel({
                exclude: ".no-export",
                filename: `company-${day}-${month}.xls`,
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: true
            });
        }

        function loadCompanyDataBase(search='',state='') {
            var data = `request_type=loadCompanyDataBase&search=${search}&state=${state}`;
            $('#loadCompanyDataBase').html(window.tableSkeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);
                
                $('#loadCompanyDataBase').html(window.tableSkeleton);
                
                var tableHead = `
                    <tr>
                        <th width="15%" style="text-align:center;">Company</th>
                        <th width="15%">Contact Person</th>
                        <th width="20%">State</th>
                        <th width="15%">Phone</th>
                        <th width="15%">Email</th>
                        <th width="10%">Balance(Rs)	</th>
                        <th></th>
                    </tr>
                `;

                let exportTableHead = `
                    <tr>
                        <th style="text-align:center;">Company</th>
                        <th>Contact Person</th>
                        <th>CP Phone Number</th>
                        <th>CP Whatsapp Number</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Post Code</th>
                        <th>Office Phone Number</th>
                        <th>GST Number</th>
                        <th>Rate Plan</th>
                        <th>Sales Manager</th>
                        <th>Discount</th>
                        <th>Notes</th>
                    </tr>
                `;

                var tableBody = '';
                let exportTableBody = '';

                if(response != null && response.length > 0){
                $.each(response, (key, val) => {
                    var companyId = val.id;
                    var name = val.name;
                    var orgConName = val.orgConName;
                    var organisationEmail = val.organisationEmail;
                    var cpwhatsappNumber = val.cpwhatsappNumber;
                    var cpPhoneNumber = val.cpPhoneNumber;
                    var designation = val.designation;

                    var organisationAddress = val.organisationAddress;
                    var organisationCity = val.organisationCity;
                    var organisationState = val.organisationState;
                    var organisationCountry = val.organisationCountry;
                    var organisationPostCode = val.organisationPostCode;
                    var organisationNumber = val.organisationNumber;
                    var organisationGstNo = val.organisationGstNo;
                    var ratePlan = val.ratePlan;
                    var salesManager = val.salesManager;
                    var organisationDiscount = val.organisationDiscount;
                    var organisationNote = val.organisationNote;
                    var balance = rupeesFormat(val.balance);                    

                    tableBody += `<tr>
                        <td style="text-align: center;">${name}</td>
                        <td style="text-align: center;">${orgConName}</td>
                        <td style="text-align: center;">${organisationState}</td>
                        <td style="text-align: center;">${organisationNumber}</td>
                        <td style="text-align: center;">${organisationEmail}</td>
                        <td style="text-align: center;">${balance}</td>
                        <td>
                            <a class="tableIcon update bg-gradient-info" onclick="addCompanyForm(${companyId})" data-page="guest" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a>
                        </td>
                    </tr>`;

                    exportTableBody += `<tr>
                        <td style="text-align: center;">${name}</td>
                        <td style="text-align: center;">${orgConName}</td>
                        <td style="text-align: center;">${cpPhoneNumber}</td>
                        <td style="text-align: center;">${cpwhatsappNumber}</td>
                        <td style="text-align: center;">${organisationEmail}</td>
                        <td style="text-align: center;">${designation}</td>
                        <td style="text-align: center;">${organisationAddress}</td>
                        <td style="text-align: center;">${organisationCity}</td>
                        <td style="text-align: center;">${organisationState}</td>
                        <td style="text-align: center;">${organisationCountry}</td>
                        <td style="text-align: center;">${organisationPostCode}</td>
                        <td style="text-align: center;">${organisationNumber}</td>
                        <td style="text-align: center;">${organisationGstNo}</td>
                        <td style="text-align: center;">${ratePlan}</td>
                        <td style="text-align: center;">${salesManager}</td>
                        <td style="text-align: center;">${organisationDiscount}</td>
                        <td style="text-align: center;">${organisationNote}</td>
                    </tr>`;


                    })
                }else{
                    tableBody += `<tr>
                        <td colspan="100%" style="text-align: center;">No Data</td>
                    </tr>`;
                    exportTableBody += `<tr>
                        <td colspan="100%" style="text-align: center;">No Data</td>
                    </tr>`;
                }

                var html = `
                <table  id="tableStatusReport" class="table">
                    <thead>${tableHead}</thead>
                    <tbody>${tableBody}</tbody>
                </table>
                `;

                let exportHtml = `
                    <thead>${exportTableHead}</thead>
                    <tbody>${exportTableBody}</tbody>
                `;

                $('#loadCompanyDataBase').html(html);
                $('#exportCompanyTable').html(exportHtml);
            });
        }

        $(document).ready(function(){
            // loadCompanyDataBase();
            
            
            $('#companySearchFilter').on('keyup', function(){
                var value = $(this).val();
                loadCompanyDataBase(value);
            });
            
            $('#companyStatesFilter').on('change', function(){
                var value = $(this).val();
                loadCompanyDataBase('',value);
            });
            
        });
    </script>

</body>

</html>