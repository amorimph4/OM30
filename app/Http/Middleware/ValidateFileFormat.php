<?php

namespace App\Http\Middleware;

use App\Domain\Address;
use App\Domain\Patient;
use Illuminate\Http\Request;
use App\Jobs\PatientsCsvProcess;
use Closure;
use DateTime;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ValidateFileFormat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'file' => 'required||mimes:csv,txt',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $this->processFileToQueue(file($request->file));
            return $next($request);
        }
        
        throw new BadRequestException("error uploading file");
    }

    private function processFileToQueue($file) {
        $chunks = array_chunk($file, 1000)[0];
        unset($chunks[0]);

        foreach (array_map('str_getcsv', $chunks) as $chunk) {
            $patient = new Patient(
                $chunk[0],
                $chunk[1],
                new DateTime($chunk[2]),
                $chunk[3],
                $chunk[4],
                new Address(
                    $chunk[5],
                    $chunk[6],
                    $chunk[7],
                    $chunk[8],
                    $chunk[9],
                    $chunk[10],
                    $chunk[11],
                )
            );
            PatientsCsvProcess::dispatch($patient);
        }
    }
}
