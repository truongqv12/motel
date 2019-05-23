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
//        $data = $rq->data;
//        $fp   = @fopen('demo.txt', "w");
//
//        // Kiểm tra file mở thành công không
//        if (!$fp) {
//            echo 'Mở file không thành công';
//        } else {
//            fwrite($fp, base64_encode($data));
//        }
//        die;
        $data = "eyJkb21haW4iOiBudWxsLCAiZGV0YWlsX3RvaWxldCI6ICJLaFx1MDBlOXAga1x1MDBlZG4iLCAiZGV0YWlsX3ByaWNlIjogIjEsNTAwLDAwMCBcdTAxMTAvdGhcdTAwZTFuZyIsICJpZF93ZWIiOiAiMTU2IiwgImxhbmdfd2ViIjogImphdmFzY3JpcHQiLCAiZGV0YWlsX2xuZyI6ICIxMDUuODkxMjAwNzk5MjI3OTMiLCAiZGV0YWlsX2FtZW5pdGllcyI6IFsiQ2hcdTFlZDcgXHUwMTExXHUxZWMzIHhlIiwgIlNcdTAwZTJuIHBoXHUwMWExaSIsICJJbnRlcm5ldCIsICJUcnV5XHUxZWMxbiBoXHUwMGVjbmggY1x1MDBlMXAiXSwgImRldGFpbF9hcmVhIjogIjIwbSIsICJkZXRhaWxfZGVzY3JpcHRpb24iOiBbIjxkaXYgY2xhc3M9XCJkaXMtY29udGVudFwiPkNobyB0aHVcdTAwZWEgcGhcdTAwZjJuZyB0clx1MWVjZCBraFx1MDBlOXAga1x1MDBlZG4gdHJvbmcgbmhcdTAwZTAgNCB0XHUxZWE3bmcuPGJyPlx1MDExMFx1MWVhN3kgXHUwMTExXHUxZWU3IHRoaVx1MWViZnQgYlx1MWVjYiB2XHUxZWM3IHNpbmggdlx1MDBlMCBiXHUwMGUwbiBiXHUxZWJmcCwgY1x1MDBmMyBnXHUwMGUxYyB4XHUwMGU5cCBcdTAxMTFcdTFlYzMgXHUwMTExXHUxZWQzLjxicj5OaFx1MDBlMCAwNCB0XHUxZWE3bmcsIHNcdTAwZTJuIFx1MDExMVx1MWVjMyB4ZSB0XHUxZWE3bmcgMSwgc1x1MDBlMm4gcGhcdTAxYTFpIHRcdTFlYTduZyA0IHJcdTFlZDluZyByXHUwMGUzaS4gR2lcdTFlZGQgZ2lcdTFlYTVjIHRcdTFlZjEgZG8sIGFuIG5pbmggdFx1MWVkMXQuPGJyPlx1MDExMFx1MWVjYmEgY2hcdTFlYzkgc1x1MWVkMSBuaFx1MDBlMCA0NywgbmdcdTAwZjUgMjggVGhhbmggXHUwMTEwXHUwMGUwbSwgcGhcdTAxYjBcdTFlZGRuZyBUaGFuaCBUclx1MDBlYywgcXVcdTFlYWRuIEhvXHUwMGUwbmcgTWFpLCBIXHUwMGUwIE5cdTFlZDlpLjxicj5cdTAxMTBpXHUxZWM3biAzLjUgbmdoXHUwMGVjbi9zXHUxZWQxLjxicj5OXHUwMWIwXHUxZWRiYyAyNSBuZ2hcdTAwZWNuL3NcdTFlZDEuPGJyPkRpXHUxZWM3biB0XHUwMGVkY2ggcGhcdTAwZjJuZzogMjBtMi48YnI+R2lcdTAwZTEgY2hvIHRodVx1MDBlYTogMS41IHRyL3RoXHUwMGUxbmcuPGJyPlBoXHUwMGYybmcgdHJvbmcgbmhcdTAwZTAgbVx1MWVkYmkgeFx1MDBlMnkuPGJyPk5oXHUwMGUwIHRpXHUxZWM3biBjaFx1MWVlMyB2XHUwMGUwIFx1MDExMWlcdTFlYzNtIHhlIGJ1cyBuZ2F5IFx1MDExMVx1MDBlYSBOZ3V5XHUxZWM1biBLaG9cdTAwZTFpLjxicj5HXHUxZWE3biBjXHUwMGUxYyB0clx1MDFiMFx1MWVkZG5nIFx1MDExMVx1MWVhMWkgaFx1MWVjZGM6IEtpbmggRG9hbmggQ1x1MDBmNG5nIE5naFx1MWVjNywgWSBUdVx1MWVjNyBUXHUwMTI5bmgsIEtpbmggVFx1MWViZiBLXHUxZWY5IFRodVx1MWVhZHQgSFx1MDBlMCBOXHUxZWQ5aSwgY1x1MWVhN3UgVlx1MDEyOW5oIFR1eSwgVGltZXMgQ2l0eS4uLjxicj5MaVx1MDBlYW4gaFx1MWVjNyBjaFx1MDBlZG5oIGNoXHUxZWU3OiBNciBUaHV5XHUwMGVhbiAwOTgyMzQ5Mjc5IChNaVx1MWVjNW4gdHJ1bmcgZ2lhbikuPC9kaXY+Il0sICJkZXRhaWxfYWRkcmVzcyI6IFsiU1x1MWVkMSA0NyBuZ1x1MDBmNSAyOCBUaGFuaCBcdTAxMTBcdTAwZTBtLCBwaFx1MDFiMFx1MWVkZG5nIFRoYW5oIFRyXHUwMGVjLCBIb1x1MDBlMG5nIE1haSwgSE4iLCAiVGhhbmggXHUwMTEwXHUwMGUwbSIsICJIb1x1MDBlMG5nIE1haSIsICJIXHUwMGUwIE5cdTFlZDlpIl0sICJkZXRhaWxfaW1nIjogWyJodHRwOi8vbWVkaWEucGhvbmd0b3Qudm4veGM1dHg0Y2ovY2hpbmgtY2h1LWNoby10aHVlLXBob25nLXRyby1raGVwLWtpbi1kaWVuLXRpY2gtMjBtMi10YWktdGhhbmgtZGFtLXBodW9uZy10aGFuaC10cmktcXVhbi1ob2FuZy1tYWktZnZsYXcuanBnIiwgImh0dHA6Ly9tZWRpYS5waG9uZ3RvdC52bi94YzV0eDRjai9jaGluaC1jaHUtY2hvLXRodWUtcGhvbmctdHJvLWtoZXAta2luLWRpZW4tdGljaC0yMG0yLXRhaS10aGFuaC1kYW0tcGh1b25nLXRoYW5oLXRyaS1xdWFuLWhvYW5nLW1haS01aHpzYy5qcGciLCAiaHR0cDovL21lZGlhLnBob25ndG90LnZuL3hjNXR4NGNqL2NoaW5oLWNodS1jaG8tdGh1ZS1waG9uZy10cm8ta2hlcC1raW4tZGllbi10aWNoLTIwbTItdGFpLXRoYW5oLWRhbS1waHVvbmctdGhhbmgtdHJpLXF1YW4taG9hbmctbWFpLXBzMDByLmpwZyJdLCAiZGV0YWlsX3Bob25lIjogIjA5ODIzNDkyNzkiLCAibGluayI6ICJodHRwOi8vcGhvbmd0b3Qudm4vcGhvbmctdHJvLW5oYS10cm8vY2hpbmgtY2h1LWNoby10aHVlLXBob25nLXRyby1raGVwLWtpbi1kaWVuLXRpY2gtMjBtMi10YWktdGhhbmgtZGFtLXBodW9uZy10aGFuaC10cmktcXVhbi1ob2FuZy1tYWkiLCAiZGV0YWlsX2xhdCI6ICIyMC45OTM5MTIyMTYyMDUzMDYiLCAiYWN0aXZlIjogIjIiLCAiZGV0YWlsX3RpdGxlIjogIkNoXHUwMGVkbmggY2hcdTFlZTcgY2hvIHRodVx1MDBlYSBwaFx1MDBmMm5nIHRyXHUxZWNkIGtoXHUwMGU5cCBrXHUwMGVkbiwgZGlcdTFlYzduIHRcdTAwZWRjaCAyMG0yIHRcdTFlYTFpIFRoYW5oIFx1MDExMFx1MDBlMG0sIHBoXHUwMWIwXHUxZWRkbmcgVGhhbmggVHJcdTAwZWMsIHF1XHUxZWFkbiBIb1x1MDBlMG5nIE1haSIsICJkZXRhaWxfcGVvcGxlIjogIjMifQ==";
        $data = json_decode(base64_decode($data), 1);
//        $data = json_decode($data, 1);
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
                    $arr_images[] = get_image($item);
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
