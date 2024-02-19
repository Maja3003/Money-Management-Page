const navMobile = document.querySelector(".nav-mobile");
const navBtn = document.querySelector(".hamburger");
const footerYear = document.querySelector(".footer__year");
const allNavItems = document.querySelectorAll(".nav__link");

const plansSilver = document.querySelector(".plans__silver");
const plansGold = document.querySelector(".plans__gold");
const plansDiamond = document.querySelector(".plans__diamond");
const plansModal = document.querySelector(".plans__modal");

const silverBtn = document.querySelector(".silver-btn");
const goldBtn = document.querySelector(".gold-btn");
const diamondBtn = document.querySelector(".diamond-btn");

const plansBtns = document.querySelectorAll(".plans__item-button");
const closeModalBtns = document.querySelectorAll(".plans__modal-button");

const handleNav = () => {
	navBtn.classList.toggle("is-active");
	navMobile.classList.toggle("nav-mobile--active");
	document.body.classList.toggle("sticky-body");

	allNavItems.forEach((item) => {
		item.addEventListener("click", () => {
			navMobile.classList.remove("nav-mobile--active");
			navBtn.classList.remove("is-active");
			document.body.classList.remove("sticky-body");
		});
	});
};

const handleCurrentYear = () => {
	const year = new Date().getFullYear();
	footerYear.innerText = year;
};

const showModal = (e) => {
	plansSilver.classList.remove("plan-active");
	plansGold.classList.remove("plan-active");
	plansDiamond.classList.remove("plan-active");

	if (!plansModal.classList.contains("modal-active")) {
		plansModal.classList.add("modal-active");
		document.body.classList.add("sticky-body");

		if (e.target === silverBtn) {
			plansSilver.classList.add("plan-active");
		} else if (e.target === goldBtn) {
			plansGold.classList.add("plan-active");
		} else if (e.target === diamondBtn) {
			plansDiamond.classList.add("plan-active");
		}
	} else {
		document.body.classList.remove("sticky-body");
		plansModal.classList.remove("modal-active");
	}
};

navBtn.addEventListener("click", handleNav);
window.addEventListener("click", (e) => {
	// e.target === plansModal ? showModal() : false;
	if (e.target === plansModal) {
		showModal();
	}
});
plansBtns.forEach((btn) => {
	btn.addEventListener("click", showModal);
});
closeModalBtns.forEach((btn) => {
	btn.addEventListener("click", showModal);
});

handleCurrentYear();
