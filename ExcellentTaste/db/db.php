<?php
class database {
    private $host;
    private $user;
    private $pass;
    private $db;
    private $charset;
    private $pdo;
    private $comments;

    public function __construct(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'excellenttaste';
        $this->charset = 'utf8mb4'; 
        
        try{
            $dsn = 'mysql:host='. $this->host.';dbname='.$this->db.';charset='.$this->charset;
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        catch(\PDOException $e){
            echo "Connection Failed: ".$e->getMessage();
        }
    }
    //Functie om data te inserten naar tabel reservering
    public function insertReservering($tafel, $datum, $tijd,  $klant_id, $aantal_personen, $aantal_kinderen, $status, $allergien, $opmerkingen) {
        $sql = "INSERT INTO reservering (id, tafel, datum, tijd, aantal_personen, aantal_kinderen, status, datum_toegevoegd, allergien, opmerkingen, klant_id) 
                VALUES (NULL, :tafel, :datum, :tijd, :aantal_personen, :aantal_kinderen, :status, CURRENT_TIMESTAMP(), :allergien, :opmerkingen, :klant_id)";
       
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ':tafel' => $tafel,
            ':datum' => $datum,
            ':tijd' => $tijd,
            ':aantal_personen' => $aantal_personen,
            ':aantal_kinderen' => $aantal_kinderen,
            ':status' => $status,
            ':allergien' => $allergien,
            ':opmerkingen' => $opmerkingen,
            ':klant_id' => $klant_id
        ]);

