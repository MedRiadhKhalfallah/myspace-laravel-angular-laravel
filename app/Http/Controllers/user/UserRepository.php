<?php


namespace App\Http\Controllers\user;


use App\Models\User;

class UserRepository
{
    public function searchWithCriteria($criteria)
    {
        $qr = User::with('roles')->orderBy('id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where($key, 'like', '%' . $value . '%');
                        break;
                    case 'prenom':
                        $qr->where($key, 'like', '%' . $value . '%');
                        break;
                    case 'email':
                        $qr->where($key, 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        return $qr->get()
            ->map->format();
    }
}
