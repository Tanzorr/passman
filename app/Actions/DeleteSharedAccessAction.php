<?php
//
//namespace App\Actions;
//
//use App\Contracts\MutationActionInterface;
//use App\Models\SharedAccess;
//
//class DeleteSharedAccessAction implements MutationActionInterface
//{
//
//    public function handle(array $data): mixed
//    {
//        SharedAccess::where('accessible_type', $data[$typeMapping[$data['accessible_type']]])
//            ->where('accessible_id', $data['accessible_id'])
//            ->where('user_id', $data['user_id'])
//            ->first()
//            ->delete();
//
//        return response()->json(['message' => 'Access removed successfully']);
//    }
//}
