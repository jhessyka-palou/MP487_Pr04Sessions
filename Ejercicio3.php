<?php
session_start();

// create array if isn't exit
if (!isset($_SESSION['shopping_list'])) {
    $_SESSION['shopping_list'] = [];
}

// variables to edit the product
$editIndex = null;
$editName = "";
$editQuantity = "";
$editPrice = "";

//form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //click buttom add
    if (isset($_POST['add'])) { 
        //add product to the list with the values:
        $name = $_POST['name'];
        $quantity = intval($_POST['quantity']);
        $price = floatval($_POST['price']);
        
        if (!empty($name) && $quantity > 0 && $price > 0) {
            //create the array asociative
            $_SESSION['shopping_list'][] = [
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $quantity * $price];
        }
        //click buttom edit
    } elseif (isset($_POST['edit']) && isset($_POST['index'])) {
        // Editar un ítem existente
        $editIndex = intval($_POST['index']);
        if (isset($_SESSION['shopping_list'][$editIndex])) {
            $editName = $_SESSION['shopping_list'][$editIndex]['name'];
            $editQuantity = $_SESSION['shopping_list'][$editIndex]['quantity'];
            $editPrice = $_SESSION['shopping_list'][$editIndex]['price'];
        }
        //after edit click update buttom
    } elseif (isset($_POST['update'])) {
        $updateIndex = intval($_POST['index']);
        if (isset($_SESSION['shopping_list'][$updateIndex])) {
            $_SESSION['shopping_list'][$updateIndex]['name'] = $_POST['name'];
            $_SESSION['shopping_list'][$updateIndex]['quantity'] = intval($_POST['quantity']);
            $_SESSION['shopping_list'][$updateIndex]['price'] = floatval($_POST['price']);
            $_SESSION['shopping_list'][$updateIndex]['total'] = $_SESSION['shopping_list'][$updateIndex]['quantity'] * $_SESSION['shopping_list'][$updateIndex]['price'];
        }

    } elseif (isset($_POST['delete'])) {
        // remove the item of the list product
        $index = intval($_POST['index']);
        if (isset($_SESSION['shopping_list'][$index])) {
            array_splice($_SESSION['shopping_list'], $index, 1);
        }
    }
}
//Calculate total list 
$totalCost = array_sum(array_column($_SESSION['shopping_list'], 'total'));



?>


<html>
    <head>
        <title>Shopping List</title>
    </head>
    
    <h2>Shopping list</h2>
    <form action="Ejercicio3.php" method="POST">
    <input type="hidden" name="index" value="<?php echo ($editIndex !== null) ? $editIndex : ''; ?>">

    <label for="name">Name Product: </label>
    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($editName); ?>">
    <br><br>
    <label for="quantity">Quantity: </label>
    <input type="number" id="quantity" name="quantity" min="1" required value="<?php echo htmlspecialchars($editQuantity); ?>">
    <br><br>
    <label for="price">Price: </label>
    <input type="number" id="price" name="price" step="0.01" min="0.01" required value="<?php echo htmlspecialchars($editPrice); ?>">
    <br><br>

    <input type="submit" value="Add" name="add">
    <input type="submit" value="Update" name="update">

    <input type="reset" value="Reset">
    </form>

    <h3>Item list:</h3>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Cost</th>
            <th>Actions</th>
        </tr>
        
        <?php foreach ($_SESSION['shopping_list'] as $index => $item): // add de products ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price']; ?>€</td>
                <td><?php echo $item['total']; ?>€</td>
                <td>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <input type="submit" value="Edit" name="edit">
                    </form>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <input type="submit" value="Delete" name="delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total Cost: <?php echo $totalCost; ?>€</h3>
    </body>

</html>