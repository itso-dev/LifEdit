<?php
include_once('../../head.php');

$event = "";
if(isset($_POST['event']))
{
   $event = $_POST['event'];
}else{
    $event = 'N';
}
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/join.css" rel="stylesheet" />

<article id="join01_article01">
    <p>join</p>
    <h3>회원가입</h3>
    <div class="agree">
        <span>정보입력</span>
        <ul>
            <li>01 약관동의</li>
            <li class="click">02 정보입력</li>
            <li>03 가입완료</li>
        </ul>
    </div>
</article>

<article id="join02_article">
    <form id="join02Fm" method="post" action="./ajax/register.php">
        <div cl></div>
        <div class="input_inner">
            <input type="hidden" name="certification" value="N" />
            <input type="hidden" name="emailNumChk" value="N" />
            <input type="hidden" name="event" value="<?= $event ?>" />
            <div class="input06 input-wrap">
                <p>이메일 <strong>*</strong></p>
                <input type="email" placeholder="이메일을 입력해 주세요." name="email" class="email" autocomplete='off' />
                <div class="btn-wrap">
                    <button class="green_box_btn green_login" type="button" onclick="chkEmail()">중복확인</button>
                    <button class="green_box_btn green_login" type="button" onclick="sendEmail()">인증받기</button>
                </div>
                <p id="email-result" class=""></p>
            </div>
            <div class="input05 input-wrap certification-wrap">
                <p>인증번호 <strong>*</strong></p>
                <input type="text" placeholder="인증번호를 입력해 주세요." class="number" id="numChk" autocomplete='off' />
                <button class="green_box_btn green_login" type="button" onclick="emailNumChkFuc();">확인</button>
                <p id="numChk-result" class=""></p>
            </div>

            <div class="input07 input-wrap">
                <input type="hidden" id="pwChk" value="N">
                <p>비밀번호 <strong>*</strong></p>
                <input type="password" placeholder="비밀번호를 입력해 주세요." id="password" name="password" class="pass" autocomplete='off' onkeyup="chkpw()" />
                <p id="pw-result" class=""></p>
            </div>

            <div class="input08 input-wrap">
                <input type="hidden" id="pwReChk" value="N">
                <p>비밀번호 확인 <strong>*</strong></p>
                <input type="password" placeholder="비밀번호를 다시 입력해 주세요." id="rePw" class="pass" autocomplete='off' onkeyup="pwRe()" />
                <p id="pw-chk-result" class=""></p>
            </div>
            <div class="input01 input-wrap">
                <p>이름<strong>*</strong></p>
                <input type="text" placeholder="이름을 입력해 주세요." class="name" name="name" autocomplete='off' />
            </div>

            <div class="input02 input-wrap">
                <p>생년월일<strong>*</strong></p>
                <div class="input02_02">
                    <span class="">연도</span>
                    <input type="text" placeholder="" name="year" maxlength="4" class="year" />
                    <span class="">월</span>
                    <input type="text" placeholder="" name="month" maxlength="2" class="month" />
                    <span class="">일</span>
                    <input type="text" placeholder="" name="day" maxlength="2" class="day" />
                </div>
            </div>

            <div class="input03 input-wrap">
                <p>주소 <strong>*</strong></p>
                <div class="input02_03">
                    <input type="text" placeholder="" class="add01" id="address" name="address" readonly/>
                    <button class="green_box_btn green_login" type="button" onclick="execDaumPostcode();">검색</button>
                </div>
                <input type="text" placeholder="상세 주소를 입력해 주세요." name="address_detail" id="address_detail" class="add02" />
            </div>

            <div class="input04 input-wrap">
                <p>연락처<strong>*</strong></p>
                <input type="text" placeholder="연락처를 입력해 주세요." name="phone" class="call" />
            </div>
        </div>
    </form>
</article>

<article id="loginbtn_div">
    <button class="green_box_btn green_login" type="button" onclick="validation();">다음</button>
