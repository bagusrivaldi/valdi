<?php include('session.php'); ?>
<?php
include('includes/database.php');

if (isset($_POST['post_comment'])) {
	$user = $_SESSION['id'];
	$content_comment = $_POST['content_comment'];
	$photo_id = $_POST['photo_id'];
	$user_id = $_POST['user_id'];
	$time = time(); {
		mySQLi_query($con, "INSERT INTO comments (photo_id,user_id,name,content_comment,image,created)
			VALUES ('$photo_id','$id','$user_id','$content_comment','$profile_picture',$time)");
		echo "<script>window.location='home.php'</script>";
	}
}

?>