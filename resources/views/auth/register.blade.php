<table>
    <tbody>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.register_email.head') }}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.register_email.body') }} <b>{{ $user->fullName() }}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.register_email.password_recovery_request') }} <b>{{ $password }}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.register_email.footer') }}</td>
    </tr>
    </tbody>
</table>