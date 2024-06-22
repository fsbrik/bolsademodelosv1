<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'in:modelo,empresa'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'telefono' => $input['telefono'],
                'password' => Hash::make($input['password']),
            ]);

            Log::info('User created:', ['user' => $user]);

            $roleName = $input['role'];
            Log::info('Role name:', ['role_name' => $roleName]);

            $role = Role::where('name', $roleName)->first();
            Log::info('Role found:', ['role' => $role]);

            if ($role) {
                $user->assignRole($roleName); // Usa el nombre del rol directamente
                Log::info('Role assigned successfully:', ['user_id' => $user->id, 'role' => $roleName]);
            } else {
                Log::error('The role does not exist:', ['role' => $roleName]);
                throw new \Exception('El rol no existe.');
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in transaction:', ['error' => $e->getMessage()]);
            throw $e;
        }

        return $user;
    }
}
