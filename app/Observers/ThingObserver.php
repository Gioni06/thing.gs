<?php

namespace App\Observers;
use App\PseudoCrypt\PseudoCrypt;
use App\Thing;

class ThingObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Thing  $thing
     * @return void
     */
    public function created(Thing $thing)
    {
        $thing->code = PseudoCrypt::hash($thing->id, 8);
        $thing->save();
    }
}
