<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // ユーザー認証時はtrueに変更すること
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //バリデーションルールを此処に記載
            //カラム名 => ルール、複数指定の場合は|で区切る
            'title' => 'required|max:32',
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトルう',
            'content' => '紹介文',
        ];
    }
}
