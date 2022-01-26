<div class="section section-padding

@if(isset($bg_color))
{{$bg_color}}
@else
        bg-milky
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
            <?php

            $width = round(100 / count($items), 2);
            if (!empty($row)) {
                $width = $width * $row;
            } else {
                $row = 1;
            }
            ?>
            <div class="d-flex  w-100 flex-md-wrap flex-sm-wrap " style="flex-wrap: wrap" data-aos="fade-up"
                 data-aos-delay="600">
                @foreach($items as $key => $item)
                    <div class="d-flex justify-content-around " data-aos="fade-up"
                         data-aos-delay="{{$key}}000">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <div class="mt-2 mx-1" style="position: relative ;">
                                @if(!empty($item['image_center_icon']))
                                    <div style="position: absolute;width: 100%;height:100%;display: flex;justify-content: center;align-items: center">
                                        <div>
                                            <img src="{{$item['image_center_icon']}}">
                                            @if(!empty($item['center_text']))
                                                <div style="color: white;text-align: center">{{$item['center_text']}}</div>
                                            @endif
                                        </div>
                                    </div>

                                @endif
                                <img class="rounded-2" style="
                                @if(!empty($item['image_width']))
                                        width:{{$item['image_width']}}
                                @endif
                                        " src="{{$item['image_url']}}">
                            </div>
                            @isset($item['title'])
                                <div class="mt-2">
                                    <h6>{{$item['title']}}</h6>
                                </div>
                            @endisset

                            @isset($item['title_sub'])
                                <div class="d-flex justify-content-center flex-column align-items-center"
                                     style="text-align: center">
                                    {!! $item['title_sub'] !!}
                                </div>
                            @endisset

                            @if(!empty($item['bottom']))
                                {!! $item['bottom'] !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>

</div>

<style>
    {{--style="width: calc(calc(100% / {{count($items)/$row}}) - 10px)"--}}
    ._width {
        width: {{$width}}%;
    }

    /*@media screen and (max-width: 992px) {*/

    /*    ._width{*/
    /*        width: 50%;*/
    /*    }*/
    /*}*/

</style>