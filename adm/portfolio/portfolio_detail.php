<?php
    include_once('../head.php');
    include_once('../default.php');

    $id = $_GET['id'];


    $admin_sql = "select * from portfolio_tbl where id = $id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $val = $admin_stt -> fetch();
    $thumb_file = $root_url .'/data/portfolio/' . $val['chg_name'];
    function type($num){
        $type = "";
        switch ($num){
            case 1:
                $type = "공연";
                break;
            case 2:
                $type = "오디오컨텐츠";
                break;
            case 3:
                $type = "축제/행사";
                break;
            case 4:
                $type = "교육/사업";
                break;
            case 5:
                $type = "라이프에디트 랩";
                break;
        }
        return $type;
    }

    // File List
    $file_sql = "select * from portfolio_file_tbl where fk_id = $id";
    $file_stt=$db_conn->prepare($file_sql);
    $file_stt->execute();

?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/portfolio_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">포트폴리오 관리</h4>

            <div class="btn-head">
                <span class="notice <? if($val['is_notice'] == 'Y') echo 'active' ?>" onclick="setNotice(this)">
                    <?
                        if($val['is_notice'] == 'Y') echo '대표 지정 해제';
                        else echo '대표로 지정';
                    ?>
                </span>
                <span class="notice <? if($val['is_main'] == 'Y') echo 'active' ?>" onclick="setMain(this)">
                    <?
                    if($val['is_notice'] == 'Y') echo '메인 전시 지정 해제';
                    else echo '메인 전시로 지정';
                    ?>
                </span>
                <a class="modify" href="portfolio_form.php?id=<?= $val['id'] ?>&mode=modify&menu=99">수정</a>
                <span class="delete" onclick="delData()">삭제</span>
            </div>

            <div class="detail-container">
                <div class="line">
                    <div class="label">
                        카테고리
                    </div>
                    <div class="val">
                        <?= type($val['category']) ?>
                    </div>
                </div>
                <div class="line">
                    <div class="label">
                        구분
                    </div>
                    <div class="val">
                        <?
                            if($val['type'] == 1){
                                echo "영상";
                            } else{
                                echo "이미지";
                            }
                        ?>
                    </div>
                </div>
                <div class="line">
                    <div class="label">
                        썸네일
                    </div>
                    <div class="val">
                        <img src="<?= $thumb_file ?>">
                    </div>
                </div>
                <div class="line">
                    <div class="label">
                        포트폴리오 명
                    </div>
                    <div class="val">
                        <?= $val['title'] ?>
                    </div>
                </div>
                <div class="line">
                    <div class="label">
                        포트폴리오 설명
                    </div>
                    <div class="val">
                        <?= $val['text'] ?>
                    </div>
                </div>
                <? if($val['type'] == 1){  ?>
                    <div class="line">
                        <div class="label">
                            유튜브 영상
                        </div>
                        <div class="val">
                            ID: <?= $val['video_id'] ?><br>
                            Link: <a href="https://www.youtube.com/watch?v=<?= $val['video_id'] ?>" target="_blank">https://www.youtube.com/watch?v=<?= $val['video_id'] ?></a>
                        </div>
                    </div>
                <? } else { ?>
                    <div class="line">
                        <div class="label">
                            첨부 이미지
                        </div>
                        <div class="val">
                            <?php
                            while($file=$file_stt->fetch()){
                                $file_src = $root_url .'/data/portfolio/' . $file['chg_name'];

                                ?>
                                <img src="<?= $file_src ?>">
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
            </div>

            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="portfolio_list.php?menu=99" class="go-back">목록</a>
            </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">


    function delData(element){
        if(!confirm("선택한 데이터를 정말 삭제하시겠습니까?")) {
            return false;
        }else{
            $.ajax({
                type:'post',
                url:'./setting/portfolio_delete.php',
                data:{id:<?= $id ?>, type: 'detail'},
                success:function(html){
                    alert('삭제 되었습니다.');
                    location.href='../portfolio_list.php?menu=99&'
                }
            });
        }
    }
    function setNotice(element){

        let value = "";

        if($(element).hasClass("active")){
            $(element).removeClass('active');
            $(element).text("대표로 지정")
            value = "N";
        } else {
            $(element).addClass('active');
            $(element).text("대표 지정 해제")
            value = "Y";
        }

        $.ajax({
            type:'post',
            url:'./setting/set_notice.php',
            data:{id: <?= $id ?>, key: value, link: "portfolio_detail.php"},
            success:function(html){
                console.log(html);
            }
        });
    }
    function setMain(element){

        let value = "";

        if($(element).hasClass("active")){
            $(element).removeClass('active');
            $(element).text("메인 전시로 지정")
            value = "N";
        } else {
            $(element).addClass('active');
            $(element).text("메인 전시 지정 해제")
            value = "Y";
        }

        $.ajax({
            type:'post',
            url:'./setting/set_main.php',
            data:{id: <?= $id ?>, key: value, link: "portfolio_detail.php"},
            success:function(html){
                console.log(html);
            }
        });
    }
</script>
