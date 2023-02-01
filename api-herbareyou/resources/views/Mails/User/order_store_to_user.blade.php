@include('Mails.User.Bases.header')
{{$user->last_name}}{{$user->first_name}}　様

こんにちは。この度はHerb Are Youのオンラインショップにて
ご注文いただきまして誠にありがとうございます。

下記の内容で確かにご注文を承りました。お手数をおかけいたしますが、
ご注文内容をご確認くださいますようお願いいたします。

●このメールはショッピングカートシステムから自動的に送信しています。重要な情報を含んでおりますので、大切に保管してください。
●ご注文にお心当たりのない方は、お手数をおかけいたしますが本メールの返信にてご連絡いただけますと幸いです。

【　ご 注 文 番 号　】 {{$order->order_no}}

▼お客さま情報
---------------------------------------------------------
【　お　　名　　前　】{{$user->last_name}}{{$user->first_name}}　（{{$user->last_name_kana}}{{$user->first_name_kana}}） 様
【　メールアドレス　】{{$user->email}}
【　郵　便　番　号　】{{$user->zip}}
【　ご　　住　　所　】{{$user->address1}}
【　電　話　番　号　】{{$user->tel1}}
【　メールマガジン　】{{$user->is_mail_magazine ? '受信する' : '受信しない'}}
【　注　　文　　日　】{{(new Carbon\Carbon($order->created_at))->format('Y/m/d')}}
【　決　済　方　法　】クレジットカード決済（イプシロン）
---------------------------------------------------------

▼配送先情報
---------------------------------------------------------
【　お　　名　　前　】{{$userDeliveryLocation->last_name}}{{$userDeliveryLocation->first_name}}　（{{$userDeliveryLocation->last_name_kana}}{{$userDeliveryLocation->first_name_kana}}）様
【　郵　便　番　号　】{{$userDeliveryLocation->zip}}
【　ご　　住　　所　】{{$userDeliveryLocation->address1}}
【　電　話　番　号　】{{$userDeliveryLocation->tel1}}
【　お届け　希望日　】{{$order->delivered_at ? $order->delivered_at->format('Y/m/d') : ''}}
【　配　送　会　社　】ゆうパケット（郵便局）　※ポストへの投函となります
---------------------------------------------------------
［　商　品　詳　細　］
---------------------------------------------------------
@foreach ($orderDetails as $orderDetail)
【　商　品　番　号　】{{$orderDetail->product_no}}
【　商　　品　　名　】{{$orderDetail->product_name1}} {{$orderDetail->product_name2}}
【　サ　　イ　　ズ　】 {{$orderDetail->product_price_capacity}}
【　価　格　（税込）】{{$orderDetail->product_price}}円
【　　税　　　率　　】{{config('order.product_tax_rate') * 100}}%
【　　数　　　量　　】{{$orderDetail->num}}
【　　小　　　計　　】{{$orderDetail->sub_total}}円

@endforeach

---------------------------------------------------------
［配　送　料　合　計］
---------------------------------------------------------
【　　送　　　料　　】{{$order->total_delivery_charge}}円（税込）
---------------------------------------------------------

▼総合計
---------------------------------------------------------
【　合計（消費税）　】{{$order->total_product_price}}円({{$order->total_product_include_tax}}円)
【　10％対象　合計　】0円
【　 8％対象　合計　】{{$order->total_product_include_tax}}円
【　送　料　合　計　】{{$order->total_delivery_charge}}円（税込）
【決　済　手　数　料】{{$order->fee}}円（税込）
【　割　引　合　計　】{{$order->coupon_discount_price}}円
【　総　　合　　計　】{{$order->total_price}}円
---------------------------------------------------------
商品発送後、「shop@herbareyou.jp」より【商品発送完了メール】をお送りいたします。

何かご不明な点などがございましたら、お気軽にお問い合わせください。
お届け後の商品のご感想などもいただけると幸いです。

それでは引き続きどうぞよろしくお願いいたします。

@include('Mails.User.Bases.footer')
