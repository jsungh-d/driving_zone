
<div class="form-inline mb5 goods_area goods_area_added" style="position: relative;">
    <select class="form-control dp_ib goods_select" name="goods_idx[]" style="width:calc(33% - 17px);" required>
        <option id="goods_default_0" value="">상품 선택</option>
        <?php foreach ($goods_lists as $row) { ?>
            <option id="goods_<?= $row['GOODS_IDX'] ?>_<?= $row['GOODS_PRICE'] ?>" value="<?= $row['GOODS_IDX'] ?>"><?= $row['GOODS_NAME'] ?>&nbsp;/&nbsp;<?= $row['LICENSE_TYPE_TEXT'] ?></option>
        <?php } ?>
    </select>
    <select class="form-control dp_ib payment_select" name="payment_idx[]" style="width:calc(33% - 17px);" required>
        <?php foreach ($payment_lists as $row) { ?>
            <option id="payment_<?= $row['PAYMENT_IDX'] ?>_<?= $row['WEIGHT'] ?>" value="<?= $row['PAYMENT_IDX'] ?>"><?= $row['NAME'] ?></option>
        <?php } ?>
    </select>
    <select class="form-control dp_ib event_select" name="event_idx[]" style="width:calc(33% - 17px);">
        <option id="event_default_0" value=""> 할인 선택</option>
        <?php foreach ($event_lists as $row) { ?>
            <option id="event_<?= $row['EVENT_IDX'] ?>_<?= $row['DISCOUNT_RATE'] ?>" value="<?= $row['EVENT_IDX'] ?>"><?= $row['EVENT_NAME'] ?></option>
        <?php } ?>
    </select>
    <button class="btn btn-default minus goods_minus" type="button" style="vertical-align: top;">-</button><br>
    <!-- 미납 여부 체크박스 -->
    <label style="margin:5px 3px;" class="payment_label">
        <input type="checkbox" value="Y" class="pay_yn_chk">
        <input type="hidden"  class="pay_yn_hidden" name="pay_yn[]" value="N">
        <span>미납 여부</span>
    </label>

    <input type="hidden" name="tot_price[]" value="" class="price_view">
    <span class="price_view_text">0원</span>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".pay_yn_chk").change(function(){
            if($(this).prop("checked")){
                $(this).siblings(".pay_yn_hidden").val("Y");
            }else {
                $(this).siblings(".pay_yn_hidden").val("N");
            }
        });
    });
</script>

