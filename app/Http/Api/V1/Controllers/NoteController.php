<?php

namespace App\Http\Api\V1\Controllers;

use App\Note;
use App\Repositories\NoteRepository;
use Laravel\Lumen\Routing\Controller;

/**
 *
 * @author Kabir Baidhya
 */
class NoteController extends Controller
{
    /**
     * @param NoteRepository $notes
     */
    public function __construct(NoteRepository $notes)
    {
        $this->notes = $notes;
    }

    /**
     * Returns a list of notes
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return $this->notes->all();
    }
}
