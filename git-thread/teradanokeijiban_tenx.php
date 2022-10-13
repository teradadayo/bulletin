<?php

$mysql = mysqli_connect('db', 'root', 'root');
if (!$mysql) {
  echo "接続に失敗しました".mysql_error();
  exit;
}
echo '<p>接続に成功しました。</p>';

// データベースの選択 use mysql_lesson; の事
$db_selected = mysqli_select_db($mysql, 'terada_thread');
if (!$db_selected){
  echo "データベースの選択に失敗しました".mysqli_error();
  exit;
}

echo '<p>データベースの選択に成功しました。</p>';

?>
<a href="./teradanokeijiban.php">TOP<a>
<center>
  <h1>投稿完了です！ありがとうございます！<h1>
</center>

<?php
$preview = $_POST["preview"];
$name = $_POST["name"];
$subject = $_POST["subject"];
$message = $_POST["comment"];
$email = $_POST["email"];
$url = $_POST["url"];
$image = $_POST["image"];
date_default_timezone_set("Asia/Tokyo");
$time= date("Y-m-d H:i:s");
$edit = $_POST["edit"];
$font_color = $_POST["color"];
// var_dump($image);
// exit;


//Edit ga kara dato kanma ga tuduityaunode settei
// if(empty($edit)) {
//   $edit = 1234;
// }

$query ="INSERT INTO comments
values(
NULL,
'$name',
'$subject',
'$message',
'$image',
'$email',
'$url',
'$font_color',
'$edit',
'$time'
);";
mysqli_query($mysql,$query);

?>
