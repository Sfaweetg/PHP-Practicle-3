<?php

session_start();
include "db.php";

if(!isset($_SESSION['uid'])){
    header("Location:login.php");
    exit;
}
$uid =$_SESSION['uid'];



if ($_SERVER['REQUEST_METHOD']==="POST") {
    $pname=$_POST['pname'];
    $pcategory=$_POST['pcategory'];
    $pprice=$_POST['pprice'];
    $pquantity=$_POST['pquantity'];
    $sname=$_POST['sname'];

    $sql=$conn->prepare("insert into product(pname,category,price,quantity,sname,uid) values(?,?,?,?,?,?)");
    $sql->bind_param('ssdisi',$pname,$pcategory,$pprice,$pquantity,$sname,$uid);
    if ($sql->execute()) {
        echo "<script>alert('Product added')</script>";
        header("Location:home.php");
    }
}
$sql=$conn->prepare("select pid,pname,category,price,quantity,sname from product where uid=?");
$sql->bind_param('i',$uid);
$sql->execute();
$result=$sql->get_result();



?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                    <a class="navbar-brand" href="#"><?=$_SESSION['name']?></a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                           
                        </ul>
                        <form class="d-flex my-2 my-lg-0" action="pdf.php">
                            
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Create pdf
                            </button>
                        </form>
                        <form class="d-flex my-2 my-lg-0 m-2" action="logout.php">
                            
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>
            <h2 class="text-center mt-2">Add Products</h2>

            <div
                class="container"
            >
               <form action="" method="post" class="col-md-7 mx-auto m-2 p-4 border rounded shadow">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pname"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pcategory"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Category</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pprice"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Price</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pquantity"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Quantity</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="sname"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Supplier Name</label>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Submit
                </button>
                
                
                
                
                
                
               </form>
            </div>

            <h2 class="text-center mt-2">Product Dashboard</h2>
            <div
                class="container"
            >
               <div
                class="table-responsive"
               >
                <table
                    class="table table-primary"
                >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Suppiler Name</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$result->fetch_assoc()){?>
                        <tr class="">
                
                            <td scope="row"><?=$row['pid']?></td>
                            <td><?=$row['pname']?></td>
                            <td><?=$row['category']?></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['quantity']?></td>
                            <td><?=$row['sname']?></td>
                            <td>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="edit.php?pid=<?=$row['pid']?>"
                                    role="button"
                                    >Edit</a
                                >
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="delete.php?pid=<?=$row['pid']?>"
                                    role="button"
                                    >Delete</a
                                >
                                
                                
                            </td>
</tr>
<?php }?>

                        
                    </tbody>
                </table>
               </div>
               
            </div>
            
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
