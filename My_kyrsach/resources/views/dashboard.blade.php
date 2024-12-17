
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Главная') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h1>Каталог туров</h1>
                        <div class="row">
                            @foreach ($tours as $tour)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ asset($tour->tour_photo) }}" alt="{{ $tour->tour_name }}" class="img-fluid">

                                        
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $tour->tour_name }}</h5>
                                            <p class="card-text">Цена: {{ $tour->price }} руб.</p>
                                            <p class="card-text">Описание: {{ $tour->description }}</p>
                                            <a href="#" class="btn btn-primary">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

