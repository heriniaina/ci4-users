<?php namespace Solaitra\Users\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel {
    protected $table = 'users';
    protected $allowedFields = ['email', 'username', 'password_hash', 'active'];
}