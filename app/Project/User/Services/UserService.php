<?php

namespace App\Project\User\Services;

use App\Jobs\SendWelcomeEmailJob;
use App\Project\Common\Abstracts\AbstractService;
use App\Project\User\Repositories\UserRepository;
use App\Project\User\Validators\DataUserValidator;
use App\Traits\Common;
use Exception;

class UserService extends AbstractService
{
    use Common;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function beforeSave($params): array
    {
        return $this->preparePayloadToSave($params);
    }

    public function beforeUpdate($entity, $params): array
    {
        return $this->preparePayloadToUpdate($params);
    }

    private function preparePayloadToSave(array $params): array
    {
        $dataUserValidator = new DataUserValidator($params);

        $payload = $dataUserValidator->toArray();

        return array_merge($params, $payload);
    }

    private function preparePayloadToUpdate(array $params): array
    {
        $dataUserValidator = new DataUserValidator($params);

        $payload = $dataUserValidator->toArray();

        $removeFields = [
            'password',
            'code',
            'picture',
            'email_verified_at',
            'user_terms_accepted',
            'user_full_registration',
            'user_responded_form',
            'max_charge_amount',
            'active'
        ];

        foreach ($removeFields as $key) {
            unset($payload[$key]);
        }

        return array_merge($params, $payload);
    }

    /**
     * @throws Exception
     */
    public function afterSave($entity, array $params)
    {
        dump('afterSave');
        switch ($params['action']) {
            case 'new-subscriber':
                break;
            case 'new-admin':
//                $this->createOrUpdatePermissions($entity, $params);
                break;
        }

        dispatch(new SendWelcomeEmailJob($entity));

        return $entity;
    }

    public function afterUpdate($entity, array $params)
    {
        switch ($params['action']) {
            case 'update-subscriber':
                break;
            case 'update-admin':
                $this->createOrUpdatePermissions($entity, $params);
                break;
        }

        return $entity;
    }

    public function updatePassword(string $email, $password)
    {
        return $this->findOneWhere(['email' => $email])->update(['password' => $password]);
    }

    private function createOrUpdatePermissions($entity, $params): void
    {
        $permissionsToUser = $this->preparePermissions($params['permission-user']);
        $entity->syncPermissions($permissionsToUser);
    }

    private function preparePermissions(array $permissionsToUser): array
    {
        $permissions = $this->getArrayPermission();
        $permissionsArray = [];
        foreach ($permissions as $permission) {
            foreach ($permission->subCategories as $subCategory) {
                if (in_array($subCategory->value, $permissionsToUser)) {
                    foreach ($subCategory->verbs as $verb => $checked) {
                        $permissionsArray[] = $subCategory->value.'.'.$verb;
                    }
                }
            }
        }

        return $permissionsArray;
    }
}
