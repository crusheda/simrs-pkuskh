<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Auth;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        $auth = Auth::user();
        $id = $auth->id;
        $name = $auth->name;
        $role = $auth->roles->first()->name; //kabag-keperawatan
        return $id;
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        $auth = Auth::user();
        $id = $auth->id;
        $name = $auth->name;
        $role = $auth->roles->first()->name; //kabag-keperawatan

        if ($name === 'it') {
            return [
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => '*', 'access' => 2], 
                ['disk' => 'managerfile', 'path' => '*/', 'access' => 2], 
            ];
        }
        
        return [
            ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
            ['disk' => 'managerfile', 'path' => $role, 'access' => 1],
            ['disk' => 'managerfile', 'path' => $role.'/', 'access' => 2],   
        ];

        // TUTOR
        // ['disk' => 'images', 'path' => 'nature', 'access' => 0],      // guest don't have access for this folder
        // ['disk' => 'images', 'path' => 'icons', 'access' => 1],       // only read - guest can't change folder - rename, delete
        // ['disk' => 'images', 'path' => 'icons/*', 'access' => 1],     // only read all files and foders in this folder
        // ['disk' => 'images', 'path' => 'image*.jpg', 'access' => 0],  // can't read and write (preview, rename, delete..)
        // ['disk' => 'images', 'path' => 'avatar.png', 'access' => 1],  // only read (view)
    }
}