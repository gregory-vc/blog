<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>My Blog</title>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<a href="/">[ Main ]</a>
<?php

if (\My\Services\Auth::isLogin()) {?>

    You login as <?=htmlspecialchars(\My\Services\Auth::getUser()['login'])?>
    <a href="/logout/">[ Logout ]</a>
    <?php
} else {
?>
<a href="/login/">[ Login ]</a>

<?php } ?>
<h1>My blog</h1>
<?=$contents?>
</body>
</html>