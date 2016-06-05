<h1><?=htmlspecialchars($data['post']['content']['header'])?> by node <?=htmlspecialchars($data['post']['node'])?></h1>
<div>
    <?=htmlspecialchars($data['post']['content']['body'])?>
</div>
<hr>
<h2>Comments by node <?=htmlspecialchars($data['comments']['node'])?></h2>
<?php
foreach ($data['comments']['content'] as $comment) {
    ?>
    <h2>Name is: <?=htmlspecialchars($comment['name'])?></h2>
    <div>
        <?=htmlspecialchars($comment['text'])?>
    </div>
    <?php
}
?>