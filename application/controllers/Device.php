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

class Device extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->DRIVING_ZONE = $this->load->database('DRIVING_ZONE', TRUE);

        $this->load->helper(array('url', 'date', 'form', 'alert'));
        $this->load->model('Db_m');
        $this->load->library('session');
    }

    function index() {
        $this->login_machine();
    }

    function login_machine() {
        $this->load->view('login_machine');
    }

    function calender_machine() {

        if (!$this->session->userdata('MACHINE_INFO_IDX')) {
            alert("세션이 만료되었습니다.", '/device');
            exit;
        }

        $sql = "SELECT
                    M.MEMBER_IDX,
                    CONCAT(DATE_FORMAT(B.BOOKING_SDATE, '%H:%i'), '~', DATE_FORMAT(B.BOOKING_EDATE, '%H:%i')) TIME,
                    M.NAME,
                    CASE 
                        G.GOODS_TYPE
                        WHEN 'G' THEN '보장형'
                        WHEN 'T' THEN '시간형'
                        WHEN 'C' THEN '코스형'
                    END TYPE,
                    CASE 
                        G.LICENSE_TYPE
                        WHEN '1' THEN '1종'
                        WHEN '2' THEN '2종'
                        WHEN 'B' THEN '대형'
                    END LICENSE_TYPE,
                    G.GOODS_NAME,
                    DATEDIFF(MD.IN_TEST_DATE, B.BOOKING_SDATE) IN_TEST_LIMIT,
                    DATEDIFF(MD.ROAD_TEST_DATE, B.BOOKING_SDATE) ROAD_TEST_LIMIT,
                    MD.IN_TEST_DATE,
                    MD.ROAD_TEST_DATE,
                    B.CONTENTS
                FROM 
                    BOOKING B, BOOKING_DETAIL BD, MACHINE_INFO MI, MEMBER M, MEMBER_DEFAULT MD, GOODS G 
                WHERE 
                    B.BOOKING_IDX = BD.BOOKING_IDX AND
                    BD.MACHINE_INFO_IDX = MI.MACHINE_INFO_IDX AND
                    BD.MEMBER_IDX = M.MEMBER_IDX AND
                    BD.GOODS_IDX = G.GOODS_IDX AND 
                    M.MEMBER_IDX = MD.MEMBER_IDX AND
                    MI.MACHINE_INFO_IDX = '" . $this->session->userdata('MACHINE_INFO_IDX') . "' AND
                    DATE_FORMAT(B.BOOKING_SDATE, '%Y-%m-%d') = '" . date('Y-m-d') . "' 
                    ORDER BY B.BOOKING_SDATE ASC";
        $data['lists'] = $this->Db_m->getList($sql, 'DRIVING_ZONE');

        foreach ($data['lists'] as $row) {
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
                                        SUM(TG.GOODS_TIME) * 60 GOODS_TIME 
                                    FROM 
                                        MEMBER_GOODS MG, GOODS G, TIME_GOODS TG 
                                    WHERE 
                                        MG.GOODS_IDX = G.GOODS_IDX AND 
                                        G.GOODS_IDX = TG.GOODS_IDX AND 
                                        MG.MEMBER_IDX = '" . $row['MEMBER_IDX'] . "'";

            $member_tot_time_res = $this->Db_m->getInfo($member_tot_time_sql, 'DRIVING_ZONE');

            if ($goods_chk_res->GOODS_TYPE == 'T') {
                $minute = $member_tot_time_res->GOODS_TIME - $member_time_res->SUM_TIME;
                $time1 = (int) ($minute / 60);
                $time2 = $minute % 60;
                $data['time' . $row['MEMBER_IDX']] = "잔여 " . $time1 . "시간 " . $time2 . "분";
            } else {
                $data['time' . $row['MEMBER_IDX']] = "";
            }
        }

        $this->load->view('appointment/calender_machine', $data);
    }

}
