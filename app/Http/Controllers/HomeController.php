<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newpayment;
use App\Mail\PaymentInvitation;
use App\User;
use Yajra\Datatables\Datatables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
      return view('home');
    }

    public function indexDataTables()
    {
      $newpays = Newpayment::where('active', 1);
      return Datatables::of($newpays)
          ->addColumn('action', function($newpays) {
              return '
                <div class="dropdown">
                  <a href="#" class="" role="button" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span style="color: #ba7f00;" class="oi oi-chevron-bottom" title="Actions" aria-hidden="true"></span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="actionDropdown">
                    <h6 class="dropdown-header">Actions:</h6>

                    <a class="dropdown-item" href="/deactivatePayment/'. $newpays->paymentuniqid .'">
                      Block Link
                    </a>

                    <a class="dropdown-item" href="/reactivatePayment/'. $newpays->paymentuniqid .'">
                      Reactivate Link
                    </a>

                    <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#showLinkModal" data-link="' . $newpays->paymentuniqlink .'">
                      Show Link
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-total="' . $newpays->total . '" data-target="#editRecordModal" data-title="' . $newpays->title . '" data-salutation="' . $newpays->_salutation . '" data-firstname="' . $newpays->firstname . '" data-lastname="' . $newpays->lastname . '"
                    data-email="' . $newpays->email . '" data-language="' . $newpays->language . '" data-type="' . $newpays->type . '" data-paymentIDedit="' . $newpays->paymentuniqid . '">
                      Edit Record
                    </a>

                    <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#resendRecordModal" data-title="' . $newpays->title . '" data-salutation="' . $newpays->_salutation . '" data-firstname="' . $newpays->firstname . '" data-lastname="' . $newpays->lastname . '"
                    data-email="' . $newpays->email . '" data-language="' . $newpays->language . '" data-type="' . $newpays->type . '" data-paymentIDresend="' . $newpays->paymentuniqid . '">
                      Resend Invitation
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" role="button" data-toggle="modal" data-target="#" data-paymentID="' . $newpays->paymentuniqid .'">
                      Delete Record
                    </a>
                  </div>
                </div>
              ';
          })
          ->editColumn('action', function($newpays) {
            switch ($newpays->paymentstatus)
            {
              case 'blocked':
              // BLOCK LINK //
              $classBlock      = 'text-muted';
              $styleBlock      = 'not-allowed';
              $aBlock          = '';
              // REACTIVATE LINK //
              $classReactivate = '';
              $styleReactivate = '';
              $aReactivate     = 'href="/reactivatePayment/'. $newpays->paymentuniqid .'"';
              // DELETE LINK //
              $classDelete     = '';
              $styleDelete     = '';
              $aDelete         = '#deleteRecordModal';
              // EDIT RECORD //
              $classEdit       = '';
              $styleEdit       = '';
              $aEdit         = '#editRecordModal';
              break;

              case 'sent':
              // BLOCK LINK //
              $classBlock      = '';
              $styleBlock      = '';
              $aBlock          = 'href="/deactivatePayment/'. $newpays->paymentuniqid .'"';
              // REACTIVATE LINK //
              $classReactivate = 'text-muted';
              $styleReactivate = 'not-allowed';
              $aReactivate     = '';
              // DELETE LINK //
              $classDelete     = '';
              $styleDelete     = '';
              $aDelete         = '#deleteRecordModal';
              // EDIT RECORD //
              $classEdit       = '';
              $styleEdit       = '';
              $aEdit           = '#editRecordModal';
              break;

              case 'opened':
              // BLOCK LINK //
              $classBlock      = '';
              $styleBlock      = '';
              $aBlock          = 'href="/deactivatePayment/'. $newpays->paymentuniqid .'"';
              // REACTIVATE LINK //
              $classReactivate = 'text-muted';
              $styleReactivate = 'not-allowed';
              $aReactivate     = '';
              // DELETE LINK //
              $classDelete     = 'text-muted';
              $styleDelete     = 'not-allowed';
              $aDelete         = '';
              // EDIT RECORD //
              $classEdit       = '';
              $styleEdit       = '';
              $aEdit           = '#editRecordModal';
              break;

              case 'paid':
              // BLOCK LINK //
              $classBlock      = 'text-muted';
              $styleBlock      = 'not-allowed';
              $aBlock          = '';
              // REACTIVATE LINK //
              $classReactivate = 'text-muted';
              $styleReactivate = 'not-allowed';
              $aReactivate     = '';
              // DELETE LINK //
              $classDelete     = 'text-muted';
              $styleDelete     = 'not-allowed';
              $aDelete         = '';
              // EDIT RECORD //
              $classEdit       = 'text-muted';
              $styleEdit       = 'not-allowed';
              $aEdit           = '';
              break;

              case 'error':
              // BLOCK LINK //
              $classBlock      = 'text-muted';
              $styleBlock      = 'not-allowed';
              $aBlock          = '';
              // REACTIVATE LINK //
              $classReactivate = '';
              $styleReactivate = '';
              $aReactivate     = 'href="/reactivatePayment/'. $newpays->paymentuniqid .'"';
              // DELETE LINK //
              $classDelete     = '';
              $styleDelete     = '';
              $aDelete         = '#deleteRecordModal';
              // EDIT RECORD //
              $classEdit       = '';
              $styleEdit       = '';
              $aEdit           = '#editRecordModal';
              break;

              default:
              // BLOCK LINK //
              $classBlock      = 'text-muted';
              $styleBlock      = 'not-allowed';
              $aBlock          = '';
              // REACTIVATE LINK //
              $classReactivate = 'text-muted';
              $styleReactivate = 'not-allowed';
              $aReactivate     = '';
              // DELETE LINK //
              $classDelete     = 'text-muted';
              $styleDelete     = 'not-allowed';
              $aDelete         = '';
              // EDIT RECORD //
              $classEdit       = 'text-muted';
              $styleEdit       = 'not-allowed';
              $aEdit           = '';
              break;

            }
            return '
              <div class="dropdown">
                <a href="#" class="" role="button" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span style="color: #ba7f00;" class="oi oi-chevron-bottom" title="Actions" aria-hidden="true"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                  <h6 class="dropdown-header">Actions:</h6>

                  <a class="dropdown-item ' . $classBlock . '" style="cursor: ' . $styleBlock . '" ' . $aBlock . '>
                    Block Link
                  </a>

                  <a class="dropdown-item ' . $classReactivate . '" style="cursor: ' . $styleReactivate . '" ' . $aReactivate . '>
                    Reactivate Link
                  </a>

                  <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#showLinkModal"
                      data-link="' . $newpays->paymentuniqlink .'">
                    Show Link
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item ' . $classEdit . '" style="cursor: ' . $styleEdit . '" href="#" role="button" data-toggle="modal" data-target="' . $aEdit . '"
                      data-total="' . $newpays->total . '"
                      data-title="' . $newpays->title . '"
                      data-salutation="' . $newpays->_salutation . '"
                      data-firstname="' . $newpays->firstname . '"
                      data-lastname="' . $newpays->lastname . '"
                      data-email="' . $newpays->email . '"
                      data-language="' . $newpays->language . '"
                      data-type="' . $newpays->type . '"
                      data-paymentidedit="' . $newpays->paymentuniqid . '">
                    Edit Record
                  </a>

                  <a class="dropdown-item" style="cursor: " href="#" role="button" data-toggle="modal" data-target="#resendRecordModal"
                      data-total="' . $newpays->total . '"
                      data-title="' . $newpays->title . '"
                      data-salutation="' . $newpays->_salutation . '"
                      data-firstname="' . $newpays->firstname . '"
                      data-lastname="' . $newpays->lastname . '"
                      data-email="' . $newpays->email . '"
                      data-language="' . $newpays->language . '"
                      data-type="' . $newpays->type . '"
                      data-paymentidresend="' . $newpays->paymentuniqid . '"
                      data-link="' . $newpays->paymentuniqlink . '">
                    Resend Invitation
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger ' . $classDelete . '" style="cursor: ' . $styleDelete . '" href="#" role="button" data-toggle="modal" data-target="' . $aDelete . '"
                      data-paymentID="' . $newpays->paymentuniqid . '"
                      data-firstname="' . $newpays->firstname . '"
                      data-lastname="' . $newpays->lastname . '"
                      data-total="' . $newpays->total . '">
                    Delete Record
                  </a>
                </div>
              </div>
            ';
          })
          ->editColumn('created_at', function($formatDate) {
            return $formatDate->created_at->format('d-m-Y');
          })
          ->editColumn('_user', function($newpays) {
            return User::where('id', $newpays->_user)->first()->shortcode;
          })
          ->make(true);
    }

    public function index()
    {
      $paymentsUsername   = User::all();
      $paymentsSalutation = \DB::table('salutations')->get();
      return view('paymentsdashboard', compact('paymentsUsername', 'paymentsSalutation'));
    }


    public function store(Request $request)
    {
      $clientMail = $request->input('email');
      /* CREATE PAYMENT STATUS */
      $paymentstatus = 'sent';
      /* CREATE UNIQUE ID */
      $uniqidCreate    = uniqid(md5(rand()));
      $uniqidCreateII  = uniqid(md5(rand()));
      $uniqidCreateSum = $uniqidCreate . '.' . $uniqidCreateII;
      /* CREATE UNIQUE ID */
      $paymentlanguage = $request->input('language');
      $paymenttype = $request->input('type');
      /* CREATE UNIQUE LINK */
      if(empty($_SERVER['REQUEST_URI'])) {
        $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
      }
      $url = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
      $folderpath = 'https://steigenberger.hotelapp.cloud'.ltrim(dirname($url), '/').'/';

      $targetUrl = $folderpath . $paymentlanguage . '/' . $paymenttype . '/' . $uniqidCreate . '.' . $uniqidCreateII;
      /* INSERT INTO DATABASE */
      $request = Newpayment::create([
        'title'           => request('title'),
        '_salutation'     => request('salutation'),
        'firstname'       => request('firstname'),
        'lastname'        => request('lastname'),
        'email'           => request('email'),
        'arrival'         => request('arrival'),
        'departure'       => request('departure'),
        'rooms'           => request('rooms'),
        'persons'         => request('persons'),
        'children'        => request('children'),
        'category'        => request('category'),
        'language'        => request('language'),
        'type'            => request('type'),
        'total'           => request('total'),
        'paymentstatus'   => $paymentstatus,
        'paymentuniqid'   => $uniqidCreateSum,
        'paymentuniqlink' => $targetUrl,
        'active'          => 1,
        '_user'           => request('user'),
      ]);
      /* SEND INVITATION MAIL TO CLIENT */
      $salutation = \DB::table('salutations')->where('salutationID', $request->_salutation)->first();

      $mailContent = [
        'contentLang'       => $request->language,
        'contentTitle'      => $request->title,
        'contentSalutation' => $salutation->salutation,
        'contentFirstname'  => $request->firstname,
        'contentLastname'   => $request->lastname,
        'contentlink'       => $request->paymentuniqlink,
        'contentType'       => $request->type
      ];
      \Mail::to($clientMail)->send(new PaymentInvitation($mailContent));

      return redirect('paymentsdashboard');
    }

    public function deactivate($uniqupdateid)
    {
      $test=\DB::table('newpayments')
            ->where('paymentuniqid', $uniqupdateid)
            ->update([
              'paymentstatus' => 'blocked',
      ]);
      return redirect('paymentsdashboard');
    }

    public function reactivate($uniqupdateid)
    {
      \DB::table('newpayments')
            ->where('paymentuniqid', $uniqupdateid)
            ->update([
              'paymentstatus' => 'sent',
              'paymentaccess' => 0,
      ]);
      return redirect('paymentsdashboard');
    }

    public function edit(Request $request)
    {
      $paymentID = request('showPaymentIDedit');
      $editRecord = Newpayment::where('paymentuniqid', $paymentID)
            ->update([
              'title'         => request('showTitle'),
              '_salutation'   => request('showSalutation'),
              'firstname'     => request('showFirstname'),
              'lastname'      => request('showLastname'),
              'email'         => request('showEmail'),
              'total'         => request('showTotal'),
              '_userLastEdit' => request('userLastEdit'),
            ]);
      return redirect('paymentsdashboard');
    }

    public function delete(Request $request)
    {
      $paymentID = request('showPaymentID');
      $softDelete = Newpayment::where('paymentuniqid', $paymentID)
            ->update([
              'active' => 0,
              '_userSoftDelete' => request('userSoftDelete'),
            ]);
      return redirect('paymentsdashboard');
    }

    public function resend(Request $request)
    {
      $paymentID = request('showPaymentIDresend');
      $resend = Newpayment::where('paymentuniqid', $paymentID)
            ->update([
              'active' => 1,
              'paymentaccess' => 0,
              'paymentstatus' => 'sent',
            ]);
      /* SEND INVITATION MAIL TO CLIENT */
      $clientMail = request('showEmail');
      $salutation = \DB::table('salutations')->where('salutationID', $request->_salutation)->first();

      $mailContent = [
        'contentLang'       => request('showLanguage'),
        'contentTitle'      => request('showTitle'),
        'contentSalutation' => $request->salutation,
        'contentFirstname'  => request('showFirstname'),
        'contentLastname'   => request('showLastname'),
        'contentlink'       => request('showLink'),
        'contentType'       => request('showType'),
      ];
      \Mail::to($clientMail)->send(new PaymentInvitation($mailContent));

      return redirect('paymentsdashboard');
    }

}
