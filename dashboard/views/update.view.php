<h3>Das ist die Edit-Seite</h3>
<form action="edit.php" method="post"><?php // ginge auch mit "edit.php?id= hier drin php-code" danach müsste aber method="GET" ?>
    <input type="hidden" name="id" value="<?php echo e($galleryImage->id); ?>" />
    <input type="text" name="title" value="<?php echo e($galleryImage->title); ?>" />
    <input type="submit" value="Edit">
</form>
<a href="dashboard.php">Zurück zur Übersicht</a>

