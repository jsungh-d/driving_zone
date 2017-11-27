 <!-- Chart.js -->
 <script src="/vendors/Chart.js/dist/Chart.min.js"></script>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>통계</h3>
        </div>

        <!--        <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                    <!-- <div class="x_title">
                        <select class="title_select">
                            <option value=""><h2>가나다점</h2></option>
                            <option value=""><h2>라마바점</h2></option>
                            <option value=""><h2>사아자점</h2></option>
                        </select>
                        <small></small>

                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
                            <li></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div> -->
                    <div class="x_content">
                        <div class="row" style="margin-top: 20px;">

                            <div class="col-lg-12 col-xs-12">
                                <div class="x_panel tile">
                                    <div class="x_title statistics_title">
                                        <h2>기간별 매출 확인</h2>
                                        <ul class="nav navbar-right panel_toolbox"  style="width: 220px;">
                                            <div class="input-group" style="margin:0;">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control date_rangepicker" id="sales_date_term" value="" placeholder="날짜지정">
                                            </div>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="sales_wrapper2" style="height:500px;">
                                            <canvas id="salesTerm"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- col 종료 -->


                            <div class="col-lg-6 col-xs-12">
                                <div class="x_panel tile">
                                    <div class="x_title statistics_title">
                                        <h2>매출</h2>
                                        <div class="statistic_btn_area statistic_btn_area_sales">
                                            <div class="on statistic_btn">일간</div>
                                            <div class="statistic_btn">월간</div>
                                        </div>
                                        <ul class="nav navbar-right panel_toolbox"  style="width: 170px;">
                                            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" style="margin:0;">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control" id="sales_date" value="" placeholder="날짜지정">
                                            </div>
                                            <!-- <div class="input-group ">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control" id="sales_date_month" value="" placeholder="날짜지정">
                                            </div> -->
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="sales_wrapper" style="height:350px;">
                                            <canvas id="sales"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="x_panel tile">
                                    <div class="x_title statistics_title">
                                        <h2>회원 수</h2>
                                        <div class="statistic_btn_area statistic_btn_area_member">
                                            <div class="on statistic_btn">일간</div>
                                            <div class=" statistic_btn">월간</div>
                                        </div>
                                        <ul class="nav navbar-right panel_toolbox"  style="width: 170px;">
                                            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" style="margin:0;">
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                                <input type="text" class="form-control" id="member_date" value="" placeholder="날짜지정">
                                            </div>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="member_wrapper" style="height:350px">
                                            <canvas id="member"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>누적 매출</h2>
                                                                    <div class="statistic_btn_area">
                                                                        <div class="on">일간</div>
                                                                        <div>월간</div>
                                                                    </div>
                                                                    <ul class="nav navbar-right panel_toolbox"  style="width: 170px;">
                                                                        <div class="input-group date chart_date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                                            <div class="input-group-addon">
                                                                                <span class="fa fa-calendar"></span>
                                                                            </div>
                                                                            <input type="text" class="form-control" id="total_sales_date" value="" placeholder="날짜지정">
                                                                        </div>
                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">
                                                                    <canvas id="total_sales"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>누적 회원</h2>
                                                                    <div class="statistic_btn_area">
                                                                        <div class="on">일간</div>
                                                                        <div>월간</div>
                                                                    </div>
                                                                    <ul class="nav navbar-right panel_toolbox"  style="width: 170px;">
                                                                        <div class="input-group date chart_date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                                            <div class="input-group-addon">
                                                                                <span class="fa fa-calendar"></span>
                                                                            </div>
                                                                            <input type="text" class="form-control" id="total_member_date" value="" placeholder="날짜지정">
                                                                        </div>
                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">
                                                                    <canvas id="total_member"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel">
                                                                <div class="x_title" style="padding-bottom: 2px">
                                                                    <h2>기간별 상품 유형</h2>
                                                                    <ul class="nav navbar-right panel_toolbox" style="width: 220px;">
                                                                        <div class="input-group" style="margin:0;">
                                                                            <div class="input-group-addon" style="">
                                                                                <span class="fa fa-calendar"></span>
                                                                            </div>
                                                                            <input type="text" class="form-control date_rangepicker" id="goods_date_term" value="" placeholder="날짜지정" >
                                                                        </div>
                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12"> 
                                                                            <div class="goodsTypeTerm_wrapper" style="height:300px;">
                                                                                <canvas id="goodsTypeTerm" ></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%; margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">상품</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="goodsTypeTextArea">
                                                                                    
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel">
                                                                <div class="x_title">
                                                                    <h2>상품 유형</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12"> 
                                                                            <div class="goodsType_wrapper" style="height:300px;">
                                                                                <canvas id="goodsType" ></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%; margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">상품</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($goods_lists as $row) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><?= $row['GOODS_TYPE'] ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $row['SUM_GOODS_PERCENT'] ?>% (누적 금액 : <?= number_format($row['GOODS_PRICE']) ?>)</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>결제 유형</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="payType_wrapper" style="height:300px;">
                                                                                <canvas id="payType"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%; margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">결제</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($pay_percent as $row) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><?= $row['NAME'] ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $row['PAY_CNT'] ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>방문 경로</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="route_wrapper" style="height:300px;">
                                                                                <canvas id="route"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%; margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">방문경로</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($visit_route_percent as $row) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><?= $row['NAME'] ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $row['VISIT_ROUTE_CNT'] ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>연습방법</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="practice_wrapper" style="height:300px;">
                                                                                <canvas id="practice"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%;  margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">연습방법</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($practice_percent as $row) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><?= $row['NAME'] ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $row['PRACTICE_CNT'] ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>시험장소</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="place_wrapper" style="height:300px;">
                                                                                <canvas id="place"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%;  margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">시험장소</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($test_site_percent as $row) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><?= $row['NAME'] ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $row['TEST_SITE_CNT'] ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>합격률</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="pass_wrapper" style="height:300px;">
                                                                                <canvas id="pass"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%;  margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">합격여부</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p>합격</p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $pass->PASS ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p>미합격</p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $unpass->FAILED ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel tile">
                                                                <div class="x_title">
                                                                    <h2>상담 후 계약률</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-xs-12">
                                                                            <div class="proceeding_wrapper" style="height:300px;">
                                                                                <canvas id="proceeding"></canvas>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12">
                                                                            <table class="" style="width:100%;  margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="">계약여부</p>
                                                                                        </th>
                                                                                        <th>
                                                                                            <p class="">비율</p>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p>계약</p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $proceeding->PASS ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p>미계약</p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><?= $unproceeding->FAILED ?>%</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- col 종료 -->
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="x_panel">
                                                                <div class="x_title">
                                                                    <h2>합격기간</h2>
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
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>1개월 이내</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range1->ONE_MONTH ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range1->ONE_MONTH ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range1->ONE_MONTH ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>2개월 이내</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range2->TWO_MONTH ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range2->TWO_MONTH ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range2->TWO_MONTH ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>3개월 이내</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range3->THREE_MONTH ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range3->THREE_MONTH ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range3->THREE_MONTH ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>6개월 이내</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range4->SIX_MONTH ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range4->SIX_MONTH ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range4->SIX_MONTH ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>1년 이내</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range5->ONE_YEAR ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range5->ONE_YEAR ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range5->ONE_YEAR ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="widget_summary">
                                                                        <div class="w_left w_25">
                                                                            <span>1년 이상</span>
                                                                        </div>
                                                                        <div class="w_center w_55">
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $pass_range6->ONE_YEAR_OVER ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pass_range6->ONE_YEAR_OVER ?>%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w_right w_20">
                                                                            <span><?= $pass_range6->ONE_YEAR_OVER ?>%</span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /page content -->

                            <script type="text/javascript">
                                $(document).ready(function () {

                                    $(".statistic_btn_area div").click(function () {
                                        $(this).parent().find("div").removeClass("on");
                                        $(this).addClass("on");

                                        var index = $(this).parent().index(".statistic_btn_area");

                                        if ($(this).text() == '월간') {
                                            if (index == 0) {
                                                $("#sales_date").datepicker("destroy");
                                                $("#sales_date").datepicker({
                                                    format: 'yyyy-mm-dd',
                                                    autoclose: true,
                                                    language: "kr",
                                                    todayHighlight: false,
                                                    maxViewMode: 2,
                                                    minViewMode: 1
                                                });

                                                var data = {date: $("#sales_date").val(), type: 'month'};

                                                $.ajax({
                                                    dataType: 'json',
                                                    url: '/index.php/dataFunction/statisticsChart',
                                                    data: data,
                                                    type: 'POST',
                                                    success: function (data, status, xhr) {

                                                        $('#sales').remove();
                                                        $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                                                        var ctx = document.getElementById("sales");

                                                        var title = [];
                                                        var price = [];
                                                        for (var i = 0; i < data.price.length; i++) {
                                                            title.push(data.price[i].title);
                                                            price.push(data.price[i].price);
                                                        }
                                                        var mybarChart = new Chart(ctx, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: title,
                                                                datasets: [{
                                                                    label: '매출',
                                                                    backgroundColor: "#0d2259",
                                                                    data: price
                                                                }]
                                                            },
                                                            options: {
                                                                maintainAspectRatio: false,
                                                                tooltips: {
                                                                    callbacks: {
                                                                        label: function (tooltipItem, data) {
                                                                            var value = data.datasets[0].data[tooltipItem.index];
                                                                            if (parseInt(value) >= 1000) {
                                                                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                                                            } else {
                                                                                return  value.toFixed(1) + "원";
                                                                            }
                                                                        }
                                                                    }
                                                                },
                                                                scales: {
                                                                    yAxes: [{
                                                                        ticks: {
                                                                            beginAtZero: true,
                                                                            callback: function (value, index, values) {
                                                                                if (parseInt(value) >= 1000) {
                                                                                    return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                                                                } else {
                                                                                    return  value.toFixed(1) + "원";
                                                                                }
                                                                            }
                                                                        }
                                                                    }]
                                                                }
                                                            }
                                                        });

                                                    }
                                                });


} else {
    $("#member_date").datepicker("destroy");
    $("#member_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        language: "kr",
        todayHighlight: false,
        maxViewMode: 2,
        minViewMode: 1
    });


    var data = {date: $("#member_date").val(), type: 'month'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {

            $('#member').remove();
            $('.member_wrapper').append('<canvas id="member"><canvas>');

            var ctx = document.getElementById("member");

            var member_title = [];
            var member_price = [];
            for (var i = 0; i < data.member.length; i++) {
                member_title.push(data.member[i].member_title);
                member_price.push(data.member[i].member_price);
            }

            var memberChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: member_title,
                    datasets: [{
                        label: '회원',
                        backgroundColor: "#58d6ff",
                        data: member_price
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                }
            });

        }
    });

}
} else {
    if (index == 0) {
        $("#sales_date").datepicker("destroy");
        $("#sales_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: "kr",
            todayHighlight: true,
            maxViewMode: 2,
            minViewMode: 0
        });

        var data = {date: $("#sales_date").val(), type: 'day'};

        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/statisticsChart',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {

                $('#sales').remove();
                $('.sales_wrapper').append('<canvas id="sales"><canvas>');

                var ctx = document.getElementById("sales");

                var title = [];
                var price = [];
                for (var i = 0; i < data.price.length; i++) {
                    title.push(data.price[i].title);
                    price.push(data.price[i].price);
                }
                var mybarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: title,
                        datasets: [{
                            label: '매출',
                            backgroundColor: "#0d2259",
                            data: price
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var value = data.datasets[0].data[tooltipItem.index];
                                    if (parseInt(value) >= 1000) {
                                        return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                    } else {
                                        return  value.toFixed(1) + "원";
                                    }
                                }
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value, index, values) {
                                        if (parseInt(value) >= 1000) {
                                            return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                        } else {
                                            return  value.toFixed(1) + "원";
                                        }
                                    }
                                }
                            }]
                        }
                    }
                });

            }
        });
    } else {
        $("#member_date").datepicker("destroy");
        $("#member_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: "kr",
            todayHighlight: true,
            maxViewMode: 2,
            minViewMode: 0
        });

        var data = {date: $("#member_date").val(), type: 'day'};

        $.ajax({
            dataType: 'json',
            url: '/index.php/dataFunction/statisticsChart',
            data: data,
            type: 'POST',
            success: function (data, status, xhr) {

                $('#member').remove();
                $('.member_wrapper').append('<canvas id="member"><canvas>');

                var ctx = document.getElementById("member");

                var member_title = [];
                var member_price = [];
                for (var i = 0; i < data.member.length; i++) {
                    member_title.push(data.member[i].member_title);
                    member_price.push(data.member[i].member_price);
                }



                var memberChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: member_title,
                        datasets: [{
                            label: '회원',
                            backgroundColor: "#58d6ff",
                            data: member_price
                        }]
                    },
                    options: {
                        maintainAspectRatio: false
                    }
                });

            }
        });
    }
}
});

 $("#member_date").val(moment().format('YYYY-MM-DD'));
 $("#sales_date").val(moment().format('YYYY-MM-DD'));
 $("#total_member_date").val(moment().format('YYYY-MM-DD'));
 $("#total_sales_date").val(moment().format('YYYY-MM-DD'));

 var dt = new Date();
 var year = dt.getFullYear();
 var month = dt.getMonth() + 1;
 var day = dt.getDate();

 var data = {date: year + '-' + month + '-' + day, type: 'day'};

 $.ajax({
    dataType: 'json',
    url: '/index.php/dataFunction/statisticsChart',
    data: data,
    type: 'POST',
    success: function (data, status, xhr) {

// 매출 그래프
if ($('#sales').length) {
    var ctx = document.getElementById("sales");
    ctx.height = 350;
    var title = [];
    var price = [];
    for (var i = 0; i < data.price.length; i++) {
        title.push(data.price[i].title);
        price.push(data.price[i].price);
    }
    var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: title,
            datasets: [{
                label: '매출',
                backgroundColor: "#0d2259",
                data: price
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var value = data.datasets[0].data[tooltipItem.index];
                        if (parseInt(value) >= 1000) {
                            return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                        } else {
                            return  value.toFixed(1) + "원";
                        }
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value, index, values) {
                            if (parseInt(value) >= 1000) {
                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                            } else {
                                return  value.toFixed(1) + "원";
                            }
                        }
                    }
                }]
            }
        }
    });


}

