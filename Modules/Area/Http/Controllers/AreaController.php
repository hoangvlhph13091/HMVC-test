<?php

namespace Modules\Area\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Area\Entities\Area;
use Modules\Area\Http\Requests\AreaRequest;
use Modules\Area\Http\Requests\AreaEditRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        $searchValue = $request->searchValue ? $request->searchValue : '';
        $areas = Area::where('book_area_name','like',"%$searchValue%")->orderBy($sortType, $order)->paginate(5);

        return view('area::index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        return view('area::createArea');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(AreaRequest $request)
    {
        $data = $request->except('_token');

        $Area = new Area();

        $Area->fill($data);

        $Area->save();

        return $Area->fresh();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editForm($id)
    {
        $area = Area::Where('id', $id)->first();

        return view('area::editArea', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $data = $request->except('_token');

        $area = Area::Where('id', $id)->first();

        $area->fill($data);

        $area->save();

        return $area->fresh();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Area::destroy($id);
        return redirect(route('area'));
    }
}
