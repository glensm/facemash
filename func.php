<?php
require_once('define.php');

# Check if the image exists already
function check($imageurl) {
		
	$query = "SELECT * FROM facemash WHERE imageurl=?";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){	  
		if ($stmt = mysqli_prepare($con, $query)) {
			mysqli_stmt_bind_param($stmt, 's',$imageurl);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				$count = mysqli_stmt_num_rows($stmt);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);
				if($count >= 1)
				{
					return false;
				}else
				{
					return true;
				}
			}
			else{
				echo "The query could not be completed.";
				return false;
			}
		}
	}
	else{
		echo "Could not connect to the database.";
		return false;
	}
}
# Add new opponent
function newopponent($imageurl)
{
	$base_rating = BASE_RATING;
	$query = "INSERT INTO facemash (id,rating,imageurl) values('',?,?)";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			mysqli_stmt_bind_param($stmt, 'ss',$base_rating,$imageurl);
			if(mysqli_stmt_execute($stmt)){
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
# Get rating
function rating($id)
{
	$query = "SELECT rating FROM facemash WHERE id=?";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			mysqli_stmt_bind_param($stmt, 's',$id);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $rating);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);
				return $rating;
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
#Update rating
function newrating($id,$rating)
{
	$query = "UPDATE facemash SET rating=? WHERE id=?";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			mysqli_stmt_bind_param($stmt, 'ss',$rating,$id);
			if(mysqli_stmt_execute($stmt)){
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
# Creates a new match
function newmatch()
{
	$rand = 0.1*rand(1,9);

	$query = "SELECT a.id,a.rating,a.imageurl, b.id,b.rating,b.imageurl from facemash as a join facemash as b on a.id != b.id where abs(a.rating - b.rating) < 100 ORDER BY RAND() limit 1";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			mysqli_stmt_bind_param($stmt, '');
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt,$aid,$arating,$aimageurl,$bid,$brating,$bimageurl);
				while (mysqli_stmt_fetch($stmt)) {
					echo '<div class="player">';
					echo '<a href="index.php?id='.$aid.'&oid='.$bid.'">';
					echo '<img src="images/'.$aimageurl.'" alt="'.$aid.'" width="'.IMAGE_WIDTH.'px" height="'.IMAGE_HEIGHT.'px" />';
					echo '</a>';
					echo '<p>'.$arating.'</p>';
					echo '</div>';
					echo '<div class="player">';
					echo '<a href="index.php?id='.$bid.'&oid='.$aid.'">';
					echo '<img src="images/'.$bimageurl.'" alt="'.$bid.'" width="'.IMAGE_WIDTH.'px" height="'.IMAGE_HEIGHT.'px" />';
					echo '</a>';
					echo '<p>'.$brating.'</p>';
					echo '</div>';
				}

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
# Prints out a list of scores in descending order along with id and rating
function toplist()
{
	$query = "SELECT * FROM facemash ORDER BY rating DESC";
	if($con = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB)){
		if ($stmt = mysqli_prepare($con, $query)) {
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt,$id,$rating,$imageurl);
				echo '<table><tr><td>PIC</td><td>ID</td><td>Rating</td></tr>';
				while (mysqli_stmt_fetch($stmt)) {
					echo '<tr><td><img src="images/'.$imageurl.'" width="50px" height="50px" /></td><td>'.$id.'</td><td>'.$rating.'</td></tr>';
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
?>