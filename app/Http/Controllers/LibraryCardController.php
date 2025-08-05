<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LibraryCard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LibraryCardController extends Controller
{
    public function index()
    {
        $libraryCards = LibraryCard::with('user')->get();
        return view('library_cards.index', compact('libraryCards'));
    }

    public function create()
    {
        $users = User::doesntHave('libraryCard')->get(); // Hanya user tanpa kartu
        return view('library_cards.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barcode' => 'required|unique:library_cards',
            'rfid_code' => 'required|unique:library_cards',
            'status' => 'required|in:active,inactive'
        ]);

        LibraryCard::create($request->all());

        return redirect()->route('library_cards.index')->with('success', 'Kartu perpustakaan berhasil dibuat');
    }

    public function edit(LibraryCard $libraryCard)
    {
        return view('library_cards.edit', compact('libraryCard'));
    }

    public function update(Request $request, LibraryCard $libraryCard)
    {
        $request->validate([
            'barcode' => 'required|unique:library_cards,barcode,' . $libraryCard->id,
            'rfid_code' => 'required|unique:library_cards,rfid_code,' . $libraryCard->id,
            'status' => 'required|in:active,inactive'
        ]);

        $libraryCard->update($request->all());

        return redirect()->route('library_cards.index')->with('success', 'Data kartu diperbarui');
    }

    public function destroy(LibraryCard $libraryCard)
    {
        $libraryCard->delete();
        return redirect()->route('library_cards.index')->with('success', 'Kartu perpustakaan dihapus');
    }

    public function printCard()
    {
        $user = Auth::user();

        if (!$user->libraryCard) {
            return redirect()->back()->with('error', 'Anda belum memiliki kartu perpustakaan.');
        }

        // Generate QR Code
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($user->libraryCard->barcode));

        $pdf = Pdf::loadView('library_card.print', compact('user', 'qrCode'))->setPaper('credit-card', 'landscape');

        return $pdf->stream('Kartu Perpustakaan - ' . $user->name . '.pdf');
    }
}