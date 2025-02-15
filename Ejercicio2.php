<?php
session_start();

// create array w/ 3 number values
if(!isset($_SESSION ['numbers'])){
    $_SESSION['numbers']= [10,20,30];
}
//create form 
//to modify values of 1 specific position 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modify'])) { // que se mantenga las modificaciones en el array
        $indice = intval($_POST['indice']);
        $newValue = intval($_POST['newValue']);
        if (isset($_SESSION['numbers'][$indice])) {
            $_SESSION['numbers'][$indice] = $newValue;
        }
//add a botón para calcular el valor medio
    }else if (isset($_POST['average'])){
        $average = array_sum($_SESSION['numbers']) / count($_SESSION['numbers']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modify array</title>
</head>
    <body>
        <h2>Modify array</h2>
        <form action="Ejercicio2.php" method="POST">
        <label for="indice">Position to modify: </label>
        <input type="number" id="indice" name="indice" min="0" max="2">
        <br><br>
        <label for="newValue">New value: </label>
        <input type="number" id="newValue" name="newValue">
        <br><br>
        <input type="submit" value="Modify" name="modify">
        <input type="submit" value="Average" name="average">

        <input type="reset" value="Reset">
        </form>

        <h2>Arrays values: </h2>
        <p><?php print_r($_SESSION['numbers']); ?></p>

        <?php if (isset($average)): ?>
            <h2>Average value:<?php echo$average ?> </h2>
        <?php endif; ?>

    </body>

</html>