<div class="container-fluid bg-green">
    <div class="container">
        <div class="front-line-title">
            <h3> FRONTLINE SERVICES </h3>
        </div>
        <table class="table-fronline">
            <tr>
                @foreach($webdata->frontline() as $key => $value)
                <td class="text-center">
                    <a href="{{ $value->front_link }}" @if($value->target_blank == 1) target="_blank" @endif>
                        <img src="{{ asset($value->front_image_path) }}">
                        <p> {{ $value->front_text }} </p>
                    </a>
                </td>
                @endforeach
            </tr>
        </table>
    </div>
</div>