<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\DesignDimensionMaterial;
use App\Models\Dimensions;
use App\Models\DimMatModel;
use App\Models\Materials;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function addDesign(Request $request)
    {
        // request [ name , image:( img file ) , dim_mat [{id(DimMatModle),price}]]
        $design = Design::create([
            'name' => $request->name,
            'img_url' => "",
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $file_extention = $image->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images';
            $image->move($path, $file_name);
            $design->img_url = $path . '/' . $file_name;
            $design->save();
        }
        $ddms = []; // designs dimension material
        error_log(count($request->matDim));
        foreach ($request->matDim as $dm) {
            
            $dims = explode(' x ', $dm->dim);
            $width = $dims[0];
            $height = $dims[1];
            $thickness = $dims[2];
            $dim = Dimensions::where('width', $width)->where('height', $height)
                ->where('thickness', $thickness)->first();
            if (!isset($dim)) {
                return response()->json([
                    'msg' => 'dim not found ' . $dm->dim
                ], 400);
            }
            $mat = Materials::where('name', $dm->mat)->first();
            if (!isset($mat)) {
                return response()->json([
                    'msg' => 'mat not found ' . $dm->mat
                ], 400);
            }
            $dimMat = DimMatModel::where('dimension_id', $dim->id)
                ->where('material_id', $mat->id)->first();
            if (!isset($mat)) {
                $dimMat = DimMatModel::create([
                    'name' => '',
                    'dimension_id' => $dim->id,
                    'material_id' => $mat->id,
                ]);
                $dimMat->name = "ستاندر " . $dimMat->id;
                $dimMat->save();
            }
            $ddm = DesignDimensionMaterial::create([
                'DM_id' => $dimMat->id,
                'design_id' => $design->id,
                'price' => $dm->price,
            ]);
            array_push($ddms, $ddm);
        }

        return response()->json(['msg' => 'ok', 'desgin' => $design, 'ddms' => $ddms], 200);
    }

    public function getDesign()
    {
        $d = Design::with('design_dms.DM.dim')->with('design_dms.DM.mat')->get();
        return response()->json($d, 200);
    }
    public function removeDesign(Request $request)
    {
    }
    public function getRequests()
    {
        return response()->json(UserRequest::with('user')->with('design')->with('admin'), 200);
    }
    public function getMaterials()
    {
        return response()->json(Materials::get(), 200);
    }
    public function getDimensions()
    {
        return response()->json(Dimensions::get(), 200);
    }
    public function getMatDim()
    {
        return response()->json(DimMatModel::with('dim')->with('mat')->get(), 200);
    }
}
