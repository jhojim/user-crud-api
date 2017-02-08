<?php

namespace SRC\Common;


class DebugTimer
{
    private $startTime;
    private $key;
    private $finished;

    public function __construct($key = false)
    {
        $this->key = $key;
        $this->startTime = microtime(true);
    }

    public function __destruct()
    {
        $this->finish();
    }

    // Returns elapsed time in milliseconds
    public function getTime()
    {
        return (float)sprintf("%.1f", 1000*(microtime(true) - $this->startTime));
    }

    // Finishes a timer and logs it to Debug
    public function finish()
    {
        if (!$this->finished) {
            $this->finished = $this->getTime();
            if ($this->finished<=0.1) {
                return 0;
            }
            if (!$this->finished) {
                $this->finished = 0.000001;
            }
            if ($this->key) {
                Debug::endTimer($this->key, $this->finished);
            }
        }
        return $this->finished;
    }
}
