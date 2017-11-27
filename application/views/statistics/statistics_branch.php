<!-- Chart.js -->
<script src="/vendors/Chart.js/dist/Chart.min.js"></script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>통계</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <select id="branch_select" class="title_select">
                            <?php foreach ($branch_lists as $row) { ?>
                                <option value="<?= $row['BRANCH_IDX'] ?>"><h2><?= $row['NAME'] ?></h2></option>
                            <?php } ?>
                        </select>
                        <small></small>

                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div> 
                    <div class="x_content">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12 col-xs-12">
                                <div class="x_panel tile">
                                    <div class="x_title statistics_title">
                                        <h2>매출</h2>
                                        <div class="statistic_btn_area">
                                            <div class="on">일간</div>
                                            <div>월간</div>
                                        </div>
                                        <ul class="nav navbar-right panel_toolbox"  style="width: 170px;">
                                            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control" id="sales_date" value="" placeholder="날짜지정">
                                            </div>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="sales_wrapper" style="height:450px;">
                                            <canvas id="sales"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">
    $(document).ready(function () {

        $(".statistic_btn_area div").click(function () {
            $(this).parent().find("div").removeClass("on");
            $(this).addClass("on");
            var index = $(this).parent().index(".statistic_btn_area");
            if ($(this).text() == '월간') {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: false,
                    maxViewMode: 2,
                    minViewMode: 1
                });
            } else {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: false,
                    maxViewMode: 2,
                    minViewMode: 0
                });
            }
        });

        $("#member_date").val(moment().format('YYYY-MM-DD'));
        $("#sales_date").val(moment().format('YYYY-MM-DD'));
        $("#total_member_date").val(moment().format('YYYY-MM-DD'));
        $("#total_sales_date").val(moment().format('YYYY-MM-DD'));

        var dt = new Date();
        var year = dt.getFullYear();
        var month = dt.getMonth() + 1;
        var day = dt.getDate();

        var data = {date: year + '-' + month + '-' + day, type: 'day', idx: $("#branch_select").select().val()};

        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/statisticsChart',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {

                // 매출 그래프
                if ($('#sales').length) {
                    var ctx = document.getElementById("sales");
                    ctx.height = 350;
                    var title = [];
                    var price = [];
                    for (var i = 0; i < data.price.length; i++) {
                        title.push(data.price[i].title);
                        price.push(data.price[i].price);
                    }
                    var mybarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: title,
                            datasets: [{
                                    label: '매출',
                                    backgroundColor: "#f03737",
                                    data: price
                                }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        var value = data.datasets[0].data[tooltipItem.index];
                                        if (parseInt(value) >= 1000) {
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
                                            beginAtZero: true,
                                            callback: function (value, index, values) {
                                                if (parseInt(value) >= 1000) {
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
                    $("#sales_date").change(function () {
                        mybarChart.destroy();
                    });

                }
            }
        });

        $("#branch_select").change(function () {
            var select_date = $("#sales_date").val();

            var ctx = document.getElementById("sales");
            // 일간일때
            if ($("#sales_date").parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: true,
                    maxViewMode: 2,
                    minViewMode: 0
                });

                var data = {date: select_date, type: 'day', idx: $("#branch_select").select().val()};

                $.ajax({
                    dataType: 'json',
                    url: '/index.php/dataFunction/statisticsChart',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {

                        $('#sales').remove();
                        $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                        var ctx = document.getElementById("sales");

                        var title = [];
                        var price = [];
                        for (var i = 0; i < data.price.length; i++) {
                            title.push(data.price[i].title);
                            price.push(data.price[i].price);
                        }
                        var mybarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: title,
                                datasets: [{
                                        label: '매출',
                                        backgroundColor: "#f03737",
                                        data: price
                                    }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            var value = data.datasets[0].data[tooltipItem.index];
                                            if (parseInt(value) >= 1000) {
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
                                                beginAtZero: true,
                                                callback: function (value, index, values) {
                                                    if (parseInt(value) >= 1000) {
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
                });
            }
            // 월간일때
            else {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: false,
                    maxViewMode: 2,
                    minViewMode: 1
                });
                var data = {date: select_date, type: 'month'};

                $.ajax({
                    dataType: 'json',
                    url: '/index.php/dataFunction/statisticsChart',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        $('#sales').remove();
                        $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                        var ctx = document.getElementById("sales");

                        var title = [];
                        var price = [];
                        for (var i = 0; i < data.price.length; i++) {
                            title.push(data.price[i].title);
                            price.push(data.price[i].price);
                        }
                        var mybarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: title,
                                datasets: [{
                                        label: '매출',
                                        backgroundColor: "#f03737",
                                        data: price
                                    }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            var value = data.datasets[0].data[tooltipItem.index];
                                            if (parseInt(value) >= 1000) {
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
                                                beginAtZero: true,
                                                callback: function (value, index, values) {
                                                    if (parseInt(value) >= 1000) {
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
                });
            }
        });

        // 날짜 선택 할 때 
        $("#sales_date").change(function () {
            var select_date = $("#sales_date").val();

            var ctx = document.getElementById("sales");
            // 일간일때
            if ($(this).parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: true,
                    maxViewMode: 2,
                    minViewMode: 0
                });

                var data = {date: select_date, type: 'day', idx: $("#branch_select").select().val()};

                $.ajax({
                    dataType: 'json',
                    url: '/index.php/dataFunction/statisticsChart',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        $('#sales').remove();
                        $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                        var ctx = document.getElementById("sales");

                        var title = [];
                        var price = [];
                        for (var i = 0; i < data.price.length; i++) {
                            title.push(data.price[i].title);
                            price.push(data.price[i].price);
                        }
                        var mybarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: title,
                                datasets: [{
                                        label: '매출',
                                        backgroundColor: "#f03737",
                                        data: price
                                    }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            var value = data.datasets[0].data[tooltipItem.index];
                                            if (parseInt(value) >= 1000) {
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
                                                beginAtZero: true,
                                                callback: function (value, index, values) {
                                                    if (parseInt(value) >= 1000) {
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
                });
            }
            // 월간일때
            else {
                $("#sales_date").datepicker("destroy");
                $("#sales_date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    language: "kr",
                    todayHighlight: false,
                    maxViewMode: 2,
                    minViewMode: 1
                });
                var data = {date: select_date, type: 'month'};

                $.ajax({
                    dataType: 'json',
                    url: '/index.php/dataFunction/statisticsChart',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        $('#sales').remove();
                        $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                        var ctx = document.getElementById("sales");

                        var title = [];
                        var price = [];
                        for (var i = 0; i < data.price.length; i++) {
                            title.push(data.price[i].title);
                            price.push(data.price[i].price);
                        }
                        var mybarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: title,
                                datasets: [{
                                        label: '매출',
                                        backgroundColor: "#f03737",
                                        data: price
                                    }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            var value = data.datasets[0].data[tooltipItem.index];
                                            if (parseInt(value) >= 1000) {
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
                                                beginAtZero: true,
                                                callback: function (value, index, values) {
                                                    if (parseInt(value) >= 1000) {
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
                });
            }
        });
    });

    function newDate(select_date, days) {
        // return moment().add(days, 'd').toDate();
        var date = moment(select_date).add(days, 'd').toDate();
        return moment(date).format('YYYY-MM-DD');
    }

    function newMonth(select_date, days) {
        // return moment().add(days, 'd').toDate();
        var date = moment(select_date).add(days, 'M').toDate();
        return moment(date).format('YYYY-MM');
    }

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

</script>