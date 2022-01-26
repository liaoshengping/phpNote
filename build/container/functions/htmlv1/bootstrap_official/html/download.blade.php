<div style="width: 100%;" class="bg-gray" >
    <div class="container " >

        @foreach($items as $item)
            <div class="row bg-white" style="margin-bottom: 40px; margin-top: 40px" >
                <div class="col-12 col-md-4 ">
                    <img src="{{$item['image_url']}}">
                </div>
                @foreach($item['items'] as $i)

                    <div class="col-12 col-md-4 ">
                        <div style=" display: flex;align-items: center">
                            <div>
                                <img style="margin-left: -20px;" src="{{$i['image_url']}}">
                            </div>
                            <div>
                                <div><h5 style="color: #cb3131 !important;">{{$i['title']}}</h5></div>
                                <div>{{$i['ver']}}</div>
                                <div>{{$i['date']}}</div>
                            </div>
                        </div>
                        <div>
                            {!! $i['content'] !!}
                        </div>
                        <a href="##">
                            <div style="background-color: #fddc7a; text-align:center;margin-top:20px;padding-bottom: 5px;padding-top: 5px;padding-right: 10px;padding-left: 10px;border-radius: 30px;width: 126px">
                                {{$i['button_text']}}
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
</div>