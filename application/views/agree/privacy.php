<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>개인정보 관리</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- start project list -->
                        <form method="post" action="/index.php/dataFunction/modPrivacy">
                            <input type="hidden" name="idx" value="<?= $this->session->userdata('BRANCH_IDX') ?>">
                            <table class="table table-striped jambo_table bulk_action board_table">
                                <colgroup>
                                    <col width="*">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>개인정보 관리</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <?php //if ($this->session->userdata('BRANCH_IDX') === '1') { ?>
                                                <textarea name="privacy" class="form-control" placeholder="내용을 입력해주세요." required><?= $info->PRIVACY ?></textarea>
                                            <?php //} else { ?>
                                                
                                            <?php //} ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php //if ($this->session->userdata('BRANCH_IDX') === '1') { ?>
                            <button type="button" class="btn btn-warning">취소</button>
                            <button type="submit" class="btn btn-primary">저장</button>
                            <?php //} ?>
                        </form>
                        <!-- end project list -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->
