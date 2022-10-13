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

echo '<p>データベースの選択に成功しました。</p>';

?>

<!DOCTYPE html>
<head>
  <title>寺田の掲示板</title>
</head>
<body>

<form action="teradanokeijiban_confirm.php" method="POST" enctype="multipart/form-data">

  <hr/>

  <center>
    <h2>寺田掲示板</h2>
  </center>
  <table>
    <tr>
      <th>名前</th>
      <td>
        <input type="text" name="name"/>
      </td>
    </tr>
    <tr>
      <th>件名</th>
      <td>
        <input type="text" name="subject"/>
      </td>
    </tr>
    <tr>
      <th>メッセージ</th>
      <td>
        <textarea name="comment" rows="5" cols="40"></textarea>
      </td>
    </tr>
    <tr>
      <th>画像</th>
      <td>
        <input type="file" name="image" accept="image/*">
      </td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td>
        <input type="email" name="email">
      </td>
    </tr>
    <tr>
      <th>URL</th>
      <td>
        <input type="text" name="url">
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
        <input type="number" name="edit" size="8" maxlength="4" value="2222">
        <small>(数字で4文字以内)</small>
      </td>
    </tr>
    <tr>
     <td colspan="2"><input type="checkbox" name="preview" value="1">
        プレビューする（投稿前に、内容をプレビューして確認できます）
      </th>
    </tr>
    <tr>
      <th colspan="2" align="right">
        <input type="submit" value="送信"　/>
        <input type="reset" value="リセット"　/>
      </th>
    </tr>
  </table>
</form>
<?php
// "<font_color = blue>".
// $queryという変数を用意して、"SELECT * FROM comments order by name"という文字列を用意する
// $query = "SELECT * FROM comments order by name;";

// $queryの文字列を、接続済みのMySQL（$mysqlが接続情報もってる）に打つ
$datas = mysqli_query($mysql, "SELECT * FROM comments ORDER BY comment_id DESC");
// もしSELECT*FROM〜〜が存在するなら
if(!empty($datas)){
  // 取得してきた件数を頭からwhile(loop)し、一行ずつ$dataに代入
  while($data = mysqli_fetch_assoc($datas)){

    //$data = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM comments ORDER BY comment_id DESC"));
    echo "<table border='1'>";
    echo "<tr>\n";
    echo "<td>No.</td>";
    echo "<td>".$data["comment_id"]."</td>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>名前:</td>";
    echo "<td>"."<font color = ".$data['font_color'].">".$data["name"]."</td>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>件名:</td>";
    echo "<td>"."<font color = ".$data['font_color'].">".$data["subject"]."</td>"."</font>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>メッセージ:</td>";
    echo "<td><font color ='{$data['font_color']}'>". nl2br($data["message"]) ."</td>";
    echo "</tr>\n";
    // もしも　どるでーたイメージが　どっとすらっしゅしーえすえすすらっしゅ　じゃなかったら
    if(!empty($data["image"]) && $data["image"] != "./css/"){
      echo "<tr>";
      echo "<td>画像:</td>";
      echo "<td><img src='{$data["image"]}' width='200' height='200'/></td>";
      echo "</tr>\n";
    }
    echo "<tr>";
    echo "<td>メールアドレス:</td>";
    echo "<td>".$data["email_address"]."</td>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>Url:</td>";
    echo "<td>".$data["url"]."</td>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>EDIT</td>";
    echo "<td>".$data["edit"]."</td>";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td>時間:</td>";
    echo "<td>".$data["time"]."</td>";
    echo "</tr>\n";
    ?>
    <tr>
      <td>
        <form action="teradanokeijiban_sakujyo.php" method="post">
          <input type="hidden" name="comment_id" value="<?php echo $data["comment_id"];?>">
          <input type="hidden" name="edit" value="<?php echo $data["edit"];?>">
    	    <input type="submit" value="削除する">
        </form>
          <form action="teradanokeijiban_hensin.php" method="post">
            <input type="hidden" name="comment_id" value="<?php echo $data["comment_id"];?>">
            <input type="hidden" name="edit" value="<?php echo $data["edit"];?>">
        	<input type="submit" value="返信">
        </form>
        <form action="teradanokeijiban_edit.php" method="post">
          <input type="hidden" name="comment_id" value="<?php echo $data["comment_id"];?>">
          <input type="hidden" name="edit" value="<?php echo $data["edit"];?>">
        	<input type="submit" value="編集">
        </form>
      </td>
    </tr>
  </table>
    <?php
    $res = mysqli_query($mysql, "SELECT * FROM threads WHERE comment_id =".$data["comment_id"]." ORDER BY comment_id DESC");
    if(!empty($res)){
      // 取得してきた件数を頭からwhile(loop)し、一行ずつ$dataに代入
      while($re = mysqli_fetch_assoc($res)){
        echo "<table border='1' class= 'hensin'>\n";
        echo "<tr>\n";

        echo "<td>No.</td>\n";
        echo "<td>".$re["comment_id"]."</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>名前:</td>\n";
        echo "<td>"."<font color = ".$re['font_color'].">".$re["name"]."</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>件名:</td>";
        echo "<td>"."<font color = ".$re['font_color'].">".$re["subject"]."</td>"."</font>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>メッセージ:</td>\n";
        echo "<td><font color ='{$re['font_color']}'>" . nl2br($re["message"]) . "</td>\n";
        echo "</tr>\n";
        // もしも　どるでーたイメージが　どっとすらっしゅしーえすえすすらっしゅ　じゃなかったら
        if(!empty($re["image"]) && $re["image"] != "./css/"){
          echo "<tr>\n";
          echo "<td>画像:</td>\n";
          echo "<td><img src='{$re["image"]}' width='200' height='200'/></td>\n";
          echo "</tr>\n";
        }
        echo "<tr>\n";
        echo "<td>メールアドレス:</td>\n";
        echo "<td>".$re["email_address"]."</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Url:</td>\n";
        echo "<td>".$re["url"]."</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>EDIT</td>\n";
        echo "<td>".$re["edit"]."</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>時間:</td>\n";
        echo "<td>".$re["time"]."</td>\n";
        echo "</tr>\n";

        echo "</table>\n";
        // var_dump($data);
        // exit;
      }
    }
    echo"<hr />";
  }
}
?>
<style>
.hensin {
  background-color: #f4f4f4;
  padding-left: 300px;
  margin: 10px;
}
.hensin td {
 align:right;
 text-align:right;
 border:1px dash #000;
}
</style>
