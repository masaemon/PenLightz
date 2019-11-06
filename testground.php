<?php
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://unpkg.com/obniz@1.14.1/obniz.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://api.songle.jp/v2/api.js"></script>
    <nav class="navbar has-shadow">
        <div class="navbar-brand">
            <a class="navbar-item title is-3" href="./home.php">
                PenLightz
            </a>
        </div>
        <div id="navbarPens" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="./home.php">Home</a>
                <a class="navbar-item" href="./testground.php">試してみる</a>
                <a class="navbar-item" href="./search_music.php">遊ぶ</a>

            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-info is-rounded is-outlined" href="./history.php">音楽履歴</a>
                        <?php
    if(isset($_SESSION["obnizid"])) {
      echo '<a class="button is-primary is-rounded is-outlined" href="./logout_obniz.php">ログアウト</a>';
    } else {
      echo '<a class="button is-primary is-rounded is-outlined" href="./add_obniz.php">ID登録</a>';
    }
  ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">さあ試してみよう</h1>
            <h2 class="subtitle">obnizとつないだペンライトを試してみましょう</h2>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="media">
                <div>
                    <button class="button is-white is-medium play">
                        <i class="material-icons">play_arrow</i>
                    </button>
                    <button class="button is-white is-medium stop">
                        <i class="material-icons">stop</i>
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div id="colorpicker-wrap" class="tile is-child box">
                        <p class="title">色の変更</p>
                        <div style="float: left;">
                            <div id="colorpicker-red"></div>
                            <div id="colorpicker-green"></div>
                            <div id="colorpicker-blue"></div>
                        </div>
                        <div style="float: left;">
                            <div id="colorpicker-swatch" class="ui-widget-content ui-corner-all"></div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box">
                        <p class="title">点滅パターン</p>
                        <div class="control" id="radio">
                            <form id="blink">
                                <label class="radio">
                                    <input type="radio" name="answer" checked value="stay" onchange="onRadioButtonChange();">
                                    そのまま
                                </label>
                                <label class="radio">
                                    <input type="radio" name="answer" value="blink" onchange="onRadioButtonChange();">
                                    音楽に合わせる
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="songle"></div>
        </div>

        <div class="container">
            <section class="beat">
                <span class="info1">-</span>
                <span>/</span>
                <span class="info2">-</span>
            </section>
            <section class="chord">
                <span class="name">-</span>
            </section>
        </div>
    </section>
</body>

</html>

<script type="text/javascript">
    var obnizid = '<?php echo $_SESSION["obnizid"]; ?>';

</script>

<script type="text/javascript" src="testground.js"></script>



<link rel="stylesheet" href="./style.css">
<script src="./testground.js"></script>
