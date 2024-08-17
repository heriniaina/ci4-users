<?php

namespace Solaitra\Users\Controllers;

use Solaitra\Base\Controllers\BaseController;
use Solaitra\Users\Models\UserModel;
use CodeIgniter\Shield\Entities\User;


class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->data['page_title'] = "Users";
    }

    public function index()
    {
        $this->data['users'] = $this->userModel->findAll();
        return view('\Solaitra\Users\Views\user_index', $this->data);
    }

    public function create()
    {
        if ($this->request->is('post') && $this->validate([
            'username' => 'required|min_length[4]|max_length[50]|is_unique[users.username]|regex_match[/\A[a-zA-Z0-9\.]+\z/]',
            'email' => 'required|max_length[254]|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|max_length[254]|min_length[10]'
        ])) {
            //save user
            $users = auth()->getProvider();

            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);
            $users->save($user);

            // To get the complete user object with ID, we need to get from the database
            $user = $users->findById($users->getInsertID());

            // Add to default group
            $users->addToDefaultGroup($user);

            return redirect()->to('users')->with('message', lang('Users.user_created'));
        }
        $this->data['validation'] = $this->validator;

        $this->data['page_title'] = lang('Users.create_user');
        return view('\Solaitra\Users\Views\user_create', $this->data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->userModel->save($data);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $this->data['page_title'] = lang('Users.edit_user');
        $this->data['user'] = $this->userModel->find($id);
        return view('\Solaitra\Users\Views\user_edit', $this->data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $this->userModel->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users');
    }
}
