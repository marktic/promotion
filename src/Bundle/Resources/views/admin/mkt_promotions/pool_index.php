<?php

echo $this->load(
    '/abstract/index',
    [
        'addURLParams' => ['id_event' => $this->_event->id]
    ]
);