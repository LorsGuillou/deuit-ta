<?php include_once ('app/Views/front/layout/header.php') ?>

    <main class="container">
        <h1>Bonjour,  <?= $_SESSION['firstname'] ?> ! <span class="txt-bzh">Demat deoc'h, <?= $_SESSION['firstname'] ?> !</span></h1>
        <form action="editAccount" method="post" enctype="multipart/form-data">
            <p>
                <input type="file" id="edit-avatar" name="image">
            </p>
            <p>
                <button type="submit" id="submit-edit" class="submit">Envoyer</button>
            </p>
        </form>
    </main>

<?php include_once ('app/Views/front/layout/footer.php') ?>