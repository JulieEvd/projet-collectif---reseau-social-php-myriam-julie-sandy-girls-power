<?php include("connexion.php"); ?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <?php include('header.php'); ?>
        <div id="wrapper">          
            <aside>
                <img src = "clara.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET["user_id"]) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                include('connexionbdd.php'); 
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                
                while ($post = $lesInformations->fetch_assoc())
                {
                
                ?>
                <article>
                    <img src="clara.jpg" alt="blason"/>
                    <h3><a href="wall.php?user_id=<?php echo $post['id'] ?>"><?php echo $post["alias"] ?></a></h3>
                    <p><?php echo $post["id"] ?></p>
                </article>

                <?php } ?>
            </main>
        </div>
    </body>
</html>
