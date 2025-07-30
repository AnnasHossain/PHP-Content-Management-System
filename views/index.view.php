<?php /* <pre><?php var_dump($images); ?></pre> */ ?>
<?php if(!empty($images)): ?>
    <div class="image-gallery">
        <?php foreach($images AS $image): ?>
            <figure class="image-gallery-item">
                <img class="image-gallery-image" src="./images/<?php echo $image->src; ?>" />
                <figcaption><?php echo e($image->title); ?></figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Es wurden bisher noch keine Bilder erfasst.</p>
<?php endif; ?>