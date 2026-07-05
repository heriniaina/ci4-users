<?php 

namespace Solaitra\Users\Config;
use CodeIgniter\Events\Events;


Events::on('register', static function ($user) {
    //if first user, set as superadmin 
    $userProvider = auth()->getProvider();

    $userCount = $userProvider->countAllResults();

    if($userCount == 1) {
        $user->addGroup('superadmin');
    }
});