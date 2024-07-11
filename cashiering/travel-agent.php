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

    <title>Travel Agent</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid">

            <?php echo backNavbarUi('', 'Travel Agent'); ?>

            <div style="height: 85vh;overflow: hidden;" class="card">
                <div class="card-head dFlex aic jcsb">
                    <div class="leftSide">
                        <?= cashNavHtml('travel-agent') ?>
                    </div>
                    <div class="rightSide">
                        <input class="customInput" id="travelSearchFilter" placeholder="Search name"/>
                        <select class="customInput" id="travelGroupFilter">
                            <option value=''>Select Group</option>
                            <?php
                                foreach(fetchData('travelagentgroup') as $val){
                                    $groupName = $val['name'];
                                    $groupId = $val['id'];
                                    echo "<option value='$groupId'>$groupName</option>";
                                }
                            ?>
                        </select>
                        <select class="customInput" id="travelStatesFilter">
                            <option value=''>Select States</option>
                            <?php
                                foreach(getStatesOfIndia() as $val){
                                    echo "<option value='$val'>$val</option>";
                                }
                            ?>
                        </select>
                        <a class="mb-0 btn btn-info" href="javascript:void(0)" onclick="addTravelAgentForm()"> Add Travel Agent</a>
                        
                        <?php
                        
                            if(fetchData('hoteluser', ['id' => $_SESSION['ADMIN_ID']])[0]['role'] == 1){
                                echo '<button onclick="exportFile()" class="btn btn-outline-secondary m-0">Export</button>';
                            }

                        ?>
                    </div>
                </div>
                <div style="padding-top: 0;" class="card-body">
                    <div id="loadTravelAgent"></div>
                </div>
            </div>

        </div>


        </div>

        </div>


    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>



    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>


    <table id="exportTravelAgentTable" style="display: none;">

    </table>


    <script>
        $('.linkBtn').removeClass('active');
        $('.cashingLink').addClass('active');
        
        function exportFile() {
            var currentDate = new Date();
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1;
            $('#exportTravelAgentTable').table2excel({
                exclude: ".no-export",
                filename: `travel-${day}-${month}.xls`,
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: true
            });
        }


        function loadTravelAgent(search='',state='',group='') {
            var data = `request_type=loadTravelAgent&search=${search}&state=${state}&group=${group}`;
            $('#loadTravelAgent').html(window.tableSkeleton);
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                let  exportTableHead = `
                    <tr>
                        <th style="text-align:center;">Agent Name</th>
                        <th>Group</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Post Code</th>
                        <th>Phone Number</th>
                        <th>GST Number</th>
                        <th>Commission</th>
                        <th>GST On Commission</th>
                        <th>TCS</th>
                        <th>TDS</th>
                        <th>Notes</th>
                        <th>Balance(Rs)	</th>
                    </tr>
                `;

                let tableHead = `
                    <tr>
                        <th width="15%" style="text-align:center;">Agent Name</th>
                        <th width="15%">Group</th>
                        <th width="15%">Name</th>
                        <th width="10%">State</th>
                        <th width="15%">Phone</th>
                        <th width="15%">Email</th>
                        <th width="10%"></th>
                        <th width="5%"></th>
                    </tr>
                `;

                var tableBody = '';
                let exportTableBody = '';

                if(response != null && response.length > 0){
                    $.each(response, (key, val) => {
                    var agentId = val.id;
                    var agentName = val.agentName;
                    var travelagentname = val.travelagentname;
                    var travelagentState = val.travelagentState;
                    var travelagentPhoneno = val.travelagentPhoneno;
                    var travelagentemail = val.travelagentemail;
                    
                    let travelaaagentGstonCommision = val.travelaaagentGstonCommision;
                    let travelaaagentTcs = val.travelaaagentTcs;
                    let travelaaagentTds = val.travelaaagentTds;
                    let travelagentAddress = val.travelagentAddress;
                    let travelagentCountry = val.travelagentCountry;
                    let travelagentGstNo = val.travelagentGstNo;
                    let travelagentNote = val.travelagentNote;
                    let travelagentPostCode = val.travelagentPostCode;
                    let travelagrntCity = val.travelagrntCity;
                    let travelagentcommission = val.travelagentcommission;


                    var groupName = val.groupName;
                    var balance = rupeesFormat(val.balance);
                    var group = '';

                    var statusName = 'Active';
                    var statusBg = '#00b300';
                    var statusClr = '#006300';

                    tableBody += `<tr>
                        <td style="text-align: center;">${agentName}</td>
                        <td style="text-align: center;">${groupName}</td>
                        <td style="text-align: center;">${travelagentname}</td>
                        <td style="text-align: center;">${travelagentState}</td>
                        <td style="text-align: center;">${travelagentPhoneno}</td>
                        <td style="text-align: center;">${travelagentemail}</td>
                        <td style="text-align: center;">${balance}</td>
                        </td>
                        <td>
                            <a class="tableIcon update bg-gradient-info" onclick="addTravelAgentForm(${agentId})" data-page="guest" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a>
                        </td>
                    </tr>`;

                    exportTableBody += `<tr>
                        <td style="text-align: center;">${agentName}</td>
                        <td style="text-align: center;">${groupName}</td>
                        <td style="text-align: center;">${travelagentname}</td>
                        <td style="text-align: center;">${travelagentemail}</td>
                        <td style="text-align: center;">${travelagentAddress}</td>
                        <td style="text-align: center;">${travelagrntCity}</td>
                        <td style="text-align: center;">${travelagentCountry}</td>
                        <td style="text-align: center;">${travelagentPostCode}</td>
                        <td style="text-align: center;">${travelagentPhoneno}</td>
                        <td style="text-align: center;">${travelagentcommission}</td>
                        <td style="text-align: center;">${travelaaagentGstonCommision}</td>
                        <td style="text-align: center;">${travelaaagentTcs}</td>
                        <td style="text-align: center;">${travelaaagentTds}</td>
                        <td style="text-align: center;">${travelagentNote}</td>
                        <td style="text-align: center;">${balance}</td>
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
                </table>`;

                let exportHtml = `
                    <thead>${exportTableHead}</thead>
                    <tbody>${exportTableBody}</tbody>`;

                $('#loadTravelAgent').html(html);
                $('#exportTravelAgentTable').html(exportHtml);
            });
        }

        $(document).ready(function(){
            // loadTravelAgent();
            
            
            $('#travelSearchFilter').on('keyup', function(){
                var value = $(this).val();
                loadTravelAgent(value);
            });
            
            $('#travelStatesFilter').on('change', function(){
                var value = $(this).val();
                loadTravelAgent('',value);
            });

            $('#travelGroupFilter').on('change', function(){
                var value = $(this).val();
                loadTravelAgent('','',value);
            });
            
        });
    </script>

</body>

</html>