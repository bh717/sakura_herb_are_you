@include('Mails.User.Bases.header')
アカウントが発行されました

email: このemailアドレス
password:

こちらよりログインをお願いします
{{ config('consts.BASE_ADMIN_APP_URL') }}auth/login
@include('Mails.User.Bases.footer')
