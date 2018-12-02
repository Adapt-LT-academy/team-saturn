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
 * @property  startConversation
 */
class WelcomeConversation extends Conversation {
    
    use ContainerAwareConversationTrait;


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
//                $selectedText = $answer->getText(); // etc..
              }

              switch ($answer){
                  case 'startBrowse':
                      //$this->startConversation(new Browse);
                      $this->runBrowse();
                      break;

                  case 'startRandom':
                      $this->runBrowse();
                      break;

                  case 'startQuit':
                      $this->runBrowse();
                      break;
              }
              // printout selected
 //             $this->say("You pressed $selectedValue");

          });
    }


    public function runBrowse() {
        $this->say('runBrowse executed');
     //   $this->startConversation (new Browse());
    }


}
