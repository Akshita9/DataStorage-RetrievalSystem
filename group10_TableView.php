<!DOCTYPE html>
<html>
    <head>
    <title>Group 10 - Table View</title>
    <link href="group10_style_v3.css" type="text/css" rel="stylesheet" />
    </head>

<body>
    
    <h1>People of Data Science</h1>
    <header>
        <div class="nav">
            <ul>
                <li><a href="http://iia02.ci.unt.edu/5717/group10/group10_index.php">Home</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Search.html">Search Database</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_TableView.html">Table View</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_AboutUs.html">About Us</a></li>
			</ul>
        </div>
    </header>
		<h2> Table View Results </h2>
		<?php
		// create short variable names
		$table_name=$_POST['table_name'];
		if (!$table_name) {
		echo 'An error occurred. Please go back and try again.';
		exit;
		}
		@ $db = new mysqli('localhost', '5717G10', 'group10', '5717G10');
		if (mysqli_connect_errno()) {
			echo 'Error: Could not connect to database. Please try again later.';
		exit;
		}
		if ($table_name == "SCHOLAR"){
			$query = "SELECT * FROM ".$table_name;
			$result = $db->query($query);
			$num_results = $result->num_rows;
		echo "<h3>Number of records found in the ".$table_name." table: ".$num_results."</h3>";
		
		echo "<table border=1><tr><th>ScholarID</th><th>First Name</th><th>Last Name</th><th>Current Employer</th><th>Current Title</th><th>Website</th><th>Number of Citations</th><th>Created Date</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["ScholarID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["CurrentEmployer"]."</td><td>".$row["CurrentTitle"]."</td><td>".$row["PersonalURL"]."</td><td>".$row["TotalNoOfCitations"]."</td><td>".$row["CreatedDate"]."</td></tr>";
			}
			echo "</table>";
			
		} elseif ($table_name == "EDUCATION_HISTORY"){
		$query = "SELECT * FROM ".$table_name." JOIN SCHOLAR WHERE SCHOLAR.ScholarID = ".$table_name.".ScholarID";
		$result = $db->query($query);
		$num_results = $result->num_rows;
		echo "<h3>Number of records found in the ".$table_name." table: ".$num_results."</h3>";
		
		echo "<table border=1><tr><th>EducationID</th><th>First Name</th><th>Last Name</th><th>Institution</th><th>Degree Level</th><th>Program</th><th>Year Awarded</th><th>Created Date</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["EducationID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["EducationInstitution"]."</td><td>".$row["DegreeLevel"]."</td><td>".$row["Program"]."</td><td>".$row["YearAwarded"]."</td><td>".$row["CreatedDate"]."</td></tr>";
			}
			echo "</table>";
			
		} elseif ($table_name == "EMPLOYMENT_HISTORY"){
		$query = "SELECT * FROM ".$table_name." JOIN SCHOLAR WHERE SCHOLAR.ScholarID = ".$table_name.".ScholarID";
		$result = $db->query($query);
		$num_results = $result->num_rows;
		echo "<h3>Number of records found in the ".$table_name." table: ".$num_results."</h3>";
		
		echo "<table border=1><tr><th>WorkID</th><th>First Name</th><th>Last Name</th><th>Institution</th><th>Title</th><th>Website</th><th>Location</th><th>Year From</th><th>Year To</th><th>CreatedDate</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["WorkID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["WorkInstitution"]."</td><td>".$row["WorkTitle"]."</td><td>".$row["WorkURL"]."</td><td>".$row["WorkCountry"]."</td><td>".$row["WorkYearFrom"]."</td><td>".$row["WorkYearTo"]."</td><td>".$row["CreatedDate"]."</td></tr>";
			}
			echo "</table>";
		
		} elseif ($table_name == "SCHOLAR_INTERESTS"){
		$query = "SELECT SCHOLAR.FirstName, SCHOLAR.LastName, SCHOLAR_INTERESTS.ScholarID, SCHOLAR_INTERESTS.CreatedDate, ResearchInterests FROM ".$table_name." JOIN RESEARCH_INTERESTS, SCHOLAR WHERE RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID AND SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID";
		$result = $db->query($query);
		$num_results = $result->num_rows;
		echo "<h3>Number of records found in the ".$table_name." table: ".$num_results."</h3>";
		
		echo "<table border=1><tr><th>First Name</th><th>Last Name</th><th>Research Interests</th><th>CreatedDate</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["ResearchInterests"]."</td><td>".$row["CreatedDate"]."</td></tr>";
			}
			echo "</table>";
			
		} else {
		$query = "SELECT * FROM ".$table_name." JOIN SCHOLAR WHERE SCHOLAR.ScholarID = ".$table_name.".ScholarID";
		$result = $db->query($query);
		$num_results = $result->num_rows;
		echo "<h3>Number of records found in the ".$table_name." table: ".$num_results."</h3>";
		
		echo "<table border=1><tr><th>PublicationID</th><th>First Name</th><th>Last Name</th><th>Title</th><th>Publisher</th><th>Year</th><th>Edition</th><th>Volume</th><th>Issue</th><th>Publication Type</th><th>URL</th><th>Cited By</th><th>Created Date</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["PublicationID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["Title"]."</td><td>".$row["Publisher"]."</td><td>".$row["Year"]."</td><td>".$row["Edition"]."</td><td>".$row["Volume"]."</td><td>".$row["Issue"]."</td><td>".$row["PublicationType"]."</td><td>".$row["PublicationURL"]."</td><td>".$row["CitedBy"]."</td><td>".$row["CreatedDate"]."</td></tr>";
			}
			echo "</table>";
			
		}	
		$db->close();
		?>
		<h3 style="text-align: center"><a href="http://iia02.ci.unt.edu/5717/group10/group10_TableView.html">Return to Table View Options</a></h3>
	</body>
</html>