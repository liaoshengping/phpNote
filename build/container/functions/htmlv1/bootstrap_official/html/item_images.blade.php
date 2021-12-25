<div class="section section-padding

@if(isset($bg_color))
{{$bg_color}}
@else
        bg-milky
@endif
        ">
    <div class="container">
        <div class="row d-flex justify-content-center flex-column  align-items-center mb-n6">
            @foreach($items as $key=>$item)
                <div class="d-flex justify-content-center mt-2" data-aos="fade-up" data-aos-delay="{{$key}}00" >
                    <img src="{{$item['image_url']}}">
                </div>
            @endforeach
        </div>
    </div>
</div>