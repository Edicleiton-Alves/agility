
function chargeWidth() {
	if (window.innerWidth < 576) {
		$('#subMenu').addClass('offcanvas bgDash');
		$('nav > .nav-link').addClass('rounded-2');
		$('body').removeClass('vh-100');
	} else {
		$('#subMenu').removeClass('offcanvas bgDash');
		$('nav > .nav-link').removeClass('rounded-2');
		$('body').addClass('vh-100');
	}
}
chargeWidth();

$(window).resize(function () {
	chargeWidth();
});

$('#v-pills-planos').load("/load/planos");

$('[data-load="pills"]').click(function () {
	let page = $(this).attr('data-content');
	$('#v-pills-' + page).html('<div class="d-flex vh-60"><div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;"></div></div>').off().load('/load/' + page);
	$('.offcanvas').offcanvas('hide');
});

function toast($status, $msg) {
	if ($status == 'success') {
		$('.toast-body').html($msg);
		$('.toast').removeClass('text-bg-danger').addClass('text-bg-success').toast('show');
	} else {
		$('.toast-body').html($msg);
		$('.toast').removeClass('text-bg-success').addClass('text-bg-danger').toast('show');
	}
}

function search(input, search) {
	let x = $('.' + search);
	let i;
	for (i = 0; i < x.length; i++) {
		if (!$(x[i]).text().toLowerCase().includes(input)) {
			$(x[i]).fadeOut(300);
		} else {
			$(x[i]).fadeIn(300);
		}
	}
}

function sendForm() {
	this.action;
	this.method;
	this.data;
	this.param;

	this.getter = function (getter) {
		return this[getter];
	};

	this.setForm = function (form) {
		this.action = $(form).attr('action');
		this.method = $(form).attr('method');
		if (this.method == 'post') {
			this.data = new FormData(form);
		} else {
			this.data = $(form).serialize();
		}
	};

	this.resetForm = function () {
		this.action = '';
		this.method = '';
		this.data = '';
		this.param = '';
	};

	this.request = function () {
		let result;
		$.ajax({
			url: this.action,
			type: this.method,
			dataType: 'json',
			data: this.data,
			async: false,
			contentType: false,
			processData: false,
			success: function (r) {
				result = r;
			},
			error: function (r) {
				result = { status: 'error', msg: 'Erro Interno!' };
			}
		});
		return result;
	}

	this.get = function (action, param) {
		this.resetForm();
		this.action = action + '/' + param;
		this.method = 'get';
		this.param = param;
		return this.request();
	};
}

const envForm = new sendForm();

function desenDado(dado) {
	return result = envForm.get('/load/cod', dado);
}

function encDado(dado) {
	let result;
	let compl = "<?php echo base64_encode($_SERVER['REMOTE_ADDR']); ?>";
	result = envForm.get('/load/dec', btoa(dado + '-' + atob(compl)));

	return result.resposta;
}

document.addEventListener("DOMContentLoaded", function () {
	const menu = document.querySelector(".menu-lateral");
	const main = document.querySelector("main");
	const btnToggle = document.getElementById("toggleFixar");
	const iconeFixar = document.getElementById("iconeFixar");

	if (!menu || !main || !btnToggle || !iconeFixar) return;

	function ajustarMainMargin() {
		const menuWidth = window.getComputedStyle(menu).width;
		main.style.marginLeft = menuWidth;
	}

	btnToggle.addEventListener("click", function () {
		// Bloqueia fixar no mobile
		if (window.innerWidth <= 768) return;

		menu.classList.toggle("menu-fixo");

		if (menu.classList.contains("menu-fixo")) {
			iconeFixar.classList.remove("bi-pin");
			iconeFixar.classList.add("bi-pin-angle-fill");
		} else {
			iconeFixar.classList.remove("bi-pin-angle-fill");
			iconeFixar.classList.add("bi-pin");
		}

		ajustarMainMargin();
	});

	// Hover desktop apenas
	menu.addEventListener("mouseenter", function () {
		if (window.innerWidth <= 768) return;
		ajustarMainMargin();
	});

	menu.addEventListener("mouseleave", function () {
		if (window.innerWidth <= 768) return;

		if (!menu.classList.contains("menu-fixo")) {
			main.style.marginLeft = "80px";
		}
	});

	// Se já estiver fixo no carregamento e desktop
	if (menu.classList.contains("menu-fixo") && window.innerWidth > 768) {
		ajustarMainMargin();
	}

	// Remove fixar se redimensionar para mobile
	window.addEventListener("resize", function () {
		if (window.innerWidth <= 768 && menu.classList.contains("menu-fixo")) {
			menu.classList.remove("menu-fixo");
			iconeFixar.classList.remove("bi-pin-angle-fill");
			iconeFixar.classList.add("bi-pin");
			main.style.marginLeft = "0";
		}
	});
});

