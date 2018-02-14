<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT CONCAT(sp.fname,' ',sp.lname)as parent, sp.phone
FROM student as s, student_parent as sp
WHERE s.studentid = sp.studentid AND
s.studentid IN (
SELECT s.studentid
FROM student as s, gradebook as gb, section as st, course as c,major as m, student_major as sm
WHERE 
s.studentid = gb.studentid AND
gb.sectionid = st.sectionid AND
c.coursenum = st.coursenum AND
m.majorid = sm.majorid AND
sm.studentid = s.studentid
GROUP BY s.studentid
HAVING SUM(c.credit_hour) >= 15)
";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Parent Name</th>
    			<th>Phone</th>
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["parent"]."</td>
        	<td>".$row["phone"]."</td>
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>