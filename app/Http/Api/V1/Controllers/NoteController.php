<?php

namespace App\Http\Api\V1\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\NoteRepository;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function show($id)
    {
        try {
            $note = $this->notes->find($id);

            return [
                'data' => $note
            ];
        } catch (NotFoundHttpException $e) {
            return $this->handleNotFound($e);
        }
    }

    public function store(Request $request)
    {
        $data = $request->only('title', 'text');

        try {
            $note = $this->notes->create($data);

            return new JsonResponse([
                'message' => 'Note Created',
                'data' => [
                    'id' => $note->id,
                    '_link' => url('/api/v1/notes/' . $note->id)
                ]
            ], 201);
        } catch (Exception $e) {
            // TODO error response
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->only('title', 'text');

        try {
            $updated = $this->notes->update($id, $data);

            return [
                'message' => 'Updated Successfully',
                'data' => $updated
            ];
        } catch (NotFoundHttpException $e) {
            return $this->handleNotFound($e);
        }

    }

    public function destroy($id)
    {
        try {
            $this->notes->remove($id);

            // Successful response
            return [
                'message' => 'Deleted Successfully'
            ];
        } catch (NotFoundHttpException $e) {
            return $this->handleNotFound($e);
        }
    }

    /**
     * @param Exception $e
     * @return JsonResponse
     */
    protected function handleNotFound(Exception $e)
    {
        return new JsonResponse([
            'message' => $e->getMessage()
        ], 404);
    }

}
