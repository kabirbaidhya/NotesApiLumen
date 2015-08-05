<?php

namespace App\Repositories;

use App\Note;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @return Note
     * @param $id
     */
    public function find($id)
    {
        $note = Note::find($id);
        if (!$note) {
            throw new NotFoundHttpException('Note not found');
        }

        return $note;
    }

    /**
     * @param array $data
     * @return Note
     */
    public function create(array $data)
    {
        return Note::create($data);
    }

    public function update($id, array $data)
    {
        $note = $this->find($id);

        $note->title = $data['title'];
        $note->text = $data['text'];
        $note->save();

        return $note;
    }

    public function remove($id)
    {
        return $this->find($id)->delete();
    }
}
