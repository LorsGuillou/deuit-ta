<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Contact</h1>
        <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 0)) : ?>
            <h2>Contactez-nous</h2>
            <p>Un problème avec le site ? Une idée à nous proposer ? Dites-nous tout !</p>
            <form>
                
            </form>
        <?php else : ?>    
            <section id="contact-info">
                <h2>Vous souhaitez nous contacter ?</h2>
                <p>Pour cela, vous pouvez <a href="index.php?action=register">créer un compte</a> ou, si vous en avez déjà un, <a href="index.php?action=login">vous connectez</a> pour pouvoir remplir le formulaire de contact.</p>
            </section>
        <?php endif ?>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>