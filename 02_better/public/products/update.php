<?php

/** @var $pdo \PDO */
require_once "../../database.php";
require_once "../../function.php";

$id = $_GET['id'] ?? null;

if(!$id){
    header('location: index.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue('id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);



$errors = [];

$title = $product['title'];
$price = $product['price'];
$description = $product['description'];


if($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once "../../validate_product.php";


 if (empty($errors)){


$statement = $pdo->prepare("UPDATE products SET title = :title, 
                image = :image, description = :description, 
                price = :price WHERE id = :id");
$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':id', $id);
$statement->execute();
header('location: index.php');
}

}


?>

<?php include_once "../../views/partials/header.php"; ?>

    <P>
        <a href="index.php" class="btn btn-secondary">Go back to Products></a>
    </P>

  <h1>Update Product <b><?php echo $product['title']?> </b></h1>

    <?php include_once "../../views/products/form.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>