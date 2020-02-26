@extends('layouts.contact.app')

@section('title', 'Информация о контакте')

@push('css')

@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary">
                    <span class="text-white">Информация о контакте {{ $contact->name }} {{ $contact->surname }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="2">Имя</th>
                                <th colspan="2">{{ $contact->name }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Фамилия</th>
                                <th colspan="2">{{ $contact->surname }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Email</th>
                                <th colspan="2">{{ $contact->email }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Телефон</th>
                                <th colspan="2">{{ $contact->phone }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Создан</th>
                                <th colspan="2">{{ $contact->created_at }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Обновлен</th>
                                <th colspan="2">{{ $contact->updated_at }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Быстрый переход</th>
                                <th colspan="2">
                                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-success">Редактировать</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteContact({{ $contact->id }})">
                                        Удалить
                                    </button>
                                    <form id="delete-form-{{$contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('contact.index') }}" class="btn btn-outline-danger">Назад</a>
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
    </script>
@endpush
