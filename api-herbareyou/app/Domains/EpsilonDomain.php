<?php

namespace App\Domains;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class EpsilonDomain extends BaseDomain
{
    private $order;
    public function __construct(
        Order $order
    ) {
        $this->order = $order;
    }

    public function getPaymentUrl(int $orderId): string
    {
        $order = $this
            ->order
            ->with([
                'details'
            ])
            ->find($orderId);
        $data = [
            'version' => 2,
            'contract_code' => config('epsilon.contract_code'),
            'user_id' => config('epsilon.app_name') . $order->user_id,
            'user_name' => $order->user_last_name_kana . ' ' . $order->user_first_name_kana,
            'user_mail_add' => $order->user_email,
            'item_code' => mb_substr(implode('-', $order->details->pluck('product_no')->toArray()), 0, 32),
            'item_name' => mb_substr(implode('-', $order->details->pluck('product_name1')->toArray()), 0, 32),
            'order_number' => $order->order_no,
            'st_code' => '10000-0000-00000-00000-00000-00000-00000',
            'mission_code' => 1,
            'item_price' => $order->total_price,
            'process_code' => 1,
            'memo1' => '',
            'memo2' => '',
            'xml' => 1,
            'lang_id' => 'ja',
        ];
        \Log::info(' データ: ' . json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
        $data['user_name'] = mb_convert_encoding($data['user_name'], "sjis", "utf-8");
        $data['item_name'] = mb_convert_encoding($data['item_name'], "sjis", "utf-8");
        $data['memo1'] = mb_convert_encoding($data['memo1'], "sjis", "utf-8");
        $data['memo2'] = mb_convert_encoding($data['memo2'], "sjis", "utf-8");

        $response = Http::asForm()->post(config('epsilon.api_base_url') . 'cgi-bin/order/receive_order3.cgi', $data);
        $responseData = [];
        if ($response->successful()) {
            $responseData = $this->getArrayDataFromXmlData($response->body());
            if (isset($responseData['redirect'])) {
                return rawurldecode($responseData['redirect']);
            }
        }
        logs()->error('決済に失敗しました');
        logs()->error($responseData);
        throw new \Exception('決済に失敗しました');
    }

    public function getSales(string $transCode): array
    {
        $data = [
            'contract_code' => config('epsilon.contract_code'),
            'trans_code' => $transCode,
        ];
        $response = Http::asForm()->post(config('epsilon.api_base_url') . 'cgi-bin/order/getsales2.cgi', $data);
        if ($response->successful()) {
            return $this->getArrayDataFromXmlData($response->body());
        }
        \Log::error('注文データ確認に失敗しました');
        \Log::error('注文データ確認に失敗しました 送られてきたtrans_code' . $transCode);
        throw new \Exception('注文データ確認に失敗しました');
    }

    private function getArrayDataFromXmlData(string $xmlData): array
    {
        // $xmlData = mb_convert_encoding($xmlData, "UTF-8", "auto");
        $temp = simplexml_load_string($xmlData);
        $responseJsonData = json_encode($temp);
        $responseData = json_decode($responseJsonData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $arrayData = [];
        foreach ($responseData['result'] as $value1) {
            foreach ($value1 as $key2 => $value2) {
                foreach ($value2 as $key3 => $value3) {
                    $arrayData[$key3] = $value3;
                }
            }
        }
        return $arrayData;
    }
}
