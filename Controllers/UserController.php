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


    public function edit($id)
    {
        // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();
        $user = $users->find($id);
        $this->data['page_title'] = lang('Users.edit_user');
        if ($this->request->is('post') && $this->validate([
            'id'    => 'max_length[19]|is_natural_no_zero',
            'username' => 'required|min_length[4]|max_length[50]|is_unique[users.username,id,{id}]|regex_match[/\A[a-zA-Z0-9\.]+\z/]',
            'email' => 'required|max_length[254]|valid_email|is_unique[auth_identities.secret,user_id,{id}]',
            'password' => 'permit_empty|max_length[254]|min_length[10]'
        ])) {

            $user->fill([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
            ]);
            if($this->request->getPost('password')) {
                $user->fill(['password' => $this->request->getPost('password')]);
            }
            $users->save($user);
            return redirect()->to('users')->with('message', lang('Users.user_updated'));
        }
        $this->data['validation'] = $this->validator;
        $this->data['user'] = $user;
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
