<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitSqlSeeder extends Seeder
{
    public function run(): void
    {
        // -- 管理者
        DB::insert("INSERT INTO
            adminers (id, email, password, name)
        VALUES
            (
                1,
                'test1@test.com',
                '$2y$10\$IxrASeTNEzPmAtqjh4b8YupDp0dmUG4UOWZ7DDULh7Bhv6A08N5o.',
                '古谷'
            );
            ");

        // -- ユーザー
        DB::insert("INSERT INTO
            users (
                id,
                email,
                password,
                last_name,
                first_name,
                last_name_kana,
                first_name_kana,
                birthday,
                zip,
                address1,
                tel1
            )
        VALUES
            (
                1,
                'test1@test.com',
                '$2y$10\$IxrASeTNEzPmAtqjh4b8YupDp0dmUG4UOWZ7DDULh7Bhv6A08N5o.',
                '古谷',
                '竜一',
                'furuya',
                'ryuichi',
                '1990-05-25',
                '165-0024',
                '東京都中野区',
                '08067298429'
            );
            ");

        // -- ユーザーお届け先
        DB::insert("INSERT INTO
            user_delivery_locations (
                id,
                user_id,
                last_name,
                first_name,
                last_name_kana,
                first_name_kana,
                zip,
                address1,
                tel1
            )
        VALUES
            (
                1,
                1,
                '古谷',
                '竜一',
                'furuya',
                'ryuichi',
                '165-0024',
                '東京都中野区',
                '08067298429'
            );
            ");

        // -- 症状
        DB::insert("INSERT INTO
            symptoms (id, category_no, name, sort_order)
        VALUES
            (1, '1', '症状1', 1);
            ");

        DB::insert("INSERT INTO
            symptoms (id, category_no, name, sort_order)
        VALUES
            (2, '2', '症状2', 2);
            ");

        // -- 味
        DB::insert("INSERT INTO
            tastes (id, category_no, name, sort_order)
        VALUES
            (1, '1', '味1', 1);
            ");

        DB::insert("INSERT INTO
            tastes (id, category_no, name, sort_order)
        VALUES
            (2, '2', '味2', 2);
            ");

        // -- 材料
        DB::insert("INSERT INTO
            materials (id, category_no, name, sort_order)
        VALUES
            (1, '1', '材料1', 1);
            ");

        DB::insert("INSERT INTO
            materials (id, category_no, name, sort_order)
        VALUES
            (2, '2', '材料2', 2);
            ");

        // -- 商品カテゴリ(シリーズ)
        DB::insert("INSERT INTO
            product_categories (id, series_name, name, sort_order)
        VALUES
            (1, '商品カテゴリ1', 'シリーズ名1', 1);
            ");

        DB::insert("INSERT INTO
            product_categories (id, series_name, name, sort_order)
        VALUES
            (2, '商品カテゴリ2', 'シリーズ名2', 2);
            ");

        // -- 商品
        DB::insert("INSERT INTO
            products (
                id,
                product_category_id,
                product_no,
                name1,
                name2,
                capacity,
                description,
                is_public
            )
        VALUES
            (1, 2, '001', '商品名1', '商品名2', 1, '商品説明', 1);
            ");

        // -- 商品値段
        DB::insert("INSERT INTO
            product_prices (
                id,
                product_id,
                capacity,
                price,
                include_tax,
                sort_order
            )
        VALUES
            ('1', '1', 'LEAF 20g', 700, 30, 1);
            ");

        DB::insert("INSERT INTO
            product_prices (
                id,
                product_id,
                capacity,
                price,
                include_tax,
                sort_order
            )
        VALUES
            ('2', '1', 'LEAF 100g', 1100, 30, 2);
            ");

        DB::insert("INSERT INTO
            product_prices (
                id,
                product_id,
                capacity,
                price,
                include_tax,
                sort_order
            )
        VALUES
            ('3', '1', 'LEAF 200g', 1700, 30, 3);
            ");

        // -- 商品キーワード
        DB::insert("INSERT INTO
            product_keywords (id, product_id, keyword)
        VALUES
            (1, 1, 'シワ');
            ");

        DB::insert("INSERT INTO
            product_keywords (id, product_id, keyword)
        VALUES
            (2, 1, '乾燥');
            ");

        // -- 商品値段
        DB::insert("INSERT INTO
            product_recommendations (id, product_id, kind, sort_order)
        VALUES
            (1, 1, 1, 1);
            ");

        // -- 商品 - 症状
        DB::insert("INSERT INTO
            product_symptom (id, product_id, symptom_id)
        VALUES
            (1, 1, 2);
            ");

        // -- 商品 - 味
        DB::insert("INSERT INTO
            product_taste (id, product_id, taste_id)
        VALUES
            (1, 1, 2);
            ");

        // -- 商品 - 材料
        DB::insert("INSERT INTO
            product_material (id, product_id, material_id)
        VALUES
            (1, 1, 2);
            ");

        // -- クーポン
        DB::insert("INSERT INTO
            coupons (id, name, code, discount_price, expired_at)
        VALUES
            (
                1,
                'お試しクーポン1',
                'c-0001',
                100,
                '2021-12-31 00:00:00'
            );
            ");

        DB::insert("INSERT INTO
            coupons (id, name, code, discount_price, expired_at)
        VALUES
            (
                2,
                'お試しクーポン2',
                'c-0002',
                200,
                '2021-12-31 00:00:00'
            );
            ");

        // -- 注文
        DB::insert("INSERT INTO
            orders (
                id,
                user_id,
                user_delivery_location_id,
                coupon_id,
                user_email,
                user_last_name,
                user_first_name,
                user_last_name_kana,
                user_first_name_kana,
                user_birthday,
                user_zip,
                user_address1,
                user_tel1,
                user_delivery_location_last_name,
                user_delivery_location_first_name,
                user_delivery_location_last_name_kana,
                user_delivery_location_first_name_kana,
                user_delivery_location_zip,
                user_delivery_location_address1,
                user_delivery_location_tel1,
                coupon_name,
                coupon_code,
                delivered_at,
                status,
                total_num,
                total_product_price,
                total_product_include_tax,
                total_delivery_charge,
                fee,
                total_price
            )
        VALUES
            (
                1,
                1,
                1,
                1,
                'test1@test.com',
                '古谷',
                '竜一',
                'furuya',
                'ryuichi',
                '1990-05-25',
                '165-0024',
                '東京都中野区',
                '08067298429',
                '古谷',
                '竜一',
                'furuya',
                'ryuichi',
                '165-0024',
                '東京都中野区',
                '08067298429',
                'お試しクーポン1',
                'c-0001',
                '2021-12-01',
                0,
                10,
                10000,
                1000,
                500,
                0,
                10500
            );
            ");

        // -- 注文詳細
        DB::insert("INSERT INTO
            order_details (
                id,
                order_id,
                product_category_id,
                product_id,
                product_price_id,
                product_category_name,
                product_category_series_name,
                product_no,
                product_name1,
                product_name2,
                product_description,
                product_price,
                product_include_tax,
                product_capacity,
                symptom_id_csv,
                taste_id_csv,
                material_id_csv,
                symptom_name_csv,
                taste_name_csv,
                material_name_csv,
                num,
                sub_total
            )
        VALUES
            (
                1,
                1,
                1,
                1,
                1,
                '商品カテゴリ1',
                'シリーズ名1',
                '001',
                '商品名1',
                '商品名1',
                '商品説明',
                1100,
                100,
                '170g',
                '1,2',
                '1,2',
                '1,2',
                '症状1,症状2',
                '味1,味2',
                '材料1,材料2',
                5,
                5500
            );
            ");

        // -- セラピスト
        DB::insert("INSERT INTO
            therapists (id, name, name_kana, profile)
        VALUES
            (1, 'セラピスト名前', 'NAME', '私はセラピストです');
            ");

        // -- カート詳細
        DB::insert("INSERT INTO
            therapist_blogs (id, therapist_id, title, body, is_public)
        VALUES
            (1, 1, 'title1', 'body1', 1),
            (2, 1, 'title2', 'body2', 1);
            ");
    }
}
