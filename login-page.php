<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>食べ食べプラン</title>
</head>

<body>
    <!-- G1-2-1に対応している画面です -->
    <div class="main">
        <div class="text-center">
            <p class="text-success"><strong>ログイン</strong></p>
            <p>Eメールアドレス</p>
            <p id ="mailErrMesage"></p>
            <input type="text" name="email"  id="inputMail" placeholder="Email"></p>
            <p>パスワード(半角英数6文字以上)</p>
            <input type="password" name="passward" id="inputPass" placeholder="password"></p>
            <p id="passErrMesage"></p>
	        <p><button type="button" id="btnSubmit" class="btn btn-success">ログインする</button></p>
            <p class="text-success"><strong>パスワードをお忘れの方はこちら</storong></p>
            <p class="text-success"><strong>アカウント作成はこちら</strong></p>
        </div>
    </div>
</body>

<script>
    const inputMail = document.getElementById("inputMail");
    const inputPass = document.getElementById("inputPass");
    // アルファベット小文字、大文字または数値が1文字
    const pass = /^([a-zA-Z0-9]{5,})$/ 
    // 先頭に記号を含まない、@と.を含む
    const reg = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/;
    
    const btnSubmit = document.getElementById("btnSubmit");

    const mailErrMesage = document.getElementById("mailErrMesage")
    const passErrMesage = document.getElementById("passErrMesage")

    btnSubmit.addEventListener('click' ,()=>{
        // errがなければ画面遷移
        let errCount = 0;
        if(inputMail.value == ""){
            mailErrMesage.innerHTML = "メールアドレスが未入力です。"
            errCount++;
        }
        else if(!reg.test(inputMail.value)){
            mailErrMesage.innerHTML ="メールアドレスの形式が不正です。"
            errCount++;
        }
    
        // pass
        if(inputPass.value==""){
            passErrMesage.innerHTML="パスワードが未入力です。"
            errCount++;
        }
        else if(!inputPass.value.match(/^([a-zA-Z0-9]{5,})$/)){
            passErrMesage.innerHTML="パスワードの形式が不正です。"
            errCount++;
        }

        if(errCount==0){
            location.href="menu-list.php";
        }
        else if (errCount>0){
            alert("入力に誤りがあります。")
        }

    })
</script>

</html>