// 회원그래프
if ($('#member').length) {
    var ctx = document.getElementById("member");
    ctx.height = 350;
    var member_title = [];
    var member_price = [];
    for (var i = 0; i < data.member.length; i++) {
        member_title.push(data.member[i].member_title);
        member_price.push(data.member[i].member_price);
    }

    var memberChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: member_title,
            datasets: [{
                label: '회원',
                backgroundColor: "#58d6ff",
                data: member_price
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

                    // memberChart.destroy();
                }

// 누적 매출 그래프
//                    if ($('#total_sales').length) {
//                        var select_date = $("#sales_date").val();
//                        var ctx = document.getElementById("total_sales");
//                        var tot_price_title = [];
//                        var tot_price_price = [];
//                        for (var i = 0; i < data.tot_price.length; i++) {
//                            tot_price_title.push(data.tot_price[i].tot_price_title);
//                            tot_price_price.push(data.tot_price[i].tot_price_price);
//                        }
//                        var lineChart = new Chart(ctx, {
//                            type: 'line',
//                            data: {
//                                labels: tot_price_title,
//                                datasets: [{
//                                        label: "누적 매출",
//                                        backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                        borderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                        pointHoverBackgroundColor: "#fff",
//                                        pointHoverBorderColor: "rgba(220,220,220,1)",
//                                        pointBorderWidth: 1,
//                                        data: tot_price_price
//                                    }]
//                            },
//                            options: {
//                                scales: {
//                                    yAxes: [{
//                                            ticks: {
//                                                suggestedMin: 0,
//                                                beginAtZero: true
//                                            }
//                                        }]
//                                }
//                            }
//                        });
//                        lineChart.destroy();
//                    }

// 상품유형 그래프
if ($('#goodsType').length) {
    var ctx = document.getElementById("goodsType");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".goodsType_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var goods_title = [];
    var goods_price = [];
    for (var i = 0; i < data.goods.length; i++) {
        goods_title.push(data.goods[i].goods_title);
        goods_price.push(data.goods[i].goods_price);
    }

    var chartdata = {
        labels: goods_title,
        datasets: [{
            data: goods_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}

// 결제 형태 그래프
if ($('#payType').length) {
    var ctx = document.getElementById("payType");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".payType_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var pay_title = [];
    var pay_price = [];
    for (var i = 0; i < data.pay.length; i++) {
        pay_title.push(data.pay[i].pay_title);
        pay_price.push(data.pay[i].pay_price);
    }
    var chartdata = {
        labels: pay_title,
        datasets: [{
            data: pay_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}

// 방문 경로 그래프
if ($('#route').length) {
    var ctx = document.getElementById("route");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 4) * 15 + 300;
    $(".route_wrapper").css("height", (data.test_site.length - 4) * 15 + 300);
    var visit_route_title = [];
    var visit_route_price = [];
    for (var i = 0; i < data.visit_route.length; i++) {
        visit_route_title.push(data.visit_route[i].visit_route_title);
        visit_route_price.push(data.visit_route[i].visit_route_price);
    }

    var visit_route_data = {
        labels: visit_route_title,
        datasets: [{
            data: visit_route_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: visit_route_data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}

// 연습방법 그래프
if ($('#practice').length) {
    var ctx = document.getElementById("practice");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".practice_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var practice_title = [];
    var practice_price = [];
    for (var i = 0; i < data.practice.length; i++) {
        practice_title.push(data.practice[i].practice_title);
        practice_price.push(data.practice[i].practice_price);
    }

    var practice_data = {
        labels: practice_title,
        datasets: [{
            data: practice_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: practice_data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}

// 합격률 그래프
if ($('#pass').length) {
    var ctx = document.getElementById("pass");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".pass_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var pass_title = ['합격', '미합격'];
    var pass_value = [data.pass[0].pass_value, data.unpass[0].unpass_value];

    var pass_data = {
        labels: pass_title,
        datasets: [{
            data: pass_value,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: pass_data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}


// 합격률 그래프
if ($('#proceeding').length) {
    var ctx = document.getElementById("proceeding");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".proceeding_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var proceeding_title = ['계약', '미계약'];
    var proceeding_value = [data.proceeding[0].proceeding_value, data.unproceeding[0].unproceeding_value];

    var proceeding_data = {
        labels: proceeding_title,
        datasets: [{
            data: proceeding_value,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: proceeding_data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}

// 방문 경로 그래프
if ($('#contract').length) {
    var ctx = document.getElementById("contract");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 4) * 15 + 300;
    $(".contract_wrapper").css("height", (data.test_site.length - 4) * 15 + 300);
    var visit_route_title = [];
    var visit_route_price = [];
    for (var i = 0; i < data.visit_route.length; i++) {
        visit_route_title.push(data.visit_route[i].visit_route_title);
        visit_route_price.push(data.visit_route[i].visit_route_price);
    }

    var visit_route_data = {
        labels: visit_route_title,
        datasets: [{
            data: visit_route_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: visit_route_data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}



// 시험장소 그래프
if ($('#place').length) {
    var ctx = document.getElementById("place");
    ctx.height = 300;
    ctx.height = (data.test_site.length - 5) * 15 + 300;
    $(".place_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
    var test_site_title = [];
    var test_site_price = [];
    for (var i = 0; i < data.test_site.length; i++) {
        test_site_title.push(data.test_site[i].test_site_title);
        test_site_price.push(data.test_site[i].test_site_price);
    }
    ctx.height = (data.test_site.length - 4) * 15 + 300;
    $(".place_wrapper").css("height", (data.test_site.length - 4) * 15 + 300);
    var data = {
        labels: test_site_title,
        datasets: [{
            data: test_site_price,
            backgroundColor: [
            "#0d2259",
            "#58d6ff",
            "#dd9eea",
            "#24afc4",
            "#9eeace",
            "#ffc547",
            "#3e5ad5",
            "#fa6465",
            "#4da803"
            ],
            hoverBackgroundColor: [
            "#35497e",
            "#9ee3f9",
            "#e2b8eb",
            "#74bdc8",
            "#cbe9de",
            "#fed67f",
            "#667bd7",
            "#f78686",
            "#81bb52"
            ]
        }]
    };

    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
}
}
});


// 날짜 선택 할 때 
$("#sales_date").change(function () {
    var select_date = $("#sales_date").val();

// 일간일때
if ($(this).parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {

    var data = {date: select_date, type: 'day'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {

            $('#sales').remove();
            $('.sales_wrapper').append('<canvas id="sales"><canvas>');

            var ctx = document.getElementById("sales");

            var title = [];
            var price = [];
            for (var i = 0; i < data.price.length; i++) {
                title.push(data.price[i].title);
                price.push(data.price[i].price);
            }
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: title,
                    datasets: [{
                        label: '매출',
                        backgroundColor: "#0d2259",
                        data: price
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var value = data.datasets[0].data[tooltipItem.index];
                                if (parseInt(value) >= 1000) {
                                    return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                } else {
                                    return  value.toFixed(1) + "원";
                                }
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                    } else {
                                        return  value.toFixed(1) + "원";
                                    }
                                }
                            }
                        }]
                    }
                }
            });

        }
    });
}
// 월간일때
else {
    var data = {date: select_date, type: 'month'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {
            $('#sales').remove();
            $('.sales_wrapper').append('<canvas id="sales"><canvas>');

            var ctx = document.getElementById("sales");

            var title = [];
            var price = [];
            for (var i = 0; i < data.price.length; i++) {
                title.push(data.price[i].title);
                price.push(data.price[i].price);
            }
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: title,
                    datasets: [{
                        label: '매출',
                        backgroundColor: "#0d2259",
                        data: price
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var value = data.datasets[0].data[tooltipItem.index];
                                if (parseInt(value) >= 1000) {
                                    return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                } else {
                                    return  value.toFixed(1) + "원";
                                }
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                    } else {
                                        return  value.toFixed(1) + "원";
                                    }
                                }
                            }
                        }]
                    }
                }
            });

        }
    });
}
});

// 날짜 선택 할 때 
$("#member_date").change(function () {
    var select_date = $("#member_date").val();

// 일간일때
if ($(this).parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {

    var data = {date: select_date, type: 'day'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {
            $('#member').remove();
            $('.member_wrapper').append('<canvas id="member"><canvas>');

            var ctx = document.getElementById("member");
            var member_title = [];
            var member_price = [];
            for (var i = 0; i < data.member.length; i++) {
                member_title.push(data.member[i].member_title);
                member_price.push(data.member[i].member_price);
            }

            var memberChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: member_title,
                    datasets: [{
                        label: '회원',
                        backgroundColor: "#58d6ff",
                        data: member_price
                    }]
                },
                options: {
                    maintainAspectRatio: false
                }
            });

        }
    });


}
// 월간일때
else {
    var data = {date: select_date, type: 'month'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChart',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {
            $('#member').remove();
            $('.member_wrapper').append('<canvas id="member"><canvas>');

            var ctx = document.getElementById("member");
            var member_title = [];
            var member_price = [];
            for (var i = 0; i < data.member.length; i++) {
                member_title.push(data.member[i].member_title);
                member_price.push(data.member[i].member_price);
            }

            var memberChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: member_title,
                    datasets: [{
                        label: '회원',
                        backgroundColor: "#58d6ff",
                        data: member_price
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                }
            });

        }
    });
}
});

