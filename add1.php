<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT CONCAT(a.fname,' ', a.lname)as aname, 
ae.expertise, CONCAT(s.fname,' ',s.lname) as sname
FROM advisor as a, student as s, student_advisor as sa, advisor_expertise as ae
WHERE sa.advisorid = a.advisorid AND
s.studentid = sa.studentid AND
a.advisorid = ae.advisorid";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Advisor Name</th>
    			<th>Expertise</th>
    			<th>Student Name</th>
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["aname"]."</td>
        	<td>".$row["expertise"]."</td>
        	<td>".$row["sname"]."</td>
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>