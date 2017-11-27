<!-- Chart.js -->
<script src="/vendors/Chart.js/dist/Chart.min.js"></script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>매출 상세 내역</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row" style="margin-top: 20px;">

                            <div class="col-lg-12 col-xs-12">
                                <div class="x_panel tile">
                                    <div class="x_title statistics_title">
                                        <h2>기간별 매출 확인</h2>
                                        <ul class="nav navbar-right panel_toolbox"  style="width: 220px;">
                                            <div class="input-group" style="margin:0;">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control" id="sales_date_term" placeholder="날짜지정">
                                            </div>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table class="table table-striped jambo_table bulk_action sortable table_responsive_xxl">
                                            <colgroup>
                                                <col width="180px">
                                                <col width="*">
                                                <col width="*">
                                                <col width="*">
                                                <col width="*">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th>일자</th>
                                                    <th>이름</th>
                                                    <th>금액</th>
                                                    <th>상품</th>
                                                    <th>지불 방식</th>
                                                    <th>이벤트</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- col 종료 -->
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
        
        $('#sales_date_term').daterangepicker({
    "locale": {
        // "format": "YYYY-MM-DD",
        // "separator": " / ",
        "applyLabel": "확인",
        "cancelLabel": "취소",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
        "일",
        "월",
        "화",
        "수",
        "목",
        "금",
        "토"
        ],
        "monthNames": [
        "1월",
        "2월",
        "3월",
        "4월",
        "5월",
        "6월",
        "7월",
        "8월",
        "9월",
        "10월",
        "11월",
        "12월"
        ]
    },
    startDate : moment().add(-3, 'day'),
    endDate : moment().add(0, 'day')
});

        $("#sales_date_term").change(function () {

            var data = {date: $("#sales_date_term").val(), type: 'day'};

            $.ajax({
                dataType: 'json',
                url: '/index.php/dataFunction/salesViewTerm',
                data: data,
                type: 'POST',
                success: function (data, status, xhr) {
                    
                    $("tbody").empty();
                    
                    $(data).each(function(index, obj){
                        var tr = $("<tr/>");

                        $("<td/>").text(obj.time_stamp).appendTo(tr);
                        $("<td/>").text(obj.member_name).appendTo(tr);
                        $("<td/>").text(obj.tot_price + "원").appendTo(tr);
                        $("<td/>").text(obj.goods_name).appendTo(tr);
                        $("<td/>").text(obj.payment_name).appendTo(tr);
                        $("<td/>").text(obj.event_name).appendTo(tr);

                        $("tbody").append(tr);

                    });


                }
            });
            // ajax 종료
        });



    });
    //document ready 종료

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