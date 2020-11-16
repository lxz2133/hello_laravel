<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

/**
 * Class SessionsController
 * @package App\Http\Controllers
 */
class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            session()->flash('success', '欢迎回来！');

            return redirect()->intended(route('users.show', compact('user')));
        } else {
            // 登录失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');

            return redirect()->back()->withInput();
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');

        return redirect('login');
    }
}
