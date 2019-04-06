let ft_list;

$(window).on('load', () => {
    $("#new").click(take_element);
    $("#ft_list div").click(delete_element);
    ft_list = $("#ft_list");
    loadData();
});

function loadData() {
    ft_list.empty();

    $.ajax({
        url: 'select.php',
        method: "GET",
        data: null,
    }).done((response) => {
            response = JSON.parse(response);
            $.each(response, (index, value) => {
                ft_list.prepend($('<div data-id="' + index + '">' + value + '</div>').click(delete_element));
            })
    });
}

function add_element(card) {
    $.ajax({
        url: 'insert.php?todo=' + card,
        method: "GET",
        data: null,
    }).done((data) => loadData());
}

function delete_element() {
	if (confirm("Are your sure you want to delete this element?")) {
	    $.ajax({
            url: 'delete.php?id=' + $(this).data('id'),
            method: "GET",
            data: null,
        }).done((data) => loadData());
	}
}

function take_element() {
	let input = prompt();

	if (input !== null) {
		add_element(input);
	}
}
