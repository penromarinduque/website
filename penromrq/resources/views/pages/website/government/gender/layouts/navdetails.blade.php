@foreach($navbar as $key => $value)

<li class="nav-item @if($value->detail_type == '1') dropdown @endif">

    <a class="nav-link text-white @if($value->detail_type == '1') dropdown-toggle @endif" href="{{ $value->detail_link }}" @if($value->detail_type == '1') id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" @endif>
        {{ $value->detail_name }}
    </a>

    @if($value->detail_type == '1')
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <?php 

                $navbardetails = app('GenderNavBarDetails')
                            ->where('detail_parent', $value->detail_id)
                            ->where('status','1')
                            ->orderBy('order_level','asc')
                            ->get();

            ?>

            @foreach($navbardetails as $detail)

                <li @if($detail->detail_type == '1') class="nav-item dropdown" @endif>

                    <a class="dropdown-item text-white @if($detail->detail_type == '1') dropdown-toggle @endif" href="{{ $detail->detail_link }}" @if($detail->detail_type == '1') id="navbarDropdown1" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" @endif> {{ $detail->detail_name }} @if($detail->detail_type == '1')<i class="fa fa-caret-right pull-right mt-1"></i>@endif</a>

                    @if($detail->detail_type == '1')

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">

                            <?php 

                                $navbarsub = app('GenderNavBarDetails')
                                            ->where('detail_parent', $detail->detail_id)
                                            ->where('status','1')
                                            ->orderBy('order_level','asc')
                                            ->get();

                            ?>

                            @foreach($navbarsub as $subdetail)
                                <li><a class="dropdown-item text-white" href="{{ $subdetail->detail_link }}"> {{ $subdetail->detail_name }} </a>
                            @endforeach
                            
                        </ul>

                    @endif

                </li>

            @endforeach

        </ul>
    @endif
</li>

@endforeach
