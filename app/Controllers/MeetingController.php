<?php

namespace App\Controllers;

use App\Models\MeetingModel;
use CodeIgniter\Controller;
use App\Controllers\BaseController; 

class MeetingController extends BaseController 
{
    protected $meetingModel;

    public function __construct()
    {
        $this->meetingModel = new MeetingModel();
    }

    public function index()
    {
        $data['meetings'] = $this->meetingModel->findAll();
        return view('partials/meeting-content', $data);
    }

    public function getMeetings()
    {
        $meetings = $this->meetingModel->findAll(); 
        
        return $this->response->setJSON($meetings);
    }

    public function save()
    {
        $this->meetingModel->save([
            'nama_meeting' => $this->request->getPost('nama_meeting'),
            'tanggal'      => $this->request->getPost('tanggal'),
            'tempat'       => $this->request->getPost('tempat'),
            'status'       => 'Belum Dilaksanakan'
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function getUpcoming()
    {
        $now = date('Y-m-d H:i:s');
        $limit = date('Y-m-d H:i:s', strtotime('+1 day'));

        $meetings = $this->meetingModel->where('tanggal >=', $now)
                                      ->where('tanggal <=', $limit)
                                      ->orderBy('tanggal', 'ASC')
                                      ->findAll();

        return $this->response->setJSON($meetings);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        try {
            // Hapus participants terkait terlebih dahulu (karena foreign key)
            $participantModel = new \App\Models\ParticipantModel();
            $participantModel->where('meeting_id', $id)->delete();
            
            // Hapus discussions terkait
            $discussionModel = new \App\Models\DiscussionModel();
            $discussionModel->where('meeting_id', $id)->delete();

            // Hapus meeting
            if ($this->meetingModel->delete($id)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus meeting']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama_meeting' => $this->request->getPost('nama_meeting'),
            'tanggal'      => $this->request->getPost('tanggal'),
            'tempat'       => $this->request->getPost('tempat'),
            'status'       => $this->request->getPost('status') 
        ];

        if ($this->meetingModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal update data.']);
        }
    }

}