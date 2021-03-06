@extends('layouts.main')

@section('page_title') Lend Books @endsection
@section('content_header') Step 2: Scan book QR @endsection
@section('additional_styles')
<style>
    #preview {
        width: 250px;
        height: 250px;
        outline: 1px solid red;
    }

    @media(min-width: 600px) {
        #preview {
            width: 300px;
            height: 300px;
        }
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-12 offset-md-3 col-md-9 alert mb-1" id="errors_div"></div>
</div>
<div class="row">
    <div class="col-12 col-md-4 d-flex flex-row justify-content-center justify-content-md-start mb-2 mb-md-0">
        <video id="preview"></video>
    </div>
    <div class="col-12 col-md-7 px-0">
        @include('book-loans.card')

        @include('book-loans.buttons')
    </div>
</div>

@section('additional_scripts')

<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", event => {

            let token =  $('meta[name="csrf-token"]').attr('content');
            const submit_btn = $('#custom_btn');
            const cancel_btn = $('#back_btn');
            let err_div = $('#errors_div');
            let table_body = $('#table_body_id');
            let buttons_div = $('#buttons_div');

            let pattern = /^https:\/\/unilib-app.herokuapp.com\/books\/qrcode\/read\/\d*$/;

            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            Instascan.Camera.getCameras().then(cameras => {
                scanner.camera = cameras[cameras.length - 1];
                scanner.start();
            }).catch(e => console.error(e));

            scanner.addListener('scan', content => {
                // scanner.stop();

                err_div.removeClass('alert-danger');
                err_div.children().remove();

                if (!pattern.test(content)) {
                    err_div.addClass('alert-danger');
                    err_div.append(`<li>Please scan a valid book QR code.</li>`);
                } else {
                    $.ajax({
                        'url' : content,
                        'type' : 'POST',
                        'data' : {_token:token, flag:true},
                        'success' : (res) => {
                            let id = res['id'];
                            let title = res['book']['title'];
                            let author = res['book']['author']['name'];
                            let publisher = res['book']['publisher']['name'];
                            let edition = res['edition'];
                            let condition = res['condition']['name'];

                            table_body.append(
                                `
                                <tr class="book-${id}">
                                    <input type="hidden" name="book_copy_id[]" value="${id}">
                                    <td>
                                        <input type="text" disabled class="form-control" value="${title}">
                                    </td>
                                    <td>
                                        <input type="text" disabled class="form-control" value="${author}">
                                    </td>
                                    <td>
                                        <input type="text" disabled class="form-control" value="${publisher}">
                                    </td>
                                    <td>
                                        <input type="text" disabled class="form-control" value="${edition}">
                                    </td>
                                    <td>
                                        <input type="text" disabled class="form-control" value="${condition}">
                                    </td>
                                    <td>
                                        <form action="/book-copies/remove/${id}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-tool remove-btn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                `
                            );

                            // add a success message
                            err_div.addClass('alert-success');
                            err_div.append(`<li>Book added successfully!</li>`);

                            // display buttons if they are not already visible
                            if ((buttons_div).hasClass('d-none')) {
                                (buttons_div).removeClass('d-none');
                            }
                        },
                        'error' : (res) => {
                            err_div.empty();
                            let err = res['responseJSON']['message'];
                            err_div.addClass('alert-danger');
                            err_div.append(`<li>${err}</li>`);
                        }
                    });
                }
            });

            $('#custom_btn').on('click', function(e)  {
                e.preventDefault();

                $.ajax({
                    'url' : '/book-loans/post-two',
                    'type' : 'POST',
                    'data' : {_token:token},
                    'success' : (res) => {
                        window.location.href = '/';
                    },
                    'error' : (res) => {
                        let err = res['responseJSON']['message'];

                        if (res['status'] == 418) {
                            let splitMsg = err.split('.');
                            let index = splitMsg[1];
                            err = splitMsg[0] + '.';

                            // add border around the book in question
                            $('.book-' + index).addClass('border border-danger');
                        }

                        err_div.addClass('alert-danger');
                        err_div.append(`<li>${err}</li>`);
                    }
                });
            });
        });

    </script>
@endsection

@endsection
