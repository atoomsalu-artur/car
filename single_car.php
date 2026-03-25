<?php
include("config.php");
include("header.php");

$message = "";

if (!isset($_GET["id"])) {
    die("Auto ID puudub.");
}

$id = (int)$_GET["id"];

$paring = "SELECT * FROM cars WHERE id = $id";
$valjund = mysqli_query($yhendus, $paring);
$rida = mysqli_fetch_assoc($valjund);

if (!$rida) {
    die("Autot ei leitud.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = (int)$_POST["user_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $price_per_day = $rida["price"];

    if (!empty($user_id) && !empty($start_date) && !empty($end_date)) {
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);

        if ($end >= $start) {
            $days = $start->diff($end)->days + 1;
            $total_price = $days * $price_per_day;

            $sql = "INSERT INTO reservations (user_id, car_id, start_date, end_date, total_price)
                    VALUES ('$user_id', '$id', '$start_date', '$end_date', '$total_price')";

            if (mysqli_query($yhendus, $sql)) {
                $message = "Broneering õnnestus! Koguhind: " . $total_price . " €";
            } else {
                $message = "Viga: " . mysqli_error($yhendus);
            }
        } else {
            $message = "Lõppkuupäev peab olema hilisem või sama mis alguskuupäev.";
        }
    } else {
        $message = "Palun täida kõik väljad.";
    }
}

$users_result = mysqli_query($yhendus, "SELECT * FROM users");
?>

<div class="container">
    <a href="index.php" class="btn btn-dark mb-3">Tagasi</a>

    <?php if (!empty($message)) { ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php } ?>

    <div class="row">
        <div class="col-md-6">
            <h1><?php echo $rida["mark"]; ?> <?php echo $rida["model"]; ?></h1>
            <p>Mootor: <?php echo $rida["engine"]; ?></p>
            <p>Kütus: <?php echo $rida["fuel"]; ?></p>
            <p>Aasta: <?php echo $rida["year"]; ?></p>
            <p>Staatus: <?php echo $rida["status"]; ?></p>
            <p>Käigukast: <?php echo $rida["transmission"]; ?></p>
            <p>Istmed: <?php echo $rida["seats"]; ?></p>
            <p class="fs-5"><strong>Hind: <?php echo $rida["price"]; ?> €/päev</strong></p>

            <hr>

            <h3>Broneeri auto</h3>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Kasutaja</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">Vali kasutaja</option>
                        <?php while($user = mysqli_fetch_assoc($users_result)) { ?>
                            <option value="<?php echo $user["id"]; ?>">
                                <?php echo $user["name"]; ?> (ID: <?php echo $user["id"]; ?>)
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alguskuupäev</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lõppkuupäev</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark w-100">Arvuta koguhind ja salvesta</button>
            </form>
        </div>

        <div class="col-md-6">
            <img src="https://loremflickr.com/800/500/<?php echo str_replace(' ', '', $rida["mark"]); ?>" class="card-img-top img-fluid" alt="<?php echo $rida["mark"]; ?>">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
