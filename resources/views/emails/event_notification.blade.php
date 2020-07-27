<table>
    <tbody>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.head') }}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.body') }} <b>{{ $userName }}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.detail') }}: <b>{{ $event->name }}</b> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.date') }}: <b>{{ $event->date }}</b> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.notify') }}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('events.email.footer') }}</td>
    </tr>
    </tbody>
</table>