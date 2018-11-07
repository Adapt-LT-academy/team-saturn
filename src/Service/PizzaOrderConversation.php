<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class PizzaOrderConversation extends Conversation
{
    protected $firstname;

    public function run()
    {
        $this->ask(
            'Hello! What is your first name?',
            function (Answer $answer) {
// Save result
                $this->firstname = $answer->getText();
                $this->say('Nice to meet you ' . $this->firstname);
            }
        );
    }
}
