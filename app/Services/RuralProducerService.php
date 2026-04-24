<?php

namespace App\Services;

use App\Models\RuralProducer;

/**
 * Service class for managing rural producers.
 */
class RuralProducerService
{
    /**
     * Create a new rural producer.
     *
     * @param array $data
     * @return RuralProducer
     */
    public function create(array $data)
    {
        $data['cpf_cnpj'] = $this->removeCharacters($data['cpf_cnpj']);
        $data['phone'] = $this->removeCharacters($data['phone']);

        return RuralProducer::create($data);
    }

    /**
     * List rural producers with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list(array $filters)
    {
        $query = RuralProducer::query();

        $query->when($filters['name'] ?? null, fn($q, $name) =>
            $q->where('name', 'ilike', "%$name%")
        )
        ->when($filters['cpf_cnpj'] ?? null, fn($q, $cpfCnpj) =>
            $q->where('cpf_cnpj', 'like', "%$cpfCnpj%")
        )
        ->when($filters['phone'] ?? null, fn($q, $phone) =>
            $q->where('phone', 'like', "%$phone%")
        )
        ->when($filters['email'] ?? null, fn($q, $email) =>
            $q->where('email', 'ilike', "%$email%")
        );

        $perPage = $filters['limit'] ?? 10;

        return $query->paginate($perPage);
    }

    /**
     * Update an existing rural producer.
     *
     * @param RuralProducer $ruralProducer
     * @param array $data
     * @return RuralProducer
     */
    public function update(RuralProducer $ruralProducer, array $data)
    {
        if (isset($data['cpf_cnpj'])) {
            $data['cpf_cnpj'] = $this->removeCharacters($data['cpf_cnpj']);
        }

        if (isset($data['phone'])) {
            $data['phone'] = $this->removeCharacters($data['phone']);
        }

        $ruralProducer->update($data);

        return $ruralProducer;
    }

    /**
     * Delete a rural producer.
     *
     * @param RuralProducer $ruralProducer
     * @return bool
     */
    public function delete(RuralProducer $ruralProducer)
    {
        return $ruralProducer->delete();
    }

    /**
     * Remove non-numeric characters from a string.
     *
     * @param string $value
     * @return string
     */
    private function removeCharacters(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }
}
