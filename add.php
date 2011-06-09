<?php
require_once('define.php');
require_once('func.php');

// NEW user scan folder

$scan = scandir(FOLDER);
$added = 0;
for($i=0;$i<=count($scan)-1;$i++)
{
	if(check($scan[$i]) <= 0){
		$filename = $scan[$i];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if($ext=="jpg" || $ext=="JPG")
		{	
			# Check if filename exists
			if(!check($filename)){
				# Add opponent
				if(newopponent($filename))
				{
					echo $filename;
					$added++;
				}
			}
		}
	}
}
if($added != 0){
		echo $added.' New Files added';
}
?>