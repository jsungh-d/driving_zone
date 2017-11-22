<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author dev_piljae
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->DRIVING_ZONE = $this->load->database('DRIVING_ZONE', TRUE);

        $this->load->helper(array('url', 'date', 'form', 'alert'));
        $this->load->model('Db_m');
        $this->load->library('session');
    }

    function _remap($method) {
        if ($this->uri->segment(2)) {

            if (!$this->session->userdata('BRANCH_IDX')) {
                alert('로그인 해주세요.', '/');
                exit;
            }

            $notice_cnt_sql = "SELECT
                                COUNT(*) CNT 
                               FROM 
                                BOARD 
                               WHERE 
                                DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";

            $data['notice_cnt'] = $this->Db_m->getInfo($notice_cnt_sql, 'DRIVING_ZONE');

            if ($this->session->userdata('BRANCH_IDX') != '1') {
                $question_board_cnt_sql = "SELECT
                                            COUNT(*) CNT 
                                           FROM 
                                            QUESTION_BOARD 
                                           WHERE 
                                            BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                            DATE_FORMAT(A_TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";
            } else if ($this->session->userdata('BRANCH_IDX') == '1') {
                $question_board_cnt_sql = "SELECT
                                            COUNT(*) CNT 
                                           FROM 
                                            QUESTION_BOARD 
                                           WHERE 
                                            DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";
            }

            $data['question_cnt'] = $this->Db_m->getInfo($question_board_cnt_sql, 'DRIVING_ZONE');

            $this->load->view('inc/header', $data);

            if (method_exists($this, $method)) {
                $this->{"{$method}"}();
            }

            $this->load->view('inc/footer');
        } else {
            if (method_exists($this, $method)) {
                $this->{"{$method}"}();
            }
        }
    }

    function segment_explode($seg) {
        //세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
        $len = strlen($seg);
        if (substr($seg, 0, 1) == '/') {
            $seg = substr($seg, 1, $len);
        }

        $len = strlen($seg);
        if (substr($seg, -1) == '/') {
            $seg = substr($seg, 0, $len - 1);
        }

        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }

    function url_explode($url, $key) {
        for ($i = 0; count($url) > $i; $i++) {
            if ($url[$i] == $key) {
                $k = $i + 1;
                return $url[$k];
            }
        }
    }

    public function index() {
        $this->login();
    }

    function login() {
        $this->load->view('login');
    }

    function main() {

        $member_tot_sql = "SELECT
                            COUNT(*) CNT 
                           FROM 
                            MEMBER 
                           WHERE 
                            BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['member_tot'] = $this->Db_m->getInfo($member_tot_sql, 'DRIVING_ZONE');

        $member_month_sql = "SELECT
                                COUNT(*) CNT 
                             FROM 
                                MEMBER 
                             WHERE 
                                BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                DATE_FORMAT(TIMESTAMP, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')";

        $data['member_month_tot'] = $this->Db_m->getInfo($member_month_sql, 'DRIVING_ZONE');

        $price_tot_sql = "SELECT
                            SUM(MG.TOT_PRICE) TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_GOODS MG 
                          WHERE 
                            M.MEMBER_IDX = MG.MEMBER_IDX AND 
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['price_tot'] = $this->Db_m->getInfo($price_tot_sql, 'DRIVING_ZONE');

        $price_etc_tot_sql = "SELECT
                                SUM(MEP.PRICE) TOT_PRICE 
                              FROM 
                                MEMBER M, MEMBER_ETC_PAY MEP 
                              WHERE 
                                M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                                MEP.PAY_YN = 'N' AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['price_etc_tot'] = $this->Db_m->getInfo($price_etc_tot_sql, 'DRIVING_ZONE');

        $price_month_tot_sql = "SELECT
                            SUM(MG.TOT_PRICE) TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_GOODS MG 
                          WHERE 
                            M.MEMBER_IDX = MG.MEMBER_IDX AND 
                            MG.PAY_YN = 'N' AND
                            DATE_FORMAT(MG.TIMESTAMP, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m') AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['price_month_tot'] = $this->Db_m->getInfo($price_month_tot_sql, 'DRIVING_ZONE');

        $price_month_etc_tot_sql = "SELECT
                                        SUM(MEP.PRICE) TOT_PRICE 
                                    FROM 
                                        MEMBER M, MEMBER_ETC_PAY MEP 
                                    WHERE 
                                        M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                                        MEP.PAY_YN = 'N' AND
                                        DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m') AND
                                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['price_month_etc_tot'] = $this->Db_m->getInfo($price_month_etc_tot_sql, 'DRIVING_ZONE');

        $pay_tot_sql = "SELECT 
                            SUM(
                                (
                                    SELECT 
                                        COUNT(*) 
                                    FROM 
                                        MEMBER_GOODS MG, MEMBER M 
                                    WHERE 
                                        MG.PAYMENT_IDX = P.PAYMENT_IDX AND 
                                        MG.PAY_YN = 'N' AND
                                        MG.MEMBER_IDX = M.MEMBER_IDX AND 
                                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                )
                            ) PAY_CNT
                        FROM 
                            PAYMENT P
                        WHERE
                           P.DEL_YN = 'N'";

        $pay_tot_res = $this->Db_m->getInfo($pay_tot_sql, 'DRIVING_ZONE');

        $pay_percent_sql = "SELECT 
                                P.NAME,
                                ROUND(
                                  (
                                    SELECT 
                                      COUNT(*) 
                                    FROM 
                                      MEMBER_GOODS MG, MEMBER M 
                                    WHERE 
                                      MG.PAYMENT_IDX = P.PAYMENT_IDX AND 
                                      MG.PAY_YN = 'N' AND
                                      MG.MEMBER_IDX = M.MEMBER_IDX AND 
                                      M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                  ) / $pay_tot_res->PAY_CNT * 100
                                ) PAY_CNT
                            FROM 
                                PAYMENT P
                            WHERE
                               P.DEL_YN = 'N'";

        $data['pay_percent'] = $this->Db_m->getList($pay_percent_sql, 'DRIVING_ZONE');

        $goods_tot_sql = "SELECT 
                                SUM((
                                  SELECT 
                                    COUNT(*) CNT 
                                  FROM 
                                    MEMBER_GOODS MG, MEMBER M
                                  WHERE 
                                    MG.MEMBER_IDX = M.MEMBER_IDX AND
                                    MG.GOODS_IDX = G.GOODS_IDX AND
                                    MG.PAY_YN = 'N' AND
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                )) SUM_GOODS
                              FROM 
                                GOODS G";

        $goods_tot_res = $this->Db_m->getInfo($goods_tot_sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT 
                        CASE 
                          G.GOODS_TYPE 
                          WHEN 'C' THEN '코스형'
                          WHEN 'G' THEN '보장형'
                          WHEN 'T' THEN '시간형'
                        END GOODS_TYPE,
                        SUM((
                          SELECT 
                            COUNT(*) CNT 
                          FROM 
                            MEMBER_GOODS MG, MEMBER M
                          WHERE 
                            MG.MEMBER_IDX = M.MEMBER_IDX AND
                            MG.GOODS_IDX = G.GOODS_IDX AND
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                        )) SUM_GOODS,
                        ROUND(SUM((
                          SELECT 
                            COUNT(*) CNT 
                          FROM 
                            MEMBER_GOODS MG, MEMBER M
                          WHERE 
                            MG.MEMBER_IDX = M.MEMBER_IDX AND
                            MG.GOODS_IDX = G.GOODS_IDX AND
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                        )) / $goods_tot_res->SUM_GOODS * 100) SUM_GOODS_PERCENT
                      FROM 
                        GOODS G 
                      GROUP BY G.GOODS_TYPE";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $this->load->view('index', $data);
    }

    function store() {

        $sql = "SELECT
                    BRANCH_IDX, 
                    ID, 
                    NAME, 
                    CASE 
                        WHEN TYPE = 'D' THEN '직영' 
                        WHEN TYPE = 'A' THEN '가맹' 
                    END TYPE_TEXT, 
                    OWNER_NAME, 
                    OWNER_PHONE, 
                    MANAGER_NAME, 
                    MANAGER_PHONE, 
                    USE_EDATE, 
                    COMMENT 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $branch_lists_sql = "SELECT
                                BRANCH_IDX,
                                NAME
                             FROM 
                                BRANCH";

        $data['branch_lists'] = $this->Db_m->getList($branch_lists_sql, 'DRIVING_ZONE');

        $machine_info_sql = "SELECT
                                MACHINE_INFO_IDX, 
                                ID, 
                                COMMENT 
                             FROM 
                                MACHINE_INFO 
                             WHERE 
                                BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['machine_lists'] = $this->Db_m->getList($machine_info_sql, 'DRIVING_ZONE');

        $this->load->view('store/store', $data);
    }

    function store_admin() {

        if ($this->session->userdata('BRANCH_IDX') != '1') {
            alert('관리자만 접근 가능합니다.', '/index/main');
            exit;
        }

        $add_where = "";
        $data['gubun'] = "";
        $data['text'] = "";

        //검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 4;

        //주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환 
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            //주소에 검색어가 있을 경우의 처리. 즉 검색시 
            $gubun = urldecode($this->url_explode($uri_array, 'gubun'));
            $text = urldecode($this->url_explode($uri_array, 'text'));
            //페이지네이션용 주소 
            $page_url = '/q/gubun/' . $gubun . '/text/' . $text;
            $uri_segment = 9;

            if ($this->uri->segment(5) == 'title' && $this->uri->segment(7)) {
                $add_where .= "AND ID LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }

            if ($this->uri->segment(5) == 'contents' && $this->uri->segment(7)) {
                $add_where .= "AND NAME LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }
        }

        //페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');

        //페이지네이션 설정 '.$page_url.'
        $config['base_url'] = '/admin/store_admin/' . $page_url . '/page/'; //페이징 주소
        //게시물의 전체 갯수
        $count_sql = "SELECT
                            COUNT(*) CNT
                          FROM
                            BRANCH
                          WHERE
                            BRANCH_IDX <> '' ";
        $count_sql .= $add_where;

        $count_res = $this->Db_m->getInfo($count_sql, 'DRIVING_ZONE');

        $config['total_rows'] = $count_res->CNT;
        $data['total_rows'] = $count_res->CNT;

        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        //$config['num_links'] = 2; //페이지 링크 갯수 설정
        $config['use_fixed_page'] = TRUE;
        $config['fixed_page_num'] = 10;

        $config['display_first_always'] = TRUE;
        $config['disable_first_link'] = TRUE;
        $config['display_last_always'] = TRUE;
        $config['disable_last_link'] = TRUE;
        $config['display_prev_always'] = TRUE;
        $config['display_next_always'] = TRUE;
        $config['disable_prev_link'] = TRUE;
        $config['disable_next_link'] = TRUE;

        //페이지네이션 전체 감싸는 태그추가
        $config['full_tag_open'] = '<div class="boardPaging">';
        $config['full_tag_close'] = '</div>';

        //항상나오는 처음으로 버튼 태그추가
        $config['disabled_first_tag_open'] = "<span class='disableBtnFirst'>";
        $config['disabled_first_tag_close'] = "</span>";

        //처음으로버튼 감싸는 태그추가
        $config['first_tag_open'] = '<span class="btnFirst">';
        $config['first_tag_close'] = '</span>';

        //항상나오는 마지막으로 버튼 태그추가
        $config['disabled_last_tag_open'] = "<span class='disableBtnLast'>";
        $config['disabled_last_tag_close'] = "</span>";

        //마지막으로버튼 감싸는 태그추가
        $config['last_tag_open'] = '<span class="btnLast">';
        $config['last_tag_close'] = '</span>';

        //항상나오는 다음버튼 감싸는 태그추가
        $config['disabled_next_tag_open'] = '<span class="disableBtnNext">';
        $config['disabled_next_tag_close'] = '</span>';

        //다음버튼 감싸는 태그추가
        $config['next_tag_open'] = '<span class="btnNext">';
        $config['next_tag_close'] = '</span>';

        //항상나오는 이전버튼 태그추가
        $config['disabled_prev_tag_open'] = "<span class='disableBtnPrev'>";
        $config['disabled_prev_tag_close'] = "</span>";

        //이전버튼 감싸는 태그추가
        $config['prev_tag_open'] = '<span class="btnPrev">';
        $config['prev_tag_close'] = '</span>';

        //현재페이지번호 감싸는 태그추가
        $config['cur_tag_open'] = '<span class="on">';
        $config['cur_tag_close'] = '</span>';

        //페이지번호 감싸는 태그추가
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        //페이지네이션 초기화
        $this->pagination->initialize($config);

        //페이징 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        //게시판 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this->uri->segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];

        $lists_sql = "SELECT
                         BRANCH_IDX,
                         NAME,
                         ID,
                         CASE 
                            WHEN TYPE = 'D' THEN '직영' 
                            WHEN TYPE = 'A' THEN '가맹' 
                         END TYPE_TEXT,
                         OWNER_NAME,
                         MANAGER_NAME,
                         MANAGER_PHONE,
                         DATE_FORMAT(TIMESTAMP, '%Y.%m.%d') INS_TIME,
                         IF(DATE_FORMAT(TIMESTAMP, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d'), 'Y', 'N') TODAY
                      FROM 
                         BRANCH
                      WHERE
                         BRANCH_IDX <> '' ";
        $lists_sql .= $add_where;
        $lists_sql .= "ORDER BY TIMESTAMP DESC LIMIT $start, $limit";

        $data['lists'] = $this->Db_m->getList($lists_sql, 'DRIVING_ZONE');

        $this->load->view('store/store_admin', $data);
    }

    function object() {

        $sql = "SELECT
                    NAME 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT
                        GOODS_IDX,
                        CASE
                            GOODS_TYPE 
                                WHEN 'G' THEN '보장형' 
                                WHEN 'T' THEN '시간형' 
                                WHEN 'C' THEN '코스형' 
                            END GOODS_TYPE_TEXT,
                        GOODS_NAME,
                        CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT,
                        GOODS_PRICE
                      FROM 
                        GOODS 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        DEL_YN = 'N'
                      ORDER BY SHOW_LEVEL = 0, SHOW_LEVEL, GOODS_IDX ASC";

        $data['lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $this->load->view('object/object', $data);
    }

    function event() {

        $sql = "SELECT
                    NAME 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $event_sql = "SELECT
                        EVENT_IDX,
                        EVENT_NAME,
                        EVENT_TYPE,
                        DISCOUNT_RATE
                      FROM
                        EVENT 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' OR EVENT_TYPE = 'A' AND
                        DEL_YN = 'N' 
                      ORDER BY SHOW_LEVEL = 0, SHOW_LEVEL, EVENT_IDX ASC";

        $data['event_lists'] = $this->Db_m->getList($event_sql, 'DRIVING_ZONE');

        $this->load->view('object/event', $data);
    }

    function member() {

        $sql = "SELECT
                    BRANCH_IDX,
                    NAME 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT
                        G.GOODS_IDX,
                        G.GOODS_NAME,
                        G.GOODS_PRICE,
                        CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT
                      FROM 
                        GOODS G, BRANCH B 
                      WHERE 
                        G.BRANCH_IDX = B.BRANCH_IDX AND 
                        G.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        G.DEL_YN = 'N' 
                      ORDER BY G.SHOW_LEVEL = 0, SHOW_LEVEL, G.GOODS_IDX ASC";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $payment_sql = "SELECT
                            PAYMENT_IDX, 
                            NAME, 
                            WEIGHT 
                        FROM 
                            PAYMENT 
                        WHERE 
                            DEL_YN = 'N'";

        $data['payment_lists'] = $this->Db_m->getList($payment_sql, 'DRIVING_ZONE');

        $event_sql = "SELECT
                        EVENT_IDX,
                        EVENT_NAME,
                        EVENT_TYPE,
                        DISCOUNT_RATE
                      FROM
                        EVENT 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' OR EVENT_TYPE = 'A' AND
                        DEL_YN = 'N' 
                      ORDER BY SHOW_LEVEL = 0, SHOW_LEVEL, EVENT_IDX ASC";

        $data['event_lists'] = $this->Db_m->getList($event_sql, 'DRIVING_ZONE');

        $visit_route_sql = "SELECT
                                VISIT_ROUTE_IDX,
                                NAME
                            FROM 
                                VISIT_ROUTE 
                            WHERE 
                                DEL_YN = 'N'";

        $data['visit_route_lists'] = $this->Db_m->getList($visit_route_sql, "DRIVING_ZONE");

        $practice_sql = "SELECT
                            PRACTICE_IDX,
                            NAME
                         FROM 
                            PRACTICE 
                         WHERE 
                            DEL_YN = 'N'";

        $data['practice_lists'] = $this->Db_m->getList($practice_sql, "DRIVING_ZONE");

        $add_where = "";
        $add_order = "ORDER BY M.TIMESTAMP DESC ";
        $data['gubun'] = "";
        $data['text'] = "";
        $data['goods'] = "";
        $data['sort'] = "";
        $data['order'] = "";

        //검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 4;

        //주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환 
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            //주소에 검색어가 있을 경우의 처리. 즉 검색시 
            $gubun = urldecode($this->url_explode($uri_array, 'gubun'));
            $text = urldecode($this->url_explode($uri_array, 'text'));
            $goods = urldecode($this->url_explode($uri_array, 'goods'));
            $sort = urldecode($this->url_explode($uri_array, 'sort'));
            $order = urldecode($this->url_explode($uri_array, 'order'));
            //페이지네이션용 주소 
            $page_url = '/q/gubun/' . $gubun . '/text/' . $text . '/goods/' . $goods . '/sort/' . $sort . '/order/' . $order;
            $uri_segment = 15;

            $data['sort'] = $sort;
            $data['order'] = $order;

            if ($gubun == 'title' && $text !== 'none') {
                $add_where .= "AND M.ID LIKE '%" . urldecode($text) . "%'";
                $data['gubun'] = $gubun;
                $data['text'] = urldecode($text);
            }

            if ($gubun == 'contents' && $text !== 'none') {
                $add_where .= "AND M.NAME LIKE '%" . urldecode($text) . "%'";
                $data['gubun'] = $gubun;
                $data['text'] = urldecode($text);
            }

            if ($gubun == 'phone' && $text !== 'none') {
                $add_where .= "AND M.PHONE LIKE '%" . urldecode($text) . "%'";
                $data['gubun'] = $gubun;
                $data['text'] = urldecode($text);
            }

            if ($goods !== 'none') {
                $add_where .= "AND (
                                SELECT 
                                  MG.MEMBER_IDX 
                                FROM 
                                  MEMBER_GOODS MG 
                                WHERE 
                                  MG.GOODS_IDX = '" . urldecode($goods) . "' AND 
                                  MG.MEMBER_IDX = M.MEMBER_IDX GROUP BY M.MEMBER_IDX
                              )";
                $data['goods'] = $goods;
            }

            if ($sort === 'name') {
                $add_order = 'ORDER BY M.NAME ' . $order . ' ';
            }

            if ($sort === 'phone') {
                $add_order = 'ORDER BY M.PHONE ' . $order . ' ';
            }

            if ($sort === 'goods') {
                $add_order = 'ORDER BY GOODS_NAME ' . $order . ' ';
            }

            if ($sort === 'ins_date') {
                $add_order = 'ORDER BY M.TIMESTAMP ' . $order . ' ';
            }
        }

        //페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');

        //페이지네이션 설정 '.$page_url.'
        $config['base_url'] = '/index/member/' . $page_url . '/page/'; //페이징 주소
        //게시물의 전체 갯수
        $count_sql = "SELECT
                        COUNT(*) CNT
                      FROM
                        MEMBER M, MEMBER_DEFAULT MD, BRANCH B
                      WHERE 
                        M.BRANCH_IDX = B.BRANCH_IDX AND
                        M.MEMBER_IDX = MD.MEMBER_IDX AND 
                        M.STATUS = 'N' AND
                        M.TYPE = 'N' AND
                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' ";
        $count_sql .= $add_where;

        $count_res = $this->Db_m->getInfo($count_sql, 'DRIVING_ZONE');

        $config['total_rows'] = $count_res->CNT;
        $data['total_rows'] = $count_res->CNT;

        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        //$config['num_links'] = 2; //페이지 링크 갯수 설정
        $config['use_fixed_page'] = TRUE;
        $config['fixed_page_num'] = 10;

        $config['display_first_always'] = TRUE;
        $config['disable_first_link'] = TRUE;
        $config['display_last_always'] = TRUE;
        $config['disable_last_link'] = TRUE;
        $config['display_prev_always'] = TRUE;
        $config['display_next_always'] = TRUE;
        $config['disable_prev_link'] = TRUE;
        $config['disable_next_link'] = TRUE;

        //페이지네이션 전체 감싸는 태그추가
        $config['full_tag_open'] = '<div class="boardPaging">';
        $config['full_tag_close'] = '</div>';

        //항상나오는 처음으로 버튼 태그추가
        $config['disabled_first_tag_open'] = "<span class='disableBtnFirst'>";
        $config['disabled_first_tag_close'] = "</span>";

        //처음으로버튼 감싸는 태그추가
        $config['first_tag_open'] = '<span class="btnFirst">';
        $config['first_tag_close'] = '</span>';

        //항상나오는 마지막으로 버튼 태그추가
        $config['disabled_last_tag_open'] = "<span class='disableBtnLast'>";
        $config['disabled_last_tag_close'] = "</span>";

        //마지막으로버튼 감싸는 태그추가
        $config['last_tag_open'] = '<span class="btnLast">';
        $config['last_tag_close'] = '</span>';

        //항상나오는 다음버튼 감싸는 태그추가
        $config['disabled_next_tag_open'] = '<span class="disableBtnNext">';
        $config['disabled_next_tag_close'] = '</span>';

        //다음버튼 감싸는 태그추가
        $config['next_tag_open'] = '<span class="btnNext">';
        $config['next_tag_close'] = '</span>';

        //항상나오는 이전버튼 태그추가
        $config['disabled_prev_tag_open'] = "<span class='disableBtnPrev'>";
        $config['disabled_prev_tag_close'] = "</span>";

        //이전버튼 감싸는 태그추가
        $config['prev_tag_open'] = '<span class="btnPrev">';
        $config['prev_tag_close'] = '</span>';

        //현재페이지번호 감싸는 태그추가
        $config['cur_tag_open'] = '<span class="on">';
        $config['cur_tag_close'] = '</span>';

        //페이지번호 감싸는 태그추가
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        //페이지네이션 초기화
        $this->pagination->initialize($config);

        //페이징 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        //게시판 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this->uri->segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];

        $member_lists_sql = "SELECT
                                M.MEMBER_IDX,
                                M.NAME, 
                                MD.BIRTH,
                                MD.ADDR,
                                MD.DETAIL_ADDR,
                                M.INS_TYPE,
                                DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') INS_DATE,
                                MD.IN_ROUTE_COMMENT,
                                MD.PRACTICE_COMMENT,
                                TS.NAME TEST_SITE_NAME,
                                MD.IMG,
                                MD.FINAL_YN,
                                MD.PROCEEDING_YN,
                                MD.COMMENT,
                                MD.BOOKING_HISTORY,
                                (
                                    SELECT 
                                        G.GOODS_NAME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        MG.MEMBER_IDX = M.MEMBER_IDX
                                        ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1
                                ) GOODS_NAME,
                                (
                                    SELECT 
                                        MG.TIMESTAMP 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        MG.MEMBER_IDX = M.MEMBER_IDX
                                        ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1
                                ) MEMBER_GOODS_TIME,
                                MD.IN_TEST_YN,
                                MD.IN_TEST_DATE,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%Y-%m-%d') MOD_TEST_DATE,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%H') MOD_TEST_DATE_TIME,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%i') MOD_TEST_DATE_MIN,
                                MD.ROAD_TEST_YN,
                                MD.ROAD_TEST_DATE,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%Y-%m-%d') MOD_ROAD_DATE,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%H') MOD_ROAD_DATE_TIME,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%i') MOD_ROAD_DATE_MIN,
                                CASE 
                                    MD.FINAL_YN 
                                    WHEN 'Y' THEN '합격' 
                                    WHEN 'N' THEN '-' 
                                END FINAL_YN,
                                M.PHONE,
                                B.NAME BRANCH_NAME,
                                M.TIMESTAMP
                             FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                                LEFT JOIN TEST_SITE TS 
                                ON MD.TEST_SITE_IDX = TS.TEST_SITE_IDX, 
                                BRANCH B
                             WHERE 
                                M.BRANCH_IDX = B.BRANCH_IDX AND
                                M.MEMBER_IDX = MD.MEMBER_IDX AND 
                                M.STATUS = 'N' AND
                                M.TYPE = 'N' AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";
        $member_lists_sql .= $add_where;
        $member_lists_sql .= $add_order;
        $member_lists_sql .= "LIMIT $start, $limit";

//        ECHO $member_lists_sql;

        $data['member_lists'] = $this->Db_m->getList($member_lists_sql, 'DRIVING_ZONE');

        foreach ($data['member_lists'] as $row) {
            $member_etc_pay_sql = "SELECT
                                        MEMBER_ETC_PAY_IDX,
                                        NAME, 
                                        PRICE, 
                                        DATE,
                                        PAY_YN
                                   FROM 
                                        MEMBER_ETC_PAY 
                                   WHERE 
                                        MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_etc_pay' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_etc_pay_sql, 'DRIVING_ZONE');

            $member_goods_sql = "SELECT 
                                    G.GOODS_NAME,
                                    P.NAME PAYMENT_NAME,
                                    E.EVENT_NAME,
                                    MG.MEMBER_GOODS_IDX,
                                    MG.TOT_PRICE,
                                    MG.GOODS_IDX,
                                    MG.PAYMENT_IDX,
                                    ME.EVENT_IDX,
                                    MG.PAY_YN,
                                    CASE
                                    LICENSE_TYPE 
                                        WHEN '1' THEN '1종' 
                                        WHEN '2' THEN '2종' 
                                        WHEN 'B' THEN '대형' 
                                    END LICENSE_TYPE_TEXT
                                 FROM
                                    MEMBER_GOODS MG 
                                    LEFT JOIN
                                        MEMBER_EVENT ME
                                        ON 
                                        MG.MEMBER_GOODS_IDX = ME.MEMBER_GOODS_IDX 
                                    LEFT JOIN 
                                        EVENT E 
                                        ON 
                                        ME.EVENT_IDX = E.EVENT_IDX
                                    , GOODS G, PAYMENT P
                                 WHERE 
                                    MG.GOODS_IDX = G.GOODS_IDX AND 
                                    MG.PAYMENT_IDX = P.PAYMENT_IDX AND
                                    MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_goods' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_goods_sql, 'DRIVING_ZONE');

            $member_visit_route_sql = "SELECT
                                        VR.VISIT_ROUTE_IDX, 
                                        IF(MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX, 'checked', '') CHECKED, 
                                        NAME 
                                       FROM 
                                        VISIT_ROUTE VR 
                                        LEFT JOIN 
                                            MEMBER_VISIT_ROUTE MVR 
                                            ON 
                                            VR.VISIT_ROUTE_IDX = MVR.VISIT_ROUTE_IDX AND 
                                            MVR.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $data['member_visit_route' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_visit_route_sql, 'DRIVING_ZONE');

            $member_practice_sql = "SELECT
                                        P.PRACTICE_IDX, 
                                        IF(MP.PRACTICE_IDX = P.PRACTICE_IDX, 'checked', '') CHECKED, 
                                        NAME 
                                       FROM 
                                        PRACTICE P 
                                        LEFT JOIN 
                                            MEMBER_PRACTICE MP 
                                            ON 
                                            P.PRACTICE_IDX = MP.PRACTICE_IDX AND 
                                            MP.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $data['member_practice' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_practice_sql, 'DRIVING_ZONE');

            $member_memo_sql = "SELECT
                                    MEMBER_MEMO_IDX,
                                    DATE,
                                    CONTENTS
                                FROM 
                                    MEMBER_MEMO
                                WHERE 
                                    MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_memo' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');

            //회원의 최신 상품이 시간형인지 구분
            $goods_chk_sql = "SELECT
                                G.GOODS_TYPE
                              FROM 
                                MEMBER_GOODS MG, GOODS G 
                                LEFT JOIN 
                                    TIME_GOODS TG 
                                    ON 
                                    G.GOODS_IDX = TG.GOODS_IDX
                              WHERE 
                                MG.GOODS_IDX = G.GOODS_IDX AND
                                MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'
                                ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1";

            $goods_chk_res = $this->Db_m->getInfo($goods_chk_sql, 'DRIVING_ZONE');

            //회원의 예약했던 시간의 합
            $member_time_sql = "SELECT 
                                    SUM(TIMESTAMPDIFF(MINUTE, BOOKING_SDATE, BOOKING_EDATE)) SUM_TIME
                                FROM 
                                    BOOKING B, BOOKING_DETAIL BD, GOODS G
                                WHERE
                                    B.BOOKING_IDX = BD.BOOKING_IDX AND
                                    BD.GOODS_IDX = G.GOODS_IDX AND
                                    G.GOODS_TYPE = 'T' AND
                                    BD.ABSENT_YN = 'N' AND
                                    BD.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');

            //회원의 전체 상품 내역중 시간형 상품만 가져와서 시간형 상품의 종합시간값
            $member_tot_time_sql = "SELECT 
                                        (SUM(TG.GOODS_TIME) * 60) GOODS_TIME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        G.GOODS_IDX = TG.GOODS_IDX AND 
                                        MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

            if ($goods_chk_res) {
                if ($goods_chk_res->GOODS_TYPE == 'T') {
//                    echo $row['NAME'].$member_tot_time_res->GOODS_TIME.'<br>';
//                    echo $row['NAME'].$member_time_res->SUM_TIME.'<br>';
                    $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                    $time1 = (int) ($minute / 60);
                    $time2 = $minute % 60;
                    $data['time' . $row['MEMBER_IDX']] = "잔여시간 " . $time1 . "시간 " . $time2 . "분";
                } else {

                    //회원의 예약했던 시간의 합
                    $member_time_sql = "SELECT 
                                        SUM(TIMESTAMPDIFF(MINUTE, BOOKING_SDATE, BOOKING_EDATE)) SUM_TIME
                                    FROM 
                                        BOOKING B, BOOKING_DETAIL BD, GOODS G
                                    WHERE
                                        B.BOOKING_IDX = BD.BOOKING_IDX AND
                                        BD.GOODS_IDX = G.GOODS_IDX AND
                                        BD.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

                    $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');
                    $minute = $member_time_res->SUM_TIME;
                    $time1 = (int) ($minute / 60);
                    $time2 = $minute % 60;

                    $data['time' . $row['MEMBER_IDX']] = "누적시간 " . $time1 . "시간 " . $time2 . "분";
                }
            } else {
                $data['time' . $row['MEMBER_IDX']] = "";
            }
        }

        $refunds_sql = "SELECT
                    REFUNDS 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['refunds_info'] = $this->Db_m->getInfo($refunds_sql, 'DRIVING_ZONE');

        $privacy_sql = "SELECT
                    PRIVACY 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['privacy_info'] = $this->Db_m->getInfo($privacy_sql, 'DRIVING_ZONE');


        $this->load->view('member/member', $data);
    }

    function item() {

        if ($this->session->userdata('BRANCH_IDX') != '1') {
            alert('관리자만 접근 가능합니다.', '/index/main');
            exit;
        }

        $payment_sql = "SELECT
                            NAME, 
                            WEIGHT 
                        FROM 
                            PAYMENT 
                        WHERE 
                            DEL_YN = 'N'";

        $data['payment_lists'] = $this->Db_m->getList($payment_sql, "DRIVING_ZONE");

        $visit_route_sql = "SELECT
                                NAME
                            FROM 
                                VISIT_ROUTE 
                            WHERE 
                                DEL_YN = 'N'";

        $data['visit_route_lists'] = $this->Db_m->getList($visit_route_sql, "DRIVING_ZONE");

        $practice_sql = "SELECT
                                NAME
                            FROM 
                                PRACTICE 
                            WHERE 
                                DEL_YN = 'N'";

        $data['practice_lists'] = $this->Db_m->getList($practice_sql, "DRIVING_ZONE");

        $test_site_sql = "SELECT
                                NAME
                            FROM 
                                TEST_SITE 
                            WHERE 
                                DEL_YN = 'N'";

        $data['test_site_lists'] = $this->Db_m->getList($test_site_sql, "DRIVING_ZONE");

        $this->load->view('member/item', $data);
    }

    function calender() {

        $goods_sql = "SELECT
                        GOODS_NAME 
                      FROM 
                        GOODS 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        DEL_YN = 'N'";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $member_sql = "SELECT
                        MEMBER_IDX, 
                        NAME 
                       FROM 
                        MEMBER 
                       WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['member_lists'] = $this->Db_m->getList($member_sql, 'DRIVING_ZONE');

        $machine_info_sql = "SELECT
                                MACHINE_INFO_IDX, 
                                ID, 
                                COMMENT 
                             FROM 
                                MACHINE_INFO 
                             WHERE 
                                BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['machine_lists'] = $this->Db_m->getList($machine_info_sql, 'DRIVING_ZONE');

        $refunds_sql = "SELECT
                    REFUNDS 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['refunds_info'] = $this->Db_m->getInfo($refunds_sql, 'DRIVING_ZONE');

        $privacy_sql = "SELECT
                    PRIVACY 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['privacy_info'] = $this->Db_m->getInfo($privacy_sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT
                        G.GOODS_IDX,
                        G.GOODS_NAME,
                        G.GOODS_PRICE,
                        CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT
                      FROM 
                        GOODS G, BRANCH B 
                      WHERE 
                        G.BRANCH_IDX = B.BRANCH_IDX AND 
                        G.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        G.DEL_YN = 'N'";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $payment_sql = "SELECT
                            PAYMENT_IDX, 
                            NAME, 
                            WEIGHT 
                        FROM 
                            PAYMENT 
                        WHERE 
                            DEL_YN = 'N'";

        $data['payment_lists'] = $this->Db_m->getList($payment_sql, 'DRIVING_ZONE');

        $event_sql = "SELECT
                        EVENT_IDX,
                        EVENT_NAME,
                        EVENT_TYPE,
                        DISCOUNT_RATE
                      FROM
                        EVENT 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' OR EVENT_TYPE = 'A' AND
                        DEL_YN = 'N'";

        $data['event_lists'] = $this->Db_m->getList($event_sql, 'DRIVING_ZONE');


        $this->load->view('appointment/calender', $data);
    }

    function statistics() {

        $pay_tot_sql = "SELECT 
                            SUM(
                                (
                                    SELECT 
                                        COUNT(*) 
                                    FROM 
                                        MEMBER_GOODS MG, MEMBER M 
                                    WHERE 
                                        MG.PAYMENT_IDX = P.PAYMENT_IDX AND 
                                        MG.MEMBER_IDX = M.MEMBER_IDX AND 
                                        MG.PAY_YN = 'N' AND
                                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                )
                            ) PAY_CNT
                        FROM 
                            PAYMENT P
                        WHERE
                           P.DEL_YN = 'N'";

        $pay_tot_res = $this->Db_m->getInfo($pay_tot_sql, 'DRIVING_ZONE');

        $pay_percent_sql = "SELECT 
                                P.NAME,
                                ROUND(
                                  (
                                    SELECT 
                                      COUNT(*) 
                                    FROM 
                                      MEMBER_GOODS MG, MEMBER M 
                                    WHERE 
                                      MG.PAYMENT_IDX = P.PAYMENT_IDX AND 
                                      MG.MEMBER_IDX = M.MEMBER_IDX AND 
                                      MG.PAY_YN = 'N' AND
                                      M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                  ) / $pay_tot_res->PAY_CNT * 100
                                ) PAY_CNT
                            FROM 
                                PAYMENT P
                            WHERE
                               P.DEL_YN = 'N'";

        $data['pay_percent'] = $this->Db_m->getList($pay_percent_sql, 'DRIVING_ZONE');

        $goods_tot_sql = "SELECT 
                                SUM((
                                  SELECT 
                                    COUNT(*) CNT 
                                  FROM 
                                    MEMBER_GOODS MG, MEMBER M
                                  WHERE 
                                    MG.MEMBER_IDX = M.MEMBER_IDX AND
                                    MG.GOODS_IDX = G.GOODS_IDX AND
                                    MG.PAY_YN = 'N' AND
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                )) SUM_GOODS
                              FROM 
                                GOODS G";

        $goods_tot_res = $this->Db_m->getInfo($goods_tot_sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT 
                        CASE 
                          G.GOODS_TYPE 
                          WHEN 'C' THEN '코스형'
                          WHEN 'G' THEN '보장형'
                          WHEN 'T' THEN '시간형'
                        END GOODS_TYPE,
                        SUM((
                          SELECT 
                            COUNT(*) CNT 
                          FROM 
                            MEMBER_GOODS MG, MEMBER M
                          WHERE 
                            MG.MEMBER_IDX = M.MEMBER_IDX AND
                            MG.GOODS_IDX = G.GOODS_IDX AND
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                        )) SUM_GOODS,
                        ROUND(SUM((
                          SELECT 
                            COUNT(*) CNT 
                          FROM 
                            MEMBER_GOODS MG, MEMBER M
                          WHERE 
                            MG.MEMBER_IDX = M.MEMBER_IDX AND
                            MG.GOODS_IDX = G.GOODS_IDX AND
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                        )) / $goods_tot_res->SUM_GOODS * 100) SUM_GOODS_PERCENT,
                        ( 
                            SELECT 
                              SUM(MG.TOT_PRICE)
                            FROM 
                              MEMBER_GOODS MG, GOODS G1
                            WHERE 
                              MG.GOODS_IDX = G1.GOODS_IDX AND
                              G1.GOODS_TYPE = G.GOODS_TYPE AND
                              MG.PAY_YN = 'N' AND
                              G1.BRANCH_IDX = 4
                        ) GOODS_PRICE
                      FROM 
                        GOODS G 
                      GROUP BY G.GOODS_TYPE";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $visit_route_tot_sql = "SELECT 
                                    SUM(
                                        (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER_VISIT_ROUTE MVR, MEMBER M 
                                            WHERE 
                                                MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX AND 
                                                MVR.MEMBER_IDX = M.MEMBER_IDX AND 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        )
                                    ) VISIT_ROUTE_CNT
                                FROM 
                                    VISIT_ROUTE VR
                                WHERE
                                   VR.DEL_YN = 'N'";

        $visit_route_tot_res = $this->Db_m->getInfo($visit_route_tot_sql, 'DRIVING_ZONE');

        $visit_route_percent_sql = "SELECT 
                                        VR.NAME,
                                        ROUND(
                                          (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER_VISIT_ROUTE MVR, MEMBER M 
                                            WHERE 
                                                MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX AND 
                                                MVR.MEMBER_IDX = M.MEMBER_IDX AND 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                          ) / $visit_route_tot_res->VISIT_ROUTE_CNT * 100
                                        ) VISIT_ROUTE_CNT
                                    FROM 
                                        VISIT_ROUTE VR
                                    WHERE
                                       VR.DEL_YN = 'N'";

        $data['visit_route_percent'] = $this->Db_m->getList($visit_route_percent_sql, 'DRIVING_ZONE');

        $practice_tot_sql = "SELECT 
                                SUM(
                                    (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER_PRACTICE MP, MEMBER M 
                                        WHERE 
                                            MP.PRACTICE_IDX = P.PRACTICE_IDX AND 
                                            MP.MEMBER_IDX = M.MEMBER_IDX AND 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    )
                                ) PRACTICE_CNT
                            FROM 
                                PRACTICE P
                            WHERE
                               P.DEL_YN = 'N'";

        $practice_tot_res = $this->Db_m->getInfo($practice_tot_sql, 'DRIVING_ZONE');

        $practice_percent_sql = "SELECT 
                                    P.NAME,
                                    ROUND(
                                      (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER_PRACTICE MP, MEMBER M 
                                        WHERE 
                                            MP.PRACTICE_IDX = P.PRACTICE_IDX AND 
                                            MP.MEMBER_IDX = M.MEMBER_IDX AND 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                      ) / $practice_tot_res->PRACTICE_CNT * 100
                                    ) PRACTICE_CNT
                                FROM 
                                    PRACTICE P
                                WHERE
                                   P.DEL_YN = 'N'";

        $data['practice_percent'] = $this->Db_m->getList($practice_percent_sql, 'DRIVING_ZONE');

        $test_site_tot_sql = "SELECT 
                                    SUM(
                                        (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER_DEFAULT MD, MEMBER M 
                                            WHERE 
                                                MD.TEST_SITE_IDX = TS.TEST_SITE_IDX AND 
                                                MD.MEMBER_IDX = M.MEMBER_IDX AND 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        )
                                    ) TEST_SITE_CNT
                                FROM 
                                    TEST_SITE TS
                                WHERE
                                   TS.DEL_YN = 'N'";

        $test_site_tot_res = $this->Db_m->getInfo($test_site_tot_sql, 'DRIVING_ZONE');

        $test_site_percent_sql = "SELECT 
                                        TS.NAME,
                                        IFNULL(ROUND(
                                          (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER_DEFAULT MD, MEMBER M 
                                            WHERE 
                                                MD.TEST_SITE_IDX = TS.TEST_SITE_IDX AND 
                                                MD.MEMBER_IDX = M.MEMBER_IDX AND 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                          ) / $test_site_tot_res->TEST_SITE_CNT * 100
                                        ), 0) TEST_SITE_CNT
                                    FROM 
                                        TEST_SITE TS
                                    WHERE
                                       TS.DEL_YN = 'N'";

        $data['test_site_percent'] = $this->Db_m->getList($test_site_percent_sql, 'DRIVING_ZONE');

        $unpass_sql = "SELECT 
                            IFNULL(
                                ROUND(
                                    COUNT(*) / (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER M 
                                        WHERE 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    ) * 100
                            ), 0) FAILED
                       FROM 
                            MEMBER M, MEMBER_DEFAULT MD 
                       WHERE 
                            M.MEMBER_IDX = MD.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MD.FINAL_YN = 'N'";

        $data['unpass'] = $this->Db_m->getInfo($unpass_sql, 'DRIVING_ZONE');

        $pass_sql = "SELECT 
                            IFNULL(
                                ROUND(
                                    COUNT(*) / (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER M 
                                        WHERE 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    ) * 100
                            ), 0) PASS
                       FROM 
                            MEMBER M, MEMBER_DEFAULT MD 
                       WHERE 
                            M.MEMBER_IDX = MD.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MD.FINAL_YN = 'Y'";

        $data['pass'] = $this->Db_m->getInfo($pass_sql, 'DRIVING_ZONE');

        $pass_range_sql1 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) ONE_MONTH
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) > 0 AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) <= 30";

        $data['pass_range1'] = $this->Db_m->getInfo($pass_range_sql1, 'DRIVING_ZONE');

        $pass_range_sql2 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) TWO_MONTH
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) > 30 AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) <= 60";

        $data['pass_range2'] = $this->Db_m->getInfo($pass_range_sql2, 'DRIVING_ZONE');

        $pass_range_sql3 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) THREE_MONTH
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) > 61 AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) <= 90";

        $data['pass_range3'] = $this->Db_m->getInfo($pass_range_sql3, 'DRIVING_ZONE');

        $pass_range_sql4 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) SIX_MONTH
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) > 90 AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) <= 180";

        $data['pass_range4'] = $this->Db_m->getInfo($pass_range_sql4, 'DRIVING_ZONE');

        $pass_range_sql5 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) ONE_YEAR
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) > 180 AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) <= 365";

        $data['pass_range5'] = $this->Db_m->getInfo($pass_range_sql5, 'DRIVING_ZONE');

        $pass_range_sql6 = "SELECT 
                                IFNULL(
                                    ROUND(
                                        COUNT(*) / (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                MEMBER M 
                                            WHERE 
                                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                        ) * 100
                                ), 0) ONE_YEAR_OVER
                           FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                           WHERE 
                                M.MEMBER_IDX = MD.MEMBER_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MD.FINAL_YN = 'Y' AND
                                DATEDIFF(MD.FINAL_DATE, M.TIMESTAMP) >= 365";

        $data['pass_range6'] = $this->Db_m->getInfo($pass_range_sql6, 'DRIVING_ZONE');

        $unproceeding_sql = "SELECT 
                            IFNULL(
                                ROUND(
                                    COUNT(*) / (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER M 
                                        WHERE 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    ) * 100
                            ), 0) FAILED
                       FROM 
                            MEMBER M, MEMBER_DEFAULT MD 
                       WHERE 
                            M.MEMBER_IDX = MD.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MD.PROCEEDING_YN = 'N'";

        $data['unproceeding'] = $this->Db_m->getInfo($unproceeding_sql, 'DRIVING_ZONE');


        $proceeding_sql = "SELECT 
                            IFNULL(
                                ROUND(
                                    COUNT(*) / (
                                        SELECT 
                                            COUNT(*) 
                                        FROM 
                                            MEMBER M 
                                        WHERE 
                                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    ) * 100
                            ), 0) PASS
                       FROM 
                            MEMBER M, MEMBER_DEFAULT MD 
                       WHERE 
                            M.MEMBER_IDX = MD.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MD.PROCEEDING_YN = 'Y'";

        $data['proceeding'] = $this->Db_m->getInfo($proceeding_sql, 'DRIVING_ZONE');




        $this->load->view('statistics/statistics', $data);
    }

    function statistics_branch() {

        if ($this->session->userdata('BRANCH_IDX') != '1') {
            alert('관리자만 접근 가능합니다.', '/index/statistics');
            exit;
        }

        $branch_lists_sql = "SELECT
                                BRANCH_IDX,
                                NAME
                             FROM 
                                BRANCH
                             WHERE
                                BRANCH_IDX <> '1'";

        $data['branch_lists'] = $this->Db_m->getList($branch_lists_sql, 'DRIVING_ZONE');

        $this->load->view('statistics/statistics_branch', $data);
    }

    function board() {

        $add_where = "";
        $data['gubun'] = "";
        $data['text'] = "";

        //검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 4;

        //주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환 
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            //주소에 검색어가 있을 경우의 처리. 즉 검색시 
            $gubun = urldecode($this->url_explode($uri_array, 'gubun'));
            $text = urldecode($this->url_explode($uri_array, 'text'));
            //페이지네이션용 주소 
            $page_url = '/q/gubun/' . $gubun . '/text/' . $text;
            $uri_segment = 9;

            if ($this->uri->segment(5) == 'title' && $this->uri->segment(7)) {
                $add_where .= "AND B.TITLE LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }

            if ($this->uri->segment(5) == 'contents' && $this->uri->segment(7)) {
                $add_where .= "AND B.CONTENTS LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }
        }

        //페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');

        //페이지네이션 설정 '.$page_url.'
        $config['base_url'] = '/index/board/' . $page_url . '/page/'; //페이징 주소
        //게시물의 전체 갯수
        $count_sql = "SELECT
                        COUNT(*) CNT
                      FROM
                        BOARD B, BRANCH BC
                      WHERE 
                        B.BRANCH_IDX = BC.BRANCH_IDX ";
        $count_sql .= $add_where;

        $count_res = $this->Db_m->getInfo($count_sql, 'DRIVING_ZONE');

        $config['total_rows'] = $count_res->CNT;
        $data['total_rows'] = $count_res->CNT;

        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        //$config['num_links'] = 2; //페이지 링크 갯수 설정
        $config['use_fixed_page'] = TRUE;
        $config['fixed_page_num'] = 10;

        $config['display_first_always'] = TRUE;
        $config['disable_first_link'] = TRUE;
        $config['display_last_always'] = TRUE;
        $config['disable_last_link'] = TRUE;
        $config['display_prev_always'] = TRUE;
        $config['display_next_always'] = TRUE;
        $config['disable_prev_link'] = TRUE;
        $config['disable_next_link'] = TRUE;

        //페이지네이션 전체 감싸는 태그추가
        $config['full_tag_open'] = '<div class="boardPaging">';
        $config['full_tag_close'] = '</div>';

        //항상나오는 처음으로 버튼 태그추가
        $config['disabled_first_tag_open'] = "<span class='disableBtnFirst'>";
        $config['disabled_first_tag_close'] = "</span>";

        //처음으로버튼 감싸는 태그추가
        $config['first_tag_open'] = '<span class="btnFirst">';
        $config['first_tag_close'] = '</span>';

        //항상나오는 마지막으로 버튼 태그추가
        $config['disabled_last_tag_open'] = "<span class='disableBtnLast'>";
        $config['disabled_last_tag_close'] = "</span>";

        //마지막으로버튼 감싸는 태그추가
        $config['last_tag_open'] = '<span class="btnLast">';
        $config['last_tag_close'] = '</span>';

        //항상나오는 다음버튼 감싸는 태그추가
        $config['disabled_next_tag_open'] = '<span class="disableBtnNext">';
        $config['disabled_next_tag_close'] = '</span>';

        //다음버튼 감싸는 태그추가
        $config['next_tag_open'] = '<span class="btnNext">';
        $config['next_tag_close'] = '</span>';

        //항상나오는 이전버튼 태그추가
        $config['disabled_prev_tag_open'] = "<span class='disableBtnPrev'>";
        $config['disabled_prev_tag_close'] = "</span>";

        //이전버튼 감싸는 태그추가
        $config['prev_tag_open'] = '<span class="btnPrev">';
        $config['prev_tag_close'] = '</span>';

        //현재페이지번호 감싸는 태그추가
        $config['cur_tag_open'] = '<span class="on">';
        $config['cur_tag_close'] = '</span>';

        //페이지번호 감싸는 태그추가
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        //페이지네이션 초기화
        $this->pagination->initialize($config);

        //페이징 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        //게시판 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this->uri->segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];

        $lists_sql = "SELECT
                        B.BOARD_IDX,
                        B.TITLE,
                        BC.NAME,
                        DATE_FORMAT(B.TIMESTAMP, '%Y-%m-%d') INS_DATE
                      FROM 
                        BOARD B, BRANCH BC
                      WHERE 
                        B.BRANCH_IDX = BC.BRANCH_IDX ";
        $lists_sql .= $add_where;
        $lists_sql .= "ORDER BY B.TIMESTAMP DESC LIMIT $start, $limit";

        $data['lists'] = $this->Db_m->getList($lists_sql, 'DRIVING_ZONE');

        $this->load->view('board/list', $data);
    }

    function board_view() {

        $sql = "SELECT
                    B.BOARD_IDX,
                    B.TITLE,
                    BC.NAME,
                    B.CONTENTS,
                    DATE_FORMAT(B.TIMESTAMP, '%Y-%m-%d') INS_DATE
                FROM 
                    BOARD B, BRANCH BC
                WHERE 
                    B.BRANCH_IDX = BC.BRANCH_IDX AND 
                    B.BOARD_IDX = '" . $this->uri->segment(3) . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('board/view', $data);
    }

    function board_write() {

        if (!$this->session->userdata('BRANCH_IDX')) {
            alert('세션이 만료되었습니다.', '/');
            exit;
        }

        if ($this->session->userdata('BRANCH_IDX') != '1') {
            alert('관리자만 접근 가능합니다.', '/index/board');
            exit;
        }

        $this->load->view('board/write');
    }

    function board_modify() {

        if (!$this->session->userdata('BRANCH_IDX')) {
            alert('세션이 만료되었습니다.', '/');
            exit;
        }

        if ($this->session->userdata('BRANCH_IDX') != '1') {
            alert('관리자만 접근 가능합니다.', '/index/board');
            exit;
        }

        $sql = "SELECT
                    B.BOARD_IDX,
                    B.TITLE,
                    BC.NAME,
                    B.CONTENTS,
                    DATE_FORMAT(B.TIMESTAMP, '%Y-%m-%d') INS_DATE
                FROM 
                    BOARD B, BRANCH BC
                WHERE 
                    B.BRANCH_IDX = BC.BRANCH_IDX AND 
                    B.BOARD_IDX = '" . $this->uri->segment(3) . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('board/modify', $data);
    }

    function refunds() {

        $sql = "SELECT
                    REFUNDS 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('agree/refunds', $data);
    }

    function privacy() {

        $sql = "SELECT
                    PRIVACY 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('agree/privacy', $data);
    }

    function marketing() {
        $this->load->view('marketing/marketing');
    }

    function question_board() {

        $add_where = "";
        $data['gubun'] = "";
        $data['text'] = "";

        //검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 4;

        //주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환 
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            //주소에 검색어가 있을 경우의 처리. 즉 검색시 
            $gubun = urldecode($this->url_explode($uri_array, 'gubun'));
            $text = urldecode($this->url_explode($uri_array, 'text'));
            //페이지네이션용 주소 
            $page_url = '/q/gubun/' . $gubun . '/text/' . $text;
            $uri_segment = 9;

            if ($this->uri->segment(5) == 'title' && $this->uri->segment(7)) {
                $add_where .= "AND QB.TITLE LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }

            if ($this->uri->segment(5) == 'contents' && $this->uri->segment(7)) {
                $add_where .= "AND QB.CONTENTS LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }
        }

        //페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');

        //페이지네이션 설정 '.$page_url.'
        $config['base_url'] = '/index/question_board/' . $page_url . '/page/'; //페이징 주소
        //게시물의 전체 갯수
        if ($this->session->userdata('BRANCH_IDX') === '1') {
            $count_sql = "SELECT
                            COUNT(*) CNT
                          FROM
                            QUESTION_BOARD QB, BRANCH BC
                          WHERE 
                            QB.BRANCH_IDX = BC.BRANCH_IDX ";
        } else {
            $count_sql = "SELECT
                            COUNT(*) CNT
                          FROM
                            QUESTION_BOARD QB, BRANCH BC
                          WHERE 
                            QB.BRANCH_IDX = BC.BRANCH_IDX AND 
                            BC.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' ";
        }
        $count_sql .= $add_where;

        $count_res = $this->Db_m->getInfo($count_sql, 'DRIVING_ZONE');

        $config['total_rows'] = $count_res->CNT;
        $data['total_rows'] = $count_res->CNT;

        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        //$config['num_links'] = 2; //페이지 링크 갯수 설정
        $config['use_fixed_page'] = TRUE;
        $config['fixed_page_num'] = 10;

        $config['display_first_always'] = TRUE;
        $config['disable_first_link'] = TRUE;
        $config['display_last_always'] = TRUE;
        $config['disable_last_link'] = TRUE;
        $config['display_prev_always'] = TRUE;
        $config['display_next_always'] = TRUE;
        $config['disable_prev_link'] = TRUE;
        $config['disable_next_link'] = TRUE;

        //페이지네이션 전체 감싸는 태그추가
        $config['full_tag_open'] = '<div class="boardPaging">';
        $config['full_tag_close'] = '</div>';

        //항상나오는 처음으로 버튼 태그추가
        $config['disabled_first_tag_open'] = "<span class='disableBtnFirst'>";
        $config['disabled_first_tag_close'] = "</span>";

        //처음으로버튼 감싸는 태그추가
        $config['first_tag_open'] = '<span class="btnFirst">';
        $config['first_tag_close'] = '</span>';

        //항상나오는 마지막으로 버튼 태그추가
        $config['disabled_last_tag_open'] = "<span class='disableBtnLast'>";
        $config['disabled_last_tag_close'] = "</span>";

        //마지막으로버튼 감싸는 태그추가
        $config['last_tag_open'] = '<span class="btnLast">';
        $config['last_tag_close'] = '</span>';

        //항상나오는 다음버튼 감싸는 태그추가
        $config['disabled_next_tag_open'] = '<span class="disableBtnNext">';
        $config['disabled_next_tag_close'] = '</span>';

        //다음버튼 감싸는 태그추가
        $config['next_tag_open'] = '<span class="btnNext">';
        $config['next_tag_close'] = '</span>';

        //항상나오는 이전버튼 태그추가
        $config['disabled_prev_tag_open'] = "<span class='disableBtnPrev'>";
        $config['disabled_prev_tag_close'] = "</span>";

        //이전버튼 감싸는 태그추가
        $config['prev_tag_open'] = '<span class="btnPrev">';
        $config['prev_tag_close'] = '</span>';

        //현재페이지번호 감싸는 태그추가
        $config['cur_tag_open'] = '<span class="on">';
        $config['cur_tag_close'] = '</span>';

        //페이지번호 감싸는 태그추가
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        //페이지네이션 초기화
        $this->pagination->initialize($config);

        //페이징 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        //게시판 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this->uri->segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];

        if ($this->session->userdata('BRANCH_IDX') === '1') {
            $lists_sql = "SELECT
                            QB.QUESTION_BOARD_IDX,
                            QB.TITLE,
                            BC.NAME,
                            DATE_FORMAT(QB.TIMESTAMP, '%Y-%m-%d') INS_DATE
                          FROM 
                            QUESTION_BOARD QB, BRANCH BC
                          WHERE 
                            QB.BRANCH_IDX = BC.BRANCH_IDX ";
        } else {
            $lists_sql = "SELECT
                            QB.QUESTION_BOARD_IDX,
                            QB.TITLE,
                            BC.NAME,
                            DATE_FORMAT(QB.TIMESTAMP, '%Y-%m-%d') INS_DATE
                          FROM 
                            QUESTION_BOARD QB, BRANCH BC
                          WHERE 
                            QB.BRANCH_IDX = BC.BRANCH_IDX AND
                            BC.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";
        }
        $lists_sql .= $add_where;
        $lists_sql .= "ORDER BY QB.TIMESTAMP DESC LIMIT $start, $limit";

        $data['lists'] = $this->Db_m->getList($lists_sql, 'DRIVING_ZONE');

        $this->load->view('board/question_board/list', $data);
    }

    function question_board_write() {
        $this->load->view('board/question_board/write');
    }

    function question_board_view() {

        $sql = "SELECT
                    QB.QUESTION_BOARD_IDX,
                    QB.TITLE,
                    BC.NAME,
                    QB.CONTENTS,
                    QB.ANSWER,
                    QB.A_TIMESTAMP,
                    DATE_FORMAT(QB.TIMESTAMP, '%Y-%m-%d') INS_DATE
                FROM 
                    QUESTION_BOARD QB, BRANCH BC
                WHERE 
                    QB.BRANCH_IDX = BC.BRANCH_IDX AND 
                    QB.QUESTION_BOARD_IDX = '" . $this->uri->segment(3) . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('board/question_board/view', $data);
    }

    function question_board_answer() {

        $sql = "SELECT
                    QB.QUESTION_BOARD_IDX,
                    QB.TITLE,
                    BC.NAME,
                    QB.CONTENTS,
                    QB.ANSWER,
                    QB.A_TIMESTAMP,
                    DATE_FORMAT(QB.TIMESTAMP, '%Y-%m-%d') INS_DATE
                FROM 
                    QUESTION_BOARD QB, BRANCH BC
                WHERE 
                    QB.BRANCH_IDX = BC.BRANCH_IDX AND 
                    QB.QUESTION_BOARD_IDX = '" . $this->uri->segment(3) . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('board/question_board/answer', $data);
    }

    function question_board_modify() {
        $sql = "SELECT
                    QB.QUESTION_BOARD_IDX,
                    QB.TITLE,
                    BC.NAME,
                    QB.CONTENTS,
                    QB.ANSWER,
                    QB.A_TIMESTAMP,
                    DATE_FORMAT(QB.TIMESTAMP, '%Y-%m-%d') INS_DATE
                FROM 
                    QUESTION_BOARD QB, BRANCH BC
                WHERE 
                    QB.BRANCH_IDX = BC.BRANCH_IDX AND 
                    QB.QUESTION_BOARD_IDX = '" . $this->uri->segment(3) . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $this->load->view('board/question_board/modify', $data);
    }

    function member_delete() {

        $sql = "SELECT
                    BRANCH_IDX,
                    NAME 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $goods_sql = "SELECT
                        G.GOODS_IDX,
                        G.GOODS_NAME,
                        G.GOODS_PRICE,
                        CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT
                      FROM 
                        GOODS G, BRANCH B 
                      WHERE 
                        G.BRANCH_IDX = B.BRANCH_IDX AND 
                        G.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        G.DEL_YN = 'N'";

        $data['goods_lists'] = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $payment_sql = "SELECT
                            PAYMENT_IDX, 
                            NAME, 
                            WEIGHT 
                        FROM 
                            PAYMENT 
                        WHERE 
                            DEL_YN = 'N'";

        $data['payment_lists'] = $this->Db_m->getList($payment_sql, 'DRIVING_ZONE');

        $event_sql = "SELECT
                        EVENT_IDX,
                        EVENT_NAME,
                        EVENT_TYPE,
                        DISCOUNT_RATE
                      FROM
                        EVENT 
                      WHERE 
                        BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' OR EVENT_TYPE = 'A' AND
                        DEL_YN = 'N'";

        $data['event_lists'] = $this->Db_m->getList($event_sql, 'DRIVING_ZONE');

        $visit_route_sql = "SELECT
                                VISIT_ROUTE_IDX,
                                NAME
                            FROM 
                                VISIT_ROUTE 
                            WHERE 
                                DEL_YN = 'N'";

        $data['visit_route_lists'] = $this->Db_m->getList($visit_route_sql, "DRIVING_ZONE");

        $practice_sql = "SELECT
                            PRACTICE_IDX,
                            NAME
                         FROM 
                            PRACTICE 
                         WHERE 
                            DEL_YN = 'N'";

        $data['practice_lists'] = $this->Db_m->getList($practice_sql, "DRIVING_ZONE");

        $add_where = "";
        $data['gubun'] = "";
        $data['text'] = "";

        //검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 4;

        //주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환 
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            //주소에 검색어가 있을 경우의 처리. 즉 검색시 
            $gubun = urldecode($this->url_explode($uri_array, 'gubun'));
            $text = urldecode($this->url_explode($uri_array, 'text'));
            //페이지네이션용 주소 
            $page_url = '/q/gubun/' . $gubun . '/text/' . $text;
            $uri_segment = 9;

            if ($this->uri->segment(5) == 'title' && $this->uri->segment(7)) {
                $add_where .= "AND M.ID LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }

            if ($this->uri->segment(5) == 'contents' && $this->uri->segment(7)) {
                $add_where .= "AND M.NAME LIKE '%" . urldecode($this->uri->segment(7)) . "%'";
                $data['gubun'] = $this->uri->segment(5);
                $data['text'] = urldecode($this->uri->segment(7));
            }
        }

        //페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');

        //페이지네이션 설정 '.$page_url.'
        $config['base_url'] = '/index/member_delete/' . $page_url . '/page/'; //페이징 주소
        //게시물의 전체 갯수
        $count_sql = "SELECT
                        COUNT(*) CNT
                      FROM
                        MEMBER M, MEMBER_DEFAULT MD, BRANCH B
                      WHERE 
                        M.BRANCH_IDX = B.BRANCH_IDX AND
                        M.MEMBER_IDX = MD.MEMBER_IDX AND 
                        M.STATUS = 'Y' AND
                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' ";
        $count_sql .= $add_where;

        $count_res = $this->Db_m->getInfo($count_sql, 'DRIVING_ZONE');

        $config['total_rows'] = $count_res->CNT;
        $data['total_rows'] = $count_res->CNT;

        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        //$config['num_links'] = 2; //페이지 링크 갯수 설정
        $config['use_fixed_page'] = TRUE;
        $config['fixed_page_num'] = 10;

        $config['display_first_always'] = TRUE;
        $config['disable_first_link'] = TRUE;
        $config['display_last_always'] = TRUE;
        $config['disable_last_link'] = TRUE;
        $config['display_prev_always'] = TRUE;
        $config['display_next_always'] = TRUE;
        $config['disable_prev_link'] = TRUE;
        $config['disable_next_link'] = TRUE;

        //페이지네이션 전체 감싸는 태그추가
        $config['full_tag_open'] = '<div class="boardPaging">';
        $config['full_tag_close'] = '</div>';

        //항상나오는 처음으로 버튼 태그추가
        $config['disabled_first_tag_open'] = "<span class='disableBtnFirst'>";
        $config['disabled_first_tag_close'] = "</span>";

        //처음으로버튼 감싸는 태그추가
        $config['first_tag_open'] = '<span class="btnFirst">';
        $config['first_tag_close'] = '</span>';

        //항상나오는 마지막으로 버튼 태그추가
        $config['disabled_last_tag_open'] = "<span class='disableBtnLast'>";
        $config['disabled_last_tag_close'] = "</span>";

        //마지막으로버튼 감싸는 태그추가
        $config['last_tag_open'] = '<span class="btnLast">';
        $config['last_tag_close'] = '</span>';

        //항상나오는 다음버튼 감싸는 태그추가
        $config['disabled_next_tag_open'] = '<span class="disableBtnNext">';
        $config['disabled_next_tag_close'] = '</span>';

        //다음버튼 감싸는 태그추가
        $config['next_tag_open'] = '<span class="btnNext">';
        $config['next_tag_close'] = '</span>';

        //항상나오는 이전버튼 태그추가
        $config['disabled_prev_tag_open'] = "<span class='disableBtnPrev'>";
        $config['disabled_prev_tag_close'] = "</span>";

        //이전버튼 감싸는 태그추가
        $config['prev_tag_open'] = '<span class="btnPrev">';
        $config['prev_tag_close'] = '</span>';

        //현재페이지번호 감싸는 태그추가
        $config['cur_tag_open'] = '<span class="on">';
        $config['cur_tag_close'] = '</span>';

        //페이지번호 감싸는 태그추가
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        //페이지네이션 초기화
        $this->pagination->initialize($config);

        //페이징 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        //게시판 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this->uri->segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];

        $member_lists_sql = "SELECT
                                M.MEMBER_IDX,
                                M.NAME, 
                                MD.BIRTH,
                                MD.ADDR,
                                MD.DETAIL_ADDR,
                                M.INS_TYPE,
                                DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') INS_DATE,
                                MD.IN_ROUTE_COMMENT,
                                MD.PRACTICE_COMMENT,
                                TS.NAME TEST_SITE_NAME,
                                MD.IMG,
                                MD.FINAL_YN,
                                MD.PROCEEDING_YN,
                                MD.COMMENT,
                                MD.BOOKING_HISTORY,
                                (
                                    SELECT 
                                        G.GOODS_NAME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        MG.MEMBER_IDX = M.MEMBER_IDX
                                        ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1
                                ) GOODS_NAME,
                                (
                                    SELECT 
                                        MG.TIMESTAMP 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        MG.MEMBER_IDX = M.MEMBER_IDX
                                        ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1
                                ) MEMBER_GOODS_TIME,
                                MD.IN_TEST_YN,
                                MD.IN_TEST_DATE,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%Y-%m-%d') MOD_TEST_DATE,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%H') MOD_TEST_DATE_TIME,
                                DATE_FORMAT(MD.IN_TEST_DATE, '%i') MOD_TEST_DATE_MIN,
                                MD.ROAD_TEST_YN,
                                MD.ROAD_TEST_DATE,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%Y-%m-%d') MOD_ROAD_DATE,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%H') MOD_ROAD_DATE_TIME,
                                DATE_FORMAT(MD.ROAD_TEST_DATE, '%i') MOD_ROAD_DATE_MIN,
                                CASE 
                                    MD.FINAL_YN 
                                    WHEN 'Y' THEN '합격' 
                                    WHEN 'N' THEN '-' 
                                END FINAL_YN,
                                M.PHONE,
                                B.NAME BRANCH_NAME,
                                M.TIMESTAMP
                             FROM 
                                MEMBER M, MEMBER_DEFAULT MD 
                                LEFT JOIN TEST_SITE TS 
                                ON MD.TEST_SITE_IDX = TS.TEST_SITE_IDX, 
                                BRANCH B
                             WHERE 
                                M.BRANCH_IDX = B.BRANCH_IDX AND
                                M.MEMBER_IDX = MD.MEMBER_IDX AND 
                                M.STATUS = 'Y' AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";
        $member_lists_sql .= $add_where;
        $member_lists_sql .= "ORDER BY M.TIMESTAMP DESC LIMIT $start, $limit";

//        ECHO $member_lists_sql;

        $data['member_lists'] = $this->Db_m->getList($member_lists_sql, 'DRIVING_ZONE');

        foreach ($data['member_lists'] as $row) {
            $member_etc_pay_sql = "SELECT
                                        MEMBER_ETC_PAY_IDX,
                                        NAME, 
                                        PRICE 
                                   FROM 
                                        MEMBER_ETC_PAY 
                                   WHERE 
                                        MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_etc_pay' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_etc_pay_sql, 'DRIVING_ZONE');

            $member_goods_sql = "SELECT 
                                    G.GOODS_NAME,
                                    P.NAME PAYMENT_NAME,
                                    E.EVENT_NAME,
                                    MG.MEMBER_GOODS_IDX,
                                    MG.TOT_PRICE,
                                    MG.GOODS_IDX,
                                    MG.PAYMENT_IDX,
                                    ME.EVENT_IDX,
                                    CASE
                                    LICENSE_TYPE 
                                        WHEN '1' THEN '1종' 
                                        WHEN '2' THEN '2종' 
                                        WHEN 'B' THEN '대형' 
                                    END LICENSE_TYPE_TEXT
                                 FROM
                                    MEMBER_GOODS MG 
                                    LEFT JOIN
                                        MEMBER_EVENT ME
                                        ON 
                                        MG.MEMBER_GOODS_IDX = ME.MEMBER_GOODS_IDX 
                                    LEFT JOIN 
                                        EVENT E 
                                        ON 
                                        ME.EVENT_IDX = E.EVENT_IDX
                                    , GOODS G, PAYMENT P
                                 WHERE 
                                    MG.GOODS_IDX = G.GOODS_IDX AND 
                                    MG.PAYMENT_IDX = P.PAYMENT_IDX AND
                                    MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_goods' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_goods_sql, 'DRIVING_ZONE');

            $member_visit_route_sql = "SELECT
                                        VR.VISIT_ROUTE_IDX, 
                                        IF(MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX, 'checked', '') CHECKED, 
                                        NAME 
                                       FROM 
                                        VISIT_ROUTE VR 
                                        LEFT JOIN 
                                            MEMBER_VISIT_ROUTE MVR 
                                            ON 
                                            VR.VISIT_ROUTE_IDX = MVR.VISIT_ROUTE_IDX AND 
                                            MVR.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $data['member_visit_route' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_visit_route_sql, 'DRIVING_ZONE');

            $member_practice_sql = "SELECT
                                        P.PRACTICE_IDX, 
                                        IF(MP.PRACTICE_IDX = P.PRACTICE_IDX, 'checked', '') CHECKED, 
                                        NAME 
                                       FROM 
                                        PRACTICE P 
                                        LEFT JOIN 
                                            MEMBER_PRACTICE MP 
                                            ON 
                                            P.PRACTICE_IDX = MP.PRACTICE_IDX AND 
                                            MP.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $data['member_practice' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_practice_sql, 'DRIVING_ZONE');

            $member_memo_sql = "SELECT
                                    MEMBER_MEMO_IDX,
                                    DATE,
                                    CONTENTS
                                FROM 
                                    MEMBER_MEMO
                                WHERE 
                                    MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";
            $data['member_memo' . $row['MEMBER_IDX']] = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');

            //회원의 최신 상품이 시간형인지 구분
            $goods_chk_sql = "SELECT
                                G.GOODS_TYPE
                              FROM 
                                MEMBER_GOODS MG, GOODS G 
                                LEFT JOIN 
                                    TIME_GOODS TG 
                                    ON 
                                    G.GOODS_IDX = TG.GOODS_IDX
                              WHERE 
                                MG.GOODS_IDX = G.GOODS_IDX AND
                                MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'
                                ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1";

            $goods_chk_res = $this->Db_m->getInfo($goods_chk_sql, 'DRIVING_ZONE');

            //회원의 예약했던 시간의 합
            $member_time_sql = "SELECT 
                                    SUM(TIMESTAMPDIFF(MINUTE, BOOKING_SDATE, BOOKING_EDATE)) SUM_TIME
                                FROM 
                                    BOOKING B, BOOKING_DETAIL BD, GOODS G
                                WHERE
                                    B.BOOKING_IDX = BD.BOOKING_IDX AND
                                    BD.GOODS_IDX = G.GOODS_IDX AND
                                    G.GOODS_TYPE = 'T' AND
                                    BD.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');

            //회원의 전체 상품 내역중 시간형 상품만 가져와서 시간형 상품의 종합시간값
            $member_tot_time_sql = "SELECT 
                                        (SUM(TG.GOODS_TIME) * 60) GOODS_TIME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        G.GOODS_IDX = TG.GOODS_IDX AND 
                                        MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

            if ($goods_chk_res) {
                if ($goods_chk_res->GOODS_TYPE == 'T') {
//                    echo $row['NAME'].$member_tot_time_res->GOODS_TIME.'<br>';
//                    echo $row['NAME'].$member_time_res->SUM_TIME.'<br>';
                    $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                    $time1 = (int) ($minute / 60);
                    $time2 = $minute % 60;
                    $data['time' . $row['MEMBER_IDX']] = "잔여시간 " . $time1 . "시간 " . $time2 . "분";
                } else {

                    //회원의 예약했던 시간의 합
                    $member_time_sql = "SELECT 
                                        SUM(TIMESTAMPDIFF(MINUTE, BOOKING_SDATE, BOOKING_EDATE)) SUM_TIME
                                    FROM 
                                        BOOKING B, BOOKING_DETAIL BD, GOODS G
                                    WHERE
                                        B.BOOKING_IDX = BD.BOOKING_IDX AND
                                        BD.GOODS_IDX = G.GOODS_IDX AND
                                        BD.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

                    $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');
                    $minute = $member_time_res->SUM_TIME;
                    $time1 = (int) ($minute / 60);
                    $time2 = $minute % 60;

                    $data['time' . $row['MEMBER_IDX']] = "누적시간 " . $time1 . "시간 " . $time2 . "분";
                }
            } else {
                $data['time' . $row['MEMBER_IDX']] = "";
            }
        }

        $refunds_sql = "SELECT
                    REFUNDS 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['refunds_info'] = $this->Db_m->getInfo($refunds_sql, 'DRIVING_ZONE');

        $privacy_sql = "SELECT
                    PRIVACY 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['privacy_info'] = $this->Db_m->getInfo($privacy_sql, 'DRIVING_ZONE');


        $this->load->view('member/member_delete', $data);
    }

}
