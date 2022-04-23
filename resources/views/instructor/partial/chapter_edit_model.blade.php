{{--Chapter edit model start--}}
@foreach($chapters as $key => $chapter)
    <div class="col-xs-6 col-sm-3 m-t-30">
        <div id="editChapterModal{{$key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form role="form" action="{{route('instructor.chapters.update', $chapter->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="form-group">
                            <label for="title">Chapter name</label>
                            <input type="text" name="name" value="{{$chapter->name ? $chapter->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Chapter name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endforeach
{{--Chapter edit model end--}}
