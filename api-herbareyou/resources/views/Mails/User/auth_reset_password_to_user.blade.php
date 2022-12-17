@include('Mails.User.Bases.header')
こちらよりパスワードの設定をお願いします
{{ config('consts.BASE_APP_URL') }}mypage/reset-password?code={{$userResetPaswordRow->code}}

@include('Mails.User.Bases.footer')
