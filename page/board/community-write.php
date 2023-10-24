<?php
include_once('../../head.php');

$content = "";
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/board.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/adm/ajax/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>

<article id="board">
    <p class="page-title">Edit</p>
    <h3 class="page-title-sub">작성하기</h3>
    <div class="write-container">
        <form method="post" enctype="multipart/form-data" action="community-edit.php">
            <input type="hidden" name="writer" value="홍길동">
            <p class="label">제목</p>
            <input type="text" name="title" placeholder="제목을 입력해주세요." required>
            <p class="label">내용</p>
            <textarea id="content" name="content" required></textarea>
            <div class="upload-wrap">
                <div class="input-wrap">
                    <div class="file-add">
                        <span class="upload-btn" id="upload-btn" onclick="fileAdd()">파일 업로드</span>
                        <input type="file" id="file" name="file[]">
                    </div>
                </div>
                <div class="file-list" id="file-list">
                </div>
            </div>
            <input class="submit" id="submit" type="submit" value="등록" />
        </form>
    </div>

</article>


<script type="text/javascript">
    var sel_file;
    var fileList = document.getElementById('file-list');
    var file_id = "";


    function fileAdd(){
        $('#file' + file_id).click();
    }

    $(document).on("change", "input[name='file[]']", function() {
        var fullPath = $(this).val();
        if (fullPath) { // 파일이 선택된 경우에만 실행
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명

            var newPreview = document.createElement('div');
            newPreview.className = 'preview';
            newPreview.innerHTML = `<img class='icon' src='<?= $site_url ?>/img/common/file-icon.png'>` +
                `<span class='name'>` + fileName + `</span>` +
                `<img class='del' src='<?= $site_url ?>/img/common/x.png' onclick='deleteFile(this.parentNode, "#file`+ file_id +`")'>`;
            fileList.appendChild(newPreview);

            $(this).parent('.file-add').hide();

            if(file_id == ''){
                file_id = 0;
            }
            ++file_id;
            var newFile = `<div class="file-add">`
                            +`<span class="upload-btn" id="upload-btn`+ file_id +`" onclick="fileAdd()">파일 업로드</span>`
                            +`<input type="file" id="file`+ file_id +`" name="file[]">`
                        +`</div>`
            $('.upload-wrap .input-wrap').append(newFile);

        }
    });

    function deleteFile(element, id) {
        fileList.removeChild(element);
        $(id).parent('.file-add').remove();
    }

    $(function(){
        //전역변수
        var obj = [];
        //스마트에디터 프레임생성
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: obj,
            elPlaceHolder: "content", // textarea의 name태그
            sSkinURI: "<?= $site_url ?>/adm/ajax/smarteditor2/SmartEditor2Skin.html",  // 본인 경로게 맞게 수정
            htParams : {
                // 툴바 사용 여부
                bUseToolbar : true,
                // 입력창 크기 조절바 사용 여부
                bUseVerticalResizer : true,
                // 모드 탭(Editor | HTML | TEXT) 사용 여부
                bUseModeChanger : true,
            },
            fOnAppLoad : function(){
                obj.getById["content"].exec("PASTE_HTML", ['<?= $content ?>']);
            },
            fCreator: "createSEditor2"
        });
        function pasteHTML(filepath) {
            var sHTML = '<span><img src="'+filepath+'"></span>';
            obj.getById["content"].exec("PASTE_HTML", [sHTML]);
        }
        //전송버튼
        $("#submit").click(function(){
            //id가 smarteditor인 textarea에 에디터에서 대입
            obj.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
            $("#submit").submit();
        });
    });
</script>


<?php
include_once('../../tale.php');
?>
