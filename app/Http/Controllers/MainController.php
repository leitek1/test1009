<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use library\Convertor\Lukmanov;

class MainController extends RealConvertorController
{


    public function home()
    {
        $convertor = new RealConvertorController();
        $data['currenciesList'] = $convertor->currenciesListArr();
        $data['from'] = 'USD';
        $data['to'] = 'RUB';
        $data['amount'] = '';
        $data['result'] = 'Здесь будет результат!';
        return view('home', ['data' => $data]);
    }

    public function toconvert(Request $request)
    {
        $convertor = new RealConvertorController();
        $data = [];
        $data['currenciesList'] = $convertor->currenciesListArr();
        $data['from'] = $request['from'] ?? 'USD';
        $data['to'] = $request['to'] ?? 'RUB';
        $data['amount'] = $request['amount'] ?? '';
        if (empty($data['amount'])) {
            $data['result'] = 'Здесь будет результат!';
        } else {
            $data['amount'] = str_replace(',', '.', $data['amount']);
            $result = $convertor->convert($data['from'], $data['to'], $data['amount']);
            $result = number_format($result, 2, ',', ' ');
            $result = str_replace(',', '.', $result);
            $result = floatval($data['amount']) . " " . $convertor->getFullName($data['from']) . " = <br>" . $result . " " . $convertor->getFullName($data['to']);
            $data['result'] = $result;
            file_put_contents('log.txt', $result, FILE_APPEND);
        }
        return view('home', ['data' => $data]);
    }


    public function review()
    {
        $reviews = new Contacts();
        return view('review', ['reviews' => $reviews->all()]);
    }
    public function review_check(Request $request)
    {
        $valid = $request->validate(
            [
                'email' => 'required|min:4|max:100',
                'subject' => 'required|min:4|max:100',
                'message' => 'required|min:15|max:500'
            ]
        );

        $review = new Contacts();
        $review->email = $request->input('email');
        $review->subject = $request->input('subject');
        $review->message = $request->input('message');
        $review->save();
        return redirect()->route('review');
    }
}
