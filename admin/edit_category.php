<?php include '../libraries/db_class.php';?>
<?php include '../admin/includes/header.php';?>
<?php include '../config/config.php';?>



<?php 
//get id from URL

$id = $_GET['id'];

// Vytvoření Tabulky

$db = new Database();

//Vytvoření Query

$query4 = 'SELECT * FROM categories WHERE id = ' .$id;

//Run Query

$idCategories = $db -> select($query4)-> fetch_assoc();


//DElete Query 


// výběr všecho z tabulky categories podle Id

$query = 'SELECT * FROM categories WHERE id='.$id;
$allCategories = $db->select($query) -> fetch_assoc();



?>


<?php 
// Vložení kategorie
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($db->conn,$_POST['name']);
    //Jednoduchá validace
    if($name == ""){
        echo 'Vyplntě pole pro název kategorie';
    }
    else{
        $query = "UPDATE categories SET
                    name = '$name'
                    WHERE id=".$id;
        $update_categories = $db -> update($query);
    }
}

?>


<?php 
// Vymazání kategorie
if(isset($_POST['delete'])){
    $query = "DELETE FROM categories WHERE id=".$id;

    $delete_category = $db->delete($query);
}





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
    <form method="POST" action="edit_category.php?id=<?php echo $id?>">

            <div class="mb-3  w-50  m-auto">
                <label for="exampleInputEmail1" class="form-label">Název Kategorie</label>
                <input name="name" type="text"  value="<?php echo $allCategories['name']; ?>" class="form-control" >
                
            </div>
         
            <input name="submit" type="submit" class="btn btn-primary" value="Upravit">
            <a href="index.php" class=" btn btn-secondary">Cancel</a>
            <input name="delete" type="submit" class="btn btn-danger" value="Vymaž">
        <br>
    </form>
<br>

</div>



<?php include '../includes/footer.php';?>