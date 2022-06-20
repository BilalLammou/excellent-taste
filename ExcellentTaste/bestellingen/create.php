<?php
require '../db/db.php';

$db = new database();
$reserveringen = $db->getReserveringen();
$menuitems = $db->getMenuitems();

if (isset($_POST['submit'])) {
    $fieldnames = ['aantal', 'geserveerd', 'reservering', 'menuitem'];

    $error = false;

    foreach ($fieldnames as $fieldname) {
        if (empty($_POST[$fieldname])) {
            $error = true;
        }
    }

    if (!$error) {
        $db->createBestelling($_POST['geserveerd'], $_POST['reservering'], $_POST['menuitem'], $_POST['aantal']);
    }

}
?>
<?php
require '../header.php';
?>
 <div class="container">
        <div class="card mt-5">
            <div class="cardheader">
                <h2>Bestelling toevoegen</h2>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="naam">aantal</label>
                            <input type="text" name="aantal" id="naam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="geserveerd">geserveerd</label>
                            <select name="geserveerd">
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="reservering">Tafel</label>
                            <select name="reservering"> 
                                <?php foreach ($reserveringen as $reservering): ?>
                                    <option value="<?php echo $reservering['reserveringsId']; ?>"><?php echo $reservering['tafel']; ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="menuitem">Menuitem</label>
                            <select name="menuitem"> 
                                <?php foreach ($menuitems as $menuitem): ?>
                                    <option value="<?php echo $menuitem['id']; ?>"><?php echo $menuitem['naam']; ?></option>
                                <?php endforeach; ?> 
                            </select>
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