<?php
require '../db/db.php';

$db = new database();

$reserveringen = $db->getReserveringen();
?>

<?php
require '../header.php';
?>
    <div class="container">
        <a href="./reserveringen.php" class="btn btn-success mt-5">Reserveren</a>
        <div class="card mt-5">
            <div class="card-header">
                <h2>reserveringsoverzicht</h2>

            </div>
            <div class="card-body">
                <table class="tabe table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>tafel</th>
                        <th>datum</th>
                        <th>tijd</th>
                        <th>klantnaam</th>
                        <th>aantal</th>
                        <th>status</th>
                        <th>aantal_k</th>
                        <th>allergieen</th>
                        <th>opmerkingen</th>
                        
                    </tr>
                    <?php foreach($reserveringen as $reservering): ?>
                    <tr>
                        <td><?= $reservering['reserveringsId']; ?></td>
                        <td><?= $reservering['tafel']; ?></td>
                        <td><?= $reservering['datum']; ?></td>
                        <td><?= $reservering['tijd']; ?></td>
                        <td><?= $reservering['naam']; ?></td>
                        <td><?= $reservering['aantal_personen']; ?></td>
                        <td><?= $reservering['status']; ?></td>
                        <td><?= $reservering['aantal_kinderen']; ?></td>
                        <td><?= $reservering['allergien']; ?></td>
                        <td><?= $reservering['opmerkingen']; ?></td>

                        <td>
                            <a href="editreservering.php?id=<?php echo $reservering['reserveringsId'] ?>" class="btn btn-info">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete')"href="deletereservering.php?id=<?php echo $reservering['reserveringsId'] ?>" class="btn btn-danger">delete</a>
                        </td>
            
                    </tr>
                    <?php endforeach; ?>
                    

                </table>
            </div>
        </div>
    </div>
<?php
require '../footer.php';
?>