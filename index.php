<?php
/*
	Facemash and working with the ELO rating system
	http://en.wikipedia.org/wiki/Elo_rating_system
*/

require_once('define.php');
require_once('func.php');

/*
	The opponents new scores are parameters in a get query
	The parameters are id and oid where id is the images own id and oid is the opponents id
	This script assumes that whoever gets clicked on and has the get query passed, is the winner.
*/
if(ISSET($_GET['id']) && ISSET($_GET['oid']))
{
	// SCORE
	$sa = 1;
	$sb = 0;
	// ID
	$player_a=$_GET['id'];
	$player_b=$_GET['oid'];
	
	// CURRENT RATING
	$RA = rating($player_a);
	$RB = rating($player_b);
	
	// EXPECTATION
	$EA = 1/(1+pow(10,(($RB-$RA)/400)));
	$EB = 1/(1+pow(10,(($RA-$RB)/400)));

	// NEW RATING
	$RA=$RA+K*($sa-$EA);
	$RB=$RB+K*($sb-$EB);
}

?>

<html>
<head>
<title>Facemash</title>

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
p{
	font-size:30px;
	text-align:center;
}
</style>
</head>
<body>
<div id="players">
<?php newmatch();?>	
</div>
</body>
</html>