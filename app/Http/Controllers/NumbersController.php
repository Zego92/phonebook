<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Numbers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'min:10', 'max:20', 'unique:numbers']
        ]);
        $numbers = new Numbers();
        $numbers->contact_id = $request->contact_id;
        $numbers->phone = $request->phone;
        if ($numbers->save())
        {
            Toastr::success('Номер Телефона Успешно Добавлен :)', 'Успех');
            return redirect()->back();
        }
        else
        {
            Toastr::error('Произошла ошибка :)', 'Ошибка');
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $number = Numbers::find($id);
        return view('numbers.show', compact('number'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => ['required', 'min:10', 'max:20', 'unique:numbers']
        ]);
        $number = Numbers::find($id);
        $number->phone = $request->phone;
        if ($number->update())
        {
            Toastr::success('Номер Телефона Успешно Обновлен :)', 'Успех');
            return redirect()->route('contact.index');
        }
        else
        {
            Toastr::error('Произошла ошибка :)', 'Ошибка');
            return redirect()->route('contact.index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $number = Numbers::find($id);
        $number->delete();
        Toastr::success('Номер Телефона Успешно Удален :)', 'Успех');
        return redirect()->back();
    }
}
