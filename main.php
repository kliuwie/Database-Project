<!DOCTYPE html>
<html>
<body>
	<h1>i308 Group 2 Final Project</h2><br>
	<h2>Required Query</h2>
	<h3>2b. Produce list of rooms that are equipped with some feature</h3>
		<form action="2b.php" method="post">
Room feature: <select name='rf'>
 
<?php
	$con  = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02","i308u17_team02");
	if(!$con) {
	die("Connection failed.".mysqli_connect_error());}
	$result = mysqli_query($con,"SELECT DISTINCT feature from room_feature");
	while ($row = mysqli_fetch_assoc($result)){
		unset ( $name);
		$name = $row['feature'];
		echo '<option value="'.$name.'">'.$name.'</option>';
		
	}
	?>
 
	</select>
<br><br>
		Time: <input type="time" name="time"><br>




		<input type="submit" name="submit" value="Show 2b">
		</form>
	<hr>
	<h3>3b. Produce a list of faculty who havenever taught a *specified course*</h3>
		<form action="3b.php" method="post">
Course Number: <select name='cn'>
 
<?php
	$con  = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02","i308u17_team02");
	if(!$con) {
	die("Connection failed.".mysqli_connect_error());}
	$result = mysqli_query($con,"SELECT DISTINCT coursenum from course");
	while ($row = mysqli_fetch_assoc($result)){
		unset ( $name);
		$name = $row['coursenum'];
		echo '<option value="'.$name.'">'.$name.'</option>';
		
	}
	?>
 
	</select>



		<input type="submit" name="submit" value="Show 3b">
		</form>
	<hr>
	<h3>4c. Produce a list of students who took a course that had a prerequisite 
		but the student had not taken the prerequisite. Include the semester, the course 
		subject and number, and the grade the student received.</h3>
		<form action="4c.php" method="post">
		<input type="submit" name="submit" value="Show 4c">
		</form>
	<hr>
	<h3>6b. Produce a list of students and faculty who were in a *particular building* 
		at a *particular time*. </h3>
		<form action="6b.php" method="post">

		Building name: <select name='bname'>
 
<?php
	$con  = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02","i308u17_team02");
	if(!$con) {
	die("Connection failed.".mysqli_connect_error());}
	$result = mysqli_query($con,"SELECT name from building");
	while ($row = mysqli_fetch_assoc($result)){
		unset ( $name);
		$name = $row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
		
	}
	?>
 
	</select>
<br><br>
		Time: <input type="time" name="time"><br>
		<input type="submit" name="submit" value="Show 6b">
		</form>
	<hr>
	<h3>9a. Produce a list of majors offered, along with the department that offers 
		them and their requirements to graduate (hours earned and overall GPA)</h3>
		<form action="9a.php" method="post">
		<input type="submit" name="submit" value="Show 9a">
		</form>
	<h2>Additional Query</h2>
	<h3>Display student and advisors along with advisor specialty</h3>
		<form action="add1.php" method="post">
		<input type="submit" name="submit" value="Show ">
		</form>
	<h3>Display parent contact information for student who is graduating</h3>
		<form action="add2.php" method="post">
		<input type="submit" name="submit" value="Show">
		</form>
 
</body>
</html>
 
