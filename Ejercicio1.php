<?php
session_start();
//if doesn't exit, = 0
if(!isset($_SESSION['milk'])) {
    $_SESSION['milk'] = 0;
}
if(!isset($_SESSION['softDrink'])) {
    $_SESSION['softDrink'] = 0;
}

//form
if ($_SERVER['REQUEST_METHOD']==='POST') {
    //info form
    $worker = $_POST['worker']?? '';
    $product = $_POST['product']?? '';
    $quantity = $_POST['quantity'] ? intval($_POST['quantity']) : 0;
    
    //save worker name
    $_SESSION["worker"] = $worker;

    //detect the buttons
    // if exist, add product
    if(isset($_POST["add"])){
        switch($product){
            //array per product manangement
            //add quantity product
            case'milk':
                $_SESSION['milk']+=$quantity;
                break;
            case 'softDrink':
                $_SESSION['softDrink']+=$quantity;
                break;
            default:
                echo "<br> Product not found!";
                break;
        }
  
    //click on buttom remov
    }else if (isset($_POST["remove"])){
        switch($product){
            //less quantity product
            case'milk':
                if ($_SESSION['milk'] >= $quantity) {
                    $_SESSION['milk'] -= $quantity;
                } else {
                    echo "<br>Not enough stock of milk!";
                }
                break;
            case 'softDrink':
                //if there is stock
                if ($_SESSION['softDrink'] >= $quantity) {
                    $_SESSION['softDrink'] -= $quantity;
                } else {
                    echo "<br>Not enough stock of soft drink!";
                }
                break;
            default:
                echo "<br> There isn't more product";
                break;
       }
    }
}
    
?>


<!DOCTYPE html>
<html>
<head>
    <title> Supermarket Management</title>
</head>
<body>
    <h1>Supermarket Management </h1>

    <form action="Ejercicio1.php" method="POST">
    <label for="workerNm">Worker name: </label>
    <input type="text" id=" workerNm" name="worker" value="<?php echo isset($_SESSION['worker']) ? $_SESSION['worker'] : ''; ?>">

    <h2>Choose product: </h2>
    <select name="product" id="product">
        <option value="milk">Milk</option>
        <option value="softDrink">Soft drink</option>
    </select>

    <h2>Product quantity: </h2>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>
    <input type="submit" value="Add" name="add">
    <input type="submit" value="Remove" name="remove">
    <input type="reset" value="Reset">
    </form>

    <h2>Inventary: </h2>
    <p>Worker: <?php echo isset($_SESSION['worker']) ? $_SESSION['worker'] : ''; ?></p>
    <p>Units of Milk: <?php echo $_SESSION['milk']; ?></p>
    <p>Units of Soft Drinks: <?php echo $_SESSION['softDrink']; ?></p>
</body>
</html>