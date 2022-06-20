<?php
require '../db/db.php';

$db = new database();
$reservering =  $db->getReservering($_GET['id']);
$klanten = $db->getKlanten();
$klant = $db->getKlant($reservering['klant_id']);

if (isset($_POST['submit'])) {
    $fieldnames = ['tafel', 'datum', 'tijd', 'klant_id', 'aantal', 'status', 'aantal_k', 'allergien', 'opmerkingen'];
    $fieldnamesNumeric = ['aantal', 'aantal_k', 'tafel', 'klant_id', 'status'];

    $error = false;

    foreach ($fieldnames as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            $error = true;
        }
    }

    foreach ($fieldnamesNumeric as $fieldname) {
        if ($_POST[$fieldname] == 0) {
            $error = false;
        }
    }

    if (!$error) {
        $db->updateReservering($_GET['id'], $_POST['tafel'], $_POST['datum'], $_POST['tijd'], $_POST['klant_id'], $_POST['aantal'], $_POST['aantal_k'], $_POST['status'], $_POST['allergien'], $_POST['opmerkingen']);
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
                <h2>update</h2>
                <div class="card-body">
                    <?php if (!empty($message)):  ?>
                        <div class="alert alert-succes">
                            <?= $message; ?>
                        </div>
                        <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="tafel">tafel</label>
                            <input type="text" name="tafel" value="<?php echo $reservering['tafel'] ?>" id="tafel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="datum">datum</label>
                            <input type="date" name="datum" value="<?php echo $reservering['datum'] ?>" id="datum" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tijd">tijd</label>
                            <input type="time" name="tijd" value="<?php echo $reservering['tijd'] ?>" id="tijd" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="klant_id">klantnaam</label>
                            <select name="klant_id">
                                <option value="<?php echo $reservering['klant_id']; ?>" selected><?php echo $klant['naam']; ?></option>
                                <hr>
                                <?php foreach ($klanten as $klant): ?>
                                    <option value="<?= $klant['id']; ?>"><?php echo $klant['naam']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="aantal">aantal</label>
                            <input type="text" name="aantal" value="<?php echo $reservering['aantal_personen']; ?>" id="aantal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">status</label>
                            <input type="text" name="status" value="<?php echo $reservering['status']; ?>" id="status" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="aantal_k">aantal_k</label>
                            <input type="text" name="aantal_k" value="<?php echo $reservering['aantal_kinderen']; ?>" id="aantal_k" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="allergieen">allergieen</label>
                            <input type="text" name="allergien" value="<?php echo $reservering['allergien']; ?>" id="allergieen" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="opmerkingen">opmerkingen</label>
                            <input type="text" name="opmerkingen" value="<?php echo $reservering['opmerkingen']; ?>" id="opmerkingen" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>