@foreach($side_data as $key => $value)

<div class="@if($value->side_panel_flag == '1') box box-default box-solid @endif" id="div_panel_{{ $value->side_id }}">

    <div class="box-header @if($value->side_panel_flag == '1') with-border @endif">

        @if($value->side_panel_flag == '1') <h3 class="box-title" style="font-size: 14px;"> <span style="font-weight: bold;">{{ $value->order_level }}. {{ $value->side_panel_title }} </span></h3> @endif

        <div class="box-tools pull-right">

            <button class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#mod_add_detail_{{ $value->side_id }}">
                <i class="fa fa-plus"></i>
            </button>

            <button class="btn bg-blue btn-flat btn-sm" data-toggle="modal" data-target="#modEditPanel{{ $value->side_id }}">
                <i class="fa fa-pencil"></i>
            </button>

            @if($value->subClass()->count() < 1)
                <button class="btn btn-danger btn-flat btn-sm" id="{{ encrypt($value->side_id) }}" onclick="return deletePanel(this)">
                    <i class="fa fa-trash"></i>
                </button>
            @endif

        </div>
    </div>
    <div class="box-body no-padding">
        @foreach($value->subClass()->get() as $detail)

            <div id="div_detail_{{ $detail->detail_id }}">

                @if($detail->detail_flag == 'I')
                    <div class="" style="margin-bottom: 10px;">
                        <a href="{{ $detail->detail_link }}" target="_blank">
                            <img src="{{ asset($detail->detail_path) }}" class="img-thumbnail" style="width: 100%;">
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

                <div class="box-tools text-right" style="margin-top: 10px;border-top: 1px solid #999; padding:5px 10px 5px;">
                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modaleditdetail{{ $detail->detail_id }}">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <button class="btn btn-danger btn-sm btn-flat" id="{{ encrypt($detail->detail_id) }}" onclick="return deleteDetail(this)">
                        <i class="fa fa-trash"></i>
                    </button>

                    @include('pages.admin.government.modal.modaleditsidepaneldetail')
                </div>

            </div>
        @endforeach
    </div>
</div>

@include('pages.admin.government.modal.modaleditsidepanelpanel',['side_id' => $value->side_id ])

@include('pages.admin.government.modal.modaladdsidepaneldetail',['side_id' => $value->side_id ])

@endforeach