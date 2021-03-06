@extends('layouts.main')

@section('page_title') Books @endsection
@section('content_header') Books @endsection

@section('additional_styles')
<link rel="stylesheet" href="{{ asset('css/general.css') }}">

<style>
    .clickable-row { cursor: pointer; }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a class="ml-1 btn btn-primary" href={{ route('books.create') }}>
                            Add a book
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>ISBN</th>
                                <th>Quantity</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $key => $book)
                               @include('books.book')
                            @empty
                                @include('books.no-book')
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $books->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('/js/books/index.js') }}"></script>
    <script src="{{ asset('/js/delete.js') }}"></script>
@endsection
