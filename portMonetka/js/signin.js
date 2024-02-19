const password = document.querySelector("#password");
const email = document.querySelector("#email");
const sendBtn = document.querySelector(".send");

const showError = (input, msg) => {
	const formBox = input.parentElement;
	const errorMsg = formBox.querySelector(".error-text");

	formBox.classList.add("error");
	errorMsg.textContent = msg;
};

const clearError = (input) => {
	const formBox = input.parentElement;
	formBox.classList.remove("error");
};

const checkForm = () => {
	if (email.value != "" && password.value != "") {
		let formData = new FormData();
		formData.append("haslo_logowanie", password.value);
		formData.append("email_logowanie", email.value);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../php/login.php");
		xhr.send(formData);
		xhr.onload = function () {
			fetch("../php/getdata.php")
				.then((response) => {
					if (!response.ok) {
						throw new Error("Something went wrong!");
					}
					return response.json();
				})
				.then((data) => {
					if (data == 0) {
						showError(password, "Błędne hasło lub email.");
					} else {
						clearError(password);
						window.location.href = "../html/panel.php";
					}
				})
				.catch((error) => {
					console.log(error);
				});

			return false;
		};
	} else {
		showError(password, "Błędne hasło lub email.");
	}
};

sendBtn.addEventListener("click", (e) => {
	e.preventDefault();

	checkForm();
});
