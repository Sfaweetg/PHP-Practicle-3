<?php
session_start();
include "db.php";

if(!isset($_SESSION['uid'])){
    header("Location:login.php");
    exit;

}
$uid = $_SESSION['uid'];

$sql=$conn->prepare("select pid, pname, category, price, sname from product where uid=?");
$sql->bind_param("i",$uid);
$sql->execute();
$result = $sql->get_result();

header('Content-Type: text/csv');
header('Content-Dispoition: attachment; filename="product.csv"');

$output=fopen("php://output","w");

fputcsv($output,array("Product ID","Product Name","Category","Price","Quantity","Supplier Name"));

while($row=$result->fetch_assoc()){
    fputcsv($output,array(
        $row['pid'],
        $row['pname'],
        $row['category'],
        $row['price'],
        $row['quantity'],
        $row['sname']
    ));
}
fclose($output);

session_unset();
session_destroy();

echo '<script>window.location.href="login.php";</script>';

exit;
?>