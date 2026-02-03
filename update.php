<?php
$con = mysql_connect("localhost","root","");
if (!$con) {
    header('Location: retrieve.php');
    exit;
}
mysql_select_db("stock", $con);

// Handle POST: update the product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pcode']) && $_POST['pcode'] !== '') {
        $pcode = mysql_real_escape_string($_POST['pcode']);
        $pname = isset($_POST['pname']) ? mysql_real_escape_string($_POST['pname']) : '';
        $pquantity = isset($_POST['pquantity']) ? (int) $_POST['pquantity'] : 0;
        $pdate = isset($_POST['pdate']) ? mysql_real_escape_string($_POST['pdate']) : '';

        mysql_query("UPDATE product SET pname='$pname', pquantity='$pquantity', pdate='$pdate' WHERE pcode='$pcode'");
    }
    header('Location: retrieve.php');
    exit;
}

// Handle GET: show form for the provided pcode
if (isset($_GET['pcode']) && $_GET['pcode'] !== '') {
    $pcode = mysql_real_escape_string($_GET['pcode']);
    $res = mysql_query("SELECT * FROM product WHERE pcode='$pcode' LIMIT 1");
    if ($res && mysql_num_rows($res) === 1) {
        $product = mysql_fetch_assoc($res);
    } else {
        header('Location: retrieve.php');
        exit;
    }
} else {
    header('Location: retrieve.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body bgcolor="cyan">
    <div class="retrieve-container">
        <h1 class="retrieve-header">Update Product</h1>
        <a href="retrieve.php" class="link-btn">Back to List</a>
        <div class="form-wrapper">
            <form method="post" action="update.php">
                <label>PCode (readonly)</label><br>
                <input type="text" name="pcode" value="<?php echo htmlspecialchars($product['pcode']); ?>" readonly style="width:300px;"><br><br>

                <label>Product Name</label><br>
                <input type="text" name="pname" value="<?php echo htmlspecialchars($product['pname']); ?>" required style="width:300px;"><br><br>

                <label>Quantity</label><br>
                <input type="number" name="pquantity" value="<?php echo htmlspecialchars($product['pquantity']); ?>" min="0" required style="width:300px;"><br><br>

                <label>Date</label><br>
                <input type="date" name="pdate" value="<?php echo htmlspecialchars($product['pdate']); ?>" style="width:300px;"><br><br>

                <button type="submit" class="link-btn">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php mysql_close($con); ?>
