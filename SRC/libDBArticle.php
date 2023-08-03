<?php
//
//物件管理リスト
//
function fnSqlArticleList($flg, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo)
{
	switch ($flg) {
		case 0:
			$sql  = "SELECT COUNT(*)";
			break;
		case 1:
			//<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
			$sql  = "SELECT ARTICLENO, ARTICLE, ROOM, KEYPLACE, ARTICLENOTE, KEYBOX, DRAWING, SELLCHARGE";
			break;
	}
	$sql .= " FROM TBLARTICLE";
	$sql .= " WHERE DEL = $sDel";
	//<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
	if ($sArticle) {
		$sql .= " AND ARTICLE LIKE '%$sArticle%'";
	}
	if ($sRoom) {
		$sql .= " AND ROOM LIKE '%$sRoom%'";
	}
	if ($sKeyPlace) {
		$sql .= " AND KEYPLACE LIKE '%$sKeyPlace%'";
	}
	if ($sArticleNote) {
		$sql .= " AND ARTICLENOTE LIKE '%$sArticleNote%'";
	}
	if ($sKeyBox) {
		$sql .= " AND KEYBOX LIKE '%$sKeyBox%'";
	}
	if ($sDrawing) {
		$sql .= " AND DRAWING LIKE '%$sDrawing%'";
	}
	if ($sSellCharge) {
		$sql .= " AND SELLCHARGE LIKE '%$sSellCharge%'";
	}
	if ($orderBy) {
		$sql .= " ORDER BY $orderBy $orderTo";
	}
	if ($flg) {
		$sql .= " LIMIT " . (($sPage - 1) * PAGE_MAX) . ", " . PAGE_MAX;
	}

	return ($sql);
}



//
//物件管理情報
//
function fnSqlArticleEdit($articleNo)
{
	//<!-- 7/31日 物件管理_仕様書_NO112による修正(ここだけ並び順がほかと違うので、併せて修正) -->
	$sql  = "SELECT ARTICLE, ROOM, KEYPLACE, ADDRESS, ARTICLENOTE, KEYBOX, SELLCHARGE, DEL, DRAWING";
	$sql .= " FROM TBLARTICLE";
	//<!-- 7/31日 物件管理_仕様書_NO112による修正(多分直接関係ないが、固定で１はおかしいので、併せて修正) -->
	$sql .= " WHERE ARTICLENO = $articleNo";

	return ($sql);
}



//
//物件管理情報更新
//
//<!-- 7/28日 物件管理_仕様書_NO112 による修正 -->
function fnSqlArticleUpdate($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $sellCharge, $del, $drawing)
{
	$sql  = "UPDATE TBLARTICLE";
	$sql .= " SET ARTICLE = '$article'";
	$sql .= ",ROOM = '$room'";
	$sql .= ",KEYPLACE = '$keyPlace'";
	//<!-- 7/31日 物件管理_仕様書_NO112による修正 -->
	$sql .= ",ADDRESS = '$address'";
	$sql .= ",ARTICLENOTE = '$articleNote'";
	$sql .= ",KEYBOX = '$keyBox'";
	$sql .= ",SELLCHARGE = '$sellCharge'";
	$sql .= ",DEL = '$del'";
	$sql .= ",DRAWING = '$drawing'";
	//<!-- 7/31日 物件管理_仕様書_NO147による修正 -->
	$sql .= ",UPDT = CURRENT_TIMESTAMP";
	$sql .= " WHERE ARTICLENO = '$articleNo'";

	return ($sql);
}



//
//物件管理情報登録
//
//<!-- 7/26日 物件管理_仕様書_NO111の２ による修正 -->
function fnSqlArticleInsert($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $sellCharge, $del, $drawing)
{
	//<!-- 7/26日 物件管理_仕様書_NO111ほか による修正 -->
	//<!-- 7/26日 物件管理_仕様書_NO111の２ による修正 -->
	$sql  = "INSERT INTO TBLARTICLE (";
	$sql .= " ARTICLENO, ARTICLE, ROOM, KEYPLACE, ADDRESS, ARTICLENOTE, KEYBOX, DUEDT, SELLCHARGE, AREA, YEARS, SELLPRICE, INTERIORPRICE, CONSTTRADER,"
		. " CONSTPRICE, CONSTADD, CONSTNOTE, PURCHASEDT, WORKSTARTDT, WORKENDDT, LINEOPENDT, LINECLOSEDT, RECEIVE, HOTWATER, SITEDT, LEAVINGFORM,"
		. " LEAVINGDT, MANAGECOMPANY, FLOORPLAN, FORMEROWNER, BROKERCHARGE, BROKERCONTACT, INTERIORCHARGE, CONSTFLG1, CONSTFLG2, CONSTFLG3, CONSTFLG4, INSDT, UPDT, DEL,"
		. " DRAWING, LINEOPENCONTACTDT, LINECLOSECONTACTDT, LINECONTACTNOTE, ELECTRICITYCHARGE, GASCHARGE, LIGHTORDER";
	$sql .= " ) VALUES ( ";
	$sql .= "'$articleNo', '$article', '$room', '$keyPlace', '$address', '$articleNote', '$keyBox', '', '$sellCharge', '', '', '', '', '',"
		. " '', '', '', '', '', '', '', '', '', '', '', '',"
		. " '', '', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$del',"
		. " '$drawing', '', '', '', '', '', '' )";

	return ($sql);
}



//
//物件管理情報削除
//
function fnSqlArticleDelete($articleNo)
{
	$sql  = "UPDATE TBLARTICLE";
	//<!-- 7/31日 物件管理_仕様書_NO148による修正 -->
	$sql .= " SET DEL = -1";
	$sql .= ",UPDT = CURRENT_TIMESTAMP";
	$sql .= " WHERE ARTICLENO = '$articleNo'";

	return ($sql);
}
