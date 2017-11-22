<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>1:1게시판 답변작성</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form method="post" action="/index.php/dataFunction/insBoardAnswer">
                        <input type="hidden" name="idx" value="<?= $this->uri->segment(3) ?>">
                        <input type="hidden" name="gubun" value="<?= $this->uri->segment(4) ?>">
                        <input type="hidden" name="text" value="<?= $this->uri->segment(5) ?>">
                        <input type="hidden" name="page" value="<?= $this->uri->segment(6) ?>">
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
                            <table class="table table-striped  board_table board_view_table">
                                <colgroup>
                                    <col width="80px">
                                    <col width="*">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>답변일</th>
                                        <th class="text_align_l"><?= date('Y-m-d')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text_align_l" colspan="2">
                                            <div class="view_detail">
                                                <textarea name="answer" class="form-control" placeholder="답변내용을 작성해주세요." required><?= $info->ANSWER ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php
                            if ($this->uri->segment(4) != 'none') {
                                $url = "/index/question_board/q/gubun/" . $this->uri->segment(4) . "/text/" . $this->uri->segment(5) . "/page/" . $this->uri->segment(6) . "";
                            } else {
                                $url = "/index/question_board/page/" . $this->uri->segment(6) . "";
                            }
                            ?>

                            <button type="button" class="btn btn-primary" onclick="location.href = '<?= $url ?>'">목록</button>
                            <button type="submit" class="btn btn-warning">답변작성</button>
                            <!-- end project list -->
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>