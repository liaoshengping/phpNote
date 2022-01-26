
<!-- About Section Start -->
<div class="section section-padding

@if(isset($bg_color))
{{$bg_color}}
@else
@if(empty($bg_style))
        bg-milky
        @endif

@endif

        "
     style="
@if(isset($bg_style))
     {{$bg_style}}
     @endif

">
    <div class="container">

        <div class="row align-items-center mb-n6">
            @isset($big_title)
                <div data-aos="fade-up" data-aos-delay="100" style="font-size: 40px; margin-bottom: 20px;display: flex;justify-content: center;" class="col-lg-12 d-flex justify-content-center">
                    {!! $big_title !!}
                </div>
            @endisset


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