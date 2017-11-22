<link rel="stylesheet" type="text/css" href="/css/fc_custom.css">

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>예약 관리 <small>각 지점의 예약을 확인 할 수 있습니다.</small></h3>
        </div>

        <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div> -->
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <select class="title_select">
                            <option value=""><h2>가나다점</h2></option>
                            <option value=""><h2>라마바점</h2></option>
                            <option value=""><h2>사아자점</h2></option>
                        </select>
                        <small></small> -->
                        <div class="event_information_wrapper" style="display:inline-block;">
                            <!--       <?php foreach ($goods_lists as $row) { ?>
                                      <div class="event_information">
                                          <span class="bg_red"></span>
                                          <span><?= $row['GOODS_NAME'] ?></span>
                                      </div>
                            <?php } ?> -->
                            <div class="event_information">
                                <span class="bg_red"></span>
                                <span>보장형</span>
                            </div>
                            <div class="event_information">
                                <span class="bg_green"></span>
                                <span>코스형</span>
                            </div>
                            <div class="event_information">
                                <span class="bg_yellow"></span>
                                <span>시간형</span>
                            </div>
                            <div class="event_information">
                                <span class="bg_blue"></span>
                                <span>상품없음</span>
                            </div>
                            <div class="event_information">
                                <span class="bg_gray"></span>
                                <span>결석처리</span>
                            </div> 
                            <div class="event_information">
                                <span class="bg_nMember"></span>
                                <span>비회원</span>
                            </div> 
                        </div>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li>
                                <button type="button" class="btn consulting_btn btn-success">상담보기</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-primary add_cal_btn title_cal_btn"  data-toggle="modal" title="" data-target="#CalenderModalNew">일정 추가</button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->

                        <div id="calendar" class="">
                            <div id="left_time_line">
                                <div>
                                </div>
                                <div>
                                    <p>9am</p>
                                </div>
                                <div>
                                    <p>10am</p>
                                </div>
                                <div>
                                    <p>11am</p>
                                </div>
                                <div>
                                    <p>12pm</p>
                                </div>
                                <div>
                                    <p>1pm</p>
                                </div>
                                <div>
                                    <p>2pm</p>
                                </div>
                                <div>
                                    <p>3pm</p>
                                </div>
                                <div>
                                    <p>4pm</p>
                                </div>
                                <div>
                                    <p>5pm</p>
                                </div>
                                <div>
                                    <p>6pm</p>
                                </div>
                                <div>
                                    <p>7pm</p>
                                </div>
                                <div>
                                    <p>8pm</p>
                                </div>
                            </div>
                        </div>
                        <!-- end project list -->
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /page content -->

    <!-- 약관보기 모달 -->
    <div id="termsModal" title="약관 보기" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="termsModalLabel">약관 보기</h4>
                </div>
                <div class="modal-body">
                    <div class="terms_modal_content">
                        <p>환급 정책 관리</p>
                        <div>
                            <?= nl2br($refunds_info->REFUNDS) ?>
                        </div>
                    </div>
                    <div class="terms_modal_content">
                        <p>개인정보 수집동의 관리</p>
                        <div>
                            <?= nl2br($privacy_info->PRIVACY) ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>  

    <!-- 이미지 미리보기 모달-->
    <div id="imgViewModal" title="이미지보기" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="imgViewModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="imgViewModalLabel">이미지 미리보기</h4>
                </div>
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <img id="imgView" src="" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>


    <!-- 일정추가 모달 -->
    <div id="CalenderModalNew" class="modal fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">새 일정</h4>
                </div>
                <form method="post" class="calendar_add_form" action="/index.php/dataFunction/insBooking" onsubmit="insFormChk(this);
                        return false;" enctype="multipart/form-data">
                    <input type="hidden" name="branch_idx" value="<?= $this->session->userdata('BRANCH_IDX') ?>">
                    <div class="modal-body" style="overflow: hidden;">
                        <div id="testmodal" style="padding: 5px 20px;">	

                            <div class="form-group row" style="overflow: hidden;">
                                <label class="col-xs-3 control-label">일정 유형</label>
                                <div class="col-xs-9">
                                    <div class="radio" style="display: inline-block; margin-right: 10px; margin-top: 0;">
                                        <label>
                                            <input type="radio" class="type_a type" checked value="B" name="type"> 예약
                                        </label>
                                    </div>
                                    <!-- <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input type="radio" class="type_b type" value="C" name="type"> 상담
                                        </label>
                                    </div> -->
                                </div>
                            </div>

                            <div class="form-group row" style="overflow: hidden;">
                                <label class="col-xs-3 control-label" style="margin-top: 10px;">예약일</label>
                                <div class="col-xs-9">
                                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                        <input type="text" id="insDate" class="form-control date_select ins_date_select" name="booking_date" placeholder="날짜지정" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="overflow: hidden;">
                                <label class="col-xs-3 control-label" style="margin-top: 10px;">시작 시간</label>
                                <div class="col-xs-9">
                                    <div class="form-inline mb5">
                                        <select id="insStime" class="form-control dp_ib hour_select ins_date_select" name="stime" style="width:48%;">
                                            <option value="default" disabled selected>시작 시</option>
                                            <?php
                                            for ($i = 9; $i < 21; $i++) {
                                                $num = $i;
                                                if ($i < 10) {
                                                    $num = '0' . $i;
                                                }
                                                ?>
                                                <option value="<?= $num ?>"><?= $num ?>시</option>
                                            <?php } ?>
                                        </select>
                                        <select id="insStime_min" class="form-control dp_ib minute_select ins_date_select" name="stime_min" style="width:48%;">
                                            <option value="default" disabled selected>시작 분</option>
                                            <option value="00">00분</option>
                                            <option value="30">30분</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="overflow: hidden;">
                                <label class="col-xs-3 control-label" style="margin-top: 10px;">종료 시간</label>
                                <div class="col-xs-9">
                                    <div class="form-inline mb5">
                                        <select id="insEtime" class="form-control dp_ib hour_select_end ins_date_select" name="etime" style="width:48%;">
                                            <option value="default" disabled selected>종료 시</option>
                                            <?php
                                            for ($i = 9; $i < 22; $i++) {
                                                $num = $i;
                                                if ($i < 10) {
                                                    $num = '0' . $i;
                                                }
                                                ?>
                                                <option value="<?= $num ?>"><?= $num ?>시</option>
                                            <?php } ?>
                                        </select>
                                        <select id="insEtime_min" class="form-control dp_ib minute_select_end ins_date_select" name="etime_min" style="width:48%;">
                                            <option value="default" disabled selected>종료 분</option>
                                            <option value="00">00분</option>
                                            <option value="30">30분</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row type_b_hidden"  style="overflow: hidden;">
                                <label class="col-xs-3 control-label" style="margin-top: 10px;">기기 선택</label>
                                <div class="col-xs-9">
                                    <select id="insMachine" name="machine_info_idx" class="form-control device_name1" required>
                                        <option value="">먼저 일자를 선택해주세요.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row type_b_hidden" style="overflow: hidden; margin-top: 20px;">
                                <label class="col-xs-3 control-label">회원 유형</label>
                                <div class="col-xs-9">
                                    <div class="radio" style="display: inline-block; margin-right: 10px; margin-top: 0px;">
                                        <label>
                                            <input type="radio" class="type_member_a member_type" checked value="M" name="member_type"> 기존회원
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block; margin-right: 10px;">
                                        <label>
                                            <input type="radio" class="type_member_b member_type" value="J" name="member_type"> 바로가입
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input type="radio" class="type_member_c member_type" value="N" name="member_type"> 비회원
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row type_b_hidden member_input"  style="">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">회원이름</label>
                                <div class="col-xs-9" style="margin-top: 5px;">
                                    <select id="member_select" class="type_member_a_input" name="member_name" style="width:100%;" required>
                                        <option value="">선택</option>
                                        <?php foreach ($member_lists as $row) { ?>
                                            <option value="<?= $row['MEMBER_IDX'] ?>"><?= $row['NAME'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row type_b_hidden member_none_input" style="display:none;">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">회원이름</label>
                                <div class="col-xs-9" style="margin-top: 5px;">
                                    <input type="text" id="member_ins_name" class="form-control" name="member_ins_name" maxlength="4" placeholder="이름을 입력해주세요." required>
                                </div>
                            </div>

                            <div class="form-group row type_b_hidden insPhone_area"  style="">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">연락처</label>
                                <div class="col-xs-9" style="margin-top: 5px;">
                                    <input type="text" id="insPhone" class="form-control" name="phone" placeholder="연락처를 입력해주세요." minlength="10" maxlength="13" pattern="[0-9,-]*" readonly>

                                    <label class="nullPhoneLabel" style="margin:5px 3px; width: calc(33% - 17px); display: none;">
                                        <input type="checkbox" class="nullPhone"> 연락처 없음
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row type_b_hidden"  style="">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">상품</label>
                                <div class="col-xs-9" style="margin-top: 5px;">
                                    <input type="text" class="form-control" id="insGoods" name="member_goods" value="" readonly>
                                    <input type="hidden" id="ins_member_goods_idx" name="goods_idx" value="">

                                    <div class="form-inline mb5 goods_area goods_area_added" style="display:none;">
                                        <label class="nullGoodsLabel" style="margin:5px 3px; width: 100%;">
                                            <input type="checkbox" class="nullGoods"> 상품 없음
                                        </label>
                                        <select class="form-control dp_ib goods_select" name="goods_idx" style="width:calc(33% - 17px);" required disabled>
                                            <option id="goods_default_0" value="">상품 선택</option>
                                            <?php foreach ($goods_lists as $row) { ?>
                                                <option id="goods_<?= $row['GOODS_IDX'] ?>_<?= $row['GOODS_PRICE'] ?>" value="<?= $row['GOODS_IDX'] ?>"><?= $row['GOODS_NAME'] ?>&nbsp;/&nbsp;<?= $row['LICENSE_TYPE_TEXT'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="form-control dp_ib payment_select" name="payment_idx" style="width:calc(33% - 17px);" required disabled>
                                            <?php foreach ($payment_lists as $row) { ?>
                                                <option id="payment_<?= $row['PAYMENT_IDX'] ?>_<?= $row['WEIGHT'] ?>" value="<?= $row['PAYMENT_IDX'] ?>"><?= $row['NAME'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="form-control dp_ib event_select" name="event_idx" style="width:calc(33% - 17px);" disabled>
                                            <option id="event_default_0" value=""> 할인 선택</option>
                                            <?php foreach ($event_lists as $row) { ?>
                                                <option id="event_<?= $row['EVENT_IDX'] ?>_<?= $row['DISCOUNT_RATE'] ?>" value="<?= $row['EVENT_IDX'] ?>"><?= $row['EVENT_NAME'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="tot_price" value="" class="price_view">
                                        <span class="price_view_text">0원</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row"  style="">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">예약관련 메모</label>
                                <div class="col-xs-9" style="margin-top: 5px;">
                                    <textarea class="form-control" style="height:55px;" id="ins_contents" name="contents"></textarea>
                                </div>
                            </div>

                            <div class="form-group row type_b_hidden member_input">
                                <label class="col-xs-3 control-label" style="margin-top: 13px;">회원 메모</label>
                                <div id="insComment" class="col-xs-9" style="margin-top: 5px;">
                                    <div class="form-inline mb5">
                                        <input type="text" class="form-control modify_comment_date"  readonly >
                                        <input type="text" class="form-control modify_comment_text"   readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary antosubmit">바로 예약</button>
                        <button type="submit" class="btn btn-warning copysubmit">계속 예약</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 일정추가 모달끝  -->

    <!--일정수정 모달-->
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">일정 수정</h4>
                </div>
                <form class="calendar_mod_form" method="post" action="/index.php/dataFunction/modBooking">
                    <input type="hidden" id="modify_booking_idx" name="booking_idx" value="">
                    <div class="modal-body" style="">

                        <div id="testmodal2" style="padding: 5px 20px;">

                            <div class="form-group row" style="">
                                <label class="col-xs-3 control-label">예약일</label>
                                <div class="col-xs-9">
                                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        <div class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                        <input type="text" class="form-control modify_date_select" name="booking_date" placeholder="날짜지정">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="">
                                <label class="col-xs-3 control-label">시작 시간</label>
                                <div class="col-xs-9">
                                    <div class="form-inline mb5">
                                        <select class="form-control dp_ib modify_hour_select" name="stime" style="width:48%;">
                                            <?php
                                            for ($i = 9; $i < 21; $i++) {
                                                $num = $i;
                                                if ($i < 10) {
                                                    $num = '0' . $i;
                                                }
                                                ?>
                                                <option value="<?= $num ?>"><?= $num ?>시</option>
                                            <?php } ?>
                                        </select>
                                        <select class="form-control dp_ib modify_minute_select" name="stime_min" style="width:48%;">
                                            <option value="00">00분</option>
                                            <option value="30">30분</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="">
                                <label class="col-xs-3 control-label">종료 시간</label>
                                <div class="col-xs-9">
                                    <div class="form-inline mb5">
                                        <select class="form-control dp_ib modify_hour_select_end" name="etime" style="width:48%;">
                                            <?php
                                            for ($i = 9; $i < 22; $i++) {
                                                $num = $i;
                                                if ($i < 10) {
                                                    $num = '0' . $i;
                                                }
                                                ?>
                                                <option value="<?= $num ?>"><?= $num ?>시</option>
                                            <?php } ?>
                                        </select>
                                        <select class="form-control dp_ib modify_minute_select_end" name="etime_min" style="width:48%;">
                                            <option value="00">00분</option>
                                            <option value="30">30분</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mod_type_b_hidden" style="overflow:hidden;">
                                <label class="col-xs-3 control-label">선택 기기</label>
                                <div class="col-xs-9">
                                    <input class="form-control device_name2" type="text" name="machine_info_idx" readonly>
                                </div>
                            </div>
                            <div class="form-group row mod_type_b_hidden"  style="overflow:hidden;">
                                <label class="col-xs-3 control-label">회원이름</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control autocomplete modify_name" name="" placeholder="이름을 입력해주세요." readonly>
                                </div>
                            </div>

                            <!-- 사진 -->
                            <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
                                <label class="col-xs-3 control-label">사진</label>
                                <div class="col-xs-9 view_picture" style="">
                                    <img src="" style="max-width: 200px;">
                                </div>
                            </div>

                            <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
                                <label class="col-xs-3 control-label">연락처</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control modify_phone" placeholder="연락처를 입력해주세요" pattern="[0-9,-]*" readonly>
                                </div>
                            </div>
                            <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
                                <label class="col-xs-3 control-label">상품</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control modify_goods_name" readonly>
                                </div>
                            </div>
                            <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
                                <label class="col-xs-3 control-label">시험 일정</label>
                                <div class="col-xs-9">
                                    <div class="form-inline mb5">
                                        <span style="margin-right: 10px;">기능 시험</span>
                                        <input class="form-control view_in_test_date" value="" readonly style="width: calc(100% - 70px);">
                                    </div>
                                    <div class="form-inline mb5">
                                        <span style="margin-right: 10px;">주행 시험</span>
                                        <input class="form-control view_road_test_date" value="" readonly style="width: calc(100% - 70px);">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" style="overflow: hidden;">
                                <label class="col-xs-3 control-label">예약관련 메모</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" style="height:55px;" id="modify_contents" name="contents"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mod_type_b_hidden"  style="overflow:hidden;">
                                <label class="col-xs-3 control-label">회원 메모</label>
                                <div class="col-xs-9" id="memo_area">
                                    <div class="form-inline mb5">
                                        <input type="text" class="form-control modify_comment_date" readonly>
                                        <input type="text" class="form-control modify_comment_text" readonly>
                                    </div>
                                    <!-- <textarea class="form-control modify_comment" readonly></textarea> -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">취소</button>
                        <a onclick="modMemberView();" style="float:left;">
                            <input type="hidden" id="view_member_idx" value="">
                            <button type="button" class="btn btn-warning">회원정보 수정</button>
                        </a>
                        <button type="button" class="btn btn-danger absent_btn">결석</button>
                        <button type="button" class="btn btn-danger dis_absent_btn">결석취소</button>
                        <button type="button" class="btn btn-primary delete_btn">삭제</button>
                        <!--<button type="submit" class="btn btn-success antosubmit2" style="margin-left: 0;">바로 예약</button>
                                                <button type="submit" class="btn btn-warning copysubmit2" style="margin-left: 0;">계속 예약</button>-->
                        <button type="submit" class="btn btn-default copysubmit3" style="margin-left: 0;">수정</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--일정수정 모달끝-->

    <!-- 캘린더 뷰 모달-->
    <!--  <div id="CalenderModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="z-index: 1050">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h4 class="modal-title" id="myModalLabel2">일정 보기</h4>
                 </div>
                 <form method="post" action="">
                     <div class="modal-body" style="overflow: hidden;">

                         <div id="testmodal2" style="padding: 5px 20px;">

                             <div class="form-group row" style="overflow: hidden;">
                                 <label class="col-xs-3 control-label">예약일</label>
                                 <div class="col-xs-9" id="view_date">
                                     2017-08-10
                                 </div>
                             </div>
                             <div class="form-group row" style="overflow: hidden;">
                                 <label class="col-xs-3 control-label">시작 시간</label>
                                 <div class="col-xs-9">
                                     <div class="form-inline mb5" id="view_stime">
                                         10시 00분
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group row" style="overflow: hidden;">
                                 <label class="col-xs-3 control-label">종료 시간</label>
                                 <div class="col-xs-9">
                                     <div class="form-inline mb5" id="view_etime">
                                         10시 30분
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group row mod_type_b_hidden" style="overflow: hidden;">
                                 <label class="col-xs-3 control-label">선택 기기</label>
                                 <div class="col-xs-9" id="view_machine">
                                     2호기
                                 </div>
                             </div>
                             <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
                                 <label class="col-xs-3 control-label">회원이름</label>
                                 <a onclick="openMemberView();">
                                     <input type="hidden" id="view_member_idx" value="">
                                     <div class="col-xs-9" id="view_name" style="color:#004ff1; text-decoration: underline;">
                                         김아무개
                                     </div>
                                     <span class="col-xs-9" style="font-size:11px;">※회원의 정보를 확인하시려면 클릭하세요.</span>
                                 </a>
                             </div> -->
    <!-- 회원 메모 -->
    <!--  <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
         <label class="col-xs-3 control-label">회원 메모</label>
             <div class="col-xs-9" id="view_member_comment" style="">
                 김아무개
             </div>
         </div> -->

    <!-- 사진 -->
    <!-- <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
        <label class="col-xs-3 control-label">사진</label>
            <div class="col-xs-9" id="view_picture" style="">
                <img src="" style="max-width: 200px;">
            </div>
    </div>

    <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
        <label class="col-xs-3 control-label">연락처</label>
        <div class="col-xs-9" id="view_phone">
            연락처
        </div>
    </div>
    <div class="form-group row mod_type_b_hidden"  style="overflow: hidden;">
        <label class="col-xs-3 control-label">상품</label>
        <div class="col-xs-9" id="view_goods_name">
            시간형 상품
        </div>
    </div>
    <div class="form-group row mod_type_b_hidden" style="overflow: hidden;">
        <label class="col-xs-3 control-label">시험 일정</label>
        <div class="col-xs-9">
            <div class="form-inline mb5">
                <span>기능 시험</span>
                <span id="view_in_test_date">2017-09-10</span>
            </div>
            <div class="form-inline mb5">
                <span>주행 시험</span>
                <span id="view_road_test_date">2017-09-10</span>
            </div>
        </div>
    </div>
    <div class="form-group row" style="overflow: hidden;">
        <label class="col-xs-3 control-label">예약관련 메모</label>
        <div class="col-xs-9" id="view_comment">
            메모
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
<a href="/index/member" style="display: inline-block;"><button type="button" class="btn btn-success">회원목록보기</button></a>
<button type="button" class="btn btn-primary add_cal_btn" data-toggle="modal" title="" data-target="#CalenderModalEdit">일정 수정</button>
<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">닫기</button>
</div>
</form>
</div>
</div>
</div> -->


    <!-- 회원 수정 및 삭제 모달 -->
    <div id="modifyMemberModal" title="회원 수정" class="modal fade modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true" style="z-index: 1061;">
    </div>


    <!-- 회원 뷰 모달 -->
    <div id="memberViewModal" title="회원 정보" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true"  style="z-index: 1061">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modifyModalLabel">회원 정보<small>회원의 정보를 확인하세요</small></h4>
                </div>
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">지점</label>
                                <div class="col-xs-9" id="member_branch">
                                    본점
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">이름</label>
                                <div class="col-xs-9" id="member_name">
                                    홍길동
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">생년월일</label>
                                <div class="col-xs-9" id="member_birth">
                                    1990-08-02
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">주소</label>
                                <div class="col-xs-9" id="member_addr">
                                    서울시 동대문구 답십리동
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">상세주소</label>
                                <div class="col-xs-9" id="member_detail_addr">
                                    4-213
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">연락처</label>
                                <div class="col-xs-9" id="member_phone">
                                    010-1234-5678
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">접수일</label>
                                <div class="col-xs-9" id="member_timestamp">
                                    2017-08-16
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">상품/결제형태</label>
                                <div class="col-xs-9" id="member_goods">
                                    100% 합격보장
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">기타결제</label>
                                <div class="col-xs-9" id="member_etc_pay">

                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">방문경로</label>
                                <div class="col-xs-9" id="member_visit">
                                    메모
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">지금까지 연습방법</label>
                                <div class="col-xs-9" id="member_practice">
                                    메모
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">시험응시 예정/일자</label>
                                <div class="col-xs-9">
                                    <label class="skill_test skill_test1" id="in_test">
                                        장내기능 시험
                                    </label>
                                    <br>
                                    <label class="road_test road_test1" id="road_test">
                                        도로주행 시험
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">응시 예정 시험장</label>
                                <div class="col-xs-9" id="member_test_site">
                                    강서 면허 시험장
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">사진첨부</label>
                                <img id="member_img" style="width: 100px">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">최종합격여부</label>
                                <div class="col-xs-9">
                                    <label id="member_final">
                                        합격
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">메모사항</label>
                                <div class="col-xs-9" id="member_comment">
                                    메모
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="row">
                                <label class="col-xs-3 control-label">예약/사용 내역</label>
                                <div class="col-xs-9" id="member_history">
                                    예약
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/index/member"><button class="btn btn-success">회원목록보기</button></a>
                    <button type="button" class="btn btn-primary antoclose"  data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($machine_lists as $row) { ?>
    <input type="hidden" class="device_info" value="<?= $row['ID'] ?>">
<?php } ?>
<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>

<!-- typeahead -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
                            $(document).ready(function () {

                                $('.fc-agendaWeek-view').scroll(function () {
                                    $(this).find('#left_time_line').css('left', $(this).scrollLeft());
                                });

                                goods_area_calc();

                                // 상담보기 버튼
                                $(".consulting_btn").click(function () {
                                    var option =
                                            "menubar=no,toolbar=no,location=no,status=no,height=600px, width=800px";

                                    window.open("/DataFunction/consult_memo", "상담 메모", option);
                                });

                                init_calendar();

                                if (window.sessionStorage.getItem("defaultView")) {
                                    window.sessionStorage.removeItem("defaultView");
                                }

                                var keydownCnt = 0;
                                $(document).keydown(function (event) {
                                    var x = event.which || event.keyCode;
                                    if (x == "39") {
                                        keydownCnt++;
                                        if (keydownCnt >= 2) {
                                            keydownCnt = 2;
                                        }

                                        $(".fc-agendaWeek-view").animate({scrollLeft: ($(".x_content").width() / 2) * keydownCnt}, 400);
                                    } else if (x == "37") {
                                        keydownCnt--;
                                        if (keydownCnt <= 0) {
                                            keydownCnt = 0;
                                        }

                                        $(".fc-agendaWeek-view").animate({scrollLeft: ($(".x_content").width() / 2) * keydownCnt}, 400);
                                    }
                                });

                                $(".type_member_a_input").select2();

                                $(".member_none_input").find("input").prop("disabled", true);

                                $("input[name='phone']").keyup(function () {
                                    $(this).val(autoHypenPhone($(this).val()));
                                });

                                $(".type_member_a").click(function () {
                                    $(".member_input").find("input").prop("disabled", false);
                                    $(".member_input").find("select").prop("disabled", false);
                                    $(".member_none_input").find("input").prop("disabled", true);
                                    $(".member_none_input").css("display", "none");
                                    $(".member_input").css("display", "block");
                                    $('#member_select').val($('#member_select option:first-child').val()).trigger('change');
                                    $("#insPhone").prop("readonly", true);
                                    $("#insPhone").val('');
                                    $(".insPhone_area").show();
                                    $("#insPhone").css({"margin": "0", "width": "100%", "display": "block"});
                                    $(".nullPhoneLabel").css("display", "none");

                                    $("#insGoods").val('');
                                    $("#ins_member_goods_idx").val('');
                                    $("#insGoods").prop('disabled', false);
                                    $("#ins_member_goods_idx").prop('disabled', false);
                                    $(".goods_select").prop('disabled', true);
                                    $(".payment_select").prop('disabled', true);
                                    $(".event_select").prop('disabled', true);
                                    $("#insGoods").show();
                                    $("#ins_member_goods_idx").show();
                                    $(".goods_area").hide();
                                });

                                $(".type_member_b").click(function () {
                                    $(".member_input").find("input").prop("disabled", true);
                                    $(".member_input").find("select").prop("disabled", true);
                                    $(".member_none_input").find("input").prop("disabled", false);
                                    $(".member_none_input").css("display", "block");
                                    $(".member_input").css("display", "none");
                                    $("#insPhone").prop("readonly", false);
                                    $("#insPhone").val('');
                                    $(".insPhone_area").show();
                                    $("#insPhone").css({"margin": "5px 3px 0px 0", "width": "calc(66% - 17px)", "display": "inline-block"});
                                    $(".nullPhoneLabel").css("display", "inline-block");

                                    $("#insGoods").val('');
                                    $("#ins_member_goods_idx").val('');
                                    $("#insGoods").prop('disabled', true);
                                    $("#ins_member_goods_idx").prop('disabled', true);
                                    $(".goods_select").prop('disabled', false);
                                    $(".payment_select").prop('disabled', false);
                                    $(".event_select").prop('disabled', false);
                                    $(".goods_area").show();
                                    $("#insGoods").hide();
                                    $("#ins_member_goods_idx").hide();
                                });

                                $(".type_member_c").click(function () {
                                    $(".member_input").find("input").prop("disabled", true);
                                    $(".member_input").find("select").prop("disabled", true);
                                    $(".member_none_input").find("input").prop("disabled", false);
                                    $(".member_none_input").css("display", "block");
                                    $(".member_input").css("display", "none");
                                    $("#insPhone").prop("readonly", false);
                                    $("#insPhone").val('010-0000-0000');
                                    $(".insPhone_area").hide();

                                    $("#insPhone").css({"margin": "5px 3px 0px 0", "width": "calc(66% - 17px)", "display": "inline-block"});
                                    $(".nullPhoneLabel").css("display", "inline-block");

                                    $("#insGoods").val('');
                                    $("#ins_member_goods_idx").val('');
                                    $("#insGoods").prop('disabled', true);
                                    $("#ins_member_goods_idx").prop('disabled', true);
                                    $(".goods_select").prop('disabled', false);
                                    $(".payment_select").prop('disabled', false);
                                    $(".event_select").prop('disabled', false);
                                    $(".goods_area").show();
                                    $("#insGoods").hide();
                                    $("#ins_member_goods_idx").hide();
                                });

                                $(".nullPhone").change(function () {
                                    if ($(this).prop("checked")) {
                                        $("#insPhone").attr("disabled", "disabled");
                                        $(this).siblings($("#insPhoneHidden")).remove();
                                        $(this).after($("<input type='hidden' id='insPhoneHidden' value='010-0000-0000' name='phone' />"));
                                        $("#insPhoneHidden").removeAttr("disabled");
                                    } else {
                                        $(this).siblings($("#insPhoneHidden")).remove();
                                        $("#insPhoneHidden").attr("disabled", "disabled");
                                        $("#insPhone").removeAttr("disabled");
                                    }
                                });

                                $(".nullGoods").change(function () {
                                    if ($(this).prop("checked")) {
                                        $(".goods_select").prop('disabled', true);
                                        $(".payment_select").prop('disabled', true);
                                        $(".event_select").prop('disabled', true);
                                    } else {
                                        $(".goods_select").prop('disabled', false);
                                        $(".payment_select").prop('disabled', false);
                                        $(".event_select").prop('disabled', false);
                                    }
                                });

                                $(".type_b").click(function () {
                                    if ($(this).prop("checked")) {
                                        $(".type_b_hidden").find("input").prop("disabled", true);
                                        $(".type_b_hidden").find("select").prop("disabled", true);
                                        $(".type_b_hidden").css("display", "none");
                                    }
                                });
                                $(".type_a").click(function () {
                                    if ($(this).prop("checked")) {
                                        $(".type_b_hidden").find("input").prop("disabled", false);
                                        $(".type_b_hidden").find("select").prop("disabled", false);
                                        $(".type_b_hidden").css("display", "block");
                                        // if($(".type_member_a ").prop("checked")){
                                        //     $("#member_ins_name").prop("disabled", false);
                                        //     $(".member_none_input").css("display", "none");
                                        // }
                                        $(".type_member_a").trigger("click");
                                    }
                                });

                                $(".ins_date_select").change(function () {

                                    if (!$("#insDate").val()) {
                                        alert("예약일을 선택해주세요.");
                                        return false;
                                    }

                                    var sdate = $("#insDate").val() + ' ' + $("#insStime").select().val() + ':' + $("#insStime_min").select().val() + ':00';
                                    var edate = $("#insDate").val() + ' ' + $("#insEtime").select().val() + ':' + $("#insEtime_min").select().val() + ':00';
                                    var data = {sdate: sdate, edate: edate};

                                    $.ajax({
                                        dataType: 'text',
                                        url: '/index.php/dataFunction/chkDate',
                                        data: data,
                                        type: 'POST',
                                        success: function (data, status, xhr) {
                                            $("#insMachine").html(data);
                                        }
                                    });
                                });

                                $("#member_select").change(function () {
                                    var member_idx = $(this).select().val();
                                    var data = {member_idx: member_idx};
                                    $.ajax({
                                        dataType: 'json',
                                        url: '/index.php/dataFunction/getMemberInfo',
                                        data: data,
                                        type: 'POST',
                                        success: function (data, status, xhr) {
                                            if (data.RESULT === 'SUCCESS') {
                                                if (data.PHONE == "01000000000") {
                                                    $("#insPhone").val("없음");
                                                    $("#insPhone").attr("disabled", "disabled");
                                                    $("#insPhone").siblings().find($("input[type='hidden']")).remove();
                                                    $("#insPhone").after($("<input type='hidden' value='010-0000-0000' id='insPhoneHidden' name='phone' />"));

                                                } else {
                                                    $("#insPhone").siblings().find($("input[type='hidden']")).remove();
                                                    $("#insPhone").removeAttr("disabled");
                                                    $("#insPhone").val(autoHypenPhone(data.PHONE));
                                                }

                                                if (data.GOODS_NAME) {
                                                    $("#insGoods").val(data.GOODS_NAME + " / " + data.LICENSE_TYPE_TEXT);
                                                } else {
                                                    $("#insGoods").val("");
                                                }

                                                if (!data.COMMENT) {
                                                    var html = '<div class="form-inline mb5">';
                                                    html += '<input type="text" class="form-control modify_comment_date" readonly >';
                                                    html += '<input type="text" class="form-control modify_comment_text" readonly style="    margin-left: 3px;">';
                                                    html += '</div>';

                                                    $("#insComment").html(html);
                                                } else {
                                                    $("#insComment").html(data.COMMENT);
                                                }
                                                $("#ins_member_goods_idx").val(data.GOODS_IDX);
                                            } else if (data.RESULT === 'NO_DATA') {
//                                        alert('회원 정보가 없습니다.');
                                                $("#insPhone").val('');
                                                $("#insGoods").val('');
                                                $("#ins_member_goods_idx").val('');
                                                return false;
                                            } else {
                                                alert('데이터 처리오류!!');
                                                return false;
                                            }
                                        }
                                    });
                                });


                                $(".copysubmit").on("click", function (e) {
                                    e.preventDefault();
                                    window.sessionStorage.setItem("member_type", $("input[name='member_type']:checked").val());
                                    if ($("input[name='member_type']:checked").val() == "M") {
                                        window.sessionStorage.setItem("member_name", $("#member_select").select().val());
                                    } else {
                                        window.sessionStorage.setItem("member_name", $("#member_ins_name").val());
                                        window.sessionStorage.setItem("comment", $("#insComment").val());
                                        window.sessionStorage.setItem("phone", $("#insPhone").val());
                                        window.sessionStorage.setItem("nullPhone", $(".nullPhone").prop("checked"));
                                    }
                                    window.sessionStorage.setItem("contents", $("#ins_contents").val());

                                    $(".calendar_add_form").submit();

                                });





                                $(".copysubmit2").on("click", function (e) {
                                    e.preventDefault();
                                    window.sessionStorage.setItem("member_name", $("#view_member_idx").val());
                                    window.sessionStorage.setItem("contents", $("#modify_contents").val());

                                    $(".calendar_mod_form").submit();
                                });

                                $(".copysubmit3").on("click", function (e) {
                                    e.preventDefault();
                                    $(".calendar_mod_form").submit();
                                });







                                $(".add_cal_btn").click(function () {
                                    // 인풋 초기화
                                    $(".date_select").val("");
                                    $(".hour_select").val("default").prop("selected", true);
                                    $(".minute_select").val("default").prop("selected", true);
                                    $(".hour_select_end").val("default").prop("selected", true);
                                    $(".minute_select_end").val("default").prop("selected", true);
                                    $(".member_name").val("default").prop("selected", true);
                                    $(".goods_name").val("default").prop("selected", true);
                                    if ($(this).hasClass("title_cal_btn")) {
                                        $("#insDate").val(defaultToday());
                                    }
                                });

                                $('input.autocomplete').typeahead({
                                    source: function (query, process) {
                                        return $.get('/index.php/dataFunction/memberAutoComplete', {query: query}, function (data) {
                                            console.log(data);
                                            data = $.parseJSON(data);
                                            return process(data);
                                        });
                                    }
                                });

                            });


                            $("#insStime").unbind().bind("change", function () {

                                $("#insStime_min").val("00").select();
                                $("#insEtime_min").val("00").select();

                                if (parseInt($("#insStime").val()) + 1 >= 10 && parseInt($("#insStime").val()) + 1 != 24) {
                                    $("#insEtime").val(parseInt($("#insStime").val()) + 1).select();

                                } else if (parseInt($("#insStime").val()) + 1 == 24) {
                                    $("#insEtime").val("00").select();
                                } else {
                                    $("#insEtime").val("0" + (parseInt($("#insStime").val()) + 1)).select();
                                }

                                // if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                if (parseInt($("#insStime").val()) > parseInt($("#insEtime").val())) {
                                    $("#insStime").val("default").select();
                                    $("#insStime_min").val("default").select();

                                    $("#insEtime").val("default").select();
                                    $("#insEtime_min").val("default").select();

                                    alert("시작 시간이 종료 시간보다 늦습니다.");

                                } else if (parseInt($("#insStime").val()) == parseInt($("#insEtime").val())) {
                                    if (parseInt($("#insStime_min").val()) > parseInt($("#insEtime_min").val())) {
                                        $("#insStime").val("default").select();
                                        $("#insStime_min").val("default").select();

                                        $("#insEtime").val("default").select();
                                        $("#insEtime_min").val("default").select();

                                        alert("시작 시간이 종료 시간보다 늦습니다.");
                                    }
                                }
                                // }
                            });
                            $("#insStime_min").unbind().bind("change", function () {
                                // if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                if (parseInt($("#insStime").val()) == parseInt($("#insEtime").val())) {
                                    if (parseInt($("#insStime_min").val()) > parseInt($("#insEtime_min").val())) {
                                        $("#insStime").val("default").select();
                                        $("#insStime_min").val("default").select();

                                        $("#insEtime").val("default").select();
                                        $("#insEtime_min").val("default").select();

                                        alert("시작 시간이 종료 시간보다 늦습니다.");

                                    }
                                }
                                // }
                            });


                            $("#insEtime").unbind().bind("change", function () {
                                // if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                if (parseInt($("#insEtime").val()) == 21) {
                                    $("#insEtime_min").val("00").select();
                                }
                                if (parseInt($("#insStime").val()) > parseInt($("#insEtime").val())) {
                                    $("#insStime").val("default").select();
                                    $("#insStime_min").val("default").select();

                                    $("#insEtime").val("default").select();
                                    $("#insEtime_min").val("default").select();
                                    alert("시작 시간이 종료 시간보다 늦습니다.");

                                } else if (parseInt($("#insStime").val()) == parseInt($("#insEtime").val())) {
                                    if (parseInt($("#insStime_min").val()) > parseInt($("#insEtime_min").val())) {
                                        $("#insStime").val("default").select();
                                        $("#insStime_min").val("default").select();

                                        $("#insEtime").val("default").select();
                                        $("#insEtime_min").val("default").select();

                                        alert("시작 시간이 종료 시간보다 늦습니다.");
                                    }
                                }
                                // }
                            });
                            $("#insEtime_min").unbind().bind("change", function () {
                                // if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                if (parseInt($("#insEtime").val()) == 21) {
                                    $("#insEtime_min").val("00").select();
                                }
                                if (parseInt($("#insStime").val()) == parseInt($("#insEtime").val())) {
                                    if (parseInt($("#insStime_min").val()) > parseInt($("#insEtime_min").val())) {
                                        $("#insStime").val("default").select();
                                        $("#insStime_min").val("default").select();

                                        $("#insEtime").val("default").select();
                                        $("#insEtime_min").val("default").select();

                                        alert("시작 시간이 종료 시간보다 늦습니다.");

                                    }
                                }
                                // }

                            });

                            /* CALENDAR */
                            function  init_calendar() {
                                var repeat = 0;
                                // 기계 수
                                var device_length = $(".device_info").length;
                                var date = new Date(),
                                        default_view = moment(),
                                        d = date.getDate(),
                                        m = date.getMonth(),
                                        y = date.getFullYear(),
                                        started,
                                        categoryClass;

                                if (window.sessionStorage.getItem("defaultView")) {
                                    default_view = moment(window.sessionStorage.getItem("defaultView"));
                                }
                                var calendar = $('#calendar').fullCalendar({
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    multiple_selection: true,
                                    contentHeight: 'auto',
                                    monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                                    monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                                    dayNames: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"],
                                    dayNamesShort: ["일", "월", "화", "수", "목", "금", "토"],
                                    buttonText: {
                                        today: "오늘",
                                        month: "월별",
                                        week: "주별",
                                        day: "일별"
                                    },
                                    contentHeight: 955,
                                            defaultView: 'agendaWeek',
                                    allDaySlot: false,
                                    displayEventEnd: false,
                                    timeFormat: "HH:mm",
                                    defaultDate: default_view,
                                    slotEventOverlap: false,
                                    minTime: "09:00:00",
                                    maxTime: "21:00:00",
                                    eventLimit: true,
                                    views: {
                                        agenda: {
                                            eventLimit: 6
                                        },
                                        month: {// name of view
                                            titleFormat: 'YYYY년 MMMM'
                                        },
                                        week: {
                                            titleFormat: 'YYYY년 MMM DD일'
                                        },
                                        day: {
                                            titleFormat: 'YYYY년 MMM DD일'
                                        }
                                    },
                                    selectable: true,
                                    selectHelper: true,
                                    select: function (start, end, allDay) {
                                        $('#fc_create').click();

                                        started = start;
                                        ended = end;

                                        // 드래그 했을 때 인풋들에 들어가는 값
                                        $(".date_select").val(moment(started).format('YYYY-MM-DD'));
                                        $(".hour_select").val(moment(started).format('HH')).prop("selected", true);
                                        $(".minute_select").val(moment(started).format('mm')).prop("selected", true);

                                        $(".hour_select_end").val(moment(ended).format('HH')).prop("selected", true);
                                        $(".minute_select_end").val(moment(ended).format('mm')).prop("selected", true);

                                        var sdate = $(".date_select").val() + ' ' + $(".hour_select").select().val() + ':' + $(".minute_select").select().val() + ':00';
                                        var edate = $(".date_select").val() + ' ' + $(".hour_select_end").select().val() + ':' + $(".minute_select_end").select().val() + ':00';
                                        var data = {sdate: sdate, edate: edate};

                                        $("#insStime").change(function () {

                                            if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                                // if (parseInt($("#insStime").val()) > parseInt($("#insEtime").val())) {
                                                //     alert(2);
                                                //     $("#insStime").val(moment(started).format('HH')).select();
                                                //     $("#insStime_min").val(moment(started).format('mm')).select();

                                                //     $("#insEtime").val(moment(ended).format('HH')).select();
                                                //     $("#insEtime_min").val(moment(ended).format('mm')).select();

                                                //     alert("시작 시간이 종료 시간보다 늦습니다.");

                                                // }
                                                $("#insStime").val(moment(started).format('HH')).select();
                                                $("#insStime_min").val(moment(started).format('mm')).select();

                                                $("#insEtime").val(moment(ended).format('HH')).select();
                                                $("#insEtime_min").val(moment(ended).format('mm')).select();
                                            }
                                        });
                                        $("#insStime_min").change(function () {
                                            // if ($("#insStime").val() || $("#insStime_min").val() || $("#insEtime").val() || $("#insEtime_min").val()) {
                                            //     if (parseInt($("#insStime").val()) == parseInt($("#insEtime").val())) {
                                            //         if (parseInt($("#insStime_min").val()) > parseInt($("#insEtime_min").val())) {
                                            //             $("#insStime").val(moment(started).format('HH')).select();
                                            //             $("#insStime_min").val(moment(started).format('mm')).select();

                                            //             $("#insEtime").val(moment(ended).format('HH')).select();
                                            //             $("#insEtime_min").val(moment(ended).format('mm')).select();
                                            //                 alert("시작 시간이 종료 시간보다 늦습니다.");

                                            //         }
                                            //     }
                                            // }
                                            if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                                $("#insStime").val(moment(started).format('HH')).select();
                                                $("#insStime_min").val(moment(started).format('mm')).select();

                                                $("#insEtime").val(moment(ended).format('HH')).select();
                                                $("#insEtime_min").val(moment(ended).format('mm')).select();
                                            }
                                        });
                                        $("#insEtime").change(function () {
                                            if (parseInt($("#insEtime").val()) == 21) {
                                                $("#insEtime_min").val("00").select();
                                            }
                                            if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                                $("#insStime").val(moment(started).format('HH')).select();
                                                $("#insStime_min").val(moment(started).format('mm')).select();

                                                $("#insEtime").val(moment(ended).format('HH')).select();
                                                $("#insEtime_min").val(moment(ended).format('mm')).select();
                                            }
                                        });
                                        $("#insEtime_min").change(function () {
                                            if (parseInt($("#insEtime").val()) == 21) {
                                                $("#insEtime_min").val("00").select();
                                            }
                                            if (!$("#insStime").val() || !$("#insStime_min").val() || !$("#insEtime").val() || !$("#insEtime_min").val()) {
                                                $("#insStime").val(moment(started).format('HH')).select();
                                                $("#insStime_min").val(moment(started).format('mm')).select();

                                                $("#insEtime").val(moment(ended).format('HH')).select();
                                                $("#insEtime_min").val(moment(ended).format('mm')).select();
                                            }
                                        });

                                        $.ajax({
                                            dataType: 'text',
                                            url: '/index.php/dataFunction/chkDate',
                                            data: data,
                                            type: 'POST',
                                            success: function (data, status, xhr) {
                                                $("#insMachine").html(data);
                                            }
                                        });


                                        if (window.sessionStorage.getItem("member_name")) {


                                            if (window.sessionStorage.getItem("member_type") == "N") {
                                                // $(".type_member_b").trigger("click");
                                                console.log(getParameters('mdibx'));

                                                window.sessionStorage.setItem("member_name", getParameters('mdibx'));
                                                $("#member_ins_name").val(window.sessionStorage.getItem("member_name"));

                                                $('#member_select').val(getParameters('mdibx')).trigger('change');
                                                $("#insComment").html(window.sessionStorage.getItem("comment"));

                                                if (window.sessionStorage.getItem("nullPhone") == "false") {
                                                    $(".nullPhone").prop("checked", false).change();
                                                    $("#insPhone").val(window.sessionStorage.getItem("phone"));
                                                } else {
                                                    $(".nullPhone").prop("checked", true).change();
                                                }

                                            } else {
                                                var idx = window.sessionStorage.getItem("member_name");
                                                $('#member_select').val(idx).trigger('change');

                                            }

                                            $("#ins_contents").html(window.sessionStorage.getItem("contents"));

                                            window.sessionStorage.removeItem("member_type");
                                            window.sessionStorage.removeItem("member_name");
                                            window.sessionStorage.removeItem("comment");
                                            window.sessionStorage.removeItem("phone");
                                            window.sessionStorage.removeItem("nullPhone");
                                            window.sessionStorage.removeItem("contents");
                                        }


                                        if (window.sessionStorage.getItem("member_type")) {


                                            if (window.sessionStorage.getItem("member_type") == "M") {
                                                var idx = window.sessionStorage.getItem("member_name");

                                                $('#member_select').val(idx).trigger('change');

                                            } else {
                                                $(".type_member_b").trigger("click");
                                                $("#member_ins_name").val(window.sessionStorage.getItem("member_name"));
                                                $("#insComment").html(window.sessionStorage.getItem("comment"));

                                                console.log("N");

                                                if (window.sessionStorage.getItem("nullPhone") == "true") {
                                                    $(".nullPhone").prop("checked", true).change();
                                                } else {
                                                    $(".nullPhone").prop("checked", false).change();
                                                    $("#insPhone").val(window.sessionStorage.getItem("phone"));
                                                }
                                            }

                                            $("#ins_contents").html(window.sessionStorage.getItem("contents"));

                                            window.sessionStorage.removeItem("member_type");
                                            window.sessionStorage.removeItem("member_name");
                                            window.sessionStorage.removeItem("comment");
                                            window.sessionStorage.removeItem("phone");
                                            window.sessionStorage.removeItem("nullPhone");
                                            window.sessionStorage.removeItem("contents");
                                        }
                                    },
                                    eventClick: function (calEvent, jsEvent, view) {
                                        var id = calEvent.id;
                                        var data = {idx: id};

                                        $.ajax({
                                            dataType: 'json',
                                            url: '/index.php/dataFunction/getBookingInfo',
                                            data: data,
                                            type: 'POST',
                                            success: function (data, status, xhr) {
                                                if (data.RESULT === 'SUCCESS') {
                                                    // 수정 모달띄우는 부분
                                                    $('#fc_edit').click();
                                                    $('#view_date').html(data.DATE);
                                                    $('#view_stime').html(data.STIME);
                                                    $('#view_etime').html(data.ETIME);
                                                    $('#view_machine').html(data.ID);
                                                    $('#view_name').html(data.NAME);
                                                    $("#memo_area").html(data.MEMO);
                                                    $('#view_picture img').attr("src", data.IMG);
                                                    $('#view_member_comment').html(data.COMMENT);
                                                    $('#view_member_idx').val(data.MEMBER_IDX);
                                                    $('#view_phone').html('<a href="tel:' + data.PHONE + '">' + autoHypenPhone(data.PHONE) + "</a>");
                                                    $('#view_goods_name').html(data.GOODS_NAME + " / " + data.LICENSE_TYPE_TEXT);
                                                    $('#view_in_test_date').html(data.IN_TEST_DATE);
                                                    $('#view_road_test_date').html(data.ROAD_TEST_DATE);
                                                    $('#view_comment').html(data.CONTENTS);
                                                    if (data.ABSENT_YN === 'N') {
                                                        $(".absent_btn").show();
                                                        $(".dis_absent_btn").hide();
                                                    } else {
                                                        $(".absent_btn").hide();
                                                        $(".dis_absent_btn").show();
                                                    }

                                                    // 수정모달에서 인풋들에 들어가는 값
                                                    $("#modify_booking_idx").val(id);
                                                    $(".delete_btn").val(id);
                                                    $(".modify_date_select").val(moment(calEvent.start).format('YYYY-MM-DD'));
                                                    $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                    $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                    $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                    $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                    $(".device_name2").val(data.ID);
                                                    $(".modify_name").val(data.NAME);
                                                    $('.view_picture img').attr("src", data.IMG);

                                                    if (data.PHONE == "01000000000") {
                                                        $(".modify_phone").val("없음");
                                                    } else {
                                                        $(".modify_phone").val(autoHypenPhone(data.PHONE));
                                                    }

                                                    if (!data.GOODS_NAME) {
                                                        $(".modify_goods_name").val("");
                                                    } else {
                                                        $(".modify_goods_name").val(data.GOODS_NAME);
                                                    }

                                                    $('.view_in_test_date').val(data.IN_TEST_DATE);
                                                    $('.view_road_test_date').val(data.ROAD_TEST_DATE);
                                                    $("#modify_contents").val(data.CONTENTS);

                                                    categoryClass = $("#event_type").val();

                                                    if (calEvent.className == "bg_orange") {
                                                        $(".mod_type_b_hidden").find("input").prop("disabled", true);
                                                        $(".mod_type_b_hidden").find("select").prop("disabled", true);
                                                        $(".mod_type_b_hidden").css("display", "none");
                                                    } else {
                                                        $(".mod_type_b_hidden").find("input").prop("disabled", false);
                                                        $(".mod_type_b_hidden").find("select").prop("disabled", false);
                                                        $(".mod_type_b_hidden").css("display", "block");
                                                    }

                                                    // 시간 선택 부분
                                                    $(".modify_hour_select").unbind().bind("change", function () {
                                                        if (parseInt($(".modify_hour_select").val()) > parseInt($(".modify_hour_select_end").val())) {
                                                            $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                            $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                            $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                            $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                            alert("시작 시간이 종료 시간보다 늦습니다.");
                                                        } else if (parseInt($(".modify_hour_select").val()) == parseInt($(".modify_hour_select_end").val())) {
                                                            if (parseInt($(".modify_minute_select").val()) > parseInt($(".modify_minute_select_end").val())) {
                                                                $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                                $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                                alert("시작 시간이 종료 시간보다 늦습니다.");
                                                            }
                                                        }
                                                    });
                                                    $(".modify_minute_select").unbind().bind("change", function () {
                                                        if (parseInt($(".modify_hour_select").val()) == parseInt($(".modify_hour_select_end").val())) {
                                                            if (parseInt($(".modify_minute_select").val()) > parseInt($(".modify_minute_select_end").val())) {
                                                                $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                                $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                                alert("시작 시간이 종료 시간보다 늦습니다.");
                                                            }
                                                        }
                                                    });

                                                    $(".modify_hour_select_end").unbind().bind("change", function () {
                                                        if (parseInt($(".modify_hour_select_end").val()) == 21) {
                                                            $(".modify_minute_select_end").val("00").select();
                                                        }
                                                        if (parseInt($(".modify_hour_select").val()) > parseInt($(".modify_hour_select_end").val())) {
                                                            $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                            $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                            $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                            $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                            alert("시작 시간이 종료 시간보다 늦습니다.");
                                                        } else if (parseInt($(".modify_hour_select").val()) == parseInt($(".modify_hour_select_end").val())) {
                                                            if (parseInt($(".modify_minute_select").val()) > parseInt($(".modify_minute_select_end").val())) {
                                                                $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                                $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                                alert("시작 시간이 종료 시간보다 늦습니다.");
                                                            }
                                                        }
                                                    });
                                                    $(".modify_minute_select_end").unbind().bind("change", function () {
                                                        if (parseInt($(".modify_hour_select_end").val()) == 21) {
                                                            $(".modify_minute_select_end").val("00").select();
                                                        }
                                                        if (parseInt($(".modify_hour_select").val()) == parseInt($(".modify_hour_select_end").val())) {
                                                            if (parseInt($(".modify_minute_select").val()) > parseInt($(".modify_minute_select_end").val())) {
                                                                $(".modify_hour_select").val(moment(calEvent.start).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select").val(moment(calEvent.start).format('mm')).prop("selected", true);

                                                                $(".modify_hour_select_end").val(moment(calEvent.end).format('HH')).prop("selected", true);
                                                                $(".modify_minute_select_end").val(moment(calEvent.end).format('mm')).prop("selected", true);

                                                                alert("시작 시간이 종료 시간보다 늦습니다.");
                                                            }
                                                        }
                                                    });

                                                    // 삭제 부분
                                                    $(".delete_btn").unbind().bind("click", function () {
                                                        if (confirm("삭제하시겠습니까?")) {
                                                            var data = {idx: $(this).val()};
                                                            $.ajax({
                                                                dataType: 'text',
                                                                url: '/index.php/dataFunction/delBooking',
                                                                data: data,
                                                                type: 'POST',
                                                                success: function (data, status, xhr) {
                                                                    if (data === 'SUCCESS') {
                                                                        alert('삭제되었습니다.');
                                                                        location.reload();
                                                                    } else {
                                                                        alert('데이터 처리오류!!');
                                                                        return false;
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });

                                                    //결석 부분
                                                    $(".absent_btn").unbind().bind("click", function () {
                                                        if (confirm("결석처리 하시겠습니까?")) {
                                                            var data = {idx: $("#modify_booking_idx").val()};
                                                            $.ajax({
                                                                dataType: 'text',
                                                                url: '/index.php/dataFunction/absentBooking',
                                                                data: data,
                                                                type: 'POST',
                                                                success: function (data, status, xhr) {
                                                                    if (data === 'SUCCESS') {
                                                                        alert('결석처리되었습니다.');
                                                                        $(".absent_btn").hide();
                                                                        $(".dis_absent_btn").show();
                                                                        modMemberView();
                                                                    } else {
                                                                        alert('데이터 처리오류!!');
                                                                        return false;
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });

                                                    //결석취소 부분
                                                    $(".dis_absent_btn").click(function () {
                                                        if (confirm("결석취소처리 하시겠습니까?")) {
                                                            var data = {idx: $("#modify_booking_idx").val()};
                                                            $.ajax({
                                                                dataType: 'text',
                                                                url: '/index.php/dataFunction/disAbsentBooking',
                                                                data: data,
                                                                type: 'POST',
                                                                success: function (data, status, xhr) {
                                                                    if (data === 'SUCCESS') {
                                                                        alert('결석취소처리되었습니다.');
                                                                        $(".absent_btn").show();
                                                                        $(".dis_absent_btn").hide();
                                                                        modMemberView();
                                                                    } else {
                                                                        alert('데이터 처리오류!!');
                                                                        return false;
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });

                                                    calendar.fullCalendar('unselect');
                                                } else {
                                                    alert('데이터 처리오류!!');
                                                    return false;
                                                }
                                            }
                                        });
                                    },
                                    editable: false,
                                    eventDurationEditable: false,
                                    eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
                                        var strStartDate = moment(event.start).format('YYYY-MM-DD');
                                        var strEndDate = moment(event.end).format('YYYY-MM-DD');
                                        var strStartHour = moment(event.start).format('hh');
                                        var strStartMinute = moment(event.start).format('mm');
                                        var strEndHour = moment(event.end).format('hh');
                                        var strEndMinute = moment(event.end).format('mm');
                                    },
                                    // 드래그 했을 때
                                    eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) {
                                        var strStartDate = moment(event.start).format('YYYY-MM-DD');
                                        var strEndDate = moment(event.end).format('YYYY-MM-DD');
                                        var strStartHour = moment(event.start).format('hh');
                                        var strStartMinute = moment(event.start).format('mm');
                                        var strEndHour = moment(event.end).format('hh');
                                        var strEndMinute = moment(event.end).format('mm');
                                        console.log(moment(event.start).format('YYYY-MM-DD'));
                                        console.log(strStartDate, strEndDate, strStartHour, strStartMinute, strEndHour, strEndMinute);
                                        var evento = $("#calendar").fullCalendar('clientEvents');
                                        // console.log(evento.length);
                                        // console.log(evento.indexOf(event));
                                        for (var i = 0; i < evento.length; i++) {

                                            // 디바이스명 중복 검사
                                            if (evento[i].device == event.device) {

                                                // 지금 움직이는 이벤트는 제외한다
                                                if (i == evento.indexOf(event)) {
                                                    continue;
                                                }
                                            }
                                        }
                                    },
                                    eventRender: function (event, element) {
                                        $(element).find(".fc-title").empty();
                                        $(element).find(".fc-title").html(event.title);
                                    },
                                    eventAfterRender: function (event, element, view) {
                                        if (view.type === "month" || view.type === "agendaWeek" || view.type === "agendaDay") {
                                            $(element).find(".fc-title").empty();
                                            $(element).find(".fc-title").html(event.title);
                                        }

                                        // $(".fc-month-view").find(".fc-title").empty();
                                        // $(".fc-month-view").find(".fc-title").html(event.title);
                                        $(".fc-agendaWeek-view").find(element).css('width', 100 / device_length + '%');
                                        $(".fc-agendaDay-view").find(element).css('width', 100 / device_length + '%');
                                        for (var i = 1; i <= device_length; i++) {
                                            var left = (100 / device_length * i) - (100 / device_length) + '%';
//                                                    var right = (100/device_length*i) - (100/device_length)+'%';
                                            $(".fc-agendaWeek-view").find(".device" + i + "").css({'left': left, 'right': 'auto'});
                                            $(".fc-agendaDay-view").find(".device" + i + "").css({'left': left, 'right': 'auto'});
                                        }
//                                                $(".device1").css({'left': '0', 'right': '80%'});
//                                                $(".device2").css({'left': '20%', 'right': '60%'});
//                                                $(".device3").css({'left': '40%', 'right': '40%'});
//                                                $(".device4").css({'left': '60%', 'right': '20%'});
//                                                $(".device5").css({'left': '80%', 'right': '0'});
                                        // $(".fc-agendaWeek-view").find(element).addClass("custom_class");
                                        // $(".custom_class:nth-child("+ repeat +")").css("left", (100/device_length*repeat) - (100/device_length) + "%" );
                                        // $(".custom_class:nth-child("+ 2 +")").css("left", 100/device_length + "%");
                                    },
                                    eventAfterAllRender: function (view, element) {
                                        if (view.type === "agendaWeek" || view.type === "agendaDay") {
                                            var html = "<table class='device_table'>";
                                            html += "<tr>";
                                            for (var i = 1; i <= device_length; i++) {
                                                html += "<td>";
                                                html += i;
                                                html += "</td>";
                                            }
                                            html += "</tr>";
                                            html += "</table>";
                                            $("#calendar").find('.fc-day-header').append(html);
                                            $("#left_time_line").show();
                                        } else {
                                            $("#left_time_line").hide();
                                        }
                                    },
                                    // 데이터들
                                    events: "/index.php/dataFunction/getEvent"
                                });


// $(document).bind( 'scroll', function() {

//         var scroll= $(document).scrollTop();

//         if ( scroll >= 150 ) {

//             $('.fc-head').css({'position':'fixed'});
//             $('.fc-body').css({'marign-top':$('.fc-head').height()+'px'});
//         }
// });

                            }

                            function insFormChk(obj) {
                                var booking_date = $("#insDate").val();
                                var reservation_time1 = $("#insStime").select().val();
                                var reservation_time2 = $("#insStime_min").select().val();
                                var reservation_time3 = $("#insEtime").select().val();
                                var reservation_time4 = $("#insEtime_min").select().val();
                                var machine_info_idx = $("#insMachine").select().val();
                                var member_type = $(".member_type:checked").val();
// var member_phone = $("input[name='phone']").val();
                                if ($("#insPhone").prop("disabled")) {
                                    var member_phone = $("#insPhoneHidden").val();
                                } else {
                                    var member_phone = $("#insPhone").val();
                                }
                                var member_ins_name = $("#member_ins_name").val();

                                if (!$.trim(booking_date)) {
                                    alert("예약일을 선택해주세요.");
                                    return false;
                                } else if (!reservation_time1 || !reservation_time2 || !reservation_time3 || !reservation_time4) {
                                    alert("시간을 선택해주세요.");
                                    return false;
                                } else if (!$.trim(machine_info_idx) && $(".type:checked").val() === 'B') {
                                    alert("기기를 선택해주세요.");
                                    return false;
                                } else if (member_type === 'M' && $(".type:checked").val() === 'B') {
                                    if (!$.trim(member_phone)) {
                                        alert("회원정보 처리의 오류입니다.\n관리자에게 문의하세요.");
                                        return false;
                                    } else {
                                        window.sessionStorage.setItem("defaultView", booking_date);
                                        obj.submit();
                                    }
                                } else if (member_type === 'N') {
                                    if (!$.trim(member_ins_name)) {
                                        alert("등록할 회원명을 입력하세요.");
                                        return false;
                                    } else if (!$.trim(member_phone)) {
                                        alert("등록할 회원 연락처를 입력하세요.");
                                        return false;
                                    } else {
                                        var data = {name: member_ins_name, phone: member_phone};
                                        $.ajax({
                                            dataType: 'text',
                                            url: '/index.php/dataFunction/chkDupleMember',
                                            data: data,
                                            type: 'POST',
                                            success: function (data, status, xhr) {
                                                if (data == 'DUPLE') {
                                                    alert('이미 등록된 연락처입니다.');
//                                            $("#member_ins_name").val('');
                                                    $("#insPhone").val('');
                                                    $("#insPhone").focus();
                                                    return false;
                                                } else if (data === 'SUCCESS') {
                                                    window.sessionStorage.setItem("defaultView", booking_date);
                                                    obj.submit();
                                                }
                                            }
                                        });
                                    }
                                } else {
                                    window.sessionStorage.setItem("defaultView", booking_date);
                                    obj.submit();
                                }
                            }

                            function defaultToday() {
// 새 일정 모달에서 예약일 디폴트 값
                                return moment(new Date()).format('YYYY-MM-DD');
                            }


                            function modMemberView() {
                                var member_idx = $("#view_member_idx").val();
                                var data = {member_idx: member_idx};
                                $.ajax({
                                    url: '/index.php/dataFunction/modMemberView',
                                    data: data,
                                    type: 'POST',
                                    success: function (data, status, xhr) {
                                        $("#modifyMemberModal").empty();
                                        $("#modifyMemberModal").append(data);
                                        $("#modifyMemberModal").modal();
                                    }
                                });
                            }


                            function openMemberView() {
                                var member_idx = $("#view_member_idx").val();
                                var data = {member_idx: member_idx};
                                $.ajax({
                                    dataType: 'json',
                                    url: '/index.php/dataFunction/calendaerViewMemberInfo',
                                    data: data,
                                    type: 'POST',
                                    success: function (data, status, xhr) {
                                        if (data.RESULT === 'SUCCESS') {
                                            $("#member_branch").html(data.BRANCH_NAME);
                                            $("#member_name").html(data.NAME);
                                            $("#member_birth").html(data.BIRTH);
                                            $("#member_addr").html(data.ADDR);
                                            $("#member_detail_addr").html(data.DETAIL_ADDR);
                                            $("#member_phone").html(autoHypenPhone(data.PHONE));
                                            $("#member_timestamp").html(data.TIMESTAMP);
                                            $("#member_goods").html(data.GOODS_NAME + " / " + data.LICENSE_TYPE_TEXT);
                                            $("#member_etc_pay").html(data.ETC_PRICE);
                                            $("#member_visit").html(data.MEMBER_VISIT_ROUTE);
                                            $("#member_practice").html(data.MEMBER_PRACTICE);
                                            if (data.IN_TEST_YN === 'Y') {
                                                $("#in_test").html('<label class="skill_test skill_test1" id="in_test">장내기능 시험 &nbsp;&nbsp; </label>' + data.IN_TEST_DATE + '<br>');
                                            } else {
                                                $("#in_test").html('<label class="skill_test skill_test1" id="in_test">장내기능 시험 &nbsp;&nbsp; </label><br>');
                                            }

                                            if (data.ROAD_TEST_YN === 'Y') {
                                                $("#road_test").html('<label class="road_test road_test1" id="road_test">도로주행 시험 &nbsp;&nbsp; </label>' + data.ROAD_TEST_DATE + '');
                                            } else {
                                                $("#road_test").html('<label class="road_test road_test1" id="road_test">도로주행 시험 &nbsp;&nbsp; </label>');
                                            }


                                            $("#member_test_site").html(data.TS_NAME);
                                            $("#member_img").attr('src', data.IMG);
                                            $("#member_final").html(data.FINAL_YN);
                                            $("#member_comment").html(data.COMMENT);
                                            $("#member_history").html(data.BOOKING_HISTORY);
                                            $("#memberViewModal").modal();
                                        } else {
                                            alert('데이터 처리오류!!');
                                            return false;
                                        }

                                    }
                                });

                            }


                            function autoHypenPhone(str) {
                                str = str.replace(/[^0-9]/g, '');
                                var tmp = '';
                                if (str.length < 4) {
                                    return str;
                                } else if (str.length < 7) {
                                    tmp += str.substr(0, 3);
                                    tmp += '-';
                                    tmp += str.substr(3);
                                    return tmp;
                                } else if (str.length < 11) {
                                    tmp += str.substr(0, 3);
                                    tmp += '-';
                                    tmp += str.substr(3, 3);
                                    tmp += '-';
                                    tmp += str.substr(6);
                                    return tmp;
                                } else {
                                    tmp += str.substr(0, 3);
                                    tmp += '-';
                                    tmp += str.substr(3, 4);
                                    tmp += '-';
                                    tmp += str.substr(7);
                                    return tmp;
                                }
                                return str;
                            }


                            var getParameters = function (paramName) {
// 리턴값을 위한 변수 선언
                                var returnValue;

// 현재 URL 가져오기
                                var url = location.href;

// get 파라미터 값을 가져올 수 있는 ? 를 기점으로 slice 한 후 split 으로 나눔
                                var parameters = (url.slice(url.indexOf('?') + 1, url.length)).split('&');

// 나누어진 값의 비교를 통해 paramName 으로 요청된 데이터의 값만 return
                                for (var i = 0; i < parameters.length; i++) {
                                    var varName = parameters[i].split('=')[0];
                                    if (varName.toUpperCase() == paramName.toUpperCase()) {
                                        returnValue = parameters[i].split('=')[1];
                                        return decodeURIComponent(returnValue);
                                    }
                                }
                            };

                            function numberWithCommas(x) {
                                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

</script>
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
                            function openDaumPostcode() {
                                new daum.Postcode({
                                    oncomplete: function (data) {
                                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                                        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
//    $("#zip_code").val(data.postcode1 + "-" + data.postcode2);
//                                        document.getElementById('post2').value = data.postcode2;
                                        //                                        document.getElementById('addr').value = data.address;
                                        $("#addr1").val(data.address);
                                        //전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
                                        //아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
                                        //var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
                                        //document.getElementById('addr').value = addr;

                                        $('#addr2').focus();
                                    }
                                }).open();
                            }

                            function openDaumPostcode2() {
                                new daum.Postcode({
                                    oncomplete: function (data) {
                                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                                        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
//    $("#zip_code").val(data.postcode1 + "-" + data.postcode2);
//                                        document.getElementById('post2').value = data.postcode2;
                                        //                                        document.getElementById('addr').value = data.address;
                                        $("#mod_addr1").val(data.address);
                                        //전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
                                        //아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
                                        //var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
                                        //document.getElementById('addr').value = addr;

                                        $('#mod_addr2').focus();
                                    }
                                }).open();
                            }
</script>

<script language="JavaScript">

    function configure(idx) {
        Webcam.set({
            width: 280,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90,
            upload_name: 'file'
        });
        Webcam.attach('.my_camera' + idx);
    }

    function take_snapshot(idx) {
        Webcam.snap(function (data_uri) {
            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            // $('.camera_results'+ idx).html('<img class="imageprev' + idx +  '" src="'+data_uri+'"/>');

            $(".webcam_input" + idx).val(raw_image_data);
        });
        // Webcam.reset();
    }

    function saveSnap(idx) {
        var base64image = $(".imageprev" + idx).attr("src");

        Webcam.upload(base64image, '/index.php/dataFunction/webcamUpload', function (code, text) {
            console.log('Save successfully');
        });

    }
</script>