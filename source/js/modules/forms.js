// =======================================
// Variables and modules
// =======================================
var popup = require("./popup.js");
popup.init("#hm-popup", ".hm-popup__text", ".hm-popup__close");

var match_arr = {
		"username" : /^[A-Za-zА-Яа-я0-9_-\s]{2,}$/g,
		"email" : /^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/g,
		"text" : /.{10,}/g,
		"password" : /^([a-zA-Z0-9@*#]{6,18})$/g

	},
	errors_arr = {
		"username" : "Имя должно быть длиннее 2х символов и не содержать посторонних знаков",
		"email" : "Email имеет неверный формат<br/>Например: ex@mp.le",
		"text" : "Ваше сообщение должно быть не короче 10 символов"
	};




// =======================================
// Hide tooltips
// =======================================
function hideTooplitp(){
	var field = $(this);

	if(field.next().hasClass("tooltip")){
		field.next().removeClass("show").addClass("hide");
	}
};



// =======================================
// Check text fields on air with regexp
// =======================================
function onAirCheck (form_selector){
	var fields = $(form_selector).find("input[type=text], input[type=email], input[type=password], textarea");

	fields.on("keyup", function(){
		var field = $(this),
			check_type = field.data("check"),
			value = field.val();

		if(value.match(match_arr[check_type])){
			field.removeClass("error").addClass("valid");
		}else{
			field.removeClass("valid").addClass("error");
		};

	});
};



// =======================================
// Check text fields on form submit
// =======================================
function textFieldsCheck (form) {
	var fields = form.find("input[type=text], input[type=email], textarea"),
		valid = true,
		tooltip_template = $("<div class='tooltip'></div>"),
		form_offset = form.offset().top;


	fields.each(function() {
		var field = $(this),
			check_type = field.data("check"),
			value = field.val(),
			tooltip_offset = field.offset().top - form_offset;

		if(!value.match(match_arr[check_type])){
			var field_tooltip;

			if(field.next().hasClass("tooltip")){
				field_tooltip = field.next();
			} else {
				field_tooltip = tooltip_template.clone();
				field.after(field_tooltip);
			}

			field_tooltip
				.css({"top" : tooltip_offset})
				.html(errors_arr[check_type])
				.removeClass("hide")
				.addClass("show");

			field.addClass("error");
			valid = false;
		}

	});

	return valid;
};



// =======================================
// Reset textfields
// =======================================
function resetForm (form){
	var maybe_airchecked_fields = form.find("input[type=text], input[type=email], input[type=password], textarea"),
		tooltips = form.find(".tooltip");

	maybe_airchecked_fields.removeClass("error valid");
	tooltips.removeClass("show").addClass("hide");
	form[0].reset();
}



// =======================================
// Send Feedback
// =======================================
function sendFeedback (form) {
	if(textFieldsCheck(form)){
		$.ajax({
			url: "php/mail.php",
			type: "POST",
			data: form.serialize(),
			dataType: "json"
		}).done(function(resp) {
			popup.showPopup(resp.message);
			resetForm(form);
		}).fail(function(){
			popup.showPopup("Упс. На сервере произошла ошибка.<br/>Попробуйте позже.");
			resetForm(form);
		});
		return false;
	} else {
		popup.showPopup("Пожалуйста исправьте ошибки заполнения.",2500);
	}
}



// =======================================
// Check robot
// =======================================
function checkRobot(form, checkbox_stat, radio_stat){
	var valid = false,
		human = $("input:checkbox").prop("checked"),
		radio = $("input:radio:checked").val();

	if(human===checkbox_stat && radio===radio_stat){
		valid = true;
	}else{
		popup.showPopup("Айзеку Азимову было бы стыдно за такого врушу",2500);
	}

	return valid;
}



// =======================================
// Process login
// =======================================
function authorization(form){
	// $.ajax({
	// 	type: "POST",
	// 	url: "process.php",
	// 	data: form.serialize()
	// }).done(function() {

	// });

	popup.showPopup("Тут еще будет проверка пароля, но не сегодня.<br/>Добро пожаловать", 3000);
	setTimeout(function(){
		window.location.href = "/admin.html";
	}, 3000)
	return false;
}



// =======================================
// Auth form watcher
// =======================================
function authForm (selector, login, checkbox_stat, radio_stat){
	var form = $(selector),
		button = form.find(login);

	form.on("submit", function(e){
		e.preventDefault();
		if(checkRobot(form, checkbox_stat, radio_stat)){
			authorization(form);
		}
		resetForm(form);
	});

	// button.on("click", function(e){
	// 	e.preventDefault();
	// 	form.trigger("submit");
	// 	resetForm(form);
	// });
}



// =======================================
// Contact form watcher
// =======================================
function contactForm (selector, reset){
	var form = $(selector),
		reset = form.find(reset),
		fields = form.find("input[type=text], input[type=email], textarea");

	fields.on("focus", hideTooplitp);

	reset.on("click", function(e){
		e.preventDefault();
		resetForm(form);
	});

	form.on("submit", function(e) {
		e.preventDefault();
		sendFeedback(form);
	});
};



module.exports = {
	contactForm : contactForm,
	authForm : authForm,
	onAirCheck : onAirCheck
};