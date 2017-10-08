<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href = "styles/style.css">
    <title>Letters Aren't Trademarked</title>
</head>
<body>
  

  <?php     
      //https://stackoverflow.com/questions/7711466/checking-if-form-has-been-submitted-php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //var_dump($_POST);
          // array(6) { ["title"]=> string(5) "money" ["edition"]=> string(1) "0" ["author"]=> string(7) "robbins" ["price"]=> string(2) "35" ["email"]=> string(20) "geofree101@gmail.com" ["submit"]=> string(14) "List Your Book" }
          
          $validate = true;

          

          $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
          if (strlen($title) > 64) {
              echo "The book's title is too long. Delete everything except the first couple words. Make it less than 40 characters to be safe. Please go back and try again. <br />";
              $validate = false;
          }

          
          $edition = intval($_POST['edition']);
          if (!is_int($edition) || ($edition < 0 || $edition > 99)) {
              echo "You somehow inputed something other than a number between 0-99. Congratulations you fuck. <br />";
              $validate = false;
          }

          $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
          if (strlen($author) > 64) {
              echo "The author's name is too long. Make it less than 40 characters to be safe. Please go back and try again. <br />";
              $validate = false;
          }

          $price = intval($_POST['price']);
          if (!is_int($price) || ($price < 0 || $price > 999)) {
              echo "You somehow inputed something other than a number between 0-999. Congratulations you fuck. <br />";
              $validate = false;
          }

          $email = $_POST['email'];
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              echo "You inputed an invalid email. Please go back and try again. <br />";
              $validate = false;
          }

          if ($validate) {

              $delete_code = random_int(0, 9223372036854775807);
              $message = 
              "
              Your book $title is now listed.
              After your book has sold, click the link below to delete your listing.
              http://localhost:8888/CS2300/fuckthecstore3/delete.php?delete_code=$delete_code
              Save this link for future reference!
              Otherwise, buyers will email you all semester long.

              Bingalee Dingalee";

              require_once 'includes/config.php';
              $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
              
              if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
              }

              $sql = "INSERT INTO books VALUES (NULL, '$title', '$edition', '$author', '$price', '$email', 1, '$delete_code', CURRENT_TIMESTAMP)";

              if (mysqli_query($conn, $sql)) {
                  echo "New listing successfully created!";
                  mail($email, "Fuck The C Store Listing Successfully Created", $message);
              } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }

              mysqli_close($conn);

              //https://stackoverflow.com/questions/37433826/php-redirect-after-form-submit
              //echo '<script>window.location = "http://localhost:8888/CS2300/fuckthecstore3/catalog.php" </script>';


          }
      }
      else {
          echo "No POST data sent. What are you doing here?";
      }
  ?>
</body>
</html>