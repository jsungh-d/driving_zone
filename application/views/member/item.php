<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>회원 관리 항목 설정<small>회원관리에 반영되는 항목들을 설정할 수 있습니다.</small></h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>항목관리 <small>회원등록에 필요한 항목 및 항목별 필수 / 선택 정보를 설정하세요</small></h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="">
                            <!--                            <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">이름</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="name"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="name"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">생년월일</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="birth"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="birth"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">주소</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="address"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="address"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">연락처</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="number"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="number"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">접수일</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="receipt"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="receipt"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <div class="form-group mb15">
                                <label class="col-sm-2 col-xs-6 control-label">결제형태 및 가산세율</label>
                                <div class="col-sm-9 col-xs-6">
                                    <!--                                    <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="required" id="" name="pay"> 필수
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="" id="" name="pay"> 선택
                                                                            </label>
                                                                        </div>-->
                                    <button type="button" class="btn-link item_btn" data-toggle="modal" title="" data-target="#payModal">항목관리</button>
                                </div>
                            </div>

                            <div class="form-group mb15">
                                <label class="col-sm-2 col-xs-6 control-label">방문경로</label>
                                <div class="col-sm-9 col-xs-6">
                                    <!--                                    <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="required" id="" name="visit"> 필수
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="" id="" name="visit"> 선택
                                                                            </label>
                                                                        </div>-->
                                    <button type="button" class="btn-link item_btn"  data-toggle="modal" title="" data-target="#visitModal">항목관리</button>
                                </div>
                            </div>

                            <div class="form-group mb15">
                                <label class="col-sm-2 col-xs-6 control-label">지금까지 연습방법</label>
                                <div class="col-sm-9 col-xs-6">
                                    <!--                                    <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="required" id="" name="practice"> 필수
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="" id="" name="practice"> 선택
                                                                            </label>
                                                                        </div>-->
                                    <button type="button" class="btn-link item_btn"  data-toggle="modal" title="" data-target="#practiceModal">항목관리</button>
                                </div>
                            </div>

                            <!--                            <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">응시시험 유형</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="type"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="type"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <div class="form-group mb15">
                                <label class="col-sm-2 col-xs-6 control-label">응시예정 시험장 사전 설정</label>
                                <div class="col-sm-9 col-xs-6">
                                    <!--                                    <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="required" id="" name="place"> 필수
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio dp_ib" style="margin-right: 10px">
                                                                            <label>
                                                                                <input type="radio" checked="" value="" id="" name="place"> 선택
                                                                            </label>
                                                                        </div>-->
                                    <button type="button" class="btn-link item_btn"  data-toggle="modal" title="" data-target="#placeModal">항목관리</button>
                                </div>
                            </div>

                            <!--                            <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">사진첨부</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="picture"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="picture"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">최종합격여부</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="pass"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="pass"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group mb15">
                                                            <label class="col-xs-2 control-label">메모 및 기타일정</label>
                                                            <div class="col-xs-9">
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="required" id="" name="memo"> 필수
                                                                    </label>
                                                                </div>
                                                                <div class="radio dp_ib" style="margin-right: 10px">
                                                                    <label>
                                                                        <input type="radio" checked="" value="" id="" name="memo"> 선택
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="col-xs-offset-2 col-xs-8">
                                <!--<button type="submit" class="btn btn-success">설정</button>-->
                            </div>

                        </form>
                        <!-- end project list -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /page content -->

