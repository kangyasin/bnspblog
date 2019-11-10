<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
      $id = $this->route()->parameter('id');
      return [
          'nama_produk' => 'required|string|min:5|unique:products,nama_produk,'.$id.'',
          // 'nama_produk' => 'required|string|min:5|unique:articles,title',
          'deskripsi' => 'required',
          'gambar' => ''
      ];
  }
  // return message info validation error
  public function messages()
  {
    return [
        'nama_produk.required' => 'Nama produk wajib diisi',
        'nama_produk.min' => 'Nama produk minimal 5 karakter',
        'nama_produk.unique' => 'Nama produk harus unik',
        'deskripsi.required' => 'Deskripsi wajib diisi'
    ];
  }
}
