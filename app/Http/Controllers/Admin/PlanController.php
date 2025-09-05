<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Artisan;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
//  public function __construct()
//   {
//     $this->middleware( 'auth' );
//   }

	public function kannan() {

		$globalregainsssar = DB::table('global_regain')
			->where('plan_id', 1)
			->where('status', 0)
			->orderby('id','ASC')
			->first();

		$globalregain = DB::table('global_regain')
			->where('plan_id', 1)
			->where('status', 0)
			->where('from_id', $globalregainsssar->to_id)
			->orderby('id','DESC')
			->count();

		$parentId = $globalregainsssar->to_id;

		if($globalregain == 3) {
			DB::table('global_regain')->insert([
				'plan_id'        => 1,
				'from_id'        => $parentId,
				'to_id'          => 7,
				'level'          => 1,
				'pay_reason_id'  => 2,
				'amount'         => 5,
				'payment_status' => 1,
				'message'        => 'Global Regain',
				'user_type_id'   => 3,
				'log_id'         => auth()->id(),
				'created_at'     => now(),
			]);
			
			DB::table('global_regain')->where('to_id',$parentId)->update([
				'status'        => 1,
			]);
			
		} else {

			DB::table('global_regain')->insert([
				'plan_id'        => 1,
				'from_id'        => $parentId,
				'to_id'          => 7,
				'level'          => 1,
				'pay_reason_id'  => 2,
				'amount'         => 5,
				'payment_status' => 1,
				'message'        => 'Global Regain',
				'user_type_id'   => 3,
				'log_id'         => auth()->id(),
				'created_at'     => now(),
			]);
		}
	}

