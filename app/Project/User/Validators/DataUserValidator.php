<?php

namespace App\Project\User\Validators;

use App\Traits\Common;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Model;

class DataUserValidator
{
    use Common;

    private array $params;

    private Model $entity;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->params['name'] ?? '',
            'code' => $this->params['code'] ?? '',
            'email' => $this->params['email'] ?? $this->params['email'],
            'email_verified' => $this->params['email_verified_at'] ?? false,
            'password' => $this->params['password'] ?? '',
            'picture' => $this->params['picture'] ?? 'images/users/profile.png',
            'document' => self::sanitizeCpfCnpj($this->params['document'] ?? null),
            'phone' => self::sanitizePhone($this->params['phone'] ?? null),
            'user_terms_accepted_at' => isset($this->params['user_terms_accepted']) && $this->params['user_terms_accepted'] ? Carbon::now()->toDateTimeString() : null,
            'user_full_registration' => $this->params['user_full_registration'] ?? false,
            'user_responded_form' => $this->params['user_responded_form'] ?? false,
            'active' => $this->params['active'] ?? true,
            'role' => $this->setUserRole($this->params['action']),
            'action' => $this->params['action'] ?? 'new-subscriber',
        ];
    }

    private function setUserRole($action): string
    {
        return match ($action) {
            'update-admin',
            'new-admin' => UserRoleEnum::ADMIN->value,
            'update-subscriber',
            'new-subscriber' => UserRoleEnum::STANDARD->value,
            'update-candidate',
            'new-candidate' => UserRoleEnum::CANDIDATE->value,
            default => UserRoleEnum::STANDARD->value,
        };
    }

}
