<!DOCTYPE html>
<html>

<head>
	<title>Welcome to Instagram - Sign up, Log in, Post </title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
	<?php include('session.php'); ?>

	<div id="header">
		<div class="head-view">
			<ul>
				<li><a href="home.php" title="instagram"><b>Instagram</b></a></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li><a href="home.php" title="Home"><label>Home</label></a></li>
				<li><a href="photos.php" title="<?php echo $username ?>"><label><?php echo $username ?></label></a></li>
				<li><a href="logout.php" title="Log out"><button class="btn-sign-in" value="Log out">Log out</button></a></li>
			</ul>
		</div>
	</div>

	<div id="container">
		<div id="left-nav">
			<div class="clip1">
				<a href="updatephoto.php" title="Change Profile Picture"><img src="<?php echo $row['profile_picture'] ?>"></a>
			</div>

			<div class="user-details">
				<h3><?php echo $firstname ?>&nbsp;<?php echo $lastname ?></h3>
				<h2><?php echo $username ?></h2>
			</div>
		</div>





		<?php
		include("includes/database.php");
		$query = mySQLi_query($con, "SELECT * from photos LEFT JOIN user on user.user_id = photos.user_id order by photo_id DESC");
		while ($row = mySQLi_fetch_array($query)) {
			$posted_by = $row['firstname'] . " " . $row['lastname'];
			$location = $row['location'];
			$profile_picture = $row['profile_picture'];
			$photo_id = $row['photo_id'];
		?>
			<div id="right-nav1">
				<div class="profile-pics">
					<img src="<?php echo $profile_picture ?>">
					<b><?php echo $posted_by ?></b>
				</div>
				<br />
				<div class="post-content">
					<center>
						<img src="<?php echo $location ?>">
					</center>
				</div>

				<?php
				include("includes/database.php");
				$comment = mySQLi_query($con, "SELECT * from comments where post_id='$post_id' order by post_id DESC");
				while ($row = mySQLi_fetch_array($comment)) {
					$comment_id = $row['comment_id'];
					$content_comment = $row['content_comment'];
					$time = $row['created'];
					$post_id = $row['post_id'];
					$user = $_SESSION['id'];

				?>
					<div class="comment-display" <?php echo $comment_id ?>>
						<div class="delete-post">
							<a href="delete_comment.php<?php echo '?id=' . $comment_id; ?>" title="Delete your comment"><button class="btn-delete">X</button></a>
						</div>
						<div class="user-comment-name"><img src="<?php echo $row['image']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $row['name']; ?><b class="time-comment"><?php echo $time = time_stamp($time); ?></b></div>
						<div class="comment"><?php echo $row['content_comment']; ?></div>

					</div>
					<br />

				<?php
				}
				?>


				<form method="POST" action="comment.php">
					<div class="comment-area">

						<?php $image = mysqli_query($con, "select * from user where user_id='$id'");
						while ($row = mysqli_fetch_array($image)) {


						?>
							<img src="<?php echo $row['profile_picture']; ?>" width="50" height="50">
						<?php } ?>

						<input type="text" name="content_comment" placeholder="Write a comment..." class="comment-text">
						<input type="hidden" name="post_id" value="<?php echo $post_id ?>">
						<input type="hidden" name="user_id" value="<?php echo $firstname . ' ' . $lastname  ?>">
						<input type="hidden" name="image" value="<?php echo $profile_picture  ?>">
						<input type="submit" name="post_comment" value="Enter" class="btn-comment">

					</div>
				</form>


			</div>
		<?php
		}
		?>


	</div>

</body>

</html>