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

    <title>POS</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container">

            <?php echo backNavbarUi('', 'POS'); ?>

            <div style="height: 85vh;overflow: hidden;" class="card">
                <div class="card-head dFlex jcsb aic">
                    <div class="leftSide">
                        <?= cashNavHtml('pos') ?>
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



    <script>
        $('.linkBtn').removeClass('active');
        $('.cashingLink').addClass('active');

        function loadCompanyDataBase() {
            var data = `request_type=loadCompanyDataBase`;
            ajax_request(data).done(function(request) {
                var response = JSON.parse(request);

                var tableHead = `
                    <tr>
                        <th width="15%" style="text-align:center;">Invoice #</th>
                        <th width="15%">Table / Room</th>
                        <th width="20%">Guest Name</th>
                        <th width="10%">Balance(Rs)	</th>
                    </tr>
                `;

                var tableBody = '';

                $.each(response, (key, val) => {
                    
                    var name = val.name;
                    var organisationCountry = val.organisationCountry;
                    var organisationEmail = val.organisationEmail;
                    var organisationNumber = val.organisationNumber;
                    var balance = rupeesFormat(val.balance);

                    var statusName = 'Active';
                    var statusBg = '#00b300';
                    var statusClr = '#006300';

                    tableBody += `<tr>
                        <td style="text-align: center;">${name}</td>
                        <td style="text-align: center;">${name}</td>
                        <td style="text-align: center;">${organisationCountry}</td>
                        <td style="text-align: center;">${organisationNumber}</td>
                        <td style="text-align: center;">${organisationEmail}</td>
                        <td style="text-align: center;">
                            <span style="border-color: ${statusBg}; color: ${statusClr};" class="spanBtn">
                                <div style="background: ${statusBg};" class="bg"></div>
                                ${statusName}
                            </span>
                        </td>
                        <td style="text-align: center;">${balance}</td>
                        </td>
                    </tr>`;
                    })

                var html = `
                <table  id="tableStatusReport" class="table">
                    <thead>${tableHead}</thead>                    
                </table>
                `;

                $('#loadCompanyDataBase').html(html);
            });
        }
        
        // <tbody>${tableBody}</tbody>
        $(document).ready(function(){
            loadCompanyDataBase();
        });
    </script>

</body>

</html>