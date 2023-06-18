<?php

namespace Vanguard\Http\Controllers\Web\Users;

use Illuminate\Http\Request;
use Vanguard\Events\User\UpdatedByAdmin;
use Vanguard\Http\Controllers\Api\ApiController;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\UploadFileManager;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\User;


class AvatarController extends ApiController
{
    private $users;
    private $avatarManager;
    private $fileManager;

    public function __construct(UserRepository $users, UserAvatarManager $avatarManager, UploadFileManager $fileManager)
    {
        $this->users = $users;
        $this->avatarManager = $avatarManager;
        $this->fileManager = $fileManager;
    }

    public function updateExternal(User $user, Request $request)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->id, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user)
            ->withSuccess(__('Avatar changed successfully.'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        $name = $this->avatarManager->uploadAndCropAvatar(
            $request->file('avatar'),
            $request->get('points'),
        );
        if (!$name) {
            $name = $this->fileManager->uploadFile($request->file('avatar'));
        }

        if ($name) {
            $this->users->update($user->id, ['avatar' => $name]);

            event(new UpdatedByAdmin($user));

            return redirect()->route('users.edit', $user)
                ->withSuccess(__('Avatar changed successfully.'));
        }

        return redirect()->route('users.edit', $user)
            ->withErrors(__('Avatar image cannot be updated. Please try again.'));
    }
}
