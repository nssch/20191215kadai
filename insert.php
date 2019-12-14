<?php
//var_dump($_POST);

//関数のファイルをよみこむ
include('functions.php');

//POSTデータ取得
//入力チェック。入力なしの時はえらー
if (
    !isset($_POST['name']) || $_POST['name'] == '' ||
    !isset($_POST['comment']) || $_POST['comment'] == '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
    exit('Paramerror');
}

//POSTデータ取得
$name = $_POST['name'];
$comment = $_POST['comment'];
$deadline = $_POST['deadline'];

//データ登録の処理
$pdo = connectToDb();

//データ登録SQL
$sql = 'INSERT INTO todo_table(id,name,comment,deadline,indate)VALUES(NULL,:a1,:a2,:a3,sysdate())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $comment, PDO::PARAM_STR);
$stmt->bindValue(':a3', $deadline, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {             //SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();    //SQL処理エラー字の関数実行
    exit('sqlerror:' . $error[2]);   //sqlerror:エラーをオブジェクトで表示
} else {
    header('Location: index.php');  //エラーなくデータ登録できればindex.php表示される
    //header('Location: index.html');  //てすとエラーなくデータ登録できればindex.php表示される
}
