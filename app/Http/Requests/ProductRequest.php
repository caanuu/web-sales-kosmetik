<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('spec_keys') && is_array($this->spec_keys)) {
            $specs = [];
            foreach($this->spec_keys as $index => $key) {
                $key = trim($key);
                $val = trim($this->spec_values[$index] ?? '');
                if ($key !== '') {
                    $specs[] = $key . ': ' . $val;
                }
            }
            $this->merge([
                'keterangan' => empty($specs) ? null : implode('|', $specs),
            ]);
        }
    }

    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'keterangan' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];

        if ($this->isMethod('POST')) {
            $rules['images'] = ['required', 'array', 'min:1'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
            'discount_price.lt' => 'Harga diskon harus lebih rendah dari harga asli.',
            'stock.required' => 'Stok wajib diisi.',
            'images.required' => 'Minimal 1 gambar produk wajib diunggah.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
