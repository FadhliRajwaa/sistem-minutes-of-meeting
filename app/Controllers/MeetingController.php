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

    public function index()
    {
        $data['meetings'] = $this->meetingModel
            ->where('user_id', $this->getUserId())
            ->orderBy('tanggal', 'DESC')
            ->findAll();
        return view('partials/meeting-content', $data);
    }

    public function getMeetings()
    {
        $meetings = $this->meetingModel
            ->select('id, nama_meeting, tanggal, tempat, status')
            ->where('user_id', $this->getUserId())
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return $this->response
            ->setHeader('Cache-Control', 'private, max-age=5')
            ->setJSON($meetings);
    }

    public function save()
    {
        $nama = trim($this->request->getPost('nama_meeting') ?? '');
        $tanggal = $this->request->getPost('tanggal');
        $tempat = trim($this->request->getPost('tempat') ?? '');

        if (empty($nama) || empty($tanggal) || empty($tempat)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Semua field harus diisi']);
        }

        $this->meetingModel->save([
            'user_id'      => $this->getUserId(),
            'nama_meeting' => $nama,
            'tanggal'      => $tanggal,
            'tempat'       => $tempat,
            'status'       => 'Belum Dilaksanakan'
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function getUpcoming()
    {
        $now = date('Y-m-d H:i:s');
        
        $meetings = $this->meetingModel
            ->select('id, nama_meeting, tanggal, tempat')
            ->where('user_id', $this->getUserId())
            ->where('tanggal >=', $now)
            ->where('status !=', 'Sudah Dilaksanakan')
            ->orderBy('tanggal', 'ASC')
            ->limit(1)
            ->findAll();

        return $this->response
            ->setHeader('Cache-Control', 'private, max-age=30')
            ->setJSON($meetings);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID tidak valid']);
        }

        $userId = $this->getUserId();
        $meeting = $this->meetingModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            (new ParticipantModel())->where('meeting_id', $id)->where('user_id', $userId)->delete();
            (new DiscussionModel())->where('meeting_id', $id)->where('user_id', $userId)->delete();
            $this->meetingModel->delete($id);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus meeting']);
            }

            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID tidak valid']);
        }

        $userId = $this->getUserId();
        $meeting = $this->meetingModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        $data = array_filter([
            'nama_meeting' => trim($this->request->getPost('nama_meeting') ?? ''),
            'tanggal'      => $this->request->getPost('tanggal'),
            'tempat'       => trim($this->request->getPost('tempat') ?? ''),
            'status'       => $this->request->getPost('status')
        ], fn($v) => $v !== '' && $v !== null);

        if (empty($data)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data untuk diupdate']);
        }

        if ($this->meetingModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal update data.']);
    }
}
