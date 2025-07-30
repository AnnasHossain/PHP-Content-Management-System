<?php /* <pre><?php var_dump($images); ?></pre> */ ?>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <h3>Bild hochladen</h3>
    <label for="upload-title">Titel:</label><br />
    <input type="text" name="title" id="upload-title" />

    <br />
    <label for="upload-image">Bild auswählen:</label><br />
    <input type="file" name="image" id="upload-image" />
    <input type="submit" value="Abschicken!" />
</form>

<?php if(!empty($images)): ?>
    <table>
        <thead>
            <tr>
                <th>Bild</th>
                <th>Titel</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($images AS $image): ?>
                <tr>
                    <td><img src="../images/<?php echo $image->src; ?>" style="width: 10rem;" /></td>
                    <td><?php echo e($image->title); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo e($image -> id); ?>">Edit</a>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo e($image->id); ?>" />
                            <input type="submit" value="Löschen" class="button-as-link" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php /*
    <div class="image-gallery">
        <?php foreach($images AS $image): ?>
            <figure class="image-gallery-item">
                <img class="image-gallery-image" src="../images/<?php echo $image->src; ?>" />
                <figcaption><?php echo e($image->title); ?></figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
    */ ?>
<?php else: ?>
    <p>Es wurden bisher noch keine Bilder erfasst.</p>
<?php endif; ?>