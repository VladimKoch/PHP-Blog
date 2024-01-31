<?php include './config/config.php';?>
<?php include './includes/header.php';?>
<?php include './libraries/db_class.php';?>
<?php include './helpers/format_helper.php';?>


<?php 

//Create DB connection
$db = new Database;


// Check URL for category
if(isset($_GET['category'])){
  //Get Category
  $category = $_GET['category'];
  //Query
  $query4 = "SELECT * FROM posts WHERE category =" . $category . "ORDER BY id DESC";
  //DB select
  $categories = $db -> select($query4) -> fetch_assoc();

}

else {
  $query3 = 'SELECT * FROM posts';
  $posts2 = $db -> select($query3);
}


//Vytvoření Query

$query = 'SELECT * FROM posts';
$query2 = 'SELECT * FROM categories';


//Run Query

$posts = $db -> select($query);
$categories = $db -> select($query2);

// $category = $db -> select($query4) -> fetch_assoc();


?>

<main class="container">
    

  
<?php if ($posts):?>
    <?php while($row = $posts->fetch_assoc()):?>
      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
              <h3 class="mb-0"><?php echo $row['title'];?></h3>
              <div class="mb-1 text-body-secondary"><?php echo formatDate($row['date']);?></div>
              <p class="card-text mb-auto"><?php echo shortenText($row['body']);?></p>
              <a href="post.php?id=<?php echo urlencode($row['id']);?>" class="icon-link gap-1 icon-link-hover stretched-link">
                Continue reading
                <svg class="bi"><use xlink:href="#chevron-right"/></svg>
              </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else : ?>
      <p> Ještě zde nejsou žádne posty<p>

    <?php endif ; ?>
      
     

      <nav class="blog-pagination" aria-label="Pagination">
          <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
          <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
        </nav>
        
    </div>
    
    
    
  </div>

</main>



<?php include 'includes/footer.php';?>