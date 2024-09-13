<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;

class MailController extends Controller
{
    public function fetchEmails()
    {
        // Connect to the IMAP server
        $client = Client::account('default');
        $client->connect();

        // Get all folders
        $folders = $client->getFolders();

        foreach ($folders as $folder) {
            // Get all messages in the folder
            if($folder->name == 'Tasks') {
                $messages = $folder->messages()->all()->get();

                foreach ($messages as $message) {
                    dd($message);
                    echo $message->getSubject() . '<br />';
                    echo 'Attachments: ' . $message->getAttachments()->count() . '<br />';
                    echo $message->getHTMLBody();
                }
            }
        }
    }
}
