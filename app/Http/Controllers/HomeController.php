<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Session\Store as Session;

use App\Purchase;
use App\Sales;


use Phelium\Component\MySQLBackup;

class HomeController extends Controller {

	public function getStockTable(Request $request){
		$date = $request->get('date');
		$return = '';
		
		if($request->ajax()){
			$purchase = Purchase::where('date',$date)->get();
			$sales = Sales::where('date',$date)->get();
			$i=1;
			$totalPurchase = 0;
			$totalSales = 0;

			foreach($purchase as $pur){
				$particular_name = App\Particular::where('status',0)->where('id',$pur->particular_id)->first()->particular_name;
				$totalPurchase += $pur->quantity;
				return $totalPurchase;
				if($sales != ''){
					foreach($sales as $s){
						$totalSales += $s->quantity;
					}
				}else{
					$totalSales = 0;
				}	
				$return .= '<tr>';
				$return .= '<td>'.$i++.'</td>';
				$return .= '<td>'.$date.'</td>';
				$return .= '<td>'.$particular_name.'</td>';
				$return .= '<td>'.$totalPurchase.'</td>';
				$return .= '<td>'.$totalSales.'</td>';
				$return .= '<td>'.$totalPurchase-$totalSales.'</td>';
				$return .= '</tr>';
			}
			return $return;
		}
		return false;
	}
	
	
	public function backup(){		
		$Dump = new MySQLBackup('localhost', 'root', '', 'accounting');
		$Dump->setCompress('zip')->setFilename('accounting-'.date('Y-m-d'))->setDownload(true)->dump(); // starts downloading
	}
}
