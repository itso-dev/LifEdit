<?php
    session_start();

    if ( isset($_SESSION['m_id']) ) {
        session_unset();
        session_destroy();
        echo "<script type='text/javascript'>";
        echo "location.href='/'";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alert('로그인 중이 아닙니다.'); location.href='/'";
        echo "</script>";
    }
?>
