<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>상품 관리 <small>각 지점의 상품을 등록/수정/삭제 할 수 있습니다.</small></h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <!--                    <div class="x_title">
                                            <select class="title_select">
                                                <option value=""><h2>가나다점</h2></option>
                                                <option value=""><h2>라마바점</h2></option>
                                                <option value=""><h2>사아자점</h2></option>
                                            </select>
                                            <small>권한에 따라 지점을 선택 할 수 있습니다.</small>
                                            <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>-->
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insGoods">
                            <input type="hidden" name="branch_idx" value="<?= $this->session->userdata('BRANCH_IDX') ?>">
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">지점명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="<?= $info->NAME ?>" placeholder="지점명" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">면허유형</label>
                                <div class="col-xs-8">
                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label>
                                            <input type="radio" checked="" value="1" name="license_type"> 1종
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label>
                                            <input type="radio" value="2" name="license_type"> 2종
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input type="radio" value="B" name="license_type"> 대형
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">상품유형</label>
                                <div class="col-xs-8">
                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label>
                                            <input type="radio" checked="" value="G" name="goods_type" class="type_radio"> 보장형
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block; margin-right: 10px">
                                        <label>
                                            <input type="radio" value="T" name="goods_type" class="radio_time type_radio"> 시간형
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input type="radio" value="C" name="goods_type" class="type_radio"> 코스형
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">상품의 사용 가능 시간</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control radio_time_text" name="goods_time" pattern="[0-9]*" maxlength="2" placeholder="시간형 상품만 입력할 수 있습니다. ex)10 " disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">상품명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="goods_name" placeholder="상품명을 자유롭게 입력해주세요" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">상품가격</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="goods_price" placeholder="상품가격을 결정해주세요" maxlength="7" pattern="[0-9]*" required>
                                </div>
                            </div>
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-success">저장</button>
                            </div>
                        </form>
                        <!-- end project list -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>상품목록 <small>등록한 상품 목록입니다</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped projects table_responsive_sm custom_responsive_sm">
                            <thead>
                                <tr>
                                    <th class="min_30px">#</th>
                                    <th class="min_80px">상품유형</th>
                                    <th class="min_200px">상품이름</th>
                                    <th class="min_80px">면허유형</th>
                                    <th class="min_100px">가격</th>
                                    <th class="min_80px">설정</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                <?php
                                $num = 1;
                                foreach ($lists as $row) {
                                    ?>
                                    <tr class="ui-state-default" id="<?= $row['GOODS_IDX'] ?>">
                                        <td><?= $num ?></td>
                                        <td><?= $row['GOODS_TYPE_TEXT'] ?></td>
                                        <td><?= $row['GOODS_NAME'] ?></td>
                                        <td><?= $row['LICENSE_TYPE_TEXT'] ?></td>
                                        <td><?= number_format($row['GOODS_PRICE']) ?>원</td>
                                        <td class="cursor" onclick="modModalOpen('<?= $row['GOODS_IDX'] ?>')">수정/삭제</td>
                                    </tr>
                                    <?php
                                    $num++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- end project list -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /page content -->

<!-- 상품 수정 및 삭제 모달 -->
<div id="modifyModal" title="상품 수정 및 삭제" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modifyModalLabel">상품 수정 및 삭제 <small style="font-size:12px;">등록된 상품을 수정 및 삭제합니다.</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modGoods">
                <input type="hidden" name="goods_idx" id="mod_goods_idx">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">지점명</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" value="<?= $info->NAME ?>" placeholder="지점명" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">면허유형</label>
                            <div class="col-xs-8">
                                <div class="radio" style="display: inline-block; margin-right: 10px">
                                    <label>
                                        <input type="radio" value="1" name="license_type" class="license_type"> 1종
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block; margin-right: 10px">
                                    <label>
                                        <input type="radio" value="2" name="license_type" class="license_type"> 2종
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block;">
                                    <label>
                                        <input type="radio" value="B" name="license_type" class="license_type"> 대형
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">상품유형</label>
                            <div class="col-xs-8">
                                <div class="radio" style="display: inline-block; margin-right: 10px">
                                    <label>
                                        <input type="radio" value="G" name="goods_type" class="modal_type_radio"> 보장형
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block; margin-right: 10px">
                                    <label>
                                        <input type="radio" value="T" name="goods_type" class="modal_radio_time modal_type_radio"> 시간형
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block;">
                                    <label>
                                        <input type="radio" value="C" name="goods_type" class="modal_type_radio"> 코스형
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">상품의 사용시간</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control modal_radio_time_text" id="goods_time" name="goods_time" pattern="[0-9]*" maxlength="2" placeholder="시간형 상품만 입력할 수 있습니다." disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">상품명</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="goods_name" name="goods_name" placeholder="상품명을 자유롭게 입력해주세요" maxlength="20" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">상품가격</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="goods_price" name="goods_price" placeholder="상품가격을 결정해주세요" maxlength="7" pattern="[0-9]*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span style="font-size:12px; margin-right: 65px;"></span>
                    <button type="button" id="del_goods_btn" class="btn btn-primary antosubmit btn_position">삭제</button>
                    <button type="submit" class="btn btn-success antosubmit">수정</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $("#sortable").sortable({
            update: function (event, ui) {
                var order = $("#sortable").sortable('toArray').toString();
                var data = {idx: order};
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/updateGoodsShowLevel',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data !== 'SUCCESS') {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            }
        });

        // 상품등록에서의 스크립트(라디오 버튼 시간형이 체크 되어야만 사용시간 disable이 풀림)
        $(".type_radio").click(function () {
            if ($(".radio_time").prop("checked")) {
                $(".radio_time_text").prop("disabled", false);
                $(".radio_time_text").prop("required", true);
            } else {
                $(".radio_time_text").prop("disabled", true);
                $(".radio_time_text").prop("required", false);
            }
        });
        // 수정 삭제 모달에서의 스크립트(라디오 버튼 시간형이 체크 되어야만 사용시간 disable이 풀림)
        $(".modal_type_radio").click(function () {
            if ($(".modal_radio_time").prop("checked")) {
                $(".modal_radio_time_text").prop("disabled", false);
                $(".modal_radio_time_text").prop("required", true);
            } else {
                $(".modal_radio_time_text").prop("disabled", true);
                $(".modal_radio_time_text").prop("required", false);
            }
        });

        $("#del_goods_btn").click(function () {
            if (confirm("정말 삭제하시겠습니까??") == true) {    //확인
                var data = {'goods_idx': $(this).val()};
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/delGoods',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'SUCCESS') {
                            alert('삭제 되었습니다.');
                            location.reload();
                        } else {
                            alert("데이터 처리오류!!");
                            return false;
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });

    function modModalOpen(idx) {
        var data = {'goods_idx': idx};
        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/getGoodsInfo',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {
                if (data.RESULT == 'SUCCESS') {
                    $("#mod_goods_idx").val(data.GOODS_IDX);
                    $("#del_goods_btn").val(data.GOODS_IDX);
                    if (data.LICENSE_TYPE === '1') {
                        $(".license_type").eq(0).prop('checked', true);
                    }

                    if (data.LICENSE_TYPE === '2') {
                        $(".license_type").eq(1).prop('checked', true);
                    }

                    if (data.LICENSE_TYPE === 'B') {
                        $(".license_type").eq(2).prop('checked', true);
                    }

                    if (data.GOODS_TYPE === 'G') {
                        $(".modal_type_radio").eq(0).prop('checked', true);
                    }

                    if (data.GOODS_TYPE === 'T') {
                        $(".modal_radio_time_text").prop("disabled", false);
                        $(".modal_radio_time_text").prop("required", true);
                        $("#goods_time").val(data.GOODS_TIME);
                        $(".modal_type_radio").eq(1).prop('checked', true);
                    }

                    if (data.GOODS_TYPE === 'C') {
                        $(".modal_type_radio").eq(2).prop('checked', true);
                    }

                    $("#goods_name").val(data.GOODS_NAME);
                    $("#goods_price").val(data.GOODS_PRICE);

                    $("#modifyModal").modal();
                } else {
                    alert("데이터 처리오류!!");
                    return false;
                }
            }
        });
    }
</script>
