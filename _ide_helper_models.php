<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $vault_id
 * @property string $name
 * @property string|null $description
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SharedAccess> $sharedAccess
 * @property-read int|null $shared_access_count
 * @property-read \App\Models\Vault|null $vault
 * @method static \Database\Factories\PasswordFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Password whereVaultId($value)
 */
	class Password extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $accessible_type
 * @property int $accessible_id
 * @property int $user_id
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $accessible
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereAccessibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereAccessibleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SharedAccess whereUserId($value)
 */
	class SharedAccess extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vault> $vaults
 * @property-read int|null $vaults_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User filterBySearch($search = '')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $accessedUsers
 * @property-read int|null $accessed_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Password> $passwords
 * @property-read int|null $passwords_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SharedAccess> $sharedAccess
 * @property-read int|null $shared_access_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\VaultFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault filterBySearch($search = '')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vault whereUserId($value)
 */
	class Vault extends \Eloquent {}
}

