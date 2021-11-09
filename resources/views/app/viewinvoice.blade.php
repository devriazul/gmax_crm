@extends('layouts.app')
@section('content')


<script src="/js/jspdf.debug.js"></script>
<script src="/js/html2canvas.min.js"></script>
<script src="/js/html2pdf.min.js"></script>

  @php 
  $image = public_path('storage/uploads/').$business->logo;
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);
$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
  @endphp
    <div class="row">
       
        <div class="col-md-9">
            <div class="card card-lg">
                <div class="card-body"  id="invoice">
                  <div class="row">
                    <div class="col-6">
                        <img src="{{$dataUri}}" width="200">
                   
                      <address class="mt-2">
                        <strong>{{$business->businessname}}</strong> <br>
                        @if($business->address!=NULL)  {{$business->address}}<br>@endif
                        @if($business->address2!=NULL) {{$business->address2}}<br> @endif
                        @if($business->city!=NULL)   {{$business->city}}, @endif  @if($business->state!=NULL)  {{$business->state}}<br> @endif
                        @if($business->email!=NULL)    {{$business->email}}, @endif  @if($business->contactnum!=NULL)  {{$business->contactnum}}<br> @endif
                        @if($business->taxid!=NULL)   {{$settings->taxname}} : {{$business->taxid}}<br> @endif
          
                      </address>
                    </div>
                    <div class="col-6 text-end">                       
                     
                                                    
                      <address class="mt-4"></address>                    
                        <strong>{{$invoice->clientdata->name}}</strong> <br>
                        {{$invoice->clientdata->business}}<br>
                        {{$invoice->clientdata->address}}<br>
                        {{$invoice->clientdata->state}}, {{$invoice->clientdata->city}}<br>
                        {{$invoice->clientdata->country}}, {{$invoice->clientdata->zip}}<br>
                        {{$invoice->clientdata->email}}
                      </address>
                    </div>
                    <div class="col-12 my-3">
                      <h3>Invoice : #{{$invoice->invoid}}</h1>
                        <address>
                            <strong>  Invoice Date:</strong>  {{ $invoice->invodate}}<br>
                              <strong>  Due Date :</strong> {{ $invoice->duedate}}<br>
                                <strong >  Status :</strong>  @if($invoice->invostatus ==1)<span class="badge bg-yellow text-uppercase">Unpaid</span>@endif
                                      @if($invoice->invostatus ==2)<span class="badge bg-indigo text-uppercase">partly paid</span>@endif
                                      @if($invoice->invostatus ==3)<span class="badge bg-green text-uppercase">Paid</span>@endif
                                      @if($invoice->invostatus ==4)<span class="badge bg-purple text-uppercase">Refuned</span>@endif
                                      @if($invoice->invostatus ==5)<span class="badge bg-dark text-uppercase">Cancelled</span>@endif    
                          </address>
                    </div>
                  </div>
                  <table class="table table-transparent table-responsive">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 1%">#</th>
                        <th>Item</th>
                        <th class="text-center" style="width: 10%">Qnt</th>
                        <th class="text-end" style="width: 1%">Amount</th>
                        @if($invoice->taxable==1)
                        <th class="text-end" style="width: 1%">Tax</th>
                        @endif
                        <th class="text-end" style="width: 1%">Total</th>
                      </tr>
                    </thead>
                    @php $totalamt =0;  $invokey =1; $tottax =0; @endphp
                    @foreach($invometas as $invometa)
                    <tr>
                      <td class="text-center">@php echo $invokey; $invokey ++; @endphp </td>
                      <td>
                      
                        <div class="">{{$invometa->meta}}</div>
                      </td>
                      <td class="text-center">
                        {{$invometa->qty}}<small>{{$invometa->qtykey}}</small>
                      </td>
                      @if($invoice->taxable==1)
                      <td class="text-end">{{$settings->prefix}}{{$invometa->amount}}</td>
                      @endif
                      <td class="text-end">{{$settings->prefix}}@php echo $invometa->tax; $tottax +=$invometa->tax;  @endphp </td>
                      <td class="text-end">{{$settings->prefix}}{{$invometa->total}} @php $totalamt +=$invometa->amount*$invometa->qty; @endphp</td>
                    </tr>
              
                    @endforeach
                    <tr>
                      <td colspan="@if($invoice->taxable==1) 5 @else 4 @endif" class="strong text-end"> @if($invoice->taxable==1)Total Before Tax @else Sub Total @endif</td>
                      <td class="text-end">{{$settings->prefix}}{{$totalamt}}</td>
                    </tr>
                    @if($invoice->taxable==1)
                    <tr>
                      <td colspan="5" class="strong text-end">{{$settings->taxname}}</td>
                      <td class="text-end">{{$settings->taxpercent}}%</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="strong text-end">{{$settings->taxname}} Due</td>
                      <td class="text-end">{{$settings->prefix}}{{$tottax}}</td>
                    </tr>
                    @endif
                    <tr>
                      <td colspan="@if($invoice->taxable==1) 5 @else 4 @endif" class="font-weight-bold text-uppercase text-end">Total Due</td>
                      <td class="font-weight-bold text-end">{{$settings->prefix}}{{$invoice->totalamount}}</td>
                    </tr>
                  </table>
                  @if($payments->count()>0)
                  <h3 class="mt-4">Transactions </h3>
                  <table class="table table-transparent table-responsive">
                    <thead>
                      <tr>                        
                        <th>Transaction Date</th>
                        <th class="text-center">Gateway</th>
                        <th class="text-end">Transaction ID</th>
                        <th class="text-end" >Amount</th>
                      </tr>
                    </thead>
                    @php $totalpaid = 0; @endphp
                    @foreach($payments as $payment)
                    <tr>
                      <td class="text-left">{{$payment->date}}</td>
                      <td>
                      
                        <div class="">{{$payment->method}}</div>
                      </td>
                      <td class="text-center">
                        {{$payment->transation}}  
                      </td>
                      
                      <td class="text-end"> {{$settings->prefix}}{{$payment->amount}}
                        @php $totalpaid += $payment->amount; @endphp</td>
                    </tr>
                   @endforeach
                   
                    <tr>
                      <td colspan="3" class=" font-weight-bold text-end">Total Paid</td>
                      <td class=" text-end">{{$settings->prefix}}{{ $totalpaid}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-weight-bold text-uppercase text-end">Balance Due</td>
                        <td class="font-weight-bold text-end">{{$settings->prefix}}@php echo $invoice->totalamount - $invoice->paidamount  @endphp</td>
                      </tr>
                  </table>
                  @endif
                  <p class="text-muted text-center mt-5">{{$settings->invoicenote}}</p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
                <div class="dropdown-menu dropdown-menu-demo">
                    <span class="dropdown-header">Menu</span>
                    <a class="dropdown-item " href="/invoice/edit/{{$invoice->id}}">                  
                   
                	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"   style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                         Edit Invoice
                    </a>
                    <a class="dropdown-item btn-download"  href="javascript:void(0)" >            
                    <svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg>
                            Download PDF
                    </a>
                    <a class="dropdown-item " data-toggle="modal" data-target="#paymentlink">          
                   
	                <svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><line x1="10" y1="14" x2="20" y2="4" /><polyline points="15 4 20 4 20 9" /></svg>
                            Payment Link
                    </a>
                    <a class="dropdown-item " href="/invoice/email/{{$invoice->id}}" onclick="return confirm('Are you sure?')"  >            
                       
	                <svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                                Send Email
                    </a>
                    <a class="dropdown-item " href="#"  onclick="printDiv('invoice')">            
                            
                	<svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                               Print Invoice
                    </a>    
                   
                 
                </div>
            </div>

        </div>
    </div>

        <!---- get payment link --->


        <div class="modal modal-blur fade" id="paymentlink" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Get Payment Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
          
              <div class="modal-body">
                  
                  <div class="mb-2">
                      <label class="form-label">Payment Link</label>
                      <input type="text" class="form-control" placeholder="Payment link" value="@php echo URL::to('/');@endphp/invoice/pay/{{$invoice->id}}">
                  </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              
              </div>
              </form>
            </div>
          </div>
        </div>


          

      
<script>

    const options = {
      margin: 0.5,
      filename: 'invoice{{$invoice->invoid}}.pdf',
      image: { 
        type: 'jpeg', 
        quality: 100
      },
      html2canvas: { 
        scale: 1 
      },
      jsPDF: { 
        unit: 'in', 
        format: 'letter', 
        orientation: 'portrait' 
      }
    }
    
    $('.btn-download').click(function(e){
      e.preventDefault();
      const element = document.getElementById('invoice');
      html2pdf().from(element).set(options).save();
    });


    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>

@endsection