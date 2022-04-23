{{--lecture Create model start--}}
<div class="col-xs-6 col-sm-3 m-t-30">
    <div id="createLectureModal-{{$chapter->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" action="{{route('instructor.lectures.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Lecture Form</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Lecture name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Chapter name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

<!--                        <div class="form-group">
                            <label for="audio">Audio File</label>
                            <input type="file" name="audio" value="{{ old('audio') }}" class="form-control @error('audio') is-invalid @enderror">
                        </div>
                        @error('audio')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="video">Video File</label>
                            <input type="file" name="video" value="{{ old('video') }}" class="form-control @error('video') is-invalid @enderror">
                        </div>
                        @error('video')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="pdf">PDF File</label>
                            <input type="file" name="pdf" value="{{ old('pdf') }}" class="form-control @error('pdf') is-invalid @enderror">
                        </div>
                        @error('pdf')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="ppt">PPT File</label>
                            <input type="file" name="ppt" value="{{ old('ppt') }}" class="form-control @error('ppt') is-invalid @enderror">
                        </div>
                        @error('ppt')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="resource">Extra Resource</label>
                            <input type="file" name="resource" value="{{ old('resource') }}" class="form-control @error('resource') is-invalid @enderror">
                        </div>
                        @error('resource')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror-->


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
