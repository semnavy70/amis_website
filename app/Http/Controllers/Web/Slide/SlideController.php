<?php

namespace Vanguard\Http\Controllers\Web\Slide;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Slide\CreateSlideRequest;
use Vanguard\Http\Requests\Slide\UpdateSlideRequest;
use Vanguard\Repositories\Slide\SlideRepository;
use Vanguard\Services\Upload\UploadFileManager;

class SlideController extends Controller
{

    public function __construct(private SlideRepository $slideRepository,private UploadFileManager $fileManager)
    {
    }

    public function index(){
        $data = $this->slideRepository->paginate(10,request()->get("search"));
        return view("slide/index",["data"=>$data]);
    }

    public function create(){
        return view("slide/create");
    }
    public function store(CreateSlideRequest $request){
        $root =  "slide/" . date("Ym");
        $path = $this->fileManager->uploadFile($request->image,$root);
        $this->slideRepository->store([
            "name"=>$request->name,
            "order"=>$request->order,
            "image"=>$path,
        ]);
        return redirect()->route('slide.index')->withSuccess("បង្តើតស្លាយបានជោគជ័យ");
    }
    public function edit($id){
        $slide = $this->slideRepository->single($id);
        return view("slide/edit",["slide"=>$slide]);
    }
    public function update(UpdateSlideRequest $request){
        $path = null;
        if($request->image){
            $root =  "slide/" . date("Ym");
            $path = $this->fileManager->uploadFile($request->image,$root);
        }
        $this->slideRepository->update($request->id,[
            "name"=>$request->name,
            "order"=>$request->order,
            "image"=>$path,
        ]);
        return redirect()->route('slide.index')->withSuccess("កែប្រែស្លាយបានជោគជ័យ");
    }

    public function delete(Request $request){
        $this->slideRepository->delete($request->id);
        return redirect()->route('slide.index')->withSuccess("លុបស្លាយបានជោគជ័យ");
    }
}
