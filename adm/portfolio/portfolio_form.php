<?php
include_once('../head.php');
include_once('../default.php');

$mode = $_GET['mode'];
$id = "";
$category = "";
$title = "";
$text = "";
$video_id = "";
$thumb_file = "";
$thumb_old_file = "";
$type = "";


if($mode=='modify'){
    $id = $_GET['id'];
    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from portfolio_tbl where id = $id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $row = $admin_stt -> fetch();
    $thumb_file = $root_url .'/data/portfolio/' . $row['chg_name']; // pc
    $thumb_old_file = $row['chg_name'];

    $title = $row['title'];
    $category = $row['category'];
    $type = $row['type'];
    $text = $row['text'];
    $video_id = $row['video_id'];

    // File List
    $file_sql = "select * from portfolio_file_tbl where fk_id = $id";
    $file_stt=$db_conn->prepare($file_sql);
    $file_stt->execute();


}
?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/popup_form.css" rel="stylesheet" />
    <div class="page-header">
        <h4 class="page-title">포트폴리오 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/portfolio_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="mode" value="<?= $mode ?>" />
            <input type="hidden" name="thumb_old_file" value="<?= $thumb_old_file ?>" />
            <div class="input-wrap">
                <p class="label-name">카테고리*</p>
                <select name="category" style="width: 150px; padding: 8px 5px;">
                    <option value="">선택하세요</option>
                    <option value="1" <?php if($category == '1') echo "selected"; ?>>공연</option>
                    <option value="2" <?php if($category == '2') echo "selected"; ?>>오디오 컨텐츠</option>
                    <option value="3" <?php if($category == '3') echo "selected"; ?>>축제/행사</option>
                    <option value="4" <?php if($category == '4') echo "selected"; ?>>교육 사업</option>
                    <option value="5" <?php if($category == '5') echo "selected"; ?>>라이프에디트 랩</option>
                </select>
            </div>
            <div class="input-wrap">
                <p class="label-name">구분*</p>
                <label>
                    <input type="radio" value="1" name="type" <?php if($type == '1') echo "checked"; ?>>
                    영상
                </label>
                <label>
                    <input type="radio" value="2" name="type" <?php if($type == '2') echo "checked"; ?>>
                    이미지
                </label>
            </div>
            <div class="input-wrap input-file">
                <p class="label-name">썸네일 이미지 업로드*</p>
                <input type="file" id="thumb-img" name="thumb-img" class="form-control" required>
                <small class="red">권장 사이즈 1000 * 1000 px</small><br>
                <small>5MB 이하의 파일만 업로드 가능합니다</small>
                <div class="img-preview">
                    <img src="<?= $thumb_file ?>" id="thumb-preview">
                </div>
            </div>
            <div class="input-wrap">
                <p class="label-name">포트폴리오 명*</p>
                <input type="text" name="title" class="form-control" value="<?= $title ?>" required>
            </div>
            <div class="input-wrap">
                <p class="label-name">포트폴리오 설명</p>
                <textarea name="text" class="form-control"><?= $text ?></textarea>
            </div>
            <div class="input-wrap" id="type_video">
                <p class="label-name">유튜브 영상 ID</p>
                <input type="text" name="video_id" class="form-control" value="<?= $video_id ?>" >
                <small>유튜브 링크의 ID를 입력해주세요. ex)https://www.youtube.com/watch?v=<strong style="color:#983535">a_k-dCgubFo</strong></small>
            </div>
            <div class="input-wrap" id="type_img">
                <p class="label-name">이미지 등록</p>
                <div class="upload-wrap">
                    <div class="input-wrap">
                        <div class="file-add">
                            <span class="upload-btn" id="upload-btn" onclick="fileAdd()">파일 업로드</span>
                            <input type="file" id="file" name="file[]">
                        </div>
                    </div>
                    <div class="file-list" id="file-list">
                        <?php
                        if($mode=='modify'){
                        while($file=$file_stt->fetch()){
                            $file_src = $root_url .'/data/portfolio/' . $file['chg_name'];
                            ?>
                            <div class="preview">
                                <img src="<?= $file_src ?>" style="width: 280px;">
                                <img class="del" src="x.png" onclick="fileDel(this, <?= $file['id'] ?>);">
                            </div>
                        <? }} ?>
                    </div>
                </div>
            </div>
            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <?php if($mode=='modify'){ ?>
                <a href="portfolio_detail.php?menu=99&id=<?= $id ?>" class="go-back">상세 페이지로</a>
                <? } ?>
            </div>
         </form>
    </div>
