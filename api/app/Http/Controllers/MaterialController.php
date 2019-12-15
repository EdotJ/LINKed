<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Tag;
use App\TagJoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreMaterial;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{

    private $material;
    public function __construct(Material $material)
    {
        $this->middleware(['auth', 'verified']);
        $this->material = $material;
    }
    public function getMaterials()
    {
        $materials = Material::all();
        $tags = DB::table('learning_material_tag as mtags')
        ->join('tags','tags.id','=','mtags.tag_id')
        ->select('mtags.learning_material_id as id','tags.name as name')
        ->get();
        return view('material', compact('materials','tags'));
    }

    public function getMaterialsFilter(Request $request)
    {
        $tagList = $request->get('tags');
        
        if(!$tagList == ""){
            $query = "";
            $tagList = explode(" ",$tagList);
            foreach($tagList as $name){
                $query = $query . "tags.name = '" . $name ."'  or ";
            }
            $query = substr($query, 0, -5);
            $tags = DB::table('learning_material_tag as mtags')
            ->join('tags','tags.id','=','mtags.tag_id')
            ->select('mtags.learning_material_id as id','tags.name as name')
            ->get();
            $materials = DB::table('learning_material_tag as mtags')
            ->join('tags','tags.id','=','mtags.tag_id')
            ->join('learning_materials as m','m.id', '=','mtags.learning_material_id')
            ->select('m.title as title', 'm.user_id as user_id','m.size as size',
            'm.updated_at as updated_at','m.id as id','m.private as private')
            ->whereRaw(DB::raw($query))
            ->get();
        } else {
            $materials = Material::all();
            $tags = DB::table('learning_material_tag as mtags')
            ->join('tags','tags.id','=','mtags.tag_id')
            ->select('mtags.learning_material_id as id','tags.name as name')
            ->get();
        }
        return view('material', compact('materials','tags'));
    }

    public function uploadMaterial(StoreMaterial $request)
    {
        if($request != null){
            $path = Storage::disk('s3')->put('materials', $request->file);
            $request->merge([
                'size' => $request->file->getClientSize(),
                'path' => $path
            ]);
            $this->material->create($request->only('path', 'title', 'size'));
            return back()->with('success', 'File Successfully Uploaded');
        }
    }
    public function deleteMaterial(Request $request, $id)
    {
        $material = Material::find($id);
        if (Storage::disk('s3')->exists($material->path)){
            if(Storage::disk('s3')->delete($material->path)){
                $tagJoints = TagJoint::all();
                foreach($tagJoints as $tagJoint){
                    if($tagJoint->learning_material_id == $material->id){
                        $tagJoint->delete();
                    }
                }
                $material->delete();
                return back()->with('success', 'File Successfully Deleted');
            }
        }
    }
    public function downloadMaterial(Request $request, $id){
        $material = Material::find($id);
        if (Storage::disk('s3')->exists($material->path)){
            $size = Storage::disk('s3')->size($material->path);
            $fileType = pathinfo($material->path, PATHINFO_EXTENSION);
            $file_name = $material->title . "." . $fileType;
            $response =  [
                'Content-Type' => $fileType,
                'Content-Length' => $size,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename=$file_name",
                'Content-Transfer-Encoding' => 'binary',
            ];
            ob_end_clean();
            return Response::make(Storage::disk('s3')->get($material->path),200,$response);
        } else {
            return back()->with('errors', 'File Does Not Exist');
        }
    }

    public function editMaterial(Request $request, $id)
    {
        $material = Material::find($id);
        $tagJoints = TagJoint::all();
        $temp = "";
        foreach($tagJoints as $tagJoint){
            if($tagJoint->learning_material_id == $id){
                $tag = Tag::find($tagJoint->tag_id);
                $temp = $temp . $tag->name;
                $temp = $temp . " ";
            }
        }
        $temp = substr($temp, 0, -1);
        return view('materials/edit', compact('material', 'temp'));
    }

    public function updateMaterial(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $material = Material::find($id);
        $material->title = $request->get('name');
        if ($request->get('private') == null)
            $material->private = 0;
        else
            $material->private = 1;
        $material->save();
        $tagJoints = TagJoint::MaterialId($id)->paginate();
        foreach($tagJoints as $tagJoint){
            $tagJoint->delete();
        }
        $tagList = $request->get('tags');
        if(!$tagList == ""){
            $tagList = explode(" ",$tagList);
            foreach($tagList as $tagName){
                $tag = Tag::Name($tagName)->paginate()[0];
                if($tag == null){
                    $newTag = new Tag([
                        'name' => $tagName
                    ]);
                    $newTag->timestamps = false;
                    $newTag->save();
                    $tag = $newTag;
                }
    
                $newTagJoint = new TagJoint([
                    'tag_id' => $tag->id,
                    'learning_material_id' => $id
                ]);
                $newTagJoint->timestamps = false;
                $newTagJoint->save();
            }
        }
        session()->flash('success', 'File Updated');
        return redirect('material');
    }
}
