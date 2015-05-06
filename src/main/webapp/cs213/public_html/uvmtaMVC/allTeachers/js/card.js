/*
 * TOOLS
 */
 
$.fn.tagName = function() {
  return this.prop("tagName").toLowerCase();
};

$.fn.isSelected = function() {
	return $(this).hasClass("selected");
};

$.fn.select = function() {
	$(this).addClass("selected");
};

$.fn.deselect = function() {
	$(this).removeClass("selected");
};

// Toggle functions

function toggleValue(toggle) {
	if ($(toggle).value() == "Y") {
		$(toggle).value("N");
	} else {
		$(toggle).value("Y");
	}
}

$.fn.value = function(value) {
	var type = $(this).tagName();
	if (value === undefined) {
		if (type == "input" || type == "option") {
			return $(this).val();
		} else {
			if ($(this).hasClass("yes")) {
				return "Y";
			} else {
				return "N";
			}
		}
	} else {
		if (type == "input" || type == "option") {
			$(this).val(value);
		} else {
			if (value == "Y" || value == "Yes" || value == true) {
				$(this).addClass("yes");
			} else if (value == "N" || value == "No" || value == false) {
				$(this).removeClass("yes");
			}
		}
	}
	
	return $(this);
};

// Visibility functions

$.fn.show = function() {
	$(this).removeClass("hide");
};

$.fn.hide = function() {
	$(this).addClass("hide");
};

/*
 * INSERTION FUNCTIONS
 */

function insertData(type, label, data) {
	data = data == 'Y' ? "Yes" : data;
	data = data == 'N' ? "No" : data;
	$("<section></section>").appendTo("#card #"+type);
	$("<label></label>")
		.html(label)
	.appendTo("#card #"+type+" section:last-child");
	$("<article></article>")
		.html(data)
	.appendTo("#card #"+type+" section:last-child");
}

function insertField(type, id, label, value) {
	value = value === undefined ? "" : value;
	$("<section></section>").appendTo("#card #"+type);
	$("<label></label>")
		.html(label)
	.appendTo("#card #"+type+" section:last-child");
	$("<article></article>")
	.appendTo("#card #"+type+" section:last-child");
	$('<input type="text" />')
		.attr("id", id)
		.addClass("data")
		.value(value)
	.appendTo("#card #"+type+" section:last-child article");
}

function insertToggle(type, id, label, value) {
	value = value === undefined ? "N" : value;
	$("<section></section>").appendTo("#card #"+type);
	$("<label></label>")
		.html(label)
	.appendTo("#card #"+type+" section:last-child");
	$("<article></article>")
	.appendTo("#card #"+type+" section:last-child");
	$('<div class="toggle"><div id="handle"></div></div>')
		.attr("id", id)
		.addClass("data")
		.value(value)
		.attr("onclick", "toggleValue(this)")
	.appendTo("#card #"+type+" section:last-child article");
}

/*
 * DIALOG FUNCTIONS
 */
 
var curTeacher;
 
function loadCard(teacherId) {
	$.getJSON("model/getTeacher.php", { 'teacherId': teacherId }, function(json) {
		var teacher = json[0];
		curTeacher = teacher;
		$("#card #contact").empty();
		$("#card #uvmta").empty();
		$("#card header").html(teacher.first+" "+teacher.last);
		insertData("contact", "Address", teacher.street+"<br />"+teacher.city+", "+teacher.state+" "+teacher.zip);
		insertData("contact", "Phone", teacher.phone);
		insertData("contact", "Email", teacher.email);
		insertData("uvmta", "Username", teacher.username);
		insertData("uvmta", "ID", teacher.uvmtaId);
		insertData("uvmta", "Admin", teacher.admin);
		insertData("uvmta", "Early Reg.", teacher.earlyReg);
		insertData("uvmta", "Current", teacher.membershipCurrent);
		insertData("uvmta", "Mem. Fees", "$"+teacher.membershipFees);
		insertData("uvmta", "Reg. Fees", "$"+teacher.regFees);
		$("footer .edit").hide();
		$("footer .add").hide();
		$("footer .display").show();
		$("#card").show();
	});
}

function addCard() {
	$("#card #contact").empty();
	$("#card #uvmta").empty();
	$("#card header").html("Add New Teacher");
	insertField("uvmta", "first", "First");
	insertField("uvmta", "last", "Last");
	insertField("uvmta", "username", "Username");
	insertField("uvmta", "pwd", "Password");
	insertField("uvmta", "uvmtaId", "ID");
	insertToggle("uvmta", "admin", "Admin");
	insertToggle("uvmta", "earlyReg", "Early Reg.");
	insertToggle("uvmta", "membershipCurrent", "Current");
	insertField("uvmta", "membershipFees", "Mem. Fees", "25.00");
	insertField("uvmta", "regFees", "Reg. Fees", "0.00");
	insertField("contact", "street", "Street");
	insertField("contact", "city", "City");
	insertField("contact", "state", "State");
	insertField("contact", "zip", "Zip");
	insertField("contact", "phone", "Phone");
	insertField("contact", "email", "Email");
	$("footer .display").hide();
	$("footer .edit").hide();
	$("footer .add").show();
	$("#card").show();
}

