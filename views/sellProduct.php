<?php
//include '../conex.php';
include '../scriptsPhp/funciones.php';
$sql = "SELECT * FrOM products p";
$resp = query($sql);
if (!sessionStarted()) { ?>
    <script>
        alert("No ha iniciado sesion");
        location.href = "../index.php";
    </script>
<?php
}

//consulto todos los productos
$sqlProducts = "SELECT * FROM products";
$respProducts = query($sqlProducts);

//consulto en consecutivo de facturacion
$sqlSale = "SELECT MAX(sale_id) AS sale_id FROM productsales";
$respSale = query($sqlSale);
$rowSale = mysqli_fetch_assoc($respSale);
$sale_id = $rowSale['sale_id'] + 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Konecta</title>
</head>

<body class=" h-screen bg-gray-700 ">
    <?php
    require 'nav.php'
    ?>

    <div class=" p-5 flex justify-center">
        <div class=" border-2 p-1 relative shadow-md sm:rounded-lg">
            <form class="w-full max-w-lg p-3" action="/scriptsPhp/saveProduct.php" method="post">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="product_id">
                            Nombre
                        </label>
                        <div class="relative">
                            <select id="product_id" name="product_id" value="<?= isset($_GET['product_id']) ? $_GET['product_id'] : '' ?>" class="block appearance-none w-full bg-gray-200 border border-gray-200 
                            text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500">
                                <?php
                                foreach ($respProducts as $rowproduct) {
                                    if ($rowproduct['id'] == $_GET['product_id']) {
                                        echo "<option selected value='" . $rowproduct['id'] . "'>" . $rowproduct['name_product'] . "</option>";
                                    } else {
                                        echo "<option  value='" . $rowproduct['id'] . "'>" . $rowproduct['name_product'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="sale_id">
                            Numero de factura
                        </label>
                        <input required id="sale_id" name="sale_id" type="text" value="<?= $sale_id ?>" readonly class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white 
                        focus:border-gray-500">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="quantity">
                            cantidad
                        </label>
                        <input required id="quantity" name="quantity" type="text" value="<?= isset($_GET['quantity']) ? $_GET['quantity'] : '' ?>" placeholder="Cantidad producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="price">
                            precio
                        </label>
                        <input required name="price" id="price" type="text" value="<?= isset($_GET['price']) ? $_GET['price'] : '' ?>" placeholder="precio producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>

                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="date">
                            Fecha de venta
                        </label>
                        <input required id="date" name="date" type="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>" placeholder="Peso producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none 
                        focus:bg-white">

                    </div>

                </div>

                <div class=" flex justify-center">

                    <div class="w-full md:w-1/3 px-3 ">
                        <input required type="submit" value="Realizar venta" name="save" class="block w-full bg-blue-600 hover:bg-blue-700 text-white border font-bold 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>

</html>