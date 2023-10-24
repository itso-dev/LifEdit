<?php
include_once('../head.php');
include_once('../default.php');

// 리스트에 출력하기 위한 sql문
$admin_sql = "select * from contents2_tbl where id = 1";
$admin_stt=$db_conn->prepare($admin_sql);
$admin_stt->execute();
$row = $admin_stt -> fetch();

//대표 이미지
$img_file_name0 = $root_url .'/data/contents/' . $row['img_chg_name0'];
//첫번째 이미지
$img_file_name1 = $root_url .'/data/contents/' . $row['img_chg_name1'];
//두번째 이미지
$img_file_name2 = $root_url .'/data/contents/' . $row['img_chg_name2'];
//소개서 파일
$file_name = $root_url .'/data/contents/' . $row['chg_name'];

$old_img_file1 = $row['img_chg_name1'];
$old_img_file0 = $row['img_chg_name0'];
$old_img_file2 = $row['img_chg_name2'];
$old_file_name = $row['chg_name'];

$data_cnt1 = $row['data_cnt1'];
$data_cnt2 = $row['data_cnt2'];
$data_cnt3 = $row['data_cnt3'];

$regdate = substr($row['regdate'], 0 , 10);

?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/popup_form.css" rel="stylesheet" />
<div class="page-header">
    <h4 class="page-title">교육 사업 관리 <span class="small">최종수정일: <?= $regdate ?></span></h4>
    <form name="logo_form" id="logo_form" method="post" action="./setting/contents_setting.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="1" />
        <input type="hidden" name="type" value="edu" />
        <input type="hidden" name="old_img_file0" value="<?= $old_img_file0 ?>" />
        <input type="hidden" name="old_img_file1" value="<?= $old_img_file1 ?>" />
        <input type="hidden" name="old_img_file2" value="<?= $old_img_file2 ?>" />
        <input type="hidden" name="old_file" value="<?= $old_file_name ?>" />
        <input type="hidden" name="is_show" value="Y" />
        <input type="hidden" name="data_cnt3" value="" />

        <div class="input-wrap input-file">
            <p class="label-name">대표 이미지 등록*</p>
            <input type="file" id="img_file0" name="img_file0" class="form-control">
            <small class="red">권장 사이즈 2000 * 1100 px</small><br>
            <small>5MB 이하의 파일만 업로드 가능합니다</small>
            <div class="img-preview">
                <img src="<?= $img_file_name0 ?>" id="preview0">
            </div>
        </div>
        <div class="input-wrap input-file">
            <p class="label-name">교육 사업 차별점 상세페이지 등록*</p>
            <input type="file" id="img_file1" name="img_file1" class="form-control">
            <small class="red">권장 사이즈 2840 * 1200 px</small><br>
            <small>5MB 이하의 파일만 업로드 가능합니다</small>
            <div class="img-preview">
                <img src="<?= $img_file_name1 ?>" id="preview1">
            </div>
        </div>
        <div class="input-wrap input-file">
            <p class="label-name">교육 사업 분야 소개 등록*</p>
            <input type="file" id="img_file2" name="img_file2" class="form-control">
            <small class="red">권장 사이즈 2840 * 1200 px</small><br>
            <small>5MB 이하의 파일만 업로드 가능합니다</small>
            <div class="img-preview">
                <img src="<?= $img_file_name2 ?>" id="preview2">
            </div>
        </div>
        <p>교육 사업 데이터</p>
        <div class="input-wrap">
            <p class="label-name">교육 진행 수 (개)</p>
            <input type="number" name="data_cnt1" class="form-control" placeholder="숫자만 입력해주세요." value="<?= $data_cnt1 ?>">
        </div>
        <div class="input-wrap">
            <p class="label-name">수강생 수 (명)</p>
            <input type="number" name="data_cnt2" class="form-control" placeholder="숫자만 입력해주세요." value="<?= $data_cnt2 ?>">
        </div>
        <div class="input-wrap input-file">
            <p class="label-name">소개서 등록*</p>
            <input type="file" id="file" name="file" class="form-control">
            <p class="file">등록된 파일: <a href="<?= $file_name ?>" download="<?= $row['file_name'] ?>"><?= $row['file_name'] ?></a></p>
            <small>5MB 이하의 파일만 업로드 가능합니다</small>
        </div>
        <div class="btn-wrap">
            <input type="submit" class="submit" value="확인" />
        </div>

    </form>
</div>
<!-- box end -->
</div>
<!-- content-box-wrap end -->
<style>
    .small{
        font-size: 15px;
        color: #989898;
    }
    .file{
        margin-top: 5px;
        padding-left: 10px;
        font-size: 15px;
    }
    .file a{
        text-decoration: underline;
        margin-left: 10px;
    }
</style>

<script type="text/javascript">
    var sel_file;

    $(document).ready(function () {
        $("#img_file0").on("change", handleImgFileSelect0);
        $("#img_file1").on("change", handleImgFileSelect1);
        $("#img_file2").on("change", handleImgFileSelect2);

    });

    function handleImgFileSelect0(e) {
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
                $("#preview0").attr("src", e.target.result);
            }
            reader.readAsDataURL(f);
        });
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
                $("#preview1").attr("src", e.target.result);
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
