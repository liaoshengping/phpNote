<!-- Hero/Intro Slider Start -->
<div class="section">
    <div class="hero-slider swiper-container">
        <div class="swiper-wrapper">

            @foreach($items as $item)
                <div class="hero-slide-item swiper-slide">
                    <div class="hero-slide-bg">
                        <img src="{{$item['image_url']}}" alt="Slider Image"/>
                    </div>
                    <div class="container">
                        <div class="hero-slide-content">
                            <h2 class="title m-0"> {{$item['title']}} </h2>
                            @if(!empty($item['title_sub']))
                                <p>{{$item['title_sub']}}</p>
                            @endif
                            @if(!empty($item['href']))
                                <a href="{{$item['href']['url']}}"
                                   class="btn btn-primary btn-hover-light">{{$item['href']['name']}}</a>
                            @endif
                        </div>
                    </div>
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