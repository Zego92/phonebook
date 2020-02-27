<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Numbers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $numbers = Numbers::with('contact')->paginate(5);
//        foreach ($numbers as $number){
//            dd($number->contact->name);
//        }
        $contacts = Contact::paginate(25);
//
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.add');
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'surname' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'phone' => ['required', 'string', 'min:10', 'max:20', 'unique:numbers'],
        ]);
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->email = $request->email;
        $contact->save();
        $numbers = new Numbers();
        $numbers->phone = $request->phone;
        $numbers->contact_id = $contact->id;
        $numbers->save();
        Toastr::success('Контакт Успешно Создан :)', 'Успех');
        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $numbers = Numbers::where('contact_id', $id)->get();
        $count = Numbers::where('contact_id', $id)->count();

        $contact = Contact::find($id);
//        dd($count);
        return view('contact.show', compact('contact', 'numbers', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        $numbers = Numbers::where('contact_id', $id)->get();
//        dd($numbers);
        return view('contact.edit', compact('contact', 'numbers'));
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'surname' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->email = $request->email;
        $contact->update();
        Toastr::success('Контакт Успешно Обновлен :)', 'Успех');
        return redirect()->route('contact.index');

    }


    public function add(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => ['required', 'string', 'min:10', 'max:20']
        ]);
        $contact = Contact::find($id);
        $numbers = new Numbers();
        $numbers->contact_id = $contact;
        $numbers->phone = $request->phone;
        if ($numbers->save())
        {
            Toastr::success('Телефон Успешно Добавлен :)', 'Успех');
            return redirect()->route('contact.show');
        }
        else
        {
            Toastr::error('Произошла ошибка :)', 'Ошибка');
            return redirect()->route('contact.show');
        }


    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        Toastr::success('Контакт Успешно Удален :)', 'Успех');
        return redirect()->route('contact.index');
    }
}
