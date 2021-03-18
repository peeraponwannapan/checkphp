<?php
//Connect MSSQL
$serverName = '192.168.16.3';
$userName = 'fuser';
$userPassword = 'userf';
$dbName = 'ForthHardwareR';
$port = 1433;
 
try{
	$conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	die(print_r($e->getMessage()));
}
 
//การ query และแสดงข้อมูล จัดเรียงตามฟิวด์ field1 แบบมากไปน้อย เริ่มที่เรคคอร์ดที่ 0-100
$query = " SELECT H_COMNAME,H_ASSET, H_SERIAL_NO,D_DESC, B_BRAND,H_COMMODEL 
FROM HARDWARE 
INNER JOIN DEPARTMENT 
ON H_D_ID = D_ID 
INNER JOIN BRAND 
ON H_B_ID = B_ID 
WHERE(H_DEL_FLAG < > 'D')";
$getRes = $conn->prepare($query);
$getRes->execute();
 
while($row = $getRes->fetch( PDO::FETCH_ASSOC ))
{
echo $row['H_COMNAME']."<br />";
echo $row['H_ASSET']."<br />";
}
?>