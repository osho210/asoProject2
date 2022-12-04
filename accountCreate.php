<?php
    session_start();
    require_once "DBManager.php";
    $dbm = new DBManager();

    try{
        $dbm->account_registration($_POST["onamae"],$_POST["email"],$_POST["passward"]);

        sleep(1);

        $searchArray=$dbm->login_check($_POST["email"],$_POST["passward"]);

        foreach($searchArray as $row){
            $_SESSION['user_id'] = $row['customer_id'];
            $_SESSION['user_name'] = $row['customer_name'];
        }


    }catch(BadMethodCallException $bce){
        echo $bce->getMessage();
    }catch(LogicException $le){
        echo $le->getMessage();
    }

    return 0;
?>