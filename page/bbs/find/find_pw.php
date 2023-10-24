<?php
include_once('../../../head.php');
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/join.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/find.css" rel="stylesheet" />

<article id="join01_article01">
    <p>find</p>
    <h3>비밀번호 찾기</h3>
    <div class="agree">
</article>
<article id="join02_article">
    <form id="join02Fm" method="post" action="./ajax/find_pw_ajax.php">
        <div class="find-container">
            <div class="input_inner">
                <div class="input07 input-wrap">
                    <p>이메일 <strong>*</strong></p>
                    <input type="email" placeholder="가입하신 이메일을 입력해 주세요." id="email" name="email"autocomplete='off' required />
                </div>
                <div class="input07 input-wrap">
                    <p>이름 <strong>*</strong></p>
                    <input type="text" placeholder="가입하신 이름를 입력해 주세요." id="name" name="name"autocomplete='off' required />
                </div>
                <div class="input07 input-wrap">
                    <p>연락처 <strong>*</strong></p>
                    <input type="number" placeholder="가입하신 연락처를 입력해 주세요." id="phone" name="phone"autocomplete='off' required />
                </div>
            </div>
            <article id="loginbtn_div">
                <button class="green_box_btn green_login" type=submit>다음</button>
            </article>
        </div>
    </form>
</article>




<script>

</script>

<?php
include_once('../../../tale.php');
?>
