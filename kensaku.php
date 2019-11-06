<?php
$wordd = $_GET["word"];
$apikey = "YOUR_YOUTUBEDATAAPI_KEY";
$url = "https://www.googleapis.com/youtube/v3/search?type=video&part=snippet&q=" . $wordd . "&key=" . $apikey;
$json = file_get_contents($url);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$arr = json_decode($json, true);

if ($arr === null) {
  echo "データがありません";
} 
?>

<!DOCTYPE html>
<html lang="ja">

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
            <h1 class="title">検索結果</h1>
            <h2 class="subtitle">遊ぶ曲を選びましょう</h2>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <?php
  $etags = [];
  $dougaids = [];
  $thumbnails = [];
  for ($i = 0; $i < 5; ++$i) {
    $thumbnails[$i] = $arr["items"][$i]["snippet"]["thumbnails"]["default"]["url"];
    $etags[$i] = $arr["items"][$i]["snippet"]["title"];
    $dougaids[$i] = $arr["items"][$i]["id"]["videoId"];
    echo "<div class=\"card\">";
    echo "<div class=\"card-content\">";
    echo "<div class=\"media\">";
    echo "<figure class=\"media-left\">";
    echo "<p class=\"image is-256x256\">";
    echo "<img src=\"".$thumbnails[$i]."\"";
    echo "</img></p></figure>";
    echo "<div class=\"media-content\">";
    echo "<div class=\"content\"><p class=\"title is-5\">" . $etags[$i] . "</p>";
    echo "<p><a href=\"playground.php?id=". $dougaids[$i] . "&title=".$etags[$i]."&thumbnail=".$thumbnails[$i]."  \"class=\"media-right button is-primary is-rounded\">この曲で遊ぶ</a></p>";
    echo "</div></div></div></div></div>";
  }
?>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <form action="kensaku.php" method="get">
                <p class="title is-4">再検索</p>
                <input class="input is-rounded is-primary" type="text" placeholder="keyword" name="word">
                <input class="button is-primary is-rounded" id="submit" type="submit" value="検索">
            </form>
        </div>
    </section>
</body>

</html>
<style>
    #submit {
    margin-top:1.5rem;
  }
</style>


<div type="hidden" id="php-val" style="display:none;" data-val="<?= htmlspecialchars($dougaid, ENT_QUOTES, 'UTF-8') ?>"></div>
