<?php
include("config.php");
include("header.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($name) && !empty($email) && !empty($password)) {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($yhendus, $sql)) {
            $message = "Registreerimine õnnestus!";
        } else {
            $message = "Viga: " . mysqli_error($yhendus);
        }
    } else {
        $message = "Palun täida kõik väljad.";
    }
}
?>

<div class="container">
    <h2 class="mb-4">Kasutaja registreerimine</h2>

    <?php if (!empty($message)) { ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php } ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nimi</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-post</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Parool</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark">Registreeri</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
