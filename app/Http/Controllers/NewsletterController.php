<?php

namespace App\Http\Controllers;

use App\Models\EmailConfig;
use Illuminate\Http\Request;
use Newsletter;

class NewsletterController extends Controller
{
    public function mail()
    {
        $n = Newsletter::subscribe('thamjeed@gmail.com');
        // Newsletter::setMarketingPermission('rincewind@discworld.com', 'email', true);
    }

    public function index(Request $request)
    {
        $mailchimp = EmailConfig::where('user_id', Auth::user()->id)->first();
        if (isset($mailchimp->mailchimp_api_key)) {

            $listId = $mailchimp->mailchimp_list_id;
            $mailchimp = new \Mailchimp($mailchimp->mailchimp_api_key);

            $campaign = $mailchimp->campaigns->create('regular', [
                'list_id' => $listId,
                'subject' => 'Example Mail',
                'from_email' => $mailchimp->mailchimp_from_email,
                'from_name' => $mailchimp->mailchimp_from_name,
                'to_name' => $mailchimp->mailchimp_to_name,

            ], [
                // 'html' => $request->input('content'),
                // 'text' => strip_tags($request->input('content'))
                'html' => "sdzxfsdxsd",
                'text' => "sdfsdxfsdg",
            ]);

            //Send campaign
            $mailchimp->campaigns->send($campaign['id']);
            return redirect()->back()->with('success', __('Campaign send successfully'));
        } else {
            return redirect()->back()->with('error', __('Something went wrong in API'));

        }

    }
}
