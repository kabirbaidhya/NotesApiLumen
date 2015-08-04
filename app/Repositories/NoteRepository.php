<?php

namespace App\Repositories;

use App\Note;

/**
 *
 * @author Kabir Baidhya
 */
class NoteRepository
{
    public function all()
    {
        return Note::all();
    }
}
