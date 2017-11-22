<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>내 지점 정보 <small>내 지점의 정보를 확인하세요. 일부 정보를 수정 할 수 있습니다.</small></h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="x_panel">
                    <?php if ($this->session->userdata('BRANCH_IDX') == 1) { ?>
                        <!--                        <div class="x_title">
                                                    <select class="title_select">
                        <?php foreach ($branch_lists as $row) { ?>
                                                                                                                                                                                    <option value="<?= $row['BRANCH_IDX'] ?>"><h2><?= $row['NAME'] ?></h2></option>
                        <?php } ?>
                                                    </select>
                                                    <small>권한에 따라 선택 할 수 있습니다.</small>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="#">Settings 1</a>
                                                                </li>
                                                                <li><a href="#">Settings 2</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>-->
                    <?php } ?>
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modBranch">
                            <input type="hidden" name="branch_idx" value="<?= $info->BRANCH_IDX ?>">
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">지점명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="name" value="<?= $info->NAME ?>" maxlength="10" placeholder="지점명" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">유형</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="<?= $info->TYPE_TEXT ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">아이디</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="<?= $info->ID ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">비밀번호</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" name="pwd" placeholder="비밀번호">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">점주명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="owner_name" value="<?= $info->OWNER_NAME ?>" maxlength="4" placeholder="점주명" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">점주 연락처</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="owner_phone" value="<?= $info->OWNER_PHONE ?>" maxlength="11" placeholder="01012341234" pattern="[0-9]*" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">관리자명</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="manager_name" value="<?= $info->MANAGER_NAME ?>" maxlength="4" placeholder="관리자명" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">관리자 연락처</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="manager_phone" value="<?= $info->MANAGER_PHONE ?>" maxlength="11" placeholder="01012341234" pattern="[0-9]*" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">사용종료일</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="<?= $info->USE_EDATE ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4 control-label">메모사항</label>
                                <div class="col-xs-8">
                                    <textarea name="comment" class="form-control"><?= $info->COMMENT ?></textarea>
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

            <div class="col-lg-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>지원 기기 목록 <small>지점에 구비된 기기를 반드시 생성하세요</small></h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li>
                                <a onclick="openAddModal();">
                                    <i class="fa fa-plus"></i>
                                </a>

                                <!-- 기기 생성 모달 -->
                                <div id="addModal" title="기기 생성" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">기기 생성 <small style="font-size:12px;">기기번호와 비밀번호는 <b class="text-success">기기에서 로그인</b>하는데에 사용됩니다.</small></h4>
                                            </div>
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insMachine">
                                                <input type="hidden" name="branch_idx" value="<?= $info->BRANCH_IDX ?>">
                                                <div class="modal-body">
                                                    <div style="padding: 5px 20px;">
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">기기번호</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="id" id="machine_id" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">비밀번호</label>
                                                            <div class="col-xs-8">
                                                                <input type="password" class="form-control" name="pwd" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">메모</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="comment" placeholder="메모">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal" style="margin-left: 10px;">취소</button>
                                                    <button type="submit" class="btn btn-success antosubmit">완료</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped projects table_responsive_sm custom_responsive_sm">
                            <thead>
                                <tr>
                                    <th class="min_30px">#</th>
                                    <th class="min_80px">기기번호</th>
                                    <th class="min_200px">메모사항</th>
                                    <!-- <th class="min_80px">예약현황</th> -->
                                    <th class="min_80px">설정</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($machine_lists as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['ID'] ?></td>
                                        <td><?= nl2br($row['COMMENT']) ?></td>
                                        <!-- <td><a class="">예약보기</a></td> -->
                                        <td class="cursor" onclick="openModModal('<?= $row['MACHINE_INFO_IDX'] ?>');">수정/삭제</td>
                                    </tr>
                                    <?php
                                    $i++;
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

<!-- 기기 수정 및 삭제 모달 -->
<div id="modifyModal" title="기기 수정 및 삭제" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modifyModalLabel">기기 수정 및 삭제 <small style="font-size:12px;">기기번호와 비밀번호는 <b class="text-success">기기에서 로그인</b>하는데에 사용됩니다.</small></h4>
            </div>
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modMachine">
                <input type="hidden" name="machine_info_idx" id="machine_info_idx" value="">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">기기번호</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="id" id="mod_machine_id" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">비밀번호</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="pwd" placeholder="수정시 입력하세요.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">메모</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="comment" id="mod_machine_comment" placeholder="메모">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span style="font-size:12px; margin-right: 65px;">삭제시 연관된 예약이 모두 삭제 될 수 있습니다. 주의하세요.</span>
                    <button type="button" class="btn btn-primary antosubmit btn_position" id="del_machine_btn" value="">삭제</button>
                    <button type="submit" class="btn btn-success antosubmit">수정</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#del_machine_btn").click(function () {
            if (confirm("정말 삭제하시겠습니까??") == true) {    //확인
                var data = {'machine_info_idx': $(this).val()};
                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/delMachine',
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
    function openAddModal() {
        $("#addModal").modal();
        var cnt = $("table.projects tbody tr").length;
        $("#machine_id").val('<?= $info->ID ?>-' + (cnt + 1));
    }

    function openModModal(idx) {
        var data = {'machine_info_idx': idx};
        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/getMachineInfo',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {
                if (data.REQUEST == 'SUCCESS') {
                    $("#modifyModal").modal();
                    $("#machine_info_idx").val(data.MACHINE_INFO_IDX);
                    $("#del_machine_btn").val(data.MACHINE_INFO_IDX);
                    $("#mod_machine_id").val(data.ID);
                    $("#mod_machine_comment").val(data.COMMENT);
                } else {
                    alert("데이터 처리오류!!");
                    return false;
                }
            }
        });
    }
</script>