<?php

$mysql = mysqli_connect('db', 'root', 'root');
if (!$mysql) {
  echo "接続に失敗しました".mysql_error();
  exit;
}
echo '<p>接続に成功しました。</p>';

$db_selected = mysqli_select_db($mysql, 'terada_thread');
if (!$db_selected){
  echo "データベースの選択に失敗しました".mysqli_error();
  exit;
}

// 後々Upload_Pathを使うので初期化
$uploaded_path = "";

// Upload Method
if(!empty($_FILES)) {
  $filename = $_FILES['image']['name'];

  // アップロードされていれば代入
  $uploaded_path = "./css/".$filename;
  $result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);


  if($result) {
    $MSG = 'アップロード成功！ファイル名：'.$filename;
    $img_path = $uploaded_path;

  } else {
    $MSG = 'アップロード失敗！エラーコード：'.$_FILES['image']['error'];
  }


} else {
  $MSG = '画像を選択してください';
}

$comment_id = $_POST["comment_id"];
$preview = $_POST["preview"];
$name = $_POST["name"];
$subject = $_POST["subject"];
$message = $_POST["comment"];
$email = $_POST["email"];
$url = $_POST["url"];

  // アップロードされていれば代入　されてなければ　””のまま。
$image = $uploaded_path;

date_default_timezone_set("Asia/Tokyo");
$time= date("Y-m-d H:i:s");
$edit = $_POST["edit"];
$font_color = $_POST["color"];
$query = "INSERT INTO threads
values(
NULL,
'$comment_id',
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
echo "返信完了";
echo "<a href='./teradanokeijiban.php'>TOP</a>";
// var_dump($query);
// exit;
?>
