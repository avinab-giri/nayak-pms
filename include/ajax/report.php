<?php
    
    include ('../constant.php');
    include (SERVER_INCLUDE_PATH.'db.php');
    include (SERVER_INCLUDE_PATH.'function.php');

    if(isset($_POST['type'])){
        $type = $_POST['type'];
    }else{
        $type = '';
    }

    if($type == 'graph'){
        $reportBy = $_POST['reportBy'];
        $filterType = $_POST['filterType'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];


        function loadDetail($type='',$toatalData,$toatalData2){
            $html = '
            
                    <table class="reportTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PMS</td>
                                <td>Rs '.number_format($toatalData).'</td>
                            </tr>
                            <tr>
                                <td>BE</td>
                                <td>Rs '.number_format($toatalData2).'</td>
                            </tr>

                            <tr>
                                <td>Total</td>
                                <td>Rs '.number_format($toatalData + $toatalData2).'</td>
                            </tr>
                            
                        </tbody>
                    </table>
            
            ';

            return $html;
        }

        $toatalData = 0;
        $toatalData2 = 0;

        $toatalDataCount = 0;
        $toatalData2Count = 0;

        if($reportBy == 'bookingDate'){
            if($filterType == 'customDate'){
                $night = getNightByTwoDates($startDate,$endDate);
                for($i = 0; $i < $night; $i ++){
                    $oneDate = date("Y-m-d", strtotime($startDate) + (86400 * $i));
                    $booking = dailyBookingEarning($oneDate,2)['total'];
                    $pms = dailyBookingEarning($oneDate,1)['total'];
                    $toatalData += $pms;
                    $toatalData2 += $booking;
                    $total = $booking + $pms;

                    $bookingCount = dailyBookingEarning($oneDate,2)['bookingCount'];
                    $pmsCount = dailyBookingEarning($oneDate,1)['bookingCount'];
                    $toatalDataCount += $pmsCount;
                    $toatalData2Count += $bookingCount;
                    $totalCount = $bookingCount + $pmsCount;
                    
                    
                    $datePrint = date('M d', strtotime($oneDate));
                    $dailyBooking[] = [
                        'labels'=> $datePrint,

                        'revenueDatasets'=> $total,
                        'revenueData'=> $pms,
                        'revenueData2'=> $booking,

                        'revenueDatasetsCount'=> $totalCount,
                        'revenueDataCount'=> $pmsCount,
                        'revenueData2Count'=> $bookingCount,
                    ];
                }
                $revenueLabel = 'Revenue,PMS,BE';
                $revenueKey = 'PMS,BE,Total';
                $totalRevenue = $toatalData + $toatalData2;
                $revenueValue = "Rs $toatalData,Rs $toatalData2,Rs $totalRevenue";

                $BookingLabel = 'Total,PMS,BE';
                $bookingKey = 'PMS,BE,Total';
                $totalBookingCount = $toatalDataCount + $toatalData2Count;
                $bookingValue = "$toatalDataCount,$toatalData2Count,$totalBookingCount";
            }
        }

        foreach($dailyBooking as $val){
            $labelsArry[] = $val['labels'];
            $revenueDatasetsArry[] = $val['revenueDatasets'];
            $revenueDataArry[] = $val['revenueData'];
            $revenueDataArry2[] = $val['revenueData2'];

            $revenueDatasetsArryCount[] = $val['revenueDatasetsCount'];
            $revenueDataArryCount[] = $val['revenueDataCount'];
            $revenueDataArry2Count[] = $val['revenueData2Count'];
        }

        $labelsStr = implode(',', $labelsArry);
        $revenueDatasetsStr = implode(',', $revenueDatasetsArry);
        $revenueDataStr = implode(',', $revenueDataArry);
        $revenueDataStr2 = implode(',', $revenueDataArry2);

        $revenueDatasetsStrCount = implode(',', $revenueDatasetsArryCount);
        $revenueDataStrCount = implode(',', $revenueDataArryCount);
        $revenueDataStr2Count = implode(',', $revenueDataArry2Count);

        $reportDetail = loadDetail('',$toatalData,$toatalData2);

        $html = '
        
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body reportNav">
                            <ul>
                                <li><a class="reportTypeBtn active" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStr.'" data-revenueData="'.$revenueDataStr.'" data-revenueData2="'.$revenueDataStr2.'" data-lable="'.$revenueLabel.'" data-key="'.$revenueKey.'" data-value="'.$revenueValue.'">Revenue</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Bookings</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Rate Plan</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Room Type</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Adult</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Child</a></li>
                                <li><a class="reportTypeBtn" href="javascript:void(0)" data-revenueDatasets="'.$revenueDatasetsStrCount.'" data-revenueData="'.$revenueDataStrCount.'" data-revenueData2="'.$revenueDataStr2Count.'" data-lable="'.$BookingLabel.'" data-key="'.$bookingKey.'" data-value="'.$bookingValue.'">Payment Collection</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="tblCustomers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card" style="height: 100%;">
                                    <div class="card-body">
                                        '.$reportDetail.'
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card z-index-2">
                                    <div class="card-header p-3 pb-0 dFlex aic jcsb">
                                        <h6>Revenue</h6>
                                        <input type="button" id="btnExport" value="Export" />
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="chart">
                                            <canvas id="mixed-chart" class="chart-canvas" height="300" width="755"
                                                style="display: block; box-sizing: border-box; height: 300px; width: 755px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
        ';

        $data = [
            'label'=>$labelsStr,
            'html'=>$html,
            'datasets'=>$revenueDatasetsStr,
            'data'=>$revenueDataStr,
            'data2'=>$revenueDataStr2,
        ];

        echo json_encode($data);
    }

    if($type == 'nightAuditHtml'){
        $html = '';

        echo $html;
    }

    

?>