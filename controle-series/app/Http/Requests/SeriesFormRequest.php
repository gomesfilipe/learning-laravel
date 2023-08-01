<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:3'],
            'seasonsQty' => ['required', 'integer', 'min:1'],
            'episodesPerSeason' => ['required', 'integer', 'min:1'],
            'cover' => ['file', 'mimes:jpeg,jpg,png,gif'],
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'O campo \'nome\' é obrigatório',
            'nome.min' => 'O campo \'nome\' precisa de pelo menos :min caracteres',
            'seasonsQty.required' => 'O campo \'Número de Temporadas\' é obrigatório',
            'seasonsQty.integer' => 'O campo \'Número de Temporadas\' deve ser um número inteiro.',
            'seasonsQty.min' => 'O campo \'Número de Temporadas\' deve ser no mínimo :min',
            'episodesPerSeason.required' => 'O campo \'Episódios por Temporada\' é obrigatório',
            'episodesPerSeason.integer' => 'O campo \'Episódios por Temporada\' deve ser um número inteiro.',
            'episodesPerSeason.min' => 'O campo \'Episódios por Temporada\' deve ser no mínimo :min',
            'cover.file' => 'O campo \'capa\' deve ser um arquivo',
            'cover.mimes' => 'O campo \'capa\' deve ser um arquivo do tipo :mimes',
        ];
    }
}
