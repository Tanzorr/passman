<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Pass Manager API",
 *     version="1.0.0",
 *     description="API documentation for Pass Manager application",
 *
 *     @OA\Contact(
 *         email="support@example.com"
 *     ),
 *
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000/",
 *     description="Local development server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="JWT Bearer token authentication"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="Operations related to user authentication"
 * )
 *
 * @OA\Schema(
 *     schema="LoginUserRequest",
 *     type="object",
 *
 *     @OA\Property(property="email", type="string", example="admin@gmail.com"),
 *     @OA\Property(property="password", type="string", example="password")
 * )
 *
 * @OA\Tag(
 *     name="Vault",
 *     description="Operations related to vault management"
 * )
 *
 * @OA\Schema(
 *     schema="Vault",
 *     type="object",
 *     required={"id", "user_id", "name", "description", "created_at", "updated_at"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Vault 1"),
 *     @OA\Property(property="description", type="string", example="Personal vault"),
 *     @OA\Property(property="is_shared", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:30:00Z")
 * )
 *
 * @OA\Schema(
 *      schema="StoreVaultRequest",
 *      type="object",
 *
 *      @OA\Property(property="name", type="string", example="Updated Vault Name"),
 *      @OA\Property(property="description", type="string", example="Updated description"),
 *      @OA\Property(property="user_id", type="intager", example=11)
 *  )
 *
 * @OA\Schema(
 *       schema="UpdateVaultRequest",
 *       type="object",
 *
 *       @OA\Property (property="id", type="integer", example=1),
 *       @OA\Property(property="name", type="string", example="Updated Vault Name"),
 *       @OA\Property(property="description", type="string", example="Updated description"),
 *       @OA\Property(property="user_id", type="intager", example=11)
 *   )
 *
 * @OA\Tag(
 *     name="Page",
 *     description="Operations related to page management"
 * )
 *
 * @OA\Schema(
 *     schema="UpadtePageRequest",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="author_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Page title"),
 *     @OA\Property(property="content", type="string", example="Page content"),
 *     )
 *
 * @OA\Schema(
 *     schema="StorePageRequest",
 *     type="object",
 *
 *     @OA\Property(property="author_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Page title"),
 *     @OA\Property(property="content", type="string", example="Page content"),
 *     )
 *
 * @OA\Schema(
 *     schema="Page",
 *     type="object",
 *     required={"id", "author_id", "title", "content", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="author_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Page title"),
 *     @OA\Property(property="content", type="string", example="Page content"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:30:00Z")
 * )
 *
 * @OA\Tag(
 *     name="Passwords",
 *     description="API Endpoints for managing passwords"
 * )
 *
 * @OA\Schema(
 *     schema="Password",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="vault_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Facebook"),
 *     @OA\Property(property="value", type="string", example="johndoe"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="StorePasswordRequest",
 *     type="object",
 *
 *     @OA\Property(property="vault_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Facebook"),
 *     @OA\Property(property="value", type="string", example="johndoe"),
 *     @OA\Property(property="description", type="string", example="My Facebook password")
 * )
 *
 * @OA\Tag (
 *     name="SharedAccess",
 *     description="Operations related to shared access management"
 * )
 *
 * @OA\Schema(
 *     schema="SharedAccess",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="accessible_type", type="string", example="VaultModel"),
 *     @OA\Property(property="accessible_id", type="integer", example=1),
 *     @OA\Property(property="expires_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z")
 *)
 *
 * @OA\Schema(
 *     schema="StoreSharedAccessRequest",
 *     type="object",
 *
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="accessible_type", type="string", example="VaultModel"),
 *     @OA\Property(property="accessible_id", type="integer", example=1),
 *     @OA\Property(property="expires_at", type="string", format="date-time", example="2026-08-01T00:00:00.000000Z"),
 *     )
 *
 * @OA\Schema(
 *     schema="UpdateSharedAccessRequest",
 *     type="object",
 *     required={"user_id", "accessible_type", "accessible_id"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="accessible_type", type="string", example="VaultModel"),
 *     @OA\Property(property="accessible_id", type="integer", example=1),
 *     @OA\Property(property="expires_at", type="string", format="date-time", example="2028-08-01T00:00:00.000000Z"),
 *     )
 *
 * @OA\Tag(
 *     name="Media",
 *     description="Operations related to media management"
 * )
 *
 * @OA\Schema(
 *     schema="Media",
 *     type="object",
 *
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="user_id", type="integer", example=1),
 *      @OA\Property(property="file_name", type="string", example="example.jpg"),
 *      @OA\Property(property="file_path", type="string", example="/uploads/example.jpg"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z")
 * )
 *
 * @OA\Tag(
 *     name="EntityMedia",
 *     description="API Endpoints for managing entity media relations"
 * )
 *
 * @OA\Schema(
 *      schema="EntityMedia",
 *      type="object",
 *
 *      @OA\Property(property="media_id", type="integer", example=1),
 *      @OA\Property(property="mediable_type", type="string", example="user"),
 *      @OA\Property(property="mediable_id", type="integer", example=1)
 * )
 *
 * @OA\Tag(
 *      name="User",
 *      description="Operations related to user management"
 *  )
 *
 * @OA\Schema(
 *      schema="User",
 *      type="object",
 *
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="John Doe"),
 *      @OA\Property(property="email", type="string", example="example@ukr.net"),
 *      @OA\Property(property="password", type="string", example="password"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2021-09-01T12:00:00"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2021-09-01T12:00:00")
 *  )
 *
 * @OA\Schema (
 *     schema="StoreUserRequest",
 *     type="object",
 *
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="example@gmail.com"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     @OA\Property(property="password_confirmation", type="string", example="password")
 *)
 */
class OpenApi extends Controller
{
    // This class is only for Swagger annotations
}
