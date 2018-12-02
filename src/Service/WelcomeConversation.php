<?php

namespace App\Service;

use App\Controller\IndexController;
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
     //   $this->ask('Select one of above');
          $question = Question::create('Select one of above')
              ->addButtons([
                  Button::create('Browse')->value('startBrowse'),
                  Button::create('Random')->value('startRandom'),
                  Button::create('Quit')->value('startQuit'),
              ]);

          $this->ask($question, function (Answer $answer) {
              // Detect if button was clicked:
              if ($answer->isInteractiveMessageReply()) {
                  $selectedValue = $answer->getValue(); // will be either 'startBrowse', 'startRandom' or 'startQuit'
                  $selectedText = $answer->getText(); // etc..
              }

          });  
    }


}
