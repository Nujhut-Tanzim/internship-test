@extends('layouts.admin', ['title' => 'Products'])

@section('mainContent')
    <div class="container">
        <div class="products mb-3">
        @foreach($products as $product)
                <div class="__single">
                    <div class="image">
                    <img class="w-100" src="{{ asset($product->image) }}" alt="product image">
                    </div>
                    <div>
                    <h2>{{ $product->name }}</h2>

                        <div>
                            <p class="fw-bold m-0">Categories:</p>
                            <div>
                                @for($i=0; $i < 4 ; $i++)
                                    <span class="badge bg-info text-capitalize">category 1</span>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <p class="fw-bold m-0">Features:</p>
                            <ul>
                            @foreach($product->features as $feature)
                                    <li class="text-capitalize">{{ $feature->feature_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>

        <nav aria-label="Page navigation example mt-2">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <script>
        $("#imgSrc").attr('src', "https://ui-avatars.com/api/?background=random&color=fff&name={{ auth()->user()->name }}")
    </script>
@endsection
