<div class="section section-padding

<?php if(isset($bg_color)): ?>
<?php echo e($bg_color); ?>

<?php else: ?>
        bg-milky
<?php endif; ?>

        ">
    <div class="container">
        <div class="row d-flex justify-content-center flex-column  align-items-center mb-n6">

            <div data-aos="fade-up" data-aos-delay="200"
                 class="col-lg-12 mb-6 d-flex flex-column align-items-center justify-content-center ">
                <div><h2><?php echo e($title); ?></h2></div>
                <?php if(isset($title_sub)): ?>
                    <div class="d-flex justify-content-center flex-column align-items-center"><?php echo $title_sub; ?></div>
                <?php endif; ?>
            </div>
            <?php
            $count = count($items);
            $col = 12 / $count;
            $colmd = $col * 2;
            $row = isset($row)?$row:1;

            $row_num = count($items)/$row;

            if ($row >1){
                $col = 12/$row_num;
            }
            $row_count = 1;
            $item_count =0;
            ?>

            <?php for($i=0;$i<$row;$i++): ?>
                <?php
                    $row_count ++;
                ?>

                <div class="d-flex col-lg-12 row " data-aos="fade-up" data-aos-delay="600">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                                $item_count++;
                                if ($row_count * $row_num <= $item_count){ continue;}
                        ?>

                        <div class="col-lg-<?php echo e($col); ?> col-md-<?php echo e($colmd); ?> d-flex justify-content-center" data-aos="fade-up"
                             data-aos-delay="<?php echo e($key); ?>000">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="mt-2 mx-1">
                                    <img class="rounded-2" src="<?php echo e($item['image_url']); ?>">
                                </div>
                                <?php if(isset($item['title'])): ?>
                                    <div class="mt-2">
                                        <h6><?php echo e($item['title']); ?></h6>
                                    </div>
                                <?php endif; ?>

                                <?php if(isset($item['title_sub'])): ?>
                                    <div class="d-flex justify-content-center flex-column align-items-center">
                                        <?php echo $item['title_sub']; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endfor; ?>


        </div>
    </div>

</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/title_items_image.blade.php ENDPATH**/ ?>