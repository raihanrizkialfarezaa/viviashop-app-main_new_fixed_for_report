<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return User::select('name', 'email', 'is_admin', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Admin', 'Created At'];
    }
}
