@extends('layouts.app')
@section('styleTags')
  <style media="screen">
    .invoice-detail #entry{
      display: unset;
    }
  </style>
@endsection
@section('content')
  <section class="invoice-edit">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{isset($invoice) ? 'Edit' : 'Create'}} Invoice</h1>
            </div>
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
              <form method="POST" enctype="multipart/form-data" action="{{route('invoice.store')}}" class="mb-3">
                @if (isset($invoice))
                  <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                @endif
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <div class="invoice-title">
                            <div class="status">
                                <span class="{{isset($invoice) ? $invoice->status : ''}}">{{isset($invoice) ? $invoice->status : ''}}</span>
                            </div>
                            <div class="invoiceTit">
                                <input type="text" name="invoice_title" value="{{isset($invoice) ? $invoice->title : ''}}" required class="form-control" placeholder="Invoice">
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn btn-default invoice-logo">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" value="{{isset($invoice) ? $invoice->attachment : ''}}" name="invoice_logo">
                            Logo Upload
                        </button>

                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-md-5 col-sm-5 col-xs-6">
                        <label for="invoiceNo.">Inovioce No.</label>
                        <div class="invoiceNumber">
                            <input type="text"  name="invoice_num" required value="{{isset($invoice) ? $invoice->invoice_num : ''}}" class="form-control">
                            <span>#</span>
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-6">
                        <label for="language">Languages</label>
                        <select required class="form-control" name="language" >
                            <option value="Select Language">Select Language</option>
                            <option value="English" {{isset($invoice) && $invoice->language == "English" ? 'selected' : ''}}>English</option>
                            <option value="Urdu" {{isset($invoice) && $invoice->language == "Urdu" ? 'selected' : ''}}>Urdu</option>
                            <option value="Chinese" {{isset($invoice) && $invoice->language == "Chinese" ? 'selected' : ''}}>Chinese</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-6">
                        <label for="currency">Currency</label>
                        <select required class="form-control" name="currency" >
                            <option value="Select Currency">Select Currency</option>
                            <option value="PKR" {{isset($invoice) && $invoice->currency == "PKR" ? 'selected' : ''}}>PKR</option>
                            <option value="Dollar" {{isset($invoice) && $invoice->currency == "Dollar" ? 'selected' : ''}}>Dollar</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-8 col-xs-6">
                        <div class="form-group">
                            <label for="From">From</label>
                            <textarea placeholder="Add Details"  name="from_detail" cols="30" rows="3" required class="form-control">{{isset($invoice->InvoiceDetail) ? $invoice->InvoiceDetail->from_detail : ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="From">To</label>
                            <textarea placeholder="Add Details" name="to_detail"  cols="30" rows="3" required class="form-control">{{isset($invoice->InvoiceDetail) ? $invoice->InvoiceDetail->to_detail : ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <input type="text" required class="form-control datepicker" value="{{isset($invoice->InvoiceDetail) ? date('d M Y',strtotime($invoice->InvoiceDetail->date)) : ''}}" name="date_issue" data-toggle="datepicker">
                        </div>
                        <div class="form-group">
                            <label for="InvDate">Status</label>
                            <select class="form-control" required name="status" id="invDate">
                                <option value="">Select Status</option>
                                <option value="Due" {{isset($invoice->InvoiceDetail) && $invoice->status == "Due" ? 'selected'  : ''}}>Due</option>
                                <option value="Paid" {{isset($invoice->InvoiceDetail) && $invoice->status == "Paid" ? 'selected'  : ''}}>Paid</option>
                                <option value="Process" {{isset($invoice->InvoiceDetail) && $invoice->status == "Process" ? 'selected'  : ''}}>Process</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="OrderNumber">Purchase Order Number</label>
                            <input type="number" required name="order_num" class="form-control" value="{{isset($invoice->InvoiceDetail) ? $invoice->InvoiceDetail->order_num  : ''}}" placeholder="12345">
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <hr>
                    </div>
                    <div class="clearfix"></div>
                    <div class="invoice-detail">

                    @php
                      $i=1;$temp='';
                    @endphp
                    @if (isset($invoice->InvoiceDescription[0]))
                    @forelse($invoice->InvoiceDescription as $description)
                      @if ($i>1)
                        @php
                          $temp=$i;
                        @endphp
                      @endif
                        <div class="clonedInput" id="entry{{$temp}}">
                            <div class="form-group col-md-6 col-sm-5 col-xs-12">
                                <label for="desc{{$temp}}" class="label_desc">Description</label>
                                <textarea rows="1" required name="description[]" class="form-control" name="desc" id="input_desc{{$temp}}">{{$description->description}}</textarea>
                            </div>
                            <div class="form-group col-md-2 col-sm-2 col-xs-6 quantity">

                                <label for="quantity{{$temp}}" class="label_quantity">Quantity</label>
                                <input type="number" required type="text" class="form-control" value={{$description->quantity}} name="quantity[]" id="input_quantity{{$temp}}"
                                    placeholder="1">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-6 rate">
                                <label for="rate{{$temp}}" class="label_rate">Rate</label>
                                <input type="number" step="0.01" min="0" required class="form-control" name="rate[]" value="{{$description->rate}}" id="input_rate{{$temp}}"
                                    placeholder="1500">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-6 amount">
                                <label for="amount{{$temp}}" class="label_amount">Amount</label>
                                <input type="number" disabled class="form-control input_amount" name="amount{{$temp}}" value="{{$description->amount}}" id="input_amount{{$temp}}"
                                    placeholder="0">
                            </div>
                        </div>
                        @php
                          $i++;
                        @endphp

                  @empty
                    <div class="clearfix"></div>
                    <div class="invoice-detail">
                      <div class="clonedInput" id="entry">
                          <div class="form-group col-md-6 col-sm-5 col-xs-12">
                              <label for="desc" class="label_desc">Description</label>
                              <textarea rows="1" required name="description[]" class="form-control" name="desc" id="input_desc"></textarea>
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-xs-6 quantity">

                              <label for="quantity" class="label_quantity">Quantity</label>
                              <input type="number" required type="text" class="form-control" name="quantity[]" id="input_quantity"
                                  placeholder="1">
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-6 rate">
                              <label for="rate" class="label_rate">Rate</label>
                              <input type="number" step="0.01" min="0" required class="form-control" name="rate[]" id="input_rate"
                                  placeholder="1500">
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-6 amount">
                              <label for="amount" class="label_amount">Amount</label>
                              <input type="number" disabled class="form-control input_amount" name="amount" id="input_amount"
                                  placeholder="0">
                          </div>
                      </div>

                    </div>
                  @endforelse
                @else  <div class="clearfix"></div>
                  <div class="invoice-detail">
                    <div class="clonedInput" id="entry">
                        <div class="form-group col-md-6 col-sm-5 col-xs-12">
                            <label for="desc" class="label_desc">Description</label>
                            <textarea rows="1" required name="description[]" class="form-control" name="desc" id="input_desc"></textarea>
                        </div>
                        <div class="form-group col-md-2 col-sm-2 col-xs-6 quantity">

                            <label for="quantity" class="label_quantity">Quantity</label>
                            <input type="number" required type="text" class="form-control" name="quantity[]" id="input_quantity"
                                placeholder="1">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 rate">
                            <label for="rate" class="label_rate">Rate</label>
                            <input type="number" step="0.01" min="0" required class="form-control" name="rate[]" id="input_rate"
                                placeholder="1500">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 amount">
                            <label for="amount" class="label_amount">Amount</label>
                            <input type="number" disabled class="form-control input_amount" name="amount" id="input_amount"
                                placeholder="0">
                        </div>
                    </div>

                  </div>
                @endif
                </div>
                <div class="clearfix"></div>
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="btnAdd">New Line</button>
                        <button class="btn btn-warning" id="btnDel">Del Line</button>
                    </div>
                    <div class="col-md-12 ">
                        <br>
                    </div>
                    <div class="clearfix"></div>
                     <div class="col-md-6 col-sm-8 col-xs-12 pull-right">
                        <div class="invoice-total">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    Total
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 total">
                                    0
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12">
                        <br>
                        <button class="btn btn-success" type="submit" id="submit" name="submit">send</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
  </section>
@endsection
@section('scriptTags')
  <script type="text/javascript">
  function calculateTotal(){
    var total=0;
    $(`input.input_amount`).each(function(){
      total+=parseFloat($(this).val());
    })
    total =  total ? total : 0;
    $('.total').text(total);
  }
  $(document).ready(function(){

// Delete button enabled in Edit Form when length > 1
    var num     = $('.invoice-detail .clonedInput').length;
    if (num -1 == 1)
      $('#btnDel').attr('disabled', false);

    calculateTotal();
    $('[data-toggle="datepicker"]').datepicker({
        format: "dd M yyyy"
    });


// Multiplying quantity into rate

    $(document).on('change','input[name="rate[]"] , input[name="quantity[]"]',function(){
      var thisval=$(this).val();
      var quantity=0;
      if($(this).parent().hasClass('quantity'))
        quantity=$(this).parent().siblings('.rate').children('input[name="rate[]"]').val();
      else if($(this).parent().hasClass('rate'))
        quantity=$(this).parent().siblings('.quantity').children('input[name="quantity[]"]').val();
        quantity = quantity ? quantity : 1;
      $(this).parent().siblings('.amount').children('.input_amount').val(parseFloat(quantity*thisval));

      calculateTotal();
    });
  });

  // Checking the format of file
  $('input[type="file"]').on('change',function(){
        var fileName = $(this).val();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
          $(this).val('');
            alert("Only jpg/jpeg and png files are allowed!");
        }
    });
  </script>
@endsection