        header("Location: reserveringsoverzicht.php");
        return $stmt;
    }
    //Functie die data selecteert gebaseerd op id
    public function getReservering($id) {
        $sql = "SELECT * FROM reservering WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie om data in reservering te wijzigen
    public function updateReservering($id, $tafel, $datum, $tijd,  $klant_id, $aantal_personen, $aantal_kinderen, $status, $allergien, $opmerkingen) {
        $sql = "UPDATE reservering SET tafel = :tafel, datum = :datum, tijd = :tijd, aantal_personen = :aantal_personen, aantal_kinderen = :aantal_kinderen, status = :status, allergien = :allergien, opmerkingen = :opmerkingen 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id,
            ':tafel' => $tafel,
            ':datum' => $datum,
            ':tijd' => $tijd,
            ':aantal_personen' => $aantal_personen,
            ':aantal_kinderen' => $aantal_kinderen,
            ':status' => $status,
            ':allergien' => $allergien,
            ':opmerkingen' => $opmerkingen
        ]);

        header("Location: reserveringsoverzicht.php");
        return $stmt;
    }
    //Functie om data te verwijderen uit reservering
    public function deleteReservering($id) {
        $sql = "DELETE FROM reservering WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header("Location: reserveringsoverzicht.php");
        return $stmt;
    }
    //Functie om data te inserten in klant
    public function insertKlant($naam, $telefoon, $email) {
        $sql = "INSERT INTO klant (id, naam, telefoon, email)
                VALUES (NULL, :naam, :telefoon, :email)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':naam' => $naam,
            ':telefoon' => $telefoon,
            ':email' => $email
        ]);

        header("Location: klantenoverzicht.php");
        return $stmt;
    }
    //Functie die alle klanten pakt uit tabel klant
    public function getKlanten() {
        $sql = "SELECT * FROM klant";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie die klant pakt gebaseerd op de id
    public function getKlant($id) {
        $sql = "SELECT * FROM klant WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } 
    //Functie die data van klant wijzigt in klant
    public function updateKlant($id, $naam, $telefoon, $email) {
        $sql = "UPDATE klant SET naam = :naam, telefoon = :telefoon, email = :email WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':naam' => $naam,
            ':telefoon' => $telefoon,
            ':email' => $email,
            ':id' => $id
        ]);

        header("Location: klantenoverzicht.php");
    }
    //Functie die data van klant verwijderd in klant
    public function deleteKlant($id) {
        $sql = "DELETE FROM klant WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header("Location: klantenoverzicht.php");
    }
    //Functie om alle data te pakken uit menuitems
    public function getMenuitems() {
        $sql = "SELECT * FROM menuitems";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie die reservering selecteert en data van klant.id laat joinen in reservering.klant_id
    public function getReserveringen() {
        $sql = "SELECT reservering.id as reserveringsId, naam, telefoon, email, tafel, datum, tijd, aantal_personen, aantal_kinderen, status, datum_toegevoegd, allergien, opmerkingen, klant_id 
                FROM reservering 
                INNER JOIN klant 
                ON reservering.klant_id = klant.id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie die bestelling aanmaakt
    public function createBestelling($gereserveerd, $reservering_id, $menuitem_id, $aantal) {
        $sql = "INSERT INTO bestellingen (id, geserveerd, aantal, reservering_id, menuitems_id)
                VALUES (NULL, :geserveerd, :aantal, :reservering_id, :menuitems_id)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':geserveerd' => $gereserveerd,
            ':aantal' => $aantal,
            ':reservering_id' => $reservering_id,
            ':menuitems_id' => $menuitem_id
        ]);

        header("Location: index.php");
    }
    //Functie die data in bestelling van een bestelling wijzigt
    public function updateBestelling($id, $geserveerd, $aantal, $reservering_id, $menuitem_id) {
        $sql = "UPDATE bestellingen 
                SET 
                    geserveerd = :geserveerd, 
                    aantal = :aantal, 
                    reservering_id = :reservering_id, 
                    menuitems_id = :menuitems_id 
                    WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':geserveerd' => $geserveerd,
            ':aantal' => $aantal,
            ':reservering_id' => $reservering_id,
            ':menuitems_id' => $menuitem_id,
            ':id' => $id
        ]);

        header("Location: index.php");
    }

    //Functie om data te verwijderen in bestelling
    public function deleteBestelling($id) { 
        $sql = "DELETE FROM bestellingen WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header("Location: index.php");
    }
    //Functie die reservering.id en menuitems.id in bestellingen laat inner joinen
    public function getBestellingen() {
        $sql = "SELECT 
                bestellingen.id as bestellingId,
                bestellingen.aantal,
                IF(bestellingen.geserveerd = 1, 'Ja', 'Nee') AS geserveerd,
                menuitems.naam,
                (bestellingen.aantal * menuitems.prijs) AS totaalPrijs,
                reservering.*
                FROM 
                bestellingen
                INNER JOIN reservering
                    ON bestellingen.reservering_id = reservering.id
                INNER JOIN menuitems
                    ON bestellingen.menuitems_id = menuitems.id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie die reservering.id en menuitems.id in bestellingen laat inner joinen gebaseerd op de id
    public function getBestelling($id) {
        $sql = "SELECT 
                    bestellingen.id AS bestellingId,
                    reservering.id AS reserveringId,
                    menuitems.id AS menuitemId,
                    bestellingen.aantal,
                    bestellingen.geserveerd as geserveerdnr,
                    IF(bestellingen.geserveerd = 1, 'Ja', 'Nee') AS geserveerd,
                    menuitems.naam,
                    reservering.*
                FROM 
                bestellingen
                INNER JOIN reservering
                    ON bestellingen.reservering_id = reservering.id
                INNER JOIN menuitems
                    ON bestellingen.menuitems_id = menuitems.id
                WHERE bestellingen.id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    //functie data te selecteren voor kok overzicht
    public function getKokData() {
        $sql = "SELECT 
                    reservering.tafel,
                    menuitems.naam,
                    IF(bestellingen.geserveerd = 1, 'Ja', 'Nee') AS geserveerd,
                    bestellingen.aantal
                FROM 
                bestellingen 
                INNER JOIN reservering
                    ON bestellingen.reservering_id = reservering.id
                INNER JOIN menuitems
                    ON bestellingen.menuitems_id = menuitems.id
                INNER JOIN gerechtsoorten 
                    ON menuitems.gerechtsoort_id = gerechtsoorten.id
                WHERE gerechtsoorten.code = 'Kok'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //functie data te selecteren voor barman overzicht
    public function getBarmanData() {
        $sql = "SELECT 
        reservering.tafel,
        menuitems.naam,
        IF(bestellingen.geserveerd = 1, 'Ja', 'Nee') AS geserveerd,
        bestellingen.aantal
            FROM 
            bestellingen 
            INNER JOIN reservering
                ON bestellingen.reservering_id = reservering.id
            INNER JOIN menuitems
                ON bestellingen.menuitems_id = menuitems.id
            INNER JOIN gerechtsoorten 
                ON menuitems.gerechtsoort_id = gerechtsoorten.id
            WHERE gerechtsoorten.code = 'Bar'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //functie om alle bestellingen te selecteren voor ober overzicht
    public function getOberBestellingen() {
        $sql = "SELECT 
            reservering.tafel,
            menuitems.naam,
            IF(bestellingen.geserveerd = 1, 'Ja', 'Nee') AS geserveerd,
            bestellingen.aantal
                FROM 
                bestellingen 
                INNER JOIN reservering
                    ON bestellingen.reservering_id = reservering.id
                INNER JOIN menuitems
                    ON bestellingen.menuitems_id = menuitems.id
                INNER JOIN gerechtsoorten 
                    ON menuitems.gerechtsoort_id = gerechtsoorten.id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie om alle data van menu te pakken
    public function getMenu() {
        $sql = "SELECT 
        menuitems.id AS menuitemId,
        menuitems.naam AS menuitemNaam,
        gerechtsoorten.naam AS gerechtsoortNaam,
        gerechtcategorien.naam AS gerechtcategorieNaam,
        menuitems.*,
        gerechtsoorten.*,
        gerechtcategorien.*
        FROM 
        menuitems
        INNER JOIN gerechtsoorten
            ON menuitems.gerechtsoort_id = gerechtsoorten.id
        INNER JOIN gerechtcategorien
            ON gerechtsoorten.gerechtcategorie_id = gerechtcategorien.id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //functie om menu attributen te pakken
    public function getMenuDetail($id) {
        $sql = "SELECT 
        menuitems.id AS menuitemId,
        menuitems.naam AS menuitemNaam,
        gerechtsoorten.naam AS gerechtsoortNaam,
        gerechtcategorien.naam AS gerechtcategorieNaam,
        menuitems.*,
        gerechtsoorten.*,
        gerechtcategorien.*
        FROM 
        menuitems
        INNER JOIN gerechtsoorten
            ON menuitems.gerechtsoort_id = gerechtsoorten.id
        INNER JOIN gerechtcategorien
            ON gerechtsoorten.gerechtcategorie_id = gerechtcategorien.id
        WHERE menuitems.id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //Functie om alle gerechtcategorien te pakken
    public function getGerechtCategorien() {
        $sql = "SELECT * FROM gerechtcategorien";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getGerechtSoorten() {
        $sql = "SELECT * FROM gerechtsoorten";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //functie om nieuwe data in menu te laten toe voegen
    public function createMenu($code, $menuItemNaam, $prijs, $gerechtsoort_id) {
        $sql = "INSERT INTO menuitems (code, naam, prijs, gerechtsoort_id) 
                VALUES (:code, :naam, :prijs, :gerechtsoort_id)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':code' => $code,
            ':prijs' => $prijs,
            ':naam' => $menuItemNaam,
            ':gerechtsoort_id' => $gerechtsoort_id
        ]);
    }
    //functie om data in menu te verwijderen
    public function deleteMenu($id) {
        $sql = "DELETE FROM menuitems WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        header("Location: index.php");
    }



}
?>
