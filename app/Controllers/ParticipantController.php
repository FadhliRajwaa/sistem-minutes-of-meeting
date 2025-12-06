<?php

namespace App\Controllers;
use App\Models\ParticipantModel;
use App\Models\MeetingModel;
use CodeIgniter\Controller;

class ParticipantController extends Controller
{
    public function index()
    {
        return view('partials/participant-content');
    }

    public function getParticipants($meetingId)
    {
        $model = new ParticipantModel();
        return $this->response->setJSON($model->where('meeting_id', $meetingId)->findAll());
    }

    public function addParticipant()
    {
        $model = new ParticipantModel();
        $data = [
            'meeting_id' => $this->request->getPost('meeting_id'),
            'name' => $this->request->getPost('name'),
            'barcode_id' => $this->request->getPost('barcode_id')
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function scanBarcode()
    {
        $model = new ParticipantModel();
        $barcode = $this->request->getPost('barcode');
        $participant = $model->where('barcode_id', $barcode)->first();

        if (!$participant) {
            return $this->response->setJSON(['status' => 'not_found']);
        }

        $model->update($participant['id'], ['status' => 'hadir', 'scanned_at' => date('Y-m-d H:i:s')]); 
        return $this->response->setJSON(['status' => 'success']);
    }

    public function absen()
    {
        $barcode = $this->request->getPost('barcode');
        $meeting_id = $this->request->getPost('meeting_id');

        $model = new ParticipantModel();
        $participant = $model->where('barcode_id', $barcode)
                             ->where('meeting_id', $meeting_id)
                             ->first();

        if ($participant) {
            $model->update($participant['id'], ['status' => 'hadir', 'scanned_at' => date('Y-m-d H:i:s')]);
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}