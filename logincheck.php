<?php
    session_start();
    require_once "DBManager.php";
    $dbm = new DBManager();

    try{
        $searchArray=$dbm->login_check($_POST["email"],$_POST["password"]);
        //配列取得（照合成功）
        foreach($searchArray as $row){
            $_SESSION['user_id'] = $row['customer_id'];//セッションにユーザーID挿入
            $_SESSION['user_name'] = $row['customer_name'];//セッションにユーザー名挿入
        }

            header('Location:loginAlready.php');//メニュー画面へ

    }catch(BadMethodCallException $bce){
        echo $bce->getMessage();
    }catch(LogicException $le){
        echo $le->getMessage();
    }
?>