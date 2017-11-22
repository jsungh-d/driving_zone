<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>이벤트 관리 <small>각 지점의 이벤트를 등록/수정/삭제 할 수 있습니다.</small></h3>
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
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insEvent">
                            <input type="hidden" name="branch_idx" value="<?= $this->session->userdata('BRANCH_IDX') ?>">
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">지점명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="<?= $info->NAME ?>" placeholder="지점명" readonly>
                                </div>
                            </div>
                            <?php if ($this->session->userdata('BRANCH_IDX') == 1) { ?>
                                <div class="form-group row">
                                    <label class="col-xs-4 control-label">이벤트 범위</label>
                                    <div class="col-xs-8">
                                        <select name="event_type" class="form-control">
                                            <option value="A">전체이벤트</option>
                                            <option value="M">지점이벤트</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="event_type" value="M">
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">이벤트명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="event_name" placeholder="이벤트명을 자유롭게 입력해주세요" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">할인율</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="discount_rate" placeholder="할인율을 결정해주세요" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">메모사항</label>
                                <div class="col-xs-8">
                                    <textarea name="comment" class="form-control"></textarea>
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
                        <h2>이벤트 목록 <small>등록한 이벤트 목록입니다</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped projects table_responsive_sm custom_responsive_sm">
                            <thead>
                                <tr>
                                    <th class="min_30px">#</th>
                                    <th class="min_200px">이벤트이름</th>
                                    <th class="min_100px">할인율</th>
                                    <th class="min_80px">설정</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                <?php
                                $num = 1;
                                foreach ($event_lists as $row) {
                                    ?>
                                    <tr class="ui-state-default" id="<?= $row['EVENT_IDX'] ?>">
                                        <td><?= $num ?></td>
                                        <td><?= $row['EVENT_NAME'] ?></td>
                                        <td>
                                            <?php
                                            $chk_type = substr($row['DISCOUNT_RATE'], -1);
                                            if ($chk_type == '%') {
                                                echo $row['DISCOUNT_RATE'];
                                            } else {
                                                echo number_format($row['DISCOUNT_RATE']) . '원';
                                            }
                                            ?>
                                        </td>
                                        <?php if ($row['EVENT_TYPE'] == 'M' || $this->session->userdata('BRANCH_IDX') == 1) { ?>
                                            <td class="cursor" onclick="modModalOpen('<?= $row['EVENT_IDX'] ?>')">수정/삭제</td>
                                        <?php } ?>
                                        <?php if ($row['EVENT_TYPE'] == 'A' && $this->session->userdata('BRANCH_IDX') != 1) { ?>
                                            <td class="cursor">전체이벤트</td>
                                        <?php } ?>
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

<!-- 이벤트 수정 및 삭제 모달 -->
<div id="modifyModal" title="이벤트 수정 및 삭제" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modifyModalLabel">이벤트 수정 및 삭제 <small style="font-size:12px;">등록된 이벤트를 수정 및 삭제합니다.</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modEvent">
                <input type="hidden" name="event_idx" id="event_idx" value="">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">지점명</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"  value="<?= $info->NAME ?>" placeholder="지점명" readonly>
                            </div>
                        </div>
                        <?php if ($this->session->userdata('BRANCH_IDX') == 1) { ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">이벤트 범위</label>
                                <div class="col-sm-8">
                                    <select name="event_type" id="mod_event_type" class="form-control">
                                        <option value="A">전체이벤트</option>
                                        <option value="M">지점이벤트</option>
                                    </select>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" name="event_type" value="M">
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">이벤트명</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_event_name" name="event_name" placeholder="이벤트명을 자유롭게 입력해주세요" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">할인율</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_discount_rate" name="discount_rate" placeholder="할인율을 결정해주세요" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">메모사항</label>
                            <div class="col-sm-8">
                                <textarea name="comment" id="mod_comment" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span style="font-size:12px; margin-right: 65px;"></span>
                    <button type="button" id="del_event_btn" class="btn btn-primary antosubmit btn_position">삭제</button>
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
                    url: '/index.php/dataFunction/updateEventShowLevel',
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

        $("#del_event_btn").click(function () {
            if (confirm("정말 삭제하시겠습니까??") == true) {    //확인
                var data = {event_idx: $(this).val()};
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/delEvent',
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
        var data = {'event_idx': idx};
        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/getEventInfo',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {
                if (data.RESULT == 'SUCCESS') {
                    $("#event_idx").val(data.EVENT_IDX);
                    $("#del_event_btn").val(data.EVENT_IDX);
                    $("#mod_event_type").val(data.EVENT_TYPE).select();
                    $("#mod_event_name").val(data.EVENT_NAME);
                    $("#mod_discount_rate").val(data.DISCOUNT_RATE);
                    $("#mod_comment").val(data.COMMENT);
                    $("#modifyModal").modal();
                } else {
                    alert("데이터 처리오류!!");
                    return false;
                }
            }
        });
    }
</script>