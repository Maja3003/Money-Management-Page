<?php
session_start();
if (isset($_SESSION['czyZalogowany'])&& $_SESSION['czyZalogowany']==True)
{
	require("../php/connect.php");

	//TUTAJ SOBIE BIORE EMAIL BO WIEM ZE JEST TYLKO JEDEN TAKI W BAZIE!
	$email=$_SESSION['email_user'];
	//TRANSPORT
	$sql_transport = "SELECT Wydatki_transport FROM `users` WHERE EMAIL like '$email';";
	$transport_result=$conn->query($sql_transport);
	while ($row = $transport_result->fetch_assoc()) {
		$transport=$row['Wydatki_transport'];
	}
	//ZAKUPY
	$sql_zakupy = "SELECT Wydatki_zakupy FROM `users` WHERE EMAIL like '$email';";
	$zakupy_result=$conn->query($sql_zakupy);
	while ($row = $zakupy_result->fetch_assoc()) {
		$zakupy=$row['Wydatki_zakupy'];
	}
	//ZDROWIE
	$sql_zdrowie= "SELECT Wydatki_zdrowie FROM `users` WHERE EMAIL like '$email';";
	$zdrowie_result=$conn->query($sql_zdrowie);
	while ($row = $zdrowie_result->fetch_assoc()) {
		$zdrowie=$row['Wydatki_zdrowie'];
	}
	//JEDZENIE
	$sql_jedzenie= "SELECT Wydatki_jedzenie FROM `users` WHERE EMAIL like '$email';";
	$jedzenie_result=$conn->query($sql_jedzenie);
	while ($row = $jedzenie_result->fetch_assoc()) {
		$jedzenie=$row['Wydatki_jedzenie'];
	}
	//AKTYNOŚĆ I ROZRYWKA
	$sql_aktywnosc= "SELECT Wydatki_aktywnosc FROM `users` WHERE EMAIL like '$email';";
	$aktywnosc_result=$conn->query($sql_aktywnosc);
	while ($row = $aktywnosc_result->fetch_assoc()) {
		$aktywnosc=$row['Wydatki_aktywnosc'];
	}
	//WYNAJEM
	$sql_wynajem= "SELECT Wydatki_wynajem FROM `users` WHERE EMAIL like '$email';";
	$wynajem_result=$conn->query($sql_wynajem);
	while ($row = $wynajem_result->fetch_assoc()) {
		$wynajem=$row['Wydatki_wynajem'];
	}
	//tutaj licze sobie do tego wykresu ile wydalem za wszystko 
	$all = $transport+$zakupy+$zdrowie+$jedzenie+$aktywnosc+$wynajem;
	//przychod
	$sql_przychod= "SELECT przychod FROM `users` WHERE EMAIL like '$email';";
	$przychod_result=$conn->query($sql_przychod);
	while ($row = $przychod_result->fetch_assoc()) {
		$przychod=$row['przychod'];
	}
	$_SESSION['saldo']=$przychod-$all;

	$dataPoints = array(
		array("label"=> "Jedzenie + Napoje", "y"=> $jedzenie),
		array("label"=> "Aktywności + Rozrywka", "y"=> $aktywnosc),
		array("label"=> "Zdrowie", "y"=> $zdrowie),
		array("label"=> "Zakupy", "y"=> $zakupy),
		array("label"=> "Transport", "y"=> $transport),
		array("label"=> "Wynajem", "y"=> $wynajem),
	);
	$dataPoints1 = array( 
	array("y" => 2105,"label" => "Styczeń" ),
	array("y" => 3400,"label" => "Luty" ),
	array("y" => 1500,"label" => "Marzec" ),
	array("y" => 2450,"label" => "Kwiecień" ),
	array("y" => $all,"label" => "Maj" )
);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>PortMonetka</title>

		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Raleway:wght@200;400;900&display=swap"
			rel="stylesheet"
		/>

		<script
			src="https://kit.fontawesome.com/22b2a63529.js"
			crossorigin="anonymous"
		></script>

		<link
			href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="../sass/css/hamburger.css" />
		<link rel="stylesheet" href="../sass/css/panel.css" />
		<link rel="stylesheet" href="../sass/css/analityka.css" />

	</head>
	<body>
		<nav class="sidebar">
			<div class="sidebar__logo">
				<div class="sidebar__logo-name">PortMonetka</div>
				<i class="bx bx-menu" id="btn"></i>
			</div>
			<ul class="sidebar__list">
				<li>
					<a href="panel.php">
						<i class="bx bx-grid-alt"></i>
						<span class="sidebar__item-name">Panel</span>
					</a>
					<span class="tooltip">Panel</span>
				</li>
				<li>
					<a href="analityka.php">
						<i class="bx bx-pie-chart-alt-2"></i>
						<span class="sidebar__item-name">Analityka</span>
					</a>
					<span class="tooltip">Analityka</span>
				</li>
				<li>
					<a href="ustawienia.php">
						<i class="bx bx-cog"></i>
						<span class="sidebar__item-name">Ustawienia</span>
					</a>
					<span class="tooltip">Ustawienia</span>
				</li>
				<li class="sidebar__profile">
					<div class="sidebar__profile-details">
						<img src="../img/banknotes.jpg" alt="profileImg" />
						<p class="sidebar__profile-name">
							<?php
								
								echo $_SESSION['zalogowany_user'];
							?>
						</p>
						<form action="../php/wylogowanie.php" method="post">
							<button type="submit" class="sidebar__profile-logout"><i class="bx bx-log-out" id="log_out"></i></button>
						</form>
					</div>
				</li>
			</ul>
		</nav>
		<script>
			window.onload = () => {
			
			let chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				exportEnabled: true,
				backgroundColor: "#232323",
				fontColor: "red",

				// title:{
				// 	text: "Jak wydajesz swoje pieniądze?",
				// 	fontColor: "white"
				// },
				legend : {
					fontColor: "white",
				},
				indexlabel:{
					fontColor: "white",
				},
				// subtitles: [{
				// 	text: "Waluta: Polski złoty (zł)",
				// 	fontColor: "white"
				// }],
				data: [{
					type: "pie",
					showInLegend: "true",
					legendText: "{label}",
					indexLabelFontSize: 16,
					indexLabel: "{label} - #percent%",
					yValueFormatString: "#,##0zł",
					indexLabelFontColor: "white",

					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
			
			let chart1 = new CanvasJS.Chart("chartContainer1", {
				animationEnabled: true,
				backgroundColor: "#232323",
				// title:{
				// 	text: "W którym miesiącu wydałeś najwięcej?",
				// 	fontColor: "white"
				// },
				axisY: {
					title: "Pieniądze (w PLN)",
					includeZero: true,
					suffix:  "zł",
					labelFontColor: "white",
					fontColor:"white",
					titleFontColor: "white",
				},
				legend : {
				fontColor: "white",
				labelFontFamily: "Raleway",
				},
				axisX:{
					labelFontColor: "white",
					labelFontSize: 20,
					labelFontFamily: "Raleway",
				},
				data: [{
					type: "bar",
					yValueFormatString: "####,##0zł",
					indexLabel: "{y}",
					indexLabelPlacement: "inside",
					indexLabelFontWeight: "bolder",
					indexLabelFontColor: "white",
					
					dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart1.render();
			}
		</script>
		<main class="main">
			<h1 class="charts__title title">Jak wydajesz swoje pieniądze?</h1>
			<div class="charts__container chart" id="chartContainer" ></div>
			<h1 class ="charts__title title1">W którym miesiącu wydałeś najwięcej?</h1>
			<div class="charts__container chart1" id="chartContainer1" ></div>
		</main>

		<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
		<script src="../js/sidebar.js"></script>
	</body>
</html>
<?php
}
else{
	header('Location: ../index.html');
}
?>