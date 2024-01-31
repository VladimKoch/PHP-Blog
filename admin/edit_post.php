<?php include '../libraries/db_class.php';?>
<?php include '../admin/includes/header.php';?>
<?php include '../config/config.php';?>

<?php 
//get id from URL

$id = $_GET['id'];

// Vytvoření Tabulky

$db = new Database();

//Vytvoření Query

$query4 = 'SELECT * FROM posts WHERE id = ' .$id;

//Run Query

$idPost = $db -> select($query4)-> fetch_assoc();

//Categories query

$query = 'SELECT * FROM categories';

$categories = $db -> select($query);

?>

<?php 
if (isset($_POST['submit'])){

    //Přiřazené Proměných
    $title = mysqli_real_escape_string($db->conn,$_POST['title']);
    $body = mysqli_real_escape_string($db->conn,$_POST['body']);
    $category = mysqli_real_escape_string($db->conn,$_POST['category']);
    $author = mysqli_real_escape_string($db->conn,$_POST['author']);
    $tags = mysqli_real_escape_string($db->conn,$_POST['tags']);

     //Jednoduchá Validace
     if($title == '' || $body == '' || $category == '' || $author == '' || $tags == ''){
        $error = 'Prosím vyplňte všechna pole';

        echo $error;
        
    } else {
       
        $query = "UPDATE posts SET
                    title ='$title',
                    body = '$body',
                    category = '$category',
                    author = '$author',
                    tags='$tags'
                    WHERE id=".$id;


        $update_row = $db-> update($query);
    }
}

?>

<?php 


if (isset($_POST['delete'])){

   
        $query = "DELETE FROM posts WHERE id=".$id;
                 

        $delete_row = $db-> delete($query);
    
}





?>

<style>
    select {
      
        text-align-last: center; /* Pro některé prohlížeče */
        display: inline-block; /* Aby bylo možné použít vertikální zarovnání */
    }
    
    input{
        text-align: center;
    }

    label{
        color:#0dcaf0;
    }
   
</style>


    <div class="container align-content-center text-center">
        <br>
            <form method="POST" action="edit_post.php?id=<?php echo $id;?>">
    
                <div class="mb-3  w-50  m-auto">
                    <label for="exampleInputEmail1" class="form-label">Vlož Titul</label>
                    <input name="title" type="text" class="form-control"  value="<?php echo $idPost['title'];?> " aria-describedby="emailHelp">
                </div>
    
                <div class="mb-3  w-50 text-center m-auto">
                    <label for="exampleInputEmail1" class="form-label">Vlož Text</label>
                    <textarea name="body" rows="8"  type="text" class="form-control"  aria-describedby="emailHelp"><?php echo $idPost['body'];?></textarea>
                </div>

                <div class="mb-3 w-25 text-center m-auto">
                <label for="exampleInputEmail1" class="form-label text-align-last">Kategorie</label>
                
                <select name="category"  value="" class="form-control" >
                    <?php while($row = $categories->fetch_assoc()) : ?>
                        <?php if($row['id'] == $idPost['category']) {
                            $selected = 'selected';

                        } else {
                            $selected = '';
                        }
                            
                        ?>
                    <option value="<?php echo $row['id'];?>"<?php echo $selected;?>><?php echo $row['name'];?></option>
                    <?php endwhile; ?>
                </select>
                </div>
                
                <div class="mb-3  w-50 text-center m-auto">
                    <label for="exampleInputEmail1" class="form-label">Autor</label>
                    <input name="author" type="text" class="form-control" value="<?php echo $idPost['author'];?>"  aria-describedby="emailHelp">
                </div>

                <div class="mb-3  w-50 text-center m-auto">
                    <label for="exampleInputEmail1" class="form-label">Tagy</label>
                    <input name="tags" type="text" class="form-control" value="<?php echo $idPost['tags'];?>"  aria-describedby="emailHelp">
                </div>
                
                <br>
                
                <input name="submit" type="submit" class="btn btn-primary" value="Upravit">
                <a href="index.php" class=" btn btn-secondary">Cancel</a>
                <input name="delete" type="submit" class="btn btn-danger" value="Vymazat">
        </form>
        <br>
    </div>
    






<?php include '../includes/footer.php';?>