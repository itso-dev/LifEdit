<?php
    include_once('../head.php');
    include_once('../default.php');

    $type = $_GET['type'];
    $id = "";
    $title = "";
    $content = "";
    $file = "";
    $old_file = "";

    if($type=='modify'){
        $id = $_GET['id'];
        // 리스트에 출력하기 위한 sql문
        $admin_sql = "select * from awards_tbl where id = $id";
        $admin_stt=$db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $val = $admin_stt -> fetch();
        $file = $root_url .'/data/awards/' . $val['chg_name']; // pc
        $title = $val['title'];
        $content = $val['content'];
        $old_file = $val['chg_name'];
    }
?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/popup_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">수상 내역 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/awards_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="<?= $type ?>" />
            <input type="hidden" name="old_file" value="<?= $old_file ?>" />
            </div>
                <div class="input-wrap">
                    <p class="label-name">수상 명*</p>
                    <input type="text" name="title" class="form-control" value="<?= $title ?>" required>
                </div>
                <div class="input-wrap">
                    <p class="label-name">수상 내용*</p>
                    <textarea class="form-control" name="content" required><?= $content ?></textarea>
                </div>
                <div class="input-wrap input-file">
                    <p class="label-name">이미지 업로드*</p>
                    <input type="file" id="img_upload" name="img_upload" class="form-control">
                    <small class="red">권장 사이즈 350 * 350 px</small><br>
                    <small>5MB 이하의 파일만 업로드 가능합니다.</small>
                    <div class="img-preview">
                        <img src="<?= $file ?>" id="preview1">
                    </div>
                </div>
            </div>

                <div class="btn-wrap">
                    <input type="submit" class="submit" value="확인" />
                    <a href="awards_list.php?menu=88" class="go-back">목록</a>
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
