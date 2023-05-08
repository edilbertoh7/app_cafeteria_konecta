<?php
include 'funciones.php';
if (!sessionStarted()) { ?>
    <script>
        alert("No ha iniciado sesion");
        location.href = "../index.php";
    </script>
    <?php
}
//echo "<pre>";
//print_r($_POST);
//exit;
$save = $_POST['save'];

if ($save == 'Guardar' || $save == 'Actualizar') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $stock = $_POST['stock'];
    $date = $_POST['date'];
    if ($save == 'Guardar') {
        $sql = "SELECT * FROM products p WHERE p.name_product = '$name' AND  p.reference = '$reference' AND p.category_id = '$category'";
        $result = query($sql);
        $row = mysqli_fetch_row($result);
        //print_r($row);
        if ($row) {
            $resp = data($sql);
            $id = $resp['id'];
            $stock = $stock + $resp['stock'];
            // si el producto ya existe en la base de datos se actualiza el stock
            updateProduct($name, $reference, $price, $weight, $category, $stock, $date, $id);
        } else {
            saveProduct($name, $reference, $price, $weight, $category, $stock, $date);
        }
    } else {
        updateProduct($name, $reference, $price, $weight, $category, $stock, $date, $id);
    }
}
if ($save == 'Realizar venta') {
    $product_id = $_POST['product_id'];
    $sale_id = $_POST['sale_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $total = $quantity * $price;
    //funcion para vender un producto
    sellProduct($product_id, $sale_id, $quantity, $price, $total, $date);
}


