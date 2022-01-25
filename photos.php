<?php include('session.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Welcome to Instagram - Sign up, Log in, Post </title>
	<link rel="stylesheet" type="text/css" href="css/photos.css">
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

			<?php
			include("includes/database.php");
			$query = mySQLi_query($con, "SELECT * from user where user_id='$id' order by user_id DESC");
			while ($row = mySQLi_fetch_array($query)) {
				$id = $row['user_id'];
			?>

				<div id="left-nav1">
					<h2>Personal Info</h2>
					<table>
						<tr>
							<td><label>Username</label></td>
							<td width="20"></td>
							<td><b><?php echo $row['username']; ?></b></td>
						</tr>
						<tr>
							<td><label>Birthday</label></td>
							<td width="20"></td>
							<td><b><?php echo $row['birthday']; ?></b></td>
						</tr>
						<tr>
							<td><label>Gender</label></td>
							<td width="20"></td>
							<td><b><?php echo $row['gender']; ?></b></td>
						</tr>
						<tr>
							<td><label>Contact</label></td>
							<td width="20"></td>
							<td><b><?php echo $row['number']; ?></b></td>
						</tr>
						<tr>
							<td><label>Email</label></td>
							<td width="20"></td>
							<td><b><?php echo $row['email']; ?></b></td>
						</tr>
						<tr>
							<td><label></label></td>
							<td width="20"></td>
							<td><a href='edit_profile.php?user_id=$id'><button>Edit Profile</button></a></td>
						</tr>
					</table>
				<?php
			}
				?>
				</div>

		</div>
		<div id="right-nav">
			<h1>Your Photos</h1>
			<div>
				<form method="post" action="add_photo.php" enctype="multipart/form-data">
					<input type="file" name="image">
					<button class="btn-submit-photo" name="Submit" value="Log out">Add Photos</button>
				</form>
				<hr />
			</div>

			<?php
			include("includes/database.php");
			$query = mySQLi_query($con, "SELECT * from photos where user_id='$id' ");
			while ($row = mySQLi_fetch_array($query)) {
				$id = $row['photo_id'];
			?>

				<div class="photo-select">
					<center>
						<img src="<?php echo $row['location']; ?>">
						<hr>
						<a href="delete_photos.php<?php echo '?id=' . $id; ?>" class="btn-delete-photos">Delete</a>
					</center>
				</div>

			<?php
			}
			?>
		</div>


	</div>

</body>

</html>