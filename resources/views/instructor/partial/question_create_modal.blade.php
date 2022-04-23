{{--lecture Create model start--}}
<div class="col-xs-6 col-sm-3 m-t-30">
    <div id="createMcqQuestionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" action="{{route('instructor.questions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Mcq Quiz Form</h4>
                    </div>
                    <div>
                        <div class="row text-center m-t-10">
                            <input type="checkbox" id="fileQuestion">
                            <label for="">MCQ Image</label>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="textField">
                            <label for="question">Question Title</label>
                            <input type="text" name="question" value="{{old('question')}}" class="form-control @error('question') is-invalid @enderror" id="ex1" placeholder="Enter Quiz title">
                        </div>
                        @error('question')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group" style="display: none" id="fileField">
                            <label for="audio">Question File</label>
                            <input type="file" name="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror">
                        </div>

                        <div class="form-group">
                            <label for="form-field-2">Option A </label>
                            <div>
                                <input type="text" id="form-field-2" placeholder="Option" class="form-control" name="option[]" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-field-2">Option B </label>
                            <div>
                                <input type="text" id="form-field-2" placeholder="Option" class="form-control" name="option[]" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-field-2">Option C </label>
                            <div>
                                <input type="text" id="form-field-2" placeholder="Option" class="form-control" name="option[]" required="" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="form-field-2">Option D </label>
                            <div>
                                <input type="text" id="form-field-2" placeholder="Option" class="form-control" name="option[]" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-field-2">Right Answer</label>
                            <div>
                                <input type="text" id="form-field-2" placeholder="Right Answer" class="form-control" name="answer" required="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-field-2">Note : </label>
                            <div>
                                <input type="text" id="form-field-2" placeholder=" Note " class="form-control" name="note"   />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Quiz Status</label>
                            <br>
                            @php
                                if (old('status')){
                                    $status = old('status');
                                }else {
                                    $status = 1;
                                }
                            @endphp
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                <label for="inlineRadio1">Active</label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="0" name="status"@if($status==0) {{'checked'}}@endif>
                                <label for="inlineRadio1">Inactive</label>
                            </div>
                        </div>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="hidden" name="mcq_quiz_id" value="{{$mcqQuiz->id}}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
</div>
{{--lecture Create model end--}}

