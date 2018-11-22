<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceDetail;
use App\InvoiceDescription;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::all();
        return view('invoice.index',['invoices'=>$invoices]);
    }

    /**
     * Display a listing of the resource in Json.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvioces()
    {
      return response()->json(Invoice::with('InvoiceDetail')->orderBy('created_at','desc')->paginate(8));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $old_pic=null;
        $invoice = isset($request->invoice_id) ? Invoice::findOrFail($request->invoice_id) : new Invoice;
        $invoice->title=$request->invoice_title;
        $invoice->invoice_num=$request->invoice_num;
        $invoice->language=$request->language;
        $invoice->currency=$request->currency;
        $invoice->status=$request->status;
        if($request->hasFile('invoice_logo')){

          // If user wants to update file
          if(isset($request->invoice_id) && $request->invoice_logo!=$invoice->attachment)
          {
            // Assigned the Previous ID, Not necessary but Why we should use too much increments
            $invoice->id=$request->invoice_id;
            Storage::delete($invoice->attachment);
          }
          // Storing new file
          elseif($request->invoice_logo) {
            $invoice->attachment=$request->invoice_logo;
          }
          $request->file('invoice_logo')->store('public/');
          $file_name = $request->file('invoice_logo')->hashName();
          $invoice->attachment=$file_name;
        }
        if(isset($request->invoice_id))
        {
          $invoice->delete();
          // $invoice->$old
        }
        $invoice->save();

        $invoiceDetail = new InvoiceDetail();
        $invoiceDetail->from_detail=$request->from_detail;
        $invoiceDetail->to_detail=$request->to_detail;
        $invoiceDetail->date=date('Y-m-d',strtotime($request->date_issue));
        $invoiceDetail->order_num=$request->order_num;
        $invoiceDetail->invoice_id=$invoice->id;
        $invoiceDetail->save();
        $i=0;
        foreach ($request->description as $desc) {
          $invoiceDescription = new InvoiceDescription();
          $invoiceDescription->description=$desc;
          $invoiceDescription->quantity=$request->quantity[$i];
          $invoiceDescription->rate=$request->rate[$i];
          $invoiceDescription->amount=($request->rate[$i]*$request->quantity[$i]);
          $invoiceDescription->invoice_id=$invoice->id;
          $invoiceDescription->save();
        }

        return redirect()->route('invoice.index')->with('message', 'Saved SuccessFully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $invoice=null;

      if($id){
        $invoice=Invoice::findOrFail($id);
      }
      return view('invoice.create',['invoice'=>$invoice]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice=Invoice::findOrFail($id);
        Storage::delete('public/'.$invoice->attachment);
        $invoice->delete();
        return response()->json(['message'=>'Deleted SuccessFully']);

    }
}
