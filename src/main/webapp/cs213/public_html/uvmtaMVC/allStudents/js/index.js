var teacherId = -1;
var sort = 'last ASC';

/*
 * Count the number of rows that are selected
 */
function countSelectedRows() {
	var count = 0;
	var $rows = $("section table tbody tr");
	for (var i = 0; i < $rows.length; i++) {
		if ($rows.eq(i).hasClass("selected")) {
			count++;
		}
	}
	return count;
}

/*
 * Load students by teacher and specified sorting order
 */
function loadStudents() {
	$.getJSON("model/getStudents.php", { 'teacherId': teacherId, 'sort': sort }, function(json) {
		var students = "";
		for (var i = 0; i < json.length; i++) {
			students += '<tr id="'+json[i].studentId+'" onclick="selectStudent(this)">'+
						'<td>'+json[i].first+'</td>'+
						'<td>'+json[i].last+'</td>'+
						'<td>'+json[i].instrument+'</td>'+
						'<td>'+json[i].gradYear+'</td>' +
						'<td class="small">'+json[i].festivals+'</td>'+
						'<td class="small">'+json[i].points+'</td>' +
						'<td>'+json[i].lastFestDate+'</td>' +
						'<td>'+$("#"+json[i].teacherId+" span").html()+'</td>'+
						'</tr>';
		}
		
		$("section table tbody").html(students);
	});
}

/*
 * Search students
 */
//function search() {
//	var searchPhrase = $("#search").val();
//	$.getJSON("model/search.php", { 'search': searchPhrase }, function(json) {
//		var students = "";
//		for (var i = 0; i < json.length; i++) {
//			students += '<tr onclick="selectStudent(this)">'+
//						'<td>'+json[i].first+'</td>'+
//						'<td>'+json[i].last+'</td>'+
//						'<td>'+json[i].instrument+'</td>'+
//						'<td>'+json[i].festivals+'</td>'+
//						'<td>'+json[i].points+'</td>'+
//						'</tr>';
//		}
//		
//		$("section table tbody").html(students);
//	});
//	
//	return false;
//}

/*
 * Select student row
 */
function selectStudent(student) {
	if ($(student).hasClass("selected")) {
		$(student).removeClass("selected");
	} else {
		if ($(student).attr("id") != "newStudent") {
			$(student).addClass("selected");
		}
	}
}

// Select all
function selectAll() {
	$("section table tbody tr").addClass("selected");
}

// Deselect all
function deselectAll() {
	$("section table tbody tr").removeClass("selected");
}

// Fixes the height of the table to fit the page
function adjustHeight() {
	var height = $(window).height();
	height -= $("#header").height();
	height -= ($("section table thead").height() + 1);
	height -= $("footer").height();
	
	$("aside ul").height(height);
	$("section table tbody").height(height);
}

$(window).resize(function() {
	adjustHeight();
});

/*
 * Onload function
 */
$(document).ready(function() {
	adjustHeight();
	loadStudents();
	
	// Teacher sorting onclick event
	$("aside ul li").click(function() {
		teacherId = $(this).attr("id");
		$("aside ul li").removeClass("selected");
		$(this).addClass("selected");
		deselectAll();
		loadStudents();
	});
	
	// Student sorting button onclick event
	$("section table thead th").click(function() {
		sort = $(this).children("span").html();
		sort = sort == "teacher" ? "teacherId" : sort;
		sort = sort == "graduation" ? "gradYear" : sort;
		sort = sort == "last fest." ? "lastFestDate" : sort;
		if ($(this).hasClass("selected")) {
			if ($(this).hasClass("ascending")) {
				$(this).removeClass("ascending").addClass("descending");
				sort += " DESC";
			} else {
				$(this).removeClass("descending").addClass("ascending");
				sort += " ASC";
			}
		} else {
			$("section table thead th").removeClass("selected ascending descending");
			$(this).addClass("selected ascending");
			sort += " ASC";
		}
		loadStudents();
	});
	
	// Select and deselect buttons
	$("#add").click(addCard);
	$("#delete").click(deleteCard);
	$("#edit").click(editCard);
	$("#selectAll").click(selectAll);
	$("#deselectAll").click(deselectAll);
});

function selectAllStudents() {
	var menuItem = document.getElementById('miAllStudents');
   menuItem.className = menuItem.className + "menuSelected";
}