</article>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    var random_num = generateRandomCode(6);

    function validation(){
        if($("input[name=email]").val() == ""){
            alert("이메일을 입력해주세요.");
            $("input[name=email]").focus();
            return false;
        }
        else if($("input[name=certification]").val() == "N"){
            alert("이메일을 중복확인을 해주세요.");
            $("input[name=email]").focus();
            return false;
        }
        else if($("input[name=emailNumChk]").val() == "N"){
            alert("이메일을 인증을 해주세요.");
            $("#numChk").focus();
            return false;
        }
        else if($("#pwChk").val() == "N"){
            alert("비밀번호를 정확히 입력해주세요.");
            $("input[name=password]").focus();
            return false;
        }
        else if($("#pwReChk").val() == "N"){
            alert("비밀번호 재입력이 일치하지 않습니다.");
            $("#rePw").focus();
            return false;
        }
        else if($("input[name=name]").val() == ""){
            alert("이름을 입력해주세요.");
            $("input[name=name]").focus();
            return false;
        }
        else if($("input[name=year]").val() == "" || $("input[name=month]").val() == "" || $("input[name=day]").val() == ""){
            alert("생년월일을 입력해주세요.");
            $("input[name=year]").focus();
            return false;
        }
        else if($("input[name=address]").val() == ""){
            alert("주소를 입력해주세요.");
            $("input[name=address]").focus();
            return false;
        }
        else if($("input[name=address_detail]").val() == ""){
            alert("상세주소를 입력해주세요.");
            $("input[name=address_detail]").focus();
            return false;
        }
        else if($("input[name=phone]").val() == ""){
            alert("연락처를 입력해주세요.");
            $("input[name=phone]").focus();
            return false;
        }
        else{
            $("#join02Fm").submit();
            return true;
        }

    }
    function chkEmail(){
        var email = $("input[name=email]").val();

        if(email == ""){
            alert("이메일을 입력해주세요.");
        } else {
            $.ajax({
                type:'post',
                url:'./ajax/emailChk.php',
                data:{email: email},
                success:function(html){
                    console.log(html);
                    if(html == "Y"){
                        $("input[name=certification]").val("N");
                        $("#email-result").text("이미 사용 중인 이메일 입니다.")
                        $("#email-result").addClass("error");
                        $("#email-result").removeClass("poss");
                    }
                    else if(html == "N"){
                        $("input[name=certification]").val("Y");
                        $("#email-result").text("사용 가능한 이메일 입니다.")
                        $("#email-result").addClass("poss");
                        $("#email-result").removeClass("error");

                    }
                }
            });
        }
    }
    function sendEmail(){
        var email = $("input[name=email]").val();

        if($("input[name=certification]").val() == "N"){
            alert("이메일 중복확인을 해주세요.");
        } else{
            $.ajax({
                type:'post',
                url:'./ajax/emailSend.php',
                data:{email: email, num: random_num},
                success:function(html){
                    alert("인증번호가 전송되었습니다.");
                   $(".certification-wrap").show();

                }
            });
        }
    }
    function emailNumChkFuc(){
        var inputNum = $("#numChk").val();
        var num = random_num;

        if(inputNum === num){
            $("#numChk-result").text("인증되었습니다.");
            $("#numChk-result").addClass("poss");
            $("#numChk-result").removeClass("error");
            $("input[name=emailNumChk]").val("Y");
        } else {
            $("#numChk-result").text("인증번호가 일치 하지않습니다.");
            $("#numChk-result").addClass("error");
            $("#numChk-result").removeClass("poss");
            $("input[name=emailNumChk]").val("N");
        }
    }

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

    function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("address").value = extraAddr;

                } else {
                    document.getElementById("address").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("address_detail").focus();
            }
        }).open();
    }

    function generateRandomCode(n) {
        let str = ''
        for (let i = 0; i < n; i++) {
            str += Math.floor(Math.random() * 10)
        }
        return str
    }
</script>
<?php
include_once('../../tale.php');
?>
