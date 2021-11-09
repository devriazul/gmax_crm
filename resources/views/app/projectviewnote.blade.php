@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="row">
    <div class="col-md-3">
        @include('app.projectnav')

     
     

    </div>
    <div class="col-md-9">      
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Note</h3>
                      </div>
                    <div class="card-body p-2">
                    <form action="{{route('updatenoteprjct')}}" method="post" enctype="multipart/form">
                        @csrf 
                        <input type="hidden" name="id" value="{{$note->id}}">
                        <textarea id="editor" class="form-control" style="width: 100%;" id="editor" name="note" rows="6">
                            {!!$note->note!!}
                        </textarea>
                       
                  
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="#" class="btn btn-link">Last updated by {{$note->admindata->name}} </a>
                          <button type="submit"  class="btn btn-primary ms-auto">Save</a>
                        </div>
                      </div>
                    </form>
                </div>
             </div>      
             


        </div>
        
    </div>
    
</div> 



<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )       
        .catch( error => {
            console.error( error );
            
        } );


</script>


@endsection
