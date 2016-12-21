<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use \App\Account;

class AccountController extends Controller {

    /**
     *
     * @var type List of visible attr.
     */
    protected $visible_attr = ['id', 'name', 'iban'];

    public function all(Request $request) {
        $builder = Account::select($this->visible_attr);

        if ($request->has('enabled')) {
            $builder->enabled($request->input('enabled'));
        }

        $accounts = $builder->paginate();
        return response()->json($accounts);
    }

    public function one(Request $request, $modelId) {
        $account = Account::find($modelId);
        if (!$account) {
            abort(500, 'better use find or fail next time');
        }

        return response()->json($account);
    }

    public function update(Request $request, $modelId) {
        $account = Account::findOrFail($modelId);

        $attr = $request->only('name', 'iban');
        $account->fill($attr);
        $account->save();

        return response()->json(['data' => $account->fresh()]);
    }

    public function pdf(Request $request, $modelId) {
       
        $pdf = PDF::loadView('pdf.invoice', $data);
return $pdf->download('invoice.pdf');

          $pdf = \Barryvdh\Snappy\Facades\SnappyPdf::loadView('account.overview', ['name' => 'James']);
          $pdf->setBinary('D:\bin\wkhtmltopdf\bin\wkhtmltopdf.exe');

          $pdf->inline('file.pdf');
         
    }

}
