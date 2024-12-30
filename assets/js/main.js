// untuk navbar
window.onscroll = window.onload = () => {
	const navbar = document.querySelector(".navbar");
	const navLinks = document.querySelectorAll(".nav-link.active");
	const cartIcon = document.getElementById("cart-icon");
	const scrolled = window.scrollY > 50;

	navbar.classList.toggle("navbar-scrolled", scrolled);
	navbar.classList.toggle("navbar-transparent", !scrolled);

	navLinks.forEach((link) => {
		link.classList.toggle("active-scroll", scrolled);
	});

	cartIcon.classList.toggle("icon-white", !scrolled);
	cartIcon.classList.toggle("icon-black", scrolled);
};

// untuk tab pada daftar menu paket
document.querySelectorAll(".nav .nav-link").forEach((link) => {
	link.addEventListener("click", () => {
		document.querySelectorAll(".nav .nav-link").forEach((link) => {
			link.classList.remove(
				"text-black",
				"btn-sm",
				"btn-hijau",
				"rounded-5",
				"px-3",
				"active"
			);
		});

		link.classList.add(
			"text-black",
			"btn-sm",
			"btn-hijau",
			"rounded-5",
			"px-3",
			"active"
		);
	});
});
