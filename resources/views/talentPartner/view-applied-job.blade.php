@extends('partials.talentPartner.app')
@section('talentPartnerTitle','View Applied Job')
@section('talentPartner-content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome {{auth()->user()->name}} </h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">View Applied Job's</a></li>
                </ol>
            </div>
        </div>

        <!-- Notification Start -->
        @if(Session::get('success'))
        <div class="alert alert-success solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>{{session::get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @elseif (Session::get('error'))
        <div class="alert alert-danger solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>{{session::get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @elseif (Session::get('delete'))
        <div class="alert alert-danger solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>{{session::get('delete')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
        <!-- Notification End -->
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Applied Job's</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display text-center" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Company Name</th>
                                        <th>Job Title</th>
                                        <th>Applied Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($viewAppliedJob as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            @if ($data->userId== NULL)
                                            Werecuite
                                            @else
                                            {{$data->company_name}}
                                            @endif

                                        </td>
                                        <td>{{ $data->job_title}}</td>
                                        <td>{{ $data->created_at->format('d M Y h:i A')}} <span class="text-success">({{$data->created_at->diffForHumans()}})</span></td>
                                        <td>
                                            @if ($data != NULL)
                                            @if($data->status == 0 && $data->screening_schedule == 0 && $data->interview_schedule == 0 && $data->selected == 0)

                                            <button type="button" class="btn btn-success btn-sm">Applied</button>

                                            @elseif ($data->status == 1 && $data->screening_schedule == 0 && $data->interview_schedule == 0 && $data->selected == 0)

                                            <button type="button" class="btn btn-success btn-sm">Screening</button>


                                            @elseif ($data->status == 1 && $data->screening_schedule == 1 && $data->interview_schedule == 0 && $data->selected == 0)

                                            <button type="button" class="btn btn-success btn-sm">Screening Scheduled</button>


                                            @elseif ($data->status == 1 && $data->screening_schedule == 1 && $data->interview_schedule == 1 && $data->selected == 0)

                                            <button type="button" class="btn btn-success btn-sm">Interview Scheduled</button>


                                            @elseif ($data->status == 1 && $data->screening_schedule == 1 && $data->interview_schedule == 1 && $data->selected == 1)

                                            <button type="button" class="btn btn-success btn-sm">Selected</button>

                                            @endif
                                            @endif

                                        </td>

                                        <td>
                                            <a href="#"><a href="{{route('talent.job_desc',['id'=>$data->jobId])}}" class="btn btn-success btn-sm" title="View Job Description"><i class="fa fa-eye"></i></a></a>
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
    </div>
</div>

@endsection
@push('script')


@endpush