<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>食べ食べプラン</title>
</head>

<body>
    <!-- G1-8に対応している画面です -->
    <?php
    $pushArrayVal = [];
    $pushArrayKey = [];

    // 入力された変数分だけ取得する
    for ($i = 1; $i <= 7; $i++) {
        // 存在しない場合処理を終了
        if (!isset($_POST['value' . $i])) {
            // echo 'elemetNone.<br>';
            break;
        } else {
            array_push($pushArrayVal, $_POST['value' . $i]);
            array_push($pushArrayKey, $_POST['key' . $i]);
        }
    }

    // keyの値(商品ID)
    print_r($pushArrayKey);
    echo '<br>';
    // valueの値(商品の数)
    print_r($pushArrayVal);
    // 配列の長さの分だけ回してあげれば取得できます
    ?>
    <main class="main">
        <div class="text-center">
            <p class="text-success">
                <strong>ご購入手続き</strong><br>
                <img src="./img/image4.png" style="width: 40%;">

            <div class="text-center">
                <div style="margin: 70px;">
                    <div style="display: flex; justify-content: space-between;">
                        <strong>料金</strong>
                        <strong>￥4000</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <strong>消費税</strong>
                        <strong>￥200</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <strong>送料</strong>
                        <strong>￥0</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <strong>手数料</strong>
                        <strong>￥0</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <strong>合計</strong>
                        <strong>￥4200</strong>
                    </div>
                </div>

                <p>
                    <button type="button" class="btn btn-secondary" onclick="location.href='orderContent-page.php'">戻る</button>
                    <button type="button" class="btn btn-success" onclick="location.href='orderComplete-page.php'">申込む</button>
                </p>
            </div>
    </main>

</html>
</body>