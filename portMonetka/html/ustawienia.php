<?php
session_start();
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
		<link rel="stylesheet" href="../sass/css/ustawienia.css" />
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
					<a href="ustawienia.html">
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
		<main class="main">
			<div class="user__settings">
				<h1 class="user__settings-title">Twoje dane</h1>
				<div class="user__settings-info-box">
					<div class="user__settings-info-box-name">
						<p class="user__settings-info-box-p">Login</p>
						<p class="user__settings-info-box-p">Hasło</p>
						<p class="user__settings-info-box-p">E-mail</p>
					</div>
					<div class="user__settings-info-box-bio">
						<p class="user__settings-info-box-p underline">
							<?php
								echo $_SESSION['zalogowany_user'];
							?>
						</p>
						<p class="user__settings-info-box-p underline">********</p>
						<p class="user__settings-info-box-p underline">
							<?php
								echo $_SESSION['email_user'];
							?>
						</p>
					</div>
				</div>
				<h1 class="user__settings-title">Zmień hasło</h1>
				<form class="user__settings-form" method="POST">
					<div class="user__settings-form-container">
						<div class="user__settings-form-labels">
							<label class="user__settings-form-item" for="oldPassword">
								Stare hasło
							</label>
							<label class="user__settings-form-item" for="newPassword">
								Nowe hasło
							</label>
						</div>
						<div class="user__settings-form-inputs">
							<input
								class="user__settings-form-input old-password"
								type="password"
								id="oldPassword"
								name="oldPassword"
							/>
							<input
								class="user__settings-form-input new-password"
								type="password"
								id="newPassword"
								name="newPassword"
							/>
						</div>
					</div>

					<button class="send">Wyślij</button>
				</form>
				<p class="message"></p>
			</div>
		</main>

		<script src="../js/sidebar.js"></script>
		<script src="../js/settings.js"></script>
	</body>
</html>
<?php
}
else{
	header('Location: ../index.html');
}
?>
