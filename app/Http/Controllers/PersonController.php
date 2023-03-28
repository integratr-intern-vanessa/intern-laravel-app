<?php

namespace App\Http\Controllers;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::all();

        return response()->json($persons, 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $payload = $this->payload($request);

            $payload = Person::create($payload);

            return response()->json($payload, 200);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::where('id', $id)->first();

        return response()->json($person, 200);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = $this->payload($request);

        $person = Person::where('id', $id)->first();

        $person->update($payload);

        return response()->json($person, 200);


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $person = Person::where('id', $id)->first();
        $person->delete();
        return response('', 204);

        //
    }
    public function payload($request)
{
    return $this->validate($request, [
        'name' => ['required'],
        'gender' => ['required', Rule::in(['Male', 'Female'])],
        'place_of_birth'=> ['required'],
        'birthday' => ['required', 'date']

    ]);

}
}
