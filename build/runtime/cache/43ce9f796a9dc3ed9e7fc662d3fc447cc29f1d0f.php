<div class="section section-padding

<?php if(isset($bg_color)): ?>
<?php echo e($bg_color); ?>

<?php else: ?>
        bg-milky
<?php endif; ?>
        ">
    <div class="container">
        <div class="row d-flex justify-content-center flex-column  align-items-center mb-n6">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-center mt-2" data-aos="fade-up" data-aos-delay="<?php echo e($key); ?>00" >
                    <img src="<?php echo e($item['image_url']); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/item_images.blade.php ENDPATH**/ ?>