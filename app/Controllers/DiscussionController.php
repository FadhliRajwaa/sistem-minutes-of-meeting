<?php

namespace App\Controllers;

use App\Models\DiscussionModel;
use App\Models\MeetingModel;

class DiscussionController extends BaseController
{
    /**
     * Helper: ambil user_id dari session
     */
    private function getUserId(): int
    {
        return (int) session()->get('user')['id'];
    }

    public function index()
    {
        $meetingModel = new MeetingModel();

        // Hanya tampilkan meeting milik user ini
        $data['meetings'] = $meetingModel->where('user_id', $this->getUserId())->findAll();

        return view('partials/discussion-content', $data);
    }

    public function save()
    {
        $discussionModel = new DiscussionModel();
        $userId = $this->getUserId();

        // Verifikasi meeting milik user ini
        $meetingModel = new MeetingModel();
        $meetingId = $this->request->getPost('meeting_id');
        $meeting = $meetingModel->where('id', $meetingId)->where('user_id', $userId)->first();
        
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        $pembahasan = $this->request->getPost('pembahasan');
        $pembahasanJson = json_encode($pembahasan);

        $discussionModel->save([
            'user_id'      => $userId,
            'meeting_id'   => $meetingId,
            'topik'        => $this->request->getPost('topik'),
            'pembahasan'   => $pembahasanJson,
            'tanggal'      => $this->request->getPost('tanggal'),
            'nama_notulis' => $this->request->getPost('nama_notulis')
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Berhasil disimpan!']);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $userId = $this->getUserId();

        $model = new DiscussionModel();

        $data = $model->where('user_id', $userId)
                    ->groupStart()
                        ->like('topik', $keyword)
                        ->orLike('nama_notulis', $keyword)
                        ->orLike('tanggal', $keyword)
                    ->groupEnd()
                    ->findAll();

        return $this->response->setJSON($data);
    }

    public function delete()
    {
        $json = $this->request->getJSON();
        $id = $json->id;
        $userId = $this->getUserId();

        $model = new DiscussionModel();
        
        // Pastikan discussion milik user ini
        $discussion = $model->where('id', $id)->where('user_id', $userId)->first();
        if (!$discussion) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
        }
    }
}
