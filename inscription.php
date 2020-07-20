<?php 
    require_once 'config.php';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <title>Inscription</title>
        </head>
        <body>
            <div class="container">
                <h1 class="py-3">Inscription</h1>
                <div class="text-center">
                    <?php 
                    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat']))
                    {
                        $nom = htmlspecialchars($_POST['nom']);
                        $prenom = htmlspecialchars($_POST['prenom']);
                        $email = htmlspecialchars($_POST['email']);
                        $password = htmlspecialchars($_POST['password']);
                        $password_r = htmlspecialchars($_POST['password_repeat']);

                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                if($password == $password_r)
                                {
                                    $check = $bdd->prepare('SELECT email FROM tutoformulaire WHERE email = ?');
                                    $check->execute(array($email));
                                    $row = $check->rowCount();
                                    
                                    if($row == 0)
                                    {
                                        $password = hash('sha256', $password);

                                        $d = date('d/m/Y');
                                        $h = date('h:i');
                                        $date = $d." ".$h;

                                        $nom = strtoupper($nom);

                                        $insert = $bdd->prepare('INSERT INTO tutoformulaire (nom, prenom, email, password, ip, date_inscription) VALUES (?, ?, ?, ?, ?, ?)');
                                        $insert->execute(array($nom, $prenom, $email, $password, $_SERVER['REMOTE_ADDR'], $date));
                                        echo "Inscription effectuée avec succès ! vous pouvez vous connecter";
                                        
                                    }
                                    else 
                                        echo "Compte deja existant";
                                
                                }   
                                else 
                                    echo "Mot de passe pas bon";
                            }
                            else 
                                echo "Email non valide !";
                        
                    }
                ?>
                </div>
                <br>
                <div class="form-group">
                    <form action="" method="POST">
                        <input type="text" name="nom" class="form-control" placeholder="Votre nom" autocomplete="off" required>
                        <br>
                        <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" autocomplete="off" required>
                        <br>
                        <input type="email" name="email" class="form-control" placeholder="Votre email" autocomplete="off" required>
                        <br>
                        <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" autocomplete="off" required>
                        <br>
                        <input type="password" name="password_repeat" class="form-control" placeholder="Re-tapez votre mot de passe" autocomplete="off" required>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success">Inscription</button>
                    </form>
                </div>
            </div>

        </body>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>