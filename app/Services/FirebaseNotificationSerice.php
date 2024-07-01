<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class FirebaseNotificationSerice
{
    public function  Send($title, $body, $image, $tokens, $data = [])
    {
        $registrationIDs = $tokens;
        
        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'image' => $image,
            "sound"=> "default"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => response()->json($data),
            'content_available' => true,
        );

        $headers = array(
            'Authorization: key = ' . config('app.FIREBASE_API_KEY'),
            'Content-Type: application/json'
        );



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);

        return $result;
    }
}