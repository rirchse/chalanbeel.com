@extends('admin')
@section('title', 'Edit Career')
@section('stylesheets')
<link rel="stylesheet" href="/assets/summernote/summernote.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <form action="{{route('career.update', $career->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header card-header-icon" data-background-color="orange">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit Career</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title: <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ $career->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description: <span class="text-danger">*</span></label>
                            <textarea rows="10" name="description" class="form-control editor" required>{{ $career->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="requirements">Requirements:</label>
                            <textarea rows="8" name="requirements" class="form-control editor">{{ $career->requirements }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <input type="text" name="department" class="form-control" value="{{ $career->department }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" name="location" class="form-control" value="{{ $career->location }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Job Type:</label>
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Full-time" {{ $career->type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ $career->type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ $career->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ $career->type == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deadline">Application Deadline:</label>
                            <input type="date" name="deadline" class="form-control" value="{{ $career->deadline ? date('Y-m-d', strtotime($career->deadline)) : '' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_min">Salary Min:</label>
                            <input type="number" name="salary_min" class="form-control" value="{{ $career->salary_min }}" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_max">Salary Max:</label>
                            <input type="number" name="salary_max" class="form-control" value="{{ $career->salary_max }}" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status: <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $career->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $career->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-primary btn-fill pull-right">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
@section('scripts')

<script src="/assets/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.editor').summernote({
            height: 150
        });
    });
</script>
@endsection

