<html>
<head>
<title>Facemash - Top</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

</script>
<style>
a img{
	border:0;
}
#players{
	width:650px;
	margin:0 auto;
}
.player{
	float:left;
	margin-left:20px;
}
table{
	clear:both;
}
tr,td{
	border:1px solid black;
}
</style>
</head>
<body>
<?php
define('MYSQL_HOST', "localhost");
define('MYSQL_USER', "root");
define('MYSQL_PASS', "hello");
define('MYSQL_DB', "labuser");
define('FOLDER', "images/");
define('K', "32");

function toplist()
{
	$query = "SELECT * FROM facemash ORDER BY rating DESC";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt,$id,$rating,$imageurl);
				echo '<table><tr><td>PIC</td><td>ID</td><td>Rating</td></tr>';
				while (mysqli_stmt_fetch($stmt)) {
					echo '<tr><td><a href="images/'.$imageurl.'"><img src="images/'.$imageurl.'" width="50px" height="50px" /></a></td><td>'.$id.'</td><td>'.$rating.'</td></tr>';
				}
				echo '</table>';
				mysqli_stmt_close($stmt);
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}

	toplist();
?>
</body>
</html>