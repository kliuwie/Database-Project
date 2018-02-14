<?php

// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u17_team02","my+sql=i308u17_team02", "i308u17_team02");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$bname =  mysqli_real_escape_string($conn,$_POST['bname']);
$time =  mysqli_real_escape_string($conn,$_POST['time']);


$sql = "SELECT DISTINCT CONCAT(s.fname,' ',s.lname) as name
FROM student as s, schedule as sc, room as r, building as b, section as st,gradebook as gb
WHERE s.studentid =gb.studentid AND
gb.sectionid = sc.sectionid AND
sc.roomid = r.roomid AND
r.buildingid = b.buildingid AND
b.name = '$bname' AND
st.start_time <= '$time' AND
st.end_time >= '$time'
UNION
SELECT DISTINCT CONCAT(f.fname,' ',f.lname)
FROM faculty as f, schedule as sc, room as r, building as b, section as st
WHERE f.facultyid =sc.facultyid AND
sc.roomid = r.roomid AND
r.buildingid = b.buildingid AND
b.name = '$bname' AND
st.start_time <= '$time' AND
st.end_time >= '$time'
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