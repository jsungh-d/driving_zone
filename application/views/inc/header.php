<!DOCTYPE html>
<html lang="kor">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DrivingZone</title>

        <!-- Bootstrap -->
        <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- 테이블 소트 -->
        <link href="/vendors/sortable/Contents/bootstrap-sortable.css" rel="stylesheet"/>
        <!-- 데이트피커 -->
        <link href="/vendors/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- 데이트렌지피커 -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <!-- 체크박스 css -->
        <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="/build/css/custom.css" rel="stylesheet">
        <!-- 커먼 css -->
        <link href="/css/common.css" rel="stylesheet">
        <!-- 페이지네이션 css -->
        <link href="/css/pagination.css" rel="stylesheet">
        <!-- 다중 셀렉트 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <!-- 풀켈린더 -->
        <link href="/vendors/fullcalendar/dist/fullcalendar.css" rel="stylesheet">
        <link href="/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="/build/css/custom.css" rel="stylesheet">
        <!-- 스타일 css -->
        <link href="/css/style.css" rel="stylesheet">
        <!-- 제이쿼리 -->
        <script type="text/javascript" src="/vendors/jquery/dist/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- 테이블 소트 -->
        <!--<script src="/vendors/sortable/Scripts/bootstrap-sortable.js"></script>-->
        <!-- 다중 셀렉트 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <!-- 모멘트 -->
        <script src="/vendors/moment/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/2.2.0/moment-range.min.js"></script>
        <!-- 데이트렌지피커 -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <!-- 풀켈린더 -->
        <script src="/vendors/fullcalendar/dist/fullcalendar.js"></script>
        <!-- 웹캠 -->
        <script src="/js/webcam.js"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="/index/main" class="site_title"><span>고수의 운전면허</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="/images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <h2>고수의운전면허 매니징 프로그램</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li><a href="/index/main"><i class="fa fa-home"></i> Dashboard</a>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> 회원관리 <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/member">회원 현황</a></li>
                                            <li><a href="/index/member_delete">회원 임시 보관함</a></li>
                                            <li><a href="/index/item">항목 관리(관리자 전용)</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> 예약관리 <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/calender">예약 현황</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> 상품관리 <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/object">상품관리</a></li>
                                            <li><a href="/index/event">이벤트관리</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a><i class="fa fa-bar-chart-o"></i> 통계 보기 <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/statistics">통계 보기</a></li>
                                            <!--<li><a href="/index/sales_view">매출 상세 내역</a></li>-->
                                            <li><a href="/index/statistics_branch">지점별 매출 보기(관리자전용)</a></li>
                                            
                                        </ul>
                                    </li>
                                    <!-- <li><a><i class="fa fa-clone"></i> 방문경로 <span class="fa fa-chevron-down"></span></a> -->

                                    </li>
                                    <li><a><i class="fa fa-bug"></i> 지점관리 <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/store">내 지점 관리하기</a></li>
                                            <li><a href="/index/store_admin">지점 관리(관리자 전용)</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-windows"></i> 게시판 <?php if ($notice_cnt->CNT + $question_cnt->CNT > 0) echo '<img src="/images/new.png" class="new_text" style="margin-left: 3px; width:15px;">'; ?> <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/board">공지사항<?php if ($notice_cnt->CNT > 0) echo '<img src="/images/new.png" class="new_text" style="margin-left: 3px; width:15px;">'; ?></a></li>
                                            <li><a href="/index/question_board">1:1게시판<?php if ($question_cnt->CNT > 0) echo '<img src="/images/new.png" class="new_text" style="margin-left: 3px; width:15px;">'; ?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu_section">
                                <h3></h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-bug"></i>약관 관리<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/index/privacy">개인정보 수집동의 관리</a></li>
                                            <li><a href="/index/refunds">환급정책 관리</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/index/marketing"><i class="fa fa-windows"></i> 마케팅용 SMS작성</a>
                                    </li>
                                </ul>
                                </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="/index.php/dataFunction/logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <!-- <img src="/images/img.jpg" alt=""> -->
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="/index.php/dataFunction/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->