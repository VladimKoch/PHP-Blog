<?php include '../config/config.php';?>
<?php include '../libraries/db_class.php';?>
<?php include '../helpers/format_helper.php';?>
<?php include '../admin/includes/header.php'; ?>
<?php





// Vytvoření Databáze

$db = new Database();
$db -> createTable();

// Select Inner Join Posts and Categories

$query = 'SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.category = categories.id
            ORDER BY posts.title DESC';

$posts = $db -> select($query);

// Select Category


$query1 = 'SELECT * FROM categories ORDER by name';
$categories = $db -> select($query1);



?>


<!---------------------------------------------------------------------------------------->
<!---------------------------------       CONTENT      ----------------------------------->
<!---------------------------------------------------------------------------------------->



<!-- create post table -->
<table class="container table table-striped">
        <tr>
            <th>POST ID#</th>
            <th>POST Titul</th>
            <th>Kategorie</th>
            <th>Autor</th>
            <th>Datum</th>
        </tr>
        <!-- print all data from posts table -->

    <?php if ($posts == ""):?>
        <br>
        <div class=" container text-center"><h2 class="btn btn-danger">Posty nebyly doposud vloženy</h2></div>
        <br>

    <?php else:?>

        <?php while ($row = $posts -> fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><a href="edit_post.php?id=<?php echo $row['id']?>"><?php echo $row['title']?></a></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['author']?></td>
                <td><?php echo formatDate($row['date'])?></td>
                <?php echo '<br>' ?>
                <?php endwhile; ?>  
            </tr>
    <?php endif;?>

</table>

<!-- create category table -->
<table class="container table table-striped">
    <tr>
        <th>Kategorie ID#</th>
        <th>Kategorie Název</th>
        
    </tr>
    <!-- print all from categories table -->

    <?php if($categories == ""):?>
        <br>
        <div class=" container text-center"><h2 class="btn btn-danger">Kategorie nebyly doposud vloženy</h2></div>
        <br>
    <?php else:?>

        <?php while ($row = $categories -> fetch_assoc()):?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><a href="edit_category.php?id=<?php echo $row['id'];?>"><?php echo $row['name']; ?></td>
        </tr>
        <?php endwhile; ?>

    <?php endif;?>

</table>


<?php include '../admin/includes/footer.php'; ?>
