
<?php
session_start();
include "db.php";

if(!isset($_SESSION['uid'])){
    header("Location:login.php");
    exit;
}

$uid = $_SESSION['uid'];
$pid = $_GET['pid'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $pname = $_POST['pname'];
    $pcategory = $_POST['pcategory'];
    $pprice = $_POST['pprice'];
    $pquantity = $_POST['pquantity'];
    $sname = $_POST['sname'];

    $sql = $conn->prepare("update product
                           set pname=?, category=?, price=?, quantity=?, sname=?
                           where pid=? AND uid=?");

    $sql->bind_param(
        'ssdisii', $pname, $pcategory,$pprice,  $pquantity,  $sname,  $pid,  $uid );

    if($sql->execute()){
        header("Location:home.php");
        exit;
    }
}

$sql = $conn->prepare("SELECT pid, pname, category, price, quantity, sname
                       FROM product
                       WHERE pid=? AND uid=?");

$sql->bind_param('ii', $pid, $uid);

$sql->execute();

$sql->bind_result(
    $pid,
    $pname,
    $pcategory,
    $pprice,
    $pquantity,
    $sname
);

$sql->fetch();
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Edit Product</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous"
    />
</head>

<body>

    <main>

        <h2 class="text-center mt-2">Edit Products</h2>

        <div class="container">

            <form
                action=""
                method="post"
                class="col-md-7 mx-auto m-2 p-4 border rounded shadow"
            >

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pname"
                        placeholder=""
                        value="<?php echo $pname; ?>"
                    />
                    <label>Product Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pcategory"
                        placeholder=""
                        value="<?php echo $pcategory; ?>"
                    />
                    <label>Category</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pprice"
                        placeholder=""
                        value="<?php echo $pprice; ?>"
                    />
                    <label>Price</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pquantity"
                        placeholder=""
                        value="<?php echo $pquantity; ?>"
                    />
                    <label>Quantity</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="sname"
                        placeholder=""
                        value="<?php echo $sname; ?>"
                    />
                    <label>Supplier Name</label>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Submit
                </button>

            </form>

        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"
    ></script>

</body>

</html>
```