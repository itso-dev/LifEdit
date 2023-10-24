<?php
include_once('../../head.php');
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/login.css" rel="stylesheet" />
<h3>
    <strong>라이프 에디트</strong>에 오신 것을<br>
    환영합니다.
</h3>
<article class="input_article">
    <form method="post" action="ajax/login_chk.php">
        <p class="">로그인</p>
        <div class="input-wrap">
            <input type="text" placeholder="이메일" name="email" class="email" />
            <input type="password" placeholder="비밀번호" name="password" class="" />
        </div>
        <div class="login_option">
            <label>
                <input type="checkbox" class="check" name="option1" value="save"> 아이디 저장
            </label>
            <div class="find_div">
                <a href="find/find_id.php">아이디 찾기</a>
                <a href="find/find_pw.php">비밀번호 찾기</a>
            </div>
        </div>
        <div class="loginbtn_div">
            <input type="submit" class="green_box_btn green_login" value="로그인">
            <a href="join01.php" class="green_line_btn green_join">회원가입</a>
        </div>
    </form>
</article>
<?php
include_once('../../tale.php');
?>
