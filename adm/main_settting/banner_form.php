<?php
include_once('../head.php');
include_once('../default.php');

$type = $_GET['type'];
$id = "";
$title = "";
$order = "";
$url = "";
$pc_file = "";
$mobile_file = "";
$pc_old_file = "";
$mobile_old_file = "";

$cnt_val = "";
$cnt_sql = "select count(*) as cnt from banner_tbl";
$cnt_stt=$db_conn->prepare($cnt_sql);
$cnt_stt->execute();
$cnt = $cnt_stt -> fetch();
$cnt_val =  $cnt['cnt'] + 1;


if($type=='modify'){
    $id = $_GET['id'];
    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from banner_tbl where id = $id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $row = $admin_stt -> fetch();
    $pc_file = $root_url .'/data/banner/' . $row['pc_chg_name']; // pc
    $mobile_file = $root_url .'/data/banner/' . $row['mobile_chg_name']; // pc
    $title = $row['title'];
    $order = $row['b_order'];
    $url = $row['url'];
    $pc_old_file = $row['pc_chg_name'];
    $mobile_old_file = $row['mobile_chg_name'];
    $cnt_val =  $cnt['cnt'];
}
?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/popup_form.css" rel="stylesheet" />
    <div class="page-header">
        <h4 class="page-title">메인 배너 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/banner_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="<?= $type ?>" />
            <input type="hidden" name="pc_old_file" value="<?= $pc_old_file ?>" />
            <input type="hidden" name="mobile_old_file" value="<?= $mobile_old_file ?>" />
            <div class="input-wrap">
                <p class="label-name">배너 명*</p>
                <input type="text" name="title" class="form-control" value="<?= $title ?>" required>
            </div>
            <div class="input-wrap">
                <p class="label-name">노출 순서*</p>
                <select name="order" style="width: 150px; padding: 8px 5px;">
                        <option value="">선택하세요</option>
                    <?php for($i = 0; $i < $cnt_val; $i++ ){ ?>
                        <option value="<?= $i+1 ?>" <? if($order == '1') echo 'selected' ?>><?= $i+1 ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-wrap">
                <p class="label-name">URL</p>
                <input type="text" name="url" class="form-control" value="<?= $url ?>">
            </div>
            <div class="input-wrap input-file">
                <p class="label-name">PC 배너 이미지 업로드*</p>
                <input type="file" id="pc_img" name="pc_img" class="form-control">
                <small class="red">권장 사이즈 1920 * 700 px</small><br>
                <small>5MB 이하의 파일만 업로드 가능합니다</small>
                <div class="img-preview">
                    <img src="<?= $pc_file ?>" id="preview1">
                </div>
            </div>
            <div class="input-wrap input-file">
                <p class="label-name">모바일 배너 이미지 업로드*</p>
                <input type="file" id="mobile_img" name="mobile_img" class="form-control">
                <small class="red">권장 사이즈 780 * 480 px</small><br>
                <small>5MB 이하의 파일만 업로드 가능합니다</small>
                <div class="img-preview">
                    <img src="<?= $mobile_file ?>" id="preview2">
                </div>
            </div>
            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="banner_list.php?menu=22" class="go-back">목록</a>
            </div>
         </form>
    </div>
<!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">
    var sel_file;

    $(document).ready(function () {
        $("#pc_img").on("change", handleImgFileSelect1);
        $("#mobile_img").on("change", handleImgFileSelect2);

    });

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
