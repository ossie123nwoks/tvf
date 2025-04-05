<x-app-layout>

@section('content')
<div class="container">
    <h1>Gallery</h1>
    <div class="row">
        @foreach ($galleries as $gallery)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $gallery->image_url }}" class="card-img-top" alt="{{ $gallery->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->title }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
</x-app-layout>