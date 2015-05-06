<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/uvmta.css"/>
	<link rel="stylesheet" href="css/table.css" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		<?php
			echo "var teachers = ".json_encode($teachers);
		?>
	</script>
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
	<svg class="arrow hide" viewBox="0 0 75 150">
		<polygon id="arrow" points="0,0 75,75 0,150 0,140 65,75 0,10" />
	</svg>
	<main>
		<aside>
			<header>Teachers</header>
			<ul>
				<li id="-1" class="selected">All Teachers
					<svg viewBox="0 0 75 150" class="arrows">
						<use xlink:href="#arrow" />
					</svg>
				</li>
				<?php
					foreach ($teachers as $teacher) {
						echo '<li id="'.$teacher['teacherId'].'"><span>'.$teacher['first'].' '.$teacher['last'].
								 '</span><svg viewBox="0 0 75 150" class="arrows">'.
								 '<use xlink:href="#arrow" />'.
								 '</svg>'.
								 '</li>';
					}
				?>
			</ul>
		</aside>
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
						<th>
							<span>instrument</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>graduation</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="small">
							<span>festivals</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th class="small">
							<span>points</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>last fest.</span>
							<svg viewBox="0 0 110 154" class="sortButtons">
								<use id="ascending" xlink:href="#ascending" />
								<use id="descending" xlink:href="#descending" />
							</svg>
						</th>
						<th>
							<span>teacher</span>
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
			<li id="add">Add</li>
			<li id="delete">Delete</li>
			<li id="edit">Edit</li>
			<li id="selectAll">Select All</li>
			<li id="deselectAll">Deselect All</li>
		</ul>
	</footer>
	<div id="card">
		<div id="close"></div>
		<header></header>
		<div id="info"></div>
	</div>
	<div id="dialog"></div>
</body>
</html>