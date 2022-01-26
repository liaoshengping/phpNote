
<!-- About Section Start -->
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

        <div class="row align-items-center mb-n6">
            <?php if(isset($big_title)): ?>
                <div data-aos="fade-up" data-aos-delay="100" style="font-size: 40px; margin-bottom: 20px;display: flex;justify-content: center;" class="col-lg-12 d-flex justify-content-center">
                    <?php echo $big_title; ?>

                </div>
            <?php endif; ?>


            <div class="col-lg-7 mb-6">

                <!-- About Content Start  -->
                <div class="about-content" data-aos="fade-up" data-aos-delay="600">
                    <div class="about-title">
                        <?php if(isset($title)): ?>
                            <?php echo $title; ?>

                        <?php endif; ?>
                    </div>
                    <div >
                        <?php if(isset($text)): ?>
                            <?php echo $text; ?>

                        <?php endif; ?>
                    </div>
                </div>
                <!-- About Content End -->

            </div>

            <div class="col-lg-5 mb-6">

                <!-- About Thumb Start -->
                <div class="about-thumb" data-aos="fade-up" data-aos-delay="200">
                    <img class="fit-image" src="<?php echo e($image_url); ?>" alt="About Image">
                </div>
                <!-- About Thumb End -->

            </div>

        </div>

    </div>
</div><?php /**PATH E:\linuxdir\php\phpNote\build\container\functions\htmlv1\bootstrap_official\html/image_right_section.blade.php ENDPATH**/ ?>