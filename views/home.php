<?php
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

function getCategory($id)
{
    $sql = "SELECT * FROM categories where id = '$id'";
    return data($sql)['category_name'];
}
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
    <?php
    if (query($sql) == "") { ?>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 text-gray-400">
            </table>
        </div>
    <?php } else { ?>
        <div class=" p-5 flex justify-center">
            <div class="  relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-auto text-sm text-left text-gray-500 text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 bg-gray-700 text-gray-400">
                        <tr class="">
                            <th scope="col" class="px-6 py-3">
                                id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                referencia
                            </th>
                            <th scope="col" class="px-6 py-3">
                                precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                peso
                            </th>

                            <th scope="col" class="px-6 py-3">
                                stock
                            </th>
                            <th scope="col" class="px-6 py-3">
                                creacion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  }

                $count = 0;
                foreach ($resp  as $value) {
                    $count++;

                    $class = ($count % 2 == 0) ? " border-b bg-gray-900"
                        : "border-b bg-gray-50 bg-gray-800";
                    ?>
                        <tr class="<?= $class ?> border-gray-700 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-white">
                                <?= $value['id'] ?>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $value['name_product'] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $value['reference'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $value['price'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $value['weight'] ?>
                            </td>
                          
                            <td class="px-6 py-4">
                                <?= $value['stock'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $value['creation_date'] ?>
                            </td>
                            <td class=" px-6 py-4">
                                <a href="createProduct.php?action=update&id=<?= $value['id'] ?>" class="font-medium text-white bg-yellow-500 rounded p-2 hover:bg-yellow-700">Editar</a>
                                <a href="../scriptsPhp/deleteProduct.php?id=<?= $value['id'] ?>" class="font-medium text-white bg-red-500 rounded p-2 hover:bg-red-700">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>



                    </tbody>
                </table>
            </div>

        </div>

</body>

</html>