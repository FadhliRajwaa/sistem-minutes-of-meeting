<?php

namespace App\Controllers;

use App\Models\MeetingModel;
use App\Models\ParticipantModel;
use App\Models\DiscussionModel;

class MeetingController extends BaseController 
{
    protected $meetingModel;

    public function __construct()
    {
        $this->meetingModel = new MeetingModel();
    }

    /**
     * Helper: ambil user_id dari session
     */
    private function getUserId(): int
    {
        return (int) session()->get('user')['id'];
    }

    public function index()
    {
        $data['meetings'] = $this->meetingModel->where('user_id', $this->getUserId())->findAll();
        return view('partials/meeting-content', $data);
    }

    public function getMeetings()
    {
        $meetings = $this->meetingModel->where('user_id', $this->getUserId())->findAll(); 
        return $this->response->setJSON($meetings);
    }

    public function save()
    {
        $this->meetingModel->save([
            'user_id'      => $this->getUserId(),
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
        
        $meetings = $this->meetingModel
            ->where('user_id', $this->getUserId())
            ->where('tanggal >=', $now)
            ->where('status !=', 'Sudah Dilaksanakan')
            ->orderBy('tanggal', 'ASC')
            ->limit(1)
            ->findAll();

        return $this->response->setJSON($meetings);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $userId = $this->getUserId();

        // Pastikan meeting milik user ini
        $meeting = $this->meetingModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        try {
            // Hapus participants terkait
            $participantModel = new ParticipantModel();
            $participantModel->where('meeting_id', $id)->delete();
            
            // Hapus discussions terkait
            $discussionModel = new DiscussionModel();
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
        $userId = $this->getUserId();

        // Pastikan meeting milik user ini
        $meeting = $this->meetingModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

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
