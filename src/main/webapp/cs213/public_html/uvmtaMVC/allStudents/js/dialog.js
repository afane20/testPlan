/*
 * DIALOG FUNCTIONS
 */

function insertTitle(title) {
	$("<h1></h1>")
		.html(title)
	.appendTo("#dialog");
}

function insertMessage(message) {
	$("<p></p>")
		.html(message)
	.appendTo("#dialog");
}

function insertButton(label, onclick) {
	$("<button></button>")
		.html(label)
		.attr("onclick", onclick)
	.appendTo("#dialog");
}

function insertClose() {
	$("<div></div>")
		.attr("id", "close")
		.attr("onclick", "hideDialog()")
	.appendTo("#dialog");
}

function hideDialog() {
	$("#dialog").removeClass("scale delete");
	$("#dialog").empty();
}

/*
 * DIALOGS
 */

function showBasicMessage(message) {
	$("#dialog").empty();
	insertMessage(message);
	insertClose();
	$("#dialog").addClass("scale");
}