<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemsResource;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $resources = Resources::paginate();
            return ItemsResource::collection($resources);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'year' => 'nullable',
            'unit' => 'nullable',
            'url' => 'nullable',
            'price' => 'nullable',
            'thumbnailimage' => 'nullable',
            
        ]);

        try {
            if (isset($data['thumbnailimage'])) {
                $relativePath = $this->saveImage($data['thumbnailimage']);
                $data['thumbnailimage'] = $relativePath;
            }
            $resource = Resources::create($data);
            return response()->json('Resource created', 200);
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Resources $resources)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resources $resources)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resources $resources, $id)
    {
        $data = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'year' => 'nullable',
            'unit' => 'nullable',
            'url' => 'nullable|active_url',
            'price' => 'nullable',
            'thumbnailimage' => 'nullable',
            
        ]);


       
        try {
            $resource = Resources::where('id', $id);
            if (isset($data['thumbnailimage'])) {
                $relativePath = $this->saveImage($data['thumbnailimage']);
                $data['thumbnailimage'] = $relativePath;
            }
            $resource->update($data);
            return response()->json('Resource updated', 200);
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resources $Resources, Request $request, $id)
    {
       

        $Resource = Resources::where('id', $id);
        

        // if an old image exist, delete it
        if ($Resource->thumbnailimage) {
            $absolutePath = public_path($Resource->thumbnailimage);
            File::delete($absolutePath);
        }

        $Resource->delete();
        
        return response('', 204);
    }




    private function saveImage($image)
    {
        // check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            //Get file extention
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random(). '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }


    // Client

    public function getResources()
    {
        try {
            $allresources = ItemsResource::collection(Resources::paginate());
            $books = ItemsResource::collection(Resources::where('type', 'Book')->paginate());
            $articles = ItemsResource::collection(Resources::where('type', 'Article')->paginate());
            $videos = ItemsResource::collection(Resources::where('type', 'Video')->paginate());

            $data = [
                'allresources' => $allresources,
                'books' => $books,
                'articles' => $articles,
                'videos' => $videos
            ];
            return $data;
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
