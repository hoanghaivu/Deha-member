@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @include('notifications')
        <div class="card">
            <div class="card-header">
                <strong>Edit</strong> Member
            </div>
            <div class="card-body card-block">
                <form action="{{ route(MEMBER_UPDATE, ['id' =>  $members->id]) }}" method="post" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="member_id" value="{{ $members->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Division <span class="character-require">*</span></label>
                                <select class="form-control" name="division_id">
                                <option value="">Please choose</option>
                                    @foreach($divisions as $key => $division)
                                        <option value="{{ $key }}" {{ ($members->division_id == $key) ? "selected" : "" }}>
                                            {{ $division }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(!empty($errors->has('division_id')))
                                    <span class="message-validate">{{ $errors->first('division_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Full Name <span class="character-require">*</span></label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') ?? $members->full_name }}">
                                @if(!empty($errors->has('full_name')))
                                <span class="message-validate">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row radio-margin-bottom">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Gender <span class="character-require">*</span></label>
                                <div>
                                    <label class="radio-inline">
                                        <input class="" type="radio" name="gender" value="0" 
                                            @if($members->gender == 0)
                                                {{ "checked" }}
                                            @endif> Male
                                    </label>
                                    <label class="radio-inline ">
                                        <input class="" type="radio" name="gender" value="1"
                                            @if($members->gender == 1)
                                                {{ "checked" }}
                                            @endif> Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Birthday <span class="character-require">*</span></label>
                                <div class='input-group date format-date'>
                                    <input name="birthday" type='text' class="form-control" value="{{ old('birthday') ?? $members->birthday }}" />
                                    <span class="input-group-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                @if(!empty($errors->has('birthday')))
                                <span class="message-validate">{{ $errors->first('birthday') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Home Town <span class="character-require">*</span></label>
                                <input type="text" name="hometown" class="form-control" value="{{ old('hometown') ?? $members->hometown }}">
                                @if(!empty($errors->has('hometown')))
                                <span class="message-validate">{{ $errors->first('hometown') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Start Date <span class="character-require">*</span></label>
                                <div class='input-group date format-date'>
                                    <input name="start_working_date" type='text' class="form-control" value="{{ old('start_working_date') ?? $members->start_working_date }}" />
                                    <span class="input-group-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                @if(!empty($errors->has('start_working_date')))
                                <span class="message-validate">{{ $errors->first('start_working_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Deha Mail</label>
                                <input type="text" name="deha_mail" class="form-control" value="{{ old('deha_mail') ?? $members->deha_mail }}">
                                @if(!empty($errors->has('deha_mail')))
                                <span class="message-validate">{{ $errors->first('deha_mail') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Person Mail <span class="character-require">*</span></label>
                                <input type="text" name="person_mail" class="form-control" value="{{ old('person_mail') ?? $members->person_mail }}">
                                @if(!empty($errors->has('person_mail')))
                                <span class="message-validate">{{ $errors->first('person_mail') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Positions <span class="character-require">*</span></label>
                                <div>
                                    <div class="form-check-inline form-check">
                                        @foreach($positions as $key => $position)
                                            <label for="position_{{ $key }}" class="form-check-label m15r hover-pointer">
                                                <input id="position_{{ $key }}" class="form-check-input" type="checkbox" 
                                                    name="positions[]" value="{{ $key }}"
                                                    @foreach($members->memberPositions as $memberPosition)
                                                        {{ ($memberPosition->position_id == $key) ? "checked" : "" }}
                                                    @endforeach
                                                    >
                                                {{ $position }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Mobile <span class="character-require">*</span></label>
                                <input type="text" name="mobile" class="form-control format-mobile" value="{{ old('mobile') ?? $members->mobile }}">
                                @if(!empty($errors->has('mobile')))
                                <span class="message-validate">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Skype</label>
                                <input type="text" name="skype" class="form-control" value="{{ old('skype') ?? $members->skype }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{ old('facebook') ?? $members->facebook }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Accommodation <span class="character-require">*</span></label>
                                <input type="text" name="current_accommodation" class="form-control" value="{{ old('current_accommodation') ?? $members->current_accommodation }}">
                                @if(!empty($errors->has('current_accommodation')))
                                <span class="message-validate">{{ $errors->first('current_accommodation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Experience</label>
                                <input type="text" name="experience" class="form-control format-experience" value="{{ old('experience') ?? $members->experience }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">ID Card <span class="character-require">*</span></label>
                                <input type="text" name="id_card_member" class="form-control format-idCard" value="{{ old('id_card_member') ?? $members->id_card_member }}">
                                @if(!empty($errors->has('id_card_member')))
                                <span class="message-validate">{{ $errors->first('id_card_member') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Place Issued <span class="character-require">*</span></label>
                                <input type="text" name="place_issued" class="form-control" value="{{ old('place_issued') ?? $members->place_issued }}">
                                @if(!empty($errors->has('place_issued')))
                                <span class="message-validate">{{ $errors->first('place_issued') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Date Issued <span class="character-require">*</span></label>
                                <div class='input-group date format-date'>
                                    <input name="date_issued" type='text' class="form-control" value="{{ old('date_issued') ?? $members->date_issued }}" />
                                    <span class="input-group-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                @if(!empty($errors->has('date_issued')))
                                <span class="message-validate">{{ $errors->first('date_issued') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 radio-margin-bottom">
                            <div class="form-group">
                                <label class="form-control-label">Marital Status <span class="character-require">*</span></label>
                                <div>
                                    <label class="radio-inline">
                                        <input class="" type="radio" name="marital_status" value="0"
                                            @if($members->marital_status == 0)
                                                {{ "checked" }}
                                            @endif> Alone
                                    </label>
                                    <label class="radio-inline">
                                        <input class="" type="radio" name="marital_status" value="1"
                                            @if($members->marital_status == 1)
                                                {{ "checked" }}
                                            @endif> Married
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Education <span class="character-require">*</span></label>
                                <input type="text" name="education" class="form-control" value="{{ old('education') ?? $members->education }}">
                                @if(!empty($errors->has('education')))
                                <span class="message-validate">{{ $errors->first('education') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="float-right m15t">
                        <button type="submit" class="btn btn-primary btn-sm m10r">
                            {{ __('dehaText.button.edit') }}
                        </button>
                        <button type="reset" class="btn btn-secondary btn-sm">
                            {{ __('dehaText.button.reset') }}
                        </button>
                        </a>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection