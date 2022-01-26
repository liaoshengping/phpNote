<div class="section section-padding

<?php if(isset($bg_color)): ?>
<?php echo e($bg_color); ?>

<?php else: ?>
<?php if(empty($bg_style)): ?>
        bg-milky
        <?php endif; ?>

<?php endif; ?>

        "
     style="
<?php if(isset($bg_style)): ?>
     <?php echo e($bg_style); ?>

     <?php endif; ?>

             ">
    <div class="container">
        <div class="row d-flex justify-content-center flex-column  align-items-center mb-n6">
            <div data-aos="fade-up" data-aos-delay="200"
                 class="col-lg-12 mb-6 d-flex flex-column align-items-center justify-content-center ">
                <?php if(!empty($title)): ?>
                    <div><h2><?php echo e($title); ?></h2></div>
                <?php endif; ?>
                <?php if(isset($title_sub)): ?>
                    <div class="d-flex justify-content-center flex-column align-items-center"><?php echo $title_sub; ?></div>
                <?php endif; ?>
            </div>
            <?php if(!empty($items)): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-center mt-2" data-aos="fade-up" data-aos-delay="<?php echo e($key); ?>00">
                        <img src="<?php echo e($item['image_url']); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


        </div>
    </div>
</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/item_images.blade.php ENDPATH**/ ?>