<!-- 상품 / 결제 형태 모달-->
<div id="payModal" title="결제 형태" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="payModalLabel">결제 형태 및 가산금 설정<small>각 항목을 설정해주세요</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insPayment">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <!--                        <div class="form-group" style="margin-bottom: 15px;">
                                                    <label class="col-xs-3 control-label">상품</label>
                                                    <div class="col-xs-9">
                                                        <input type="text" class="form-control" name="" placeholder="" required>
                                                    </div>
                                                </div>-->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-xs-12" style="text-align: center;">각 결제 형태에 따른 가산세율을 숫자로 입력해주세요. (단위:%)</label>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-xs-3 control-label">결제형태</label>
                            <div class="col-xs-9">
                                <div class="form-group">
                                    <?php if (!$payment_lists) { ?>
                                        <div class="form-inline mb5">
                                            <input type="text" name="name[]" class="form-control dp_ib payment_name" style="width:calc(50% - 25px);" placeholder="카드" maxlength="10" required>
                                            <input type="text" name="weight[]" class="form-control dp_ib" style="width:calc(50% - 25px);" pattern="[0-9]*" maxlength="2" placeholder="%" required>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    $i = 0;
                                    foreach ($payment_lists as $row) {
                                        ?>
                                        <div class="form-inline mb5">
                                            <input type="text" name="name[]" class="form-control dp_ib mod_payment_name" style="width:calc(50% - 25px);" value="<?= $row['NAME'] ?>" placeholder="카드" maxlength="10" required>
                                            <input type="hidden" class="mod_payment_name_org" value="<?= $row['NAME'] ?>">
                                            <input type="text" name="weight[]" class="form-control dp_ib" style="width:calc(50% - 25px);" value="<?= $row['WEIGHT'] ?>" pattern="[0-9]*" maxlength="2" placeholder="%" required>
                                            <?php if ($i > 0) { ?>
                                                <button class="btn btn-default shape_btn_minus" type="button" style=" vertical-align: top; float: right;">-</button>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                                <div class="append_target shape_btn" style="margin-top: 5px;">
                                    <button class="btn btn-success plus" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-success antosubmit">설정</button>
                </div>
            </form>
        </div>
    </div>
</div>			

<!-- 방문경로 설정 모달-->
<div id="visitModal" title="방문경로 설정" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="visitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="visitModalLabel">방문경로 설정 <small>항목을 설정해주세요</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insVisitRoute">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-xs-3 control-label">방문경로</label>
                            <div class="col-xs-9">
                                <?php if (!$visit_route_lists) { ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib visit_route_name" style="width:calc(100% - 45px);" maxlength="10" placeholder="오프라인 광고" required>
                                    </div>
                                <?php } ?>
                                <?php
                                $i = 0;
                                foreach ($visit_route_lists as $row) {
                                    ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib mod_visit_route_name" style="width:calc(100% - 45px);" maxlength="10" value="<?= $row['NAME'] ?>" placeholder="오프라인 광고" required>
                                        <input type="hidden" class="mod_visit_route_name_org" value="<?= $row['NAME'] ?>">
                                        <?php if ($i > 0) { ?>
                                            <button class="btn btn-default minus" type="button" style=" vertical-align: top;">-</button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>

                                <div class="append_target route_btn" style="margin-top: 5px;">
                                    <button class="btn btn-success plus" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-success antosubmit">설정</button>
                </div>
            </form>
        </div>
    </div>
</div>			

<!-- 연습방법 모달-->
<div id="practiceModal" title="연습방법 설정" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="practiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="practiceModalLabel">연습방법 설정 <small>항목을 설정해주세요</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insPractice">
                <div class="modal-body">
                    <div style="padding: 5px;">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-xs-3 control-label">지금까지 연습방법</label>
                            <div class="col-xs-9">
                                <?php if (!$practice_lists) { ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib practice_name" maxlength="10" style="width:calc(100% - 45px);" required>
                                    </div>
                                <?php } ?>
                                <?php
                                $i = 0;
                                foreach ($practice_lists as $row) {
                                    ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib mod_practice_name" value="<?= $row['NAME'] ?>" maxlength="10" style="width:calc(100% - 45px);" required>
                                        <input type="hidden" class="mod_practice_name_org" value="<?= $row['NAME'] ?>">
                                        <?php if ($i > 0) { ?>
                                            <button class="btn btn-default minus" type="button" style=" vertical-align: top;">-</button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>

                                <div class="append_target practice_btn" style="margin-top: 5px;">
                                    <button class="btn btn-success plus" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-success antosubmit">설정</button>
                </div>
            </form>
        </div>
    </div>
</div>			

<!-- 응시예정 시험장 모달-->
<div id="placeModal" title="응시예정 시험장 설정" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="placeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="placeModalLabel">응시예정 시험장 <small>해당 항목은 시험장 선택 시 자동완성에 영향을 미칩니다.</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insTestSite">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="col-xs-3 control-label">응시예정시험장</label>
                            <div class="col-xs-9">
                                <?php if (!$test_site_lists) { ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib test_site" placeholder="강남면허시험장" maxlength="20" style="width:calc(100% - 45px);" required>
                                    </div>
                                <?php } ?>
                                <?php
                                $i = 0;
                                foreach ($test_site_lists as $row) {
                                    ?>
                                    <div class="form-group">
                                        <input type="text" name="name[]" class="form-control dp_ib mod_test_site" value="<?= $row['NAME'] ?>" placeholder="강남면허시험장" maxlength="20" style="width:calc(100% - 45px);" required>
                                        <input type="hidden" class="mod_test_site_org" value="<?= $row['NAME'] ?>">
                                        <?php if ($i > 0) { ?>
                                            <button class="btn btn-default minus" type="button" style=" vertical-align: top;">-</button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>

                                <div class="append_target place_btn" style="margin-top: 5px;">
                                    <button class="btn btn-success plus" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-success antosubmit">설정</button>
                </div>
            </form>
        </div>
    </div>
</div>	

<script type="text/javascript">
    $(document).ready(function () {
        $('#sdate').datepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });

        $(".checkbox").iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
        // $(".checkbox_switch").iCheck({
        // 	radioClass: 'iradio_flat-green'
        // });

        $(".shape_btn .plus").click(function () {
            $.post("/index.php/dataFunction/item_shape_add", function (data) {
                $(".shape_btn").before(data);
                $(".shape_btn_minus").click(function () {
                    $(this).parent().parent().remove();
                });

                $(".payment_name").blur(function () {
                    var obj = $(this);
                    var text = $(this).val();
                    var data = {name: text};
                    $.ajax({
                        dataType: 'text',
                        url: '/index.php/dataFunction/chkPayment',
                        data: data,
                        type: 'POST',
                        success: function (data, status, xhr) {
                            if (data == 'DUPLE') {
                                alert('중복된 결제명입니다.');
                                obj.val('');
                            } else if (data == 'FAILED') {
                                alert("데이터 처리오류!!");
                                return false;
                            }
                        }
                    });
                });
            });
        });
        $(".route_btn .plus").click(function () {
            $.post("/index.php/dataFunction/item_route_add", function (data) {
                $(".route_btn").before(data);
                $(".minus").click(function () {
                    $(this).parent().remove();
                });

                $(".visit_route_name").blur(function () {
                    var obj = $(this);
                    var text = $(this).val();
                    var data = {name: text};
                    $.ajax({
                        dataType: 'text',
                        url: '/index.php/dataFunction/chkVisitRoute',
                        data: data,
                        type: 'POST',
                        success: function (data, status, xhr) {
                            if (data == 'DUPLE') {
                                alert('중복된 방문경로입니다.');
                                obj.val('');
                            } else if (data == 'FAILED') {
                                alert("데이터 처리오류!!");
                                return false;
                            }
                        }
                    });
                });
            });
        });
        $(".practice_btn .plus").click(function () {
            $.post("/index.php/dataFunction/item_practice_add", function (data) {
                $(".practice_btn").before(data);
                $(".minus").click(function () {
                    $(this).parent().remove();
                });

                $(".practice_name").blur(function () {
                    var obj = $(this);
                    var text = $(this).val();
                    var data = {name: text};
                    $.ajax({
                        dataType: 'text',
                        url: '/index.php/dataFunction/chkPractice',
                        data: data,
                        type: 'POST',
                        success: function (data, status, xhr) {
                            if (data == 'DUPLE') {
                                alert('중복된 연습방법명입니다.');
                                obj.val('');
                            } else if (data == 'FAILED') {
                                alert("데이터 처리오류!!");
                                return false;
                            }
                        }
                    });
                });
            });
        });
        $(".place_btn .plus").click(function () {
            $.post("/index.php/dataFunction/item_place_add", function (data) {
                $(".place_btn").before(data);
                $(".minus").click(function () {
                    $(this).parent().remove();
                });

                $(".test_site").blur(function () {
                    var obj = $(this);
                    var text = $(this).val();
                    var data = {name: text};
                    $.ajax({
                        dataType: 'text',
                        url: '/index.php/dataFunction/chkTestSite',
                        data: data,
                        type: 'POST',
                        success: function (data, status, xhr) {
                            if (data == 'DUPLE') {
                                alert('중복된 시험장입니다.');
                                obj.val('');
                            } else if (data == 'FAILED') {
                                alert("데이터 처리오류!!");
                                return false;
                            }
                        }
                    });
                });
            });
        });

        $(".payment_name").blur(function () {
            var obj = $(this);
            var text = $(this).val();
            var data = {name: text};
            $.ajax({
                dataType: 'text',
                url: '/index.php/dataFunction/chkPayment',
                data: data,
                type: 'POST',
                success: function (data, status, xhr) {
                    if (data == 'DUPLE') {
                        alert('중복된 결제명입니다.');
                        obj.val('');
                    } else if (data == 'FAILED') {
                        alert("데이터 처리오류!!");
                        return false;
                    }
                }
            });
        });

        $(".visit_route_name").blur(function () {
            var obj = $(this);
            var text = $(this).val();
            var data = {name: text};
            $.ajax({
                dataType: 'text',
                url: '/index.php/dataFunction/chkVisitRoute',
                data: data,
                type: 'POST',
                success: function (data, status, xhr) {
                    if (data == 'DUPLE') {
                        alert('중복된 방문경로입니다.');
                        obj.val('');
                    } else if (data == 'FAILED') {
                        alert("데이터 처리오류!!");
                        return false;
                    }
                }
            });
        });

        $(".mod_payment_name").blur(function () {
            var obj = $(this);
            var index = $(this).index('.mod_payment_name');
            var text = $(this).val();
            var org_text = $(".mod_payment_name_org:eq(" + index + ")").val();
            var data = {name: text};
            if (text != org_text) {
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/chkPayment',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'DUPLE') {
                            alert('중복된 결제명입니다.');
                            obj.val(org_text);
                        } else if (data == 'FAILED') {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            }
        });

        $(".mod_visit_route_name").blur(function () {
            var obj = $(this);
            var index = $(this).index('.mod_visit_route_name');
            var text = $(this).val();
            var org_text = $(".mod_visit_route_name_org:eq(" + index + ")").val();
            var data = {name: text};
            if (text != org_text) {
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/chkVisitRoute',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'DUPLE') {
                            alert('중복된 방문경로입니다.');
                            obj.val(org_text);
                        } else if (data == 'FAILED') {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            }
        });

        $(".practice_name").blur(function () {
            var obj = $(this);
            var text = $(this).val();
            var data = {name: text};
            $.ajax({
                dataType: 'text',
                url: '/index.php/dataFunction/chkPractice',
                data: data,
                type: 'POST',
                success: function (data, status, xhr) {
                    if (data == 'DUPLE') {
                        alert('중복된 연습방법명입니다.');
                        obj.val('');
                    } else if (data == 'FAILED') {
                        alert("데이터 처리오류!!");
                        return false;
                    }
                }
            });
        });

        $(".mod_practice_name").blur(function () {
            var obj = $(this);
            var index = $(this).index('.mod_practice_name');
            var text = $(this).val();
            var org_text = $(".mod_practice_name_org:eq(" + index + ")").val();
            var data = {name: text};
            if (text != org_text) {
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/chkPractice',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'DUPLE') {
                            alert('중복된 연습방법명입니다.');
                            obj.val(org_text);
                        } else if (data == 'FAILED') {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            }
        });

        $(".test_site").blur(function () {
            var obj = $(this);
            var text = $(this).val();
            var data = {name: text};
            $.ajax({
                dataType: 'text',
                url: '/index.php/dataFunction/chkTestSite',
                data: data,
                type: 'POST',
                success: function (data, status, xhr) {
                    if (data == 'DUPLE') {
                        alert('중복된 시험장입니다.');
                        obj.val('');
                    } else if (data == 'FAILED') {
                        alert("데이터 처리오류!!");
                        return false;
                    }
                }
            });
        });

        $(".mod_test_site").blur(function () {
            var obj = $(this);
            var index = $(this).index('.mod_test_site');
            var text = $(this).val();
            var org_text = $(".mod_test_site_org:eq(" + index + ")").val();
            var data = {name: text};
            if (text != org_text) {
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/chkTestSite',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'DUPLE') {
                            alert('중복된 시험장입니다.');
                            obj.val(org_text);
                        } else if (data == 'FAILED') {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            }
        });

        $(".shape_btn_minus").click(function () {
            $(this).parent().remove();
        });
        $(".minus").click(function () {
            $(this).parent().remove();
        });

    });
</script>
