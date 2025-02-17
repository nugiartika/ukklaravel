<?php

namespace App\Http\Controllers;

use App\Models\sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    public function generatePDF()
    {
        // Ambil data penjualan
        $sales = Sale::with(['user', 'sale_detail.product'])->get(); // Tambahkan get()

        $pdf = Pdf::loadView('pimpinan.print', compact('sales'))->setPaper('A4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('Laporan-Penjualan.pdf');
    }
}
