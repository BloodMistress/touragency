<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index(Request $request)
    {
        // Создаем запрос к базе
        $query = Tour::query();

        // Поиск по ключевым словам
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('tour_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Фильтр по цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Фильтр по возрастной категории
        if ($request->filled('age_orientation')) {
            $query->where('age_orientation', '>=', $request->age_orientation);
        }

        // Получаем результаты
        $tours = $query->get();

        return view('tours', compact('tours'));
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('show', compact('tour'));
    }

    public function buy($id)
    {
        $tour = Tour::findOrFail($id);

        // Логика обработки покупки (например, добавление в таблицу заказов)
        return redirect()->route('tours')->with('success', 'Вы успешно купили тур!');
    }
}
