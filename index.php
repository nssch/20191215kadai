<?php
//関数ファイルの読みこみ
include('functions.php');

//データベース接続
$pdo = connectToDb();

//データ表示SQL
$dbn = 'SELECT*FROM todo_table ORDER BY deadline ASC';
$stmt = $pdo->prepare($dbn);
$status = $stmt->execute();

//データ表示
$view = '';
if ($status == false) {  //SQL実行時にエラーがあればエラー表示
    $error = $stmt->errorInfo();
    exit('sqlerror:' . $error[2]);
} else {
    //データの数だけ自動ループ
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<table class="cp_table">';
        $view .= '<tr>';
        $view .= '<th>' . $result['name'] . '</th>';
        $view .= '<td class="comment">';
        $view .= '<p>' . $result['comment'] . '</p>';
        $view .= '</td>';
        $view .= '<td class="deadline">';
        $view .= '<p>' . $result['deadline'] . '</p>';
        $view .= '</td>';
        $view .= '<td class="edit">';
        $view .= '<p><a href="detail.php?id=' . $result['id'] . '" class="e_btn">Edit</a>';
        $view .= '<a href="delete.php?id=' . $result['id'] . '" class="d_btn">Delete</a></p>';
        //$view .= '<small>' . $result['indate'] . '</small>';
        $view .= '</td>';
        $view .= '</tr>';
        $view .= '</table>';
    }
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
        <div>
            <h1>TO DO</h1>
        </div>

        <!-- <nav>
            <ul>
                <li>
                    <a href="index.php">登録</a>
                </li>
                <li><a href="select.php">表示？分けるか迷い中</a></li>
            </ul>
        </nav> -->
    </header>



    <form action="insert.php" method="POST">
        <div>
            <label for="name">名前</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="comment">To Do</label>
            <textarea name="comment"></textarea>
        </div>
        <div>
            <label for="deadline">期限</label>
            <input type="date" name="deadline" id="">
        </div>
        <div class="btnarea">
            <button class="button">登録</button>
        </div>
    </form>

    <div class="viewarea">
        <?= $view ?>
    </div>

</body>

</html>