<?php

namespace App\Http\Controllers\Api;

use App\Models\Amenities;
use App\Models\Cities;
use App\Models\District;
use App\Models\MotelAmenities;
use App\Models\MotelRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CrawlController extends Controller
{
    public function crawl(Request $rq)
    {
        $data = $rq->data;
//        $fp   = @fopen('demo.txt', "w");
//
//        // Kiểm tra file mở thành công không
//        if (!$fp) {
//            echo 'Mở file không thành công';
//        } else {
//            fwrite($fp, base64_encode($data));
//        }
//        die;

        $data = json_decode($data, 1);
//        dd($data);
        $title       = $data['detail_title'] ?: '';
        $price       = $data['detail_price'] ?: '';
        $area        = $data['detail_area'] ?: '';
        $phone       = $data['detail_phone'] ?: '';
        $address     = $data['detail_address'] ?: '';
        $toilet      = $data['detail_toilet'] ?: '';
        $people      = $data['detail_people'] ?: '';
        $amenities   = $data['detail_amenities'] ?: [];
        $description = $data['detail_description'] ? $data['detail_description'][0] : '';
        $lng         = $data['detail_lng'] ?: '';
        $lat         = $data['detail_lat'] ?: '';

        $address_fill = array_reverse($address);

        $cities = Cities::where('cit_name', 'like', '%' . $address_fill[0] . '%')->first();

        if (!$cities) {
            $city_ins = [
                'cit_name'      => $address_fill[0],
                'cit_parent_id' => 0
            ];

            $cities = Cities::firstOrCreate($city_ins);
        }

        $distict = Cities::where('cit_name', 'like', '%' . $address_fill[1] . '%')->first();

        if (!$distict) {
            $distict_ins = [
                'cit_name'      => $address_fill[1],
                'cit_parent_id' => $cities->cit_id,
            ];

            $distict = Cities::firstOrCreate($distict_ins);
        }
        if (count($address_fill) >= 4) {
            $ward = Cities::where('cit_name', 'like', '%' . $address_fill[2] . '%')->first();

            if (!$ward) {
                $wardt_ins = [
                    'cit_name'      => $address_fill[2],
                    'cit_parent_id' => $distict->cit_id,
                ];

                $ward = Cities::firstOrCreate($wardt_ins);
            }
        } else {
            $ward = false;
        }

        $arr_images = [];

        if (is_numeric($people)) {
            if (!empty($data['detail_img']) && count($data['detail_img']) > 0) {
                foreach ($data['detail_img'] as $item) {
                    $arr_images[] = get_image($item, '/upload/motel/');
                }
            } else {
                $arr_images[] = "no_img_room.png";
            }
        }


        $images         = json_encode($arr_images, JSON_FORCE_OBJECT);
        $price          = (float)filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $area           = (int)filter_var($area, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $address        = implode($address, ', ');
        $latlng[]       = $lat;
        $latlng[]       = $lng;
        $latlng         = json_encode($latlng, JSON_FORCE_OBJECT);
        $amenities_json = json_encode($amenities, JSON_FORCE_OBJECT);

        $data_insert = [
            'title'       => $title,
            'slug'        => Str::slug($title, '-'),
            'images'      => $images,
            'price'       => $price,
            'area'        => $area,
            'cty_id'      => $cities->cit_id,
            'dis_id'      => $distict->cit_id,
            'war_id'      => $ward ? $ward->cit_id : 0,
            'address'     => $address,
            'phone'       => $phone,
            'toilet'      => $toilet,
            'people'      => $people,
            'description' => $description,
            'amenities'   => base64_encode($amenities_json),
            'category_id' => 1,
            'use_id'      => 0,
            'latlng'      => $latlng,
            'status'      => 1,
        ];

        $motelroom_id = MotelRoom::firstOrCreate($data_insert);

        if (!empty($amenities)) {

            foreach ($amenities as $item) {
                $exist = Amenities::where('name', '=', $item)->first();
                if ($exist) {
                    $amenities_id = $exist;
                } else {
                    $amenities_id = Amenities::firstOrCreate([
                        'name' => trim($item),
                    ]);
                }

                $list_style = [
                    'amenities_id' => $amenities_id->id,
                    'motelroom_id' => $motelroom_id->id,
                ];

                MotelAmenities::firstOrCreate($list_style);
            }
        }
    }
}
