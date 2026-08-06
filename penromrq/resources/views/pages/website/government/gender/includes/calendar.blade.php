@foreach($Calendar as $key => $value)

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <a href="{{ $value->calendar->file_link }}" @if($value->calendar->file_tab == '1') target="_blank" @endif>
                    <img src="{{ asset($value->calendar->file_path) }}" class="card-img img-fluid mx-auto img-thumbnail" style="width: 500px; height: 100px;">
                </a>
            </div>
            <div class="col-md-8">
                <div class="card-body text-center">
                    <a href="{{ $value->calendar->file_link }}" @if($value->calendar->file_tab == '1') target="_blank" @endif>
                        <h5 class="card-title"> {{ $value->calendar->file_name }} </h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
  
@endforeach

{{ $Calendar->links('pages.website.gender.includes.activitypagination') }}

@push('scripts')

<script type="text/javascript">
    $(function () {
        $('#calendar-pagination').on('click','.page-activity',function(event){
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'html',
                success: function(data){
                    $('#calendar-pagination').html(data);
                }
            });
            return false;
        });
    });
</script>

@endpush