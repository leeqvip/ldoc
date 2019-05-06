<?php

namespace Ldoc;

/**
 * Parsedown extra
 */
class Parsedown extends \Parsedown
{
    protected function blockHeader($Line)
    {
        $Block = parent::blockHeader($Line);
        if ($Block) {
            $Block['element']['attributes'] = [
                'id' => $Block['element']['text'],
            ];
        }

        return $Block;
    }
}
