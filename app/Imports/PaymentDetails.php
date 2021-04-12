<?php

namespace App\Imports;

use App\PaymentStatus;
use App\User;
use App\Due;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
//use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\Rule;
use Throwable;
use Carbon\Carbon;

class PaymentDetails implements ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnError, 
    // WithBatchInserts,
    SkipsOnFailure
{
    use Importable, SkipsFailures, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {    
        $oldStanding = PaymentStatus::where('user_id', User::where('email', $row['email'])->first()->id)->
           where('dues_id', Due::where('name', $row['dues'])->first()->id)->where('uploaded_excel', 'false')->first();
        
        if($oldStanding != null){
            $oldStanding->standing = ($row['outstanding'] * -1) + (int)$oldStanding->standing;
            $oldStanding->reference_date = Carbon::now();
            $oldStanding->uploaded_excel = 'true';
            $oldStanding->save();
        }
        return new PaymentStatus([
            'standing' => $row['outstanding'] * -1,
            'reference_date'    => Carbon::now(),
            'user_id'  => User::where('email', $row['email'])->first()->id,
            'dues_id'  => Due::where('name', $row['dues'])->first()->id,
            'uploaded_excel' => 'true'
        ]);
    }

    public function rules(): array
    {
        return [
            '*.email' => ['required','email', 'exists:users,email'],
            '*.dues' => ['required','exists:dues,name'],
           '*.outstanding' => ['required','numeric'], 
        ];
    }

    // public function customValidationAttributes()
    // {
    //     return ['Email', 'Dues', 'Outstanding'];
    // }

    // public function batchSize(): int
    // {
    //     return 1000;
    // }

}
