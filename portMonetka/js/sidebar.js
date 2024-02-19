const sidebar = document.querySelector(".sidebar");
const closeBtn = document.querySelector("#btn");
const profileName = document.querySelector(".sidebar__profile-name");

const menuBtnChange = () => {
	if (sidebar.classList.contains("open")) {
		closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
	} else {
		closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
	}
};

closeBtn.addEventListener("click", () => {
	sidebar.classList.toggle("open");
	menuBtnChange();
});
