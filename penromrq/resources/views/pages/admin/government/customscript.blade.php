<script type="text/javascript">
    $(function(){

        var root = '<?php echo request()->root() ?>';
        var url = '<?php echo route('website.route',['path' => $path,'action' => 'admin-add-editor-image','id' => Crypt::encrypt('')]) ?>';

        $('#form_modaladdimage').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:url,
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    if(data.path.length > 0)
                    {
                        var col        = document.createElement("DIV");
                        var box        = document.createElement("DIV");
                        var boxBody    = document.createElement("DIV");
                        var boxFooter  = document.createElement("DIV");
                        var inputGroup = document.createElement("DIV");
                        col.setAttribute("class", "col-sm-6");
                        box.setAttribute("class", "box box-success box-solid");
                        boxBody.setAttribute("class", "box-body");
                        boxBody.setAttribute("style", "height: 150px; overflow: hidden;");
                        boxBody.innerHTML = "<img src='" + root + '/' + data.path + "' style='width: 100%;'>";
                        boxFooter.setAttribute("class", "box-footer");
                        inputGroup.setAttribute("class","input-group margin");
                        inputGroup.innerHTML  = "<input type='text' id='" + data.path + "' value='" + root + '/' + data.path + "' class='form-control input-sm'>";
                        inputGroup.innerHTML += "<span class='input-group-btn'>"
                        +"<button type='button' class='btn btn-success btn-sm btn-flat' onclick=\"return copytoclipboard('" + data.path + "')\">COPY</button>"
                        +"</span>";
                        boxFooter.appendChild(inputGroup);
                        box.appendChild(boxBody);
                        box.appendChild(boxFooter);
                        col.appendChild(box);
                        console.log(col)
                        $('#new_uploaded_image').append(col);
                    }

                    var alert = document.createElement("DIV");
                    alert.setAttribute("class", "alert alert-info");
                    alert.innerHTML = "<button type='button' class='close alert-close' data-dismiss='alert' area-hidden='true'>&times;</button>";
                    alert.innerHTML += "<label><i class='fa fa-warning'></i> " + data.message + "</label>";
                    $('#image_upload_alert').html(alert);
                    $('#image_to_upload').val('');

                    setTimeout(function(){
                        $('.alert-close').click();
                    },3000);
                }
            })
        });
    });
</script>