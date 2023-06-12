@extends('layouts.admin')

{{-- @section('page_title', 'Create') --}}

@section('content')
    <div class="container-fluid">

        @include('partials.validation_errors')

        <h5 class="text-uppercase text-muted my-3">Edit Technology</h5>
        <form action="{{ route('admin.technologies.update', $technology->slug) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" required
                    value="{{ old('name', $technology->name) }}" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="type name here"
                    aria-describedby="nameHelper">
                <small id="nameHelper" class="text-secondary @error('name') text-danger @enderror">
                    Type the name of the technology max 50 characters
                </small>
            </div>
            {{-- /.name --}}
            <div class="mb-3">
                <label for="link_cover" class="form-label">Cover</label>
                <input type="text" required
                    value="{{ old('link_cover', $technology->link_cover) }}" name="link_cover" id="link_cover"
                    class="form-control @error('link_cover') is-invalid @enderror"
                    placeholder="type link_cover here"
                    aria-describedby="link_coverHelper">
                <small id="link_coverHelper"
                    class="text-secondary @error('link_cover') text-danger @enderror">
                    Type the source image of the technology max 200 characters
                </small>
            </div>
            {{-- /.link_cover --}}
            <button type="submit" class="btn btn-dark w-100 my-4">Save</button>
        </form>
    </div>
@endsection