@extends('layouts.app')
@section('content')
    <div class="col-lg-12">
        @include('notifications')
        <div class="card">
            <div class="card-header">
                <strong>Division</strong> Add new
            </div>
            <div class="card-body card-block">
                <form action="{{ route(DIVISION_STORE) }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Division name <span class="character-require">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="division_name" name="division_name"
                                placeholder="Enter division name..." class="form-control" value="{{ old('division_name') }}">
                            @if(!empty($errors->has('division_name')))
                                <span class="message-validate">{{ $errors->first('division_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm m10r"> {{ __('dehaText.button.add') }}
                        </button>
                        <a href="{{ route(DIVISION_CREATE) }}">
                            <button type="reset" class="btn btn-secondary btn-sm"> {{ __('dehaText.button.reset') }}
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection