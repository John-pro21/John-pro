<html>
<head>
    <title>RETRIEVE</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
    <body bgcolor="cyan">
        <div class="retrieve-container">
            <h1 class="retrieve-header">Out of Stock Products</h1>
            <a href="index.php" class="link-btn">Go to Home</a>
            <div class="marquee">John-pro</div>
            <p>
                <?php
                $con = mysql_connect("localhost", "root", "");
                mysql_select_db("stock", $con);
                $na=mysql_query("SELECT * FROM product");
                echo "<div class='table-wrapper'><table class='out-of-stock-table'><thead><tr>
                <th>pcode</th>
                <th>pname</th>
                <th>pquantity</th>
                <th>pdate</th>
                <th>Action</th>
                </tr></thead><tbody>";
                if($na && mysql_num_rows($na) > 0){
                    while($q=mysql_fetch_array($na)){
                        echo "<tr><td>" . htmlspecialchars($q['pcode']) . "</td>";
                        echo "<td>" . htmlspecialchars($q['pname']) . "</td>";
                        echo "<td>" . htmlspecialchars($q['pquantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($q['pdate']) . "</td>";
                        echo "<td><a href='update.php?pcode=" . urlencode($q['pcode']) . "'>edit</a> | <a href='delete.php?pcode=" . urlencode($q['pcode']) . "'>delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='padding:12px;'>No products found</td></tr>";
                }
                echo "</tbody></table></div>";
                ?>
            </p>
        </div>
    </body>
    </html>
