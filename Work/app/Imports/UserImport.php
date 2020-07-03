<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Repositories\ModelRepository\UsersPostRepository;
use Debugbar;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(\Illuminate\Support\Collection $collection)
    {
        $postRepository = app(UsersPostRepository::class);
        $posts = $postRepository->getPosts();
        foreach ($collection as $row) {
            $post = $posts->where("name", $row["rol"])->first();
            if ($post) {
                if ($post->id != 2) {
                    User::create([
                        "post_id" => $post->id,
                        "name" => $row['imya'],
                        "secName" => $row['familiya'],
                        "thirdName" => $row['otchestvo'],
                        "email" => $row['email'],
                    ]);
                } else {
                    $user = User::create([
                        "post_id" => $post->id,
                        "name" => $row['imya'],
                        "secName" => $row['familiya'],
                        "thirdName" => $row['otchestvo'],
                        "email" => $row['email'],
                    ]);
                    Student::create([
                        "gender" => $row['pol_studenta'],
                        "type_of_financing" => $row['tip_finansirovaniya_studenta'],
                        "birthday" => $row['den_rozhdeniya_studenta'],
                        "user_id" => $user->id,
                    ]);
                }
            }
        }
    }
}
