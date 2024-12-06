<html>
<head>
  <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php
  // create short variable names
  $isbn=$_POST['ISBN'];
  $name=$_POST['name'];
  $description=$_POST['description'];
  $quantity=$_POST['quantity'];

  if (!$isbn || !$name || !$description || !$quantity) {
     echo "You have not entered all the required details.<br />"
          ."Please go back and try again.";
     exit;
  }

  if (!get_magic_quotes_gpc()) {
    $isbn = addslashes($isbn);
    $name = addslashes($name);
    $description = addslashes($description);
    $quantity = doubleval($quantity);
  }

  @ $db = new mysqli('localhost', 'gonzac43_testuser1', 'U^fdh{?}aMkc', 'gonzac43_Books_Inventory');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  $query = "insert into books values
            ('".$isbn."', '".$name."', '".$description."', '".$quantity."')";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." book inserted into database.";
  } else {
  	  echo "An error has occurred.  The item was not added.";
  }

  $db->close();
?>
</body>
</html>
