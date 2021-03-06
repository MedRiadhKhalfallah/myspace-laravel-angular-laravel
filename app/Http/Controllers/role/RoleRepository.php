<?php


namespace App\Http\Controllers\role;


use App\Models\Role;
use Illuminate\Database\Query\Builder;

class RoleRepository
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
        /** @var Builder $qr */
        $qr = Role::orderBy('name');
//        return $criteria;
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('name', 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
        /*        $roles = $qr->get()
                    ->map(function ($role) {
                        return  $role->format();
                    });*/

        /*        ->map(function ($role){
                    return[
                        'role_id'=>$role->id,
                        'role_name'=>$role->name,
                        'modele_id'=>$role->model->id,
                        'modele_nale'=>$role->model->name
                    ];
                });*/

    }

    /*    protected function format($role)
        {
            return [
                'role_id' => $role->id,
                'role_name' => $role->name
            ];

        }*/
}
