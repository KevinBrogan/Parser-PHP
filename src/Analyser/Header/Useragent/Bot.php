<?php

namespace WhichBrowser\Analyser\Header\Useragent;

use WhichBrowser\Constants;
use WhichBrowser\Data;

trait Bot
{
    private function &detectBot($ua)
    {
        /* Detect bots based on common markers */

        if (preg_match('/(?:Bot|Robot|Spider|Crawler)([\/;]|$)/iu', $ua)) {
            $this->data->browser->reset();
            $this->data->os->reset();
            $this->data->engine->reset();
            $this->data->device->reset();

            $this->data->device->type = Constants\DeviceType::BOT;
        }

        /* Detect based on a predefined list or markers */

        if ($bot = Data\Bots::identify($ua)) {
            $this->data->browser = $bot;
            $this->data->os->reset();
            $this->data->engine->reset();
            $this->data->device->reset();

            $this->data->device->type = Constants\DeviceType::BOT;
        }

        return $this;
    }
}