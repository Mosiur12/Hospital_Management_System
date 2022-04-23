<div id="quizMarkModel-{{$key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" action="{{route('instructor.course.quiz.uploadQuizMark')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Marks Upload</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" name="marks" value="{{old('marks')}}" class="form-control @error('marks') is-invalid @enderror" id="ex1" placeholder="Enter Quiz Marks">
                    </div>
                    @error('marks')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="marks_id" value="{{$answerScript->id}}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
