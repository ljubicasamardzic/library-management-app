@extends('layouts.main')

@section('page_title') Edit a book @endsection
@section('content_header') Edit a book @endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-book mr-2"></i>
                        Edit book details
                    </h3>
                </div>
                <div class="card-body p-0  mt-4">
                    <form action="/books/{{ $book->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center mb-3">
                            <div class="col-4">
                                <input 
                                    type="text" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title" 
                                    placeholder="Title"
                                    value="{{ $book->title }}"
                                >
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}   
                                </div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <input 
                                    type="text" 
                                    class="form-control @error('isbn') is-invalid @enderror" 
                                    name="isbn" 
                                    placeholder="ISBN"
                                    value="{{ $book->isbn }}"
                                >
                                @error('isbn')
                                <div class="invalid-feedback">
                                    {{ $message }}   
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-4">
                            <div class="col-3">
                                <select name="author_id" class="form-control @error('author_id') is-invalid @enderror">
                                    <option value="">-- author --</option>
                                    @foreach ($authors as $a)
                                        <option value="{{ $a->id }}" {{ $a->id == $book->author_id ? 'selected' : '' }}>{{ $a->name }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                <div class="invalid-feedback">
                                    {{ $message }}   
                                </div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <select name="publisher_id" class="form-control @error('publisher_id') is-invalid @enderror">
                                    <option value="">-- publisher --</option>
                                    @foreach ($publishers as $p)
                                        <option value="{{ $p->id }}" {{ $p->id == $book->publisher_id ? 'selected' : '' }}>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @error('publisher_id')
                                <div class="invalid-feedback">
                                    {{ $message }}   
                                </div>
                                @enderror
                            </div>
                            <div class="col-2">
                                <input 
                                    type="text" 
                                    class="form-control @error('available_quantity') is-invalid @enderror" 
                                    name="available_quantity" 
                                    placeholder="Quantity"
                                    value="{{ $book->available_quantity }}"
                                >
                                @error('available_quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}   
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="offset-2 col-8">
                                <button class="btn btn-primary float-right mb-2">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection