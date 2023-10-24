<?php
include_once('../../head.php');
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/join.css" rel="stylesheet" />

<article id="join01_article01">
    <p>join</p>
    <h3>회원가입</h3>
    <div class="agree">
        <span>약관동의</span>
        <ul>
            <li class="click">01 약관동의</li>
            <li>02 정보입력</li>
            <li>03 가입완료</li>
        </ul>
    </div>
</article>

<article id="check_article">
    <form id="join01Fm" method="post" action="join02.php">
        <div class="check_inner">
            <div class="check01_inner check-wrap">
                <label>
                    <input type="checkbox" style="zoom:1.5;" class="check" name="chk-all" > 전체 동의
                </label>
            </div>
            <div class="check-wrap">
                <div class="check02_inner">
                    <label>
                        <input type="checkbox" style="zoom:1.5;" class="check option" id="option1" name="option1"> 서비스 이용약관 <strong>(필수)*</strong>
                    </label>
                    <img src="../../img/common/downrec.png">
                </div>
                <div class="box">
                    <p><?php include_once('terms/terms.php'); ?></p>
                </div>
            </div>
            <div class="check-wrap">
                <div class="check03_inner check-wrap">
                    <label>
                        <input type="checkbox" style="zoom:1.5;" class="check option" id="option2" name="option2"> 개인정보 처리방침 <strong>(필수)*</strong>
                    </label>
                    <img src="../../img/common/downrec.png">
                </div>
                <div class="box">
                    <p><?php include_once('terms/policy.php'); ?></p>
                </div>
            </div>
            <div class="check-wrap">
                <div class="check04_inner check-wrap">
                    <label>
                        <input type="checkbox" style="zoom:1.5;" class="check option" id="option3" name="event" value="Y"> 이벤트 정보 수집 동의 <strong>(선택)</strong>
                    </label>
                    <img src="../../img/common/downrec.png">
                </div>
                <div class="box">
                    <p><?php include_once('terms/event.php'); ?></p>
                </div>
            </div>
        </div>
    </form>
</article>

<article id="loginbtn_div">
    <button class="green_box_btn green_login" type="button" onclick="next()">다음</button>
</article>

<script>
    $(document).ready(function() {
        $("input[name=chk-all]").click(function() {
            if($("input[name=chk-all]").is(":checked")) $(".option").prop("checked", true);
            else $(".option").prop("checked", false);
        });
    });
    $(".check-wrap").click(function (){
        if($(this).hasClass("open")){
            $(this).removeClass("open");
            $(this).find(".box").slideUp('500');
        } else {
            $(this).addClass("open");
            $(this).find(".box").slideDown('500');
        }
    });

    function next(){
        if(!$("#option1").is(":checked")){
            alert("서비스 이용약관에 동의해주세요.");
            return false;
        }
        else if(!$("#option1").is(":checked")){
            alert("개인정보 처리방침에 동의해주세요.");
            return false;
        }
        $("#join01Fm").submit();
    }

</script>

<?php
include_once('../../tale.php');
?>
