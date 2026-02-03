<?php
$con = mysql_connect("localhost","root","");
if (!$con) {
    header('Location: retrieve.php');
    exit;
}
mysql_select_db("stock", $con);
if (isset($_GET['pcode']) && $_GET['pcode'] !== '') {
    $pcode = mysql_real_escape_string($_GET['pcode']);
    mysql_query("DELETE FROM product WHERE pcode='$pcode'");
}
echo '<script type="text/javascript">window.location=\'retrieve.php\';</script>';
mysql_close($con);
?>
