<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <title>食べ食べプラン</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.slider').bxSlider({
        auto: true,
        pause: 5000,
      });
    });
  </script>
</head>

<body>
  <!-- G1-1に対応しているページです。  -->
  <header>
    <nav>
      <ul class="nav-list">
        <li><img src="img/menu-logo.png" /></li>
        <li><img src="img/logo.png" /></li>
        <li><img src="img/login-logo.png" /></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="slider">
      <img src="img/menu1.png" width="500" height="300" alt="">
      <img src="img/menu2.png" width="500" height="300" alt="">
      <img src="img/menu3.png" width="500" height="300" alt="">
      <img src="img/menu4.png" width="500" height="300" alt="">
    </div>
    <div class="front-back">
      <button type="button" class="top-botton" onclick="location.href='menu-list.html'">今すぐ始める</button>

    </div>
    <div class="text-center">
      <p>メニューもいっぱい</p>
    </div>
    </div>
  </main>
</body>

</html>