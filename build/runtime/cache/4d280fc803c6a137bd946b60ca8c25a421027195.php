<div class="section testimonial-bg" style="background-image: url(<?php echo e($bg_image_url); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Title Start -->
                <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="title"><?php echo $title; ?></h2>

                </div>
                <!-- Section Title End -->

                <!-- Testimonial Carousel Start -->
                <div class="testimonial-carousel aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                    <div class=""  style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                        <?php if(!empty($image_url)): ?>
                            <img style="width: 250px" src="<?php echo e($image_url); ?>">
                            <?php endif; ?>

                            <?php if(!empty($title_sub)): ?>
                        <div style="display: flex;justify-content: center"><?php echo $title_sub; ?></div>
                        <?php endif; ?>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white d-none" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-cf150e7d06f11012"></div>
                        <div class="swiper-button-prev swiper-button-white d-none" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-cf150e7d06f11012"></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
                <!-- Testimonial Carousel End -->
            </div>
        </div>
    </div>
</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/qr_min.blade.php ENDPATH**/ ?>