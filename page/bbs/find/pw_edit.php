<?php
include_once('../../../head.php');
$prevPage = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

if($prevPage != '/Lifedit/page/bbs/find/ajax/find_pw_ajax.php') {
    echo "<script>alert('허용되지 않는 잘못된 접근입니다.');location.href='".$site_url."'</script>";
}
$m_id = $_GET['m_id'];
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/join.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/find.css" rel="stylesheet" />

<article id="join01_article01">
    <p>find</p>
    <h3>비밀번호 재설정</h3>
    <div class="agree">
</article>
<article id="join02_article">
    <form id="join02Fm" method="post" action="./ajax/pw_write.php" onsubmit="return validation()">
        <input type="hidden" name="id" value="<?= $m_id ?>">
        <div class="find-container">
            <div class="input_inner">
                <div class="input07 input-wrap">
                    <input type="hidden" id="pwChk" value="N">
                    <p>비밀번호 <strong>*</strong></p>
                    <input type="password" placeholder="비밀번호를 입력해 주세요." id="password" name="password" class="pass" autocomplete='off' onkeyup="chkpw()" required />
                    <p id="pw-result" class=""></p>
                </div>
                <div class="input07 input-wrap">
                    <input type="hidden" id="pwReChk" value="N">
                    <p>비밀번호 확인 <strong>*</strong></p>
                    <input type="password" placeholder="비밀번호를 다시 입력해 주세요." id="rePw" class="pass" autocomplete='off' onkeyup="pwRe()" required />
                    <p id="pw-chk-result" class=""></p>
                </div>
            </div>
            <article id="loginbtn_div">
                <button class="green_box_btn green_login" type=submit>다음</button>
            </article>
        </div>
    </form>
</article>




<script>
    function chkpw(){
        let pw = $("#password").val();
        let number = pw.search(/[0-9]/g);
        let english = pw.search(/[a-z]/ig);
        let spece = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
        let reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

        if (false === reg.test(pw)) {
            $("#pw-result").text("비밀번호는 8자 이상이어야 하며, 숫자/대문자/소문자/특수문자를 모두 포함해야 합니다.");
            $("#pw-result").addClass("error");
            $("#pw-result").removeClass("poss");
            $("#pwChk").val("N");
            return false;
        } else {
            $("#pw-result").text("사용가능한 비밀번호입니다.")
            $("#pw-result").addClass("poss");
            $("#pw-result").removeClass("error");
            $("#pwChk").val("Y");
            return true;
        }
    }
    function pwRe(){
        let pw = $("#password").val();
        let rePw = $("#rePw").val();
        if (pw === rePw) {
            $("#pw-chk-result").text("비밀번호가 일치합니다.")
            $("#pw-chk-result").addClass("poss");
            $("#pw-chk-result").removeClass("error");
            $("#pwReChk").val("Y");
            return true;
        } else {
            $("#pw-chk-result").text("비밀번호가 일치하지 않습니다.");
            $("#pw-chk-result").addClass("error");
            $("#pw-chk-result").removeClass("poss");
            $("#pwReChk").val("N");
            return false;
        }
    }

    function validation(){
    if($("#pwChk").val() == "N"){
            alert("비밀번호를 정확히 입력해주세요.");
            $("input[name=password]").focus();
            return false;
        }
        else if($("#pwReChk").val() == "N"){
            alert("비밀번호 재입력이 일치하지 않습니다.");
            $("#rePw").focus();
            return false;
        } else{
            $("#join02Fm").submit();
            return true;
        }
    }
</script>

<?php
include_once('../../../tale.php');
?>
