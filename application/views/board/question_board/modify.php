<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>1:1게시판 글 수정</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" action="/index.php/dataFunction/modQuestionBoard">
                            <input type="hidden" name="idx" value="<?= $this->uri->segment(3) ?>">
                            <input type="hidden" name="gubun" value="<?= $this->uri->segment(4) ?>">
                            <input type="hidden" name="text" value="<?= $this->uri->segment(5) ?>">
                            <input type="hidden" name="page" value="<?= $this->uri->segment(6) ?>">
                            <table class="table table-striped jambo_table bulk_action board_table">
                                <colgroup>
                                    <col width="*">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>제목</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="title" class="form-control" placeholder="제목" value="<?= $info->TITLE ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea name="contents" class="form-control" placeholder="문의내용을 입력해주세요." required><?= $info->CONTENTS ?></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-warning" onclick="location.href = '/index/question_board_view/<?= $this->uri->segment(3) ?>/<?= $this->uri->segment(4) ?>/<?= $this->uri->segment(5) ?>/<?= $this->uri->segment(6) ?>'">취소</button>
                            <button type="submit" class="btn btn-primary">수정</button>
                        </form>
                        <!-- end project list -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /page content -->
