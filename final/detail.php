<!DOCTYPE html>

<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="recipe-detail-page/styles.css">
        <link rel="icon" type="image/x-icon" href="media/logo.png">
        <title> NomNomNerd - Recipe Detail </title>
    </head>

    <body id="recipeDetailPage">

        <?php
            require_once './includes/fun.php';
            consoleMsg("PHP to JS .. is Wicked FUN");

            // Include env.php that holds global vars with secret info
            require_once './env.php';

            // Include the database connection code
            require_once './includes/database.php';

        ?>

        <header>
            <img id="logo" src="media/logo.png" alt="Logo">
            
            
        </header>

        <main>
            <?php
                // Get all the recipes from "recipes" table in the "idm232" database
                $recID = $_GET['id'];
                $query = "SELECT * FROM recipes WHERE id = $recID";
                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                    consoleMsg("Query successful! number of rows: $results->num_rows");
                    while ($oneRecipe = mysqli_fetch_array($results)) {

                        //TITLE + SUBTITLE
                        echo '<h1> ' .$oneRecipe['Title']. '<br><span class="recipePageSubtitle">' .$oneRecipe['Subtitle']. '</span></h1>'; 
                        
                        echo '<div id="recipeIntro">';

                        // HERO IMAGE
                        echo '<img id="recipeHeroImg" src="./media/food/'.$oneRecipe['Main IMG'] . '" alt="Dish image">';

                        echo '<div>';

                        // DESCRIPTION
                        echo '<p id="recipeDesc"> ' . $oneRecipe['Description'] . '</p>';

                        echo '<div id="recipeOverview">';

                        // COOKTIME
                        echo '<p> <strong>Cook Time:</strong><br> ' . $oneRecipe['Cook Time'] . '</p>';
                        
                        // SERVINGS
                        echo '<p> <strong>Servings:</strong><br> ' . $oneRecipe['Servings'] . '</p>';
                        
                        // NUTRITION
                        echo '<p> <strong>Cal/Serving:</strong><br> ' . $oneRecipe['Cal/Serving'] . '</p>';

                        // PROTEIN
                        echo '<p> <strong>Protein:</strong><br> ' . $oneRecipe['Proteine'] . '</p>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div>';
                        echo '<h2> Ingredients </h2>';
                        echo '<div id="ingredients">';

                        // $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
                        // echo '<p> Ingredients Array: ' . $ingredientsArray[1]  .  '</p>'; 

                        // echo '<ul>';
                        // for($lp = 0; $lp < count($ingredientsArray); $lp++) {
                        //     echo '<li>' . $ingredientsArray[$lp] . '</li>';
                        // }
                        // echo '<ul>';

                        
                        $ingredientsArray = explode('*', $oneRecipe['All Ingredients']);
                    
                        // Trim each ingredient to remove extra whitespaces
                        $ingredientsArray = array_map('trim', $ingredientsArray);
                            echo '<ul>';
                            foreach ($ingredientsArray as $ingredient) {
                                echo '<li>' . $ingredient . '</li>';
                            }
                            echo '</ul>';


                        echo '<img src="./media/recipe-ingre/'.$oneRecipe['Ingredients IMG'] . '" alt="All Ingredients">';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<h2> Instructions</h2>';
                        echo '<div id="instruct">';
                        
                        $originalSteps2 = explode('*', $oneRecipe['All Steps']);
                        $stepImgsArray = explode("*", $oneRecipe['Step IMGs']);
                    // echo '<p> Number of steps is' . count($originalSteps2) .' </p>';
                        for($lp = 0; $lp < count($originalSteps2 ); $lp++) {
                            $firstChar = substr($originalSteps2[$lp], 0, 1);
                        
                            // echo '<p> this is the first character' . $firstChar . '</p>';
                            if (is_numeric($firstChar)){
                                echo '<div class="instructStep">';
                                echo '<div>';
                                echo '<h3>' . $originalSteps2[$lp] . '</h3>';
                                echo '<p>' . $originalSteps2[$lp+1] . '</p>';
                                echo '</div>';
                                echo '<img class="stepImg" src="./media/recipe-steps/' . $stepImgsArray[$firstChar-1] . '" alt="Dish image">';
                                echo '</div>';
                            }
                        
                        }

                        echo '</div>';
                
                    }

                } else {
                    consoleMsg("QUERY ERROR");
                }
            ?>

            <a class="view-button" id="recipeReturnButton" href="index.php"> Return to Home </a>
        </main>

        <footer>
            <img id="logo-footer" src="media/logo_footer.png" alt="Logo footer">
            <p id="copyright"> © 2023 Kaylie Nguyen </p>
        </footer>

    </body>

</html>