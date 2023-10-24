<?php
    include_once('./head.php');
    include_once('./default.php');


    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from email_tbl where id = 1";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $row = $admin_stt -> fetch();

    $email = $row['email'];

?>

<link rel="stylesheet" type="text/css" href="./css/manager_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">발송 이메일 설정</h4>
        <form name="manager_form" id="manager_form" method="post" action="./ajax/email_setting.php">
            </div>
                <div class="input-wrap">
                    <p class="label-name">이메일*</p>
                    <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                </div>
            </div>
            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="./apply_list.php?menu=1" class="go-back">뒤로</a>
            </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type='text/javascript'>
    $( document ).ready(function() {
        $('#password').val('');
    });

</script>
