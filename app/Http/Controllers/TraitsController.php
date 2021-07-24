<?php

namespace App\Http\Controllers;

use App\Http\Resources\TraitResource;
use App\Models\Character;
use App\Models\CharTrait;
use Illuminate\Http\Request;

class TraitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traits = CharTrait::all();
        return response()->json([
            'data'      => TraitResource::collection($traits),
            'message'   => 'Successfully fetched all traits'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a new pivot entry for traits on a character
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object) $request->all();
        $data_payload = (object) $data->payload;

        $char = Character::whereId($data_payload->char_id)->first();
        $existing_traits = $char->traits;

        $array_traits = [];
        $array_trait_ids = [];
        foreach($data_payload->traits as $trait_groups) {
            foreach ($trait_groups as $item) {
                $array_traits[] = CharTrait::whereId($item['id'])->first();
                $array_trait_ids[] = CharTrait::whereId($item['id'])->first()->id;
            }
        }

        $existing_ids = [];
        foreach($existing_traits as $trait) {
            $existing_ids[] = $trait->id;
        }

        $results = array_diff($existing_ids, $array_trait_ids);
        foreach($results as $result) {
            if (!in_array($result, $array_trait_ids)) {
                $char->traits()->detach($result);
            }
        }
        
        foreach ($array_traits as $trait) {            
            $trait->characters()->syncWithoutDetaching((integer) $data_payload->char_id);
        }

        return response()->json([
            'data'      => $data_payload->traits,
            'message'   => 'Successfully added new trait on character'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CharTrait  $charTrait
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trait = CharTrait::whereId($id)->get();
        return response()->json([
            'data'      => TraitResource::collection($trait),
            'message'   => 'Successfully fetched specified character'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CharTrait  $charTrait
     * @return \Illuminate\Http\Response
     */
    public function edit(CharTrait $charTrait)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CharTrait  $charTrait
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CharTrait $charTrait)
    {
        //
        $input = $request->all();
        $charTrait->fill($input)->save();
        return response()->json([
            'data'      => $charTrait,
            'messgae'   => 'Successfully updated trait' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CharTrait  $charTrait
     * @return \Illuminate\Http\Response
     */
    public function destroy(CharTrait $charTrait)
    {
        //
        $charTrait->delete();
        return response()->json([
            'data'      => TraitResource::collection($charTrait),
            'message'   => 'Successfully deleted trait record'
        ]);
    }
}
