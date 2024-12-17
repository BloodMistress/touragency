<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Корзина
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 dark:text-gray-200">Ваши билеты:</h3>
                
                @if($cartItems->isEmpty())
                    <p>Корзина пуста.</p>
                @else
                <table class="table-auto w-full text-left border-collapse border border-gray-300 dark:border-gray-600">
    <thead>
        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Название</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Количество</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Цена</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Общая стоимость</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200">
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->tour->tour_name }}</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->quantity }}</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->tour->price }} руб.</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->quantity * $item->tour->price }} руб.</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-700">
                        Удалить
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


                    
                    <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-success dark:text-gray-200">
                            Оформить покупку
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
