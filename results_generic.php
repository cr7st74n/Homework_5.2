<html>
<head>
  <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
  // create short variable names
  $searchtype=$_POST['searchtype'];
  $searchterm=trim($_POST['searchterm']);

  if (!$searchtype || !$searchterm) {
     echo "You have not entered search details.  Please go back and try again.";
     exit;
  }
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);

  set up for using PEAR MDB2
  require_once('MDB2.php');
  $user = 'gonzac43_testuser1';
  $pass = 'U^fdh{?}aMkc';
  $host = 'localhost';
  $db_name = 'books';

  // set up universal connection string or DSN
  $dsn = "mysqli://".$user.":".$pass."@".$host."/".$db_name;

  // connect to database
  $db = &MDB2::connect($dsn);

  // check if connection worked
  if (MDB2::isError($db)) {
    echo $db->getMessage();
    exit;
  }
  
  //====================================================================

  // ===================================================================

  // perform query
  $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";

  $result = $db->query($query);

  // check that result was ok
  if (MDB2::isError($result))  {
    echo $db->getMessage();
    exit;
  }

  // get number of returned rows
  $num_results = $result->numRows();

  // display each returned row
  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetchRow(MDB2_FETCHMODE_ASSOC);
     echo "<p><strong>".($i+1).". Description: ";
     echo htmlspecialchars(stripslashes($row['description']));
     echo "</strong><br />Name: ";
     echo stripslashes($row['name']);
     echo "<br />ISBN: ";
     echo stripslashes($row['isbn']);
     echo "<br />Quantity: ";
     echo stripslashes($row['quantity']);
     echo "</p>";
  }

  // disconnect from database
  $db->disconnect();
?>
</body>
</html>