// 날짜 선택 할 때 
//            $("#total_sales_date").change(function () {
//                var select_date = $("#total_sales_date").val();
//                var ctx = document.getElementById("total_sales");
//                // 일간일때
//                if ($(this).parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {
//                    var lineChart = new Chart(ctx, {
//                        type: 'line',
//                        data: {
//                            labels: [newDate(select_date, -6), newDate(select_date, -5), newDate(select_date, -4), newDate(select_date, -3), newDate(select_date, -2), newDate(select_date, -1), newDate(select_date, 0)],
//                            datasets: [{
//                                    label: "누적 매출",
//                                    backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                    borderColor: "rgba(38, 185, 154, 0.7)",
//                                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                    pointHoverBackgroundColor: "#fff",
//                                    pointHoverBorderColor: "rgba(220,220,220,1)",
//                                    pointBorderWidth: 1,
//                                    data: [31, 74, 6, 39, 20, 85, 7, 120]
//                                }]
//                        },
//                        options: {
//                            scales: {
//                                yAxes: [{
//                                        ticks: {
//                                            suggestedMin: 0,
//                                            beginAtZero: true
//                                        }
//                                    }]
//                            }
//                        }
//                    });
//                }
//                // 월간일때
//                else {
//                    var lineChart = new Chart(ctx, {
//                        type: 'line',
//                        data: {
//                            labels: [newMonth(select_date, -6), newMonth(select_date, -5), newMonth(select_date, -4), newMonth(select_date, -3), newMonth(select_date, -2), newMonth(select_date, -1), newMonth(select_date, 0)],
//                            datasets: [{
//                                    label: "누적 매출",
//                                    backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                    borderColor: "rgba(38, 185, 154, 0.7)",
//                                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                    pointHoverBackgroundColor: "#fff",
//                                    pointHoverBorderColor: "rgba(220,220,220,1)",
//                                    pointBorderWidth: 1,
//                                    data: [31, 74, 6, 39, 20, 85, 7, 120]
//                                }]
//                        },
//                        options: {
//                            scales: {
//                                yAxes: [{
//                                        ticks: {
//                                            suggestedMin: 0,
//                                            beginAtZero: true
//                                        }
//                                    }]
//                            }
//                        }
//                    });
//                }
//            });
//
//
//            if ($('#total_member').length) {
//
//                var select_date = $("#sales_date").val();
//                var ctx = document.getElementById("total_member");
//                var lineChart = new Chart(ctx, {
//                    type: 'line',
//                    data: {
//                        labels: [newDate(select_date, -6), newDate(select_date, -5), newDate(select_date, -4), newDate(select_date, -3), newDate(select_date, -2), newDate(select_date, -1), newDate(select_date, 0)],
//                        datasets: [{
//                                label: "누적 회원",
//                                backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                borderColor: "rgba(38, 185, 154, 0.7)",
//                                pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                pointHoverBackgroundColor: "#fff",
//                                pointHoverBorderColor: "rgba(220,220,220,1)",
//                                pointBorderWidth: 1,
//                                data: [31, 74, 6, 39, 20, 85, 7, 60]
//                            }]
//                    },
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                    ticks: {
//                                        beginAtZero: true
//                                    }
//                                }]
//                        }
//                    }
//                });
//                lineChart.destroy();
//                // 날짜 선택 할 때 
//                $("#total_member_date").change(function () {
//                    var select_date = $("#total_member_date").val();
//                    var ctx = document.getElementById("total_member");
//                    // 일간일때
//                    if ($(this).parent().parent().siblings(".statistic_btn_area").find(".on").text() == "일간") {
//                        var lineChart = new Chart(ctx, {
//                            type: 'line',
//                            data: {
//                                labels: [newDate(select_date, -6), newDate(select_date, -5), newDate(select_date, -4), newDate(select_date, -3), newDate(select_date, -2), newDate(select_date, -1), newDate(select_date, 0)],
//                                datasets: [{
//                                        label: "누적 회원",
//                                        backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                        borderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                        pointHoverBackgroundColor: "#fff",
//                                        pointHoverBorderColor: "rgba(220,220,220,1)",
//                                        pointBorderWidth: 1,
//                                        data: [31, 74, 6, 39, 20, 85, 7, 60]
//                                    }]
//                            },
//                            options: {
//                                scales: {
//                                    yAxes: [{
//                                            ticks: {
//                                                beginAtZero: true
//                                            }
//                                        }]
//                                }
//                            }
//                        });
//                    }
//                    // 월간일때
//                    else {
//                        var lineChart = new Chart(ctx, {
//                            type: 'line',
//                            data: {
//                                labels: [newMonth(select_date, -6), newMonth(select_date, -5), newMonth(select_date, -4), newMonth(select_date, -3), newMonth(select_date, -2), newMonth(select_date, -1), newMonth(select_date, 0)],
//                                datasets: [{
//                                        label: "누적 회원",
//                                        backgroundColor: "rgba(38, 185, 154, 0.31)",
//                                        borderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
//                                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
//                                        pointHoverBackgroundColor: "#fff",
//                                        pointHoverBorderColor: "rgba(220,220,220,1)",
//                                        pointBorderWidth: 1,
//                                        data: [31, 74, 6, 39, 20, 85, 7, 60]
//                                    }]
//                            },
//                            options: {
//                                scales: {
//                                    yAxes: [{
//                                            ticks: {
//                                                beginAtZero: true
//                                            }
//                                        }]
//                                }
//                            }
//                        });
//                    }
//                });
//            }


var data = {date: $("#sales_date_term").val(), type: 'day'};
$.ajax({
    dataType: 'json',
    url: '/index.php/dataFunction/statisticsChartTerm',
    data: data,
    type: 'POST',
    success: function (data, status, xhr) {

        $('#salesTerm').remove();
        $('.sales_wrapper2').append('<canvas id="salesTerm"><canvas>');

        var ctx = document.getElementById("salesTerm");

        var title = [];
        var price = [];
        for (var i = 0; i < data.price.length; i++) {
            title.push(data.price[i].title);
            price.push(data.price[i].price);
        }
        var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: title,
                datasets: [{
                    label: '매출',
                    backgroundColor: "#0d2259",
                    data: price
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            if (parseInt(value) >= 1000) {
                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                            } else {
                                return  value.toFixed(1) + "원";
                            }
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                } else {
                                    return  value.toFixed(1) + "원";
                                }
                            }
                        }
                    }]
                }
            }
        });

    }
});



