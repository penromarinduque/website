<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-edit-news-and-articles' , 'id' => Crypt::encrypt($center->detail_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    @if(!empty($center))
    <div class="form-group">
        <input type="hidden" name="detail_id" value="{{ Crypt::encrypt($center->detail_id) }}">
        <input type="hidden" name="center_id" value="{{ Crypt::encrypt($center->center_id) }}">
        <label> IMAGES </label>
        <table class="table table-bordered">
            <tr>
                <td style="width:33.33%">
                    <div class="background-image" style="background-image: url('{{asset($center->created_image)}}')">
                        <div class="img-btn">
                            {{-- <label class="btn btn-danger" data-toggle="tooltip" title="Delete Image" onclick="deleteNewsArticleImage('{{ $center->detail_id }}','0')"><i class="fa fa-trash"></i></label> --}}
                        </div>
                    </div>
                    <input type="file" id="addimage1" name="image1" class="form-control" onchange="return ValidateFileUpload(this.id)" name="image1">
                </td>
                <td class="text-center" style="width:33.33%">
                    @if($center->otherimage->count() >= 1)
                    <div class="background-image" style="background-image: url('{{ asset($center->otherimage[0]->vid_img_path) }}')">
                        <div class="img-btn">
                            <label class="btn btn-danger" data-toggle="tooltip" title="Delete Image" onclick="deleteNewsArticleImage('{{ $center->otherimage[0]->content_id }}','1')"><i class="fa fa-trash"></i></label>
                        </div>
                    </div>
                    @else
                    <div class="background-image" style="background-image: url('')"></div>
                    @endif
                    <input type="file" id="addimage2" name="image2" class="form-control" onchange="return ValidateFileUpload(this.id)">
                 </td>
                <td class="text-center" style="width:33.33%" style="">
                    @if($center->otherimage->count() > 1)
                    <div class="background-image" style="background-image: url('{{ asset($center->otherimage[1]->vid_img_path) }}')">
                        <div class="img-btn">
                            <label class="btn btn-danger" data-toggle="tooltip" title="Delete Image" onclick="deleteNewsArticleImage('{{ $center->otherimage[1]->content_id }}','1')"><i class="fa fa-trash"></i></label>
                        </div>
                    </div>
                    @else
                    <div class="background-image" style="background-image: url('')"></div>
                    @endif
                    <input type="file" id="addimage3" name="image3" class="form-control" onchange="return ValidateFileUpload(this.id)">
                </td>
            </tr>
        </table>
    </div>
    <div class="form-group">
        <label> HEADLINE / TITLE </label>
        <textarea class="form-control" name="created_title" style="resize: vertical;min-height: 100px;" required>{{ $center->created_title }}</textarea>
    </div>
    <div class="form-group">
        <label> PUBLISHED BY </label>
        <input type="text" class="form-control" name="published_by" value="{{ $center->published_by }}" required>
    </div>
    <div class="form-group">
        <label> PUBLISHED DATE </label>
        <input type="date" class="form-control" name="published_date" value="{{ date('Y-m-d',strtotime($center->published_date)) }}" required>
    </div>
    <div class="form-group">
        <label> FULL DESCRIPTION </label>
        <button type="button" data-toggle="modal" data-target="#modaladdnewimage" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Image </button>
        <textarea class="ckeditor" name="wysihtml5" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $center->created_story !!}</textarea>
        <span class="help-block">To create an anchor tag: Highlight first the text and select insert link button to add link.</span>
    </div>
    <div class="box-tools text-right">
        <button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('Are you sure you want to change details?')">
            <i class="fa fa-save fa-fw"></i> SUBMIT 
        </button>
        <a href="{{ route('website.route',['path' => $path, 'action' => 'admin-delete-news-and-articles', 'id'
                     => Crypt::encrypt($center->detail_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')" class="btn btn-danger btn-sm"> 
            <i class="fa fa-trash fa-fw"></i> DELETE 
        </a>
    </div>
    @else
    <div class="form-group text-center">
        <h1> Record has been deleted! </h1>
    </div>
    @endif
</form>

@push('scripts')
<script type="text/javascript">
    function deleteNewsArticleImage(img,type) {
        if(confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url : '{{ route('website.route',['path' => $path ,'action' => 'admin-delete-center-panel-image-path', 'id' => Crypt::encrypt('')]) }}',
                type : 'post',
                data : { 'image_id' : img, 'type' : type },
                success : function(data){
                    window.location.reload();
                },
            })
        }
    }
</script>
@endpush