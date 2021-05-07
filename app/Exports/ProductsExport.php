<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithTitle, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /*
    public function query()
    {
        return Product::query()->where('list_id','=',$this->id);
    }
    */
    public function title(): string
    {
        return 'Lista de precios';
    }
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 60,
            'D' => 20,
            'E' => 10,
            'F' => 50,
            'G' => 50,
        ];
    }
    public function styles(Worksheet $sheet): array
    {
        return [
            1   => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'ID LISTA',
            'NOMBRE', 
            'PRECIO',
            'CÓDIGO',
            'IMAGEN',
            'URL',
        ]; 
    }

    public function collection()
    {
        if($this->id=="all"){
            $products = Product::all();
            $products->makeHidden(['created_at', 'updated_at']);
            return $products;

        }else{
            $products = Product::where('list_id','=',$this->id)->get();
            $products->makeHidden(['created_at', 'updated_at']);
            return $products;
        }

        
    }
}
