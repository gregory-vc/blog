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
<h3>Add comment</h3>
<form action="/comment/add_request/" method="post">
    <div>Name</div>
    <div><input type="text" style="width: 600px" name="name"></div>
    <div style="margin-top: 20px">Text</div>
    <div><textarea style="width: 600px; height: 200px;" name="text"></textarea></div>
    <input type="hidden" value="<?=htmlspecialchars($params['id'])?>" name="post_id">
    <div><input type="submit" value="Submit"><div>
</form>
