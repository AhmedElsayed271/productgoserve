<?php

namespace App\Imports;

use App\Models\Size;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;


class ProductImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {


            $strings = explode(',',$row[1]);

            // Regular expression pattern to capture SKU, Arabic sentence, and Qty
            $pattern = '/\(SKU:\s*(.*?)\)(.*?)\(Qty:\s*(\d+)\)/u'; // 'u' flag for Unicode support


            // Arrays to store extracted data
            $skus = [];
            $arabic_sentences = [];
            $quantities = [];

            foreach ($strings as $string) {
                if (preg_match($pattern, $string, $matches)) {
                    $sku = $matches[1]; // SKU number
                    $arabic_sentence = trim($matches[2]); // Arabic sentence
                    $qty = $matches[3]; // Qty

                    $skus[] = $sku;
                    $arabic_sentences[] = $arabic_sentence;
                    $quantities[] = $qty;
                }
            }

            foreach ($arabic_sentences as $index => $item) {


                $size = Size::where('name', $skus[$index])->first();

                $id = $size->id ?? ""; 

                if (!$size) {
                    $size = Size::create([
                        'name' => $skus[$index],
                    ]);

                    $id = $size->id;
                }

                $product = Product::create([
                    'name' => $item,
                ]);

                $product->sizes()->attach($id);
            }       

        }
    }

}
