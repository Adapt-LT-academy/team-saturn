<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Service\OptionsService;
use App\Traits\ContainerAwareConversationTrait;

/**
 * Class TestConversation
 */
class WelcomeConversation extends Conversation {
    
    use ContainerAwareConversationTrait;

    protected $firstName;
    protected $testItem;
    protected $address;

    public function run() {

    }


}
