@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
         <div class="col-md-4">
            <h1>Choose Profile Picture</h1><br>
            <form method="POST" action="upload" enctype="multipart/form-data">
                            <input type = "file" name="file" required><br>
                            <input type="submit" name="submit">
             </form>
         </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Dashboard') }}</h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>{{ __('Welcome! ') }} {{Auth::user()->name}}</h2>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
