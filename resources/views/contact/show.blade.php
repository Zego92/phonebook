@extends('layouts.contact.app')

@section('title', 'Информация о контакте')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary mb-4">
                    <span class="text-white">Информация о контакте {{ $contact->name }} {{ $contact->surname }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="2">Имя</th>
                                <th colspan="2" class="text-center">{{ $contact->name }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Фамилия</th>
                                <th colspan="2" class="text-center">{{ $contact->surname }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Email</th>
                                <th colspan="2" class="text-center">{{ $contact->email }}</th>
                            </tr>
                            @foreach($numbers as $k => $number)
                            <tr>
                                <th colspan="2">Телефон {{ $k +1 }}</th>
                                <th colspan="2" class="text-center">
                                    {{ $number->phone }}
                                    <div class="btn-group" role="group" aria-label="Basic example" >
                                        @if($numbers->count() < 1)
                                        <button type="button" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#addNumber"><i class="fas fa-plus"></i></button>
                                            <a href="{{ route('numbers.show', $number->id) }}" class="btn btn-sm btn-warning ml-3"><i class="fas fa-edit"></i></a>
                                        @elseif($numbers->count() === 20)
                                            <a href="{{ route('numbers.show', $number->id) }}" class="btn btn-sm btn-warning ml-3"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger ml-3" onclick="deleteNumber({{ $number->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $number->id }}" action="{{ route('numbers.destroy', $number->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success ml-3" data-toggle="modal" data-target="#addNumber"><i class="fas fa-plus"></i></button>
                                            <a href="{{ route('numbers.show', $number->id) }}" class="btn btn-sm btn-warning ml-3"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger ml-3" onclick="deleteNumber({{ $number->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $number->id }}" action="{{ route('numbers.destroy', $number->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endif
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">Создан</th>
                                <th colspan="2" class="text-center">{{ $contact->created_at }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Обновлен</th>
                                <th colspan="2" class="text-center">{{ $contact->updated_at }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('contact.index') }}" class="btn btn-danger">Назад</a>
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-success">Редактировать</a>
                    <button type="button" class="btn btn-danger" onclick="deleteContact({{ $contact->id }})">
                        Удалить
                    </button>
                    <form id="delete-form-{{ $contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editNumber" tabindex="-1" role="dialog" aria-labelledby="editNumber" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNumber">Редактирование номера</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('numbers.update', $number->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold" for="phone">Телефон</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $number->phone }}"  minlength="10" maxlength="20" aria-describedby="nameHelp" required>
                                <small id="nameHelp" class="form-text text-muted">Например +380999999999</small>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-success">Обновить</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="addNumber" tabindex="-1" role="dialog" aria-labelledby="addNumber" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNumber">Редактирование номера</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('numbers.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold" for="phone">Телефон</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}"  minlength="10" maxlength="20" aria-describedby="nameHelp" required>
                                <small id="nameHelp" class="form-text text-muted">Например +380999999999</small>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="contact_id" value="{{ $number->contact_id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        function deleteContact(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Вы Уверены?',
                text: "Данные Восстановлению не Подлежат",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Да, Удалить',
                cancelButtonText: 'Отмена',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Отменено',
                        'Действие Успшно Отменено',
                        'error'
                    )
                }
            })
        }
        function deleteNumber(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Вы Уверены?',
                text: "Данные Восстановлению не Подлежат",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Да, Удалить',
                cancelButtonText: 'Отмена',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Отменено',
                        'Действие Успшно Отменено',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush
