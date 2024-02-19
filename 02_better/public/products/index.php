<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="app.css" rel="stylesheet">
</head>
<body>
<?php


/** @var $pdo \PDO */
require_once "../../database.php";

$search = $_GET['search'] ?? '';
if ($search){

  $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
  $statement->bindValue(':title', "%$search%");
} else {
  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}


$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include_once "../../views/partials/header.php"; ?>

    <h1>Products</h1>

    <p>

        <a href="create.php" class="btn btn-success">Create Product</a>

    </p>


    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
        foreach($products as $i => $product): ?>
         <tr>
            <th scope="row"><?php echo $i + 1?></th>
            <td>
                <img src="<?php echo $product['image']?>" class="thumb-image">
            </td>
            <td><?php echo $product['title']?></td>
            <td><?php echo $product['price']?></td>
            <td><?php echo $product['create_date']?></td>
            <td>
                 <a href="update.php?id=<?php echo $product['id'] ?>"class ="btn btn-sm btn-outline-primary">Edit</a>
                        <form style="display: inline-block" method="post" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $product['id']?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                      </td>
         </tr>
        <?php endforeach; ?>
  </tbody>
</table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
</body>
</html>