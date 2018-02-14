<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT CONCAT(s.fname,' ',s.lname) as name, sc.semestercode, c.coursenum, c.course_subject,gb.grade
FROM student as s, course as c, section as st, gradebook as gb, course_prereq as cp, semester as sc
WHERE s.studentid = gb.studentid AND
gb.sectionid = st.sectionid AND
st.coursenum = c.coursenum AND
st.semestercode = sc.semestercode AND
c.coursenum = cp.coursenum AND
c.coursenum != cp.prereqnum
";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Name</th>
    			<th>Semester code</th>
    			<th>Course Number</th>
    			<th>Course Subject</th>
    			<th>Grade</th>
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["name"]."</td>
        	<td>".$row["semestercode"]."</td>
        	<td>".$row["coursenum"]."</td>
        	<td>".$row["course_subject"]."</td>
        	<td>".$row["grade"]."</td>
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>