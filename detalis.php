<?php
   include('config/db_connct.php');
   if(isset($_POST['delete']))
   {
    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql= "DELETE FROM pizza WHERE id=$id_to_delete";

    if(mysqli_query($conn,$sql))
    {
        //success
       header('location:index.php');
    }{
        //failure
        echo 'query error:'. mysqli_error($conn);
    }
   }
// Initialize $pizza variable
$pizza = null;

//check get request id 
if(isset($_GET['id']))
{
    $id= mysqli_real_escape_string($conn,$_GET['id']);
    //make sql
    $sql="SELECT * FROM pizza WHERE id= '$id'";
    //get the qurey result 
    $result = mysqli_query($conn, $sql);
    //fetch reslut
    $pizza=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html >
    <?php include('tempets/header.php');?>
    <div class="container center grey-text">
        <?php if($pizza): ?>
            <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
            <p>Created by:<?php htmlspecialchars($pizza['email']); ?></p>
            <p><?php echo date($pizza['created_at']);?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlentities($pizza['ingredients']);?></p>
            <!-- delete form -->
            <form action="detalis.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>">
                <input type="submit" name="delete" class="btn brand z-depth-0" value="Delete">
            </form>
        <?php else:?>
        <h5>No such pizza exists!</h5>
        <?php endif;?>
    </div>
    <?php include('tempets/footer.php');?>

</html>