@include('Mails.User.Bases.header_html')
{{$user->last_name}}{{$user->first_name}}　様<br>
<br>
こんにちは。Herb Are You オンラインショップです。<br>
お届けしたハーブティーはいかがでしたでしょうか？<br>
<br>
健やかなひと時に、お役に立てていたらうれしいです。<br>
Herb Are You では植物の働きを生かした<br>
100種類以上のブレンドをご用意しています。<br>
肩の力を抜いてつきあえる日常のハーブティーから、<br>
季節のハーブティー、気分を高めてくれるものまで。<br>
ぜひまたのぞいてみてください。<br>
<br>
ご質問、ご感想などございましたらお気軽にお問い合わせください。<br>
これからもHerb Are You をよろしくお願いいたします。<br>
<br>
@if (!$recommendationProducts->isEmpty())
●おすすめハーブティー<br>
@foreach ($recommendationProducts as $recommendationProduct)
@if (isset($recommendationProduct->uploadFiles[0]->file_path))
<p>
<a href="{{config('consts.BASE_APP_URL') . 'product/' . $recommendationProduct->id}}">
<img src="{{config('aws.cloudfront_domain') . $recommendationProduct->uploadFiles[0]->file_path}}">
</a>
</p>
@endif
@endforeach
@endif
<br>
@include('Mails.User.Bases.footer_html')
