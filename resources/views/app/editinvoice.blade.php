@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="dropdown-menu dropdown-menu-demo">
                <span class="dropdown-header">Menu</span>
                <a class="dropdown-item " href="/invoice/{{ $invoice->id }}">                  
	            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                     View Invoice
                </a>
              
                <a class="dropdown-item " href="#timeline" data-toggle="modal" data-target="#paymentlink">            
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><line x1="10" y1="14" x2="20" y2="4" /><polyline points="15 4 20 4 20 9" /></svg>
                        Payment Link
                </a>
                <a class="dropdown-item " href="/invoice/email/{{$invoice->id}}" onclick="return confirm('Are you sure?')">            
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                            Send Email
                    </a>
                    
    
            </div>

            <div class="dropdown-menu dropdown-menu-demo">
                <span class="dropdown-header">Payments</span>
                <a class="dropdown-item " href="#timeline" data-toggle="modal" data-target="#markpayment" >                  
	            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" /></svg>
                     Add Payment
                </a>
                <a class="dropdown-item " href="#timeline"  data-toggle="modal" data-target="#issuerefund">            
	            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2" /></svg>
                     Refund
                </a>

                <a class="dropdown-item " href="#timeline" data-toggle="modal" data-target="#editinvoice" >               
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                         Edit Invoice
                    </a>
                
                <a class="dropdown-item " href="/invoice/cancel/{{$invoice->id}}" onclick="return confirm('Are you sure?')">            
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16m2 -2h10a2 2 0 0 1 2 2v10m0 4.01v1.99l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><line x1="11" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="11" y2="11" /><line x1="13" y1="15" x2="15" y2="15" /><line x1="15" y1="11" x2="15" y2="11.01" /><line x1="3" y1="3" x2="21" y2="21" /></svg>
                         Cancel Invoice
                    </a>

                    <a class="dropdown-item " href="/invoice/delete/{{$invoice->id}}" onclick="return confirm('Are you sure?')">            
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"  style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
                             Delete Invoice
                </a>  
    
            </div>
         

        </div>
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title">Client Information</div>
                        <div class="mb-2">
                
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                          <strong>{{$invoice->clientdata->name}}</strong>
                                        </div>
                                        <div class="mb-2">
                                          
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                                      <strong> {{$invoice->clientdata->email}}</strong>
                                        </div>
                                        <div class="mb-2">
                                   
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>
                                       <strong> {{$invoice->clientdata->phone}}</strong>
                                        </div>

                       
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                          <strong>  {{$invoice->clientdata->address}} </strong>
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="11" r="3"></circle><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path></svg>
                          <strong>
                            {{$invoice->clientdata->city}}, {{$invoice->clientdata->country}}</strong>
                        </div>
                       
                      </div>
                    </div> 
        
                    
                    
                </div>  
                <div class="col-md-6">
                  <div class="card">
                  
                    <div class="card-body">
                    
                      <dl class="row">
                        <dt class="col-5">Date:</dt>
                        <dd class="col-7">  {{$invoice->invodate}}</dd>
                        <dt class="col-5">Due:</dt>
                        <dd class="col-7">{{$invoice->duedate}}</dd>
                        <dt class="col-5">Invoice NO:</dt>
                        <dd class="col-7"><strong>#{{$invoice->invoid}}</strong></dd>
                        <dt class="col-5">Status:</dt>
                        <dd class="col-7">
                            @if($invoice->invostatus ==1)<span class="badge bg-yellow">Unpaid</span>@endif
                            @if($invoice->invostatus ==2)<span class="badge bg-indigo">Part Paid</span>@endif
                            @if($invoice->invostatus ==3)<span class="badge bg-green">Paid</span>@endif
                            @if($invoice->invostatus ==4)<span class="badge bg-purple">Refuned</span>@endif
                            @if($invoice->invostatus ==5)<span class="badge bg-dark">Cancelled</span>@endif                        
                        </dd>
                        
                        <dt class="col-5">Amount:</dt>
                        <dd class="col-7"><strong>{{$settings->prefix}}{{$invoice->totalamount}}</strong></dd>
                        <dt class="col-5">Balance:</dt>
                        <dd class="col-7"><strong>{{$settings->prefix}}{{$invoice->totalamount - $invoice->paidamount}}</strong></dd>
                        @if($settings->taxstatus==1)
                        <dt class="col-5">Enable Tax:</dt>
                        <dd class="col-7"> 
                          <form action="{{route('invoicetaxenable')}}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{$invoice->id}}">
                                <label class="form-check form-switch m-0">
                                <input class="form-check-input position-static" name="taxable" onchange="this.form.submit()"  type="checkbox" @if($invoice->taxable==1) value="0" checked @else value="1" @endif >
                                </label>
                          </form> 
                        </dd>
                        @endif
                      </dl>
                    </div>
                  
                    </div>
        
                   
                </div>  

            </div>
          
            <div class="card" style="margin-top:15px;">
                <div class="card-header">
                  <h3 class="card-title">Invoice Items</h3>                
                </div>
                
                
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>                                
                                <th style="width:40%">Particular</th>
                                <th>Qty</th>
                                <th>Type</th>
                                <th>amount</th>
                                @if($invoice->taxable==1)
                                <th>tax</th>  
                                @endif                           
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach($invometas as $invometa)
                            <tr>
                              <form action="{{route('editinvoicemeta')}}" method="post">
                                @csrf
                                <input type="hidden" name="metaid" value="{{$invometa->id}}">
                                <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                                 
                                  <td class="text-muted"> <input class="form-control form-control-sm" type="text"   value="{{$invometa->meta}}" name="meta"  placeholder="Particular "></td>
                                  <td class="text-muted">
                                    <input class="form-control form-control-sm" type="text" name="qty"  value="{{$invometa->qty}}" placeholder="Qty">
                                  </td>
                                  <td>
                                      <select class="form-control form-control-sm" name="qtykey">
                                        <option value="Qty" @if($invometa->qtykey=="Qty") selected @endif> Qty </option>
                                        <option value="Hour" @if($invometa->qtykey=="Hour") selected @endif> Hour </option>
                                        <option value="Nos" @if($invometa->qtykey=="Nos") selected @endif> Nos </option>
                                      </select>
                                  </td>
                                  <td>                                         
                                    <input class="form-control form-control-sm" type="text" name="amount"  value="{{$invometa->amount}}"  placeholder="amount">                                          
                                 </td>
                                 @if($invoice->taxable==1)
                                 <td> 
                                   <input class="form-control form-control-sm" type="text"  value="{{$settings->prefix}}{{$invometa->tax}}"  placeholder="total" disabled>
                                </td>
                                @endif
                                  <td>
                                    <input class="form-control form-control-sm" type="text"  value="{{$settings->prefix}}{{$invometa->total}}"  placeholder="total" disabled>
                                 </td>
                                
                                  <td>
                                      <button type="submit" class="btn btn-success btn-sm"
                                          style="color: #fff;">Save</button>
                                  </td>
                                  <td>
                                    <a onclick="return confirm('Are you sure?')" href="/invoices/deleteinvoicemeta/{{$invometa->id}}/{{$invoice->id}}" class="btn btn-warning btn-sm"  style="color: #fff;">Del</a>
                                </td>
                              </form>
                          </tr>
                          @endforeach


                            <tr>
                                <form action="{{route('newinvoicemeta')}}" method="post">
                                   @csrf
                                   <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                                    
                                    <td class="text-muted"> <input class="form-control form-control-sm" type="text"  name="meta"  placeholder="Particular "></td>
                                    <td class="text-muted">
                                      <input class="form-control form-control-sm" type="text" name="qty" id="qty"  placeholder="Qty">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" name="qtykey">
                                          <option value="Qty"> Qty </option>
                                          <option value="Hour"> Hour </option>
                                          <option value="Nos"> Nos </option>
                                        </select>
                                    </td>
                                    <td>                                         
                                        <input class="form-control form-control-sm" type="text" name="amount" id="amount"  placeholder="amount" onchange="gettotal()">                                          
                                  </td>
                                  @if($invoice->taxable==1)
                                  <td> 
                                    <input class="form-control form-control-sm" type="text"  value="{{$settings->taxpercent}}%"  placeholder="total" disabled>
                                 </td>
                                  @endif
                                <td>                            
                                    <input  id="totalcost" class="form-control form-control-sm" type="text"  value="{{$settings->prefix}}00.00"  placeholder="total" disabled>
                                </td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm"
                                            style="color: #fff;">Save</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                    function gettotal() {
                         let qty =  document.getElementById("qty").value;
                         let amount =  document.getElementById("amount").value;
                         let total =  qty * amount;
                         @if($invoice->taxable==1)
                         let totalamt = {{$settings->taxpercent}} * total / 100 + total;
                         document.getElementById("totalcost").value = "{{$settings->prefix}}"+ totalamt;                         
                          @else                        
                         document.getElementById("totalcost").value = "{{$settings->prefix}}"+ total; 
                          @endif
                        }
                    </script>

                </div>
            </div>


            <div class="card" style="margin-top:15px;">
                <div class="card-header">
                  <h3 class="card-title">Transaction History </h3>                
                </div>
                
                
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Note</th>                               
                                <th>Transation</th>
                                <th></th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalamt = 0; @endphp
                          @foreach($payments as $payment)
                            <tr>                             
                                  <td class="text-muted">
                                    {{$payment->date}}
                                  </td>
                                  <td class="text-muted">
                                    ${{$payment->amount}}
                                    @php $totalamt += $payment->amount; @endphp
                                </td>
                                <td class="text-muted">
                                    {{$payment->note}}
                                </td>
                                <td class="text-muted">
                                    {{$payment->transation}}
                                </td>
                                  
                                  <td>
                                    <a onclick="return confirm('Are you sure?')" href="/invoices/reversepayment/{{$payment->id}}/{{$invoice->id}}" class="btn btn-warning btn-sm"  style="color: #fff;">Del</a>
                                </td>
                              
                          </tr>
                          @endforeach
                          <tr>                             
                            <td class="text-">
                             Total Payment : 
                            </td>
                            <td class="text-">                             
                          <strong>   {{$settings->prefix}} @php echo $totalamt; @endphp </strong>
                          </td>
                          <td class="text-muted">
                             
                          </td>
                          <td class="text-muted">
                          
                          </td>
                            
                            <td>
                            
                          </td>
                        
                    </tr>


                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>


    </div>

    <!---- payment mark --->


        <div class="modal modal-blur fade" id="markpayment" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Payment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('invopaymentsave')}}" method="post">
                    @csrf
                    <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                <div class="modal-body">
                    <div class="mb-2">
                        
                        <input type="date" class="form-control" name="date" placeholder="Date" value="@php  echo date('Y-m-d') @endphp">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$invoice->totalamount - $invoice->paidamount}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="Note">
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Add Payments</button>
                </div>
                </form>
              </div>
            </div>
          </div>

           <!---- refund issue --->


        <div class="modal modal-blur fade" id="issuerefund" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Issue Refund</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('refundinvoice')}}" method="post">
                    @csrf
                    <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                <div class="modal-body">
                    <div class="mb-2">
                        
                        <input type="date" class="form-control" name="date" placeholder="Date" value="@php  echo date('Y-m-d') @endphp">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Refund Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$invoice->paidamount}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="Note">
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Issue Refund</button>
                </div>
                </form>
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

        <!---- edit invoice --->


        

        <div class="modal modal-blur fade" id="editinvoice" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{route('editinvoicedata')}}" method="post">
                  @csrf
                  <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
              <div class="modal-body">
                <div class="mb-2">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" value="{{$invoice->title}}" placeholder="Title">
                </div>
                  <div class="mb-2">
                      <label class="form-label">Invoice Date</label>
                      <input type="date" class="form-control" name="invodate" placeholder="Invoice Date" value="{{$invoice->invodate}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="duedate" placeholder="Due Date" value="{{$invoice->duedate}}">
                  </div>
               
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update Invoice</button>
              </div>
              </form>
            </div>
          </div>
        </div>

      

@endsection
