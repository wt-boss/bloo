<?php

namespace App\Http\Controllers;

use App\Form;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SondageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $forms = $current_user->forms()->orWhereHas('collaborationUsers', function ($query) use ($current_user) {
            $query->where('form_collaborators.user_id', $current_user->id);
        })->latest()->get();
        return view('admin.sondages.index', compact('forms', 'current_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = Auth::user();

        $max_no_user_unclosed_forms = config('custom.forms.max_no_user_unclosed_forms');
        $unclosed_forms_count = $current_user->forms()
            ->whereIn('status', [Form::STATUS_DRAFT, Form::STATUS_PENDING, Form::STATUS_OPEN])
            ->count();

        if ($unclosed_forms_count == $max_no_user_unclosed_forms) {
            session()->flash('index', [
                'status' => 'warning', 'message' => "You have {$max_no_user_unclosed_forms} unclosed forms. Please resolve them before you can create more forms",
            ]);

            return redirect()->route('forms.index');
        }

        return view('admin.sondages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
