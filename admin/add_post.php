<?php include '../libraries/db_class.php';?>
<?php include 'includes/header.php';?>
<?php include '../config/config.php';?>

<?php

//Vytvoření Databáze

$db = new Database();


if (isset($_POST['submit'])){
    
    //Přiřazené Proměných
    $title = mysqli_real_escape_string($db->conn,$_POST['title']);
    $body = mysqli_real_escape_string($db->conn,$_POST['body']);
    $category = mysqli_real_escape_string($db->conn,$_POST['category']);
    $author = mysqli_real_escape_string($db->conn,$_POST['author']);
    $tags = mysqli_real_escape_string($db->conn,$_POST['tags']);

    //Jednoduchá Validace
    if($title == '' || $body== '' || $category=='' || $author=='' || $tags == ''){
        $error = 'Prosím vyplňte všechna pole';

        echo $error;
        
    } else {
       
        $query = "INSERT INTO posts(title,body,category,author,tags)VALUES('$title','$body',$category,'$author','$tags')";

        $insert_row = $db-> insert($query);
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

<br>
<div class="container align-content-center text-center">
    <br>
        <form method="POST" action="add_post.php">

            <div class="mb-3  w-50  m-auto">
                <label for="exampleInputEmail1" class="form-label">Vlož Titul</label>
                <input name="title" type="text" class="form-control"   aria-describedby="emailHelp">
            </div>
            <div class="mb-3  w-50 text-center m-auto">
                <label for="exampleInputEmail1" class="form-label">Vlož Text</label>
                <textarea name="body" type="text" class="form-control"   aria-describedby="emailHelp"></textarea>
            </div>
            
            <div class="mb-3 w-25 text-center m-auto">
                <label for="exampleInputEmail1" class="form-label text-align-last">Kategorie</label>
                <?php if($categories == ""):?>
                    <br>
                    <div class=" container text-center"><h2 class="btn btn-danger">Nejprve vložte kategorii</h2></div>
                    <br>
                    <?php else :?>
                        <select name="category"  class="form-control" >
                            <?php while ($row = $categories -> fetch_assoc()):?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
                            <?php endwhile;?>
                        </select>
                <?php endif ;?>
                
            </div>
            
            <div class="mb-3  w-50 text-center m-auto">
                <label for="exampleInputEmail1" class="form-label">Autor</label>
                <input name="author" type="text" class="form-control"   aria-describedby="emailHelp"></textarea>
            </div>

            <div class="mb-3  w-50 text-center m-auto">
                <label for="exampleInputEmail1" class="form-label">Tagy</label>
                <input name="tags" type="text" class="form-control"   aria-describedby="emailHelp"></textarea>
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Potvrď</button>
            <a href="index.php" class=" btn btn-secondary">Cancel</a>
    </form>
    <br>
    
</div>




<?php include '../includes/footer.php';?>