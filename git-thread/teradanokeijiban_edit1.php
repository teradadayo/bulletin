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
// exit;å
?>
<?php
$edit = $_POST["edit"];
$delete = $_POST["delete"];
$comment_id = $_POST["comment_id"];
$datas = mysqli_query($mysql, "SELECT * FROM comments WHERE comment_id = {$comment_id};");
$base = NULL;
while($data = mysqli_fetch_assoc($datas)){
  if ($delete == $edit){
  ?>
    <form action="teradanokeijiban_edit0.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="comment_id" value="<?php echo $data["comment_id"];?>">
        <input type="hidden" name="image" value="<?php echo $data["image"];?>">
      <hr/>

      <center>
        <h2>寺田掲示板</h2>
      </center>
      <table>
        <tr>
          <th>名前</th>
          <td>
            <input type="text" name="name" value="<?php echo $data['name']?>"/>
          </td>
        </tr>
        <tr>
          <th>件名</th>
          <td>
            <input type="text" name="subject" value="<?php echo $data["subject"]?>"/>
          </td>
        </tr>
        <tr>
          <th>メッセージ</th>
          <td>
            <textarea name="comment" rows="5" cols="40"><?php echo $data["message"]?></textarea>
          </td>
        </tr>
        <tr>
          <th>画像</th>
          <td>
            <input type="file" name="image" accept="image/*" value="<?php echo $data["image"]?>"/>
          </td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>
            <input type="email" name="email" value="<?php echo $data["email_address"]?>"/>
          </td>
        </tr>
        <tr>
          <th>URL</th>
          <td>
            <input type="text" name="url" value="<?php echo $data["url"]?>"/>
          </td>
        </tr>
        <tr>
          <th>文字色</th>
          <td>
            <!-- 黒 -->
            <label>
              <input type="radio" name="color" value="black">
              <font color="black">■</font>
            </label>

            <!-- 青 -->
            <label>
              <input type="radio" name="color" value="blue">
              <font color="blue">■</font>
            </label>

            <!-- 緑 -->
            <label>
              <input type="radio" name="color" value="green">
              <font color="green">■</font>
            </label>

            <!-- ラベンダー -->
            <label>
              <input type="radio" name="color" value="lavender">
              <font color="lavender">■</font>
            </label>

          </td>
        </tr>
        <tr>
          <th>編集/削除キー</th>
          <td>
            <input type="password" name="edit" size="8" maxlength="8" value="<?php echo $_POST["edit"]; ?>">
            <small>(英数字で8文字以内)</small>
          </td>
        </tr>
        <tr>
          <th colspan="2" align="right">
            <input type="submit" value="編集する"　/>
          </th>
        </tr>
      </table>
    <?php

  }
  else {
    echo "<p>ちがう</p>";
    echo "<a href='./teradanokeijiban.php'>TOP</a>";
  }

}
?>
