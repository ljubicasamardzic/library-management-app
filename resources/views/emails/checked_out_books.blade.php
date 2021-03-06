<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ui-sortable-handle">
                    <h1 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Book Lending Details
                    </h1>
                </div>
                <div class="card-body py-2">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr><td colspan="2"><h3>Dear {{ $lendings[0]['user']['name'] }}, you have taken out the following:</h3></td></tr>
                            @include('emails/partials.body', ['lendings' => $lendings])
                        </table>
                    </div>
                </div>
                @include('emails/partials.footer')
            </div>
        </div>
    </div>
<body>