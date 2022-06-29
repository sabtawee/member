<!DOCTYPE html>
<?php
// Initialize the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "config.php";

if(isset($_SESSION["session_login"]) && $_SESSION["session_login"] === true){
    header("location: index.php");
    exit;
}

$username = "";
$password = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$username = $_POST['user'];
    $password = $_POST['pass'];
	
	$username = stripcslashes($username);  
	$password = stripcslashes($password);  
	$username = mysqli_real_escape_string($ConSql, $username);  
	$password = mysqli_real_escape_string($ConSql, $password);
 
	$LoginSQLi = "select * from login where userid = '$username' and user_pass = '$password'";  
	$LoginResult = mysqli_query($ConSql, $LoginSQLi);
	$LoginData = mysqli_fetch_array($LoginResult, MYSQLI_ASSOC);  
	$LoginCount = mysqli_num_rows($LoginResult);
	
	if($LoginCount == 1){  
		$_SESSION["session_login"] = true;
		$_SESSION["userid"] = $username;	
		$_SESSION["account_id"] = $LoginData["account_id"];	
		// header("location: index.php");
        $success = "ยินดีต้อนรับเช้าสู่ระบบ";
	} else {
		$error = "ไอดีเกมส์ หรือ รหัสผ่าน ไม่ถูกต้อง";
	}
	mysqli_close($ConSql);  
								
}
?>
<html lang="en">

<head>
    <title>[Login] Ragnarok Member</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <!-- Section: Design Block -->
    <section class="text-center">
        <?php
		if(!empty($error)){
			echo '<script>';
			echo "Swal.fire({
					icon: 'error',
					title: '$error',
					text: 'โปรดตรวจสอบ'
				}).then(function() {
					window.location = './';
				});";
			echo '</script>';
			// echo '<div class="alert alert-dismissible alert-danger text-center"><strong>' . $error . '</strong></div>';
		}
		if(!empty($success)){
			echo '<script>';
			echo "Swal.fire({
					icon: 'success',
					title: '$success',
					text: 'สมาชิก'
				}).then(function() {
					window.location = './';
				});";
			echo '</script>';
			// echo '<div class="alert alert-dismissible alert-danger text-center"><strong>' . $error . '</strong></div>';
		}
		
		?>
        <!-- Background image -->
        <div class="p-5 bg-image" style="
        background-image: url('images/poster.jpg');
        height: 300px;
        "></div>
        <!-- Background image -->

        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Login Member System</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <!-- 2 column grid layout with text inputs for the first and last names -->

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="user" class="form-control" />
                                <label class="form-label" for="form3Example3">ID : Game</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="pass" class="form-control" />
                                <label class="form-label" for="">Password</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-success btn-block mb-4">
                                        Login
                                    </button>
                                </div>
                                <div class="col-6">
                                    <!-- Submit button -->
                                    <a href="register"  class="btn btn-primary btn-block mb-4">
                                        Register
                                    </a>
                                </div>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Community Server</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>