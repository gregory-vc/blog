<h1>List all post of node <?=htmlspecialchars($data['node'])?></h1>
<a href="/post/add/">[ Add post ]</a>
<?php
    foreach ($data['content'] as $post) {
?>
    <h2><?=htmlspecialchars($post['header'])?> <a href="/post/?id=<?=htmlspecialchars($post['post_id'])?>">[ View ]</a></h2>
        <div>
            <?=htmlspecialchars($post['body'])?>
        </div>
<?php
    }
?>