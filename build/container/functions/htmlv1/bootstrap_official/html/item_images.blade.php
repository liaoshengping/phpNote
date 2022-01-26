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
        <div class="row d-flex justify-content-center flex-column  align-items-center mb-n6">
            <div data-aos="fade-up" data-aos-delay="200"
                 class="col-lg-12 mb-6 d-flex flex-column align-items-center justify-content-center ">
                @if(!empty($title))
                    <div><h2>{{$title}}</h2></div>
                @endif
                @isset($title_sub)
                    <div class="d-flex justify-content-center flex-column align-items-center">{!! $title_sub !!}</div>
                @endisset
            </div>
            @if(!empty($items))
                @foreach($items as $key=>$item)
                    <div class="d-flex justify-content-center mt-2" data-aos="fade-up" data-aos-delay="{{$key}}00">
                        <img src="{{$item['image_url']}}">
                    </div>
                @endforeach
            @endif


        </div>
    </div>
</div>