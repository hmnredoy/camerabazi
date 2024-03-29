<?php


namespace App\Repositories;


use App\Http\Controllers\Helper\CustomHelper;
use App\Models\Enums\MembershipStatus;
use App\Models\User;

class MembershipPurchaseRepository
{
    private function getUserMembership($obj_or_id){
        if(is_object($obj_or_id)){
            $user = $obj_or_id;
        }else{
            $user = User::find($obj_or_id);
        }
        if($user) {
            return $user->memberships();
        }
        return false;
    }

    public function getMembershipData($obj_or_id, $paginate = 15){
        $membership = $this->getUserMembership($obj_or_id);

        if($membership){
            if($paginate == false){
                return $membership->where('expire', '>=', date('Y-m-d', strtotime("now")))->get();
            }
            return $membership->where('expire', '>=', date('Y-m-d', strtotime("now")))->paginate($paginate);
        }
        return [];
    }

    public function getSum($model_or_id, $sum_column, $status = 1, $expire = true){
        $membership = $this->getUserMembership($model_or_id);
        if($expire){
            return $membership
                ->where('expire', '>=', date('Y-m-d', strtotime("now")))
                ->where('status', $status)
                ->sum($sum_column);
        }
        if($membership){
            return $membership
                ->where('status', $status)
                ->sum($sum_column);
        }
        return [];
    }

    public function getAllData($obj_or_id, $paginateOrSelect = ['*'], $with_expire = false){
        $membership = $this->getUserMembership($obj_or_id);

        $data  = CustomHelper::getOrPaginate($paginateOrSelect);
        $getOrPaginate = $data->getOrPaginate;
        $perPage        = $data->perPage;

        if($membership){
            if($with_expire){
                return $membership->where('expire', '>=', date('Y-m-d', strtotime("now")))->$getOrPaginate($perPage);
            }
            return $membership->$getOrPaginate($perPage);
        }
        return [];
    }

    public function getDataByStatus($obj_or_id, $column, $status = 1, $with_expire = true, $order = 'desc'){
        $membership = $this->getUserMembership($obj_or_id);
        if($membership) {
            $bids = $membership
                ->where($column, '>', 0)
                ->where('expire', '>=', date('Y-m-d', strtotime("now")))->where('status', $status)
                ->orderBy('created_at', $order)
                ->get();
            if($with_expire == false){
                $bids = $membership->where($column, '>', 0)->where('status', $status)->get();
            }
            return $bids;
        }
        return [];
    }

    public function useMembershipData($obj_or_id, $column, $decrement = 1){
        $purchaseData = $this->getDataByStatus($obj_or_id, $column,MembershipStatus::Active);
        $lastData = 0;
        if(count($purchaseData) > 0){
            foreach ($purchaseData as $key => $purchase){
                $membership = $this->getUserMembership($obj_or_id);
                if($purchase->$column >= $decrement){
                    $lastData = $purchase->$column;
                    $purchase->$column = $purchase->$column - $decrement;
                    $membership->where('id', $purchase->id)->update($purchase->only([$column]));
                    break;
                }
            }
        }
        $data = collect(['purchaseData' => $purchaseData, 'LastData' => $lastData]);
        return $data;
    }

}
