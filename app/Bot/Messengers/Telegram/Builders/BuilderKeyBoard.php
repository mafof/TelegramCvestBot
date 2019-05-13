<?php

namespace App\Bot\Messengers\Telegram\Builders;

use App\Bot\Messengers\Telegram\Errors\ErrorBuilderKeyBoard;

class BuilderKeyBoard {
    private $keyboard = null;
    private $isRemoveKeyBoard = false;

    public function setInlineKeyBoard() {
        if($this->keyboard != null) throw new ErrorBuilderKeyBoard("instance keyboard is not empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is removed");
        $this->keyboard = new \stdClass();
        $this->keyboard->inline_keyboard = Array();

        return $this;
    }

    public function setReplyKeyboard($resizeKeyboard = false, $oneTimeKeyboard = false, $selective = false) {
        if($this->keyboard != null) throw new ErrorBuilderKeyBoard("instance keyboard is not empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is removed");
        $this->keyboard = new \stdClass();

        $this->keyboard->keyboard          = Array();
        $this->keyboard->resize_keyboard   = $resizeKeyboard;
        $this->keyboard->one_time_keyboard = $oneTimeKeyboard;
        $this->keyboard->selective         = $selective;

        return $this;
    }

    public function setRemoveKeyBoard($selective = false) {
        if($this->keyboard != null) throw new ErrorBuilderKeyBoard("instance keyboard is not empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is now removed");

        $this->keyboard                  = new \stdClass();
        $this->keyboard->remove_keyboard = true;
        $this->keyboard->selective       = $selective;

        return $this;
    }

    public function appendRow() {
        if($this->keyboard == null) throw new ErrorBuilderKeyBoard("instance keyboard is empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is removed");

        if(isset($this->keyboard->keyboard)) {
            array_push($this->keyboard->keyboard, Array());
        } else {
            array_push($this->keyboard->inline_keyboard, Array());
        }

        return $this;
    }

    public function appendButtonReply($text, $requestContact = false, $requestLocation = false) {
        if($this->keyboard == null) throw new ErrorBuilderKeyBoard("instance keyboard is empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is removed");
        if(isset($this->keyboard->inline_keyboard)) return $this->keyboard;

        $countRow = count($this->keyboard->keyboard);
        if($countRow > 0) {
            $keyButton = new \stdClass();
            $keyButton->text = $text;
            $keyButton->request_contact = $requestContact;
            $keyButton->request_location = $requestLocation;
            array_push($this->keyboard->keyboard[$countRow-1], $keyButton);
        }

        return $this;
    }

    public function appendButtonInline($text, $callbackData, $url = null) {
        if($this->keyboard == null) throw new ErrorBuilderKeyBoard("instance keyboard is empty");
        if($this->isRemoveKeyBoard) throw new ErrorBuilderKeyBoard("keyboard is removed");
        if(is_null($callbackData) && is_null($url)) throw new ErrorBuilderKeyBoard("is not define one params");
        if(isset($this->keyboard->keyboard)) return $this->keyboard;

        $countRow = count($this->keyboard->inline_keyboard);
        if($countRow > 0) {
            $keyButtonInline = new \stdClass();
            $keyButtonInline->text = $text;
            if(!is_null($url)) $keyButtonInline->url = $url;
            if(!is_null($callbackData)) $keyButtonInline->callback_data = $callbackData;

            array_push($this->keyboard->inline_keyboard[$countRow-1], $keyButtonInline);
        }

        return $this;
    }

    public function getKeyboard() {
        return $this->keyboard;
    }
}
