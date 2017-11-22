<!-- footer content -->
<footer>
    <div class="pull-right">
        Driving zone
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="/build/js/custom.js"></script>
<!-- 데이트피커 -->
<script type="text/javascript" src="/vendors/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.kr.js"></script>
<!-- 제이쿼리 ui 데이트피커 -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <!-- 체크박스 작동 js -->
    <script type="text/javascript" src="/vendors/iCheck/icheck.min.js"></script>
    <script type="text/javascript">

        function clear() {
            $("#sdate").val('');
        }

        function clear2() {
            $("#edate").val('');
        }

        $(document).ready(function () {

            $(".birth_year").change(function(){
                $(this).siblings("input[name='birth']").val($(this).val() + "-" + $(this).siblings(".birth_month").val() + "-" + $(this).siblings(".birth_day").val());

                if(!$(this).siblings(".birth_month").val()){
                    $(this).siblings(".birth_month").val('01').trigger('change');
                }
                if(!$(this).siblings(".birth_day").val()){
                    $(this).siblings(".birth_day").val('01').trigger('change');
                }
            });
            $(".birth_month").change(function(){
                $(this).siblings("input[name='birth']").val($(this).siblings(".birth_year").val() + "-" + $(this).val() + "-" + $(this).siblings(".birth_day").val());

                if(!$(this).siblings(".birth_year").val()){
                    $(this).siblings(".birth_year").val('1960').trigger('change');
                }
                if(!$(this).siblings(".birth_day").val()){
                    $(this).siblings(".birth_day").val('01').trigger('change');
                }
            });
            $(".birth_day").change(function(){
                $(this).siblings("input[name='birth']").val($(this).siblings(".birth_year").val() + "-" + $(this).siblings(".birth_month").val() + "-" + $(this).val());

                if(!$(this).siblings(".birth_month").val()){
                    $(this).siblings(".birth_month").val('01').trigger('change');
                }
                if(!$(this).siblings(".birth_year").val()){
                    $(this).siblings(".birth_year").val('1960').trigger('change');
                }
            });

        // 이미지 업로드시 웹캠과 파일첨부의 선택 여부에 따른 뷰 전환
        $("input[name='file_type']").change(function(){
            if($(this).val()=='F'){
                $(this).parent().parent().parent().find(".file_area").show();
                $(this).parent().parent().parent().find(".webcam_area").find(".webcam_input").prop("disabled",true);
                $(this).parent().parent().parent().find(".file_area").find(".img_input").prop("disabled",false);
                $(this).parent().parent().parent().find(".webcam_area").hide();
            }else{
                $(this).parent().parent().parent().find(".file_area").hide();
                $(this).parent().parent().parent().find(".webcam_area").show();
                $(this).parent().parent().parent().find(".webcam_area").find(".webcam_input").prop("disabled",false);
                $(this).parent().parent().parent().find(".file_area").find(".img_input").prop("disabled",true);
            }
        });
        

        var date = new Date();
        var year = date.getFullYear(); //get year
        var month = date.getMonth(); //get month
        var day = date.getDate(); //get month
        if (month < 10) {
            month = '0' + (date.getMonth() + 1);
        }
        if (day < 10) {
            day = '0' + date.getDate();
        }

        // jquery-ui 데이트피커
    //     $(".date").datepicker({
    //   changeMonth: true,
    //   changeYear: true,
    //   dateFormat: "yy-mm-dd",
    //   monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    //     monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    //     dayNames: ['일', '월', '화', '수', '목', '금', '토'],
    //     dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
    //     dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']

    // });

    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        language: "kr",
        todayHighlight: true
    });

    $('.date_rangepicker').daterangepicker({
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
    startDate : moment().add(-10, 'day'),
    endDate : moment().add(0, 'day')
});

    $('.date_range').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

    $('.date.excel_date:eq(0)').datepicker().on('changeDate', function (ev) {
        ev.preventDefault();
        if (date < ev.date && year + '-' + month + '-' + day != ev.format()) {
            alert("시작일은 오늘보다 클수 없습니다.");
            clear();
            return false;
        }

        if (ev.format() > $("#edate").val() && $("#edate").val()) {
            alert("시작일은 종료일보다 클수 없습니다.");
            clear();
            return false;
        }
    });

    $('.date.excel_date:eq(1)').datepicker().on('changeDate', function (ev) {
        ev.preventDefault();
        if (date < ev.date && year + '-' + month + '-' + day != ev.format()) {
            alert("종료일은 오늘보다 클수 없습니다.");
            clear2();
            return false;
        }

        if (ev.format() < $("#sdate").val()) {
            alert("종료일은 시작일보다 작을수 없습니다.");
            clear2();
            return false;
        }
    });

    $(".date").keydown(function (event) {
        event.preventDefault();
    });

    $('.date_month').datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
        language: "kr"
                    // todayHighlight: true
                });
    $(".date_month").keydown(function (event) {
        event.preventDefault();
    });

        // $('.date_range').daterangepicker({
        //     locale: {
        //         format: 'YYYY-MM-DD',
        //         autoclose: true,
        //         todayHighlight: true,
        //         separator: " ~ ",
        //         applyLabel: "확인",
        //         cancelLabel: "취소",
        //         fromLabel: "부터",
        //         toLabel: "까지",
        //         customRangeLabel: "Custom",
        //         daysOfWeek: [
        //         "일",
        //         "월",
        //         "화",
        //         "수",
        //         "목",
        //         "금",
        //         "토"
        //         ],
        //         monthNames: [
        //         "1월",
        //         "2월",
        //         "3월",
        //         "4월",
        //         "5월",
        //         "6월",
        //         "7월",
        //         "8월",
        //         "9월",
        //         "10월",
        //         "11월",
        //         "12월"
        //         ]
        //     }
        // });
    });
</script>


</body>
</html>
