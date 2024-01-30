<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'resume_db';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include("../try.php");

// Validate form submission
if (isset($_POST['submit'])) {
    // Validate user input
    $objective = filter_var(trim($_POST['objective']), FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
    $linkedin = filter_var(trim($_POST['linkedin']), FILTER_SANITIZE_URL);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $edu = filter_var(trim($_POST['edu']), FILTER_SANITIZE_STRING);
    $work = filter_var(trim($_POST['work']), FILTER_SANITIZE_STRING);
    $tskills = filter_var(trim($_POST['tskills']), FILTER_SANITIZE_STRING);
    $sskills = filter_var(trim($_POST['sskills']), FILTER_SANITIZE_STRING);
    $project = filter_var(trim($_POST['project']), FILTER_SANITIZE_STRING);
    $research = filter_var(trim($_POST['research']), FILTER_SANITIZE_STRING);

    // Validate file upload
    // $avatar = '';
    // if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
    //     $filename = basename($_FILES['avatar']['name']);
    //     $target_dir = 'images/';
    //     $target_file = $target_dir . $filename;
    //     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //     // Check if file is an image
    //     $check = getimagesize($_FILES['avatar']['tmp_name']);
    //     if ($check === false) {
    //         die('File is not an image.');
    //     }

    //     // Check if file already exists
    //     if (file_exists($target_file)) {
    //         die('File already exists.');
    //     }

    //     // Check file size
    //     if ($_FILES['avatar']['size'] > 500000) {
    //         die('File is too large.');
    //     }

    //     // Allow certain file formats
    //     if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
    //         die('Only JPG, JPEG, PNG & GIF files are allowed.');
    //     }

    //     // Upload file
    //     if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
    //         $avatar = $filename;
    //     }
    // }

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO resume_details (objective, phone, linkedin, email, edu, work, tskills, sskills, project, research, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $objective, $phone, $linkedin, $email, $edu, $work, $tskills, $sskills, $project, $research, $avatar);

    // Execute statement
    if ($stmt->execute()) {
        echo "Register form submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

	header("Location: index.php?image_path=" . urlencode($target_file));

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
		<title>Register Form</title>
	</head>
	<body>
        <div class="container shadow p-5 mb-5 bg-white rounded">
		<h1 class="text-center" style="font-size: 80px; font-weight: 800; color:#044450 ;"><?= htmlspecialchars($_SESSION["username"]); ?></h1>


            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <table width="1px" class="table">

                    <tr>
                <!-- ...Objective... -->
			<td align="center">

					<!-- <img style="float:left;"  src="images/<?= htmlspecialchars($_SESSION['photo']); ?>" alt="Avatar" class="img-fluid rounded-circle mb-3">	 -->
				<div class="form-outline w-75 mb-4"><textarea class="form-control" type="text" name="objective" placeholder="Objective"></textarea></div><div>
			 <?php
			if(isset($errors['objective']))
			{
				echo $errors['objective'];
			}
			?>
			</div></td>
		</tr>
        <tr>
			<th align="right">Contact No. :</th>
			<td><input type="text" name="phone" class="form-control form-outline w-75 md-4" placeholder="Enter Phone no."/><div>
			<?php
			if(isset($errors['phone']))
			{
				echo $errors['phone'];
			}
			?>
			</div></td>
        </tr>
        <tr>
            <th align="right">LinkedIn ID:</th>
            <td><input type="text" class="form-control form-outline w-75 md-4" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Link for LinkedIn" name="linkedin"/><div>
			<?php
			if(isset($errors['linkedin']))
			{
				echo $errors['linkedin'];
			}
			?>
			</div></td>
        </tr>
        <tr>
            <th align="right">Email ID</th>
            <td><input type="email" class="form-control form-outline w-75 md-4" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email"/><div>
			<?php
			if(isset($errors['email']))
			{
				echo $errors['email'];
			}
			?>
			</div></td>
		</tr>
		<tr>
			<th align="right">Education :</th>
			<td align="left">
                <div class="form-outline w-75 md-4"><textarea class="form-control" type="text" name="edu" placeholder="Enter educational Background"></textarea></div>
			<div>
			<?php
			if(isset($errors['edu']))
			{
				echo $errors['edu'];
			}
			?>
			</div>
			</td>
			
		</tr>
		<tr>
        <th align="right">Work Experience :</th>
			<td align="left">
                <div class="form-outline w-75 md-4"><textarea class="form-control" type="text" name="work" placeholder="Enter Professional experience"></textarea></div>
			<div>
			<?php
			if(isset($errors['work']))
			{
				echo $errors['work'];
			}
			?>
			</div>
			</td>
		</tr>
		<tr>
        <th align="right">Skills</th>
			<td align="left"><div class="form-outline w-75 md-4"><textarea type="text" name="tskills" class="form-control" placeholder="Technical Skills"/></textarea></div>
            <div>
			<?php
			if(isset($errors['tskills']))
			{
				echo $errors['tskills'];
			}
			?>
			</div></td>
        </tr>
        <tr>
        <th></th>
            <td align="left"><div class="form-outline w-75 md-4"><textarea type="text" class="form-control" placeholder="Soft Skills" name="sskills"/></textarea><div>
			<?php
			if(isset($errors['sskills']))
			{
				echo $errors['sskills'];
			}
			?>
			</div></td>
		</tr>
		<tr>
        <th align="right">Project/Research Work</th>
			<td align="left">
            <div class="form-outline w-75 md-4"><textarea type="text" name="project" class="form-control" placeholder="Enter Project(s)"/></textarea></div>
            <div>
			<?php
			if(isset($errors['project']))
			{
				echo $errors['project'];
			}
			?>
			</div></td>
        </tr>
        <tr>
            <th align="right"></th>
            <td>
            <div class="form-outline w-75 md-4"><textarea type="text" class="form-control" placeholder="Enter Research(s)" name="research"/></textarea></div>
            <div>
			<?php
			if(isset($errors['research']))
			{
				echo $errors['research'];
			}
			?>
			</div></td>
		</tr>
		
		<!-- <tr>
			<th align="right">Photo :</th>
			<td><input type="file" name="avatar" /><div>
			<?php
			if(isset($errors['avatar']))
			{
				echo $errors['avatar'];
			}
			?>
			</div></td>
		</tr> -->
			<td>&nbsp;
			<td><input type="submit" name="submit"/>
			<input type="button" name="show" value="Show" onclick="window.print();"/>
			</td>
			</td>
		</tr>
		</tr>
		</table>
    </div>
		</form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
	</body>
</html>