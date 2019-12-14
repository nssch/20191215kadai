<?php
//指定id取得
$id = $_GET['id'];

//関数ファイル読み込み
include('functions.php');

//DB接続
$pdo = connectToDb();

//データ登録SQL
$sql = 'DELETE FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    //select.phpへ
    header('Location:index.php');
    exit;
}
