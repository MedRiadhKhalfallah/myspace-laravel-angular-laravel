<?php


namespace App\Http\Controllers\user;


use App\Models\User;

class UserRepository
{
    private $offset = 0;
    private $limit = 50;

    public function searchWithCriteria($criteria)
    {
        if (isset($criteria['offset'])) {
            $this->offset = $criteria['offset'];
        }
        if (isset($criteria['limit']) && $criteria['limit'] < 50) {
            $this->limit = $criteria['limit'];
        }

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
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
    }
}
