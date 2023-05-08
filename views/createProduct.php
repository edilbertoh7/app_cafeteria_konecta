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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FrOM products  where id = '$id'";
    $resp = query($sql);
    foreach ($resp as $row) {/*necesario
         para mostra los datos en el formulario cuando se va a editar*/
    }
}
//print_r($_GET);
//consulto todas las categorias
$sqlCategories = "SELECT * FROM categories";
$respCategories = query($sqlCategories);

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
            <?php
            if ($_GET['action'] == "new") { ?>
                <h1 class="text-white p-3 font-bold">Registrar un Nuevo Producto</h1>
            <?php } else { ?>
                <h1 class="text-white p-3 font-bold">Actualizar este producto</h1>
            <?php } ?>
            <form class="w-full max-w-lg p-3" action="/scriptsPhp/saveProduct.php" method="post">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="name">
                            nombre
                        </label>
                        <input type="hidden" name="id" id="id" value="<?= isset($_GET['id']) ? $row['id'] : '' ?>">
                        <input required id="name" name="name" value="<?= isset($_GET['id']) ? $row['name_product'] : '' ?>" type="text" placeholder="Nombre producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none 
                        focus:bg-white">

                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="reference">
                            referencia
                        </label>
                        <input required id="reference" name="reference" value="<?= isset($_GET['id']) ? $row['reference'] : '' ?>" type="text" placeholder="Referencia" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white 
                        focus:border-gray-500">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="category">
                            categoria
                        </label>
                        <div class="relative">
                            <select id="category" name="category" class="block appearance-none w-full bg-gray-200 border border-gray-200 
                            text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500">
                                <?php
                                foreach ($respCategories as $rowCategory) {
                                    if ($rowCategory['id'] == $row['category_id']) {
                                        echo "<option selected value='" . $rowCategory['id'] . "'>" . $rowCategory['category_name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $rowCategory['id'] . "'>" . $rowCategory['category_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="price">
                            precio
                        </label>
                        <input required name="price" id="price" value="<?= isset($_GET['id']) ? $row['price'] : '' ?>" type="text" placeholder="precio producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="weight">
                            peso
                        </label>
                        <input required id="weight" name="weight" type="text" value="<?= isset($_GET['id']) ? $row['weight'] : '' ?>" placeholder="Peso producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none 
                        focus:bg-white">

                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="stock">
                            cantidad
                        </label>
                        <input required id="stock" name="stock" type="text" value="<?= isset($_GET['id']) ? $row['stock'] : '' ?>" placeholder="Cantidad producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>

                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="date">
                            Fecha de registro
                        </label>
                        <input required id="date" name="date" value="<?= isset($_GET['id']) ? $row['creation_date'] : '' ?>" type="date" placeholder="Peso producto" class="appearance-none block w-full bg-gray-200 text-gray-700 border 
                        border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none 
                        focus:bg-white">

                    </div>

                </div>

                <div class=" flex justify-center">

                    <div class="w-full md:w-1/3 px-3 ">
                        <input required type="submit" value="<?= isset($_GET['id']) ? 'Actualizar' : 'Guardar' ?>" name="save" class="block w-full bg-blue-600 hover:bg-blue-700 text-white border font-bold 
                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none 
                        focus:bg-white focus:border-gray-500">
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>

</html>