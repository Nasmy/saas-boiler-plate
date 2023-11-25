<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        return view('users.create');
    }

    public function edit($id) {
        $user = $this->userRepository->getUserById($id);
        return view('users.edit',[
            'user'=>$user
        ]);
    }

    public function update(Request $request,$id) {
        $this->userRepository->updateUser($id,$request);
        return redirect('/admin/dashboard')->with('success', 'User detail updated is successfully');

    }

    // GameController.php

    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);
        return redirect('/admin/dashboard')->with('success', 'Game Data is successfully deleted');
    }
}
