@foreach($Announcements as $key => $value)

    <div class="card card-shadow mb-4">
        <div class="card-body">
            <div style="overflow: hidden; text-overflow: ellipsis; height: 46px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                <a href="{{ $value->announcement->post_link }}" @if($value->announcement->post_tab == '1') target="_blank" @endif style="text-decoration: none;">
                    <h5 class="card-title text-info" title="{{ $value->announcement->post_subject }}"> {{ $value->announcement->post_subject }} </h5>
                </a>
            </div>
            <div style="overflow: hidden; text-overflow: ellipsis; height: 75px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-align: justify;">
                <p class="card-text"> {{ strip_tags($value->announcement->post_content) }}</p>
            </div>
        </div>
    </div>

@endforeach

{{ $Announcements->links('pages.website.gender.includes.activitypagination') }}

@push('scripts')

<script type="text/javascript">
    $(function () {
        $('#announcement-pagination').on('click','.page-activity',function(event){
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'html',
                success: function(data){
                    $('#announcement-pagination').html(data);
                }
            });
            return false;
        });
    });
</script>

@endpush