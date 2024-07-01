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
         foreach ($rows as $row) {
             $sizes = $row[0];
             $substringsToRemove = ['\'', '"'];
             $sizes = str_replace($substringsToRemove, "", $sizes);
             $sizes = explode(",", $sizes);
             $sizeArr = [];
     
             foreach ($sizes as $size) {
                 $checkSize = Size::where('name', $size)->first();
                 $id = $checkSize->id ?? "";
     
                 if (!$checkSize) {
                     $checkSize = Size::create([
                         'name' => $size,
                     ]);
                     $id = $checkSize->id;
                 }
     
                 $sizeArr[] = $id;
             }
     
   
             $productName = $row[1];
             $arabicSentence = $this->extractArabicSentence($productName);
     
            
            //  dd(['productName' => $productName, 'arabicSentence' => $arabicSentence]);
     
             $product = Product::where('name', $arabicSentence)->first();
     
             if (!$product) {
                 $product = Product::create([
                     'name' => $arabicSentence,
                 ]);
                 $product->sizes()->attach($sizeArr);
             }
         }
     }
     
     private function extractArabicSentence($string)
     {
         
         $pattern = '/[\p{Arabic}]+(?:\s+[\p{Arabic}]+)*/u';
         
         preg_match($pattern, $string, $matches);
     
         return $matches[0] ?? null;
     }
     
     
}