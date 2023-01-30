<?php

namespace App\Exports;

use App\Models\User;
use Hekmatinasser\Verta\Facades\Verta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'role',
            'date sign in',
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->role,
            $user->created_at,
        ];
    }

    public function fields(): array
    {
        return [
            'name',
            'email',
            'role',
            'created_at'
        ];
    }
}
