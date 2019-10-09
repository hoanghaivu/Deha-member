@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @include('notifications')
        <div class="card">
            <div class="card-header">
                <strong>Search</strong> Division
            </div>
            <div class="card-body card-block">
                <form action="{{ route(DIVISION_LIST) }}" method="get" class="form-horizontal" role="search">
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label class=" form-control-label">Division name </label>
                        </div>
                        <div class="col-12 col-md-10">
                            <input class="form-control" type="search" id="division_name" name="division_name" value="{{ request()->division_name ?? '' }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm m10r">
                            {{ __('dehaText.button.search') }}
                        </button>
                        <a href="{{ route(DIVISION_LIST) }}">
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
            <a class="js-arrow" href="{{ route(DIVISION_CREATE) }}">
                <span class="character-add">{{ __('dehaText.button.addDivision') }}</span>
            </a>
        </button>
    </div>

    <div class="col-lg-12">
{{--        Begin paginate--}}
        <div class="col-lg-12 m-b-20">
            <div class="row">
                <div class="col-lg-6">
                    {{ $divisions->firstItem() }} ~ {{ $divisions->lastItem() }} ({{ $divisions->total() }})
                </div>
                <div class="paginate-right col-lg-6">
                    {{ $divisions->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
{{--        End paginate--}}
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning division-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Division Name</th>
                        <th class="text-center">Members Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($divisions->isNotEmpty())
                    @foreach($divisions as $division)
                    <tr>
                        <td>{{ $division->id }}</td>
                        <td>{{ $division->division_name }}</td>
                        <td class="text-center">{{ $division->members_count }}</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item m10r" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="{{ route(DIVISION_EDIT, ['id' => $division->id]) }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                </button>
                                <button title="Delete" class="item btnDeleteDivision" data-toggle="modal" data-name="{{ $division->division_name }}" data-id="{{ $division->id }}" data-target="#deleteDivision">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="no-data" colspan="4">
                            <i>{{ __('dehaText.text.noData') }}</i>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{--        Begin paginate--}}
        <div class="col-lg-12 m-b-30">
            <div class="row">
                <div class="col-lg-6">
                    {{ $divisions->firstItem() }} ~ {{ $divisions->lastItem() }} ({{ $divisions->total() }})
                </div>
                <div class="paginate-right col-lg-6">
                    {{ $divisions->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
        {{--        End paginate--}}
    </div>

    <div class="col-lg-12">
        <div id="deleteDivision" class="modal fade m50t" role="dialog" data-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bgModalTitle">
                        <h5 class="modal-title bgModalTitle">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p>Are you sure want to delete this division: <span id="divisionName"></span>?</p>
                        <form action="{{ route(DIVISION_DELETE) }}" method="post" id="formDeleteDivision">
                            @csrf
                            <input type="hidden" id="divisionId" name="divisionId">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary m10r" data-dismiss="modal">{{ __('dehaText.button.cancel') }}</button>
                        <button type="button" class="btn btn-primary" id="btnConfirmDeleteDivision">{{ __('dehaText.button.ok') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection