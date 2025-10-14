<?php
namespace App\Interface;

interface HeadOfFamilyRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    );

    public function getById(
        string $id
    );

    public function getByUserId(
        string $userId
    );

    public function getByIdWithFamilyMembers(
        string $id
    );

    public function getByUserIdWithFamilyMembers(
        string $userId
    );

    public function create(array $data);

    public function update(
        string $id,
        array $data
    );

    public function delete(
        string $id
    );
}
