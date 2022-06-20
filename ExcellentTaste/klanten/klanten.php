<?php
require '../db/db.php';

if (isset($_POST['submit'])) {
    $fieldnames = ['naam', 'telefoon', 'email'];

    $error = false;

    foreach ($fieldnames as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            $error = true;
        }
    }

    if (!$error) { 
        $db = new database();
        $db->insertKlant($_POST['naam'], $_POST['telefoon'], $_POST['email']);
    } else {
        echo '<div class="alert alert-danger" role="alert"> Er is instertien gefaald </div>';
    }
}
?>

<?php
require '../header.php';
?>
    <div class="container">
        <div class="card mt-5">
            <div class="cardheader">
                <h2>Klant toevoegen</h2>
                <div class="card-body">
                    <?php if (!empty($message)):  ?>
                        <div class="alert alert-succes">
                            <?= $message; ?>
                        </div>
                        <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="naam">naam</label>
                            <input type="text" name="naam" id="naam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefoon">telefoon</label>
                            <input type="text" name="telefoon" id="telefoon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="txt" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">Voeg toe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>