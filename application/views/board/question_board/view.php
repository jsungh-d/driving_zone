<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>1:1게시판</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped  board_table board_view_table">
                            <colgroup>
                                <col width="80px"><col width="150px"><col width="80px"><col width="*">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>제목</th>
                                    <th colspan="3" class="text_align_l"><?= $info->TITLE ?></th>
                                </tr>
                                <tr>
                                    <th>작성자</th>
                                    <th class="text_align_l"><?= $info->NAME ?></th>
                                    <th>작성일</th>
                                    <th class="text_align_l"><?= $info->INS_DATE ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text_align_l" colspan="4">
                                        <div class="view_detail">
                                            <?= nl2br($info->CONTENTS) ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if ($info->ANSWER) { ?>
                            <table class="table table-striped  board_table board_view_table">
                                <colgroup>
                                    <col width="80px">
                                    <col width="*">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>답변일</th>
                                        <th class="text_align_l"><?= $info->A_TIMESTAMP ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text_align_l" colspan="2">
                                            <div class="view_detail">
                                                <?= nl2br($info->ANSWER) ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>

                        <?php
                        if ($this->uri->segment(4) != 'none') {
                            $url = "/index/question_board/q/gubun/" . $this->uri->segment(4) . "/text/" . $this->uri->segment(5) . "/page/" . $this->uri->segment(6) . "";
                        } else {
                            $url = "/index/question_board/page/" . $this->uri->segment(6) . "";
                        }
                        ?>

                        <button type="button" class="btn btn-primary" onclick="location.href = '<?= $url ?>'">목록</button>
                        <?php if ($this->session->userdata('BRANCH_IDX') === '1') { ?>
                            <button type="button" class="btn btn-warning" onclick="location.href = '/index/question_board_answer/<?= $this->uri->segment(3) ?>/<?= $this->uri->segment(4) ?>/<?= $this->uri->segment(5) ?>/<?= $this->uri->segment(6) ?>'">답변작성</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-warning" onclick="location.href = '/index/question_board_modify/<?= $this->uri->segment(3) ?>/<?= $this->uri->segment(4) ?>/<?= $this->uri->segment(5) ?>/<?= $this->uri->segment(6) ?>'">수정</button>
                        <?php } ?>
                        <button type="button" id="del_contents_btn" class="btn btn-danger" value="<?= $info->QUESTION_BOARD_IDX ?>">삭제</button>
                        <!-- end project list -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /page content -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#del_contents_btn").click(function () {
            if (confirm("삭제 하시겠습니까?") == true) {    //확인

                var idx = $(this).val();
                var data = {idx: idx};

                $.ajax({
                    dataType: 'text',
                    url: '/index.php/dataFunction/delQuestionBoard',
                    data: data,
                    type: 'POST',
                    success: function (data, status, xhr) {
                        if (data == 'SUCCESS') {
                            alert('삭제 되었습니다.');
                            location.href = '/index/question_board';
                        } else {
                            alert('처리오류');
                            return false;
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>