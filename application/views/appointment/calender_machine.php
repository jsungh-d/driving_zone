<!DOCTYPE html>
<html lang="kor">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DrivingZone</title>

    <!-- 스타일 css -->
    <link href="/css/device.css" rel="stylesheet">
    <!-- 제이쿼리 -->
    <script type="text/javascript" src="/vendors/jquery/dist/jquery.min.js"></script>
    <!-- 모멘트 -->
    <script src="/vendors/moment/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/2.2.0/moment-range.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                // Create two variable with the names of the months and days in an array
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

                // Create a newDate() object
                var newDate = new Date();
                // Extract the current date from Date object
                newDate.setDate(newDate.getDate());
                // Output the day, date, month and year  
                $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

                setInterval(function () {
                    // Create a newDate() object and extract the seconds of the current time on the visitor's
                    var seconds = new Date().getSeconds();
                    // Add a leading zero to seconds value
                    $("#sec").html((seconds < 10 ? "0" : "") + seconds);

                    if($("#min").html()=="30" && $("#sec").html()=="01"){
                        location.reload();
                    }
                    if($("#min").html()=="00" && $("#sec").html()=="01"){
                        location.reload();
                    }
                }, 1000);

                setInterval(function () {
                    // Create a newDate() object and extract the minutes of the current time on the visitor's
                    var minutes = new Date().getMinutes();
                    // Add a leading zero to the minutes value
                    $("#min").html((minutes < 10 ? "0" : "") + minutes);
                }, 1000);

                setInterval(function () {
                    // Create a newDate() object and extract the hours of the current time on the visitor's
                    var hours = new Date().getHours();
                    // Add a leading zero to the hours value
                    $("#hours").html((hours < 10 ? "0" : "") + hours);
                }, 1000);
            });
        </script>
        <style>
            /* If you want you can use font-face */
            @font-face {
                font-family: 'BebasNeueRegular';
                src: url('BebasNeue-webfont.eot');
                src: url('BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
                url('BebasNeue-webfont.woff') format('woff'),
                url('BebasNeue-webfont.ttf') format('truetype'),
                url('BebasNeue-webfont.svg#BebasNeueRegular') format('svg');
                font-weight: normal;
                font-style: normal;
            }

            .container {
                width: 960px;
                margin: 0 auto;
                overflow: hidden;
            }

            ul {
                width: 100%;
                margin: 0 auto;
                padding: 0px;
                list-style: none;
                text-align: left;
            }

            ul li {
                display: inline;
                font-size: 51px;
                text-align: center;
                font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
/*                text-shadow: 0 0 5px #00c6ff;
*/            }

            #point {
                position: relative;
                -moz-animation: mymove 1s ease infinite;
                -webkit-animation: mymove 1s ease infinite;
                padding-left: 2px;
                padding-right: 2px;
            }

            /* Simple Animation */
            @-webkit-keyframes mymove {
                0% {opacity: 1.0;
                   /* text-shadow: 0 0 20px #00c6ff;*/
                }

                50% {
                    opacity: 0;
                    text-shadow: none;
                }

                100% {
                    opacity: 1.0;
                    /*text-shadow: 0 0 20px #00c6ff;*/
                }	
            }

            @-moz-keyframes mymove {
                0% {
                    opacity: 1.0;
               /*     text-shadow: 0 0 20px #00c6ff;*/
                }

                50% {
                    opacity: 0;
                    text-shadow: none;
                }

                100% {
                    opacity: 1.0;
               /*     text-shadow: 0 0 20px #00c6ff;*/
                };
            }
        </style>
    </head>
    <body>
        <section class="device">
            <div class="left_box">
                <div class="clock">
                    <h3 class="h2">현재시각</h3>
                    <h2>
                        <ul>
                            <li id="hours"></li>
                            <li id="point">:</li>
                            <li id="min"></li>
                            <li id="point">:</li>
                            <li id="sec"></li>
                        </ul>
                    </h2>
                </div>
                <div class="left_caution">
                    <span class="left_caution_action">!</span>
                    <span class="left_caution_text">
                        사용 전 꼭!<br>
                        관리자에게 알려주세요!
                    </span>
                </div>
                <div class="button_area">
                    <div class="button_area_wrapper">
                        <h6>고수의 운전면허</h6>
                        <p style="font-size:12px; font-weight: 100; margin:10px; letter-spacing: 1px;">Driving Master<p>
                        
                        <button type="button">
                            <a href="webrun:C:\Windows\notepad.exe">
                                시작<br><p style="font-size:12px; font-weight: 100;  letter-spacing: 1px;">Start!<p>
                            </a>
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    <div class="center_box">
        <div class="center_box_top">
            <h5>
                오늘의<br>예약 현황에서<br>
                <strong>자신의 이름</strong>을<br> 확인하세요
            </h5>
        </div>
    </div>
    <div class="right_box">
            <div class="contents_wrapper">
                <h4 style="color: #252142; font-size: 33px; margin-bottom: 30px;"><strong><?= date('Y' . '년' . ' m' . '월' . ' d' . '일') ?></strong> 예약 현황</h4>
                <table>
                    <colspan>
                    <col width="100px"><col width="60px"><col width="60px"><col width="*"><col width="40px"><col width="*"><col width="*"><col width="*">
                </colspan>
                <tbody>
                    <?php foreach ($lists as $row) { ?>
                    <tr>
                        <td><?= $row['TIME'] ?></td>
                        <td><?= $row['NAME'] ?></td>
                        <td><?= $row['TYPE'] ?></td>
                        <td><?= ${'time' . $row['MEMBER_IDX']} ?></td>
                        <td><?= $row['LICENSE_TYPE'] ?></td>
                        <td><?= $row['GOODS_NAME'] ?></td>
                        <td>
                            <?php
                            $title = '';
                            if (($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 1) && ($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 1) && $row['IN_TEST_DATE'] && $row['ROAD_TEST_DATE']) {
                                $title = '[기능,주행시험임박]';
                            } else if (($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 1) && $row['IN_TEST_DATE']) {
                                $title = '[기능시험임박]';
                            } else if (($row['IN_TEST_LIMIT'] == 0 || $row['IN_TEST_LIMIT'] == 1) && $row['ROAD_TEST_DATE']) {
                                $title = '[주행시험임박]';
                            }

                            echo $title;
                            ?>
                        </td>
                        <td><?= nl2br($row['CONTENTS']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <h6 class="caption"><strong>고수의 운전면허</strong><br><span>Driving Master</span></h6>
</section>
</body>
</html>
