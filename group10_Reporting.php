<!DOCTYPE html>
<html>
    <head>
    <title>Group 10 - Reporting Tools</title>
    <link href="group10_style.css" type="text/css" rel="stylesheet" />
    </head>

<body>
    
    <h1>People of Data Science</h1>
    <header>
        <div class="nav">
            <ul>
                <li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Index.html">Home</a></li>
                <li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Reporting.html">Reporting Tools</a></li>
                <li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Insert.html">Insert Data</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Search.html">Search Database</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_TableView.html">Table View</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_AboutUs.html">About Us</a></li>
			</ul>
        </div>
    </header>
	<?php
	$ReportCriteria = $_POST['ReportCriteria1'];
	$ReportCriteria2 = $_POST['ReportCriteria2'];
	$Year = trim($_POST['reportterm']);
	if (!$ReportCriteria) {
		echo 'You have not entered selected the report criteria. Please go back and try again.';
		exit;
		}
		
	if (!get_magic_quotes_gpc()){
	    $ReportCriteria = addslashes($ReportCriteria);
	    $Year = addslashes($Year);
	}
	@ $db = new mysqli('localhost', '5717G10', 'group10', '5717G10');
	if (mysqli_connect_errno()) 
	   {
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
		}
	if($ReportCriteria == 1)
	{
	  $query = "SELECT YEAR(CreatedDate), COUNT(ScholarID) FROM SCHOLAR WHERE YEAR(CreatedDate) = '".$Year."' GROUP BY YEAR(CreatedDate)";
	  if(!$reportResult = $db -> query($query))
	   {
	      echo 'Cannot run the query';
	      exit;
	    }
	    $numOfResults = $reportResult -> num_rows;
	    
	  for($i = 0; $i < $numOfResults;$i++)
	  {
	    $reportResultStore = $reportResult -> fetch_assoc();
	    $ResultYear = $reportResultStore['YEAR(CreatedDate)'];
	    $ResultCount = $reportResultStore['COUNT(ScholarID)'];
	    echo "<p><strong> Number of Scholars updated in ".$ResultYear." are ".$ResultCount."</strong></p>";
	   }
	}
	else if($ReportCriteria == 2)
	{
	  $query2 = "SELECT YEAR(CreatedDate), COUNT(PublicationID) FROM PUBLICATION_HISTORY WHERE YEAR(CreatedDate) = '".$Year."' GROUP BY YEAR(CreatedDate)";
	  if(!$reportResult2 = $db -> query($query2))
	   {
	      echo 'Cannot run the query';
	      exit;
	    }
	    $numOfPubResults = $reportResult2 -> num_rows;
	  for($i = 0; $i < $numOfPubResults;$i++)
	  {
	    $pubreportResultStore = $reportResult2 -> fetch_assoc();
	    $ResultPubYear = $pubreportResultStore['YEAR(CreatedDate)'];
	    $ResultPubCount = $pubreportResultStore['COUNT(PublicationID)'];
	    echo "<p><strong> Number of Scholars updated in ".$ResultPubYear." are ".$ResultPubCount."</strong></p>";
	    }
	}
    if($ReportCriteria2 == 3)
	{
	  header("location:group10_Reporting.html");
	}
	if($ReportCriteria2 == 4)
	{
	  $query3 = "SELECT * FROM SCHOLAR ORDER BY TotalNoOfCitation DESC LIMIT 5";
	  if(!$reportResult3 = $db -> query($query3))
	   {
	      echo 'Cannot run the query';
	      exit;
	    }
	   echo "<p>The top 5 scholars based on citation details are: </p>";
	   ?> 
	   <table>
	    <th> First Name </th>
        <th> Last Name </th>
	    <th> Number of Citation </th> 
	  <?php
	  while ($reportTopResult = $reportResult3 -> fetch_assoc())
	    {
        echo "<tr>";
        echo "<td>".$reportTopResult["FirstName"]."</td>";
        echo "<td>".$reportTopResult["LastName"]."</td>";
        echo "<td>".$reportTopResult['TotalNoOfCitation']."</td>";
        echo "</tr>";    
         }
        echo "</table>";
	}
	if($ReportCriteria2 == 5)
	{
	  $query4 = "SELECT *";
      $query4 .= " FROM PUBLICATION_HISTORY p";
      $query4 .= " JOIN SCHOLAR s ON p.ScholarID = s.ScholarID";
      $query4 .= " ORDER BY CitedBy DESC";
      $query4 .= " LIMIT 5";
	  if(!$reportResult4 = $db -> query($query4))
	   {
	      echo 'Cannot run the query';
	      exit;
	    }
	   echo "<p>The top 5 publication of scholars based on citation details are: </p>";
	   ?> 
	   <table>
	    <th> First Name </th>
        <th> Last Name </th>
        <th> Article Title </th>
        <th> Publisher </th>
	    <th> Number of Citation </th> 
	  <?php
	  while ($reportTopPubResult = $reportResult4 -> fetch_assoc())
	    {
        echo "<tr>";
        echo "<td>".$reportTopPubResult["FirstName"]."</td>";
        echo "<td>".$reportTopPubResult["LastName"]."</td>";
        echo "<td>".$reportTopPubResult['Title']."</td>";
        echo "<td>".$reportTopPubResult['Publisher']."</td>";
        echo "<td>".$reportTopPubResult['CitedBy']."</td>";
        echo "</tr>";    
         }
        echo "</table>";
	}
	if($ReportCriteria2 == 6)
	{
	  header("location:group10_Reporting.html");
	}
	?>
	</body>
</html>