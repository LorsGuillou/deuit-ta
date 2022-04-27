<?php include_once ('app/Views/front/layout/header.php') ?>


    <main id="register" class="container">
        <h1>Créez votre compte <span class="txt-bzh">Krouat ho kont</span></h1>
        <section id="register-page" class="input-page">
            <h2>Identifiants <span class="txt-bzh">Anaouderioù</span></h2>
            <?= $alert ?>
            <form action="createUser" method="post" enctype="multipart/form-data">
                <p>
                    <input type="text" id="lastname" name="lastname" placeholder="Nom">
                </p>
                <p>
                    <input type="text" id="firstname" name="firstname" placeholder="Prénom">
                </p>
                <p>
                    <label for="image">Image de profil : </label>
                    <input type="file" id="avatar" name="image">
                </p>
                <p>
                    <input type="mail" id="mail" name="mail" placeholder="Email">
                </p>
                <p class="pswdSpace">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, 1 chiffre, 1 lettre majuscule et 1 lettre minuscule.">
                    <i class="fa-solid fa-eye" id="togglePswd"></i>
                </p>
                <div id="pswdMessage">
                    <p>Le mot de passe doit contenir :</p>
                    <p id="pswdLength" class="invalid">Au moins 8 caractères</p>
                    <p id="pswdNumber" class="invalid">Un chiffre</p>
                    <p id="pswdUpper" class="invalid">Une lettre majuscule</p>
                    <p id="pswdLower" class="invalid">Une lettre minuscule</p>
                </div>
                <p class="pswdSpace">
                    <input type="password" id="confirmPswd" name="confirmPswd" placeholder="Confirmer le mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                    <i class="fa-solid fa-eye" id="toggleConfirm"></i>
                </p>
                <p>
                    <label for="rgpd">RGPD</label>
                    <input type="checkbox" id="rgpd" name="rgpd">
                </p>
                <p>
                    <button type="submit" id="submit-register" class="submit">Envoyer</button>
                    <button type="reset" id="reset-register" class="reset">Effacer</button>
                </p>
            </form>
        </section>
    </main>


<?php include_once ('app/Views/front/layout/footer.php') ?>