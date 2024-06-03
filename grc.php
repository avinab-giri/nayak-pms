<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

$bid = $_GET['id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRC Form</title>
</head>
<body>
    
    <?= generateDownloadInvoice('blankGRC', $bid) ?>

    <a id="btnPrint" onclick="Print();" style="display: block; padding: 5px 10px; background-color: rgb(34, 186, 160); width: 40px; text-align: center; color: rgb(255, 255, 255); margin-top: 10px; cursor: pointer; float: left; clear: both;">Print</a>
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