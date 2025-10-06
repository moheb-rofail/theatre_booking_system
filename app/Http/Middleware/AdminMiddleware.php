<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // إضافة هذه المكتبة

class AdminMiddleware
{
    /**
     * معالجة طلب وارد.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. التحقق أن المستخدم مسجل دخول
        // 'auth' middleware يقوم بالتحقق من هذا، لكن هذه خطوة إضافية للوضوح
        if (!Auth::check()) {
            // إذا لم يكن مسجلاً، وجهه لصفحة تسجيل الدخول
            return redirect('/login'); 
        }

        // 2. التحقق أن المستخدم أدمن (is_admin = true)
        // نفترض أن الـ Model الخاص بك هو App\Models\User إذا كنت تستخدم Laravel 8 أو أحدث.
        if (Auth::user()->is_admin) {
            // إذا كان أدمن، اسمح بالمرور
            return $next($request);
        }

        // 3. إذا كان مسجلاً دخول لكن ليس أدمن، وجهه لصفحة ما
        // يمكنك توجيهه لصفحة 403 (ممنوع) أو الصفحة الرئيسية.
        return redirect('/')->with('error', 'ليس لديك صلاحية الوصول لهذه الصفحة.');
        // أو يمكنك استخدام abort(403);
    }
}