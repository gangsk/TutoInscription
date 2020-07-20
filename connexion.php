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
            <title>Connexion</title>
        </head>
        <body>
            <div class="container">
                <h1 class="py-3">Connexion</h1>
                <div class="text-center">
                    <?php 
                    if(isset($_POST['email']) && isset($_POST['password']) )
                    {
                        $email = htmlspecialchars($_POST['email']);
                        $password = htmlspecialchars($_POST['password']);

                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {

                                    $check = $bdd->prepare('SELECT email, password FROM tutoformulaire WHERE email = ?');
                                    $check->execute(array($email));
                                    $data = $check->fetch();
                                    $row = $check->rowCount();
                                    
                                    if($row == 1)
                                    {
                                        $password = hash('sha256', $password);

                                        if($password == $data['password'])
                                        {
                                            $_SESSION['user'] = $email;
                                            header('Location:index.php');
                                        }
                                        else 
                                            echo "Mot de passe incorrect";
                                        
                                    }
                                    else 
                                        echo "Ce compte n'existe pas !";
                                
                            }
                            else 
                                echo "Email non valide !";
                        
                    }
                ?>
                </div>
                <br>
                <div class="form-group">
                    <form action="" method="POST">
                        <input type="email" name="email" class="form-control" placeholder="Votre email" autocomplete="off" required>
                        <br>
                        <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" autocomplete="off" required>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success">Connexion</button>
                    </form>
                </div>
            </div>

        </body>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>