<?php
include "Classes/PHPExcel.php";
include_once('../../db/dbconfig.php');

$type = "";
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
if($type == 'all'){
    $list_sql = "select * from contact_tbl order by id desc";
    $list_stt=$db_conn->prepare($list_sql);
    $list_stt->execute();
} else {
    $chk =$_POST['chk'];
    $chk_count = count($_POST['chk']);


    $list_sql = "select * from contact_tbl
                            where
                    id IN (" . implode(',', array_map('intval', $chk)) .")
                            order by id";
    $list_stt=$db_conn->prepare($list_sql);
    $list_stt->execute();


}

$phpExcel = new PHPExcel();

$phpExcel->setActiveSheetIndex(0);
$phpExcel->getActiveSheet()
    ->setCellValue("A1", "등록일")
    ->setCellValue("B1", "이름")
    ->setCellValue("C1", "연락처")
    ->setCellValue("D1", "창업희망지역")
    ->setCellValue("E1", "문의내용")
    ->setCellValue("F1", "결과")
    ->setCellValue("G1", "아이피");

$line = 2;
while($list_row=$list_stt->fetch()) {
    $phpExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$line, $list_row['write_date'])
        ->setCellValue("B".$line, $list_row['name'])
        ->setCellValue("C".$line, $list_row['phone'])
        ->setCellValue("D".$line, $list_row['location'])
        ->setCellValue("E".$line,$list_row['contact_desc'])
        ->setCellValue("F".$line,$list_row['result_status'])
        ->setCellValue("G".$line,$list_row['writer_ip']);
    $line++;
}

header('Content-Type: application/vnd.ms-excel');
header( "Content-Disposition: attachment; filename = 문의ㅠ_".date('Y-m-d H:i:s') .".xls" );     //filename = 저장되는 파일명을 설정합니다.
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
$objWriter->save('php://output');

?>
