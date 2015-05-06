/*
 * UTILITIES
 */
 
$.fn.tagName = function() {
  return this.prop("tagName").toLowerCase();
};

/*
 * DIALOG FUNCTIONS
 */
 
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
	$("#dialog").removeClass("scale");
	$("#dialog").empty();
}

function showMessage(message) {
	$("#dialog").empty();
	insertMessage(message);
	insertClose();
	$("#dialog").addClass("scale");
}

function showPrompt(message, button, action) {
	$("#dialog").empty();
	insertMessage(message);
	insertButton(button, action);
	insertClose();
	$("#dialog").addClass("scale");
}
