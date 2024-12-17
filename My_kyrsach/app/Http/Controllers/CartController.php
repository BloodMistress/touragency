<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $quantity = (int)$request->input('quantity', 1);

        // Проверяем, достаточно ли билетов
        if ($quantity > $tour->num_of_people) {
            return redirect()->back()->withErrors(['error' => 'Недостаточно билетов в наличии.']);
        }

        // Проверяем суммарное количество в корзине
        $existingCartItem = Cart::where('user_id', Auth::id())->where('tour_id', $id)->first();
        if ($existingCartItem && $existingCartItem->quantity + $quantity > $tour->num_of_people) {
            return redirect()->back()->withErrors(['error' => 'Нельзя добавить больше билетов, чем доступно.']);
        }

        // Добавляем в корзину или обновляем количество
        $cartItem = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'tour_id' => $id],
            ['quantity' => \DB::raw("LEAST(quantity + $quantity, {$tour->num_of_people})")]
        );

        // Уменьшаем количество доступных билетов
        $tour->decrement('num_of_people', $quantity);

        return redirect()->route('cart.index')->with('success', 'Тур добавлен в корзину.');
    }

    public function index()
    {
        $cartItems = Cart::with('tour')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function checkout()
    {
        $cartItems = Cart::with('tour')->where('user_id', Auth::id())->get();

        foreach ($cartItems as $item) {
            $item->tour->decrement('num_of_people', $item->quantity);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('tours')->with('success', 'Покупка успешно совершена.');
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Тур удален из корзины.');
    }
}
