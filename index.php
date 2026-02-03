<html>
<head>
    <title>Form - Add Product</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="lovely-bg">
    <div class="container">
      <div class="form-container" style="max-width: 600px; margin: 40px auto;">
        <form method="post" action="">
          <h1 class="retrieve-header"><u>Fill the following form</u></h1>

          <div class="form-group">
            <label for="pcode">Pcode</label>
            <input id="pcode" type="number" name="pcode" placeholder="pcode" required>
          </div>

          <div class="form-group">
            <label for="pname">Pname</label>
            <input id="pname" type="text" name="pname" placeholder="pname" required>
          </div>

          <div class="form-group">
            <label for="pquantity">Pquantity</label>
            <input id="pquantity" type="text" name="pquantity" placeholder="pquantity" required>
          </div>

          <div class="form-group">
            <label for="pdate">Pdate</label>
            <input id="pdate" type="date" name="pdate">
          </div>

          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Send</button>
            <a href="retrieve.php" class="link-btn">View</a>
          </div>

<?php
if(isset($_POST['submit'])){
    $conn = mysql_connect("localhost","root","");
    $sele = mysql_select_db("stock", $conn);
    $a = mysql_real_escape_string($_POST['pcode']);
    $b = mysql_real_escape_string($_POST['pname']);
    $c = mysql_real_escape_string($_POST['pquantity']);
    $d = mysql_real_escape_string($_POST['pdate']);
    mysql_query("INSERT INTO product (pcode,pname,pquantity,pdate) VALUES ('$a','$b','$c','$d')");
    echo '<p style="margin-top:12px;color:green;">Product added successfully.</p>';
}
?>
        </form>
      </div>
    </div>
</body>
</html>