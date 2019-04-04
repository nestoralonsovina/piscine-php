let ft_list;
let cookies = [];

$(window).on('load', () => {
    $("#new").click(take_element);
    $("#ft_list div").click(delete_element);
    ft_list = $("#ft_list");
    let tmp = document.cookie;
    if (tmp) {
        cookie = JSON.parse(tmp);
        cookie.forEach((e) => {
            add_element(e);
        });
    }
});

function save_list() {
    let todo = ft_list.children();
    let newCookie = [];
    for (let i = 0; i < todo.length; i++)
        newCookie.unshift(todo[i].innerHTML);
    document.cookie = JSON.stringify(newCookie);
};

function add_element(card) {
    ft_list.prepend($('<div>' + card + '</div>').click(delete_element));
    save_list();
}

function delete_element() {
	if (confirm("Are your sure you want to delete this element?") == true) {
        this.remove();
        save_list();
	}
}

function take_element() {
	let input = prompt();

	if (input !== null) {
		add_element(input);
	}
}
