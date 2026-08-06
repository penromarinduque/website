<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b> Version </b> {{ config('app.probuilder.version') }}
    </div>
    <strong> Copyright &copy; {{ (date('Y') == config('app.probuilder.since')) ? '' : config('app.probuilder.since').'-' }}{{ date('Y') }} <a href="#"></a>.</strong> All rights
    reserved.
</footer>