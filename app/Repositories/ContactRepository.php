<?php

namespace App\Repositories;

use App\Models\Contact;

use Carbon\Carbon;

class ContactRepository
{

    public function create($request)
    {
        try {
            return Contact::create($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findAll($request)
    {
        $query = Contact::query();


        if ($request->has('started_date') && !$request->has('ended_date')) {
            $query->where(
                'created_at',
                '>=',
                Carbon::parse($request->started_date)->startOfDay()
            );
        } elseif (!$request->has('started_date') && $request->has('ended_date')) {
            $query->where(
                'created_at',
                '<=',
                Carbon::parse($request->ended_date)->endOfDay()
            );
        } elseif ($request->has('started_date') && $request->has('ended_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->started_date)->startOfDay(),
                Carbon::parse($request->ended_date)->endOfDay(),
            ]);
        }

        if ($request->has('isHandle')) {
            $query->where('isHandle', $request->isHandle);
        }

        if ($request->has('name')) {
            $query->where('name', 'like', $request->name . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', $request->email . '%');
        }

        return $query->orderBy('id', 'desc')->paginate(20)->appends($request->query());
    }

    /**
     * @return bool
     */
    public function update($contact, $request)
    {
        try {

            Contact::where('id', $contact->id)->update($request);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

