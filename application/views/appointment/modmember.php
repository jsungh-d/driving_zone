
<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="modifyModalLabel">회원 수정<small>&ensp; 회원의 정보를 정확하게 입력해주세요</small></h4>
        </div>
        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modMember">
            <input type="hidden" name="member_idx" id="member_idx" value="<?= $member_lists->MEMBER_IDX ?>">
            <div class="modal-body">
                <div style="padding: 5px 20px;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="col-xs-3 control-label">지점</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" value="<?= $info->NAME ?>" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="col-xs-3 control-label">이름</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="name" value="<?= $member_lists->NAME ?>"  maxlength="4" placeholder="이름" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="col-xs-3 control-label">생년월일</label>
                        <div class="col-xs-9">
                            <?php
                            $str = $member_lists->BIRTH;
                            $str2 = explode('-', $str);
                            ?>
                            <select class="form-control dp_ib birth_year" style="width:calc(33% - 2px);">
                                <option disabled selected>년</option>
                                <?php
                                for ($i = 1920; $i <= 2017; $i++) {
                                  ?>
                                  <option value="<?= $i ?>" <?php if ($i == $str2[0]) {echo 'selected';} ?>><?= $i . '년' ?></option>
                                  <?php } ?>
                              </select>
                              <select class="form-control dp_ib birth_month" style="width:calc(33% - 2px);">
                                <option disabled selected>월</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    if($i<10){
                                      ?>
                                      <option value="<?= '0' . $i ?>" <?php if($str) if ($i == $str2[1]) {echo 'selected';} ?>><?= $i . '월' ?></option>
                                      <?php 
                                  } else {
                                    ?>
                                    <option value="<?= $i ?>" <?php if($str) if ($i == $str2[1]) {echo 'selected';} ?>><?= $i . '월' ?></option>
                                    <?php 
                                }
                            } ?>
                        </select>
                        <select class="form-control dp_ib birth_day" style="width:calc(33% - 2px);">
                            <option disabled selected>일</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                if($i<10){
                                  ?>
                                  <option value="<?= '0' . $i ?>" <?php if($str) if ($i == $str2[2]) {echo 'selected';} ?>><?= $i . '일' ?></option>
                                  <?php 
                              } else {
                                ?>
                                <option value="<?= $i ?>" <?php if($str) if ($i == $str2[2]) {echo 'selected';} ?>><?= $i . '일' ?></option>
                                <?php
                            } 
                        } ?>
                    </select>
                    <input type="hidden" name="birth" value="<?= $member_lists->BIRTH ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">주소</label>
                <div class="col-xs-9">
                    <input class=" form-control" type="text" id="mod_addr1" name="addr" value="<?= $member_lists->ADDR ?>" placeholder="주소를 입력해주세요." onclick="openDaumPostcode2();" readonly>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">상세주소</label>
                <div class="col-xs-9">
                    <input class=" form-control" type="text" id="mod_addr2" name="detail_addr" value="<?= $member_lists->DETAIL_ADDR ?>" maxlength="100" placeholder="상세주소를 입력해주세요.">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">연락처</label>
                <div class="col-xs-9">
                    <?php
                    if($member_lists->PHONE == "01000000000"){
                        ?>
                        <input type="text" class="form-control" name="phone" placeholder="01012341234" value="" maxlength="13" pattern="[0-9,-]*" onblur="modChkPhone($(this).val(),<?= $member_lists->MEMBER_IDX ?>); " required disabled style="display:inline-block; width: 66%;">
                        <?php
                    }else {
                        ?>
                        <?php $phone = preg_replace("/(^02.{0}|^01.{1}|^07.{1}|^03.{1}|^04.{1}|^15.{2}|^16.{2}|^18.{2}|^0502.{0}|^0503.{0}|^0504.{0}|^0505.{0}|^0506.{0}|^0507.{0}|^0508.{0}|^06.{1}|^05.{1}|[0-9]{4})([0-9]+)([0-9]{4})/", "$1-$2-$3", $member_lists->PHONE);$phone_exp = explode('-', $phone); ?>
                        <input type="text" class="form-control" name="phone" placeholder="01012341234" value="<?= $phone_exp[0] ?>-<?= $phone_exp[1] ?>-<?= $phone_exp[2] ?>" maxlength="13" pattern="[0-9,-]*" onblur="modChkPhone($(this).val(),<?= $member_lists->MEMBER_IDX ?>); " required style="display:inline-block; width: 66%;">
                        <?php 
                    }  
                    ?>
                    <label class="" style="margin:5px 3px; width: calc(33% - 17px); display: inline-block;">
                        <?php
                        if($member_lists->PHONE == "01000000000"){
                            ?>
                            <input type="hidden" class="form-control nullPhoneChk" name="phone" maxlength="13" pattern="[0-9,-]*" value="010-0000-0000">
                            <input type="checkbox" class="nullPhone" checked style="vertical-align: middle;margin: 0;"> <span style="display: inline-block;color: #73879C;vertical-align: middle;">연락처 없음</span>
                            <?php
                        }else {
                            ?>
                            <input type="hidden" class="form-control nullPhoneChk" name="phone" maxlength="13"  pattern="[0-9,-]*" value="010-0000-0000" disabled>
                            <input type="checkbox" class="nullPhone"  style="vertical-align: middle;margin: 0;"> <span style="display: inline-block;color: #73879C;vertical-align: middle;">연락처 없음</span>
                            <?php        
                        }
                        ?>   
                    </label>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">접수일</label>
                <div class="col-xs-9">
                    <input type="hidden" value="D" name="ins_type">
                    <div class="input-group date apply_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" disable>
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <input type="text" name="timestamp" class="form-control" value="<?= $member_lists->INS_DATE ?>" placeholder="날짜지정">
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">상품/결제형태</label>
                <div class="col-xs-9">
                    <?php foreach (${'member_goods'} as $subRow) { ?>
                    <div class="form-inline mb5" style="position: relative;"  data-bind="<?= $subRow['MEMBER_GOODS_IDX'] ?>">
                        <?php 
                        $pay_yn = '';
                        if($subRow['PAY_YN']=='Y') { 
                            $pay_yn = 'checked';
                        }
                        echo '<span class="member_list" style="line-height: 28px;">' . $subRow['GOODS_NAME'] . $subRow['LICENSE_TYPE_TEXT'] . '/' . $subRow['PAYMENT_NAME'] . '/' . $subRow['EVENT_NAME'] . '</span>' . '<label style="margin:5px 3px;" class="payment_label">' . '<input type="checkbox" name="" value="Y"' . $pay_yn . '>' . '<span>미납 여부</span>' . '</label>' . '<span>' . '(' . number_format($subRow['TOT_PRICE']) . '원)' . '</span>'; ?>
                        <button class="btn btn-default minus goods_minus goods_del_btn" type="button" style="vertical-align: top;" value="<?= $subRow['MEMBER_GOODS_IDX'] ?>">-</button>
                        <br>
                    </div>
                    <?php } ?>

                    <div class="append_target shape_btn">
                        <button class="btn btn-success plus" type="button">+</button>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">기타결제</label>
                <div class="col-xs-9">
                    <?php foreach (${'member_etc_pay'} as $subRow) { ?>
                    <div class="form-inline mb5">
                        <input type="text" placeholder="날짜지정" name="etc_pay_date[]" value="<?= $subRow['DATE'] ?>" class="form-control date" maxlength="20" style="display: inline-block;  width: calc(33% - 28px);">
                        <input type="text" placeholder="기타결제명" name="etc_pay_name[]" value="<?= $subRow['NAME'] ?>" class="form-control" maxlength="20" style="display: inline-block;  width: calc(33% - 12px);">
                        <input type="text" placeholder="기타결제금액" name="etc_pay_price[]" value="<?= $subRow['PRICE'] ?>" pattern="[-0-9]*" maxlength="7" class="form-control" style="display: inline-block;  width: calc(33% - 12px);">
                        <button class="btn btn-default minus etc_del_btn" type="button" style="vertical-align: top;" value="<?= $subRow['MEMBER_ETC_PAY_IDX'] ?>">-</button> 
                        <!-- 기타미납 여부 체크박스 -->
                        <label style="margin:5px 3px;" class="etc_payment_label">
                            <input type="checkbox" value="Y" class="etc_pay_yn_chk" <?php if ($subRow['PAY_YN'] === 'Y') echo 'checked'; ?>>
                            <input type="hidden" class="etc_pay_yn_hidden" name="etc_pay_yn[]" value="<?= $subRow['PAY_YN'] ?>">
                            <span>미납 여부</span>
                        </label>
                    </div>
                    <?php } ?>
                    <div class="append_target etc_btn">
                        <button class="btn btn-success plus" type="button">+</button>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">방문경로</label>
                <div class="col-xs-9">
                    <?php foreach (${'member_visit_route'} as $visit_row) { ?>
                    <label class="" style="margin:5px 3px;">
                        <input type="checkbox" class="checkbox" value="<?= $visit_row['VISIT_ROUTE_IDX'] ?>" name="visit_route_idx[]" <?= $visit_row['CHECKED'] ?>>
                        <?= $visit_row['NAME'] ?>
                    </label>
                    <?php } ?>
                    <input type="text" class="form-control" name="in_route_comment" value="<?= $member_lists->IN_ROUTE_COMMENT ?>" placeholder="지인의 이름 또는 기타 사항을 메모해두세요">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">지금까지 연습방법</label>
                <div class="col-xs-9">
                    <?php foreach (${'member_practice'} as $practice_row) { ?>
                    <label class="" style="margin:5px 3px;">
                        <input type="checkbox" class="checkbox" value="<?= $practice_row['PRACTICE_IDX'] ?>" name="practice_idx[]" <?= $practice_row['CHECKED'] ?>>
                        <?= $practice_row['NAME'] ?>
                    </label>
                    <?php } ?>
                    <input type="text" class="form-control" name="practice_comment" value="<?= $member_lists->PRACTICE_COMMENT ?>" placeholder="타 학원 또는 기타 사항을 메모해두세요">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="col-xs-3 control-label">시험응시 예정/일자</label>
                <div class="col-xs-9">
                    <label class="skill_test skill_test1" style="margin:5px 3px;">
                        <input type="checkbox" class="skill_test_chk" name="in_test_yn" value="Y" <?php if ($member_lists->IN_TEST_YN == 'Y') echo 'checked'; ?>  style="vertical-align: middle;margin: 0;">
                        <span style="display: inline-block;color: #73879C;vertical-align: middle;">장내기능 시험</span>
                    </label>
                    <div class="input-group date  skill_test_input" data-provide="datepicker" data-date-format="yyyy-mm-dd" style="width:100%;">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <input type="text" class="form-control" name="in_test_date" value="<?= $member_lists->MOD_TEST_DATE ?>" placeholder="날짜지정" minlength="10" maxlength="10" <?php if ($member_lists->IN_TEST_YN == 'N') echo 'disable'; ?> style="width: calc(33.3% - 2px)">
                        <select name="in_test_time" style="width: calc(33.3% - 2px)">
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                if ($i < 10) {
                                    $time = '0' . $i;
                                } else {
                                    $time = $i;
                                }
                                ?>
                                <option value="<?= $time ?>" <?php if ($time == $member_lists->MOD_TEST_DATE_TIME) echo 'selected'; ?>><?= $time ?>시</option>
                                <?php } ?>
                            </select>
                            <select name="in_test_min" style="width: calc(33.3% - 2px)">
                                <?php
                                for ($i = 0; $i <= 5; $i++) {
                                    ?>
                                    <option value="<?= $i . '0' ?>" <?php if ($i . '0' == $member_lists->MOD_TEST_DATE_MIN) echo 'selected'; ?>><?= $i . '0' ?>분</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="road_test road_test1" style="margin:5px 3px;">
                                <input type="checkbox" class="road_test_chk" name="road_test_yn" value="Y" <?php if ($member_lists->ROAD_TEST_YN == 'Y') echo 'checked'; ?>  style="vertical-align: middle;margin: 0;">
                                <span style="display: inline-block;color: #73879C;vertical-align: middle;">도로주행 시험</span>
                            </label>
                            <div class="input-group date road_test_input" data-provide="datepicker" data-date-format="yyyy-mm-dd"  style="width:100%;">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <input type="text" class="form-control" name="road_test_date" value="<?= $member_lists->MOD_ROAD_DATE ?>" placeholder="날짜지정" minlength="10" maxlength="10" <?php if ($member_lists->ROAD_TEST_YN == 'N') echo 'disable'; ?> style="width: calc(33.3% - 2px)">
                                <select name="road_test_time" style="width: calc(33.3% - 2px)">
                                    <?php
                                    for ($i = 0; $i < 24; $i++) {
                                        if ($i < 10) {
                                            $time = '0' . $i;
                                        } else {
                                            $time = $i;
                                        }
                                        ?>
                                        <option value="<?= $time ?>" <?php if ($time == $member_lists->MOD_ROAD_DATE_TIME) echo 'selected'; ?>><?= $time ?>시</option>
                                        <?php } ?>
                                    </select>
                                    <select name="road_test_min" style="width: calc(33.3% - 2px)">
                                        <?php
                                        for ($i = 0; $i <= 5; $i++) {
                                            ?>
                                            <option value="<?= $i . '0' ?>" <?php if ($i . '0' == $member_lists->MOD_ROAD_DATE_MIN) echo 'selected'; ?>><?= $i . '0' ?>분</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">응시 예정 시험장</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control autocomplete" value="<?= $member_lists->TEST_SITE_NAME ?>" name="test_site" placeholder="시험장을 입력해주세요.">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">사진첨부</label>
                                <?php if (!$member_lists->IMG) { ?>
                                <div class="col-xs-9">

                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label class="file_ins">
                                            <input type="radio" checked="" value="F" name="file_type"> 파일 첨부
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label class="webcam_ins">
                                            <input type="radio" value="W" name="file_type"> 웹캠
                                        </label>
                                    </div>

                                    <div class="file_area" style="margin-top: 10px;">
                                        <input type="file" name="file" class="img_input" accept="image/*" style="display: inline-block;">
                                        <input type="hidden" name="org_img" value="">
                                        <button type="button" class="btn-link img_input_view" data-toggle="modal" title="" data-target="#imgViewModal" style="float: right;
                                        padding-right: 0px;  border-right-width: 0px;  margin-right: 0px;">[사진보기]</button>
                                    </div>
                                    <div class="webcam_area" style="display: none; margin-top: 10px;">
                                        <!-- <span>준비중입니다.</span> -->
                                        <div class="my_camera<?=$member_lists->MEMBER_IDX?>" style="width:280px; height:200px; border:1px dashed #ccc; margin-bottom: 10px;"></div>
                                        <input type=button value="웹캠 준비" onClick="configure(<?=$member_lists->MEMBER_IDX?>)" style="color:#000;">
                                        <input type=button value="사진 촬영" onClick="take_snapshot(<?=$member_lists->MEMBER_IDX?>)" style="color:#000;">
                                        <!-- <input type=button value="저장" onClick="saveSnap(<?=$member_lists->MEMBER_IDX?>)" style="color:#000;"> -->
                                        <input class="webcam_input<?=$member_lists->MEMBER_IDX?>" type="hidden" name="file" value=""/>
                                        <div class="camera_results<?=$member_lists->MEMBER_IDX?>"  style="margin-top: 10px;"></div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-xs-9">
                                    <div class="img_input_wrapper">
                                        <img src="<?= $member_lists->IMG ?>" style="max-width: 200px">
                                        <button type="button" class="del_img_btn"  value="<?= $member_lists->MEMBER_IDX ?>">
                                            <img src="/images/delete-button.png" alt="삭제" style="width:20px;">
                                        </button>
                                        <input type="hidden" name="org_img" value="<?= $member_lists->IMG ?>">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">사전상담여부</label>
                                <div class="col-xs-9">
                                    <label  style="margin:5px 3px;">
                                        <input type="checkbox" class="checkbox" name="proceeding_yn" value="Y" <?php if ($member_lists->PROCEEDING_YN == 'Y') echo 'checked'; ?>>
                                        진행
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">최종합격여부</label>
                                <div class="col-xs-9">
                                    <label  style="margin:5px 3px;">
                                        <input type="checkbox" class="checkbox" name="final_yn" value="Y" <?php if ($member_lists->FINAL_YN == 'Y') echo 'checked'; ?>>
                                        합격
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">미방문 사유</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="" value="" placeholder="ex) 불합격 2회, 기간만료">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">약관 설명 및 동의</label>
                                <div class="col-xs-9">
                                    <label  style="margin:5px 3px;">
                                        <input type="checkbox" class="checkbox" name="">
                                        약관 설명 및 동의하였습니다.
                                    </label>
                                    <a class="btn-link" data-toggle="modal" title="" data-target="#termsModal" style="float: right;">[약관보기]</a>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">교육 및 메모사항</label>
                                <div class="col-xs-9">
                                    <?php foreach (${'member_memo'} as $subRow) { ?>
                                    <div class="form-inline mb5">

                                        <input type="text" name="date[]" value="<?= $subRow['DATE'] ?>" placeholder="날짜지정" class="form-control date" maxlength="20" style="display: inline-block; width: calc(35% - 28px);" required>
                                        <input type="text" name="comment[]" value="<?= $subRow['CONTENTS']?>"  placeholder="교육내용" class="form-control" style="display: inline-block; width: calc(65% - 15px);" required>

                                        <button class="btn btn-default minus"  value="<?= $subRow['MEMBER_MEMO_IDX'] ?>" type="button" style="vertical-align: top;">-</button>
                                    </div>
                                    <?php } ?>
                                    <div class="append_target comment_btn">
                                        <button class="btn btn-success plus" type="button">+</button>
                                    </div>
                                    <!-- <textarea name="comment" class="form-control" placeholder="1) 2017.00.00 교육내용을 작성해주세요.&#13;&#10;2) 2017.00.00 교육내용을 작성해주세요.&#13;&#10;3) 2017.00.00 교육내용을 작성해주세요." style="height:100px;"><?= nl2br($member_lists->COMMENT) ?></textarea> -->
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="col-xs-3 control-label">예약/사용 내역</label>
                                <div class="col-xs-9">
                                    <div name="booking_history" class="booking_history"><?= $member_lists->BOOKING_HISTORY ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary antosubmit btn_position del_member_btn" value="<?= $member_lists->MEMBER_IDX ?>">삭제</button> -->
                        <input type="hidden" name="location_name" value="calender">
                        <button type="button" class="btn btn-default autoclose" data-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-success antosubmit">수정</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: "kr",
            todayHighlight: true
        });

        $(".etc_pay_yn_chk").change(function () {
            alert("미납여부가 처리되었습니다.");
            if ($(this).prop("checked")) {
                $(this).siblings(".etc_pay_yn_hidden").val("Y");
            } else {
                $(this).siblings(".etc_pay_yn_hidden").val("N");
            }
        });

                    // 체크박스 디자인 바꾸는 외부 스크립트
                    $(".checkbox").iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });

                    //상품/결제형태 엑션
                    goods_area_calc();

                    $(".shape_btn .plus").click(function () {

                        $.post("/index.php/dataFunction/member_shape_add", function (data) {
                            $(".shape_btn").before(data);
                            // 다중 셀렉
                            $(".multiple_select").select2();
                            $(".minus").unbind("click").bind("click", function () {
                                if (confirm("삭제하시겠습니까? 이미 등록되어있는 결제내역을 삭제 하실경우 해당 매출에서 차감됩니다.")) {
                                    $(this).parent().remove();
                                }

                            });

                            //상품/결제형태 엑션
                            goods_area_calc();
                        });
                    });

                    $(".etc_btn .plus").click(function () {

                        $.post("/index.php/dataFunction/member_etc_add", function (data) {
                            $(".etc_btn").before(data);
                            // 다중 셀렉
                            $(".multiple_select").select2();
                            $(".minus").unbind("click").bind("click", function () {
                                if (confirm("삭제하시겠습니까? 이미 등록되어있는 결제내역을 삭제 하실경우 해당 매출에서 차감됩니다.")) {
                                    $(this).parent().remove();
                                }
                            });
                            $('.date').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true,
                                language: "kr",
                                todayHighlight: true
                            });
                        });
                    });

                    $(".comment_btn .plus").click(function () {
                        $.post("/index.php/dataFunction/member_comment_add", function (data) {
                            $(".comment_btn").before(data);

                            $('.date').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true,
                                language: "kr",
                                todayHighlight: true
                            });

                            $(".minus").unbind("click").bind("click", function () {
                                if (confirm("삭제하시겠습니까?")) {
                                    $(this).parent().remove();
                                }
                            });
                        });
                    });


                    $(".minus").unbind("click").bind("click", function () {
                        var obj = $(this);
                        if (obj.hasClass('goods_del_btn')) {
                            if (confirm("삭제하시겠습니까? 이미 등록되어있는 결제내역을 삭제 하실경우 해당 매출에서 차감됩니다.")) {
                                var data = {goods_idx: obj.val()};
                                $.ajax({
                                    dataType: 'text',
                                    url: '/index.php/dataFunction/delMemberGoods',
                                    data: data,
                                    type: 'POST',
                                    success: function (data, status, xhr) {
                                        if (data === 'SUCCESS') {
                                            obj.parent().remove();
                                        } else {
                                            alert('데이터 처리오류!!');
                                            return false;
                                        }
                                    }
                                });
                            }
                        } else if (obj.hasClass('etc_del_btn')) {
                            if (confirm("삭제하시겠습니까? 이미 등록되어있는 결제내역을 삭제 하실경우 해당 매출에서 차감됩니다.")) {
                                var data = {etc_idx: obj.val()};
                                $.ajax({
                                    dataType: 'text',
                                    url: '/index.php/dataFunction/delMemberEtc',
                                    data: data,
                                    type: 'POST',
                                    success: function (data, status, xhr) {
                                        if (data === 'SUCCESS') {
                                            obj.parent().remove();
                                        } else {
                                            alert('데이터 처리오류!!');
                                            return false;
                                        }
                                    }
                                });
                            }
                        } else {
                            if (confirm("삭제하시겠습니까?")) {
                                obj.parent().remove();
                            }
                        }
                    });

                    // 이미지 보기를 눌렀을때와 이미지파일만 전송하기 위한 스크립트
                    $('.img_input').on('change', function () {
                        if ($(this).val() != "") {
                            var fileExt = $(this).val().substring($(this).val().lastIndexOf(".") + 1);
                            var reg = /gif|jpg|jpeg|png/i;

                            if (reg.test(fileExt) == false) {
                                alert("첨부파일은 gif,jpg,png로 된 이미지만 가능합니다.");
                                $(this).val("")
                                return;
                            } else {

                            }
                        }
                        readURL(this);
                        if ($(this).val() == "") {
                            $('#imgView').attr('src', '');
                        }
                    });

                    $("#addModal").on("hidden.bs.modal", function () {
                        $(this).find(".img_input").val("");
                        $('#imgView').attr('src', '');
                    });
                    $(".modifyModal").on("hidden.bs.modal", function () {
                        $(this).find(".img_input").val("");
                        $('#imgView').attr('src', '');
                    });


                     // 미납 여부 스크립트
                     $(".payment_label").find("input").click(function(){
                        var pay_yn = "N";
                        if($(this).prop("checked")){
                            pay_yn = "Y";
                        }
                        console.log(pay_yn + "  " + $(this).parent().parent().attr("data-bind"));

                        var data = {goods_idx: $(this).parent().parent().attr("data-bind"), pay_yn: pay_yn };

                        $.ajax({
                            dataType: 'text',
                            url: '/index.php/dataFunction/payWhether',
                            data: data,
                            type: 'POST',
                            success: function (data, status, xhr) {
                                if (data === 'SUCCESS') {
                                    alert("미납 여부가 처리 되었습니다.");
                                } else {
                                    alert('데이터 처리오류!!');
                                    return false;
                                }
                            }
                        });
                    });


                    // 도로주행 시험과 장내기능 시험은 체크박스에 체크를 해야만 input 창이 열린다
                    $('.road_test_input > .form-control').prop('disabled', true);
                    $('.skill_test_input > .form-control').prop('disabled', true);
                    $('.road_test_input > select').prop('disabled', true);
                    $('.skill_test_input > select').prop('disabled', true);

                    if ($(".skill_test1").children(".skill_test_chk").prop("checked")) {
                        $(".skill_test1").siblings('.skill_test_input').children('.form-control').prop('disabled', false);
                        $(".skill_test1").siblings('.skill_test_input').children('select').prop('disabled', false);
                    }

                    $(".skill_test").click(function () {
                        if ($(this).children(".skill_test_chk").prop("checked")) {
                            $(this).siblings('.skill_test_input').children('.form-control').prop('disabled', false);
                            $(this).siblings('.skill_test_input').children('select').prop('disabled', false);
                        } else {
                            $(this).siblings('.skill_test_input').children('.form-control').prop('disabled', true);
                            $(this).siblings('.skill_test_input').children('select').prop('disabled', true);
                            $(this).siblings('.skill_test_input').children('.form-control').val("");
                            $(this).siblings('.skill_test_input').children('select').val('00').select();
                        }
                    });

                    if ($(".road_test1").children(".road_test_chk").prop("checked")) {
                        $(".road_test1").siblings('.road_test_input').children('.form-control').prop('disabled', false);
                        $(".road_test1").siblings('.road_test_input').children('select').prop('disabled', false);
                    }

                    $(".road_test").click(function () {
                        if ($(this).children(".road_test_chk").prop("checked")) {
                            $(this).siblings('.road_test_input').children('.form-control').prop('disabled', false);
                            $(this).siblings('.road_test_input').children('select').prop('disabled', false);
                        } else {
                            $(this).siblings('.road_test_input').children('.form-control').prop('disabled', true);
                            $(this).siblings('.road_test_input').children('select').prop('disabled', true);
                            $(this).siblings('.road_test_input').children('.form-control').val("");
                            $(this).siblings('.road_test_input').children('select').val('00').select();
                        }
                    });


                    $('input.autocomplete').typeahead({
                        source: function (query, process) {
                            return $.get('/index.php/dataFunction/testSiteAutoComplete', {query: query}, function (data) {
                                console.log(data);
                                data = $.parseJSON(data);
                                return process(data);
                            });
                        }
                    });


                    $(".del_img_btn").click(function () {
                     var index = $(".del_img_btn").index(this);
                        // var html = '<input type="file" name="file" class="img_input" accept="image/*" style="display: inline-block;">';
                        // html += '<input type="hidden" name="org_img" value="">';
                        // html += '<button type="button" class="btn-link img_input_view" data-toggle="modal" title="" data-target="#imgViewModal">보기</button>';

                        $.post("/index.php/dataFunction/member_img_add" , { idx : $(this).val() } , function(result){
                            $(".del_img_btn").eq(index).parent().parent().html(result);


                            // 이미지 보기를 눌렀을때와 이미지파일만 전송하기 위한 스크립트
                            $('.img_input').on('change', function () {
                                if ($(this).val() != "") {
                                    var fileExt = $(this).val().substring($(this).val().lastIndexOf(".") + 1);
                                    var reg = /gif|jpg|jpeg|png/i;

                                    if (reg.test(fileExt) == false) {
                                        alert("첨부파일은 gif,jpg,png로 된 이미지만 가능합니다.");
                                        $(this).val("")
                                        return;
                                    } else {

                                    }
                                }
                                readURL(this);
                                if ($(this).val() == "") {
                                    $('#imgView').attr('src', '');
                                }
                            });

                            // 이미지 업로드시 웹캠과 파일첨부의 선택 여부에 따른 뷰 전환
                            $("input[name='file_type']").change(function(){
                                if($(this).val()=='F'){
                                    $(this).parent().parent().parent().find(".file_area").show();
                                    $(this).parent().parent().parent().find(".file_area").find(".img_input").prop("disabled",false);
                                    $(this).parent().parent().parent().find(".webcam_area").hide();
                                }else{
                                    $(this).parent().parent().parent().find(".file_area").hide();
                                    $(this).parent().parent().parent().find(".webcam_area").show();
                                    $(this).parent().parent().parent().find(".file_area").find(".img_input").prop("disabled",true);
                                }
                            });


                        });         
                    });


                    $("input[name='phone']").keyup(function(){
                        $(this).val(autoHypenPhone($(this).val()));
                    });


                    $(".nullPhone").change(function(){
                        if($(this).prop("checked")){
                            $(this).parent().parent().find($("input[name='phone']")).attr("disabled","disabled");
                            $(this).parent().find($(".nullPhoneChk")).removeAttr("disabled");
                        }else {
                            $(this).parent().parent().find($("input[name='phone']")).removeAttr("disabled");
                            $(this).parent().find($(".nullPhoneChk")).attr("disabled","disabled");
                        }
                    });



                    function chkPhone(val) {
                        var data = {phone: val};
                        $.ajax({
                            dataType: 'text',
                            url: '/index.php/dataFunction/chkPhone',
                            data: data,
                            type: 'POST',
                            success: function (data, status, xhr) {
                                if (data == 'DUPLE') {
                                    alert('이미 등록된 번호입니다.');
                                    $("#phone").val('');
                                    $("#phone").focus();
                                    return false;
                                } else if (data === 'FAILED') {
                                    alert("데이터 처리오류!!");
                                    return false;
                                }
                            }
                        });
                    }

                    function modChkPhone(val1,val2) {
                        var data = {phone: val1 , idx: val2};
                        $.ajax({
                            dataType: 'text',
                            url: '/index.php/dataFunction/modChkPhone',
                            data: data,
                            type: 'POST',
                            success: function (data, status, xhr) {
                                if (data == 'DUPLE') {
                                    alert('이미 등록된 번호입니다.');
                                    $("#phone").val('');
                                    $("#phone").focus();
                                    return false;
                                } else if (data === 'FAILED') {
                                    alert("데이터 처리오류!!");
                                    return false;
                                }
                            }
                        });
                    }

                // 현재 시간 구하기
                function getTimeStamp() {
                    var d = new Date();
                    var s =
                    leadingZeros(d.getFullYear(), 4) + '-' +
                    leadingZeros(d.getMonth() + 1, 2) + '-' +
                    leadingZeros(d.getDate(), 2) + ' '
                    return s;
                }

                function leadingZeros(n, digits) {
                    var zero = '';
                    n = n.toString();

                    if (n.length < digits) {
                        for (i = 0; i < digits - n.length; i++)
                            zero += '0';
                    }
                    return zero + n;
                }

                function openModModal(idx) {
                    $("#modifyModal_" + idx + "").modal();
                }

                function openCalenderModalNew(idx) {
                    $("#CalenderModalNew").modal();
                    $("#member_select").val(idx).trigger('change');
                }


                //이미지 바꾸는 함수
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imgView').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function goods_area_calc() {
                    $(".goods_area select").change(function () {
                        var idx = $(this).parent().index('.goods_area');
                        var price_id = $('.goods_select:eq(' + idx + ')').children(":selected").attr("id");
                        var split_price = price_id.split('_');
                        var price = split_price[2];

                        var payment_id = $(".payment_select:eq(" + idx + ")").children(":selected").attr("id");
                        var split_payment = payment_id.split('_');
                        var payment = split_payment[2];

                        var event_id = $(".event_select:eq(" + idx + ")").children(":selected").attr("id");
                        var split_event = event_id.split('_');
                        var event_chk = split_event[2].charAt(split_event[2].length - 1);

                        var payment_price_calc = 0;
                        if (parseInt(payment) !== parseInt(0)) {
                            payment_price_calc = parseInt(price) + ((price * payment) / 100);
                        } else {
                            payment_price_calc = parseInt(price);
                        }

                        if (event_chk === '%') {
                            payment_price_calc = parseInt(payment_price_calc) - ((payment_price_calc * split_event[2].substring(0, split_event[2].length - 1)) / 100);
                        } else {
                            payment_price_calc = parseInt(payment_price_calc) - parseInt(split_event[2]);
                        }

                        if (parseInt(price) === parseInt(0)) {
                            payment_price_calc = 0;
                        }

                        $(this).parent().children('.price_view_text').html(numberWithCommas(payment_price_calc) + '원');
                        $(this).parent().children('input[type=hidden]').val(payment_price_calc);
                    });
                }

                function numberWithCommas(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }


                function autoHypenPhone(str){
                    str = str.replace(/[^0-9]/g, '');
                    var tmp = '';
                    if( str.length < 4){
                        return str;
                    }else if(str.length < 7){
                        tmp += str.substr(0, 3);
                        tmp += '-';
                        tmp += str.substr(3);
                        return tmp;
                    }else if(str.length < 11){
                        tmp += str.substr(0, 3);
                        tmp += '-';
                        tmp += str.substr(3, 3);
                        tmp += '-';
                        tmp += str.substr(6);
                        return tmp;
                    }else{              
                        tmp += str.substr(0, 3);
                        tmp += '-';
                        tmp += str.substr(3, 4);
                        tmp += '-';
                        tmp += str.substr(7);
                        return tmp;
                    }
                    return str;
                }

            </script>