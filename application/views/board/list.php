<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>게시판</h3>
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
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped jambo_table bulk_action board_table">
                            <colgroup>
                                <col width="50px"><col width="*"><col width="100px"><col width="110px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>작성자</th>
                                    <th>작성일</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$lists) { ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                            게시글이 없습니다.
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php
                                foreach ($lists as $row) {
                                    if ($this->uri->segment(3) == 'q') {
                                        $num = $total_rows - $this->uri->segment(9);
                                        $page = $this->uri->segment(9);
                                        $gubun = $this->uri->segment(5);
                                        $title = $this->uri->segment(7);
                                    } else {
                                        $num = $total_rows - $this->uri->segment(4);
                                        $page = $this->uri->segment(4);
                                        $gubun = "none";
                                        $title = "none";
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $num ?></td>
                                        <td>
                                            <a href="/index/board_view/<?= $row['BOARD_IDX'] ?>/<?= $gubun ?>/<?= $title ?>/<?= $page ?>"><?= $row['TITLE'] ?></a>
                                        </td>
                                        <td><?= $row['NAME'] ?></td>
                                        <td><?= $row['INS_DATE'] ?></td>
                                    </tr>
                                    <?php
                                    $num --;
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php if ($this->session->userdata('BRANCH_IDX') == '1') { ?>
                            <button type="button" class="btn btn-primary" onclick="location.href = '/index/board_write'">글 쓰기</button>
                        <?php } ?>
                        <!-- end project list -->
                    </div>
                </div>
            </div>
            <?= $pagination ?>
        </div>

    </div>
</div>
<!-- /page content -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#search_text").keydown(function (key) {
            var gubun = 'contents';
            var text = $("#search_text").val();

            if (!$.trim(text)) {
                text = 'none';
            }

            if (key.keyCode == 13) {
                if (text !== 'none') {
                    location.href = '/index/board/q/gubun/' + gubun + '/text/' + text + '';
                } else {
                    location.href = '/index/board';
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
                location.href = '/index/board/q/gubun/' + gubun + '/text/' + text + '';
            } else {
                location.href = '/index/board';
            }
        });
    });
</script>