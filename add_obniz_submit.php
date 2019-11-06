<?php
session_start();
if (isset($_GET["obnizid"])) {
  $obnizid = $_GET["obnizid"];
  if (preg_match("/\d\d\d\d-\d\d\d\d/", $obnizid)) {
    $result = "obnizの登録が完了しました。";
    $_SESSION["obnizid"] = $obnizid;
  } else {
    $result = "IDの形式が違います。";
  }
} else {
  $result = "入力がありません。";
}
$session=$_SESSION["obnizid"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
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
if (isset($_SESSION["obnizid"])) {
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
            <?php
print '<p style="text-align:center;" class="title">' . $result . '</p>';
             
            ?>
        </div>

    </section>
</body>

</html>
