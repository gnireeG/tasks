<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Google\Client;
use Google\Service\Gmail;

class GmailController extends Controller
{
    public static function getClient(){
        $user = auth()->user();
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setAccessToken($user->google_token);
        return $client;
    }

    public function getMails(){
        $client = self::getClient();
        $service = new Gmail($client);

        // Get the label ID for the "todos" label
        $labelId = $this->getLabelId($service, 'todos');

        if ($labelId) {
            // List messages in the "todos" label
            $messages = $service->users_messages->listUsersMessages('me', ['labelIds' => $labelId]);

            $emails = [];
            foreach ($messages->getMessages() as $message) {
                $msg = $service->users_messages->get('me', $message->getId());
                $emails[] = $msg;
            }

            return response()->json($emails);
        } else {
            return response()->json(['error' => 'Label "todos" not found'], 404);
        }
    }

    private function getLabelId($service, $labelName)
    {
        $labels = $service->users_labels->listUsersLabels('me');
        foreach ($labels->getLabels() as $label) {
            if ($label->getName() === $labelName) {
                return $label->getId();
            }
        }
        return null;
    }
}
