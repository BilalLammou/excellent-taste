<?php
require '../db/db.php';

$db = new database();

$klanten = $db->getKlanten();
?>

<?php
require '../header.php';
?>
    <div class="container">
        <a href="./klanten.php" class="btn btn-success mt-5">Klant toevoegen</a>
        <div class="card mt-5">
            <div class="card-header">
                <h2>klanten overzicht</h2>

            </div>
            <div class="card-body">
                <table class="tabe table-bordered table table-striped">
                    <tr>

                        <th>ID</th>
                        <th>naam</th>
                        <th>telefoon</th>
                        <th>email</th>
                        
                    </tr>
                    <?php foreach($klanten as $klant): ?>
                    <tr>
                        <td><?= $klant['id']; ?></td>
                        <td><?= $klant['naam']; ?></td>
                        <td><?= $klant['telefoon']; ?></td>
                        <td><?= $klant['email']; ?></td>
                        
                        <td>
                        <a href="klantenedit.php?id=<?php echo $klant['id'] ?>" class="btn btn-info">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete')"href="deleteklant.php?id=<?php echo $klant['id'] ?>" class="btn btn-danger">delete</a>

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