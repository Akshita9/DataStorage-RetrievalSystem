<html>
	<head>
    <title>Group 10 - Search Results</title>
    <link href="group10_style.css" type="text/css" rel="stylesheet" />
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
	
	<p style="font-size:20px; text-align: center"> Group 10's Database Search Results. </p>
		
		<?php
		// Define variable names
		$Criteria1=$_POST['Criteria1'];
		$Criteria2=$_POST['Criteria2'];
		$Join1=$_POST['Join1'];
		$searchterm1=trim($_POST['searchterm1']);
		$searchterm2=trim($_POST['searchterm2']);
		$Result1=$_POST['Result1'];
		$Result2=$_POST['Result2'];
		$Result3=$_POST['Result3'];
		$Result4=$_POST['Result4'];
		$Result5=$_POST['Result5'];
		$Result6=$_POST['Result6'];
		
		if (!$Criteria1 || !$searchterm1) {
		echo 'You have not entered search details. Please go back and try again.';
		exit;
		}
		if (!get_magic_quotes_gpc()){
			$Criteria1 = addslashes($Criteria1);
			$Criteria2 = addslashes($Criteria2);
			$Join1 = addslashes($Join1);
			$searchterm1 = addslashes($searchterm1);
			$searchterm2 = addslashes($searchterm2);
			$Result1 = addslashes($Result1);
			$Result2 = addslashes($Result2);
			$Result3 = addslashes($Result3);
			$Result4 = addslashes($Result4);
			$Result5 = addslashes($Result5);
			$Result6 = addslashes($Result6);
		}
		
		@ $db = new mysqli('localhost', '5717G10', 'group10', '5717G10');
		if (mysqli_connect_errno()) {
			echo 'Error: Could not connect to database. Please try again later.';
		exit;
		}
		if($Join1 == "NULL"){
			if($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL" && $Result6 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5.", ".$Result6."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."'</strong></p>";
				echo "<table border=1><tr><th>".$Result1."</th><th>".$Result2."</th><th>".$Result3."</th><th>".$Result4."</th><th>".$Result5."</th><th>".$Result1."</th></tr>";
				while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row[$Result1]."</td><td>".$row[$Result2]."</td><td>".$row[$Result3]."</td><td>".$row[$Result4]."</td><td>".$row[$Result5]."</td><td>".$row[$Result6]."</td></tr>";
				}
				echo "</table>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</strong><br />".$Result6.":";
					echo stripslashes($row[$Result6]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL" && $Result6 =="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."'</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 =="NULL" && $Result6 =="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."'</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 =="NULL" && $Result5 =="NULL" && $Result6 =="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."'</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 =="NULL" && $Result4 =="NULL" && $Result5 =="NULL" && $Result6 =="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."'</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</p>";
				}	
			}
		} elseif($Join1 == "AND"){
			if($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL" && $Result6 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5.", ".$Result6."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' AND ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' and '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</strong><br />".$Result6.":";
					echo stripslashes($row[$Result6]);
					echo "</p>";
				}	
			} elseif($Result2!="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' AND ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' and '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' AND ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' and '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' AND ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' and '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' AND ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' and '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</p>";
				}	
			}	
		} elseif($Join1 == "OR"){
			if($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL" && $Result6 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5.", ".$Result6."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' OR ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' or '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</strong><br />".$Result6.":";
					echo stripslashes($row[$Result6]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL" && $Result5 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4.", ".$Result5."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' OR ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' or '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</strong><br />".$Result5.":";
					echo stripslashes($row[$Result5]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL" && $Result4 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3.", ".$Result4."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' OR ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' or '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</strong><br />".$Result4.":";
					echo stripslashes($row[$Result4]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL" && $Result3 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2.", ".$Result3."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' OR ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' or '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</strong><br />".$Result3.":";
					echo stripslashes($row[$Result3]);
					echo "</p>";
				}	
			} elseif($Result2 !="NULL"){
				$query =   "SELECT DISTINCT ".$Result1.", ".$Result2."
							FROM SCHOLAR
								JOIN EDUCATION_HISTORY ON SCHOLAR.ScholarID = EDUCATION_HISTORY.ScholarID
								JOIN PUBLICATION_HISTORY ON SCHOLAR.ScholarID = PUBLICATION_HISTORY.ScholarID
								JOIN EMPLOYMENT_HISTORY ON SCHOLAR.ScholarID = EMPLOYMENT_HISTORY.ScholarID
								JOIN SCHOLAR_INTERESTS ON SCHOLAR.ScholarID = SCHOLAR_INTERESTS.ScholarID
								JOIN RESEARCH_INTERESTS ON RESEARCH_INTERESTS.ResearchInterestsID = SCHOLAR_INTERESTS.ResearchInterestsID 
				WHERE ".$Criteria1." like '%".$searchterm1."%' OR ".$Criteria2." like '%".$searchterm2."%'";
				$result = $db->query($query);
				$num_results = $result->num_rows;
				echo "<p><strong>~ ".$num_results." records found that match the search term; '".$searchterm1."' or '".$searchterm2."'.</strong></p>";
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
					echo "<p><strong>".($i+1).".".$Result1.":";
					echo stripslashes($row[$Result1]);
					echo "</strong><br />".$Result2.":";
					echo stripslashes($row[$Result2]);
					echo "</p>";
				}	
			}	
		}
		$result->free();
		$db->close();
		?>
	</body>
</html>