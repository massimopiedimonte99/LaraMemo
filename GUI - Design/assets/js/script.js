this.addEventListener('DOMContentLoaded', function() {
	document.querySelector('.avatar').onclick = function() {
		document.querySelector('.avatar-info').classList.toggle('show');
	}
});