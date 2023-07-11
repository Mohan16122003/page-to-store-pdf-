<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $weight = $_POST['weight'];
  $email = $_POST['email'];
  $healthReport = $_FILES['health-report']['name'];
  $uploadDirectory = "uploads/";
  $targetFilePath = $uploadDirectory . basename($healthReport);
  move_uploaded_file($_FILES['health-report']['tmp_name'], $targetFilePath);

  $sql = "INSERT INTO work (name, age, weight, email, pdffile) VALUES ('$name', '$age', '$weight', '$email', '$targetFilePath')";

  if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Data inserted successfully!");</script>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<script src="insertion.js"></script>
</head>

<body>
  <div class="container">
    <h2>Registration Form</h2>
    <form id="registration-form" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
      
      <label for=" name">Name</label>
      <input type="text" id="name" name="name">

      <label for="age">Age</label>
      <input type="number" name="age" id="age">

      <label for="weight">Weight</label>
      <input type="number" id="weight" name="weight">

      <label for="email">Email</label>
      <input type="email" id="email" name="email">



      <label for="health-report">Upload Health Report</label>
      <input type="file" id="health-report" name="health-report">
      <hr>
      <input type="submit" value="Submit" class="submit-button" name="submit">
    </form>
  </div>
  <div id="warning-modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <p id="warning-message"></p>
    </div>
  </div>

 
</body>

</html>
<?php
mysqli_close($conn);
?>