function editCard() {
	$("#card #contact").empty();
	$("#card #uvmta").empty();
	var teacher = curTeacher;
	$("#card header").html("Edit: "+teacher.first+" "+teacher.last);
	insertField("contact", "street", "Street", teacher.street);
	insertField("contact", "city", "City", teacher.city);
	insertField("contact", "state", "State", teacher.state);
	insertField("contact", "zip", "Zip", teacher.zip);
	insertField("contact", "phone", "Phone", teacher.phone);
	insertField("contact", "email", "Email", teacher.email);
	
	insertField("uvmta", "first", "First", teacher.first);
	insertField("uvmta", "last", "Last", teacher.last);
	insertField("uvmta", "username", "Username", teacher.username);
	insertField("uvmta", "pwd", "Password");
	insertField("uvmta", "uvmtaId", "ID", teacher.uvmtaId);
	insertToggle("uvmta", "admin", "Admin", teacher.admin);
	insertToggle("uvmta", "earlyReg", "Early Reg.", teacher.earlyReg);
	insertToggle("uvmta", "membershipCurrent", "Current", teacher.membershipCurrent);
	insertField("uvmta", "membershipFees", "Mem. Fees", teacher.membershipFees);
	insertField("uvmta", "regFees", "Reg. Fees", teacher.regFees);
	$("footer .display").hide();
	$("footer .add").hide();
	$("footer .edit").show();
}

/*
 * DATABASE FUNCTIONS
 */

// Add teacher to the database
function addTeacher() {
	var complete = true;
	var $required = $("#card #uvmta .data");
	for (var i = 0; i < $required.length; i++) {
		if ($required.eq(i).value() == "") {
			complete = false;
		}
	}
	if (!complete) { showMessage("Please fill out all fields in the UVMTA section then try again"); return; }
	
	var first = $("#card #first").value();
	var last = $("#card #last").value();
	var username = $("#card #username").value();
	var pwd = $("#card #pwd").value();
	var uvmtaId = $("#card #uvmtaId").value();
	var admin = $("#card #admin").value();
	var earlyReg = $("#card #earlyReg").value();
	var memCurr = $("#card #membershipCurrent").value();
	var memFees = $("#card #membershipFees").value();
	var regFees = $("#card #regFees").value();
	var street = $("#card #street").value();
	var city = $("#card #city").value();
	var state = $("#card #state").value();
	var zip = $("#card #zip").value();
	var phone = $("#card #phone").value();
	var email = $("#card #email").value();
	
	$.post("model/addTeacher.php", { 'first': first, 'last': last, 'street': street, 'city': city, 'state': state, 'zip': zip, 'phone': phone, 'email': email, 'username': username, 'pwd': pwd, 'uvmtaId': uvmtaId, 'admin': admin, 'earlyReg': earlyReg, 'memCurr': memCurr, 'memFees': memFees, 'regFees': regFees }, function(success) {
		if (success) {
			$("#reload").trigger("click");
			$("#card").hide();
			showMessage(first+" "+last+" was added to the database");
		} else {
			showMessage("Could not add new teacher to the database");
		}
		setTimeout(hideDialog, 3000);
	});
}

function deleteTeacher() {
	$.post("model/deleteTeacher.php", { 'teacherId': curTeacher.teacherId }, function(message) {
		$("#reload").trigger("click");
		$("#card").hide();
		showMessage(message);
		setTimeout(hideDialog, 3000);
	});
}

// Save only fields that were changed
function saveChanges() {
	var numEdits = 0;
	
	// Get all changed fields
	var $fields = $("#card .data");
	var count = $fields.length;
	var fields = "";
	var values = "";
	for (var i = 0; i < count; i++) {
		var field = $fields.eq(i).attr("id");
		var value = $fields.eq(i).value();
		
		if (value != curTeacher[field] && value != "") {
			if (fields != "") {
				fields += ",";
				values += ",";
			}
			fields += field;
			values += value;
			numEdits++;
		}
	}
	
	// Make changes to database
	if (numEdits != 0) {
		$.post("model/updateFields.php", { 'teacherId': curTeacher.teacherId, 'fields': fields, 'values': values }, function(success) {
			if (success) {
				$("#reload").trigger("click");
				loadCard(curTeacher.teacherId);
			} else {
				showMessage("Could not complete request to update teacher");
			}
			setTimeout(hideDialog, 1200);
		});
	}
}

/*
 * ONLOAD FUNCTION
 */

$(document).ready(function() {
	$("#card").draggable({
		'handle': "header",
		'cursorAt': {
			'left': 0,
			'top': 0
		}
	}).hide();

	$("#card nav button").click(function() {
		if (!$(this).isSelected()) {
			$(this).select();
			$(this).siblings().deselect();
			
			var contentId = "#"+$(this).html();
			$(contentId).siblings().hide();
			$(contentId).show();
		}
	});
	
	$("#card #close").click(function() {
		$("#card").hide();
	});
	
	$("#card footer #edit").click(function() {
		editCard();
	});
	
	$("#card footer #add").click(function() {
		addTeacher();
	});
	
	$("#card footer #delete").click(function() {
		showPrompt("Are you sure you want to delete "+curTeacher.first+" "+curTeacher.last+" from the database", "Delete", "deleteTeacher()");
	});
	
	$("#card footer #save").click(function() {
		saveChanges();
	});
	
	$("#card footer #cancel").click(function() {
		loadCard(curTeacher.teacherId);
	});
	
	$("#card footer #cancelAdd").click(function() {
		$("#card").hide();
	});
});