<!DOCTYPE html>
<html lang="kor">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DrivingZone</title>
    
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- 커먼 css -->
    <link href="/css/common.css" rel="stylesheet">
    <!-- 스타일 css -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- 제이쿼리 -->
    <script type="text/javascript" src="/vendors/jquery/dist/jquery.min.js"></script>
    <style type="text/css">
        html,body {
            height: 100%;
            padding: 0;
            margin: 0;
        }
        h3 {
            padding: 15px 0;
            margin:  0 auto;
            width: 100%;
            color: #73879C;
            font-weight: 500;
            overflow: hidden;
        }
        h3 small {
            font-size: 14px;
            color: #777;
            font-weight: 500;
        }
        input[type=checkbox] {
            vertical-align: top;
        }
        textarea {
            width: calc(100% - 7px);
            height: 50px;
            resize: none;
        }
        .save_btn {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            border: none;
            float: right;
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
            border-radius: 3px;
        }
        .save_btn:hover {
            background-color: #286090;
            border-color: #204d74;
        }
        .content table {
            margin: 0 auto;
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .content table td {
            border: 1px solid #ebebeb;
        }
        .content table thead {
            background: rgba(52, 73, 94, 0.94);
            color: #ECF0F1;    
            text-align: center;
        }
        .content table thead td {
            padding: 5px 0;
        }
        .content table td:first-child {
            text-align: center;
        }
        .content span {
            font-size: 13px;
        }
        .add_btn_area {
            padding: 15px 0;
            text-align: right;
        }
        .del_btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
            white-space: nowrap;
        }
        .add_btn {
            display: inline-block;
            padding: 6px 12px;
            /* float: right; */
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            border-radius: 4px;
            color: #fff;
            background: #26B99A;
            border: 1px solid #169F85;
        }
        .caution_text {
            display: inline-block;
            font-size: 14px;
            margin-right: 10px;
            color: #777;
            font-weight: 500;
        }
        .align_c {
            text-align: center;
        }
        .content table tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
<div style="padding:0 15px">
    <h3>
        상담 및 메모보기 
        <small>※ 쿠키를 삭제할 경우 내용이 사라집니다.</small><br>
        <div style="float:right; padding: 10px 0 0">
            <small style="display: inline-block; margin-right: 15px;">※ 메모를 하신 후 '저장' 버튼을 눌러주세요.</small>
            <button type="button" class="save_btn">저장</button>
        </div>
    </h3>
    <div class="content">
        <table>
            <colgroup>
            <col width="70px">
            <col width="*">
            <col width="70px">
        </colgroup>
        <thead>
            <tr>
                <td>
                    <span>인콜 여부</span>
                </td>
                <td>
                    <span>메모 내용</span>
                </td>
                <td>
                    <span>삭제</span>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="checkbox" class="checkbox">
                </td>
                <td>
                    <textarea class="consult_memo"></textarea>        
                </td>
                <td>    
                    <!-- <button type="button" class="del_btn">제거</button> -->
                </td>
            </tr>
        </tbody>
    </table>
    <div class="add_btn_area">
        <span class="caution_text">※ 메모 내용을 추가 하실 경우 '추가' 버튼을 눌러주세요.</span>
        <button type="button" class="add_btn">추가</button>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
            // $(".consult_memo").val(window.localStorage.getItem("drivingZoneConsulting"));

            var record = JSON.parse(window.localStorage.getItem("drivingZoneConsulting")) || [];    
            var recordChk = JSON.parse(window.localStorage.getItem("drivingZoneConsultingChk")) || [];  

            $(".save_btn").click(function(){
                // window.localStorage.removeItem("drivingZoneConsulting");
                // window.localStorage.removeItem("drivingZoneConsultingChk");
                record = [];
                recordChk = [];
                for( var i = 0 ; i < $(".consult_memo").length ; i++ ){
                    record.push($(".consult_memo").eq(i).val());    

                    if($(".checkbox").eq(i).prop("checked")){
                        recordChk.push("y");    
                    }else {
                        recordChk.push("n");    
                    }
                }
                window.localStorage.setItem("drivingZoneConsulting",JSON.stringify(record));
                window.localStorage.setItem("drivingZoneConsultingChk",JSON.stringify(recordChk));
                alert("저장 되었습니다.");
            });

            for( var i = 1 ; i < JSON.parse(window.localStorage.getItem("drivingZoneConsulting")).length ; i++){
                var html = '<tr><td><input type="checkbox" class="checkbox"/></td><td><textarea class="consult_memo"></textarea></td><td class="align_c"><button type="button" class="del_btn">제거</button></td></tr>';
                $(html).appendTo($("tbody"));
            };
            

            $.each(record,function(index,data){
                $(".consult_memo").eq(index).val(data);
            });

            $.each(recordChk,function(index,data){
                if(data == "y"){
                    $(".checkbox").eq(index).prop("checked",true);    
                }else if(data == "n"){
                    $(".checkbox").eq(index).prop("checked",false);    
                }
            });

            $(".add_btn").click(function(){
                // alert(1);
                var html = '<tr><td><input type="checkbox" class="checkbox"/></td><td><textarea class="consult_memo"></textarea></td><td class="align_c"><button type="button" class="del_btn">제거</button></td></tr>';

                $(html).appendTo($("tbody"));
                // tr.appendTo($("tbody"));
                $(".del_btn").unbind().bind("click", function(){
                    if(confirm("해당 행을 삭제하시겠습니까?")){
                        $(this).parent().parent().remove();    
                    }
                });
            });

            $(".del_btn").unbind().bind("click",function(){
                if(confirm("해당 행을 삭제하시겠습니까?")){
                    $(this).parent().parent().remove();    
                }
            });


            // $(".consult_memo").val( getCookie("drivingZoneConsulting"));

            // $(".save_btn").click(function(){
            //     setCookie("drivingZoneConsulting",$(".consult_memo").val(),1);
            //     alert("저장 되었습니다.");
            // });
        });

    // // 쿠키 생성
    // function setCookie(cName, cValue, cDay){
    //     var expire = new Date();
    //     expire.setDate(expire.getDate() + cDay);
    //     cookies = cName + '=' + escape(cValue) + '; path=/ '; 
    //     // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
    //     if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
    //     document.cookie = cookies;
    // }

    // // 쿠키 가져오기
    // function getCookie(cName) {
    //     cName = cName + '=';
    //     var cookieData = document.cookie;
    //     var start = cookieData.indexOf(cName);
    //     var cValue = '';
    //     if(start != -1){
    //         start += cName.length;
    //         var end = cookieData.indexOf(';', start);
    //         if(end == -1)end = cookieData.length;
    //         cValue = cookieData.substring(start, end);
    //     }
    //     return unescape(cValue);
    // }
</script>
</div>
</body>
</html>
