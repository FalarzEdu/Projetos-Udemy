<?php
  include_once("templates/header.php")
?>
<main class="container-main">
  <header id="page-title">
    <h1>Coding blog</h1>
    <h2>Your programming blog</h2>
  </header>
  <section class="page-content">
    <section id="posts">
      <?php 
        foreach($posts as $post):
      ?>
      <div class="post-box">
      <img src="<?= $BASE_URL ?>/img/<?= $post['img'] ?>" alt="<?= $post['title'] ?>" class="post-img">
        <h2> 
          <a class="post-title" href="<?= $BASE_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a> 
        </h2>
        <p class="post-description"> <?= $post['description'] ?> </p>
        <ul class="tags-list">
        <?php
          foreach($post['tags'] as $tag):
        ?>

        <li class="post-tag"> <a href="#"> <?= $tag ?> </a></li>

        <?php 
          endforeach;
        ?>
        </ul>
      </div>
      
      <?php 
        endforeach;
      ?>
    </section>
    <section class="aside-content">
        <div>
            <div class="post-page-tags-title">
                <h2>Tags</h2>
            </div>
            <ul class="tags-list post-tags-list">
                <?php 
                foreach($tags as $tag): 
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