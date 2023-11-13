<!DOCTYPE html>

<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <!-- <link rel="icon" type="image/x-icon" href="portfolio-assets/logo 32x32.png"> -->
        <title> NomNomNerd </title>
    </head>

    <body>
        <?php
            // $msg = "HOWDY";
            // echo '<script type="text/javascript">console.log("'. $msg .'");</script>';

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
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder="Search">
                        <button type="submit" class="searchButton">
                            <img class="field-icon" src="media/search_black.png" alt="Search icon">
                        </button>
                    </div>
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
                <a class="view-button" href=""> Beef </a>
                <a class="view-button" href=""> Chicken </a>
                <a class="view-button" href=""> Pork </a>
                <a class="view-button" href=""> Fish </a>
                <a class="view-button" href=""> Vegetarian </a>
            </div>
            <h1> All Recipes </h1>

            <div id="recipe-list">

            <?php
                // Get all the recipes from "recipes" table in the "idm232" database
                $query = "SELECT * FROM recipes";
                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                    consoleMsg("Query successful! number of rows: $results->num_rows");
                    while ($oneRecipe = mysqli_fetch_array($results)) {
                    // echo '<h3>' .$oneRecipe['Title']. ' - '  . $oneRecipe['Cal/Serving']  .  '</h3>'; 
                    $id = $oneRecipe['id'];
                    echo '<a loading="lazy" class="linktodet" href="recipe-detail-page/index.php?id=' . $oneRecipe['id'] . '" aria-label="make this recipe">';
                    echo '<div class="main-recipe">';
                    echo '<img class="main-recipe-img" src="./media/food/' . $oneRecipe['Main IMG'] . '" alt="Dish image">';
                    echo '<h2 class="main-recipe-name">' . $oneRecipe['Title'] . ' <br><span class="recipe-subtitle">' . $oneRecipe['Subtitle'] . '</span></h2>';
                    echo '</div>';
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

        <script src="script.js"> </script>
    </body>

</html>