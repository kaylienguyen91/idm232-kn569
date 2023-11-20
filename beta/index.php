<!DOCTYPE html>

<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="recipe-detail-page/styles.css">
        <!-- <link rel="icon" type="image/x-icon" href="portfolio-assets/logo 32x32.png"> -->
        <title> NomNomNerd - Recipe Detail </title>
    </head>

    <body id="recipeDetailPage">

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
            <img id="logo" src="media/logo.png" alt="Logo">
            
            <h1> 
                <?php 
                    $recipe_id = $_GET['id'];  
                    // if (isset($_GET['id'])) {
                        // Retrieve recipe data based on ID from the URL
                        $recipe_id = 10;
                        $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                        $results = mysqli_query($db_connection, $query);
                        while ($oneRecipe = mysqli_fetch_array($results)) {
                            echo $oneRecipe['Title'];
                        };
                    // };
                ?>
            <br><span class="recipePageSubtitle">
                <?php 
                    // if (isset($_GET['id'])) {
                        // $recipe_id = $_GET['id'];
                        $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                        $results = mysqli_query($db_connection, $query);
                        while ($oneRecipe = mysqli_fetch_array($results)) {
                            echo $oneRecipe['Subtitle'];
                        };
                    // };
                ?>
            </span> </h1>
            
        </header>

        <main>
            <div id="recipeIntro">
                <!-- <img id="recipeHeroImg" src="media/food/1_chicken.jpg" alt="Hero image"> -->

                <?php
                //  if (isset($_GET['id'])) {
                    // $recipe_id = $_GET['id'];
                    $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                    $results = mysqli_query($db_connection, $query);
                    while ($oneRecipe = mysqli_fetch_array($results)) {
                        echo '<img id="recipeHeroImg" src="./media/food/'.$oneRecipe['Main IMG'] . '" " alt="Dish image">';
                    };
                // };
                ?>

                <div>
                    <p id="recipeDesc"> 
                        <?php
                        //    if (isset($_GET['id'])) {
                            // $recipe_id = $_GET['id'];
                            $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                            $results = mysqli_query($db_connection, $query);
                            while ($oneRecipe = mysqli_fetch_array($results)) {
                                echo $oneRecipe['Description'];
                            };
                        // };
                        ?>
                    </p>

                    <div id="recipeOverview">
                        <p> <strong>Cook Time:</strong><br> 
                            <?php 
                            // if (isset($_GET['id'])) {
                                // $recipe_id = $_GET['id'];
                                $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                                $results = mysqli_query($db_connection, $query);
                                while ($oneRecipe = mysqli_fetch_array($results)) {
                                    echo $oneRecipe['Cook Time'];
                                };
                            // };
                            ?>
                        </p>
                        <p> <strong>Servings:</strong><br> 
                            <?php
                            //   if (isset($_GET['id'])) {
                                // $recipe_id = $_GET['id'];
                                $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                                $results = mysqli_query($db_connection, $query);
                                while ($oneRecipe = mysqli_fetch_array($results)) {
                                    echo $oneRecipe['Servings'];
                                // };
                            };
                            ?>
                        </p>
                        <p> <strong>Cal/Serving:</strong><br>
                            <?php 
                            //  if (isset($_GET['id'])) {
                                // $recipe_id = $_GET['id'];
                                $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                                $results = mysqli_query($db_connection, $query);
                                while ($oneRecipe = mysqli_fetch_array($results)) {
                                    echo $oneRecipe['Cal/Serving'];
                                };
                            // };
                            ?>
                        </p>
                        <p> <strong>Protein:</strong><br>
                            <?php 
                            //  if (isset($_GET['id'])) {
                                // $recipe_id = $_GET['id'];
                                $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                                $results = mysqli_query($db_connection, $query);
                                while ($oneRecipe = mysqli_fetch_array($results)) {
                                    echo $oneRecipe['Proteine'];
                                };
                            // };
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div>
                <h2> Ingredients </h2>
                <div id="ingredients">
                    
                    <?php
                    // if (isset($_GET['id'])) {
                        // $recipe_id = $_GET['id'];
                        $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                        $results = mysqli_query($db_connection, $query);
                        while ($oneRecipe = mysqli_fetch_array($results)) {
             
            
                    function keyExists($oneRecipe, $key) {
                        return isset($oneRecipe[$key]) && !empty($oneRecipe[$key]);
                      };
                    if (keyExists($oneRecipe, 'All Ingredients')) {
                        $ingredientsArray = explode('*', $oneRecipe['All Ingredients']);
                    
                        // Trim each ingredient to remove extra whitespaces
                        $ingredientsArray = array_map('trim', $ingredientsArray);
                            echo '<ul>';
                            foreach ($ingredientsArray as $ingredient) {
                                echo '<li>' . $ingredient . '</li>';
                            }
                            echo '</ul>';
                    } else {
                        echo 'No ingredients available.';
                    }           
                 }; 
                // }
                    ?>

                    <?php
                    //   if (isset($_GET['id'])) {
                        // $recipe_id = $_GET['id'];
                        $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                        $results = mysqli_query($db_connection, $query);
                        while ($oneRecipe = mysqli_fetch_array($results)) {
                            echo '<img src="./media/recipe-ingre/'.$oneRecipe['Ingredients IMG'] . '" " alt="All Ingredients">';
                        };
                    // };
                    ?>
                </div>
            </div>

            <h2> Instructions</h2>

            <div id="instruct">

                <?php
                // if (isset($_GET['id'])) {
                    // $recipe_id = $_GET['id'];
                    $query = "SELECT * FROM Recipes WHERE id = $recipe_id ";
                    $results = mysqli_query($db_connection, $query);
                    while ($oneRecipe = mysqli_fetch_array($results)) {
        
                        $originalSteps2 = explode('*', $oneRecipe['All Steps']);
                        $stepImgsArray = explode("*", $oneRecipe['Step IMGs']);
                    // echo '<p> Number of steps is' . count($originalSteps2) .' </p>';
                        for($lp = 0; $lp < count($originalSteps2 ); $lp++) {
                            $firstChar = substr($originalSteps2[$lp], 0, 1);
                        
                            // echo '<p> this is the first character' . $firstChar . '</p>';
                            if (is_numeric($firstChar)){
                                echo '<div class="instructStep">';
                                echo '<div>';
                                echo '<h3> Step ' . $originalSteps2[$lp] . '</h3>';
                                echo '<p>' . $originalSteps2[$lp+1] . '</p>';
                                echo '</div>';
                                echo '<img class="stepImg" src="./media/recipe-steps/' . $stepImgsArray[$firstChar-1] . '" alt="Dish image">';
                                echo '</div>';
                            }
                        
                        }

                    };
                ?>

            </div>
            <a class="view-button" id="recipeReturnButton" href=""> Return to Home </a>
        </main>

        <footer>
            <img id="logo-footer" src="media/logo_footer.png" alt="Logo footer">
            <p id="copyright"> © 2023 Kaylie Nguyen </p>
        </footer>

    </body>

</html>