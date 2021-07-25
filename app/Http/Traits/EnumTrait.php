<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait EnumTrait {

    /**
     * Fetches all enum options
     *
     * @param String $table
     * @param String $col
     * @return Array
     */
    public static function fetchValues($table, $col) {
        $type = DB::select(
            DB::raw('SHOW COLUMNS FROM '. $table .' WHERE Field = "'. $col .'"')
        )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}