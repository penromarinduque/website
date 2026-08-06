<div class="container-fluid bg-green">
    <div style="padding-top: 15px; padding-bottom: 15px;">
        <div class="container" style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 footer-text">
                        <div class="row">
                            @foreach($webdata->getWebFooter('A') as $key => $footer)
                            <div class="{{ $footer->footer_column }}">
                                <div class="form-group">
                                    <label> {{ $footer->footer_title }} </label>
                                    @if(View::exists('pages.website.government.includes.'.$footer->footer_path))
                                        @include('pages.website.government.includes.'.$footer->footer_path , ['details' => $footer->subClass()->where('status','1')->get() ])
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>