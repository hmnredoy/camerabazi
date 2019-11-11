<?php

namespace App\Exports;

use App\Models\TMR;
use App\Filters\TMRFilters;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TMRExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $filters = app(TMRFilters::class);

        return TMR::filter($filters)->get();
    }

    public function headings() : array
    {
        return [
            'SL',
            'Name',
            'TMR Code',
            'Phone',
            'Alt Phone',
            'Email',
            'Present Address',
            'Permanent Address',
            'Date of Birth',
            'Joined At',
            'NID',
            'Contact Person',
            'Contact Number',
            'Contact Address',
            'Status'
        ];
    }

    public function map($tmr) : array
    {
        return [
            $tmr->id,
            $tmr->name,
            $tmr->tmr_code,
            $tmr->phone,
            $tmr->alt_phone,
            $tmr->email,
            $tmr->present_address,
            $tmr->permanent_address,
            $tmr->dob,
            $tmr->joined_at,
            $tmr->nid,
            $tmr->contact_person,
            $tmr->contact_number,
            $tmr->contact_address,
            $tmr->status == 1 ? 'Active' : 'Inactive',
        ];
    }

}
