<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Row;

class QuestionImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue, SkipsOnError, WithValidation, SkipsOnFailure, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors, SkipsFailures;

    public function rules(): array{
        return[
            'author' => 'required|string',
            'category' => 'required|string',
            'text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'option_e' => 'required|string',
            'true_option' => 'required|integer',
            'weight' => 'required',
            'explanation' => 'required|string',
        ];
    }
    

    public function model(array $row)
    {
        return new Question([
            'author' => $row['author'],
            'category' => $row['category'],
            'text' => $row['text'],
            'option_a' => $row['option_a'],
            'option_b' => $row['option_b'],
            'option_c' => $row['option_c'],
            'option_d' => $row['option_d'],
            'option_e' => $row['option_e'],
            'true_option' => (int)$row['true_option'],
            'weight' => (float)$row['weight'],
            'explanation' => $row['explanation'],
        ]);
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    // public function onError(\Throwable $error)
    // {
    //     $errorMessage = 'Bir hata oluştu: ' . $e->getMessage();
    //     dd($errorMessage);
    //     return redirect()->back()->with('error', $errorMessage);
    // }

}
