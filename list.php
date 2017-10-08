<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href = "styles/style.css">
    <title>Fuck the C Store</title>
</head>
<body>

    <?php include 'includes/header.php';?>

    <form action="process.php" method="post">
        
        <label for="title" id="title">Title:</label>
        <input type="text" name="title" maxlength="64" placeholder="e.g. The Hobbit" required />
        <br>

        <label for="edition" id="edition">Edition:</label>
        <input type="number" name="edition" min="0" max="99" />
        <br>
        
        <label for="author" id="author">Just the Author's Last Name:</label>
        <input type="text" name="author" maxlength="64" placeholder="Tolkien" required />
        <br>
        
        <label for="price" id="price">Asking Price:</label>
        <input type="number" name="price" min="0" max="999" required />
        <br>
        
        <label for="email" id="email">Email:</label>
        <input type="email" name="email" maxlength="64" placeholder="abc123@cornell.edu" required />
        <br>
            
        <input type="submit" name="submit" value="List Your Book" />
    </form>

</body>
</html>