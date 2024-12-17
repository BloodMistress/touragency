<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Детали тура') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Блок с фото -->
                    <div class="p-6">
                        <img src="{{ asset($tour->tour_photo) }}" 
                             alt="{{ $tour->tour_name }}" 
                             class="w-full h-72 object-cover rounded-md shadow-lg hover:shadow-xl transition-shadow duration-300">
                    </div>

                    <!-- Блок с информацией -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                                {{ $tour->tour_name }}
                            </h1>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                {{ $tour->description }}
                            </p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                Цена: {{ $tour->price }} руб.
                            </p>
                            <p class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">
                                Дата проведения: {{ \Carbon\Carbon::parse($tour->date)->format('d.m.Y') }}
                            </p>
                            <p class="text-md text-gray-700 dark:text-gray-300 mb-4">
                                Свободных мест: {{ $tour->num_of_people }}
                            </p>
                        </div>

                        <!-- Форма покупки -->
                        <div class="mt-4">
                            <form action="{{ route('cart.add', $tour->tourID) }}" method="POST">
                                @csrf
                                <div class="flex items-center mb-4">
                                    <label for="quantity" class="text-gray-700 dark:text-gray-300 mr-2">
                                        Количество билетов:
                                    </label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $tour->num_of_people }}" 
                                           class="form-input w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </div>
                                <button type="submit" 
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md shadow-lg transition duration-300">
                                    Добавить в корзину
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
