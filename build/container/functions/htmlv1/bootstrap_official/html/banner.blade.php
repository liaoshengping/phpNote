<!-- Hero/Intro Slider Start -->
<div class="section">
    <div class="hero-slider swiper-container">
        <div class="swiper-wrapper">

            @foreach($items as $item)
                <div class="hero-slide-item swiper-slide"  style="position: relative">
                    <div class="hero-slide-bg">
                        <img src="{{$item['image_url']}}" alt="Slider Image"/>
                    </div>

                    <div class="container">
                        <div class="hero-slide-content">
                            @if(!empty($item['title_top']))
                                <p style="margin-bottom: 10px">{{$item['title_top']}}</p>
                            @endif
                            <h2 class="title m-0"> {{$item['title']}} </h2>
                            @if(!empty($item['title_sub']))
                                <p>{{$item['title_sub']}}</p>
                            @endif
                            @if(!empty($item['href']))
                                <a href="{{$item['href']['url']}}"
                                   class="btn btn-default btn-hover-light" style="border: #0c4128 1px solid">{{$item['href']['name']}}</a>
                            @endif
                        </div>
                    </div>
                    @if(!empty($item['title_right_image']))
                        <div  data-aos="fade-up" data-aos-delay="200" style="position: absolute;
    right: 50px;
    top: 90px;
    z-index: 10;">
                            <img class="md-none" style="width: 80%" src="{{$item['title_right_image']}}" alt="Slider Image"/>
                        </div>
                    @endif
                </div>
            @endforeach
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
<!-- Hero/Intro Slider End -->