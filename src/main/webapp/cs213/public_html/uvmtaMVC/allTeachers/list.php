<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/uvmta.css"/>
	<link rel="stylesheet" href="css/table.css" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/draggable.js" type="text/javascript"></script>
	<script src="js/dialog.js" type="text/javascript"></script>
	<script src="js/card.js" type="text/javascript"></script>
	<script src="js/index.js" type="text/javascript"></script>
</head>
<body onload="selectAllStudents();">
	<svg class="sortButtons hide" viewBox="0 0 110 154">
		<polygon id="ascending" points="110,58 55,0 0,58" />
		<polygon id="descending" points="0,96 55,154 110,96" />
	</svg>
	<main>
		<section>
			<table>
				<thead>
					<tr>
						<th>
							<span>first</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="selected ascending">
							<span>last</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="small">
							<span>id</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>phone</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="small">
							<span>current</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>mem. fees</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>reg. fees</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="small">
							<span>early</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</section>
	</main>
	<footer>
		<form onsubmit="search()" method="post" action="">
			<input id="search" type="search" placeholder="Search" />
		</form>
		<ul>
			<li id="addTeacher" onclick="addCard()">Add Teacher</li>
			<li>Reset Membership Fees</li>
		</ul>
	</footer>
	<div id="card">
		<div id="close"></div>
		<header></header>
		<nav>
			<button class="selected">uvmta</button>
			<button>contact</button>
		</nav>
		<div id="info">
			<div id="uvmta"></div>
			<div id="contact" class="hide"></div>
		</div>
		<footer>
			<button id="delete" class="display">Delete</button>
			<button id="edit" class="display">Edit</button>
			<button id="cancel" class="edit">Cancel</button>
			<button id="save" class="edit">Save</button>
			<button id="cancelAdd" class="add">Cancel</button>
			<button id="add" class="add">Add</button>
		</footer>
	</div>
	<div id="dialog"></div>
	<button id="reload" class="hide"></button>
</body>
</html>