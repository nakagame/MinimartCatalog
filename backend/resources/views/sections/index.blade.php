@extends('layouts.app')

@section('title', 'Section')
    
@section('content')
    <h1 class="w-50 mx-auto mb-3">Section</h1>

    <form action="{{ route('section.store') }}" method="post">
        @csrf

        <div class="input-group w-50 mx-auto">
            <input type="text" name="name" class="form-control bg-white" value="{{ old('name') }}" placeholder="Input a section..." autofocus> 
            <button type="submit" class="btn btn-info">
                <i class="fa-solid fa-plus"></i> Add
            </button>
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>

    <table class="table table-hover mt-4 w-50 mx-auto">
        <thead class="table-info">
            <tr>
                <th class="border border-0">ID</th>
                <th class="border border-0">NAME</th>
                <th class="border border-0"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_sections as $section)
                <tr>
                    <th>{{ $section->id }}</th>
                    <th>{{ $section->name }}</th>
                    <th>
                        <form action="{{ route('section.destroy', $section->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </th>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="3" class="border border-start-0 border-end-0 bg-white">No Item to display.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection