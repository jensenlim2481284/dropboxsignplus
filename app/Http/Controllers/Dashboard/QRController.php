<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Qr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Exports\QRExport;
use Maatwebsite\Excel\Facades\Excel;

class QRController extends Controller
{

	# Index page
    public function index(Request $request){

		# Fitler		
		$records = new QR;      
		if($searchQuery = $request->input('query'))
			$records = $records->where(function ($query) use ($searchQuery) {
                $query->where('url', 'like', "%$searchQuery%");
            });
        $records = $records->orderBy('created_at','DESC')->paginate(30);
        
        return view('pages.dashboard.qr',compact('records'));
       
    }


    # Get QR info
    public function get($id)
    {
        $QR =  QR::findOrFail($id);
        return  $QR;         
    }


	# Create or Update QR
    public function createOrUpdate(Request $request){
    
        # 1 : Check if edit QR
        if($request->editID)
        {
            # 1.1 : Get data 
            $QR = QR::findOrFail( $request->editID );                

            # 1.2 : Delete previous attachment 
            if($request->QR_document){
                Storage::delete($QR->image);
    
                # 1.3 : Upload image 
                $path = $request->file('QR_document')->store('public/images');
                $request->merge(['image' => $path]);
            }

            # 1.4 : Update data 
            $QR->update($request->except('editID','QR_document'));

            return back()->with(['success' => translate('QR_updated','QR Updated')]);
        }
        # 2 :  if create QR
        else 
        {

            # Create QR
            $qrCode = QR::create($request->only(['pin','title','desc']));
            $encrypted_uid = $qrCode->encrypted_uid;
            $pythonScriptPath = 'python\qrGenerate.py '.$encrypted_uid . ' ' . $request->pattern;
            exec("py $pythonScriptPath 2>&1", $output, $returnCode);
            if ($returnCode !== 0) {
                dd($output);
            }
            return back()->with('success', translate('QR_created','QR Created'));

        }

    }


	# Delete QR 
    public function delete(Request $request){

        $QR = QR::findOrFail($request->deleteID);    
        $QR->delete();
        return back()->with( ['success' => translate('QR_deleted','QR deleted')]);

    }



    # Function to export record to excel
    public function export(){
        $response =  Excel::download(new QRExport(), 'QRList.xlsx',  \Maatwebsite\Excel\Excel::XLSX);   
        ob_end_clean();
        return $response;
    }

    
    
}
