<?php


$mysql = mysqli_connect('db', 'root', 'root');
if (!$mysql) {
  echo "接続に失敗しました".mysql_error();

}
echo '<p>接続に成功しました。</p>';
if(!empty($_FILES))
{
$filename = $_FILES['image']['name'];
$uploaded_path = "./css/".$filename;
$result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);

if($result)
{
$MSG = 'アップロード成功！ファイル名：'.$filename;
$img_path = $uploaded_path;

}else
{
$MSG = 'アップロード失敗！エラーコード：'.$_FILES['image']['error'];
}

}else
{
$MSG = '画像を選択してください';
}

// データベースの選択 use mysql_lesson; の事
$db_selected = mysqli_select_db($mysql, 'terada_thread');
if (!$db_selected){
  echo "データベースの選択に失敗しました".mysqli_error();
}
$preview = $_POST['preview'];
$name = $_POST["name"];
$subject = $_POST["subject"];
$message = $_POST["comment"];
$email = $_POST["email"];
$url = $_POST["url"];
$image = $uploaded_path;
date_default_timezone_set("Asia/Tokyo");
$time= date("Y-m-d H:i:s");
$edit = $_POST["edit"];
$font_color = $_POST["color"];

// もしプレビューが１なら確認画面に行く
if ($preview ==1){

?>
<form action="./teradanokeijiban_tenx.php" method="POST">
<?php

echo "<table border='1'>";
echo "<tr>";
$name = $_POST["name"];
echo "<td>名前:{$name}</td>";
echo "<br/>";
echo "<tr>";
$subject = $_POST["subject"];
echo "<td>件名:{$subject}</td>";
echo "<br/>";
echo "<tr>";
$message = $_POST["comment"];
echo "<td>メッセージ:{$message}</td>";
echo "<br/>";
echo "<tr>";
$email= $_POST["email"];
echo "<td>メールアドレス:{$email}</td>";
echo "<tr>";
$url= $_POST["url"];
echo "<td>url:{$url}</td>";
echo "</tr>";
echo "<hr />";
$font_color = $_POST['color'];
$preview = $_POST["preview"];
// var_dump($image);
// exit;
 ?>
<form action="./teradanokeijiban_tenx.php">

  <input type="hidden" name="name" value="<?php echo $name;?>"/>

  <input type="hidden" name="subject" value="<?php echo $subject;?>"/>

  <input type="hidden" name="comment" value="<?php echo $message;?>"/>

  <input type="hidden" name="email" value="<?php echo $email;?>"/>

  <input type="hidden" name="url" value="<?php echo $url;?>"/>

  <input type="hidden" name="image" value="<?php echo $image;?>"/>

  <input type="hidden" name="time" value="<?php echo $time;?>"/>

  <input type="hidden" name="edit" value="<?php echo $edit;?>"/>

  <input type="hidden" name="color" value="<?php echo $font_color;?>"/>

<button type="button" onclick="history.back()">訂正</button>
  <input type="submit" value="完了"/>
</form>
<?php
}
else
{$query ="INSERT INTO comments
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
  echo "投稿完了";
?>
<a href="./teradanokeijiban.php">TOP</a>
<?php
// var_dump($image);
// exit;
}
?>
