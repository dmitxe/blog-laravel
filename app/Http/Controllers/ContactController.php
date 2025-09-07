<?php

namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\Admin;

class ContactController extends Controller
{
    public $secretToken = 'sddjf3858ghdkifdklgds';
    public function show()
    {
        return view('contact');
    }

    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {
        if (isset($_POST['mail-token']) && $this->secretToken == $_POST['mail-token']) {
            //send the admin an notification
			//var_dump($admin); exit;
            $admin->notify(new InboxMessage($message));
            // redirect the user back
            return redirect()->back()->with('message', 'Спасибо за обращение! Ваше сообщение успешно отправлено администратору сайта!');
        } else {
            return redirect()->back()->with('message-fail', 'Не удалось отправить письмо. Вы не прошли защиту от спама!');
        }
    }
}