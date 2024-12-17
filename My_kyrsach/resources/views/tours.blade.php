<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Каталог туров') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Поисковая строка -->
                <form method="GET" action="{{ route('tours') }}" class="mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Поле для поиска -->
                        <div class="flex items-center">
                            <input type="text" name="search" 
                                   class="form-input w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:outline-none" 
                                   placeholder="Поиск туров..." 
                                   value="{{ request('search') }}">
                        </div>

                        <!-- Фильтр по цене -->
                        <div class="flex items-center">
                            <input type="number" name="min_price" 
                                   class="form-input w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2  focus:outline-none" 
                                   placeholder="Мин. цена" 
                                   value="{{ request('min_price') }}">
                            <input type="number" name="max_price" 
                                   class="form-input w-full rounded-md ml-2 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2  focus:outline-none" 
                                   placeholder="Макс. цена" 
                                   value="{{ request('max_price') }}">
                        </div>

                        <!-- Фильтр по возрасту -->
                        <div class="flex items-center">
                            <select name="age_orientation" 
                                    class="form-select w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:ring-2  focus:outline-none">
                                <option value="">Выберите возраст</option>
                                <option value="20" {{ request('age_orientation') == 20 ? 'selected' : '' }}>20+</option>
                                <option value="30" {{ request('age_orientation') == 30 ? 'selected' : '' }}>30+</option>
                                <option value="50" {{ request('age_orientation') == 50 ? 'selected' : '' }}>50+</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                            Искать
                        </button>
                    </div>
                </form>

                <!-- Каталог туров -->
                @if(isset($tours))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse ($tours as $tour)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                                <!-- Ссылка на страницу тура -->
                                <a href="{{ route('tours.show', $tour->tourID) }}">
                                    <img src="{{ asset($tour->tour_photo) }}" 
                                         alt="{{ $tour->tour_name }}" 
                                         class="w-full h-48 object-cover rounded-md mb-4 hover:opacity-90 transition-opacity duration-300">
                                </a>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 hover:text-purple-600 transition duration-300">
                                    {{ $tour->tour_name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    {{ $tour->description }}
                                </p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-2">
                                    Цена: {{ $tour->price }} руб.
                                </p>

                                <!-- Кнопка "Купить" -->
                                <form action="{{ route('cart.add', $tour->tourID) }}" method="POST">
                                    @csrf
                                    <div class="flex items-center mt-2">
                                        <input type="number" name="quantity" value="1" min="1" max="{{ $tour->num_of_people }}" 
                                               class="form-input w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                                        <button type="submit" class="ml-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                                            Купить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">
                                Туров не найдено.
                            </p>
                        @endforelse
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-400">
                        Данные о турах недоступны. Пожалуйста, войдите в систему.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
