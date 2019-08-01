@extends('layouts.backend') 
@section('content')

<div class="content">
    <div class="col-md-8">
        <div class="block">
             <div class="block-content">
                <div class="block-header">
                    <h3 class="block-title">
                        Add New Role
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.role.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="role">Role Name</label>
                                    <input type="text" placeholder="Give an awesome name for role" name="name" class="form-control" id="role" required>
                                </div>
                                <h2 class="content-heading">
                                    <button type="submit" class="btn btn-info btn-md">
                                        Submit
                                    </button>
                                </h2>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection