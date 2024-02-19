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
	} else {
		clearError(input);
	}
};

sendBtn.addEventListener("click", (e) => {
	e.preventDefault();

	checkForm([username, password, password2, email]);
	checkLength(username, 3);
	checkLength(password, 8);
	checkPass(password, password2);
	checkMail(email);
});

clearBtn.addEventListener("click", (e) => {
	e.preventDefault();

	[username, password, password2, email].forEach((el) => {
		el.value = "";

		clearError(el);
	});
});
