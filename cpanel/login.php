<?php
    require_once '../lib/Admin.php';
    require_once '../helper/output.php';
    require_once 'template/header_login.tpl';
?>
<section>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto height-5">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <svg
                        style="width: 100%"
                        class="m-auto my-2 text-info"
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="50"
                        fill="currentColor"
                        class="bi bi-person-circle"
                        viewBox="0 0 16 16"
                        >
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path
                                fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"
                            />
                        </svg>
                        <h3 class="text-center mb-3">Login</h3>
<?php
    if(isset($_POST['login'])){
        // collect data
        $username = $_POST['username'];
        $password = $_POST['password'];
        // check data valid or no 
        if($username == null){
            echo getNullMessage("username");
        }elseif($password == null){
            echo getNullMessage("password");
        }else{
            if(Admin::Login($username, $password)){
                // redirect to index page 
                header("Location: index.php");
                // for security 
                exit();
            }else{
                echo getMessage("error happend");
            }
        }
    }
?>
                        <form action="" method="POST">
                            <input
                                type="text"
                                class="form-control my-4 py-2"
                                placeholder="Username"
                                id="username"
                                name="username"
                            />
                            <input
                                type="password"
                                class="form-control my-4 py-2"
                                placeholder="password"
                                id="password"
                                name="password"
                            />
                            <div class="text-center">
                                <input
                                    type="submit"
                                    class="btn btn-info mb-3"
                                    value="Login"
                                    name="login"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>
</html>
