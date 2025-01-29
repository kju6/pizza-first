<?php 
    include('config/db_connct.php');
    //wite qurey for all pizza 
    $sql='SElECT title, ingredients, id FROM pizza order by created_at';

    //make qurey and get result
    $result = mysqli_query($conn, $sql);

    //featch the resulting rows as an array
    $pizzas= mysqli_fetch_all($result, MYSQLI_ASSOC);
    //free result from memory
    mysqli_free_result($result);
    //close connection
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include('tempets/header.php')?>
    <h4 class="center grey-text" style="text-align: center;">Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="imge/pizza.avif" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing);?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="detalis.php?id=<?php echo $pizza['id']; ?>" class="brand-text ">more info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php include('tempets/footer.php')?>
</body>
</html>