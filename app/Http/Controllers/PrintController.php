<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

class PrintController extends Controller
{
    public function index()
    {
        $data = ['greeting' => 'hello world'];
        $pdf = PDF::loadView('try', $data);

        return $pdf->stream('hello.pdf');
    }
}
