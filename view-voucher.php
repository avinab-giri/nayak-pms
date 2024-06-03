<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH . 'svg.php');

$bid = '';

if (isset($_GET['id'])) {
    $bid = $_GET['id'];
    $type = (isset($_GET['type'])) ? $_GET['type'] : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>
    <style>
        p {
            margin: 0;
        }
        body{
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="content" style="max-width: 1280px;margin: 0 auto;">
        <?= orderEmail2($bid,$type) ?>
        <a id="btnPrint" onclick="Print();" style="display: block; padding: 5px 10px; background-color: rgb(34, 186, 160); width: 40px; text-align: center; color: rgb(255, 255, 255); margin-top: 10px; cursor: pointer; float: left; clear: both;">Print</a>
    </div>

    <script>
        function Print() {
            document.getElementById("btnPrint").style.display = "none";
            window.print();
            document.getElementById("btnPrint").style.display = "block";
        }
    </script>
    <script>
        setTimeout(Print, 1000);
    </script>
</body>

</html>