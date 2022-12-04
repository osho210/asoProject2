<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/menu.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <style>
    .filter {
      flex-wrap: wrap;
      display: flex;
    }

    .filterNone {
      flex-wrap: wrap;
      display: none;
    }
  </style>
  <title>食べ食べプラン</title>
</head>


<?php require 'DBManager.php';
$dbmng = new DBManager();
?>

<body id="body">
  <!-- 初期状態はnone -->
  <div id="unallpwPage" class="unallpwPage none">
    <div>
      <p>避けたい食材を選択してください</p>
      <div id="food">
        <!-- DBから要素を作成 -->
        <?php
        $dbmng->allergyCreate();
        ?>
      </div>
      <button class="canselButtun" id="canselButtun">閉じる</button>
    </div>
  </div>

  <div class="allowPage" id="allowPage">
    <!-- メニュー絞り込み部分 -->
    <div>
      <div class="menuRecomend">
        <p>メニューからおまかせ選択</p>
      </div>
      <div class="menuFillter">
        <ul>
          <li class="menuFilter">一覧</li>
          <li class="menuFilter">豚肉</li>
          <li class="menuFilter">鶏肉</li>
          <li class="menuFilter">牛肉</li>
          <li class="menuFilter">魚</li>
        </ul>
      </div>
    </div>
    <!-- mainコンテンツ部分 -->
    <!-- 食材フィルター -->
    <div class="foodFillter">
      <div><button class="foodButton" id="allergyButton">食材フィルター</button></div>
      <div class="cp_ipselect cp_sl01">
        <select id="selectId">
          <option value="" hidden="">並び替え</option>
          <option value="1">糖質</option>
          <option value="2">塩分</option>
          <option value="3">食物繊維</option>
          <option value="4">カロリー</option>
          <option value="5">タンパク質</option>
          <option value="6">脂質</option>
        </select>
      </div>
    </div>
    <!-- コンテンツ部分 -->
    <div id="mainContent">
      <!-- DBから要素を作成 -->
      <div class=" filter">
        <?php
        $dbmng->menuCreate();
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->allergyCreateElement('小麦');
        // $dbmng->allergyCreateElement('小麦');
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->allergyCreateElement('小麦');
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->allergyCreateElement('肉');
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->allergyCreateElement('ジャガイモ');
        ?>
      </div>

      <!-- 要素の並べ替え -->
      <!-- selectboxの値によって表示非表示が変更 -->
      <!-- フィルター要素の繰り返し以降に記述することで自動でnoneを付与 -->
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(1);
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(2);
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(3);
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(4);
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(5);
        ?>
      </div>
      <div class="filter filterNone">
        <?php
        $dbmng->menu_sort(6);
        ?>
      </div>
    </div>
    <!-- 変更処理 -->
    <button class="choisedMenu" id="choisedMenu" type="submit" disabled>
      <p id="selectMenuCount" name="test">あと7食必要です</p>
    </button>

  </div>
  <script>
    const selectMenuFn = () => {
      if (menuCountArray.length < 7) {
        selectMenuCount.textContent = "あと" + (7 - menuCountArray.length) + "食必要です"
      } else {
        selectMenuCount.textContent = "注文する"
      }
    }

    // メニューボタンを表示する処理
    const allergyButton = document.getElementById('allergyButton')
    const allowPage = document.getElementById('allowPage');
    allergyButton.addEventListener('click', () => {
      allowPage.classList.add('none');
      unallpwPage.classList.remove('none')
    })

    // メニューボタンを非表示にする処理
    const canselButtun = document.getElementById('canselButtun');
    canselButtun.addEventListener('click', () => {
      unallpwPage.classList.add('none');
      allowPage.classList.remove('none');
    })



    // 取得要素格納のための配列
    let menuCountArray = [];

    // もしもlocalstorageに値がある場合は上書き
    let json = localStorage.getItem('key');
    let menuCountArrayStorage = JSON.parse(json)
    let vallValue = 0;
    let keyValue = 0;




    // filterNoneクラスがついていないものを取得
    const filterNoneSearch = (clickNum) => {
      const mainContent = document.getElementById('mainContent');
      mainContentLength = mainContent.childElementCount

      const displayArea = mainContent.children[clickNum] //filterクラスの取得
      const menuWrapperLength = displayArea.childElementCount //menuWrapper要素数を取得
      for (let j = 1; j <= menuWrapperLength; j++) {
        const menuWrapper = displayArea.childNodes[j] //menuWrapper要素の取得
        const menuWrapperBtnWrapper = menuWrapper.childNodes[3]; //btn領域の確保
        const menuWrapperBtnWrapperAdd = menuWrapperBtnWrapper.childNodes[1] //add領域の確保
        const menuWrapperBtnWrapperAddVal = menuWrapperBtnWrapperAdd.value //addbuttunのvalueの確保
        const menuWrapperNumWrapper = menuWrapper.childNodes[4]; //countの確保
        const menuWrapperBtnWrapperCount = menuWrapperNumWrapper.childNodes[0]

        Object.values(menuCountArrayStorage).forEach(value => {
          Object.keys(value).forEach(key => {
            keyValue = key;
          })
          Object.values(value).forEach(detailValue => {
            // console.log(vallValue + "loocale")
            vallValue = detailValue
          })
          if (menuWrapperBtnWrapperAddVal == keyValue) {
            menuWrapperBtnWrapperCount.innerHTML = vallValue + "食"
          }
        })
      }
    }

    // 食材選択カウントボタンのid取得
    const selectMenuCount = document.getElementById('selectMenuCount');

    // localstrageに値がある場合にmenucountArrayに格納
    if (menuCountArrayStorage) {
      filterNoneSearch(0)
      menuCountArray = [];
      let countTotal = 0;
      Object.values(menuCountArrayStorage).forEach(value => {
        Object.keys(value).forEach(key => {
          keyValue = key;
        })
        Object.values(value).forEach(detailValue => {
          vallValue = detailValue
        })
        for (let i = 0; i < vallValue; i++) {
          menuCountArray.push(keyValue)
        }
      })
      selectMenuCount.textContent = "注文する"
      const choisedMenu = document.getElementById('choisedMenu')
      choisedMenu.disabled = false
    }


    // 作成要素数の取得
    let btnElemenNum = document.getElementsByClassName('btnWrapper')
    // addボタンとdeleteボタンの処理をクラスの数だけ作成
    for (let i = 0; i < btnElemenNum.length; i++) {
      // addボタンの処理
      let addButtun = document.getElementsByClassName('addButtun')[i];
      // 各要素のvalueを取得
      let selectBtnValue = addButtun.getAttribute('value');
      // 食数の値の変更
      let selectCount = document.getElementsByClassName('selectCount')[i]


      addButtun.addEventListener('click', () => {
        // 選択した要素が7件の場合disabled属性の削除
        menuSubmit.disabled = true
        if (menuCountArray.length >= 6) {
          menuSubmit.disabled = false
        }
        // valueの値を配列に格納
        if (menuCountArray.length <= 6 && arrayValueSearch(selectBtnValue) <= 6) {
          menuCountArray.push(selectBtnValue)
          selectCount.innerHTML = arrayValueSearch(selectBtnValue) + "食";
          // 送信可能か判定
          selectMenuFn();
        }
      })


      // 削除ボタンの処理
      let deleteButtun = document.getElementsByClassName('deleteButtun')[i];
      deleteButtun.addEventListener('click', () => {
        menuSubmit.disabled = true
        // 配列内に要素があるか検索
        if (menuCountArray.length > 0 && arrayValueSearch(selectBtnValue) > 0) {
          // 配列内要素からvalueを1つ削除
          // 追加した要素のindex情報を取得
          let deleteIndex = menuCountArray
          menuCountArray.findIndex(element => element == selectBtnValue);
          menuCountArray.splice(deleteIndex, 1)
          selectCount.innerHTML = arrayValueSearch(selectBtnValue) + "食";

          // 送信可能か判定
          selectMenuFn();
        }
      })
    }


    // 配列内のvalueの数をカウント
    const arrayValueSearch = selectBtnValue => {
      let count = menuCountArray.filter(valueElement => valueElement == selectBtnValue).length
      return count;
    }



    // formの送信処理
    const menuSubmit = document.getElementById('choisedMenu');
    // 7件以上ある場合送信可能

    let testArray = []
    let j = 0
    menuSubmit.addEventListener('click', () => {
      // localstorageにデータが7子含まれている場合画面遷移
      if (menuCountArrayStorage) {
        localStorage.removeItem('key')
        alert('success')
      }

      for (let i = 0; i < btnElemenNum.length; i++) {
        const selectCountVal = Number(document.getElementsByClassName('selectCount')[i].textContent.replace("食", ""))
        if (selectCountVal > 0) {
          testArray[j] = {
            [i]: selectCountVal
          }
          j++;
        }
      }
      // もしlocalstorageが存在する場合は削除
      if (localStorage.getItem('key')) {
        console.log('succes')
        localStorage.removeItem('key');
      }
      let json = JSON.stringify(testArray, undefined, 1);
      localStorage.setItem('key', json)
      location.href = "orderinfo-page.php";
    })


    // sortの処理
    const selectId = document.getElementById('selectId');
    selectId.onchange = (() => {
      console.log("sort" + menuCountArray)
      let options = Number(selectId.selectedOptions[0].value) + 4;
      // console.log(options)
      if (menuCountArrayStorage) {
        filterNoneSearch(options)
      }
      const filterArea = document.getElementsByClassName('filter')[options];
      filterArea.classList.remove('filterNone')
      for (let j = 0; j < 11; j++) {
        if (j != (options)) {
          const filterArea = document.getElementsByClassName('filter')[j];
          filterArea.classList.add('filterNone')
        }
      }
    })


    // filterの処理
    const filterCount = document.getElementsByClassName("filter")
    for (let i = 0; i < filterCount.length; i++) {
      const menuFilter = document.getElementsByClassName('menuFilter')[i];
      menuFilter.addEventListener('click', () => {
        console.log(menuCountArray + "filter")
        if (menuCountArrayStorage) {
          // clickした要素を取得
          filterNoneSearch(i)
        }
        const filterArea = document.getElementsByClassName('filter')[i];
        filterArea.classList.remove('filterNone')
        // クリックした要素以外の非表示
        for (let j = 0; j < filterCount.length; j++) {
          if (i != j) {
            const filterArea = document.getElementsByClassName('filter')[j];
            filterArea.classList.add('filterNone')
          }
        }
      })
    }



    // クリックした場合valueに処理を追加
    const foodContentText = document.getElementsByClassName("foodContentText")
    let foodContentTextLength = foodContentText.length;
    for (let i = 0; i < foodContentTextLength; i++) {
      const foodContentTextAdd = document.getElementsByClassName("foodContentText")[i];
      foodContentTextAdd.addEventListener('click', () => {
        foodContentTextAdd.setAttribute("value", i);
      })
    }

    selectMenuFn()
  </script>
</body>

</html>