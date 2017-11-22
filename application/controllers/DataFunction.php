<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataFunction
 *
 * @author dev_piljae
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class DataFunction extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->DRIVING_ZONE = $this->load->database('DRIVING_ZONE', TRUE);

        $this->load->helper(array('url', 'date', 'form', 'alert'));
        $this->load->model('Db_m');
        $this->load->library('session');
    }

    function upload_receiver_from_ck() {
        $this->load->library('upload');
        $url_path = "/boardUpFile";
        $upload_config = Array(
            'upload_path' => $_SERVER['DOCUMENT_ROOT'] . $url_path,
            'allowed_types' => 'gif|jpg|jpeg|png|bmp',
            'max_size' => '512000',
            'encrypt_name' => TRUE
        );
        $this->upload->initialize($upload_config);
        if (!$this->upload->do_upload("upload")) {
            echo "<script type='text/javascript'>alert('업로드에 실패 하였습니다. " . $this->upload->display_errors('', '') . "')</script>";
        } else {

            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
            $data = $this->upload->data();
            $fileName = $data['file_name'];
            $url = "/boardUpFile/" . $fileName;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('" . $CKEditorFuncNum . "', '" . $url . "', '전송에 성공 했습니다.')</script>";
        }
    }

    //초기 관리자 등록 액션
    function defaultSet() {
        $insArray = array(
            'ID' => 'admin',
            'PWD' => md5('1234'),
            'NAME' => '본점',
            'TYPE' => 'D',
            'OWNER_NAME' => '정재헌',
            'OWNER_PHONE' => '01090249394',
            'MANAGER_NAME' => '정재헌',
            'MANAGER_PHONE' => '01090249394',
            'USE_EDATE' => '2999-12-31'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('BRANCH', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/');
        } else {
            alert('세팅 되었습니다.', '/');
        }
    }

    function login() {
        //sql 인젝션 방지
        $id = $this->DRIVING_ZONE->escape($this->input->post('id', TRUE));
        $pwd = $this->DRIVING_ZONE->escape(md5($this->input->post('pwd', TRUE)));

        $sql = "SELECT
                    BRANCH_IDX,
                    ID,
                    USE_EDATE,
                    NOW() NOW
                FROM 
                    BRANCH 
                WHERE
                    ID = $id AND
                    PWD = $pwd";
        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');
        if ($res) {

            $date1 = new DateTime($res->NOW);
            $date2 = new DateTime($res->USE_EDATE);
            $diff = date_diff($date1, $date2);
            if ($diff->invert == 0) {
                //세션 생성
                $newdata = array(
                    'BRANCH_IDX' => $res->BRANCH_IDX
                );
                $this->session->set_userdata($newdata);
                alert('로그인 되었습니다.', '/index/main');
            } else {
                alert('계정의 사용기간이 만료되었습니다.', '/');
            }
        } else {
            alert('아이디나 비밀번호를 확인해주세요', '/');
        }
    }

    function machineLogin() {
        //sql 인젝션 방지
        $id = $this->DRIVING_ZONE->escape($this->input->post('id', TRUE));
        $pwd = $this->DRIVING_ZONE->escape(md5($this->input->post('pwd', TRUE)));

        $sql = "SELECT
                    MACHINE_INFO_IDX
                FROM 
                    MACHINE_INFO 
                WHERE
                    ID = $id AND
                    PWD = $pwd";
        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');
        if ($res) {
            //세션 생성
            $newdata = array(
                'MACHINE_INFO_IDX' => $res->MACHINE_INFO_IDX
            );
            $this->session->set_userdata($newdata);
            alert('로그인 되었습니다.', '/device/calender_machine');
        } else {
            alert('아이디나 비밀번호를 확인해주세요', '/device');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        echo "<script language='javascript'>";
        echo "alert('로그아웃 되었습니다.');";
        echo "location.href='/'";
        echo "</script>";
    }

    function dashboardChart() {
        $sql = "SELECT 
                    DT.d,
                    IFNULL(TOT_PRICE, 0) TOT_PRICE,
                    IFNULL(MEP_TOT_PRICE, 0) MEP_TOT_PRICE,
                    IFNULL(TOT_PRICE, 0) + IFNULL(MEP_TOT_PRICE, 0) ALL_TOT_PRICE
                FROM 
                    date_t DT 
                    LEFT OUTER JOIN
                    (
                      SELECT 
                        DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d') MG_DATE,
                        SUM(MG.TOT_PRICE) TOT_PRICE 
                      FROM 
                        MEMBER M, MEMBER_GOODS MG 
                      WHERE
                        M.MEMBER_IDX = MG.MEMBER_IDX AND 
                        MG.PAY_YN = 'N' AND
                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                        GROUP BY DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d')
                    ) MG
                    ON MG.MG_DATE = DT.d
                    LEFT OUTER JOIN
                    (
                      SELECT 
                        DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d') MEP_DATE,
                        SUM(MEP.PRICE) MEP_TOT_PRICE 
                      FROM 
                        MEMBER M, MEMBER_ETC_PAY MEP 
                      WHERE
                        M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                        M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND 
                        MEP.PAY_YN = 'N'
                        GROUP BY DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d')
                    ) MEP
                    ON MEP.MEP_DATE = DT.d
                WHERE 
                    TO_DAYS('" . $this->input->post('date', true) . "') - TO_DAYS(DT.d) <= 6
                ORDER BY DT.d LIMIT 0, 7";
//        echo $sql;

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        $pay_sql = "SELECT 
                        P.NAME,
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
                        ) PAY_CNT
                    FROM 
                        PAYMENT P
                    WHERE
                       P.DEL_YN = 'N'";

        $pay_res = $this->Db_m->getList($pay_sql, 'DRIVING_ZONE');

        $result[][] = array();

        foreach ($res as $row) {
            $result['title'][] = array(
                'title' => $row['d']
            );

            $result['price'][] = array(
                'price' => $row['ALL_TOT_PRICE']
            );
        }

        foreach ($pay_res as $row) {
            $result['pay_title'][] = array(
                'title' => $row['NAME']
            );
            $result['pay_price'][] = array(
                'price' => $row['PAY_CNT']
            );
        }

        print_r(json_encode($result));
    }

    function statisticsChart() {

        if ($this->input->post('idx', true)) {
            $branch_idx = $this->input->post('idx', true);
        } else {
            $branch_idx = $this->session->userdata('BRANCH_IDX');
        }

        if ($this->input->post('type', true) == 'day') {

            $sql = "SELECT 
                        DT.d,
                        IFNULL(TOT_PRICE, 0) TOT_PRICE,
                        IFNULL(MEP_TOT_PRICE, 0) MEP_TOT_PRICE,
                        IFNULL(TOT_PRICE, 0) + IFNULL(MEP_TOT_PRICE, 0) ALL_TOT_PRICE
                    FROM 
                        date_t DT 
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d') MG_DATE,
                            SUM(MG.TOT_PRICE) TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_GOODS MG 
                          WHERE
                            M.MEMBER_IDX = MG.MEMBER_IDX AND 
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $branch_idx . "'
                            GROUP BY DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d')
                        ) MG
                        ON MG.MG_DATE = DT.d
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d') MEP_DATE,
                            SUM(MEP.PRICE) MEP_TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_ETC_PAY MEP 
                          WHERE
                            M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $branch_idx . "' AND 
                            MEP.PAY_YN = 'N'
                            GROUP BY DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d')
                        ) MEP
                        ON MEP.MEP_DATE = DT.d
                    WHERE 
                        TO_DAYS('" . $this->input->post('date', true) . "') - TO_DAYS(DT.d) <= 6
                    ORDER BY DT.d LIMIT 0, 7";

            $member_sql = "SELECT 
                                DT.d,
                                IFNULL(MEMBER_TOT, 0) MEMBER_TOT
                            FROM 
                                date_t DT 
                                LEFT OUTER JOIN
                                (
                                  SELECT 
                                    DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') M_DATE,
                                    COUNT(*) MEMBER_TOT
                                  FROM 
                                    MEMBER M
                                  WHERE
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    GROUP BY DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d')
                                ) M
                                ON M.M_DATE = DT.d
                            WHERE 
                                TO_DAYS('" . $this->input->post('date', true) . "') - TO_DAYS(DT.d) <= 6
                            ORDER BY DT.d LIMIT 0, 7";
        } else if ($this->input->post('type', true) == 'month') {

            $sdate = substr($this->input->post('date', true), 0, -2) . '01';
            $sql = "SELECT 
                        DATE_FORMAT(DT.d, '%Y-%m') d,
                        IFNULL(TOT_PRICE, 0) TOT_PRICE,
                        IFNULL(MEP_TOT_PRICE, 0) MEP_TOT_PRICE,
                        IFNULL(TOT_PRICE, 0) + IFNULL(MEP_TOT_PRICE, 0) ALL_TOT_PRICE
                    FROM 
                        date_t DT 
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d') MG_DATE,
                            SUM(MG.TOT_PRICE) TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_GOODS MG 
                          WHERE
                            M.MEMBER_IDX = MG.MEMBER_IDX AND 
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $branch_idx . "'
                            GROUP BY DATE_FORMAT(MG.TIMESTAMP, '%Y-%m')
                        ) MG
                        ON MG.MG_DATE = DT.d
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d') MEP_DATE,
                            SUM(MEP.PRICE) MEP_TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_ETC_PAY MEP 
                          WHERE
                            M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $branch_idx . "' AND 
                            MEP.PAY_YN = 'N'
                            GROUP BY DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m')
                        ) MEP
                        ON MEP.MEP_DATE = DT.d
                    WHERE 
                        DT.d BETWEEN '" . date("Y-m-d", strtotime("$sdate -6 month")) . "' AND '" . substr($this->input->post('date', true), 0, -2) . '31' . "'
                    GROUP BY DATE_FORMAT(DT.d, '%Y%m') ORDER BY DT.d";

            $member_sql = "SELECT 
                                DATE_FORMAT(DT.d, '%Y-%m') d,
                                IFNULL(MEMBER_TOT, 0) MEMBER_TOT
                            FROM 
                                date_t DT 
                                LEFT OUTER JOIN
                                (
                                  SELECT 
                                    DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') M_DATE,
                                    COUNT(*) MEMBER_TOT
                                  FROM 
                                    MEMBER M
                                  WHERE
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    GROUP BY DATE_FORMAT(M.TIMESTAMP, '%Y-%m')
                                ) M
                                ON M.M_DATE = DT.d
                            WHERE 
                                DT.d BETWEEN '" . date("Y-m-d", strtotime("$sdate -6 month")) . "' AND '" . substr($this->input->post('date', true), 0, -2) . '31' . "'
                            GROUP BY DATE_FORMAT(DT.d, '%Y%m') ORDER BY DT.d";
        }

//        echo $sql;

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');
        $member_res = $this->Db_m->getList($member_sql, 'DRIVING_ZONE');
//        $tot_price_res = $this->Db_m->getList($tot_price_sql, 'DRIVING_ZONE');

        $pay_sql = "SELECT 
                        P.NAME,
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
                        ) PAY_CNT
                    FROM 
                        PAYMENT P
                    WHERE
                       P.DEL_YN = 'N'";

        $pay_res = $this->Db_m->getList($pay_sql, 'DRIVING_ZONE');

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
                        )) SUM_GOODS
                      FROM 
                        GOODS G 
                      GROUP BY G.GOODS_TYPE";

        $goods_res = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $visit_route_sql = "SELECT 
                                VR.NAME,
                                (
                                  SELECT 
                                    COUNT(*) CNT
                                  FROM 
                                    MEMBER_VISIT_ROUTE MVR, MEMBER M 
                                  WHERE 
                                    MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX AND
                                    MVR.MEMBER_IDX = M.MEMBER_IDX AND
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                ) VR_CNT
                           FROM 
                                VISIT_ROUTE VR
                           WHERE 
                                VR.DEL_YN = 'N'
                              GROUP BY VR.VISIT_ROUTE_IDX";

        $visit_route_res = $this->Db_m->getList($visit_route_sql, 'DRIVING_ZONE');

        $practice_sql = "SELECT
                            P.NAME,
                            (
                              SELECT 
                                COUNT(*) CNT
                              FROM 
                                MEMBER_PRACTICE MP, MEMBER M 
                              WHERE 
                                MP.MEMBER_IDX = M.MEMBER_IDX AND 
                                MP.PRACTICE_IDX = P.PRACTICE_IDX AND 
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                            ) MP_CNT
                          FROM 
                            PRACTICE P 
                          WHERE 
                            P.DEL_YN = 'N' 
                          GROUP BY P.PRACTICE_IDX";

        $practice_res = $this->Db_m->getList($practice_sql, 'DRIVING_ZONE');

        $test_site_sql = "SELECT 
                            TS.NAME,
                            (
                              SELECT 
                                COUNT(*) CNT 
                              FROM 
                                MEMBER_DEFAULT MD, MEMBER M 
                              WHERE 
                                MD.MEMBER_IDX = M.MEMBER_IDX AND 
                                MD.TEST_SITE_IDX = TS.TEST_SITE_IDX AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                            ) TS_CNT
                          FROM 
                            TEST_SITE TS 
                          WHERE 
                            TS.DEL_YN = 'N' 
                            GROUP BY TS.NAME";

        $test_site_res = $this->Db_m->getList($test_site_sql, 'DRIVING_ZONE');

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

        $unpass = $this->Db_m->getInfo($unpass_sql, 'DRIVING_ZONE');

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

        $pass = $this->Db_m->getInfo($pass_sql, 'DRIVING_ZONE');


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

        $unproceeding = $this->Db_m->getInfo($unproceeding_sql, 'DRIVING_ZONE');

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

        $proceeding = $this->Db_m->getInfo($proceeding_sql, 'DRIVING_ZONE');

        $result[][] = array();

        foreach ($res as $row) {
            $result['price'][] = array(
                'title' => $row['d'],
                'price' => $row['ALL_TOT_PRICE']
            );
        }

        foreach ($member_res as $row) {
            $result['member'][] = array(
                'member_title' => $row['d'],
                'member_price' => $row['MEMBER_TOT']
            );
        }

