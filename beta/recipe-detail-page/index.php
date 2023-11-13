<!DOCTYPE html>

<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <!-- <link rel="icon" type="image/x-icon" href="portfolio-assets/logo 32x32.png"> -->
        <title> NomNomNerd - Ancho-Orange Chicken </title>
    </head>

    <body id="recipeDetailPage">

        <?php
            require_once '../includes/fun.php';
            consoleMsg("PHP fun is loaded");
            require_once '../env.php';
            require_once '../includes/database.php';
        ?> 


        <?php
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
    try {
        $pdo = new PDO($dsn, $db_user, $db_pass);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    };

    consoleMsg("dsn worked");

        $recipe_id = $_GET['id'];  // Assuming the ID is passed through the URL
        $stmt = $pdo->prepare('SELECT * FROM Recipes WHERE id = :recipe_id');
        $stmt->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the data
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
        consoleMsg("fetch asssoc worked");
    
        if (isset($_GET['id'])) {
            // Retrieve recipe data based on ID from the URL
            $recipe_id = $_GET['id'];

            $stmt = $pdo->prepare('SELECT * FROM Recipes WHERE id = :recipe_id');
            $stmt->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
        
            // Fetch the data
            $oneRecipe = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // If a recipe with the specified ID is not found, you might want to handle that case
            if (!$oneRecipe) {
                echo "Recipe not found.";
                // You can redirect the user, show an error message, etc.
            }
        };
        consoleMsg("before null worked");
    
        // Close the database connection
        $pdo = null;
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
            
            <?php
            echo '<h1 class="main-recipe-name">' . $oneRecipe['Title'] . ' <br><span class="recipePageSubtitle">' . $oneRecipe['Subtitle'] . '</span></h1>';
            ?>
            <!-- <h1> Ancho-Orange Chicken <br><span class="recipePageSubtitle">with Kale Rice & Roasted Carrots</span> -->
            
        </header>

        <main>
            <div id="recipeIntro">
                <?php
                    echo '<img id="recipeHeroImg" src="./../media/food/'.$oneRecipe['Main IMG'] . '" " alt="Dish image">';
                ?>
                <!-- <img id="recipeHeroImg" src="media/food/1_chicken.jpg" alt="Hero image"> -->
                <div>
                    <p id="recipeDesc">  
                        <?php
                        echo $oneRecipe['Description'];
                        ?>
                    </p>

                    <!-- We’re amping up chicken breasts with a glaze of smoky ancho chile paste and 
                        fresh orange juice in this recipe. On the side, roasted carrots and lightly creamy, golden 
                        raisin-studded rice perfectly accent the sweetness of the glaze. -->

                    <div id="recipeOverview">
                        <p> <strong>Cook Time:</strong><br> 
                            <?php 
                            echo $oneRecipe['Cook Time'];
                            ?>
                        </p>
                        <p> <strong>Servings:</strong><br> 
                            <?php 
                            echo $oneRecipe['Servings'];
                            ?>
                        </p>
                        <p> <strong>Cal/Serving:</strong><br> 
                            <?php 
                            echo $oneRecipe['Cal/Serving'];
                            ?>
                        </p>
                        <p> <strong>Protein:</strong><br> 
                            <?php 
                            echo $oneRecipe['Proteine'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div>
                <h2> Ingredients </h2>
                <div id="ingredients">
                    <?php
                        function keyExists($oneRecipe, $key) {
                            return isset($oneRecipe[$key]) && !empty($oneRecipe[$key]);
                        };
                        if (keyExists($oneRecipe, 'All Ingredients')) {
                            // Split the ingredients using the asterisk as a delimiter
                            $ingredientsArray = explode('*', $oneRecipe['All Ingredients']);
                        
                            // Trim each ingredient to remove extra whitespaces
                            $ingredientsArray = array_map('trim', $ingredientsArray);
                        
                            // Display the ingredients as list items
                            // if (!empty($ingredientsArray)) {
                                echo '<ul>';
                                foreach ($ingredientsArray as $ingredient) {
                                    echo '<li>' . $ingredient . '</li>';
                                }
                                echo '</ul>';
                            // }
                        } else {
                            echo 'No ingredients available.';
                        }
                    ?>
                    <!-- <ul>
                        <li> 4 boneless, skinless chicken breasts</li>
                        <li> 1 lime</li>
                        <li> 1 tbsp Ancho Chile paste</li>
                        <li> 1 bunch of kale</li>
                        <li> 2 tbsps butter</li>
                        <li> 3/4 cup Jasmine rice</li>
                        <li> 2 cloves of garlic</li>
                        <li> 2 tbsps Crème Fraîche</li>
                        <li> 4 carrots</li>
                        <li> 3 tbsps Golden Raisins</li>
                        <li> 1 orange</li>
                    </ul> -->
                    <?php
                        echo '<img src="./../media/recipe-ingre/'.$oneRecipe['Ingredients IMG'] . '" " alt="All Ingredients">';
                    ?>
                    <!-- <img src="media/dish_1/ingredients.webp" alt="Ingredients"> -->
                </div>
            </div>

            <h2> Instructions</h2>

            <div id="instruct">

                <div class="instructStep">
                    <div>
                        <h3>1. Cook the rice</h3>
                        <p> Place an oven rack in the center of the oven, then preheat to 450°F. In a medium pot, combine the rice, a big pinch of salt, and 1 1/2 cups of water. Heat to boiling on high. Once boiling, cover and reduce the heat to low. Cook 12 to 14 minutes, or until the water has been absorbed and the rice is tender. Turn off the heat and fluff with a fork. Cover to keep warm.</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_1.webp" alt="Step 1">
                </div>

                <div class="instructStep">
                    <div>
                        <h3>2. Prepare the ingredients & make the glaze</h3>
                        <p> While the rice cooks, wash and dry the fresh produce. Peel the carrots; quarter lengthwise, then halve crosswise. Peel and roughly chop the garlic. Remove and discard the stems of the kale; finely chop the leaves. Using a peeler, remove the lime rind, avoiding the white pith; mince to get 2 teaspoons of zest (or use a zester). Halve the lime crosswise. Halve the orange; squeeze the juice into a bowl, straining out any seeds. Whisk in the chile paste and 2 tablespoons of water until smooth.</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_2.webp" alt="Step 2">
                </div>

                <div class="instructStep">
                    <div>
                        <h3>3. Roast the carrots</h3>
                        <p> Place the sliced carrots on a sheet pan. Drizzle with olive oil and season with salt and pepper; toss to coat. Arrange in an even layer. Roast 15 to 17 minutes, or until tender when pierced with a fork. Remove from the oven.</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_3.webp" alt="Step 3">
                </div>

                <div class="instructStep">
                    <div>
                        <h3>4. Cook the kale</h3>
                        <p> While the carrots roast, in a large pan (nonstick, if you have one), heat 2 teaspoons of olive oil on medium-high until hot. Add the chopped garlic and cook, stirring constantly, 30 seconds to 1 minute, or until fragrant. Add the chopped kale; season with salt and pepper. Cook, stirring occasionally, 3 to 4 minutes, or until slightly wilted. Add 1/3 cup of water; season with salt and pepper. Cook, stirring occasionally, 3 to 4 minutes, or until the kale has wilted and the water has cooked off. Transfer to the pot of cooked rice. Stir to combine; season with salt and pepper to taste. Cover to keep warm. Wipe out the pan.</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_4.webp" alt="Step 4">
                </div>

                <div class="instructStep">
                    <div>
                        <h3>5. Cook and glaze the chicken</h3>
                        <p> While the carrots continue to roast, pat the chicken dry with paper towels; season with salt and pepper on both sides. In the same pan, heat 2 teaspoons of olive oil on medium-high until hot. Add the seasoned chicken and cook 4 to 6 minutes on the first side, or until browned. Flip and cook 2 to 3 minutes, or until lightly browned. Add the glaze and cook, frequently spooning the glaze over the chicken, 2 to 3 minutes, or until the chicken is coated and cooked through. Turn off the heat; stir the butter and the juice of 1 lime half into the glaze until the butter has melted. Season with salt and pepper to taste.</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_5.webp" alt="Step 5">
                </div>

                <div class="instructStep">
                    <div>
                        <h3>6. Finish the rice and serve your dish</h3>
                        <p> To the pot of cooked rice and kale, add the lime zest, crème fraîche, raisins, and the juice of the remaining lime half. Stir to combine; season with salt and pepper to taste. Serve the glazed chicken with the finished rice and roasted carrots. Top the chicken with the remaining glaze from the pan. Enjoy!</p>
                    </div>
                    <img class="stepImg" src="media/dish_1/step_6.webp" alt="Step 6">
                </div>

            </div>
            <a class="view-button" id="recipeReturnButton" href=""> Return to Home </a>
        </main>

        <footer>
            <img id="logo-footer" src="media/logo_footer.png" alt="Logo footer">
            <p id="copyright"> © 2023 Kaylie Nguyen </p>
        </footer>

    </body>

</html>