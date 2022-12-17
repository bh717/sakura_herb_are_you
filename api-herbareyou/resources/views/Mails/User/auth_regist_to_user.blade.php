@include('Mails.User.Bases.header')
{{$user->last_name}}{{$user->first_name}}　様

こんにちは。Herb Are You？ オンラインショップです。

ユーザー登録が完了いたしました。
ご登録ありがとうございます。

【ログインはこちらから】
{{ config('consts.BASE_APP_URL') }}auth/login

商品やサービスに関してのご意見ご質問等ございましたら、
お気軽にお問合せフォームよりご連絡ください。

今後ともHerb Are You？をよろしくお願いいたします。

@include('Mails.User.Bases.footer')