<!-- box end -->
</div>
<!-- content-box-wrap end -->
<style>
    label{
        font-size: 16px;
        margin-right: 20px;
        color:#333;
    }
    <? if($type == '1'){  ?>

    #type_img{
        display: none;
    }
    <? } else if($type == '2') { ?>
    #type_video{
        display: none;
    }
    <? } else { ?>
    #type_img,
    #type_video{
        display: none;
    }
    <? } ?>

</style>
<script type="text/javascript">
    var sel_file;
    var fileList = document.getElementById('file-list');
    var file_id = "";


    function fileAdd(){
        $('#file' + file_id).click();
    }

    $(document).on("change", "input[name='file[]']", function() {
        var fullPath = $(this).val();
        if (fullPath) { // 파일이 선택된 경우에만 실행
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명

            var newPreview = document.createElement('div');
            newPreview.className = 'preview';
            newPreview.innerHTML = `<img src="` + URL.createObjectURL(this.files[0]) + `" style="width: 280px;">` +
                `<img class='del' src='x.png' onclick='deleteFile(this.parentNode, "#file`+ file_id +`")'>`;
            fileList.appendChild(newPreview);

            $(this).parent('.file-add').hide();

            if(file_id == ''){
                file_id = 0;
            }
            ++file_id;
            var newFile = `<div class="file-add">`
                +`<span class="upload-btn" id="upload-btn`+ file_id +`" onclick="fileAdd()">파일 업로드</span>`
                +`<input type="file" id="file`+ file_id +`" name="file[]">`
                +`</div>`
            $('.upload-wrap .input-wrap').append(newFile);

        }
    });

    function deleteFile(element, id) {
        fileList.removeChild(element);
        $(id).parent('.file-add').remove();
    }


    $(document).ready(function () {
        $("#thumb-img").on("change", handleImgFileSelect1);

        $("input[name=type]").change(function (){
            var value = $(this).val();
            if(value == 1){
                $("#type_video").show();
                $("#type_img").hide();
            } else if(value == 2){
                $("#type_img").show();
                $("#type_video").hide();

            }
        });
    });

    function fileDel(element, id){
        if(!confirm("삭제한 데이터는 복구하실 수 없습니다. 선택한 데이터를 정말 삭제하시겠습니까?")) {
            return false;
        }else{
            $.ajax({
                type:'post',
                url:'./setting/file_delete.php',
                data:{id:id},
                success:function(html){
                    $(element).parent(".preview").remove();
                }
            });
        }
    }

    function handleImgFileSelect1(e) {
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        filesArr.forEach(function (f) {
            if (!f.type.match("image.*")) {
                alert("확장자는 이미지 확장자만 가능합니다.");
                return;
            }
            sel_file = f;

            var reader = new FileReader();
            reader.onload = function (e) {
                $("#thumb-preview").attr("src", e.target.result);
            }
            reader.readAsDataURL(f);
        });
    }

    function handleImgFileSelect2(e) {
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        filesArr.forEach(function (f) {
            if (!f.type.match("image.*")) {
                alert("확장자는 이미지 확장자만 가능합니다.");
                return;
            }
            sel_file = f;

            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview2").attr("src", e.target.result);
            }
            reader.readAsDataURL(f);
        });
    }
</script>
