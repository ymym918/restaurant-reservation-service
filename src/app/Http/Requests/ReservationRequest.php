<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            // 予約日付のバリデーション: 必須、日付型、今日以降の日付
            'reservation_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',

            // 予約時間のバリデーション: 必須、フォーマットチェック、指定した時間内に制限
            'reservation_time' => [
                'required',
                'date_format:H:i',
                Rule::in(['11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00']),
            ],

            // 予約人数のバリデーション: 必須、整数型、1から10の範囲
            'number_of_people' => 'required|integer|min:1|max:10',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_date.date' => '正しい日付を入力してください。',
            'reservation_date.date_format' => '予約日の形式は「Y-m-d」の形式で入力してください。',
            'reservation_date.after_or_equal' => '予約日は今日以降の日付を選択してください。',

            'reservation_time.required' => '予約時間を選択してください。',
            'reservation_time.date_format' => '時間の形式は「HH:MM」の形式で入力してください。',
            'reservation_time.in' => '予約時間は11:00から21:00の間で選択してください。',

            'number_of_people.required' => '人数を選択してください。',
            'number_of_people.integer' => '人数は整数で入力してください。',
            'number_of_people.min' => '予約人数は1人以上で指定してください。',
            'number_of_people.max' => '予約人数は10人以下で指定してください。',
        ];
    }
}
