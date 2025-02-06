<?php
session_start();

// create array w/ 3 number values

//a) create form to modify values of 1 specific position 


// que se mantenga las modificaciones en el array

//add a botón para calcular el valor medio

?>
<!--  -->


<!-- -->
<!DOCTYPE html>

<html>
    <head>
        <title>Modify array</title>
    </head>
    <body>
        <h2>Modify array</h2>
        <form action="Ejercicio2.php" method="POST">
        <label for="number">Position to modify: </label>
        <input type="integer" id=" number" name="number" value="<?php echo isset($_POST['number']) ? $_POST['nu']: ''; ?>" </input>
        <form action="Ejercicio2.php" method="POST">

        <h3>Position to modify: </h3>
        <select name="product" id="product">
            <option value="milk">Milk </option>
            <option value="softDrink">Soft drink </option>
        </select>

        <h3>New value: </h3>
        <input type="text" id="value" name="value"><br><br>
        <input type="submit" value="modify" name="modify">
        <input type="submit" value="average" name="average">
        <input type="reset" value="reset">
        </form>
        <p>Current array: </p>
        echo $_SESSION[]

    </body>

</html>