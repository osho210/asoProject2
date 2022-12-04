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
    <style>
        .menuDiv {
            display: flex;
            justify-content: space-between;
        }

        .menuInput {
            width: 60%;
        }

        .changeOrder {
            width: 10%;
        }

        .changeOrder input {
            margin: 5px 0;
        }

        .menuDiv .menuDiv2 {
            display: flex;
            justify-content: space-around;
        }

        .menuDiv img {
            width: 30%;
        }

        .block {
            display: block;
            width: 100%;
        }

        .orderMenuImg {
            height: 100px;
        }

        .orderMenuName {
            line-height: 100px;
            font-size: 16px;
        }

        .deleteBtn {
            margin: 12% 0;
        }

        .deleteBtn button {
            border: none;
        }

        .addButtun {
            background: green;
            color: white;
            border: none;
        }

        .subtraction {
            border: none;
        }

        .form {
            text-align: center;
        }

        .btnWrapper {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <!-- valueの種類の数だけ -->
    <script>
        <?php require 'DBManager.php';
        $dbmng = new DBManager();
        $dbmng->menu_display()
        ?>
    </script>
    <div id="contentWrapper">
    </div>
    <div class="btnWrapper">
        <form id="form1" class="form" action="registragtion1-page.php">
            <div id="inputWrapper">
                <!-- input要素を動的作成のための領域 -->
            </div>
            <button class="closeMenuButton" id="choisedMenu" type="submit">
                <p id="selectMenuCount" name="test">確定する</p>
            </button>
            <br>
            <a>
                <button class="closeMenuButton">
                    リンクで遷移する
                </button>
            </a>
        </form>
    </div>
</body>



<script>
    let json = localStorage.getItem('key');
    let menuCountArrayStorage = JSON.parse(json)
    // console.log(menuCountArrayStorage)

    //渡されたvalueのカウントと配列の削除(後程)
    const contentWrapper = document.getElementById('contentWrapper')
    // 合計数量の計算
    let vallValueTotal = 0;
    Object.values(menuCountArrayStorage).forEach(value => {
        Object.values(value).forEach(detailValue => {
            vallValueTotal = vallValueTotal + detailValue;
        })
    })

    // localstorageから選択項目の取得
    const valueCountFc = () => {
        // localstorage用の連想配列
        Object.values(menuCountArrayStorage).forEach(value => {
            Object.keys(value).forEach(key => {
                keyValue = key;
                // console.log(keyValue)
            })
            Object.values(value).forEach(detailValue => {
                vallValue = detailValue
                // console.log(vallValue)

                for (let i = 0; i < 1; i++) {
                    // 要要素を作成
                    const menuDiv = document.createElement('div')
                    menuDiv.classList.add('menuDiv')

                    const changeOrder = document.createElement('div')
                    changeOrder.classList.add('changeOrder')

                    // 増量ボタン
                    const addButtun = document.createElement('buttun')
                    addButtun.innerHTML = "+"
                    addButtun.classList.add('block', 'addButtun')
                    // clickの処理
                    addButtun.addEventListener('click', () => {
                        console.log(vallValueTotal)
                        if (vallValueTotal < 7) {
                            vallValueTotal++;
                            menuInputNum = Number(menuInput.value) + 1;
                            menuInput.value = menuInputNum;
                        }
                    })

                    const menuInput = document.createElement('input')
                    menuInput.setAttribute('value', vallValue)
                    menuInput.disabled = true;
                    // console.log(vallValue)
                    menuInput.classList.add('menuInput', 'block')
                    menuInput.setAttribute('name', "name" + i)

                    const subtraction = document.createElement('buttun')
                    subtraction.innerHTML = "-"
                    subtraction.classList.add('block', 'subtraction')
                    // マイナスの処理
                    subtraction.addEventListener('click', () => {
                        vallValueTotal--;
                        // 0以上の場合処理が走る
                        if (menuInput.value > 0) {
                            menuInputNum = Number(menuInput.value) - 1;
                            menuInput.value = menuInputNum;
                        }
                    })

                    // appendchild
                    changeOrder.appendChild(addButtun)
                    changeOrder.appendChild(menuInput)
                    changeOrder.appendChild(subtraction)


                    const menuDiv2 = document.createElement('div')
                    menuDiv2.classList.add('menuDiv2')
                    const menuImage = document.createElement('img')
                    menuImage.classList.add = "orderMenuImg"
                    menuImage.src = "img/" + menuArray[keyValue][1];

                    const orderMenuName = document.createElement('p')
                    orderMenuName.innerHTML = menuArray[keyValue][0]
                    orderMenuName.classList.add('orderMenuName')
                    menuDiv2.appendChild(menuImage)
                    menuDiv2.appendChild(orderMenuName)



                    const deleteBtn = document.createElement('div')
                    deleteBtn.classList.add('deleteBtn')
                    const button = document.createElement('button')
                    button.innerHTML = "✘"
                    deleteBtn.appendChild(button)


                    menuDiv.appendChild(changeOrder);
                    menuDiv.appendChild(menuDiv2)
                    menuDiv.appendChild(deleteBtn)
                    contentWrapper.appendChild(menuDiv)
                }
            })
            // totalが7つあるか判定
            console.log(vallValueTotal + "row")

        })

        const form1 = document.getElementById('form1')
        form1.addEventListener('click', e => {
            e.preventDefault();
            if (vallValueTotal != 7) {
                window.alert('商品を7つ選択してください')
                // 一覧選択に戻りますか？(アラート画面)
            } else {
                location.href = "registragtion1-page.php"
            }
        })
        // console.log('呼び出しテスト')
    }

    // 配列がiが7以下の場合(i=0番目スタート)
    // for (let i = 7; i > 0; i--) {
    //     // 配列の要素の先頭を取得して連想配列のkeyに格納
    //     localStorageArrayVal = menuCountArrayStorage[0];
    //     // console.log(localStorageArrayVal)
    //     let count = 0;
    //     menuCountArrayStorage.forEach((element, index, array) => {
    //         // 同じ値が2つあった場合１つ取れていない
    //         if (element == localStorageArrayVal) {
    //             // 配列の削除
    //             menuCountArrayStorage.splice(index, 1)
    //             // console.log(menuCountArrayStorage)
    //             console.log(array)
    //             console.log(i)
    //             count++;
    //         }
    //     });
    //     // 連想配列にkeyとvalueを格納
    //     localStorageArray[localStorageArrayIndex] = {
    //         localStorageArrayVal: count
    //     };
    //     // console.log(localStorageArrayVal)
    //     localStorageArrayIndex++;
    // }

    // console.log(localStorageArray)
    // 配列内で検索(filterでカウントアップ)
    // カウントアップ終了時に連想配列のvalueに値を格納
    // }

    valueCountFc();
    // 連想配列のlengthだけcreateのdom操作を実行


    // localstorageの値で要素を生成
    //最初の値で要素を生成して配列内の要素に値が含まれるならカウントアップして配列の値を削除する
    // localstorageの値の破棄

    // input要素に格納
</script>

</html>