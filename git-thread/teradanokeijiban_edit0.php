<?php

$mysql = mysqli_connect('db', 'root', 'root');
if (!$mysql) {
  echo "接続に失敗しました".mysql_error();
}
$db_selected = mysqli_select_db($mysql, 'terada_thread');
if (!$db_selected){
  echo "データベースの選択に失敗しました".mysqli_error();
  exit;
}
$comment_id = $_POST["comment_id"];
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


if(!empty($uploaded_path)) {
  $image = $uploaded_path;
}


$query ="UPDATE comments SET
name = '$name',subject = '$subject',message = '$message',image = '$image', email_address = '$email',
url = '$url',edit = $edit,font_color= '$font_color',time = '$time'
WHERE comment_id = '$comment_id';";

// var_dump($query);
// exit;

mysqli_query($mysql,$query);



echo "<a href='./teradanokeijiban.php'>TOP</a>";


?>
<p>編集完了</p>
