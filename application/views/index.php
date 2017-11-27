<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!-- Chart.js -->
<script src="/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- Flot -->
<script src="/vendors/Flot/jquery.flot.js"></script>
<script src="/vendors/Flot/jquery.flot.pie.js"></script>
<script src="/vendors/Flot/jquery.flot.time.js"></script>
<script src="/vendors/Flot/jquery.flot.stack.js"></script>
<script src="/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- bootstrap-progressbar -->
<link href="/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- bootstrap-progressbar -->
<script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>


<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> 총 회원수</span>
            <div class="count"><?= number_format($member_tot->CNT) ?></div>
        </div>
        <div class="col-md-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> 이번달 가입한 회원수</span>
            <div class="count"><?= number_format($member_month_tot->CNT) ?></div>
        </div>
        <div class="col-md-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> 총매출</span>
            <div class="count green"><?= number_format($price_tot->TOT_PRICE + $price_etc_tot->TOT_PRICE) ?></div>
        </div>
        <div class="col-md-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> 이번달 매출</span>
            <div class="count"><?= number_format($price_month_tot->TOT_PRICE + $price_month_etc_tot->TOT_PRICE) ?></div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>
                            <!-- <select class="title_select">
                                <option value="">가나다점</option>
                                <option value="">라마바점</option>
                                <option value="">사아자점</option>
                            </select> -->
                            <small>기간별 변화를 볼 수 있는 그래프입니다.</small>
                        </h3>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <div class="input-group pull-right date chart_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" style=" width:170px;">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input type="text" class="form-control" id="price_date" value="<?= date('Y-m-d') ?>" placeholder="날짜지정">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div style="height:400px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-6 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>결제 유형</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-7 col-xs-12">
                            <canvas id="canvasDoughnut" ></canvas>
                        </div>
                        <div class="col-sm-5 col-xs-12">
                            <table class="" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <p class="">상품</p>
                                        </th>
                                        <th>
                                            <p class="">비율</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pay_percent as $row) { ?>
                                    <tr>
                                        <td>
                                            <p><?= $row['NAME'] ?></p>
                                        </td>
                                        <td><?= $row['PAY_CNT'] ?>%</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>상품유형</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h6 style="margin-bottom: 15px;">상품유형별 합계 입니다.</h6>
                    <?php foreach ($goods_lists as $row) { ?>
                    <div class="widget_summary">
                        <div class="w_left w_25">
                            <span><?= $row['GOODS_TYPE'] ?></span>
                        </div>
                        <div class="w_center w_55">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $row['SUM_GOODS_PERCENT'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $row['SUM_GOODS_PERCENT'] ?>%;">
                                    <span class="sr-only"><?= $row['SUM_GOODS_PERCENT'] ?>%</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span><?= $row['SUM_GOODS'] ?>명</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script type="text/javascript">
    $(document).ready(function () {
        var dt = new Date();
        var year = dt.getFullYear();
        var month = dt.getMonth() + 1;
        var day = dt.getDate();

        var data = {date: year + '-' + month + '-' + day};

        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/dashboardChart',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {

                var title = [];
                var price = [];
                for (var i = 0; i < data.title.length; i++) {
                    title.push(data.title[i].title);
                    price.push(data.price[i].price);
                }

                if ($('#lineChart').length) {

                    var ctx = document.getElementById("lineChart");
                    ctx.height =450;
                    var lineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: title,
                            datasets: [{
                                label: "매출",
                                backgroundColor: "rgba(38, 185, 154, 0.31)",
                                borderColor: "rgba(38, 185, 154, 0.7)",
                                pointBorderColor: "rgba(38, 185, 154, 0.7)",
                                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointBorderWidth: 1,
                                data: price
                            }
                            ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                              callbacks: {
                                label: function(tooltipItem, data) {
                                    var value = data.datasets[0].data[tooltipItem.index];
                                    if(parseInt(value) >= 1000){
                                     return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                 } else {
                                     return  value.toFixed(1) + "원";
                                 }
                             }
                         }
                     },               
                     scales: {
                     xAxes: [{
    
        }],

                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                callback: function(value, index, values) {
                                    if(parseInt(value) >= 1000){
                                     return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                 } else {
                                     return  value.toFixed(1) + "원";
                                 }
                             }                            
                         }
                     }]
                 }
             }
         });

                }

                if ($('#canvasDoughnut').length) {

                    var pay_title = [];
                    var pay_price = [];
                    for (var i = 0; i < data.pay_title.length; i++) {
                        pay_title.push(data.pay_title[i].title);
                        pay_price.push(data.pay_price[i].price);
                    }

                    var ctx = document.getElementById("canvasDoughnut");
                    var data = {
                        labels: pay_title,
                        datasets: [{
                            data: pay_price,
                             backgroundColor: [
                                    "#0d2259",
                                    "#58d6ff",
                                    "#dd9eea",
                                    "#24afc4",
                                    "#9eeace",
                                    "#ffc547",
                                    "#3e5ad5",
                                    "#fa6465",
                                    "#4da803"
                                ],
                                hoverBackgroundColor: [
                                    "#35497e",
                                    "#9ee3f9",
                                    "#e2b8eb",
                                    "#74bdc8",
                                    "#cbe9de",
                                    "#fed67f",
                                    "#667bd7",
                                    "#f78686",
                                    "#81bb52"
                                ]

                        }]
                    };

                    var canvasDoughnut = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                        legend: {
                            display: false,
                            labels: {
                                display: false
                            }
                        }
                    });

                }
            }
        });

var ctx = document.getElementById("lineChart");
var lineChart = new Chart(ctx);

$("#price_date").change(function () {

    var data = {date: $(this).val()};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/dashboardChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {

            var title = [];
            var price = [];
            for (var i = 0; i < data.title.length; i++) {
                title.push(data.title[i].title);
                price.push(data.price[i].price);
            }

            if ($('#lineChart').length) {

                var ctx = document.getElementById("lineChart");
                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: title,
                        datasets: [{
                            label: "매출",
                            backgroundColor: "rgba(38, 185, 154, 0.31)",
                            borderColor: "rgba(38, 185, 154, 0.7)",
                            pointBorderColor: "rgba(38, 185, 154, 0.7)",
                            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointBorderWidth: 1,
                            data: price
                        }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                          callbacks: {
                            label: function(tooltipItem, data) {
                                var value = data.datasets[0].data[tooltipItem.index];
                                if(parseInt(value) >= 1000){
                                   return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                               } else {
                                   return  value.toFixed(1) + "원";
                               }
                           }
                       }
                   },               
                   scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                   return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                               } else {
                                   return  value.toFixed(1) + "원";
                               }
                           }                            
                       }
                   }]
               }

           }
       });

                lineChart.update();

            }
        }
    });
});

});
</script>