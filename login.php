<?php include('nav.php'); ?>

<!-- Start Login Area -->
<div class="login-area pt-100 pb-70">
    <div class="container">
        <div class="login">
            <h3>Connexion</h3>
            <form method="post" action="traitement_login.php">
                <div class="form-group">
                    <label for="email">Adresse e-mail </label>
                    <input type="email" id="email" class="form-control" placeholder="Adresse e-mail ou Nom d'utilisateur*" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" class="form-control" placeholder="Mot de passe*" name="mot_de_passe" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember_me" id="flexCheckDefault" value="1">
                    <label class="form-check-label" for="flexCheckDefault">
                        Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="default-btn btn active">Se connecter</button>
                <a href="recover-password.html">Mot de passe oublié ?</a>
            </form>
        </div>
    </div>
</div>
<!-- End Login Area -->

<?php include('footer.php'); ?>
