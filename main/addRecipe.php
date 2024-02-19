<?php
    $successalert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    //function for uploading image
    include("../partials\_dbconnect.php");
    function uploadeInmage()
    {
        $targetDirectory = "../uploads/image";
        // Generate a unique filename
        $randomString = bin2hex(random_bytes(8)); // Generate a random string
        $uniqueFilename = $randomString . '_' . basename($_FILES["file"]["name"]);
        $targetFile = $targetDirectory . '/' . $uniqueFilename;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // echo "File uploaded successfully. Path: " . $filePath;
        } else {
            echo "Error uploading file: ";
        }
        return $targetFile;
    }
    session_start();
    include("../partials/_dbconnect.php");
    $username = $_SESSION['username'];
    $recipe_name = $_POST['RecipeName'];
    $Recipe_Ingredients = $_POST['RecipeIngredients'];
    $Recipe_Instructions = $_POST['RecipeInstructions'];
    $Category = $_POST['Rcategory'];
    $Location = $_POST['Rlocation'];
    $YTLink = $_POST['RYoutubeLink'];
    $imagePath = uploadeInmage();
    $sql = "INSERT INTO rec ( `username`, `recipeName`, `recipeIngredients`, `recipeInstruction`, `recipeImage`, `category`, `location`, `youtubeLink`) VALUES ( '$username', '$recipe_name', '$Recipe_Ingredients', '$Recipe_Instructions', '$imagePath', '$Category', '$Location', '$YTLink')";
    //     // $sql = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$hpass')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $successalert = true;
        // echo "inserted";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddRecipe</title>
    <link rel="stylesheet" href="..\static\stylesheet\addRecipeStyle.css">
</head>

<body>

    <form action="addRecipe.php" method="POST" enctype="multipart/form-data">
        <h1 class="heading">Add Your recipe to our website</h1>
         <h1 class="succheading"> <?php
                                    if ($successalert) {
                                        echo "Your recipe is added successfully...";
                                    }
                                    ?></h1>
        <label for="RecipeName">Recipe_Name:</label>
        <input type="text" placeholder="Name of your recipe" name="RecipeName" class="Rname" required>
        <p><label for="RecipeIngredients">Recipe_Ingredients:</label></p>
        <textarea id="RecipeIngredients" name="RecipeIngredients" rows="4" cols="70"></textarea>
        <p><label for="RecipeInstructions">Recipe_Instructions:</label></p>
        <textarea id="RecipeInstructions" name="RecipeInstructions" rows="4" cols="100"></textarea>
        <label for="Rcategory">Category:</label>
        <input type="text" placeholder="category of your recipe" name="Rcategory" class="Rcategory">
        <label for="Rlocation">Location:</label>
        <input type="text" placeholder="Location" name="Rlocation" class="Rlocation">
        <label for="RYoutubeLink">YouTube_Video_link:</label>
        <input type="text" placeholder="Enter your recipe video link" name="RYoutubeLink">
        <label for="file">Upload your recipe image:</label>
        <input type="file" name="file" id="file" accept="image/jpeg, image/png, image/gif">
        <br>
        <input type="submit">
    </form>
</body>

</html>