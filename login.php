<?php
session_start();
include "db.php";



if($_SERVER['REQUEST_METHOD']==="POST"){

$email=$_POST['email'];
$pass=$_POST['pass'];

$sql=$conn->prepare("select uid,name,password from users where email=?");
$sql->bind_param('s',$email);
$sql->execute();
$sql->bind_result($uid,$n, $passwords);
if ($sql->fetch()) {
    if (password_verify($pass, $passwords)) {
       $_SESSION['uid']=$uid;
       $_SESSION['name']=$n;
       header("Location:home.php");
    }else{
        echo "<script>alret('login failed')</script>";
    }
}

}
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
            <!-- place navbar here -->
        </header>
        <main>
            <h2 class="text-center mt-2">Login with Us!</h2>
            <div
                class="container"
            >
                <form action="" method="post" class=" col-md-10 mt-2 p-4 border rounded shadow">
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            id=""
                            aria-describedby="emailHelpId"
                            placeholder="abc@mail.com"
                        />
                       
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="pass"
                            id=""
                            placeholder=""
                        />
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
