<?php
//include '../conex.php';
include '../scriptsPhp/funciones.php';
$id = $_GET['id'];
if (!sessionStarted()) { ?>
    <script>
        alert("No ha iniciado sesion");
        location.href = "../index.php";
    </script>
<?php
}
$sql = "SELECT * FROM productsales  WHERE product_id = '$id'";
$result = query($sql);
if (mysqli_fetch_row($result)) { ?>
    <script>
       alert("No se puede eliminar el producto porque tiene ventas asociadas");
        location.href = `../views/home.php`;
    </script>
<?php
}

$sql = "DELETE FROM products WHERE id = '$id'";
$result = query($sql);

header('Location: ../views/home.php');
?>