$("#sales_date_term").change(function(){

    var data = {date: $("#sales_date_term").val(), type: 'day'};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/statisticsChartTerm',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {

            $('#salesTerm').remove();
            $('.sales_wrapper2').append('<canvas id="salesTerm"><canvas>');

            var ctx = document.getElementById("salesTerm");

            var title = [];
            var price = [];
            for (var i = 0; i < data.price.length; i++) {
                title.push(data.price[i].title);
                price.push(data.price[i].price);
            }
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: title,
                    datasets: [{
                        label: '매출',
                        backgroundColor: "#0d2259",
                        data: price
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var value = data.datasets[0].data[tooltipItem.index];
                                if (parseInt(value) >= 1000) {
                                    return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                } else {
                                    return  value.toFixed(1) + "원";
                                }
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원";
                                    } else {
                                        return  value.toFixed(1) + "원";
                                    }
                                }
                            }
                        }]
                    }
                }
            });

        }
    });
            // ajax 종료
        });


$("#goods_date_term").change(function(){

    var data = {date: $("#goods_date_term").val()};

    $.ajax({
        dataType: 'json',
        url: '/index.php/dataFunction/goodsChartTerm',
        data: data,
        type: 'POST',
        success: function (data, status, xhr) {
            $("#goodsTypeTextArea").html(data.goods_name.goods_name);

            $('#goodsTypeTerm').remove();
            $('.goodsTypeTerm_wrapper').append('<canvas id="goodsTypeTerm"><canvas>');

            var ctx = document.getElementById("goodsTypeTerm");
            ctx.height = 300;
            // ctx.height = (data.test_site.length - 5) * 15 + 300;
            // $(".goodsTypeTerm_wrapper").css("height", (data.test_site.length - 5) * 15 + 300);
            var goods_title = [];
            var goods_price = [];
            for (var i = 0; i < data.goods.length; i++) {
                goods_title.push(data.goods[i].goods_title);
                goods_price.push(data.goods[i].goods_price);
            }

            var chartdata = {
                labels: goods_title,
                datasets: [{
                    data: goods_price,
                    backgroundColor: [
                    "#0d2259",
                    "#58d6ff",
                    "#dd9eea",
                    "#24afc4",
                    "#9eeace",
                    "#ffc547",
                    "#3e5ad5",
                    "#fa6465",
                    "#4da803"
                    ],
                    hoverBackgroundColor: [
                    "#35497e",
                    "#9ee3f9",
                    "#e2b8eb",
                    "#74bdc8",
                    "#cbe9de",
                    "#fed67f",
                    "#667bd7",
                    "#f78686",
                    "#81bb52"
                    ]
                }]
            };

            var canvasDoughnut = new Chart(ctx, {
                type: 'doughnut',
                data: chartdata,
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }
    });
            // ajax 종료
        });

});
 //document ready 종료

 function newDate(select_date, days) {
// return moment().add(days, 'd').toDate();
var date = moment(select_date).add(days, 'd').toDate();
return moment(date).format('YYYY-MM-DD');
}

function newMonth(select_date, days) {
// return moment().add(days, 'd').toDate();
var date = moment(select_date).add(days, 'M').toDate();
return moment(date).format('YYYY-MM');
}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

</script>