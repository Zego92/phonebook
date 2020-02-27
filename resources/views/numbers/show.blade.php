@extends('layouts.contact.app')

@section('title', 'Редактор номера')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary">
                    <span class="text-white">Редактор номера</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('numbers.update', $number->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="font-weight-bold" for="phone">Телефон</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $number->phone }}" minlength="10" maxlength="20" aria-describedby="nameHelp" required autofocus>
                            <small id="nameHelp" class="form-text text-muted">Например +380999999999</small>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Обновить</button>
                            <a href="{{ route('contact.index') }}" class="btn btn-block btn-danger">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
