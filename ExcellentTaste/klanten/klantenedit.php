<?php
require '../db/db.php';

$db = new database();

$klant = $db->getKlant($_GET['id']);

if (isset($_POST['submit'])) {
    $fieldnames = ['naam', 'telefoon', 'email'];

    $error = false;

    foreach ($fieldnames as $fieldname) {
        if (empty($_POST[$fieldname])) {
            $error = true;
        }
    }

    if (!$error) {
        $db->updateKlant($_GET['id'], $_POST['naam'], $_POST['telefoon'], $_POST['email']);
    }
}

?>

<?php
require '../header.php';
?>
    <div class="container">
        <div class="card mt-5">
            <div class="cardheader">
                <h2>Wijzig klant gegevens</h2>
                <div class="card-body">
                    <?php if (!empty($message)):  ?>
                        <div class="alert alert-succes">
                            <?= $message; ?>
                        </div>
                        <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="naam">naam</label>
                            <input type="text" name="naam" id="naam" value="<?php echo $klant['naam'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefoon">telefoon</label>
                            <input type="text" name="telefoon" id="telefoon" value="<?php echo $klant['telefoon'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email" value="<?php echo $klant['email'] ?>" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">Wijzig</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>