<?php
session_start();

if(isset($_SESSION["user"])){
    header("Location: index.php");
}


if(!empty($_POST)){
    require 'config/mysql_connect.php';

    $errors = [];

    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
        $errors["fields"] =  "Merci de remplir tout les champs !";
    }

    if(empty($errors)){

        $reqUser = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $reqUser->execute([
           ':username' => $_POST['username'],
        ]);
        $resUser = $reqUser->fetch();

        if(password_verify($_POST['password'], $resUser->password)){

            $_SESSION['user'] = $resUser;
            header('location: index.php');
            exit();

        }
    }

}

?>

<?php include 'inc/head.php'; ?>
    <div class="container">

        <h1>Connexion</h1>

        <pre>
            <b>Utilisateur de test :</b>
                [
                    "Pseudo => "bobby",
                    "MotDePasse" => "lolilol"
                ]
        </pre>

        <?= (!empty($errors) ? "<div class='alert alert-danger'>Utilisateur inconnu.</div>" : ""); ?>

        <form method="POST" action="">

            <div class="form-group">
                <label for="username">Votre pseudo :</label>
                <input type="text" name="username" class="form-control" placeholder="Votre pseudo">
            </div>

            <div class="form-group">
                <label for="password">Votre mot de passe :</label>
                <input type="password" name="password" class="form-control" placeholder="Votre mot de passe">
            </div>

            <button type="submit" class="btn btn-warning">Connexion</button>

        </form>

    </div>

<?php include 'inc/foot.php'; ?>