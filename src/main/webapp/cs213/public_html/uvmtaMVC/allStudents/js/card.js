var instruments = [
	{
		"teacherId": "Piano",
		"first": "Piano",
		"last": ""
	},
	{
		"teacherId": "String",
		"first": "String",
		"last": ""
	},
	{
		"teacherId": "Vocal",
		"first": "Vocal",
		"last": ""
	}
];

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
		if (type == "input" || type == "option" || type == "select") {
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
		} else if (type == "select") {
			$(this).find('option:contains("'+value+'")').attr("selected", true);
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
 
function insertTitle(title) {
	$("#card header").html(title);
}

function insertField(id, label, value) {
	value = value === undefined ? "" : value;
	$("<section></section>").appendTo("#card #info");
	$("<label></label>")
		.html(label)
	.appendTo("#card #info section:last-child");
	$("<article></article>")
	.appendTo("#card #info section:last-child");
	$('<input type="text" />')
		.attr("id", id)
		.addClass("data")
		.value(value)
	.appendTo("#card #info section:last-child article");
}

function insertSelection(id, label, options, value) {
	value = value === undefined ? false : value;
	$("<section></section>").appendTo("#card #info");
	$("<label></label>")
		.html(label)
	.appendTo("#card #info section:last-child");
	$("<article></article>")
	.appendTo("#card #info section:last-child");
	$("<select></select>")
		.attr("id", id)
		.addClass("data")
	.appendTo("#card #info section:last-child article");
	$("<option></option>").val("").html("")
	.appendTo("#card #"+id);
	for (var i = 0; i < options.length; i++) {
		$("<option></option>")
			.val(options[i].teacherId)
			.html(options[i].first+" "+options[i].last)
		.appendTo("#card #"+id);
	}
	if (value) {
		$("#card #"+id).value(value);
	}
}

function insertToggle(id, label, value) {
	value = value === undefined ? "N" : value;
	$("<section></section>").appendTo("#card #info");
	$("<label></label>")
		.html(label)
	.appendTo("#card #info section:last-child");
	$("<article></article>")
	.appendTo("#card #info section:last-child");
	$('<div class="toggle"><div id="handle"></div></div>')
		.attr("id", id)
		.addClass("data")
		.value(value)
		.attr("onclick", "toggleValue(this)")
	.appendTo("#card #info section:last-child article");
}

/*
 * DIALOG FUNCTIONS
 */

function addCard() {
	$("#card #info").empty();
	insertTitle("Add New Student");
	insertField("first", "First");
	insertField("last", "Last");
	insertSelection("instrument", "Instrument", instruments, "Piano");
	insertField("gradYear", "Graduation");
	insertField("festivals", "Festivals", "0");
	insertField("points", "Points", "0");
	insertField("lastFestDate", "Last Fest.");
	insertSelection("teacherId", "Teacher", teachers, "Unknown");
	$("#card").show();
	$("#card #first").focus();
	$("footer ul li").addClass("hide");
	$("<li>Save</li>").addClass("temp").attr("onclick", "addStudent()").appendTo("footer ul");
	$("<li>Cancel</li>").addClass("temp").attr("onclick", "cancel()").appendTo("footer ul");
}

var studentsToEdit;

function editCard() {
	var count = $("section table tr.selected").length;
	if (count == 0) {
		showBasicMessage("Please select one or more students to edit and try again");
		return;
	} else if (count == 1) {
		var $fields = $("section table tr.selected").children("td");
		studentsToEdit = $("section table tr.selected").attr("id");
		var curStudent = [];
		for (var i = 0; i < $fields.length; i++) {
			curStudent[i] = $fields.eq(i).html();
		}
		$("#card #info").empty();
		insertTitle("Edit: "+curStudent[0]+" "+curStudent[1]);
		insertField("first", "First", curStudent[0]);
		insertField("last", "Last", curStudent[1]);
		insertSelection("instrument", "Instrument", instruments, curStudent[2]);
		insertField("gradYear", "Graduation", curStudent[3]);
		insertField("festivals", "Festivals", curStudent[4]);
		insertField("points", "Points", curStudent[5]);
		insertField("lastFestDate", "Last Fest.", curStudent[6]);
		insertSelection("teacherId", "Teacher", teachers, curStudent[7]);
		
	} else {
		var $students = $("section table tr.selected");
		studentsToEdit = "";
		for (var i = 0; i < $students.length; i++) {
			if (i != 0) { studentsToEdit += ","; }
			studentsToEdit += $students.eq(i).attr("id");
		}
		$("#card #info").empty();
		insertTitle("Edit: "+count+" Students");
		insertSelection("instrument", "Instrument", instruments);
		insertField("gradYear", "Graduation");
		insertField("festivals", "Festivals");
		insertField("points", "Points");
		insertField("lastFestDate", "Last Fest.");
		insertSelection("teacherId", "Teacher", teachers);
	}
	$("#card").show();
	$("footer ul li").addClass("hide");
	$("<li>Update</li>").addClass("temp").attr("onclick", "editStudents()").appendTo("footer ul");
	$("<li>Cancel</li>").addClass("temp").attr("onclick", "cancel()").appendTo("footer ul");
}

function deleteCard() {
	var count = $("section table tr.selected").length;
	var message = "Are you sure you want to delete ";
	if (count == 0) {
		showBasicMessage("Please select students to delete and try again");
		return;
	} else if (count == 1) {
		var first = $("section table tr.selected td").eq(0).html();
		var last = $("section table tr.selected td").eq(1).html();
		message += first+" "+last+" from the database?";
	} else {
		message += count+" students from the database?";
	}
	
	$("#dialog").empty();
	
	insertTitle("Delete Student");
	insertMessage(message);
	insertButton("Delete", "deleteStudents()");
	insertClose();
	
	$("#dialog").addClass("scale delete");
}

/*
 * DATABASE FUNCTIONS
 */
 
function cancel() {
	$("#card").hide();
	$("footer ul li.temp").remove();
	$("footer ul li.hide").removeClass("hide");
}

// Add student to the database
function addStudent() {	
	var first = $("#card #first").value();
	var last = $("#card #last").value();
	var instrument = $("#card #instrument").value();
	var gradYear = $("#card #gradYear").value();
	var festivals = $("#card #festivals").value();
	var points = $("#card #points").value();
	var lastFestDate = $("#card #lastFestDate").value();
	var teacherId = $("#card #teacherId").value();
	
	$.post("model/addStudent.php", { 'first': first, 'last': last, 'instrument': instrument, 'gradYear': gradYear, 'festivals': festivals, 'points': points, 'lastFestDate': lastFestDate, 'teacherId': teacherId }, function(message) {
		showBasicMessage(message);
		$("aside ul li.selected").trigger("click");
	});
	
	cancel();
	setTimeout(hideDialog, 3000);
}

// Edit one or more students
function editStudents() {
	var numEdits = 0;
	
	// Get all changed fields
	var $fields = $("#card .data");
	var count = $fields.length;
	var fields = "";
	var values = "";
	for (var i = 0; i < count; i++) {
		var field = $fields.eq(i).attr("id");
		var value = $fields.eq(i).value();
		
		if (value != "") {
			if (fields != "") {
				fields += ",";
				values += ",";
			}
			fields += field;
			values += value;
			numEdits++;
		}
	}
	
	if (numEdits != 0) {
		$.post("model/updateFields.php", { 'studentIds': studentsToEdit, 'fields': fields, 'values': values }, function(success) {
			if (success) {
				showBasicMessage("The selected students were updated");
			} else {
				showBasicMessage("Could not complete request to update students");
			}
			$("aside ul li.selected").trigger("click");
			setTimeout(hideDialog, 1200);
		});
	}
	cancel();
}

function deleteStudents() {
	var completedSuccessfully = true;
	$("section table tr.selected").each(function() {
		var studentId = $(this).attr("id");
		$.post("model/deleteStudent.php", { 'studentId': studentId }, function(success) {
			if (success == false) {
				completedSuccessfully = false;
			}
		});
	});
	if (completedSuccessfully) {
		showBasicMessage("The selected student/s were deleted");
	} else {
		showBasicMessage("Could not complete request to delete students");
	}
	$("aside ul li.selected").trigger("click");
	setTimeout(hideDialog, 1200);
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
	
	$("#card #close").click(cancel);
	
//	$("#card footer #delete").click(function() {
//		showPrompt("Are you sure you want to delete "+curTeacher.first+" "+curTeacher.last+" from the database", "Delete", "deleteTeacher()");
//	});
});