<?php 
    session_start();
    require_once 'config.php';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <title>Accueil</title>
        </head>
    <body>


    <?php 
        if(isset($_SESSION['user']))
        { 
        
            $r = $bdd->prepare('SELECT * FROM tutoformulaire WHERE email = ?');
            $r->execute(array($_SESSION['user']));
            $data = $r->fetch();
    ?>

    <div class="container text-center">
                    <br>
                    <h1>Accueil</h1>
                    <br>
                    <div class="text-center">
                        <h3>Bonjour ! <?php echo $data['nom']." ".$data['prenom']; ?></h3>
                    </div>
                    <br> 
                    <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
            </div>

    <?php 
        }
        else 
        {   
    ?>
            <div class="container text-center">
                <br>
                <h1>Accueil</h1>
                <br>
                <div class="btn-choice">
                    <div class="connexion">
                        <a href="connexion.php" class="btn btn-primary btn-lg">Connexion</a>
                    </div>
                   
                    <div class="inscription">
                        <a href="inscription.php" class="btn btn-primary btn-lg">Inscription</a>
                    </div>
                </div>
        </div>    
    
    
    <?php 
    }
    ?>



    <style>
        .btn-choice 
        {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 10px !important;
        }
        .connexion 
        {
            margin: 10px !important;
        }
    </style>




    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>