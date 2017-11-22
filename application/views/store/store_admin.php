<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>지점 관리 <small>각 지점의 ID를 생성하여 전달하세요</small></h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search_text" placeholder="Search for..." value="<?= $text ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="search_btn" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>지점 관리 <small>지점을 생성하려면 오른쪽 +버튼을 눌러주세요. 각 지점명을 클릭하면 수정, 삭제 가능합니다</small></h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li>
                                <a data-toggle="modal" title="" data-target="#addModal">
                                    <i class="fa fa-plus"></i>
                                </a>

                                <div id="addModal" title="지점 생성" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">지점 생성 <small>지점의 정보를 입력하세요</small></h4>
                                            </div>
                                            <form method="post" id="insForm" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/insBranch">
                                                <div class="modal-body">
                                                    <div style="padding: 5px 20px;">
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">지점명</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="name" placeholder="지점명" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">아이디</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="id" placeholder="아이디" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">비밀번호</label>
                                                            <div class="col-xs-8">
                                                                <input type="password" class="form-control" name="pwd" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">유형</label>
                                                            <div class="col-xs-8">
                                                                <select name="type" class="form-control">
                                                                    <option value="D">직영점</option>
                                                                    <option value="A">가맹점</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">점주명</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="owner_name" placeholder="점주명" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">점주 연락처</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="owner_phone" placeholder="01012341234" pattern="[0-9]*" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">관리자명</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="manager_name" placeholder="관리자명" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">관리자 연락처</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" name="manager_phone" placeholder="01012341234" pattern="[0-9]*" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">사용종료일</label>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control date" name="use_edate" placeholder="사용종료일" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xs-4 control-label">메모사항</label>
                                                            <div class="col-xs-8">
                                                                <textarea name="comment" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary antoclose" data-dismiss="modal">닫기</button>
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
                        <table class="table table-striped projects sortable table_responsive_sm">
                            <thead>
                                <tr>
                                    <th class="min_110px">지점명</th>
                                    <th class="min_100px">ID</th>
                                    <th class="min_50px">유형</th>
                                    <th class="min_100px">점주명</th>
                                    <th class="min_100px">관리자명</th>
                                    <th class="min_110px">관리자 연락처</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lists as $row) { ?>
                                    <tr>
                                        <td class="cursor" onclick="openModModal('<?= $row['BRANCH_IDX'] ?>');"><?= $row['NAME'] ?></td>
                                        <td><?= $row['ID'] ?></td>
                                        <td><?= $row['TYPE_TEXT'] ?></td>
                                        <td><?= $row['OWNER_NAME'] ?></td>
                                        <td><?= $row['MANAGER_NAME'] ?></td>
                                        <td><?= $row['MANAGER_PHONE'] ?></td>
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

<!-- 지점 수정 및 삭제 모달 -->
<div id="modifyModal" title="지점 수정 및 삭제" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modifyModalLabel">지점 수정 및 삭제 <small>지점의 정보를 입력하세요</small></h4>
            </div>
            <form method="post" id="modForm" class="form-horizontal" enctype="multipart/form-data" action="/index.php/dataFunction/modBranchAdmin">
                <input type="hidden" id="idx" name="idx" value="">
                <div class="modal-body">
                    <div style="padding: 5px 20px;">
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">지점명</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_name" name="name" placeholder="지점명" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">아이디</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_id" name="id" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">비밀번호</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="pwd" placeholder="비밀번호 변경시 입력하세요.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">유형</label>
                            <div class="col-xs-8">
                                <select name="type" class="form-control" id="mod_type">
                                    <option value="D">직영점</option>
                                    <option value="A">가맹점</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">점주명</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_owner_name" name="owner_name" placeholder="점주명" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">점주 연락처</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_owner_phone" name="owner_phone" placeholder="01012341234" pattern="[0-9]*" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">관리자명</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_manager_name" name="manager_name" placeholder="관리자명" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">관리자 연락처</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="mod_manager_phone" name="manager_phone" placeholder="01012341234" pattern="[0-9]*" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">사용종료일</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control date" id="mod_use_edate" name="use_edate" placeholder="사용종료일" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4 control-label">메모사항</label>
                            <div class="col-xs-8">
                                <textarea name="comment" id="mod_comment" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="mod_del_btn" class="btn btn-primary antosubmit btn_position" value="">삭제</button>
                    <button type="submit" class="btn btn-success antosubmit">수정</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--jquery validation 플러그인-->
<script src="/js/jquery.validate.min.js"></script>
<script src="/js/additional-methods.min.js"></script>
<script src="/js/messages_ko.min.js"></script>
<!--jquery validation 플러그인-->
<script type="text/javascript">
                                        $(function () {

                                            $("#search_text").keydown(function (key) {
                                                var gubun = 'contents';
                                                var text = $("#search_text").val();

                                                if (!$.trim(text)) {
                                                    text = 'none';
                                                }

                                                if (key.keyCode == 13) {
                                                    if (text !== 'none') {
                                                        location.href = '/index/store_admin/q/gubun/' + gubun + '/text/' + text + '';
                                                    } else {
                                                        location.href = '/index/store_admin';
                                                    }
                                                }
                                            });

                                            $("#search_btn").click(function () {
                                                var gubun = 'contents';
                                                var text = $("#search_text").val();

                                                if (!$.trim(text)) {
                                                    text = 'none';
                                                }

                                                if (text !== 'none') {
                                                    location.href = '/index/store_admin/q/gubun/' + gubun + '/text/' + text + '';
                                                } else {
                                                    location.href = '/index/store_admin';
                                                }
                                            });

                                            $('#insForm').validate({
                                                //validation이 끝난 이후의 submit 직전 추가 작업할 부분
                                                submitHandler: function () {
                                                    var f = confirm("지점등록을 완료하겠습니까?");
                                                    if (f) {
                                                        return true;
                                                    } else {
                                                        return false;
                                                    }
                                                },
                                                rules: {
                                                    name: {
                                                        required: true
                                                    },
                                                    id: {
                                                        required: true,
                                                        remote: '/index.php/dataFunction/idCheck'
                                                    },
                                                    pwd: {
                                                        required: true
                                                    },
                                                    owner_name: {
                                                        required: true

                                                    },
                                                    owner_phone: {
                                                        required: true,
                                                        number: true
                                                    },
                                                    manager_name: {
                                                        required: true
                                                    },
                                                    manager_phone: {
                                                        required: true,
                                                        number: true
                                                    },
                                                    use_edate: {
                                                        required: true
                                                    }
                                                },
                                                //규칙체크 실패시 출력될 메시지
                                                messages: {
                                                    name: {
                                                        required: "<span class='helpR'>지점명을 입력해주세요.</span>"
                                                    },
                                                    id: {
                                                        required: "<span class='helpR'>아이디를 입력해주세요.</span>",
                                                        remote: "<span class='helpR'>이미 사용중인 아이디 입니다.</span>"
                                                    },
                                                    pwd: {
                                                        required: "<span class='helpR'>비밀번호를 입력해주세요.</span>"
                                                    },
                                                    owner_name: {
                                                        required: "<span class='helpR'>점주명을 입력해주세요.</span>"
                                                    }
                                                    ,
                                                    owner_phone: {
                                                        required: "<span class='helpR'>점주 연락처를 입력해주세요.</span>",
                                                        number: "<span class='helpR'>숫자만 입력해주세요.</span>"
                                                    },
                                                    manager_name: {
                                                        required: "<span class='helpR'>관리자명을 입력해주세요.</span>"
                                                    },
                                                    manager_phone: {
                                                        required: "<span class='helpR'>관리자 연락처를 입력해주세요.</span>",
                                                        number: "<span class='helpR'>숫자만 입력해주세요.</span>"
                                                    },
                                                    use_edate: {
                                                        required: "<span class='helpR'>사용종료일을 입력해주세요.</span>"
                                                    }
                                                }
                                            });

                                            $('#modForm').validate({
                                                //validation이 끝난 이후의 submit 직전 추가 작업할 부분
                                                submitHandler: function () {
                                                    var f = confirm("지점등록을 수정하겠습니까?");
                                                    if (f) {
                                                        return true;
                                                    } else {
                                                        return false;
                                                    }
                                                },
                                                rules: {
                                                    name: {
                                                        required: true
                                                    },
                                                    owner_name: {
                                                        required: true

                                                    },
                                                    owner_phone: {
                                                        required: true,
                                                        number: true
                                                    },
                                                    manager_name: {
                                                        required: true
                                                    },
                                                    manager_phone: {
                                                        required: true,
                                                        number: true
                                                    },
                                                    use_edate: {
                                                        required: true
                                                    }
                                                },
                                                //규칙체크 실패시 출력될 메시지
                                                messages: {
                                                    name: {
                                                        required: "<span class='helpR'>지점명을 입력해주세요.</span>"
                                                    },
                                                    owner_name: {
                                                        required: "<span class='helpR'>점주명을 입력해주세요.</span>"
                                                    }
                                                    ,
                                                    owner_phone: {
                                                        required: "<span class='helpR'>점주 연락처를 입력해주세요.</span>",
                                                        number: "<span class='helpR'>숫자만 입력해주세요.</span>"
                                                    },
                                                    manager_name: {
                                                        required: "<span class='helpR'>관리자명을 입력해주세요.</span>"
                                                    },
                                                    manager_phone: {
                                                        required: "<span class='helpR'>관리자 연락처를 입력해주세요.</span>",
                                                        number: "<span class='helpR'>숫자만 입력해주세요.</span>"
                                                    },
                                                    use_edate: {
                                                        required: "<span class='helpR'>사용종료일을 입력해주세요.</span>"
                                                    }
                                                }
                                            });

                                            $("#mod_del_btn").click(function () {
                                                if (confirm("정말 삭제하시겠습니까??") == true) {    //확인
                                                    var data = {idx: $(this).val()};
                                                    $.ajax({
                                                        dataType: 'text',
                                                        url: '/index.php/dataFunction/delBranch',
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

                                        function openModModal(idx) {
                                            var data = {idx: idx};
                                            $.ajax({
                                                dataType: 'json',
                                                url: '/index.php/dataFunction/getModBranchInfo',
                                                data: data,
                                                type: 'POST',
                                                success: function (data, status, xhr) {
                                                    if (data.RESULT == 'SUCCESS') {
                                                        $("#idx").val(data.BRANCH_IDX);
                                                        $("#mod_name").val(data.NAME);
                                                        $("#mod_id").val(data.ID);
                                                        $("#mod_type").val(data.TYPE).prop('selected', true);
                                                        $("#mod_owner_name").val(data.OWNER_NAME);
                                                        $("#mod_owner_phone").val(data.OWNER_PHONE);
                                                        $("#mod_manager_name").val(data.MANAGER_NAME);
                                                        $("#mod_manager_phone").val(data.MANAGER_PHONE);
                                                        $("#mod_use_edate").val(data.USE_EDATE);
                                                        $("#mod_comment").val(data.COMMENT);
                                                        $("#mod_del_btn").val(data.BRANCH_IDX);
                                                        $("#modifyModal").modal();
                                                    } else if (data.RESULT == 'FAILED') {
                                                        alert("데이터 처리오류!!");
                                                        return false;
                                                    }

                                                }
                                            });
                                        }
</script>