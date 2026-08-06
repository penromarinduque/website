@foreach(app('SideBar')->where('side_panel_type', $side)->orderBy('order_level','asc')->get() as $key => $value)

    <div class="panel @if($value->side_panel_flag == '1') panel-default @endif" style="z-index: -10;">
        <div class="@if($value->side_panel_flag == '1') panel-heading bg-green @endif">
            @if($value->side_panel_flag == '1') <h3 class="panel-title text-white" style="font-size: 11pt"><b>{{ $value->side_panel_title }}</b></h3> @endif
        </div>
        <div class="panel-body">
            @foreach($value->subClass()->get() as $detail)
                @if($detail->detail_flag == 'I')
                    <div class="" style="margin-bottom: 10px;">
                        <a href="{{ $detail->detail_link }}" target="_blank">
                            <img src="{{ asset($detail->detail_path) }}" style="width: 100%;">
                        </a>
                    </div>
                @endif
                @if($detail->detail_flag == 'F')
                    {!! $detail->detail_path !!}
                @endif
                @if(!is_null($detail->detail_text))
                    <div class="text-center">
                        <b>{{ $detail->detail_text }}</b>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endforeach

