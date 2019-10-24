<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use PDF;
use App\User;


class PDFController extends Controller
{
    public function pdf(){
      $orders = User::all();
      $pdf = PDF::loadView('pdf',compact('orders'));
      return $pdf->stream();

    }
}
