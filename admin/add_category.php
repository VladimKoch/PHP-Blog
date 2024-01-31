<?php include '../libraries/db_class.php';?>
<?php include 'includes/header.php';?>

<?php

//Vytvoření Databáze

$db = new Database();


if (isset($_POST['submit'])){
    
    //Přiřazené Proměných
    $name = mysqli_real_escape_string($db->conn,$_POST['name']);
  

    //Jednoduchá Validace
    if($name == ''){
        $error = 'Prosím vyplňte pole';

        echo $error;
        
    } else {
       
        $query = "INSERT INTO categories(name)VALUES('$name')";

        $update_row = $db-> insert($query);

        // header("Location: ../admin/index.php?msg=".urlencode('Record Updated'));
    }


}

// Query z databáze

$query = "SELECT * FROM categories";
$categories = $db ->select($query);


?>

<style>
    select {
      
        text-align-last: center; /* Pro některé prohlížeče */
        display: inline-block; /* Aby bylo možné použít vertikální zarovnání */
    }
    label{
        color:#0dcaf0;
    }
   
   
</style>

<div class="container align-content-center text-center">
    <br>
        <form method="POST" action="./add_category.php">

            <div class="mb-3  w-50  m-auto">
                <label for="exampleInputEmail1" class="form-label">Vlož název Kategorie</label>
                <input name="name" type="text" class="form-control"   aria-describedby="emailHelp">
            </div>
         
            <button name="submit" type="submit" class="btn btn-primary">Potvrď</button>
            <a href="index.php" class=" btn btn-secondary">Cancel</a>
    </form>
    <br>
</div>



<?php include '../includes/footer.php';?>