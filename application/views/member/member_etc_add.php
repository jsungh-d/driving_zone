<div class="form-inline mb5">
    <input type="text" name="etc_pay_date[]" placeholder="날짜지정" class="form-control date" maxlength="20" style="display: inline-block;  width: calc(33% - 28px);" required>
    <input type="text" name="etc_pay_name[]" placeholder="기타결제명" class="form-control" maxlength="20" style="display: inline-block; width: calc(33% - 12px);" required>
    <input type="text" name="etc_pay_price[]" placeholder="기타결제금액" pattern="[-0-9]*" maxlength="7" class="form-control" style="display: inline-block; width: calc(33% - 12px);" required>
    <button class="btn btn-default minus" type="button" style="vertical-align: top;">-</button>
    <!-- 미납 여부 체크박스 -->
    <label style="margin:5px 3px;" class="etc_payment_label">
        <input type="checkbox" value="Y" class="etc_pay_yn_chk">
        <input type="hidden"  class="etc_pay_yn_hidden" name="etc_pay_yn[]" value="N">
        <span>미납 여부</span>
    </label>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".etc_pay_yn_chk").change(function () {
            if ($(this).prop("checked")) {
                $(this).siblings(".etc_pay_yn_hidden").val("Y");
            } else {
                $(this).siblings(".etc_pay_yn_hidden").val("N");
            }
        });
    });
</script>