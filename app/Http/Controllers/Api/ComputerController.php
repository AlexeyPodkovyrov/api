<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComputerController extends Controller
{
    private function prepareSelect()
    {
        return $computers = Computer::with([
            'processors' => function ($query) {
                $query->select('id', 'computer_id', 'name', 'manufacturer', 'description', 'number_of_cores');
            },
			'motherboards' => function ($query) {
                $query->select('id', 'computer_id', 'name', 'manufacturer');
            },
            'memories' => function ($query) {
                $query->select('id', 'computer_id', 'size', 'speed');
            },
			'videocards' => function ($query) {
                $query->select('id', 'computer_id', 'name', 'memory', 'driver_version');
            },  
			'storages' => function ($query) {
                $query->select('id', 'computer_id', 'serial_number', 'model_id', 'version', 'interface_type', 'size', 'logical_disk', 'file_system', 'logical_disk_size', 'logical_disk_free_space');
            },
            'monitors' => function ($query) {
                $query->select('id', 'computer_id', 'name', 'manufacturer', 'refresh_rate', 'max_resolution');
            },           
            'bios' => function ($query) {
                $query->select('id', 'computer_id', 'description', 'manufacturer', 'version', 'smbios_version');
            },                    
        ])
            ->select(['id', 'type', 'name', 'user_name', 'operating_system', 'service_pack', 'created_at']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        // $computers = Computer::with(['processors', 'memories', 'monitors', 'storages', 'bios', 'vidoecards', 'motherboards'])->get();

        $query = $this->prepareSelect();
        $computers = $query->get();

        /*$computers = Computer::with([
            'processors' => function ($query) {
                $query->select('computer_id', 'name', 'manufacturer');
            },
            'memories' => function ($query) {
                $query->select('computer_id', 'size', 'speed');
            },
            'monitors' => function ($query) {
                $query->select('computer_id', 'manufacturer');
            },
            'storages' => function ($query) {
                $query->select('computer_id', 'version', 'size');
            },
            'bios' => function ($query) {
                $query->select('computer_id', 'version');
            },
            'vidoecards' => function ($query) {
                $query->select('computer_id', 'name', 'memory');
            },
            'motherboards' => function ($query) {
                $query->select('computer_id', 'name', 'manufacturer');
            },
        ])
            ->select(['id', 'name', 'user_name'])*/



        //$computers = Computer::with(['processors'])->get();
        //  $result = [];
        /* foreach ($computers as $computer) {
             $processors = [];
             foreach ($computer->processors as $processor) {
                 $processors[] = [
                     'id' => $processor->id,
                     'manufacturer' => $processor->manufacturer
                 ];
             }
             $result[] = [
                 'name' => $computer->name,
                 'procs' => $processors
             ];
         }*/


        return response()->json($computers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function show(Request $request, Computer $computer)
    {
        return response()->json($this->prepareSelect()->where('id', $computer->id)->first());
    }
}
