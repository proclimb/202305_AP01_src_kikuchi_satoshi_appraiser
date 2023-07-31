<?php
//
//物件管理画面
//
function subArticle()
{
	$conn = fnDbConnect();

	//<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
	//<!-- 7/27日 物件管理_仕様書_NO143 による修正 :subArticle内の;漏れ多数を補記〈多すぎるためマークは省略〉-->
	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	$sDrawing     = htmlspecialchars($_REQUEST['sDrawing']);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);

	$orderBy = $_REQUEST['orderBy'];
	$orderTo = $_REQUEST['orderTo'];
	$sPage   = $_REQUEST['sPage'];

	//<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
	if ($sDel == '') {
		$sDel = 1;
	}

	//<!-- 7/26日 物件管理_仕様書_NO116～NO123ほか による修正 -->
	if (!$sPage) {
		$sPage = 1;
	}

	if (!$orderBy) {
		$orderBy = 'ARTICLENO';
		//<!-- 7/31日 物件管理_仕様書_NO145 による修正 -->
		$orderTo = 'ASC';
	}

	subMenu();
?>

	<h1>物件管理一覧</h1>

	<form name="form" id="form" action="index.php" method="post">
		<input type="hidden" name="act" value="articleSearch" />
		<input type="hidden" name="orderBy" value="<?php print $orderBy; ?>" />
		<input type="hidden" name="orderTo" value="<?php print $orderTo; ?>" />
		<input type="hidden" name="sPage" value="<?php print $sPage; ?>" />
		<input type="hidden" name="articleNo" />
		<input type="hidden" name="sName" />
		<!-- 7/28日 物件管理_仕様書_NO111の4による修正 -->
		<!-- <input type="hidden" name="sRoom" /> -->

		<a href="javascript:form.act.value='articleEdit';form.submit();"><img src="./images/btn_enter.png"></a>

		<div class="search">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<th>除外</th>
					<!-- 7/25日 物件管理_仕様書_NO7による修正 -->
					<td><input type="checkbox" name="sDel" value="0" /></td>
					<th>備考</th>
					<td><input type="text" name="sArticleNote" value="<?php print $sArticleNote; ?>" size="50" /></td>
				</tr>
				<tr>
					<th>物件名</th>
					<!-- 7/26日 物件管理_仕様書_NO116～NO123ほか による修正 -->
					<!-- 7/26日 物件管理_仕様書_NO111ほか による修正 -->
					<td><input type="text" name="sArticle" value="<?php print $sArticle; ?>" size="50" /></td>
					<th>キーBox番号</th>
					<td><input type="text" name="sKeyBox" value="<?php print $sKeyBox; ?>" size="30" /></td>
				</tr>
				<tr>
					<th>部屋番号</th>
					<!-- 7/26日 物件管理_仕様書_NO111ほか による修正 -->
					<!-- 7/27日 物件管理_仕様書_NO128 による修正 -->
					<td><input type="text" name="sRoom" value="<?php print $sRoom; ?>" size="30" /></td>
					<th>3Dパース</th>
					<td><input type="text" name="sDrawing" value="<?php print $sDrawing; ?>" size="30" /></td>
				</tr>
				<tr>
					<th>鍵場所</th>
					<!-- 7/26日 物件管理_仕様書_NO116～NO123ほか による修正 -->
					<td><input type="text" name="sKeyPlace" value="<?php print $sKeyPlace; ?>" size="30" /></td>
					<th>営業担当者</th>
					<td><input type="text" name="sSellCharge" value="<?php print $sSellCharge; ?>" /></td>
				</tr>
			</table>
		</div>

		<input type="image" src="./images/btn_search.png" onclick="form.act.value='articleSearch';form.sPage.value=1;form.submit();" />

		<hr />
	
		<?php
		if ($_REQUEST['act'] == 'article') {
			return;
		}

		$sql = fnSqlArticleList(0, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo);
		//<!-- 7/26日 物件管理_仕様書_NO116～NO123ほか による修正 -->
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($res);

		$count = $row[0];

		$sPage = fnPage($count, $sPage, 'articleSearch');
		?>

		<div class="list">
			<table border="0" cellpadding="5" cellspacing="1">
				<tr>
					<th class="list_head">物件名<?php fnOrder('ARTICLE', 'articleSearch'); ?></th>
					<th class="list_head">部屋<?php fnOrder('ROOM', 'articleSearch'); ?></th>
					<th class="list_head">鍵場所<?php fnOrder('KEYPLACE', 'articleSearch'); ?></th>
					<th class="list_head">備考<?php fnOrder('ARTICLENOTE', 'articleSearch'); ?></th>
					<th class="list_head">書類</th>
					<th class="list_head">キーBox番号<?php fnOrder('KEYBOX', 'articleSearch'); ?></th>
					<th class="list_head">3Dパース<?php fnOrder('DRAWING', 'articleSearch'); ?></th>
					<th class="list_head">営業担当者<?php fnOrder('SELLCHARGE', 'articleSearch'); ?></th>
				</tr>

				<?php
				$sql = fnSqlArticleList(1, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo);
				$res = mysqli_query($conn, $sql);
				$i = 0;
				while ($row = mysqli_fetch_array($res)) {
					//<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
					$articleNo   = htmlspecialchars($row[0]);
					$article     = htmlspecialchars($row[1]);
					$room        = htmlspecialchars($row[2]);
					$keyPlace    = htmlspecialchars($row[3]);
					$articleNote = htmlspecialchars($row[4]);
					$keyBox      = htmlspecialchars($row[5]);
					$drawing     = htmlspecialchars($row[6]);
					$sellCharge  = htmlspecialchars($row[7]);
				?>
				<tr>
					<!-- 7/26日 物件管理_仕様書_NO116～NO123ほか による修正 -->
					<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
					<td class="list_td<?php print $i; ?>"><a href="javascript:form.act.value='articleEdit';form.articleNo.value='<?php print $articleNo; ?>';form.submit();"><?php print $article; ?></a></td>
					<td class="list_td<?php print $i; ?>"><?php print $room; ?></td>
					<td class="list_td<?php print $i; ?>"><?php print $keyPlace; ?></td>
					<td class="list_td<?php print $i; ?>"><?php print $articleNote; ?></td>
					<!-- 7/28日 物件管理_仕様書_NO96 による修正 -->
					<td class="list_td<?php print $i; ?>"><a href="javascript:form.act.value='fManager';form.sName.value='<?php print $article; ?>';form.sRoom.value='<?php print $room; ?>';form.submit();">表示</a></td>
					<td class="list_td<?php print $i; ?>"><?php print $keyBox; ?></td>
					<td class="list_td<?php print $i; ?>"><?php print $drawing; ?></td>
					<td class="list_td<?php print $i; ?>"><?php print $sellCharge; ?></td>
				</tr>
				<!-- 7/27日 物件管理_仕様書_NO143 による修正 -->
				<?php 
					$i = ($i + 1) % 2;
				}
				?>
			</table>
		</div>
	</form>
