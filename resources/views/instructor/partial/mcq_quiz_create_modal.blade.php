{{--lecture Create model start--}}
<div class="col-xs-6 col-sm-3 m-t-30">
    <div id="createMCQQuizModal-{{$chapter->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" action="{{route('instructor.mcqQuizzes.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">MCQ Quiz Form</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">MCQ Quiz Title</label>
                            <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter Quiz title">
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <label for="marks">Quiz Time (Minutes)</label>
                            <input type="text" name="time" value="{{old('time')}}" class="form-control @error('time') is-invalid @enderror" id="ex1" placeholder="Enter Quiz time in minutes">
                        </div>
                        @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


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

                        <input type="hidden" name="chapter_id" value="{{$chapter->id}}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
{{--lecture Create model end--}}
