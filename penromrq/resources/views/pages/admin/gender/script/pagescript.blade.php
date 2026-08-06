@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });
    function selectedPanel(evt) {
        $('#panel_id').val($(evt).data('panel'));
        $('#modalselectpanelgroup').modal('hide');
    }
    function openFeaturedVideoModal(path,link) {
        $('#modalfeaturedvideo').modal('show');
        $('.modal #modalfeaturedvideoimage').attr('src',path);
        $('.modal #imagelink').val(link);
    }
    function openPlanandBudgetModal(path,link) {
        $('#modalplanandbudget').modal('show');
        $('.modal #modalplanandbudgetimage').attr('src',path);
        $('.modal #imagelink').val(link);
    }
    function openPhotoReleaseModal(path,link) {
        $('#modalphotoreleases').modal('show');
        $('.modal #modalphotoreleasesimage').attr('src',path);
        $('.modal #imagelink').val(link);
    }
    function openCalendarModal(path,link) {
        $('#modalcalendar').modal('show');
        $('.modal #modalcalendarimage').attr('src',path);
        $('.modal #imagelink').val(link);
    }
    function openDownloadableFormModal(path,link) {
        $('#modaldownloadableform').modal('show');
        $('.modal #modaldownloadableformimage').attr('src',path);
        $('.modal #imagelink').val(link);
    }
    function updateStatus(id,url){
        if($('#'+id).hasClass('fa-toggle-on')){
            $('#'+id).removeClass('fa-toggle-on')
                .removeClass('text-orange')
                .addClass('fa-toggle-off')
                .addClass('text-red');
            tooglestatus(url,0);
        } else if($('#'+id).hasClass('fa-toggle-off')){
            $('#'+id).removeClass('fa-toggle-off')
                .removeClass('text-red')
                .addClass('fa-toggle-on').addClass('text-orange');
            tooglestatus(url,1);
        }
    }
    function tooglestatus(url,stat)
    {
        $.get(url,{status:stat},function(count){ });
    }
</script>

@endpush