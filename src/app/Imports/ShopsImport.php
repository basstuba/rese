<?php

namespace App\Imports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ShopsImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shop([
            'name' => $row['店舗名'],
            'area' => $row['地域'],
            'genre' => $row['ジャンル'],
            'comment' => $row['店舗概要'],
            'img_url' => $row['画像URL']
        ]);
    }

    public function rules(): array
    {
        return [
            '店舗名' => 'required|max:50',
            '地域' => 'required|in:東京都,大阪府,福岡県',
            'ジャンル' => 'required|in:寿司,焼肉,居酒屋,イタリアン,ラーメン',
            '店舗概要' => 'required|max:400',
            '画像URL' => ['required', 'regex:/\.(jpeg|jpg|png)$/i']
        ];
    }

    public function customValidationMessages()
    {
        return [
            '店舗名.required' => '店舗名がありません',
            '店舗名.max' => '店舗名は50文字以内にしてください',
            '地域.required' => '地域がありません',
            '地域.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかにしてください',
            'ジャンル.required' => 'ジャンルがありません',
            'ジャンル.in' => 'ジャンルは「寿司」「焼肉」「居酒屋」「イタリアン」「ラーメン」のいずれかにしてください',
            '店舗概要.required' => '店舗概要がありません',
            '店舗概要.max' => '店舗概要は400文字以内にしてください',
            '画像URL.required' => '画像URLがありません',
            '画像URL.regex' => '末尾がjpeg又はpngのURLを使用してください'
        ];
    }
}
