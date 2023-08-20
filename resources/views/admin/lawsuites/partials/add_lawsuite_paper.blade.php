<!-- Modal effects -->
<div class="modal" id="addLawsuitePaper">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <form class="form-horizontal" action="{{ route('admin.lawsuites-papers.store') }}" method="POST">
                @csrf
				<input type="hidden" name="_method">
				<input type="hidden" name="id">
				<input type="hidden" name="lawsuite_id">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="title">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.newspapers', 0) }}</label>
                                <input type="text" name="title" class="title form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="date">{{ trans('site.date_attr', ['attr' => trans_choice('site.newspapers', 0)]) }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div><input class="form-control @error('date') is-invalid @enderror fc-datepicker" name="date" placeholder="MM/DD/YYYY" type="text" value="{{ old('date') }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="subject">{{ removebeginninLetters(trans('site.subject'), 2) .' '. trans_choice('site.newspapers',0) }}</label>
                                <textarea name="subject" class="form-control @error('subject') is-invalid @enderror contract_textarea" name="subject" id="subject" placeholder="{{ removebeginninLetters(trans('site.subject'), 2) .' '. trans_choice('site.newspapers',0) }}">{{ old('subject') }}</textarea>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-sm">
                            
                            <div class="col-lg">
                                <label for="based_on_it">{{ trans('site.based_on_it') }}</label>
                                <textarea name="based_on_it" class="form-control @error('based_on_it') is-invalid @enderror contract_textarea" name="based_on_it" id="based_on_it" placeholder="{{ trans('site.based_on_it') }}">{{ old('based_on_it') }}</textarea>
                                @error('based_on_it')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success save-btn" type="submit">{{ trans('site.add') }}</button>
                    <button class="btn ripple btn-secondary close-btn" data-dismiss="modal" type="button">{{ trans('site.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->