<div class="container-fluid bg-green-darker">
    <div style="padding-top: 15px; padding-bottom: 15px;">
        <div class="container" style="padding-top: 15px;">
            <div class="row">
                <div class="col-md-8">
                    @foreach($webdata->getWebFooter('S') as $key => $value)
                    <div class="{{ $value->footer_column }} footer-text">
                        <label> {{ $value->footer_title }} </label>
                        @if(View::exists('pages.website.government.includes.'.$value->footer_path ))
                            @include('pages.website.government.includes.'.$value->footer_path , ['details' => $value->subClass()->where('status','1')->get() ])
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('web/images/logo/coa-footer-82x921.png') }}" style="max-width: 280px;">
                </div>
            </div>
        </div>
    </div>
</div>