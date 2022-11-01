
@extends('layouts.app')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title " style="font-size:1.05rem">View LGA Polling Results</h4>
                                            
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
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
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title"> Results</h5>
                                                    </div>
                                                    <div class="card-tools mr-n1">
                                                    </div><!-- .card-tools -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-block nk-block-lg">
                                                    <div class="card card-preview">
                                                        <div class="card-inner">
                                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true" id="buildTable">
                                                                <thead>
                                                                    <tr class="nk-tb-item nk-tb-head">
                                                                        <th class="nk-tb-col "><span class="sub-text">#Id</th>
                                                                          <th class="nk-tb-col "><span class="sub-text">Party</th>
                                                                         <th class="nk-tb-col "><span class="sub-text">Votes Counts</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <tr class="nk-tb-item">   
                                                                        <td class="nk-tb-col "></td>
                                                                        <td class="nk-tb-col "></td>
                                                                       <td class="nk-tb-col "></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div><!-- .card-preview -->
                                                </div> <!-- nk-block -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                               Total Valid Votes: <span id="total"> </span>
                                             </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
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
// $('#arms-div').load(site_url+'classes/classes-and-arms #arms-table');
$('#lga').change(function(){
    lga_id = document.getElementById('lga').value;
            $.ajaxSetup({
                header:
                {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('lga-polls-result',"")}}" + "/" + lga_id,
                type: "get",
                dataType: "json",
                cache:false,
                success:function(response) { 
                  //  console.log(response.result);
                    if(response.results.length > 1){
                    var buildTable = "<tr class=\"nk-tb-item nk-tb-head\"> <th class=\"nk-tb-col \"><span class=\"sub-text\">#Id </th> <th class=\"nk-tb-col\"><span class=\"sub-text\">Party</th> <th class=\"nk-tb-col\"><span class=\"sub-text\">Votes Counts</th> </tr> ";
                    $.each(response.results, function(key, value){
                        buildTable += "<tr class=\"nk-tb-item\"><td class=\"nk-tb-col\">" + value.result_id+ "</td>"
                                    +  "<td class=\"nk-tb-col \"> "  + value.party_abbreviation + " </td> "
                                    + "<td class=\"nk-tb-col\">" + value.party_score + "</td></tr>";
                    })
                    $('#buildTable').html(buildTable);
                    $('#total').html(response.total)
                }else{
                    Swal.fire({
                        title: 'No Results Found',
                        text: "Seems there was no election in this polling Unit",
                        showCancelButton: false,
                        cancelButtonText: 'Exit!'
                    });
                    $('#buildTable').empty()
                    $('#total').empty();
                }
                },
            });
        });  
</script>
@endsection
