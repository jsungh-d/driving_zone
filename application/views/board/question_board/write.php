<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>1:1게시판 글 쓰기</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" action="/index.php/dataFunction/insQuestionBoard">
                            <input type="hidden" name="branch_idx" value="<?= $this->session->userdata('BRANCH_IDX') ?>">
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
                                            <input type="text" name="title" class="form-control" placeholder="제목" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea name="contents" class="form-control" placeholder="문의내용을 입력해주세요." required></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-warning" onclick="location.href = '/index/question_board'">취소</button>
                            <button type="submit" class="btn btn-primary">저장</button>
                        </form>
                        <!-- end project list -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->
