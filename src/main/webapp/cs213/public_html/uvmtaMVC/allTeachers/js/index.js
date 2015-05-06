var sort = 'last ASC';

/*
 * Load teachers by specified sorting order
 */
function loadTeachers() {
	$.getJSON("model/getTeachers.php", { 'sort': sort }, function(json) {
		var teachers = "";
		for (var i = 0; i < json.length; i++) {
			if (json[i].last == "Unknown") { continue; }
			teachers += '<tr id="'+json[i].teacherId+'" onclick="selectTeacher(this)">'+
						'<td>'+json[i].first+'</td>'+
						'<td>'+json[i].last+'</td>'+
						'<td class="small">'+json[i].uvmtaId+'</td>'+
						'<td>'+json[i].phone+'</td>' +
						'<td class="small">'+json[i].membershipCurrent+'</td>'+
						'<td>'+json[i].membershipFees+'</td>' +
						'<td>'+json[i].regFees+'</td>' +
						'<td class="small">'+json[i].earlyReg+'</td>'+
						'</tr>';
		}
		
		$("section table tbody").html(teachers);
	});
}

/*
 * Select student row
 */
function selectTeacher(teacher) {
	var teacherId = $(teacher).attr("id");
	loadCard(teacherId);
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
	loadTeachers();
	
	// Student sorting button onclick event
	$("section table thead th").click(function() {
		sort = $(this).children("span").html();
		sort = sort == "id" ? "uvmtaId" : sort;
		sort = sort == "current" ? "membershipCurrent" : sort;
		sort = sort == "mem. fees" ? "membershipFees" : sort;
		sort = sort == "reg. fees" ? "regFees" : sort;
		sort = sort == "early" ? "earlyReg" : sort;
		
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
		loadTeachers();
	});
	
	$("#reload").click(function() {
		loadTeachers();
	});
});

function selectAllStudents() {
	var menuItem = document.getElementById('miTeachers');
   menuItem.className = menuItem.className + "menuSelected";
}