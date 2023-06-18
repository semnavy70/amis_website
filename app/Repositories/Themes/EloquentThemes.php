<?php

namespace Vanguard\Repositories\Themes;

use DB;
use Vanguard\Services\Upload\UploadFileManager;
use Vanguard\ThemeSetting;

class EloquentThemes implements ThemesRepository
{
    private $fileManager;
    private $folder;

    public function __construct(UploadFileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->folder = "themes/" . date("Ym");
    }

    public function index()
    {
        // TODO: Implement index() method.
        return DB::table('theme_settings')->get();

    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
        $theme = new ThemeSetting();
        $theme->logo = $this->fileManager->uploadFile($data["logo"], $this->folder);
        $theme->site_name = $data["site_name"];
        $theme->site_description = $data["site_description"];
        $theme->slogan = $data["slogan"];
        $theme->facebook_link = $data["facebook_link"];
        $theme->youtube_link = $data["youtube_link"];
        $theme->instagram_link = $data["instagram_link"];
        $theme->twitter_link = $data["twitter_link"];
        $theme->linkedin_link = $data["linkedin_link"];
        $theme->tiktok_link = $data["tiktok_link"];
        $theme->phone_number = $data["phone_number"];
        $theme->copyright_name = $data["copyright_name"];

        $theme->save();
        return $theme;
    }

    public function single()
    {
        return ThemeSetting::first();
    }

    public function update(array $data)
    {
        $theme = ThemeSetting::first();
        if($theme == null) {
            $theme = new ThemeSetting();
        }
        $theme->site_name = $data["site_name"];
        $theme->site_description = $data["site_description"];
        $theme->slogan = $data["slogan"];
        $theme->facebook_link = $data["facebook_link"];
        $theme->youtube_link = $data["youtube_link"];
        $theme->instagram_link = $data["instagram_link"];
        $theme->twitter_link = $data["twitter_link"];
        $theme->linkedin_link = $data["linkedin_link"];
        $theme->tiktok_link = $data["tiktok_link"];
        $theme->phone_number = $data["phone_number"];
        $theme->copyright_name = $data["copyright_name"];
        if (isset($data["logo"])) {
            if (is_file($data["logo"]  ?? null)) {
                $theme->logo = $this->fileManager->uploadFile($data["logo"], $this->folder);
            }
        }
        $theme->save();
        return $theme;
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
