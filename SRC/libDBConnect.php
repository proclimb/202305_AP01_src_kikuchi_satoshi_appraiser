<?php

//
// ログイン
//
function fnSqlLogin($id, $pw)
{
    $id = addslashes($id);
    $sql = "SELECT USERNO,AUTHORITY FROM TBLUSER";
    $sql .= " WHERE DEL = 1";
    $sql .= " AND ID = '$id'";
    $sql .= " AND PASSWORD = '$pw'";

    return ($sql);
}

//
// ユーザー情報リスト
//
function fnSqlAdminUserList()
{
    $sql = "SELECT USERNO,NAME,ID,PASSWORD,AUTHORITY FROM TBLUSER";
    $sql .= " WHERE DEL = 1";
    $sql .= " ORDER BY AUTHORITY ASC,NAME ASC";

    return ($sql);
}

//
// ユーザー情報詳細
//
function fnSqlAdminUserEdit($userNo)
{
    $sql = "SELECT NAME,ID,PASSWORD,AUTHORITY FROM TBLUSER";
    $sql .= " WHERE USERNO = $userNo";

    return ($sql);
}

//
// ユーザー情報更新
//
function fnSqlAdminUserUpdate($userNo, $name, $id, $password, $authority)
{
    //<!-- 7/24日 ユーザー情報_仕様書_NO31～による修正 -->
    //$pass = addslashes(hash('adler32', $password));
    $sql = "UPDATE TBLUSER";
    $sql .= " SET NAME = '$name'";
    $sql .= ",ID = '$id'";
    $sql .= ",PASSWORD = '$password'";
    $sql .= ",AUTHORITY = '$authority'";
    $sql .= ",UPDT = CURRENT_TIMESTAMP";
    $sql .= " WHERE USERNO = '$userNo'";

    return ($sql);
}

//
// ユーザー情報登録
//
function fnSqlAdminUserInsert($userNo, $name, $id, $password, $authority)
{
     //<!-- 7/24日 ユーザー情報_仕様書_NO31～による修正 -->
    //$pass = addslashes(hash('adler32', $password));
    $sql = "INSERT INTO TBLUSER(";
    $sql .= "USERNO,NAME,ID,PASSWORD,AUTHORITY,INSDT,UPDT,DEL";
    $sql .= ")VALUES(";
    $sql .= "'$userNo','$name','$id','$password','$authority',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,1)";

    return ($sql);
}

//
// ユーザー情報削除
//
function fnSqlAdminUserDelete($userNo)
{
    $sql = "UPDATE TBLUSER";
    $sql .= " SET DEL = 0";
    $sql .= ",UPDT = CURRENT_TIMESTAMP";
    $sql .= " WHERE USERNO = '$userNo'";

    return ($sql);
}

//
// 次の番号を得る
//
function fnNextNo($t)
{
    $conn = fnDbConnect();
    //<!-- 7/20日 ユーザー情報_仕様書_NO109～による修正 -->
    $sql = "SELECT MAX(" . $t . "NO) +1 FROM TBL" . $t;
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    if ($row[0]) {
        $max = $row[0];
    } else {
        $max = 1;
    }

    return ($max);
    var_dump($row[0]);
}
