<?php
require '../db/db.php';

$db = new database();

$bestellingen = $db->getBestellingen();
?>

<?php
require '../header.php';
?>

    <div class="container">
        <a href="./create.php" class="btn btn-success mt-5">bestellingen toevoegen</a>
        <div class="card mt-5">
            <div class="card-header">
                <h2>bestellingen overzicht</h2>

            </div>
            <div class="card-body">
                <table class="tabe table-bordered table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>aantal</th>
                        <th>naam</th>
                        <th>totaal prijs</th>
                        <th>geserveerd</th>
                        <th>tafel</th>
                        <th>datum</th>
                        <th>tijd</th>
                        <th>aantal_personen</th>
                        <th>aantal_kinderen</th>
                        <th>status</th>
                        <th>datum_toegevoegd</th>
                        <th>allergien</th>
                        <th>opmerkingen</th>
                    </tr>
                    <?php foreach($bestellingen as $bestelling): ?>
                    <tr>
                        <td><?= $bestelling['bestellingId']; ?></td>
                        <td><?= $bestelling['aantal']; ?></td>
                        <td><?= $bestelling['naam']; ?></td>
                        <td><?= $bestelling['totaalPrijs']; ?></td>
                        <td><?= $bestelling['geserveerd']; ?></td>
                        <td><?= $bestelling['tafel']; ?></td>
                        <td><?= $bestelling['datum']; ?></td>
                        <td><?= $bestelling['tijd']; ?></td>
                        <td><?= $bestelling['aantal_personen']; ?></td>
                        <td><?= $bestelling['aantal_kinderen']; ?></td>
                        <td><?= $bestelling['status']; ?></td>
                        <td><?= $bestelling['datum_toegevoegd']; ?></td>
                        <td><?= $bestelling['allergien']; ?></td>
                        <td><?= $bestelling['opmerkingen']; ?></td>
                        <td>
                        <a href="update.php?id=<?php echo $bestelling['bestellingId'] ?>" class="btn btn-info">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete')"href="delete.php?id=<?php echo $bestelling['bestellingId'] ?>" class="btn btn-danger">delete</a>
                        <button onclick="window.print()">Print</button>
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