<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>임시 보관함 <small>삭제된 회원의 목록입니다.</small></h3>
        </div>

        <div class="title_right">
            <div class="col-md-10 col-sm-10 col-xs-12 form-group pull-right top_search">
                <div class="input-group" style="width:60%; float:right;">
                    <input type="text" class="form-control" id="search_text" placeholder="Search for..." value="<?= $text ?>" style="display:inline-block;">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="search_btn" type="button">Go!</button>
                    </span>
                </div>
                <select id="search_select" style="">
                    <option value="contents">이름</option>
                    <option value="phone">연락처</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="/index/calender">
                            <button type="button" class="btn btn-success" style="margin-right: 10px;">예약 현황</button>
                        </a>
                        <small>임시 보관함에서 회원을 삭제 시 영구적으로 삭제됩니다.</small>

                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li style="margin-left: 5px;">
                                <input type="text" id="sdate" class="form-control date excel_date" placeholder="가입기간시작일">
                            </li>
                            <li style="margin-left: 5px;">
                                <input type="text" id="edate" class="form-control date excel_date" placeholder="가입기간종료일">
                            </li>
                            <li style="margin-left: 5px;">
                                <button type="button" class="btn btn-default" onclick="location.href = '/index.php/dataFunction/memExcelDown?sdate=' + $('#sdate').val() + '&edate=' + $('#edate').val() + '&branch_idx=<?= $this->session->userdata('BRANCH_IDX') ?>'">엑셀 다운로드</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-primary" id="restoreCheckMemberBtn">선택 복구</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-warning" id="delCheckMemberBtn">선택 영구삭제</button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped jambo_table bulk_action sortable table_responsive_xxl">
                            <colgroup>
                                <col width="30px"><col width="80px"><!-- <col width="80px"> --><col width="*"><col width="150px"><col width="*"><col width="100px"><col width="*"><col width="*"><col width="240px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="sort_none">
                                        <input type="checkbox" name="" value="" class="cAll">
                                    </th>
                                    <th class="min_80px">이름</th>
                                    <th class="min_110px">연락처</th>
                                    <!-- <th class="min_80px">예약하기</th> -->
                                    <th class="min_200px">상품</th>
                                    <th class="min_150px">잔여시간</th>
                                    <th class="min_200px">시험예정일</th>
                                    <th class="min_110px">최종합격여부</th>
                                    <th class="min_50px">지점</th>
                                    <th class="min_50px">추가알림</th>
                                    <th class="min_200px">가입일자</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($member_lists as $row) { ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="member_idx" value="<?= $row['MEMBER_IDX'] ?>" class="cDown">
                                    </td>
                                    <td class="cursor">
                                        <a onclick="openModModal('<?= $row['MEMBER_IDX'] ?>');"><?= $row['NAME'] ?></a>
                                        <!-- 회원 수정 및 삭제 모달 -->
                                        <div id="modifyModal_<?= $row['MEMBER_IDX'] ?>" title="회원 수정 및 삭제" class="modal fade modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="modifyModalLabel">회원 수정 및 삭제<small>회원의 정보를 정확하게 입력해주세요</small></h4>
                                                    </div>
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modMember">
                                                        <input type="hidden" name="member_idx" id="member_idx" value="<?= $row['MEMBER_IDX'] ?>">
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
                                                                        <input type="text" class="form-control" name="name" value="<?= $row['NAME'] ?>"  maxlength="4" placeholder="이름" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom: 15px;">
                                                                    <label class="col-xs-3 control-label">생년월일</label>
                                                                    <div class="col-xs-9">
                                                                        <?php
                                                                        $str = $row['BIRTH'];
                                                                        $str2 = explode('-', $str);
                                                                        ?>
                                                                        <select class="form-control dp_ib birth_year" style="width:calc(33% - 2px);">
                                                                            <option disabled selected>년</option>
                                                                            <?php
                                                                            for ($i = 1960; $i <= 2017; $i++) {
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
                                                                <input type="hidden" name="birth" value="<?=$row['BIRTH']?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">주소</label>
                                                            <div class="col-xs-9">
                                                                <input class=" form-control" type="text" id="mod_addr1" name="addr" value="<?= $row['ADDR'] ?>" placeholder="주소를 입력해주세요." onclick="openDaumPostcode2();" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">상세주소</label>
                                                            <div class="col-xs-9">
                                                                <input class=" form-control" type="text" id="mod_addr2" name="detail_addr" value="<?= $row['DETAIL_ADDR'] ?>" maxlength="100" placeholder="상세주소를 입력해주세요.">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">연락처</label>
                                                            <div class="col-xs-9">
                                                                <?php
                                                                if($row['PHONE'] == "01000000000"){
                                                                    ?>
                                                                    <input type="text" class="form-control" name="phone" placeholder="01012341234" value="" maxlength="13" pattern="[0-9,-]*" onblur="modChkPhone($(this).val(),<?= $row['MEMBER_IDX'] ?>);" required disabled style="display:inline-block; width: 66%;">
                                                                    <?php
                                                                }else {
                                                                    ?>
                                                                    <?php $phone = preg_replace("/(^02.{0}|^01.{1}|^07.{1}|^03.{1}|^04.{1}|^15.{2}|^16.{2}|^18.{2}|^0502.{0}|^0503.{0}|^0504.{0}|^0505.{0}|^0506.{0}|^0507.{0}|^0508.{0}|^06.{1}|^05.{1}|[0-9]{4})([0-9]+)([0-9]{4})/", "$1-$2-$3", $row['PHONE']);$phone_exp = explode('-', $phone); ?>
                                                                    <input type="text" class="form-control" name="phone" placeholder="01012341234" value="<?= $phone_exp[0] ?>-<?= $phone_exp[1] ?>-<?= $phone_exp[2] ?>" maxlength="13" pattern="[0-9,-]*" onblur="modChkPhone($(this).val(),<?= $row['MEMBER_IDX'] ?>);" required style="display:inline-block; width: 66%;">
                                                                    <?php 
                                                                }  
                                                                ?> 
                                                                <label class="" style="margin:5px 3px; width: calc(33% - 17px); display: inline-block;">
                                                                    <?php
                                                                    if($row['PHONE'] == "01000000000"){
                                                                        ?>
                                                                        <input type="hidden" class="form-control nullPhoneChk" name="phone" maxlength="13" pattern="[0-9,-]*" value="010-0000-0000">
                                                                        <input type="checkbox" class="nullPhone" checked style="vertical-align: middle;margin: 0;"> <span style="display: inline-block;color: #73879C;vertical-align: middle;">연락처 없음</span>
                                                                        <?php
                                                                    }else {
                                                                        ?>
                                                                        <input type="hidden" class="form-control nullPhoneChk" name="phone" maxlength="13"  pattern="[0-9,-]*" value="010-0000-0000" disabled style="vertical-align: middle;margin: 0;">
                                                                        <input type="checkbox" class="nullPhone" style="vertical-align: middle;margin: 0;"> <span style="display: inline-block;color: #73879C;vertical-align: middle;">연락처 없음</span>
                                                                        <?php        
                                                                    }
                                                                    ?>   
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">접수일</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio"  style="display: inline-block; margin-right: 10px">
                                                                    <label class="now_time">
                                                                        <input type="radio" <?php if ($row['INS_TYPE'] == 'T') echo 'checked'; ?> value="T" name="ins_type"> 현재시각
                                                                    </label>
                                                                </div>
                                                                <div class="radio" style="display: inline-block; margin-right: 10px">
                                                                    <label class="choice_time">
                                                                        <input type="radio" <?php if ($row['INS_TYPE'] == 'D') echo 'checked'; ?> value="D" name="ins_type"> 지정일
                                                                    </label>
                                                                </div>
                                                                <div class="input-group date apply_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" disable style="margin-top: 10px; display: none;<?php if ($row['INS_TYPE'] == 'D') echo 'display: table;'; ?>">
                                                                    <div class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                    <input type="text" name="timestamp" class="form-control" value="<?= $row['INS_DATE'] ?>" placeholder="날짜지정">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">상품/결제형태</label>
                                                            <div class="col-xs-9">
                                                                <?php foreach (${'member_goods' . $row['MEMBER_IDX']} as $subRow) { ?>
                                                                <div class="form-inline mb5">
                                                                    <?php echo '<span class="member_list">' . $subRow['GOODS_NAME'] . $subRow['LICENSE_TYPE_TEXT'] . '/' . $subRow['PAYMENT_NAME'] . '/' . $subRow['EVENT_NAME'] . '(' . number_format($subRow['TOT_PRICE']) . '원)' . '</span>'; ?>
                                                                    <button class="btn btn-default minus goods_del_btn" type="button" style="vertical-align: top;" value="<?= $subRow['MEMBER_GOODS_IDX'] ?>">-</button>
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
                                                                <?php foreach (${'member_etc_pay' . $row['MEMBER_IDX']} as $subRow) { ?>
                                                                <div class="form-inline mb5">
                                                                    <input type="text" placeholder="기타결제명" value="<?= $subRow['NAME'] ?>" class="form-control" maxlength="20" style="display: inline-block;  width: calc(50% - 28px);">
                                                                    <input type="text" placeholder="기타결제금액" value="<?= $subRow['PRICE'] ?>" pattern="[-0-9]*" maxlength="7" class="form-control" style="display: inline-block;  width: calc(50% - 28px);">
                                                                    <button class="btn btn-default minus etc_del_btn" type="button" style="vertical-align: top;" value="<?= $subRow['MEMBER_ETC_PAY_IDX'] ?>">-</button> 
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
                                                                <?php foreach (${'member_visit_route' . $row['MEMBER_IDX']} as $visit_row) { ?>
                                                                <label class="" style="margin:5px 3px;">
                                                                    <input type="checkbox" class="checkbox" value="<?= $visit_row['VISIT_ROUTE_IDX'] ?>" name="visit_route_idx[]" <?= $visit_row['CHECKED'] ?>>
                                                                    <?= $visit_row['NAME'] ?>
                                                                </label>
                                                                <?php } ?>
                                                                <input type="text" class="form-control" name="in_route_comment" value="<?= $row['IN_ROUTE_COMMENT'] ?>" placeholder="지인의 이름 또는 기타 사항을 메모해두세요">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">지금까지 연습방법</label>
                                                            <div class="col-xs-9">
                                                                <?php foreach (${'member_practice' . $row['MEMBER_IDX']} as $practice_row) { ?>
                                                                <label class="" style="margin:5px 3px;">
                                                                    <input type="checkbox" class="checkbox" value="<?= $practice_row['PRACTICE_IDX'] ?>" name="practice_idx[]" <?= $practice_row['CHECKED'] ?>>
                                                                    <?= $practice_row['NAME'] ?>
                                                                </label>
                                                                <?php } ?>
                                                                <input type="text" class="form-control" name="practice_comment" value="<?= $row['PRACTICE_COMMENT'] ?>" placeholder="타 학원 또는 기타 사항을 메모해두세요">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-xs-3 control-label">시험응시 예정/일자</label>
                                                            <div class="col-xs-9">
                                                                <label class="skill_test skill_test1" style="margin:5px 3px;">
                                                                    <input type="checkbox" class="skill_test_chk" name="in_test_yn" value="Y" <?php if ($row['IN_TEST_YN'] == 'Y') echo 'checked'; ?> style="margin: 0;vertical-align: middle;">
                                                                    <span style="color:#73879C; vertical-align: middle;">장내기능 시험</span>
                                                                </label>
                                                                <div class="input-group date  skill_test_input" data-provide="datepicker" data-date-format="yyyy-mm-dd" style="width:100%;">
                                                                    <div class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="in_test_date" value="<?= $row['MOD_TEST_DATE'] ?>" placeholder="날짜지정" minlength="10" maxlength="10" <?php if ($row['IN_TEST_YN'] == 'N') echo 'disable'; ?> style="width: calc(33.3% - 2px)">
                                                                    <select name="in_test_time" style="width: calc(33.3% - 2px)">
                                                                        <?php
                                                                        for ($i = 0; $i < 24; $i++) {
                                                                            if ($i < 10) {
                                                                                $time = '0' . $i;
                                                                            } else {
                                                                                $time = $i;
                                                                            }
                                                                            ?>
                                                                            <option value="<?= $time ?>" <?php if ($time == $row['MOD_TEST_DATE_TIME']) echo 'selected'; ?>><?= $time ?>시</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <select name="in_test_min" style="width: calc(33.3% - 2px)">
                                                                            <?php
                                                                            for ($i = 0; $i <= 5; $i++) {
                                                                                ?>
                                                                                <option value="<?= $i . '0' ?>" <?php if ($i . '0' == $row['MOD_TEST_DATE_MIN']) echo 'selected'; ?>><?= $i . '0' ?>분</option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <label class="road_test road_test1" style="margin:5px 3px;">
                                                                            <input type="checkbox" class="road_test_chk" name="road_test_yn" value="Y" <?php if ($row['ROAD_TEST_YN'] == 'Y') echo 'checked'; ?> style="margin:0; vertical-align: middle;">
                                                                            <span style="color:#73879C; vertical-align: middle;">도로주행 시험</span>
                                                                        </label>
                                                                        <div class="input-group date road_test_input" data-provide="datepicker" data-date-format="yyyy-mm-dd"  style="width:100%;">
                                                                            <div class="input-group-addon">
                                                                                <span class="fa fa-calendar"></span>
                                                                            </div>
                                                                            <input type="text" class="form-control" name="road_test_date" value="<?= $row['MOD_ROAD_DATE'] ?>" placeholder="날짜지정" minlength="10" maxlength="10" <?php if ($row['ROAD_TEST_YN'] == 'N') echo 'disable'; ?> style="width: calc(33.3% - 2px)">
                                                                            <select name="road_test_time" style="width: calc(33.3% - 2px)">
                                                                                <?php
                                                                                for ($i = 0; $i < 24; $i++) {
                                                                                    if ($i < 10) {
                                                                                        $time = '0' . $i;
                                                                                    } else {
                                                                                        $time = $i;
                                                                                    }
                                                                                    ?>
                                                                                    <option value="<?= $time ?>" <?php if ($time == $row['MOD_ROAD_DATE_TIME']) echo 'selected'; ?>><?= $time ?>시</option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                <select name="road_test_min" style="width: calc(33.3% - 2px)">
                                                                                    <?php
                                                                                    for ($i = 0; $i <= 5; $i++) {
                                                                                        ?>
                                                                                        <option value="<?= $i . '0' ?>" <?php if ($i . '0' == $row['MOD_ROAD_DATE_MIN']) echo 'selected'; ?>><?= $i . '0' ?>분</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                                            <label class="col-xs-3 control-label">응시 예정 시험장</label>
                                                                            <div class="col-xs-9">
                                                                                <input type="text" class="form-control autocomplete" value="<?= $row['TEST_SITE_NAME'] ?>" name="test_site" placeholder="시험장을 입력해주세요.">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                                            <label class="col-xs-3 control-label">사진첨부</label>
                                                                            <?php if (!$row['IMG']) { ?>
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
                                                                                    <div class="my_camera<?=$row['MEMBER_IDX']?>" style="width:280px; height:200px; border:1px dashed #ccc; margin-bottom: 10px;"></div>
                                                                                    <input type=button value="웹캠 준비" onClick="configure(<?=$row['MEMBER_IDX']?>)" style="color:#000;">
                                                                                    <input type=button value="사진 촬영" onClick="take_snapshot(<?=$row['MEMBER_IDX']?>)" style="color:#000;">
                                                                                    <!-- <input type=button value="저장" onClick="saveSnap(<?=$row['MEMBER_IDX']?>)" style="color:#000;"> -->
                                                                                    <input class="webcam_input<?=$row['MEMBER_IDX']?>" type="hidden" name="file" value=""/>
                                                                                    <div class="camera_results<?=$row['MEMBER_IDX']?>"  style="margin-top: 10px;"></div>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else { ?>
                                                                            <div class="col-xs-9">
                                                                                <div class="img_input_wrapper">
                                                                                    <img src="<?= $row['IMG'] ?>" style="width: 200px">
                                                                                    <button type="button" class="del_img_btn" value="<?= $row['MEMBER_IDX'] ?>">
                                                                                        <img src="/images/delete-button.png" alt="삭제" style="width:20px;">
                                                                                    </button>
                                                                                </div>
                                                                                <input type="hidden" name="org_img" value="<?= $row['IMG'] ?>">
                                                                                
                                                                            </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                        
                                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                                            <label class="col-xs-3 control-label">사전상담여부</label>
                                                                            <div class="col-xs-9">
                                                                                <label  style="margin:5px 3px;">
                                                                                    <input type="checkbox" class="checkbox" name="proceeding_yn" value="Y" <?php if($row['PROCEEDING_YN'] == 'Y') echo 'checked'; ?>>
                                                                                    진행
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                                            <label class="col-xs-3 control-label">최종합격여부</label>
                                                                            <div class="col-xs-9">
                                                                                <label  style="margin:5px 3px;">
                                                                                    <input type="checkbox" class="checkbox" name="final_yn" value="Y" <?php if ($row['FINAL_YN'] == '합격') echo 'checked'; ?>>
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

                                                                                <?php foreach (${'member_memo' . $row['MEMBER_IDX']} as $subRow) { ?>
                                                                                <div class="form-inline mb5">
                                                                                    <input type="text" name="date[]" value="<?= $subRow['DATE'] ?>" placeholder="날짜지정" class="form-control date" maxlength="20" style="display: inline-block; width: calc(35% - 28px);" required>
                                                                                    <input type="text" name="comment[]" value="<?= $subRow['CONTENTS'] ?>" placeholder="교육내용" class="form-control" style="display: inline-block; width: calc(65% - 15px);" required>
                                                                                    <button class="btn btn-default minus" value="<?= $subRow['MEMBER_MEMO_IDX'] ?>" type="button" style="vertical-align: top;">-</button>
                                                                                </div>
                                                                                <?php } ?>
                                                                                <div class="append_target comment_btn">
                                                                                    <button class="btn btn-success plus" type="button">+</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                                            <label class="col-xs-3 control-label">예약/사용 내역</label>
                                                                            <div class="col-xs-9">
                                                                                <div name="booking_history" class="booking_history"><?= $row['BOOKING_HISTORY'] ?></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="location_name" value="member_delete">
                                                                    <button type="button" class="btn btn-warning antosubmit del_member_btn" value="<?= $row['MEMBER_IDX'] ?>">영구삭제</button>
                                                                    <button type="button" class="btn btn-primary antosubmit" value="<?= $row['MEMBER_IDX'] ?>">복구</button>
                                                                    <button type="submit" class="btn btn-success antosubmit">수정</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if( $row['PHONE'] != '01000000000'){ ?>
                                                <a href="tel:<?= $row['PHONE'] ?>">
                                                    <?php
                                                    $phone = preg_replace("/(^02.{0}|^01.{1}|^07.{1}|^03.{1}|^04.{1}|^15.{2}|^16.{2}|^18.{2}|^0502.{0}|^0503.{0}|^0504.{0}|^0505.{0}|^0506.{0}|^0507.{0}|^0508.{0}|^06.{1}|^05.{1}|[0-9]{4})([0-9]+)([0-9]{4})/", "$1-$2-$3", $row['PHONE']);
                                                    $phone_exp = explode('-', $phone);
                                                    ?>
                                                    <?= $phone_exp[0] ?>-<?= $phone_exp[1] ?>-<?= $phone_exp[2] ?>
                                                </a>
                                                <?php 
                                            } else {
                                                ?>
                                                없음
                                                <?php 
                                            }
                                            ?>
                                        </td>
                                        <!-- <td><a style="text-decoration: underline;" onclick="openCalenderModalNew('<?= $row['MEMBER_IDX'] ?>');">예약하기</a></td> -->
                                        <td><?= $row['GOODS_NAME'] ?></td>
                                        <td><?= ${'time' . $row['MEMBER_IDX']} ?></td>
                                        <td>
                                            <?php if ($row['IN_TEST_YN'] == 'Y' && $row['ROAD_TEST_YN'] == 'Y') { ?>
                                            기능 <?= $row['IN_TEST_DATE'] ?> / 주행  <?= $row['ROAD_TEST_DATE'] ?>
                                            <?php } ?>
                                            <?php if ($row['IN_TEST_YN'] == 'Y' && $row['ROAD_TEST_YN'] == 'N') { ?>
                                            기능 <?= $row['IN_TEST_DATE'] ?>
                                            <?php } ?>
                                            <?php if ($row['IN_TEST_YN'] == 'N' && $row['ROAD_TEST_YN'] == 'Y') { ?>
                                            주행  <?= $row['ROAD_TEST_DATE'] ?>
                                            <?php } ?>
                                        </td>
                                        <td><?= $row['FINAL_YN'] ?></td>
                                        <td><?= $row['BRANCH_NAME'] ?></td>
                                        <td>
                                            <?php
                                            $now_time = date('Y-m-d H:i:s');
                                            $use_time_check = strtotime($now_time) - strtotime($row['MEMBER_GOODS_TIME']); //대상 날짜 및 시간 필드
                                            $use_total_time = $use_time_check;

                                            $use_days = floor($use_total_time / 86400);
                                            if ($row['MEMBER_GOODS_TIME']) {
                                                if ($use_days > 90 && $row['FINAL_YN'] == 'N') {
                                                    echo '[3개월 지남]';
                                                } else {
                                                    echo '-';
                                                }
                                            } else {
                                                echo '상품없음';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= $row['TIMESTAMP'] ?>
                                            <?php
                                            $time_check = strtotime($now_time) - strtotime($row['TIMESTAMP']); //대상 날짜 및 시간 필드

                                            $total_time = $time_check;

                                            $days = floor($total_time / 86400);
                                            $time = $total_time - ($days * 86400);
                                            $hours = floor($time / 3600);
                                            $time = $time - ($hours * 3600);
                                            $min = floor($time / 60);
                                            $sec = $time - ($min * 60);

                                            if ($days == 0 && $hours == 0 && $min == 0)
                                                echo "[D+" . $sec . "초 경과]";
                                            else if ($days == 0 && $hours == 0)
                                                echo "[D+" . $min . "분 경과]";
                                            else if ($days == 0)
                                                echo "[D+" . $hours . "시간 경과]";
                                            else
                                                echo "[D+" . $days . "일 경과]";
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- end project list -->
                            <?= $pagination ?>
                        </div>
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
                            <?php 
                            echo nl2br($refunds_info->REFUNDS);
                            ?>
                        </div>
                    </div>
                    <div class="terms_modal_content">
                        <p>개인정보 수집동의 관리</p>
                        <div>
                            <?php 
                            echo nl2br($privacy_info->PRIVACY);
                            ?>
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

    <!-- typeahead -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addModal').on('show.bs.modal', function (e) {
                $(".goods_area_added").remove();
                $(".etc_area_added").remove();
            });
            $('.modifyModal').on('show.bs.modal', function (e) {
                $(".goods_area_added").remove();
                $(".etc_area_added").remove();
            });

            $("#search_text").keydown(function (key) {
                var gubun = $("#search_select").val();
                var text = $("#search_text").val();

                if (!$.trim(text)) {
                    text = 'none';
                }

                if (key.keyCode == 13) {
                    if (text !== 'none') {
                        location.href = '/index/member/q/gubun/' + gubun + '/text/' + text + '';
                    } else {
                        location.href = '/index/member';
                    }
                }
            });

            $("#search_btn").click(function () {
                var gubun = $("#search_select").val();
                var text = $("#search_text").val();

                if (!$.trim(text)) {
                    text = 'none';
                }

                if (text !== 'none') {
                    location.href = '/index/member/q/gubun/' + gubun + '/text/' + text + '';
                } else {
                    location.href = '/index/member';
                }
            });

                    // 예약하기 모달 쪽 스크립트
                    $(".nullPhone").change(function(){
                        if($(this).prop("checked")){
                            $(this).parent().parent().find($("input[name='phone']")).attr("disabled","disabled");
                            $(this).parent().find($(".nullPhoneChk")).removeAttr("disabled");
                        }else {
                            $(this).parent().parent().find($("input[name='phone']")).removeAttr("disabled");
                            $(this).parent().find($(".nullPhoneChk")).attr("disabled","disabled");
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
                        });
                    });

                    $(".comment_btn .plus").click(function(){
                        $.post("/index.php/dataFunction/member_comment_add",function(data){
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

                    // 전체 체크박스 스크립트
                    $(".cAll").click(function () {
                        if ($(this).prop("checked")) {
                            $(".cDown").prop("checked", true);
                        } else {
                            $(".cDown").prop("checked", false);
                        }
                    });
                    $(".cDown").click(function () {
                        if ($(".cDown:checked").length == $(".cDown").length) {
                            $(".cAll").prop("checked", true);
                        } else {
                            $(".cAll").prop("checked", false);
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

                    // 현재 시간 라디오 누를시 
                    $(".now_time").click(function () {
                        $(this).parent().siblings(".apply_date").find("input").val(getTimeStamp());
                        $(this).parent().siblings(".apply_date").css("display", "none");
                    });

                    $(".choice_time").click(function () {
                        $(this).parent().siblings(".apply_date").find("input").val("");
                        $(this).parent().siblings(".apply_date").css("display", "table");
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


                        });                        

                        
                    });

                    $(".del_member_btn").click(function () {
                        if (confirm("임시보관함에서의 삭제는 영구적으로 회원이 삭제됩니다. 회원을 삭제하시겠습니까?")) {
                            var idx = $(this).val();
                            var data = {idx: idx};

                            $.ajax({
                                dataType: 'text',
                                url: '/index.php/dataFunction/delMember',
                                data: data,
                                type: 'POST',
                                success: function (data, status, xhr) {
                                    if (data === 'SUCCESS') {
                                        alert('삭제 되었습니다.');
                                        location.reload();
                                    } else {
                                        alert('데이터 처리오류!!');
                                        return false;
                                    }
                                }
                            });
                        }
                    });

                    $("#restoreCheckMemberBtn").click(function(){
                        var check = $('.cDown:checked').length;
                        var check_number = "";
                        if (check == 0) {
                            alert('회원을 체크 해주세요.');
                            return false;
                        } else {
                            if (confirm("선택 회원을 복구하시겠습니까?")) {

                                    $(".cDown:checked").each(function (index) {
                                        check_number += $(this).val() + ",";
                                    });
                                    var appNum = check_number.substr(0, check_number.length - 1);
                                    var data = {idx: appNum};
                                    $.ajax({
                                        dataType: 'text',
                                        url: '/index.php/dataFunction/memberRestore',
                                        data: data,
                                        type: 'POST',
                                        success: function (data, status, xhr) {
                                            alert("복구 되었습니다.");
                                            location.reload();
                                        }
                                    });
                            }
                        }
                    })

                    $("#delCheckMemberBtn").click(function () {
                        var check = $('.cDown:checked').length;
                        var check_number = "";
                        if (check == 0) {
                            alert('회원을 체크 해주세요.');
                            return false;
                        } else {
                            if (confirm("선택 회원을 삭제하시겠습니까?")) {
                                if (confirm("임시보관함에서의 삭제는 영구적으로 회원이 삭제됩니다. 회원을 삭제하시겠습니까?")) {

                                    $(".cDown:checked").each(function (index) {
                                        check_number += $(this).val() + ",";
                                    });
                                    var appNum = check_number.substr(0, check_number.length - 1);
                                    var data = {idx: appNum};
                                    $.ajax({
                                        dataType: 'text',
                                        url: '/index.php/dataFunction/delMember',
                                        data: data,
                                        type: 'POST',
                                        success: function (data, status, xhr) {
                                            alert("삭제 되었습니다.");
                                            location.reload();
                                        }
                                    });
                                }
                            }
                        }
                    });

                    $("input[name='phone']").keyup(function(){
                        $(this).val(autoHypenPhone($(this).val()));
                    });

                    $(".copysubmit").on("click",function(e){
                        e.preventDefault();
                        window.sessionStorage.setItem("member_name",$("#member_select").select().val());
                        window.sessionStorage.setItem("contents",$("#ins_contents").val());

                        $(".calendar_add_form").submit();
                    });

                });

function chkPhone(val) {
    if(val!="010-0000-0000"){
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
    }else {
        console.log("no phone");
    }
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

               function configure(idx){
                Webcam.set({
                    width: 280,
                    height: 200,
                    image_format: 'jpeg',
                    jpeg_quality: 90,
                    upload_name: 'file'
                });
                Webcam.attach( '.my_camera'+ idx );
            }

            function take_snapshot(idx) {
              Webcam.snap( function(data_uri) {
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                
                // $('.camera_results'+ idx).html('<img class="imageprev' + idx +  '" src="'+data_uri+'"/>');


                $(".webcam_input"+ idx).val(raw_image_data);
            });
              // Webcam.reset();
          }

          function saveSnap(idx){
           var base64image = $(".imageprev"+idx).attr("src");

           Webcam.upload( base64image, '/index.php/dataFunction/webcamUpload', function(code, text) {
            console.log('Save successfully');
        });

       }
   </script>