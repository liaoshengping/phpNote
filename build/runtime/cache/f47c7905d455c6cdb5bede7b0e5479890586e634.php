<!-- Hero/Intro Slider Start -->
<div class="section">
    <div class="hero-slider swiper-container">
        <div class="swiper-wrapper">

            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="hero-slide-item swiper-slide"  style="position: relative">
                    <div class="hero-slide-bg">
                        <img src="<?php echo e($item['image_url']); ?>" alt="Slider Image"/>
                    </div>

                    <div class="container">
                        <div class="hero-slide-content">
                            <?php if(!empty($item['title_top'])): ?>
                                <p style="margin-bottom: 10px"><?php echo e($item['title_top']); ?></p>
                            <?php endif; ?>
                            <h2 class="title m-0"> <?php echo e($item['title']); ?> </h2>
                            <?php if(!empty($item['title_sub'])): ?>
                                <p><?php echo e($item['title_sub']); ?></p>
                            <?php endif; ?>
                            <?php if(!empty($item['href'])): ?>
                                <a href="<?php echo e($item['href']['url']); ?>"
                                   class="btn btn-default btn-hover-light" style="border: #0c4128 1px solid"><?php echo e($item['href']['name']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(!empty($item['title_right_image'])): ?>
                        <div  data-aos="fade-up" data-aos-delay="200" style="position: absolute;
    right: 50px;
    top: 90px;
    z-index: 10;">
                            <img class="md-none" style="width: 80%" src="<?php echo e($item['title_right_image']); ?>" alt="Slider Image"/>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!-- Swiper Pagination Start -->
        <div class="swiper-pagination d-lg-none"></div>
        <!-- Swiper Pagination End -->

        <!-- Swiper Navigation Start -->
        <div class="home-slider-prev swiper-button-prev main-slider-nav d-lg-flex d-none"><i
                    class="pe-7s-angle-left"></i></div>
        <div class="home-slider-next swiper-button-next main-slider-nav d-lg-flex d-none"><i
                    class="pe-7s-angle-right"></i></div>
        <!-- Swiper Navigation End -->
    </div>
</div>
<!-- Hero/Intro Slider End --><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/banner.blade.php ENDPATH**/ ?>