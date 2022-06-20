<?php
require '../db/db.php';

$db = new database();

$menuitems = $db->getMenu();
?>

<?php
require '../header.php';
?>
    <div class="container">
        <a href="./create.php" class="btn btn-success mt-5">Menu</a>
        <div class="card mt-5">
            <div class="card-header">
                <h2>Menu</h2>

            </div>
            <div class="card-body">
                <table class="tabe table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Menu Naam</th>
                        <th>Menu Prijs</th>
                        <th>Gerechtsoort Naam</th>
                        <th>gerechtcategorie Naam</th>
                    </tr>
                    <?php foreach($menuitems as $menuitem): ?>
                    <tr>
                        <td><?= $menuitem['menuitemId']; ?></td>
                        <td><?= $menuitem['menuitemNaam']; ?></td>
                        <td><?= $menuitem['prijs']; ?></td>
                        <td><?= $menuitem['gerechtsoortNaam']; ?></td>
                        <td><?= $menuitem['gerechtcategorieNaam']; ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $menuitem['menuitemId'] ?>" class="btn btn-info">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete')"href="delete.php?id=<?php echo $menuitem['menuitemId'] ?>" class="btn btn-danger">delete</a>
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