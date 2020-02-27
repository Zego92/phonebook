@extends('layouts.contact.app')

@section('title', 'Редактор контакта')

@push('css')

@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary">
                    <span class="text-white">Изменение информации о {{ $contact->name }} {{ $contact->surname }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('contact.update', $contact->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="font-weight-bold" for="name">Имя</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $contact->name }}" minlength="3" maxlength="20" aria-describedby="nameHelp" required autofocus>
                            <small id="nameHelp" class="form-text text-muted">Например Иван....</small>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="surname">Фамилия</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $contact->surname }}" id="surname" minlength="3" maxlength="20" aria-describedby="surnameHelp" required>
                            <small id="surnameHelp" class="form-text text-muted">Например Иванов....</small>
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $contact->email }}" aria-describedby="emailHelp" required>
                            <small id="emailHelp" class="form-text text-muted">Например test@test.com</small>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-outline-success font-weight-bold">Обновить</button>
                            <a href="{{ route('contact.index') }}" class="btn btn-block btn-outline-danger font-weight-bold">Назад</a>
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
