<div class="container-fluid bg-green">
    <div class="container">
        <div class="master-container">
            <div class="row">
                <table style="width: 100%;">
                    <tr>
                        <td id="head-td-id">
                            <div class="col-md-2 head-img text-center">
                                <img src="{{ asset($webdata->masterhead()->head_logo) }}">
                            </div>
                        </td>
                        <td id="head-td-id2">
                            <div class="master-head">
                                <p id="title-1"> {{ $webdata->masterhead()->head_title }} </p>
                                <p id="title-2" style="font-size: 22pt!important;"> 
                                    <a href="{{ $webdata->masterhead()->head_link }}" @if($webdata->masterhead()->target_blank == 1) target="_blank" @endif>
                                        {{ $webdata->masterhead()->head_description }}
                                    </a>
                                </p>
                                <p id="title-3">
                                    <a href="{{ $webdata->masterhead()->head_link }}" @if($webdata->masterhead()->target_blank == 1) target="_blank" @endif>
                                        {{ $webdata->masterhead()->head_tagline }}
                                    </a>
                                </p>
                                <p id="title-4"> {{ $webdata->masterhead()->head_location }} </p>
                            </div>
                        </td>
                        <td>
                            <div class="col-md-2 head-img text-center">
                                <img src="{{ asset('web/images/logo/BAGONG-PILIPINAS-LOGO.png') }}"  style="max-width: 150px!important; max-height: 150px!important;">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>