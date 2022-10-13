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
?>
<a href="./teradanokeijiban.php">TOP<a>
<?php
$comment_id = $_POST["comment_id"];
// $query =("DELETE FROM comments WHERE comment_id = '$comment_id';");
// mysqli_query($mysql,$query);
// var_dump($comment_id);
// exit;
?>
<?php
$edit = $_POST["edit"];
$delete = $_POST["delete"];
$comment_id = $_POST["comment_id"];

if ($delete == $edit){
  $query =("DELETE FROM comments WHERE comment_id = '$comment_id';");
  mysqli_query($mysql,$query);
  echo "<p>削除完了</p>";
  echo "<a href='./teradanokeijiban.php'>TOP</a>";
}
else {
  echo "<p>ちがう</p>";
  echo "<a href='./teradanokeijiban.php'>TOP</a>";
}

?>
