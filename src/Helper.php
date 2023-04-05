<?php
namespace Codelife\CodelifeHelpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class Helper {
    protected $model;
    protected ?string $activity;
    protected ?int $user_id;
    const table = 'activity_logs';

    // new Helper(new Todos);
    // new Helper(new Todos, 'Sample Log');
    // Above are sample usage, second parameter is optional
    public function __construct($model, ?string $activity = null){
        $this->model = $model;
        $this->activity = $activity;
        $this->user_id = $this->getCurrentUser();
        $this->setActivityLog($this->model, $this->activity, $this->user_id);
    }

    private function setActivityLog($model, ?string $activity, ?int $user_id): void{
        DB::table(self::table)->insert([
            'user_id' => $user_id,
            'table' => ucfirst($model->getTable()),
            'activity' => $activity == null ? 'A '.request()->getMethod().' has been made.' : $activity,
            'json_data' => json_encode($model->getAttributes(), JSON_PRETTY_PRINT)
        ]);
    }

    private function getCurrentUser(): ?int{
        return (Auth::check())
                ? Auth::user()->id
                : null;
    }

    // function for getting data
    // return Helper::getAllActivityLogs()->getData(); if request wants json
    // Helper::getAllActivityLogs(); if not
    public static function getAllActivityLogs(){
        $data = DB::select("SELECT * FROM ".self::table);
        if($data){
            return (request()->wantsJson())
                    ? new JsonResponse(['data' => $data], 204)
                    : $data;
        }

    }

    // function for getting data
    // Helper::setTableEmpty(); if not
    public static function setTableEmpty(){
        $response = DB::table(self::table)->truncate();
        return ($response)
                ? false
                : true;
    }

}

// public functions are hereby initialized
interface HelperBlueprint {
    public static function getAllActivityLogs();
    public function setTableEmpty();
}
