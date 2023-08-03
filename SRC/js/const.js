//
//工事管理チェック
//
function fnConstEditCheck() {
	//<!-- 8/3日 工事管理_仕様書_NO138 による修正 -->
	tmp = form.area.value;
	if (tmp.length > 0 && !tmp.match(/^(\d{0,3}|\d{0,3}\.\d{0,2})$/)) {
		alert('面積は3桁以内（小数点以下2桁以内）の半角数字で入力してください');
		return;
	}
	tmp = form.years.value;
	if (tmp.length > 200) {
		alert('築年は200文字以内で入力してください');
		return;
	}
	tmp = form.sellPrice.value;
	if (tmp.length > 9 || tmp.match(/[^0-9]+/)) {
		alert('販売予定額は9桁以内の半角数字で入力してください');
		return;
	}
	tmp = form.interiorPrice.value;
	if (tmp.length > 9 || tmp.match(/[^0-9]+/)) {
		alert('内装見越額は9桁以内の半角数字で入力してください');
		return;
	}
	tmp = form.constTrader.value;
	if (tmp.length > 100) {
		alert('施工業者は100文字以内で入力してください');
		return;
	}
	tmp = form.constPrice.value;
	if (tmp.length > 9 || tmp.match(/[^0-9]+/)) {
		alert('工事金額は9桁以内の半角数字で入力してください');
		return;
	}
	tmp = form.constAdd.value;
	if (tmp.length > 100) {
		alert('追加工事は100文字以内で入力してください');
		return;
	}
	tmp = form.constNote.value;
	if (tmp.length > 200) {
		alert('備考は200文字以内で入力してください');
		return;
	}
	if (!fnYMDCheck("正しい買取決済日付", form.purchaseDT)) { return; }
	if (!fnYMDCheck("正しい工期開始日付", form.workStartDT)) { return; }
	if (!fnYMDCheck("正しい工期終了日付", form.workEndDT)) { return; }
	if (!fnYMDCheck("正しい電気水道開栓日付", form.lineOpenDT)) { return; }
	if (!fnYMDCheck("正しい電気水道閉栓日付", form.lineCloseDT)) { return; }
	if (!fnYMDCheck("正しい電気水道開栓連絡日", form.lineOpenContactDT)) { return; }
	if (!fnYMDCheck("正しい電気水道閉栓連絡日", form.lineCloseContactDT)) { return; }
	tmp = form.lineContactNote.value;
	if (tmp.length > 200) {
		alert('備考は200文字以内で入力してください');
		return;
	}
	tmp = form.electricityCharge.value;
	if (tmp.length > 100) {
		alert('電気連絡者は100文字以内で入力してください');
		return;
	}
	tmp = form.gasCharge.value;
	if (tmp.length > 100) {
		alert('ガス連絡者は100文字以内で入力してください');
		return;
	}
	tmp = form.receive.value;
	if (tmp.length > 100) {
		alert('荷＆鍵引取は100文字以内で入力してください');
		return;
	}
	tmp = form.hotWater.value;
	if (tmp.length > 100) {
		alert('給湯は100文字以内で入力してください');
		return;
	}
	if (!fnYMDCheck("正しい現調日付", form.siteDate)) { return; }
	tmp = form.leavingForm.value;
	if (tmp.length > 100) {
		alert('届出用紙は100文字以内で入力してください');
		return;
	}
	if (!fnYMDCheck("正しい届出期日", form.leavingDT)) { return; }
	tmp = form.manageCompany.value;
	if (tmp.length > 100) {
		alert('管理会社は100文字以内で入力してください');
		return;
	}
	tmp = form.floorPlan.value;
	if (tmp.length > 100) {
		alert('管理室は100文字以内で入力してください');
		return;
	}
	tmp = form.formerOwner.value;
	if (tmp.length > 100) {
		alert('前所有者は100文字以内で入力してください');
		return;
	}
	tmp = form.brokerCharge.value;
	if (tmp.length > 100) {
		alert('仲介会社（担当）は100文字以内で入力してください');
		return;
	}
	tmp = form.brokerContact.value;
	if (tmp.length > 100) {
		alert('仲介会社（連絡先）は100文字以内で入力してください');
		return;
	}
	tmp = form.interiorCharge.value;
	if (tmp.length > 100) {
		alert('内装担当者は100文字以内で入力してください');
		return;
	}

	if (confirm('この内容で登録します。よろしいですか？')) {
		form.act.value = 'constEditComplete';
		form.submit();
	}
}
