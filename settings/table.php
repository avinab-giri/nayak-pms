<?php

include ('../include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();

$hotelId = $_SESSION['HOTEL_ID'];

$backLink = FRONT_SITE;
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''){
    $backLink = $_SERVER['HTTP_REFERER'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Table</title>

    <?php  include(FO_SERVER_SCREEN_PATH.'link.php');?>

    

</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH.'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH.'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <section id="setupSection">
            <div class="setupLeftSide">
                <?php include(FO_SERVER_SCREEN_PATH.'setupNav.php') ?>
            </div>
            <div class="setupRightSide">
                <div class="innerLink">
                    <ul class="innerNav">
                        <li class="item active"><a href="<?= FRONT_SITE.'/settings/table' ?>">Table</a></li>
                    </ul>
                </div>
                <div class="detailView scrollBar">
                    <div class="servicesArea">
                        <div id="loadTable" class="kotTable_box"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    
    <div class="itemContent">
        <div class="icon"></div>
        <h4></h4>
    </div>

    <?php
        include(FO_SERVER_SCREEN_PATH.'booing_detail.php');
        include(FO_SERVER_SCREEN_PATH.'script.php');    
    ?>

    <script>

        $('.posNav').addClass('active');
        $('.posNav .table').addClass('active');

        function loadKotTable($serviceId = '') {
            var serviceId = $serviceId;
            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/kot.php' ?>",
                type: 'post',
                data: {
                    type: 'loadKotTableList',
                    serviceId: serviceId
                },
                success: function(data) {

                    var response = JSON.parse(data);
                    var restaurant = response.restaurant;
                    var table = response.table;

                    if (restaurant.length > 0) {
                        var dasable = '';
                        var alertText = "";
                    } else {
                        var alertText = "Please <button id='alertAddResBtn'>add a restaurant</button> then add a table";
                        var dasable = 'disable';
                    }

                    var resList = '';
                    var displayData = '';
                    $.each(restaurant, function(key, val) {
                        var id = val.id;
                        var name = val.name;
                        var select = (key == 0) ? 'selected' : '';
                        resList += `<option ${select} value="${id}">${name}</option>`;
                        
                        var tableHtml = '';
                        console.log(table.filter(v => v.resId === id));
                        $.each(table.filter(v => v.resId === id), function(tkey, tval) {
                            var id = tval.id;
                            var tableNum = tval.tableNum;
                            tableHtml += `<li class="dib alert alert-secondary text-white mr5">${tableNum}</li>`;
                        })

                        displayData += `
                            <div class="db">
                                <h6 class="db">${name}</h6>
                                <ul class="db">${tableHtml}</ul> 
                            </div>
                        `;
                    });


                    var html = `
                            ${alertText}
                            <h4>Add Table</h4>                        
                            
                            <form class="${dasable}" action="">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="kotTableInput">Table Number</label>
                                            <input class="form-control" type="number" id="kotTableInput" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group">
                                            <label for="tableNum">Restaurant</label>
                                            <select name="choseRes" class="customControl" id="choseRes" style="height:3rem;">
                                                ${resList}
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                         <div class="form-group">
                                         <label for="tableNum" style="height:24px;"></label>
                                             <button id="addTableForKotBtn" class="customControl btn bg-gradient-dark mb-0 text-center" style="width:50%">Add</button>
                                         </div>
                                    </div>
                                   
                                </div>
                            </form>

                            <div id="loadKotTableData">
                                ${displayData}
                            </div>
                        `;



                    $('.kotTable_box').html(html);
                }
            });
        }

        $(document).ready(()=>{
            loadKotTable(1);
        });
        
    </script>

</body>

</html>