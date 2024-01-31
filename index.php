<?php include './config/config.php';?>
<?php include './includes/header.php';?>
<?php include './libraries/db_class.php';?>
<?php include './helpers/format_helper.php';?>

<?php 
// Vytvoření Tabulky

$db = new Database();



//Vytvoření Query

$query = 'SELECT * FROM posts ORDER BY id DESC';
$query2 = 'SELECT * FROM categories';
$query3 = 'SELECT * FROM posts ORDER BY id DESC';


//Run Query

$posts = $db -> select($query);
$categories = $db -> select($query2);
$posts2 = $db -> select($query3);

?>




<main class="container">
    <div class="logo text-center"><img src="/images/logo.png"></div>
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
      <h1 class="display-4 fst-italic">PHP Novinky, cvičení, videa & více</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="post.php?id=1" class="readmore text-body-emphasis fw-bold">Čti více</a></p>
    </div>
  </div>

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

<div class=" "></div>

  

  <div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the Firehose
      </h3>


     

      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
        <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0"><?php echo $site_description;?></p>
        </div>

        <div>
          <h4 class="fst-italic">Recent posts</h4>
          <ul class="list-unstyled">
            <?php if ($posts2):?>
              <?php while($row = $posts2->fetch_assoc()):?>
                <li>
                  <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                    <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                    <div class="col-lg-8">
                      <h6 class="mb-0"><?php echo $row['title'];?></h6>
                      <small class="text-body-secondary"><?php echo formatDate($row['date']);?></small>
                    </div>
                  </a>
                </li>
              <?php endwhile;?>
              <?php else : ?>
              <p> Není zde žádný post <p>
            <?php endif;?>
          
          </ul>
        </div>
        <div class="p-4">
          <h4 class="fst-italic">Kategorie</h4>
          <?php if ($categories) : ?>
            <ol class="list-unstyled mb-0">
              <?php while ($row = $categories -> fetch_assoc()) : ?>
                <li><a href="posts.php?category=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></li>
              <?php endwhile; ?>
            </ol>
            <?php else : ?>
              <p> nejsou zde žádné kategorie </p>
            <?php endif; ?>
        </div>

      
      </div>
    </div>
  </div>

</main>

<?php include 'includes/footer.php';?>