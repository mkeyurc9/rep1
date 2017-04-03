<?php

function send_email($data,$template) {
    
      Mail::send($template, $data, function($message) use ($data)
            {
                $message->from('no-reply@site.com', "JobZedra");
                $message->subject($data['msg']);
                $message->to($data['email']);
            });
}