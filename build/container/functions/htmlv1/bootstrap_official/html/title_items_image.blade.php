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
                <div><h2>{{$title}}</h2></div>
                @isset($title_sub)
                    <div class="d-flex justify-content-center flex-column align-items-center">{!! $title_sub !!}</div>
                @endisset
            </div>
            <?php
            $count = count($items);
            $col = 12 / $count;
            $colmd = $col * 2;
            $row = isset($row)?$row:1;
            $row_num = count($items)/$row;
            if ($row >1){
                $col = 12/$row_num;
            }
            $row_count = 1;
            $item_count =0;
            ?>

            @for($i=0;$i<$row;$i++)
                @php
                    $row_count ++;
                @endphp

                <div class="d-flex col-lg-12 row " data-aos="fade-up" data-aos-delay="600">
                    @foreach($items as $key => $item)
                        @php
                                $item_count++;
                                if ($row_count * $row_num <= $item_count){ continue;}
                        @endphp

                        <div class="col-lg-{{$col}} col-md-{{$colmd}} d-flex justify-content-center" data-aos="fade-up"
                             data-aos-delay="{{$key}}000">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="mt-2 mx-1">
                                    <img class="rounded-2" src="{{$item['image_url']}}">
                                </div>
                                @isset($item['title'])
                                    <div class="mt-2">
                                        <h6>{{$item['title']}}</h6>
                                    </div>
                                @endisset

                                @isset($item['title_sub'])
                                    <div class="d-flex justify-content-center flex-column align-items-center">
                                        {!! $item['title_sub'] !!}
                                    </div>
                                @endisset
                            </div>
                        </div>
                    @endforeach
                </div>
            @endfor


        </div>
    </div>

</div>