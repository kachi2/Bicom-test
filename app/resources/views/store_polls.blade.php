
@extends('layouts.app')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title " style="font-size:1.05rem">View Individual Polls Results</h4>
                                            
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                 <form method="post" action="{{route('PollsStore')}}">
                                        @csrf
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            
                                            <div class="card-inner">
                                                <Label for="lga"> Select Local Governemnt
                                                </Label> 
                                                <select class="form-control" id="lga"> 
                                                @foreach ($lga as $lg )
                                                <option value="{{$lg->lga_id}}"> {{$lg->lga_name}}</option> 
                                                @endforeach  
                                                </select>
                                                <div class="p-2"></div>

                                                <Label for="lga"> Select Polling Unit
                                                </Label> 
                                                <select class="form-control" id="unit" name="polling_id"> 
                                                
                                                <option value=""> Polling Units</option> 
                                               
                                                </select>


                                                <div class="p-4"></div>
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">Populate Results</h5>
                                                    </div>
                                                    <div class="card-tools mr-n1">
                                                    </div><!-- .card-tools -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-block nk-block-lg">
                                                    <div class="card card-preview">
                                                        <div class="card-inner">
                                                            <label for="textArea">Enter Results with Party </label>
                                                            
                                                           <textarea class="form-control" id="textArea" name="polls_results"> {{old('polls_results')}} </textarea> 
                                                           <small>Enter Party name and score as pairs, seperate with coma (,) e.g PDP:534, LABOUR:3433</small> 
                                                           <p> Party Codes: @foreach ($party as  $pp)
                                                               <span> {{$pp->partyname}}</span>
                                                           @endforeach </p>
                                                        </div>
                                                    </div><!-- .card-preview -->
                                               
                                                </div> <!-- nk-block -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                              <button type="submit" class="btn btn-outline-primary">Upload Results</button>
                                             </div><!-- .card-inner -->
                                            </form>
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </form>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
               
@endsection
@section('scripts')
    <script>

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};


if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}
$('#lga').change(function(){
    site_url = '{{ route("getLga") }}';
    options = ""
    var id = document.getElementById('lga').value;
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('conent')
        }
    });
    $.ajax({
        url:"{{route('getLgaPolls',"")}}" + "/"+ id,
        type:"get",
        dataType:"json",
        cache:false,
        success:function(response){
            $.each(response, function(key, value) {
            options += "<option value="+value.uniqueid+">"  +  value.polling_unit_name + "</option>"
            });
            option = "<option> Select Polling Unit </option>"
            $('#unit').empty(options)
            $('#unit').append(option);
            $('#unit').append(options);
        }
    }) 
        });
       
</script>
@endsection
