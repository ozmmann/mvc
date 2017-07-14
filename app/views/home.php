<?php
    $this->addJs('jquery.js');
    $this->title = 'Home page';
?>
<h1>Hello World</h1>

<?php foreach ($posts as $post):?>
    <h2><?= $post->title?></h2>
    <div class="content">
        <?= $post->content ?>
    </div>
    <div class="author">
        <?= $post->author ?>
    </div>
<?php endforeach;?>