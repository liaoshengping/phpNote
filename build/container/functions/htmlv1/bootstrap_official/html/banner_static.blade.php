<div class="section testimonial-bg" style="background-image: url({{$bg_image_url}});">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12 col-12" style="display: flex;justify-content: center;align-items: center">
                <div>
                    @if(!empty($image_left))
                        <img src="{{$image_left}}">
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 col-12" style="display: flex;justify-content: center;align-items: center">
                <div>
                    @if(!empty($image_right))
                        <img src="{{$image_right}}">
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>