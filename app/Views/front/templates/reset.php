<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Réinitialiser votre mot de passe</h1>
            <section class="input-page">
                <h2>Un mot de passe va vous être envoyés par mail</h2>
                <?= $alert ?>
                <form>
                    <p>
                        <input type="email" id="reset-mail" name="reset-mail" placeholder="Email">
                    </p>
                    <p>
                        <button type="submit" id="reset-submit" class="submit">Envoyer</button>
                    </p>
                </form>
            </section>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>