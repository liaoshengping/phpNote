
<!-- About Section Start -->
<div class="section section-padding

@if(isset($bg_color))
{{$bg_color}}
@else
        bg-milky
@endif

">
    <div class="container">

        <div class="row align-items-center mb-n6">



            <div class="col-lg-7 mb-6">

                <!-- About Content Start  -->
                <div class="about-content" data-aos="fade-up" data-aos-delay="600">
                    <div class="about-title">
                        @isset($title)
                            {!! $title !!}
                        @endisset
                    </div>
                    <div >
                        @isset($text)
                            {!! $text !!}
                        @endisset
                    </div>
                </div>
                <!-- About Content End -->

            </div>

            <div class="col-lg-5 mb-6">

                <!-- About Thumb Start -->
                <div class="about-thumb" data-aos="fade-up" data-aos-delay="200">
                    <img class="fit-image" src="{{$image_url}}" alt="About Image">
                </div>
                <!-- About Thumb End -->

            </div>

        </div>

    </div>
</div>