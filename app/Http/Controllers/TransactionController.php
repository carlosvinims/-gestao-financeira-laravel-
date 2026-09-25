<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $type = $request->get('type');

        $transactions = Transaction::with('category')
        ->when($month, function ($query) use ($month) {
            $query->whereMonth('date', $month);
        })
        ->when($year, function ($query) use ($year) {
            $query->whereYear('date', $year);
        })
        ->when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        $categories = Category::all();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        Transaction::create($request->validated());

        return redirect()
        ->route('transactions.index')
        ->with('success', 'Transação cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $categories = Category::all();

        return view('transactions.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return redirect()
        ->route('transacrions.index')
        ->with('success', 'Transação atualizad com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
        ->route('transactions.index')
        ->with('success', 'Transação deleta com sucesso!');
    }
}