//        foreach ($tot_price_res as $row) {
//            $result['tot_price'][] = array(
//                'tot_price_title' => $row['MG_DATE'],
//                'tot_price_price' => $row['TOT_PRICE']
//            );
//        }

        foreach ($pay_res as $row) {
            $result['pay'][] = array(
                'pay_title' => $row['NAME'],
                'pay_price' => $row['PAY_CNT']
            );
        }

        foreach ($goods_res as $row) {
            $result['goods'][] = array(
                'goods_title' => $row['GOODS_TYPE'],
                'goods_price' => $row['SUM_GOODS']
            );
        }

        foreach ($visit_route_res as $row) {
            $result['visit_route'][] = array(
                'visit_route_title' => $row['NAME'],
                'visit_route_price' => $row['VR_CNT']
            );
        }

        foreach ($practice_res as $row) {
            $result['practice'][] = array(
                'practice_title' => $row['NAME'],
                'practice_price' => $row['MP_CNT']
            );
        }

        foreach ($test_site_res as $row) {
            $result['test_site'][] = array(
                'test_site_title' => $row['NAME'],
                'test_site_price' => $row['TS_CNT']
            );
        }


        $result['pass'][] = array(
            'pass_value' => $pass->PASS
        );

        $result['unpass'][] = array(
            'unpass_value' => $unpass->FAILED
        );

        $result['proceeding'][] = array(
            'proceeding_value' => $proceeding->PASS
        );

        $result['unproceeding'][] = array(
            'unproceeding_value' => $unproceeding->FAILED
        );



        print_r(json_encode($result));
    }

    function modBranch() {

        if ($this->input->post('pwd', true)) {
            $updateArray = array(
                'PWD' => md5($this->input->post('pwd', true)),
                'NAME' => $this->input->post('name', true),
                'OWNER_NAME' => $this->input->post('owner_name', true),
                'OWNER_PHONE' => $this->input->post('owner_phone', true),
                'MANAGER_NAME' => $this->input->post('manager_name', true),
                'MANAGER_PHONE' => $this->input->post('manager_phone', true),
                'COMMENT' => $this->input->post('comment', true)
            );
        } else {
            $updateArray = array(
                'NAME' => $this->input->post('name', true),
                'OWNER_NAME' => $this->input->post('owner_name', true),
                'OWNER_PHONE' => $this->input->post('owner_phone', true),
                'MANAGER_NAME' => $this->input->post('manager_name', true),
                'MANAGER_PHONE' => $this->input->post('manager_phone', true),
                'COMMENT' => $this->input->post('comment', true)
            );
        }

        $updateWhere = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('BRANCH', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/store');
        } else {
            alert('수정 되었습니다.', '/index/store');
        }
    }

    function insMachine() {
        $insArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true),
            'ID' => $this->input->post('id', true),
            'PWD' => md5($this->input->post('pwd', true)),
            'COMMENT' => $this->input->post('comment', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('MACHINE_INFO', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/store');
        } else {
            alert('기기등록 되었습니다.', '/index/store');
        }
    }

    function getMachineInfo() {
        $sql = "SELECT
                   MACHINE_INFO_IDX, 
                   ID, 
                   COMMENT
                FROM 
                   MACHINE_INFO 
                WHERE 
                   MACHINE_INFO_IDX = '" . $this->input->post('machine_info_idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $result = array();

        if ($res->MACHINE_INFO_IDX) {
            $result = array(
                'REQUEST' => 'SUCCESS',
                'MACHINE_INFO_IDX' => $res->MACHINE_INFO_IDX,
                'ID' => $res->ID,
                'COMMENT' => $res->COMMENT
            );
        } else {
            $result = array(
                'REQUEST' => 'FAILED'
            );
        }

        echo json_encode($result);
    }

    function modMachine() {
        if ($this->input->post('pwd', true)) {
            $updateArray = array(
                'PWD' => md5($this->input->post('pwd', true)),
                'COMMENT' => $this->input->post('comment', true)
            );
        } else {
            $updateArray = array(
                'COMMENT' => $this->input->post('comment', true)
            );
        }

        $updateWhere = array(
            'MACHINE_INFO_IDX' => $this->input->post('machine_info_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('MACHINE_INFO', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/store');
        } else {
            alert('수정 되었습니다.', '/index/store');
        }
    }

    function delMachine() {
        $delWhere = array(
            'MACHINE_INFO_IDX' => $this->input->post('machine_info_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('MACHINE_INFO', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function idCheck() {
        //sql 인젝션 방지
        $id = $this->DRIVING_ZONE->escape($this->input->get('id', TRUE));

        $sql = "SELECT
                    ID 
                FROM 
                    BRANCH 
                WHERE 
                    ID = $id";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if (!$res) {
            echo "true";
        } else {
            echo "false";
        }
    }

    function insBranch() {
        $insArray = array(
            'ID' => $this->input->post('id', true),
            'PWD' => md5($this->input->post('pwd', true)),
            'NAME' => $this->input->post('name', true),
            'TYPE' => $this->input->post('type', true),
            'OWNER_NAME' => $this->input->post('owner_name', true),
            'OWNER_PHONE' => $this->input->post('owner_phone', true),
            'MANAGER_NAME' => $this->input->post('manager_name', true),
            'MANAGER_PHONE' => $this->input->post('manager_phone', true),
            'USE_EDATE' => $this->input->post('use_edate', true),
            'COMMENT' => $this->input->post('comment', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('BRANCH', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/store_admin');
        } else {
            alert("등록 되었습니다.", '/index/store_admin');
        }
    }

    function getModBranchInfo() {
        $sql = "SELECT
                    BRANCH_IDX, 
                    ID, 
                    NAME, 
                    TYPE, 
                    OWNER_NAME, 
                    OWNER_PHONE, 
                    MANAGER_NAME, 
                    MANAGER_PHONE, 
                    USE_EDATE, 
                    COMMENT 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->input->post('idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $result = array();

        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'BRANCH_IDX' => $res->BRANCH_IDX,
                'ID' => $res->ID,
                'NAME' => $res->NAME,
                'TYPE' => $res->TYPE,
                'OWNER_NAME' => $res->OWNER_NAME,
                'OWNER_PHONE' => $res->OWNER_PHONE,
                'MANAGER_NAME' => $res->MANAGER_NAME,
                'MANAGER_PHONE' => $res->MANAGER_PHONE,
                'USE_EDATE' => $res->USE_EDATE,
                'COMMENT' => $res->COMMENT
            );
        } else {
            $result = array(
                'RESULT' => 'FAILED'
            );
        }

        echo json_encode($result);
    }

    function modBranchAdmin() {
        if ($this->input->post('pwd', true)) {
            $updateArray = array(
                'PWD' => md5($this->input->post('pwd', true)),
                'NAME' => $this->input->post('name', true),
                'TYPE' => $this->input->post('type', true),
                'OWNER_NAME' => $this->input->post('owner_name', true),
                'OWNER_PHONE' => $this->input->post('owner_phone', true),
                'MANAGER_NAME' => $this->input->post('manager_name', true),
                'MANAGER_PHONE' => $this->input->post('manager_phone', true),
                'USE_EDATE' => $this->input->post('use_edate', true),
                'COMMENT' => $this->input->post('comment', true)
            );
        } else {
            $updateArray = array(
                'NAME' => $this->input->post('name', true),
                'TYPE' => $this->input->post('type', true),
                'OWNER_NAME' => $this->input->post('owner_name', true),
                'OWNER_PHONE' => $this->input->post('owner_phone', true),
                'MANAGER_NAME' => $this->input->post('manager_name', true),
                'MANAGER_PHONE' => $this->input->post('manager_phone', true),
                'USE_EDATE' => $this->input->post('use_edate', true),
                'COMMENT' => $this->input->post('comment', true)
            );
        }

        $updateWhere = array(
            'BRANCH_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('BRANCH', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/store_admin');
        } else {
            alert('수정 되었습니다.', '/index/store_admin');
        }
    }

    function delBranch() {
        $delWhere = array(
            'BRANCH_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('BRANCH', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function insGoods() {
        $insArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', TRUE),
            'LICENSE_TYPE' => $this->input->post('license_type', true),
            'GOODS_TYPE' => $this->input->post('goods_type', true),
            'GOODS_NAME' => $this->input->post('goods_name', true),
            'GOODS_PRICE' => $this->input->post('goods_price', true),
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('GOODS', $insArray, 'DRIVING_ZONE');
        $ins_id = $this->DRIVING_ZONE->insert_id();

        if ($this->input->post('goods_type', true) == 'T') {
            $insTimeGoodsArray = array(
                'GOODS_IDX' => $ins_id,
                'GOODS_TIME' => $this->input->post('goods_time', true)
            );

            $this->Db_m->insData('TIME_GOODS', $insTimeGoodsArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/object');
        } else {
            alert('상품등록 되었습니다.', '/index/object');
        }
    }

    function getGoodsInfo() {
        $sql = "SELECT
                    G.GOODS_IDX, 
                    G.LICENSE_TYPE,
                    G.GOODS_TYPE,
                    TG.GOODS_TIME,
                    G.GOODS_NAME,
                    G.GOODS_PRICE
                FROM 
                    GOODS G 
                    LEFT JOIN 
                        TIME_GOODS TG 
                    ON 
                        G.GOODS_IDX = TG.GOODS_IDX 
                WHERE 
                    G.GOODS_IDX = '" . $this->input->post('goods_idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $result = array();

        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'GOODS_IDX' => $res->GOODS_IDX,
                'LICENSE_TYPE' => $res->LICENSE_TYPE,
                'GOODS_TYPE' => $res->GOODS_TYPE,
                'GOODS_TIME' => $res->GOODS_TIME,
                'GOODS_NAME' => $res->GOODS_NAME,
                'GOODS_PRICE' => $res->GOODS_PRICE
            );
        } else {
            $result = array(
                'RESULT' => 'FAILED'
            );
        }

        echo json_encode($result);
    }

    function modGoods() {
        $updateArray = array(
            'LICENSE_TYPE' => $this->input->post('license_type', true),
            'GOODS_TYPE' => $this->input->post('goods_type', true),
            'GOODS_NAME' => $this->input->post('goods_name', true),
            'GOODS_PRICE' => $this->input->post('goods_price', true)
        );

        $updateWhere = array(
            'GOODS_IDX' => $this->input->post('goods_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('GOODS', $updateArray, $updateWhere, 'DRIVING_ZONE');
        $this->Db_m->delete('TIME_GOODS', $updateWhere, 'DRIVING_ZONE');

        if ($this->input->post('goods_type', true) == 'T') {
            $insTimeGoodsArray = array(
                'GOODS_IDX' => $this->input->post('goods_idx', true),
                'GOODS_TIME' => $this->input->post('goods_time', true)
            );

            $this->Db_m->insData('TIME_GOODS', $insTimeGoodsArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/object');
        } else {
            alert('상품수정 되었습니다.', '/index/object');
        }
    }

    function delGoods() {
        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'GOODS_IDX' => $this->input->post('goods_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('GOODS', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function updateGoodsShowLevel() {
        $expArray = explode(',', $this->input->post('idx', true));

        if ($expArray) {
            for ($i = 0; $i < count($expArray); $i++) {
                $updateArray[] = array(
                    'GOODS_IDX' => $expArray[$i],
                    'SHOW_LEVEL' => $i + 1
                );
            }
            $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

            $this->Db_m->modMultiData('GOODS', $updateArray, 'GOODS_IDX', 'DRIVING_ZONE');

            $this->DRIVING_ZONE->trans_complete();

            if ($this->DRIVING_ZONE->trans_status() === FALSE) {
                echo 'FAILED';
            } else {
                echo 'SUCCESS';
            }
        } else {
            echo 'FAILED';
        }
    }

    function insEvent() {
        $insArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true),
            'EVENT_NAME' => $this->input->post('event_name', true),
            'EVENT_TYPE' => $this->input->post('event_type', true),
            'DISCOUNT_RATE' => $this->input->post('discount_rate', true),
            'COMMENT' => $this->input->post('comment', true),
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('EVENT', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', 'index/event');
        } else {
            alert('이벤트 등록 되었습니다.', '/index/event');
        }
    }

    function getEventInfo() {
        $sql = "SELECT
                    EVENT_IDX, 
                    EVENT_NAME,
                    EVENT_TYPE,
                    DISCOUNT_RATE,
                    COMMENT
                FROM 
                    EVENT
                WHERE 
                    EVENT_IDX = '" . $this->input->post('event_idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $result = array();

        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'EVENT_IDX' => $res->EVENT_IDX,
                'EVENT_NAME' => $res->EVENT_NAME,
                'EVENT_TYPE' => $res->EVENT_TYPE,
                'DISCOUNT_RATE' => $res->DISCOUNT_RATE,
                'COMMENT' => $res->COMMENT
            );
        } else {
            $result = array(
                'RESULT' => 'FAILED'
            );
        }

        echo json_encode($result);
    }

    function modEvent() {
        $updateArray = array(
            'EVENT_NAME' => $this->input->post('event_name', true),
            'EVENT_TYPE' => $this->input->post('event_type', true),
            'DISCOUNT_RATE' => $this->input->post('discount_rate', true),
            'COMMENT' => $this->input->post('comment', true)
        );

        $updateWhere = array(
            'EVENT_IDX' => $this->input->post('event_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('EVENT', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', 'index/event');
        } else {
            alert('이벤트 수정 되었습니다.', '/index/event');
        }
    }

    function delEvent() {
        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'EVENT_IDX' => $this->input->post('event_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('EVENT', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function updateEventShowLevel() {
        $expArray = explode(',', $this->input->post('idx', true));

        if ($expArray) {
            for ($i = 0; $i < count($expArray); $i++) {
                $updateArray[] = array(
                    'EVENT_IDX' => $expArray[$i],
                    'SHOW_LEVEL' => $i + 1
                );
            }
            $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

            $this->Db_m->modMultiData('EVENT', $updateArray, 'EVENT_IDX', 'DRIVING_ZONE');

            $this->DRIVING_ZONE->trans_complete();

            if ($this->DRIVING_ZONE->trans_status() === FALSE) {
                echo 'FAILED';
            } else {
                echo 'SUCCESS';
            }
        } else {
            echo 'FAILED';
        }
    }

    function member_shape_add() {

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

        $this->load->view('member/member_shape_add', $data);
    }

    function member_etc_add() {
        $this->load->view('member/member_etc_add');
    }

    function member_comment_add() {
        $this->load->view('member/member_comment_add');
    }

    function member_img_add() {
        $this->load->view('member/member_img_add');
    }

    function item_place_add() {
        $this->load->view('member/item_place_add');
    }

    function item_practice_add() {
        $this->load->view('member/item_practice_add');
    }

    function item_route_add() {
        $this->load->view('member/item_route_add');
    }

    function item_shape_add() {
        $data['idx'] = $this->input->post("idx", true);
        $this->load->view('member/item_shape_add', $data);
    }

    function insPayment() {

        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('PAYMENT', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $insArray = array();

        for ($i = 0; $i < count($this->input->post('name', true)); $i++) {
            $sql = "SELECT
                        PAYMENT_IDX 
                    FROM 
                        PAYMENT 
                    WHERE 
                        NAME = '" . $this->input->post('name', true)[$i] . "'";

            $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

            if ($res) {
                $modArray = array(
                    'WEIGHT' => $this->input->post('weight', true)[$i],
                    'DEL_YN' => 'N'
                );

                $modWhere = array(
                    'PAYMENT_IDX' => $res->PAYMENT_IDX
                );

                $this->Db_m->update('PAYMENT', $modArray, $modWhere, 'DRIVING_ZONE');
            } else {
                $insArray[] = array(
                    'NAME' => $this->input->post('name', true)[$i],
                    'WEIGHT' => $this->input->post('weight', true)[$i]
                );
            }
        }

        if ($insArray) {
            $this->Db_m->insMultiData('PAYMENT', $insArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/item');
        } else {
            alert("결제 형태 설정 되었습니다.", '/index/item');
        }
    }

    function chkPayment() {
        $sql = "SELECT
                    COUNT(*) CNT
                FROM 
                    PAYMENT 
                WHERE 
                    NAME = '" . $this->input->post('name', true) . "' AND
                    DEL_YN = 'N'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function insVisitRoute() {
        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('VISIT_ROUTE', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $insArray = array();

        for ($i = 0; $i < count($this->input->post('name', true)); $i++) {
            $sql = "SELECT
                        VISIT_ROUTE_IDX 
                    FROM 
                        VISIT_ROUTE 
                    WHERE 
                        NAME = '" . $this->input->post('name', true)[$i] . "'";

            $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

            if ($res) {
                $modArray = array(
                    'DEL_YN' => 'N'
                );

                $modWhere = array(
                    'VISIT_ROUTE_IDX' => $res->VISIT_ROUTE_IDX
                );

                $this->Db_m->update('VISIT_ROUTE', $modArray, $modWhere, 'DRIVING_ZONE');
            } else {
                $insArray[] = array(
                    'NAME' => $this->input->post('name', true)[$i]
                );
            }
        }

        if ($insArray) {
            $this->Db_m->insMultiData('VISIT_ROUTE', $insArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/item');
        } else {
            alert("방문경로 설정 되었습니다.", '/index/item');
        }
    }

    function chkVisitRoute() {
        $sql = "SELECT
                    COUNT(*) CNT
                FROM 
                    VISIT_ROUTE 
                WHERE 
                    NAME = '" . $this->input->post('name', true) . "' AND
                    DEL_YN = 'N'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function chkPractice() {
        $sql = "SELECT
                    COUNT(*) CNT
                FROM 
                    PRACTICE 
                WHERE 
                    NAME = '" . $this->input->post('name', true) . "' AND
                    DEL_YN = 'N'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function insPractice() {
        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('PRACTICE', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $insArray = array();

        for ($i = 0; $i < count($this->input->post('name', true)); $i++) {
            $sql = "SELECT
                        PRACTICE_IDX 
                    FROM 
                        PRACTICE 
                    WHERE 
                        NAME = '" . $this->input->post('name', true)[$i] . "'";

            $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

            if ($res) {
                $modArray = array(
                    'DEL_YN' => 'N'
                );

                $modWhere = array(
                    'PRACTICE_IDX' => $res->PRACTICE_IDX
                );

                $this->Db_m->update('PRACTICE', $modArray, $modWhere, 'DRIVING_ZONE');
            } else {
                $insArray[] = array(
                    'NAME' => $this->input->post('name', true)[$i]
                );
            }
        }

        if ($insArray) {
            $this->Db_m->insMultiData('PRACTICE', $insArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/item');
        } else {
            alert("연습방법 설정 되었습니다.", '/index/item');
        }
    }

    function chkTestSite() {
        $sql = "SELECT
                    COUNT(*) CNT
                FROM 
                    TEST_SITE 
                WHERE 
                    NAME = '" . $this->input->post('name', true) . "' AND
                    DEL_YN = 'N'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function insTestSite() {
        $updateArray = array(
            'DEL_YN' => 'Y'
        );

        $updateWhere = array(
            'DEL_YN' => 'N'
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('TEST_SITE', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $insArray = array();

        for ($i = 0; $i < count($this->input->post('name', true)); $i++) {
            $sql = "SELECT
                        TEST_SITE_IDX 
                    FROM 
                        TEST_SITE 
                    WHERE 
                        NAME = '" . $this->input->post('name', true)[$i] . "'";

            $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

            if ($res) {
                $modArray = array(
                    'DEL_YN' => 'N'
                );

                $modWhere = array(
                    'TEST_SITE_IDX' => $res->TEST_SITE_IDX
                );

                $this->Db_m->update('TEST_SITE', $modArray, $modWhere, 'DRIVING_ZONE');
            } else {
                $insArray[] = array(
                    'NAME' => $this->input->post('name', true)[$i]
                );
            }
        }

        if ($insArray) {
            $this->Db_m->insMultiData('TEST_SITE', $insArray, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/item');
        } else {
            alert("시험장 설정 되었습니다.", '/index/item');
        }
    }

    function testSiteAutoComplete() {
        $sql = "SELECT
                    NAME 
                FROM 
                    TEST_SITE 
                WHERE 
                    NAME LIKE '%" . $this->input->get('query', true) . "%' AND
                    DEL_YN = 'N'";
        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        $result = array();
        foreach ($res as $row) {
            $result[] = array(
                'name' => $row['NAME']
            );
        }

        echo json_encode($result);
    }

    function chkPhone() {
        $sql = "SELECT
                    COUNT(*) CNT 
                FROM 
                    MEMBER 
                WHERE 
                    PHONE = '" . str_replace('-', '', $this->input->post('phone', true)) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function modChkPhone() {
        $sql = "SELECT
                    COUNT(*) CNT 
                FROM 
                    MEMBER 
                WHERE 
                    PHONE = '" . str_replace('-', '', $this->input->post('phone', true)) . "' AND
                    PHONE <> (
                    SELECT
                    PHONE
                FROM 
                    MEMBER 
                WHERE 
                    MEMBER_IDX = '" . $this->input->post('idx', true) . "'
                    )";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT == 0) {
            echo 'SUCCESS';
        } else if ($res->CNT > 0) {
            echo 'DUPLE';
        } else {
            echo 'FAILED';
        }
    }

    function insMember() {

        if ($this->input->post('ins_type', true) == 'T') {
            $insMemberArray = array(
                'BRANCH_IDX' => $this->input->post('branch_idx', true),
                'NAME' => $this->input->post('name', true),
                'PHONE' => str_replace('-', '', $this->input->post('phone', true)),
                'INS_TYPE' => $this->input->post('ins_type', true)
            );
        } else if ($this->input->post('ins_type', true) == 'D') {
            $insMemberArray = array(
                'BRANCH_IDX' => $this->input->post('branch_idx', true),
                'NAME' => $this->input->post('name', true),
                'PHONE' => str_replace('-', '', $this->input->post('phone', true)),
                'INS_TYPE' => $this->input->post('ins_type', true),
                'TIMESTAMP' => $this->input->post('timestamp', true)
            );
        }

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('MEMBER', $insMemberArray, 'DRIVING_ZONE');
        $ins_id = $this->DRIVING_ZONE->insert_id();

        if ($this->input->post('in_test_yn', true) == 'Y') {
            $ins_test_yn = 'Y';
        } else {
            $ins_test_yn = 'N';
        }

        if ($this->input->post('road_test_yn', true) == 'Y') {
            $road_test_yn = 'Y';
        } else {
            $road_test_yn = 'N';
        }

        $test_site_sql = "SELECT
                            TEST_SITE_IDX, 
                            DEL_YN 
                          FROM 
                            TEST_SITE 
                          WHERE 
                            NAME = '" . $this->input->post('test_site', true) . "'";

        $test_site_res = $this->Db_m->getInfo($test_site_sql, 'DRIVING_ZONE');

        if ($this->input->post('test_site', true)) {
            if ($test_site_res) {
                $test_site = $test_site_res->TEST_SITE_IDX;
                if ($test_site_res->DEL_YN == 'Y') {
                    $updateArray = array(
                        'DEL_YN' => 'N'
                    );

                    $updateWhere = array(
                        'TEST_SITE_IDX' => $test_site_res->TEST_SITE_IDX
                    );

                    $this->Db_m->update('TEST_SITE', $updateArray, $updateWhere, 'DRIVING_ZONE');
                }
            } else {
                $insTestSiteArray = array(
                    'NAME' => $this->input->post('test_site', true)
                );

                $this->Db_m->insData('TEST_SITE', $insTestSiteArray, 'DRIVING_ZONE');
                $test_site = $this->DRIVING_ZONE->insert_id();
            }
        } else {
            $test_site = null;
        }

        $this->load->library('upload');

        $file['img'] = '';
        $file['origin_name'] = '';


        if ($this->input->post('file_type', true) == 'W') {
            $url_path = "/uploads/memberImg";
            $img_path = uniqid() . '.jpg';
            $upload_path = $_SERVER['DOCUMENT_ROOT'] . $url_path . '/' . $img_path;

            $binary_data = base64_decode($_POST['file']);
            file_put_contents($upload_path, $binary_data);

            $info = $this->upload->data();

            $file['img'] = $url_path . "/" . $img_path;
            $file['origin_name'] = $img_path;
        } else {
            if ($_FILES['file']['name']) {
                $url_path = "/uploads/memberImg";
                $upload_config = Array(
                    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . $url_path,
                    'allowed_types' => 'gif|jpg|jpeg|png|bmp',
                    'encrypt_name' => TRUE,
                    'max_size' => '512000'
                );
                $this->upload->initialize($upload_config);
                $upfile = $_FILES['file']['name'];
                if (!$this->upload->do_upload('file')) {
                    echo $this->upload->display_errors();
                }
                $info = $this->upload->data();
                $file['img'] = $url_path . "/" . $info['file_name'];
                $file['origin_name'] = $info['orig_name'];
            }
        }




        if ($this->input->post('final_yn', true) == 'Y') {
            $final_yn = 'Y';
        } else {
            $final_yn = 'N';
        }


        if ($this->input->post('proceeding_yn', true) == 'Y') {
            $proceeding_yn = 'Y';
        } else {
            $proceeding_yn = 'N';
        }

        if (!$this->input->post('birth', true)) {
            $birth = null;
        } else {
            $birth = $this->input->post('birth', true);
        }

        if (!$this->input->post('in_test_date', true)) {
            $in_test_date = null;
        } else {
            $in_test_date = $this->input->post('in_test_date', true) . ' ' . $this->input->post('in_test_time', true) . ':' . $this->input->post('in_test_min', true);
        }

        if (!$this->input->post('road_test_date', true)) {
            $road_test_date = null;
        } else {
            $road_test_date = $this->input->post('road_test_date', true) . ' ' . $this->input->post('road_test_time', true) . ':' . $this->input->post('road_test_min', true);
        }

        $ins_member_default_array = array(
            'MEMBER_IDX' => $ins_id,
            'BIRTH' => $birth,
            'ADDR' => $this->input->post('addr', true),
            'DETAIL_ADDR' => $this->input->post('detail_addr', true),
            'IN_ROUTE_COMMENT' => $this->input->post('in_route_comment', true),
            'PRACTICE_COMMENT' => $this->input->post('practice_comment', true),
            'IN_TEST_YN' => $ins_test_yn,
            'IN_TEST_DATE' => $in_test_date,
            'ROAD_TEST_YN' => $road_test_yn,
            'ROAD_TEST_DATE' => $road_test_date,
            'TEST_SITE_IDX' => $test_site,
            'IMG' => $file['img'],
            'FINAL_YN' => $final_yn,
            'PROCEEDING_YN' => $proceeding_yn
        );

        $this->Db_m->insData('MEMBER_DEFAULT', $ins_member_default_array, 'DRIVING_ZONE');

        if ($this->input->post('date', true)) {
            for ($i = 0; $i < count($this->input->post('date', true)); $i++) {
                $insMemberMemoArray[] = array(
                    'MEMBER_IDX' => $ins_id,
                    'DATE' => $this->input->post('date', true)[$i],
                    'CONTENTS' => $this->input->post('comment', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_MEMO', $insMemberMemoArray, 'DRIVING_ZONE');
        }

        if ($this->input->post('goods_idx', true)) {
            for ($i = 0; $i < count($this->input->post('goods_idx', true)); $i++) {

                $insMemberGoodsArray = array(
                    'MEMBER_IDX' => $ins_id,
                    'GOODS_IDX' => $this->input->post('goods_idx', true)[$i],
                    'PAYMENT_IDX' => $this->input->post('payment_idx', true)[$i],
                    'TOT_PRICE' => $this->input->post('tot_price', true)[$i],
                    'PAY_YN' => $this->input->post('pay_yn', true)[$i]
                );

                $this->Db_m->insData('MEMBER_GOODS', $insMemberGoodsArray, 'DRIVING_ZONE');
                $ins_goods_idx = $this->DRIVING_ZONE->insert_id();

                if ($this->input->post('event_idx')[$i]) {
                    $insMemberEventArray = array(
                        'MEMBER_IDX' => $ins_id,
                        'MEMBER_GOODS_IDX' => $ins_goods_idx,
                        'EVENT_IDX' => $this->input->post('event_idx')[$i]
                    );

                    $this->Db_m->insData('MEMBER_EVENT', $insMemberEventArray, 'DRIVING_ZONE');
                }
            }
        }

        if ($this->input->post('etc_pay_name', true)) {
            for ($i = 0; $i < count($this->input->post('etc_pay_name', true)); $i++) {
                if ($this->input->post('etc_pay_yn', true)[$i] === 'Y') {
                    $etc_pay_yn = 'Y';
                } else {
                    $etc_pay_yn = 'N';
                }
                $insMemberEtcPayArray[] = array(
                    'MEMBER_IDX' => $ins_id,
                    'NAME' => $this->input->post('etc_pay_name', true)[$i],
                    'PRICE' => $this->input->post('etc_pay_price', true)[$i],
                    'DATE' => $this->input->post('etc_pay_date', true)[$i],
                    'PAY_YN' => $etc_pay_yn
                );
            }

            $this->Db_m->insMultiData('MEMBER_ETC_PAY', $insMemberEtcPayArray, 'DRIVING_ZONE');
        }

        if ($this->input->post('visit_route_idx', true)) {
            for ($i = 0; $i < count($this->input->post('visit_route_idx', true)); $i++) {
                $ins_member_visit_route[] = array(
                    'MEMBER_IDX' => $ins_id,
                    'VISIT_ROUTE_IDX' => $this->input->post('visit_route_idx', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_VISIT_ROUTE', $ins_member_visit_route, 'DRIVING_ZONE');
        }

        if ($this->input->post('practice_idx', true)) {
            for ($i = 0; $i < count($this->input->post('practice_idx', true)); $i++) {
                $ins_member_practice[] = array(
                    'MEMBER_IDX' => $ins_id,
                    'PRACTICE_IDX' => $this->input->post('practice_idx', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_PRACTICE', $ins_member_practice, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/member');
        } else {
            alert("회원등록 되었습니다.", '/index/member');
        }
    }

    function delMemberGoods() {
        $delWhere = array(
            'MEMBER_GOODS_IDX' => $this->input->post('goods_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('MEMBER_GOODS', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function delMemberEtc() {
        $delWhere = array(
            'MEMBER_ETC_PAY_IDX' => $this->input->post('etc_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('MEMBER_ETC_PAY', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function modMember() {
//        if ($this->input->post('ins_type', true) == 'T') {
//            $updateMemberArray = array(
//                'NAME' => $this->input->post('name', true),
//                'PHONE' => $this->input->post('phone', true),
//                'INS_TYPE' => $this->input->post('ins_type', true),
//                'TIMESTAMP' => date("Y-m-d H:i:s", time())
//            );
//        } else if ($this->input->post('ins_type', true) == 'D') {
        $updateMemberArray = array(
            'NAME' => $this->input->post('name', true),
            'PHONE' => str_replace('-', '', $this->input->post('phone', true)),
            'INS_TYPE' => $this->input->post('ins_type', true),
        );
//        }

        $updateWhere = array(
            'MEMBER_IDX' => $this->input->post('member_idx')
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('MEMBER', $updateMemberArray, $updateWhere, 'DRIVING_ZONE');

        if ($this->input->post('in_test_yn', true) == 'Y') {
            $ins_test_yn = 'Y';
        } else {
            $ins_test_yn = 'N';
        }

        if ($this->input->post('road_test_yn', true) == 'Y') {
            $road_test_yn = 'Y';
        } else {
            $road_test_yn = 'N';
        }

        $test_site_sql = "SELECT
                            TEST_SITE_IDX, 
                            DEL_YN 
                          FROM 
                            TEST_SITE 
                          WHERE 
                            NAME = '" . $this->input->post('test_site', true) . "'";

        $test_site_res = $this->Db_m->getInfo($test_site_sql, 'DRIVING_ZONE');

        if ($this->input->post('test_site', true)) {
            if ($test_site_res) {
                $test_site = $test_site_res->TEST_SITE_IDX;
                if ($test_site_res->DEL_YN == 'Y') {
                    $updateArray = array(
                        'DEL_YN' => 'N'
                    );

                    $updateWhere = array(
                        'TEST_SITE_IDX' => $test_site_res->TEST_SITE_IDX
                    );

                    $this->Db_m->update('TEST_SITE', $updateArray, $updateWhere, 'DRIVING_ZONE');
                }
            } else {
                $insTestSiteArray = array(
                    'NAME' => $this->input->post('test_site', true)
                );

                $this->Db_m->insData('TEST_SITE', $insTestSiteArray, 'DRIVING_ZONE');
                $test_site = $this->DRIVING_ZONE->insert_id();
            }
        } else {
            $test_site = null;
        }

        $this->load->library('upload');

        $file['img'] = $this->input->post('org_img', true);
        $file['origin_name'] = '';

        if ($this->input->post('file_type', true) == 'W') {
            $url_path = "/uploads/memberImg";
            $img_path = uniqid() . '.jpg';
            $upload_path = $_SERVER['DOCUMENT_ROOT'] . $url_path . '/' . $img_path;

            $binary_data = base64_decode($_POST['file']);
            file_put_contents($upload_path, $binary_data);

            $info = $this->upload->data();

            $file['img'] = $url_path . "/" . $img_path;
            $file['origin_name'] = $img_path;
        } else {

            if (@$_FILES['file']['name']) {
                $url_path = "/uploads/memberImg";
                $upload_config = Array(
                    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . $url_path,
                    'allowed_types' => 'gif|jpg|jpeg|png|bmp',
                    'encrypt_name' => TRUE,
                    'max_size' => '512000'
                );
                $this->upload->initialize($upload_config);
                $upfile = $_FILES['file']['name'];
                if (!$this->upload->do_upload('file')) {
                    echo $this->upload->display_errors();
                }
                $info = $this->upload->data();
                $file['img'] = $url_path . "/" . $info['file_name'];
                $file['origin_name'] = $info['orig_name'];
            }
        }

        if ($this->input->post('final_yn', true) == 'Y') {
            $final_yn = 'Y';
            $chk_final_sql = "SELECT
                                FINAL_DATE 
                              FROM 
                                MEMBER_DEFAULT 
                              WHERE 
                                MEMBER_IDX = '" . $this->input->post('member_idx') . "'";

            $chk_final_res = $this->Db_m->getInfo($chk_final_sql, 'DRIVING_ZONE');

            if (!$chk_final_res->FINAL_DATE) {
                $final_date = date('Y-m-d');
            } else {
                $final_date = $chk_final_res->FINAL_DATE;
            }
        } else {
            $final_yn = 'N';
            $final_date = null;
        }

        if ($this->input->post('proceeding_yn', true) == 'Y') {
            $proceeding_yn = 'Y';
        } else {
            $proceeding_yn = 'N';
        }


        if (!$this->input->post('birth', true)) {
            $birth = null;
        } else {
            $birth = $this->input->post('birth', true);
        }

        if (!$this->input->post('in_test_date', true)) {
            $in_test_date = null;
        } else {
            $in_test_date = $this->input->post('in_test_date', true) . ' ' . $this->input->post('in_test_time', true) . ':' . $this->input->post('in_test_min', true);
        }

        if (!$this->input->post('road_test_date', true)) {
            $road_test_date = null;
        } else {
            $road_test_date = $this->input->post('road_test_date', true) . ' ' . $this->input->post('road_test_time', true) . ':' . $this->input->post('road_test_min', true);
        }

        $delWhere = array(
            'MEMBER_IDX' => $this->input->post('member_idx')
        );

        $update_member_default_array = array(
            'BIRTH' => $birth,
            'ADDR' => $this->input->post('addr', true),
            'DETAIL_ADDR' => $this->input->post('detail_addr', true),
            'IN_ROUTE_COMMENT' => $this->input->post('in_route_comment', true),
            'PRACTICE_COMMENT' => $this->input->post('practice_comment', true),
            'IN_TEST_YN' => $ins_test_yn,
            'IN_TEST_DATE' => $in_test_date,
            'ROAD_TEST_YN' => $road_test_yn,
            'ROAD_TEST_DATE' => $road_test_date,
            'TEST_SITE_IDX' => $test_site,
            'IMG' => $file['img'],
            'FINAL_YN' => $final_yn,
            'FINAL_DATE' => $final_date,
            'PROCEEDING_YN' => $proceeding_yn
//            'COMMENT' => $this->input->post('comment', true)
        );

        $this->Db_m->update('MEMBER_DEFAULT', $update_member_default_array, $delWhere, 'DRIVING_ZONE');

        $member_goods_sql = "SELECT
                                MEMBER_GOODS_IDX,
                                MEMBER_IDX, 
                                GOODS_IDX, 
                                PAYMENT_IDX, 
                                TOT_PRICE,
                                PAY_YN, 
                                TIMESTAMP 
                             FROM 
                                MEMBER_GOODS 
                             WHERE 
                                MEMBER_IDX = '" . $this->input->post('member_idx') . "'";

        $member_goods_res = $this->Db_m->getList($member_goods_sql, 'DRIVING_ZONE');

        $member_goods_event_sql = "SELECT
                                        MEMBER_IDX, 
                                        MEMBER_GOODS_IDX, 
                                        EVENT_IDX, 
                                        TIMESTAMP 
                                   FROM 
                                        MEMBER_EVENT 
                                   WHERE 
                                        MEMBER_IDX = '" . $this->input->post('member_idx') . "'";

        $member_event_res = $this->Db_m->getList($member_goods_event_sql, 'DRIVING_ZONE');

        $member_memo_sql = "SELECT
                                MEMBER_MEMO_IDX,
                                MEMBER_IDX, 
                                DATE, 
                                CONTENTS, 
                                TIMESTAMP 
                             FROM 
                                MEMBER_MEMO 
                             WHERE 
                                MEMBER_IDX = '" . $this->input->post('member_idx') . "'";

        $member_memo_res = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');

        $this->Db_m->delete('MEMBER_GOODS', $delWhere, 'DRIVING_ZONE');

        if ($member_goods_res) {
            foreach ($member_goods_res as $row) {
                $insMemberGoodsArray[] = array(
                    'MEMBER_GOODS_IDX' => $row['MEMBER_GOODS_IDX'],
                    'MEMBER_IDX' => $row['MEMBER_IDX'],
                    'GOODS_IDX' => $row['GOODS_IDX'],
                    'PAYMENT_IDX' => $row['PAYMENT_IDX'],
                    'TOT_PRICE' => $row['TOT_PRICE'],
                    'PAY_YN' => $row['PAY_YN'],
                    'TIMESTAMP' => $row['TIMESTAMP']
                );
            }

            $this->Db_m->insMultiData('MEMBER_GOODS', $insMemberGoodsArray, 'DRIVING_ZONE');
        }

        if ($member_event_res) {
            foreach ($member_event_res as $row) {
                $insMemberEventArray[] = array(
                    'MEMBER_IDX' => $row['MEMBER_IDX'],
                    'MEMBER_GOODS_IDX' => $row['MEMBER_GOODS_IDX'],
                    'EVENT_IDX' => $row['EVENT_IDX'],
                    'TIMESTAMP' => $row['TIMESTAMP']
                );
            }

            $this->Db_m->insMultiData('MEMBER_EVENT', $insMemberEventArray, 'DRIVING_ZONE');
        }

        if ($this->input->post('goods_idx', true)) {
            for ($i = 0; $i < count($this->input->post('goods_idx', true)); $i++) {

                $insMemberGoodsArray2 = array(
                    'MEMBER_IDX' => $this->input->post('member_idx'),
                    'GOODS_IDX' => $this->input->post('goods_idx', true)[$i],
                    'PAYMENT_IDX' => $this->input->post('payment_idx', true)[$i],
                    'TOT_PRICE' => $this->input->post('tot_price', true)[$i],
                    'PAY_YN' => $this->input->post('pay_yn', true)[$i]
                );

                $this->Db_m->insData('MEMBER_GOODS', $insMemberGoodsArray2, 'DRIVING_ZONE');
                $ins_goods_idx = $this->DRIVING_ZONE->insert_id();

                if ($this->input->post('event_idx')[$i]) {
                    $insMemberEventArray2 = array(
                        'MEMBER_IDX' => $this->input->post('member_idx'),
                        'MEMBER_GOODS_IDX' => $ins_goods_idx,
                        'EVENT_IDX' => $this->input->post('event_idx')[$i]
                    );

                    $this->Db_m->insData('MEMBER_EVENT', $insMemberEventArray2, 'DRIVING_ZONE');
                }
            }
        }

        $this->Db_m->delete('MEMBER_MEMO', $delWhere, 'DRIVING_ZONE');

        if ($this->input->post('date', true)) {
            for ($i = 0; $i < count($this->input->post('date', true)); $i++) {
                $insMemberMemoArray2[] = array(
                    'MEMBER_IDX' => $this->input->post('member_idx'),
                    'DATE' => $this->input->post('date', true)[$i],
                    'CONTENTS' => $this->input->post('comment', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_MEMO', $insMemberMemoArray2, 'DRIVING_ZONE');
        }

        //예약이있는지 체크
        $booking_sql = "SELECT
                            COUNT(*) CNT 
                        FROM 
                            BOOKING_DETAIL 
                        WHERE 
                            MEMBER_IDX = '" . $this->input->post('member_idx') . "' AND
                            GOODS_IDX IS NULL";

        $booking_res = $this->Db_m->getInfo($booking_sql, 'DRIVING_ZONE');

        if ($booking_res->CNT > 0) {

            $member_goods_sql = "SELECT
                                    MG.GOODS_IDX
                                 FROM 
                                    MEMBER_GOODS MG 
                                 WHERE 
                                    MG.MEMBER_IDX = '" . $this->input->post('member_idx') . "'
                                    ORDER BY MEMBER_GOODS_IDX DESC LIMIT 0, 1";

            $member_goods_res = $this->Db_m->getInfo($member_goods_sql, 'DRIVING_ZONE');

            if ($member_goods_res) {
                $updateBookingArray = array(
                    'GOODS_IDX' => $member_goods_res->GOODS_IDX
                );

                $this->Db_m->update('BOOKING_DETAIL', $updateBookingArray, $delWhere, 'DRIVING_ZONE');
            }
        }


        $this->Db_m->delete('MEMBER_ETC_PAY', $delWhere, 'DRIVING_ZONE');

        if ($this->input->post('etc_pay_name', true)) {
            for ($i = 0; $i < count($this->input->post('etc_pay_name', true)); $i++) {
                $insMemberEtcPayArray2[] = array(
                    'MEMBER_IDX' => $this->input->post('member_idx'),
                    'NAME' => $this->input->post('etc_pay_name', true)[$i],
                    'PRICE' => $this->input->post('etc_pay_price', true)[$i],
                    'DATE' => $this->input->post('etc_pay_date', true)[$i],
                    'PAY_YN' => $this->input->post('etc_pay_yn', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_ETC_PAY', $insMemberEtcPayArray2, 'DRIVING_ZONE');
        }

        $this->Db_m->delete('MEMBER_VISIT_ROUTE', $delWhere, 'DRIVING_ZONE');

        if ($this->input->post('visit_route_idx', true)) {
            for ($i = 0; $i < count($this->input->post('visit_route_idx', true)); $i++) {
                $ins_member_visit_route[] = array(
                    'MEMBER_IDX' => $this->input->post('member_idx'),
                    'VISIT_ROUTE_IDX' => $this->input->post('visit_route_idx', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_VISIT_ROUTE', $ins_member_visit_route, 'DRIVING_ZONE');
        }

        $this->Db_m->delete('MEMBER_PRACTICE', $delWhere, 'DRIVING_ZONE');

        if ($this->input->post('practice_idx', true)) {
            for ($i = 0; $i < count($this->input->post('practice_idx', true)); $i++) {
                $ins_member_practice[] = array(
                    'MEMBER_IDX' => $this->input->post('member_idx'),
                    'PRACTICE_IDX' => $this->input->post('practice_idx', true)[$i]
                );
            }

            $this->Db_m->insMultiData('MEMBER_PRACTICE', $ins_member_practice, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            if ($this->input->post('location_name', true) == 'member') {
                alert("데이터 처리오류!!", '/index/member');
            } else if ($this->input->post('location_name', true) == 'member_delete') {
                alert("데이터 처리오류!!", '/index/member_delete');
            } else {
                alert("데이터 처리오류!!", '/index/calender');
            }
        } else {
            if ($this->input->post('location_name', true) == 'member') {
                alert("회원수정 되었습니다.", '/index/member');
            } else if ($this->input->post('location_name', true) == 'member_delete') {
                alert("회원수정 되었습니다.", '/index/member_delete');
            } else {
                alert("회원수정 되었습니다.", '/index/calender');
            }
        }
    }

    function delMember() {

        $getBookingIdx = "SELECT
                            B.BOOKING_IDX
                          FROM 
                            BOOKING B, BOOKING_DETAIL BD 
                          WHERE 
                            B.BOOKING_IDX = BD.BOOKING_IDX AND 
                            BD.MEMBER_IDX IN(" . $this->input->post('idx', true) . ")
                            GROUP BY B.BOOKING_IDX";

        $booking_idx_res = $this->Db_m->getList($getBookingIdx, 'DRIVING_ZONE');

        $sql = "DELETE
                FROM
                    MEMBER
                WHERE 
                    MEMBER_IDX IN(" . $this->input->post('idx', true) . ")";


        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        foreach ($booking_idx_res as $row) {
            $delWhere = array(
                'BOOKING_IDX' => $row['BOOKING_IDX']
            );

            $this->Db_m->delete('BOOKING', $delWhere, 'DRIVING_ZONE');
        }


        $this->DRIVING_ZONE->query($sql);

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
            exit;
        } else {
            echo 'SUCCESS';
            exit;
        }
    }

    function delTmpMember() {

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $exp_idx = explode(',', $this->input->post('idx', true));

        if ($exp_idx) {
            for ($i = 0; $i < count($exp_idx); $i++) {
                $updateArray[] = array(
                    'MEMBER_IDX' => $exp_idx[$i],
                    'STATUS' => 'Y'
                );
            }

            $this->Db_m->modMultiData('MEMBER', $updateArray, 'MEMBER_IDX', 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
            exit;
        } else {
            echo 'SUCCESS';
            exit;
        }
    }

    function memberRestore() {
        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $exp_idx = explode(',', $this->input->post('idx', true));

        if ($exp_idx) {
            for ($i = 0; $i < count($exp_idx); $i++) {
                $updateArray[] = array(
                    'MEMBER_IDX' => $exp_idx[$i],
                    'STATUS' => 'N'
                );
            }

            $this->Db_m->modMultiData('MEMBER', $updateArray, 'MEMBER_IDX', 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
            exit;
        } else {
            echo 'SUCCESS';
            exit;
        }
    }

    function memberAutoComplete() {
        $sql = "SELECT
                    NAME 
                FROM 
                    MEMBER 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        $result = array();
        foreach ($res as $row) {
            $result[] = array(
                'name' => $row['NAME']
            );
        }

        echo json_encode($result);
    }

    function chkDate() {
        $sdate = $this->input->post('sdate', true);
//        $sdate_plus_30min = date("Y-m-d H:i:s", strtotime("$sdate +60 minutes"));
//        $sdate_mainer_30min = date("Y-m-d H:i:s", strtotime("$sdate -60 minutes"));

        $edate = $this->input->post('edate', true);
//        $edate_plus_30min = date("Y-m-d H:i:s", strtotime("$edate +60 minutes"));
//        $edate_mainer_30min = date("Y-m-d H:i:s", strtotime("$edate -60 minutes"));

        $sql = "SELECT
                    MI.MACHINE_INFO_IDX, 
                    MI.ID
                FROM 
                    MACHINE_INFO MI
                WHERE 
                    MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                    MI.MACHINE_INFO_IDX NOT IN (
                    SELECT
                        MI.MACHINE_INFO_IDX
                    FROM 
                        MACHINE_INFO MI 
                        LEFT JOIN 
                          BOOKING_DETAIL BD
                          ON
                          BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX
                        LEFT JOIN 
                          BOOKING B 
                          ON 
                          BD.BOOKING_IDX = B.BOOKING_IDX
                    WHERE 
                        MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$edate') OR
                        (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$sdate')
                    )";

//        echo $sql;exit;

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        $data = '<option value="">등록 가능한 기기가 없습니다.</option>';
        if ($res) {
            $data = '<option value="">기기를 선택해주세요.</option>';
            foreach ($res as $row) {
                $data .= '<option value="' . $row['MACHINE_INFO_IDX'] . '">' . $row['ID'] . '</option>';
            }
        }

        echo $data;
    }

    function getMemberInfo() {
        $sql = "SELECT
                    M.MEMBER_IDX,
                    M.PHONE, 
                    G.GOODS_NAME,
                    G.GOODS_IDX,
                    (
                        SELECT 
                            MD.COMMENT 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = M.MEMBER_IDX
                    ) COMMENT,
                    (
                        SELECT 
                            CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT
                        FROM 
                            MEMBER_GOODS MG, GOODS G 
                        WHERE 
                            MG.GOODS_IDX = G.GOODS_IDX AND 
                            MG.MEMBER_IDX = M.MEMBER_IDX 
                            ORDER BY MG.TIMESTAMP DESC LIMIT 0, 1
                    ) LICENSE_TYPE_TEXT
                FROM 
                    MEMBER M 
                    LEFT JOIN 
                        MEMBER_GOODS MG 
                        ON 
                        M.MEMBER_IDX = MG.MEMBER_IDX 
                    LEFT JOIN 
                        GOODS G 
                        ON 
                        G.GOODS_IDX = MG.GOODS_IDX
                WHERE
                    M.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'
                    ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1";

        $result = array();

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $member_memo_sql = "SELECT
                                    MM.MEMBER_MEMO_IDX,
                                    MM.DATE,
                                    MM.CONTENTS
                                FROM 
                                    MEMBER M, MEMBER_MEMO MM
                                WHERE 
                                    M.MEMBER_IDX = MM.MEMBER_IDX AND
                                    MM.MEMBER_IDX = '" . $res->MEMBER_IDX . "'";
        $member_memo = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');

        $memo_text = '';
        if ($member_memo) {
            foreach ($member_memo as $row) {
                $memo_text .= '<div class="form-inline mb5">
                                        <input type="text" class="form-control modify_comment_date" value="' . $row['DATE'] . '" readonly >
                                        <input type="text" class="form-control modify_comment_text" value="' . $row['CONTENTS'] . '"  readonly >
                                   </div>';
            }
        }




        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'PHONE' => $res->PHONE,
                'COMMENT' => $memo_text,
                'GOODS_NAME' => $res->GOODS_NAME,
                'LICENSE_TYPE_TEXT' => $res->LICENSE_TYPE_TEXT,
                'GOODS_IDX' => $res->GOODS_IDX
            );
        } else {
            $result = array(
                'RESULT' => 'NO_DATA'
            );
        }

        echo json_encode($result);
    }

    function chkDupleMember() {
        $sql = "SELECT
                    COUNT(*) CNT 
                FROM 
                    MEMBER 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                    PHONE = '" . str_replace('-', '', $this->input->post('phone', true)) . "' AND
                    PHONE <> 01000000000";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($res->CNT > 0) {
            echo 'DUPLE';
        } else if ($res->CNT == 0) {
            echo 'SUCCESS';
        }
    }

    function insBooking() {

        $sdate = $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00';
//        $sdate_plus_30min = date("Y-m-d H:i:s", strtotime("$sdate +60 minutes"));
//        $sdate_mainer_30min = date("Y-m-d H:i:s", strtotime("$sdate -60 minutes"));

        $edate = $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00';
//        $edate_plus_30min = date("Y-m-d H:i:s", strtotime("$edate +60 minutes"));
//        $edate_mainer_30min = date("Y-m-d H:i:s", strtotime("$edate -60 minutes"));

        $sql = "SELECT
                    MI.MACHINE_INFO_IDX, 
                    MI.ID
                FROM 
                    MACHINE_INFO MI
                WHERE 
                    MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                    MI.MACHINE_INFO_IDX = '" . $this->input->post('machine_info_idx', true) . "' AND
                    MI.MACHINE_INFO_IDX NOT IN (
                    SELECT
                        MI.MACHINE_INFO_IDX
                    FROM 
                        MACHINE_INFO MI 
                        LEFT JOIN 
                          BOOKING_DETAIL BD
                          ON
                          BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX
                        LEFT JOIN 
                          BOOKING B 
                          ON 
                          BD.BOOKING_IDX = B.BOOKING_IDX
                    WHERE 
                        MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$edate') OR
                        (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$sdate')
                    )";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        if ($this->input->post('type', true) == 'B') {
            if (!$res) {
                alert('이미 등록된 예약이 있습니다.', '/index/calender');
                exit;
            }

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
                                MG.MEMBER_IDX = '" . $this->input->post('member_name', true) . "'
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
                                    BD.MEMBER_IDX = '" . $this->input->post('member_name', true) . "'";

            $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');

            if ($goods_chk_res) {
                if ($goods_chk_res->GOODS_TYPE == 'T') {
                    //회원의 전체 상품 내역중 시간형 상품만 가져와서 시간형 상품의 종합시간값
                    $member_tot_time_sql = "SELECT 
                                            SUM(TG.GOODS_TIME) * 60 GOODS_TIME 
                                        FROM 
                                            MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                        WHERE 
                                            MG.GOODS_IDX = G.GOODS_IDX AND 
                                            G.GOODS_IDX = TG.GOODS_IDX AND 
                                            MG.MEMBER_IDX = '" . $this->input->post('member_name', true) . "'";

                    $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

                    $diff_minute = (strtotime($edate) - strtotime($sdate)) / 60;

//                echo '토탈시간 ->'.$member_tot_time_res->GOODS_TIME.'<br>';
//                echo '예약토탈시간 ->'.$member_time_res->SUM_TIME.'<br>';
//                echo '입력된시간 ->'.$diff_minute.'<br>';

                    if ($member_tot_time_res->GOODS_TIME < ($member_time_res->SUM_TIME + $diff_minute)) {
//                    echo $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                        $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                        $time1 = (int) ($minute / 60);
                        $time2 = $minute % 60;
                        alert("예약시간이 초과합니다. 잔여시간은 " . $time1 . "시간 " . $time2 . "분 입니다.", '/index/calender');
                        exit;
                    }
                }
            }
        }

        $insBookingArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true),
            'TYPE' => $this->input->post('type', true),
            'BOOKING_SDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00',
            'BOOKING_EDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00',
            'CONTENTS' => $this->input->post('contents', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('BOOKING', $insBookingArray, 'DRIVING_ZONE');

        $member_default_idx = 0;

        if ($this->input->post('type', true) == 'B') {
            $ins_id = $this->DRIVING_ZONE->insert_id();

            if ($this->input->post('member_type', true) == 'M') {

                if (!$this->input->post('goods_idx', true)) {
                    $member_goods_idx = NULL;
                } else {
                    $member_goods_idx = $this->input->post('goods_idx', true);
                }

                $insBookingDetailArray = array(
                    'BOOKING_IDX' => $ins_id,
                    'MACHINE_INFO_IDX' => $this->input->post('machine_info_idx', true),
                    'MEMBER_IDX' => $this->input->post('member_name', true),
                    'GOODS_IDX' => $member_goods_idx
                );

                //회원 히스토리
                $history_sql = "SELECT
                                    MEMBER_IDX,
                                    BOOKING_HISTORY 
                                FROM 
                                    MEMBER_DEFAULT 
                                WHERE 
                                    MEMBER_IDX = '" . $this->input->post('member_name', true) . "'";
            }

            if ($this->input->post('member_type', true) == 'J') {

                $insMemberArray = array(
                    'BRANCH_IDX' => $this->input->post('branch_idx', true),
                    'NAME' => $this->input->post('member_ins_name', true),
                    'PHONE' => str_replace('-', '', $this->input->post('phone', true)),
                    'INS_TYPE' => 'T',
                    'TYPE' => 'N'
                );

                $this->Db_m->insData('MEMBER', $insMemberArray, 'DRIVING_ZONE');
                $ins_member_id = $this->DRIVING_ZONE->insert_id();

                if (!$this->input->post('goods_idx', true)) {
                    $member_goods_idx = NULL;
                    $member_payment_idx = NULL;
                    $member_tot_price = 0;
                } else if ($this->input->post('goods_idx', true) == '') {
                    $member_goods_idx = NULL;
                    $member_payment_idx = NULL;
                    $member_tot_price = 0;
                } else {
                    $member_goods_idx = $this->input->post('goods_idx', true);
                    $member_payment_idx = $this->input->post('payment_idx', true);
                    $member_tot_price = $this->input->post('tot_price', true);

                    $insMemberGoodsArray = array(
                        'MEMBER_IDX' => $ins_member_id,
                        'GOODS_IDX' => $member_goods_idx,
                        'PAYMENT_IDX' => $member_payment_idx,
                        'TOT_PRICE' => $member_tot_price
                    );

                    $this->Db_m->insData('MEMBER_GOODS', $insMemberGoodsArray, 'DRIVING_ZONE');
                    $ins_goods_idx = $this->DRIVING_ZONE->insert_id();

                    if (!$this->input->post('event_idx', true)) {
                        $member_event_idx = NULL;
                    } else if ($this->input->post('event_idx', true) == '') {
                        $member_event_idx = NULL;
                    } else {
                        $member_event_idx = $this->input->post('event_idx', true);

                        $insMemberEventArray = array(
                            'MEMBER_IDX' => $ins_member_id,
                            'MEMBER_GOODS_IDX' => $ins_goods_idx,
                            'EVENT_IDX' => $member_event_idx
                        );
                        $this->Db_m->insData('MEMBER_EVENT', $insMemberEventArray, 'DRIVING_ZONE');
                    }
                }

                $insMemberDefaultArray = array(
                    'MEMBER_IDX' => $ins_member_id
                );
                $this->Db_m->insData('MEMBER_DEFAULT', $insMemberDefaultArray, 'DRIVING_ZONE');

                $insBookingDetailArray = array(
                    'BOOKING_IDX' => $ins_id,
                    'MACHINE_INFO_IDX' => $this->input->post('machine_info_idx', true),
                    'MEMBER_IDX' => $ins_member_id,
                    'GOODS_IDX' => $member_goods_idx
                );

                //비회원 히스토리
                $history_sql = "SELECT
                                    MEMBER_IDX,
                                    BOOKING_HISTORY 
                                FROM 
                                    MEMBER_DEFAULT 
                                WHERE 
                                    MEMBER_IDX = '" . $ins_member_id . "'";
            }


            if ($this->input->post('member_type', true) == 'N') {

                $insMemberArray = array(
                    'BRANCH_IDX' => $this->input->post('branch_idx', true),
                    'NAME' => $this->input->post('member_ins_name', true),
                    'PHONE' => str_replace('-', '', $this->input->post('phone', true)),
                    'INS_TYPE' => 'T',
                    'TYPE' => 'Y'
                );

                $this->Db_m->insData('MEMBER', $insMemberArray, 'DRIVING_ZONE');
                $ins_member_id = $this->DRIVING_ZONE->insert_id();

                if (!$this->input->post('goods_idx', true)) {
                    $member_goods_idx = NULL;
                    $member_payment_idx = NULL;
                    $member_tot_price = 0;
                } else if ($this->input->post('goods_idx', true) == '') {
                    $member_goods_idx = NULL;
                    $member_payment_idx = NULL;
                    $member_tot_price = 0;
                } else {
                    $member_goods_idx = $this->input->post('goods_idx', true);
                    $member_payment_idx = $this->input->post('payment_idx', true);
                    $member_tot_price = $this->input->post('tot_price', true);

                    $insMemberGoodsArray = array(
                        'MEMBER_IDX' => $ins_member_id,
                        'GOODS_IDX' => $member_goods_idx,
                        'PAYMENT_IDX' => $member_payment_idx,
                        'TOT_PRICE' => $member_tot_price
                    );

                    $this->Db_m->insData('MEMBER_GOODS', $insMemberGoodsArray, 'DRIVING_ZONE');
                    $ins_goods_idx = $this->DRIVING_ZONE->insert_id();

                    if (!$this->input->post('event_idx', true)) {
                        $member_event_idx = NULL;
                    } else if ($this->input->post('event_idx', true) == '') {
                        $member_event_idx = NULL;
                    } else {
                        $member_event_idx = $this->input->post('event_idx', true);

                        $insMemberEventArray = array(
                            'MEMBER_IDX' => $ins_member_id,
                            'MEMBER_GOODS_IDX' => $ins_goods_idx,
                            'EVENT_IDX' => $member_event_idx
                        );
                        $this->Db_m->insData('MEMBER_EVENT', $insMemberEventArray, 'DRIVING_ZONE');
                    }
                }

                $insMemberDefaultArray = array(
                    'MEMBER_IDX' => $ins_member_id
                );
                $this->Db_m->insData('MEMBER_DEFAULT', $insMemberDefaultArray, 'DRIVING_ZONE');

                $insBookingDetailArray = array(
                    'BOOKING_IDX' => $ins_id,
                    'MACHINE_INFO_IDX' => $this->input->post('machine_info_idx', true),
                    'MEMBER_IDX' => $ins_member_id,
                    'GOODS_IDX' => $member_goods_idx
                );

                //비회원 히스토리
                $history_sql = "SELECT
                                    MEMBER_IDX,
                                    BOOKING_HISTORY 
                                FROM 
                                    MEMBER_DEFAULT 
                                WHERE 
                                    MEMBER_IDX = '" . $ins_member_id . "'";
            }

            $this->Db_m->insData('BOOKING_DETAIL', $insBookingDetailArray, 'DRIVING_ZONE');

            $history_res = $this->Db_m->getInfo($history_sql, 'DRIVING_ZONE');
            $modHistoryArray = array(
                'BOOKING_HISTORY' => $history_res->BOOKING_HISTORY . '<br>' . $this->input->post('booking_date') . '/' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . '~' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ' 예약 하셨습니다.'
            );

            $modHistoryWhere = array(
                'MEMBER_IDX' => $history_res->MEMBER_IDX
            );

            $this->Db_m->update('MEMBER_DEFAULT', $modHistoryArray, $modHistoryWhere, 'DRIVING_ZONE');

            $member_default_idx = $history_res->MEMBER_IDX;
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/calender');
        } else {
            if ($member_default_idx != 0) {
                alert("예약 되었습니다.", '/index/calender?mdibx=' . $member_default_idx);
            } else {
                alert("예약 되었습니다.", '/index/calender');
            }
        }
    }

    function getEvent() {
        $sql = "SELECT
                    B.BOOKING_IDX,
                    MI.ID,
                    B.TYPE,
                    B.BOOKING_SDATE,
                    B.BOOKING_EDATE,
                    (
                        SELECT 
                            M.NAME 
                        FROM 
                            MEMBER M 
                        WHERE 
                            M.MEMBER_IDX = BD.MEMBER_IDX
                    ) NAME,
                    (
                        SELECT 
                            M.TYPE 
                        FROM 
                            MEMBER M 
                        WHERE 
                            M.MEMBER_IDX = BD.MEMBER_IDX
                    ) MEMBER_TYPE,
                    (
                        SELECT 
                            G.GOODS_TYPE
                        FROM 
                            GOODS G 
                        WHERE 
                            G.GOODS_IDX = BD.GOODS_IDX 
                    ) GOODS_TYPE,
                    BD.GOODS_IDX,
                    DATEDIFF(
                        (
                            SELECT 
                                IN_TEST_DATE 
                            FROM 
                                MEMBER_DEFAULT MD
                            WHERE 
                                MD.MEMBER_IDX = BD.MEMBER_IDX
                        ), B.BOOKING_SDATE
                    ) IN_TEST_LIMIT,
                    DATEDIFF(
                        (
                            SELECT 
                                ROAD_TEST_DATE 
                            FROM 
                                MEMBER_DEFAULT MD
                            WHERE 
                                MD.MEMBER_IDX = BD.MEMBER_IDX
                        ), B.BOOKING_SDATE
                    ) ROAD_TEST_LIMIT,
                    (
                        SELECT 
                            IN_TEST_DATE 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) IN_TEST_DATE,
                    (
                        SELECT 
                            ROAD_TEST_DATE 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) ROAD_TEST_DATE,
                    BD.MEMBER_IDX,
                    BD.ABSENT_YN,
                    B.CONTENTS
                FROM 
                    BOOKING B
                    LEFT JOIN 
                        BOOKING_DETAIL BD 
                        ON 
                        B.BOOKING_IDX = BD.BOOKING_IDX 
                    LEFT JOIN 
                        MACHINE_INFO MI 
                        ON 
                        BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX
                WHERE 
                    B.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";
        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        $result = array();

        foreach ($res as $row) {

            $member_memo_cnt_sql = "SELECT
                                        COUNT(*) CNT 
                                    FROM 
                                        MEMBER_MEMO 
                                    WHERE 
                                        MEMBER_IDX = '" . $row['MEMBER_IDX'] . "' AND DATE >= NOW()";

            $member_memo_cnt = $this->Db_m->getInfo($member_memo_cnt_sql, 'DRIVING_ZONE');

            if ($row['NAME']) {

                $name = $row['NAME'];
                $title = '';
                if (($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 0) && ($row['ROAD_TEST_LIMIT'] == 0 || $row['ROAD_TEST_LIMIT'] == 0) && $row['IN_TEST_DATE'] && $row['ROAD_TEST_DATE']) {
//                    기능,주행시험
                    $title = '[시험]';
                } else if (($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 0) && $row['IN_TEST_DATE']) {
//                    기능시험
                    $title = '[시험]';
                } else if (($row['ROAD_TEST_LIMIT'] == 0 || $row['ROAD_TEST_LIMIT'] == 0) && $row['ROAD_TEST_DATE']) {
//                    주행시험
                    $title = '[시험]';
                }
            } else {
                $title = '상담';
            }

            if ($member_memo_cnt->CNT > 0) {
                $title .= '[메모]';
            }

            if ($row['ID']) {

                $idx = explode('-', $row['ID']);
            } else {
                $idx = explode('-', '-');
            }

            //상담
            if ($row['TYPE'] == 'C') {
                $color = 'bg_orange device' . $idx[1] . '';
            }
            //보장형
            else if ($row['GOODS_TYPE'] == 'G') {
                $color = 'bg_red device' . $idx[1] . '';
            }
            //시간제
            else if ($row['GOODS_TYPE'] == 'T') {
                $color = 'bg_yellow device' . $idx[1] . '';

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

                $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                $time1 = (int) ($minute / 60);
                $time2 = $minute % 60;
                if ($time1 <= 2) {
                    $title .= '[시간제]';
                }
            }
            //코스형
            else if ($row['GOODS_TYPE'] == 'C') {
                $color = 'bg_green device' . $idx[1] . '';
            }
            //상품없음
            else if (!$row['GOODS_IDX']) {
                $color = 'bg_blue device' . $idx[1] . '';
            }
            // 비회원
            if ($row['MEMBER_TYPE'] == 'Y') {
                $color = 'bg_nMember device' . $idx[1] . '';
            }
            // 결석
            if ($row['ABSENT_YN'] === 'Y') {
                $color = 'bg_gray device' . $idx[1] . '';
            }


            //회원의 상품에 미납있는지 체크
            $goods_chk_sql = "SELECT
                                COUNT(*) CNT
                              FROM 
                                MEMBER_GOODS MG
                              WHERE 
                                MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "' AND
                                MG.PAY_YN = 'Y'";

            $goods_chk_res = $this->Db_m->getInfo($goods_chk_sql, 'DRIVING_ZONE');

            //회원의 상품에 미납있는지 체크
            $etc_pay_chk_sql = "SELECT
                                COUNT(*) CNT
                              FROM 
                                MEMBER_ETC_PAY
                              WHERE 
                                MEMBER_IDX = '" . $row['MEMBER_IDX'] . "' AND
                                PAY_YN = 'Y'";

            $etc_pay_chk_res = $this->Db_m->getInfo($etc_pay_chk_sql, 'DRIVING_ZONE');

            if ($goods_chk_res->CNT > 0 || $etc_pay_chk_res->CNT > 0) {
                $title .= '[미납]';
            }

            if($row['CONTENTS']){
                $color .= ' bd_red';
            }

            $result[] = array(
                'id' => $row['BOOKING_IDX'],
                'title' => $name . ' ' . '<p class="text_red">' . $title . '</p>',
                'className' => $color,
                'start' => $row['BOOKING_SDATE'],
                'end' => $row['BOOKING_EDATE'],
                'allDay' => false
            );
        }

        print_r(json_encode($result));
    }

    function getBookingInfo() {
        $sql = "SELECT
                    B.BOOKING_IDX,
                    MI.ID,
                    B.TYPE,
                    DATE_FORMAT(B.BOOKING_SDATE, '%Y-%m-%d') DATE,
                    DATE_FORMAT(B.BOOKING_SDATE, '%H시 %i분') STIME,
                    DATE_FORMAT(B.BOOKING_EDATE, '%H시 %i분') ETIME,
                    (
                        SELECT 
                            M.MEMBER_IDX 
                        FROM 
                            MEMBER M 
                        WHERE 
                            M.MEMBER_IDX = BD.MEMBER_IDX
                    ) MEMBER_IDX,
                    (
                        SELECT 
                            M.NAME 
                        FROM 
                            MEMBER M 
                        WHERE 
                            M.MEMBER_IDX = BD.MEMBER_IDX
                    ) NAME,
                    (
                        SELECT 
                            M.PHONE 
                        FROM 
                            MEMBER M 
                        WHERE 
                            M.MEMBER_IDX = BD.MEMBER_IDX
                    ) PHONE,
                    (
                        SELECT 
                            CONCAT(G.GOODS_NAME, ' / ', CASE LICENSE_TYPE  WHEN '1' THEN '1종'  WHEN '2' THEN '2종'  WHEN 'B' THEN '대형' END, IF(MG.PAY_YN = 'Y', ' [미납]', ''))
                        FROM 
                            MEMBER_GOODS MG, GOODS G
                        WHERE 
                            MG.GOODS_IDX = G.GOODS_IDX AND
                            MG.MEMBER_IDX = BD.MEMBER_IDX AND
                            BD.GOODS_IDX = G.GOODS_IDX
                        ORDER BY MG.MEMBER_GOODS_IDX DESC LIMIT 0, 1
                    ) GOODS_NAME,
                    (
                        SELECT 
                            MD.IN_TEST_DATE 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) IN_TEST_DATE,
                    (
                        SELECT 
                            MD.ROAD_TEST_DATE 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) ROAD_TEST_DATE,
                    (
                        SELECT 
                            MD.IMG 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) IMG,
                    (
                        SELECT 
                            MD.COMMENT 
                        FROM 
                            MEMBER_DEFAULT MD
                        WHERE 
                            MD.MEMBER_IDX = BD.MEMBER_IDX
                    ) COMMENT,
                    B.CONTENTS,
                    BD.ABSENT_YN
                FROM 
                    BOOKING B
                    LEFT JOIN 
                        BOOKING_DETAIL BD 
                        ON 
                        B.BOOKING_IDX = BD.BOOKING_IDX 
                    LEFT JOIN 
                        MACHINE_INFO MI 
                        ON 
                        BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX
                WHERE 
                    B.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                    B.BOOKING_IDX = '" . $this->input->post('idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $member_memo_sql = "SELECT
                                    MM.MEMBER_MEMO_IDX,
                                    MM.DATE,
                                    MM.CONTENTS
                                FROM 
                                    BOOKING_DETAIL BD, MEMBER_MEMO MM
                                WHERE 
                                    BD.MEMBER_IDX = MM.MEMBER_IDX AND
                                    BD.BOOKING_IDX = '" . $res->BOOKING_IDX . "'";
        $member_memo = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');

        $memo_text = '';
        if ($member_memo) {
            foreach ($member_memo as $row) {
                $memo_text .= '<div class="form-inline mb5">
                                        <input type="text" class="form-control modify_comment_date" value="' . $row['DATE'] . '" readonly >
                                        <input type="text" class="form-control modify_comment_text" value="' . $row['CONTENTS'] . '"  readonly >
                                   </div>';
            }
        }


        $result = array();

        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'DATE' => $res->DATE,
                'STIME' => $res->STIME,
                'ETIME' => $res->ETIME,
                'ID' => $res->ID,
                'MEMO' => $memo_text,
                'IMG' => $res->IMG,
                'COMMENT' => $res->COMMENT,
                'MEMBER_IDX' => $res->MEMBER_IDX,
                'NAME' => $res->NAME,
                'PHONE' => $res->PHONE,
                'GOODS_NAME' => $res->GOODS_NAME,
                'IN_TEST_DATE' => $res->IN_TEST_DATE,
                'ROAD_TEST_DATE' => $res->ROAD_TEST_DATE,
                'CONTENTS' => $res->CONTENTS,
                'ABSENT_YN' => $res->ABSENT_YN
            );
        } else {
            $result = array(
                'RESULT' => 'FAILED'
            );
        }

        print_r(json_encode($result));
    }

    function modMemberView() {
        $sql = "SELECT
                    BRANCH_IDX,
                    NAME 
                FROM 
                    BRANCH 
                WHERE 
                    BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";

        $data['info'] = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

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
                                M.MEMBER_IDX = '" . $this->input->post('member_idx') . "' AND
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'";


        $data['member_lists'] = $this->Db_m->getInfo($member_lists_sql, 'DRIVING_ZONE');


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
                                    MG.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";
        $data['member_goods'] = $this->Db_m->getList($member_goods_sql, 'DRIVING_ZONE');

        $member_etc_pay_sql = "SELECT
                                        MEMBER_ETC_PAY_IDX,
                                        NAME, 
                                        PRICE,
                                        DATE,
                                        PAY_YN
                                   FROM 
                                        MEMBER_ETC_PAY 
                                   WHERE 
                                        MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";
        $data['member_etc_pay'] = $this->Db_m->getList($member_etc_pay_sql, 'DRIVING_ZONE');

        $member_memo_sql = "SELECT
                                    MEMBER_MEMO_IDX,
                                    DATE,
                                    CONTENTS
                                FROM 
                                    MEMBER_MEMO
                                WHERE 
                                    MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";
        $data['member_memo'] = $this->Db_m->getList($member_memo_sql, 'DRIVING_ZONE');


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
                                            MVR.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

        $data['member_visit_route'] = $this->Db_m->getList($member_visit_route_sql, 'DRIVING_ZONE');


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
                                            MP.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

        $data['member_practice'] = $this->Db_m->getList($member_practice_sql, 'DRIVING_ZONE');

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
                                MG.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'
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
                                    BD.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

        $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');

        //회원의 전체 상품 내역중 시간형 상품만 가져와서 시간형 상품의 종합시간값
        $member_tot_time_sql = "SELECT 
                                        (SUM(TG.GOODS_TIME) * 60) GOODS_TIME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        G.GOODS_IDX = TG.GOODS_IDX AND 
                                        MG.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

        $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

        if ($goods_chk_res) {
            if ($goods_chk_res->GOODS_TYPE == 'T') {
//                    echo $row['NAME'].$member_tot_time_res->GOODS_TIME.'<br>';
//                    echo $row['NAME'].$member_time_res->SUM_TIME.'<br>';
                $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                $time1 = (int) ($minute / 60);
                $time2 = $minute % 60;
                $data['time' . $this->input->post('member_idx', true)] = "잔여시간 " . $time1 . "시간 " . $time2 . "분";
            } else {

                //회원의 예약했던 시간의 합
                $member_time_sql = "SELECT 
                                        SUM(TIMESTAMPDIFF(MINUTE, BOOKING_SDATE, BOOKING_EDATE)) SUM_TIME
                                    FROM 
                                        BOOKING B, BOOKING_DETAIL BD, GOODS G
                                    WHERE
                                        B.BOOKING_IDX = BD.BOOKING_IDX AND
                                        BD.GOODS_IDX = G.GOODS_IDX AND
                                        BD.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

                $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');
                $minute = $member_time_res->SUM_TIME;
                $time1 = (int) ($minute / 60);
                $time2 = $minute % 60;

                $data['time' . $this->input->post('member_idx', true)] = "누적시간 " . $time1 . "시간 " . $time2 . "분";
            }
        } else {
            $data['time' . $this->input->post('member_idx', true)] = "";
        }

        $this->load->view('appointment/modmember', $data);
    }

    function modBooking() {
        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $sdate = $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00';
//        $sdate_plus_30min = date("Y-m-d H:i:s", strtotime("$sdate +60 minutes"));
//        $sdate_mainer_30min = date("Y-m-d H:i:s", strtotime("$sdate -60 minutes"));

        $edate = $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00';
//        $edate_plus_30min = date("Y-m-d H:i:s", strtotime("$edate +60 minutes"));
//        $edate_mainer_30min = date("Y-m-d H:i:s", strtotime("$edate -60 minutes"));

        $type_sql = "SELECT
                        BOOKING_IDX,
                        BRANCH_IDX,
                        TYPE,
                        BOOKING_SDATE,
                        BOOKING_EDATE,
                        CONTENTS,
                        TIMESTAMP
                     FROM 
                        BOOKING 
                     WHERE 
                        BOOKING_IDX = '" . $this->input->post('booking_idx', true) . "'";

        $type_res = $this->Db_m->getInfo($type_sql, 'DRIVING_ZONE');

        $detail_sql = "SELECT
                            MACHINE_INFO_IDX,
                            MEMBER_IDX,
                            GOODS_IDX,
                            TIMESTAMP
                        FROM 
                            BOOKING_DETAIL 
                        WHERE 
                            BOOKING_IDX = '" . $this->input->post('booking_idx', true) . "'";

        $detail_res = $this->Db_m->getInfo($detail_sql, 'DRIVING_ZONE');

        if ($type_res->TYPE == 'B' && $sdate == $type_res->BOOKING_SDATE && $edate == $type_res->BOOKING_EDATE) {


            $updateArray = array(
                'BOOKING_SDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00',
                'BOOKING_EDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00',
                'CONTENTS' => $this->input->post('contents', true)
            );

            $updateWhere = array(
                'BOOKING_IDX' => $this->input->post('booking_idx', true)
            );

            $this->Db_m->update('BOOKING', $updateArray, $updateWhere, 'DRIVING_ZONE');
        } else if ($type_res->TYPE == 'B') {

            $insBookingArray = array(
                'BOOKING_IDX' => $type_res->BOOKING_IDX,
                'BRANCH_IDX' => $type_res->BRANCH_IDX,
                'TYPE' => $type_res->TYPE,
                'BOOKING_SDATE' => $type_res->BOOKING_SDATE,
                'BOOKING_EDATE' => $type_res->BOOKING_EDATE,
                'CONTENTS' => $type_res->CONTENTS,
                'TIMESTAMP' => $type_res->TIMESTAMP
            );

            $insBookingDetailArray = array(
                'BOOKING_IDX' => $type_res->BOOKING_IDX,
                'MACHINE_INFO_IDX' => $detail_res->MACHINE_INFO_IDX,
                'MEMBER_IDX' => $detail_res->MEMBER_IDX,
                'GOODS_IDX' => $detail_res->GOODS_IDX,
                'TIMESTAMP' => $detail_res->TIMESTAMP
            );

            $member_sql = "SELECT
                            MEMBER_IDX 
                           FROM 
                            BOOKING_DETAIL 
                           WHERE 
                            BOOKING_IDX = '" . $type_res->BOOKING_IDX . "'";
            $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

            $delWhere = array(
                'BOOKING_IDX' => $this->input->post('booking_idx', true)
            );

            $this->Db_m->delete('BOOKING', $delWhere, 'DRIVING_ZONE');

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
                                MG.MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'
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
                                    BD.MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

            $member_time_res = $this->Db_m->getInfo($member_time_sql, 'DRIVING_ZONE');

            // 캘린더에서 비회원의 일정을 수정할시 상품이 없기 때문에 에러가 남
            if ($goods_chk_res) {

                if ($goods_chk_res->GOODS_TYPE == 'T') {
                    //회원의 전체 상품 내역중 시간형 상품만 가져와서 시간형 상품의 종합시간값
                    $member_tot_time_sql = "SELECT 
                                                SUM(TG.GOODS_TIME) * 60 GOODS_TIME 
                                            FROM 
                                                MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                            WHERE 
                                                MG.GOODS_IDX = G.GOODS_IDX AND 
                                                G.GOODS_IDX = TG.GOODS_IDX AND 
                                                MG.MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

                    $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

                    $diff_minute = (strtotime($edate) - strtotime($sdate)) / 60;

                    //                echo '토탈시간 ->' . $member_tot_time_res->GOODS_TIME . '<br>';
                    //                echo '예약토탈시간 ->' . $member_time_res->SUM_TIME . '<br>';
                    //                echo '입력된시간 ->' . $diff_minute . '<br>';

                    if ($member_tot_time_res->GOODS_TIME < ($member_time_res->SUM_TIME + $diff_minute)) {

                        $this->Db_m->insData('BOOKING', $insBookingArray, 'DRIVING_ZONE');
                        $this->Db_m->insData('BOOKING_DETAIL', $insBookingDetailArray, 'DRIVING_ZONE');

                        //                    echo $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                        $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                        $time1 = (int) ($minute / 60);
                        $time2 = $minute % 60;
                        alert("예약시간이 초과합니다. 잔여시간은 " . $time1 . "시간 " . $time2 . "분 입니다.", '/index/calender');
                        exit;
                    }
                }
            }

            $sql = "SELECT
                        MI.MACHINE_INFO_IDX, 
                        MI.ID
                    FROM 
                        MACHINE_INFO MI
                    WHERE 
                        MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                        MI.ID = '" . $this->input->post('machine_info_idx', true) . "' AND
                        MI.MACHINE_INFO_IDX NOT IN (
                        SELECT
                            MI.MACHINE_INFO_IDX
                        FROM 
                            MACHINE_INFO MI 
                            LEFT JOIN 
                              BOOKING_DETAIL BD
                              ON
                              BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX
                            LEFT JOIN 
                              BOOKING B 
                              ON 
                              BD.BOOKING_IDX = B.BOOKING_IDX
                        WHERE 
                            MI.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$edate') OR
                            (B.BOOKING_SDATE < '$edate' AND B.BOOKING_EDATE > '$sdate')
                        )";
//        echo $sql;
            $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

            if (!$res) {

                $this->Db_m->insData('BOOKING', $insBookingArray, 'DRIVING_ZONE');
                $this->Db_m->insData('BOOKING_DETAIL', $insBookingDetailArray, 'DRIVING_ZONE');
                alert('이미 등록된 예약이 있습니다.', '/index/calender');
                exit;
            }

            $insBookingArray2 = array(
                'BRANCH_IDX' => $type_res->BRANCH_IDX,
                'TYPE' => $type_res->TYPE,
                'BOOKING_SDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00',
                'BOOKING_EDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00',
                'CONTENTS' => $this->input->post('contents', true)
            );

            $this->Db_m->insData('BOOKING', $insBookingArray2, 'DRIVING_ZONE');
            $ins_id = $this->DRIVING_ZONE->insert_id();

            $insBookingDetailArray2 = array(
                'BOOKING_IDX' => $ins_id,
                'MACHINE_INFO_IDX' => $detail_res->MACHINE_INFO_IDX,
                'MEMBER_IDX' => $detail_res->MEMBER_IDX,
                'GOODS_IDX' => $detail_res->GOODS_IDX
            );

            $this->Db_m->insData('BOOKING_DETAIL', $insBookingDetailArray2, 'DRIVING_ZONE');

            //회원 히스토리
            $history_sql = "SELECT
                                MEMBER_IDX,
                                BOOKING_HISTORY 
                            FROM 
                                MEMBER_DEFAULT 
                            WHERE 
                                MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

            $history_res = $this->Db_m->getInfo($history_sql, 'DRIVING_ZONE');
            $modHistoryArray = array(
                'BOOKING_HISTORY' => $history_res->BOOKING_HISTORY . '<br>' . $this->input->post('booking_date') . '/' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . '~' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ' 예약수정.'
            );

            $modHistoryWhere = array(
                'MEMBER_IDX' => $history_res->MEMBER_IDX
            );

            $this->Db_m->update('MEMBER_DEFAULT', $modHistoryArray, $modHistoryWhere, 'DRIVING_ZONE');
        } else {
            $updateArray = array(
                'BOOKING_SDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('stime') . ':' . $this->input->post('stime_min') . ':00',
                'BOOKING_EDATE' => $this->input->post('booking_date') . ' ' . $this->input->post('etime') . ':' . $this->input->post('etime_min') . ':00',
                'CONTENTS' => $this->input->post('contents', true)
            );

            $updateWhere = array(
                'BOOKING_IDX' => $this->input->post('booking_idx', true)
            );

            $this->Db_m->update('BOOKING', $updateArray, $updateWhere, 'DRIVING_ZONE');
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/calender');
        } else {
            alert("수정 되었습니다.", '/index/calender');
        }
    }

    function delBooking() {

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $delWhere = array(
            'BOOKING_IDX' => $this->input->post('idx', true)
        );

        $type_sql = "SELECT
                        BOOKING_IDX,
                        TYPE,
                        DATE_FORMAT(BOOKING_SDATE, '%Y-%m-%d') B_DATE,
                        DATE_FORMAT(BOOKING_SDATE, '%H:%i') B_STIME,
                        DATE_FORMAT(BOOKING_EDATE, '%H:%i') B_ETIME
                     FROM 
                        BOOKING 
                     WHERE 
                        BOOKING_IDX = '" . $this->input->post('idx', true) . "'";

        $type_res = $this->Db_m->getInfo($type_sql, 'DRIVING_ZONE');

        if (@$type_res->TYPE == 'B') {

            $member_sql = "SELECT
                            MEMBER_IDX 
                           FROM 
                            BOOKING_DETAIL 
                           WHERE 
                            BOOKING_IDX = '" . $type_res->BOOKING_IDX . "'";
            $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

            if ($member_res) {
                //회원 히스토리
                $history_sql = "SELECT
                                MEMBER_IDX,
                                BOOKING_HISTORY 
                            FROM 
                                MEMBER_DEFAULT 
                            WHERE 
                                MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

                $history_res = $this->Db_m->getInfo($history_sql, 'DRIVING_ZONE');
                $modHistoryArray = array(
                    'BOOKING_HISTORY' => $history_res->BOOKING_HISTORY . '<br>' . $type_res->B_DATE . '/' . $type_res->B_STIME . '~' . $type_res->B_ETIME . ' 예약 취소.'
                );

                $modHistoryWhere = array(
                    'MEMBER_IDX' => $history_res->MEMBER_IDX
                );

                $this->Db_m->update('MEMBER_DEFAULT', $modHistoryArray, $modHistoryWhere, 'DRIVING_ZONE');
            }
        }

        $this->Db_m->delete('BOOKING', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function absentBooking() {
        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $updateArray = array(
            'ABSENT_YN' => 'Y'
        );

        $updateWhere = array(
            'BOOKING_IDX' => $this->input->post('idx', true)
        );

        $this->Db_m->update('BOOKING_DETAIL', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $type_sql = "SELECT
                        BOOKING_IDX,
                        TYPE,
                        DATE_FORMAT(BOOKING_SDATE, '%Y-%m-%d') B_DATE,
                        DATE_FORMAT(BOOKING_SDATE, '%H:%i') B_STIME,
                        DATE_FORMAT(BOOKING_EDATE, '%H:%i') B_ETIME
                     FROM 
                        BOOKING 
                     WHERE 
                        BOOKING_IDX = '" . $this->input->post('idx', true) . "'";

        $type_res = $this->Db_m->getInfo($type_sql, 'DRIVING_ZONE');

        if (@$type_res->TYPE == 'B') {

            $member_sql = "SELECT
                            MEMBER_IDX 
                           FROM 
                            BOOKING_DETAIL 
                           WHERE 
                            BOOKING_IDX = '" . $type_res->BOOKING_IDX . "'";
            $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

            if ($member_res) {
                //회원 히스토리
                $history_sql = "SELECT
                                MEMBER_IDX,
                                BOOKING_HISTORY 
                            FROM 
                                MEMBER_DEFAULT 
                            WHERE 
                                MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

                $history_res = $this->Db_m->getInfo($history_sql, 'DRIVING_ZONE');
                $modHistoryArray = array(
                    'BOOKING_HISTORY' => $history_res->BOOKING_HISTORY . '<br>' . $type_res->B_DATE . '/' . $type_res->B_STIME . '~' . $type_res->B_ETIME . ' 결석.'
                );

                $modHistoryWhere = array(
                    'MEMBER_IDX' => $history_res->MEMBER_IDX
                );

                $this->Db_m->update('MEMBER_DEFAULT', $modHistoryArray, $modHistoryWhere, 'DRIVING_ZONE');

                //회원메모 추가
                $insMemoArray = array(
                    'MEMBER_IDX' => $member_res->MEMBER_IDX,
                    'DATE' => $type_res->B_DATE,
                    'CONTENTS' => '결석'
                );

                $this->Db_m->insData('MEMBER_MEMO', $insMemoArray, 'DRIVING_ZONE');
            }
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function disAbsentBooking() {
        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $updateArray = array(
            'ABSENT_YN' => 'N'
        );

        $updateWhere = array(
            'BOOKING_IDX' => $this->input->post('idx', true)
        );

        $this->Db_m->update('BOOKING_DETAIL', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $type_sql = "SELECT
                        BOOKING_IDX,
                        TYPE,
                        DATE_FORMAT(BOOKING_SDATE, '%Y-%m-%d') B_DATE,
                        DATE_FORMAT(BOOKING_SDATE, '%H:%i') B_STIME,
                        DATE_FORMAT(BOOKING_EDATE, '%H:%i') B_ETIME
                     FROM 
                        BOOKING 
                     WHERE 
                        BOOKING_IDX = '" . $this->input->post('idx', true) . "'";

        $type_res = $this->Db_m->getInfo($type_sql, 'DRIVING_ZONE');

        if (@$type_res->TYPE == 'B') {

            $member_sql = "SELECT
                            MEMBER_IDX 
                           FROM 
                            BOOKING_DETAIL 
                           WHERE 
                            BOOKING_IDX = '" . $type_res->BOOKING_IDX . "'";
            $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

            if ($member_res) {
                //회원 히스토리
                $history_sql = "SELECT
                                MEMBER_IDX,
                                BOOKING_HISTORY 
                            FROM 
                                MEMBER_DEFAULT 
                            WHERE 
                                MEMBER_IDX = '" . $member_res->MEMBER_IDX . "'";

                $history_res = $this->Db_m->getInfo($history_sql, 'DRIVING_ZONE');
                $modHistoryArray = array(
                    'BOOKING_HISTORY' => $history_res->BOOKING_HISTORY . '<br>' . $type_res->B_DATE . '/' . $type_res->B_STIME . '~' . $type_res->B_ETIME . ' 결석취소.'
                );

                $modHistoryWhere = array(
                    'MEMBER_IDX' => $history_res->MEMBER_IDX
                );

                $this->Db_m->update('MEMBER_DEFAULT', $modHistoryArray, $modHistoryWhere, 'DRIVING_ZONE');

                //회원메모 추가
                $insMemoArray = array(
                    'MEMBER_IDX' => $member_res->MEMBER_IDX,
                    'DATE' => $type_res->B_DATE,
                    'CONTENTS' => '결석취소'
                );

                $this->Db_m->insData('MEMBER_MEMO', $insMemoArray, 'DRIVING_ZONE');
            }
        }

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function calendaerViewMemberInfo() {
        $sql = "SELECT 
                    M.MEMBER_IDX,
                    B.NAME BRANCH_NAME,
                    M.NAME,
                    MD.BIRTH,
                    MD.ADDR,
                    MD.DETAIL_ADDR,
                    M.PHONE,
                    M.TIMESTAMP,
                    (
                        SELECT 
                            G.GOODS_NAME 
                        FROM 
                            MEMBER_GOODS MG, GOODS G 
                        WHERE 
                            MG.GOODS_IDX = G.GOODS_IDX AND 
                            MG.MEMBER_IDX = M.MEMBER_IDX 
                            ORDER BY MG.TIMESTAMP DESC LIMIT 0, 1
                    ) GOODS_NAME,
                    (
                        SELECT 
                            CASE
                            LICENSE_TYPE 
                                WHEN '1' THEN '1종' 
                                WHEN '2' THEN '2종' 
                                WHEN 'B' THEN '대형' 
                            END LICENSE_TYPE_TEXT
                        FROM 
                            MEMBER_GOODS MG, GOODS G 
                        WHERE 
                            MG.GOODS_IDX = G.GOODS_IDX AND 
                            MG.MEMBER_IDX = M.MEMBER_IDX 
                            ORDER BY MG.TIMESTAMP DESC LIMIT 0, 1
                    ) LICENSE_TYPE_TEXT,
                    IN_TEST_YN,
                    IN_TEST_DATE,
                    ROAD_TEST_YN,
                    ROAD_TEST_DATE,
                    TS.NAME TS_NAME,
                    MD.IMG,
                    CASE 
                        FINAL_YN 
                        WHEN 'Y' THEN '합격'
                        WHEN 'N' THEN '-'
                    END FINAL_YN,
                    MD.COMMENT,
                    MD.BOOKING_HISTORY
                FROM 
                    MEMBER M, MEMBER_DEFAULT MD 
                        LEFT JOIN 
                            TEST_SITE TS 
                            ON 
                            MD.TEST_SITE_IDX = TS.TEST_SITE_IDX
                    , BRANCH B
                WHERE 
                    M.BRANCH_IDX = B.BRANCH_IDX AND
                    M.MEMBER_IDX = MD.MEMBER_IDX AND
                    M.MEMBER_IDX = '" . $this->input->post('member_idx', true) . "'";

        $res = $this->Db_m->getInfo($sql, 'DRIVING_ZONE');

        $etc_price_sql = "SELECT
                            NAME,
                            PRICE 
                          FROM 
                            MEMBER_ETC_PAY 
                          WHERE 
                            MEMBER_IDX = '" . $res->MEMBER_IDX . "'";

        $etc_price_res = $this->Db_m->getList($etc_price_sql, 'DRIVING_ZONE');

        $etc_price = "";
        foreach ($etc_price_res as $row) {
            $etc_price .= $row['NAME'] . '/' . number_format($row['PRICE']) . '원' . '<br>';
        }

        $member_visit_route_sql = "SELECT
                                        VR.NAME 
                                   FROM 
                                        MEMBER_VISIT_ROUTE MVR, VISIT_ROUTE VR 
                                   WHERE 
                                        MVR.VISIT_ROUTE_IDX = VR.VISIT_ROUTE_IDX AND 
                                        MVR.MEMBER_IDX = '" . $res->MEMBER_IDX . "'";

        $member_visit_route_res = $this->Db_m->getList($member_visit_route_sql, 'DRIVING_ZONE');

        $member_visit_route = "";

        foreach ($member_visit_route_res as $row) {
            $member_visit_route .= $row['NAME'] . ',';
        }

        $member_practice_sql = "SELECT
                                    P.NAME 
                                FROM 
                                    MEMBER_PRACTICE MP, PRACTICE P 
                                WHERE 
                                    MP.PRACTICE_IDX = P.PRACTICE_IDX AND 
                                    MP.MEMBER_IDX = '" . $res->MEMBER_IDX . "'";

        $member_practice_res = $this->Db_m->getList($member_practice_sql, 'DRIVING_ZONE');

        $member_practice = "";

        foreach ($member_practice_res as $row) {
            $member_practice .= $row['NAME'] . ',';
        }

        $result = array();

        if ($res) {
            $result = array(
                'RESULT' => 'SUCCESS',
                'BRANCH_NAME' => $res->BRANCH_NAME,
                'NAME' => $res->NAME,
                'BIRTH' => $res->BIRTH,
                'ADDR' => $res->ADDR,
                'DETAIL_ADDR' => $res->DETAIL_ADDR,
                'PHONE' => $res->PHONE,
                'TIMESTAMP' => $res->TIMESTAMP,
                'GOODS_NAME' => $res->GOODS_NAME,
                'LICENSE_TYPE_TEXT' => $res->LICENSE_TYPE_TEXT,
                'ETC_PRICE' => $etc_price,
                'MEMBER_VISIT_ROUTE' => substr($member_visit_route, 0, -1),
                'MEMBER_PRACTICE' => substr($member_practice, 0, -1),
                'IN_TEST_YN' => $res->IN_TEST_YN,
                'IN_TEST_DATE' => $res->IN_TEST_DATE,
                'ROAD_TEST_YN' => $res->ROAD_TEST_YN,
                'ROAD_TEST_DATE' => $res->ROAD_TEST_DATE,
                'TS_NAME' => $res->TS_NAME,
                'IMG' => $res->IMG,
                'FINAL_YN' => $res->FINAL_YN,
                'COMMENT' => $res->COMMENT,
                'BOOKING_HISTORY' => $res->BOOKING_HISTORY
            );
        } else {
            $result = array(
                'RESULT' => 'FAILED'
            );
        }

        print_r(json_encode($result));
    }

    function insBoard() {
        $insArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true),
            'TITLE' => $this->input->post('title', true),
            'CONTENTS' => $this->input->post('contents', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('BOARD', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/board_write');
        } else {
            alert('게시글 등록 되었습니다.', '/index/board');
        }
    }

    function modBoard() {
        $updateArray = array(
            'TITLE' => $this->input->post('title', true),
            'CONTENTS' => $this->input->post('contents', true)
        );

        $updateWhere = array(
            'BOARD_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('BOARD', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/board_modify/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        } else {
            alert('게시글 수정 되었습니다.', '/index/board_view/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        }
    }

    function delBoard() {
        $delWhere = array(
            'BOARD_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('BOARD', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function modPrivacy() {

        //일단 본점 관리자만이 전체 지점 약관을 총괄함 바뀔시 해당부와 쿼리 처리부 주석필요
//        $sql = "UPDATE BRANCH SET PRIVACY = '" . $this->input->post('privacy', true) . "'";
        //개별로 할시 주석 부분 사용
        $updateArray = array(
            'PRIVACY' => $this->input->post('privacy', true)
        );

        $updateWhere = array(
            'BRANCH_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back
        $this->Db_m->update('BRANCH', $updateArray, $updateWhere, 'DRIVING_ZONE');

//        $this->DRIVING_ZONE->query($sql);

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/privacy');
        } else {
            alert("개인정보 수집동의 약관이 적용되었습니다.", '/index/privacy');
        }
    }

    function modRefunds() {
        //일단 본점 관리자만이 전체 지점 약관을 총괄함 바뀔시 해당부와 쿼리 처리부 주석필요
//        $sql = "UPDATE BRANCH SET REFUNDS = '" . $this->input->post('refunds', true) . "'";
        //개별로 할시 주석 부분 사용
        $updateArray = array(
            'REFUNDS' => $this->input->post('refunds', true)
        );

        $updateWhere = array(
            'BRANCH_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back
        $this->Db_m->update('BRANCH', $updateArray, $updateWhere, 'DRIVING_ZONE');

//        $this->DRIVING_ZONE->query($sql);

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/refunds');
        } else {
            alert("환급정책 약관이 적용되었습니다.", '/index/refunds');
        }
    }

    function consult_memo() {
        $this->load->view('appointment/consult_memo');
    }

    function insQuestionBoard() {
        $insArray = array(
            'BRANCH_IDX' => $this->input->post('branch_idx', true),
            'TITLE' => $this->input->post('title', true),
            'CONTENTS' => $this->input->post('contents', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->insData('QUESTION_BOARD', $insArray, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert("데이터 처리오류!!", '/index/question_board_write');
        } else {
            alert("문의 등록 되었습니다.", '/index/question_board');
        }
    }

    function delQuestionBoard() {
        $delWhere = array(
            'QUESTION_BOARD_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->delete('QUESTION_BOARD', $delWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function insBoardAnswer() {
        $updateArray = array(
            'ANSWER' => $this->input->post('answer', true),
            'A_TIMESTAMP' => date("Y-m-d H:i:s", time())
        );

        $updateWhere = array(
            'QUESTION_BOARD_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('QUESTION_BOARD', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/question_board_answer/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        } else {
            alert('답변 작성 되었습니다.', '/index/question_board_view/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        }
    }

    function modQuestionBoard() {
        $updateArray = array(
            'TITLE' => $this->input->post('title', true),
            'CONTENTS' => $this->input->post('contents', true)
        );

        $updateWhere = array(
            'QUESTION_BOARD_IDX' => $this->input->post('idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('QUESTION_BOARD', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            alert('데이터 처리오류!!', '/index/question_board_modify/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        } else {
            alert('문의 수정 되었습니다.', '/index/question_board_view/' . $this->input->post('idx', true) . '/' . $this->input->post('gubun', true) . '/' . $this->input->post('text', true) . '/' . $this->input->post('page', true) . '');
        }
    }

    function memExcelDown() {
        ini_set('memory_limit', '-1');

        $add_where = "";

        if ($this->input->get('branch_idx', true) && $this->input->get('branch_idx', true) !== '1') {
            $add_where .= "AND B.BRANCH_IDX = '" . $this->input->get('branch_idx', true) . "'";
        }

        if ($this->input->get('sdate', true) && $this->input->get('edate', true)) {
            $add_where .= "AND DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') BETWEEN '" . $this->input->get('sdate', true) . "' AND '" . $this->input->get('edate', true) . "'";
        }

        $sql = "SELECT
                    B.NAME,
                    M.NAME MEMBER_NAME,
                    DATE_FORMAT(MD.BIRTH, '%Y-%m-%d') BIRTH,
                    CONCAT(MD.ADDR, ' ', MD.DETAIL_ADDR) TOT_ADDR,
                    M.PHONE,
                    M.TIMESTAMP
                FROM 
                    MEMBER M, MEMBER_DEFAULT MD, BRANCH B 
                WHERE 
                    M.MEMBER_IDX = MD.MEMBER_IDX AND 
                    M.BRANCH_IDX = B.BRANCH_IDX ";
        $sql .= $add_where;
        $sql .= " ORDER BY M.TIMESTAMP DESC";

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        header("Content-type: application/vnd.ms-excel");
        header("Content-type: application/x-msexcel; charset=utf-8");
        header("Content-Disposition: attachment; filename = 회원리스트.xls");
        header("Content-Description: PHP4 Generated Data");

        echo " 
            <meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel;charset=utf-8\"> 
            <TABLE border='1'>
                <TR>
                    <TD>지점명</TD>
                    <TD>회원명</TD>
                    <TD>생년월일</TD>
                    <TD>주소</TD>
                    <TD>연락처</TD>
                    <TD>가입일</TD>
                </TR>";
        $date = 'mso-number-format:"yyyy-mm-dd"'; //다운로드 서식 날짜 변환
        $number = 'mso-number-format:"\@";'; //다운로드 서식 숫자로 인식시키기

        foreach ($res as $row) {
            echo " 
                <TR>
                    <TD>$row[NAME]</TD>
                    <TD>$row[MEMBER_NAME]</TD>
                    <TD style='$date'>$row[BIRTH]</TD>
                    <TD>$row[TOT_ADDR]</TD>
                    <TD style='$number'>$row[PHONE]</TD>
                    <TD>$row[TIMESTAMP]</TD>
                </TR>";
        }
        echo "</TR>	
            </TABLE>";
    }

    function webcamUpload() {
        $this->load->library('upload');

        $file['img'] = '';
        $file['origin_name'] = '';

        if ($_FILES['file']['name']) {
            $url_path = "/uploads/memberImg";
            $upload_config = Array(
                'upload_path' => $_SERVER['DOCUMENT_ROOT'] . $url_path,
                'allowed_types' => 'gif|jpg|jpeg|png|bmp',
                'encrypt_name' => TRUE,
                'max_size' => '512000'
            );
            $this->upload->initialize($upload_config);
            $upfile = $_FILES['file']['name'];
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
            }
            $info = $this->upload->data();
            $file['img'] = $url_path . "/" . $info['file_name'];
            $file['origin_name'] = $info['orig_name'];
        }
    }

    function sendSms() {

        $member_sql = "SELECT
                        NAME, 
                        PHONE 
                       FROM 
                        MEMBER 
                       WHERE 
                        MEMBER_IDX = '" . $this->input->post('idx', true) . "'";

        $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

        $member_goods_sql = "SELECT 
                                G.GOODS_NAME,
                                MG.TOT_PRICE,
                                MG.TIMESTAMP
                             FROM
                                MEMBER_GOODS MG, GOODS G
                             WHERE 
                                MG.GOODS_IDX = G.GOODS_IDX AND 
                                MG.MEMBER_IDX = '" . $this->input->post('idx', true) . "'
                             ORDER BY MG.GOODS_IDX DESC LIMIT 0, 1";

        $member_goods_res = $this->Db_m->getInfo($member_goods_sql, 'DRIVING_ZONE');

        if (!$member_goods_res) {
            echo 'NO_DATA';
            exit;
        }

        $userkey = "CzlVYw05Dz8BOwcoAThQaFVoDGwGJQRlBns=";
        $userid = "jjheun";
        $phone = $member_res->PHONE;
        $callback = "01090249394";
        $msg = $this->input->post('sms_text', true);
        $send_date = "2011-01-11 00:00:00"; // 예약메세지일 경우 사용하시기 바랍니다.

        $url = "http://link.smsceo.co.kr/sendsms_utf8.php?userkey=" . $userkey;
        $url .= "&userid=" . $userid;
        $url .= "&phone=" . $phone;
        $url .= "&callback=" . $callback;
        $url .= "&msg=" . urlencode($msg);
        $url .= "&send_date=" . $send_date;

        $result = array();
        $result = $this->smsRes($url); // 결과 출력형식을 참고하세요.
//        print_r($result);
//        if (@$result[result_code] == "1") { // 전송성공
//            echo "결과코드 : " . @$result[result_code];
//            echo "메세지 : " . @iconv('euc-kr', 'utf-8', $result[result_msg]);
//            echo "총 접수건수 : " . @$result[total_count];
//            echo "성공건수 : " . @$result[succ_count];
//            echo "실패건수 : " . @$result[fail_count];
//            echo "잔액 : " . @$result[money];
//        } else {
//            echo "결과코드 : " . @$result[result_code];
//            echo "메세지 : " . @$result[result_msg];
//        }

        if (@$result[result_code] == "1") { // 전송성공
            echo "SUCCESS";
        } else {
            echo "FAILED";
        }
    }

    function smsRes($url) {
        $result = file_get_contents($url);
        $result = trim($result);
        parse_str($result, $result_var);

        return $result_var;
    }

    function sendSmsView() {

        $member_sql = "SELECT
                        NAME, 
                        PHONE 
                       FROM 
                        MEMBER 
                       WHERE 
                        MEMBER_IDX = '" . $this->input->post('idx', true) . "'";

        $member_res = $this->Db_m->getInfo($member_sql, 'DRIVING_ZONE');

        $member_goods_sql = "SELECT 
                                G.GOODS_NAME,
                                MG.TOT_PRICE,
                                MG.TIMESTAMP
                             FROM
                                MEMBER_GOODS MG, GOODS G
                             WHERE 
                                MG.GOODS_IDX = G.GOODS_IDX AND 
                                MG.MEMBER_IDX = '" . $this->input->post('idx', true) . "'
                             ORDER BY MG.GOODS_IDX DESC LIMIT 0, 1";

        $member_goods_res = $this->Db_m->getInfo($member_goods_sql, 'DRIVING_ZONE');

        if (!$member_goods_res) {
            $member_goods_name = "상품 없음";
            $member_goods_time = "상품 없음";
            $member_goods_price = "0";
        } else {
            $member_goods_name = $member_goods_res->GOODS_NAME;
            $member_goods_time = $member_goods_res->TIMESTAMP;
            $member_goods_price = $member_goods_res->TOT_PRICE;
        }

        $msg = "" . $member_res->NAME . " / " . $member_goods_name . " / " . $member_goods_time . " / " . number_format($member_goods_price) . "원 등록하셨습니다.";


        if (!$member_goods_res) {
            echo 'NO_DATA';
            exit;
        } else {
            echo $msg;
        }
    }

    function payWhether() {
        $updateArray = array(
            'PAY_YN' => $this->input->post('pay_yn', true)
        );

        $updateWhere = array(
            'MEMBER_GOODS_IDX' => $this->input->post('goods_idx', true)
        );

        $this->DRIVING_ZONE->trans_start(); // Query will be rolled back

        $this->Db_m->update('MEMBER_GOODS', $updateArray, $updateWhere, 'DRIVING_ZONE');

        $this->DRIVING_ZONE->trans_complete();

        if ($this->DRIVING_ZONE->trans_status() === FALSE) {
            echo 'FAILED';
        } else {
            echo 'SUCCESS';
        }
    }

    function statisticsChartTerm() {

        if ($this->input->post('idx', true)) {
            $branch_idx = $this->input->post('idx', true);
        } else {
            $branch_idx = $this->session->userdata('BRANCH_IDX');
        }

        if ($this->input->post('type', true) == 'day') {

            $date = str_replace(' ', '', explode('-', $this->input->post('date', true)));
            $date1 = explode('/', $date[0]);
            $date2 = explode('/', $date[1]);

            $dateWhere1 = $date1[2] . "-" . $date1[0] . "-" . $date1[1];
            $dateWhere2 = $date2[2] . "-" . $date2[0] . "-" . $date2[1];


            $sql = "SELECT 
                        DT.d,
                        IFNULL(TOT_PRICE, 0) TOT_PRICE,
                        IFNULL(MEP_TOT_PRICE, 0) MEP_TOT_PRICE,
                        IFNULL(TOT_PRICE, 0) + IFNULL(MEP_TOT_PRICE, 0) ALL_TOT_PRICE
                    FROM 
                        date_t DT 
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d') MG_DATE,
                            SUM(MG.TOT_PRICE) TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_GOODS MG 
                          WHERE
                            M.MEMBER_IDX = MG.MEMBER_IDX AND 
                            MG.PAY_YN = 'N' AND
                            M.BRANCH_IDX = '" . $branch_idx . "'
                            GROUP BY DATE_FORMAT(MG.TIMESTAMP, '%Y-%m-%d')
                        ) MG
                        ON MG.MG_DATE = DT.d
                        LEFT OUTER JOIN
                        (
                          SELECT 
                            DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d') MEP_DATE,
                            SUM(MEP.PRICE) MEP_TOT_PRICE 
                          FROM 
                            MEMBER M, MEMBER_ETC_PAY MEP 
                          WHERE
                            M.MEMBER_IDX = MEP.MEMBER_IDX AND 
                            M.BRANCH_IDX = '" . $branch_idx . "' AND 
                            MEP.PAY_YN = 'N'
                            GROUP BY DATE_FORMAT(MEP.TIMESTAMP, '%Y-%m-%d')
                        ) MEP
                        ON MEP.MEP_DATE = DT.d
                    WHERE 
                        DT.d BETWEEN '" . $dateWhere1 . "' AND  '" . $dateWhere2 . "'
                    ORDER BY DT.d";

            // echo $sql;
            $member_sql = "SELECT 
                                DT.d,
                                IFNULL(MEMBER_TOT, 0) MEMBER_TOT
                            FROM 
                                date_t DT 
                                LEFT OUTER JOIN
                                (
                                  SELECT 
                                    DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d') M_DATE,
                                    COUNT(*) MEMBER_TOT
                                  FROM 
                                    MEMBER M
                                  WHERE
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "'
                                    GROUP BY DATE_FORMAT(M.TIMESTAMP, '%Y-%m-%d')
                                ) M
                                ON M.M_DATE = DT.d
                            WHERE 
                                TO_DAYS('" . $this->input->post('date', true) . "') - TO_DAYS(DT.d) <= 6
                            ORDER BY DT.d LIMIT 0, 7";
        }

//        echo $sql;

        $res = $this->Db_m->getList($sql, 'DRIVING_ZONE');
        $member_res = $this->Db_m->getList($member_sql, 'DRIVING_ZONE');
//        $tot_price_res = $this->Db_m->getList($tot_price_sql, 'DRIVING_ZONE');


        $result[][] = array();

        foreach ($res as $row) {
            $result['price'][] = array(
                'title' => $row['d'],
                'price' => $row['ALL_TOT_PRICE']
            );
        }

        print_r(json_encode($result));
    }

    function goodsChartTerm() {

        $date = str_replace(' ', '', explode('-', $this->input->post('date', true)));
        $date1 = explode('/', $date[0]);
        $date2 = explode('/', $date[1]);

        $dateWhere1 = $date1[2] . "-" . $date1[0] . "-" . $date1[1];
        $dateWhere2 = $date2[2] . "-" . $date2[0] . "-" . $date2[1];

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
                                    M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                    MG.TIMESTAMP BETWEEN '" . $dateWhere1 . "' AND '" . $dateWhere2 . "'
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
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MG.TIMESTAMP BETWEEN '" . $dateWhere1 . "' AND '" . $dateWhere2 . "'
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
                            M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                            MG.TIMESTAMP BETWEEN '" . $dateWhere1 . "' AND '" . $dateWhere2 . "'
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
                              G1.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                              MG.TIMESTAMP BETWEEN '" . $dateWhere1 . "' AND '" . $dateWhere2 . "'
                        ) GOODS_PRICE
                      FROM 
                        GOODS G 
                      GROUP BY G.GOODS_TYPE";

        $goods_lists = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $goods_name = "";
        foreach ($goods_lists as $row) {
            $goods_name .= "<tr>
                                <td>
                                    <p>" . $row['GOODS_TYPE'] . "</p>
                                </td>
                                <td>
                                    <p>" . $row['SUM_GOODS_PERCENT'] . "% (누적 금액 : " . number_format($row['GOODS_PRICE']) . ")</p>
                                </td>
                            </tr>";
        }

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
                                M.BRANCH_IDX = '" . $this->session->userdata('BRANCH_IDX') . "' AND
                                MG.TIMESTAMP BETWEEN '" . $dateWhere1 . "' AND '" . $dateWhere2 . "'
                            )) SUM_GOODS
                          FROM 
                            GOODS G 
                          GROUP BY G.GOODS_TYPE";

        $goods_res = $this->Db_m->getList($goods_sql, 'DRIVING_ZONE');

        $result[][] = array();

        foreach ($goods_res as $row) {
            $result['goods'][] = array(
                'goods_title' => $row['GOODS_TYPE'],
                'goods_price' => $row['SUM_GOODS']
            );
        }

        $result['goods_name'] = array(
            'goods_name' => $goods_name
        );

        print_r(json_encode($result));
    }

}
