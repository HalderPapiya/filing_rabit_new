<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\BaseController;
use App\Models\BrokerChat;
use App\Models\BusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MailController extends BaseController
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receiverId = Auth::user()->id;
        $mails = BrokerChat::where('receiver_id', $receiverId)->orwhere('sender_id', $receiverId)->get();
        // dd($mails);
        $senderId = Auth::user()->id;
        $senderMails = BrokerChat::where('sender_id', $senderId)->get();
        // dd($SenderMails);


        return view('user.mail.index', compact('mails', 'senderMails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.mail.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $receiverId = Auth::user()->id;
        $mails = BrokerChat::where('receiver_id', $receiverId)->get();

        // foreach ($mails as $mail) {
        //     $receiver_id = $mail->sender_id;
        // }
        // dd($receiver_id);

        $user = new BrokerChat;
        $user->receiver_id = $receiver_id;
        $user->sender_id = Auth::user()->id;
        $user->subject = $request->subject;
        $user->message = $request->message;
        $user->save();

        if (!$user) {
            return $this->responseRedirectBack('Error occurred while creating blog.', 'error', true, true);
        }
        return Redirect::back()->with('message', 'Mail Send successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $bid = $this->addOnBidRepository->findBusinessAddOnById($id);
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Edit Bid : ' . $bid->title);
        return view('user.business.edit', compact('bid', 'businessTypes'));
    }
    public function show($id)
    {


        $bid = $this->addOnBidRepository->findBusinessAddOnById($id);
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Show Bid : ' . $bid->title);
        return view('user.business.show', compact('bid', 'businessTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'type_id' =>  'required',
            'valuation' =>  'required',
        ]);

        $params = $request->except('_token');



        $bid = $this->addOnBidRepository->updateBusinessService($params);

        if (!$bid) {
            return $this->responseRedirectBack('Error occurred while updating Bid.', 'error', true, true);
        }
        return $this->responseRedirect('user.bid.index', 'Bid updated successfully', 'success', false, false);
    }


    public function destroy($id)
    {
        $BusinessService = $this->addOnBidRepository->deleteBusinessService($id);

        if (!$BusinessService) {
            return $this->responseRedirectBack('Error occurred while deleting Bid.', 'error', true, true);
        }
        return $this->responseRedirect('admin.bid.index', 'Bid deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $BusinessService = $this->addOnBidRepository->updateBusinessServiceStatus($params);

        if ($BusinessService) {
            return response()->json(array('message' => 'Bid  status successfully updated'));
        }
    }
}
