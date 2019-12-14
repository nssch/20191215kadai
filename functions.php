<?php
//データベースに接続するための関数
function connectToDb()
{

    $dbn = 'mysql:dbname=gsacfd04_db18;charset=utf8;port=3306;host=localhost';
    $user =  'root';
    $pwd = '';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
}

//SQL処理エラー
function showSqlErrorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
}
