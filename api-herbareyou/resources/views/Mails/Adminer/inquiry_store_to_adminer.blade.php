@include('Mails.User.Bases.header')
お問い合わせがありました。
お名前: {{$inquiry->name}}
メールアドレス: {{$inquiry->email}}
ご注文番号: {{$inquiry->order_no}}
お問い合わせ:
{!! $inquiry->inquiry !!}
@include('Mails.Adminer.Bases.footer')
