@extends('./../template')

@section('back')
    <div class="m-5">
        <a role="button" href="{{ route('index.document') }}" class="btn-back"><img src="{{ asset('images/back.png') }}"
                class="btn-back" alt="Atrás"></a>
    </div>
@endsection

@section('content')
    <h1 class="text-center">Previsualización del documento</h1>
    <div class="container mb-5">
        <div class="card rounded-0 mt-4">
            <div class="card-body">
                <iframe id="pdf-preview" src="{{ asset('documents/' . $data->document) }}" width="100%"
                    height="600"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/pdf.js') }}"></script>
    <script>
        var url = document.getElementById('pdf-preview').src;

        pdfjsLib.getDocument(url).then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                var viewport = page.getViewport({
                    scale: 1
                });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise.then(function() {
                    document.getElementById('pdf-preview').src = canvas.toDataURL();
                });
            });
        });
    </script>
@endsection
