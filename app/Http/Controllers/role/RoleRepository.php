<?php


namespace App\Http\Controllers\role;


use App\Models\Role;

class RoleRepository
{
    public function searchWithCriteria($criteria)
    {
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
        return $qr->get()
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
