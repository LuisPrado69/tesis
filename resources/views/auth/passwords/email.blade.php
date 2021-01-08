<table>
    <tbody>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.email.head') }}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.email.body') }} <b>{{ $user->fullName() }}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.email.password_recovery_request') }} <b>{{ $password }}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>{{ trans('users.email.footer') }}</td>
    </tr>
    </tbody>
</table>