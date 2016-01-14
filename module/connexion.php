<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Connexion à votre compte</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="">
                    <div class="input-group" style="padding-bottom: 15px;">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" class="form-control" id="login_user" placeholder="Nom d'utilisateur" required="">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" id="pwd_user" placeholder="Mot de passe" required="">
                    </div>
                    <br />
                    <input type="button" class="btn btn-primary" value="Connexion" onclick="connexion()">
                </form>
                <a href="mot-de-passe-oublie" type="button" class="btn btn-link"><i class="fa fa-eraser"></i> Mot de passe oublié?</a>
            </div>
            <div class="modal-footer">

                <a href="" onclick="javascript:hidelogin();" data-toggle="modal" data-target="#modal-register" type="button" class="btn btn-block btn-facebook btn-social"><i class="fa fa-lock"></i> Créer mon compte</a>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                <h4 class="modal-title" id="exampleModalLabel">Inscription</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="">
                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="lastname" placeholder="Nom" required="">
                    </div>
                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="firstname" placeholder="Prénom" required="">
                    </div>
                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input type="email" class="form-control" id="email" placeholder="Email" required="">
                    </div>
                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" id="pwd_user" placeholder="Mot de passe" required="">
                    </div>
                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" id="pwd_user_conf" placeholder="Confirmation mot de passe" required="">
                    </div>

                    <div class="input-group" style="padding-bottom: 10px;">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" id="mobilephone" placeholder="Téléphone mobile" required="">
                    </div>
                    <br />
                    <input type="button" class="btn btn-success" value="M'inscrire!" onclick="inscription()">
<<<<<<< HEAD
                    <input type="submit" class="btn btn-warning" value="Fermer" onclick="javascript:annuler()">
=======
                    
>>>>>>> origin/master

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>