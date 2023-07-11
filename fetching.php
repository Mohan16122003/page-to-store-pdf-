<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $_POST['email'];
$query = "SELECT pdffile FROM work WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
  $row = $result->fetch_assoc();
  $pdf = $row['pdffile'];
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $pdf . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($pdf);
} else {
  echo '<script>alert("No health report associated with the given mail");</script>';
}
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    form {
      margin-top: 30px;
    }

    input[type="email"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .submit-button {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .pdf-container {
      margin-top: 30px;
      text-align: center;
    }

    .pdf-viewer {
      width: 100%;
      height: 500px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>PDF Viewer</h2>
    <?php if (isset($error)) { echo $error; } ?>
    <form id="email-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="email">Enter Email:</label>
      <input type="email" id="email" name="email"><hr>
      <input type="submit" value="Fetch PDF" class="submit-button">
    </form>

    <div id="pdf-container" class="pdf-container">
      <object id="pdf-viewer" class="pdf-viewer" data="" type="application/pdf">
        <p>Your browser does not support PDF viewing. Please download the PDF to view it.</p>
      </object>
    </div>
  </div>

</body>

</html>

<?php
mysqli_close($conn);
?>