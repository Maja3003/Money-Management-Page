const username = document.querySelector("#username");
const password = document.querySelector("#password");
const password2 = document.querySelector("#password2");
const email = document.querySelector("#email");
const clearBtn = document.querySelector(".clear");
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

const checkForm = (input) => {
	input.forEach((el) => {
		if (el.value === "") {
			showError(el, el.placeholder);
		} else {
			clearError(el);
		}
	});
};

const checkLength = (input, min) => {
	if (input.value.length < min) {
		const inputName = input.previousElementSibling.innerText;
		showError(input, `${inputName} składa się z min. ${min} znaków.`);
	}
};

const checkPass = (pass1, pass2) => {
	if (pass1.value !== pass2.value) {
		showError(pass2, "Hasła do siebie nie pasują.");
	}
};

const checkMail = (input) => {
	const re =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if (!re.test(input.value)) {
		showError(input, "Nieprawidłowy email.");
		return false;
	} else {
		clearError(input);
		return true;
	}
};

const ajaxCall = () => {
	if (
		email.value != "" &&
		password.value != "" &&
		password.value != "" &&
		password2.value != "" &&
		username.value != ""
	) {
		let dataForm = new FormData();
		dataForm.append("login_rejestracja", username.value);
		dataForm.append("haslo_rejestracja", password.value);
		dataForm.append("email_rejestracja", email.value);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../php/rejestracja.php");
		xhr.send(dataForm);
		xhr.onload = function () {
			fetch("../php/iloscBledow.php")
				.then((response) => {
					if (!response.ok) {
						throw new Error("Something went wrong!");
					}
					return response.json();
				})
				.then((data) => {
					console.log(data);
					if (data == 0) {
						showError(username, "Podana nazwa użytkownika jest zajęta");
					} else if (data == 2) {
						console.log("kupka");
						if (email.value != "" && checkMail(email)) {
							console.log("kupka2");
							showError(email, "Podany email jest zajęty.");
						}
					} else {
						if (username.value != "" && email.value != "") {
							clearError(username);
							clearError(email);
						}
						window.location.href = "../html/po_rejestracji.html";
					}
				})
				.catch((error) => {
					console.log(error);
				});

			return false;
		};
	}
};

sendBtn.addEventListener("click", (e) => {
	e.preventDefault();

	checkForm([username, password, password2, email]);
	checkLength(username, 3);
	checkLength(password, 8);
	checkPass(password, password2);
	checkMail(email);
	ajaxCall();
});

clearBtn.addEventListener("click", (e) => {
	e.preventDefault();

	[username, password, password2, email].forEach((el) => {
		el.value = "";

		clearError(el);
	});
});