<?php } ?>



<?php
//
//物件管理編集画面
//
function subArticleEdit()
{
	$conn = fnDbConnect();

	//<!-- 7/28日 物件管理_仕様書_NO112 による修正 -->
	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	$sDueDTFrom   = htmlspecialchars($_REQUEST['sDueDTFrom']);
	$sDueDTTo     = htmlspecialchars($_REQUEST['sDueDTTo']);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);

	$orderBy = $_REQUEST['orderBy'];
	$orderTo = $_REQUEST['orderTo'];
	$sPage   = $_REQUEST['sPage'];

	$articleNo = $_REQUEST['articleNo'];

	if ($articleNo) {
		$sql = fnSqlArticleEdit($articleNo);
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($res);

		$article     =  htmlspecialchars($row[0]);
		$room        =  htmlspecialchars($row[1]);
		$keyPlace    =  htmlspecialchars($row[2]);
		$address     =  htmlspecialchars($row[3]);
		$articleNote =  htmlspecialchars($row[4]);
		$keyBox      =  htmlspecialchars($row[5]);
		$sellCharge  =  htmlspecialchars($row[6]);
		$del         =  htmlspecialchars($row[7]);
		$drawing     =  htmlspecialchars($row[8]);

		$purpose  = '更新';
		$btnImage = 'btn_load.png';
	} else {
		$purpose = '登録';
		$btnImage = 'btn_enter.png';
	}

	//<!-- 7/25日 物件管理_仕様書_NO7による修正 -->
	subMenu();
