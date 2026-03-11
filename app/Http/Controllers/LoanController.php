<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();

        return response()->json([
            'message' => 'Liste des emprunts',
            'data' => $loans
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string',
            'borrower_email' => 'required|email',
            'book_title' => 'required|string',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date'
        ]);

        $loan = Loan::create($validated);

        return response()->json([
            'message' => 'Emprunt créé avec succès',
            'data' => $loan
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Emprunt non trouvé',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Emprunt trouvé',
            'data' => $loan
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Emprunt non trouvé',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'borrower_name' => 'required|string',
            'borrower_email' => 'required|email',
            'book_title' => 'required|string',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date'
        ]);

        $loan->update($validated);

        return response()->json([
            'message' => 'Emprunt mis à jour',
            'data' => $loan
        ], 200);
    }
    public function returnBook($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Emprunt non trouvé',
                'data' => null
            ], 404);
        }

        $loan->update([
            'returned' => true,
            'status' => 'returned'
        ]);

        return response()->json([
            'message' => 'Livre marqué comme rendu',
            'data' => $loan
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Emprunt non trouvé',
                'data' => null
            ], 404);
        }

        $loan->delete();

        return response()->json([
            'message' => 'Emprunt supprimé',
            'data' => null
        ], 204);
    }
}
