<?php include('nav.php'); ?>

<!-- Start Register Area -->
<div class="register-area pt-100 pb-70">
    <div class="container">
        <div class="register">
            <h3>Inscription</h3>
            <form method="post" action="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email*" name="email" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Nom*" name="nom" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <input type="text" id="lname" class="form-control" placeholder="Prénom*" name="prenom" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" id="password2" class="form-control" placeholder="Mot de passe*" name="mot_de_passe" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" id="password3" class="form-control" placeholder="Confirmer le mot de passe*" name="confirm_mot_de_passe" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="default-btn btn active">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
<!-- End Register Area -->

<?php include('footer.php'); ?>
