<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return User::with(["post",'student'])->orderBy("post_id")->get();
    }

    /**
     * @var App\Models\User $group
     */
    public function map($user): array
    {
        if($user->post_id ==2){
            return [
                $user->id,
                $user->name,
                $user->secName,
                $user->thirdName,
                $user->email,
                $user->post->name,
                $user->student->gender,
                $user->student->birthday,
                $user->student->type_of_financing,
            ];
        }
        return [
            $user->id,
            $user->name,
            $user->secName,
            $user->thirdName,
            $user->email,
            $user->post->name
        ];
    }

    public function headings(): array
    {
        $header = [
            '#',
            'Имя',
            'Фамилия',
            'Отчество',
            'Email',
            'Роль',
            "Пол студента",
            "День рождения студента",
            "Тип финансирования студента"
        ];
        return $header;
    }
}
