@extends('./../template')

@section('content')
    <h1 class="text-center">Documentos</h1>
    <div class="d-flex flex-row-reverse m-2">
        <a href=" {{ route('create.document') }} " class="btn btn-action-create btn-sm"><i
                class="fas fa-plus"></i>&nbsp;CREAR</a>
    </div>
    <div class="card rounded-0 mt-4">
        <div class="card-body">
            <div class="scrolllable">
                <table class="table table-bordered m-1" style="white-space: nowrap; overflow-x: auto;">
                    <thead>
                        <th>Nombre</th>
                        <th>Fecha creación</th>
                        <th>Fecha modificación</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($documents as $row)
                            <tr>
                                <td> {{ $row->name }} </td>
                                <td> {{ $row->create }} </td>
                                <td> {{ $row->update }} </td>
                                <td class="text-rigth">
                                    <a href=" {{ route('preview.document', $row->id) }} "
                                        class="btn btn-action-preview btn-sm"><i class="fas fa-eye"></i>&nbsp;Visualizar
                                    </a>&nbsp;

                                    <a href=" {{ route('edit.document', $row->id) }} " class="btn btn-action-edit btn-sm"><i
                                            class="fas fa-pen"></i>&nbsp;Editar
                                    </a>&nbsp;

                                    <div class="modal fade" id="modal-{{ $row->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ol class="list-group">
                                                        <li class="list-group-item fw-normal">
                                                            <b>Nombre: </b>{{ $row->name }}
                                                        </li>
                                                        <li class="list-group-item fw-normal">
                                                            <b>Descripción:</b>
                                                            <div class="scrollable">{{ $row->description }}</div>
                                                        </li>
                                                    </ol>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-create"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn-action-detail btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $row->id }}"><i
                                            class="fas fa-bars"></i>&nbsp;Detalles
                                    </a>&nbsp;

                                    <form action="{{ route('delete.document', $row->id) }}" method="POST"
                                        style="display: inline-block;" id="form-delete" class="form-delete btn-form-delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-action-delete btn-sm"><i
                                                class="fa fa-trash"></i>&nbsp;Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Guardado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error') == 'no')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'No se guardo correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('actualizar') == 'ok')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Actualizado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'Eliminado correctamente',
                'success'
            )
        </script>
    @endif

    <script type="text/javascript">
        $('#form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "¡No podrá revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#21211d',
                cancelButtonColor: '#9b9b9b',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        })
    </script>
@endsection
