@extends('layouts.contact.app')

@section('title', 'Главная')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary mb-3 text-right">
                        <span class="text-white font-weight-bold">Мои Контакты</span>
                    </div>
                    <div class="card-title mb-3 text-right mr-3">
                        <a href="{{ route('contact.create') }}" class="btn btn-success" ><i class="fas fa-plus"></i> Добавить Контакт</a>
                    </div>
                    <div class="card-body justify-content-between d-flex">
                        @foreach($contacts as $contact)
                        <div class="btn-group mr-3" role="group" aria-label="Basic example">
                            <a href="{{ route('contact.show', $contact->id) }}" target="_blank" class="btn btn-outline-primary font-weight-bold">{{ $contact->name . ' ' . $contact->surname }}</a>
                        </div>
                        @endforeach
                    </div>
                    {{ $contacts->links() }}
                    <div class="card-footer bg-primary">
                        <span class="text-white">Контактов всего: {{ $contacts->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
