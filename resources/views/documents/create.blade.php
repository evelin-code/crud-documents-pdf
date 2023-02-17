@extends('./../template')

@section('back')
    <div class="m-5">
        <a role="button" href="{{ route('index.document') }}" class="btn-back"><img src="{{ asset('images/back.png') }}"
                class="btn-back" alt="Atrás"></a>
    </div>
@endsection

@section('content')
    <h1 class="text-center">Crear Documento</h1>
    <div class="container mb-5">
        <div class="card rounded-0 mt-4">
            <div class="card-body">
                <h6 class="required-text">Los campos marcados con asteriscos (*) son obligatorios</h6>
                <form method="POST" class="row g-3 mt-1" action="{{ route('save.document') }}" enctype="multipart/form-data">
                    @csrf()

                    <div class="col-md-12 mt-3">
                        <label for="name">Nombre del documento *</label>
                        <input type="text" class="form-control input-form" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="" for="description">Descripción del documento</label>
                        <textarea class="form-control" id="description" name="description" rows="7">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="file">Cargar documento PDF *</label>
                        <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                        @error('file')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn-create">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
