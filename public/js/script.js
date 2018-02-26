this.addEventListener('DOMContentLoaded', function() {
	
	document.querySelector('.avatar').onclick = function() {
		document.querySelector('.avatar-info').classList.toggle('show');
	}
	
	document.getElementById("avatar").onchange = function() {
    	document.getElementById("avatar-upload").submit();
	};

	for(let i = 0; i < document.querySelectorAll(".fa-trash").length; i++) {
		document.querySelectorAll(".fa-trash")[i].onclick = function() {
			this.parentNode.submit();
		}
	}

	// Like System w/h AJAX and jQuery
	$('.fa-heart').click((e) => {
		e.preventDefault();
		var id = $(e.target).attr('data-id');
		$.ajax({
			method: "POST",
			url: url,
			data: { _token, id }
		}).done((msg) => {
			if(msg['status']) {
				$(e.target).addClass('liked');
			} else {
				$(e.target).removeClass('liked');
			}
		});
	});

});