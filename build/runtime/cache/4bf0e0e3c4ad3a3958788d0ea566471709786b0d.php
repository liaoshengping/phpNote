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
                <?php if(!empty($title)): ?>
                    <div><h2><?php echo e($title); ?></h2></div>

                <?php endif; ?>
                <?php if(isset($title_sub)): ?>
                    <div class="d-flex justify-content-center flex-column align-items-center"><?php echo $title_sub; ?></div>
                <?php endif; ?>
            </div>
            <?php

            $width = round(100 / count($items), 2);
            if (!empty($row)) {
                $width = $width * $row;
            } else {
                $row = 1;
            }
            ?>
            <div class="d-flex  w-100 flex-md-wrap flex-sm-wrap " style="flex-wrap: wrap" data-aos="fade-up"
                 data-aos-delay="600">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-around " data-aos="fade-up"
                         data-aos-delay="<?php echo e($key); ?>000">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <div class="mt-2 mx-1" style="position: relative ;">
                                <?php if(!empty($item['image_center_icon'])): ?>
                                    <div style="position: absolute;width: 100%;height:100%;display: flex;justify-content: center;align-items: center">
                                        <div>
                                            <img src="<?php echo e($item['image_center_icon']); ?>">
                                            <?php if(!empty($item['center_text'])): ?>
                                                <div style="color: white;text-align: center"><?php echo e($item['center_text']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                <?php endif; ?>
                                <img class="rounded-2" style="
                                <?php if(!empty($item['image_width'])): ?>
                                        width:<?php echo e($item['image_width']); ?>

                                <?php endif; ?>
                                        " src="<?php echo e($item['image_url']); ?>">
                            </div>
                            <?php if(isset($item['title'])): ?>
                                <div class="mt-2">
                                    <h6><?php echo e($item['title']); ?></h6>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($item['title_sub'])): ?>
                                <div class="d-flex justify-content-center flex-column align-items-center"
                                     style="text-align: center">
                                    <?php echo $item['title_sub']; ?>

                                </div>
                            <?php endif; ?>

                            <?php if(!empty($item['bottom'])): ?>
                                <?php echo $item['bottom']; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


        </div>
    </div>

</div>

<style>
    
    ._width {
        width: <?php echo e($width); ?>%;
    }

    /*@media  screen and (max-width: 992px) {*/

    /*    ._width{*/
    /*        width: 50%;*/
    /*    }*/
    /*}*/

</style><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/title_items_image.blade.php ENDPATH**/ ?>