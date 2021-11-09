@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Invoice Manager</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New Invoice</button>
      </div> 
    </div>
      <div id="advancedsearch" style="display:none;">
        <form action="{{ route('listofinvoices') }}" method="get">
          <div class="row" style=" margin:10px;">				
            <div class="col-md-2">					
                <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
                <input type="text" class="form-control form-control-sm" name="filter[title]" placeholder="Invoice Title">					 
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Invoice #id</label>
              <input type="text" class="form-control form-control-sm" name="filter[invoid]" placeholder="eg: 22">					 
          </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Client</label>
              <select class="form-select  form-select-sm" name="filter[userid]">
                <option value="">Select Client</option>
                @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
                </select>					 
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Status</label>
              <select class="form-select  form-select-sm" name="filter[invostatus]">
                <option value="">Select Status</option>
                <option value="1">Unpaid</option>
                <option value="2">Part Paid</option>
                <option value="3">Paid</option>
                <option value="4">Refuned</option>
                <option value="5">Cancelled</option>          
                </select>					 
            </div>
           
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">&nbsp;</label>
              <button type="submit" class="btn btn-warning  btn-sm"> Search </button>
            </div>
          </div>
        </form>
        </div>
   

    <div class="table-responsive" id="theTable">
      <table class="table card-table table-vcenter text-nowrap datatable" >
        <thead>
            <tr>
                <th>Invo ID </th>
                <th>Title </th>
                <th>Client </th>
                <th>Date </th>
                <th>Due Date </th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Staus</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($invoices as $invoice)
            <tr>
               
                <td>
                  
                   # {{$invoice->invoid}}
                </td>
                <td><a href="{{route('editinvoice', ['id' => $invoice->id])}}"> {{$invoice->title}}</a></td>
                <td> 
                  <a href="/client/ {{ !empty($invoice->clientdata) ? $invoice->clientdata->id:'' }}">   {{ !empty($invoice->clientdata) ? $invoice->clientdata->name:'Removed' }} </a>
                </td>
                <td>
                    {{$invoice->invodate}}
                </td>
                <td> {{$invoice->duedate}}
                </td>
                <td> {{$invoice->totalamount}}
                </td>
                <td> {{$invoice->paidamount}}
                </td>
                <td>
                    @if($invoice->invostatus ==1)<span class="badge bg-yellow">Unpaid</span>@endif
                            @if($invoice->invostatus ==2)<span class="badge bg-indigo">Part Paid</span>@endif
                            @if($invoice->invostatus ==3)<span class="badge bg-green">Paid</span>@endif
                            @if($invoice->invostatus ==4)<span class="badge bg-purple">Refuned</span>@endif
                            @if($invoice->invostatus ==5)<span class="badge bg-dark">Cancelled</span>@endif    
                </td>
               
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn btn-white btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/invoice/edit/{{$invoice->id}}">
                                Edit Invoice
                            </a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                href="/invoice/delete/{{$invoice->id}}">
                                Delete Invoice
                            </a>
                        </div>
                    </span>
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$invoices->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$invoices->links()}}
      </ul>
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Invoice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <form action="{{route('createnewinvoice')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Invoice Title</label>
                <input type="text" class="form-control" name="title" placeholder="Invoice Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('addclient')}}" style="float:right;"> Add New Client </a></label>
                <select name="userid" id="select-users" class="form-select">
                   @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                   @endforeach
                  </select>
            </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Invoice</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    
	  <script>
      function advancedsearch() {
        var x = document.getElementById("advancedsearch");
        if (x.style.display === "none") {
        x.style.display = "block";
        } else {
        x.style.display = "none";
        }
      }



      </script>

@endsection
