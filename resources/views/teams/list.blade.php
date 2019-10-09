@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('notifications')
        <div class="card">
            <div class="card-header">
                <strong>Search</strong> Team
            </div>
            <div class="card-body card-block">
                <form action="{{ route(TEAM_LIST) }}" method="get" class="form-horizontal" role="search">
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label class=" form-control-label">Team name</label>
                        </div>
                        <div class="col-12 col-md-10">
                            <input class="form-control" type="search" id="team_name" name="team_name" value="{{ request()->team_name ?? '' }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('dehaText.button.search') }}
                        </button>
                        <a href="{{ route(TEAM_LIST) }}">
                            <button type="reset" class="btn btn-danger btn-sm">
                                {{ __('dehaText.button.reset') }}
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('teams.add')
    <div class="row col-lg-12">
        <div class="col-lg-6">
            <div class="table-data__tool-right m-b-30">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#MemberAdd">
                    <a class="js-arrow" href="#">
                        <span class="character-add">{{ __('dehaText.button.addTeam') }}</span>
                    </a>
                </button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="paginate-right">
                {{ $teams->appends(request()->all())->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning division-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Team</th>
                    <th>Division</th>
                    <th class="text-center">Members Total</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($teams->isNotEmpty())
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->id }}</td>
                            <td>{{ $team->team_name }}</td>
                            <td>{{ $team->divisions->division_name }}</td>
                            <td class="text-center">{{ $team->team_members_count }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <a href="#">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </button>
                                    <button title="Delete" class="item btnDeleteTeam" data-toggle="modal" data-name="{{ $team->team_name }}" data-id="{{ $team->id }}" data-target="#deleteTeam">
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
    </div>

    <div class="col-lg-12">
        <div class="col-lg-6">
            {{ $teams->firstItem() }} ~ {{ $teams->lastItem() }} ({{ $teams->total() }})
        </div>
        <div class="col-lg-6">
            <div class="paginate-right">
                {{ $teams->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection