{{-- Begin modal member-add --}}
<div class="col-lg-12">
    <div class="modal fade m50t" id="MemberAdd" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Team</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                @include('notifications')
                <div class="modal-body">
                    <form action="{{ route(TEAM_STORE) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Division <span class="character-require">*</span></label>
                                    <select class="form-control" name="division_id" id="division_id">
                                        <option value="">Please choose</option>
                                        @foreach($divisions as $key => $division)
                                            <option value="{{ $key }}" {{ old('division_id') == $key ? 'selected' : '' }}>{{ $division }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Team Name <span class="character-require">*</span></label>
                                    <input type="text" id="name" name="team_name" class="form-control"
                                           value="{{ old('team_name') ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Members <span class="character-require">*</span></label>
                                    <input id="autocomplete" type="text" name="members[]" class="form-control biginput" />
                                </div>
                            </div>
                            <div id="members" class="col-lg-12 table-responsive table--no-card" style="height: 100px; overflow-y: scroll"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right m15t">
                                <button id="submit-team" type="button" class="btn btn-success btn-sm">
                                    {{ __('dehaText.button.add') }}
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    {{ __('dehaText.button.reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End modal member-add --}}