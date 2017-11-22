<div class="radio" style="display: inline-block; margin-right: 10px">
    <label class="file_ins">
        <input type="radio" checked="" value="F" name="file_type"> 파일 첨부
    </label>
</div>
<div class="radio" style="display: inline-block; margin-right: 10px">
    <label class="webcam_ins">
        <input type="radio" value="W" name="file_type"> 웹캠
    </label>
</div>

<div class="file_area" style="margin-top: 10px;">
    <input type="file" name="file" class="img_input" accept="image/*" style="display: inline-block;">
    <input type="hidden" name="org_img" value="">
    <button type="button" class="btn-link img_input_view" data-toggle="modal" title="" data-target="#imgViewModal" style="float: right;
    padding-right: 0px;  border-right-width: 0px;  margin-right: 0px;">[사진보기]</button>
</div>
<div class="webcam_area" style="display: none; margin-top: 10px;">
    <!-- <span>준비중입니다</span> -->
    <div class="my_camera<?= $_POST['idx']?>" style="width:280px; height:200px; border:1px dashed #ccc; margin-bottom: 10px;"></div>
    <input type=button value="웹캠 준비" onClick="configure(<?= $_POST['idx']?>)" style="color:#000;">
    <input type=button value="사진 촬영" onClick="take_snapshot(<?= $_POST['idx']?>)" style="color:#000;">
    <!-- <input type=button value="저장" onClick="saveSnap(<?= $_POST['idx']?>)" style="color:#000;"> -->
    <input class="webcam_input<?= $_POST['idx']?>" type="hidden" name="file" value=""/>

    <div class="camera_results<?= $_POST['idx']?>" style="margin-top: 10px;"></div>
</div>