<?php

namespace App\Http\Controllers\marque;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarqueCreateRequest;
use App\Image;
use App\Models\Marque;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

class MarqueController extends Controller
{
    protected $user;

    public function __construct()
    {
        if (JWTAuth::getToken()) {
            $this->user = JWTAuth::parseToken()->authenticate();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Marque::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarqueCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MarqueCreateRequest $request)
    {
        if (Marque::isExiste($request) !== false) {
            return Marque::isExiste($request);
        }

        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('marques_images', $fileNameUnique, 'public');

            $res = Marque::create([
                'name' => $request->input('name'),
                'image_name' => $fileName,
                'image_path' => $fileNameUnique,
                'etat' =>$request->input('etat'),
                'updated_at' =>$request->input('updated_at'),
                'created_at' =>$request->input('created_at')
            ]);

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }

        }

/*        if ($request->file('selectedFile')) {
            foreach ($request->file('selectedFile') as $selectedFile) {
                $selectedFile->store("public");
            }
//            $file = $request->file('selectedFile')->store("public");
        }*/

    }

    /**
     * Display the specified resource.
     *
     * @param Marque $marque
     * @return  marque $marque
     */
    public function show(Marque $marque)
    {
        return $marque;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarqueCreateRequest $request
     * @param Marque $marque
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MarqueCreateRequest $request, Marque $marque)
    {
        $updateData=[];
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('marques_images', $fileNameUnique, 'public');
            $updateData['image_name']=$fileName;
            $updateData['image_path']=$fileNameUnique;
        }
        $updateData['name']=$request->input('name');
        $updateData['etat']=$request->input('etat');
        $updateData['updated_at']=$request->input('updated_at');

        $res = $marque->update($updateData);

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }




/*        $res = $marque->update($request->all());
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Marque $marque
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Marque $marque)
    {
        // delete foreign entity
//        $marque->modeles->each->delete();

        $res = $marque->delete();
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }
}
