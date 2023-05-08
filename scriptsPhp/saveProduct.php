<?php
echo "saveProduct.php";
include 'funciones.php';
if (!sessionStarted()) { ?>
    <script>
        alert("No ha iniciado sesion");
        location.href = "../index.php";
    </script>
<?php
}
echo "<pre>";
print_r($_POST);

$id = $_POST['id'];
$name = $_POST['name'];
$reference = $_POST['reference'];
$category = $_POST['category'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$stock = $_POST['stock'];
$date = $_POST['date'];
$save = $_POST['save'];
if ($save == 'Guardar') {
    
    $sql = "INSERT 
            INTO `products` (`name_product`, `reference`, `price`, `weight`, `category_id`, 
            `stock`, `creation_date`) 
            VALUES ('$name', '$reference.', '$price', '$weight', '$category', '$stock', '$date')";
    query($sql);
    header('Location: ../views/createProduct.php');
} else {
    $sql = "UPDATE `products` 
            SET `name_product` = '$name', `reference` = '$reference', `price` = '$price', 
            `weight` = '$weight', `category_id` = '$category', `stock` = '$stock', 
            `creation_date` = '$date' 
            WHERE `products`.`id` = '$id'";
    query($sql);
    header('Location: ../views/home.php');
}

