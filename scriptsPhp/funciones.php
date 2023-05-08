<?php
include '../conex.php';

function validarlogin($user,$password)
{
    $sql = "SELECT * FROM users WHERE email = '$user' AND password = '$password'";
    $result = query($sql);
    if (mysqli_fetch_row($result)) {
        session_start();
        $_SESSION['user']=$user;
        return true;
    }
    return false;
}
function sessionStarted()
{
	session_start();
	return isset($_SESSION['user']);
}
// nuevo producto
function saveProduct($name, $reference, $price, $weight, $category, $stock, $date)
{
    $sql = "INSERT 
            INTO `products` (`name_product`, `reference`, `price`, `weight`, `category_id`, 
            `stock`, `creation_date`) 
            VALUES ('$name', '$reference', '$price', '$weight', '$category', '$stock', '$date')";
    query($sql); ?>
    <script>
        alert("Producto creado correctamente");
        location.href = `../views/createProduct.php?action=new`;
    </script>
<?php

}
//actualizar producto
function updateProduct($name, $reference, $price, $weight, $category, $stock, $date, $id)
{
    $sql = "UPDATE `products` 
            SET `name_product` = '$name', `reference` = '$reference', `price` = '$price', 
            `weight` = '$weight', `category_id` = '$category', `stock` = '$stock', 
            `creation_date` = '$date' 
            WHERE `products`.`id` = '$id'";
    query($sql); ?>
    <script>
        alert("Producto actualizado correctamente");
        location.href = `../views/home.php`;
    </script>
<?php
}

//vender producto
function sellProduct($product_id, $sale_id, $quantity, $price, $total, $date)
{

    $sql = "SELECT * FROM productsales WHERE sale_id = '$sale_id'";
    $result = query($sql);
    if (mysqli_fetch_row($result)) { ?>
        <script>
            alert("El numero de factura ya exista en el sistema");
            location.href = `../views/sellProduct.php?sale_id=<?php echo $sale_id; ?>&product_id=<?php echo $product_id; ?>&quantity=<?php echo $quantity; ?>&price=<?php echo $price; ?>&date=<?php echo $date; ?>`;
        </script>
    <?php
        return;
    }
    $sqlProduct = "SELECT * FROM products WHERE id = '$product_id'";
    $resp = data($sqlProduct);
    $stock =  $resp['stock'] - $quantity;
    // echo "stock ==". $stock;
    if ($stock < 0) { ?>
        <script>
            alert("No hay suficiente stock para realizar la venta");
            location.href = `../views/sellProduct.php?sale_id=<?php echo $sale_id; ?>&product_id=<?php echo $product_id; ?>&quantity=<?php echo $quantity; ?>&price=<?php echo $price; ?>&date=<?php echo $date; ?>`;
        </script>
    <?php
    }
    $sqlUpdate = "UPDATE products SET stock = '$stock' WHERE id = '$product_id'";
    query($sqlUpdate);
    $sql = "INSERT INTO `productsales` (`product_id`, `sale_id`, `quantity`, `price`,`total`,`created_at`)
        VALUES ('$product_id', '$sale_id', '$quantity', '$price', '$total', '$date')";
    query($sql); ?>
    <script>
        alert("Venta realizada con exito");
        location.href = `../views/sellProduct.php`;
    </script>
<?php
}
?>
