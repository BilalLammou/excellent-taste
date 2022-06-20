<?php
require '../db/db.php';

$db = new database();

$curr_bestelling = $db->getBestelling($_GET['id']);
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
        $db->updateBestelling($_GET['id'] ,$_POST['geserveerd'], $_POST['aantal'], $_POST['reservering'], $_POST['menuitem']);
    }

}
?>
<?php
require '../header.php';

?>
 <div class="container">
        <div class="card mt-5">
            <div class="cardheader">
                <h2>Bestelling wijzigen</h2>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="naam">aantal</label>
                            <input type="text" name="aantal" value="<?php echo $curr_bestelling['aantal']; ?>" id="naam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="geserveerd">geserveerd</label>
                            <select name="geserveerd">
                                <option value="<?php echo $curr_bestelling['geserveerdnr']; ?>" selected><?php echo $curr_bestelling['geserveerd']; ?></option>
                                <hr>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="reservering"></label>
                            <select name="reservering"> 
                                <option value="<?php echo $curr_bestelling['reserveringId']; ?>" selected><?php echo $curr_bestelling['tafel'].' '.$curr_bestelling['datum'].' '.$curr_bestelling['tijd']; ?></option>
                                <?php foreach ($reserveringen as $reservering): ?>
                                    <option value="<?php echo $reservering['reserveringsId']; ?>"><?php echo $reservering['naam']; ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="menuitem"></label>
                            <select name="menuitem"> 
                                <option value="<?php echo $curr_bestelling['menuitemId']; ?>" selected><?php echo $curr_bestelling['naam']; ?></option>
                                <?php foreach ($menuitems as $menuitem): ?>
                                    <option value="<?php echo $menuitem['id']; ?>"><?php echo $menuitem['naam']; ?></option>
                                <?php endforeach; ?> 
                            </select>
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