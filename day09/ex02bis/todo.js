function add_element_cook(card) {
	const wrapper = document.getElementById('ft_list');
	let newDiv = document.createElement('div');
	newDiv.innerHTML += card;
	newDiv.onclick = delete_element;
	wrapper.prepend(newDiv);
	setCookie("todo", card, 2);
}

function add_element(card) {
	const wrapper = document.getElementById('ft_list');
	let newDiv = document.createElement('div');
	newDiv.innerHTML += card;
	newDiv.onclick = delete_element;
	wrapper.prepend(newDiv);
}

function delete_element() {
	if (confirm("Are your sure you want to delete this element?") == true) {
		this.remove();

		let cook = getCookie("todo");
		cook = cook.split('/');

		for (let i = 0; i < cook.length; i++) {
			const element = cook[i];
			if (element == this.innerHTML) {
				cook.splice(i, 1);
				break;
			}
		}

		cook = cook.join('/');
		var d = new Date();
		d.setTime(d.getTime() + (2 * 24 * 60 * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = "todo" + "=" + encodeURIComponent(cook) + ";" + expires + ";path=/";
	}
}

function take_element() {
	let input = prompt();

	if (input !== null) {
		add_element_cook(input);
	}
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
	  var c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	}
	return "";
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	if (getCookie("todo") == "") {
		document.cookie = cname + "=" + encodeURIComponent(cvalue) + ";" + expires + ";path=/";
	} else {
		document.cookie = cname + "=" + encodeURIComponent(getCookie("todo") + "/" + cvalue) + ";" + expires + ";path=/";
	}
}

function generate_html_from_cookies() {
	let todo = getCookie("todo");

	todo = todo.split("/");
	todo.forEach(element => {
		add_element(element);
	});
}

$(window).on('load', () => {

	if (getCookie("todo") != "") {
		generate_html_from_cookies();
	}
});
