<?php

namespace Vanguard\Http\Controllers\Web\Partner;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Partner\CreatePartnerRequest;
use Vanguard\Http\Requests\Partner\UpdatePartnerRequest;
use Vanguard\Repositories\Partner\PartnerRepository;
use Vanguard\Services\Upload\UploadFileManager;

class PartnerController extends Controller
{

    public function __construct(private PartnerRepository $partnerRepository,private UploadFileManager $fileManager)
    {
    }

    public function index(){
        $data = $this->partnerRepository->paginate(10,request()->get("search"));
        return view("partner/index",["data"=>$data]);
    }

    public function create(){
        return view("partner/create");
    }
    public function store(CreatePartnerRequest $request){
        $root =  "partner/" . date("Ym");
        $path = $this->fileManager->uploadFile($request->image,$root);
        $this->partnerRepository->store([
            "name"=>$request->name,
            "order"=>$request->order,
            "link"=>$request->link,
            "image"=>$path,
        ]);
        return redirect()->route('partner.index')->withSuccess("បង្តើតដៃគូសហការបានជោគជ័យ");
    }
    public function edit($id){
        $slide = $this->partnerRepository->single($id);
        return view("partner/edit",["partner"=>$slide]);
    }
    public function update(UpdatePartnerRequest $request){
        $path = null;
        if($request->image){
            $root =  "partner/" . date("Ym");
            $path = $this->fileManager->uploadFile($request->image,$root);
        }
        $this->partnerRepository->update($request->id,[
            "name"=>$request->name,
            "link"=>$request->link,
            "order"=>$request->order,
            "image"=>$path,
        ]);
        return redirect()->route('partner.index')->withSuccess("កែប្រែដៃគូសហការបានជោគជ័យ");
    }

    public function delete(Request $request){
        $this->partnerRepository->delete($request->id);
        return redirect()->route('partner.index')->withSuccess("លុបដៃគូសហការបានជោគជ័យ");
    }
}
