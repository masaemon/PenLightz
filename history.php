<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title> PenLightz history</title>
    <meta charset="UTF-8">
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
            <h1 class="title">履歴</h1>
            <h2 class="subtitle"> いままで利用した音楽を確認しましょう</h2>
        </div>
    </section>

    <section>
        <div class="container">
            <?php
$db = new PDO("sqlite:WPmusic.sqlite");
$result = $db->query("SELECT * FROM WPmusic ORDER BY id DESC");
            
for ($i = 0; $row = $result->fetch(); ++$i) {
    $id=substr($row['url'],-11);
  echo "<div class=\"card\"><div class=\"card-content\">";
  echo "<div class=\"media\">";
  echo "<figure class=\"media-left\">";
  echo "<p class=\"image is-256x256\">";
  echo "<img src=\"".$row["Imageurl"]."\"";
  echo "</img></p></figure>";
  echo "<div class=\"media-content\">";
  echo "<div class=\"content\"><p class=\"title is-5\">" . $row['name'] . "</p>";
  echo "<p><a href=\"playground.php?id=". $id . "&title=".$row['name']."&thumbnail=".$row["Imageurl"]."\"class=\"media-right button is-primary is-rounded\">この曲で遊ぶ</a></p>";
  echo "</div></div></div></div></div>";
}
?>
        </div>
    </section>
</body>

</html>
<style>

</style>
