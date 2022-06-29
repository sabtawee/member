<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "config.php";

if(!isset($_SESSION["session_login"]) || $_SESSION["session_login"] !== true){
	header("location: login");
	exit;
}

$userid = $_SESSION["userid"];
$account_id = $_SESSION["account_id"];

$ConSQLi = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die ("Failed to connect to MySQL server.");
$ConSQLi->select_db(DB_NAME);
$ConSQLi->query("SET NAMES UTF8");
$ConSQLi->select_db(DB_NAME) or die("Failed to select database.");

$Job=array( "0" => "Novice",
			"1" => "Swordman",
			"2" => "Magician",
			"3" => "Archer",
			"4" => "Acolyte",
			"5" => "Merchant",
			"6" => "Thief",
			"7" => "Knight",
			"8" => "Priest",
			"8" => "Priestess",
			"9" => "Wizard",
			"10" => "Blacksmith",
			"11" => "Hunter",
			"12" => "Assassin",
			"14" => "Crusader",
			"15" => "Monk",
			"16" => "Sage",
			"17" => "Rogue",
			"18" => "Alchemist",
			"19" => "Bard",
			"20" => "Dancer",
			"23" => "Super Novice",
			"24" => "Gunslinger",
			"24" => "Gunner",
			"25" => "Ninja",
			"4001" => "Novice High",
			"4001" => "High Novice",
			"4002" => "Swordman High",
			"4002" => "Swordsman High",
			"4003" => "Magician High",
			"4003" => "Mage High",
			"4004" => "Archer High",
			"4005" => "Acolyte High",
			"4006" => "Merchant High",
			"4007" => "Thief High",
			"4008" => "Lord Knight",
			"4009" => "High Priest",
			"4009" => "High Priestess",
			"4010" => "High Wizard",
			"4011" => "Whitesmith",
			"4012" => "Sniper",
			"4013" => "Assassin Cross",
			"4015" => "Paladin",
			"4016" => "Champion",
			"4017" => "Professor",
			"4018" => "Stalker",
			"4019" => "Creator",
			"4020" => "Clown",
			"4021" => "Gypsy",
			"4023" => "Baby Novice",
			"4024" => "Baby Swordman",
			"4024" => "Baby Swordsman",
			"4025" => "Baby Magician",
			"4025" => "Baby Mage",
			"4026" => "Baby Archer",
			"4027" => "Baby Acolyte",
			"4028" => "Baby Merchant",
			"4029" => "Baby Thief",
			"4030" => "Baby Knight",
			"4031" => "Baby Priest",
			"4031" => "Baby Priestess",
			"4032" => "Baby Wizard",
			"4033" => "Baby Blacksmith",
			"4034" => "Baby Hunter",
			"4035" => "Baby Assassin",
			"4037" => "Baby Crusader",
			"4038" => "Baby Monk",
			"4039" => "Baby Sage",
			"4040" => "Baby Rogue",
			"4041" => "Baby Alchemist",
			"4042" => "Baby Bard",
			"4043" => "Baby Dancer",
			"4045" => "Super Baby",
			"4046" => "Taekwon",
			"4046" => "Taekwon Boy",
			"4046" => "Taekwon Girl",
			"4047" => "Star Gladiator",
			"4049" => "Soul Linker",
			"4050" => "Gangsi",
			"4050" => "Bongun",
			"4050" => "Munak",
			"4051" => "Death Knight",
			"4052" => "Dark Collector",
			"4054" => "Rune Knight",
			"4055" => "Warlock",
			"4056" => "Ranger",
			"4057" => "Arch Bishop",
			"4058" => "Mechanic",
			"4059" => "Guillotine",
			"4060" => "Rune Knight2",
			"4061" => "Warlock2",
			"4062" => "Ranger2",
			"4063" => "Arch Bishop2",
			"4064" => "Mechanic2",
			"4065" => "Guillotine2",
			"4066" => "Royal Guard",
			"4067" => "Sorcerer",
			"4068" => "Minstrel",
			"4069" => "Wanderer",
			"4070" => "Sura",
			"4071" => "Genetic",
			"4072" => "Shadow Chaser",
			"4073" => "Royal Guard2",
			"4074" => "Sorcerer2",
			"4075" => "Minstrel2",
			"4076" => "Wanderer2",
			"4077" => "Sura2",
			"4078" => "Genetic2",
			"4079" => "Shadow Chaser2",
			"4096" => "Baby Rune",
			"4097" => "Baby Warlock",
			"4098" => "Baby Ranger",
			"4099" => "Baby Bishop",
			"4100" => "Baby Mechanic",
			"4101" => "Baby Cross",
			"4102" => "Baby Guard",
			"4103" => "Baby Sorcerer",
			"4104" => "Baby Minstrel",
			"4105" => "Baby Wanderer",
			"4106" => "Baby Sura",
			"4107" => "Baby Genetic",
			"4108" => "Baby Chaser",
			"4190" => "Super Novice E",
			"4191" => "Super Baby E",
			"4211" => "Kagerou",
			"4212" => "Oboro");

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
	<video id="videoBG" poster="images/poster.jpg" autoplay muted loop>
		<!-- <source src="images/bg-video.mp4" type="video/mp4"> -->
	</video>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<span class="login100-form-title">ระบบสมาชิก และ เติมเงิน</span>
				<div class="text-center p-b-30"  style="width:100%;">
					<a href="index.php" class="active btn btn-primary">Dashboard<br>แผงควบคุม</a>
					<a href="donate.php" class="btn btn-success">Donate<br>เติมเงิน</a>
					<a href="password.php" class="btn btn-info">Change Password<br>เปลี่ยนรหัสผ่าน</a>
					<a href="email.php" class="btn btn-warning">Change Email<br>เปลี่ยนอีเมล</a>
					<a href="logout.php" class="btn btn-danger">Logout<br>ออกจากระบบ</a>
				</div>
				<ul class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li class="active">Dashboard</li>
				</ul>
