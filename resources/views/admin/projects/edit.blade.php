@extends('layouts.admin')

{{-- @section('page_title', 'Create') --}}

@section('content')
    <div class="container-fluid">

        @include('partials.validation_errors')

        <h5 class="text-uppercase text-muted my-3">Edit Project</h5>
        <form action="{{ route('admin.projects.update', $project->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" required
                    value="{{ old('title', $project->title) }}" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="project title here"
                    aria-describedby="titleHelper">
                <small id="titleHelper" class="text-secondary @error('title') text-danger @enderror">
                    Type the title of the project max 50 characters
                </small>
            </div>
            {{-- /.title --}}
            <div class="mb-3">
                <label for="image" class="form-label">Cover</label>
                <div class="d-flex gap-1 align-items-center">
                    <img height="40" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                    <input type="file"
                        value="{{ old('image', $project->image) }}" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        placeholder="project image here"
                        aria-describedby="imageHelper">
                </div>
                <small id="imageHelper"
                    class="text-secondary @error('image') text-danger @enderror">
                    Select the image of the project max 1MB
                </small>
            </div>
            {{-- /.image --}}
            <div class="mb-3">
                <div for="image" class="form-label">Technologies</div>
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
                        <label class="form-check-label">
                            @if ($errors->any())
                                {{-- se ci sono degli errori di validazione signifca che bisogna recuperare le technologies selezionate tramite la funzione old(), la quale restituisce un array plain contenente solo gli id --}}
                                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                            @else
                                {{-- se non sono presenti errori di validazione significa che la pagina è appena stata aperta per la prima volta, perciò bisogna recuperare i technology dalla relazione con il post,                        che è una collection di oggetti di tipo technology	--}}
                                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                            @endif
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- /.technologies --}}
            <div class="mb-3">
                <label for="type_id" class="form-label">Types</label>
                <select class="form-select @error('type_id') is-invalid @enderror" name=" type_id" id="type_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id', $project->type?->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                <small id="type_idHelper"
                    class="text-secondary @error('type_id') text-danger @enderror">
                    Select one of the following project type
                </small>
            </div>
            {{-- /.type_id --}}
            <div class="mb-3">
                <label for="link" class="form-label">Site code</label>
                <input type="text" required
                    value="{{ old('link', $project->link) }}" name="link" id="link"
                    class="form-control @error('link') is-invalid @enderror"
                    placeholder="project link here"
                    aria-describedby="linkHelper">
                <small id="linkHelper"
                    class="text-secondary @error('link') text-danger @enderror">
                    Type the source image of the project max 200 characters
                </small>
            </div>
            {{-- /.link --}}
            <div class="mb-3">
                <label for="init" class="form-label">Start date</label>
                <input type="date" required
                    value="{{ old('init', $project->init) }}" name="init" id="init"
                    class="form-control @error('init') is-invalid @enderror"
                    placeholder="project init here"
                    aria-describedby="initHelper">
                <small id="initHelper" class="text-secondary @error('init') text-danger @enderror">
                    Type the sale date of the project
                </small>
            </div>
            {{-- /.init --}}
            <div class="mb-3">
                <label for="info" class="form-label">info</label>
                <input type="textarea" row="4"
                    value="{{ old('info', $project->info) }}" name="info" id="info"
                    class="form-control @error('info') is-invalid @enderror"
                    placeholder="project info here"
                    aria-describedby="infoHelper">
                <small id="infoHelper" class="text-secondary @error('info') text-danger @enderror">
                    Type the info of the project
                </small>
            </div>
            {{-- /.info --}}
            <button type="submit" class="btn btn-dark w-100 my-4">Save</button>
        </form>
    </div>
@endsection
