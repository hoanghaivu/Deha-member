@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('notifications')
        <div class="card">
            <div class="card-header">
                <strong>Search</strong> Member
            </div>
            <div class="card-body card-block">
                <form id="data_search" action="{{ route(MEMBER_LIST) }}" method="get" class="form-horizontal" role="search">
                    <div class="row form-group">
                        <div class="col col-md-1">
                            <label class="form-control-label">Name</label>
                        </div>
                        <div class="col-3 col-md-5">
                            <input id="data_name" type="text" name="name" class="form-control" value="{{ request()->name ?? '' }}">
                        </div>
                        <div class="col col-md-1">
                            <label class="form-control-label">Mobile</label>
                        </div>
                        <div class="col-3 col-md-5">
                            <input id="data_mobile" type="text" name="mobile" class="form-control" value="{{ request()->mobile ?? '' }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm m10r">
                            {{ __('dehaText.button.search') }}
                        </button>
                        <a href="{{ route(MEMBER_LIST) }}">
                            <button type="reset" class="btn btn-secondary btn-sm">
                                {{ __('dehaText.button.reset') }}
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-data__tool-right m-b-30 col-lg-12">
        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <a class="js-arrow" href="{{ route(MEMBER_CREATE) }}">
                <span class="character-add">{{ __('dehaText.button.addMember') }}</span>
            </a>
        </button>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-12 m-b-20">
            <div class="row">
                <div class="col-lg-6">
                    {{ $members->firstItem() }} ~ {{ $members->lastItem() }} ({{ $members->total() }})
                </div>
                <div class="col-lg-6">
                    <div class="paginate-right">
                        {{ $members->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Birthday</th>
                        <th>Mobile</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Position</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @if($members->isNotEmpty())
                        @foreach($members as $member)
                            <tr>
                                <td data="{{ $member->id }}" data-toggle="modal" data-target="#MemberDetail"
                                    class="show_info">{{ $member->full_name }}
                                </td>
                                <td>{{ $member->birthday }}</td>
                                <td>{{ $member->mobile }}</td>
                                @if($member->gender == 0)
                                    <td class="text-center">Male</td>
                                @else
                                    <td class="text-center">Female</td>
                                @endif
                                <td>
                                    @php $positionNames = []; @endphp
                                    @foreach($member->memberPositions as $memberPosition)
                                        @php(array_push($positionNames, $memberPosition->positions['position_name']))
                                    @endforeach
                                    {{ implode(', ', $positionNames) }}
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item m10r" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit">
                                            <a href="{{ route(MEMBER_EDIT, ['id' => $member->id]) }}"><i class="zmdi zmdi-edit"></i></a>
                                        </button>
                                        <button class="item btnDeleteMember" data-toggle="modal" data-placement="top" title="Delete"
                                                data-target="#deleteMember" data-backdrop="false" data-id="{{ $member->id }}" data-name="{{ $member->full_name }}">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="6"><i>{{ __('dehaText.text.noData') }}</i></td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        {{ $members->firstItem() }} ~ {{ $members->lastItem() }} ({{ $members->total() }})
                    </div>
                    <div class="col-lg-6">
                        <div class="paginate-right">
                            {{ $members->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bengin modal member-delete -->
            <div class="modal fade m50t" id="deleteMember" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bgModalTitle">
                            <h5 class="modal-title bgModalTitle" id="mediumModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Are you sure delete this member: <span id="memberFullName"></span>?
                            </p>
                            <form action="{{ route(MEMBER_DELETE) }}" method="POST" id="formDeleteMember">
                                @csrf
                                <input type="hidden" id="memberId" name="memberId">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary m10r" data-dismiss="modal"> {{ __('dehaText.button.cancel') }}</button>
                            <button type="button" class="btn btn-primary" id="btnConfirmDeleteMember"> {{ __('dehaText.button.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End modal member-delete -->
        </div>

{{--        Begin modal member-detail--}}
        <div class="col-lg-12">
            <div class="modal fade m50t" id="MemberDetail" role="dialog" data-backdrop="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Member detail</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Full Name:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="name"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Division:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="division"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Gender:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="gender"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Birthday:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="birthday"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Mobile:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="mobile"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Start date:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="start_date"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Person mail:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="person_mail"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Deha mail:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="deha_mail"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Facebook:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="facebook"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Skype:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="skype"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Experience:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="exp"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Id card:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="id_card"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Date issued:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="date_issued"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Place issued:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="place_issued"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Marital:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="marital"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4 text-right">
                                                <label class="form-control-label font-weight-bold" for="id">Education:</label>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <span id="education"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class="form-control-label font-weight-bold" for="id">Home town:</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <span id="home"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class="form-control-label font-weight-bold" for="id">Accommodation:</label>
                                            </div>
                                            <div class="col-6 col-md-9">
                                                <span id="accommodation"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        End modal member-detail--}}
    </div>
</div>
@endsection