?>
	<script type="text/javascript" src="./js/article.js"></script>

	<!-- 7/31日 物件管理_仕様書_NO112による修正 -->
	<h1>物件<?php print $purpose; ?></h1>

	<form name="form" id="form" action="index.php" method="post">
		<input type="hidden" name="act" />
		<input type="hidden" name="sDel" value="<?php print $sDel; ?>" />
		<input type="hidden" name="sArticle" value="<?php print $sArticle; ?>" />
		<input type="hidden" name="sRoom" value="<?php print $sRoom; ?>" />
		<input type="hidden" name="sKeyPlace" value="<?php print $sKeyPlace;  ?>" />
		<input type="hidden" name="sArticleNote" value="<?php print $sArticleNote; ?>" />
		<input type="hidden" name="sKeyBox" value="<?php print $sKeyBox; ?>" />
		<input type="hidden" name="sDueDTFrom" value="<?php print $sDueDTFrom; ?>" />
		<input type="hidden" name="sDueDTTo" value="<?php print $sDueDTTo; ?>" />
		<input type="hidden" name="sSellCharge" value="<?php print $sSellCharge; ?>" />
		<input type="hidden" name="orderBy" value="<?php print $orderBy; ?>" />
		<input type="hidden" name="orderTo" value="<?php print $orderTo; ?>" />
		<input type="hidden" name="sPage" value="<?php print $sPage; ?>" />
		<input type="hidden" name="articleNo" value="<?php print $articleNo; ?>" />

		<table border="0" cellpadding="5" cellspacing="1">
			<tr>
				<th>除外</th>
				<?php if ($articleNo) { ?>
					<td>
						<!-- 7/31日 物件管理_仕様書_NO34による修正 -->
						<input type="radio" name="del" value="1" checked="checked" /> 非除外
						<input type="radio" name="del" value="0" <?php if ($del == '0') print ' checked="checked"'; ?> /> 除外
					</td>
				<?php } else { ?>
					<td>
						<input type="radio" name="del" value="1" checked="checked" /> 非除外
						<input type="radio" name="del" value="0" <?php if ($del == '0') print ' checked="checked"'; ?> /> 除外
					</td>
				<?php } ?>
			</tr>
			<tr>
				<th>物件名<span class="red">（必須）</span></th>
				<td><input type="text" name="article" value="<?php print $article; ?>" /></td>
			</tr>
			<tr>
				<th>部屋番号</th>
				<td><input type="text" name="room" value="<?php print $room; ?>" /></td>
			</tr>
			<tr>
				<th>鍵場所</th>
				<td><textarea name="keyPlace" cols="50" rows="10"><?php print $keyPlace; ?></textarea></td>
			</tr>
			<tr>
				<th>住所</th>
				<td><input type="text" name="address" value="<?php print $address; ?>" /></td>
			</tr>
			<tr>
				<th>備考</th>
				<td><textarea name="articleNote" cols="50" rows="10"><?php print $articleNote; ?></textarea></td>
			</tr>
			<tr>
				<th>キーBox番号</th>
				<td><input type="text" name="keyBox" value="<?php print $keyBox; ?>" /></td>
			</tr>
			<tr>
				<th>3Dパース</th>
				<td><input type="text" name="drawing" value="<?php print $drawing; ?>" /></td>
			</tr>
			<tr>
				<th>営業担当者</th>
				<td><input type="text" name="sellCharge" value="<?php print $sellCharge; ?>" /></td>
			</tr>
		</table>

		<a href="javascript:fnArticleEditCheck();"><img src="./images/<?php print $btnImage; ?>" /></a>
		<!-- 7/26日 物件管理_仕様書_NO98による修正 -->
		<a href="javascript:form.act.value='articleSearch';form.submit();"><img src="./images/btn_return.png" /></a>
		&nbsp;&nbsp;
		<!-- 7/26日 物件管理_仕様書_NO61による修正 -->
		<?php if ($articleNo) { ?>
		<a href="javascript:fnArticleDeleteCheck(<?php print $articleNo; ?>);"><img src="./images/btn_del.png" /></a>
		<?php } ?>
	</form>
