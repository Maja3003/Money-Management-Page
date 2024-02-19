const message = document.querySelector(".message");
const oldPassword = document.querySelector(".old-password");
const newPassword = document.querySelector(".new-password");
const sendBtn = document.querySelector(".send");

const showMessage = () => {
	if (oldPassword.value != "" && newPassword.value != "") {
		let formData = new FormData();
		formData.append("oldPassword", oldPassword.value);
		formData.append("newPassword", newPassword.value);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../php/zmiana_hasla.php");
		xhr.send(formData);
		xhr.onload = () => {
			fetch("../php/haslo_getdata.php")
				.then((response) => {
					if (!response.ok) {
						throw new Error("Something went wrong!");
					}
					return response.json();
				})
				.then((data) => {
					if (data == 1) {
						message.textContent = "Hasło zostało zmienione";
					} else if (data == 0) {
						message.textContent = "Podano złe stare hasło.";
					}
				})
				.catch((error) => {
					console.log(error);
				});

			return false;
		};
	} else {
		message.textContent = "Nie podano danych";
	}
};

// TODO: trzeba jeszcze dodac sprawdzanie dlugosci hasla itp

sendBtn.addEventListener("click", (e) => {
	e.preventDefault();
	message.textContent = "";
	showMessage();
	oldPassword.value = "";
	newPassword.value = "";
});
