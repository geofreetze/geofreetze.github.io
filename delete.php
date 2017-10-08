<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href = "styles/style.css">
    <title>Letters Aren't Trademarked</title>
</head>
<body>
  

  <?php     
      //https://stackoverflow.com/questions/7711466/checking-if-form-has-been-submitted-php
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         
          $delete_code = intval($_GET['delete_code']);

          if (is_int($delete_code)) {
              if ($delete_code >= 0 && $delete_code <= 9223372036854775807) {

                  require_once 'includes/config.php';
                  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  
                  if (!$conn) {
                     die("Connection failed: " . mysqli_connect_error());
                  }

                  $sql = "UPDATE books SET active_listing = 0 WHERE delete_code=$delete_code";

                  if (mysqli_query($conn, $sql)) {
                      echo "Listing successfully deleted!";
                  } else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }

                  mysqli_close($conn);

                  //https://stackoverflow.com/questions/37433826/php-redirect-after-form-submit
                  echo '<script>window.location = "http://localhost:8888/CS2300/fuckthecstore3/catalog.php" </script>';
              }
              else {
                  echo "Your delete code isn't between 0 and 2^63 - 1, you fuck.";
              }
          }
          else {
              echo "Your delete code isn't an int, you fuck.";
          }
      }
      else {
          echo "No POST data sent. What are you doing here?";
      }
  ?>
</body>
</html>