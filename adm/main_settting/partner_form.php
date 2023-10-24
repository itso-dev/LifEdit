<?php
    include_once('../head.php');
    include_once('../default.php');

    $type = $_GET['type'];
    $id = "";
    $name = "";
    $url = "";
    $file = "";
    $row = "";
    $old_file = "";

    if($type=='modify'){
        $id = $_GET['id'];
        // 리스트에 출력하기 위한 sql문
        $admin_sql = "select * from partner_tbl where id = $id";
        $admin_stt=$db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $val = $admin_stt -> fetch();
        $file = $root_url .'/data/partner/' . $val['chg_name']; // pc
        $name = $val['name'];
        $url = $val['url'];
        $row = $val['row'];
        $old_file = $val['chg_name'];
    }
?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/popup_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">파트너 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/partner_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="<?= $type ?>" />
            <input type="hidden" name="old_file" value="<?= $old_file ?>" />
            </div>
                <div class="input-wrap">
                    <p class="label-name">파트너 명*</p>
                    <input type="text" name="name" class="form-control" value="<?= $name ?>" required>
                </div>
                <div class="input-wrap">
                    <p class="label-name">URL*</p>
                    <input type="text" name="url" class="form-control" value="<?= $url ?>" required>
                </div>
                <div class="input-wrap">
                    <p class="label-name">노출 위치*</p>
                    <select name="row" style="width: 150px; padding: 8px 5px;">
                        <option value="1" <? if($row == '1') echo 'selected' ?>>첫번째 줄</option>
                        <option value="2" <? if($row == '2') echo 'selected' ?>>두번째 줄</option>
                    </select>
                </div>
                <div class="input-wrap input-file">
                    <p class="label-name">파트너 로고 이미지 업로드*</p>
                    <input type="file" id="img_upload" name="img_upload" class="form-control">
                    <small class="red">권장 사이즈 350 * 50 px</small><br>
                    <small>5MB 이하의 파일만 업로드 가능합니다.</small>
                    <div class="img-preview">
                        <img src="<?= $file ?>" id="preview1">
                    </div>
                </div>
            </div>

                <div class="btn-wrap">
                    <input type="submit" class="submit" value="확인" />
                    <a href="partner_list.php?menu=22" class="go-back">목록</a>
                </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">
    var sel_file;

    $(document).ready(function () {
        $("#img_upload").on("change", handleImgFileSelect1);
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
</script>
