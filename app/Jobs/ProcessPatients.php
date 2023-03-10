<?php

namespace App\Jobs;

use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use App\Repository\PatientRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProcessPatients implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private PatientRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Collection $patientsDto
    ) { }

    public function getRepository(): PatientRepository
    {
        return $this->repository ?? $this->repository = new PatientRepository(new Patient());
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $form = new StorePatientRequest();
        foreach ($this->patientsDto as $patientDto) {
            $validator = Validator::make($patientDto->toArray(), $form->rules());
    
            if ($validator->fails()) {
                Log::error('Paciente não passou na validação', ['paciente' => $patientDto, 'errors' => $validator->errors()]);
                break;
            }

            try {

              $patient = $this->getRepository()->create($patientDto);

              Log::info("Paciente com o id: {$patient->id} cadastrado com sucesso");

            } catch(\Exception $e) {
                Log::error('Erro ao cadatrar paciente', ['paciente' => $patientDto, 'errors' => $e->getMessage()]);
            }
        }

    }
}
