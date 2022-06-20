<?php
require '../../db/db.php';

$db = new database();

$bestellingen = $db->getBarmanData();
?>
<?php
require '../../header.php';
?>
<div class="container">
    <?php require '../../sub-menu.php'; ?>
    <div class="card mt-5">
        <div class="card-header">
            <h2>Overzicht voor Barman</h2>

        </div>
        <div class="card-body">
            <table class="tabe table-bordered">
                <tr>
                    <th>Tafel</th>
                    <th>Aantal</th>
                    <th>Drank</th>
                    <th>Geserveerd</th>                    
                </tr>
                <?php foreach($bestellingen as $bestelling): ?>
                <tr>
                    <td><?= $bestelling['tafel']; ?></td>
                    <td><?= $bestelling['aantal']; ?></td>
                    <td><?= $bestelling['naam']; ?></td>
                    <td><?= $bestelling['geserveerd']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php
require '../../footer.php';
?>