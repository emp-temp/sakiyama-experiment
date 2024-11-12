<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>PostgreSQL 検索テスト</title>
</head>

<body>

<?php
    // ＤＢサーバへの接続
    $con = pg_connect("host=postgres port=5432 dbname=www user=apache password=passwordp");
    if (!$con){
        print "ＤＢサーバへの接続に失敗しました\n";
        exit;
    }

    // ＳＱＬ文の実行
    $sql = "SELECT school_table.sid, school_table.school, city_table.city FROM school_table INNER JOIN city_table ON school_table.cid = city_table.cid";
    $R = pg_query($con, $sql);
    if (!$R){
	print "SQL: ${sql};<br>\n";
        print "テーブルの検索に失敗しました\n";
        exit;
    }

    // 検索結果の件数
    $rows = pg_num_rows($R);

    // 検索結果の表示
    for ($i = 0; $i < $rows; $i++){
        $data = pg_fetch_array($R, $i);		// i番目の結果取得
        print $data['sid'] . ", " . $data['school'] . ", " . $data['city'] . "<br>\n";
        // print "${data['uid']}, ${data['name']}, ${data['tel']} <br>\n";
	// 上の print 文と同じ結果になる
    }

    // 検索結果の削除
    pg_free_result($R);

    // ＤＢサーバ切断
    pg_close($con);
?>

</body>
</html>

