<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function sample()
    {
        PDF::SetTitle('Sample PDF');
        PDF::AddPage();
        PDF::SetMargins(0, 0, 0, true);
        PDF::ImageSVG($file = public_path('img/sample.svg'), $x=100, $y=175, $w=100, $h=100);
        PDF::AddPage();
        PDF::Image($file = public_path('img/transparant.png'), 80, 100, 60, '', 'PNG', null, 'center');
        PDF::Output(public_path('storage/pdf/sample.pdf'), 'F');
    }
}
