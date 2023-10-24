<?php
    include_once('../head.php');
    include_once('../default.php');

    $id = "";
    $type = "";
    $year = "";
?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/history_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">연혁 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/history_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="year_insert" />
            </div>
                <div class="input-wrap">
                    <p class="label-name">연도*</p>
                    <input type="text" name="year" class="form-control" value="<?= $year ?>" required>
                </div>
            </div>

            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="history_list.php?menu=88" class="go-back">목록</a>
            </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">

</script>
