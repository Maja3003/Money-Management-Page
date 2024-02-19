<?php
session_start();
$email=$_SESSION['email_user'];
require("../php/connect.php");
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
	$id= $_SESSION['id_user'];
if (isset($_SESSION['czyZalogowany'])&& $_SESSION['czyZalogowany']==True)
{

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
							<button type="submit" class="sidebar__profile-logout">
								<i class="bx bx-log-out" id="log_out"></i>
							</button>
						</form>
					</div>
				</li>
			</ul>
		</nav>

		<main>
			<section class="options">
				<div>
					<h2 class="title">Dostępne środki:</h2>
					<p class="available-money">
						<?php 
							echo $_SESSION['saldo'];
							
						?>zł
					</p>
				</div>
				<div class="controls">
					<button class="add-transaction">
						<i class="fas fa-plus"></i> Dodaj transakcję
					</button>
				</div>
			</section>

		</main>
		<form
		method="POST"
		action="dodajdopanelu.php"
		class="add-transaction-panel">
		<h2 class="add-transaction-panel__title">Dodaj nową transakcję</h2>
		
		<label for="amount">Kwota:</label>
		<small>
			(podaj kwotę transakcji
		</small>
		<input type="number" id="amount" name="transakcja" />
		
		<label for="category">Wybierz kategorię:</label>
		<small>( [ + ] oznacza przychód, [ - ] oznacza wydatek)</small>
		<select id="category" name="jelop">
			<option value="none" selected disabled></option>
			<option value="przychod">[ + ] Przychód</option>
			<option value="transport">[ - ] Transport</option>
			<option value="zakupy">[ - ] Zakupy</option>
			<option value="zdrowie">[ - ] Zdrowie</option>
			<option value="aktywnosc">[ - ] Aktywność</option>
			<option value="jedzenie">[ - ] Jedzenie</option>
			<option value="wynajem">[ - ] Czynsz</option>
		</select>

		<label for="name">Opis:</label>
		<small>(podaj krótki opis)</small>
		<input type="text" id="name" name="opis"/>

		<div class="panel-buttons">
			<button class="save" type="submit">
				<i class="fas fa-save"></i> Dodaj
			</button>
			<button class="cancel" type="button">
				<i class="far fa-window-close"></i> Anuluj
			</button>
		</div>
	</form>

	

		<section class="history">

			
			<h2 class="history__title">Historia transakcji:</h2>

			<table class="history__table">
				<tr>
					<th>L.p</th>
					<th>Nazwa Transakcji</th>
					<th>kwota</th>
					<th>opis</th>
				</tr>
				<?php
				$sql_historia = "SELECT * FROM `wydatkihistoria` WHERE idUser = '$id';";
				$historia_result=$conn->query($sql_historia);
				$licznik=1;
				while ($row = $historia_result->fetch_assoc()) {
					
					echo '<tr>'.'<td>'.$licznik.'</td>'.'<td>'.$row['wydatekNazwa'].'</td>'.'<td>'.$row['kwota'].'zł</td>'.'<td>'.$row['Opis'].'</td>'.'</tr>';
					$licznik++;
				}
			?>
			</table>

		</section>

		<script src="../js/sidebar.js"></script>
		<script src="../js/panel.js"></script>
	</body>
</html>
<?php
}
else{
	header('Location: ../index.html');
}
?>
