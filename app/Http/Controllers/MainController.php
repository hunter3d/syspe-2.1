<?php
namespace App\Http\Controllers;

use App\Http\Requests\MessagesRequest;
use App\Models\Messages;

class MainController extends Controller {
    public function index() {
        $data['messages'] = Messages::query()->orderBy('created_at','DESC')->paginate(25);
        return view('main.index', $data);
    }

    public function create() {
        return view('main.add');
    }

    public function store(MessagesRequest $request) {
        $request->store();
        return redirect()->route('dashboard');
    }

    public function edit( $id ) {
        $data['message'] = Messages::find($id);
        if ($data['message']->user_id == auth('web')->user()->id) {
            return view('main.edit',$data);
        } else {
            return redirect()->back()->with('warning', 'Вы не можете редактировать чужое сообщение!');
        }
    }

    public function update($id, MessagesRequest $request) {
        $request->update( $id );
        return redirect()->route('dashboard');
    }

    public function destroy( $id ) {
        $message = Messages::find($id);
        if ($message->user_id == auth('web')->user()->id) {
            $message->delete();
            return redirect()->back();
        } else {
            return redirect()->back()->with('warning', 'Вы не можете удалить чужое сообщение!');
        }
    }
}
