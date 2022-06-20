<?php
require '../db/db.php';

$db = new database();

$categorien = $db->getGerechtCategorien();

if (isset($_POST['submit'])) {
    $fieldnames = ['code', 'naam', 'prijs', 'categorie'];

    $error = false;

    foreach ($fieldnames as $fieldname) {
        if (empty($_POST[$fieldname])) {
            $error = true;
        }
    }

    if (!$error) {
        $db->createMenu($_POST['code'], $_POST['naam'], $_POST['prijs'], $_POST['categorie']);
    }
}
?>
<?php
require '../header.php';
?>
    <div class="container">
        <div class="card mt-5">
            <div class="cardheader">
                <h2>Menuitem</h2>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="naam">Naam</label>
                            <input type="text" name="naam" id="naam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="categorie">Categorie</label>
                            <select name="categorie">
                                <?php foreach ($categorien as $categorie): ?>
                                    <option value="<?= $categorie['id']; ?>"><?= $categorie['naam']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <select name="code">
                                <option value="bar">bar</option>
                                <option value="kok">kok</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="aantal">aantal</label>
                            <input type="number" name="prijs" id="prijs" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>