<?php } ?>



<?php
//
//物件管理編集完了処理
//
function subArticleEditComplete()
{
	require_once('libDBFManager.php');
	$conn = fnDbConnect();

	//<!-- 7/28日 物件管理_仕様書_NO112による修正 -->
	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	$sDueDTFrom   = htmlspecialchars($_REQUEST['sDueDTFrom']);
	$sDueDTTo     = htmlspecialchars($_REQUEST['sDueDTTo']);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);

	$orderBy = $_REQUEST['orderBy'];
	$orderTo = $_REQUEST['orderTo'];
	$sPage   = $_REQUEST['sPage'];

	//<!-- 7/28日 物件管理_仕様書_NO112による修正 -->
	$articleNo   = mysqli_real_escape_string($conn, $_REQUEST['articleNo']);
	$article     = mysqli_real_escape_string($conn, $_REQUEST['article']);
	$room        = mysqli_real_escape_string($conn, $_REQUEST['room']);
	$keyPlace    = mysqli_real_escape_string($conn, $_REQUEST['keyPlace']);
	$address     = mysqli_real_escape_string($conn, $_REQUEST['address']);
	$articleNote = mysqli_real_escape_string($conn, $_REQUEST['articleNote']);
	$keyBox      = mysqli_real_escape_string($conn, $_REQUEST['keyBox']);
	$drawing     = mysqli_real_escape_string($conn, $_REQUEST['drawing']);
	$sellCharge  = mysqli_real_escape_string($conn, $_REQUEST['sellCharge']);
	$del         = mysqli_real_escape_string($conn, $_REQUEST['del']);

	if ($articleNo) {
		// 編集
		//<!-- 7/26日 物件管理_仕様書_NO111の２ による修正 -->・・見込みで修正
		$sql = fnSqlArticleUpdate($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $sellCharge, $del, $drawing);
		$res = mysqli_query($conn, $sql);

		//<!-- 7/31日 物件管理_仕様書_NO112による修正 -->
		$name=$article;
		$note=$articleNote;
		$sql = fnSqlFManagerUpdate($fMNo,$name,$room,$note,$del);
		$res = mysqli_query($conn,$sql);
	} else {
		// 新規登録
		//<!-- 7/26日 物件管理_仕様書_NO111の２ による修正 -->
		$sql = fnSqlArticleInsert(fnNextNo('ARTICLE'), $article, $room, $keyPlace, $address, $articleNote, $keyBox, $sellCharge, $del, $drawing);
		$res = mysqli_query($conn, $sql);

		//<!-- 7/28日 物件管理_仕様書_NO111の３ による修正 -->
		$name=$article;
		$note=$articleNote;
		$sql = fnSqlFManagerInsert(fnNextNo('FM'),$name,$room,$note,$del);
		$res = mysqli_query($conn,$sql);
		
	}

	$_REQUEST['act'] = 'articleSearch';
	subArticle();
}
?>


<?php
//
//物件管理削除処理
//
function subArticleDelete()
{
	$conn = fnDbConnect();

	$articleNo = $_REQUEST['articleNo'];

	$sql = fnSqlArticleDelete($articleNo);
	$res = mysqli_query($conn, $sql);

	$_REQUEST['act'] = 'articleSearch';
	subArticle();
}
?>