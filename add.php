<?php
   include('config/db_connct.php');
   
   $email=$title=$Ingredients='';
    $erros=array('email'=>'','title'=>'','Ingredients'=>'');
    if(isset($_POST['submit'])){
        //check email
        if(empty($_POST['email']))
        {
            $erros['email']= "should not be empty </br>";
        }else{        
            $email= $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $erros['email']= 'email must be a valid email address';
            }
        }
            //check title
        if(empty($_POST['title']))
        {
            $erros['title']= "should not be empty </br>";
        }else{        
            $title=$_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$title))
            {
                $erros['title']= 'title must be letters and spaces only';
            }
        }
            //check ingredients
        if(empty($_POST['Ingredients']))
        {
            $erros['Ingredients']= "should be at least one Ingredients  </br>";
        }else{        
            $ingredients=$_POST['Ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients))
                {
                    $erros['Ingredients']= 'ingredients must be a comma separated list';
                }
        }
        if(array_filter(($erros))){
            //
        }else{
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $Ingredients=mysqli_real_escape_string($conn,$_POST['Ingredients']);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            //create sql
            $sql="INSERT INTO pizza(title,email,Ingredients)values('$title','$email','$Ingredients')";
            
            if(mysqli_query($conn,$sql)){
                //success
                header('location:index.php');
            }
            else{
                //error
                echo 'query error:'.mysqli_error($conn);
            }
        }
    }

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
    <section class="container grey-text">
        <h4 class=" center">Add a pizza</h4>
        <form action="add.php" class="white" method="POST">

            <label for="" >Your Email:</label>
            <input type="text" name="email" id="" value="<?php echo $email?>">
            <div class="red-text"><?php echo $erros['email']?></div>

            <label for="">Pizza Title</label>
            <input type="text" name="title" id="" value="<?php echo $title?>">
            <div class="red-text"><?php echo $erros['title']?></div>

            <label for="">Ingredients (comma seprated):</label>
            <input type="text" name="Ingredients" id="" value="<?php echo $Ingredients?>">
            <div class="red-text"><?php echo $erros['Ingredients']?></div>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
            </div>
        </form>
    </section>
    <?php include('tempets/footer.php')?>
</body>
</html>