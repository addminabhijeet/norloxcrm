<?php
// app/Http/Controllers/GoogleSheetController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleSheetData;
use Google\Client;
use Google\Service\Sheets;

class GoogleSheetController extends Controller
{
    protected function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setAccessType('offline');

        return $client;
    }

    public function index()
    {
        $data = GoogleSheetData::all();
        return view('google_sheet.index', compact('data'));
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'sheet_link' => 'required|url'
        ]);

        // Extract spreadsheetId from URL
        preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $request->sheet_link, $matches);
        $spreadsheetId = $matches[1] ?? null;

        if (!$spreadsheetId) {
            return back()->withErrors(['sheet_link' => 'Invalid Google Sheet link']);
        }

        $client = $this->getClient();
        $service = new Sheets($client);
        $range = 'Sheet1!A:C'; // Change if your sheet has a different range

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if ($values) {
            $rowIndex = 2; // Assuming first row is header
            foreach ($values as $row) {
                GoogleSheetData::updateOrCreate(
                    ['email' => $row[1] ?? null],
                    [
                        'name' => $row[0] ?? null,
                        'phone' => $row[2] ?? null,
                        'sheet_row_number' => $rowIndex
                    ]
                );
                $rowIndex++;
            }
        }

        return redirect()->route('google.sheet.index')->with('success', 'Data fetched successfully!');
    }

    public function update(Request $request, $id)
    {
        $row = GoogleSheetData::findOrFail($id);
        $row->update($request->only(['name','email','phone']));

        // Update Google Sheet
        $client = $this->getClient();
        $service = new Sheets($client);

        $spreadsheetId = 'YOUR_SPREADSHEET_ID'; // Optionally store in DB or session
        $rowNumber = $row->sheet_row_number;
        $range = "Sheet1!A{$rowNumber}:C{$rowNumber}"; // Adjust columns as needed

        $values = [
            [
                $row->name,
                $row->email,
                $row->phone
            ]
        ];

        $body = new \Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

        return response()->json(['success' => true]);
    }

}