<?php
					if(!empty($error)){
						echo '<div class="alert alert-dismissible alert-danger text-center"><strong>' . $error . '</strong></div>';
					}
					if(!empty($success)){
						echo '<div class="alert alert-dismissible alert-success text-center">' . $success . '</div>';
					}
					?>				
				<table class="table table-striped table-hover" style="text-align: center;">
					<thead>
						<tr>
						  <th style="text-align: center;"><img src="images/icons/cash.png" class="m-b-5"><br>จำนวนพ้อยทั้งหมด</th>
						  <th style="text-align: center;"><img src="images/icons/assasin.png" class="m-b-5"><br>จำนวนตัวละคร</th>
						</tr>
					</thead>
					<?php
						$CharSQLi = "SELECT name,class,base_level,job_level,zeny,last_map,online FROM `char` WHERE account_id = $account_id LIMIT 10";																		
						$CharResult = mysqli_query($ConSQLi, $CharSQLi);
						$TotalChar = mysqli_num_rows($CharResult);
						
						$CashSQLi = "SELECT * FROM `acc_reg_num` WHERE `account_id` = $account_id AND `key` = '#CASHPOINTS'";
						$TotalCash = mysqli_query($ConSQLi, $CashSQLi);
						if (mysqli_num_rows($TotalCash) > 0){
							while($rowData = mysqli_fetch_assoc($TotalCash)){
								$Cash = number_format($rowData["value"],0).'<br>';
							}
						} else {
							$Cash = 0;
						}
					?>
					<tbody>
						<tr>
						  <td>
							  <?php
							  if ($Cash > 0) {
								echo $Cash;
							  } else {
								echo "0";
							  }
							  ?>
						  </td>
						  <td><?php echo $TotalChar; ?></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-striped table-hover" style="text-align: center;">
					<thead>
						<tr>
						  <th style="text-align: center;"><img src="images/icons/id.png" class="m-b-5"><br>ชื่อตัวละคร</th>
						  <th style="text-align: center;"><img src="images/icons/character.png" class="m-b-5"><br>อาชีพ</th>
						  <th style="text-align: center;"><img src="images/icons/level-up.png" class="m-b-5"><br>Lv/Job</th>
						  <th style="text-align: center;"><img src="images/icons/baht.png" class="m-b-5"><br>Zeny</th>
						  <th style="text-align: center;"><img src="images/icons/map.png" class="m-b-5"><br>แผนที่ล่าสุด</th>
						  <th style="text-align: center;"><img src="images/icons/switch.png" class="m-b-5"><br>สถานะ</th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
						<?php
							$CharSQLi = "SELECT name,class,base_level,job_level,zeny,last_map,online FROM `char` WHERE account_id = $account_id LIMIT 10";					
							$CharResult = mysqli_query($ConSQLi, $CharSQLi);
							$std_num=0;
							while($row = mysqli_fetch_array($CharResult,MYSQLI_ASSOC)) {
								$class = $row["class"];
								echo "<tr>";
								echo "<td>".$row["name"]."</td>";
								echo "<td>".$Job[$class]."</td>";
								echo "<td>".$row["base_level"]."/".$row["job_level"]."</td>";
								echo "<td>".number_format($row["zeny"],0)."</td>";
								echo "<td>".$row["last_map"]."</td>";
								if ($row["online"] == 0) {
									echo "<td style='color:red;'>OFFLINE</td>";
								} else {
									echo "<td style='color:green;'>ONLINE</td>";
								}
								echo "</tr>";
								$std_num++;
							}
						?>
					</tbody>
				</table>
				<div class="text-center p-t-20"  style="width:100%;">
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