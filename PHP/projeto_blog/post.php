<?php
  include_once("templates/header.php")
?>

<?php

    if(isset($_GET['id'])) {
        $postId = $_GET['id'];
        $currentPost;

        foreach($posts as $post) {
            if($post['id'] == $postId) {
                $currentPost = $post;
            }
        }
    }
    
?>

<main class="container-main">
    <header class="post-page-header">
        <h1 class="post-page-title">
            <?= $currentPost['title'] ?>
        </h1>
        <p class="post-page-description">
            <?= $currentPost['description'] ?>
        </p>
        <hr>
    </header>
    <section class="page-content">
        <section class="main-content">
            <div class="post-page-image">
                <img src="<?= $BASE_URL ?>/img/<?= $currentPost['img'] ?>" alt="">
            </div>
            <p class="post-page-content">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur delectus iusto a qui amet assumenda dolor nam consequatur quia voluptatem! Vel nisi iste ex itaque a voluptates reprehenderit cum porro! Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat consequuntur asperiores perferendis aliquam eaque, hic doloremque sequi officia voluptatum culpa, non libero. Exercitationem id soluta vitae assumenda, rerum nemo unde. Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident rem nihil animi culpa dolores sed placeat, error ullam quidem, minus suscipit. Ab, quibusdam eos incidunt cupiditate voluptates dignissimos dolorem similique? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores placeat dolores fuga qui tempora iure earum nulla, velit, asperiores, illum optio eligendi tenetur illo consectetur? Quam dolorum iure quaerat. Ab? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero magnam aperiam iure repellendus cupiditate. Quos maiores, aut sunt velit quo explicabo, quidem neque, provident enim similique doloribus reprehenderit error nemo. Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita eius quo, mollitia perspiciatis fuga adipisci, quidem, voluptates minus similique neque excepturi nulla! Unde voluptate inventore nobis quibusdam officia fugiat qui.
            </p>
        </section>
        <section class="aside-content">
            <div>
                <div class="post-page-tags-title">
                    <h2>Tags</h2>
                </div>
                <ul class="tags-list post-tags-list">
                    <?php 
                    foreach($currentPost['tags'] as $tag): 
                    ?>
                    <li class="post-tag">
                        <a href="#"> <?= $tag ?> </a>
                    </li>
                    <?php
                    endforeach 
                    ?>
                </ul>
            </div>
        </section>
    </section>
</main>

<?php
  include_once("templates/footer.php")
?>