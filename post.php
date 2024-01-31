<?php include './config/config.php';?>
<?php include './includes/header.php';?>
<?php include './libraries/db_class.php';?>
<?php include './helpers/format_helper.php';?>

<?php 
//get id from URL

$id = $_GET['id'];

// Vytvoření Tabulky

$db = new Database();

//Vytvoření Query

$query4 = 'SELECT * FROM posts WHERE id = ' .$id;

//Run Query

$idPost = $db -> select($query4)-> fetch_assoc();

?>


  <div class="container col-md-6">
    <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success-emphasis">POST</strong>
        <h3 class="mb-0"><?php echo $idPost['title'];?></h3>
          <div class="mb-1 text-body-secondary"><?php echo formatDate($idPost['date']);?></div>
            <p class="mb-auto"><?php echo $idPost['body'];?></p>
          </div>
    <div class="col-auto d-none d-lg-block">          
  </div>
</div>
      
    


<?php include 'includes/footer.php';?>