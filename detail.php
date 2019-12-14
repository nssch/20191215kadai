<?php
include('functions.php');

//送信されたid取得
$id = $_GET['id'];

//DB接続
$pdo = connectToDb();

//指定したidだけを表示する
$sql = 'SELECT*FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    //エラーの時
    showSqlErrorMsg($stmt);
} else {
    $rs = $stmt->fetch(); //fetch()で１レコードを取得して$rsに入れる。$rsは配列
    //var_dump($rs);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDO</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header>
        <h1>TO DO</h1>
    </header>


    <form action="insert.php" method="POST">
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" value="<?= $rs['name'] ?>">
        </div>
        <div>
            <label for="comment">To Do</label>
            <textarea name="comment"><?= $rs['comment'] ?></textarea>
        </div>
        <div>
            <label for="deadline">期限</label>
            <input type="date" name="deadline" id="" value="<?= $rs['deadline'] ?>">
        </div>
        <div class="btnarea">
            <button class="button">登録</button>
        </div>
        <input type="hidden" name="id" value="<?= $rs['id'] ?>">

    </form>

</body>

</html>