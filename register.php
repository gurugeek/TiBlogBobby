<?php
require 'config/mysql_connect.php';

if(!empty($_POST)){

    $errors = [];

    if(empty(trim($_POST["username"]))) {
        $errors["username"] = "Merci de mettre un pseudo valide !";
    }

    if(empty(trim($_POST["email"]) || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
            $errors["email"] = "Merci de mettre un email valide !";
    }

    if(empty(trim($_POST["password"]) || $_POST['password'] != $_POST['password_confirm'])){
            $errors["password"] = "Merci de mettre un mot de passe valide !";
    }

    if(empty($errors)){

        $req = $pdo->prepare("INSERT INTO users SET username = :username, email = :email, password = :password");
        $req->execute([
            ':username' => strip_tags($_POST['password']),
            ':email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ]);

        header("Location: login.php");
        exit();

    }

}

?>

<?php include 'inc/head.php'; ?>

    <div class="container">

        <h1>Inscription :</h1>

        <form method="POST" action="">

            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <ul>
                        <li><?= $error; ?></li>
                    </ul>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Votre pseudo :</label>
                <input type="text" name="username" class="form-control" placeholder="Votre pseudo">
            </div>

            <div class="form-group">
                <label for="email">Votre email :</label>
                <input type="email" name="email" class="form-control" placeholder="Votre email">
            </div>

            <div class="form-group">
                <label for="email">Votre mot de passe :</label>
                <input type="password" name="password" class="form-control" placeholder="Votre mot de passe">
            </div>

            <div class="form-group">
                <label for="email">Votre mot de passe (confirmation) :</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Votre mot de passe">
            </div>

            <button type="submit" class="btn btn-success">S'inscrire</button>

        </form>

    </div>


<?php include 'inc/foot.php'; ?>
