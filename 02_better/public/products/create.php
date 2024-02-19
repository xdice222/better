<?php

/** @var $pdo \PDO */
require_once "../../database.php";
require_once "../../function.php";

$errors = [];

$title = '';
$price = '';
$description = '';
$product = [
    'image' => ''
];


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "validate_product.php";

 if (empty($errors)){
 

$statement = $pdo->prepare("INSERT INTO products(title, image, description, price, create_date)
                VALUES(:title, :image, :description, :price, :date )");

$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':date', date('Y-m-d H:i:s'));
$statement->execute();
header('location: index.php');
}

}



?>


<?php include_once "../../views/partials/header.php"; ?>

    <P>
        <a href="index.php" class="btn btn-secondary">Go back to Products></a>
    </P>
    
    <h1>Create New Product</h1>

    <?php include_once "../../views/products/form.php"; ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>