public function kannanaaaaa() {

    $globalregainsssar = DB::table('global_regain')
    ->where('plan_id', 1)
    ->where('status', 0)
    ->orderby('id','DESC')
    ->first();

    $globalregainsss = DB::table('global_regain')
    ->where('plan_id', 1)
    ->where('status', 0)
    ->where('from_id', $globalregainsssar->to_id)
    ->orderby('id','ASC')
    ->first();
            
    $globalregain = DB::table('global_regain')
                    ->where('plan_id', 1)
                    ->where('status', 0)
                    // ->where('from_id', $parentId)
                    ->orderby('id','ASC')
                    ->count();

                   
                    if($globalregain < 3) {

                        
    
        $parentId =  2;

                        DB::table('global_regain')->insert([
                            'plan_id'        => 1,
                            'from_id'        => $parentId,
                            'to_id'          => 7,
                            'level'          => 1,
                            'pay_reason_id'  => 2,
                            'amount'         => 5,
                            'payment_status' => 1,
                            'message'        => 'Global Regain',
                            'user_type_id'   => 3,
                            'log_id'         => auth()->id(),
                            'created_at'     => now(),
                        ]);
                    } else {

                        $parentId = $globalregainsss->to_id;

                        DB::table('global_regain')->insert([
                            'plan_id'        => 1,
                            'from_id'        => $parentId,
                            'to_id'          => 7,
                            'level'          => 1,
                            'pay_reason_id'  => 2,
                            'amount'         => 5,
                            'payment_status' => 1,
                            'message'        => 'Global Regain',
                            'user_type_id'   => 3,
                            'log_id'         => auth()->id(),
                            'created_at'     => now(),
                        ]);

                        DB::table('global_regain')->where('to_id',$parentId)->update([
                            'status'        => 1,
                        ]);

                    }
                
}

  public function userActivatePlan()
  {
    $userId = auth()->id();

    $plans = DB::table('plans')->where('status', 1)->orderBy('id', 'ASC')->get();

    $userPlans = DB::table('user_plan')->where('user_id', $userId)->pluck('plan_id')->toArray();

    $nextPlanId = null;
    foreach ($plans as $plan) {
        if (!in_array($plan->id, $userPlans)) {
            $nextPlanId = $plan->id;
            break;
        }
    }

    return view("admin.plan.activate_plan", compact('plans', 'userPlans', 'nextPlanId'));
  }


    public function plans(){
        $plan = DB::table('plans')->where('status',1)->get();
        return view("admin.plan.plans", compact('plan'));
    }

    public function addplan( Request $request ) {

      $planid = DB::table( 'plans' )->insertGetId([
        
          'plan_name'         => $request->plan_name,
          'plan_amount'       => $request->plan_amount,
          'sponser_amount'    => $request->sponser_amount,
          'level_amount'      => $request->level_amount,
          'upline_amount'     => $request->upline_amount,
          'regain_amount'     => $request->regain_amount,
          'shib_coin'         => $request->shib_coin,
          'pepe_coin'         => $request->pepe_coin,
          'bonk_coin'         => $request->bonk_coin,
          'floki_coin'        => $request->floki_coin,
          'btt_coin'          => $request->btt_coin,
          'baby_doge_coin'    => $request->baby_doge_coin,
          'tfc_coin'          => $request->tfc_coin,
          'status'            => 1,
          'created_at'        => now(),
      ]);

      DB::table( 'user_plan' )->insert([
          'plan_id'           => $planid,
          'user_id'           => 1,
          'amount'       => $request->plan_amount,
          'created_by'        => auth()->user()->id,
          'created_at'        => now(),
      ]);

      return redirect()->back()->with( 'success', 'Plan Added Successfully ... !' );
  }

  public function editplan( Request $request ) {

    DB::table( 'plans' )->where('id',$request->id)->update( [
        'plan_name'         => $request->plan_name,
        'plan_amount'       => $request->plan_amount,
        'sponser_amount'    => $request->sponser_amount,
        'level_amount'      => $request->level_amount,
        'upline_amount'     => $request->upline_amount,
        'regain_amount'     => $request->regain_amount,
        'shib_coin'         => $request->shib_coin,
		'pepe_coin'         => $request->pepe_coin,
		'bonk_coin'         => $request->bonk_coin,
		'floki_coin'        => $request->floki_coin,
		'btt_coin'          => $request->btt_coin,
		'baby_doge_coin'    => $request->baby_doge_coin,
		'tfc_coin'          => $request->tfc_coin,
        'status'            => $request->status,
        'updated_at'        => now(),
    ] );

    return redirect()->back()->with( 'success', 'Plan Updated Successfully ... !' );
  }

  public function plan_payment($id, $userId){
    $plan = DB::table('plans')->where('id',$id)->where('status',1)->first();
    $adminwallet = DB::table('users')->where('id', 1)->first();
    $redata = DB::table('users')->where('id', $userId)->first();
    $refwallet = DB::table('users')->where('id', $redata->referral_id)->first();

    return view("admin.plan.plan_payment", compact('plan', 'userId', 'refwallet', 'adminwallet'));
  }


  public function send_push_notification($userid, $title,$body)
  {
      $user = DB::table('users')->where('id',$userid)->first();
      $fcmToken = $user->fcm_token;
      // Load the service account JSON file
      $credentialsPath = env('FIREBASE_CREDENTIALS');

      // Authenticate with Google API
      $client = new \Google\Client();
      $client->setAuthConfig($credentialsPath);
      $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
      $client->useApplicationDefaultCredentials();

      // Get OAuth2 access token
      $token = $client->fetchAccessTokenWithAssertion()['access_token'];

      // Get your Firebase project ID
      $projectId = env('FIREBASE_PROJECT_ID'); // Replace this

      // Build the message payload
      $payload = [
          'message' => [
              'token' => $fcmToken,
              'notification' => [
                  'title' => $title,
                  'body' => $body,
              ],
              'data' => [
                  'customKey1' => 'value1',
                  'customKey2' => 'value2'
              ],
          ]
      ];

      // Send the message using FCM v1 endpoint
      $response = Http::withToken($token)->post(
          "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
          $payload
      );

      return response()->json([
          'status' => $response->status(),
          'response' => $response->json()
      ]);
  }

  public function save_fcm_token(Request $request)
  {
      $request->validate([
          'token' => 'required|string'
      ]);

      $user = DB::table('users')->where('id',auth()->user()->id)->update([
          'fcm_token' => $request->token,
      ]);

      return response()->json(['message' => 'Token saved successfully']);
  }


  public function manual_activation($userID){

    $plans = DB::table('plans')->where('status', 1)->orderBy('id', 'ASC')->get();
    $user = DB::table('users')->where('id',$userID)->get();  
    $userPlans = DB::table('user_plan')->where('user_id', $userID)->pluck('plan_id')->toArray();

    $nextPlanId = null;
    foreach ($plans as $plan) {
        if (!in_array($plan->id, $userPlans)) {
            $nextPlanId = $plan->id;
            break;
        }
    }

    return view("admin.plan.manual_activate_plan", compact('plans', 'userPlans', 'nextPlanId', 'userID' ,'user'));
  }


  public function transaction_history(Request $request)
  {
      try {
          $userId   = $request->user_id;
          $amount   = $request->amount;
          $planId   = $request->plan_id;
          $admin    = $request->admin;
          $referral = $request->referral;
  
          $existing = DB::table('transaction_history')
              ->where('user_id', $userId)
              ->where('plan_id', $planId)
              ->first();
  
          if ($existing) {
              // Update existing record
              DB::table('transaction_history')
                  ->where('id', $existing->id)
                  ->update([
                      'referral'   => $referral,
                  ]);
          } else {
              // Insert new record
              DB::table('transaction_history')->insert([
                  'plan_id'    => $planId,
                  'user_id'    => $userId,
                  'amount'     => $amount,
                  'admin'      => $admin,
                  'referral'   => $referral,
                  'created_at' => now(),
              ]);
          }
  
          return response()->json(['success' => true]);
      } catch (\Exception $e) {
          return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
      }
  }
  

  public static function storeSponserPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('sponser_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);

     if($type == 'Rebirth'){
          $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
         $upgradeBalance = ($upgrade ?? 0) + $amount;
         DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
             'updated_at' => now(),
         ]);
     }
  }


  public static function storeLevelPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('level_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);

    if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $toId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
    }

    if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $toId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
    }

    if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
    }

    if($type == 'RebirthSplitMainTravel3'){
        $travel_international_tour = DB::table('users')->where('id', $toId)->value('travel_international_tour');
        $tintBalance = ($travel_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_international_tour'  => $tintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel4'){
        $travel_national_tour = DB::table('users')->where('id', $toId)->value('travel_national_tour');
        $tnatBalance = ($travel_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_national_tour'  => $tnatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel5'){
        $travel_local_tour = DB::table('users')->where('id', $toId)->value('travel_local_tour');
        $tlocBalance = ($travel_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_local_tour'  => $tlocBalance,
            'updated_at' => now(),
        ]);
      }
    

  }

  public static function storeUplinePayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id)
  {
    DB::table('upline_income')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
    ]);


      if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $toId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $toId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $toId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel3'){
        $travel_international_tour = DB::table('users')->where('id', $toId)->value('travel_international_tour');
        $tintBalance = ($travel_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_international_tour'  => $tintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel4'){
        $travel_national_tour = DB::table('users')->where('id', $toId)->value('travel_national_tour');
        $tnatBalance = ($travel_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_national_tour'  => $tnatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel5'){
        $travel_local_tour = DB::table('users')->where('id', $toId)->value('travel_local_tour');
        $tlocBalance = ($travel_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $toId)->update([
            'travel_local_tour'  => $tlocBalance,
            'updated_at' => now(),
        ]);
      }
  }

  public static function storeGlobalPayment($type, $planId, $fromId, $toId, $level, $reasonId, $amount, $paymentStatus, $message, $user_type_id, $gbAmount)
  {
    DB::table('global_regain')->insert([
        'plan_id'        => $planId,
        'from_id'        => $fromId,
        'to_id'          => $toId,
        'level'          => $level,
        'pay_reason_id'  => $reasonId,
        'amount'         => $amount,
        'payment_status' => $paymentStatus,
        'message'        => $message,
        'user_type_id'   => $user_type_id,
        'log_id'         => auth()->id(),
        'created_at'     => now(),
        'global_regain_amount' => $gbAmount
    ]);

    if($type == 'PlanTree'){
        $global_rebirth_amount = DB::table('users')->where('id', $fromId)->value('global_rebirth_amount');
        $rebBalance = ($global_rebirth_amount ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'global_rebirth_amount'  => $rebBalance,
            'global_id'  => $fromId,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain'){
        $travel_amount = DB::table('users')->where('id', $fromId)->value('travel_amount');
        $travelBalance = ($travel_amount ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'travel_amount'  => $travelBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain1'){
        $travel_allownace = DB::table('users')->where('id', $fromId)->value('travel_allownace');
        $travelalloBalance = ($travel_allownace ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'travel_allownace'  => $travelalloBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMain2'){
        $upgrade = DB::table('users')->where('id', $fromId)->value('upgrade');
        $upgradeBalance = ($upgrade ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'upgrade'  => $upgradeBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel'){
        $ta_international_tour = DB::table('users')->where('id', $fromId)->value('ta_international_tour');
        $taintBalance = ($ta_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'ta_international_tour'  => $taintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel1'){
        $ta_national_tour = DB::table('users')->where('id', $fromId)->value('ta_national_tour');
        $tanatBalance = ($ta_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'ta_national_tour'  => $tanatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel2'){
        $ta_local_tour = DB::table('users')->where('id', $fromId)->value('ta_local_tour');
        $talocBalance = ($ta_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'ta_local_tour'  => $talocBalance,
            'updated_at' => now(),
        ]);
      }
      if($type == 'RebirthSplitMainTravel3'){
        $travel_international_tour = DB::table('users')->where('id', $fromId)->value('travel_international_tour');
        $tintBalance = ($travel_international_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'travel_international_tour'  => $tintBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel4'){
        $travel_national_tour = DB::table('users')->where('id', $fromId)->value('travel_national_tour');
        $tnatBalance = ($travel_national_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'travel_national_tour'  => $tnatBalance,
            'updated_at' => now(),
        ]);
      }

      if($type == 'RebirthSplitMainTravel5'){
        $travel_local_tour = DB::table('users')->where('id', $fromId)->value('travel_local_tour');
        $tlocBalance = ($travel_local_tour ?? 0) + $amount;
        DB::table('users')->where('id', $fromId)->update([
            'travel_local_tour'  => $tlocBalance,
            'updated_at' => now(),
        ]);
      }
    
  }


  /**
   * Get the N-th level upline dynamically
   */
  private function getUpline($user, $level)
  {
    $current = $user;
    for ($i = 1; $i <= $level; $i++) {
        if (empty($current->referral_id)) {
            return null; // no more uplines
        }
        $current = DB::table('users')->where('id', $current->referral_id)->first();
    }
    return $current->id ?? null;
  }

  
    public function activatePlanPayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
            'user_id' => 'required|integer',
            'amount'  => 'required|numeric',
        ]);

        $userId = $request->user_id;
        $amount = $request->amount;
        $planId = $request->plan_id;
        $upgrade = $request->upgrade;
        $upgrade_status = $request->upgrade_status;
        $levels = 10;

        return DB::transaction(function () use ($userId, $amount, $planId, $levels, $upgrade, $upgrade_status) {

            // Store the activated plan (capture id for ordering if needed)
            DB::table('user_plan')->insert([
                'plan_id'    => $planId,
                'user_id'    => $userId,
                'amount'     => $amount,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            $planData = DB::table('plans')->where('id',$planId)->first();

            if($upgrade_status == 1){
                $totup = $upgrade - $planData->plan_amount;
                DB::table('users')->where('id', $userId)->update([
                    'upgrade'        => $totup,
                ]);
            }

            // Update user to latest plan
            DB::table('users')->where('id', $userId)->update([
                'plan_id'    => $planId,
                'status'     => 1,
                'updated_at' => now(),
            ]);
            
            // Get current user details
            $currentUser = DB::table('users')->where('id', $userId)->first();

            // Increment coins separately
            $shib_coin = ($currentUser->shib_coin ?? 0) + $planData->shib_coin;
            $bonk_coin = ($currentUser->bonk_coin ?? 0) + $planData->bonk_coin;
            $pepe_coin = ($currentUser->pepe_coin ?? 0) + $planData->pepe_coin;
            $floki_coin = ($currentUser->floki_coin ?? 0) + $planData->floki_coin;
            $btt_coin = ($currentUser->btt_coin ?? 0) + $planData->btt_coin;
            $tfc_coin = ($currentUser->tfc_coin ?? 0) + $planData->tfc_coin;
            $baby_doge_coin = ($currentUser->baby_doge_coin ?? 0) + $planData->baby_doge_coin;
            DB::table('users')->where('id', $userId)->update([
                'shib_coin' => $shib_coin,
                'bonk_coin' => $bonk_coin,
                'pepe_coin' => $pepe_coin,
                'floki_coin' => $floki_coin,
                'btt_coin' => $btt_coin,
                'tfc_coin' => $tfc_coin,
                'baby_doge_coin' => $baby_doge_coin,
            ]);

            // //////////////////////  1) Sponser Income //////////////////////////

                $refralupgradeCommission = ($amount * 5) / 100;
                $referrerCommission = ($amount * 50) / 100;
                $adminCommission    = ($amount * 5) / 100;

                // Self bonus
                $this->storeSponserPayment('Rebirth', $planId, $userId, $currentUser->referral_id, 1, '5', $refralupgradeCommission, 1, "Referal Upgrade Bonus",'3');

                //  Referrer bonus
                if (!empty($currentUser->referral_id)) {
                    $this->storeSponserPayment('RebirthIn', $planId, $userId, $currentUser->referral_id, 1, '1', $referrerCommission, 1, "Referral Sponser Income",'3');
                } else {
                    $this->storeSponserPayment('RebirthIn', $planId, $userId, 1, 1, '1', $referrerCommission, 1, "Referral Sponser Income (Admin)",'3');
                }

                // Admin bonus (set to 0 if you want ONLY the rotating 20% path)
                if ($adminCommission > 0) {
                    $this->storeSponserPayment('Rebirth', $planId, $userId, 1, 1, '8', $adminCommission, 1, "Admin Bonus Upgrade",'3');
                }


            // // /**
            // //  * 1. LEVEL COMMISSION (split into 10 levels equally)
            // //  */
                $commissionPerLevel = ($amount * $planData->level_amount) / 100;
                $comAmount = $commissionPerLevel / $levels;
                $referrerId = $currentUser->referral_id ?? null;
                for ($level = 1; $level <= $levels; $level++) {
                    if ($referrerId) {

                        $perc50 = ($comAmount * 50) / 100;
                        $perc30 = ($comAmount * 30) / 100;
                        $perc10 = ($comAmount * 10) / 100;

                        // $wallet = DB::table('users')->where('id', $referrerId)->value('wallet');
                        // $newBalance = ($wallet ?? 0) + $comAmount;
                        // DB::table('users')->where('id', $referrerId)->update([
                        //     'wallet'     => $newBalance,
                        //     'updated_at' => now(),
                        // ]);

                        $this->storeLevelPayment('Level', $planId, $userId, $referrerId, $level, '3', $comAmount, '1', "Level Income",'3');

                        $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, $referrerId, $level, '6',$perc30, 1, "Travel Amount Level",'3');
                        $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId,$referrerId,$level,'7',$perc50,1,"Travel Allowance",'3');
                        $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, $referrerId, $level, '5',$perc10, 1, "Upgrade Level",'3');
                        $this->storeLevelPayment('RebirthSplit',$planId,$userId, $referrerId, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'3');

                        $share15travels = ($perc30 * 15) / 100;
                        $share10travels = ($perc30 * 10) / 100;
                        $share5travels = ($perc30 * 5) / 100;
                
                        // Store travel-related payments
                        $this->storeLevelPayment('RebirthSplitMainTravel3',$planId,$userId,$referrerId,1,'12',$share15travels,1,"Travel International Tour",'3');
                        $this->storeLevelPayment('RebirthSplitMainTravel4',$planId,$userId,$referrerId,1,'13',$share10travels,1,"Travel National Tour",'3');
                        $this->storeLevelPayment('RebirthSplitMainTravel5',$planId,$userId,$referrerId,1,'14',$share5travels,1,"Travel Local Tour",'3');

                        $referrer = DB::table('users')->where('id', $referrerId)->first();
                        $referrerId = $referrer->referral_id ?? null;

                    } else {
                        // fallback to admin

                        $perc50 = ($comAmount * 50) / 100;
                        $perc30 = ($comAmount * 30) / 100;
                        $perc10 = ($comAmount * 10) / 100;

                        // $wallet = DB::table('users')->where('id', 1)->value('wallet');
                        // $newBalance = ($wallet ?? 0) + $comAmount;
                        // DB::table('users')->where('id', 1)->update([
                        //     'wallet'     => $newBalance,
                        //     'updated_at' => now(),
                        // ]);

                        $this->storeLevelPayment('Level', $planId, $userId, 1, $level, '3', $comAmount, '1', "Level Income",'3');

                        $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, 1, $level, '6',$perc30, 1, "Travel Amount Level",'3');
                        $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId, 1, $level,'7',$perc50,1,"Travel Allowance",'3');
                        $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, 1, $level, '5',$perc10, 1, "Upgrade Level",'3');
                        $this->storeLevelPayment('RebirthSplit',$planId,$userId, 1, $level, '8',$perc10, 1, "Admin 10% Level Upgrade",'3');

                        $share15travels = ($perc30 * 15) / 100;
                        $share10travels = ($perc30 * 10) / 100;
                        $share5travels = ($perc30 * 5) / 100;
                
                        // Store travel-related payments
                        $this->storeLevelPayment('RebirthSplitMainTravel3',$planId,$userId,1,1,'12',$share15travels,1,"Travel International Tour",'3');
                        $this->storeLevelPayment('RebirthSplitMainTravel4',$planId,$userId,1,1,'13',$share10travels,1,"Travel National Tour",'3');
                        $this->storeLevelPayment('RebirthSplitMainTravel5',$planId,$userId,1,1,'14',$share5travels,1,"Travel Local Tour",'3');

                    }
                }

            // // /**
            // //  * 4. UPLINE COMMISSION
            // //  */
                $commissionAmount = ($amount * $planData->upline_amount) / 100;
                $uplinerId = $this->getUpline($currentUser, $planId);

                if ($uplinerId) {
                    $hasPlan = DB::table('user_plan')
                        ->where('user_id', $uplinerId)
                        ->where('plan_id', $planId)
                        ->exists();

                    if (!$hasPlan) {
                        $uplinerId = 1; // admin fallback
                    }
                } else {
                    $uplinerId = 1; // admin fallback
                }

                $perca50 = ($commissionAmount * 50) / 100;
                $perca30 = ($commissionAmount * 30) / 100;
                $perca10 = ($commissionAmount * 10) / 100;

                //dd($perca50,$perca30,$perca10);

                $this->storeUplinePayment('Upline', $planId, $userId, $uplinerId, $planId, '4', $commissionAmount, 1, "Upline Sponser",'3');

                $this->storeUplinePayment('RebirthSplitMain',$planId,$userId, $uplinerId, $planId, '6',$perca30, 1, "Travel Amount Upline",'3');
                $this->storeUplinePayment('RebirthSplitMain1',$planId,$userId,$uplinerId,$planId,'7',$perca50,1,"Travel Allowance Upline",'3');
                $this->storeUplinePayment('RebirthSplitMain2',$planId,$userId, $uplinerId, $planId, '5',$perca10, 1, "Upline Sponser Income",'3');
                $this->storeUplinePayment('RebirthSplit',$planId,$userId, $uplinerId, $planId, '8',$perca10, 1, "Admin 10% Upline Upgrade",'3');

                $share15travel = ($perca30 * 15) / 100;
                $share10travel = ($perca30 * 10) / 100;
                $share5travel = ($perca30 * 5) / 100;

                $this->storeUplinePayment('RebirthSplitMainTravel3',$planId,$userId,$uplinerId,$planId,'12',$share15travel,1,"Travel International Tour Upline",'3');
                $this->storeUplinePayment('RebirthSplitMainTravel4',$planId,$userId,$uplinerId,$planId,'13',$share10travel,1,"Travel National Tour Upline",'3');
                $this->storeUplinePayment('RebirthSplitMainTravel5',$planId,$userId,$uplinerId,$planId,'14',$share5travel,1,"Travel Local Tour Upline",'3');


            // ////////////////////////////////// 2) Global Regain /////////////////////////////////
            // // . ===== NEW: Rotating 20% commission per plan (Admin -> #1 -> #2 ... per 20 purchases) =====

                $rotatingPercent = $planData->regain_amount; 
                $rotatingCommissionAmount = ($amount * $rotatingPercent) / 100;

                $globalregainsssar = DB::table('global_regain')
                ->where('plan_id', $planId)
                ->where('status', 0)
                ->where('pay_reason_id','2')
                ->orderby('id','ASC')
                ->first();

                $globalregain = DB::table('global_regain')
                    ->where('plan_id', $planId)
                    ->where('status', 0)
                    ->where('from_id', $globalregainsssar->to_id)
                    ->where('pay_reason_id','2')
                    ->count();

                $parentId = $globalregainsssar->to_id ;

                if($globalregain == 19) {

                    if($userId !='2'){
                        $this->storeGlobalPayment('PlanTree',$planId,$parentId,$userId,1,'2',$rotatingCommissionAmount,1,"Global regain Income",'3',0);
                    }

                    DB::table('global_regain')->where('plan_id',$planId)->where('to_id',$parentId)->update([
                        'status'        => 1,
                    ]);

                   
                        $total = ((($amount * 20) / 100) * 20) - $amount;
                    
                        // Calculate the splits
                        $share40 = ($total * 40) / 100;
                        $share30 = ($total * 30) / 100;
                        $share20 = ($total * 20) / 100;
                        $share10 = ($total * 10) / 100;
                
                        // Store the main rebirth splits
                        $this->storeGlobalPayment('RebirthSplitMain',$planId,$parentId,$userId,1,'6',$share40,1,"Travel Amount Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMain1',$planId,$parentId,$userId,1,'7',$share40,1,"Travel Allowance Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMain2',$planId,$parentId,$userId,1,'5',$share10,1,"Upgrade Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplit',$planId,$parentId,1,1,'8',$share10,1,"Admin 10% Global Rebirth Income",'3',1);
                
                        // Calculate travel splits
                        $share50travel = ($share40 * 50) / 100;
                        $share30travel = ($share30 * 30) / 100;
                        $share20travel = ($share20 * 10) / 100;
                
                        // Store travel-related payments
                        $this->storeGlobalPayment('RebirthSplitMainTravel3',$planId,$parentId,$userId,1,'12',$share50travel,1,"Travel International Tour Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMainTravel4',$planId,$parentId,$userId,1,'13',$share30travel,1,"Travel National Tour Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMainTravel5',$planId,$parentId,$userId,1,'14',$share20travel,1,"Travel Local Tour Global Rebirth Income",'3',1);
                
                        $this->storeGlobalPayment('RebirthSplitMainTravel',$planId,$parentId,$userId,1,'9',$share50travel,1,"Travel Allowance International Tour Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMainTravel1',$planId,$parentId,$userId,1,'10',$share30travel,1,"Travel Allowance National Tour Global Rebirth Income",'3',1);
                        $this->storeGlobalPayment('RebirthSplitMainTravel2',$planId,$parentId,$userId,1,'11',$share20travel,1,"Travel Local Tour Global Rebirth Income",'3',1);
                
                        // Reset beneficiary's global rebirth amount
                        $GBA = DB::table('users')->where('id', $parentId)->value('global_rebirth_amount');
                        $newBalance = $GBA - $amount;
                        DB::table('users')->where('id', $parentId)->update(['global_rebirth_amount' => $newBalance]);
                
                        $rebirthData = DB::table('users')->where('id', $parentId)->first();
                
                        if ($rebirthData) {

                            $latestId = DB::table('users')->max('id') ?? 0; 
                            $new = $latestId - 1; 
                            $newId = $new + 1001; 
                            $formattedId = str_pad($newId, 4, '0', STR_PAD_LEFT); 
                            $username = "TFC" . $formattedId;

                            if($planId == 1){
                                // Create new rebirth user
                                $newUId = DB::table('users')->insertGetId([
                                    'referral_id' => $parentId,
                                    'user_type_id' => 4,
                                    'plan_id' => $planId,
                                    'user_name' => $username,
                                    'name' => 'Global - Rebirth',
                                    'email' => $rebirthData->email,
                                    'phone' => $rebirthData->phone,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);

                                // Create rebirth plan entry
                                $rebirthPlan = DB::table('user_plan')->insert([
                                    'user_id' => $newUId,
                                    'plan_id' => $planId,
                                    'amount' => $amount,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => now(),
                                ]);

                                $this->repeatPlanPayment($newUId, $amount, $planId, $levels, $upgrade);

                            } else {

                                $rebirthUser = DB::table('users')->where('referral_id', $parentId)->where('user_type_id', 4)->first();

                                // Create rebirth plan entry
                                $rebirthPlan = DB::table('user_plan')->insert([
                                    'user_id' => $rebirthUser->id,
                                    'plan_id' => $planId,
                                    'amount' => $amount,
                                    'created_by' => auth()->user()->id,
                                    'created_at' => now(),
                                ]);

                                $this->repeatPlanPayment($rebirthUser->id, $amount, $planId, $levels, $upgrade);
                            }
                
                        }                      
                    
                
                } else {
                    if($userId !='2'){
                        $this->storeGlobalPayment('PlanTree',$planId,$parentId,$userId,1,'2',$rotatingCommissionAmount,1,"Global regain Income",'3',0);
                    }
                }

            // // // // ===== END NEW BLOCK =====

            return response()->json(['success' => true]);

        });
    }

    // The reusable core activation logic
    protected function repeatPlanPayment($userId, $amount, $planId,  $levels, $upgrade)
    {
        // // Store the activated plan (capture id for ordering if needed)
        // DB::table('user_plan')->insert([
        //     'plan_id'    => $planId,
        //     'user_id'    => $userId,
        //     'amount'     => $amount,
        //     'created_by' => auth()->id(),
        //     'created_at' => now(),
        // ]);

        $planData = DB::table('plans')->where('id',$planId)->first();

        // if($upgrade_status == 1){
        //     $totup = $upgrade - $planData->plan_amount;
        //     DB::table('users')->where('id', $userId)->update([
        //         'upgrade'        => $totup,
        //     ]);
        // }

        // Update user to latest plan
        // DB::table('users')->where('id', $userId)->update([
        //     'plan_id'    => $planId,
        //     'status'     => 1,
        //     'updated_at' => now(),
        // ]);
        
        
        // Get current user details
        $currentUser = DB::table('users')->where('id', $userId)->first();

        // Increment coins separately
        $shib_coin = ($currentUser->shib_coin ?? 0) + $planData->shib_coin;
        $bonk_coin = ($currentUser->bonk_coin ?? 0) + $planData->bonk_coin;
        $pepe_coin = ($currentUser->pepe_coin ?? 0) + $planData->pepe_coin;
        $floki_coin = ($currentUser->floki_coin ?? 0) + $planData->floki_coin;
        $btt_coin = ($currentUser->btt_coin ?? 0) + $planData->btt_coin;
        $tfc_coin = ($currentUser->tfc_coin ?? 0) + $planData->tfc_coin;
        $baby_doge_coin = ($currentUser->baby_doge_coin ?? 0) + $planData->baby_doge_coin;
        DB::table('users')->where('id', $userId)->update([
            'shib_coin' => $shib_coin,
            'bonk_coin' => $bonk_coin,
            'pepe_coin' => $pepe_coin,
            'floki_coin' => $floki_coin,
            'btt_coin' => $btt_coin,
            'tfc_coin' => $tfc_coin,
            'baby_doge_coin' => $baby_doge_coin,
        ]);

        // //////////////////////  1) Sponser Income //////////////////////////

            $refralupgradeCommission = ($amount * 5) / 100;
            $referrerCommission = ($amount * 50) / 100;
            $adminCommission    = ($amount * 5) / 100;

            // Self bonus
            $this->storeSponserPayment('Rebirth', $planId, $userId, $currentUser->referral_id, 1, '5', $refralupgradeCommission, 1, "Referal Upgrade Bonus - Global Regain",'4');

            //  Referrer bonus
            if (!empty($currentUser->referral_id)) {
                $this->storeSponserPayment('RebirthIn', $planId, $userId, $currentUser->referral_id, 1, '1', $referrerCommission, 1, "Referral Sponser Income - Global Regain",'3');
            } else {
                $this->storeSponserPayment('RebirthIn', $planId, $userId, 1, 1, '1', $referrerCommission, 1, "Referral Sponser Income (Admin) - Global Regain",'4');
            }

            // Admin bonus (set to 0 if you want ONLY the rotating 20% path)
            if ($adminCommission > 0) {
                $this->storeSponserPayment('Rebirth', $planId, $userId, 1, 1, '8', $adminCommission, 1, "Admin Bonus Upgrade",'4');
            }

        

        // // /**
        // //  * 1. LEVEL COMMISSION (split into 10 levels equally)
        // //  */
            $commissionPerLevel = ($amount * $planData->level_amount) / 100;
            $comAmount = $commissionPerLevel / $levels;
            $referrerId = $currentUser->referral_id ?? null;
            for ($level = 1; $level <= $levels; $level++) {
                if ($referrerId) {

                    $perc50 = ($comAmount * 50) / 100;
                    $perc30 = ($comAmount * 30) / 100;
                    $perc10 = ($comAmount * 10) / 100;

                    // $wallet = DB::table('users')->where('id', $referrerId)->value('wallet');
                    // $newBalance = ($wallet ?? 0) + $comAmount;
                    // DB::table('users')->where('id', $referrerId)->update([
                    //     'wallet'     => $newBalance,
                    //     'updated_at' => now(),
                    // ]);

                    $this->storeLevelPayment('Level', $planId, $userId, $referrerId, $level, '3', $comAmount, '1', "Level Income - Global Regain",'4');

                    $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, $referrerId, $level, '6',$perc30, 1, "Travel Amount Level - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId,$referrerId,$level,'7',$perc50,1,"Travel Allowance - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, $referrerId, $level, '5',$perc10, 1, "Upgrade Level - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplit',$planId,$userId, $referrerId, $level, '8',$perc10, 1, "Admin 10% Level Upgrade - Global Regain",'4');

                    $share15travels = ($perc30 * 15) / 100;
                    $share10travels = ($perc30 * 10) / 100;
                    $share5travels = ($perc30 * 5) / 100;
            
                    // Store travel-related payments
                    $this->storeLevelPayment('RebirthSplitMainTravel3',$planId,$userId,$referrerId,1,'12',$share15travels,1,"Travel International Tour - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMainTravel4',$planId,$userId,$referrerId,1,'13',$share10travels,1,"Travel National Tour - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMainTravel5',$planId,$userId,$referrerId,1,'14',$share5travels,1,"Travel Local Tour - Global Regain",'4');

                    $referrer = DB::table('users')->where('id', $referrerId)->first();
                    $referrerId = $referrer->referral_id ?? null;

                } else {
                    // fallback to admin

                    $perc50 = ($comAmount * 50) / 100;
                    $perc30 = ($comAmount * 30) / 100;
                    $perc10 = ($comAmount * 10) / 100;

                    // $wallet = DB::table('users')->where('id', 1)->value('wallet');
                    // $newBalance = ($wallet ?? 0) + $comAmount;
                    // DB::table('users')->where('id', 1)->update([
                    //     'wallet'     => $newBalance,
                    //     'updated_at' => now(),
                    // ]);

                    $this->storeLevelPayment('Level', $planId, $userId, 1, $level, '3', $comAmount, '1', "Level Income - Global Regain",'4');

                    $this->storeLevelPayment('RebirthSplitMain',$planId,$userId, 1, $level, '6',$perc30, 1, "Travel Amount Level - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMain1',$planId,$userId, 1, $level,'7',$perc50,1,"Travel Allowance - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMain2',$planId,$userId, 1, $level, '5',$perc10, 1, "Upgrade Level - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplit',$planId,$userId, 1, $level, '8',$perc10, 1, "Admin 10% Level Upgrade - Global Regain",'4');

                    $share15travels = ($perc30 * 15) / 100;
                    $share10travels = ($perc30 * 10) / 100;
                    $share5travels = ($perc30 * 5) / 100;
            
                    // Store travel-related payments
                    $this->storeLevelPayment('RebirthSplitMainTravel3',$planId,$userId,1,1,'12',$share15travels,1,"Travel International Tour - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMainTravel4',$planId,$userId,1,1,'13',$share10travels,1,"Travel National Tour - Global Regain",'4');
                    $this->storeLevelPayment('RebirthSplitMainTravel5',$planId,$userId,1,1,'14',$share5travels,1,"Travel Local Tour - Global Regain",'4');

                }
            }

        // // /**
        // //  * 4. UPLINE COMMISSION
        // //  */
        $commissionAmount = ($amount * $planData->upline_amount) / 100;
        $uplinerId = $this->getUpline($currentUser, $planId);

        if ($uplinerId) {
            $hasPlan = DB::table('user_plan')
                ->where('user_id', $uplinerId)
                ->where('plan_id', $planId)
                ->exists();

            if (!$hasPlan) {
                $uplinerId = 1; // admin fallback
            }
        } else {
            $uplinerId = 1; // admin fallback
        }

        $perca50 = ($commissionAmount * 50) / 100;
        $perca30 = ($commissionAmount * 30) / 100;
        $perca10 = ($commissionAmount * 10) / 100;

        //dd($perca50,$perca30,$perca10);

        $this->storeUplinePayment('Upline', $planId, $userId, $uplinerId, $planId, '4', $commissionAmount, 1, "Upline Sponser - Global Regain",'4');

        $this->storeUplinePayment('RebirthSplitMain',$planId,$userId, $uplinerId, $planId, '6',$perca30, 1, "Travel Amount Upline - Global Regain",'4');
        $this->storeUplinePayment('RebirthSplitMain1',$planId,$userId,$uplinerId,$planId,'7',$perca50,1,"Travel Allowance Upline - Global Regain",'4');
        $this->storeUplinePayment('RebirthSplitMain2',$planId,$userId, $uplinerId, $planId, '5',$perca10, 1, "Upline Sponser Income - Global Regain",'4');
        $this->storeUplinePayment('RebirthSplit',$planId,$userId, $uplinerId, $planId, '8',$perca10, 1, "Admin 10% Upline Upgrade - Global Regain",'4');

        $share15travel = ($perca30 * 15) / 100;
        $share10travel = ($perca30 * 10) / 100;
        $share5travel = ($perca30 * 5) / 100;

        $this->storeUplinePayment('RebirthSplitMainTravel3',$planId,$userId,$uplinerId,$planId,'12',$share15travel,1,"Travel International Tour Upline - Global Regain",'4');
        $this->storeUplinePayment('RebirthSplitMainTravel4',$planId,$userId,$uplinerId,$planId,'13',$share10travel,1,"Travel National Tour Upline - Global Regain",'4');
        $this->storeUplinePayment('RebirthSplitMainTravel5',$planId,$userId,$uplinerId,$planId,'14',$share5travel,1,"Travel Local Tour Upline - Global Regain",'4');


        // ////////////////////////////////// 2) Global Regain /////////////////////////////////
        // // . ===== NEW: Rotating 20% commission per plan (Admin -> #1 -> #2 ... per 20 purchases) =====
            $rotatingPercent = $planData->regain_amount; 
            $rotatingCommissionAmount = ($amount * $rotatingPercent) / 100;

            $globalregainsssar = DB::table('global_regain')
                ->where('plan_id', $planId)
                ->where('status', 0)
                ->where('pay_reason_id','2')
                ->orderby('id','ASC')
                ->first();

                $globalregain = DB::table('global_regain')
                    ->where('plan_id', $planId)
                    ->where('status', 0)
                    ->where('from_id', $globalregainsssar->to_id)
                    ->where('pay_reason_id','2')
                    ->count();

            $parentId = $globalregainsssar->to_id;

            if($globalregain == 19) {

                $this->storeGlobalPayment('PlanTree',$planId,$parentId,$userId,1,'2',$rotatingCommissionAmount,1,"Global regain Income - Global Regain",'4',0);
                
                DB::table('global_regain')->where('plan_id',$planId)->where('to_id',$parentId)->update([
                    'status'        => 1,
                ]);

                    $total = ((($amount * 20) / 100) * 20) - $amount;

                    // Calculate the splits
                    $share40 = ($total * 40) / 100;
                    $share30 = ($total * 30) / 100;
                    $share20 = ($total * 20) / 100;
                    $share10 = ($total * 10) / 100;
            
                    // Store the main rebirth splits
                    $this->storeGlobalPayment('RebirthSplitMain',$planId,$parentId,$userId,1,'6',$share40,1,"Travel Amount - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMain1',$planId,$parentId,$userId,1,'7',$share40,1,"Travel Allowance - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMain2',$planId,$parentId,$userId,1,'5',$share10,1,"Upgrade - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplit',$planId,$parentId,1,1,'8',$share10,1,"Admin 10% - Global Regain",'4');
            
                    // Calculate travel splits
                    $share50travel = ($share40 * 50) / 100;
                    $share30travel = ($share30 * 30) / 100;
                    $share20travel = ($share20 * 10) / 100;
            
                    // Store travel-related payments
                    $this->storeGlobalPayment('RebirthSplitMainTravel3',$planId,$parentId,$userId,1,'12',$share50travel,1,"Travel International Tour - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMainTravel4',$planId,$parentId,$userId,1,'13',$share30travel,1,"Travel National Tour - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMainTravel5',$planId,$parentId,$userId,1,'14',$share20travel,1,"Travel Local Tour - Global Regain",'4',1);
            
                    $this->storeGlobalPayment('RebirthSplitMainTravel',$planId,$parentId,$userId,1,'9',$share50travel,1,"Travel Allowance International Tour - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMainTravel1',$planId,$parentId,$userId,1,'10',$share30travel,1,"Travel Allowance National Tour - Global Regain",'4',1);
                    $this->storeGlobalPayment('RebirthSplitMainTravel2',$planId,$parentId,$userId,1,'11',$share20travel,1,"Travel Local Tour - Global Regain",'4',1);
            
                    // Reset beneficiary's global rebirth amount
                    $GBA = DB::table('users')->where('id', $parentId)->value('global_rebirth_amount');
                    $newBalance = $GBA - $amount;
                    DB::table('users')->where('id', $parentId)->update(['global_rebirth_amount' => $newBalance]);
            
                    $rebirthData = DB::table('users')->where('id', $parentId)->first();
            
                    if ($rebirthData) {

                        $latestId = DB::table('users')->max('id') ?? 0; 
                        $new = $latestId - 1; 
                        $newId = $new + 1001; 
                        $formattedId = str_pad($newId, 4, '0', STR_PAD_LEFT); 
                        $username = "TFC" . $formattedId;

                        if($planId == 1){
                            // Create new rebirth user
                            $newUId = DB::table('users')->insertGetId([
                                'referral_id' => $parentId,
                                'user_type_id' => 4,
                                'plan_id' => $planId,
                                'user_name' => $username,
                                'name' => 'Global - Rebirth',
                                'email' => $rebirthData->email,
                                'phone' => $rebirthData->phone,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            // Create rebirth plan entry
                            $rebirthPlan = DB::table('user_plan')->insert([
                                'user_id' => $newUId,
                                'plan_id' => $planId,
                                'amount' => $amount,
                                'created_by' => auth()->user()->id,
                                'created_at' => now(),
                            ]);

                            $this->repeatPlanPayment($newUId, $amount, $planId, $levels, $upgrade);

                        } else {

                            $rebirthUser = DB::table('users')->where('referral_id', $parentId)->where('user_type_id', 4)->first();

                            // Create rebirth plan entry
                            $rebirthPlan = DB::table('user_plan')->insert([
                                'user_id' => $rebirthUser->id,
                                'plan_id' => $planId,
                                'amount' => $amount,
                                'created_by' => auth()->user()->id,
                                'created_at' => now(),
                            ]);

                            $this->repeatPlanPayment($rebirthUser->id, $amount, $planId, $levels, $upgrade);
                        }
            
    
                        $this->repeatPlanPayment($newId, $amount, $planId, $levels, $upgrade);
                    }                      
                
            } else {
                $this->storeGlobalPayment('PlanTree',$planId,$parentId,$userId,1,'2',$rotatingCommissionAmount,1,"Global regain Income",'4',0);
            }
        // // // // ===== END NEW BLOCK =====

        return response()->json(['success' => true]);

    }

   

}