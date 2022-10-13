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
$comment_id = $_POST["comment_id"];
$datas = mysqli_query($mysql, "SELECT * FROM comments WHERE comment_id = {$comment_id};");
$base = NULL;
while($data = mysqli_fetch_assoc($datas)){
  ?>
  <form action="teradanokeijiban_edit1.php" method="post">
    <input type="password" name="delete" size="8" maxlength="8">
    <input type="hidden" name="comment_id" value ="<?php echo $_POST["comment_id"];?>">
    <input type="hidden" name="edit" value ="<?php echo $_POST["edit"];?>">
    <small>(英数字で8文字以内)</small>
    <input type="submit" value="編集">
  </form>
  <?php
}
// var_dump($data);
// exit;
?>
