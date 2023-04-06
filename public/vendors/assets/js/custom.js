$(function () {
	'use strict'

	//Switcher
	$(document).on("click", "a[data-switcher]", function (e) {
		$("head link#switcher").attr("href", $(this).data("switcher"));
		$(this).toggleClass('active').siblings().removeClass('active');
	});

	// ______________HEADER COLOR
	$(document).on('click', '#myonoffswitch', function (e) {
		if (this.checked) {
			$('body').addClass('demo-header-color');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-light');
			$('body').removeClass('demo-header-gradient');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			localStorage.setItem("demo-header-color", "True");
		}
		else {
			$('body').removeClass('demo-header-color');
			localStorage.setItem("demo-header-color", "false");
		}
	});

	// ______________HEADER DARK
	$(document).on('click', '#myonoffswitch1', function (e) {
		if (this.checked) {
			$('body').addClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-light');
			$('body').removeClass('demo-header-gradient');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			localStorage.setItem("demo-header-dark", "True");
		}
		else {
			$('body').removeClass('demo-header-dark');
			localStorage.setItem("demo-header-dark", "false");
		}
	});

	// ______________HEADER LIGHT
	$(document).on('click', '#myonoffswitch2', function (e) {
		if (this.checked) {
			$('body').addClass('demo-header-light');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-gradient');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			localStorage.setItem("demo-header-light", "True");
		}
		else {
			$('body').removeClass('demo-header-light');
			localStorage.setItem("demo-header-light", "false");
		}
	});

	// ______________HEADER GRADEINT
	$(document).on('click', '#myonoffswitch3', function (e) {
		if (this.checked) {
			$('body').addClass('demo-header-gradient');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-light');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			localStorage.setItem("demo-header-gradient", "True");
		}
		else {
			$('body').removeClass('demo-header-gradient');
			localStorage.setItem("demo-header-gradient", "false");
		}
	});

	// ______________HORIZONATL LIGHT
	$(document).on('click', '#myonoffswitch4', function (e) {
		if (this.checked) {
			$('body').addClass('horizontal-header-light');
			$('body').addClass('demo-header-light');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-gradient');
			localStorage.setItem("horizontal-header-light", "True");
		}
		else {
			$('body').removeClass('horizontal-header-light');
			localStorage.setItem("horizontal-header-light", "false");
		}
	});

	// ______________HORIZONATL COLOR
	$(document).on('click', '#myonoffswitch5', function (e) {
		if (this.checked) {
			$('body').addClass('horizontal-header-color');
			$('body').addClass('demo-header-light');
			$('body').removeClass('horizontal-header-light');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-gradient');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-gradient');
			localStorage.setItem("horizontal-header-color", "True");
		}
		else {
			$('body').removeClass('horizontal-header-color');
			localStorage.setItem("horizontal-header-color", "false");
		}
	});

	// ______________HORIZONATL DARK
	$(document).on('click', '#myonoffswitch6', function (e) {
		if (this.checked) {
			$('body').addClass('horizontal-header-dark');
			$('body').addClass('demo-header-light');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-light');
			$('body').removeClass('horizontal-header-gradient');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-gradient');
			localStorage.setItem("horizontal-header-dark", "True");
		}
		else {
			$('body').removeClass('horizontal-header-dark');
			localStorage.setItem("horizontal-header-dark", "false");
		}
	});

	// ______________HORIZONATL GRADEINT
	$(document).on('click', '#myonoffswitch7', function (e) {
		if (this.checked) {
			$('body').addClass('horizontal-header-gradient');
			$('body').addClass('demo-header-light');
			$('body').removeClass('horizontal-header-color');
			$('body').removeClass('horizontal-header-dark');
			$('body').removeClass('horizontal-header-light');
			$('body').removeClass('demo-header-dark');
			$('body').removeClass('demo-header-color');
			$('body').removeClass('demo-header-gradient');
			localStorage.setItem("horizontal-header-gradient", "True");
		}
		else {
			$('body').removeClass('horizontal-header-gradient');
			localStorage.setItem("horizontal-header-gradient", "false");
		}
	});


	// ______________FULL SCREEN
	$(document).on("click", ".fullscreen-button", function toggleFullScreen() {
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})

	// ___________TOOLTIP	
	$('[data-toggle="tooltip"]').tooltip();
	// colored tooltip
	$('[data-toggle="tooltip-primary"]').tooltip({
		template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
	});
	$('[data-toggle="tooltip-secondary"]').tooltip({
		template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
	});

	// __________POPOVER
	$('[data-toggle="popover"]').popover();
	$('[data-popover-color="head-primary"]').popover({
		template: '<div class="popover popover-head-primary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="head-secondary"]').popover({
		template: '<div class="popover popover-head-secondary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="primary"]').popover({
		template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="secondary"]').popover({
		template: '<div class="popover popover-secondary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$(document).on('click', function (e) {
		$('[data-toggle="popover"],[data-original-title]').each(function () {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons within a button that triggers a popup
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				(($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false // fix for BS 3.3.6
			}
		});
	});

	// __________MODAL

	// showing modal with effect
	$('.modal-effect').on('click', function (e) {
		e.preventDefault();
		var effect = $(this).attr('data-effect');
		$('#modaldemo8').addClass(effect);
	});
	// hide modal with effect
	$('#modaldemo8').on('hidden.bs.modal', function (e) {
		$(this).removeClass(function (index, className) {
			return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
		});
	});

	// ______________LOADER
	$("#loading").fadeOut("slow");


	// ______________ COVER IMAGE
	$(".cover-image").each(function () {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});

	// ______________ CARD REMOVE
	$('[data-toggle="card-remove"]').on('click', function (e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});

	// ______________ HIDE ACTIVE MENU IN DESKTOP
	if (window.matchMedia('(min-width: 992px)').matches) {
		$('.main-navbar .active').removeClass('show');
		$('.main-header-menu .active').removeClass('show');
	}

	// ______________  HEADER DROPDOWN HIDING CLICK ON ANOTHER LINK
	$('.main-header .dropdown > a').on('click', function (e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});

	// ______________  SUBMENU CLOSED WHEN ANOTHER SUBMENU IS OPEN
	$('.main-navbar .with-sub').on('click', function (e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});

	// ______________ HIDE DROPDOWN MENU IN MOBILE
	$('.dropdown-menu .main-header-arrow').on('click', function (e) {
		e.preventDefault();
		$(this).closest('.dropdown').removeClass('show');
	});

	// ______________ NAVBAR LEFT IN MOBILE
	$('#mainNavShow').on('click', function (e) {
		e.preventDefault();
		$('body').addClass('main-navbar-show');
	});

	// ______________  HIDE CURRENT OPEN CONTENT
	$('#mainContentLeftShow').on('click touch', function (e) {
		e.preventDefault();
		$('body').addClass('main-content-left-show');
	});

	// ______________  LEFT CONTENT SHOW IN MOBILE
	$('#mainContentLeftHide').on('click touch', function (e) {
		e.preventDefault();
		$('body').removeClass('main-content-left-show');
	});

	// ______________ CONTENT BODY IN MOBILE
	$('#mainContentBodyHide').on('click touch', function (e) {
		e.preventDefault();
		$('body').removeClass('main-content-body-show');
	})

	// ______________ NAVBAR BACKDROP MOBILE
	$('body').append('<div class="main-navbar-backdrop"></div>');
	$('.main-navbar-backdrop').on('click touchstart', function () {
		$('body').removeClass('main-navbar-show');
	});

	// ______________ CLOSE DROPDOWN HEADERMENU
	$(document).on('click touchstart', function (e) {
		e.stopPropagation();
		var dropTarg = $(e.target).closest('.main-header .dropdown').length;
		if (!dropTarg) {
			$('.main-header .dropdown').removeClass('show');
		}
		if (window.matchMedia('(min-width: 992px)').matches) {
			// Navbar
			var navTarg = $(e.target).closest('.main-navbar .nav-item').length;
			if (!navTarg) {
				$('.main-navbar .show').removeClass('show');
			}
			// Header Menu
			var menuTarg = $(e.target).closest('.main-header-menu .nav-item').length;
			if (!menuTarg) {
				$('.main-header-menu .show').removeClass('show');
			}
			if ($(e.target).hasClass('main-menu-sub-mega')) {
				$('.main-header-menu .show').removeClass('show');
			}
		} else {
			//
			if (!$(e.target).closest('#mainMenuShow').length) {
				var hm = $(e.target).closest('.main-header-menu').length;
				if (!hm) {
					$('body').removeClass('main-header-menu-show');
				}
			}
		}
	});
	$('#mainMenuShow').on('click', function (e) {
		e.preventDefault();
		$('body').toggleClass('main-header-menu-show');
	})
	$('.main-header-menu .with-sub').on('click', function (e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$('.main-header-menu-header .close').on('click', function (e) {
		e.preventDefault();
		$('body').removeClass('main-header-menu-show');
	})


	// ______________ Global Search
	$(document).on("click", "[data-toggle='search']", function (e) {
		var body = $("body");

		if (body.hasClass('search-gone')) {
			body.addClass('search-gone');
			body.removeClass('search-show');
		} else {
			body.removeClass('search-gone');
			body.addClass('search-show');
		}
	});
	var toggleSidebar = function () {
		var w = $(window);
		if (w.outerWidth() <= 1024) {
			$("body").addClass("sidebar-gone");
			$(document).off("click", "body").on("click", "body", function (e) {
				if ($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
					$("body").removeClass("sidebar-show");
					$("body").addClass("sidebar-gone");
					$("body").removeClass("search-show");
				}
			});
		} else {
			$("body").removeClass("sidebar-gone");
		}
	}
	toggleSidebar();
	$(window).resize(toggleSidebar);
	//_________________ Redirection Handler

	$('body').on('click', '[data-redirect-to]', function () {
		let url = $(this).attr('data-redirect-to');
		location.href = url;
	})
	$('[data-sync]').click(async function () {
		let url = $(this).attr('data-sync');
		await fetch(url);
	})
	// ______________Horizontal-menu Active Class
	function addActiveClass(element) {
		if (current === "") {
			if (element.attr('href').indexOf("#") !== -1) {
				element.parents('.main-navbar .nav-item').last().removeClass('active');
				if (element.parents('.main-navbar .nav-sub').length) {
					element.parents('.main-navbar .nav-sub-item').last().removeClass('active');
				}
			}
		} else {
			if (element.attr('href') === current) {
				element.parents('.main-navbar .nav-item').last().addClass('active');
				if (element.parents('.main-navbar .nav-sub').length) {
					element.parents('.main-navbar .nav-sub-item').last().addClass('active');
				}
			}
		}
	}
	var current = (location.href).split('?')[0].replace('#', '');
	$('.main-navbar .nav li a').each(function () {
		var $this = $(this);
		addActiveClass($this);
	})

	const socketServer = $('[name="socket.io"]').attr('data-server');
	const userId = $('[name="socket.io"]').attr('data-protocol-number');
	const route = $('[name="socket.io"]').attr('data-note-route');
	const _token = $('[name="socket.io"]').attr('data-pk')
	const socket = io(socketServer, {
		auth: {_token}
	});
	let notificationCount = 1;
	socket.on("connect_error", (err) => {
		console.error(err.message, ':', err.data.content); // not authorized
	  });
	socket.on(`user.${userId}.notify`, (data) => {
		Notification.show(data);
		$('[data-sync]').addClass('new');
		$('.main-notification-text').html(`You have ${notificationCount++} unread Notifications`);
		$('.main-notification-list').prepend(`<div class="media new"
		data-redirect-to="${data.url}">
		<div class="main-img-user"><img alt=""
				src="/vendors/assets/img/users/user.png">
		</div>
		<div class="media-body">
			<p>
				${data.message}
			</p>
			<span>
				Now
			</span>
		</div>
	</div>`)
	})


	$('[data-accept]').click(function() {
		let url = $(this).attr('data-accept');
		fetch(url)
		.then((res) => {
			if(res.ok) {
				$('#successHeading').html('Congradulations!');
				$('#successText').html("Availability Updated to the User. You'll be notified soon after Payment Completion.");
				$('#successModal').modal('show');
				$(this).parents('.req-card').fadeOut();
			}
		})
	})
	$('[data-decline]').click(function() {
		let url = $(this).attr('data-decline');
		fetch(url)
		.then((res) => {
			if(res.ok) {
				$('#successHeading').html('Order Rejected');
				$('#successText').html("Availability Updated to the User. Thanks for a Quick Update!");
				$('#successModal').modal('show');
				$(this).parents('.req-card').fadeOut();
			}
		})
	});
	$('[data-cancel]').click(function() {
		let url = $(this).attr('data-cancel');
		fetch(url)
		.then((res) => {
			if(res.ok) {
				$('#successHeading').html('Order Cancelled');
				$('#successText').html("Order cancelled successfully");
				$('#successModal').modal('show');
				$(this).parents('.req-card').fadeOut();
			}
		})
	})
});