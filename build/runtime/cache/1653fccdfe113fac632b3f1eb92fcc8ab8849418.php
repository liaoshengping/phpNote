<div style="width: 100%;" class="bg-gray" >
    <div class="container " >

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row bg-white" style="margin-bottom: 40px; margin-top: 40px" >
                <div class="col-12 col-md-4 ">
                    <img src="<?php echo e($item['image_url']); ?>">
                </div>
                <?php $__currentLoopData = $item['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-12 col-md-4 ">
                        <div style=" display: flex;align-items: center">
                            <div>
                                <img style="margin-left: -20px;" src="<?php echo e($i['image_url']); ?>">
                            </div>
                            <div>
                                <div><h5 style="color: #cb3131 !important;"><?php echo e($i['title']); ?></h5></div>
                                <div><?php echo e($i['ver']); ?></div>
                                <div><?php echo e($i['date']); ?></div>
                            </div>
                        </div>
                        <div>
                            <?php echo $i['content']; ?>

                        </div>
                        <a href="##">
                            <div style="background-color: #fddc7a; text-align:center;margin-top:20px;padding-bottom: 5px;padding-top: 5px;padding-right: 10px;padding-left: 10px;border-radius: 30px;width: 126px">
                                <?php echo e($i['button_text']); ?>

                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/download.blade.php ENDPATH**/ ?>