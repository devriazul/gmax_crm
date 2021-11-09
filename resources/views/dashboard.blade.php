@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div class="row">
        <div class="col-3">
          <a href="/invoices?filter[invostatus]=1">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-yellow text-white avatar">                       
	                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                       Unpaid Invoice
                      </div>
                      <div class="text-muted">
                        {{$counts['unpaid']}}  Unpaid Invoices
                      </div>
                    </div>
                  </div>
                </div>          
              </div></a>
        </div>
        <div class="col-3"> 
          <a href="/invoices?filter[invostatus]=3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-lime text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                       Paid Invoices
                      </div>
                      <div class="text-muted">
                        {{$counts['paid']}}  Paid Invoices
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>

        <div class="col-3">
          <a href="/quotes">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-teal text-white avatar">                   
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="7" width="18" height="13" rx="2" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><line x1="12" y1="12" x2="12" y2="12.01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        Quotes
                      </div>
                      <div class="text-muted">
                        {{$counts['quotes']}} Quotes
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>

        <div class="col-3">
          <a href="/projects?filter[status]=2">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-blue text-white avatar">
	                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="6" rx="1" /><rect x="4" y="14" width="6" height="6" rx="1" /><rect x="14" y="14" width="6" height="6" rx="1" /><line x1="14" y1="7" x2="20" y2="7" /><line x1="17" y1="4" x2="17" y2="10" /></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                       Active Projects
                      </div>
                      <div class="text-muted">
                        {{$counts['prjinprogress']}} Active Projects
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Invoice summary</h3>
                  <div id="chart-mentions" class="chart-lg"></div>
                </div>
              </div>

        </div>
        <div class="col-4">
           
                <div class="card ">
                  <div class="card-body mb-4">
                    <h3 class="card-title">Project summary</h3>
                    <div id="chart-demo-pie"></div>
                  </div>
                </div>
            
        </div>
    </div>

  
        
<div class="card mt-3">
    <div class="card-header">
      <h3 class="card-title">Unpaid Invoices</h3>
      <button type="button" data-toggle="modal" data-target="#modal-simple"
      style="float: right; right:0; margin-right:10px; position: absolute;"
      class="btn btn-warning btn-sm">Create New Invoice</button>
    </div>

    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
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
                <td>@php $todaydate = date('Y-m-d');  @endphp
                            @if($invoice->invostatus ==1)@if($invoice->duedate < $todaydate)<span class="badge bg-red">Overdue</span> @else <span class="badge bg-yellow">Unpaid</span>   @endif @endif
                            @if($invoice->invostatus ==2)@if($invoice->duedate < $todaydate)<span class="badge bg-red">Overdue</span> @else <span class="badge bg-indigo">Part Paid</span>  @endif @endif
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
          </button>
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
    





    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js"></script>
<script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: true
                    },
                    stacked: false,
                },
                plotOptions: {
                    bar: {
                        columnWidth: '40%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Invoices",
                    data: [ @for($i=0; $i<40; $i++) '{{ $datas[$i]['count']}}' , @endfor ]
                },
                {
                    name: "Quotes",
                    data: [ @for($i=0; $i<40; $i++) '{{ $quotedata[$i]['count']}}' , @endfor ]
                }],
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                xaxis: {
                    labels: {
                        padding: 0
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [ @for($i=0; $i<40; $i++) ' {{ $datas[$i]['date']}} ' , @endfor
                    ],
                colors: ["#206bc4", "#bfe399", "#bfe399"],
                legend: {
                    show: true,
                    position: 'bottom',
                    height: 32,
                    offsetY: 8,
                    markers: {
                        width: 8,
                        height: 8,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                    },
                },
            })).render();
        });
        // @formatter:on
      </script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
            chart: {
                type: "donut",
                fontFamily: 'inherit',
                height: 240,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            series: [{{$counts['prjnotstart']}}, {{$counts['prjinprogress']}}, {{$counts['prjinreview']}}, {{$counts['prjincompleted']}}],
            labels: ["Not Started", "In Progress", "In Review", "Completed"],
            grid: {
                strokeDashArray: 4,
            },
            colors: ["#C6CAD0", "#4299E1", "#F59F00", "#2FB344"],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
            tooltip: {
                fillSeriesColor: false
            },
        })).render();
    });
    // @formatter:on
  </script>

@endsection