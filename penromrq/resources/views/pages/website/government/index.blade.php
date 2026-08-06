@extends('pages.website.government.includes.layout')

@section('content')

@include('pages.website.government.includes.topnav')

@include('pages.website.government.includes.masterhead')

@include('pages.website.government.includes.carousel')

@include('pages.website.government.includes.bottomnav')

@include('pages.website.government.includes.frontlineservices')
<!-- center main content -->
<div class="container-fluid">
    <div class="container">
        <div class="row m-t-15">
            {{-- LEFT SIDE PANEL --}}
            <div class="col-md-3" style="position: static; z-index: 1;">
                @include('pages.website.government.sidedetail',['side' => 'L'])
            </div>{{-- ./ LEFT SIDE PANEL --}}
            
            {{-- CENTER DETAILS --}}
            <div class="col-md-6" style="position: static; z-index: 1;">
                @include('pages.website.government.centerdetail')
            </div> {{-- ./Center Body --}}

            {{-- RIGHT SIDE PANEL --}}
            <div class="col-md-3" style="position: static; z-index: 1;">
                @include('pages.website.government.sidedetail',['side' => 'R'])
            </div>{{-- ./ RIGHT SIDE PANEL  --}}

        </div>{{-- row --}}
    </div>{{-- container --}}
</div>{{-- container-fluid --}}

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection

@section('scripts')
    
<script>
    $(document).ready(function(){
        $('.ytp-large-play-button').on('click',function(){
            return false;
        });
    });
</script>

@endsection