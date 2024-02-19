<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
$version = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/stylesheet/navbraStyle.css?v=<?php echo $version ?>">

    <link rel="stylesheet" href="../static/stylesheet/homeStyle.css?v=<?php echo $version ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Recipe finder</title>
</head>

<body>
    <header>
        <div class="logo"><img src="recipelogo.png" alt="logo"></div>
        <div class="manubar">
            <span class="material-symbols-outlined">
                menu
            </span>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="addRecipe.php">AddRecipe</a></li>
                <li><a href="#">About</a></li>
                <li><a href="../userAuth/logout.php">LogOut</a></li>
            </ul>
            <form action="" method="POST" id="form">
              <input type="search" placeholder="Search Recipe..." id="search-box" class="searchBox">
                <button type="submit" class="sreachbtn" id="search-btn">Search</button>
        </form>
        </nav>
    </header>

    <main>
        <section>
            <div class="recipe-container">
                <?php
                echo "<h1>Hey " . $_SESSION['username'] ." !!"."<br> welcome to our website</h1>";
                ?>
            </div>
            <div class="recipe-details">
                <button type="butten" class="recipe-colse-btn">close</button>
                <div class="recipe-details-content"></div>
            </div>

        </section>
    </main>
    <script>
        let manubar = document.querySelector(".manubar");
        manubar.addEventListener("click", () => {
            let navbar = document.querySelector(".nav-bar");
            navbar.classList.toggle("active")
        })
         let searchbtn = document.querySelector(".sreachbtn");
        searchbtn.addEventListener("click", () => {
            let navbar = document.querySelector(".nav-bar");
            navbar.classList.remove("active")
        })

    </script>
    <script src="home.js?v=<?php echo $version ?>"></script>
</body>

</html>