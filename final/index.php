<!DOCTYPE html>

<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" type="image/x-icon" href="media/logo.png">
        <title> NomNomNerd </title>
    </head>

    <body>
        <?php
            

            require_once './includes/fun.php';
            consoleMsg("PHP to JS .. is Wicked FUN");

            // Include env.php that holds global vars with secret info
            require_once './env.php';

            // Include the database connection code
            require_once './includes/database.php';

        ?>

        <header>
            <div id="navbar">
                <img id="logo" src="media/logo.png" alt="Logo">
                <div class="search-container">
                    <!-- <div class="search"> -->
                    <form class="search" action="index.php" method="POST">
                        <input type="search" class="searchTerm" name="search" placeholder="Search" value="<?php echoSearchValue(); ?>">
                        <button type="submit" class="searchButton" name="submit" value="submit">
                            <img class="field-icon" src="media/search_black.png" alt="Search icon">
                        </button>
                    </form>
                    <!-- </div> -->
                </div>
            </div>
            <picture>
                <source media="(min-width: 880px)" srcset="media/food/hero_img.jpg">
                <img id="hero-img" src="media/food/hero_img_cropped.jpg" alt="Hero image">
            </picture>
        </header>

        <main>
            <!-- <div class="search-filter" id="filter-bar">
                <p> Filter</p>
                <img class="field-icon" src="media/down_arrow.png" alt="Drop down">
            </div> -->

            <div id="filter-bar">
                <a class="view-button" href="index.php"> All </a>
                <a class="view-button" href="index.php?filter=beef"> Beef </a>
                <a class="view-button" href="index.php?filter=chicken"> Chicken </a>
                <a class="view-button" href="index.php?filter=pork"> Pork </a>
                <a class="view-button" href="index.php?filter=steak"> Steak </a>
                <a class="view-button" href="index.php?filter=turkey"> Turkey </a>
                <a class="view-button" href="index.php?filter=fish"> Fish </a>
                <a class="view-button" href="index.php?filter=vegitarian"> Vegetarian </a>
            </div>
            <h1> All Recipes </h1>

            <div id="recipe-list">

            <?php
                $search = $_POST['search'];
                consoleMsg("Search string is: $search");

                $filter = $_GET['filter'];
                consoleMsg("Filter is: $filter");

                if (!empty($search)) {
                    consoleMsg("Doing a SEARCH");
                    // $query = "select * FROM recipes WHERE title LIKE '%{$search}%'";
                    $query = "SELECT * FROM recipes WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
                    
                  } elseif (!empty($filter)) {
                    consoleMsg("Doing a FILTER");
                    $query = "select * FROM recipes WHERE proteine LIKE '%{$filter}%'";

                  } else {
                    consoleMsg("Loading ALL RECIPES");
                    $query = "SELECT * FROM recipes";
                  }

                // Get all the recipes from "recipes" table in the "idm232" database
                
                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                    consoleMsg("Query successful! number of rows: $results->num_rows");
                    while ($oneRecipe = mysqli_fetch_array($results)) { 
                        $id = $oneRecipe['id'];

                        // STEP 01 .. Wrap thumbnail in anchor tag
                        echo '<a href="./detail.php?id=' . $oneRecipe['id'] . '">';
                        echo '<div class="main-recipe">';
                        echo '<img class="main-recipe-img" src="./media/food/' . $oneRecipe['Main IMG'] . '" alt="Dish image">';
                        echo '<h2 class="main-recipe-name">' . $oneRecipe['Title'] . '<br><span class="recipe-subtitle">' .$oneRecipe['Subtitle']. '</span></h2>';
                        echo '</div>';

                        // STEP 02 .. Close anchor tag
                        echo '</a>';
                    }
                }
            ?>
                <!-- <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/1_chicken.jpg" alt="Ancho-Orange Chicken">
                    <h2 class="main-recipe-name"> Ancho-Orange Chicken 
                    <br>
                    <span class="recipe-subtitle">with Kale Rice & Roasted Carrots</span> 
                    </h2>                  
                </div> -->

                <!-- <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/2_beef.jpg" alt="Beef Medallions & Mushroom Sauce">
                    <h2 class="main-recipe-name"> Beef Medallions & Mushroom Sauce <br><span class="recipe-subtitle">with Mashed Potatoes</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/3_sandwich.jpg" alt="Broccoli & Basil Pesto Sandwiches">
                    <h2 class="main-recipe-name"> Broccoli & Basil Pesto Sandwiches <br><span class="recipe-subtitle">with Romaine & Citrus Salad</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/4_calzone.jpg" alt="Broccoli & Mozzarella Calzones">
                    <h2 class="main-recipe-name"> Broccoli & Mozzarella Calzones <br><span class="recipe-subtitle">with Caesar Salad</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/5_alfredo.jpg" alt="Bucatini Alfredo">
                    <h2 class="main-recipe-name"> Bucatini Alfredo <br><span class="recipe-subtitle">with Broccoli</span> </h2>                  
                </div>
                
                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/6_bucatini.jpg" alt="Bucatini & Tomato Sauce">
                    <h2 class="main-recipe-name"> Bucatini & Tomato Sauce <br><span class="recipe-subtitle">with Roasted Broccoli</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/7_rojas.jpg" alt="Cheesy Enchiladas Rojas">
                    <h2 class="main-recipe-name"> Cheesy Enchiladas Rojas <br><span class="recipe-subtitle">with Mushrooms & Kale</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/8_sandwich.jpg" alt="Crispy Fish Sandwiches">
                    <h2 class="main-recipe-name"> Crispy Fish Sandwiches <br><span class="recipe-subtitle">with Tartar Sauce & Roasted Sweet Potato Wedges</span> </h2>                  
                </div>

                <div class="main-recipe">
                    <img class="main-recipe-img" src="media/food/9_chicken.jpg" alt="General Tso's Chicken">
                    <h2 class="main-recipe-name"> General Tso's Chicken <br><span class="recipe-subtitle">with Bok Choy & Jasmine Rice</span> </h2>                  
                </div> -->

            </div>
        </main>

        <footer>
            <img id="logo-footer" src="media/logo_footer.png" alt="Logo footer">
            <p id="copyright"> © 2023 Kaylie Nguyen </p>
        </footer>

    </body>

</html>