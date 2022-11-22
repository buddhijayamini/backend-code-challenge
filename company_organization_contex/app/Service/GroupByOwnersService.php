<?php

namespace App\Service;

class GroupByOwnersService implements OwnerServiceInterface
{
    public function getChallenge4()
    {
        $data =
        [
            "Company A" => ["insurance.txt", "letter.docx"],
            "Company B" => ["Contract.docx"]
        ];
        // [
        //     [
        //         'name' => 'Company A',
        //         'doc' => 'insurance.txt',
        //     ],
        //     [
        //         'name' => 'Company A',
        //         'doc' => 'letter.docx',
        //     ],
        //     [
        //         'name' => 'Company B',
        //         'doc' => 'Contract.docx',
        //     ],
        // ];

        return response()->json($data);

    }
}
