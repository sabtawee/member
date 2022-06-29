<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "config.php";

$userid = $_SESSION["userid"];
$account_id = $_SESSION["account_id"];

if($_SERVER["REQUEST_METHOD"] == "POST"){		
	$ConSQLi = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die ("Failed to connect to MySQL server.");
	$ConSQLi->select_db(DB_NAME);
	$ConSQLi->query("SET NAMES UTF8");
	$ConSQLi->select_db(DB_NAME) or die("Failed to select database."); 
	
	$GetSQLi = "SELECT * FROM login where userid = '$userid' and account_id = '$account_id'";
	$GetResult = mysqli_query($ConSql, $GetSQLi);
	$GetData = mysqli_fetch_array($GetResult, MYSQLI_ASSOC);  
	$GetCount = mysqli_num_rows($GetResult);
	
	$username = $_POST['userid'];
    $emailold = $_POST['emailold'];
	$email = $GetData["email"];	
	
	$username = stripcslashes($username);  
	$emailold = stripcslashes($emailold);  
	$username = mysqli_real_escape_string($ConSql, $username);  
	$emailold = mysqli_real_escape_string($ConSql, $emailold);
	
	if ($GetCount == 1){
		if ($email == $emailold) {
			$newemail = $_POST['emailnew'];
			$UpdateSQLi = "UPDATE login SET email = '$newemail' WHERE userid  = '$userid'";
			$query = mysqli_query($ConSQLi,$UpdateSQLi);
			$success = "เปลี่ยนอีเมลเสร็จสมบูรณ์";
		} else {
			$error = "อีเมลเดิมไม่ถูกต้อง";
		}
	} else {
		$error = "ไม่พบไอดีเกมส์ในระบบ";
	}
	$ConSQLi ->close();
}

?>
<html lang="en">
<head>
	<title>Ragnarok Member System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai+Looped&display=swap" rel="stylesheet">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
		<video id="videoBG" poster="images/poster.jpg" autoplay muted loop>
            <source src="images/bg-video.mp4" type="video/mp4">
        </video>
			<div class="wrap-login100">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login100-form validate-form" style="width:100%;">
					<span class="login100-form-title">
						เปลี่ยนรหัสผ่าน
					</span>
					<div class="text-center p-b-30"  style="width:100%;">
						<a href="index.php" class="btn btn-primary">Dashboard<br>แผงควบคุม</a>
						<a href="donate.php" class="btn btn-success">Donate<br>เติมเงิน</a>
						<a href="password.php" class="btn btn-info">Change Password<br>เปลี่ยนรหัสผ่าน</a>
						<a href="email.php" class="active btn btn-warning">Change Email<br>เปลี่ยนอีเมล</a>
						<a href="logout.php" class="btn btn-danger">Logout<br>ออกจากระบบ</a>
					</div>
					<ul class="breadcrumb">
					  <li><a href="../index.php">Home</a></li>
					  <li class="active">Change Email</li>
					</ul>
					<?php
					if(!empty($error)){
						echo '<div class="alert alert-dismissible alert-danger text-center"><strong>' . $error . '</strong></div>';
					}
					if(!empty($success)){
						echo '<div class="alert alert-dismissible alert-success text-center">' . $success . '</div>';
					}
					?>
					<div class="wrap-input100 validate-input" data-validate = "กรุณาระบุไอดีเกมส์ 4 ตัวขึ้นไป">
						<input class="input100" readonly type="text" name="userid" <?php echo 'value="'.$userid.'"'?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "กรุณาระบุไอดีเกมส์ 4 ตัวขึ้นไป">
						<input class="input100" readonly type="text" name="account_id" <?php echo 'value="'.$account_id.'"'?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "กรุณาใส่รหัสผ่าน 4 ตัวขึ้นไป">
						<input class="input100" type="email" name="emailold" placeholder="กรุณาระบุอีเมลเดิม">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope-open" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "กรุณาใส่รหัสผ่าน (4 ตัวขึ้นไป และ ไม่เกิน 23 ตัว)">
						<input class="input100" type="email" name="emailnew" placeholder="กรุณาระบุอีเมลใหม่">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope-open" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="เปลี่ยนรหัสผ่าน">
					</div>
					<div class="text-center p-t-20">
						<span class="txt1">
							Webdesign & Coding By
						</span>
						<a class="txt2" href="https://discord.gg/25zg6kjEHm">
							KNT-SERVICE
						</a>
						<span class="txt1">
							Discord : mr.knt (knt-service)#1684
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>
	<script>
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>
</body>
</html>