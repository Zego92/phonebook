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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Телефон</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $k => $contact)
                                <tr>
                                    <td>{{ $k +1 }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->surname }}</td>
                                    <td>{{ $numbers->phone }}</td>
                                    <td>
                                        <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-sm btn-outline-info rounded-circle"><i class="fas fa-question"></i></a>
                                        <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-outline-success rounded-circle"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle" onclick="deleteContact({{ $contact->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <form id="delete-form-{{$contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" method="post" style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Телефон</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
{{--                        {{ $contacts->links() }}--}}
                    </div>
                    <div class="card-footer bg-primary">
                        <span class="text-white">Контактов всего: {{ $contacts->count() }}</span>
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
