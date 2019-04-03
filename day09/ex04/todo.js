

function setStoreItem(element) {
	$.ajax({
		type: "POST",
		url: "insert.php",
		data: element,
		success: (response) => {console.log(response)},
		dataType: "text"
	});
}

function take_element() {
	let input = prompt();

	if (input !== null) {
		setStoreItem(input);
	}
}

function getStoredItems() {
	$.ajax({
		type: "GET",
		url: "select.php",
		dataType: "text",
		success: (response) => {
			print_html(response);
			console.log("SUCCESS in reading previous information")
		},
		error: () => {
			console.log("ERROR");
		}
	});
}

$(window).on('load', () => {
	$("#new").click(() => {
		take_element();
	})
});
