<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){		
	$ConSQLi = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die ("Failed to connect to MySQL server.");
	$ConSQLi->select_db(DB_NAME);
	$ConSQLi->query("SET NAMES UTF8");
	$ConSQLi->select_db(DB_NAME) or die("Failed to select database."); 
			
	if ((empty($_POST['user'])) || (strlen($_POST['user']) < 4) || (strlen($_POST['user']) > 23) ) {
		$error = "ไอดีต้องมี 4-23  ตัวอักษร";
	} elseif ((empty($_POST['pass1'])) ||  (strlen($_POST['pass1']) < 4) || (strlen($_POST['pass1']) > 23) ) {
		$error = "รหัสผ่านอย่างน้อย 4 ตัว ไม่เกิน 23 ตัว";
	} elseif ((empty($_POST['pass2'])) ||  (strlen($_POST['pass2']) < 4) || (strlen($_POST['pass2']) > 23) ) {
		$error = "รหัสผ่านอย่างน้อย 4 ตัว ไม่เกิน 23 ตัว";
	} elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
		$error = "รหัสผ่าน 2 อันไม่ตรงกัน กรุณาตรวจสอบใหม่";
	} elseif ((empty($_POST['email'])) ||  (strlen($_POST['email']) < 4) || (strlen($_POST['email']) > 39) ) {
		$error = "อีเมลต้องมี 4-39  ตัวอักษร";
	} elseif (empty($_POST['birthdate'])) {
		$error = "ต้องระบุวันเดือนปีเกิดด้วย";
	} elseif ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='') {
		$error = "Captcha ไม่ถูกต้อง ลองใหม่";
	} else {
	
	$StrRegSQL = "SELECT * FROM `login` WHERE userid = '".$ConSQLi->real_escape_string($_POST['user'])."' ";
	$RegQuery = $ConSQLi->query($StrRegSQL);
	$RegResult = $RegQuery->fetch_array();
		if($RegResult)
		{
			$error = "ไอดีเกม ".$_POST['user']." ได้ถูกสมัครไปแล้ว";
		}
		else {
			$StrRegSQL = "INSERT INTO `login` (userid,user_pass,email,sex,birthdate) VALUES ('".$ConSQLi->real_escape_string($_POST["user"])."','".$ConSQLi->real_escape_string($_POST["pass1"])."','".$ConSQLi->real_escape_string($_POST["email"])."','M','".$ConSQLi->real_escape_string($_POST["birthdate"])."') ";
			$objQuery = $ConSQLi->query($StrRegSQL);
			if($ConSQLi->insert_id){
				$success = "สมัครสมาชิกเสร็จสมบูรณ์";
			}else{
				$error = "ระบบสมัครสมาชิกมีปัญหา กรุณาติดต่อ GM";
			}
		}
	}
		
$ConSQLi ->close();
}

?>
<html lang="en">

<head>
    <title>[Register] Ragnarok Member</title>
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
				window.location = './register';
			});";
		echo '</script>';
	}
	if(!empty($success)){
		echo '<script>';
		echo "Swal.fire({
				icon: 'success',
				title: '$success',
				text: 'ยินดีต้อนรับ'
			}).then(function() {
				window.location = './login';
			});";
		echo '</script>';
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
                        <h2 class="fw-bold mb-5">Register Member System</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <!-- 2 column grid layout with text inputs for the first and last names -->

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="user" class="form-control" />
                                <label class="form-label" for="form3Example3">ID : Game กรุณาระบุไอดีเกมส์ 4
                                    ตัวขึ้นไป</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="pass1" class="form-control" />
                                <label class="form-label" for="">Password : ระบุรหัสผ่านที่ต้องการ (4 ตัวขึ้นไป และ
                                    ไม่เกิน 23 ตัว)</label>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="pass2" class="form-control" />
                                <label class="form-label" for="">Confirm Password : ยืนยันรหัสผ่านอีกครั้ง</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control" />
                                <label class="form-label" for="">Email</label>
                            </div>
                            <!-- Date input -->
                            <div class="form-outline mb-4">
                                <input type="date" name="birthdate" class="form-control" />
                                <label class="form-label" for="">Birthdate : กรุณาระบุวันเดือนปีเกิด</label>
                            </div>
                            <!-- Date input -->
                            <p>
                                กรุณาระบุตัวเลข Captcha 
                                <img src="captcha.php" alt="captcha">
								ลงในช่องด้านล่าง
                            </p>
                            <div class="form-outline mb-4">
                                <input type="text" name="vercode" class="form-control" />
                                <label class="form-label" for="">กรุณาระบุตัวเลข Captcha ด้านบน</label>
                            </div>




                            <div class="row">
                                <div class="col-6">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-success btn-block mb-4">
                                        Register
                                    </button>
                                </div>
                                <div class="col-6">
                                    <!-- Submit button -->
                                    <a href="login" class="btn btn-primary btn-block mb-4">
                                        Login
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