<?php
require '../db/db.php';

$db = new database();

$gerechtsoort = $db->getGerechtCategorien();
$curr_menu = $db->getMenuDetail($_GET['id']);

if (isset($_POST['submit'])) {
    $fieldnames = ['code', 'naam', 'prijs', 'soort'];

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
                                <?php foreach ($gerechtsoort as $categorie): ?>
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
                            <label for="prijs">prijs</label>
                            <input type="number" name="prijs" id="prijs" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>