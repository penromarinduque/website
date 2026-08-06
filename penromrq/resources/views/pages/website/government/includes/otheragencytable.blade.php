<table class="agency-table-footer">
    <tr>
        @foreach($details as $key => $value)
        <td>
            <a href="{{ $value->footer_path }}" target="_blank">
                <img src="{{ asset($value->footer_text) }}">
            </a>
        </td>
        @endforeach
    </tr>
</table>