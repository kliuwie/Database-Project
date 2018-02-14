<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cn =  mysqli_real_escape_string($conn,$_POST['cn']);



$sql = "SELECT f.facultyid, CONCAT(f.fname,' ',f.lname) as name
FROM faculty as f
WHERE f.facultyid NOT IN (
SELECT f.facultyid
FROM faculty as f, schedule as s, section as st, course as c
WHERE f.facultyid = s.facultyID AND
s.sectionid = st.sectionid AND
st.coursenum = c.coursenum AND 
c.coursenum = '$cn')

";


$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Name</th>
    			
    		</tr>";
    		
    // output data of each row
    while($row = $result->fetch_assoc()) {

	echo "<tr>
        	<td>".$row["name"]."</td>
    
        	</tr>";
       
    }

    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>