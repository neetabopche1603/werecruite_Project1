@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center text-primary">Show All Data</h3>
        </div>
        <div class="card-body mt-2">
        <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-12 col-md-12 col-11">
            <table id="survey" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Survey Id</th>
                        <th>Family Head Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Ward No.</th>
                        <th>Vidhan Sabha Name</th>
                        <th>Other Info</th>
                        <th>See Family Members</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($survey as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->surveyId}}</td>
                        <td>{{ $row->family_head_name }}</td>
                        <td>{{ $row->address}}</td>
                        <td>{{ $row->mobile }}</td>
                        <td>{{ $row->ward_no }}</td>
                        <td>{{ $row->vidhan_name}}</td>
                        <td>{{ $row->other_info}}</td>
                        <td class="text-center"><a href="{{ route('seeMember',$row->id) }}" class="btn btn-success btn-sm">See</a>       
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        </div>
   
   
    </div>
</div>
@endsection