@foreach($panel as $key => $value)
    @if(!empty($value))
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-green">
                    @isset($value->panel_name) 
                        <h3 class="panel-title text-white" style="font-size: {{ $value->font_size or '12pt' }}"><b>{{ $value->panel_name }}</b></h3> 
                    @endisset
                </div>
                <div class="panel-body">
                    <div class="row"> 
                        @foreach($value->details as $key => $detail)

                            @if($detail->panel_dtl_type == '1')
                                @if($detail->storage->file_type == 'I')
                                    <div class="col-md-12">
                                        <a 
                                            href="{{ asset($detail->storage->file_link) }}" 
                                            @if($detail->storage->file_tab == 0) 
                                                onclick="return false" 
                                            @elseif($detail->storage->file_tab == 2) 
                                                target="_blank" 
                                            @endif 
                                                data-toggle="tooltip" 
                                                title="Please click to view E-File"
                                                >
                                            <img class="img-thumbnail" src="{{ asset($detail->storage->file_path) }}" style="width: 100%;">
                                        </a>
                                    </div>
                                @endif
                                @if($detail->storage->file_type == 'V')
                                    <div class="col-md-12">
                                        <video width="100%" controls>
                                            <source src="{{ asset($storage->file_path) }}" type="video/mp4">
                                            <source src="{{ asset($storage->file_path) }}" type="video/ogg">
                                        </video>
                                    </div>
                                @endif
                                @if($detail->storage->file_type == 'D')
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body" style="text-transform: uppercase;">
                                                <a href="{{ asset($detail->storage->file_link) }}" @if($detail->storage->file_tab == 2) target="_blank" @endif><i class="fa fa-folder"></i> {{ $detail->storage->file_name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if($detail->panel_dtl_type == '2')
                                <div class="col-md-12">
                                    {!! $detail->frameset->frame_path !!}
                                </div>
                            @endif

                            @if($detail->panel_dtl_type == '3')
                                <div class="col-md-12" style="text-align: justify; text-justify: inter-word; margin-bottom: 10px;">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="text-center" style="margin-bottom: 10px; color: green;">
                                                <h3>{{ $detail->longtext->long_description }}</h3>
                                            </div>
                                            <div class="long-text-body">
                                                {!! $detail->longtext->long_text !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
            
                            @if($detail->panel_dtl_type == '4')
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body" style="text-transform: uppercase;">
                                            <a href="{{ $detail->inputtext->text_link }}" style="text-decoration: none;"> {{ $detail->inputtext->text_description }} </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @endif

@endforeach