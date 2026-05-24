const scrollBtn =
	document.getElementById('scrollTopBtn');
window.onscroll = function () {
	if (document.documentElement.scrollTop > 200) {
		scrollBtn.style.display = 'block';
	} else {
		scrollBtn.style.display = 'none';
	}
};
if (scrollBtn) {
	scrollBtn.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});
}
const darkBtn = document.getElementById('darkModeToggle');
if (localStorage.getItem('darkMode') === 'enabled') {
	document.body.classList.add('dark-mode');
	if (darkBtn) {
		darkBtn.innerHTML = '☀️';
	}
}
function toggleDarkMode() {
	document.body.classList.toggle('dark-mode');
	if (document.body.classList.contains('dark-mode')) {
		localStorage.setItem(
			'darkMode',
			'enabled'
		);
		if (darkBtn) {
			darkBtn.innerHTML = '☀️';
		}
	} else {
		localStorage.setItem(
			'darkMode',
			'disabled'
		);
		if (darkBtn) {
			darkBtn.innerHTML = '🌙';
		}
	}
}