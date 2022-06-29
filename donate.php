<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "config.php";

if(!isset($_SESSION["session_login"]) || $_SESSION["session_login"] !== true){
	header("location: login.php");
	exit;
}

$userid = $_SESSION["userid"];
$account_id = $_SESSION["account_id"];
$referenceNo = rand(100000000000000,999999999999999);		
$gbp_token = "";
$gbp_backgroundUrl = "http://localhost/member/res.php";

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
				<span class="login100-form-title">
					เติมเงินสนับสนุนเซิฟเวอร์
				</span>
				<div class="text-center p-b-30"  style="width:100%;">
				<a href="index.php" class="btn btn-primary">Dashboard<br>แผงควบคุม</a>
				<a href="donate.php" class="active btn btn-success">Donate<br>เติมเงิน</a>
				<a href="password.php" class="btn btn-info">Change Password<br>เปลี่ยนรหัสผ่าน</a>
				<a href="email.php" class="btn btn-warning">Change Email<br>เปลี่ยนอีเมล</a>
				<a href="logout.php" class="btn btn-danger">Logout<br>ออกจากระบบ</a>
				</div>
				<ul class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li class="active">Donate</li>
				</ul>
				<form id="gbprimepay" action="https://api.gbprimepay.com/gbp/gateway/qrcode/" method="POST" class="login100-form validate-form" style="width:100%;">	
					<div class="text-center p-b-20">
						ยินดีต้อนรับคุณ
						<span class="txt2 h1"><?php echo $userid ?></span>
					</div>
					<?php
					if(!empty($error)){
						echo '<div class="alert alert-dismissible alert-danger text-center"><strong>' . $error . '</strong></div>';
					}
					if(!empty($success)){
						echo '<div class="alert alert-dismissible alert-success text-center">' . $success . '</div>';
					}
					?>
					<input type="hidden" name="detail" <?php echo 'value="'.$userid.'"'?>>
					<input type="hidden" name="customerName" <?php echo 'value="'.$account_id.'"'?>>
					<input type="hidden" name="token" <?php echo 'value="'.$gbp_token.'"'?>>
					<input type="hidden" name="referenceNo" <?php echo 'value="'.$referenceNo.'"'?>>
					<input type="hidden" name="backgroundUrl" <?php echo 'value="'.$gbp_backgroundUrl.'"'?>>
					<input type="hidden" name="customerAddress" value="Frost-Ro">
					<table class="table table-striped table-hover" style="text-align: center;">
						<thead>
						<tr>
						  <th style="text-align: center;"><img src="images/icons/baht.png" class="m-b-5"><br>จำนวนเงิน</th>
						  <th style="text-align: center;"><img src="images/icons/cash.png" class="m-b-5"><br>จำนวนพ้อย</th>
						  <th style="text-align: center;"><img src="images/icons/trophy.png" class="m-b-5"><br>จำนวนโบนัส</th>
						  <th style="text-align: center;"><img src="images/icons/gift.png" class="m-b-5"><br>ของแถม</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						  <td>100</td>
						  <td>1,000</td>
						  <td>100</td>
						  <td class="thumb">VIP 1 DAY จำนวน 2 ea.<span ><img src="images/gift/vip.png" alt=""></span></td>	
						</tr>
						<tr class="info">
						  <td>200</td>
						  <td>2,000</td>
						  <td>200</td>
						  <td class="thumb">VIP 1 DAY จำนวน 4 ea.<span ><img src="images/gift/vip.png" alt=""></span></td>	
						</tr>
						<tr class="success">
						  <td>300</td>
						  <td>3,000</td>
						  <td>300</td>
						  <td class="thumb">VIP 1 DAY จำนวน 7 ea.<span ><img src="images/gift/vip.png" alt=""></span></td>	
						</tr>
						<tr class="danger">
						  <td>500</td>
						  <td>5,500</td>
						  <td>500</td>
						  <td class="thumb">VIP 1 DAY จำนวน 15 ea.<span ><img src="images/gift/vip.png" alt=""></span></td>	
						</tr>
						<tr class="warning">
						  <td>1,000</td>
						  <td>12,000</td>
						  <td>1,000</td>
						  <td class="thumb">VIP 1 DAY จำนวน 30 ea.<span ><img src="images/gift/vip.png" alt=""></span></td>	
						</tr>
						</tbody>
					</table>			
					<div class="text-center p-t-10 p-b-20">
						กรุณาเลือกจำนวนเงินที่ต้องการจะเติมเงิน
					</div>

					<div class="wrap-input100 validate-input">
						<select class="input100" name="amount" maxlength="13">
							<option value="1">ยอดเงิน 100 บาท</option>
							<option value="200">ยอดเงิน 200 บาท</option>
							<option value="300">ยอดเงิน 300 บาท</option>
							<option value="500">ยอดเงิน 500 บาท</option>
							<option value="1000">ยอดเงิน 1,000 บาท</option>
						</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-money" aria-hidden="true"></i>
						</span>
					</div>

					<div class="text-center p-t-20">
						เมื่อกดปุ่มเติมเงินจะปรากฏหน้า QR CODE ให้สแกนชำระเงินได้เลย
					</div>
					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="เติมเงิน">
					</div>

					<div class="text-center p-t-20">
						<a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
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
	var myForm = document.getElementById('gbprimepay');
	myForm.onsubmit = function() {
		var myWidth = 397;
		var myHeight = 600;
		var left = (screen.width - myWidth) / 2;
		var top = (screen.height - myHeight) / 4;
		var w = window.open('about:blank', 'Popup_Window', 'toolbar=no, location=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
		this.target = 'Popup_Window';
	};
	</script>
</body>
</html>