<?php

namespace App\Http\Controllers\image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Image;
use App\Produit;
use App\SousCategorie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageCreateRequest $request)
    {
        if ($request->hasFile('image')) {
            $fileNameExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('images', $fileNameUnique, 'public');

            $res = Image::create([
                'name'=>$fileName,
                'path'=>$fileNameUnique,
                'produit_id'=>$request->input('produit_id'),
                'updated_at'=>$request->input('updated_at')
                ]);
            if ($res) {
                return redirect(route('admin.images.index'))->with('messageSuccess', 'creation avec ucc');
            } else {
                return redirect()->back()->with('messageEchec', 'creation avec echec');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return $image;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageCreateRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $res = $image->delete();
        if ($res) {
            return redirect(route('admin.images.index'))->with('messageSuccess', 'delete success');
        } else {
            return redirect()->back()->with('messageEchec', 'delete echec');
        }

    }
}
